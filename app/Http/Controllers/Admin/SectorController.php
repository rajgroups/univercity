<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\Sector;
use App\Helpers\GcsUploader;
use App\Helpers\ImageKitHelper;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Helpers\ImageKitUploader;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all sectors from the database
        $sectors = Sector::orderBy('created_at', 'desc')->get();

        // Pass to view
        return view('admin.sector.list', compact('sectors'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.sector.add');
    }

    /**
     * Store a newly created resource in storage.
     */



    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'slug'        => 'required|string|max:255|unique:sectors,slug',
            'image'       => 'required|image',
            'status'      => 'required|in:0,1',
            'description' => 'nullable|string',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $imagePath = 'uploads/sectors/' . $imageName;
            $request->image->move(public_path('uploads/sectors'), $imageName);
        }

        $sector = new Sector;
        $sector->name        = $request->name;
        $sector->slug        = $request->slug;
        $sector->image       = $imagePath; // 👈 Save full path
        $sector->status      = $request->status;
        $sector->description = $request->description;
        $sector->save();

        return redirect()->back()->with('success', 'Sector created successfully!');
    }




    /**
     * Display the specified resource.
     */
    public function show(Sector $sector)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sector $sector)
    {
        return view('admin.sector.edit', compact('sector'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sector $sector)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'slug'          => 'required|string|max:255|unique:sectors,slug,' . $sector->id,
            'status'        => 'required|in:1,0',
            'description'   => 'nullable|string',
            'image'         => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($sector->image && file_exists(public_path($sector->image))) {
                unlink(public_path($sector->image));
            }

            // Save new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/sectors'), $imageName);
            $validated['image'] = 'uploads/sectors/' . $imageName;
        }

        $sector->update($validated);

        return redirect()->route('admin.sectors.edit', $sector->id)
                        ->with('success', 'Sector updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sector $sector)
    {
        try {
            // If sector has an image and the file exists, delete it
            if ($sector->image && file_exists(public_path($sector->image))) {
                unlink(public_path($sector->image));
            }

            $sector->delete();

            return redirect()->route('admin.sectors.index')->with('success', 'Sector deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong while deleting the sector.');
        }
    }



}
