@extends('layouts.admin.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-gradient-primary text-white py-3">
                    <h4 class="mb-0">
                        <i class="fas fa-globe-americas me-2"></i>Add New International Course
                    </h4>
                </div>
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-exclamation-triangle me-2 fs-4"></i>
                                <div>
                                    <h5 class="alert-heading mb-1">There were some problems with your input:</h5>
                                    <ul class="mb-0 ps-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.intlcourse.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf

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
                                            <option value="ISICO" {{ old('admission_provider') == 'ISICO' ? 'selected' : '' }}>ISICO</option>
                                            <option value="Overseas Partner" {{ old('admission_provider') == 'Overseas Partner' ? 'selected' : '' }}>Overseas Partner</option>
                                        </select>
                                        <div class="form-text text-muted">Select the main admission provider</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Overseas Partner Institution <span class="text-danger">*</span></label>
                                        <input type="text" name="overseas_partner_institution" class="form-control form-control-lg" required
                                               value="{{ old('overseas_partner_institution') }}"
                                               placeholder="Enter institution name">
                                        <div class="form-text text-muted">Full name of overseas partner institution</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Accreditation / Recognition</label>
                                        <input type="text" name="accreditation_recognition" class="form-control"
                                               value="{{ old('accreditation_recognition') }}"
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
                                                <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
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
                                                   placeholder="Auto-generated">
                                        </div>
                                        <div class="form-text text-muted">Auto-generated code (Country + Number)</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Course Title <span class="text-danger">*</span></label>
                                        <input type="text" name="course_title" class="form-control" required
                                               id="course_title"
                                               value="{{ old('course_title') }}"
                                               placeholder="Official course name">
                                        <div class="form-text text-muted">Official name of the course</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Slug (Auto)</label>
                                        <input type="text" name="slug" class="form-control" readonly id="course_slug" placeholder="Auto-generated from title">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Domain / Sector <span class="text-danger">*</span></label>
                                        <select name="sector_id" class="form-select select2" required>
                                            <option value="">Select Sector</option>
                                            @foreach($sectors as $sector)
                                                <option value="{{ $sector->id }}" {{ old('sector_id') == $sector->id ? 'selected' : '' }}>{{ $sector->name }}</option>
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
                                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="form-text text-muted">e.g., Foundation, UG, PG, Diploma</div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Certification Type <span class="text-danger">*</span></label>
                                        <input type="text" name="certification_type" class="form-control" required
                                               value="{{ old('certification_type') }}"
                                               placeholder="e.g., University Certificate, Joint Certificate">
                                        <div class="form-text text-muted">Type of certification awarded</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Language of Instruction <span class="text-danger">*</span></label>
                                        <select name="language_of_instruction[]" class="form-select select2-multiple" multiple required>
                                            <option value="English" {{ in_array('English', old('language_of_instruction', [])) ? 'selected' : '' }}>English</option>
                                            <option value="Japanese" {{ in_array('Japanese', old('language_of_instruction', [])) ? 'selected' : '' }}>Japanese</option>
                                            <option value="Chinese" {{ in_array('Chinese', old('language_of_instruction', [])) ? 'selected' : '' }}>Chinese</option>
                                            <option value="French" {{ in_array('French', old('language_of_instruction', [])) ? 'selected' : '' }}>French</option>
                                            <option value="German" {{ in_array('German', old('language_of_instruction', [])) ? 'selected' : '' }}>German</option>
                                            <option value="Spanish" {{ in_array('Spanish', old('language_of_instruction', [])) ? 'selected' : '' }}>Spanish</option>
                                        </select>
                                        <div class="form-text text-muted">Select multiple languages if applicable</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Pathway Type <span class="text-danger">*</span></label>
                                        <select name="pathway_type" class="form-select" required>
                                            <option value="">Select Pathway Type</option>
                                            <option value="Online" {{ old('pathway_type') == 'Online' ? 'selected' : '' }}>Online</option>
                                            <option value="Onsite Abroad" {{ old('pathway_type') == 'Onsite Abroad' ? 'selected' : '' }}>Onsite Abroad</option>
                                            <option value="Hybrid" {{ old('pathway_type') == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                                            <option value="Twinning" {{ old('pathway_type') == 'Twinning' ? 'selected' : '' }}>Twinning</option>
                                            <option value="Dual Credit" {{ old('pathway_type') == 'Dual Credit' ? 'selected' : '' }}>Dual Credit</option>
                                        </select>
                                        <div class="form-text text-muted">Select the study pathway type</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Mode of Study <span class="text-danger">*</span></label>
                                    <div class="mode-checkboxes">
                                        @foreach(['Online', 'In Centre', 'Hybrid', 'On-demand Site'] as $mode)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="mode_of_study[]"
                                                   value="{{ $mode }}" id="mode_{{ Str::slug($mode) }}" {{ in_array($mode, old('mode_of_study', [])) ? 'checked' : '' }}>
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
                                        @foreach(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'] as $month)
                                        <div class="month-checkbox">
                                            <input class="form-check-input" type="checkbox" name="intake_months[]"
                                                   value="{{ $month }}" id="month_{{ $month }}" {{ in_array($month, old('intake_months', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="month_{{ $month }}">{{ $month }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Course Details <span class="text-danger">*</span></label>
                                        <textarea name="course_details" class="form-control" rows="6" id="long_description" required
                                                  placeholder="Full course description and details...">{{ old('course_details') }}</textarea>
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
                                            <option value="10th" {{ old('minimum_education') == '10th' ? 'selected' : '' }}>10th Grade</option>
                                            <option value="12th" {{ old('minimum_education') == '12th' ? 'selected' : '' }}>12th Grade</option>
                                            <option value="UG" {{ old('minimum_education') == 'UG' ? 'selected' : '' }}>Undergraduate</option>
                                            <option value="PG" {{ old('minimum_education') == 'PG' ? 'selected' : '' }}>Postgraduate</option>
                                            <option value="Diploma" {{ old('minimum_education') == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Minimum Age <span class="text-danger">*</span></label>
                                        <input type="number" name="minimum_age" class="form-control" required
                                               value="{{ old('minimum_age') }}"
                                               min="16" max="50" placeholder="e.g., 17">
                                        <div class="form-text text-muted">Minimum age requirement</div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Work Experience Required</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="work_experience_required"
                                                   id="work_exp_switch" value="1" {{ old('work_experience_required') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="work_exp_switch">Work Experience Required</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12" id="work_exp_details" style="display: none;">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Work Experience Details</label>
                                        <textarea name="work_experience_details" class="form-control" rows="3"
                                                  placeholder="Details about work experience requirements...">{{ old('work_experience_details') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Language Proficiency <span class="text-danger">*</span></label>
                                        <input type="text" name="language_proficiency" class="form-control" required
                                               value="{{ old('language_proficiency') }}"
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
                                        <div class="input-group">
                                            <input type="number" class="form-control duration-input" id="overseas_val" placeholder="12" min="1">
                                            <select class="form-select duration-unit" id="overseas_unit">
                                                <option value="Months">Months</option>
                                                <option value="Years">Years</option>
                                                <option value="Weeks">Weeks</option>
                                            </select>
                                        </div>
                                        <input type="hidden" name="course_duration_overseas" id="course_duration_overseas">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Internship Included</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="internship_included"
                                                   id="internship_switch" value="1" {{ old('internship_included') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="internship_switch">Internship Included</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Local Training</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="local_training"
                                                   id="local_training_switch" value="1" {{ old('local_training') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="local_training_switch">Local Training Included</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6" id="internship_duration" style="display: none;">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Internship Duration</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control duration-input" id="internship_val" placeholder="6" min="1">
                                            <select class="form-select duration-unit" id="internship_unit">
                                                <option value="Months">Months</option>
                                                <option value="Years">Years</option>
                                                <option value="Weeks">Weeks</option>
                                            </select>
                                        </div>
                                        <input type="hidden" name="internship_duration" id="internship_duration_field">
                                    </div>
                                </div>

                                <div class="col-12" id="internship_summary_div" style="display: none;">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Internship Summary</label>
                                        <textarea name="internship_summary" class="form-control" rows="3"
                                                  placeholder="Internship terms & conditions or summary">{{ old('internship_summary') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6" id="local_training_duration" style="display: none;">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Local Training Duration</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control duration-input" id="local_val" placeholder="3" min="1">
                                            <select class="form-select duration-unit" id="local_unit">
                                                <option value="Months">Months</option>
                                                <option value="Days">Days</option>
                                                <option value="Weeks">Weeks</option>
                                            </select>
                                        </div>
                                        <input type="hidden" name="local_training_duration" id="local_training_duration_field">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Total Duration (Auto)</label>
                                        <input type="text" name="total_duration" class="form-control" id="total_duration" readonly
                                               placeholder="Calculated automatically...">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Paid Type <span class="text-danger">*</span></label>
                                        <select name="paid_type" class="form-select" required>
                                            <option value="">Select Type</option>
                                            <option value="Paid" {{ old('paid_type') == 'Paid' ? 'selected' : '' }}>Paid</option>
                                            <option value="Free" {{ old('paid_type') == 'Free' ? 'selected' : '' }}>Free</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Total Fees (Approx.)</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
                                            <input type="text" name="total_fees" class="form-control"
                                                   value="{{ old('total_fees') }}"
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
                                                    <div class="fee-item mb-3">
                                                        <div class="row g-2">
                                                            <div class="col-md-5">
                                                                <input type="text" name="overseas_fee_breakdown[0][label]"
                                                                       class="form-control" placeholder="Label (e.g. Tuition Fee)">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="number" name="overseas_fee_breakdown[0][amount]"
                                                                       class="form-control" placeholder="Amount" step="0.01">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <select name="overseas_fee_breakdown[0][currency]" class="form-select">
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
                                                    <div class="fee-item mb-3">
                                                        <div class="row g-2">
                                                            <div class="col-md-5">
                                                                <input type="text" name="local_training_fee[0][label]"
                                                                       class="form-control" placeholder="Label (e.g. Language Training)">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="number" name="local_training_fee[0][amount]"
                                                                       class="form-control" placeholder="Amount" step="0.01">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <select name="local_training_fee[0][currency]" class="form-select">
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
                                                   id="scholarship_switch" value="1" {{ old('scholarship_available') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="scholarship_switch">Enable Scholarship</label>
                                        </div>
                                        <div id="scholarship_notes_div" style="display: none;">
                                            <textarea name="scholarship_notes" class="form-control" rows="2"
                                                      placeholder="Scholarship Notes...">{{ old('scholarship_notes') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Bank Loan Assistance</label>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" name="bank_loan_assistance"
                                                   id="loan_switch" value="1" {{ old('bank_loan_assistance') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="loan_switch">Enable Loan Assistance</label>
                                        </div>
                                        <div id="loan_notes_div" style="display: none;">
                                            <textarea name="loan_assistance_notes" class="form-control" rows="2"
                                                      placeholder="Loan Assistance Notes...">{{ old('loan_assistance_notes') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- Learning Outcomes -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Career Outcomes / Job Roles <span class="text-danger">*</span></label>
                                        <div id="career-outcomes-container">
                                            @php
                                                $outcomes = old('career_outcomes') ? json_decode(old('career_outcomes'), true) : [];
                                                if (!is_array($outcomes) && old('career_outcomes')) {
                                                    // Fallback if it was a plain string or something else
                                                    $outcomes = [old('career_outcomes')]; 
                                                }
                                            @endphp
                                            
                                            @if(count($outcomes) > 0)
                                                @foreach($outcomes as $outcome)
                                                <div class="outcome-item input-group mb-2">
                                                    <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                                                    <input type="text" name="career_outcomes_list[]" class="form-control" 
                                                           value="{{ $outcome }}"
                                                           placeholder="Job Role (e.g., Junior Software Developer, Assistant Chef)" required>
                                                    <button type="button" class="btn btn-danger remove-career-outcome"><i class="fas fa-times"></i></button>
                                                </div>
                                                @endforeach
                                            @else
                                                <div class="outcome-item input-group mb-2">
                                                    <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                                                    <input type="text" name="career_outcomes_list[]" class="form-control" placeholder="Job Role (e.g., Junior Software Developer, Assistant Chef)" required>
                                                    <button type="button" class="btn btn-danger remove-career-outcome"><i class="fas fa-times"></i></button>
                                                </div>
                                            @endif
                                        </div>
                                        <input type="hidden" name="career_outcomes" id="career_outcomes_final">
                                        <button type="button" class="btn btn-outline-primary btn-sm mt-1" id="add-career-outcome">
                                            <i class="fas fa-plus me-1"></i>Add Job Role
                                        </button>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Next Pathways / Progression</label>
                                        <div id="next-pathways-container">
                                            @php
                                                $pathways = old('next_pathways') ? json_decode(old('next_pathways'), true) : [];
                                                 if (!is_array($pathways) && old('next_pathways')) {
                                                    $pathways = [old('next_pathways')];
                                                }
                                            @endphp

                                            @if(count($pathways) > 0)
                                                @foreach($pathways as $pathway)
                                                <div class="pathway-item input-group mb-2">
                                                    <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                                                    <input type="text" name="next_pathways_list[]" class="form-control" 
                                                           value="{{ $pathway }}"
                                                           placeholder="Pathway (e.g., Degree entry, Work progression route)">
                                                    <button type="button" class="btn btn-danger remove-next-pathway"><i class="fas fa-times"></i></button>
                                                </div>
                                                @endforeach
                                            @else
                                                <div class="pathway-item input-group mb-2">
                                                    <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                                                    <input type="text" name="next_pathways_list[]" class="form-control" placeholder="Pathway (e.g., Degree entry, Work progression route)">
                                                    <button type="button" class="btn btn-danger remove-next-pathway"><i class="fas fa-times"></i></button>
                                                </div>
                                            @endif
                                        </div>
                                        <input type="hidden" name="next_pathways" id="next_pathways_final">
                                        <button type="button" class="btn btn-outline-primary btn-sm mt-1" id="add-next-pathway">
                                            <i class="fas fa-plus me-1"></i>Add Pathway
                                        </button>
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
                                               id="visa_switch" value="1" {{ old('visa_support_included') ? 'checked' : '' }}>
                                        <label class="form-check-label fw-bold" for="visa_switch">Visa Support Included</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" name="accommodation_support"
                                               id="accommodation_switch" value="1" {{ old('accommodation_support') ? 'checked' : '' }}>
                                        <label class="form-check-label fw-bold" for="accommodation_switch">Accommodation Support</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Visa Notes</label>
                                        <textarea name="visa_notes" class="form-control" rows="3"
                                                  placeholder="Visa processing details and requirements...">{{ old('visa_notes') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Accommodation Notes</label>
                                        <textarea name="accommodation_notes" class="form-control" rows="3"
                                                  placeholder="Accommodation options and details...">{{ old('accommodation_notes') }}</textarea>
                                    </div>
                                </div>

                                <!-- Living Cost Section -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Living Cost (Per Month – Approx.)</label>
                                        <div class="card">
                                            <div class="card-body">
                                                <div id="living-cost-container">
                                                    <div class="fee-item mb-3">
                                                        <div class="row g-2">
                                                            <div class="col-md-5">
                                                                <input type="text" name="living_costs[0][label]"
                                                                       class="form-control" placeholder="Label (e.g. Food, Accommodation)">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="number" name="living_costs[0][amount]"
                                                                       class="form-control" placeholder="Amount" step="0.01">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <select name="living_costs[0][currency]" class="form-select">
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
                                                    <div class="faq-item mb-3 border-bottom pb-3">
                                                        <div class="row">
                                                            <div class="col-md-11">
                                                                <input type="text" name="faqs[0][question]" class="form-control mb-2" placeholder="Question">
                                                                <textarea name="faqs[0][answer]" class="form-control" rows="2" placeholder="Answer"></textarea>
                                                            </div>
                                                            <div class="col-md-1 d-flex align-items-center justify-content-center">
                                                                <button type="button" class="btn btn-danger btn-sm remove-faq">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
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
                                        <label class="form-label fw-bold">Thumbnail Image <span class="text-danger">*</span></label>
                                        <div class="file-upload">
                                            <input type="file" name="thumbnail_image" class="form-control"
                                                   accept="image/*" required>
                                        </div>
                                        <div class="form-text text-muted">Course thumbnail image (Recommended: 600x400px)</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Gallery Images</label>
                                        <div class="file-upload">
                                            <input type="file" name="gallery_images[]" class="form-control"
                                                   multiple accept="image/*">
                                        </div>
                                        <div class="form-text text-muted">Multiple images for course gallery</div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Course Brochure / Documents</label>
                                        <div id="brochures-container">
                                            <div class="brochure-item mb-2 border p-2 rounded relative">
                                                <div class="row g-2">
                                                    <div class="col-md-5">
                                                        <input type="text" name="course_brochures[0][label]" class="form-control" placeholder="Document Name (e.g. Brochure)">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="file" name="course_brochures[0][file]" class="form-control doc-file-input" accept=".pdf,.doc,.docx">
                                                    </div>
                                                    <div class="col-md-1">
                                                         <button type="button" class="btn btn-danger btn-sm remove-brochure">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-outline-primary btn-sm mt-1" id="add-brochure">
                                            <i class="fas fa-plus me-1"></i>Add Document
                                        </button>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Short Description <span class="text-danger">*</span></label>
                                        <textarea name="short_description" class="form-control" rows="3" maxlength="200" required
                                                  placeholder="Brief description (max 200 characters)">{{ old('short_description') }}</textarea>
                                        <div class="d-flex justify-content-between mt-1">
                                            <div class="form-text text-muted">Brief description for course listing</div>
                                            <div class="form-text"><span class="char-count">0</span>/200 characters</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Meta Description</label>
                                        <textarea name="meta_description" class="form-control" rows="3"
                                                  placeholder="SEO meta description...">{{ old('meta_description') }}</textarea>
                                        <div class="form-text text-muted">Brief description for search engines</div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">SEO Keywords</label>
                                        <input type="text" name="seo_keywords" class="form-control"
                                               value="{{ old('seo_keywords') }}"
                                               placeholder="keyword1, keyword2, keyword3">
                                        <div class="form-text text-muted">Comma separated keywords for SEO</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Display Order</label>
                                        <input type="number" name="display_order" class="form-control" value="{{ old('display_order', 0) }}"
                                               min="0">
                                        <div class="form-text text-muted">Lower numbers display first</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Publish Status</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="publish_status"
                                                   id="publish_switch" value="1" {{ old('publish_status', '1') == '1' ? 'checked' : '' }}>
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
                                            <i class="fas fa-save me-2"></i>Create Course
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
        content: '';
        position: absolute;
        top: 20px;
        left: 0;
        right: 0;
        height: 2px;
        background-color: #e0e0e0;
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

    .stepper-item.active .step-counter {
        background-color: #4361ee;
        color: white;
        border-color: #4361ee;
    }

    .stepper-item.completed .step-counter {
        background-color: #4caf50;
        color: white;
        border-color: #4caf50;
    }

    .step-counter {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: white;
        border: 2px solid #e0e0e0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-bottom: 8px;
        transition: all 0.3s ease;
    }

    .step-name {
        font-size: 14px;
        color: #666;
        font-weight: 500;
    }

    .stepper-item.active .step-name {
        color: #4361ee;
        font-weight: 600;
    }

    .section-card {
        background: white;
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .section-card:hover {
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }

    .section-header {
        border-bottom: 2px solid #f0f0f0;
        padding-bottom: 15px;
    }

    .mode-checkboxes,
    .intake-months {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        border: 1px solid #e9ecef;
    }

    .intake-months {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
    }

    .month-checkbox {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .file-upload {
        position: relative;
    }

    .file-upload input[type="file"] {
        padding: 12px;
        border: 2px dashed #dee2e6;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .file-upload input[type="file"]:hover {
        border-color: #4361ee;
        background: #f8f9ff;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }

    .form-control, .form-select {
        border-radius: 8px;
        padding: 10px 15px;
        border: 1px solid #ddd;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #4361ee;
        box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.25);
    }

    .form-check-input:checked {
        background-color: #4361ee;
        border-color: #4361ee;
    }

    .btn {
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-success {
        background: linear-gradient(135deg, #4caf50, #2e7d32);
        border: none;
    }

    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
    }

    .btn-outline-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(67, 97, 238, 0.1);
    }

    .topic-item, .fee-item, .faq-item {
        transition: all 0.3s ease;
    }

    .topic-item:hover, .fee-item:hover {
        transform: translateX(5px);
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }

    .badge {
        padding: 8px 15px;
        border-radius: 20px;
        font-weight: 500;
    }

    .bg-purple {
        background-color: #6f42c1;
    }

    .char-count {
        font-weight: 600;
        color: #4361ee;
    }

    @media (max-width: 768px) {
        .stepper-wrapper {
            flex-direction: column;
            gap: 20px;
        }

        .stepper-wrapper::before {
            display: none;
        }

        .stepper-item {
            flex-direction: row;
            gap: 15px;
            text-align: left;
        }

        .step-counter {
            margin-bottom: 0;
        }

        .intake-months {
            grid-template-columns: repeat(3, 1fr);
        }

        .nav-buttons, .submit-buttons {
            width: 100%;
            margin-bottom: 10px;
        }

        .nav-buttons .btn, .submit-buttons .btn {
            width: 100%;
        }
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
        theme: 'bootstrap4',
        width: '100%'
    });

    $('.select2-multiple').select2({
        theme: 'bootstrap4',
        width: '100%',
        placeholder: "Select languages",
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
            // Report validity of the first invalid field to trigger browser interaction
            invalidInputs[0].reportValidity();
            // Add bootstrap validation class for visual feedback
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

    // Topics/Syllabus repeater
    let topicCount = 1;
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

    // Remove topic
    $(document).on('click', '.remove-topic', function() {
        if ($('#topics-container .topic-item').length > 1) {
            $(this).closest('.topic-item').remove();
        }
    });

    // Helper function for Repeaters
    function setupRepeater(containerId, addButtonId, templateFn) {
        let count = 1;

        $(`#${addButtonId}`).click(function() {
            const newItem = templateFn(count);
            $(`#${containerId}`).append(newItem);
            count++;
        });

        $(document).on('click', `.remove-${addButtonId.replace('add-', '')}`, function() {
            if ($(`#${containerId} > div`).length > 1) {
                $(this).closest('.fee-item, .faq-item').remove();
            }
        });
    }

    // Overseas Fee Repeater
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
    `);

    // Local Fee Repeater
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
    `);

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
    `);

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
    `);

    // Form validation on submit (final check)
    // Updated submit handler
    $('form').on('submit', function(e) {
        let valid = true;
        
        // 1. Check Course Brochures for file presence and type
        $('.doc-file-input').each(function() {
            if ($(this).val()) {
                const file = this.files[0];
                const fileType = file.type;
                const validTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
                
                if (!validTypes.includes(fileType)) {
                    notyf.error('Invalid file type for document. Only PDF, DOC, DOCX allowed.');
                    $(this).addClass('is-invalid');
                    valid = false;
                } else {
                    $(this).removeClass('is-invalid');
                }
            } else {
                // If it's the first one and optional, maybe ok? But if row exists, it usually implies needed.
                // Assuming optional repeater, but if row exists, file is needed?
                // Left loose for now unless 'required'
            }
        });

        if (!valid) {
            e.preventDefault();
            e.stopPropagation();
            return false;
        }

        // 2. Prepare JSON for Repeater fields
        // Career Outcomes
        let outcomes = [];
        $('input[name="career_outcomes_list[]"]').each(function() {
            if($(this).val().trim() !== '') {
                outcomes.push($(this).val().trim());
            }
        });
        if (outcomes.length === 0) {
           // Allow empty? Field is required in HTML.
           // Browser validation should catch if empty.
        }
        $('#career_outcomes_final').val(JSON.stringify(outcomes));

        // Next Pathways
        let pathways = [];
        $('input[name="next_pathways_list[]"]').each(function() {
            if($(this).val().trim() !== '') {
                pathways.push($(this).val().trim());
            }
        });
        $('#next_pathways_final').val(JSON.stringify(pathways));


        if (!this.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
            $(this).addClass('was-validated');
            // Scroll to first invalid field
            $('input:invalid, select:invalid, textarea:invalid').first().focus();
        }
    });

    // Slug generation
    $('#course_title').on('keyup', function() {
        const title = $(this).val();
        const slug = title.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)+/g, '');
        $('#course_slug').val(slug);
    });

    // Duration Logic
    function updateDuration(type) {
        const val = $(`#${type}_val`).val();
        const unit = $(`#${type}_unit`).val();
        if (val) {
            $(`#${type}_duration_field`).val(`${val} ${unit}`);
            if (type === 'overseas') $(`#course_duration_overseas`).val(`${val} ${unit}`);
        } else {
            $(`#${type}_duration_field`).val('');
            if (type === 'overseas') $(`#course_duration_overseas`).val('');
        }
        calculateTotalDuration();
    }

    $('.duration-input, .duration-unit').on('input change', function() {
        // determine type based on id prefix
        const id = $(this).attr('id');
        let type = 'overseas';
        if (id.includes('internship')) type = 'internship';
        if (id.includes('local')) type = 'local';
        updateDuration(type);
    });

    function calculateTotalDuration() {
        const overseas = $('#course_duration_overseas').val();
        const internship = $('#internship_duration_field').val();
        const local = $('#local_training_duration_field').val();
        
        const parts = [];
        if (overseas) parts.push(`Overseas ${overseas}`);
        if ($('#internship_switch').is(':checked') && internship) parts.push(`Internship ${internship}`);
        if ($('#local_training_switch').is(':checked') && local) parts.push(`Local Training ${local}`);
        
        $('#total_duration').val(parts.join(' + '));
    }

    $('#internship_switch, #local_training_switch').change(function() {
        calculateTotalDuration();
    });

    // Outcomes Repeater
    let careerCount = 1;
    $('#add-career-outcome').click(function() {
        $('#career-outcomes-container').append(`
            <div class="outcome-item input-group mb-2">
                <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                <input type="text" name="career_outcomes_list[]" class="form-control" placeholder="Job Role (e.g., Junior Software Developer, Assistant Chef)" required>
                <button type="button" class="btn btn-danger remove-career-outcome"><i class="fas fa-times"></i></button>
            </div>
        `);
    });
    $(document).on('click', '.remove-career-outcome', function() {
        if ($('.outcome-item').length > 1) $(this).closest('.outcome-item').remove();
    });

    // Pathways Repeater
    $('#add-next-pathway').click(function() {
        $('#next-pathways-container').append(`
            <div class="pathway-item input-group mb-2">
                <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                <input type="text" name="next_pathways_list[]" class="form-control" placeholder="Pathway (e.g., Degree entry, Work progression route)">
                <button type="button" class="btn btn-danger remove-next-pathway"><i class="fas fa-times"></i></button>
            </div>
        `);
    });
    $(document).on('click', '.remove-next-pathway', function() {
        if ($('.pathway-item').length > 1) $(this).closest('.pathway-item').remove();
    });

    // Brochure Repeater
    let brochureCount = 1;
    $('#add-brochure').click(function() {
        $('#brochures-container').append(`
            <div class="brochure-item mb-2 border p-2 rounded relative">
                <div class="row g-2">
                    <div class="col-md-5">
                        <input type="text" name="course_brochures[${brochureCount}][label]" class="form-control" placeholder="Document Name">
                    </div>
                    <div class="col-md-6">
                        <input type="file" name="course_brochures[${brochureCount}][file]" class="form-control doc-file-input" accept=".pdf,.doc,.docx">
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger btn-sm remove-brochure"><i class="fas fa-times"></i></button>
                    </div>
                </div>
            </div>
        `);
        brochureCount++;
    });
    $(document).on('click', '.remove-brochure', function() {
        if ($('.brochure-item').length > 1) $(this).closest('.brochure-item').remove();
    });

    // Auto-generate course code based on country

});
</script>
@endpush
