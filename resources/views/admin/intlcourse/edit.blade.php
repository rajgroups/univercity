@extends('layouts.admin.app')

@section('content')
    <div class="container mt-4">
        <div class="page-header">
            <div class="add-item d-flex">
                <div class="page-title">
                    <h4 class="fw-bold">Edit Course</h4>
                    <h6>Update Course Details</h6>
                </div>
            </div>
            <ul class="table-top-head">
                <li>
                    <a data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Refresh"><i class="ti ti-refresh"></i></a>
                </li>
                <li>
                    <a data-bs-toggle="tooltip" data-bs-placement="top" id="collapse-header" aria-label="Collapse">
                        <i class="ti ti-chevron-up"></i>
                    </a>
                </li>
            </ul>
            <div class="page-btn mt-0">
                <a href="{{ route('admin.intlcourse.index') }}" class="btn btn-secondary">
                    <i class="feather feather-arrow-left me-2"></i>Back to List
                </a>
            </div>
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Error Message --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="shadow rounded-3 p-3">
            <form action="{{ route('admin.intlcourse.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body row g-3">
                        <h4 class="mb-3">Provider & Affiliation Details</h4>
                        <div class="col-md-6">
                            <label for="admin_provider" class="form-label">Admission Provider</label>
                            <input type="text" class="form-control @error('admin_provider') is-invalid @enderror"
                                name="admin_provider" value="{{ old('admin_provider', $course->admin_provider) }}"
                                placeholder="ISICO / overseas partner">
                            @error('admin_provider')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="partner" class="form-label">Overseas Institution / Partner <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('partner') is-invalid @enderror" name="partner"
                                placeholder="e.g., Trent Global College, Singapore"
                                value="{{ old('partner', $course->partner) }}">
                            @error('partner')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="accreditation_recognition" class="form-label">Accreditation / Recognition</label>
                            <input type="text"
                                class="form-control @error('accreditation_recognition') is-invalid @enderror"
                                name="accreditation_recognition"
                                placeholder="ISICO-recognized, Partner-recognized, International Board, Other"
                                value="{{ old('accreditation_recognition', $course->accreditation_recognition) }}">
                            @error('accreditation_recognition')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body row g-3">
                        <h4 class="mb-3">Course Details</h4>
                        <div class="col-md-6">
                            <label for="course_name" class="form-label">Course Name / Title <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('course_name') is-invalid @enderror"
                                name="course_name" value="{{ old('course_name', $course->course_name) }}"
                                placeholder="Diploma in Computer Science" required>
                            @error('course_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="level" class="form-label">Level <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('level') is-invalid @enderror" name="level"
                                value="{{ old('level', $course->level) }}">
                            @error('level')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if ($course->image)
                                <div class="mt-2">
                                    <img src="{{ asset($course->image) }}" alt="Course Image" style="max-height: 100px;"
                                        class="img-thumbnail">
                                    <small class="text-muted d-block">Current Image</small>
                                </div>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Domain / Sector <span class="text-danger">*</span></label>
                            <select name="sector_id" class="form-select @error('sector_id') is-invalid @enderror">
                                <option value="">Select Sector</option>
                                @foreach ($sectors as $sector)
                                    <option value="{{ $sector->id }}"
                                        {{ old('sector_id', $course->sector_id) == $sector->id ? 'selected' : '' }}>
                                        {{ $sector->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('sector_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Category <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $course->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Pathway Type <span class="text-danger">*</span></label>
                            <select name="pathway_type" class="form-select @error('pathway_type') is-invalid @enderror">
                                <option value="">Select Pathway Type</option>
                                <option value="online_pathway"
                                    {{ old('pathway_type', $course->pathway_type) == 'online_pathway' ? 'selected' : '' }}>
                                    Online Pathway</option>
                                <option value="onsite_abroad"
                                    {{ old('pathway_type', $course->pathway_type) == 'onsite_abroad' ? 'selected' : '' }}>
                                    Onsite Abroad</option>
                                <option value="hybrid"
                                    {{ old('pathway_type', $course->pathway_type) == 'hybrid' ? 'selected' : '' }}>Hybrid
                                </option>
                                <option value="dual_credit"
                                    {{ old('pathway_type', $course->pathway_type) == 'dual_credit' ? 'selected' : '' }}>
                                    Dual-credit</option>
                                <option value="twinning_program"
                                    {{ old('pathway_type', $course->pathway_type) == 'twinning_program' ? 'selected' : '' }}>
                                    Twinning Program</option>
                            </select>
                            @error('pathway_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Country <span class="text-danger">*</span></label>
                            <select name="country_id" class="form-select @error('country_id') is-invalid @enderror">
                                <option value="">Select Country</option>
                                @foreach ($countrys as $country)
                                    <option value="{{ $country->id }}"
                                        {{ old('country_id', $course->country_id) == $country->id ? 'selected' : '' }}>
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('country_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Language of Instruction <span class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control @error('language_instruction') is-invalid @enderror"
                                name="language_instruction"
                                value="{{ old('language_instruction', $course->language_instruction) }}">
                            @error('language_instruction')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Learning Product Type</label>
                            <input type="text"
                                class="form-control @error('learning_product_type') is-invalid @enderror"
                                name="learning_product_type"
                                value="{{ old('learning_product_type', $course->learning_product_type) }}">
                            @error('learning_product_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Paid Type <span class="text-danger">*</span></label>
                            <select name="paid_type" class="form-select @error('paid_type') is-invalid @enderror">
                                <option value="Free"
                                    {{ old('paid_type', $course->paid_type) == 'Free' ? 'selected' : '' }}>Free</option>
                                <option value="Paid"
                                    {{ old('paid_type', $course->paid_type) == 'Paid' ? 'selected' : '' }}>Paid</option>
                            </select>
                            @error('paid_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Short Description <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('short_description') is-invalid @enderror" name="short_description"
                                rows="2">{{ old('short_description', $course->short_description) }}</textarea>
                            @error('short_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Long Description <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('long_description') is-invalid @enderror" name="long_description"
                                rows="4" id="long_description">{{ old('long_description', $course->long_description) }}</textarea>
                            @error('long_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body row g-3">
                        <h4 class="mb-3">Additional Course Details</h4>

                        <div class="col-md-6">
                            <label class="form-label">Certification Type</label>
                            <input type="text" class="form-control @error('certification_type') is-invalid @enderror"
                                name="certification_type"
                                value="{{ old('certification_type', $course->certification_type) }}">
                            @error('certification_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">ISICO Course Code <span class="text-danger">*</span></label>
                            <input type="text" name="isico_course_code"
                                class="form-control @error('isico_course_code') is-invalid @enderror"
                                placeholder="e.g., SG001"
                                value="{{ old('isico_course_code', $course->isico_course_code) }}" required>
                            @error('isico_course_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">International Mapping</label>
                            <input type="text" name="international_mapping"
                                class="form-control @error('international_mapping') is-invalid @enderror"
                                placeholder="e.g., aligned to UK Level 5, Singapore Diploma, Japan Senmon-Gakko level, etc."
                                value="{{ old('international_mapping', $course->international_mapping) }}">
                            @error('international_mapping')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Credits Transferable</label>
                            <select name="credits_transferable"
                                class="form-select @error('credits_transferable') is-invalid @enderror"
                                onchange="toggleMaxCredits(this)">
                                <option value="">Select Option</option>
                                <option value="Yes"
                                    {{ old('credits_transferable', $course->credits_transferable) == 'Yes' ? 'selected' : '' }}>
                                    Yes</option>
                                <option value="No"
                                    {{ old('credits_transferable', $course->credits_transferable) == 'No' ? 'selected' : '' }}>
                                    No</option>
                            </select>
                            @error('credits_transferable')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6" id="maxCreditsField"
                            style="{{ old('credits_transferable', $course->credits_transferable) == 'Yes' ? 'display:block;' : 'display:none;' }}">
                            <label class="form-label">Max Credits Transferrable</label>
                            <input type="number" name="max_credits"
                                class="form-control @error('max_credits') is-invalid @enderror"
                                placeholder="Enter max credits" value="{{ old('max_credits', $course->max_credits) }}">
                            @error('max_credits')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Internship</label>
                            <input type="text" name="internship"
                                class="form-control @error('internship') is-invalid @enderror"
                                placeholder="Enter internship details"
                                value="{{ old('internship', $course->internship) }}">
                            @error('internship')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <h5 class="mb-3 mt-3">Delivery & Assessment</h5>

                        <div class="col-md-6">
                            <label class="form-label">Mode of Training <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('provider') is-invalid @enderror"
                                name="provider" value="{{ old('provider', $course->provider) }}">
                            @error('provider')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Assessment Mode <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('assessment_mode') is-invalid @enderror"
                                name="assessment_mode" value="{{ old('assessment_mode', $course->assessment_mode) }}">
                            @error('assessment_mode')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Learning Tools <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('learning_tools') is-invalid @enderror"
                                name="learning_tools" value="{{ old('learning_tools', $course->learning_tools) }}">
                            @error('learning_tools')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Bridge Modules</label>
                            <input type="text" name="bridge_modules"
                                class="form-control @error('bridge_modules') is-invalid @enderror"
                                placeholder="Enter bridge modules"
                                value="{{ old('bridge_modules', $course->bridge_modules) }}">
                            @error('bridge_modules')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <h5 class="mb-3 mt-3">Eligibility Details</h5>

                        <div class="col-md-4">
                            <label class="form-label">Required Age <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('required_age') is-invalid @enderror"
                                name="required_age" value="{{ old('required_age', $course->required_age) }}">
                            @error('required_age')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Minimum Education <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('minimum_education') is-invalid @enderror"
                                name="minimum_education"
                                value="{{ old('minimum_education', $course->minimum_education) }}">
                            @error('minimum_education')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Industry Experience <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('industry_experience') is-invalid @enderror"
                                name="industry_experience"
                                value="{{ old('industry_experience', $course->industry_experience) }}">
                            @error('industry_experience')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Language Proficiency Requirement</label>
                            <input type="text" name="language_proficiency_requirement"
                                class="form-control @error('language_proficiency_requirement') is-invalid @enderror"
                                placeholder="e.g., IELTS 6.0, TOEFL 80, CEFR B2"
                                value="{{ old('language_proficiency_requirement', $course->language_proficiency_requirement) }}">
                            @error('language_proficiency_requirement')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Visa Process <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('visa_proccess') is-invalid @enderror" name="visa_proccess" rows="4"
                                id="visa_proccess">{{ old('visa_proccess', $course->visa_proccess) }}</textarea>
                            @error('visa_proccess')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Other Important Info <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('other_info') is-invalid @enderror" name="other_info" rows="4"
                                id="other_info">{{ old('other_info', $course->other_info) }}</textarea>
                            @error('other_info')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">QP Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('qp_code') is-invalid @enderror"
                                name="qp_code" value="{{ old('qp_code', $course->qp_code) }}">
                            @error('qp_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">NSQF-referenced (non-accredited) <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nsqf_level') is-invalid @enderror"
                                name="nsqf_level" value="{{ old('nsqf_level', $course->nsqf_level) }}">
                            @error('nsqf_level')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Credits Assigned <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('credits_assigned') is-invalid @enderror"
                                name="credits_assigned" value="{{ old('credits_assigned', $course->credits_assigned) }}">
                            @error('credits_assigned')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Program By <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('program_by') is-invalid @enderror"
                                name="program_by" value="{{ old('program_by', $course->program_by) }}">
                            @error('program_by')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Initiative of <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('initiative_of') is-invalid @enderror"
                                name="initiative_of" value="{{ old('initiative_of', $course->initiative_of) }}">
                            @error('initiative_of')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Program <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('program') is-invalid @enderror"
                                name="program" value="{{ old('program', $course->program) }}">
                            @error('program')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Occupations <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('occupations') is-invalid @enderror"
                                name="occupations" value="{{ old('occupations', $course->occupations) }}">
                            @error('occupations')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Topics (Title & Description) <span
                                    class="text-danger">*</span></label>
                            <div id="topics-wrapper">
                                @php
                                    $topics = old('topics', $course->topics ? json_decode($course->topics, true) : []);
                                    $topicIndex = 0;
                                @endphp
                                @if (count($topics) > 0)
                                    @foreach ($topics as $index => $topic)
                                        <div class="row g-2 topic-row mb-2">
                                            <div class="col-md-5">
                                                <input type="text" name="topics[{{ $index }}][title]"
                                                    class="form-control @error('topics.' . $index . '.title') is-invalid @enderror"
                                                    placeholder="Topic Title" value="{{ $topic['title'] ?? '' }}">
                                                @error('topics.' . $index . '.title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-5">
                                                <input type="text" name="topics[{{ $index }}][description]"
                                                    class="form-control @error('topics.' . $index . '.description') is-invalid @enderror"
                                                    placeholder="Topic Description"
                                                    value="{{ $topic['description'] ?? '' }}">
                                                @error('topics.' . $index . '.description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button"
                                                    class="btn btn-danger remove-topic w-100">Remove</button>
                                            </div>
                                        </div>
                                        @php $topicIndex++; @endphp
                                    @endforeach
                                @else
                                    <div class="row g-2 topic-row mb-2">
                                        <div class="col-md-5">
                                            <input type="text" name="topics[0][title]" class="form-control"
                                                placeholder="Topic Title">
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" name="topics[0][description]" class="form-control"
                                                placeholder="Topic Description">
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button"
                                                class="btn btn-danger remove-topic w-100">Remove</button>
                                        </div>
                                    </div>
                                    @php $topicIndex++; @endphp
                                @endif
                            </div>
                            <button type="button" id="add-topic" class="btn btn-primary mt-2">Add More Topic</button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body row g-3">
                        <h4 class="mb-3 mt-3">Other Details:</h4>
                        <h5 class="mb-3 mt-3">Logistics & Costs</h5>
                        <!-- Duration (Local) -->
                        <div class="col-md-6">
                            <label class="form-label">Duration (Local)</label>
                            <input type="text" class="form-control @error('duration_local') is-invalid @enderror"
                                name="duration_local" value="{{ old('duration_local', $course->duration_local) }}"
                                placeholder="e.g., 6 months ISICO module">
                            @error('duration_local')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Duration (Overseas) -->
                        <div class="col-md-6">
                            <label class="form-label">Duration (Overseas)</label>
                            <input type="text" class="form-control @error('duration_overseas') is-invalid @enderror"
                                name="duration_overseas"
                                value="{{ old('duration_overseas', $course->duration_overseas) }}"
                                placeholder="e.g., 1 year diploma in Singapore">
                            @error('duration_overseas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Total Pathway Duration -->
                        <div class="col-md-6">
                            <label class="form-label">Total Pathway Duration</label>
                            <input type="text" class="form-control @error('total_duration') is-invalid @enderror"
                                name="total_duration" value="{{ old('total_duration', $course->total_duration) }}"
                                placeholder="e.g., 1.5 years total">
                            @error('total_duration')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Fee Structure -->
                        <div class="col-md-6">
                            <label class="form-label">Fee Structure</label>
                            <input type="text" class="form-control @error('fee_structure') is-invalid @enderror"
                                name="fee_structure" value="{{ old('fee_structure', $course->fee_structure) }}"
                                placeholder="Enter fee structure details">
                            @error('fee_structure')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Scholarship / Funding -->
                        <div class="col-md-6">
                            <label class="form-label">Scholarship / Funding</label>
                            <input type="text" class="form-control @error('scholarship_funding') is-invalid @enderror"
                                name="scholarship_funding"
                                value="{{ old('scholarship_funding', $course->scholarship_funding) }}"
                                placeholder="Enter scholarship or funding details">
                            @error('scholarship_funding')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Accommodation / Living Cost Info -->
                        <div class="col-md-6">
                            <label class="form-label">Accommodation / Living Cost Info (Optional)</label>
                            <input type="text" class="form-control @error('accommodation_cost') is-invalid @enderror"
                                name="accommodation_cost"
                                value="{{ old('accommodation_cost', $course->accommodation_cost) }}"
                                placeholder="Enter accommodation and living cost info">
                            @error('accommodation_cost')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <h5 class="mb-3 mt-3">Pathway & Outcomes</h5>
                        <!-- Next Degree / Diploma Option -->
                        <div class="col-md-6">
                            <label class="form-label">Next Degree / Diploma Option</label>
                            <input type="text" class="form-control @error('next_degree') is-invalid @enderror"
                                name="next_degree" value="{{ old('next_degree', $course->next_degree) }}"
                                placeholder="e.g., BSc in Data Science, Singapore">
                            @error('next_degree')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Career Outcomes</label>
                            <div id="careerOutcomesContainer">
                                <!-- Career outcomes will be populated by jQuery -->
                            </div>

                            <button id="addOutcomeBtn" class="btn btn-primary btn-sm mb-3" type="button">
                                + Add Outcome
                            </button>

                            <input type="hidden" name="career_outcomes_json" id="careerOutcomesJsonInput"
                                value="{{ old('career_outcomes_json', $course->career_outcomes) }}">

                            <div class="mt-3">
                                <label>JSON Output (for demo):</label>
                                <pre id="jsonOutput"></pre>
                            </div>
                        </div>

                        <!-- International Recognition -->
                        <div class="col-md-6">
                            <label class="form-label">International Recognition</label>
                            <input type="text"
                                class="form-control @error('international_recognition') is-invalid @enderror"
                                name="international_recognition"
                                value="{{ old('international_recognition', $course->international_recognition) }}"
                                placeholder="e.g., Recognized in ASEAN countries">
                            @error('international_recognition')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Pathway Next Courses -->
                        <div class="col-md-12">
                            <label class="form-label">Pathway Next Courses (Links)</label>
                            <textarea class="form-control @error('pathway_next_courses') is-invalid @enderror" name="pathway_next_courses"
                                rows="2" placeholder="e.g., https://isico.edu/course1
        https://partner.edu/course2">{{ old('pathway_next_courses', $course->pathway_next_courses) }}</textarea>
                            @error('pathway_next_courses')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Dates -->
                        <div class="col-md-6">
                            <label class="form-label">Start Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                name="start_date"
                                value="{{ old('start_date', $course->start_date ? $course->start_date->format('Y-m-d') : '') }}">
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">End Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                name="end_date"
                                value="{{ old('end_date', $course->end_date ? $course->end_date->format('Y-m-d') : '') }}">
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Featured + Status -->
                        <div class="col-md-4">
                            <label class="form-label">Is Featured? <span class="text-danger">*</span></label>
                            <select name="is_featured" class="form-select @error('is_featured') is-invalid @enderror">
                                <option value="0"
                                    {{ old('is_featured', $course->is_featured) == 0 ? 'selected' : '' }}>No</option>
                                <option value="1"
                                    {{ old('is_featured', $course->is_featured) == 1 ? 'selected' : '' }}>Yes</option>
                            </select>
                            @error('is_featured')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror">
                                    <option value="">Select</option>
                                    <option value="1" {{ old('status', $course->status) == 1 ? 'selected' : '' }}>
                                        Active</option>
                                    <option value="0" {{ old('status', $course->status) == 0 ? 'selected' : '' }}>
                                        Inactive</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Enrollment Count <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('enrollment_count') is-invalid @enderror"
                                name="enrollment_count"
                                value="{{ old('enrollment_count', $course->enrollment_count) }}">
                            @error('enrollment_count')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card-footer text-end mt-3">
                    <button type="submit" class="btn btn-success">Update Course</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize career outcomes from existing data
            function initializeCareerOutcomes() {
                const careerOutcomesJson = $('#careerOutcomesJsonInput').val();
                let outcomes = [];

                if (careerOutcomesJson) {
                    try {
                        outcomes = JSON.parse(careerOutcomesJson);
                    } catch (e) {
                        console.error('Error parsing career outcomes JSON:', e);
                    }
                }

                // Clear existing inputs
                $('#careerOutcomesContainer').empty();

                // Add inputs for each outcome
                if (outcomes.length > 0) {
                    outcomes.forEach((outcome, index) => {
                        addCareerOutcomeInput(outcome);
                    });
                } else {
                    // Add one empty input if no outcomes exist
                    addCareerOutcomeInput('');
                }

                updateJsonOutput();
            }

            // Add a new career outcome input
            function addCareerOutcomeInput(value = '') {
                const index = $('#careerOutcomesContainer .outcome-input-group').length;
                const newOutcomeInput = `
            <div class="input-group mb-2 outcome-input-group">
                <input type="text" class="form-control career-outcome-input"
                       placeholder="e.g., Data Analyst" value="${value}">
                <button class="btn btn-outline-danger remove-outcome-btn" type="button">
                    Remove
                </button>
            </div>
        `;
                $('#careerOutcomesContainer').append(newOutcomeInput);
                updateRemoveButtons();
            }

            // Update remove buttons visibility
            function updateRemoveButtons() {
                const outcomeGroups = $('#careerOutcomesContainer .outcome-input-group');
                outcomeGroups.each(function(index) {
                    const removeBtn = $(this).find('.remove-outcome-btn');
                    if (outcomeGroups.length === 1) {
                        removeBtn.hide();
                    } else {
                        removeBtn.show();
                    }
                });
            }

            // Update JSON output and hidden input
            function updateJsonOutput() {
                const outcomes = [];
                $('.career-outcome-input').each(function() {
                    const value = $(this).val().trim();
                    if (value) {
                        outcomes.push(value);
                    }
                });

                const jsonString = JSON.stringify(outcomes, null, 2);
                $('#careerOutcomesJsonInput').val(jsonString);
                $('#jsonOutput').text(jsonString);
            }

            // Add outcome button click handler
            $('#addOutcomeBtn').on('click', function() {
                addCareerOutcomeInput();
                updateJsonOutput();
            });

            // Remove outcome button click handler (event delegation)
            $('#careerOutcomesContainer').on('click', '.remove-outcome-btn', function() {
                $(this).closest('.outcome-input-group').remove();
                updateRemoveButtons();
                updateJsonOutput();
            });

            // Input change handler for career outcomes
            $('#careerOutcomesContainer').on('input', '.career-outcome-input', function() {
                updateJsonOutput();
            });

            // Initialize date fields with proper format
            function initializeDateFields() {
                const startDate = $('input[name="start_date"]');
                const endDate = $('input[name="end_date"]');

                // If dates are empty, set default values or leave empty
                if (!startDate.val() && '{{ $course->start_date }}') {
                    startDate.val('{{ $course->start_date ? $course->start_date->format('Y-m-d') : '' }}');
                }

                if (!endDate.val() && '{{ $course->end_date }}') {
                    endDate.val('{{ $course->end_date ? $course->end_date->format('Y-m-d') : '' }}');
                }
            }

            // Initialize everything when document is ready
            initializeCareerOutcomes();
            initializeDateFields();
        });
    </script>
    <script>
        let topicIndex = {{ $topicIndex }};

        $('#add-topic').on('click', function() {
            $('#topics-wrapper').append(`
        <div class="row g-2 topic-row mb-2">
            <div class="col-md-5">
                <input type="text" name="topics[${topicIndex}][title]" class="form-control" placeholder="Topic Title">
            </div>
            <div class="col-md-5">
                <input type="text" name="topics[${topicIndex}][description]" class="form-control" placeholder="Topic Description">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-topic w-100">Remove</button>
            </div>
        </div>
    `);
            topicIndex++;
        });

        $(document).on('click', '.remove-topic', function() {
            $(this).closest('.topic-row').remove();
        });

        function toggleMaxCredits(select) {
            document.getElementById('maxCreditsField').style.display =
                select.value === 'Yes' ? 'block' : 'none';
        }

        // Initialize Summernote for textareas
        $(document).ready(function() {
            $('#long_description, #other_info, #visa_proccess').summernote({
                height: 200,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });
        });
    </script>
@endpush
