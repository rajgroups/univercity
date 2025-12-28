<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Category;
use App\Models\ProjectMilestone;
use App\Models\Stakeholder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
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

        // Apply filters
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

        // Get stats for dashboard
        $stats = [
            'total' => Project::count(),
            'upcoming' => Project::where('stage', 'upcoming')->count(),
            'ongoing' => Project::where('stage', 'ongoing')->count(),
            'completed' => Project::where('stage', 'completed')->count(),
        ];

        $projects = $query->orderBy('created_at', 'desc')->paginate(20);
        $categories = Category::where('status', 'active')->get();
        // dd($projects);
        return view('admin.project.list', compact('projects', 'categories', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 1)->get();

        $year = date('Y');
        $locationCode = 'LOC';

        // Get last project of the current year
        $lastProject = Project::whereYear('created_at', $year)
            ->orderBy('id', 'desc')
            ->first();

        if ($lastProject) {
            // Extract last sequence number
            $lastCode = $lastProject->project_code; // ISICO-2025-LOC-0007
            $lastSequence = (int) substr($lastCode, -4);
            $sequence = $lastSequence + 1;
        } else {
            // ✅ No project found (initial case)
            $sequence = 1;
        }

        $projectCode = 'ISICO-' . $year . '-' . $locationCode . '-' . str_pad($sequence, 4, '0', STR_PAD_LEFT);

        return view('admin.project.add', compact('categories', 'projectCode'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Handle SDG input - convert comma-separated string to array
        $this->prepareSDGInput($request);

        // Handle other array inputs
        $this->prepareArrayInputs($request);

        // Validate the request
        $validated = $this->validateProject($request, 'store');

        Log::info('Project@store: After validation', ['alignment_categories' => $validated['alignment_categories'] ?? 'MISSING']);

        try {
            DB::beginTransaction();

            // Handle file uploads
            $filePaths = $this->handleFileUploads($request);

            // Create the project and prepare array data
            $projectData = array_merge($validated, $filePaths);

            // Stage and status defaults
            $projectData['stage'] = 'upcoming';
            $projectData['status'] = 1;
            $projectData['slug'] = Str::slug($validated['slug']);

            // ========== CRITICAL FIX: Manually encode all array fields ==========
            $projectData = $this->encodeArrayFields($projectData);
            // ====================================================================

            // Debug before create
            Log::info('Before creating project', [
                'alignment_categories' => $projectData['alignment_categories'],
                'govt_schemes' => $projectData['govt_schemes'],
                'sdg_goals' => $projectData['sdg_goals'] ?? 'not set'
            ]);

            $project = Project::create($projectData);

            DB::commit();

            return redirect()->route('admin.project.index')
                ->with('success', 'Project created successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Project creation error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error creating project: ' . $e->getMessage());
        }
    }

    // Add this new method to your controller
    protected function encodeArrayFields($data)
    {
        // List of all array fields that need JSON encoding
        $arrayFields = [
            'alignment_categories',
            'govt_schemes',
            'sdg_goals',
            'target_groups',
            'donut_metrics',
            'stakeholders',
            'risks',
            'banner_images',
            'gallery_images',
            'documents',
            'links',
            'multiple_locations',
            'resources_needed_ongoing',
            'operational_risks_ongoing'
        ];

        foreach ($arrayFields as $field) {
            if (isset($data[$field]) && is_array($data[$field])) {
                // Encode array to JSON
                $data[$field] = json_encode($data[$field]);
            } elseif (isset($data[$field]) && is_string($data[$field])) {
                // If it's already a string, check if it's valid JSON
                $decoded = json_decode($data[$field], true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    // If not valid JSON, encode as empty array
                    $data[$field] = json_encode([]);
                }
            } else {
                // Set default empty JSON array
                $data[$field] = json_encode([]);
            }
        }

        return $data;
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        // Handle SDG input - convert comma-separated string to array
        $this->prepareSDGInput($request);

        // Handle other array inputs
        $this->prepareArrayInputs($request);

        // Validate the request
        $validated = $this->validateProject($request, 'update', $project);
        Log::info('Project@update: After validation', ['alignment_categories' => $validated['alignment_categories'] ?? 'MISSING']);

        try {
            DB::beginTransaction();

            // Handle file uploads (update only)
            $filePaths = $this->handleFileUploads($request, $project);

            // Update the project data
            $projectData = array_merge($validated, $filePaths);

            // Prepare array data
            $projectData = $this->prepareJsonData($projectData, $request);

            // Convert status to boolean/integer if present
            if (isset($projectData['status'])) {
                $projectData['status'] = $projectData['status'] === 'active' ? 1 : 0;
            }

            // Handle stage transition logic
            $projectData = $this->handleStageTransition($projectData, $project, $request);

            $project->update($projectData);

            DB::commit();

            return redirect()->route('admin.project.index')
                ->with('success', 'Project updated successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Error updating project: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        try {
            // Delete associated files
            $this->deleteProjectFiles($project);

            $project->delete();

            return redirect()->route('admin.project.index')
                ->with('success', 'Project deleted successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error deleting project: ' . $e->getMessage());
        }
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
     * Handle file uploads
     */
    private function handleFileUploads(Request $request, $project = null)
    {
        $filePaths = [];

        /*
        |--------------------------------------------------------------------------
        | 1) Single File Uploads (thumbnail, before, expected, impact)
        |--------------------------------------------------------------------------
        */
        $singleFiles = [
            'thumbnail_image',
            'before_photo',
            'expected_photo',
            'impact_image'
        ];

        foreach ($singleFiles as $field) {

            // Remove existing file if user explicitly removed it
            if ($request->has("removed_{$field}") && $request->input("removed_{$field}")) {
                if ($project && $project->$field) {
                    $absolutePath = public_path($project->$field);
                    if (File::exists($absolutePath)) {
                        File::delete($absolutePath);
                    }
                }
                $filePaths[$field] = null;
            }

            // Upload new file
            if ($request->hasFile($field)) {

                // Delete previous file
                if ($project && $project->$field && !isset($filePaths[$field])) {
                    $absolutePath = public_path($project->$field);
                    if (File::exists($absolutePath)) {
                        File::delete($absolutePath);
                    }
                }

                $file = $request->file($field);
                $filename = time().'_'.$file->getClientOriginalName();

                $relativePath = 'projects';
                $absolutePath = public_path($relativePath);

                if (!File::exists($absolutePath)) {
                    File::makeDirectory($absolutePath, 0755, true);
                }

                $file->move($absolutePath, $filename);

                $filePaths[$field] = $relativePath.'/'.$filename;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | 2) Banner Image (SINGLE file — not array)
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('banner_images')) {

            // Delete old banner if exists
            if ($project && $project->banner_images) {
                $absolutePath = public_path($project->banner_images);
                if (File::exists($absolutePath)) {
                    File::delete($absolutePath);
                }
            }

            $banner = $request->file('banner_images');
            $filename = time().'_'.$banner->getClientOriginalName();

            $relativePath = 'projects';
            $absolutePath = public_path($relativePath);

            if (!File::exists($absolutePath)) {
                File::makeDirectory($absolutePath, 0755, true);
            }

            $banner->move($absolutePath, $filename);

            // Store as SINGLE string
            $filePaths['banner_images'] = $relativePath.'/'.$filename;
        }

        // User removed banner
        if ($request->has('removed_banner_image') && $request->input('removed_banner_image')) {
            if ($project && $project->banner_images) {
                $absolutePath = public_path($project->banner_images);
                if (File::exists($absolutePath)) {
                    File::delete($absolutePath);
                }
            }

            $filePaths['banner_images'] = null;
        }


        /*
        |--------------------------------------------------------------------------
        | 3) Gallery Images (MULTIPLE)
        |--------------------------------------------------------------------------
        */
        $currentGallery = ($project && $project->gallery_images) ? $project->gallery_images : [];
        if (!is_array($currentGallery)) $currentGallery = [];

        // Remove gallery images
        if ($request->has('removed_gallery_image')) {
            $galleryToRemove = $request->input('removed_gallery_image');
            if (!is_array($galleryToRemove)) $galleryToRemove = [$galleryToRemove];

            $currentGallery = array_diff($currentGallery, $galleryToRemove);

            foreach ($galleryToRemove as $path) {
                $absolutePath = public_path($path);
                if (File::exists($absolutePath)) {
                    File::delete($absolutePath);
                }
            }
        }

        // Upload new gallery images
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $galleryImage) {

                $filename = time().'_'.$galleryImage->getClientOriginalName();
                $relativePath = 'projects';
                $absolutePath = public_path($relativePath);

                if (!File::exists($absolutePath)) {
                    File::makeDirectory($absolutePath, 0755, true);
                }

                $galleryImage->move($absolutePath, $filename);

                $currentGallery[] = $relativePath.'/'.$filename;
            }
        }

        $filePaths['gallery_images'] = array_values($currentGallery);


        /*
        |--------------------------------------------------------------------------
        | 4) Documents (existing + new)
        |--------------------------------------------------------------------------
        */
        if ($request->has('documents')) {

            $finalDocuments = [];
            $inputDocs = $request->input('documents');

            foreach ($inputDocs as $index => $docData) {

                $docPath  = null;
                $docLabel = $docData['label'] ?? '';
                $docNotes = $docData['notes'] ?? '';

                // New uploaded file
                if ($request->hasFile("documents.{$index}.file")) {

                    $file = $request->file("documents.{$index}.file");
                    $filename = time().'_'.$file->getClientOriginalName();

                    $relativePath = 'projects';
                    $absolutePath = public_path($relativePath);

                    if (!File::exists($absolutePath)) {
                        File::makeDirectory($absolutePath, 0755, true);
                    }

                    $file->move($absolutePath, $filename);

                    $docPath = $relativePath.'/'.$filename;
                }
                // Keep existing file
                elseif ($request->has("existing_documents.{$index}.file")) {
                    $docPath = $request->input("existing_documents.{$index}.file");
                }

                if ($docPath) {
                    $finalDocuments[] = [
                        'label' => $docLabel,
                        'file'  => $docPath,
                        'notes' => $docNotes,
                    ];
                }
            }

            $filePaths['documents'] = $finalDocuments;
        }

        return $filePaths;
    }

    /**
     * Prepare JSON data for database storage
     */
    private function prepareJsonData(array $data, Request $request)
    {
        $jsonFields = [
            'multiple_locations',
            'donut_metrics',
            'target_groups',
            'objectives',
            'alignment_categories',
            'sdg_goals',
            'govt_schemes',
            'stakeholders',
            'risks',
            'links'
        ];

        foreach ($jsonFields as $field) {
            if (isset($data[$field])) {
                // If it's a JSON string, decode it to an array (since model will re-encode it)
                if (is_string($data[$field])) {
                    $decoded = json_decode($data[$field], true);
                    $data[$field] = is_array($decoded) ? $decoded : null;
                }

                if (is_array($data[$field])) {
                    $filteredData = array_filter($data[$field], function ($item) {
                        if (!is_array($item)) {
                            // Allow 0 as a valid value (important for IDs or boolean-like metrics)
                            return $item !== null && $item !== '';
                        }
                        return !empty(array_filter($item, function ($value) {
                            return $value !== null && $value !== '';
                        }));
                    });
                    $data[$field] = array_values($filteredData);
                }
            } elseif ($request->has($field)) {
                $fieldData = $request->input($field);
                if (is_array($fieldData)) {
                    $data[$field] = array_values(array_filter($fieldData));
                }
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
