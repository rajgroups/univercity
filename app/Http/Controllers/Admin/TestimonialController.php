<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the testimonials.
     */
    public function index()
    {
        $testimonials = Testimonial::latest()->get();
        return view('admin.testimonial.list', compact('testimonials'));
    }

    /**
     * Show the form for creating a new testimonial.
     */
    public function create()
    {
        return view('admin.testimonial.create');
    }

    /**
     * Store a newly created testimonial in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string',
            'company'       => 'required|string',
            'rating'        => 'required|numeric|min:1|max:5',
            'designation'   => 'nullable|string',
            'comment'       => 'required|string',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status'        => 'boolean',
        ]);

        $testimonial = new Testimonial();
        $testimonial->fill($request->only(['name', 'company', 'rating', 'designation', 'comment', 'status']));

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/testimonials'), $name);
            $testimonial->image = 'uploads/testimonials/' . $name;
        }

        $testimonial->save();

        return redirect()->route('admin.testimonial.index')->with('success', 'Testimonial created successfully.');
    }

    /**
     * Show the form for editing the specified testimonial.
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonial.edit', compact('testimonial'));
    }

    /**
     * Update the specified testimonial in storage.
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'name'          => 'required|string',
            'company'       => 'required|string',
            'rating'        => 'required|numeric|min:1|max:5',
            'designation'   => 'nullable|string',
            'comment'       => 'required|string',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status'        => 'boolean',
        ]);

        $testimonial->fill($request->only(['name', 'company', 'rating', 'designation', 'comment', 'status']));

        // Handle image update
        if ($request->hasFile('image')) {
            if ($testimonial->image && File::exists(public_path($testimonial->image))) {
                File::delete(public_path($testimonial->image));
            }

            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/testimonials'), $name);
            $testimonial->image = 'uploads/testimonials/' . $name;
        }

        $testimonial->save();

        return redirect()->route('admin.testimonial.index')->with('success', 'Testimonial updated successfully.');
    }

    /**
     * Remove the specified testimonial from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->image && File::exists(public_path($testimonial->image))) {
            File::delete(public_path($testimonial->image));
        }

        $testimonial->delete();

        return redirect()->back()->with('success', 'Testimonial deleted successfully.');
    }
}
