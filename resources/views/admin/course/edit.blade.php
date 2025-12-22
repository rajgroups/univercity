{{-- @dd($course->duration_unit); --}}
@extends('layouts.admin.app')

@section('content')
<div class="container mt-4">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Edit Course</h4>
                <h6>Edit existing Course</h6>
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
            <a href="{{ route('admin.course.index') }}" class="btn btn-secondary">
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

    <div class="card shadow rounded-3">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Course: {{ $course->name }}</h4>
        </div>

        <form action="{{ route('admin.course.update', $course->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card-body">
                <!-- Basic Information Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h5 class="border-bottom pb-2 mb-3 text-primary">
                            <i class="feather feather-info me-2"></i>Basic Information
                        </h5>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Course Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                               value="{{ old('name', $course->name) }}" required placeholder="Enter course name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="level" class="form-label">Level<span class="text-danger">*</span></label>
                        <select name="level" class="form-select @error('level') is-invalid @enderror" required>
                            <option value="">Select Level</option>
                            <option value="Awareness" {{ old('level', $course->level) == 'Awareness' ? 'selected' : '' }}>Awareness</option>
                            <option value="Foundation" {{ old('level', $course->level) == 'Foundation' ? 'selected' : '' }}>Foundation</option>
                            <option value="Intermediate" {{ old('level', $course->level) == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                            <option value="Advanced" {{ old('level', $course->level) == 'Advanced' ? 'selected' : '' }}>Advanced</option>
                            <option value="Professional" {{ old('level', $course->level) == 'Professional' ? 'selected' : '' }}>Professional</option>
                        </select>
                        @error('level')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" accept="image/*">
                        <div class="form-text">Recommended size: 500x300px, Max: 2MB</div>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if($course->image)
                            <div class="mt-2">
                                <img src="{{ asset($course->image) }}" alt="Course Image" style="max-height: 100px;" class="rounded">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" name="remove_image" id="remove_image" value="1">
                                    <label class="form-check-label text-danger" for="remove_image">Remove current image</label>
                                </div>
                            </div>
                        @endif
                    </div>

<div class="col-md-6 mb-3">
    <label class="form-label">Gallery Images</label>
    <input type="file" class="form-control @error('gallery') is-invalid @enderror" name="gallery[]" multiple accept="image/*">
    <div class="form-text">Select multiple images for course gallery</div>
    @error('gallery')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @if($course->gallery && count($course->gallery) > 0)
        <div class="mt-2">
            @foreach($course->gallery as $galleryImage)
                <img src="{{ asset($galleryImage) }}" alt="Gallery Image" style="max-height: 60px; margin-right: 5px;" class="rounded">
            @endforeach
            <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" name="remove_gallery" id="remove_gallery" value="1">
                <label class="form-check-label text-danger" for="remove_gallery">Remove all gallery images</label>
            </div>
        </div>
    @endif
</div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Duration Number</label>
                        <input type="number" class="form-control @error('duration_number') is-invalid @enderror"
                               name="duration_number" value="{{ old('duration_number', $course->duration_number) }}"
                               placeholder="e.g., 6" min="1">
                        @error('duration_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Duration Unit</label>
                        <select name="duration_unit" class="form-select @error('duration_unit') is-invalid @enderror">
                            <option value="">Select Unit</option>
                            <option value="days" {{ old('duration_unit', $course->duration_unit) == 'days' ? 'selected' : '' }}>Days</option>
                            <option value="weeks" {{ old('duration_unit', $course->duration_unit) == 'weeks' ? 'selected' : '' }}>Weeks</option>
                            <option value="months" {{ old('duration_unit', $course->duration_unit) == 'months' ? 'selected' : '' }}>Months</option>
                            <option value="years" {{ old('duration_unit', $course->duration_unit) == 'years' ? 'selected' : '' }}>Years</option>
                        </select>
                        @error('duration_unit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sector <span class="text-danger">*</span></label>
                        <select name="sector_id" class="form-select select2 @error('sector_id') is-invalid @enderror" required>
                            <option value="">Select Sector</option>
                            @foreach($sectors as $sector)
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

               <div class="col-md-6 mb-3">
    <label class="form-label">Paid Type <span class="text-danger">*</span></label>
    <select name="paid_type" class="form-select @error('paid_type') is-invalid @enderror" required>
        <option value="">Select Paid Type</option>
        <option value="free" {{ old('paid_type', $course->paid_type->value) == 'free' ? 'selected' : '' }}>Free</option>
        <option value="paid" {{ old('paid_type', $course->paid_type->value) == 'paid' ? 'selected' : '' }}>Paid</option>
        <option value="na" {{ old('paid_type', $course->paid_type->value) == 'na' ? 'selected' : '' }}>Not Applicable</option>
    </select>
    @error('paid_type')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

                <div class="col-md-6 mb-3">
    <label class="form-label">Language <span class="text-danger">*</span></label>
    <select name="language[]" class="form-select select2-multiple @error('language') is-invalid @enderror" multiple="multiple" required>
        @php
            // Remove json_decode since $course->language is already an array due to model casting
            $currentLanguages = old('language', $course->language ?: ['English']);
        @endphp
        <option value="English" {{ in_array('English', $currentLanguages) ? 'selected' : '' }}>English</option>
        <option value="Hindi" {{ in_array('Hindi', $currentLanguages) ? 'selected' : '' }}>Hindi</option>
        <option value="Marathi" {{ in_array('Marathi', $currentLanguages) ? 'selected' : '' }}>Marathi</option>
        <option value="Bengali" {{ in_array('Bengali', $currentLanguages) ? 'selected' : '' }}>Bengali</option>
        <option value="Tamil" {{ in_array('Tamil', $currentLanguages) ? 'selected' : '' }}>Tamil</option>
        <option value="Telugu" {{ in_array('Telugu', $currentLanguages) ? 'selected' : '' }}>Telugu</option>
        <option value="Kannada" {{ in_array('Kannada', $currentLanguages) ? 'selected' : '' }}>Kannada</option>
        <option value="Malayalam" {{ in_array('Malayalam', $currentLanguages) ? 'selected' : '' }}>Malayalam</option>
    </select>
    @error('language')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

                    <div class="col-12 mb-3">
                        <label class="form-label">Short Description</label>
                        <textarea class="form-control @error('short_description') is-invalid @enderror"
                                  name="short_description" rows="3" placeholder="Brief description of the course">{{ old('short_description', $course->short_description) }}</textarea>
                        @error('short_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">Long Description</label>
                        <textarea class="form-control @error('long_description') is-invalid @enderror"
                                  name="long_description" rows="4" id="long_description" placeholder="Detailed description of the course">{{ old('long_description', $course->long_description) }}</textarea>
                        @error('long_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Course Details Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h5 class="border-bottom pb-2 mb-3 text-primary">
                            <i class="feather feather-book me-2"></i>Course Details
                        </h5>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Training Provider</label>
                        <input type="text" class="form-control @error('provider') is-invalid @enderror"
                               name="provider" value="{{ old('provider', $course->provider) }}" placeholder="Enter training provider name">
                        @error('provider')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Certification Type</label>
                        <input type="text" class="form-control @error('certification_type') is-invalid @enderror"
                               name="certification_type" value="{{ old('certification_type', $course->certification_type) }}" placeholder="e.g., Certificate of Completion">
                        @error('certification_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Assessment Mode</label>
                        <input type="text" class="form-control @error('assessment_mode') is-invalid @enderror"
                               name="assessment_mode" value="{{ old('assessment_mode', $course->assessment_mode) }}" placeholder="e.g., Online Proctored Exam">
                        @error('assessment_mode')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Course Code</label>
                        <input type="text" class="form-control @error('course_code') is-invalid @enderror"
                               name="course_code" value="{{ old('course_code', $course->course_code) }}" placeholder="Enter course code">
                        @error('course_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">NSQF Level</label>
                        <input type="text" class="form-control @error('nsqf_level') is-invalid @enderror"
                               name="nsqf_level" value="{{ old('nsqf_level', $course->nsqf_level) }}" placeholder="e.g., Level 4, Level 5">
                        @error('nsqf_level')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

<div class="col-md-6 mb-3">
    <label class="form-label">Locations</label>
    <select name="location[]" class="form-select select2-multiple @error('location') is-invalid @enderror" multiple="multiple">
        @php
            $currentLocations = old('location', $course->location ?: []);
        @endphp
        <option value="Mumbai" {{ in_array('Mumbai', $currentLocations) ? 'selected' : '' }}>Mumbai</option>
        <option value="Delhi" {{ in_array('Delhi', $currentLocations) ? 'selected' : '' }}>Delhi</option>
        <option value="Bangalore" {{ in_array('Bangalore', $currentLocations) ? 'selected' : '' }}>Bangalore</option>
        <option value="Hyderabad" {{ in_array('Hyderabad', $currentLocations) ? 'selected' : '' }}>Hyderabad</option>
        <option value="Chennai" {{ in_array('Chennai', $currentLocations) ? 'selected' : '' }}>Chennai</option>
        <option value="Kolkata" {{ in_array('Kolkata', $currentLocations) ? 'selected' : '' }}>Kolkata</option>
        <option value="Pune" {{ in_array('Pune', $currentLocations) ? 'selected' : '' }}>Pune</option>
        <option value="Online" {{ in_array('Online', $currentLocations) ? 'selected' : '' }}>Online</option>
    </select>
    @error('location')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Mode of Study <span class="text-danger">*</span></label>
                        <select name="mode_of_study" class="form-select @error('mode_of_study') is-invalid @enderror" required>
                            <option value="">Select Mode</option>
                            <option value="1" {{ old('mode_of_study', $course->mode_of_study->value) == 1 ? 'selected' : '' }}>Online</option>
                            <option value="2" {{ old('mode_of_study', $course->mode_of_study->value) == 2 ? 'selected' : '' }}>In-Centre</option>
                            <option value="3" {{ old('mode_of_study', $course->mode_of_study->value) == 3 ? 'selected' : '' }}>Hybrid</option>
                            <option value="4" {{ old('mode_of_study', $course->mode_of_study->value) == 4 ? 'selected' : '' }}>On-Demand</option>
                        </select>
                        @error('mode_of_study')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

<div class="col-md-6 mb-3">
    <label class="form-label">Occupations</label>
    <select name="occupations[]" class="form-select select2-multiple @error('occupations') is-invalid @enderror" multiple="multiple">
        @php
            $currentOccupations = old('occupations', $course->occupations ?: []);
        @endphp
        <option value="Software Developer" {{ in_array('Software Developer', $currentOccupations) ? 'selected' : '' }}>Software Developer</option>
        <option value="Data Analyst" {{ in_array('Data Analyst', $currentOccupations) ? 'selected' : '' }}>Data Analyst</option>
        <option value="Web Designer" {{ in_array('Web Designer', $currentOccupations) ? 'selected' : '' }}>Web Designer</option>
        <option value="Digital Marketer" {{ in_array('Digital Marketer', $currentOccupations) ? 'selected' : '' }}>Digital Marketer</option>
        <option value="Project Manager" {{ in_array('Project Manager', $currentOccupations) ? 'selected' : '' }}>Project Manager</option>
    </select>
    @error('occupations')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
                </div>

                <!-- Program Information Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h5 class="border-bottom pb-2 mb-3 text-primary">
                            <i class="feather feather-briefcase me-2"></i>Program Information
                        </h5>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Program By</label>
                        <input type="text" class="form-control @error('program_by') is-invalid @enderror"
                               name="program_by" value="{{ old('program_by', $course->program_by) }}" placeholder="e.g., Skill India CSR">
                        @error('program_by')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Initiative Of</label>
                        <input type="text" class="form-control @error('initiative_of') is-invalid @enderror"
                               name="initiative_of" value="{{ old('initiative_of', $course->initiative_of) }}" placeholder="e.g., Reliance Foundation">
                        @error('initiative_of')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Domain</label>
                        <input type="text" class="form-control @error('domain') is-invalid @enderror"
                               name="domain" value="{{ old('domain', $course->domain) }}" placeholder="e.g., Information Technology">
                        @error('domain')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Internship Available</label>
                        <select name="internship" class="form-select @error('internship') is-invalid @enderror">
                            <option value="0" {{ old('internship', $course->internship) == 0 ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('internship', $course->internship) == 1 ? 'selected' : '' }}>Yes</option>
                        </select>
                        @error('internship')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Requirements Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h5 class="border-bottom pb-2 mb-3 text-primary">
                            <i class="feather feather-user-check me-2"></i>Requirements
                        </h5>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Required Age</label>
                        <input type="text" class="form-control @error('required_age') is-invalid @enderror"
                               name="required_age" value="{{ old('required_age', $course->required_age) }}" placeholder="e.g., 18+, 21-30">
                        @error('required_age')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

<div class="col-md-6 mb-3">
    <label class="form-label">Minimum Education</label>
    <select name="minimum_education[]" class="form-select select2-multiple @error('minimum_education') is-invalid @enderror" multiple="multiple">
        @php
            $currentEducation = old('minimum_education', $course->minimum_education ?: []);
        @endphp
        <option value="10th Pass" {{ in_array('10th Pass', $currentEducation) ? 'selected' : '' }}>10th Pass</option>
        <option value="12th Pass" {{ in_array('12th Pass', $currentEducation) ? 'selected' : '' }}>12th Pass</option>
        <option value="Diploma" {{ in_array('Diploma', $currentEducation) ? 'selected' : '' }}>Diploma</option>
        <option value="Graduate" {{ in_array('Graduate', $currentEducation) ? 'selected' : '' }}>Graduate</option>
        <option value="Post Graduate" {{ in_array('Post Graduate', $currentEducation) ? 'selected' : '' }}>Post Graduate</option>
        <option value="ITI" {{ in_array('ITI', $currentEducation) ? 'selected' : '' }}>ITI</option>
    </select>
    @error('minimum_education')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Industry Experience (Years)</label>
                        <input type="number" class="form-control @error('industry_experience_years') is-invalid @enderror"
                               name="industry_experience_years" value="{{ old('industry_experience_years', $course->industry_experience_years) }}" min="0" max="50">
                        @error('industry_experience_years')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Industry Experience Description</label>
                        <input type="text" class="form-control @error('industry_experience_desc') is-invalid @enderror"
                               name="industry_experience_desc" value="{{ old('industry_experience_desc', $course->industry_experience_desc) }}" placeholder="Describe experience requirements">
                        @error('industry_experience_desc')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

<div class="col-12 mb-3">
    <label class="form-label">Learning Tools</label>
    <select name="learning_tools[]" class="form-select select2-multiple @error('learning_tools') is-invalid @enderror" multiple="multiple">
        @php
            $currentTools = old('learning_tools', $course->learning_tools ?: []);
        @endphp
        <option value="VS Code" {{ in_array('VS Code', $currentTools) ? 'selected' : '' }}>VS Code</option>
        <option value="Python" {{ in_array('Python', $currentTools) ? 'selected' : '' }}>Python</option>
        <option value="JavaScript" {{ in_array('JavaScript', $currentTools) ? 'selected' : '' }}>JavaScript</option>
        <option value="React" {{ in_array('React', $currentTools) ? 'selected' : '' }}>React</option>
        <option value="Node.js" {{ in_array('Node.js', $currentTools) ? 'selected' : '' }}>Node.js</option>
        <option value="MySQL" {{ in_array('MySQL', $currentTools) ? 'selected' : '' }}>MySQL</option>
        <option value="MongoDB" {{ in_array('MongoDB', $currentTools) ? 'selected' : '' }}>MongoDB</option>
        <option value="Docker" {{ in_array('Docker', $currentTools) ? 'selected' : '' }}>Docker</option>
    </select>
    @error('learning_tools')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
                </div>

                <!-- Course Content Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h5 class="border-bottom pb-2 mb-3 text-primary">
                            <i class="feather feather-book-open me-2"></i>Course Content
                        </h5>
                    </div>

 <div class="col-12 mb-3">
    <label class="form-label">Topics (Title & Description)</label>
    <div id="topics-wrapper">
        @php
            // Remove json_decode since $course->topics is already an array
            $topics = old('topics', $course->topics ?: [['title' => '', 'description' => '']]);
        @endphp

        @foreach($topics as $index => $topic)
            <div class="row g-2 topic-row mb-2">
                <div class="col-md-5">
                    <input type="text" name="topics[{{ $index }}][title]"
                           class="form-control @error('topics.'.$index.'.title') is-invalid @enderror"
                           placeholder="Topic Title" value="{{ $topic['title'] ?? '' }}">
                    @error('topics.'.$index.'.title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-5">
                    <input type="text" name="topics[{{ $index }}][description]"
                           class="form-control @error('topics.'.$index.'.description') is-invalid @enderror"
                           placeholder="Topic Description" value="{{ $topic['description'] ?? '' }}">
                    @error('topics.'.$index.'.description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger remove-topic w-100">
                        <i class="feather feather-trash-2 me-1"></i>Remove
                    </button>
                </div>
            </div>
        @endforeach
    </div>
    <button type="button" id="add-topic" class="btn btn-primary mt-2">
        <i class="feather feather-plus me-1"></i>Add More Topic
    </button>
</div>

<div class="col-12 mb-3">
    <label class="form-label">Other Specifications</label>
    <div id="specifications-wrapper">
        @php
            // Remove json_decode since $course->other_specifications is already an array
            $specifications = old('other_specifications', $course->other_specifications ?: [['label' => '', 'description' => '']]);
        @endphp

        @foreach($specifications as $index => $spec)
            <div class="row g-2 specification-row mb-2">
                <div class="col-md-5">
                    <input type="text" name="other_specifications[{{ $index }}][label]"
                           class="form-control @error('other_specifications.'.$index.'.label') is-invalid @enderror"
                           placeholder="Specification Label" value="{{ $spec['label'] ?? '' }}">
                    @error('other_specifications.'.$index.'.label')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-5">
                    <input type="text" name="other_specifications[{{ $index }}][description]"
                           class="form-control @error('other_specifications.'.$index.'.description') is-invalid @enderror"
                           placeholder="Specification Description" value="{{ $spec['description'] ?? '' }}">
                    @error('other_specifications.'.$index.'.description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger remove-specification w-100">
                        <i class="feather feather-trash-2 me-1"></i>Remove
                    </button>
                </div>
            </div>
        @endforeach
    </div>
    <button type="button" id="add-specification" class="btn btn-primary mt-2">
        <i class="feather feather-plus me-1"></i>Add More Specification
    </button>
</div>
                </div>

                <!-- Additional Information Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h5 class="border-bottom pb-2 mb-3 text-primary">
                            <i class="feather feather-calendar me-2"></i>Additional Information
                        </h5>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Start Date</label>
                        <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                               name="start_date" value="{{ old('start_date', $course->start_date ? $course->start_date->format('Y-m-d') : '') }}">
                        @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">End Date</label>
                        <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                               name="end_date" value="{{ old('end_date', $course->end_date ? $course->end_date->format('Y-m-d') : '') }}">
                        @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Is Featured?</label>
                        <select name="is_featured" class="form-select @error('is_featured') is-invalid @enderror">
                            <option value="0" {{ old('is_featured', $course->is_featured) == 0 ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('is_featured', $course->is_featured) == 1 ? 'selected' : '' }}>Yes</option>
                        </select>
                        @error('is_featured')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="1" {{ old('status', $course->status) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $course->status) == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Enrollment Count</label>
                        <input type="number" class="form-control @error('enrollment_count') is-invalid @enderror"
                               name="enrollment_count" value="{{ old('enrollment_count', $course->enrollment_count) }}" min="0">
                        @error('enrollment_count')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="card-footer bg-light text-end">
                <button type="reset" class="btn btn-secondary me-2">
                    <i class="feather feather-refresh-cw me-1"></i>Reset
                </button>
                <button type="submit" class="btn btn-success">
                    <i class="feather feather-save me-1"></i>Update Course
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container--default .select2-selection--multiple {
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
    }
    .select2-container--default.select2-container--focus .select2-selection--multiple {
        border-color: #86b7fe;
        outline: 0;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    .border-bottom {
        border-bottom: 2px solid #dee2e6 !important;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    // Initialize Select2
    $(document).ready(function() {
        // Single select
        $('.select2').select2({
            placeholder: "Select an option",
            allowClear: true
        });

        // Multiple select with tagging
        $('.select2-multiple').select2({
            placeholder: "Select options or type to add new",
            allowClear: true,
            tags: true,
            tokenSeparators: [',', ';']
        });

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

    // Dynamic topics management
    let topicIndex = {{ count(old('topics', $course->topics ?: [['title' => '', 'description' => '']])) }};
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
                    <button type="button" class="btn btn-danger remove-topic w-100">
                        <i class="feather feather-trash-2 me-1"></i>Remove
                    </button>
                </div>
            </div>
        `);
        topicIndex++;
    });

    $(document).on('click', '.remove-topic', function () {
        $(this).closest('.topic-row').remove();
    });

    // Dynamic specifications management
    let specIndex = {{ count(old('other_specifications', $course->other_specifications ?: [['label' => '', 'description' => '']])) }};
    $('#add-specification').on('click', function () {
        $('#specifications-wrapper').append(`
            <div class="row g-2 specification-row mb-2">
                <div class="col-md-5">
                    <input type="text" name="other_specifications[${specIndex}][label]" class="form-control" placeholder="Specification Label">
                </div>
                <div class="col-md-5">
                    <input type="text" name="other_specifications[${specIndex}][description]" class="form-control" placeholder="Specification Description">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger remove-specification w-100">
                        <i class="feather feather-trash-2 me-1"></i>Remove
                    </button>
                </div>
            </div>
        `);
        specIndex++;
    });

    $(document).on('click', '.remove-specification', function () {
        $(this).closest('.specification-row').remove();
    });
</script>
@endpush
