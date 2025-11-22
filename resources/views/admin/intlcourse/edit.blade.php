@extends('layouts.admin.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit International Course</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.intlcourse.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Section 1: Provider and Affiliation -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="border-bottom pb-2">Provider and Affiliation</h5>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Admission Provider <span class="text-danger">*</span></label>
                                <select name="admission_provider" class="form-select" required>
                                    <option value="">Select Provider</option>
                                    <option value="ISICO" {{ $course->admission_provider == 'ISICO' ? 'selected' : '' }}>ISICO</option>
                                    <option value="Overseas Partner" {{ $course->admission_provider == 'Overseas Partner' ? 'selected' : '' }}>Overseas Partner</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Overseas Partner Institution <span class="text-danger">*</span></label>
                                <input type="text" name="overseas_partner_institution" class="form-control" required
                                       value="{{ old('overseas_partner_institution', $course->overseas_partner_institution) }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Accreditation / Recognition</label>
                                <input type="text" name="accreditation_recognition" class="form-control"
                                       value="{{ old('accreditation_recognition', $course->accreditation_recognition) }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Destination Country <span class="text-danger">*</span></label>
                                <select name="country_id" class="form-select" required>
                                    <option value="">Select Country</option>
                                    @foreach($countrys as $country)
                                        <option value="{{ $country->id }}" {{ $course->country_id == $country->id ? 'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Section 2: Course Information -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="border-bottom pb-2">Course Information</h5>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Course Code <span class="text-danger">*</span></label>
                                <input type="text" name="course_code" class="form-control" required
                                       value="{{ old('course_code', $course->course_code) }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Course Title <span class="text-danger">*</span></label>
                                <input type="text" name="course_title" class="form-control" required
                                       value="{{ old('course_title', $course->course_title) }}">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Domain / Sector <span class="text-danger">*</span></label>
                                <select name="sector_id" class="form-select" required>
                                    <option value="">Select Sector</option>
                                    @foreach($sectors as $sector)
                                        <option value="{{ $sector->id }}" {{ $course->sector_id == $sector->id ? 'selected' : '' }}>
                                            {{ $sector->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Course Level <span class="text-danger">*</span></label>
                                <select name="category_id" class="form-select" required>
                                    <option value="">Select Level</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $course->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Certification Type <span class="text-danger">*</span></label>
                                <input type="text" name="certification_type" class="form-control" required
                                       value="{{ old('certification_type', $course->certification_type) }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Language of Instruction <span class="text-danger">*</span></label>
                                <select name="language_of_instruction[]" class="form-select" multiple required>
                                    @php
                                        $selectedLanguages = $course->language_of_instruction ?? [];
                                    @endphp
                                    <option value="English" {{ in_array('English', $selectedLanguages) ? 'selected' : '' }}>English</option>
                                    <option value="Japanese" {{ in_array('Japanese', $selectedLanguages) ? 'selected' : '' }}>Japanese</option>
                                    <option value="Chinese" {{ in_array('Chinese', $selectedLanguages) ? 'selected' : '' }}>Chinese</option>
                                    <option value="French" {{ in_array('French', $selectedLanguages) ? 'selected' : '' }}>French</option>
                                    <option value="German" {{ in_array('German', $selectedLanguages) ? 'selected' : '' }}>German</option>
                                    <option value="Spanish" {{ in_array('Spanish', $selectedLanguages) ? 'selected' : '' }}>Spanish</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Pathway Type <span class="text-danger">*</span></label>
                                <select name="pathway_type" class="form-select" required>
                                    <option value="">Select Pathway Type</option>
                                    <option value="Online" {{ $course->pathway_type == 'Online' ? 'selected' : '' }}>Online</option>
                                    <option value="Onsite Abroad" {{ $course->pathway_type == 'Onsite Abroad' ? 'selected' : '' }}>Onsite Abroad</option>
                                    <option value="Hybrid" {{ $course->pathway_type == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                                    <option value="Twinning" {{ $course->pathway_type == 'Twinning' ? 'selected' : '' }}>Twinning</option>
                                    <option value="Dual Credit" {{ $course->pathway_type == 'Dual Credit' ? 'selected' : '' }}>Dual Credit</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Mode of Study <span class="text-danger">*</span></label>
                                <div class="border p-3 rounded">
                                    @php
                                        $selectedModes = $course->mode_of_study ?? [];
                                    @endphp
                                    @foreach(['Online', 'In Centre', 'Hybrid', 'On-demand Site'] as $mode)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="mode_of_study[]"
                                               value="{{ $mode }}" id="mode_{{ Str::slug($mode) }}"
                                               {{ in_array($mode, $selectedModes) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="mode_{{ Str::slug($mode) }}">
                                            {{ $mode }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Intake Months <span class="text-danger">*</span></label>
                                <div class="border p-3 rounded">
                                    @php
                                        $selectedMonths = $course->intake_months ?? [];
                                    @endphp
                                    @foreach(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'] as $month)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="intake_months[]"
                                               value="{{ $month }}" id="month_{{ $month }}"
                                               {{ in_array($month, $selectedMonths) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="month_{{ $month }}">{{ $month }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Course Details <span class="text-danger">*</span></label>
                                <textarea name="course_details" class="form-control" rows="6" required>{{ old('course_details', $course->course_details) }}</textarea>
                            </div>

                            <!-- Topics/Syllabus Repeater -->
                            <div class="col-12 mb-3">
                                <label class="form-label">Topics / Syllabus Covered <span class="text-danger">*</span></label>
                                <div id="topics-container">
                                    @php
                                        $topics = $course->topics_syllabus ?? [['module_title' => '', 'outline' => '']];
                                        $topicCount = count($topics);
                                    @endphp
                                    @foreach($topics as $index => $topic)
                                    <div class="topic-item border p-3 mb-2 rounded">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" name="topics[{{ $index }}][module_title]"
                                                       class="form-control mb-2" placeholder="Module Title" required
                                                       value="{{ $topic['module_title'] ?? '' }}">
                                            </div>
                                            <div class="col-md-5">
                                                <input type="text" name="topics[{{ $index }}][outline]"
                                                       class="form-control mb-2" placeholder="Module Outline" required
                                                       value="{{ $topic['outline'] ?? '' }}">
                                            </div>
                                            <div class="col-md-1">
                                                @if($topicCount > 1)
                                                <button type="button" class="btn btn-danger remove-topic">×</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-primary" id="add-topic">
                                    + Add Another Topic
                                </button>
                            </div>
                        </div>

                        <!-- Section 3: Eligibility -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="border-bottom pb-2">Eligibility Criteria</h5>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Minimum Education <span class="text-danger">*</span></label>
                                <select name="minimum_education" class="form-select" required>
                                    <option value="">Select Education Level</option>
                                    <option value="10th" {{ $course->minimum_education == '10th' ? 'selected' : '' }}>10th Grade</option>
                                    <option value="12th" {{ $course->minimum_education == '12th' ? 'selected' : '' }}>12th Grade</option>
                                    <option value="UG" {{ $course->minimum_education == 'UG' ? 'selected' : '' }}>Undergraduate</option>
                                    <option value="PG" {{ $course->minimum_education == 'PG' ? 'selected' : '' }}>Postgraduate</option>
                                    <option value="Diploma" {{ $course->minimum_education == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Minimum Age <span class="text-danger">*</span></label>
                                <input type="number" name="minimum_age" class="form-control" required
                                       min="16" max="50" value="{{ old('minimum_age', $course->minimum_age) }}">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Work Experience Required</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" name="work_experience_required"
                                           id="work_exp_switch" value="1" {{ $course->work_experience_required ? 'checked' : '' }}>
                                    <label class="form-check-label" for="work_exp_switch">Work Experience Required</label>
                                </div>
                            </div>

                            <div class="col-12 mb-3" id="work_exp_details" style="display: {{ $course->work_experience_required ? 'block' : 'none' }};">
                                <label class="form-label">Work Experience Details</label>
                                <textarea name="work_experience_details" class="form-control" rows="3">{{ old('work_experience_details', $course->work_experience_details) }}</textarea>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Language Proficiency <span class="text-danger">*</span></label>
                                <input type="text" name="language_proficiency" class="form-control" required
                                       value="{{ old('language_proficiency', $course->language_proficiency) }}">
                            </div>
                        </div>

                        <!-- Section 4: Course Duration & Fees -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="border-bottom pb-2">Course Duration & Fee Structure</h5>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Overseas Duration <span class="text-danger">*</span></label>
                                <input type="text" name="course_duration_overseas" class="form-control" required
                                       value="{{ old('course_duration_overseas', $course->course_duration_overseas) }}">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Internship Included</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" name="internship_included"
                                           id="internship_switch" value="1" {{ $course->internship_included ? 'checked' : '' }}>
                                    <label class="form-check-label" for="internship_switch">Internship Included</label>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Local Training</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" name="local_training"
                                           id="local_training_switch" value="1" {{ $course->local_training ? 'checked' : '' }}>
                                    <label class="form-check-label" for="local_training_switch">Local Training Included</label>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3" id="internship_duration" style="display: {{ $course->internship_included ? 'block' : 'none' }};">
                                <label class="form-label">Internship Duration</label>
                                <input type="text" name="internship_duration" class="form-control"
                                       value="{{ old('internship_duration', $course->internship_duration) }}">
                            </div>

                            <div class="col-md-6 mb-3" id="local_training_duration" style="display: {{ $course->local_training ? 'block' : 'none' }};">
                                <label class="form-label">Local Training Duration</label>
                                <input type="text" name="local_training_duration" class="form-control"
                                       value="{{ old('local_training_duration', $course->local_training_duration) }}">
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Total Duration <span class="text-danger">*</span></label>
                                <input type="text" name="total_duration" class="form-control" required
                                       value="{{ old('total_duration', $course->total_duration) }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Paid Type <span class="text-danger">*</span></label>
                                <select name="paid_type" class="form-select" required>
                                    <option value="">Select Type</option>
                                    <option value="Paid" {{ $course->paid_type == 'Paid' ? 'selected' : '' }}>Paid</option>
                                    <option value="Free" {{ $course->paid_type == 'Free' ? 'selected' : '' }}>Free</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Total Fees (Approx.)</label>
                                <input type="text" name="total_fees" class="form-control"
                                       value="{{ old('total_fees', $course->total_fees) }}">
                            </div>

                            <!-- Financial Assistance -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Financial Assistance</label>
                                <div class="border p-3 rounded">
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" name="scholarship_available"
                                               id="scholarship_switch" value="1" {{ $course->scholarship_available ? 'checked' : '' }}>
                                        <label class="form-check-label" for="scholarship_switch">Scholarship Available</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="bank_loan_assistance"
                                               id="loan_switch" value="1" {{ $course->bank_loan_assistance ? 'checked' : '' }}>
                                        <label class="form-check-label" for="loan_switch">Bank Loan Assistance</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 5: Learning Outcomes -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="border-bottom pb-2">Learning Outcomes</h5>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Career Outcomes / Job Roles <span class="text-danger">*</span></label>
                                <textarea name="career_outcomes" class="form-control" rows="4" required>@foreach($course->career_outcomes as $outcome){{ $outcome }}{{ !$loop->last ? "\n" : '' }}@endforeach</textarea>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Next Pathways / Progression</label>
                                <textarea name="next_pathways" class="form-control" rows="3">@if($course->next_pathways)@foreach($course->next_pathways as $pathway){{ $pathway }}{{ !$loop->last ? "\n" : '' }}@endforeach @endif</textarea>
                            </div>
                        </div>

                        <!-- Section 6: Visa & Logistics -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="border-bottom pb-2">Visa & Logistics</h5>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Visa Support</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="visa_support_included"
                                           id="visa_switch" value="1" {{ $course->visa_support_included ? 'checked' : '' }}>
                                    <label class="form-check-label" for="visa_switch">Visa Support Included</label>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Accommodation Support</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="accommodation_support"
                                           id="accommodation_switch" value="1" {{ $course->accommodation_support ? 'checked' : '' }}>
                                    <label class="form-check-label" for="accommodation_switch">Accommodation Support</label>
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Visa Notes</label>
                                <textarea name="visa_notes" class="form-control" rows="3">{{ old('visa_notes', $course->visa_notes) }}</textarea>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Accommodation Notes</label>
                                <textarea name="accommodation_notes" class="form-control" rows="3">{{ old('accommodation_notes', $course->accommodation_notes) }}</textarea>
                            </div>
                        </div>

                        <!-- Section 7: Media & SEO -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="border-bottom pb-2">Media & SEO</h5>
                            </div>

                            <!-- Current Thumbnail Preview -->
                            @if($course->thumbnail_image)
                            <div class="col-12 mb-3">
                                <label class="form-label">Current Thumbnail</label>
                                <div>
                                    <img src="{{ asset($course->thumbnail_image) }}" alt="Current Thumbnail" class="img-thumbnail" style="max-height: 150px;">
                                </div>
                            </div>
                            @endif

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Update Thumbnail Image</label>
                                <input type="file" name="thumbnail_image" class="form-control" accept="image/*">
                            </div>

                            <!-- Current Gallery Images -->
                            @if($course->gallery_images && count($course->gallery_images) > 0)
                            <div class="col-12 mb-3">
                                <label class="form-label">Current Gallery Images</label>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($course->gallery_images as $image)
                                    <img src="{{ asset($image) }}" alt="Gallery Image" class="img-thumbnail" style="max-height: 100px;">
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Add Gallery Images</label>
                                <input type="file" name="gallery_images[]" class="form-control" multiple accept="image/*">
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Short Description <span class="text-danger">*</span></label>
                                <textarea name="short_description" class="form-control" rows="3" maxlength="200" required>{{ old('short_description', $course->short_description) }}</textarea>
                                <div class="form-text"><span id="char-count">{{ strlen($course->short_description) }}</span>/200 characters</div>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Meta Description</label>
                                <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description', $course->meta_description) }}</textarea>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">SEO Keywords</label>
                                <input type="text" name="seo_keywords" class="form-control"
                                       value="{{ old('seo_keywords', $course->seo_keywords) }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Display Order</label>
                                <input type="number" name="display_order" class="form-control" value="{{ old('display_order', $course->display_order) }}" min="0">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Publish Status</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" name="publish_status"
                                           id="publish_switch" value="1" {{ $course->publish_status ? 'checked' : '' }}>
                                    <label class="form-check-label" for="publish_switch">Publish Course</label>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">Update Course</button>
                                    <button type="reset" class="btn btn-secondary">Reset Changes</button>
                                    <a href="{{ route('admin.intlcourse.index') }}" class="btn btn-outline-danger">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- JavaScript for dynamic behavior -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Character counter for short description
    const shortDesc = document.querySelector('textarea[name="short_description"]');
    const charCount = document.getElementById('char-count');

    shortDesc.addEventListener('input', function() {
        charCount.textContent = this.value.length;
    });

    // Toggle work experience details
    const workExpSwitch = document.getElementById('work_exp_switch');
    const workExpDetails = document.getElementById('work_exp_details');

    workExpSwitch.addEventListener('change', function() {
        workExpDetails.style.display = this.checked ? 'block' : 'none';
    });

    // Toggle internship duration
    const internshipSwitch = document.getElementById('internship_switch');
    const internshipDuration = document.getElementById('internship_duration');

    internshipSwitch.addEventListener('change', function() {
        internshipDuration.style.display = this.checked ? 'block' : 'none';
    });

    // Toggle local training duration
    const localTrainingSwitch = document.getElementById('local_training_switch');
    const localTrainingDuration = document.getElementById('local_training_duration');

    localTrainingSwitch.addEventListener('change', function() {
        localTrainingDuration.style.display = this.checked ? 'block' : 'none';
    });

    // Topics/Syllabus repeater
    let topicCount = {{ $topicCount }};
    const topicsContainer = document.getElementById('topics-container');
    const addTopicBtn = document.getElementById('add-topic');

    addTopicBtn.addEventListener('click', function() {
        const newTopic = document.createElement('div');
        newTopic.className = 'topic-item border p-3 mb-2 rounded';
        newTopic.innerHTML = `
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="topics[${topicCount}][module_title]"
                           class="form-control mb-2" placeholder="Module Title" required>
                </div>
                <div class="col-md-5">
                    <input type="text" name="topics[${topicCount}][outline]"
                           class="form-control mb-2" placeholder="Module Outline" required>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger remove-topic">×</button>
                </div>
            </div>
        `;
        topicsContainer.appendChild(newTopic);
        topicCount++;
    });

    // Remove topic
    topicsContainer.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-topic')) {
            if (document.querySelectorAll('.topic-item').length > 1) {
                e.target.closest('.topic-item').remove();
            }
        }
    });
});
</script>

<style>
.topic-item {
    background-color: #f8f9fa;
}
.form-section {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 5px;
    margin-bottom: 20px;
}
</style>
@endsection
