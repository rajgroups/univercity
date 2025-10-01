@extends('layouts.admin.app')

@section('content')
<div class="container mt-4">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Create Course</h4>
                <h6>Create new Course</h6>
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
    <div class=" shadow rounded-3 p-3">
        {{-- <div class="card-header text-white">
            <h4 class="mb-0">Create New Course</h4>
        </div> --}}
        <form action="{{ route('admin.intlcourse.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="card">
                <div class="card-body row g-3">
                    <h4 class="mb-3">Provider & Affiliation Details</h4>
                    <!-- Name & Short Name -->
                    <div class="col-md-6">
                        <label for="admissionprovider " class="form-label">Admission Provider  </label>
                        <input type="text" class="form-control @error('') is-invalid @enderror" name="" value="{{ old('') }}" required>
                        @error('admissionprovider')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Overseas Institution / Partner   <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('') is-invalid @enderror" name="" placeholder="Overseas Institution / Partner " value="{{ old('') }}">
                        @error('')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Accreditation / Recognition   </label>
                        <input type="text" class="form-control @error('') is-invalid @enderror" name="" placeholder="ISICO-recognized, Partner-recognized, International Board, Other " value="{{ old('') }}">
                        @error('')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-body row g-3">

                <div class="card">
                    <div class="card-body row g-3">
                        <h4 class="mb-3">Course Details</h4>
                          <!-- Name & Short Name -->
                        <div class="col-md-6">
                            <label for="name" class="form-label">Course Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="short_name" class="form-label">Level <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('short_name') is-invalid @enderror" name="short_name" value="{{ old('short_name') }}">
                            @error('short_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Image Upload -->
                        <div class="col-md-6">
                            <label class="form-label">Image <span class="text-danger">*</span></label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" required>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>



                        <!-- Sector -->
                        <div class="col-md-6">
                            <label class="form-label">Domain / Sector <span class="text-danger">*</span></label>
                            <select name="sector_id" class="form-select @error('sector_id') is-invalid @enderror">
                                <option value="">Select Sector</option>
                                @foreach($sectors as $sector)
                                    <option value="{{ $sector->id }}" {{ old('sector_id') == $sector->id ? 'selected' : '' }}>
                                        {{ $sector->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('sector_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="col-md-6">
                            <label class="form-label">Category <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Pathway Type -->
                        <div class="col-md-6">
                            <label class="form-label">Pathway Type <span class="text-danger">*</span></label>
                            <select name="pathway_type" class="form-select @error('pathway_type') is-invalid @enderror">
                                <option value="">Select Pathway Type</option>
                                <option value="Online Pathway" {{ old('') == 'Online Pathway' ? 'selected' : '' }}>Online Pathway</option>
                                <option value="Onsite Abroad" {{ old('') == 'Onsite Abroad' ? 'selected' : '' }}>Onsite Abroad</option>
                                <option value="Hybrid" {{ old('') == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                                <option value="Dual-credit" {{ old('') == 'Dual-credit' ? 'selected' : '' }}>Dual-credit</option>
                                <option value="Twinning Program" {{ old('') == 'Twinning Program' ? 'selected' : '' }}>Twinning Program</option>
                            </select>
                            @error('pathway_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Destination Country -->
                        <div class="col-md-6">
                            <label class="form-label">Destination Country <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('destination_country') is-invalid @enderror"
                                name="destination_country" value="{{ old('destination_country') }}">
                            @error('destination_country')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Country -->
                        <div class="col-md-6">
                            <label class="form-label">Country <span class="text-danger">*</span></label>
                            <select name="country_id" class="form-select @error('country_id') is-invalid @enderror">
                                <option value="">Select Country</option>
                                @foreach($countrys as $country)
                                    <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Language of Instruction  <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('language') is-invalid @enderror" name="language" value="">
                            @error('language')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- <div class="col-md-6">
                            <label class="form-label">Language</label>
                            <input type="text" class="form-control @error('language') is-invalid @enderror" name="language" value="{{ old('language', 'English') }}">
                            @error('language')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> --}}
                         <!-- Learning Product, Program, Domain -->
                        <div class="col-md-6">
                            <label class="form-label">Learning Product Type </label>
                            <input type="text" class="form-control @error('learning_product_type') is-invalid @enderror" name="learning_product_type" value="{{ old('learning_product_type') }}">
                            @error('learning_product_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Paid Type <span class="text-danger">*</span></label>
                            <select name="paid_type" class="form-select @error('paid_type') is-invalid @enderror">
                                <option value="Free" {{ old('paid_type', 'Free') == 'Free' ? 'selected' : '' }}>Free</option>
                                <option value="Paid" {{ old('paid_type') == 'Paid' ? 'selected' : '' }}>Paid</option>
                            </select>
                            @error('paid_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Descriptions -->
                        <div class="col-md-12">
                            <label class="form-label">Short Description <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('short_description') is-invalid @enderror" name="short_description" rows="2">{{ old('short_description') }}</textarea>
                            @error('short_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- Long Description --}}
                        <div class="col-md-12">
                            <label class="form-label">Long Description <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('long_description') is-invalid @enderror" name="long_description" rows="4" id="long_description">{{ old('long_description') }}</textarea>
                            @error('long_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="card-body row g-3">
                        <h4 class="mb-3">Additional Course Details </h4>
                        <!-- Certification & Assessment -->
                        <div class="col-md-6">
                            <label class="form-label">Certification Type</label>
                            <input type="text" class="form-control @error('certification_type') is-invalid @enderror" name="certification_type" value="{{ old('certification_type') }}">
                            @error('certification_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- ISICO Course Code -->
                        <div class="col-md-6">
                            <label class="form-label">ISICO Course Code <span class="text-danger">*</span></label>
                            <input type="text" name="isico_course_code" class="form-control" placeholder="e.g., SG001" required>
                        </div>

                        <!-- International Mapping -->
                        <div class="col-md-6">
                            <label class="form-label">International Mapping</label>
                            <input type="text" name="international_mapping" class="form-control" placeholder="e.g., aligned to UK Level 5, Singapore Diploma, Japan Senmon-Gakko level, etc.">
                        </div>
                          {{-- <!-- Internshipe -->
                        <div class="col-md-4">
                            <label class="form-label">Internship? <span class="text-danger">*</span></label>
                            <select name="internship" class="form-select @error('internship') is-invalid @enderror">
                                <option value="0" {{ old('internship', 0) == 0 ? 'selected' : '' }}>No</option>
                                <option value="1" {{ old('internship') == 1 ? 'selected' : '' }}>Yes</option>
                            </select>
                            @error('internship')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> --}}
                        <!-- Credits Transferable -->
                        <div class="col-md-6">
                            <label class="form-label">Credits Transferable</label>
                            <select name="credits_transferable" class="form-select" onchange="toggleMaxCredits(this)">
                                <option value="">Select Option</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>

                        <!-- Max Credits Transferrable (hidden unless Yes is selected) -->
                        <div class="col-md-6" id="maxCreditsField" style="display:none;">
                            <label class="form-label">Max Credits Transferrable</label>
                            <input type="number" name="max_credits" class="form-control" placeholder="Enter max credits">
                        </div>

                        <!-- Internship -->
                        <div class="col-md-6">
                            <label class="form-label">Internship</label>
                            <input type="text" name="internship" class="form-control" placeholder="Enter internship details">
                        </div>

                        <h5 class="mb-3 mt-3" >Delivery & Assessment</h5>
                          <!-- Provider and Language -->
                        <div class="col-md-6">
                            <label class="form-label">Mode of Training  <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('provider') is-invalid @enderror" name="provider" value="{{ old('provider') }}">
                            @error('provider')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Assessment Mode <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('assessment_mode') is-invalid @enderror" name="assessment_mode" value="{{ old('assessment_mode') }}">
                            @error('assessment_mode')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Tools & Topics -->
                        <div class="col-md-12">
                            <label class="form-label">Learning Tools <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('learning_tools') is-invalid @enderror" name="learning_tools" value="{{ old('learning_tools') }}">
                            @error('learning_tools')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Bridge Modules -->
                        <div class="col-md-6">
                            <label class="form-label">Bridge Modules</label>
                            <input type="text" name="bridge_modules" class="form-control" placeholder="Enter bridge modules">
                        </div>

                        <h5 class="mb-3 mt-3">Eligibility Details</h5>
                        <!-- Age, Education, Experience -->
                        <div class="col-md-4">
                            <label class="form-label">Required Age <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('required_age') is-invalid @enderror" name="required_age" value="{{ old('required_age') }}">
                            @error('required_age')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Minimum Education <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('minimum_education') is-invalid @enderror" name="minimum_education" value="{{ old('minimum_education') }}">
                            @error('minimum_education')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Industry Experience <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('industry_experience') is-invalid @enderror" name="industry_experience" value="{{ old('industry_experience') }}">
                            @error('industry_experience')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Language Proficiency Requirement -->
                        <div class="col-md-6">
                            <label class="form-label">Language Proficiency Requirement</label>
                            <input type="text" name="language_proficiency_requirement" class="form-control" placeholder="e.g., IELTS 6.0, TOEFL 80, CEFR B2">
                        </div>
                        {{-- visa_proccess --}}
                        <div class="col-md-12">
                            <label class="form-label">Visa Process <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('visa_proccess') is-invalid @enderror" name="visa_proccess" rows="4" id="visa_proccess">{{ old('visa_proccess') }}</textarea>
                            @error('visa_proccess')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- other_importent --}}
                        <div class="col-md-12">
                            <label class="form-label">Other Importent Info <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('other_info') is-invalid @enderror" name="other_info" rows="4" id="other_info">{{ old('other_info') }}</textarea>
                            @error('other_info')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <!-- QP & NSQF & Credit -->
                        <div class="col-md-4">
                            <label class="form-label">QP Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('qp_code') is-invalid @enderror" name="qp_code" value="{{ old('qp_code') }}">
                            @error('qp_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">NSQF Level <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nsqf_level') is-invalid @enderror" name="nsqf_level" value="{{ old('nsqf_level') }}">
                            @error('nsqf_level')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Credits Assigned <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('credits_assigned') is-invalid @enderror" name="credits_assigned" value="{{ old('credits_assigned') }}">
                            @error('credits_assigned')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-md-4">
                            <label class="form-label">Program By <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('program_by') is-invalid @enderror" name="program_by" value="{{ old('program_by') }}">
                            @error('program_by')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Initiative of  <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('initiative_of') is-invalid @enderror" name="initiative_of" value="{{ old('initiative_of') }}">
                            @error('initiative_of')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Program <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('program') is-invalid @enderror" name="program" value="{{ old('program') }}">
                            @error('program')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Domain <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('domain') is-invalid @enderror" name="domain" value="{{ old('domain') }}">
                            @error('domain')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Occupations <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('occupations') is-invalid @enderror" name="occupations" value="{{ old('occupations') }}">
                            @error('occupations')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>






                        <div class="col-md-12">
                            <label class="form-label">Topics (Title & Description) <span class="text-danger">*</span></label>
                            <div id="topics-wrapper">
                                @if(old('topics'))
                                    @foreach(old('topics') as $index => $topic)
                                        <div class="row g-2 topic-row mb-2">
                                            <div class="col-md-5">
                                                <input type="text" name="topics[{{ $index }}][title]" class="form-control @error('topics.'.$index.'.title') is-invalid @enderror" placeholder="Topic Title" value="{{ $topic['title'] ?? '' }}">
                                                @error('topics.'.$index.'.title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-5">
                                                <input type="text" name="topics[{{ $index }}][description]" class="form-control @error('topics.'.$index.'.description') is-invalid @enderror" placeholder="Topic Description" value="{{ $topic['description'] ?? '' }}">
                                                @error('topics.'.$index.'.description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-danger remove-topic w-100">Remove</button>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="row g-2 topic-row mb-2">
                                        <div class="col-md-5">
                                            <input type="text" name="topics[0][title]" class="form-control" placeholder="Topic Title">
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" name="topics[0][description]" class="form-control" placeholder="Topic Description">
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-danger remove-topic w-100">Remove</button>
                                        </div>
                                    </div>
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
                        <!-- Duration & Paid Type -->
                        {{-- <div class="col-md-6">
                            <label class="form-label">Duration <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('duration') is-invalid @enderror" name="duration" value="{{ old('duration') }}">
                            @error('duration')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> --}}
                        <!-- Duration (Local) -->
                        <div class="col-md-6">
                            <label class="form-label">Duration (Local) </label>
                            <input type="text" class="form-control @error('duration_local') is-invalid @enderror"
                                name="duration_local" value="{{ old('duration_local') }}"
                                placeholder="e.g., 6 months ISICO module">
                            @error('duration_local')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Duration (Overseas) -->
                        <div class="col-md-6">
                            <label class="form-label">Duration (Overseas)</label>
                            <input type="text" class="form-control @error('duration_overseas') is-invalid @enderror"
                                name="duration_overseas" value="{{ old('duration_overseas') }}"
                                placeholder="e.g., 1 year diploma in Singapore">
                            @error('duration_overseas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Total Pathway Duration -->
                        <div class="col-md-6">
                            <label class="form-label">Total Pathway Duration</label>
                            <input type="text" class="form-control @error('total_duration') is-invalid @enderror"
                                name="total_duration" value="{{ old('total_duration') }}"
                                placeholder="e.g., 1.5 years total">
                            @error('total_duration')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Fee Structure -->
                        <div class="col-md-6">
                            <label class="form-label">Fee Structure</label>
                            <input type="text" class="form-control @error('fee_structure') is-invalid @enderror"
                                name="fee_structure" value="{{ old('fee_structure') }}"
                                placeholder="Enter fee structure details">
                            @error('fee_structure')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Scholarship / Funding -->
                        <div class="col-md-6">
                            <label class="form-label">Scholarship / Funding</label>
                            <input type="text" class="form-control @error('scholarship_funding') is-invalid @enderror"
                                name="scholarship_funding" value="{{ old('scholarship_funding') }}"
                                placeholder="Enter scholarship or funding details">
                            @error('scholarship_funding')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Accommodation / Living Cost Info -->
                        <div class="col-md-6">
                            <label class="form-label">Accommodation / Living Cost Info (Optional)</label>
                            <input type="text" class="form-control @error('accommodation_cost') is-invalid @enderror"
                                name="accommodation_cost" value="{{ old('accommodation_cost') }}"
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
                                name="next_degree" value="{{ old('next_degree') }}"
                                placeholder="e.g., BSc in Data Science, Singapore">
                            @error('next_degree')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Career Outcomes -->
                        <div class="col-md-12">
                            <label class="form-label">Career Outcomes</label>
                            <textarea class="form-control @error('career_outcomes') is-invalid @enderror"
                                    name="career_outcomes" rows="3"
                                    placeholder="e.g.,
                        - Data Analyst
                        - Business Intelligence Specialist
                        - Machine Learning Engineer"></textarea>
                            @error('career_outcomes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- International Recognition -->
                        <div class="col-md-6">
                            <label class="form-label">International Recognition</label>
                            <input type="text" class="form-control @error('international_recognition') is-invalid @enderror"
                                name="international_recognition" value="{{ old('international_recognition') }}"
                                placeholder="e.g., Recognized in ASEAN countries">
                            @error('international_recognition')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Pathway Next Courses -->
                        <div class="col-md-12">
                            <label class="form-label">Pathway Next Courses (Links)</label>
                            <textarea class="form-control @error('pathway_next_courses') is-invalid @enderror"
                                    name="pathway_next_courses" rows="2"
                                    placeholder="e.g., https://isico.edu/course1
                        https://partner.edu/course2"></textarea>
                            @error('pathway_next_courses')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
<!-- Dates -->
                <div class="col-md-6">
                    <label class="form-label">Start Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{ old('start_date') }}">
                    @error('start_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">End Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{ old('end_date') }}">
                    @error('end_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Featured + Status -->
                <div class="col-md-4">
                    <label class="form-label">Is Featured? <span class="text-danger">*</span></label>
                    <select name="is_featured" class="form-select @error('is_featured') is-invalid @enderror">
                        <option value="0" {{ old('is_featured', 0) == 0 ? 'selected' : '' }}>No</option>
                        <option value="1" {{ old('is_featured') == 1 ? 'selected' : '' }}>Yes</option>
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
                            <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Enrollment Count <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('enrollment_count') is-invalid @enderror" name="enrollment_count" value="{{ old('enrollment_count', 0) }}">
                    @error('enrollment_count')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                    </div>
                </div>
            </div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-success">Create Course</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
let topicIndex = {{ old('topics') ? count(old('topics')) : 1 }};

$('#add-topic').on('click', function () {
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

$(document).on('click', '.remove-topic', function () {
    $(this).closest('.topic-row').remove();
});
</script>
    <script>
$(document).ready(function() {
  $('#long_description, #other_info, #visa_proccess, #terms_conditions, #extra_notes').summernote({
    height: 200,
    toolbar: [
      ['style', ['bold', 'italic', 'underline', 'clear']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['insert', ['link', 'picture']],
      ['view', ['fullscreen', 'codeview']]
    ],
    placeholder: 'Write your project description here (max 60 words)...'
  });
});
    </script>

<script>
    function toggleMaxCredits(select) {
        document.getElementById('maxCreditsField').style.display =
            select.value === 'Yes' ? 'block' : 'none';
    }
</script>
@endpush
