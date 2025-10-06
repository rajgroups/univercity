<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Country;
use App\Models\IntlCourse;
use App\Models\Sector;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            // Provider & Affiliation Details
            'admin_provider' => 'nullable|string|max:255',
            'partner' => 'required|string|max:255',
            'accreditation_recognition' => 'nullable|string|max:255',

            // Course Details
            'course_name' => 'required|string|max:255',
            'level' => 'required|string|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sector_id' => 'required|exists:sectors,id',
            'category_id' => 'required|exists:category,id',
            'pathway_type' => 'required|in:online_pathway,onsite_abroad,hybrid,dual_credit,twinning_program',
            'country_id' => 'required|exists:countries,id',
            'language_instruction' => 'required|string|max:100',
            'learning_product_type' => 'nullable|string|max:255',
            'paid_type' => 'required|in:Free,Paid',
            'short_description' => 'required|string',
            'long_description' => 'required|string',

            // Additional Course Details
            'certification_type' => 'nullable|string|max:255',
            'isico_course_code' => 'required|string|max:100',
            'international_mapping' => 'nullable|string|max:255',
            'credits_transferable' => 'nullable|in:Yes,No',
            'max_credits' => 'nullable|integer|min:0',
            'internship' => 'nullable|string|max:255',

            // Delivery & Assessment
            'provider' => 'required|string|max:255',
            'assessment_mode' => 'required|string|max:255',
            'learning_tools' => 'required|string|max:255',
            'bridge_modules' => 'nullable|string|max:255',

            // Eligibility Details
            'required_age' => 'required|string|max:50',
            'minimum_education' => 'required|string|max:255',
            'industry_experience' => 'required|string|max:255',
            'language_proficiency_requirement' => 'nullable|string|max:255',
            'visa_proccess' => 'required|string',
            'other_info' => 'required|string',

            // QP & NSQF & Credit
            'nsqf_level' => 'required|string|max:50',
            'credits_assigned' => 'required|string|max:50',
            'program_by' => 'required|string|max:255',
            'initiative_of' => 'required|string|max:255',
            'program' => 'required|string|max:255',
            'occupations' => 'required|string|max:255',

            // Topics
            'topics' => 'nullable|array',
            'topics.*.title' => 'nullable|string|max:255',
            'topics.*.description' => 'nullable|string',

            // Logistics & Costs
            'duration_local' => 'nullable|string|max:255',
            'duration_overseas' => 'nullable|string|max:255',
            'total_duration' => 'nullable|string|max:255',
            'fee_structure' => 'nullable|string|max:255',
            'scholarship_funding' => 'nullable|string|max:255',
            'accommodation_cost' => 'nullable|string|max:255',

            // Pathway & Outcomes
            'next_degree' => 'nullable|string|max:255',
            'career_outcomes_json' => 'nullable|string',
            'international_recognition' => 'nullable|string|max:255',
            'pathway_next_courses' => 'nullable|string',

            // Dates & Status
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_featured' => 'required|boolean',
            'status' => 'required|in:0,1',
            'enrollment_count' => 'required|integer|min:0',
        ]);

        // Generate slug from course_name
        $slug = Str::slug($validated['course_name']);

        // ✅ Check if slug already exists
        if (IntlCourse::where('slug', $slug)->exists()) {
            notyf()->addError('A course with a similar name already exists. Please choose a different name');
            return back()
                ->withErrors(['course_name' => 'A course with a similar name already exists. Please choose a different name.'])
                ->withInput();
        }

        // Handle image upload
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

        // Add slug to validated data
        $validated['slug'] = $slug;

        // Convert topics array to JSON if present
        if (isset($validated['topics'])) {
            $validated['topics'] = json_encode($validated['topics']);
        }

        // Handle career outcomes JSON
        if ($request->has('career_outcomes_json') && !empty($request->career_outcomes_json)) {
            $validated['career_outcomes'] = $request->career_outcomes_json;
        }

        // ✅ Auto-generate qp_code
        $country = DB::table('countries')->where('id', $validated['country_id'])->first();
        $countryIso = strtoupper($country->iso2 ?? 'XX');

        // Get the latest serial for this country
        $lastCourse = IntlCourse::where('qp_code', 'like', "ISICO{$countryIso}%")
            ->orderByDesc('id')
            ->first();

        if ($lastCourse && preg_match('/(\d+)$/', $lastCourse->qp_code, $matches)) {
            $nextNumber = intval($matches[1]) + 1;
        } else {
            $nextNumber = 1;
        }

        $formattedNumber = str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        $validated['qp_code'] = "ISICO{$countryIso}{$formattedNumber}";

        // Clean up the data - remove fields that don't exist in the model
        $modelFields = [
            'admin_provider', 'partner', 'accreditation_recognition', 'course_name', 'level',
            'image', 'sector_id', 'category_id', 'pathway_type', 'country_id', 'language_instruction',
            'learning_product_type', 'paid_type', 'short_description', 'long_description', 'certification_type',
            'isico_course_code', 'international_mapping', 'credits_transferable', 'max_credits', 'internship',
            'provider', 'assessment_mode', 'learning_tools', 'bridge_modules', 'required_age', 'minimum_education',
            'industry_experience', 'language_proficiency_requirement', 'visa_proccess', 'other_info', 'qp_code',
            'nsqf_level', 'credits_assigned', 'program_by', 'initiative_of', 'program', 'occupations', 'topics',
            'duration_local', 'duration_overseas', 'total_duration', 'fee_structure', 'scholarship_funding',
            'accommodation_cost', 'next_degree', 'career_outcomes', 'international_recognition', 'pathway_next_courses',
            'start_date', 'end_date', 'is_featured', 'status', 'enrollment_count', 'slug'
        ];

        $createData = array_intersect_key($validated, array_flip($modelFields));

        // Create the course
        $course = IntlCourse::create($createData);

        notyf()->addSuccess('International Course created successfully!');
        return redirect()->route('admin.intlcourse.index')
            ->with('success', 'International Course created successfully!');
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
        // Validate the request data
        $validated = $request->validate([
            // Provider & Affiliation Details
            'admin_provider' => 'nullable|string|max:255',
            'partner' => 'required|string|max:255',
            'accreditation_recognition' => 'nullable|string|max:255',

            // Course Details
            'course_name' => 'required|string|max:255',
            'level' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sector_id' => 'required|exists:sectors,id',
            'category_id' => 'required|exists:category,id',
            'pathway_type' => 'required|in:online_pathway,onsite_abroad,hybrid,dual_credit,twinning_program',
            'country_id' => 'required|exists:countries,id',
            'language_instruction' => 'required|string|max:100',
            'learning_product_type' => 'nullable|string|max:255',
            'paid_type' => 'required|in:Free,Paid',
            'short_description' => 'required|string',
            'long_description' => 'required|string',

            // Additional Course Details
            'certification_type' => 'nullable|string|max:255',
            'isico_course_code' => 'required|string|max:100',
            'international_mapping' => 'nullable|string|max:255',
            'credits_transferable' => 'nullable|in:Yes,No',
            'max_credits' => 'nullable|integer|min:0',
            'internship' => 'nullable|string|max:255',

            // Delivery & Assessment
            'provider' => 'required|string|max:255',
            'assessment_mode' => 'required|string|max:255',
            'learning_tools' => 'required|string|max:255',
            'bridge_modules' => 'nullable|string|max:255',

            // Eligibility Details
            'required_age' => 'required|string|max:50',
            'minimum_education' => 'required|string|max:255',
            'industry_experience' => 'required|string|max:255',
            'language_proficiency_requirement' => 'nullable|string|max:255',
            'visa_proccess' => 'required|string',
            'other_info' => 'required|string',

            // QP & NSQF & Credit
            'qp_code' => 'required|string|max:100',
            'nsqf_level' => 'required|string|max:50',
            'credits_assigned' => 'required|string|max:50',
            'program_by' => 'required|string|max:255',
            'initiative_of' => 'required|string|max:255',
            'program' => 'required|string|max:255',
            'occupations' => 'required|string|max:255',

            // Topics
            'topics' => 'nullable|array',
            'topics.*.title' => 'nullable|string|max:255',
            'topics.*.description' => 'nullable|string',

            // Logistics & Costs
            'duration_local' => 'nullable|string|max:255',
            'duration_overseas' => 'nullable|string|max:255',
            'total_duration' => 'nullable|string|max:255',
            'fee_structure' => 'nullable|string|max:255',
            'scholarship_funding' => 'nullable|string|max:255',
            'accommodation_cost' => 'nullable|string|max:255',

            // Pathway & Outcomes
            'next_degree' => 'nullable|string|max:255',
            'career_outcomes_json' => 'nullable|string',
            'international_recognition' => 'nullable|string|max:255',
            'pathway_next_courses' => 'nullable|string',

            // Dates & Status
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_featured' => 'required|boolean',
            'status' => 'required|in:0,1',
            'enrollment_count' => 'required|integer|min:0',
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

        // Generate slug if course name changed
        if ($course->course_name !== $validated['course_name']) {
            $slug = Str::slug($validated['course_name']);

            // Check if slug already exists (excluding current course)
            if (IntlCourse::where('slug', $slug)->where('id', '!=', $id)->exists()) {
                notyf()->addError('A course with a similar name already exists. Please choose a different name');
                return back()
                    ->withErrors(['course_name' => 'A course with a similar name already exists. Please choose a different name.'])
                    ->withInput();
            }

            $validated['slug'] = $slug;
        }

        // Convert topics array to JSON if present
        if (isset($validated['topics'])) {
            $validated['topics'] = json_encode($validated['topics']);
        } else {
            $validated['topics'] = null;
        }

        // Handle career outcomes JSON
        if ($request->has('career_outcomes_json') && !empty($request->career_outcomes_json)) {
            $validated['career_outcomes'] = $request->career_outcomes_json;
        } else {
            $validated['career_outcomes'] = null;
        }

        // Clean up the data - remove fields that don't exist in the model
        $modelFields = [
            'admin_provider', 'partner', 'accreditation_recognition', 'course_name', 'level',
            'image', 'sector_id', 'category_id', 'pathway_type', 'country_id', 'language_instruction',
            'learning_product_type', 'paid_type', 'short_description', 'long_description', 'certification_type',
            'isico_course_code', 'international_mapping', 'credits_transferable', 'max_credits', 'internship',
            'provider', 'assessment_mode', 'learning_tools', 'bridge_modules', 'required_age', 'minimum_education',
            'industry_experience', 'language_proficiency_requirement', 'visa_proccess', 'other_info', 'qp_code',
            'nsqf_level', 'credits_assigned', 'program_by', 'initiative_of', 'program', 'occupations', 'topics',
            'duration_local', 'duration_overseas', 'total_duration', 'fee_structure', 'scholarship_funding',
            'accommodation_cost', 'next_degree', 'career_outcomes', 'international_recognition', 'pathway_next_courses',
            'start_date', 'end_date', 'is_featured', 'status', 'enrollment_count', 'slug'
        ];

        $updateData = array_intersect_key($validated, array_flip($modelFields));

        // Update the course
        $course->update($updateData);

        notyf()->addSuccess('International Course updated successfully!');
        return redirect()->route('admin.intlcourse.index')
            ->with('success', 'International Course updated successfully!');
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
