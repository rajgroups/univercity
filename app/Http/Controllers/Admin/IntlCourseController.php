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
        $sectors = Sector::where('status', 1)->where('type', 2)->get();
        $countrys = Country::where('status', 1)->get();
        $categories = Category::where('type', 6)->get();
        return view('admin.intlcourse.create', compact('sectors', 'countrys', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            // Section 1: Provider and Affiliation
            'admission_provider' => 'required|in:ISICO,Overseas Partner',
            'overseas_partner_institution' => 'required|string|max:255',
            'accreditation_recognition' => 'nullable|string|max:255',
            'country_id' => 'required|exists:countries,id',

            // Section 2: Course Information
            'course_code' => 'nullable|string|max:255|unique:intlcourses,course_code',
            'course_title' => 'required|string|max:255',
            'sector_id' => 'required|exists:sectors,id',
            'category_id' => 'required|exists:category,id',
            'certification_type' => 'required|string|max:255',
            'language_of_instruction' => 'required|array',
            'language_of_instruction.*' => 'string',
            'course_details' => 'required|string',
            'pathway_type' => 'required|string|max:255',
            'mode_of_study' => 'required|array',
            'mode_of_study.*' => 'string',
            'intake_months' => 'required|array',
            'intake_months.*' => 'string',

            // Section 2: Eligibility
            'minimum_education' => 'required|string|max:255',
            'minimum_age' => 'required|integer|min:16|max:50',
            'work_experience_required' => 'boolean',
            'work_experience_details' => 'nullable|string',
            'language_proficiency' => 'required|string|max:255',

            // Section 3: Course Duration & Fee Structure
            'course_duration_overseas' => 'required|string|max:255',
            'internship_included' => 'boolean',
            'internship_duration' => 'nullable|string|max:255',
            'internship_summary' => 'nullable|string',
            'local_training' => 'boolean',
            'local_training_duration' => 'nullable|string|max:255',
            'total_duration' => 'required|string|max:255',
            'paid_type' => 'required|in:Paid,Free',
            'total_fees' => 'nullable|string|max:255',

            // Section 3(B): Financial Assistance
            'scholarship_available' => 'boolean',
            'scholarship_notes' => 'nullable|string',
            'bank_loan_assistance' => 'boolean',
            'loan_assistance_notes' => 'nullable|string',

            // Section 4: Learning Outcomes
            'career_outcomes' => 'required|string',
            'next_pathways' => 'nullable|string',

            // Section 5: Visa / Logistics
            'visa_support_included' => 'boolean',
            'visa_notes' => 'nullable|string',
            'accommodation_support' => 'boolean',
            'accommodation_notes' => 'nullable|string',

            // Section 7: SEO & Media
            'thumbnail_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'course_brochures' => 'nullable|array',
            'course_brochures.*.file' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'course_brochures.*.label' => 'nullable|string|max:255',
            'short_description' => 'required|string|max:200',
            'meta_description' => 'nullable|string',
            'seo_keywords' => 'nullable|string|max:255',
            'display_order' => 'nullable|integer|min:0',
            'publish_status' => 'boolean',
        ]);

        try {
            DB::beginTransaction();

            // Initialize data array
            $courseData = $validated;

            // Process JSON data for arrays
            $courseData['language_of_instruction'] = $validated['language_of_instruction'];
            $courseData['mode_of_study'] = $validated['mode_of_study'];
            $courseData['intake_months'] = $validated['intake_months'];

            // Process topics/syllabus
            if ($request->has('topics')) {
                $topics = [];
                foreach ($request->topics as $topic) {
                    if (!empty($topic['module_title']) && !empty($topic['outline'])) {
                        $topics[] = [
                            'module_title' => $topic['module_title'],
                            'outline' => $topic['outline']
                        ];
                    }
                }
                $courseData['topics_syllabus'] = $topics;
            }

            // Process career outcomes using helper
            $courseData['career_outcomes'] = $this->processMultiLineText($validated['career_outcomes']);

            // Process next pathways using helper
            if (!empty($validated['next_pathways'])) {
                $courseData['next_pathways'] = $this->processMultiLineText($validated['next_pathways']);
            }

            // Handle thumbnail image upload using helper
            if ($request->hasFile('thumbnail_image')) {
                $courseData['thumbnail_image'] = $this->handleFileUpload(
                    $request->file('thumbnail_image'),
                    'uploads/intlcourse'
                );
            }

            // Handle gallery images upload using helper
            if ($request->hasFile('gallery_images')) {
                $galleryImages = [];
                foreach ($request->file('gallery_images') as $galleryImage) {
                    $galleryImages[] = $this->handleFileUpload(
                        $galleryImage,
                        'uploads/intlcourse/gallery'
                    );
                }
                $courseData['gallery_images'] = $galleryImages;
            }

            // Handle course brochures upload
            if ($request->has('course_brochures')) {
                $brochures = [];
                $brochureData = $request->input('course_brochures');
                if (is_array($brochureData)) {
                    foreach ($brochureData as $index => $item) {
                        if ($request->hasFile("course_brochures.{$index}.file")) {
                            $file = $request->file("course_brochures.{$index}.file");
                            $filePath = $this->handleFileUpload(
                                $file,
                                'uploads/intlcourse/brochures'
                            );
                            $brochures[] = [
                                'document_name' => $item['label'] ?? $file->getClientOriginalName(),
                                'file_path' => $filePath
                            ];
                        }
                    }
                }
                if (!empty($brochures)) {
                    $courseData['course_brochures'] = $brochures;
                }
            }

            // Process overseas fee breakdown
            if ($request->has('overseas_fee_breakdown')) {
                $overseasFees = [];
                foreach ($request->overseas_fee_breakdown as $fee) {
                    if (!empty($fee['label']) && !empty($fee['amount'])) {
                        $overseasFees[] = [
                            'label' => $fee['label'],
                            'amount' => floatval($fee['amount']),
                            'currency' => $fee['currency'] ?? 'USD'
                        ];
                    }
                }
                if (!empty($overseasFees)) {
                    $courseData['overseas_fee_breakdown'] = $overseasFees;
                }
            }

            // Process local training fees
            if ($request->has('local_training_fee')) {
                $localFees = [];
                foreach ($request->local_training_fee as $fee) {
                    if (!empty($fee['label']) && !empty($fee['amount'])) {
                        $localFees[] = [
                            'label' => $fee['label'],
                            'amount' => floatval($fee['amount']),
                            'currency' => $fee['currency'] ?? 'USD'
                        ];
                    }
                }
                if (!empty($localFees)) {
                    $courseData['local_training_fee'] = $localFees;
                }
            }

            // Process living costs
            if ($request->has('living_costs')) {
                $livingCosts = [];
                foreach ($request->living_costs as $cost) {
                    if (!empty($cost['label']) && !empty($cost['amount'])) {
                        $livingCosts[] = [
                            'label' => $cost['label'],
                            'amount' => floatval($cost['amount']),
                            'currency' => $cost['currency'] ?? 'USD'
                        ];
                    }
                }
                if (!empty($livingCosts)) {
                    $courseData['living_costs'] = $livingCosts;
                }
            }

            // Process FAQs
            if ($request->has('faqs')) {
                $faqs = [];
                foreach ($request->faqs as $faq) {
                    if (!empty($faq['question']) && !empty($faq['answer'])) {
                        $faqs[] = [
                            'question' => $faq['question'],
                            'answer' => $faq['answer']
                        ];
                    }
                }
                if (!empty($faqs)) {
                    $courseData['faqs'] = $faqs;
                }
            }

            // Generate unique slug using helper
            $courseData['slug'] = $this->generateUniqueSlug($validated['course_title']);

            // Generate course code if not provided
            if (empty($courseData['course_code'])) {
                $courseData['course_code'] = $this->generateCourseCode(
                    $courseData['sector_id'],
                    $courseData['country_id']
                );
            }
            // Set default values for boolean fields
            $courseData['work_experience_required'] = $request->boolean('work_experience_required');
            $courseData['internship_included'] = $request->boolean('internship_included');
            $courseData['local_training'] = $request->boolean('local_training');
            $courseData['scholarship_available'] = $request->boolean('scholarship_available');
            $courseData['bank_loan_assistance'] = $request->boolean('bank_loan_assistance');
            $courseData['visa_support_included'] = $request->boolean('visa_support_included');
            $courseData['accommodation_support'] = $request->boolean('accommodation_support');
            $courseData['publish_status'] = $request->boolean('publish_status');

            // Set default display order
            if (empty($courseData['display_order'])) {
                $courseData['display_order'] = 0;
            }

            // Create the course
            $course = IntlCourse::create($courseData);

            DB::commit();

            notyf()->addSuccess('International course created successfully!');
            return redirect()->route('admin.intlcourse.index')
                ->with('success', 'International course created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            // Clean up uploaded files if error occurs
            $this->cleanupUploadedFiles($courseData);

            return redirect()->back()
                ->with('error', 'Error creating course: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Process multi-line text to array for JSON storage
     */
    private function processMultiLineText($text)
    {
        return array_filter(array_map('trim', explode("\n", $text)));
    }

    /**
     * Handle file upload with directory creation
     */
    private function handleFileUpload($file, $directory)
    {
        $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
        $destinationPath = public_path($directory);

        // Create directory if not exists
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        $file->move($destinationPath, $filename);
        return $directory . '/' . $filename;
    }

    /**
     * Ensure unique slug
     */
    private function generateUniqueSlug($title, $existingSlug = null)
    {
        $slug = $existingSlug ?: Str::slug($title);
        $counter = 1;
        $originalSlug = $slug;

        while (IntlCourse::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Cleanup uploaded files in case of error
     */
    private function cleanupUploadedFiles($courseData)
    {
        if (isset($courseData['thumbnail_image'])) {
            @unlink(public_path($courseData['thumbnail_image']));
        }

        if (isset($courseData['gallery_images'])) {
            foreach ($courseData['gallery_images'] as $image) {
                @unlink(public_path($image));
            }
        }

        if (isset($courseData['course_brochures'])) {
            foreach ($courseData['course_brochures'] as $brochure) {
                @unlink(public_path($brochure['file_path']));
            }
        }
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
        // Fetch the course with relationships
        $course = IntlCourse::with(['sector', 'country', 'category'])->findOrFail($id);

        // Get dropdown data
        $sectors = Sector::where('status', 1)->where('type', 2)->get();
        $countrys = Country::where('status', 1)->get();
        $categories = Category::where('type', 6)->get();

        return view('admin.intlcourse.edit', compact('course', 'sectors', 'countrys', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $course = IntlCourse::findOrFail($id);

        // Validate the request
        $validated = $request->validate([
            // Section 1: Provider and Affiliation
            'admission_provider' => 'required|in:ISICO,Overseas Partner',
            'overseas_partner_institution' => 'required|string|max:255',
            'accreditation_recognition' => 'nullable|string|max:255',
            'country_id' => 'required|exists:countries,id',

            // Section 2: Course Information
            'course_code' => 'required|string|max:255|unique:intlcourses,course_code,' . $id,
            'course_title' => 'required|string|max:255',
            'sector_id' => 'required|exists:sectors,id',
            'category_id' => 'required|exists:category,id',
            'certification_type' => 'required|string|max:255',
            'language_of_instruction' => 'required|array',
            'language_of_instruction.*' => 'string',
            'course_details' => 'required|string',
            'pathway_type' => 'required|string|max:255',
            'mode_of_study' => 'required|array',
            'mode_of_study.*' => 'string',
            'intake_months' => 'required|array',
            'intake_months.*' => 'string',

            // Section 2: Eligibility
            'minimum_education' => 'required|string|max:255',
            'minimum_age' => 'required|integer|min:16|max:50',
            'work_experience_required' => 'boolean',
            'work_experience_details' => 'nullable|string',
            'language_proficiency' => 'required|string|max:255',

            // Section 3: Course Duration & Fee Structure
            'course_duration_overseas' => 'required|string|max:255',
            'internship_included' => 'boolean',
            'internship_duration' => 'nullable|string|max:255',
            'internship_summary' => 'nullable|string',
            'local_training' => 'boolean',
            'local_training_duration' => 'nullable|string|max:255',
            'total_duration' => 'required|string|max:255',
            'paid_type' => 'required|in:Paid,Free',
            'total_fees' => 'nullable|string|max:255',

            // Section 3(B): Financial Assistance
            'scholarship_available' => 'boolean',
            'scholarship_notes' => 'nullable|string',
            'bank_loan_assistance' => 'boolean',
            'loan_assistance_notes' => 'nullable|string',

            // Section 4: Learning Outcomes
            'career_outcomes' => 'required|string',
            'next_pathways' => 'nullable|string',

            // Section 5: Visa / Logistics
            'visa_support_included' => 'boolean',
            'visa_notes' => 'nullable|string',
            'accommodation_support' => 'boolean',
            'accommodation_notes' => 'nullable|string',

            // Section 7: SEO & Media
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'course_brochures' => 'nullable|array',
            'course_brochures.*.file' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'course_brochures.*.label' => 'nullable|string|max:255',
            'short_description' => 'required|string|max:200',
            'meta_description' => 'nullable|string',
            'seo_keywords' => 'nullable|string|max:255',
            'display_order' => 'nullable|integer|min:0',
            'publish_status' => 'boolean',
        ]);

        try {
            DB::beginTransaction();

            // Initialize data array
            $courseData = $validated;

            // Process JSON data for arrays
            $courseData['language_of_instruction'] = $validated['language_of_instruction'];
            $courseData['mode_of_study'] = $validated['mode_of_study'];
            $courseData['intake_months'] = $validated['intake_months'];

            // Process topics/syllabus
            if ($request->has('topics')) {
                $topics = [];
                foreach ($request->topics as $topic) {
                    if (!empty($topic['module_title']) && !empty($topic['outline'])) {
                        $topics[] = [
                            'module_title' => $topic['module_title'],
                            'outline' => $topic['outline']
                        ];
                    }
                }
                $courseData['topics_syllabus'] = $topics;
            }

            // Process career outcomes using helper
            $courseData['career_outcomes'] = $this->processMultiLineText($validated['career_outcomes']);

            // Process next pathways using helper
            if (!empty($validated['next_pathways'])) {
                $courseData['next_pathways'] = $this->processMultiLineText($validated['next_pathways']);
            }

            // Handle thumbnail image upload using helper
            if ($request->hasFile('thumbnail_image')) {
                // Delete old thumbnail
                if ($course->thumbnail_image) {
                    @unlink(public_path($course->thumbnail_image));
                }
                $courseData['thumbnail_image'] = $this->handleFileUpload(
                    $request->file('thumbnail_image'),
                    'uploads/intlcourse'
                );
            }

            // Handle gallery images upload using helper
            if ($request->hasFile('gallery_images')) {
                $galleryImages = $course->gallery_images ?? [];
                foreach ($request->file('gallery_images') as $galleryImage) {
                    $galleryImages[] = $this->handleFileUpload(
                        $galleryImage,
                        'uploads/intlcourse/gallery'
                    );
                }
                $courseData['gallery_images'] = $galleryImages;
            }

            // Handle course brochures upload
            if ($request->has('course_brochures')) {
                $brochures = [];
                $brochureData = $request->input('course_brochures');
                
                if (is_array($brochureData)) {
                    foreach ($brochureData as $index => $item) {
                        $filePath = null;

                        // Check for new file
                        if ($request->hasFile("course_brochures.{$index}.file")) {
                            $file = $request->file("course_brochures.{$index}.file");
                            $filePath = $this->handleFileUpload(
                                $file,
                                'uploads/intlcourse/brochures'
                            );
                        } 
                        // Check for existing file
                        elseif (isset($item['existing_file'])) {
                            $filePath = $item['existing_file'];
                        }

                        if ($filePath) {
                            $brochures[] = [
                                'document_name' => $item['label'] ?? 'Document',
                                'file_path' => $filePath
                            ];
                        }
                    }
                }
                
                // Allow empty array if all removed
                 $courseData['course_brochures'] = $brochures;
            }

            // Process overseas fee breakdown
            if ($request->has('overseas_fee_breakdown')) {
                $overseasFees = [];
                foreach ($request->overseas_fee_breakdown as $fee) {
                    if (!empty($fee['label']) && !empty($fee['amount'])) {
                        $overseasFees[] = [
                            'label' => $fee['label'],
                            'amount' => floatval($fee['amount']),
                            'currency' => $fee['currency'] ?? 'USD'
                        ];
                    }
                }
                if (!empty($overseasFees)) {
                    $courseData['overseas_fee_breakdown'] = $overseasFees;
                }
            }

            // Process local training fees
            if ($request->has('local_training_fee')) {
                $localFees = [];
                foreach ($request->local_training_fee as $fee) {
                    if (!empty($fee['label']) && !empty($fee['amount'])) {
                        $localFees[] = [
                            'label' => $fee['label'],
                            'amount' => floatval($fee['amount']),
                            'currency' => $fee['currency'] ?? 'USD'
                        ];
                    }
                }
                if (!empty($localFees)) {
                    $courseData['local_training_fee'] = $localFees;
                }
            }

            // Process living costs
            if ($request->has('living_costs')) {
                $livingCosts = [];
                foreach ($request->living_costs as $cost) {
                    if (!empty($cost['label']) && !empty($cost['amount'])) {
                        $livingCosts[] = [
                            'label' => $cost['label'],
                            'amount' => floatval($cost['amount']),
                            'currency' => $cost['currency'] ?? 'USD'
                        ];
                    }
                }
                if (!empty($livingCosts)) {
                    $courseData['living_costs'] = $livingCosts;
                }
            }

            // Process FAQs
            if ($request->has('faqs')) {
                $faqs = [];
                foreach ($request->faqs as $faq) {
                    if (!empty($faq['question']) && !empty($faq['answer'])) {
                        $faqs[] = [
                            'question' => $faq['question'],
                            'answer' => $faq['answer']
                        ];
                    }
                }
                if (!empty($faqs)) {
                    $courseData['faqs'] = $faqs;
                }
            }

            // Generate unique slug if course title changed
            if ($course->course_title !== $validated['course_title']) {
                $courseData['slug'] = $this->generateUniqueSlug($validated['course_title']);
            }

            // Set boolean fields
            $courseData['work_experience_required'] = $request->boolean('work_experience_required');
            $courseData['internship_included'] = $request->boolean('internship_included');
            $courseData['local_training'] = $request->boolean('local_training');
            $courseData['scholarship_available'] = $request->boolean('scholarship_available');
            $courseData['bank_loan_assistance'] = $request->boolean('bank_loan_assistance');
            $courseData['visa_support_included'] = $request->boolean('visa_support_included');
            $courseData['accommodation_support'] = $request->boolean('accommodation_support');
            $courseData['publish_status'] = $request->boolean('publish_status');

            // Update the course
            $course->update($courseData);

            DB::commit();

            notyf()->addSuccess('International course Updated successfully!');
            return redirect()->route('admin.intlcourse.index')
                ->with('success', 'International course Updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->with('error', 'Error updating course: ' . $e->getMessage())
                ->withInput();
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            // Find the course
            $course = IntlCourse::findOrFail($id);

            // Delete thumbnail image if exists
            if ($course->thumbnail_image && file_exists(public_path($course->thumbnail_image))) {
                unlink(public_path($course->thumbnail_image));
            }

            // Delete gallery images if exist
            if ($course->gallery_images && is_array($course->gallery_images)) {
                foreach ($course->gallery_images as $galleryImage) {
                    if (file_exists(public_path($galleryImage))) {
                        unlink(public_path($galleryImage));
                    }
                }
            }

            // Delete course brochures if exist
            if ($course->course_brochures && is_array($course->course_brochures)) {
                foreach ($course->course_brochures as $brochure) {
                    if (isset($brochure['file_path']) && file_exists(public_path($brochure['file_path']))) {
                        unlink(public_path($brochure['file_path']));
                    }
                }
            }

            // Delete the course record
            $course->delete();

            DB::commit();

            notyf()->addSuccess('International course deleted successfully!');
            return redirect()->route('admin.intlcourse.index')
                ->with('success', 'International course deleted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            notyf()->addError('Error deleting course: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error deleting course: ' . $e->getMessage());
        }
    }

    /**
     * Cleanup uploaded files in case of error
     */
    // private function cleanupUploadedFiles($courseData)
    // {
    //     // Cleanup thumbnail image
    //     if (isset($courseData['thumbnail_image']) && file_exists(public_path($courseData['thumbnail_image']))) {
    //         @unlink(public_path($courseData['thumbnail_image']));
    //     }

    //     // Cleanup gallery images
    //     if (isset($courseData['gallery_images'])) {
    //         foreach ($courseData['gallery_images'] as $image) {
    //             if (file_exists(public_path($image))) {
    //                 @unlink(public_path($image));
    //             }
    //         }
    //     }

    //     // Cleanup course brochures
    //     if (isset($courseData['course_brochures'])) {
    //         foreach ($courseData['course_brochures'] as $brochure) {
    //             if (isset($brochure['file_path']) && file_exists(public_path($brochure['file_path']))) {
    //                 @unlink(public_path($brochure['file_path']));
    //             }
    //         }
    //     }
    // }

    /**
     * Generate course code based on sector and country
     */
    private function generateCourseCode($sectorId, $countryId)
    {
        // Sector not used in new format, but kept in signature for compatibility if needed.
        // $sector = Sector::find($sectorId); 
        $country = Country::find($countryId);

        if (!$country) {
            throw new \Exception('Country is required to generate course code');
        }

        // Get ISO2 code or fallback to first 2 letters
        $countryCode = strtoupper($country->iso2 ?? substr($country->name, 0, 2));

        // Get all codes starting with this prefix
        $existingCodes = \App\Models\IntlCourse::where('course_code', 'LIKE', $countryCode . '%')
            ->pluck('course_code')
            ->toArray();

        $maxNumber = 0;
        foreach ($existingCodes as $code) {
            // Check if code matches pattern CCXXX (2 letters + 3 digits) exactly
            if (preg_match('/^' . preg_quote($countryCode, '/') . '(\d{3})$/', $code, $matches)) {
                $number = intval($matches[1]);
                if ($number > $maxNumber) {
                    $maxNumber = $number;
                }
            }
        }

        $nextNumber = $maxNumber + 1;

        // Format as COUNTRYCODE + 3-digit number (e.g., SG001)
        $courseCode = $countryCode . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        return $courseCode;
    }

    /**
     * Update the status of the specified resource.
     */
    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:intlcourses,id',
            'status' => 'required|boolean'
        ]);

        try {
            $course = IntlCourse::findOrFail($request->id);
            $course->publish_status = $request->status;
            $course->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Status updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error updating status'
            ], 500);
        }
    }
}
