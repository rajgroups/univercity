<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\SDGHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::latest()->get();
        return view('admin.project.list', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sdgs = SDGHelper::getAllSDGs();
        $categories = Category::where('status', 1)->get();

        // Generate next serial for project code
        $year = date('Y');
        $prefix = 'ISICO';
        $slug = 'RUR';

        $lastProject = Project::whereYear('created_at', $year)
            ->orderByDesc('id')
            ->first();

        if ($lastProject) {
            $parts = explode('/', $lastProject->project_code);
            $lastSerial = (int)end($parts);
            $serial = str_pad($lastSerial + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $serial = '001';
        }

        $project_code = "{$prefix}/{$year}/{$slug}/{$serial}";

        return view('admin.project.add', compact('categories', 'sdgs', 'project_code'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ✅ 1. Validate inputs
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:projects,slug',
            'category_id' => 'required|exists:category,id',
            'short_description' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'gallery.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'points' => 'nullable|array',
            'beneficiaries' => 'nullable|array',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'cost' => 'nullable|numeric',
            'funding_type' => 'nullable|string|max:100',
            'csr_partner_type' => 'nullable|string|max:100',
            'csr_invitation' => 'nullable|string',
            'crowdfunding_status' => 'nullable|in:opening_soon,not_started',
            'cta_button_text' => 'nullable|string|max:255',
            'interest_link' => 'nullable|url',
            'sdgs' => 'nullable|array',
            'type' => 'nullable|in:1,2',
            'status' => 'required|boolean',
            'level' => 'required|in:1,2,3,4,5,6,7',
        ]);

        // ✅ 2. Handle slug
        $slug = $request->slug ?? Str::slug($request->title);
        $slugExists = Project::where('slug', $slug)->exists();
        if ($slugExists) {
            $slug .= '-' . time();
        }

        // ✅ 3. Handle file uploads with full paths
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $this->uploadFile($request->file('image'), 'projects');
        }

        $bannerImagePath = null;
        if ($request->hasFile('banner_image')) {
            $bannerImagePath = $this->uploadFile($request->file('banner_image'), 'projects/banners');
        }

        $galleryPaths = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $this->uploadFile($file, 'projects/gallery');
            }
        }

        // ✅ 4. Format arrays for JSON storage
        $points = $request->points ? array_values($request->points) : [];
        $beneficiaries = $request->beneficiaries ? array_values($request->beneficiaries) : [];

        // ✅ 5. Create project
        $project = Project::create([
            'project_code' => $request->project_code,
            'title' => $request->title,
            'slug' => $slug,
            'subtitle' => $request->subtitle,
            'category_id' => $request->category_id,
            'type' => $request->type,
            'stage' => 'upcoming', // Default stage
            'level' => $request->level,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'image' => $imagePath, // Full path stored
            'banner_image' => $bannerImagePath, // Full path stored
            'gallery' => !empty($galleryPaths) ? json_encode($galleryPaths) : null,
            'points' => !empty($points) ? json_encode($points) : null,
            'cost' => $request->cost,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'beneficiaries' => !empty($beneficiaries) ? json_encode($beneficiaries) : null,
            'funding_type' => $request->funding_type,
            'csr_partner_type' => $request->csr_partner_type,
            'csr_invitation' => $request->csr_invitation,
            'crowdfunding_status' => $request->crowdfunding_status,
            'cta_button_text' => $request->cta_button_text ?? 'Register Your Interest →',
            'interest_link' => $request->interest_link,
            'sdgs' => $request->sdgs ? json_encode($request->sdgs) : null,
            'status' => $request->status,
        ]);

        notyf()->addSuccess('Project created successfully.');
        return redirect()->route('admin.project.index')->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.project.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $categories = Category::where('status', 1)->get();
        $sdgs = SDGHelper::getAllSDGs();

        // Handle nullable JSON fields
        $selectedSDGs = json_decode($project->sdgs, true) ?? [];
        $points = json_decode($project->points, true) ?? [];
        $beneficiaries = json_decode($project->beneficiaries, true) ?? [];
        $progressUpdates = json_decode($project->progress_updates, true) ?? [];
        $outcomeMetrics = json_decode($project->outcome_metrics, true) ?? [];
        $testimonials = json_decode($project->testimonials, true) ?? [];
        $impactStories = json_decode($project->impact_stories, true) ?? [];
        $gallery = json_decode($project->gallery, true) ?? [];
        $beforeAfterImages = json_decode($project->before_after_images, true) ?? [];

        return view('admin.project.edit', compact(
            'project',
            'categories',
            'sdgs',
            'selectedSDGs',
            'points',
            'beneficiaries',
            'progressUpdates',
            'outcomeMetrics',
            'testimonials',
            'impactStories',
            'gallery',
            'beforeAfterImages'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            // Basic Information
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:projects,slug,' . $project->id,
            'subtitle' => 'nullable|string|max:255',
            'category_id' => 'required|exists:category,id',
            'short_description' => 'required|string',
            'description' => 'required|string',
            'stage' => 'required|in:upcoming,ongoing,completed',
            'level' => 'required|in:1,2,3,4,5,6,7',
            'status' => 'required|boolean',
            'type' => 'nullable|in:1,2',

            // Upcoming Stage Fields (nullable)
            'cost' => 'nullable|numeric|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'funding_type' => 'nullable|in:csr,crowdfunding,self-funded,donation',
            'csr_partner_type' => 'nullable|in:corporate,ngo,government,individual',
            'csr_invitation' => 'nullable|string',
            'crowdfunding_status' => 'nullable|in:opening_soon,not_started',
            'cta_button_text' => 'nullable|string|max:255',
            'interest_link' => 'nullable|url',

            // Ongoing Stage Fields (nullable)
            'project_lead' => 'nullable|string|max:255',
            'actual_start_date' => 'nullable|date',
            'expected_end_date' => 'nullable|date|after_or_equal:actual_start_date',
            'ongoing_beneficiaries' => 'nullable|integer|min:0',
            'project_cost' => 'nullable|numeric|min:0',
            'funding_target' => 'nullable|numeric|min:0',
            'amount_raised' => 'nullable|numeric|min:0',
            'ongoing_crowdfunding_status' => 'nullable|in:active,on_hold,closed',
            'main_donor' => 'nullable|string|max:255',
            'isico_message' => 'nullable|string',

            // Completed Stage Fields (nullable)
            'completed_project_lead' => 'nullable|string|max:255',
            'completed_start_date' => 'nullable|date',
            'completed_end_date' => 'nullable|date|after_or_equal:completed_start_date',
            'final_cost' => 'nullable|numeric|min:0',
            'completed_beneficiaries' => 'nullable|integer|min:0',
            'completed_csr_partner' => 'nullable|string|max:255',
            'impact_summary' => 'nullable|string',
            'sustainability_plan' => 'nullable|string',
            'lessons_learned' => 'nullable|string',

            // File uploads (nullable)
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'completion_report' => 'nullable|file|mimes:pdf|max:10240',
            'utilization_certificate' => 'nullable|file|mimes:pdf|max:10240',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'before_after_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',

            // Array fields (nullable)
            'sdgs' => 'nullable|array',
            'sdgs.*' => 'integer|between:1,17',
            'points' => 'nullable|array',
            'beneficiaries' => 'nullable|array',
            'progress_updates' => 'nullable|array',
            'outcome_metrics' => 'nullable|array',
            'testimonials' => 'nullable|array',
            'impact_stories' => 'nullable|array',
        ]);

        // Handle file uploads
        $this->handleFileUploads($request, $validated, $project);

        // Handle JSON fields - convert to JSON or null
        $validated['points'] = $request->filled('points') ? json_encode($request->points) : null;
        $validated['sdgs'] = $request->filled('sdgs') ? json_encode($request->sdgs) : null;
        $validated['beneficiaries'] = $request->filled('beneficiaries') ? json_encode($request->beneficiaries) : null;
        $validated['progress_updates'] = $request->filled('progress_updates') ? json_encode($request->progress_updates) : null;
        $validated['outcome_metrics'] = $request->filled('outcome_metrics') ? json_encode($request->outcome_metrics) : null;
        $validated['testimonials'] = $request->filled('testimonials') ? json_encode($request->testimonials) : null;
        $validated['impact_stories'] = $request->filled('impact_stories') ? json_encode($request->impact_stories) : null;

        // Handle gallery images (append to existing)
        if ($request->hasFile('gallery')) {
            $existingGallery = json_decode($project->gallery, true) ?? [];
            $newGallery = [];

            foreach ($request->file('gallery') as $file) {
                $path = $this->uploadFile($file, 'projects/gallery');
                $newGallery[] = $path;
            }

            $validated['gallery'] = json_encode(array_merge($existingGallery, $newGallery));
        }

        // Handle before/after images (append to existing)
        if ($request->hasFile('before_after_images')) {
            $existingBeforeAfter = json_decode($project->before_after_images, true) ?? [];
            $newBeforeAfter = [];

            foreach ($request->file('before_after_images') as $file) {
                $path = $this->uploadFile($file, 'projects/before-after');
                $newBeforeAfter[] = $path;
            }

            $validated['before_after_images'] = json_encode(array_merge($existingBeforeAfter, $newBeforeAfter));
        }

        // Handle progress update images
        if ($request->filled('progress_updates')) {
            $progressUpdates = [];
            foreach ($request->progress_updates as $index => $update) {
                $progressUpdate = [
                    'date' => $update['date'] ?? null,
                    'title' => $update['title'] ?? null,
                    'description' => $update['description'] ?? null,
                    'image' => $update['existing_image'] ?? null, // Keep existing image if no new upload
                ];

                // Handle new image upload
                if (isset($update['image']) && $update['image'] instanceof \Illuminate\Http\UploadedFile) {
                    $path = $this->uploadFile($update['image'], 'projects/progress-updates');
                    $progressUpdate['image'] = $path;
                }

                $progressUpdates[] = $progressUpdate;
            }
            $validated['progress_updates'] = json_encode($progressUpdates);
        }

        // Handle impact story images
        if ($request->filled('impact_stories')) {
            $impactStories = [];
            foreach ($request->impact_stories as $index => $story) {
                $impactStory = [
                    'title' => $story['title'] ?? null,
                    'description' => $story['description'] ?? null,
                    'image' => $story['existing_image'] ?? null, // Keep existing image if no new upload
                ];

                // Handle new image upload
                if (isset($story['image']) && $story['image'] instanceof \Illuminate\Http\UploadedFile) {
                    $path = $this->uploadFile($story['image'], 'projects/impact-stories');
                    $impactStory['image'] = $path;
                }

                $impactStories[] = $impactStory;
            }
            $validated['impact_stories'] = json_encode($impactStories);
        }

        $project->update($validated);

        notyf()->addSuccess('Project updated successfully.');
        return redirect()->route('admin.project.index')->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        try {
            // Delete associated files
            $this->deleteProjectFiles($project);

            // Delete record (permanent delete - no soft delete)
            $project->delete();

            notyf()->addSuccess('Project deleted successfully.');
            return redirect()->route('admin.project.index')->with('success', 'Project deleted successfully.');
        } catch (\Exception $e) {
            notyf()->addError('Failed to delete project.');
            return redirect()->back()->withErrors(['error' => 'Failed to delete project: ' . $e->getMessage()]);
        }
    }

    /**
     * Helper method to upload files and return full path
     */
    private function uploadFile($file, $folder = 'projects')
    {
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $filePath = 'uploads/' . $folder . '/' . $fileName;

        // Move file to public directory
        $file->move(public_path('uploads/' . $folder), $fileName);

        return $filePath; // Returns full path like 'uploads/projects/filename.jpg'
    }

    /**
     * Handle file uploads for update method
     */
    private function handleFileUploads($request, &$validated, $project)
    {
        // Handle main image
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($project->image && file_exists(public_path($project->image))) {
                unlink(public_path($project->image));
            }
            $validated['image'] = $this->uploadFile($request->file('image'), 'projects');
        }

        // Handle banner image
        if ($request->hasFile('banner_image')) {
            if ($project->banner_image && file_exists(public_path($project->banner_image))) {
                unlink(public_path($project->banner_image));
            }
            $validated['banner_image'] = $this->uploadFile($request->file('banner_image'), 'projects/banners');
        }

        // Handle completion report
        if ($request->hasFile('completion_report')) {
            if ($project->completion_report && file_exists(public_path($project->completion_report))) {
                unlink(public_path($project->completion_report));
            }
            $validated['completion_report'] = $this->uploadFile($request->file('completion_report'), 'projects/reports');
        }

        // Handle utilization certificate
        if ($request->hasFile('utilization_certificate')) {
            if ($project->utilization_certificate && file_exists(public_path($project->utilization_certificate))) {
                unlink(public_path($project->utilization_certificate));
            }
            $validated['utilization_certificate'] = $this->uploadFile($request->file('utilization_certificate'), 'projects/certificates');
        }
    }

    /**
     * Delete all project files
     */
    private function deleteProjectFiles($project)
    {
        // Delete main image
        if ($project->image && file_exists(public_path($project->image))) {
            unlink(public_path($project->image));
        }

        // Delete banner image
        if ($project->banner_image && file_exists(public_path($project->banner_image))) {
            unlink(public_path($project->banner_image));
        }

        // Delete completion report
        if ($project->completion_report && file_exists(public_path($project->completion_report))) {
            unlink(public_path($project->completion_report));
        }

        // Delete utilization certificate
        if ($project->utilization_certificate && file_exists(public_path($project->utilization_certificate))) {
            unlink(public_path($project->utilization_certificate));
        }

        // Delete gallery images
        if ($project->gallery) {
            $galleryImages = json_decode($project->gallery, true) ?? [];
            foreach ($galleryImages as $image) {
                if (file_exists(public_path($image))) {
                    unlink(public_path($image));
                }
            }
        }

        // Delete before/after images
        if ($project->before_after_images) {
            $beforeAfterImages = json_decode($project->before_after_images, true) ?? [];
            foreach ($beforeAfterImages as $image) {
                if (file_exists(public_path($image))) {
                    unlink(public_path($image));
                }
            }
        }

        // Delete progress update images
        if ($project->progress_updates) {
            $progressUpdates = json_decode($project->progress_updates, true) ?? [];
            foreach ($progressUpdates as $update) {
                if (isset($update['image']) && file_exists(public_path($update['image']))) {
                    unlink(public_path($update['image']));
                }
            }
        }

        // Delete impact story images
        if ($project->impact_stories) {
            $impactStories = json_decode($project->impact_stories, true) ?? [];
            foreach ($impactStories as $story) {
                if (isset($story['image']) && file_exists(public_path($story['image']))) {
                    unlink(public_path($story['image']));
                }
            }
        }
    }

    /**
     * Remove single gallery image
     */
    public function removeGalleryImage(Request $request, $projectId)
    {
        $project = Project::findOrFail($projectId);
        $imagePath = $request->input('image_path');

        $gallery = json_decode($project->gallery, true) ?? [];

        // Remove image from array
        $updatedGallery = array_filter($gallery, function($path) use ($imagePath) {
            return $path !== $imagePath;
        });

        // Delete physical file
        if (file_exists(public_path($imagePath))) {
            unlink(public_path($imagePath));
        }

        // Update project gallery
        $project->update([
            'gallery' => !empty($updatedGallery) ? json_encode(array_values($updatedGallery)) : null
        ]);

        return response()->json(['success' => true, 'message' => 'Image removed successfully.']);
    }
}
