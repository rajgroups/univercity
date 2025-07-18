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
        $request->validate([
            'title'         => 'required|string|max:255',
            'slug'          => 'required|string|max:255|unique:projects,slug',
            'image'         => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner_image'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'type'          => 'required|in:On Going,Up Coming',
            'status'        => 'required|in:Active,Inactive',
            'description'   => 'nullable|string|max:1000',
        ]);

        // Create unique filenames
        $imageName = time() . '_' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
        $bannerName = time() . '_' . uniqid() . '_banner.' . $request->file('banner_image')->getClientOriginalExtension();

        // Set destination path
        $uploadPath = public_path('upload/project');

        // Create folder if not exists
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        // Move files to public/upload/project
        $request->file('image')->move($uploadPath, $imageName);
        $request->file('banner_image')->move($uploadPath, $bannerName);

        // Save data to DB
        $project = new Project;
        $project->title = $request->title;
        $project->slug = $request->slug;
        $project->image = 'upload/project/' . $imageName;
        $project->banner_image = 'upload/project/' . $bannerName;
        $project->type = $request->type;
        $project->status = $request->status;
        $project->description = $request->description;
        $project->save();

        return redirect()->route('admin.project.create')->with('success', 'Project created successfully.');
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
