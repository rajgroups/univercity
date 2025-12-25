<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Project;
use App\Models\ProjectEstimation;
use App\Models\EstimationItem;
use App\Models\ProjectDonor;
use App\Models\ProjectFunding;
use App\Models\ProjectUtilization;
use App\Models\Admin; 
use App\Models\User; // Just in case
use Illuminate\Support\Facades\Hash;

class ProjectEstimatorTest extends TestCase
{
    // Use RefreshDatabase if possible, but be careful with existing data. 
    // Since I'm on a real dev env, I might NOT want to wipe DB.
    // I will use explicit cleanup instead of RefreshDatabase traits if I'm not sure.
    // Better to create data and delete it.

    protected $admin;
    protected $project;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Find or create an admin
        $this->admin = Admin::first();
        if (!$this->admin) {
            $this->admin = Admin::create([
                'name' => 'Test Admin',
                'email' => 'testadmin@example.com',
                'password' => Hash::make('password'),
                // add other required fields if any
            ]);
        }

        // Create a project
        $code = 'TEST-' . rand(1000, 9999);
        $this->project = Project::create([
            'title' => 'Test Project Estimator',
            'project_code' => $code,
            'slug' => 'test-project-estimator-' . $code,
            'status' => 1,
            'category_id' => 1, // Assume category 1 exists
            'description' => 'Test',
            'short_description' => 'Test',
            'stage' => 'upcoming',
            'location_type' => 'URB',
            'target_location_type' => 'single',
            'problem_statement' => 'test',
            'sustainability_plan' => 'test',
            'csr_invitation' => 'test',
            'planned_start_date' => now(),
            'planned_end_date' => now()->addDays(30),
        ]);
    }

    protected function tearDown(): void
    {
        if ($this->project) {
            // Cleanup related data
            ProjectEstimation::where('project_id', $this->project->id)->delete();
            ProjectDonor::where('project_id', $this->project->id)->delete();
            ProjectUtilization::where('project_id', $this->project->id)->delete();
            $this->project->forceDelete();
        }
        parent::tearDown();
    }

    public function test_estimator_index_page_loads()
    {
        $response = $this->actingAs($this->admin, 'admin')
            ->get(route('admin.project.estmator.index', $this->project->id));

        $response->assertStatus(200);
        $response->assertViewHas('project');
        $response->assertViewHas('estimation');
    }

    public function test_create_and_update_estimation_item()
    {
        // First ensure estimation exists (created by index or manually)
        $estimation = ProjectEstimation::create([
            'project_id' => $this->project->id,
            'version' => 'V1'
        ]);

        $data = [
            'estimation_id' => $estimation->id,
            'category' => 'Hardware',
            'item_name' => 'Test Laptop',
            'quantity' => 2,
            'unit_cost' => 50000,
            'phase' => 'P1'
        ];

        $response = $this->actingAs($this->admin, 'admin')
            ->postJson(route('admin.project.estmator.item.store'), $data);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);
        
        $this->assertDatabaseHas('estimation_items', ['item_name' => 'Test Laptop']);

        // Update
        $item = EstimationItem::where('item_name', 'Test Laptop')->first();
        $data['id'] = $item->id;
        $data['quantity'] = 3;

        $response = $this->actingAs($this->admin, 'admin')
            ->postJson(route('admin.project.estmator.item.store'), $data);
        
        $response->assertStatus(200);
        $this->assertDatabaseHas('estimation_items', ['id' => $item->id, 'quantity' => 3]);
    }

    public function test_create_donor()
    {
        $data = [
            'project_id' => $this->project->id,
            'name' => 'Test Donor',
            'amount' => 10000
        ];

        $response = $this->actingAs($this->admin, 'admin')
            ->postJson(route('admin.project.estmator.donor.store'), $data);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        $this->assertDatabaseHas('project_donors', ['name' => 'Test Donor']);
    }

    public function test_create_utilization()
    {
        $data = [
            'project_id' => $this->project->id,
            'category' => 'Hardware',
            'item_name' => 'Bought Laptop',
            'estimated_amount' => 50000,
            'actual_amount' => 45000,
            'phase' => 'P1'
        ];

        $response = $this->actingAs($this->admin, 'admin')
            ->postJson(route('admin.project.estmator.utilization.store'), $data);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        $this->assertDatabaseHas('project_utilizations', ['item_name' => 'Bought Laptop']);
    }

    public function test_import_from_estimation()
    {
        // 1. Create Estimation Item
        $estimation = ProjectEstimation::create([
            'project_id' => $this->project->id,
            'version' => 'V1'
        ]);
        
        EstimationItem::create([
            'estimation_id' => $estimation->id,
            'category' => 'Software',
            'item_name' => 'Importable Soft',
            'quantity' => 1,
            'unit_cost' => 1000,
            'total_cost' => 1000,
            'phase' => 'P2'
        ]);

        // 2. Call Import Endpoint
        $response = $this->actingAs($this->admin, 'admin')
            ->postJson(route('admin.project.estmator.import'), [
                'project_id' => $this->project->id,
                'estimation_id' => $estimation->id
            ]);

        // 3. Verify Success
        $response->assertStatus(200)
            ->assertJson(['success' => true]);
        
        // 4. Verify Utilization Created
        $this->assertDatabaseHas('project_utilizations', [
            'item_name' => 'Importable Soft',
            'estimated_amount' => 1000,
            'actual_amount' => 0 // Default
        ]);
    }

    public function test_funds_received_tracker()
    {
        // 1. Create Funding
        $data = [
            'project_id' => $this->project->id,
            'source_type' => 'Donor A',
            'amount' => 5000,
            'received_date' => now()->format('Y-m-d'),
            'notes' => 'First Installment'
        ];

        $response = $this->actingAs($this->admin, 'admin')
            ->postJson(route('admin.project.estmator.funding.store'), $data);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        // 2. Verify Database
        $this->assertDatabaseHas('project_fundings', ['source_type' => 'Donor A', 'amount' => 5000]);

        // 3. Delete Funding
        $funding = ProjectFunding::where('source_type', 'Donor A')->first();
        $response = $this->actingAs($this->admin, 'admin')
            ->deleteJson(route('admin.project.estmator.funding.delete', $funding->id));

        $response->assertStatus(200);
        $this->assertDatabaseMissing('project_fundings', ['id' => $funding->id]);
    }

    public function test_import_handles_duplicate_items()
    {
        // 1. Create Estimation with 2 Identical Items
        $estimation = ProjectEstimation::create([
            'project_id' => $this->project->id,
            'version' => 'V1'
        ]);
        
        // Item 1
        EstimationItem::create([
            'estimation_id' => $estimation->id,
            'category' => 'Hardware',
            'item_name' => 'SameItem',
            'quantity' => 1,
            'unit_cost' => 100,
            'total_cost' => 100,
            'phase' => 'P1'
        ]);
        // Item 2 (Identical to Item 1)
        EstimationItem::create([
            'estimation_id' => $estimation->id,
            'category' => 'Hardware',
            'item_name' => 'SameItem',
            'quantity' => 1,
            'unit_cost' => 200,
            'total_cost' => 200,
            'phase' => 'P1'
        ]);

        // 2. Call Import Endpoint
        $response = $this->actingAs($this->admin, 'admin')
            ->postJson(route('admin.project.estmator.import'), [
                'project_id' => $this->project->id,
                'estimation_id' => $estimation->id
            ]);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        // 3. Verify BOTH are imported (Count should be 2 for this project)
        $count = ProjectUtilization::where('project_id', $this->project->id)->count();
        $this->assertEquals(2, $count, "Expected 2 items imported, found $count");
    }
}
