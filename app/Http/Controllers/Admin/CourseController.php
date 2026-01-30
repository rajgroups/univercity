<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with('sector')->latest()->get();
        return view('admin.course.list', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sectors = Sector::where('status', 1)->where('type', 1)->get();
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
            'level'                     => 'required|in:Awareness,Foundation,Intermediate,Advanced,Professional',
            'image'                     => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'gallery'                   => 'nullable|array',
            'gallery.*'                 => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'duration_number'           => 'nullable|integer|min:1',
            'duration_unit'             => 'nullable|in:days,weeks,months,years',
            'paid_type'                 => 'required|in:free,paid,na',
            'sector_id'                 => 'required|exists:sectors,id',
            'short_description'         => 'nullable|string',
            'long_description'          => 'nullable|string',
            'provider'                  => 'nullable|string|max:255',
            'language'                  => 'nullable|array',
            'certification_type'        => 'nullable|string|max:255',
            'assessment_mode'           => 'nullable|string|max:255',
            'course_code'               => 'nullable|string|max:50',
            'nsqf_level'                => 'nullable|string|max:10',
            'location'                  => 'nullable|array',
            'mode_of_study'             => 'required|in:1,2,3,4',
            'program_by'                => 'nullable|string|max:255',
            'initiative_of'             => 'nullable|string|max:255',
            'internship'                => 'nullable|boolean',
            'domain'                    => 'nullable|string|max:100',
            'occupations'               => 'nullable|array',
            'required_age'              => 'nullable|string|max:50',
            'minimum_education'         => 'nullable|array',
            'industry_experience_years' => 'nullable|integer|min:0|max:50',
            'industry_experience_desc'  => 'nullable|string|max:500',
            'learning_tools'            => 'nullable|array',
            'start_date'                => 'nullable|date',
            'end_date'                  => 'nullable|date|after_or_equal:start_date',
            'is_featured'               => 'required|boolean',
            'status'                    => 'required|boolean',
            'enrollment_count'          => 'nullable|integer|min:0',
            'topics'                    => 'nullable|array',
            'topics.*.title'            => 'nullable|string|max:255',
            'topics.*.description'      => 'nullable|string',
            'other_specifications'      => 'nullable|array',
            'other_specifications.*.label' => 'nullable|string|max:255',
            'other_specifications.*.description' => 'nullable|string',
            'availability_status'       => 'nullable|in:available,not_available',
            'review_stars'              => 'nullable|numeric|min:0|max:5',
            'review_count'              => 'nullable|integer|min:0',
            'internship_note'           => 'nullable|string',
        ]);


        try {
            // Handle main image upload
            if ($request->hasFile('image')) {
                $validated['image'] = $this->uploadImage($request->file('image'), 'courses');
            }

            // Handle gallery images upload
            if ($request->hasFile('gallery')) {
                $galleryPaths = [];
                foreach ($request->file('gallery') as $galleryImage) {
                    $galleryPaths[] = $this->uploadImage($galleryImage, 'courses/gallery');
                }
                $validated['gallery'] = $galleryPaths;
            }

            // Generate slug
            $validated['slug'] = Str::slug($validated['name']);

            // Generate course code if not provided
            if (empty($validated['course_code'])) {
                $validated['course_code'] = $this->generateCourseCode($validated['sector_id'], $validated['level']);
            }

            // Convert JSON fields
            $jsonFields = ['language', 'location', 'occupations', 'minimum_education', 'learning_tools', 'topics', 'other_specifications'];
            foreach ($jsonFields as $field) {
                if (isset($validated[$field])) {
                    $validated[$field] = json_encode($validated[$field]);
                }
            }

            // Handle duration combination
            if ($validated['duration_number'] && $validated['duration_unit']) {
                $validated['duration'] = $validated['duration_number'] . ' ' . $validated['duration_unit'];
            }

            // Set default values
            $validated['internship'] = $request->boolean('internship');
            $validated['is_featured'] = $request->boolean('is_featured');
            $validated['status'] = $request->boolean('status');

            // Create the course
            Course::create($validated);

            notyf()->addSuccess('Course created successfully!');
            return redirect()->route('admin.course.index');
        } catch (\Exception $e) {
            Log::error('Course creation failed: ' . $e->getMessage());
            notyf()->addError('Failed to create course. Please try again.');
            // return back()->withInput();
            return redirect()->route('admin.course.create')->withInput();
        }
    }

    /**
     * Generate Course Code
     */
    private function generateCourseCode($sectorId, $level)
    {
        try {
            $sector = Sector::find($sectorId);
            if (!$sector) {
                return null;
            }

            $sectorCode = $sector->prefix ?? substr(strtoupper($sector->name), 0, 2);

            $levelCodes = [
                'Awareness' => '01',
                'Foundation' => '02',
                'Intermediate' => '03',
                'Advanced' => '04',
                'Professional' => '05'
            ];

            $levelCode = $levelCodes[$level] ?? '00';

            $lastCourse = Course::orderBy('id', 'desc')->first();
            $sequentialNumber = $lastCourse ? str_pad($lastCourse->id + 1, 3, '0', STR_PAD_LEFT) : '001';

            return "CRS{$sectorCode}{$levelCode}{$sequentialNumber}";
        } catch (\Exception $e) {
            Log::error('Error generating course code: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Upload Image
     */
    private function uploadImage($image, $folder = 'courses')
    {
        $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $path = "uploads/{$folder}/{$filename}";

        $destinationPath = public_path("uploads/{$folder}");
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        $image->move($destinationPath, $filename);
        return $path;
    }

    /**
     * Delete Image
     */
    private function deleteImage($imagePath)
    {
        if ($imagePath && file_exists(public_path($imagePath))) {
            unlink(public_path($imagePath));
            return true;
        }
        return false;
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return view('admin.course.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $sectors = Sector::where('status', 1)->where('type', 1)->get();

        // Decode JSON fields for editing
        $jsonFields = ['language', 'location', 'occupations', 'minimum_education', 'learning_tools', 'topics', 'other_specifications'];
        foreach ($jsonFields as $field) {
            $value = $course->$field;
            if ($value && is_string($value)) {
                $decoded = json_decode($value, true);
                $course->$field = json_last_error() === JSON_ERROR_NONE ? $decoded : [];
            } elseif (empty($value)) {
                $course->$field = [];
            }
            // If it's already an array, leave it as is
        }

        return view('admin.course.edit', compact('course', 'sectors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        // Validate the request data
        $validated = $request->validate([
            'name'                      => 'required|string|max:255',
            'level'                     => 'required|in:Awareness,Foundation,Intermediate,Advanced,Professional',
            'image'                     => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'gallery'                   => 'nullable|array',
            'gallery.*'                 => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'duration_number'           => 'nullable|integer|min:1',
            'duration_unit'             => 'nullable|in:days,weeks,months,years',
            'paid_type'                 => 'required|in:free,paid,na',
            'sector_id'                 => 'required|exists:sectors,id',
            'short_description'         => 'nullable|string',
            'long_description'          => 'nullable|string',
            'provider'                  => 'nullable|string|max:255',
            'language'                  => 'nullable|array',
            'certification_type'        => 'nullable|string|max:255',
            'assessment_mode'           => 'nullable|string|max:255',
            'course_code'               => 'nullable|string|max:50',
            'nsqf_level'                => 'nullable|string|max:10',
            'location'                  => 'nullable|array',
            'mode_of_study'             => 'required|in:1,2,3,4',
            'program_by'                => 'nullable|string|max:255',
            'initiative_of'             => 'nullable|string|max:255',
            'internship'                => 'nullable|boolean',
            'domain'                    => 'nullable|string|max:100',
            'occupations'               => 'nullable|array',
            'required_age'              => 'nullable|string|max:50',
            'minimum_education'         => 'nullable|array',
            'industry_experience_years' => 'nullable|integer|min:0|max:50',
            'industry_experience_desc'  => 'nullable|string|max:500',
            'learning_tools'            => 'nullable|array',
            'start_date'                => 'nullable|date',
            'end_date'                  => 'nullable|date|after_or_equal:start_date',
            'is_featured'               => 'required|boolean',
            'status'                    => 'required|boolean',
            'enrollment_count'          => 'nullable|integer|min:0',
            'topics'                    => 'nullable|array',
            'topics.*.title'            => 'nullable|string|max:255',
            'topics.*.description'      => 'nullable|string',
            'other_specifications'      => 'nullable|array',
            'other_specifications.*.label' => 'nullable|string|max:255',
            'other_specifications.*.description' => 'nullable|string',
            'availability_status'       => 'nullable|in:available,not_available',
            'review_stars'              => 'nullable|numeric|min:0|max:5',
            'review_count'              => 'nullable|integer|min:0',
            'internship_note'           => 'nullable|string',
        ]);

        try {
            // Handle main image upload
            if ($request->hasFile('image')) {
                // Delete old image
                $this->deleteImage($course->image);
                $validated['image'] = $this->uploadImage($request->file('image'), 'courses');
            } elseif ($request->boolean('remove_image')) {
                $this->deleteImage($course->image);
                $validated['image'] = null;
            }

            // Handle gallery images upload
            if ($request->hasFile('gallery')) {
                // Delete old gallery images
                // Delete old gallery images
                if ($course->gallery) {
                    $oldGallery = $course->gallery; // Already array due to casts
                    if (is_array($oldGallery)) {
                        foreach ($oldGallery as $oldImage) {
                            $this->deleteImage($oldImage);
                        }
                    }
                }

                $galleryPaths = [];
                foreach ($request->file('gallery') as $galleryImage) {
                    $galleryPaths[] = $this->uploadImage($galleryImage, 'courses/gallery');
                }
                $validated['gallery'] = $galleryPaths;
            } elseif ($request->boolean('remove_gallery')) {
                if ($course->gallery) {
                    $oldGallery = $course->gallery; // Already array due to casts
                    if (is_array($oldGallery)) {
                        foreach ($oldGallery as $oldImage) {
                            $this->deleteImage($oldImage);
                        }
                    }
                }
                $validated['gallery'] = null;
            }

            // Generate slug if name changed
            if ($course->name !== $validated['name']) {
                $validated['slug'] = Str::slug($validated['name']);
            }

            // Convert JSON fields
            $jsonFields = ['language', 'location', 'occupations', 'minimum_education', 'learning_tools', 'topics', 'other_specifications'];
            foreach ($jsonFields as $field) {
                if (isset($validated[$field])) {
                    $validated[$field] = json_encode($validated[$field]);
                } else {
                    $validated[$field] = null;
                }
            }

            // Handle duration combination
            if ($validated['duration_number'] && $validated['duration_unit']) {
                $validated['duration'] = $validated['duration_number'] . ' ' . $validated['duration_unit'];
            } else {
                $validated['duration'] = null;
            }

            // Set boolean values
            $validated['internship'] = $request->boolean('internship');
            $validated['is_featured'] = $request->boolean('is_featured');
            $validated['status'] = $request->boolean('status');

            // Update the course
            $course->update($validated);

            notyf()->addSuccess('Course updated successfully!');
            return redirect()->route('admin.course.index');
        } catch (\Exception $e) {
            Log::error('Course update failed: ' . $e->getMessage());
            notyf()->addError('Failed to update course. Please try again.');
            // return back()->withInput();
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);

        try {
            // Delete main image
            if ($course->image) {
                $this->deleteImage($course->image);
            }

            // Delete gallery images
            if ($course->gallery) {
                $galleryImages = $course->gallery; // Already array
                if (is_array($galleryImages)) {
                    foreach ($galleryImages as $image) {
                        $this->deleteImage($image);
                    }
                }
            }

            // Delete the course
            $course->delete();

            notyf()->addSuccess('Course deleted successfully!');
            return redirect()->route('admin.course.index');
        } catch (\Exception $e) {
            Log::error('Course deletion failed: ' . $e->getMessage());
            notyf()->addError('Failed to delete course. Please try again.');
            return back();
        }
    }

    // /**
    //  * Delete Image from storage
    //  */
    // private function deleteImage($imagePath)
    // {
    //     if ($imagePath && file_exists(public_path($imagePath))) {
    //         unlink(public_path($imagePath));
    //         // Optional: Remove empty directory if needed
    //         $directory = dirname(public_path($imagePath));
    //         if (is_dir($directory) && count(scandir($directory)) == 2) { // Only . and .. remain
    //             rmdir($directory);
    //         }
    //     }
    // }

    public function getBySectors(Request $request) {
        $sectorIds = $request->input('sectors', []);
        
        if (empty($sectorIds)) {
            return response()->json([], 200);
        }

        $courses = Course::with('sector:id,name')
                        ->whereIn('sector_id', $sectorIds)
                        ->where('status', 1) // Active courses only
                        ->select(
                            'id', 
                            'name', 
                            'level', 
                            'image', 
                            'course_code',
                            'mode_of_study',
                            'paid_type',
                            'provider',
                            'language',
                            'duration_number',
                            'duration_unit',
                            'enrollment_count',
                            'slug',
                            'sector_id'
                        )
                        ->get();

        return response()->json($courses);
    }
}
