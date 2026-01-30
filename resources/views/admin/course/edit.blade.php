{{-- @dd($course->duration_unit); --}}
@extends('layouts.admin.app')

@section('content')
<div class="container mt-4">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Edit Course</h4>
                <h6 class="text-muted">Update existing course details</h6>
            </div>
        </div>
        <ul class="table-top-head">
            <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh page" aria-label="Refresh"><i class="ti ti-refresh"></i></a>
            </li>
            <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse/Expand" id="collapse-header" aria-label="Collapse">
                    <i class="ti ti-chevron-up"></i>
                </a>
            </li>
        </ul>
        <div class="page-btn mt-0">
            <a href="{{ route('admin.course.index') }}" class="btn btn-secondary">
                <i class="feather feather-arrow-left me-2"></i>Back to Courses List
            </a>
        </div>
    </div>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <div class="d-flex align-items-center">
                <i class="feather feather-check-circle me-2"></i>
                <div class="flex-grow-1">
                    {{ session('success') }}
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Error Message --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
            <div class="d-flex align-items-center">
                <i class="feather feather-alert-triangle me-2"></i>
                <div>
                    <h6 class="fw-bold mb-2">Please fix the following errors:</h6>
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

    <div class="card shadow-lg rounded-4 border-0">
        <div class="card-header bg-gradient-primary text-white py-3 rounded-top-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="mb-0 fw-bold"><i class="feather feather-edit-3 me-2"></i>Edit Course: {{ $course->name }}</h4>
                    <small class="opacity-75">Update course details below</small>
                </div>
                <div class="badge bg-white text-primary px-3 py-2 fw-bold">
                    <i class="feather feather-edit me-1"></i>Editing
                </div>
            </div>
        </div>

        <form action="{{ route('admin.course.update', $course->id) }}" method="POST" enctype="multipart/form-data" id="courseForm" novalidate>
            @csrf
            @method('PUT')

            <div class="card-body">
                <!-- Progress Indicator -->
                <div class="progress-indicator mb-5">
                    <div class="d-flex justify-content-between align-items-center position-relative">
                        <div class="step active">
                            <div class="step-circle">1</div>
                            <div class="step-label">Basic Info</div>
                        </div>
                        <div class="step">
                            <div class="step-circle">2</div>
                            <div class="step-label">Details</div>
                        </div>
                        <div class="step">
                            <div class="step-circle">3</div>
                            <div class="step-label">Program Info</div>
                        </div>
                        <div class="step">
                            <div class="step-circle">4</div>
                            <div class="step-label">Requirements</div>
                        </div>
                        <div class="step">
                            <div class="step-circle">5</div>
                            <div class="step-label">Content</div>
                        </div>
                        <div class="step">
                            <div class="step-circle">6</div>
                            <div class="step-label">Additional</div>
                        </div>
                    </div>
                </div>

                <!-- Basic Information Section -->
                <div class="section-card mb-5" id="section-basic">
                    <div class="section-header mb-4">
                        <h5 class="fw-bold text-primary mb-2">
                            <i class="feather feather-info me-2"></i>Basic Information
                        </h5>
                        <p class="text-muted mb-0">Essential details about the course including name, level, and description</p>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="name" class="form-label fw-semibold">
                                Course Name <span class="text-danger">*</span>
                                <small class="text-muted d-block fw-normal">The official title of the course</small>
                            </label>
                            <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                   name="name" value="{{ old('name', $course->name) }}" 
                                   placeholder="e.g., Full Stack Web Development Masterclass" required>
                            @error('name')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="level" class="form-label fw-semibold">
                                Course Level <span class="text-danger">*</span>
                                <small class="text-muted d-block fw-normal">Select the difficulty level</small>
                            </label>
                            <select name="level" class="form-select form-select-lg @error('level') is-invalid @enderror" required>
                                <option value="" disabled>Choose a level...</option>
                                <option value="Awareness" {{ old('level', $course->level) == 'Awareness' ? 'selected' : '' }}>👶 Awareness (Beginner)</option>
                                <option value="Foundation" {{ old('level', $course->level) == 'Foundation' ? 'selected' : '' }}>📚 Foundation (Basic)</option>
                                <option value="Intermediate" {{ old('level', $course->level) == 'Intermediate' ? 'selected' : '' }}>⚡ Intermediate (Medium)</option>
                                <option value="Advanced" {{ old('level', $course->level) == 'Advanced' ? 'selected' : '' }}>🚀 Advanced (Expert)</option>
                                <option value="Professional" {{ old('level', $course->level) == 'Professional' ? 'selected' : '' }}>🎯 Professional (Industry)</option>
                            </select>
                            @error('level')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="image" class="form-label fw-semibold">
                                Featured Image
                                <small class="text-muted d-block fw-normal">Main thumbnail image for the course</small>
                            </label>
                            <div class="file-upload-wrapper">
                                <input type="file" class="form-control form-control-lg @error('image') is-invalid @enderror" 
                                       name="image" accept="image/*" id="imageUpload">
                                <div class="form-text">
                                    <i class="feather feather-info me-1"></i>
                                    Recommended: 500×300px (JPG/PNG) • Max: 2MB • Aspect Ratio: 5:3
                                </div>
                                @if($course->image)
                                    <div class="image-preview mt-2" id="imagePreview">
                                        <img src="{{ asset($course->image) }}" alt="Current Image" class="img-fluid rounded border" style="max-height: 150px;">
                                        <div class="mt-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remove_image" id="remove_image" value="1">
                                                <label class="form-check-label text-danger fw-semibold" for="remove_image">
                                                    <i class="feather feather-trash-2 me-1"></i>Remove current image
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="image-preview mt-2 d-none" id="imagePreview">
                                        <img src="" alt="Preview" class="img-fluid rounded border" style="max-height: 150px;">
                                    </div>
                                @endif
                            </div>
                            @error('image')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="gallery" class="form-label fw-semibold">
                                Gallery Images
                                <small class="text-muted d-block fw-normal">Additional images for course showcase</small>
                            </label>
                            <div class="file-upload-wrapper">
                                <input type="file" class="form-control form-control-lg @error('gallery') is-invalid @enderror"
                                       name="gallery[]" multiple accept="image/*" id="galleryUpload">
                                <div class="form-text">
                                    <i class="feather feather-info me-1"></i>
                                    Select multiple images • Allowed: JPG, PNG, WebP • Max per file: 2MB
                                </div>
                                @if($course->gallery && count($course->gallery) > 0)
                                    <div class="gallery-preview mt-2 row g-2" id="galleryPreview">
                                        @foreach($course->gallery as $galleryImage)
                                            <div class="col">
                                                <img src="{{ asset($galleryImage) }}" alt="Gallery Image" class="img-fluid rounded">
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="mt-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remove_gallery" id="remove_gallery" value="1">
                                            <label class="form-check-label text-danger fw-semibold" for="remove_gallery">
                                                <i class="feather feather-trash-2 me-1"></i>Remove all gallery images
                                            </label>
                                        </div>
                                    </div>
                                @else
                                    <div class="gallery-preview mt-2 d-none row g-2" id="galleryPreview"></div>
                                @endif
                            </div>
                            @error('gallery')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-semibold">
                                Course Duration
                                <small class="text-muted d-block fw-normal">How long the course runs</small>
                            </label>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <input type="number" class="form-control form-control-lg @error('duration_number') is-invalid @enderror"
                                           name="duration_number" value="{{ old('duration_number', $course->duration_number) }}" 
                                           placeholder="Number" min="1" max="36">
                                    <div class="form-text text-xs">e.g., 6, 12, 24</div>
                                    @error('duration_number')
                                        <div class="invalid-feedback d-flex align-items-center">
                                            <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <select name="duration_unit" class="form-select form-select-lg @error('duration_unit') is-invalid @enderror">
                                        <option value="" {{ !$course->duration_unit ? 'selected' : '' }}>Select unit</option>
                                        <option value="days" {{ old('duration_unit', $course->duration_unit?->value) == 'days' ? 'selected' : '' }}>Days</option>
                                        <option value="weeks" {{ old('duration_unit', $course->duration_unit?->value) == 'weeks' ? 'selected' : '' }}>Weeks</option>
                                        <option value="months" {{ old('duration_unit', $course->duration_unit?->value) == 'months' ? 'selected' : '' }}>Months</option>
                                        <option value="years" {{ old('duration_unit', $course->duration_unit?->value) == 'years' ? 'selected' : '' }}>Years</option>
                                    </select>
                                    @error('duration_unit')
                                        <div class="invalid-feedback d-flex align-items-center">
                                            <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-semibold">
                                Sector <span class="text-danger">*</span>
                                <small class="text-muted d-block fw-normal">Industry sector this course belongs to</small>
                            </label>
                            <select name="sector_id" class="form-select form-select-lg select2 @error('sector_id') is-invalid @enderror" required>
                                <option value="" disabled>Search or select sector...</option>
                                @foreach($sectors as $sector)
                                    <option value="{{ $sector->id }}" {{ old('sector_id', $course->sector_id) == $sector->id ? 'selected' : '' }}>
                                        {{ $sector->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('sector_id')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-semibold">
                                Payment Type <span class="text-danger">*</span>
                                <small class="text-muted d-block fw-normal">How the course is priced</small>
                            </label>
                            <select name="paid_type" class="form-select form-select-lg @error('paid_type') is-invalid @enderror" required>
                                <option value="free" {{ old('paid_type', $course->paid_type->value) == 'free' ? 'selected' : '' }}>
                                    🆓 Free Course (No charges)
                                </option>
                                <option value="paid" {{ old('paid_type', $course->paid_type->value) == 'paid' ? 'selected' : '' }}>
                                    💰 Paid Course (Requires payment)
                                </option>
                                <option value="na" {{ old('paid_type', $course->paid_type->value) == 'na' ? 'selected' : '' }}>
                                    📋 N/A (Not applicable)
                                </option>
                            </select>
                            @error('paid_type')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-semibold">
                                Available Languages <span class="text-danger">*</span>
                                <small class="text-muted d-block fw-normal">Languages in which course is offered</small>
                            </label>
                            <select name="language[]" class="form-select form-select-lg select2-multiple @error('language') is-invalid @enderror" 
                                    multiple="multiple" required data-placeholder="Select languages...">
                                @php
                                    $currentLanguages = old('language', $course->language ?: ['English']);
                                @endphp
                                <option value="English" {{ in_array('English', $currentLanguages) ? 'selected' : '' }}>
                                    🇬🇧 English (Default)
                                </option>
                                <option value="Hindi" {{ in_array('Hindi', $currentLanguages) ? 'selected' : '' }}>🇮🇳 Hindi</option>
                                <option value="Marathi" {{ in_array('Marathi', $currentLanguages) ? 'selected' : '' }}>📜 Marathi</option>
                                <option value="Bengali" {{ in_array('Bengali', $currentLanguages) ? 'selected' : '' }}>🎭 Bengali</option>
                                <option value="Tamil" {{ in_array('Tamil', $currentLanguages) ? 'selected' : '' }}>☸️ Tamil</option>
                                <option value="Telugu" {{ in_array('Telugu', $currentLanguages) ? 'selected' : '' }}>🎵 Telugu</option>
                                <option value="Kannada" {{ in_array('Kannada', $currentLanguages) ? 'selected' : '' }}>🏰 Kannada</option>
                                <option value="Malayalam" {{ in_array('Malayalam', $currentLanguages) ? 'selected' : '' }}>🌴 Malayalam</option>
                            </select>
                            @error('language')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-12 mb-4">
                            <label class="form-label fw-semibold">
                                Short Description
                                <small class="text-muted d-block fw-normal">Brief overview (2-3 sentences) shown in listings</small>
                            </label>
                            <textarea class="form-control form-control-lg @error('short_description') is-invalid @enderror" 
                                      name="short_description" rows="3" 
                                      placeholder="Provide a concise summary of what students will learn in this course...">{{ old('short_description', $course->short_description) }}</textarea>
                            <div class="form-text d-flex justify-content-between">
                                <span><i class="feather feather-info me-1"></i> Max 200 characters recommended</span>
                                <span class="char-count"><span id="shortDescCount">{{ strlen(old('short_description', $course->short_description)) }}</span>/200</span>
                            </div>
                            @error('short_description')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-12 mb-4">
                            <label class="form-label fw-semibold">
                                Detailed Description
                                <small class="text-muted d-block fw-normal">Complete course details, objectives, and outcomes</small>
                            </label>
                            <div class="editor-wrapper">
                                <textarea class="form-control @error('long_description') is-invalid @enderror" 
                                          name="long_description" rows="6" id="long_description"
                                          placeholder="Write comprehensive course details here...">{{ old('long_description', $course->long_description) }}</textarea>
                                <div class="form-text">
                                    <i class="feather feather-info me-1"></i> 
                                    Use formatting tools for better presentation. Include learning objectives, career opportunities, etc.
                                </div>
                            </div>
                            @error('long_description')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Course Details Section -->
                <div class="section-card mb-5" id="section-details">
                    <div class="section-header mb-4">
                        <h5 class="fw-bold text-primary mb-2">
                            <i class="feather feather-book-open me-2"></i>Course Details
                        </h5>
                        <p class="text-muted mb-0">Specific information about training, certification, and logistics</p>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-semibold">
                                Training Provider
                                <small class="text-muted d-block fw-normal">Organization delivering the training</small>
                            </label>
                            <input type="text" class="form-control form-control-lg @error('provider') is-invalid @enderror"
                                   name="provider" value="{{ old('provider', $course->provider) }}" 
                                   placeholder="e.g., Microsoft Learn, Google Career Certificates, Skill India">
                            @error('provider')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-semibold">
                                Certification Type
                                <small class="text-muted d-block fw-normal">Type of certificate awarded</small>
                            </label>
                            <input type="text" class="form-control form-control-lg @error('certification_type') is-invalid @enderror"
                                   name="certification_type" value="{{ old('certification_type', $course->certification_type) }}" 
                                   placeholder="e.g., Completion Certificate, Government Certified, Industry Recognized">
                            @error('certification_type')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-semibold">
                                Assessment Mode
                                <small class="text-muted d-block fw-normal">How students will be evaluated</small>
                            </label>
                            <input type="text" class="form-control form-control-lg @error('assessment_mode') is-invalid @enderror"
                                   name="assessment_mode" value="{{ old('assessment_mode', $course->assessment_mode) }}" 
                                   placeholder="e.g., Online Exam, Project Submission, Practical Test">
                            @error('assessment_mode')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-semibold">
                                Course Code
                                <small class="text-muted d-block fw-normal">Unique identifier for the course</small>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="feather feather-hash"></i></span>
                                <input type="text" class="form-control form-control-lg @error('course_code') is-invalid @enderror"
                                       name="course_code" value="{{ old('course_code', $course->course_code) }}" 
                                       placeholder="e.g., WEB101, DATA202">
                                <button type="button" class="btn btn-outline-secondary" id="generateCode">
                                    <i class="feather feather-refresh-cw"></i>
                                </button>
                            </div>
                            <div class="form-text">
                                <i class="feather feather-info me-1"></i> Click refresh to generate new code
                            </div>
                            @error('course_code')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-semibold">
                                NSQF Level
                                <small class="text-muted d-block fw-normal">National Skills Qualification Framework level</small>
                            </label>
                            <select name="nsqf_level" class="form-select form-select-lg @error('nsqf_level') is-invalid @enderror">
                                <option value="" {{ !$course->nsqf_level ? 'selected' : '' }}>Select NSQF Level...</option>
                                @for($i = 1; $i <= 10; $i++)
                                    <option value="Level {{ $i }}" {{ old('nsqf_level', $course->nsqf_level) == 'Level ' . $i ? 'selected' : '' }}>
                                        Level {{ $i }}
                                    </option>
                                @endfor
                            </select>
                            <div class="form-text">
                                <i class="feather feather-info me-1"></i> 
                                Higher levels indicate more advanced skills (Level 1 = Basic, Level 10 = Expert)
                            </div>
                            @error('nsqf_level')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-semibold">
                                Available Locations
                                <small class="text-muted d-block fw-normal">Where the course is offered</small>
                            </label>
                            <select name="location[]" class="form-select form-select-lg select2-multiple @error('location') is-invalid @enderror"
                                    multiple="multiple" data-placeholder="Select locations or add new...">
                                @php
                                    $currentLocations = old('location', $course->location ?: []);
                                @endphp
                                <option value="Mumbai" {{ in_array('Mumbai', $currentLocations) ? 'selected' : '' }}>🏙️ Mumbai</option>
                                <option value="Delhi" {{ in_array('Delhi', $currentLocations) ? 'selected' : '' }}>🏛️ Delhi</option>
                                <option value="Bangalore" {{ in_array('Bangalore', $currentLocations) ? 'selected' : '' }}>💻 Bangalore</option>
                                <option value="Hyderabad" {{ in_array('Hyderabad', $currentLocations) ? 'selected' : '' }}>💎 Hyderabad</option>
                                <option value="Chennai" {{ in_array('Chennai', $currentLocations) ? 'selected' : '' }}>🎬 Chennai</option>
                                <option value="Kolkata" {{ in_array('Kolkata', $currentLocations) ? 'selected' : '' }}>🎭 Kolkata</option>
                                <option value="Pune" {{ in_array('Pune', $currentLocations) ? 'selected' : '' }}>🎓 Pune</option>
                                <option value="Online" {{ in_array('Online', $currentLocations) ? 'selected' : '' }}>🌐 Online (Remote)</option>
                            </select>
                            @error('location')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-semibold">
                                Mode of Study <span class="text-danger">*</span>
                                <small class="text-muted d-block fw-normal">How the course is delivered</small>
                            </label>
                            <select name="mode_of_study" class="form-select form-select-lg @error('mode_of_study') is-invalid @enderror" required>
                                <option value="" disabled>Select delivery mode...</option>
                                <option value="1" {{ old('mode_of_study', $course->mode_of_study->value) == 1 ? 'selected' : '' }}>
                                    💻 Online (100% remote learning)
                                </option>
                                <option value="2" {{ old('mode_of_study', $course->mode_of_study->value) == 2 ? 'selected' : '' }}>
                                    🏢 In-Centre (Classroom based)
                                </option>
                                <option value="3" {{ old('mode_of_study', $course->mode_of_study->value) == 3 ? 'selected' : '' }}>
                                    🔀 Hybrid (Mix of online & classroom)
                                </option>
                                <option value="4" {{ old('mode_of_study', $course->mode_of_study->value) == 4 ? 'selected' : '' }}>
                                    📱 On-Demand (Self-paced, anytime)
                                </option>
                            </select>
                            @error('mode_of_study')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-semibold">
                                Target Occupations
                                <small class="text-muted d-block fw-normal">Job roles this course prepares for</small>
                            </label>
                            <select name="occupations[]" class="form-select form-select-lg select2-multiple @error('occupations') is-invalid @enderror"
                                    multiple="multiple" data-placeholder="Select occupations or add new...">
                                @php
                                    $currentOccupations = old('occupations', $course->occupations ?: []);
                                @endphp
                                <option value="Software Developer" {{ in_array('Software Developer', $currentOccupations) ? 'selected' : '' }}>
                                    💻 Software Developer
                                </option>
                                <option value="Data Analyst" {{ in_array('Data Analyst', $currentOccupations) ? 'selected' : '' }}>
                                    📊 Data Analyst
                                </option>
                                <option value="Web Designer" {{ in_array('Web Designer', $currentOccupations) ? 'selected' : '' }}>
                                    🎨 Web Designer
                                </option>
                                <option value="Digital Marketer" {{ in_array('Digital Marketer', $currentOccupations) ? 'selected' : '' }}>
                                    📈 Digital Marketer
                                </option>
                                <option value="Project Manager" {{ in_array('Project Manager', $currentOccupations) ? 'selected' : '' }}>
                                    📋 Project Manager
                                </option>
                            </select>
                            @error('occupations')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Program Information Section -->
                <div class="section-card mb-5" id="section-program">
                    <div class="section-header mb-4">
                        <h5 class="fw-bold text-primary mb-2">
                            <i class="feather feather-briefcase me-2"></i>Program Information
                        </h5>
                        <p class="text-muted mb-0">Details about the program initiative and structure</p>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-semibold">
                                Program By
                                <small class="text-muted d-block fw-normal">Organization running the program</small>
                            </label>
                            <input type="text" class="form-control form-control-lg @error('program_by') is-invalid @enderror"
                                   name="program_by" value="{{ old('program_by', $course->program_by) }}" 
                                   placeholder="e.g., Skill India Digital, PMKVY, NASSCOM">
                            @error('program_by')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-semibold">
                                Initiative Of
                                <small class="text-muted d-block fw-normal">Primary sponsor or initiator</small>
                            </label>
                            <input type="text" class="form-control form-control-lg @error('initiative_of') is-invalid @enderror"
                                   name="initiative_of" value="{{ old('initiative_of', $course->initiative_of) }}" 
                                   placeholder="e.g., Ministry of Skill Development, Tata Trusts">
                            @error('initiative_of')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-semibold">
                                Domain
                                <small class="text-muted d-block fw-normal">Primary field or industry domain</small>
                            </label>
                            <input type="text" class="form-control form-control-lg @error('domain') is-invalid @enderror"
                                   name="domain" value="{{ old('domain', $course->domain) }}" 
                                   placeholder="e.g., Information Technology, Healthcare, Agriculture">
                            @error('domain')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-semibold">
                                Internship Available
                                <small class="text-muted d-block fw-normal">Whether internship is part of the program</small>
                            </label>
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" name="internship" id="internship_no" 
                                       value="0" {{ old('internship', $course->internship) == 0 ? 'checked' : '' }}>
                                <label class="btn btn-outline-danger" for="internship_no">
                                    <i class="feather feather-x-circle me-1"></i> No Internship
                                </label>
                                
                                <input type="radio" class="btn-check" name="internship" id="internship_yes" 
                                       value="1" {{ old('internship', $course->internship) == 1 ? 'checked' : '' }}>
                                <label class="btn btn-outline-success" for="internship_yes">
                                    <i class="feather feather-check-circle me-1"></i> With Internship
                                </label>
                            </div>
                            @error('internship')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-12 mb-4" id="internship_note_div" style="display: {{ old('internship', $course->internship) == 1 ? 'block' : 'none' }}">
                            <label class="form-label fw-semibold">
                                Internship Details
                                <small class="text-muted d-block fw-normal">Specify internship duration, type, and requirements</small>
                            </label>
                            <input type="text" class="form-control form-control-lg @error('internship_note') is-invalid @enderror"
                                   name="internship_note" value="{{ old('internship_note', $course->internship_note) }}" 
                                   placeholder="e.g., 3-month paid internship, 6-month industry project, guaranteed placement assistance">
                            <div class="form-text">
                                <i class="feather feather-info me-1"></i>
                                Provide clear details about the internship component
                            </div>
                            @error('internship_note')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-semibold">
                                Stipend Available
                                <small class="text-muted d-block fw-normal">Is a stipend provided?</small>
                            </label>
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" name="stipend_status" id="stipend_no" 
                                       value="0" {{ old('stipend_status', $course->stipend_status ?? 0) == 0 ? 'checked' : '' }}>
                                <label class="btn btn-outline-danger" for="stipend_no">
                                    <i class="feather feather-x-circle me-1"></i> No
                                </label>
                                
                                <input type="radio" class="btn-check" name="stipend_status" id="stipend_yes" 
                                       value="1" {{ old('stipend_status', $course->stipend_status ?? 0) == 1 ? 'checked' : '' }}>
                                <label class="btn btn-outline-success" for="stipend_yes">
                                    <i class="feather feather-check-circle me-1"></i> Yes
                                </label>
                            </div>
                            @error('stipend_status')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4" id="stipend_amount_div" style="display: {{ old('stipend_status', $course->stipend_status ?? 0) == 1 ? 'block' : 'none' }}">
                            <label class="form-label fw-semibold">
                                Stipend Amount
                                <small class="text-muted d-block fw-normal">Amount provided</small>
                            </label>
                            <input type="text" class="form-control form-control-lg @error('stipend_amount') is-invalid @enderror"
                                   name="stipend_amount" value="{{ old('stipend_amount', $course->stipend_amount) }}" 
                                   placeholder="e.g., ₹5,000/month">
                            @error('stipend_amount')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Requirements Section -->
                <div class="section-card mb-5" id="section-requirements">
                    <div class="section-header mb-4">
                        <h5 class="fw-bold text-primary mb-2">
                            <i class="feather feather-user-check me-2"></i>Student Requirements
                        </h5>
                        <p class="text-muted mb-0">Prerequisites and qualifications needed to enroll</p>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-semibold">
                                Required Age
                                <small class="text-muted d-block fw-normal">Minimum and/or maximum age limit</small>
                            </label>
                            <input type="text" class="form-control form-control-lg @error('required_age') is-invalid @enderror"
                                   name="required_age" value="{{ old('required_age', $course->required_age) }}" 
                                   placeholder="e.g., 18+, 21-35, No age limit">
                            @error('required_age')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-semibold">
                                Minimum Education
                                <small class="text-muted d-block fw-normal">Required educational qualifications</small>
                            </label>
                            <select name="minimum_education[]" class="form-select form-select-lg select2-multiple @error('minimum_education') is-invalid @enderror"
                                    multiple="multiple" data-placeholder="Select education levels...">
                                @php
                                    $currentEducation = old('minimum_education', $course->minimum_education ?: []);
                                @endphp
                                <option value="10th Pass" {{ in_array('10th Pass', $currentEducation) ? 'selected' : '' }}>
                                    🎓 10th Pass (Matriculation)
                                </option>
                                <option value="12th Pass" {{ in_array('12th Pass', $currentEducation) ? 'selected' : '' }}>
                                    🎓 12th Pass (Intermediate)
                                </option>
                                <option value="Diploma" {{ in_array('Diploma', $currentEducation) ? 'selected' : '' }}>
                                    📜 Diploma (3-year)
                                </option>
                                <option value="Graduate" {{ in_array('Graduate', $currentEducation) ? 'selected' : '' }}>
                                    🎓 Graduate (Bachelor's Degree)
                                </option>
                                <option value="Post Graduate" {{ in_array('Post Graduate', $currentEducation) ? 'selected' : '' }}>
                                    🎓 Post Graduate (Master's Degree)
                                </option>
                                <option value="ITI" {{ in_array('ITI', $currentEducation) ? 'selected' : '' }}>
                                    🔧 ITI (Industrial Training)
                                </option>
                            </select>
                            @error('minimum_education')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-semibold">
                                Industry Experience
                                <small class="text-muted d-block fw-normal">Years of relevant work experience needed</small>
                            </label>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="number" class="form-control form-control-lg @error('industry_experience_years') is-invalid @enderror"
                                               name="industry_experience_years" value="{{ old('industry_experience_years', $course->industry_experience_years) }}" 
                                               min="0" max="50" placeholder="Years">
                                        <span class="input-group-text">years</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control form-control-lg @error('industry_experience_desc') is-invalid @enderror"
                                           name="industry_experience_desc" value="{{ old('industry_experience_desc', $course->industry_experience_desc) }}" 
                                           placeholder="e.g., Relevant field experience">
                                </div>
                            </div>
                            <div class="form-text">
                                <i class="feather feather-info me-1"></i>
                                Set to 0 if no experience required. Use description for specific requirements.
                            </div>
                            @error('industry_experience_years')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                            @error('industry_experience_desc')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-12 mb-4">
                            <label class="form-label fw-semibold">
                                Learning Tools & Technologies
                                <small class="text-muted d-block fw-normal">Software, tools, and technologies students will use</small>
                            </label>
                            <select name="learning_tools[]" class="form-select form-select-lg select2-multiple @error('learning_tools') is-invalid @enderror"
                                    multiple="multiple" data-placeholder="Select tools or add new...">
                                @php
                                    $currentTools = old('learning_tools', $course->learning_tools ?: []);
                                @endphp
                                <option value="VS Code" {{ in_array('VS Code', $currentTools) ? 'selected' : '' }}>
                                    👨‍💻 VS Code (Code Editor)
                                </option>
                                <option value="Python" {{ in_array('Python', $currentTools) ? 'selected' : '' }}>
                                    🐍 Python Programming
                                </option>
                                <option value="JavaScript" {{ in_array('JavaScript', $currentTools) ? 'selected' : '' }}>
                                    🌐 JavaScript
                                </option>
                                <option value="React" {{ in_array('React', $currentTools) ? 'selected' : '' }}>
                                    ⚛️ React JS
                                </option>
                                <option value="Node.js" {{ in_array('Node.js', $currentTools) ? 'selected' : '' }}>
                                    🟢 Node.js
                                </option>
                                <option value="MySQL" {{ in_array('MySQL', $currentTools) ? 'selected' : '' }}>
                                    🗄️ MySQL Database
                                </option>
                                <option value="MongoDB" {{ in_array('MongoDB', $currentTools) ? 'selected' : '' }}>
                                    🍃 MongoDB
                                </option>
                                <option value="Docker" {{ in_array('Docker', $currentTools) ? 'selected' : '' }}>
                                    🐳 Docker
                                </option>
                            </select>
                            @error('learning_tools')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Course Content Section -->
                <div class="section-card mb-5" id="section-content">
                    <div class="section-header mb-4">
                        <h5 class="fw-bold text-primary mb-2">
                            <i class="feather feather-book me-2"></i>Course Content & Curriculum
                        </h5>
                        <p class="text-muted mb-0">Detailed syllabus, topics, and specifications</p>
                    </div>
                    
                    <div class="row">
                        <div class="col-12 mb-4">
                            <label class="form-label fw-semibold">
                                Course Topics / Modules
                                <small class="text-muted d-block fw-normal">Add topics with titles and descriptions</small>
                            </label>
                            <div id="topics-wrapper" class="mb-3">
                                @php
                                    $topics = old('topics', $course->topics ?: [['title' => '', 'description' => '']]);
                                @endphp

                                @foreach($topics as $index => $topic)
                                    <div class="topic-card mb-3 border rounded-3 p-3 bg-light">
                                        <div class="row g-3 align-items-center">
                                            <div class="col-md-1">
                                                <div class="topic-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" 
                                                     style="width: 36px; height: 36px;">
                                                    {{ $index + 1 }}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" name="topics[{{ $index }}][title]"
                                                       class="form-control @error('topics.' . $index . '.title') is-invalid @enderror"
                                                       placeholder="Topic title (e.g., Introduction to Python)" 
                                                       value="{{ $topic['title'] ?? '' }}">
                                                @error('topics.' . $index . '.title')
                                                    <div class="invalid-feedback d-flex align-items-center">
                                                        <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-5">
                                                <input type="text" name="topics[{{ $index }}][description]"
                                                       class="form-control @error('topics.' . $index . '.description') is-invalid @enderror"
                                                       placeholder="Topic description (e.g., Learn basic syntax and concepts)" 
                                                       value="{{ $topic['description'] ?? '' }}">
                                                @error('topics.' . $index . '.description')
                                                    <div class="invalid-feedback d-flex align-items-center">
                                                        <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-danger remove-topic w-100">
                                                    <i class="feather feather-trash-2 me-1"></i>Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" id="add-topic" class="btn btn-primary">
                                <i class="feather feather-plus-circle me-2"></i>Add New Topic
                            </button>
                            <div class="form-text mt-2">
                                <i class="feather feather-info me-1"></i>
                                Add all major topics/modules covered in the course. Order them logically.
                            </div>
                        </div>

                        <div class="col-12 mb-4">
                            <label class="form-label fw-semibold">
                                Learning Outcomes
                                <small class="text-muted d-block fw-normal">Other important course details and features</small>
                            </label>
                            <div id="specifications-wrapper" class="mb-3">
                                @php
                                    $specifications = old('other_specifications', $course->other_specifications ?: [['label' => '', 'description' => '']]);
                                @endphp

                                @foreach($specifications as $index => $spec)
                                    <div class="specification-card mb-3 border rounded-3 p-3 bg-light">
                                        <div class="row g-3 align-items-center">
                                            <div class="col-md-1">
                                                <div class="spec-icon text-primary">
                                                    <i class="feather feather-file-text"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" name="other_specifications[{{ $index }}][label]"
                                                       class="form-control @error('other_specifications.' . $index . '.label') is-invalid @enderror"
                                                       placeholder="Label (e.g., Project Work, Placement Support)" 
                                                       value="{{ $spec['label'] ?? '' }}">
                                                @error('other_specifications.' . $index . '.label')
                                                    <div class="invalid-feedback d-flex align-items-center">
                                                        <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-5">
                                                <input type="text" name="other_specifications[{{ $index }}][description]"
                                                       class="form-control @error('other_specifications.' . $index . '.description') is-invalid @enderror"
                                                       placeholder="Description (e.g., 3 real-world projects with mentor guidance)" 
                                                       value="{{ $spec['description'] ?? '' }}">
                                                @error('other_specifications.' . $index . '.description')
                                                    <div class="invalid-feedback d-flex align-items-center">
                                                        <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-danger remove-specification w-100">
                                                    <i class="feather feather-trash-2 me-1"></i>Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" id="add-specification" class="btn btn-primary">
                                <i class="feather feather-plus-circle me-2"></i>Add New Learning Outcome
                            </button>
                            <div class="form-text mt-2">
                                <i class="feather feather-info me-1"></i>
                                Add additional features like projects, mentorship, placement support, etc.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Information Section -->
                <div class="section-card mb-5" id="section-additional">
                    <div class="section-header mb-4">
                        <h5 class="fw-bold text-primary mb-2">
                            <i class="feather feather-settings me-2"></i>Additional Information
                        </h5>
                        <p class="text-muted mb-0">Visibility, status, and other administrative details</p>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-semibold">
                                Course Dates
                                <small class="text-muted d-block fw-normal">Start and end dates (if applicable)</small>
                            </label>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="feather feather-calendar"></i></span>
                                        <input type="date" class="form-control form-control-lg @error('start_date') is-invalid @enderror"
                                               name="start_date" value="{{ old('start_date', $course->start_date ? $course->start_date->format('Y-m-d') : '') }}" 
                                               placeholder="Start date">
                                    </div>
                                    <div class="form-text text-xs">Batch start date</div>
                                    @error('start_date')
                                        <div class="invalid-feedback d-flex align-items-center">
                                            <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="feather feather-calendar"></i></span>
                                        <input type="date" class="form-control form-control-lg @error('end_date') is-invalid @enderror"
                                               name="end_date" value="{{ old('end_date', $course->end_date ? $course->end_date->format('Y-m-d') : '') }}" 
                                               placeholder="End date">
                                    </div>
                                    <div class="form-text text-xs">Batch end date</div>
                                    @error('end_date')
                                        <div class="invalid-feedback d-flex align-items-center">
                                            <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-4">
                            <label class="form-label fw-semibold">
                                Featured Course?
                                <small class="text-muted d-block fw-normal">Show prominently on homepage</small>
                            </label>
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" name="is_featured" id="featured_no" 
                                       value="0" {{ old('is_featured', $course->is_featured) == 0 ? 'checked' : '' }}>
                                <label class="btn btn-outline-secondary" for="featured_no">
                                    <i class="feather feather-x me-1"></i> Regular
                                </label>
                                
                                <input type="radio" class="btn-check" name="is_featured" id="featured_yes" 
                                       value="1" {{ old('is_featured', $course->is_featured) == 1 ? 'checked' : '' }}>
                                <label class="btn btn-outline-warning" for="featured_yes">
                                    <i class="feather feather-star me-1"></i> Featured
                                </label>
                            </div>
                            @error('is_featured')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-4">
                            <label class="form-label fw-semibold">
                                Status <span class="text-danger">*</span>
                                <small class="text-muted d-block fw-normal">Course visibility state</small>
                            </label>
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" name="status" id="status_active" 
                                       value="1" {{ old('status', $course->status) == 1 ? 'checked' : '' }}>
                                <label class="btn btn-outline-success" for="status_active">
                                    <i class="feather feather-check me-1"></i> Active
                                </label>
                                
                                <input type="radio" class="btn-check" name="status" id="status_inactive" 
                                       value="0" {{ old('status', $course->status) == 0 ? 'checked' : '' }}>
                                <label class="btn btn-outline-secondary" for="status_inactive">
                                    <i class="feather feather-pause me-1"></i> Inactive
                                </label>
                            </div>
                            @error('status')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-4">
                            <label class="form-label fw-semibold">
                                Availability
                                <small class="text-muted d-block fw-normal">Current availability status</small>
                            </label>
                            <select name="availability_status" class="form-select form-select-lg @error('availability_status') is-invalid @enderror">
                                <option value="available" {{ old('availability_status', $course->availability_status) == 'available' ? 'selected' : '' }}>
                                    ✅ Available (Open for enrollment)
                                </option>
                                <option value="not_available" {{ old('availability_status', $course->availability_status) == 'not_available' ? 'selected' : '' }}>
                                    ⏸️ Not Available (Closed/Upcoming)
                                </option>
                            </select>
                            @error('availability_status')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-4">
                            <label class="form-label fw-semibold">
                                Review Rating
                                <small class="text-muted d-block fw-normal">Average star rating (0-5)</small>
                            </label>
                            <div class="input-group">
                                <input type="number" step="0.1" min="0" max="5" 
                                       class="form-control form-control-lg @error('review_stars') is-invalid @enderror"
                                       name="review_stars" value="{{ old('review_stars', $course->review_stars) }}" 
                                       placeholder="e.g., 4.5">
                                <span class="input-group-text">
                                    <i class="feather feather-star text-warning"></i>
                                </span>
                            </div>
                            <div class="form-text">
                                <i class="feather feather-info me-1"></i>
                                Set rating. Use decimal values (e.g., 4.2)
                            </div>
                            @error('review_stars')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-4">
                            <label class="form-label fw-semibold">
                                Review Count
                                <small class="text-muted d-block fw-normal">Number of student reviews</small>
                            </label>
                            <input type="number" min="0" class="form-control form-control-lg @error('review_count') is-invalid @enderror"
                                   name="review_count" value="{{ old('review_count', $course->review_count) }}" 
                                   placeholder="e.g., 120">
                            @error('review_count')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-4">
                            <label class="form-label fw-semibold">
                                Enrollment Count
                                <small class="text-muted d-block fw-normal">Current number of enrolled students</small>
                            </label>
                            <div class="input-group">
                                <input type="number" class="form-control form-control-lg @error('enrollment_count') is-invalid @enderror"
                                       name="enrollment_count" value="{{ old('enrollment_count', $course->enrollment_count) }}" 
                                       min="0" placeholder="0">
                                <span class="input-group-text">
                                    <i class="feather feather-users text-primary"></i>
                                </span>
                            </div>
                            <div class="form-text">
                                <i class="feather feather-info me-1"></i>
                                Current enrollment count.
                            </div>
                            @error('enrollment_count')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="feather feather-alert-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer bg-light border-0 py-4 rounded-bottom-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <button type="reset" class="btn btn-lg btn-outline-secondary">
                            <i class="feather feather-refresh-cw me-2"></i>Reset Changes
                        </button>
                    </div>
                    <div>
                        <a href="{{ route('admin.course.index') }}" class="btn btn-lg btn-outline-danger me-3">
                            <i class="feather feather-x me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-lg btn-success px-5">
                            <i class="feather feather-save me-2"></i>Update Course
                        </button>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <small class="text-muted">
                        <i class="feather feather-info me-1"></i>
                        All fields marked with <span class="text-danger">*</span> are required
                    </small>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.css" rel="stylesheet">
<style>
    /* Custom CSS for enhanced form */
    .card {
        border: none;
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.08);
    }
    
    .section-card {
        background: #fff;
        border-radius: 1rem;
        padding: 2rem;
        margin-bottom: 2rem;
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }
    
    .section-card:hover {
        border-color: #0d6efd;
        box-shadow: 0 0.125rem 0.75rem rgba(13, 110, 253, 0.15);
    }
    
    .section-header {
        border-bottom: 2px solid #e9ecef;
        padding-bottom: 1rem;
    }
    
    .form-control-lg {
        padding: 0.75rem 1rem;
        font-size: 1rem;
        border-radius: 0.75rem;
    }
    
    .form-label {
        margin-bottom: 0.5rem;
    }
    
    .form-label small {
        font-weight: normal;
        opacity: 0.8;
    }
    
    .form-text {
        margin-top: 0.375rem;
        font-size: 0.875rem;
    }
    
    .input-group-text {
        background-color: #f8f9fa;
        border: 1px solid #ced4da;
    }
    
    .btn-group .btn {
        padding: 0.75rem 1rem;
    }
    
    /* Progress Indicator */
    .progress-indicator {
        margin: 2rem 0;
    }
    
    .step {
        text-align: center;
        position: relative;
        flex: 1;
    }
    
    .step:not(:last-child):after {
        content: '';
        position: absolute;
        top: 18px;
        right: -50%;
        width: 100%;
        height: 2px;
        background-color: #dee2e6;
        z-index: 1;
    }
    
    .step.active:not(:last-child):after {
        background-color: #0d6efd;
    }
    
    .step-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #dee2e6;
        color: #6c757d;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.5rem;
        font-weight: bold;
        position: relative;
        z-index: 2;
    }
    
    .step.active .step-circle {
        background-color: #0d6efd;
        color: white;
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.2);
    }
    
    .step-label {
        font-size: 0.875rem;
        color: #6c757d;
    }
    
    .step.active .step-label {
        color: #0d6efd;
        font-weight: 600;
    }
    
    /* File upload preview */
    .image-preview img {
        max-width: 200px;
        border: 2px dashed #dee2e6;
        padding: 0.5rem;
    }
    
    .gallery-preview .col {
        max-width: 120px;
    }
    
    .gallery-preview img {
        width: 100%;
        height: 80px;
        object-fit: cover;
        border: 1px solid #dee2e6;
        border-radius: 0.5rem;
    }
    
    /* Topic and Specification Cards */
    .topic-card, .specification-card {
        transition: all 0.3s ease;
    }
    
    .topic-card:hover, .specification-card:hover {
        border-color: #0d6efd;
        background-color: #f8f9fa;
    }
    
    .topic-number, .spec-icon {
        font-size: 1.25rem;
    }
    
    /* Select2 Customization - FIXED for custom values */
    .select2-container--default .select2-selection--multiple,
    .select2-container--default .select2-selection--single {
        border: 1px solid #ced4da;
        border-radius: 0.75rem;
        padding: 0.375rem;
        min-height: calc(3.5rem + 2px);
        height: auto;
    }
    
    .select2-container--default .select2-selection--multiple .select2-selection__rendered {
        display: block;
        list-style: none;
        margin: 0;
        padding: 0 5px;
        width: 100%;
    }
    
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: white;
        border-radius: 0.5rem;
        padding: 0.25rem 0.5rem;
        margin-top: 4px;
        margin-bottom: 4px;
        margin-right: 5px;
        display: inline-flex;
        align-items: center;
    }
    
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: white;
        margin-right: 5px;
    }
    
    .select2-container--default.select2-container--focus .select2-selection--multiple,
    .select2-container--default.select2-container--focus .select2-selection--single {
        border-color: #86b7fe;
        outline: 0;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .section-card {
            padding: 1.5rem;
        }
        
        .step:not(:last-child):after {
            display: none;
        }
        
        .progress-indicator {
            overflow-x: auto;
        }
        
        .btn-group .btn {
            font-size: 0.875rem;
            padding: 0.5rem 0.75rem;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Select2 with proper configuration for EDIT FORM
        $('.select2').select2({
            placeholder: "Select an option",
            allowClear: true,
            dropdownParent: $('.card-body'),
            width: '100%'
        });

        // Initialize Select2 multiple with tagging - FIXED for custom values
        $('.select2-multiple').each(function() {
            let selectEl = $(this);
            
            // Get existing values
            let existingValues = selectEl.val() || [];
            
            // Initialize Select2
            selectEl.select2({
                placeholder: "Select options or type to add new",
                allowClear: true,
                tags: true,
                tokenSeparators: [',', ';', ' '],
                dropdownParent: $('.card-body'),
                width: '100%',
                createTag: function(params) {
                    var term = $.trim(params.term);
                    if (term === '') return null;

                    // Check if term already exists (case-insensitive)
                    var exists = false;
                    selectEl.find("option").each(function() {
                        if ($(this).text().toLowerCase() === term.toLowerCase()) {
                            exists = true;
                            return false;
                        }
                    });

                    if (exists) return null;

                    return {
                        id: term,
                        text: term + ' (new)',
                        newTag: true
                    };
                },
                templateResult: function(data) {
                    if (data.newTag) {
                        var $result = $('<span></span>');
                        $result.text(data.text);
                        $result.append(' <span class="badge bg-success">New</span>');
                        return $result;
                    }
                    return data.text;
                }
            });

            // Add existing custom values that are not in the option list
            existingValues.forEach(function(value) {
                if (value && !selectEl.find('option[value="' + value + '"]').length) {
                    var newOption = new Option(value, value, true, true);
                    selectEl.append(newOption);
                }
            });

            // Trigger change to update selection
            selectEl.val(existingValues).trigger('change');
        });

        // Initialize Summernote
        $('#long_description').summernote({
            height: 250,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            placeholder: 'Write detailed course description here...',
            callbacks: {
                onInit: function() {
                    if ($('#long_description').val()) {
                        $(this).summernote('code', $('#long_description').val());
                    }
                },
                onChange: function(contents) {
                    $('#long_description').val(contents);
                }
            }
        });

        // Character counter for short description
        $('#shortDescCount').text($('textarea[name="short_description"]').val().length);
        $('textarea[name="short_description"]').on('input', function() {
            $('#shortDescCount').text($(this).val().length);
        });

        // Image preview for featured image
        $('#imageUpload').on('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').removeClass('d-none').find('img').attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
            }
        });

        // Gallery preview
        $('#galleryUpload').on('change', function(e) {
            const files = e.target.files;
            const preview = $('#galleryPreview');
            preview.empty();
            
            if (files.length > 0) {
                preview.removeClass('d-none');
                for (let i = 0; i < files.length; i++) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.append(`
                            <div class="col">
                                <img src="${e.target.result}" alt="Preview ${i+1}" class="img-fluid rounded">
                            </div>
                        `);
                    }
                    reader.readAsDataURL(files[i]);
                }
            } else {
                preview.addClass('d-none');
            }
        });

        // Course code generator
        $('#generateCode').on('click', function() {
            const prefix = 'CRS';
            const timestamp = Date.now().toString(36).toUpperCase();
            const random = Math.random().toString(36).substr(2, 4).toUpperCase();
            const code = prefix + timestamp.substr(-4) + random;
            $('input[name="course_code"]').val(code);
        });

        // Toggle internship note
        $('input[name="internship"]').change(function() {
            if ($(this).val() == '1') {
                $('#internship_note_div').show().addClass('animate__animated animate__fadeIn');
            } else {
                $('#internship_note_div').hide();
                $('input[name="internship_note"]').val('');
            }
        });

        // Toggle stipend amount
        $('input[name="stipend_status"]').change(function() {
            if ($(this).val() == '1') {
                $('#stipend_amount_div').show().addClass('animate__animated animate__fadeIn');
            } else {
                $('#stipend_amount_div').hide();
                $('input[name="stipend_amount"]').val('');
            }
        });

        // Handle custom values in Select2 on form submission
        $('#courseForm').on('submit', function() {
            // Ensure all custom values in Select2 are properly saved
            $('.select2-multiple').each(function() {
                var select = $(this);
                var values = select.val() || [];
                
                // Add any custom values that aren't already options
                values.forEach(function(value) {
                    if (value && !select.find('option[value="' + value + '"]').length) {
                        select.append(new Option(value, value, true, true));
                    }
                });
            });
        });
    });

    // Dynamic topics management
    let topicIndex = {{ count(old('topics', $course->topics ?: [['title' => '', 'description' => '']])) }};
    $('#add-topic').on('click', function() {
        const topicCard = `
            <div class="topic-card mb-3 border rounded-3 p-3 bg-light animate__animated animate__fadeIn">
                <div class="row g-3 align-items-center">
                    <div class="col-md-1">
                        <div class="topic-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 36px; height: 36px;">
                            ${topicIndex + 1}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="topics[${topicIndex}][title]" class="form-control"
                               placeholder="Topic title (e.g., Introduction to Python)" required>
                    </div>
                    <div class="col-md-5">
                        <input type="text" name="topics[${topicIndex}][description]" class="form-control"
                               placeholder="Topic description (e.g., Learn basic syntax and concepts)">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger remove-topic w-100">
                            <i class="feather feather-trash-2 me-1"></i>Remove
                        </button>
                    </div>
                </div>
            </div>
        `;
        $('#topics-wrapper').append(topicCard);
        topicIndex++;
    });

    // Dynamic specifications management
    let specIndex = {{ count(old('other_specifications', $course->other_specifications ?: [['label' => '', 'description' => '']])) }};
    $('#add-specification').on('click', function() {
        const specCard = `
            <div class="specification-card mb-3 border rounded-3 p-3 bg-light animate__animated animate__fadeIn">
                <div class="row g-3 align-items-center">
                    <div class="col-md-1">
                        <div class="spec-icon text-primary">
                            <i class="feather feather-file-text"></i>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="other_specifications[${specIndex}][label]" class="form-control"
                               placeholder="Label (e.g., Project Work, Placement Support)">
                    </div>
                    <div class="col-md-5">
                        <input type="text" name="other_specifications[${specIndex}][description]" class="form-control"
                               placeholder="Description (e.g., 3 real-world projects with mentor guidance)">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger remove-specification w-100">
                            <i class="feather feather-trash-2 me-1"></i>Remove
                        </button>
                    </div>
                </div>
            </div>
        `;
        $('#specifications-wrapper').append(specCard);
        specIndex++;
    });

    // Remove topic/specification
    $(document).on('click', '.remove-topic, .remove-specification', function() {
        $(this).closest('.topic-card, .specification-card').addClass('animate__animated animate__fadeOut').delay(300).queue(function() {
            $(this).remove();
            // Re-number topics
            $('.topic-card').each(function(index) {
                $(this).find('.topic-number').text(index + 1);
            });
        });
    });

    // Form validation before submission
    $('#courseForm').on('submit', function(e) {
        const requiredFields = $(this).find('[required]');
        let isValid = true;
        
        // Remove existing alerts
        $('.alert-dismissible').remove();

        requiredFields.each(function() {
            const input = $(this);
            
            // Logic to determine if empty
            let isEmpty = !input.val();
            if (input.is('select') && input.next('.select2-container').length) {
                // For Select2, checking val() is usually correct, but let's be safe
                isEmpty = !input.val() || input.val().length === 0;
            }

            if (isEmpty) {
                isValid = false;
                
                // Add error class
                if (input.hasClass('select2-hidden-accessible')) {
                    // Target Select2 container
                    input.next('.select2-container').find('.selection .select2-selection').addClass('border-danger');
                } else {
                    input.addClass('is-invalid');
                }

                // Add error message if not present
                let errorTarget = input;
                if (input.hasClass('select2-hidden-accessible')) {
                    errorTarget = input.next('.select2-container');
                } else if (input.closest('.input-group').length) {
                    errorTarget = input.closest('.input-group');
                }

                if (errorTarget.next('.invalid-feedback').length === 0) {
                    $('<div class="invalid-feedback d-block client-error">This field is required.</div>').insertAfter(errorTarget);
                } else {
                    // Ensure existing feedback is visible
                    errorTarget.next('.invalid-feedback').addClass('d-block');
                }

            } else {
                // Remove error class
                if (input.hasClass('select2-hidden-accessible')) {
                    input.next('.select2-container').find('.selection .select2-selection').removeClass('border-danger');
                } else {
                    input.removeClass('is-invalid');
                }

                // Remove error message
                let errorTarget = input;
                if (input.hasClass('select2-hidden-accessible')) {
                    errorTarget = input.next('.select2-container');
                } else if (input.closest('.input-group').length) {
                    errorTarget = input.closest('.input-group');
                }
                
                errorTarget.next('.client-error').remove();
                errorTarget.next('.invalid-feedback').removeClass('d-block');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            
            // Scroll to first error
            const firstError = $('.is-invalid, .border-danger').first();
            if (firstError.length) {
                $('html, body').animate({
                    scrollTop: firstError.offset().top - 100
                }, 500);
            }
            
            // Show error alert
            const errorAlert = `
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mt-3" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="feather feather-alert-circle me-2"></i>
                        <div>
                            Please fill all required fields marked with <span class="text-danger">*</span>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            $('.card-body').prepend(errorAlert);
        }
    });
</script>
@endpush