<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Category;
use App\Models\ProjectMilestone;
use App\Models\Stakeholder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Project::with('category');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('project_code', 'like', "%{$search}%")
                  ->orWhere('subtitle', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('stage')) {
            $query->where('stage', $request->stage);
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('location_type')) {
            $query->where('location_type', $request->location_type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $stats = [
            'total' => Project::count(),
            'upcoming' => Project::where('stage', 'upcoming')->count(),
            'ongoing' => Project::where('stage', 'ongoing')->count(),
            'completed' => Project::where('stage', 'completed')->count(),
        ];

        $projects   = $query->orderBy('created_at', 'desc')->paginate(20);
        $categories = Category::where('status', 'active')->get();

        return view('admin.project.list', compact('projects', 'categories', 'stats'));
    }

        /**
     * Validate project data
     */
    private function validateProject(Request $request, $action = 'store', $project = null)
    {
        $rules = [
            // Basic Details
            'project_code' => ['required', 'string', 'max:100'],
            'location_type' => ['required', 'in:RUR,URB,MET,MIX'],
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:category,id'],
            'short_description' => ['required', 'string', 'max:500'],
            'description' => ['required', 'string'],
            'planned_start_date' => ['required', 'date'],
            'planned_end_date' => ['nullable', 'date', 'after_or_equal:planned_start_date'],
            'stage' => ['required', 'in:upcoming,ongoing,completed'],

            // Location Details
            'target_location_type' => ['required', 'in:single,multiple'],
            'pincode' => ['nullable', 'string', 'max:10'],
            'state' => ['nullable', 'string', 'max:100'],
            'district' => ['nullable', 'string', 'max:100'],
            'taluk' => ['nullable', 'string', 'max:100'],
            'panchayat' => ['nullable', 'string', 'max:100'],
            'building_name' => ['nullable', 'string', 'max:255'],
            'gps_coordinates' => ['nullable', 'string', 'max:100'],
            'location_summary' => ['nullable', 'string'],
            'show_map_preview' => ['boolean'],

            // Strategic Goals
            'problem_statement' => ['required', 'string'],
            'baseline_survey' => ['nullable', 'string'],
            'expected_outcomes' => ['nullable', 'string'],
            'scalability_notes' => ['nullable', 'string'],
            'alignment_notes' => ['nullable', 'string'],
            'sustainability_plan' => ['required', 'string'],

            // CSR & Stakeholders
            'csr_invitation' => ['required', 'string'],
            'cta_button_text' => ['nullable', 'string', 'max:100'],

            // Resources & Risks (Upcoming)
            'resources_needed' => ['nullable', 'string'],
            'compliance_requirements' => ['nullable', 'string'],

            // Ongoing Stage Fields
            'last_update_summary' => ['nullable', 'string', 'max:500'],
            'project_progress' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'actual_beneficiary_count' => ['nullable', 'integer', 'min:0'],
            'challenges_identified' => ['nullable', 'string'],
            'compliance_requirement_status' => ['nullable', 'string'],
            'solutions_actions_taken' => ['nullable', 'string'],
            'completion_readiness' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'handover_sustainability_note' => ['nullable', 'string'],

            // Actual dates for ongoing/completed
            'actual_start_date' => ['nullable', 'date'],
            'actual_end_date' => ['nullable', 'date', 'after_or_equal:actual_start_date'],

            // SDG Goals validation
            'sdg_goals' => ['nullable', 'array'],
            'sdg_goals.*' => ['integer', 'min:1', 'max:17'],

            // Alignment Categories validation
            'alignment_categories' => ['nullable', 'array'],
            'alignment_categories.*' => ['in:sdg,nep2020,skill_india,nsqf,govt_schemes,csr_schedule_vii'],

            // Government Schemes validation
            'govt_schemes' => ['nullable', 'array'],
            'govt_schemes.*' => ['in:skill_india_mission,nsp,pmkvy,nlm,beti_bachao'],

            // File uploads
            'thumbnail_image' => [$action === 'update' ? 'nullable' : 'required', 'image', 'max:5120'], // 5MB
            'banner_images' => [$action === 'update' ? 'nullable' : 'required', 'image', 'max:5120'],
            'gallery_images.*' => ['nullable', 'image', 'max:5120'],
            'before_photo' => ['nullable', 'image', 'max:5120'],
            'expected_photo' => ['nullable', 'image', 'max:5120'],
            'impact_image' => ['nullable', 'image', 'max:5120'],

            // Array/JSON fields validation
            'multiple_locations' => ['nullable', 'array'],
            'donut_metrics' => ['nullable', 'array'],
            'target_groups' => ['nullable', 'array'],
            'objectives' => ['nullable', 'array'],
            'stakeholders' => ['nullable', 'array'],
            'risks' => ['nullable', 'array'],
            'operational_risks_ongoing' => ['nullable', 'array'],
            'resources_needed_ongoing' => ['nullable', 'array'],
            'documents' => ['nullable', 'array'],
            'links' => ['nullable', 'array'],

            // Status
            'status' => ['nullable', 'in:active,inactive'],
        ];

        // Add unique rule for slug in update
        if ($action === 'update' && $project) {
            $rules['slug'][] = Rule::unique('projects')->ignore($project->id);
            $rules['project_code'][] = Rule::unique('projects')->ignore($project->id);
        } else {
            $rules['slug'][] = 'unique:projects';
            $rules['project_code'][] = 'unique:projects';
        }

        // Conditional validation based on stage
        $stage = $request->input('stage', $project ? $project->stage : 'upcoming');

        if (in_array($stage, ['ongoing', 'completed'])) {
            $rules['last_update_summary'] = ['nullable', 'string', 'max:500'];
            $rules['actual_beneficiary_count'] = ['nullable', 'integer', 'min:0'];
            $rules['actual_start_date'] = ['nullable', 'date'];

            if ($stage === 'completed') {
                $rules['actual_end_date'] = ['required', 'date', 'after_or_equal:actual_start_date'];
                $rules['handover_sustainability_note'] = ['required', 'string'];
            }
        }

        return $request->validate($rules);
    }
    /**
     * Store a newly created resource.
     */
    public function store(Request $request)
    {
        $this->prepareSDGInput($request);
        $this->prepareArrayInputs($request);

        $validated = $this->validateProject($request, 'store');

        DB::beginTransaction();

        $filePaths = $this->handleFileUploads($request);

        $projectData = array_merge($validated, $filePaths);

        // 🚨 banner_images must ALWAYS be a string
        if (isset($projectData['banner_images']) && is_array($projectData['banner_images'])) {
            $projectData['banner_images'] = $projectData['banner_images'][0] ?? null;
        }

        $projectData['stage'] = 'upcoming';
        $projectData['status'] = 1;
        $projectData['slug']  = Str::slug($validated['slug']);

        // Encode ONLY real array fields
        $projectData = $this->encodeArrayFields($projectData);

        $project = Project::create($projectData);

        DB::commit();

        return redirect()->route('admin.project.index')
            ->with('success', 'Project created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $categories = Category::where('status', 1)->get();

        // Fields are already cast to arrays in the Project model
        $project->banner_images = $project->banner_images ?? [];
        $project->gallery_images = $project->gallery_images ?? [];
        $project->multiple_locations = $project->multiple_locations ?? [];
        $project->donut_metrics = $project->donut_metrics ?? [];
        $project->target_groups = $project->target_groups ?? [];
        $project->objectives = $project->objectives ?? [];
        $project->alignment_categories = $project->alignment_categories ?? [];
        $project->sdg_goals = $project->sdg_goals ?? [];
        $project->govt_schemes = $project->govt_schemes ?? [];
        $project->stakeholders = $project->stakeholders ?? [];
        $project->risks = $project->risks ?? [];
        $project->resources_needed_ongoing = $project->resources_needed_ongoing ?? [];
        $project->operational_risks_ongoing = $project->operational_risks_ongoing ?? [];
        $project->documents = $project->documents ?? [];
        $project->links = $project->links ?? [];

        return view('admin.project.edit', compact('project', 'categories'));
    }
    /**
     * Update the resource.
     */
    public function update(Request $request, Project $project)
    {
        $this->prepareSDGInput($request);
        $this->prepareArrayInputs($request);

        $validated = $this->validateProject($request, 'update', $project);

        DB::beginTransaction();

        $filePaths = $this->handleFileUploads($request, $project);

        $projectData = array_merge($validated, $filePaths);

        // 🚨 Normalize banner to STRING before JSON processing
        if (isset($projectData['banner_images']) && is_array($projectData['banner_images'])) {
            $projectData['banner_images'] = $projectData['banner_images'][0] ?? null;
        }

        // Process only REAL JSON fields
        $projectData = $this->prepareJsonData($projectData, $request);

        if (isset($projectData['status'])) {
            $projectData['status'] = $projectData['status'] === 'active' ? 1 : 0;
        }

        $projectData = $this->handleStageTransition($projectData, $project, $request);

        // 🔒 FINAL SAFETY — force SQL string value
        if (isset($projectData['banner_images'])) {
            $projectData['banner_images'] =
                $projectData['banner_images'] ? (string) $projectData['banner_images'] : null;
        }

        $project->update($projectData);

        DB::commit();

        return redirect()->route('admin.project.index')
            ->with('success', 'Project updated successfully!');
    }

    /**
     * Prepare SDG input from comma-separated string to array
     */
    protected function prepareSDGInput(Request $request)
    {
        if ($request->has('sdg_goals') && !empty($request->sdg_goals)) {
            // Handle comma-separated string from hidden input
            $sdgGoals = explode(',', $request->sdg_goals);
            $sdgGoals = array_map('intval', array_filter($sdgGoals));
            $sdgGoals = array_values(array_unique($sdgGoals)); // Remove duplicates
            sort($sdgGoals); // Sort ascending

            $request->merge(['sdg_goals' => $sdgGoals]);
        } else {
            $request->merge(['sdg_goals' => null]);
        }
    }

    /**
     * Prepare array inputs from the form
     */
    protected function prepareArrayInputs(Request $request)
    {
        // Handle dynamic arrays
        $arrayFields = [
            'multiple_locations',
            'donut_metrics',
            'target_groups',
            'objectives',
            'stakeholders',
            'risks',
            'documents',
            'links'
        ];

        foreach ($arrayFields as $field) {
            if ($request->has($field) && is_array($request->$field)) {
                // Filter out empty entries
                $filteredArray = array_filter($request->$field, function($item) {
                    if (is_array($item)) {
                        return !empty(array_filter($item, function($value) {
                            return !is_null($value) && $value !== '';
                        }));
                    }
                    return !empty(trim($item));
                });

                // Re-index array
                $request->merge([$field => array_values($filteredArray)]);
            } elseif ($request->has($field)) {
                // Ensure it's always an array
                $request->merge([$field => null]);
            }
        }

        // Handle alignment categories (multi-select)
        if ($request->has('alignment_categories')) {
            $alignmentCategories = $request->input('alignment_categories');
            if (!is_array($alignmentCategories)) {
                $alignmentCategories = !empty($alignmentCategories) ? [$alignmentCategories] : [];
            }
            $request->merge(['alignment_categories' => array_values(array_filter($alignmentCategories))]);
        } else {
            $request->merge(['alignment_categories' => []]);
        }

        // Handle govt schemes (multi-select)
        if ($request->has('govt_schemes')) {
            $govtSchemes = $request->input('govt_schemes');
            if (!is_array($govtSchemes)) {
                $govtSchemes = !empty($govtSchemes) ? [$govtSchemes] : [];
            }
            $request->merge(['govt_schemes' => array_values(array_filter($govtSchemes))]);
        } else {
            $request->merge(['govt_schemes' => null]);
        }

        // Handle target groups - ensure proper structure
        if ($request->has('target_groups') && is_array($request->target_groups)) {
            $targetGroups = [];
            foreach ($request->target_groups as $group) {
                if (!empty($group['group']) && !empty($group['count'])) {
                    $targetGroups[] = [
                        'group' => $group['group'],
                        'count' => (int) $group['count'],
                        'notes' => $group['notes'] ?? ''
                    ];
                }
            }
            $request->merge(['target_groups' => $targetGroups]);
        }

        // Handle donut metrics - ensure proper structure
        if ($request->has('donut_metrics') && is_array($request->donut_metrics)) {
            $donutMetrics = [];
            foreach ($request->donut_metrics as $metric) {
                if (!empty($metric['label']) && !empty($metric['value'])) {
                    $donutMetrics[] = [
                        'label' => $metric['label'],
                        'value' => (int) $metric['value'],
                        'notes' => $metric['notes'] ?? ''
                    ];
                }
            }
            $request->merge(['donut_metrics' => $donutMetrics]);
        }

        // Handle boolean toggle for show_map_preview
        $request->merge([
            'show_map_preview' => $request->has('show_map_preview') || $request->input('show_map_preview') == '1' ? 1 : 0
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }
    /**
     * JSON encode ONLY these fields.
     */
    protected function encodeArrayFields($data)
    {
        $arrayFields = [
            'alignment_categories',
            'govt_schemes',
            'sdg_goals',
            'target_groups',
            'donut_metrics',
            'stakeholders',
            'risks',
            'gallery_images',
            'documents',
            'links',
            'multiple_locations',
            'resources_needed_ongoing',
            'operational_risks_ongoing'
        ];

        foreach ($arrayFields as $field) {
            if (isset($data[$field]) && is_array($data[$field])) {
                $data[$field] = json_encode($data[$field]);
            }
        }

        return $data;
    }

    /**
     * Banner upload logic (unchanged — still correct)
     */
    private function handleFileUploads(Request $request, $project = null)
    {
        $filePaths = [];

        // Single fields
        $singleFiles = [
            'thumbnail_image','before_photo','expected_photo','impact_image'
        ];

        foreach ($singleFiles as $field) {
            if ($request->has("removed_$field") && $project && $project->$field) {
                File::delete(public_path($project->$field));
                $filePaths[$field] = null;
            }

            if ($request->hasFile($field)) {
                if ($project && $project->$field) {
                    File::delete(public_path($project->$field));
                }

                $file = $request->file($field);
                $name = time().'_'.$file->getClientOriginalName();
                $dir  = public_path('projects');

                if (!File::exists($dir)) File::makeDirectory($dir, 0755, true);

                $file->move($dir, $name);
                $filePaths[$field] = "projects/$name";
            }
        }

        // 🚨 Banner — SINGLE file
        if ($request->hasFile('banner_images')) {

            if ($project && $project->banner_images) {
                File::delete(public_path($project->banner_images));
            }

            $file = $request->file('banner_images');
            $name = time().'_'.$file->getClientOriginalName();
            $dir  = public_path('projects');

            if (!File::exists($dir)) File::makeDirectory($dir, 0755, true);

            $file->move($dir, $name);

            $filePaths['banner_images'] = "projects/$name"; // ← STRING
        }

        if ($request->has('removed_banner_image') && $project?->banner_images) {
            File::delete(public_path($project->banner_images));
            $filePaths['banner_images'] = null;
        }

        // Gallery stays array
        $gallery = ($project && is_array($project->gallery_images))
            ? $project->gallery_images : [];

        if ($request->has('removed_gallery_image')) {
            foreach ((array)$request->removed_gallery_image as $g) {
                File::delete(public_path($g));
                $gallery = array_diff($gallery, [$g]);
            }
        }

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $img) {
                $name = time().'_'.$img->getClientOriginalName();
                $dir  = public_path('projects');
                if (!File::exists($dir)) File::makeDirectory($dir, 0755, true);
                $img->move($dir, $name);
                $gallery[] = "projects/$name";
            }
        }

        $filePaths['gallery_images'] = array_values($gallery);

        return $filePaths;
    }

    /**
     * JSON fields (banner NOT included)
     */
    private function prepareJsonData(array $data, Request $request)
    {
        $jsonFields = [
            'multiple_locations','donut_metrics','target_groups','objectives',
            'alignment_categories','sdg_goals','govt_schemes',
            'stakeholders','risks','links'
        ];

        foreach ($jsonFields as $field) {
            if (isset($data[$field]) && is_array($data[$field])) {
                $data[$field] = array_values(array_filter($data[$field]));
            }
        }

        return $data;
    }


    /**
     * Handle stage transition logic
     */
    private function handleStageTransition(array $data, Project $project, Request $request)
    {
        $oldStage = $project->stage;
        $newStage = $data['stage'];

        // If moving from upcoming to ongoing
        if ($oldStage === 'upcoming' && $newStage === 'ongoing') {
            // Set actual start date if not set
            if (empty($data['actual_start_date'])) {
                $data['actual_start_date'] = now()->toDateString();
            }

            // Set initial progress
            if (empty($data['project_progress'])) {
                $data['project_progress'] = 0;
            }
        }

        // If moving from ongoing to completed
        if ($oldStage === 'ongoing' && $newStage === 'completed') {
            // Set actual end date if not set
            if (empty($data['actual_end_date'])) {
                $data['actual_end_date'] = now()->toDateString();
            }

            // Set completion readiness to 100% if not set
            if (empty($data['completion_readiness'])) {
                $data['completion_readiness'] = 100;
            }

            // Set project progress to 100% if not set
            if (empty($data['project_progress'])) {
                $data['project_progress'] = 100;
            }
        }

        return $data;
    }

    /**
     * Delete project files
     */
    private function deleteProjectFiles(Project $project)
    {
        // Delete thumbnail
        if ($project->thumbnail_image) {
            File::delete(public_path($project->thumbnail_image));
        }

        // Delete banner images safely (single or multiple)
        if (!empty($project->banner_images)) {

            $images = is_array($project->banner_images)
                ? $project->banner_images
                : [$project->banner_images]; // convert single to array

            foreach ($images as $banner) {
                File::delete(public_path($banner));
            }
        }


        // Delete gallery images
        if ($project->gallery_images && is_array($project->gallery_images)) {
            foreach ($project->gallery_images as $image) {
                File::delete(public_path($image));
            }
        }

        // Delete other images
        $otherImages = ['before_photo', 'expected_photo', 'impact_image'];
        foreach ($otherImages as $imageField) {
            if ($project->$imageField) {
                File::delete(public_path($project->$imageField));
            }
        }

        // Delete documents
        if ($project->documents && is_array($project->documents)) {
            foreach ($project->documents as $document) {
                if (isset($document['file'])) {
                    File::delete(public_path($document['file']));
                }
            }
        }
    }

    /**
     * Toggle project status
     */
    public function toggleStatus(Project $project)
    {
        try {
            $project->status = $project->status === 'active' ? 'inactive' : 'active';
            $project->save();

            return redirect()->back()
                ->with('success', 'Project status updated successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating project status: ' . $e->getMessage());
        }
    }

    /**
     * Show project details (frontend view)
     */
    public function showDetails($slug)
    {
        $project = Project::with('category')
            ->where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        return view('frontend.projects.show', compact('project'));
    }

    /**
     * List projects by category (frontend)
     */
    public function byCategory($categorySlug)
    {
        $category = Category::where('slug', $categorySlug)
            ->where('status', 'active')
            ->firstOrFail();

        $projects = Project::where('category_id', $category->id)
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('frontend.projects.category', compact('category', 'projects'));
    }

    /**
     * Export projects to CSV
     */
    public function export()
    {
        $projects = Project::with('category')->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="projects_' . date('Y-m-d') . '.csv"',
        ];

        $callback = function() use ($projects) {
            $file = fopen('php://output', 'w');

            // Add CSV headers
            fputcsv($file, [
                'ID', 'Project Code', 'Title', 'Category', 'Stage',
                'Location Type', 'Start Date', 'End Date', 'Progress',
                'Beneficiary Count', 'Status', 'Created At'
            ]);

            // Add data rows
            foreach ($projects as $project) {
                fputcsv($file, [
                    $project->id,
                    $project->project_code,
                    $project->title,
                    $project->category->name ?? 'N/A',
                    ucfirst($project->stage),
                    $project->location_type,
                    $project->planned_start_date,
                    $project->planned_end_date,
                    $project->project_progress . '%',
                    $project->actual_beneficiary_count,
                    $project->status,
                    $project->created_at->format('Y-m-d H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function getStats()
    {
        $stats = [
            'total' => Project::count(),
            'upcoming' => Project::where('stage', 'upcoming')->count(),
            'ongoing' => Project::where('stage', 'ongoing')->count(),
            'completed' => Project::where('stage', 'completed')->count(),
            'active' => Project::where('status', 'active')->count(),
            'inactive' => Project::where('status', 'inactive')->count(),
        ];

        return response()->json($stats);
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:activate,deactivate,delete',
            'ids' => 'required|array',
            'ids.*' => 'exists:projects,id'
        ]);

        try {
            DB::beginTransaction();

            switch ($request->action) {
                case 'activate':
                    Project::whereIn('id', $request->ids)->update(['status' => 'active']);
                    $message = 'Projects activated successfully';
                    break;

                case 'deactivate':
                    Project::whereIn('id', $request->ids)->update(['status' => 'inactive']);
                    $message = 'Projects deactivated successfully';
                    break;

                case 'delete':
                    $projects = Project::whereIn('id', $request->ids)->get();
                    foreach ($projects as $project) {
                        $this->deleteProjectFiles($project);
                        $project->delete();
                    }
                    $message = 'Projects deleted successfully';
                    break;
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => $message
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Error performing bulk action: ' . $e->getMessage()
            ], 500);
        }
    }

    public function createMilestone($projectid){
        $project = Project::findOrFail($projectid);
        $stakeholders = Stakeholder::where('status', 'active')->get();
        $milestones = ProjectMilestone::where('project_id', $projectid)->get();

        return view('admin.project.milestone', compact('project', 'stakeholders', 'milestones'));
    }

    public function storeMilestones(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'tasks' => 'array',
            'tasks.*.stakeholder_id' => 'required|exists:stakeholders,id',
            'tasks.*.phase' => 'required|string',
            'tasks.*.task_name' => 'required|string',
            'delete_tasks' => 'array'
        ]);

        try {
            DB::beginTransaction();

            $projectId = $request->project_id;
            $updatedTasks = [];

            // Handle deletions
            if ($request->has('delete_tasks')) {
                ProjectMilestone::whereIn('id', $request->delete_tasks)->delete();
            }

            // Handle updates and creations
            if ($request->has('tasks')) {
                foreach ($request->tasks as $taskData) {
                    $task = ProjectMilestone::updateOrCreate(
                        [
                            'id' => $taskData['id'] ?? null,
                            'project_id' => $projectId
                        ],
                        [
                            'stakeholder_id' => $taskData['stakeholder_id'],
                            'phase' => $taskData['phase'],
                            'task_name' => $taskData['task_name'],
                            'planned_start_date' => $taskData['start_date'] ?: null,
                            'planned_end_date' => $taskData['end_date'] ?: null,
                            'in_charge' => $taskData['in_charge'],
                            'priority' => $taskData['priority'],
                            'status' => $taskData['status'],
                            'progress' => $taskData['progress'],
                            'notes' => $taskData['notes']
                        ]
                    );

                    $updatedTasks[] = [
                        'client_id' => $taskData['client_id'] ?? null,
                        'id' => $task->id
                    ];
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Milestones saved successfully',
                'updated_tasks' => $updatedTasks
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error saving milestones: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getMilestones($projectId)
    {
        try {
            $milestones = ProjectMilestone::where('project_id', $projectId)
                ->with('stakeholder')
                ->orderBy('phase')
                ->get();

            return response()->json([
                'success' => true,
                'milestones' => $milestones
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching milestones: ' . $e->getMessage()
            ], 500);
        }
    }
        public function createEstmator($projectid){
            $projects = Project::findOrFail($projectid);
            return view('admin.project.estmator',compact('projects'));
        }
}
