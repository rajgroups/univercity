@push('meta')
    <title>{{ $course->course_title ?? 'International Course' }} - ISICO</title>
    <meta name="description" content="{{ Str::limit(strip_tags($course->short_description ?? ''), 150) }}">
    <meta name="keywords" content="{{ $course->seo_keywords ?? 'international course, study abroad, education' }}">
    <meta name="author" content="ISICO">
    <meta name="robots" content="index, follow">

    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:title" content="{{ $course->course_title ?? 'International Course' }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($course->short_description ?? ''), 150) }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset($course->thumbnail_image ?? 'default.jpg') }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $course->course_title ?? 'International Course' }}">
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($course->short_description ?? ''), 150) }}">
    <meta name="twitter:image" content="{{ asset($course->thumbnail_image ?? 'default.jpg') }}">
@endpush

@extends('layouts.web.app')
@section('content')
    <!-- Hero Banner -->
    <section class="sm-title-banner py-5 py-lg-120 mb-5 mb-lg-120"
        style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('{{ asset($course->thumbnail_image ?? 'default-course-banner.jpg') }}') center/cover no-repeat;">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-12 col-lg-8 mb-4 mb-lg-0">
                    <div class="text-white">
                        <span class="badge bg-warning text-dark mb-3">{{ $course->pathway_type ?? 'International Course' }}</span>
                        <h1 class="fw-bold mb-3 display-6 display-lg-5 text-shadow text-white">{{ $course->course_title }}</h1>
                        <p class="lead mb-4 text-shadow text-white">{{ $course->short_description }}</p>

                        <div class="d-flex flex-wrap align-items-center gap-3 gap-lg-4 text-white">
                            <div class="d-flex align-items-center gap-2 bg-dark bg-opacity-50 px-2 px-lg-3 py-1 py-lg-2 rounded-pill">
                                <i class="bi bi-geo-alt-fill text-warning fs-6"></i>
                                <span class="small fw-medium">{{ $course->country->name ?? 'Multiple Locations' }}</span>
                            </div>
                            <div class="d-flex align-items-center gap-2 bg-dark bg-opacity-50 px-2 px-lg-3 py-1 py-lg-2 rounded-pill">
                                <i class="bi bi-clock-fill text-warning fs-6"></i>
                                <span class="small fw-medium">{{ $course->total_duration ?? 'Flexible Duration' }}</span>
                            </div>
                            <div class="d-flex align-items-center gap-2 bg-dark bg-opacity-50 px-2 px-lg-3 py-1 py-lg-2 rounded-pill">
                                <i class="bi bi-mortarboard-fill text-warning fs-6"></i>
                                <span class="small fw-medium">{{ $course->category->name ?? 'Professional' }}</span>
                            </div>
                            <div class="d-flex align-items-center gap-2 bg-dark bg-opacity-50 px-2 px-lg-3 py-1 py-lg-2 rounded-pill">
                                <i class="bi bi-building-fill text-warning fs-6"></i>
                                <span class="small fw-medium">{{ $course->overseas_partner_institution }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="bg-white rounded-3 p-3 p-lg-4 shadow-lg">
                        <h5 class="fw-bold mb-3">Quick Details</h5>

                        <div class="d-flex justify-content-between align-items-center mb-2 py-1">
                            <span class="text-muted small">Course Code:</span>
                            <span class="fw-bold text-primary small">{{ $course->course_code }}</span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-2 py-1">
                            <span class="text-muted small">Pathway Type:</span>
                            <span class="fw-bold small">{{ $course->pathway_type }}</span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-2 py-1">
                            <span class="text-muted small">Language:</span>
                            <span class="fw-bold small">
                                @if($course->language_of_instruction)
                                    {{ implode(', ', $course->language_of_instruction) }}
                                @else
                                    English
                                @endif
                            </span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-2 py-1">
                            <span class="text-muted small">Study Mode:</span>
                            <span class="fw-bold small">
                                @if($course->mode_of_study)
                                    {{ implode(', ', $course->mode_of_study) }}
                                @else
                                    Flexible
                                @endif
                            </span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3 py-1">
                            <span class="text-muted small">Fee Type:</span>
                            <span class="badge {{ $course->paid_type == 'Free' ? 'bg-success' : 'bg-warning text-dark' }} small">
                                {{ $course->paid_type }}
                            </span>
                        </div>

                        <button class="btn btn-primary w-100 btn-lg">Enroll Now</button>
                        <button class="btn btn-outline-primary w-100 mt-2">Download Brochure</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container mt-4 mt-lg-5">
        <div class="row g-4 g-lg-5">
            <!-- Left Content -->
            <div class="col-12 col-lg-8">
                <!-- Course Gallery -->
                @if($course->gallery_images && count($course->gallery_images) > 0)
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-3 p-lg-4">
                        <h3 class="card-title fw-bold mb-3 mb-lg-4">Course Gallery</h3>
                        <div class="row g-3">
                            @foreach($course->gallery_images as $image)
                            <div class="col-6 col-md-4 col-lg-3">
                                <a href="{{ asset($image) }}" data-lightbox="gallery" data-title="{{ $course->course_title }}">
                                    <img src="{{ asset($image) }}" alt="Gallery Image {{ $loop->iteration }}" class="img-fluid rounded shadow-sm" style="height: 120px; width: 100%; object-fit: cover;">
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <!-- Course Overview -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-3 p-lg-4">
                        <h3 class="card-title fw-bold mb-3 mb-lg-4">
                            <i class="bi bi-info-circle-fill text-primary me-2"></i>
                            Course Overview
                        </h3>

                        <div class="row g-4">
                            <!-- Admission Provider -->
                            <div class="col-12 col-sm-6">
                                <div class="d-flex align-items-start p-3 border rounded-3 h-100 bg-light">
                                    <div class="flex-shrink-0 me-3">
                                        <i class="bi bi-building-check text-primary fs-4"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="fw-bold mb-2 text-primary">Admission Provider</h6>
                                        <p class="mb-0 fs-5 fw-semibold">{{ $course->admission_provider }}</p>
                                        <small class="text-muted">Primary course provider</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Partner Institution -->
                            <div class="col-12 col-sm-6">
                                <div class="d-flex align-items-start p-3 border rounded-3 h-100 bg-light">
                                    <div class="flex-shrink-0 me-3">
                                        <i class="bi bi-handshake text-success fs-4"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="fw-bold mb-2 text-success">Partner Institution</h6>
                                        <p class="mb-0 fs-5 fw-semibold">{{ $course->overseas_partner_institution }}</p>
                                        <small class="text-muted">Overseas educational partner</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Accreditation -->
                            @if($course->accreditation_recognition)
                            <div class="col-12 col-sm-6">
                                <div class="d-flex align-items-start p-3 border rounded-3 h-100 bg-light">
                                    <div class="flex-shrink-0 me-3">
                                        <i class="bi bi-award text-warning fs-4"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="fw-bold mb-2 text-warning">Accreditation</h6>
                                        <p class="mb-0 fs-5 fw-semibold">{{ $course->accreditation_recognition }}</p>
                                        <small class="text-muted">Official recognition & approval</small>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- Certification Type -->
                            <div class="col-12 col-sm-6">
                                <div class="d-flex align-items-start p-3 border rounded-3 h-100 bg-light">
                                    <div class="flex-shrink-0 me-3">
                                        <i class="bi bi-file-earmark-medical text-info fs-4"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="fw-bold mb-2 text-info">Certification</h6>
                                        <p class="mb-0 fs-5 fw-semibold">{{ $course->certification_type }}</p>
                                        <small class="text-muted">Award upon completion</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Additional Course Information -->
                            <div class="col-12">
                                <div class="row g-3">
                                    <!-- Course Level -->
                                    @if($course->category)
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <div class="d-flex align-items-center p-2 bg-success bg-opacity-10 rounded">
                                            <i class="bi bi-diagram-3 text-primary me-2"></i>
                                            <div>
                                                <small class="text-muted d-block">Course Level</small>
                                                <span class="fw-semibold">{{ $course->category->name }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    <!-- Sector -->
                                    @if($course->sector)
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <div class="d-flex align-items-center p-2 bg-success bg-opacity-10 rounded">
                                            <i class="bi bi-grid-3x3 text-success me-2"></i>
                                            <div>
                                                <small class="text-muted d-block">Industry Sector</small>
                                                <span class="fw-semibold">{{ $course->sector->name }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    <!-- Destination Country -->
                                    @if($course->country)
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <div class="d-flex align-items-center p-2 bg-warning bg-opacity-10 rounded">
                                            <i class="bi bi-globe-americas text-warning me-2"></i>
                                            <div>
                                                <small class="text-muted d-block">Destination</small>
                                                <span class="fw-semibold">{{ $course->country->name }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    <!-- Pathway Type -->
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <div class="d-flex align-items-center p-2 bg-info bg-opacity-10 rounded">
                                            <i class="bi bi-signpost-2 text-info me-2"></i>
                                            <div>
                                                <small class="text-muted d-block">Pathway Type</small>
                                                <span class="fw-semibold">{{ $course->pathway_type }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Study Mode -->
                                    @if($course->mode_of_study)
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <div class="d-flex align-items-center p-2 bg-info bg-opacity-10 rounded">
                                            <i class="bi bi-laptop text-purple me-2"></i>
                                            <div>
                                                <small class="text-muted d-block">Study Mode</small>
                                                <span class="fw-semibold">{{ implode(', ', $course->mode_of_study) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    <!-- Language -->
                                    @if($course->language_of_instruction)
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <div class="d-flex align-items-center p-2 bg-danger bg-opacity-10 rounded">
                                            <i class="bi bi-translate text-danger me-2"></i>
                                            <div>
                                                <small class="text-muted d-block">Language</small>
                                                <span class="fw-semibold">{{ implode(', ', $course->language_of_instruction) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Intake Information -->
                        @if($course->intake_months && count($course->intake_months) > 0)
                        <div class="mt-4 pt-4 border-top">
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-calendar-event text-success fs-4 me-2"></i>
                                <h5 class="fw-bold mb-0 text-success">Available Intakes</h5>
                            </div>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($course->intake_months as $month)
                                <span class="badge bg-success bg-opacity-20 text-success border border-success text-white">
                                    <i class="bi bi-calendar-check me-1"></i>
                                    {{ $month }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <style>
                .bg-purple {
                    background-color: #6f42c1 !important;
                }
                .text-purple {
                    color: #6f42c1 !important;
                }
                </style>
                <!-- Key Information Tabs -->
                <div class="card shadow-sm border-0">
                    <div class="card-body p-3 p-lg-4">
                        <ul class="nav nav-pills flex-nowrap overflow-auto pb-2 mb-3 mb-lg-4" id="courseTabs" role="tablist" style="scrollbar-width: none; -ms-overflow-style: none;">
                            <li class="nav-item flex-shrink-0" role="presentation">
                                <button class="nav-link active small" id="topics-tab" data-bs-toggle="pill" data-bs-target="#topics" type="button">Curriculum</button>
                            </li>
                            <li class="nav-item flex-shrink-0" role="presentation">
                                <button class="nav-link small" id="eligibility-tab" data-bs-toggle="pill" data-bs-target="#eligibility" type="button">Eligibility</button>
                            </li>
                            <li class="nav-item flex-shrink-0" role="presentation">
                                <button class="nav-link small" id="fees-tab" data-bs-toggle="pill" data-bs-target="#fees" type="button">Fees & Duration</button>
                            </li>
                            <li class="nav-item flex-shrink-0" role="presentation">
                                <button class="nav-link small" id="career-tab" data-bs-toggle="pill" data-bs-target="#career" type="button">Career Outcomes</button>
                            </li>
                        </ul>

                        <div class="tab-content" id="courseTabsContent">
                            <!-- Curriculum Tab -->
                            <div class="tab-pane fade show active" id="topics" role="tabpanel">
                                @if($course->topics_syllabus && count($course->topics_syllabus) > 0)
                                    <div class="accordion" id="topicsAccordion">
                                        @foreach($course->topics_syllabus as $index => $topic)
                                            <div class="accordion-item border-0 mb-2">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed bg-light py-3" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#topic{{ $index }}">
                                                        <i class="bi bi-bookmark-plus-fill text-primary me-2"></i>
                                                        <span class="text-start">{{ $topic['module_title'] ?? 'Module ' . ($index + 1) }}</span>
                                                    </button>
                                                </h2>
                                                <div id="topic{{ $index }}" class="accordion-collapse collapse"
                                                    data-bs-parent="#topicsAccordion">
                                                    <div class="accordion-body py-3">
                                                        {{ $topic['outline'] ?? 'No description available.' }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-4">
                                        <i class="bi bi-journal-x display-1 text-muted"></i>
                                        <p class="text-muted mt-3">Curriculum details coming soon.</p>
                                    </div>
                                @endif
                            </div>

                            <!-- Eligibility Tab -->
                            <div class="tab-pane fade" id="eligibility" role="tabpanel">
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="card border-0 bg-light h-100 hover-card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-start">
                                                    <div class="flex-shrink-0 me-3">
                                                        <i class="bi bi-calendar2-check text-primary fs-4"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="fw-bold mb-1">Minimum Age</h6>
                                                        <p class="mb-0 text-muted">{{ $course->minimum_age ?? 'Not specified' }}+ Years</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="card border-0 bg-light h-100 hover-card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-start">
                                                    <div class="flex-shrink-0 me-3">
                                                        <i class="bi bi-mortarboard text-success fs-4"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="fw-bold mb-1">Minimum Education</h6>
                                                        <p class="mb-0 text-muted">{{ $course->minimum_education ?? 'Not specified' }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="card border-0 bg-light h-100 hover-card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-start">
                                                    <div class="flex-shrink-0 me-3">
                                                        <i class="bi bi-briefcase text-warning fs-4"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="fw-bold mb-1">Work Experience</h6>
                                                        <p class="mb-0 text-muted">
                                                            {{ $course->work_experience_required ? ($course->work_experience_details ?? 'Required') : 'Not Required' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="card border-0 bg-light h-100 hover-card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-start">
                                                    <div class="flex-shrink-0 me-3">
                                                        <i class="bi bi-translate text-info fs-4"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="fw-bold mb-1">Language Proficiency</h6>
                                                        <p class="mb-0 text-muted">{{ $course->language_proficiency ?? 'Not specified' }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Fees & Duration Tab -->
                            <div class="tab-pane fade" id="fees" role="tabpanel">
                                <div class="row">
                                    <!-- Overseas Duration -->
                                    <div class="col-12 col-sm-6 mb-4">
                                        <div class="d-flex align-items-start p-3 border rounded-3 h-100 bg-light">
                                            <div class="flex-shrink-0 me-3">
                                                <i class="bi bi-airplane-engines text-primary fs-4"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="fw-bold mb-2 text-primary">Overseas Duration</h6>
                                                <p class="mb-0 fs-5 fw-semibold">{{ $course->course_duration_overseas }}</p>
                                                <small class="text-muted">Study abroad period</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Total Duration -->
                                    <div class="col-12 col-sm-6 mb-4">
                                        <div class="d-flex align-items-start p-3 border rounded-3 h-100 bg-light">
                                            <div class="flex-shrink-0 me-3">
                                                <i class="bi bi-calendar-range text-success fs-4"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="fw-bold mb-2 text-success">Total Duration</h6>
                                                <p class="mb-0 fs-5 fw-semibold">{{ $course->total_duration }}</p>
                                                <small class="text-muted">Complete program timeline</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Internship Duration -->
                                    @if($course->internship_included)
                                    <div class="col-12 col-sm-6 mb-4">
                                        <div class="d-flex align-items-start p-3 border rounded-3 h-100 bg-light">
                                            <div class="flex-shrink-0 me-3">
                                                <i class="bi bi-briefcase-fill text-warning fs-4"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="fw-bold mb-2 text-warning">Internship</h6>
                                                <p class="mb-0 fs-5 fw-semibold">{{ $course->internship_duration ?? 'Included' }}</p>
                                                <small class="text-muted">Practical work experience</small>
                                                @if($course->internship_summary)
                                                <div class="mt-2">
                                                    <small class="text-muted">{{ $course->internship_summary }}</small>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    <!-- Local Training -->
                                    @if($course->local_training)
                                    <div class="col-12 col-sm-6 mb-4">
                                        <div class="d-flex align-items-start p-3 border rounded-3 h-100 bg-light">
                                            <div class="flex-shrink-0 me-3">
                                                <i class="bi bi-house-check-fill text-info fs-4"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="fw-bold mb-2 text-info">Local Training</h6>
                                                <p class="mb-0 fs-5 fw-semibold">{{ $course->local_training_duration ?? 'Included' }}</p>
                                                <small class="text-muted">Pre-departure preparation</small>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    <!-- Total Fees -->
                                    @if($course->total_fees)
                                    <div class="col-12 mb-4">
                                        <div class="d-flex align-items-start p-4 border rounded-3 bg-white shadow-sm">
                                            <div class="flex-shrink-0 me-3">
                                                <i class="bi bi-currency-dollar text-danger fs-2"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="fw-bold mb-2 text-danger">Total Program Fees</h6>
                                                <p class="mb-2 fs-3 fw-bold text-danger">{{ $course->total_fees }}</p>
                                                <small class="text-muted">All inclusive program cost</small>

                                                <!-- Fee Breakdown -->
                                                @if($course->overseas_fee_breakdown && count($course->overseas_fee_breakdown) > 0)
                                                <div class="mt-3 pt-3 border-top">
                                                    <h6 class="fw-semibold mb-2 small">Overseas Fee Breakdown:</h6>
                                                    <div class="row">
                                                        @foreach($course->overseas_fee_breakdown as $fee)
                                                        <div class="col-12 col-sm-6 mb-2">
                                                            <div class="d-flex justify-content-between">
                                                                <span class="small text-muted">{{ $fee['label'] }}:</span>
                                                                <span class="small fw-semibold">{{ $fee['amount'] }} {{ $fee['currency'] ?? 'USD' }}</span>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                @endif

                                                @if($course->local_training_fee && count($course->local_training_fee) > 0)
                                                <div class="mt-2">
                                                    <h6 class="fw-semibold mb-2 small">Local Training Fees:</h6>
                                                    <div class="row">
                                                        @foreach($course->local_training_fee as $fee)
                                                        <div class="col-12 col-sm-6 mb-2">
                                                            <div class="d-flex justify-content-between">
                                                                <span class="small text-muted">{{ $fee['label'] }}:</span>
                                                                <span class="small fw-semibold">{{ $fee['amount'] }} {{ $fee['currency'] ?? 'USD' }}</span>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    <!-- Financial Assistance Section -->
                                    <div class="col-12">
                                        <div class="row">
                                            <!-- Scholarship -->
                                            @if($course->scholarship_available)
                                            <div class="col-12 col-sm-6 mb-4">
                                                <div class="d-flex align-items-start p-3 border rounded-3 h-100 bg-success bg-opacity-10">
                                                    <div class="flex-shrink-0 me-3">
                                                        <i class="bi bi-award-fill text-success fs-4"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="fw-bold mb-2 text-success">Scholarship Available</h6>
                                                        @if($course->scholarship_notes)
                                                        <p class="mb-2 small">{{ $course->scholarship_notes }}</p>
                                                        @else
                                                        <p class="mb-2 small">Financial support options available for eligible students</p>
                                                        @endif
                                                        <span class="badge bg-success">Eligibility Based</span>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                            <!-- Loan Assistance -->
                                            @if($course->bank_loan_assistance)
                                            <div class="col-12 col-sm-6 mb-4">
                                                <div class="d-flex align-items-start p-3 border rounded-3 h-100 bg-info bg-opacity-10">
                                                    <div class="flex-shrink-0 me-3">
                                                        <i class="bi bi-bank text-info fs-4"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="fw-bold mb-2 text-info">Loan Assistance</h6>
                                                        @if($course->loan_assistance_notes)
                                                        <p class="mb-2 small">{{ $course->loan_assistance_notes }}</p>
                                                        @else
                                                        <p class="mb-2 small">Bank loan facilitation support available</p>
                                                        @endif
                                                        <span class="badge bg-info">Easy Financing</span>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Living Costs -->
                                    @if($course->living_costs && count($course->living_costs) > 0)
                                    <div class="col-12 mt-3">
                                        <div class="card border-0 bg-light">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-3">
                                                    <i class="bi bi-house-heart text-purple fs-4 me-2"></i>
                                                    <h6 class="fw-bold mb-0 text-purple">Monthly Living Costs (Approx.)</h6>
                                                </div>
                                                <div class="row">
                                                    @foreach($course->living_costs as $cost)
                                                    <div class="col-12 col-sm-6 col-md-4 mb-2">
                                                        <div class="d-flex justify-content-between align-items-center p-2 bg-white rounded">
                                                            <span class="small text-muted">{{ $cost['label'] }}:</span>
                                                            <span class="small fw-semibold">{{ $cost['amount'] }} {{ $cost['currency'] ?? 'USD' }}</span>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <small class="text-muted mt-2 d-block">*Costs may vary based on lifestyle and location</small>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <!-- Career Outcomes Tab -->
                            <div class="tab-pane fade" id="career" role="tabpanel">
                                @if($course->career_outcomes && count($course->career_outcomes) > 0)
                                    <div class="mb-4">
                                        <h6 class="fw-bold mb-3">Career Opportunities</h6>
                                        <div class="row">
                                            @foreach($course->career_outcomes as $outcome)
                                                <div class="col-12 col-sm-6 mb-2">
                                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                                    <span class="small">{{ $outcome }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                @if($course->next_pathways && count($course->next_pathways) > 0)
                                    <div class="mb-4">
                                        <h6 class="fw-bold mb-3">Further Education Pathways</h6>
                                        <div class="row">
                                            @foreach($course->next_pathways as $pathway)
                                                <div class="col-12 mb-2">
                                                    <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i>
                                                    <span class="small">{{ $pathway }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Information -->
                @if($course->visa_notes || $course->accommodation_notes)
                <div class="card shadow-sm border-0 mt-4">
                    <div class="card-body p-3 p-lg-4">
                        <h4 class="fw-bold mb-3 mb-lg-4">Support Services</h4>

                        <div class="row">
                            @if($course->visa_support_included && $course->visa_notes)
                            <div class="col-12 mb-4">
                                <h5 class="fw-semibold mb-2 mb-lg-3">
                                    <i class="bi bi-passport text-primary me-2"></i>Visa Support
                                </h5>
                                <div class="bg-light p-3 p-lg-4 rounded">
                                    {!! $course->visa_notes !!}
                                </div>
                            </div>
                            @endif

                            @if($course->accommodation_support && $course->accommodation_notes)
                            <div class="col-12">
                                <h5 class="fw-semibold mb-2 mb-lg-3">
                                    <i class="bi bi-house-door text-success me-2"></i>Accommodation Support
                                </h5>
                                <div class="bg-light p-3 p-lg-4 rounded">
                                    {!! $course->accommodation_notes !!}
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
                <!-- Course Details -->
                <div class="mt-4 pt-4 border-top">
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-journal-text text-secondary fs-4 me-2"></i>
                        <h5 class="fw-bold mb-0 text-secondary">Detailed Course Description</h5>
                    </div>
                    <div class="bg-light p-4 rounded-3">
                        {!! $course->course_details !!}
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-12 col-lg-4">
                <!-- Contact Form -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-3 p-lg-4">
                        <h5 class="card-title fw-bold mb-3">Request Information</h5>
                        <form class="search-form" action="{{ route('web.enquiry') }}" method="POST" novalidate>
                            @csrf
                            <input type="hidden" name="type" value="7">
                            <input type="hidden" name="course_name" value="{{ $course->course_title }}">

                            <div class="mb-3">
                                <input type="text" class="form-control form-control-sm" name="name" placeholder="Your Name" required>
                            </div>

                            <div class="mb-3">
                                <input type="email" class="form-control form-control-sm" name="email" placeholder="Your Email">
                            </div>

                            <div class="mb-3">
                                <input type="tel" class="form-control form-control-sm" name="mobile" placeholder="Phone Number" required>
                            </div>

                            <div class="mb-3">
                                <textarea class="form-control form-control-sm" name="message" rows="3" placeholder="Your Message" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 btn-sm">Submit Enquiry</button>
                        </form>
                    </div>
                </div>

                <!-- Course Brochures -->
                @if($course->course_brochures && count($course->course_brochures) > 0)
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-3 p-lg-4">
                        <h5 class="card-title fw-bold mb-3">Download Brochures</h5>
                        @foreach($course->course_brochures as $brochure)
                        <div class="d-flex align-items-center justify-content-between mb-2 p-2 bg-light rounded">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-file-earmark-pdf text-danger me-2"></i>
                                <span class="small">{{ $brochure['document_name'] ?? 'Brochure' }}</span>
                            </div>
                            <a href="{{ asset($brochure['file_path']) }}" class="btn btn-sm btn-outline-primary" download>
                                <i class="bi bi-download"></i>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Related Courses Section -->
    @if($otherCourses->count() > 0)
    <section class="blog-sec mt-80 mb-5">
        <div class="container-fluid">
            <div class="heading mb-10 text-start">
                <div class="tagblock mb-16">
                    <img src="{{ asset('resource/web/assets/media/hero/buld-vec.png') }}" class="bulb-vec" alt="">
                    <p class="black">Related Courses</p>
                </div>
                <h3 class="fw-bold mt-2 mb-2">Explore More <span class="color-primary">International Courses</span></h3>
                <p class="cds-119 css-lg65q1 cds-121">Discover other courses in the same field to enhance your skills</p>
            </div>

            <!-- Swiper -->
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach($otherCourses as $relatedCourse)
                        <div class="swiper-slide">
                            <div class="blog-card">
                                <a href="{{ route('web.global.course.show', $relatedCourse->slug) }}" class="card-img">
                                    <img src="{{ $relatedCourse->thumbnail_image ? asset($relatedCourse->thumbnail_image) : asset('resource/web/assets/media/default/default-img.png') }}"
                                         alt="{{ $relatedCourse->course_title }}"
                                         onerror="this.src='{{ asset('resource/web/assets/media/default/default-img.png') }}'">
                                    <span class="date-block">
                                        <span class="h6 fw-400 light-black">
                                            {{ $relatedCourse->paid_type == 'Free' ? 'FREE' : 'PAID' }}
                                        </span>
                                        <span class="h6 fw-400 light-black">{{ $relatedCourse->category->name ?? 'Professional' }}</span>
                                    </span>
                                </a>
                                <div class="card-content">
                                    <a href="{{ route('web.global.course.show', $relatedCourse->slug) }}" class="h6 fw-500 mb-8">
                                        {{ \Illuminate\Support\Str::limit($relatedCourse->course_title, 50) }}
                                    </a>
                                    <p class="light-gray mb-24">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($relatedCourse->short_description), 100) }}
                                    </p>
                                    <div class="course-meta d-flex justify-content-between align-items-center mb-3">
                                        <span class="text-muted small">
                                            <i class="bi bi-clock me-1"></i>
                                            {{ $relatedCourse->course_duration_overseas ?? 'Flexible' }}
                                        </span>
                                        <span class="text-muted small">
                                            <i class="bi bi-geo-alt me-1"></i>
                                            {{ $relatedCourse->country->name ?? 'International' }}
                                        </span>
                                    </div>
                                    <a href="{{ route('web.global.course.show', $relatedCourse->slug) }}" class="card-btn">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
    @endif
@endsection

@push('styles')
    <style>
        .hover-card {
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            border-color: rgba(0, 0, 0, 0.125);
        }

        .text-shadow {
            text-shadow: 2px 2px 4px rgba(0,0,0,0.8);
        }

        @media (max-width: 575.98px) {
            .display-6 {
                font-size: 1.5rem !important;
            }
        }

        /* Swiper Styles */
        .swiper {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
    </style>
@endpush

@push('scripts')
<!-- Lightbox2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
<!-- Lightbox2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 10,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 30,
            },
        },
    });

    // Initialize Lightbox
    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true,
        'imageFadeDuration': 300
    });
</script>
@endpush
