{{-- @dd($course->paid_type); --}}
@push('meta')
    <title>
        {{ $metaTitle ?? $course->name . ' - ' . ($course->sector->name ?? 'Professional Course') . ' | ' . config('app.name') }}
    </title>

    <meta name="description"
        content="{{ $metaDescription ?? Str::limit(strip_tags($course->short_description ?? 'Professional development course'), 160) }}">
    <meta name="keywords"
        content="{{ $metaKeywords ?? $course->name . ', ' . ($course->sector->name ?? '') . ', professional course, skill development, corporate training' }}">
    <meta name="author" content="{{ $metaAuthor ?? config('app.name') }}">
    <meta name="robots" content="{{ $metaRobots ?? 'index, follow' }}">

    <!-- Canonical Tag -->
    <link rel="canonical" href="{{ $metaCanonical ?? url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:title"
        content="{{ $metaOgTitle ?? $course->name . ' - ' . ($course->sector->name ?? 'Professional Course') }}">
    <meta property="og:description"
        content="{{ $metaOgDescription ?? Str::limit(strip_tags($course->short_description ?? 'Professional development course'), 160) }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $metaOgUrl ?? url()->current() }}">
    <meta property="og:image" content="{{ $metaOgImage ?? asset($course->image ?? 'default-og.jpg') }}">
    <meta property="og:site_name" content="{{ config('app.name') }}">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title"
        content="{{ $metaTwitterTitle ?? $course->name . ' - ' . ($course->sector->name ?? 'Professional Course') }}">
    <meta name="twitter:description"
        content="{{ $metaTwitterDescription ?? Str::limit(strip_tags($course->short_description ?? 'Professional development course'), 160) }}">
    <meta name="twitter:image" content="{{ $metaTwitterImage ?? asset($course->image ?? 'default-og.jpg') }}">
    <meta name="twitter:site" content="{{ config('app.name') }}">
@endpush

@extends('layouts.web.app')
@section('content')
    <!-- Course Hero Section -->
    <section class="course-hero position-relative overflow-hidden mb-5">
        <div class="container-fluid">
            <div class="row align-items-center min-vh-50 py-5">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="hero-content pe-lg-5">
                        <div class="d-flex align-items-center gap-2 mb-3 justify-content-between">

                            {{-- Sector Badge --}}
                            <div class="badge bg-primary text-white px-3 py-2 rounded-pill d-flex align-items-center gap-1">
                                <i class="bi bi-grid-fill"></i>
                                {{ $course->sector->name ?? 'General Course' }}
                            </div>

                            {{-- Internship Badge --}}
                            <div class="badge
                                {{ $course->internship ? 'bg-success' : 'bg-secondary' }}
                                text-white px-3 py-2 rounded-pill d-flex align-items-center gap-1">
                                <i class="bi {{ $course->internship ? 'bi-check-circle' : 'bi-x-circle' }}"></i>
                                {{ $course->internship ? 'Internship Available' : 'No Internship' }}
                            </div>

                        </div>


                        <h1 class="display-5 fw-bold mb-3">{{ $course->name }}</h1>

                        <!-- Level and Languages -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <span class="text-muted">{{ $course->level ?? 'Professional Level' }}</span>
                            <span class="text-primary">
                                @php
                                    $languages = is_array($course->language) ? $course->language : [];
                                    echo count($languages) > 0
                                        ? implode(', ', array_slice($languages, 0, 2)) .
                                            (count($languages) > 2 ? ' +' . (count($languages) - 2) . ' more' : '')
                                        : 'Multiple Languages';
                                @endphp
                            </span>
                        </div>

                        <p class="text-muted mb-4">{{ $course->short_description ? Str::limit(strip_tags($course->short_description), 200) : 'No description available.' }}</p>

                        <div class="d-flex flex-wrap gap-3 mb-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-clock-fill text-primary me-2"></i>
                                <span>
                                    @if ($course->duration_number && $course->duration_unit)
                                        {{ $course->duration_number }} {{ $course->duration_unit }}
                                    @else
                                        {{ $course->duration ?? 'Flexible' }}
                                    @endif
                                </span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-people-fill text-primary me-2"></i>
                                <span>{{ ($course->enrollment_count ?? 0) }}+ Enrolled</span>
                            </div>
                           <div class="d-flex align-items-center">
                                @if ($course->paid_type->value === 'free')
                                    <span class="badge bg-success fs-6">Free</span>

                                @elseif ($course->paid_type->value === 'paid')
                                    <span class="badge bg-warning text-dark fs-6">Paid</span>

                                @else
                                    <span class="badge bg-secondary fs-6">N/A</span>
                                @endif
                            </div>

                            <div class="d-flex align-items-center">
                                <i class="bi bi-geo-alt-fill text-primary me-2"></i>
                                <span>
                                    @php
                                        $locations = is_array($course->location) ? $course->location : [];
                                        echo count($locations) > 0
                                            ? implode(', ', array_slice($locations, 0, 1)) .
                                                (count($locations) > 1 ? ' +' . (count($locations) - 1) . ' more' : '')
                                            : 'Online';
                                    @endphp
                                </span>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap gap-2">
                            <button class="btn btn-primary btn-lg px-4">Enroll Now</button>
                            <button class="btn btn-outline-primary btn-lg px-4">Share Course</button>
                        </div>
                    </div>
                </div>

                <!-- Course Image with Gallery -->
                <div class="col-lg-6">
                    <div class="course-visual">
                        <!-- Main Image -->
                        <div class="course-image-wrapper rounded-4 overflow-hidden shadow-lg mb-3">
                            <img src="{{ $course->image ? asset($course->image) : asset('resource/web/assets/media/default/default-img.png') }}"
                                 alt="{{ $course->name }}"
                                 class="img-fluid w-100"
                                 id="mainCourseImage"
                                 onerror="this.src='{{ asset('resource/web/assets/media/default/default-img.png') }}'">
                        </div>

                        <!-- Gallery Thumbnails -->
                        @if (count($course->gallery) > 0)
                            <div class="gallery-thumbnails d-flex gap-2 justify-content-center">
                                @foreach (array_slice($course->gallery, 0, 4) as $index => $galleryImage)
                                    <div class="thumbnail-wrapper position-relative">
                                        <img src="{{ asset($galleryImage) }}"
                                             alt="Gallery image {{ $index + 1 }}"
                                             class="img-thumbnail rounded-3 cursor-pointer"
                                             style="width: 80px; height: 60px; object-fit: cover;"
                                             onclick="document.getElementById('mainCourseImage').src = this.src"
                                             onerror="this.src='{{ asset('resource/web/assets/media/default/default-img.png') }}'">
                                        @if ($index === 3 && count($course->gallery) > 4)
                                            <div class="thumbnail-overlay position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 rounded-3 d-flex align-items-center justify-content-center">
                                                <span class="text-white fw-bold">+{{ count($course->gallery) - 4 }}</span>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Course Details Section -->
    <section class="course-details mb-5">
        <div class="container-fluid">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <!-- Course Tabs -->
                    <div class="card shadow-sm border-0 rounded-4 overflow-hidden mb-4">
                        <div class="card-header bg-white p-0">
                            <ul class="nav nav-tabs nav-fill border-bottom" id="courseTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active py-3" id="overview-tab" data-bs-toggle="tab"
                                        data-bs-target="#overview" type="button" role="tab">
                                        <i class="bi bi-info-circle me-2"></i>Overview
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link py-3" id="curriculum-tab" data-bs-toggle="tab"
                                        data-bs-target="#curriculum" type="button" role="tab">
                                        <i class="bi bi-journal-text me-2"></i>Curriculum
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link py-3" id="details-tab" data-bs-toggle="tab"
                                        data-bs-target="#details" type="button" role="tab">
                                        <i class="bi bi-card-checklist me-2"></i>Details
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link py-3" id="eligibility-tab" data-bs-toggle="tab"
                                        data-bs-target="#eligibility" type="button" role="tab">
                                        <i class="bi bi-person-check me-2"></i>Eligibility
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link py-3" id="gallery-tab" data-bs-toggle="tab"
                                        data-bs-target="#gallery" type="button" role="tab">
                                        <i class="bi bi-window-dock me-2"></i>Other Spacification
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body p-4">
                            <div class="tab-content" id="courseTabsContent">
                                <!-- Overview Tab -->
                                <div class="tab-pane fade show active" id="overview" role="tabpanel">
                                    <div class="course-description mb-4">
                                        @if($course->long_description)
                                            {!! $course->long_description !!}
                                        @else
                                            <div class="alert alert-info text-center py-4">
                                                <i class="bi bi-info-circle display-4 text-primary mb-3"></i>
                                                <h5>Description Not Available</h5>
                                                <p class="mb-0">Course description will be updated soon.</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Curriculum Tab -->
                                <div class="tab-pane fade" id="curriculum" role="tabpanel">
                                    @if (!empty($course->topics) && count($course->topics) > 0)
                                        <div class="accordion" id="courseCurriculum">
                                            @foreach ($course->topics as $index => $topic)
                                                @if (!empty($topic['title']) || !empty($topic['description']))
                                                    <div class="accordion-item border-0 mb-2 rounded-3 overflow-hidden">
                                                        <h2 class="accordion-header" id="heading{{ $index }}">
                                                            <button
                                                                class="accordion-button {{ $index === 0 ? '' : 'collapsed' }} bg-light shadow-none py-3"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#collapse{{ $index }}"
                                                                aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">
                                                                <div class="d-flex align-items-center w-100">
                                                                    <span class="me-3 fw-bold text-primary">{{ $index + 1 }}.</span>
                                                                    <span class="fw-medium">{{ $topic['title'] ?? 'Untitled Topic' }}</span>
                                                                    <span class="badge bg-primary ms-auto">{{ $loop->iteration }}/{{ count($course->topics) }}</span>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapse{{ $index }}"
                                                            class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                                            data-bs-parent="#courseCurriculum">
                                                            <div class="accordion-body bg-white py-3">
                                                                <p class="mb-0">
                                                                    {{ $topic['description'] ?? 'No description available.' }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="alert alert-info text-center py-4">
                                            <i class="bi bi-info-circle display-4 text-primary mb-3"></i>
                                            <h5>Curriculum Not Available</h5>
                                            <p class="mb-0">The course curriculum will be updated soon.</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Details Tab -->
                                <div class="tab-pane fade" id="details" role="tabpanel">
                                    <div class="row g-4">
                                        <!-- Course Information -->
                                        <div class="col-md-6">
                                            <h5 class="mb-3 text-primary"><i class="bi bi-info-circle me-2"></i>Course Information</h5>
                                            <div class="list-group list-group-flush">
                                                @if ($course->provider)
                                                    <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                        <span>Training Partner</span>
                                                        <span class="fw-medium">{{ $course->provider }}</span>
                                                    </div>
                                                @endif
                                                {{-- @if (!empty($course->language) && count($course->language) > 0)
                                                    <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                        <span>Language</span>
                                                        <span class="fw-medium">{{ implode(', ', $course->language) }}</span>
                                                    </div>
                                                @endif --}}
                                                @if ($course->certification_type)
                                                    <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                        <span>Certification</span>
                                                        <span class="fw-medium">{{ $course->certification_type }}</span>
                                                    </div>
                                                @endif
                                                @if ($course->assessment_mode)
                                                    <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                        <span>Assessment</span>
                                                        <span class="fw-medium">{{ $course->assessment_mode }}</span>
                                                    </div>
                                                @endif
                                                @if ($course->mode_of_study)
                                                    <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                        <span>Mode of Study</span>
                                                        <span class="fw-medium">
                                                            @switch($course->mode_of_study)
                                                                @case('1') Online @break
                                                                @case('2') Offline @break
                                                                @case('3') Hybrid @break
                                                                @case('4') Flexible @break
                                                                @default {{ $course->mode_of_study }}
                                                            @endswitch
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Program Details -->
                                        <div class="col-md-6">
                                            <h5 class="mb-3 text-primary"><i class="bi bi-gear me-2"></i>Program Details</h5>
                                            <div class="list-group list-group-flush">
                                                @if ($course->program_by)
                                                    <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                        <span>Program By</span>
                                                        <span class="fw-medium">{{ $course->program_by }}</span>
                                                    </div>
                                                @endif
                                                @if ($course->initiative_of)
                                                    <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                        <span>Initiative Of</span>
                                                        <span class="fw-medium">{{ $course->initiative_of }}</span>
                                                    </div>
                                                @endif
                                                @if ($course->domain)
                                                    <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                        <span>Domain</span>
                                                        <span class="fw-medium">{{ $course->domain }}</span>
                                                    </div>
                                                @endif
                                                @if ($course->course_code)
                                                    <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                        <span>Course Code</span>
                                                        <span class="fw-medium">{{ $course->course_code }}</span>
                                                    </div>
                                                @endif
                                                @if ($course->nsqf_level)
                                                    <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                        <span>NSQF Level</span>
                                                        <span class="fw-medium">{{ $course->nsqf_level }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Locations -->
                                        @if (!empty($course->location) && count($course->location) > 0)
                                            <div class="col-md-6">
                                                <h5 class="mb-3 text-primary"><i class="bi bi-geo-alt me-2"></i>Available Locations</h5>
                                                <div class="d-flex flex-wrap gap-2">
                                                    @foreach ($course->location as $location)
                                                        <span class="badge bg-primary px-3 py-2">{{ $location }}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                        <!-- language -->
                                        @if (!empty($course->language) && count($course->language) > 0)
                                         <div class="col-md-6">
                                            <h5 class="mb-3 text-primary"><i class="bi bi-translate me-2"></i>Available language</h5>
                                                <div class="d-flex flex-wrap gap-2">
                                                    @foreach ($course->language as $lang)
                                                        <span class="badge bg-primary px-3 py-2">{{ $lang }}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Eligibility Tab -->
                                <div class="tab-pane fade" id="eligibility" role="tabpanel">
                                    <div class="row g-4">
                                        @if ($course->required_age)
                                            <div class="col-md-6">
                                                <div class="card border-0 bg-light h-100">
                                                    <div class="card-body text-center p-4">
                                                        <i class="bi bi-calendar-check display-4 text-primary mb-3"></i>
                                                        <h5>Required Age</h5>
                                                        <p class="mb-0 fw-medium">{{ $course->required_age }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if (!empty($course->minimum_education) && count($course->minimum_education) > 0)
                                            <div class="col-md-6">
                                                <div class="card border-0 bg-light h-100">
                                                    <div class="card-body text-center p-4">
                                                        <i class="bi bi-mortarboard display-4 text-primary mb-3"></i>
                                                        <h5>Minimum Education</h5>
                                                        <p class="mb-0 fw-medium">{{ implode(', ', $course->minimum_education) }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if (!empty($course->learning_tools) && count($course->learning_tools) > 0)
                                            <div class="col-md-6">
                                                <div class="card border-0 bg-light h-100">
                                                    <div class="card-body text-center p-4">
                                                        <i class="bi bi-tools display-4 text-primary mb-3"></i>
                                                        <h5>Learning Tools</h5>
                                                        <p class="mb-0 fw-medium">{{ implode(', ', $course->learning_tools) }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <!-- Other Specifications -->
                                        @if (!empty($course->other_specifications) && count($course->other_specifications) > 0)
                                            @foreach ($course->other_specifications as $spec)
                                                @if (!empty($spec['label']) && !empty($spec['description']))
                                                    <div class="col-md-6">
                                                        <div class="card border-0 bg-light h-100">
                                                            <div class="card-body text-center p-4">
                                                                <i class="bi bi-list-check display-4 text-primary mb-3"></i>
                                                                <h5>{{ $spec['label'] }}</h5>
                                                                <p class="mb-0 fw-medium">{{ $spec['description'] }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>

                                    @if (!$course->required_age &&
                                         empty($course->minimum_education) &&
                                         !$course->industry_experience_years &&
                                         empty($course->learning_tools) &&
                                         empty($course->other_specifications))
                                        <div class="alert alert-info text-center py-4">
                                            <i class="bi bi-info-circle display-4 text-primary mb-3"></i>
                                            <h5>No Specific Eligibility Requirements</h5>
                                            <p class="mb-0">This course is open to all interested learners.</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Specifications Tab -->
                                <div class="tab-pane fade" id="gallery" role="tabpanel">
                                   <!-- Other Specifications - Card Layout -->
                                    @if (!empty($course->other_specifications) && count($course->other_specifications) > 0)
                                        @foreach ($course->other_specifications as $spec)
                                            @if (!empty($spec['label']) && !empty($spec['description']))
                                                <div class="col-md-6">
                                                    <div class="card border-0 bg-light h-100">
                                                        <div class="card-body p-4">
                                                            <div class="specification-item">
                                                                <div class="d-flex align-items-center mb-2">
                                                                    <i class="bi bi-tag-fill text-primary me-2"></i>
                                                                    <h6 class="mb-0 fw-bold text-primary">{{ $spec['label'] }}</h6>
                                                                </div>
                                                                <p class="mb-0 text-muted">
                                                                    <i class="bi bi-dash-lg text-secondary me-1"></i>
                                                                    {{ $spec['description'] }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Course Highlights -->
                    <div class="card shadow-sm border-0 rounded-4 overflow-hidden mb-4">
                        <div class="card-header bg-light py-3">
                            <h5 class="mb-0"><i class="bi bi-star me-2"></i>Course Highlights</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                @if ($course->provider)
                                    <div class="list-group-item d-flex align-items-center">
                                        <i class="bi bi-building text-primary me-3 fs-5"></i>
                                        <div>
                                            <h6 class="mb-0">Training Partner</h6>
                                            <small class="text-muted">{{ $course->provider }}</small>
                                        </div>
                                    </div>
                                @endif

                                @if ($course->certification_type)
                                    <div class="list-group-item d-flex align-items-center">
                                        <i class="bi bi-award text-primary me-3 fs-5"></i>
                                        <div>
                                            <h6 class="mb-0">Certification</h6>
                                            <small class="text-muted">{{ $course->certification_type }}</small>
                                        </div>
                                    </div>
                                @endif

                                @if ($course->duration_number && $course->duration_unit)
                                    <div class="list-group-item d-flex align-items-center">
                                        <i class="bi bi-clock text-primary me-3 fs-5"></i>
                                        <div>
                                            <h6 class="mb-0">Duration</h6>
                                            <small class="text-muted">{{ $course->duration_number }} {{ $course->duration_unit }}</small>
                                        </div>
                                    </div>
                                @endif

                                @if ($course->paid_type)
                                    <div class="list-group-item d-flex align-items-center">
                                        <i class="bi bi-currency-dollar text-primary me-3 fs-5"></i>
                                        <div>
                                            <h6 class="mb-0">Pricing</h6>
                                            <small class="text-muted">
                                                @if ($course->paid_type == 'free')
                                                    Free Course
                                                @elseif($course->paid_type == 'paid')
                                                    Paid Course
                                                @else
                                                    Not Applicable
                                                @endif
                                            </small>
                                        </div>
                                    </div>
                                @endif

                                @if ($course->internship)
                                    <div class="list-group-item d-flex align-items-center">
                                        <i class="bi bi-briefcase text-primary me-3 fs-5"></i>
                                        <div>
                                            <h6 class="mb-0">Internship</h6>
                                            <small class="text-muted">Included</small>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Enquiry Form -->
                    <div class="card shadow-sm border-0 rounded-4 overflow-hidden mb-4">
                        <div class="card-header text-white py-3">
                            <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Request Information</h5>
                        </div>
                        <div class="card-body p-4">
                            <form class="needs-validation" action="{{ route('web.enquiry') }}" method="POST" novalidate>
                                @csrf
                                <input type="hidden" name="type" value="7">
                                <input type="hidden" name="course_name" value="{{ $course->name }}">

                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter your full name" required minlength="2" maxlength="255">
                                    <div class="invalid-feedback">Please provide a valid name (2-255 characters).</div>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Enter your email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                                    <div class="invalid-feedback">Please provide a valid email address.</div>
                                </div>

                                <div class="mb-3">
                                    <label for="mobile" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" id="mobile" name="mobile"
                                        placeholder="Enter your phone number" required pattern="[0-9]{10,15}">
                                    <div class="invalid-feedback">Please provide a valid phone number (10-15 digits).</div>
                                </div>

                                <div class="mb-3">
                                    <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="message" name="message" rows="3" placeholder="Enter your message"
                                        required maxlength="1000"></textarea>
                                    <div class="invalid-feedback">Please enter your message (max 1000 characters).</div>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 py-2">
                                    <i class="bi bi-send me-2"></i>Submit Enquiry
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Banners Section -->
                    @if($banners->isNotEmpty())
                    <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                        <div class="card-header bg-primary text-white py-3">
                            <h4 class="mb-0"><i class="bi bi-images me-2"></i>Featured Banners</h4>
                        </div>
                        <div class="card-body p-0">
                            <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach($banners as $index => $banner)
                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                            <img src="{{ asset($banner->image) }}"
                                                 class="d-block w-100"
                                                 alt="Banner {{ $index + 1 }}"
                                                 style="height: 200px; object-fit: cover;"
                                                 onerror="this.src='{{ asset('resource/web/assets/media/default/default-img.png') }}'">
                                        </div>
                                    @endforeach
                                </div>
                                @if($banners->count() > 1)
                                    <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    {{-- Other related Course --}}
    <!-- Related Courses Carousel -->
<!-- Related Courses Section -->
<div class="blog-sec mt-80 mb-5">
    <div class="container-fluid">
        <div class="heading mb-10 text-start">
            <div class="tagblock mb-16">
                <img src="{{ asset('resource/web/assets/media/hero/buld-vec.png') }}" class="bulb-vec" alt="">
                <p class="black">Related Courses</p>
            </div>
            <h3 class="fw-bold mt-2 mb-2">Explore More <span class="color-primary">Courses</span></h3>
            <p class="cds-119 css-lg65q1 cds-121">Discover other courses in the same field to enhance your skills</p>
        </div>

        <!-- Swiper -->
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @if ($relatedCourses->isEmpty())
                    <div class="w-100">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>No related courses found.</strong> Please check back later.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @else
                    @foreach ($relatedCourses as $course)
                        <!-- Slide -->
                        <div class="swiper-slide" data-swiper-autoplay="2000">
                            <div class="blog-card">
                                <a href="{{ route('web.course.show', $course->slug) }}" class="card-img">
                                    <img src="{{ $course->image ? asset($course->image) : asset('resource/web/assets/media/default/default-img.png') }}"
                                         alt="{{ $course->name }}"
                                         onerror="this.src='{{ asset('resource/web/assets/media/default/default-img.png') }}'">
                                    <span class="date-block">
                                        <span class="h6 fw-400 light-black">
                                            @if($course->paid_type == 'free')
                                                FREE
                                            @else
                                                PAID
                                            @endif
                                        </span>
                                        <span class="h6 fw-400 light-black">{{ $course->level }}</span>
                                    </span>
                                </a>
                                <div class="card-content">
                                    <a href="{{ route('web.course.show', $course->slug) }}" class="h6 fw-500 mb-8">
                                        {{ $course->name }}
                                    </a>
                                    <p class="light-gray mb-24">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($course->short_description), 100) }}
                                    </p>
                                    <div class="course-meta d-flex justify-content-between align-items-center mb-3">
                                        <span class="text-muted small">
                                            <i class="bi bi-clock me-1"></i>
                                            @if($course->duration_number && $course->duration_unit)
                                                {{ $course->duration_number }} {{ $course->duration_unit }}
                                            @else
                                                Flexible
                                            @endif
                                        </span>
                                        <span class="text-muted small">
                                            <i class="bi bi-people me-1"></i>
                                            {{ $course->enrollment_count ?? 0 }}
                                        </span>
                                    </div>
                                    <a href="{{ route('web.course.show', $course->slug) }}" class="card-btn">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </div>
</div>
    <!-- Gallery Modal -->
    @if (count($course->gallery) > 0)
        <div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0">
                    <div class="modal-header border-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center p-0">
                        <img id="modalGalleryImage" src="" alt="Gallery image" class="img-fluid rounded-3">
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@push('scripts')
    <script>
        // Form validation
        (function() {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })

            // Mobile number sanitization
            document.querySelectorAll('input[name="mobile"]').forEach(function(input) {
                input.addEventListener('input', function() {
                    this.value = this.value.replace(/[^0-9]/g, '');
                });
            });
        })()

        // Gallery modal function
        function openGalleryModal(imageSrc) {
            document.getElementById('modalGalleryImage').src = imageSrc;
        }

        // Auto-rotate banners every 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            var bannerCarousel = document.getElementById('bannerCarousel');
            if (bannerCarousel) {
                var carousel = new bootstrap.Carousel(bannerCarousel, {
                    interval: 5000,
                    wrap: true
                });
            }
        });
    </script>
@endpush
