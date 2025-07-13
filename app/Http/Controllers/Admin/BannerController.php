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
        //
        return view('admin.banner.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.banner.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

            $request->validate([
                'image' => 'required|image|max:2048'
            ]);

            $path = FileHelper::uploadFile($request->file('image'), 'sectors', 'gcs');
            $url = FileHelper::getUrl($path, 'gcs');

            return response()->json([
                'success' => true,
                'path' => $path,
                'url' => $url,
            ]);
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
    public function edit(Banner $banner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
            $path = $request->input('file_path');

            if (FileHelper::deleteFile($path, 'gcs')) {
                return response()->json(['success' => true]);
            }

            return response()->json(['error' => 'File not found'], 404);
            }
}
