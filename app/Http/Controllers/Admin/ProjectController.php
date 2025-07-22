<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

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
        //
        return view('admin.project.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'slug'              => 'required|string|max:255|unique:projects,slug',
            'short_description' => 'required|string|max:255',
            'subtitle'          => 'nullable|string|max:255',
            'image'             => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'banner_image'      => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'type'              => 'required|in:1,2',
            'status'            => 'required|in:0,1',
            'description'       => 'nullable|string|max:3000',
            'points'            => 'nullable|array',
            'points.*'          => 'nullable|string|max:255',
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

        return redirect()->route('admin.project.index')->with('success', 'Announcement created successfully.');
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
            return view('admin.project.edit', compact('project'));
        }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:projects,slug,' . $project->id,
            'type' => 'required|in:On Going,Up Coming',
            'status' => 'required|in:Active,Inactive',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Image Uploads
        if ($request->hasFile('image')) {
            $imageName = time() . '_image.' . $request->image->extension();
            $request->image->move(public_path('uploads/projects'), $imageName);
            $project->image = 'uploads/projects/' . $imageName;
        }

        if ($request->hasFile('banner_image')) {
            $bannerName = time() . '_banner.' . $request->banner_image->extension();
            $request->banner_image->move(public_path('uploads/projects'), $bannerName);
            $project->banner = 'uploads/projects/' . $bannerName;
        }

        $project->title = $request->title;
        $project->slug = $request->slug;
        $project->type = $request->type;
        $project->status = $request->status;
        $project->description = $request->description ?? '';
        $project->save();

       return redirect()->route('admin.project.edit', $project->id)->with('success', 'Project updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
