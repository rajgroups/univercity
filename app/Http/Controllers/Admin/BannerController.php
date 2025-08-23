<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::latest()->get();
        return view('admin.banner.list', compact('banners'));
    }


    public function create()
    {
        return view('admin.banner.add'); // Make sure this blade file exists
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title.*'        => 'required|string|max:255',
            'image.*'        => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description.*'  => 'nullable|string',
            'link.*'         => 'nullable|url',
            'status.*'       => 'nullable|boolean'
        ]);

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $index => $imageFile) {

                // Skip if corresponding title is missing
                if (!isset($request->title[$index])) {
                    continue;
                }

                // Generate filename
                $imageName = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();

                // Upload path
                $destinationPath = public_path('uploads/announcements');

                // Create directory if not exists
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                // Move image
                $imageFile->move($destinationPath, $imageName);

                // Store full image path in DB
                $imagePath = 'uploads/announcements/' . $imageName;

                // Save banner
                $banner = new Banner();
                $banner->title       = $request->title[$index];
                $banner->image       = $imagePath; // ✅ full path stored
                $banner->link        = $request->link[$index] ?? null;
                $banner->description = $request->description[$index] ?? null;
                $banner->status      = $request->status[$index] ?? 1;
                $banner->save();
            }
        }
        notyf()->addSuccess('Banners created successfully!');
        return redirect()->route('admin.banner.create')->with('success', 'Banners created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banner.edit', compact('banner'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        // Validate input
        $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'nullable|url',
            'description' => 'nullable|string',
            'status' => 'required|in:1,0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update banner data
        $banner->title = $request->title;
        $banner->link = $request->link;
        $banner->description = $request->description;
        $banner->status = $request->status;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($banner->image && file_exists(public_path('uploads/banners/' . $banner->image))) {
                unlink(public_path('uploads/banners/' . $banner->image));
            }

            $image = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/banners'), $filename);
            $banner->image = $filename;
        }

        // Save updated banner
        $banner->save();
        notyf()->addSuccess('Banner updated successfully.');
        return redirect()->route('admin.banner.edit', $banner->id)
                 ->with('success', 'Banner updated successfully.');

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        // Delete the image file if it exists
        if ($banner->image && file_exists(public_path('uploads/banners/' . $banner->image))) {
            unlink(public_path('uploads/banners/' . $banner->image));
        }

        // Delete the banner record from the database
        $banner->delete();
        notyf()->addSuccess('Banner deleted successfully.');
        return redirect()->route('admin.banner.index')->with('success', 'Banner deleted successfully.');
    }



}
