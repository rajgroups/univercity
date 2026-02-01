@extends('layouts.admin.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-gradient-primary text-white py-3">
                    <h4 class="mb-0">
                        <i class="fas fa-edit me-2"></i>Edit International Course
                    </h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.intlcourse.update', $course->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')

                        <!-- Stepper Navigation -->
                        <div class="stepper-wrapper mb-5">
                            <div class="stepper-item active" data-step="1">
                                <div class="step-counter">1</div>
                                <div class="step-name">Basic Info</div>
                            </div>
                            <div class="stepper-item" data-step="2">
                                <div class="step-counter">2</div>
                                <div class="step-name">Course Details</div>
                            </div>
                            <div class="stepper-item" data-step="3">
                                <div class="step-counter">3</div>
                                <div class="step-name">Eligibility</div>
                            </div>
                            <div class="stepper-item" data-step="4">
                                <div class="step-counter">4</div>
                                <div class="step-name">Fees & Duration</div>
                            </div>
                            <div class="stepper-item" data-step="5">
                                <div class="step-counter">5</div>
                                <div class="step-name">Media & SEO</div>
                            </div>
                        </div>

                        <!-- Section 1: Provider and Affiliation -->
                        <div class="section-card mb-4" data-section="1">
                            <div class="section-header d-flex align-items-center justify-content-between mb-4">
                                <h5 class="mb-0">
                                    <i class="fas fa-university me-2"></i>Provider and Affiliation
                                </h5>
                                <span class="badge bg-primary">Step 1</span>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Admission Provider <span class="text-danger">*</span></label>
                                        <select name="admission_provider" class="form-select form-select-lg" required>
                                            <option value="">Select Provider</option>
                                            <option value="ISICO" {{ $course->admission_provider == 'ISICO' ? 'selected' : '' }}>ISICO</option>
                                            <option value="Overseas Partner" {{ $course->admission_provider == 'Overseas Partner' ? 'selected' : '' }}>Overseas Partner</option>
                                        </select>
                                        <div class="form-text text-muted">Select the main admission provider</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Overseas Partner Institution <span class="text-danger">*</span></label>
                                        <input type="text" name="overseas_partner_institution" class="form-control form-control-lg" required
                                               value="{{ old('overseas_partner_institution', $course->overseas_partner_institution) }}"
                                               placeholder="Enter institution name">
                                        <div class="form-text text-muted">Full name of overseas partner institution</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Accreditation / Recognition</label>
                                        <input type="text" name="accreditation_recognition" class="form-control"
                                               value="{{ old('accreditation_recognition', $course->accreditation_recognition) }}"
                                               placeholder="e.g., PEI registered, Govt Accreditation">
                                        <div class="form-text text-muted">Any accreditation or recognition details</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Destination Country <span class="text-danger">*</span></label>
                                        <select name="country_id" class="form-select select2" required>
                                            <option value="">Select Country</option>
                                            @foreach($countrys as $country)
                                                <option value="{{ $country->id }}" {{ $course->country_id == $country->id ? 'selected' : '' }}>
                                                    {{ $country->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="form-text text-muted">Select the destination country</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 2: Course Information -->
                        <div class="section-card mb-4" data-section="2">
                            <div class="section-header d-flex align-items-center justify-content-between mb-4">
                                <h5 class="mb-0">
                                    <i class="fas fa-book-open me-2"></i>Course Information
                                </h5>
                                <span class="badge bg-info">Step 2</span>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Course Code</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                            <input type="text" name="course_code" class="form-control" readonly
                                                   value="{{ old('course_code', $course->course_code) }}"
                                                   placeholder="Auto-generated">
                                        </div>
                                        <div class="form-text text-muted">Auto-generated code (Country + Number)</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Course Title <span class="text-danger">*</span></label>
                                        <input type="text" name="course_title" class="form-control" required
                                               value="{{ old('course_title', $course->course_title) }}"
                                               placeholder="Official course name">
                                        <div class="form-text text-muted">Official name of the course</div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Domain / Sector <span class="text-danger">*</span></label>
                                        <select name="sector_id" class="form-select select2" required>
                                            <option value="">Select Sector</option>
                                            @foreach($sectors as $sector)
                                                <option value="{{ $sector->id }}" {{ $course->sector_id == $sector->id ? 'selected' : '' }}>
                                                    {{ $sector->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="form-text text-muted">e.g., IT, Business, Hospitality</div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Course Level <span class="text-danger">*</span></label>
                                        <select name="category_id" class="form-select select2" required>
                                            <option value="">Select Level</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ $course->category_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="form-text text-muted">e.g., Foundation, UG, PG, Diploma</div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Certification Type <span class="text-danger">*</span></label>
                                        <input type="text" name="certification_type" class="form-control" required
                                               value="{{ old('certification_type', $course->certification_type) }}"
                                               placeholder="e.g., University Certificate, Joint Certificate">
                                        <div class="form-text text-muted">Type of certification awarded</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Language of Instruction <span class="text-danger">*</span></label>
                                        <select name="language_of_instruction[]" class="form-select select2-multiple" multiple required>
                                            @php $selectedLangs = $course->language_of_instruction ?? []; @endphp
                                            <option value="English" {{ in_array('English', $selectedLangs) ? 'selected' : '' }}>English</option>
                                            <option value="Japanese" {{ in_array('Japanese', $selectedLangs) ? 'selected' : '' }}>Japanese</option>
                                            <option value="Chinese" {{ in_array('Chinese', $selectedLangs) ? 'selected' : '' }}>Chinese</option>
                                            <option value="French" {{ in_array('French', $selectedLangs) ? 'selected' : '' }}>French</option>
                                            <option value="German" {{ in_array('German', $selectedLangs) ? 'selected' : '' }}>German</option>
                                            <option value="Spanish" {{ in_array('Spanish', $selectedLangs) ? 'selected' : '' }}>Spanish</option>
                                        </select>
                                        <div class="form-text text-muted">Select multiple languages if applicable</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Pathway Type <span class="text-danger">*</span></label>
                                        <select name="pathway_type" class="form-select" required>
                                            <option value="">Select Pathway Type</option>
                                            <option value="Online" {{ $course->pathway_type == 'Online' ? 'selected' : '' }}>Online</option>
                                            <option value="Onsite Abroad" {{ $course->pathway_type == 'Onsite Abroad' ? 'selected' : '' }}>Onsite Abroad</option>
                                            <option value="Hybrid" {{ $course->pathway_type == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                                            <option value="Twinning" {{ $course->pathway_type == 'Twinning' ? 'selected' : '' }}>Twinning</option>
                                            <option value="Dual Credit" {{ $course->pathway_type == 'Dual Credit' ? 'selected' : '' }}>Dual Credit</option>
                                        </select>
                                        <div class="form-text text-muted">Select the study pathway type</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Mode of Study <span class="text-danger">*</span></label>
                                    <div class="mode-checkboxes">
                                        @php $selectedModes = $course->mode_of_study ?? []; @endphp
                                        @foreach(['Online', 'In Centre', 'Hybrid', 'On-demand Site'] as $mode)
                                        <div class="form-check form-check-inline">
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

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Intake Months <span class="text-danger">*</span></label>
                                    <div class="intake-months">
                                        @php $selectedMonths = $course->intake_months ?? []; @endphp
                                        @foreach(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'] as $month)
                                        <div class="month-checkbox">
                                            <input class="form-check-input" type="checkbox" name="intake_months[]"
                                                   value="{{ $month }}" id="month_{{ $month }}"
                                                   {{ in_array($month, $selectedMonths) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="month_{{ $month }}">{{ $month }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Course Details <span class="text-danger">*</span></label>
                                        <textarea name="course_details" class="form-control" rows="6" id="long_description" required
                                                  placeholder="Full course description and details...">{{ old('course_details', $course->course_details) }}</textarea>
                                        <div class="form-text text-muted">Detailed course description for the course page</div>
                                    </div>
                                </div>

                                <!-- Topics/Syllabus Repeater -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Topics / Syllabus Covered <span class="text-danger">*</span></label>
                                        <div class="card">
                                            <div class="card-body">
                                                <div id="topics-container">
                                                    @php $topics = $course->topics_syllabus ?? []; @endphp
                                                    @if(count($topics) > 0)
                                                        @foreach($topics as $index => $topic)
                                                        <div class="topic-item card mb-2">
                                                            <div class="card-body">
                                                                <div class="row g-2">
                                                                    <div class="col-md-5">
                                                                        <input type="text" name="topics[{{ $index }}][module_title]"
                                                                               class="form-control" placeholder="Module Title" required
                                                                               value="{{ $topic['module_title'] ?? '' }}">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="text" name="topics[{{ $index }}][outline]"
                                                                               class="form-control" placeholder="Module Outline" required
                                                                               value="{{ $topic['outline'] ?? '' }}">
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <button type="button" class="btn btn-danger btn-sm remove-topic">
                                                                            <i class="fas fa-times"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    @else
                                                        <!-- Default Empty Item -->
                                                        <div class="topic-item card mb-2">
                                                            <div class="card-body">
                                                                <div class="row g-2">
                                                                    <div class="col-md-5">
                                                                        <input type="text" name="topics[0][module_title]"
                                                                               class="form-control" placeholder="Module Title" required>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="text" name="topics[0][outline]"
                                                                               class="form-control" placeholder="Module Outline" required>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <button type="button" class="btn btn-danger btn-sm remove-topic">
                                                                            <i class="fas fa-times"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="add-topic">
                                                    <i class="fas fa-plus me-1"></i>Add Another Topic
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 3: Eligibility -->
                        <div class="section-card mb-4" data-section="3">
                            <div class="section-header d-flex align-items-center justify-content-between mb-4">
                                <h5 class="mb-0">
                                    <i class="fas fa-user-check me-2"></i>Eligibility Criteria
                                </h5>
                                <span class="badge bg-warning">Step 3</span>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Minimum Education <span class="text-danger">*</span></label>
                                        <select name="minimum_education" class="form-select" required>
                                            <option value="">Select Education Level</option>
                                            <option value="10th" {{ $course->minimum_education == '10th' ? 'selected' : '' }}>10th Grade</option>
                                            <option value="12th" {{ $course->minimum_education == '12th' ? 'selected' : '' }}>12th Grade</option>
                                            <option value="UG" {{ $course->minimum_education == 'UG' ? 'selected' : '' }}>Undergraduate</option>
                                            <option value="PG" {{ $course->minimum_education == 'PG' ? 'selected' : '' }}>Postgraduate</option>
                                            <option value="Diploma" {{ $course->minimum_education == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Minimum Age <span class="text-danger">*</span></label>
                                        <input type="number" name="minimum_age" class="form-control" required
                                               min="16" max="50" placeholder="e.g., 17"
                                               value="{{ old('minimum_age', $course->minimum_age) }}">
                                        <div class="form-text text-muted">Minimum age requirement</div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Work Experience Required</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="work_experience_required"
                                                   id="work_exp_switch" value="1" {{ $course->work_experience_required ? 'checked' : '' }}>
                                            <label class="form-check-label" for="work_exp_switch">Work Experience Required</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12" id="work_exp_details" style="display: {{ $course->work_experience_required ? 'block' : 'none' }};">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Work Experience Details</label>
                                        <textarea name="work_experience_details" class="form-control" rows="3"
                                                  placeholder="Details about work experience requirements...">{{ old('work_experience_details', $course->work_experience_details) }}</textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Language Proficiency <span class="text-danger">*</span></label>
                                        <input type="text" name="language_proficiency" class="form-control" required
                                               value="{{ old('language_proficiency', $course->language_proficiency) }}"
                                               placeholder="e.g., IELTS 6.0, JLPT N2, TOEFL 80">
                                        <div class="form-text text-muted">Required language test scores</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 4: Fees & Duration -->
                        <div class="section-card mb-4" data-section="4">
                            <div class="section-header d-flex align-items-center justify-content-between mb-4">
                                <h5 class="mb-0">
                                    <i class="fas fa-calendar-alt me-2"></i>Course Duration & Fee Structure
                                </h5>
                                <span class="badge bg-success">Step 4</span>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Overseas Duration <span class="text-danger">*</span></label>
                                        <input type="text" name="course_duration_overseas" class="form-control" required
                                               value="{{ old('course_duration_overseas', $course->course_duration_overseas) }}"
                                               placeholder="e.g., 12 Months, 2 Years">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Internship Included</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="internship_included"
                                                   id="internship_switch" value="1" {{ $course->internship_included ? 'checked' : '' }}>
                                            <label class="form-check-label" for="internship_switch">Internship Included</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Local Training</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="local_training"
                                                   id="local_training_switch" value="1" {{ $course->local_training ? 'checked' : '' }}>
                                            <label class="form-check-label" for="local_training_switch">Local Training Included</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6" id="internship_duration" style="display: {{ $course->internship_included ? 'block' : 'none' }};">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Internship Duration</label>
                                        <input type="text" name="internship_duration" class="form-control"
                                               value="{{ old('internship_duration', $course->internship_duration) }}"
                                               placeholder="e.g., 6 Months, 1 Year">
                                    </div>
                                </div>

                                <div class="col-12" id="internship_summary_div" style="display: {{ $course->internship_included ? 'block' : 'none' }};">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Internship Summary</label>
                                        <textarea name="internship_summary" class="form-control" rows="3"
                                                  placeholder="Internship terms & conditions or summary">{{ old('internship_summary', $course->internship_summary) }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6" id="local_training_duration" style="display: {{ $course->local_training ? 'block' : 'none' }};">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Local Training Duration</label>
                                        <input type="text" name="local_training_duration" class="form-control"
                                               value="{{ old('local_training_duration', $course->local_training_duration) }}"
                                               placeholder="e.g., 3 Months, 6 Months">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Total Duration <span class="text-danger">*</span></label>
                                        <input type="text" name="total_duration" class="form-control" required
                                               value="{{ old('total_duration', $course->total_duration) }}"
                                               placeholder="e.g., Overseas 12M + Internship 6M + Local 3M">
                                        <div class="form-text text-muted">Overall course duration including all components</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Paid Type <span class="text-danger">*</span></label>
                                        <select name="paid_type" class="form-select" required>
                                            <option value="">Select Type</option>
                                            <option value="Paid" {{ $course->paid_type == 'Paid' ? 'selected' : '' }}>Paid</option>
                                            <option value="Free" {{ $course->paid_type == 'Free' ? 'selected' : '' }}>Free</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Total Fees (Approx.)</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
                                            <input type="text" name="total_fees" class="form-control"
                                                   value="{{ old('total_fees', $course->total_fees) }}"
                                                   placeholder="Approx. INR 4.1 Lakhs">
                                        </div>
                                        <div class="form-text text-muted">Must clearly mention "Approx"</div>
                                    </div>
                                </div>

                                <!-- Overseas Fee Breakdown -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Overseas Course Fee Breakdown</label>
                                        <div class="card">
                                            <div class="card-body">
                                                <div id="overseas-fees-container">
                                                    @php $overseasFees = $course->overseas_fee_breakdown ?? []; @endphp
                                                    @foreach($overseasFees as $index => $fee)
                                                    <div class="fee-item mb-3">
                                                        <div class="row g-2">
                                                            <div class="col-md-5">
                                                                <input type="text" name="overseas_fee_breakdown[{{ $index }}][label]"
                                                                       class="form-control" placeholder="Label (e.g. Tuition Fee)"
                                                                       value="{{ $fee['label'] ?? '' }}">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="number" name="overseas_fee_breakdown[{{ $index }}][amount]"
                                                                       class="form-control" placeholder="Amount" step="0.01"
                                                                       value="{{ $fee['amount'] ?? '' }}">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <select name="overseas_fee_breakdown[{{ $index }}][currency]" class="form-select">
                                                                    @foreach(['USD', 'INR', 'EUR', 'GBP', 'AUD', 'SGD', 'CAD'] as $curr)
                                                                    <option value="{{ $curr }}" {{ ($fee['currency'] ?? '') == $curr ? 'selected' : '' }}>{{ $curr }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <button type="button" class="btn btn-danger btn-sm remove-overseas-fee">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="add-overseas-fee">
                                                    <i class="fas fa-plus me-1"></i>Add Fee Component
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Local Training Fee -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Local Training Fee Breakdown</label>
                                        <div class="card">
                                            <div class="card-body">
                                                <div id="local-fees-container">
                                                    @php $localFees = $course->local_training_fee ?? []; @endphp
                                                    @foreach($localFees as $index => $fee)
                                                    <div class="fee-item mb-3">
                                                        <div class="row g-2">
                                                            <div class="col-md-5">
                                                                <input type="text" name="local_training_fee[{{ $index }}][label]"
                                                                       class="form-control" placeholder="Label (e.g. Language Training)"
                                                                       value="{{ $fee['label'] ?? '' }}">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="number" name="local_training_fee[{{ $index }}][amount]"
                                                                       class="form-control" placeholder="Amount" step="0.01"
                                                                       value="{{ $fee['amount'] ?? '' }}">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <select name="local_training_fee[{{ $index }}][currency]" class="form-select">
                                                                    @foreach(['USD', 'INR', 'EUR', 'GBP', 'AUD', 'SGD', 'CAD'] as $curr)
                                                                    <option value="{{ $curr }}" {{ ($fee['currency'] ?? '') == $curr ? 'selected' : '' }}>{{ $curr }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <button type="button" class="btn btn-danger btn-sm remove-local-fee">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="add-local-fee">
                                                    <i class="fas fa-plus me-1"></i>Add Fee Component
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Financial Assistance -->
                                <div class="col-12 mt-4">
                                    <h5 class="border-bottom pb-2 mb-3">
                                        <i class="fas fa-hand-holding-usd me-2"></i>Financial Assistance
                                    </h5>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Scholarship Available</label>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" name="scholarship_available"
                                                   id="scholarship_switch" value="1" {{ $course->scholarship_available ? 'checked' : '' }}>
                                            <label class="form-check-label" for="scholarship_switch">Enable Scholarship</label>
                                        </div>
                                        <div id="scholarship_notes_div" style="display: {{ $course->scholarship_available ? 'block' : 'none' }};">
                                            <textarea name="scholarship_notes" class="form-control" rows="2"
                                                      placeholder="Scholarship Notes...">{{ old('scholarship_notes', $course->scholarship_notes) }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Bank Loan Assistance</label>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" name="bank_loan_assistance"
                                                   id="loan_switch" value="1" {{ $course->bank_loan_assistance ? 'checked' : '' }}>
                                            <label class="form-check-label" for="loan_switch">Enable Loan Assistance</label>
                                        </div>
                                        <div id="loan_notes_div" style="display: {{ $course->bank_loan_assistance ? 'block' : 'none' }};">
                                            <textarea name="loan_assistance_notes" class="form-control" rows="2"
                                                      placeholder="Loan Assistance Notes...">{{ old('loan_assistance_notes', $course->loan_assistance_notes) }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- Learning Outcomes -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Career Outcomes / Job Roles <span class="text-danger">*</span></label>
                                        <textarea name="career_outcomes" class="form-control" rows="4" required
                                                  placeholder="Enter each job role on a new line&#10;e.g., Junior Software Developer&#10;Web Developer&#10;IT Support Specialist">@foreach($course->career_outcomes as $outcome){{ $outcome }}{{ !$loop->last ? "\n" : '' }}@endforeach</textarea>
                                        <div class="form-text text-muted">Enter each job role on a separate line</div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Next Pathways / Progression</label>
                                        <textarea name="next_pathways" class="form-control" rows="3"
                                                  placeholder="Enter progression options on new lines&#10;e.g., Degree entry to Year 2&#10;Master's Program&#10;Work Visa Pathway">@if($course->next_pathways)@foreach($course->next_pathways as $pathway){{ $pathway }}{{ !$loop->last ? "\n" : '' }}@endforeach @endif</textarea>
                                        <div class="form-text text-muted">Higher study or career progression options</div>
                                    </div>
                                </div>

                                <!-- Visa & Logistics -->
                                <div class="col-12 mt-4">
                                    <h5 class="border-bottom pb-2 mb-3">
                                        <i class="fas fa-passport me-2"></i>Visa & Logistics
                                    </h5>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" name="visa_support_included"
                                               id="visa_switch" value="1" {{ $course->visa_support_included ? 'checked' : '' }}>
                                        <label class="form-check-label fw-bold" for="visa_switch">Visa Support Included</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" name="accommodation_support"
                                               id="accommodation_switch" value="1" {{ $course->accommodation_support ? 'checked' : '' }}>
                                        <label class="form-check-label fw-bold" for="accommodation_switch">Accommodation Support</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Visa Notes</label>
                                        <textarea name="visa_notes" class="form-control" rows="3"
                                                  placeholder="Visa processing details and requirements...">{{ old('visa_notes', $course->visa_notes) }}</textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Accommodation Notes</label>
                                        <textarea name="accommodation_notes" class="form-control" rows="3"
                                                  placeholder="Accommodation options and details...">{{ old('accommodation_notes', $course->accommodation_notes) }}</textarea>
                                    </div>
                                </div>

                                <!-- Living Cost Section -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Living Cost (Per Month – Approx.)</label>
                                        <div class="card">
                                            <div class="card-body">
                                                <div id="living-cost-container">
                                                    @php $livingCosts = $course->living_costs ?? []; @endphp
                                                    @foreach($livingCosts as $index => $cost)
                                                    <div class="fee-item mb-3">
                                                        <div class="row g-2">
                                                            <div class="col-md-5">
                                                                <input type="text" name="living_costs[{{ $index }}][label]"
                                                                       class="form-control" placeholder="Label (e.g. Food, Accommodation)"
                                                                       value="{{ $cost['label'] ?? '' }}">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="number" name="living_costs[{{ $index }}][amount]"
                                                                       class="form-control" placeholder="Amount" step="0.01"
                                                                       value="{{ $cost['amount'] ?? '' }}">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <select name="living_costs[{{ $index }}][currency]" class="form-select">
                                                                    @foreach(['USD', 'INR', 'EUR', 'GBP', 'AUD', 'SGD', 'CAD'] as $curr)
                                                                    <option value="{{ $curr }}" {{ ($cost['currency'] ?? '') == $curr ? 'selected' : '' }}>{{ $curr }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <button type="button" class="btn btn-danger btn-sm remove-living-cost">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="add-living-cost">
                                                    <i class="fas fa-plus me-1"></i>Add Cost Item
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- FAQ Section -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">FAQ (Frequently Asked Questions)</label>
                                        <div class="card">
                                            <div class="card-body">
                                                <div id="faq-container">
                                                    @php $faqs = $course->faqs ?? []; @endphp
                                                    @foreach($faqs as $index => $faq)
                                                    <div class="faq-item mb-3 border-bottom pb-3">
                                                        <div class="row">
                                                            <div class="col-md-11">
                                                                <input type="text" name="faqs[{{ $index }}][question]" class="form-control mb-2" placeholder="Question"
                                                                       value="{{ $faq['question'] ?? '' }}">
                                                                <textarea name="faqs[{{ $index }}][answer]" class="form-control" rows="2" placeholder="Answer">{{ $faq['answer'] ?? '' }}</textarea>
                                                            </div>
                                                            <div class="col-md-1 d-flex align-items-center justify-content-center">
                                                                <button type="button" class="btn btn-danger btn-sm remove-faq">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="add-faq">
                                                    <i class="fas fa-plus me-1"></i>Add FAQ
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 5: Media & SEO -->
                        <div class="section-card mb-4" data-section="5">
                            <div class="section-header d-flex align-items-center justify-content-between mb-4">
                                <h5 class="mb-0">
                                    <i class="fas fa-images me-2"></i>Media & SEO
                                </h5>
                                <span class="badge bg-purple">Step 5</span>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Thumbnail Image</label>
                                        @if($course->thumbnail_image)
                                            <div class="mb-2">
                                                <img src="{{ asset($course->thumbnail_image) }}" alt="Thumbnail" class="img-thumbnail" style="max-height: 100px;">
                                            </div>
                                        @endif
                                        <div class="file-upload">
                                            <input type="file" name="thumbnail_image" class="form-control"
                                                   accept="image/*">
                                        </div>
                                        <div class="form-text text-muted">Leave empty to keep current image (Recommended: 600x400px)</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Gallery Images</label>
                                        @if($course->gallery_images && count($course->gallery_images) > 0)
                                            <div class="mb-2 d-flex flex-wrap gap-2">
                                                @foreach($course->gallery_images as $image)
                                                    <img src="{{ asset($image) }}" alt="Gallery" class="img-thumbnail" style="max-height: 80px;">
                                                @endforeach
                                            </div>
                                        @endif
                                        <div class="file-upload">
                                            <input type="file" name="gallery_images[]" class="form-control"
                                                   multiple accept="image/*">
                                        </div>
                                        <div class="form-text text-muted">Upload to add more images to gallery</div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Short Description <span class="text-danger">*</span></label>
                                        <textarea name="short_description" class="form-control" rows="3" maxlength="200" required
                                                  placeholder="Brief description (max 200 characters)">{{ old('short_description', $course->short_description) }}</textarea>
                                        <div class="d-flex justify-content-between mt-1">
                                            <div class="form-text text-muted">Brief description for course listing</div>
                                            <div class="form-text"><span class="char-count">{{ strlen($course->short_description) }}</span>/200 characters</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Meta Description</label>
                                        <textarea name="meta_description" class="form-control" rows="3"
                                                  placeholder="SEO meta description...">{{ old('meta_description', $course->meta_description) }}</textarea>
                                        <div class="form-text text-muted">Brief description for search engines</div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">SEO Keywords</label>
                                        <input type="text" name="seo_keywords" class="form-control"
                                               value="{{ old('seo_keywords', $course->seo_keywords) }}"
                                               placeholder="keyword1, keyword2, keyword3">
                                        <div class="form-text text-muted">Comma separated keywords for SEO</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Display Order</label>
                                        <input type="number" name="display_order" class="form-control"
                                               value="{{ old('display_order', $course->display_order) }}"
                                               min="0">
                                        <div class="form-text text-muted">Lower numbers display first</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Publish Status</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="publish_status"
                                                   id="publish_switch" value="1" {{ $course->publish_status ? 'checked' : '' }}>
                                            <label class="form-check-label" for="publish_switch">Publish Course</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Navigation & Submit Buttons -->
                        <div class="row mt-5">
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="nav-buttons">
                                        <button type="button" class="btn btn-outline-secondary me-2" id="prev-btn">
                                            <i class="fas fa-arrow-left me-1"></i>Previous
                                        </button>
                                        <button type="button" class="btn btn-outline-primary" id="next-btn">
                                            Next <i class="fas fa-arrow-right ms-1"></i>
                                        </button>
                                    </div>
                                    <div class="submit-buttons">
                                        <button type="submit" class="btn btn-success btn-lg px-4">
                                            <i class="fas fa-save me-2"></i>Update Course
                                        </button>
                                        <a href="{{ route('admin.intlcourse.index') }}" class="btn btn-outline-danger ms-2">
                                            Cancel
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .stepper-wrapper {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        position: relative;
    }
    .stepper-wrapper::before {
        content: "";
        position: absolute;
        top: 24px;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: #e9ecef;
        z-index: 1;
    }
    .stepper-item {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        flex: 1;
        z-index: 2;
    }
    .stepper-item .step-counter {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: #fff;
        border: 2px solid #e9ecef;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
        margin-bottom: 6px;
        color: #6c757d;
        transition: all 0.3s ease;
    }
    .stepper-item.active .step-counter {
        border-color: #4e73df;
        background-color: #4e73df;
        color: #fff;
        box-shadow: 0 0 10px rgba(78, 115, 223, 0.4);
    }
    .stepper-item.completed .step-counter {
        border-color: #1cc88a;
        background-color: #1cc88a;
        color: #fff;
    }
    .stepper-item .step-name {
        font-size: 14px;
        font-weight: 600;
        color: #6c757d;
    }
    .stepper-item.active .step-name {
        color: #4e73df;
    }
    .stepper-item.completed .step-name {
        color: #1cc88a;
    }
    .section-card {
        display: none;
        animation: fadeIn 0.4s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .submit-buttons {
        display: none;
    }
    .file-upload {
        position: relative;
        margin-top: 5px;
    }

    /* Force borders on form controls and selects */
    .form-control, .form-select, .select2-selection {
        border: 1px solid #ced4da !important;
    }
    .select2-container .select2-selection--single {
        height: 38px !important;
    }
    .select2-container--bootstrap4 .select2-selection--single .select2-selection__rendered {
        line-height: 36px !important;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">

<script>
$(document).ready(function() {
    // Initialize Select2
    $('.select2').select2({
        width: '100%',
        theme: 'bootstrap-5'
    });

    $('.select2-multiple').select2({
        width: '100%',
        theme: 'bootstrap-5',
        placeholder: "Select Languages",
        allowClear: true
    });

    // Initialize Summernote
    $('#long_description').summernote({
        height: 250,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture', 'table']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ],
        placeholder: 'Write detailed course description here...'
    });

    // Stepper functionality
    let currentStep = 1;
    const totalSteps = 5;
    const sections = $('.section-card');

    function showStep(step) {
        sections.hide();
        $(`[data-section="${step}"]`).show();
        updateStepper(step);
        updateButtons();
    }

    function updateStepper(step) {
        $('.stepper-item').removeClass('active completed');
        $('.stepper-item').each(function(index) {
            const stepNumber = index + 1;
            if (stepNumber < step) {
                $(this).addClass('completed');
            } else if (stepNumber === step) {
                $(this).addClass('active');
            }
        });
        currentStep = step;
        
        // Remove validation state when entering new step
        $('.was-validated').removeClass('was-validated');
    }

    function updateButtons() {
        $('#prev-btn').toggle(currentStep > 1);
        $('#next-btn').toggle(currentStep < totalSteps);
        if (currentStep === totalSteps) {
            $('.submit-buttons').show();
        } else {
            $('.submit-buttons').hide();
        }
    }

    // Navigation with Validation
    $('#next-btn').click(function() {
        const currentSection = $(`.section-card[data-section="${currentStep}"]`);
        const invalidInputs = currentSection.find(':input[required]').filter(function() {
            return !this.checkValidity();
        });

        if (invalidInputs.length > 0) {
            invalidInputs[0].reportValidity();
            currentSection.closest('form').addClass('was-validated');
            return;
        }

        if (currentStep < totalSteps) {
            showStep(currentStep + 1);
            smoothScrollToTop();
        }
    });

    $('#prev-btn').click(function() {
        if (currentStep > 1) {
            showStep(currentStep - 1);
            smoothScrollToTop();
        }
    });

    function smoothScrollToTop() {
        $('html, body').animate({
            scrollTop: $('.section-card:visible').offset().top - 100
        }, 300);
    }

    // Show first step initially
    showStep(1);

    // Character counter
    $('textarea[name="short_description"]').on('input', function() {
        const count = $(this).val().length;
        $(this).siblings('.d-flex').find('.char-count').text(count);
    });

    // Toggle work experience details
    $('#work_exp_switch').change(function() {
        $('#work_exp_details').toggle(this.checked);
    });

    // Toggle internship
    $('#internship_switch').change(function() {
        const checked = this.checked;
        $('#internship_duration').toggle(checked);
        $('#internship_summary_div').toggle(checked);
    });

    // Toggle local training
    $('#local_training_switch').change(function() {
        $('#local_training_duration').toggle(this.checked);
    });

    // Toggle scholarship notes
    $('#scholarship_switch').change(function() {
        $('#scholarship_notes_div').toggle(this.checked);
    });

    // Toggle loan notes
    $('#loan_switch').change(function() {
        $('#loan_notes_div').toggle(this.checked);
    });

    // Repeater Functionality
    function setupRepeater(containerId, addButtonId, templateFn, startCount) {
        let count = startCount;
        
        $(`#${addButtonId}`).click(function() {
            const newItem = templateFn(count);
            $(`#${containerId}`).append(newItem);
            count++;
        });

        $(document).on('click', `.remove-${addButtonId.replace('add-', '')}`, function() {
            if ($(`#${containerId} > div`).length > 1) {
                $(this).closest('div[class*="item"]').remove();
            }
        });
    }

    // Topics Repeater
    let topicCount = {{ count($course->topics_syllabus ?? []) > 0 ? count($course->topics_syllabus) : 1 }};
    $('#add-topic').click(function() {
        const newTopic = `
            <div class="topic-item card mb-2">
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-md-5">
                            <input type="text" name="topics[${topicCount}][module_title]"
                                   class="form-control" placeholder="Module Title" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="topics[${topicCount}][outline]"
                                   class="form-control" placeholder="Module Outline" required>
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger btn-sm remove-topic">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        $('#topics-container').append(newTopic);
        topicCount++;
    });

    $(document).on('click', '.remove-topic', function() {
        if ($('#topics-container .topic-item').length > 1) {
            $(this).closest('.topic-item').remove();
        }
    });

    // Overseas Fees Repeater
    setupRepeater('overseas-fees-container', 'add-overseas-fee', (i) => `
        <div class="fee-item mb-3">
            <div class="row g-2">
                <div class="col-md-5">
                    <input type="text" name="overseas_fee_breakdown[${i}][label]"
                           class="form-control" placeholder="Label (e.g. Tuition Fee)">
                </div>
                <div class="col-md-4">
                    <input type="number" name="overseas_fee_breakdown[${i}][amount]"
                           class="form-control" placeholder="Amount" step="0.01">
                </div>
                <div class="col-md-2">
                    <select name="overseas_fee_breakdown[${i}][currency]" class="form-select">
                        <option value="USD">USD</option>
                        <option value="INR">INR</option>
                        <option value="EUR">EUR</option>
                        <option value="GBP">GBP</option>
                        <option value="AUD">AUD</option>
                        <option value="SGD">SGD</option>
                        <option value="CAD">CAD</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger btn-sm remove-overseas-fee">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    `, {{ count($course->overseas_fee_breakdown ?? []) }});

    // Local Fees Repeater
    setupRepeater('local-fees-container', 'add-local-fee', (i) => `
        <div class="fee-item mb-3">
            <div class="row g-2">
                <div class="col-md-5">
                    <input type="text" name="local_training_fee[${i}][label]"
                           class="form-control" placeholder="Label (e.g. Language Training)">
                </div>
                <div class="col-md-4">
                    <input type="number" name="local_training_fee[${i}][amount]"
                           class="form-control" placeholder="Amount" step="0.01">
                </div>
                <div class="col-md-2">
                    <select name="local_training_fee[${i}][currency]" class="form-select">
                        <option value="USD">USD</option>
                        <option value="INR">INR</option>
                        <option value="EUR">EUR</option>
                        <option value="GBP">GBP</option>
                        <option value="AUD">AUD</option>
                        <option value="SGD">SGD</option>
                        <option value="CAD">CAD</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger btn-sm remove-local-fee">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    `, {{ count($course->local_training_fee ?? []) }});

    // Living Cost Repeater
    setupRepeater('living-cost-container', 'add-living-cost', (i) => `
        <div class="fee-item mb-3">
            <div class="row g-2">
                <div class="col-md-5">
                    <input type="text" name="living_costs[${i}][label]"
                           class="form-control" placeholder="Label (e.g. Food, Accommodation)">
                </div>
                <div class="col-md-4">
                    <input type="number" name="living_costs[${i}][amount]"
                           class="form-control" placeholder="Amount" step="0.01">
                </div>
                <div class="col-md-2">
                    <select name="living_costs[${i}][currency]" class="form-select">
                        <option value="USD">USD</option>
                        <option value="INR">INR</option>
                        <option value="EUR">EUR</option>
                        <option value="GBP">GBP</option>
                        <option value="AUD">AUD</option>
                        <option value="SGD">SGD</option>
                        <option value="CAD">CAD</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger btn-sm remove-living-cost">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    `, {{ count($course->living_costs ?? []) }});

    // FAQ Repeater
    setupRepeater('faq-container', 'add-faq', (i) => `
        <div class="faq-item mb-3 border-bottom pb-3">
            <div class="row">
                <div class="col-md-11">
                    <input type="text" name="faqs[${i}][question]" class="form-control mb-2" placeholder="Question">
                    <textarea name="faqs[${i}][answer]" class="form-control" rows="2" placeholder="Answer"></textarea>
                </div>
                <div class="col-md-1 d-flex align-items-center justify-content-center">
                    <button type="button" class="btn btn-danger btn-sm remove-faq">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    `, {{ count($course->faqs ?? []) }});

    // Form validation on submit check
    $('form').on('submit', function(e) {
        if (!this.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
            $(this).addClass('was-validated');
            $('input:invalid, select:invalid, textarea:invalid').first().focus();
        }
    });
});
</script>
@endpush
