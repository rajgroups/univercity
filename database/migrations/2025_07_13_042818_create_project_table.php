<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            // Section 0 & 1: Basic Project Details
            $table->string('project_code')->unique();
            $table->string('location_type'); // RUR, URB, MET, MIX
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('slug')->unique();
            $table->foreignId('category_id')->constrained('category')->onDelete('cascade');
            $table->text('short_description');
            $table->longText('description');
            $table->json('banner_images')->nullable();
            $table->string('thumbnail_image')->nullable();
            $table->date('planned_start_date');
            $table->date('planned_end_date')->nullable();
            $table->enum('stage', ['upcoming', 'ongoing', 'completed'])->default('upcoming');

            // Section 2: Target Location Details
            $table->enum('target_location_type', ['single', 'multiple'])->default('single');
            $table->string('pincode')->nullable();
            $table->string('state')->nullable();
            $table->string('district')->nullable();
            $table->string('taluk')->nullable();
            $table->string('panchayat')->nullable();
            $table->string('building_name')->nullable();
            $table->string('gps_coordinates')->nullable();
            $table->json('multiple_locations')->nullable();
            $table->text('location_summary')->nullable();
            $table->boolean('show_map_preview')->default(false);

            // Section 3: Strategic Goals, Objective & Impact Alignment
            $table->text('problem_statement');
            $table->text('baseline_survey')->nullable();
            $table->json('donut_metrics')->nullable();
            $table->json('target_groups')->nullable();
            $table->json('objectives')->nullable();
            $table->text('expected_outcomes')->nullable();
            $table->string('impact_image')->nullable();
            $table->text('scalability_notes')->nullable();
            $table->json('alignment_categories')->nullable();
            $table->json('sdg_goals')->nullable();
            $table->json('govt_schemes')->nullable();
            $table->text('alignment_notes')->nullable();
            $table->text('sustainability_plan');

            // Section 5: CSR & Stakeholders Engagement
            $table->text('csr_invitation');
            $table->string('cta_button_text')->default('Register Your Interest');
            $table->json('stakeholders')->nullable();

            // Section 6: Resource & Operation Compliance Risks (Upcoming Stage)
            $table->text('resources_needed')->nullable();
            $table->text('compliance_requirements')->nullable();
            $table->json('risks')->nullable();

            // Section 6: Update of Execution – Ongoing Stage (NEW)
            $table->text('last_update_summary')->nullable();
            $table->decimal('project_progress', 5, 2)->default(0);
            $table->integer('actual_beneficiary_count')->default(0);
            $table->text('challenges_identified')->nullable();
            $table->json('resources_needed_ongoing')->nullable();
            $table->json('operational_risks_ongoing')->nullable();
            $table->text('compliance_requirement_status')->nullable();
            $table->text('solutions_actions_taken')->nullable();
            $table->decimal('completion_readiness', 5, 2)->nullable();
            $table->text('handover_sustainability_note')->nullable();
            $table->boolean('status')->default(true);

            // Section 7: Media and Documents
            $table->json('gallery_images')->nullable();
            $table->string('before_photo')->nullable();
            $table->string('expected_photo')->nullable();
            $table->json('documents')->nullable();
            $table->json('links')->nullable();

            // Timestamps
            $table->timestamps();
            $table->softDeletes();

            // Indexes for better performance
            $table->index('project_code');
            $table->index('stage');
            $table->index('category_id');
            $table->index('location_type');
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
