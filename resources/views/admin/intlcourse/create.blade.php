@extends('layouts.admin.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add International Course</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.intlcourse.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Section 1: Provider and Affiliation -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="border-bottom pb-2">Provider and Affiliation</h5>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Admission Provider <span class="text-danger">*</span></label>
                                <select name="admission_provider" class="form-select" required>
                                    <option value="">Select Provider</option>
                                    <option value="ISICO">ISICO</option>
                                    <option value="Overseas Partner">Overseas Partner</option>
                                </select>
                                <div class="form-text">Select the main admission provider</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Overseas Partner Institution <span class="text-danger">*</span></label>
                                <input type="text" name="overseas_partner_institution" class="form-control" required
                                       placeholder="Enter institution name">
                                <div class="form-text">Full name of overseas partner institution</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Accreditation / Recognition</label>
                                <input type="text" name="accreditation_recognition" class="form-control"
                                       placeholder="e.g., PEI registered, Govt Accreditation">
                                <div class="form-text">Any accreditation or recognition details</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Destination Country <span class="text-danger">*</span></label>
                                <select name="country_id" class="form-select" required>
                                    <option value="">Select Country</option>
                                    @foreach($countrys as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                <div class="form-text">Select the destination country</div>
                            </div>
                        </div>

                        <!-- Section 2: Course Information -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="border-bottom pb-2">Course Information</h5>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Course Code</label>
                                <input type="text" name="course_code" class="form-control"
                                       placeholder="e.g., SG001, MY001" readonly>
                                <div class="form-text">Auto-generated code (Country + Number)</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Course Title <span class="text-danger">*</span></label>
                                <input type="text" name="course_title" class="form-control" required
                                       placeholder="Official course name">
                                <div class="form-text">Official name of the course</div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Domain / Sector <span class="text-danger">*</span></label>
                                <select name="sector_id" class="form-select" required>
                                    <option value="">Select Sector</option>
                                    @foreach($sectors as $sector)
                                        <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                                    @endforeach
                                </select>
                                <div class="form-text">e.g., IT, Business, Hospitality</div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Course Level <span class="text-danger">*</span></label>
                                <select name="category_id" class="form-select" required>
                                    <option value="">Select Level</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div class="form-text">e.g., Foundation, UG, PG, Diploma</div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Certification Type <span class="text-danger">*</span></label>
                                <input type="text" name="certification_type" class="form-control" required
                                       placeholder="e.g., University Certificate, Joint Certificate">
                                <div class="form-text">Type of certification awarded</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Language of Instruction <span class="text-danger">*</span></label>
                                <select name="language_of_instruction[]" class="form-select" multiple required>
                                    <option value="English">English</option>
                                    <option value="Japanese">Japanese</option>
                                    <option value="Chinese">Chinese</option>
                                    <option value="French">French</option>
                                    <option value="German">German</option>
                                    <option value="Spanish">Spanish</option>
                                </select>
                                <div class="form-text">Hold Ctrl/Cmd to select multiple languages</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Pathway Type <span class="text-danger">*</span></label>
                                <select name="pathway_type" class="form-select" required>
                                    <option value="">Select Pathway Type</option>
                                    <option value="Online">Online</option>
                                    <option value="Onsite Abroad">Onsite Abroad</option>
                                    <option value="Hybrid">Hybrid</option>
                                    <option value="Twinning">Twinning</option>
                                    <option value="Dual Credit">Dual Credit</option>
                                </select>
                                <div class="form-text">Select the study pathway type</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Mode of Study <span class="text-danger">*</span></label>
                                <div class="border p-3 rounded">
                                    @foreach(['Online', 'In Centre', 'Hybrid', 'On-demand Site'] as $mode)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="mode_of_study[]"
                                               value="{{ $mode }}" id="mode_{{ Str::slug($mode) }}">
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
                                    @foreach(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'] as $month)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="intake_months[]"
                                               value="{{ $month }}" id="month_{{ $month }}">
                                        <label class="form-check-label" for="month_{{ $month }}">{{ $month }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Course Details <span class="text-danger">*</span></label>
                                <textarea name="course_details" class="form-control" rows="6" id="long_description" required
                                          placeholder="Full course description and details..."></textarea>
                                <div class="form-text">Detailed course description for the course page</div>
                            </div>

                            <!-- Topics/Syllabus Repeater -->
                            <div class="col-12 mb-3">
                                <label class="form-label">Topics / Syllabus Covered <span class="text-danger">*</span></label>
                                <div id="topics-container">
                                    <div class="topic-item border p-3 mb-2 rounded">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" name="topics[0][module_title]"
                                                       class="form-control mb-2" placeholder="Module Title" required>
                                            </div>
                                            <div class="col-md-5">
                                                <input type="text" name="topics[0][outline]"
                                                       class="form-control mb-2" placeholder="Module Outline" required>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" class="btn btn-danger remove-topic">×</button>
                                            </div>
                                        </div>
                                    </div>
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
                                    <option value="10th">10th Grade</option>
                                    <option value="12th">12th Grade</option>
                                    <option value="UG">Undergraduate</option>
                                    <option value="PG">Postgraduate</option>
                                    <option value="Diploma">Diploma</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Minimum Age <span class="text-danger">*</span></label>
                                <input type="number" name="minimum_age" class="form-control" required
                                       min="16" max="50" placeholder="e.g., 17">
                                <div class="form-text">Minimum age requirement</div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Work Experience Required</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" name="work_experience_required"
                                           id="work_exp_switch" value="1">
                                    <label class="form-check-label" for="work_exp_switch">Work Experience Required</label>
                                </div>
                            </div>

                            <div class="col-12 mb-3" id="work_exp_details" style="display: none;">
                                <label class="form-label">Work Experience Details</label>
                                <textarea name="work_experience_details" class="form-control" rows="3"
                                          placeholder="Details about work experience requirements..."></textarea>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Language Proficiency <span class="text-danger">*</span></label>
                                <input type="text" name="language_proficiency" class="form-control" required
                                       placeholder="e.g., IELTS 6.0, JLPT N2, TOEFL 80">
                                <div class="form-text">Required language test scores</div>
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
                                       placeholder="e.g., 12 Months, 2 Years">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Internship Included</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" name="internship_included"
                                           id="internship_switch" value="1">
                                    <label class="form-check-label" for="internship_switch">Internship Included</label>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Local Training</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" name="local_training"
                                           id="local_training_switch" value="1">
                                    <label class="form-check-label" for="local_training_switch">Local Training Included</label>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3" id="internship_duration" style="display: none;">
                                <label class="form-label">Internship Duration</label>
                                <input type="text" name="internship_duration" class="form-control"
                                       placeholder="e.g., 6 Months, 1 Year">
                            </div>

                            <div class="col-md-6 mb-3" id="local_training_duration" style="display: none;">
                                <label class="form-label">Local Training Duration</label>
                                <input type="text" name="local_training_duration" class="form-control"
                                       placeholder="e.g., 3 Months, 6 Months">
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Total Duration <span class="text-danger">*</span></label>
                                <input type="text" name="total_duration" class="form-control" required
                                       placeholder="e.g., Overseas 12M + Internship 6M + Local 3M">
                                <div class="form-text">Overall course duration including all components</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Paid Type <span class="text-danger">*</span></label>
                                <select name="paid_type" class="form-select" required>
                                    <option value="">Select Type</option>
                                    <option value="Paid">Paid</option>
                                    <option value="Free">Free</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Total Fees (Approx.)</label>
                                <input type="text" name="total_fees" class="form-control"
                                       placeholder="e.g., INR 4.1 Lakhs">
                            </div>

                            <!-- Financial Assistance -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Financial Assistance</label>
                                <div class="border p-3 rounded">
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" name="scholarship_available"
                                               id="scholarship_switch" value="1">
                                        <label class="form-check-label" for="scholarship_switch">Scholarship Available</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="bank_loan_assistance"
                                               id="loan_switch" value="1">
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
                                <textarea name="career_outcomes" class="form-control" rows="4" required
                                          placeholder="Enter each job role on a new line&#10;e.g., Junior Software Developer&#10;Web Developer&#10;IT Support Specialist"></textarea>
                                <div class="form-text">Enter each job role on a separate line</div>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Next Pathways / Progression</label>
                                <textarea name="next_pathways" class="form-control" rows="3"
                                          placeholder="Enter progression options on new lines&#10;e.g., Degree entry to Year 2&#10;Master's Program&#10;Work Visa Pathway"></textarea>
                                <div class="form-text">Higher study or career progression options</div>
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
                                           id="visa_switch" value="1">
                                    <label class="form-check-label" for="visa_switch">Visa Support Included</label>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Accommodation Support</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="accommodation_support"
                                           id="accommodation_switch" value="1">
                                    <label class="form-check-label" for="accommodation_switch">Accommodation Support</label>
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Visa Notes</label>
                                <textarea name="visa_notes" class="form-control" rows="3"
                                          placeholder="Visa processing details and requirements..."></textarea>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Accommodation Notes</label>
                                <textarea name="accommodation_notes" class="form-control" rows="3"
                                          placeholder="Accommodation options and details..."></textarea>
                            </div>
                        </div>

                        <!-- Section 7: Media & SEO -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="border-bottom pb-2">Media & SEO</h5>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Thumbnail Image <span class="text-danger">*</span></label>
                                <input type="file" name="thumbnail_image" class="form-control"
                                       accept="image/*" required>
                                <div class="form-text">Course thumbnail image</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Gallery Images</label>
                                <input type="file" name="gallery_images[]" class="form-control"
                                       multiple accept="image/*">
                                <div class="form-text">Multiple images for course gallery</div>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Short Description <span class="text-danger">*</span></label>
                                <textarea name="short_description" class="form-control" rows="3" maxlength="200" required
                                          placeholder="Brief description (max 200 characters)"></textarea>
                                <div class="form-text"><span id="char-count">0</span>/200 characters</div>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Meta Description</label>
                                <textarea name="meta_description" class="form-control" rows="3"
                                          placeholder="SEO meta description..."></textarea>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">SEO Keywords</label>
                                <input type="text" name="seo_keywords" class="form-control"
                                       placeholder="keyword1, keyword2, keyword3">
                                <div class="form-text">Comma separated keywords for SEO</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Display Order</label>
                                <input type="number" name="display_order" class="form-control" value="0"
                                       min="0">
                                <div class="form-text">Lower numbers display first</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Publish Status</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" name="publish_status"
                                           id="publish_switch" value="1">
                                    <label class="form-check-label" for="publish_switch">Publish Course</label>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">Create Course</button>
                                    <button type="reset" class="btn btn-secondary">Reset Form</button>
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

<!-- Simple JavaScript for dynamic behavior -->
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
    let topicCount = 1;
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
@push('scripts')
<script>
    $(document).ready(function() {
    // Summernote for long description
        $('#long_description').summernote({
            height: 200,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'codeview']]
            ],
            placeholder: 'Write detailed course description here...'
        });
    });

</script>
@endpush
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
