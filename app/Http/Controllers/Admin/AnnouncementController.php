<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        public function index()
        {
            $announcements = Announcement::latest()->get(); // You can also paginate: ->paginate(10)
            return view('admin.announcement.list', compact('announcements'));
        }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.announcement.add');
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required|string|max:255',
            'slug'          => 'nullable|string|max:255|unique:announcement,slug',
            'description'   => 'nullable|string',
            'image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'type'          => 'required|in:Program,Scheme',
            'status'        => 'required|in:Active,Inactive',
        ]);

        $announcement = new Announcement();
        $announcement->title = $request->title;
        $announcement->slug = $request->slug ?: Str::slug($request->title);
        $announcement->description = $request->description;
        $announcement->type = $request->type;
        $announcement->status = $request->status;

        if ($request->hasFile('image')) {
            $imageName = time() . '_image.' . $request->image->extension();
            $request->image->move(public_path('uploads/announcements'), $imageName);
            $announcement->image = $imageName;
        }

        if ($request->hasFile('banner_image')) {
            $bannerImageName = time() . '_banner.' . $request->banner_image->extension();
            $request->banner_image->move(public_path('uploads/announcements'), $bannerImageName);
            $announcement->banner_image = $bannerImageName;
        }

        $announcement->save();

        return redirect()->route('admin.announcement.create')->with('success', 'Announcement created successfully.');
    }



    /**
     * Display the specified resource.
     */
    public function show(Announcement $announcement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Announcement $announcement)
    {
        return view('admin.announcement.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:announcement,slug,' . $announcement->id,
            'type' => 'required|in:Program,Scheme',
            'status' => 'required|in:Active,Inactive',
            'description' => 'nullable|string|max:600',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image uploads
        if ($request->hasFile('image')) {
            if ($announcement->image && file_exists(public_path('uploads/announcements/' . $announcement->image))) {
                unlink(public_path('uploads/announcements/' . $announcement->image));
            }
            $imageName = time() . '_image.' . $request->image->extension();
            $request->image->move(public_path('uploads/announcements'), $imageName);
            $announcement->image = $imageName;
        }

        if ($request->hasFile('banner_image')) {
            if ($announcement->banner_image && file_exists(public_path('uploads/announcements/' . $announcement->banner_image))) {
                unlink(public_path('uploads/announcements/' . $announcement->banner_image));
            }
            $bannerImageName = time() . '_banner.' . $request->banner_image->extension();
            $request->banner_image->move(public_path('uploads/announcements'), $bannerImageName);
            $announcement->banner_image = $bannerImageName;
        }

        // Update fields
        $announcement->title = $request->title;
        $announcement->slug = $request->slug;
        $announcement->type = $request->type;
        $announcement->status = $request->status;
        $announcement->description = $request->description;
        $announcement->save();

    return redirect()->route('admin.announcement.edit', $announcement->id)
                 ->with('success', 'Announcement updated successfully.');

        // return redirect()->route('admin.announcement.id')->with('success', 'Announcement updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement)
    {
        try {
            // Delete associated images if stored
            if ($announcement->image && file_exists(public_path('uploads/announcement/' . $announcement->image))) {
                unlink(public_path('uploads/announcement/' . $announcement->image));
            }

            if ($announcement->banner_image && file_exists(public_path('uploads/announcement/' . $announcement->banner_image))) {
                unlink(public_path('uploads/announcement/' . $announcement->banner_image));
            }

            // Delete record
            $announcement->delete();

            return redirect()->route('admin.announcement.index')->with('success', 'Announcement deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to delete announcement.']);
        }
    }

}
