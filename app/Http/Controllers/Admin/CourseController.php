<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // List of Course
        $courses = Course::all();
        return view('admin.course.list', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Create Course
        $sectors = Sector::where('status',1)->where('type',1)->get();
        // dd($sectors);
        return view('admin.course.create', compact('sectors'));
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
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('uploads/course');

            // Create directory if not exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $image->move($destinationPath, $filename);

            // Store full path in DB
            $validated['image'] = 'uploads/course/' . $filename;
        }

        // Generate slug
        $validated['slug'] = Str::slug($validated['name']);

        // Convert topics array to JSON if present
        if (isset($validated['topics'])) {
            $validated['topics'] = json_encode($validated['topics']);
        }

        // Create the course
        $course = Course::create($validated);
        notyf()->addSuccess('Course created successfully!');
        return redirect()->route('admin.course.index')
            ->with('success', 'Course created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $course = Course::findOrFail($id); // This will throw 404 if not found
        $sectors = Sector::where('type',1)->where('status',1)->get();
        return view('admin.course.edit', compact('course', 'sectors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validated = $request->validate([
            'name'                      => 'required|string|max:255',
            'short_name'                => 'nullable|string|max:100',
            'image'                     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'duration'                  => 'nullable|string|max:100',
            'paid_type'                 => 'required|in:Free,Paid',
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
        ]);

        // Find the course
        $course = Course::findOrFail($id);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('uploads/course');

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
            $validated['image'] = 'uploads/course/' . $filename;
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
        return redirect()->route('admin.course.index')
            ->with('success', 'Course updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the course
        $course = Course::findOrFail($id);

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
        return redirect()->route('admin.course.index')
            ->with('success', 'Course deleted successfully!');
    }
}
