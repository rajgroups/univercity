<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::latest()->get(); // fetch all projects ordered by latest
        return view('admin.project.list', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 1)->get();
        return view('admin.project.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'slug'              => 'required|string|max:255|unique:projects,slug',
            'short_description' => 'required|string',
            'subtitle'          => 'nullable|string',
            'image'             => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'banner_image'      => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'type'              => 'required|in:1,2',
            'status'            => 'required|in:0,1',
            'description'       => 'nullable|string',
            'points'            => 'nullable|array',
            'points.*'          => [
                'nullable', // or 'nullable' if it's optional
                'string',
                function ($attribute, $value, $fail) {
                    if (!Str::contains($value, '-')) {
                        $fail('Each point must contain a hyphen (-) to separate title and description.');
                    }
                },
            ],
            'category_id'       => 'required|exists:category,id',
        ]);

        // Convert type/status to int
        $validated['type'] = $validated['type'];
        $validated['status'] = $validated['status'];

        // Handle file upload to public folder
        if ($request->hasFile('image')) {
            $image      = $request->file('image');
            $imageName  = time() . '_img.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/projects'), $imageName);
            $validated['image'] = 'uploads/projects/' . $imageName;
        }

        if ($request->hasFile('banner_image')) {
            $banner      = $request->file('banner_image');
            $bannerName  = time() . '_banner.' . $banner->getClientOriginalExtension();
            $banner->move(public_path('uploads/projects'), $bannerName);
            $validated['banner_image'] = 'uploads/projects/' . $bannerName;
        }

        // Save points JSON
        $validated['points'] = $request->filled('points') ? json_encode(array_filter($request->input('points'))) : null;

        Project::create($validated);

        return redirect()->route('admin.project.index')->with('success', 'Project created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $categories = Category::where('status', 1)->get();
        return view('admin.project.edit', compact('project','categories'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        // Update the Announcement
        $request->validate([
            'title'                 => 'required|string|max:255',
            'slug'                  => 'required|string|max:255|unique:projects,slug,' . $project->id,
            'type'                  => 'required|in:1,2',
            'status'                => 'required|in:0,1',
            'short_description'     => 'required|string',
            'description'           => 'nullable',
            'image'                 => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'banner_image'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'points'                => 'nullable|array',
            'points.*'              => [
                'nullable', // or 'nullable' if it's optional
                'string',
                function ($attribute, $value, $fail) {
                    if (!Str::contains($value, '-')) {
                        $fail('Each point must contain a hyphen (-) to separate title and description.');
                    }
                },
            ],
            'category_id'           => 'required|exists:category,id',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($project->image && file_exists(public_path(parse_url($project->image, PHP_URL_PATH)))) {
                unlink(public_path(parse_url($project->image, PHP_URL_PATH)));
            }

            $imageName = time() . '_image.' . $request->image->extension();
            $request->image->move(public_path('uploads/projects'), $imageName);
            $project->image = asset('uploads/projects/' . $imageName); // Full path
        }

        if ($request->hasFile('banner_image')) {
            if ($project->banner_image && file_exists(public_path(parse_url($project->banner_image, PHP_URL_PATH)))) {
                unlink(public_path(parse_url($project->banner_image, PHP_URL_PATH)));
            }

            $bannerImageName = time() . '_banner.' . $request->banner_image->extension();
            $request->banner_image->move(public_path('uploads/projects'), $bannerImageName);
            $project->banner_image = asset('uploads/projects/' . $bannerImageName); // Full path
        }

        // Update fields
        $project->title             = $request->title;
        $project->slug              = $request->slug;
        $project->type              = $request->type;
        $project->status            = $request->status;
        $project->status            = $request->status;
        $project->description       = $request->description;
        $project->short_description = $request->short_description;
        $project->category_id       = $request->category_id;

        // Save bullet points as JSON
        $project->points = json_encode(array_filter($request->points ?? [])); // Save cleaned array

        $project->save();

        return redirect()->route('admin.project.index')->with('success', 'Project updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        // Delete the Announcement
        try {
            // Delete associated images if stored
            if ($project->image && file_exists(public_path($project->image))) {
                unlink(public_path($project->image));
            }

            if ($project->banner_image && file_exists(public_path($project->banner_image))) {
                unlink(public_path($project->banner_image));
            }

            // Delete record
            $project->delete();

            return redirect()->route('admin.project.index')->with('success', 'Project deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to delete Project.']);
        }
    }
}
