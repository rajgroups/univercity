<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Country;
use App\Models\IntlCourse;
use App\Models\Sector;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class IntlCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // List of Course
        $courses = IntlCourse::all();
        return view('admin.intlcourse.list', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Create Course
        $sectors = Sector::where('status', 1)->where('type',2)->get();
        $countrys = Country::where('status',1)->get();
        $categories = Category::where('type',6)->get();
        return view('admin.intlcourse.create', compact('sectors','countrys','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'name'                      => 'required|string|max:255',
            'short_name'                => 'nullable|string|max:100',
            'image'                     => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'duration'                  => 'nullable|string|max:100',
            'paid_type'                 => 'required|in:Free,Paid',
            'category_id'               => 'required|exists:category,id',
            'country_id'                => 'required|exists:countries,id',
            'sector_id'                 => 'required|exists:sectors,id',
            'short_description'         => 'nullable|string',
            'long_description'          => 'nullable|string',
            'provider'                  => 'nullable|string|max:255',
            'language'                  => 'nullable|string|max:100',
            'certification_type'        => 'nullable|string|max:255',
            'assessment_mode'           => 'nullable|string|max:255',
            'qp_code'                   => 'nullable|string|max:100',
            'nsqf_level'                => 'nullable|string|max:50',
            'credits_assigned'          => 'nullable|string|max:50',
            'learning_product_type'     => 'nullable|string|max:255',
            'program_by'                => 'nullable|string|max:255',
            'initiative_of'             => 'nullable|string|max:255',
            'program'                   => 'nullable|string|max:255',
            'domain'                    => 'nullable|string|max:255',
            'occupations'               => 'nullable|string|max:255',
            'required_age'              => 'nullable|string|max:50',
            'minimum_education'         => 'nullable|string|max:255',
            'industry_experience'       => 'nullable|string|max:255',
            'learning_tools'            => 'nullable|string|max:255',
            'start_date'                => 'nullable|date',
            'end_date'                  => 'nullable|date|after_or_equal:start_date',
            'is_featured'               => 'required|boolean',
            'status'                    => 'required|in:0,1',
            'enrollment_count'          => 'nullable|integer|min:0',
            'topics'                    => 'nullable|array',
            'topics.*.title'            => 'nullable|string|max:255',
            'topics.*.description'      => 'nullable|string',

            // Added Fields
            'internship'                => 'required|string|max:255',
            'visa_proccess'             => 'nullable|string',
            'other_info '               => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('uploads/intlcourse');

            // Create directory if not exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $image->move($destinationPath, $filename);

            // Store full path in DB
            $validated['image'] = 'uploads/intlcourse/' . $filename;
        }

        // Generate slug
        $validated['slug'] = Str::slug($validated['name']);

        // Convert topics array to JSON if present
        if (isset($validated['topics'])) {
            $validated['topics'] = json_encode($validated['topics']);
        }

        // Create the course
        $course = IntlCourse::create($validated);
        notyf()->addSuccess('Course created successfully!');
        return redirect()->route('admin.intlcourse.index')
            ->with('success', 'Course created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(IntlCourse $intlCourse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $course = IntlCourse::findOrFail($id); // This will throw 404 if not found
        $countrys = Country::where('status',1)->get();
        $categories = Category::where('type',6)->get();
        $sectors = Sector::where('status', 1)->where('type',2)->get();
        return view('admin.intlcourse.edit', compact('course', 'sectors','countrys','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        // Validate the request data
        $validated = $request->validate([
            'name'                      => 'required|string|max:255',
            'short_name'                => 'nullable|string|max:100',
            'image'                     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'duration'                  => 'nullable|string|max:100',
            'paid_type'                 => 'required|in:Free,Paid',
            'category_id'               => 'required|exists:category,id',
            'country_id'                => 'required|exists:countries,id',
            'sector_id'                 => 'required|exists:sectors,id',
            'short_description'         => 'nullable|string',
            'long_description'          => 'nullable|string',
            'provider'                  => 'nullable|string|max:255',
            'language'                  => 'nullable|string|max:100',
            'certification_type'        => 'nullable|string|max:255',
            'assessment_mode'           => 'nullable|string|max:255',
            'qp_code'                   => 'nullable|string|max:100',
            'nsqf_level'                => 'nullable|string|max:50',
            'credits_assigned'          => 'nullable|string|max:50',
            'learning_product_type'     => 'nullable|string|max:255',
            'program_by'                => 'nullable|string|max:255',
            'initiative_of'             => 'nullable|string|max:255',
            'program'                   => 'nullable|string|max:255',
            'domain'                    => 'nullable|string|max:255',
            'occupations'               => 'nullable|string|max:255',
            'required_age'              => 'nullable|string|max:50',
            'minimum_education'         => 'nullable|string|max:255',
            'industry_experience'       => 'nullable|string|max:255',
            'learning_tools'            => 'nullable|string|max:255',
            'start_date'                => 'nullable|date',
            'end_date'                  => 'nullable|date|after_or_equal:start_date',
            'is_featured'               => 'required|boolean',
            'status'                    => 'required|in:0,1',
            'enrollment_count'          => 'nullable|integer|min:0',
            'topics'                    => 'nullable|array',
            'topics.*.title'            => 'nullable|string|max:255',
            'topics.*.description'      => 'nullable|string',

            'internship'                => 'required|string|max:255',
            'visa_proccess'             => 'nullable|string',
            'other_info '               => 'nullable|string',
        ]);

        // Find the course
        $course = IntlCourse::findOrFail($id);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('uploads/intlcourse');

            // Create directory if not exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            // Delete old image if exists
            if ($course->image && file_exists(public_path($course->image))) {
                unlink(public_path($course->image));
            }

            $image->move($destinationPath, $filename);

            // Store relative path in DB
            $validated['image'] = 'uploads/intlcourse/' . $filename;
        } elseif ($request->remove_image) {
            // Remove current image if requested
            if ($course->image && file_exists(public_path($course->image))) {
                unlink(public_path($course->image));
            }
            $validated['image'] = null;
        }

        // Convert topics array to JSON if present
        if (isset($validated['topics'])) {
            $validated['topics'] = json_encode($validated['topics']);
        } else {
            $validated['topics'] = null;
        }

        // Update the course
        $course->update($validated);
        notyf()->addSuccess('Course updated successfully!');
        return redirect()->route('admin.intlcourse.index')
            ->with('success', 'Course updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the course
        $course = IntlCourse::findOrFail($id);

        // Delete associated image if exists
        if ($course->image) {
            // For Storage facade approach:
            // Storage::delete('public/'.$course->image);

            // For direct filesystem approach (matches your update method):
            if (file_exists(public_path($course->image))) {
                unlink(public_path($course->image));
            }
        }

        // Delete the course
        $course->delete();
        notyf()->addSuccess('Course deleted successfully!');
        return redirect()->route('admin.intlcourse.index')
            ->with('success', 'Course deleted successfully!');
    }
}
