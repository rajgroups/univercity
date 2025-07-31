<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::latest()->paginate(10);
        return view('admin.brand.list', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'image'  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|boolean',
        ]);

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->status = $request->status;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'brand_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/brands'), $filename);
            $brand->image = asset('uploads/brands/' . $filename); // Full path stored
        }

        $brand->save();

        return redirect()->route('admin.brand.index')->with('success', 'Brand created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        return view('admin.brand.show', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'image'  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|boolean',
        ]);

        $brand->name = $request->name;
        $brand->status = $request->status;

        if ($request->hasFile('image')) {
            // Delete old image
            if ($brand->image && File::exists(public_path('uploads/brands/' . $brand->image))) {
                File::delete(public_path('uploads/brands/' . $brand->image));
            }

            $file = $request->file('image');
            $filename = 'brand_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/brands'), $filename);
            $brand->image = asset('uploads/brands/' . $filename); // Full path stored
        }

        $brand->save();

        return redirect()->route('admin.brand.index')->with('success', 'Brand updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        if ($brand->image && File::exists(public_path($brand->image))) {
            File::delete(public_path($brand->image));
        }

        $brand->delete();

        return redirect()->route('admin.brand.index')->with('success', 'Brand deleted successfully.');
    }
}
