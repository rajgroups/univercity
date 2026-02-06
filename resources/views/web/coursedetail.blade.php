@extends('layouts.web.app')
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

@section('content')
    <style>
        :root {
            --primary-color: #2e7d32; /* Green 800 */
            --primary-light: #4caf50; /* Green 500 */
            --primary-soft: rgba(76, 175, 80, 0.1);
            --secondary-color: #6c757d;
            --light-bg: #f8f9fa;
            --dark-text: #212529;
            --border-radius: 12px;
            --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        /* Hero Section */
        .course-hero {
            background: linear-gradient(135deg, #e8f5e9 0%, #f1f8e9 100%);
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }
        .course-hero::before {
            content: "";
            position: absolute;
            top: -50%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(76, 175, 80, 0.08) 0%, rgba(255, 255, 255, 0) 70%);
            border-radius: 50%;
            z-index: 1;
        }

        .hero-title {
            font-size: 2.8rem;
            font-weight: 800;
            color: #1a1a1a;
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }

        .badge-soft-primary { background: var(--primary-soft); color: var(--primary-color); }
        .badge-soft-success { background: rgba(25, 135, 84, 0.1); color: #198754; }
        .badge-soft-warning { background: rgba(255, 193, 7, 0.1); color: #856404; }

        .hero-meta-item {
            display: flex;
            align-items: center;
            font-size: 0.95rem;
            color: #555;
            margin-right: 1.5rem;
            margin-bottom: 0.5rem;
        }
        .hero-meta-item i {
            font-size: 1.1rem;
            margin-right: 0.5rem;
            color: var(--primary-color);
        }

        .course-gallery-wrapper {
            position: relative;
            z-index: 2;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
        }
        .carousel-item img {
            transition: transform 0.5s ease;
        }
        .carousel-item:hover img {
            transform: scale(1.02);
        }

        /* Tabs Styles */
        .modern-tabs .nav-link {
            color: var(--secondary-color);
            font-weight: 600;
            border: none;
            padding: 1rem 1.5rem;
            border-bottom: 3px solid transparent;
            transition: var(--transition);
            background: transparent;
        }
        .modern-tabs .nav-link:hover {
            color: var(--primary-color);
            background: var(--primary-soft);
        }
        .modern-tabs .nav-link.active {
            color: var(--primary-color);
            border-bottom-color: var(--primary-color);
            background: transparent;
        }
        .modern-tabs .nav-link i { margin-right: 0.5rem; }

        /* Card Styles */
        .custom-card {
            background: #fff;
            border: 1px solid rgba(0,0,0,0.05);
            border-radius: var(--border-radius);
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
            overflow: hidden;
            transition: var(--transition);
        }
        .custom-card:hover { border-color: rgba(0,0,0,0.1); box-shadow: var(--box-shadow); }

        .feature-box {
            background: #f8f9fa;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            height: 100%;
            border: 1px solid transparent;
            transition: var(--transition);
        }
        .feature-box:hover {
            background: #fff;
            border-color: rgba(76, 175, 80, 0.3);
            box-shadow: 0 5px 15px rgba(76, 175, 80, 0.08);
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transform: translateY(-3px);
        }

        /* Sidebar */
        .sticky-sidebar {
            position: sticky;
            top: 90px;
            z-index: 10;
        }

        /* Accordion */
        .custom-accordion .accordion-item {
            border: none;
            margin-bottom: 0.8rem;
            border-radius: 8px !important;
            box-shadow: 0 2px 5px rgba(0,0,0,0.02);
            overflow: hidden;
        }
        .custom-accordion .accordion-button {
            background: #fff;
            box-shadow: none;
            font-weight: 600;
            padding: 1.2rem;
        }
        .custom-accordion .accordion-button:not(.collapsed) {
            background: rgba(76, 175, 80, 0.05);
            color: var(--primary-color);
        }

        /* Related Courses */
        .related-card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            overflow: hidden;
            transition: var(--transition);
        }
        .related-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }
        .related-card img { height: 200px; object-fit: cover; }
        .related-card .badge-overlay {
            position: absolute;
            top: 15px;
            left: 15px;
            z-index: 2;
        }
        /* Overrides */
        .bg-primary { background-color: var(--primary-color) !important; }
        .text-primary { color: var(--primary-color) !important; }
        .btn-primary { 
            background-color: var(--primary-color) !important; 
            border-color: var(--primary-color) !important; 
        }
        .btn-primary:hover {
            background-color: #1b5e20 !important; /* Darker Green */
            border-color: #1b5e20 !important;
        }
    </style>

    <!-- Course Hero Section -->
    <section class="course-hero">
        <div class="container">
            @if($course->availability_status == 'not_available')
                <div class="alert alert-danger text-center mb-4 rounded-3 shadow-sm border-0">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i><strong>Note:</strong> This course is currently not available for enrollment.
                </div>
            @endif
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0 z-index-2">
                    <div class="pe-lg-5">
                        <div class="d-flex align-items-center flex-wrap gap-2 mb-3">
                            <span class="badge badge-soft-primary px-3 py-2 rounded-pill">
                                <i class="bi bi-grid-fill me-1"></i> {{ $course->sector->name ?? 'General Course' }}
                            </span>
                            @if($course->internship)
                                <span class="badge badge-soft-success px-3 py-2 rounded-pill">
                                    <i class="bi bi-check-circle me-1"></i> Internship Available
                                </span>
                            @endif
                        </div>

                        <h1 class="hero-title">{{ $course->name }}</h1>

                        <p class="text-muted lead mb-4">
                            {{ $course->short_description ? Str::limit(strip_tags($course->short_description), 200) : 'Embark on a journey of professional growth with this comprehensive course designed for industry success.' }}
                        </p>

                        <div class="d-flex flex-wrap gap-y-3 mb-4">
                            <div class="hero-meta-item">
                                <i class="bi bi-bar-chart-fill"></i>
                                <span>{{ $course->level ?? 'Professional Level' }}</span>
                            </div>
                            <div class="hero-meta-item">
                                <i class="bi bi-clock-fill"></i>
                                <span>
                                    @if ($course->duration_number && $course->duration_unit)
                                        {{ $course->duration_number }} {{ $course->duration_unit }}
                                    @else
                                        {{ $course->duration ?? 'Flexible' }}
                                    @endif
                                </span>
                            </div>
                            <div class="hero-meta-item">
                                <i class="bi bi-translate"></i>
                                <span>
                                    @php
                                        $languages = is_array($course->language) ? $course->language : [];
                                        echo count($languages) > 0
                                            ? implode(', ', array_slice($languages, 0, 2)) . (count($languages) > 2 ? ' +' . (count($languages) - 2) . ' more' : '')
                                            : 'Multiple Languages';
                                    @endphp
                                </span>
                            </div>
                            <div class="hero-meta-item">
                                <i class="bi bi-star-fill text-warning"></i>
                                <span>{{ $course->review_stars ?? '4.5' }} ({{ $course->review_count ?? '120+' }} Reviews)</span>
                            </div>
                            <div class="hero-meta-item">
                                <i class="bi bi-people-fill"></i>
                                <span>{{ ($course->enrollment_count ?? 0) }}+ Enrolled</span>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap gap-3 mt-4">
                            @if($course->availability_status == 'not_available')
                                <button class="btn btn-secondary btn-lg px-5 rounded-pill" disabled>Not Available</button>
                            @else
                                <button class="btn btn-primary btn-lg px-5 rounded-pill shadow-lg hover-lift" onclick="document.getElementById('enquiryForm').scrollIntoView({behavior: 'smooth'})">
                                    Enroll Now
                                </button>
                            @endif
                            <button class="btn btn-outline-primary btn-lg px-4 rounded-pill" onclick="if(navigator.share) { navigator.share({ title: '{{ $course->name }}', text: '{{ $course->short_description }}', url: window.location.href }); } else { alert('Sharing not supported on this browser'); }">
                                <i class="bi bi-share-fill me-2"></i> Share
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Course Image/Gallery -->
                <div class="col-lg-6">
                    <div class="course-gallery-wrapper">
                        <div id="courseGalleryCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{ $course->image ? asset($course->image) : asset('resource/web/assets/media/default/default-img.png') }}"
                                         class="d-block w-100"
                                         alt="{{ $course->name }}"
                                         style="height: 450px; object-fit: cover;"
                                         onerror="this.src='{{ asset('resource/web/assets/media/default/default-img.png') }}'">
                                    @if($course->paid_type->value == 'free')
                                        <div class="position-absolute top-0 end-0 m-3 badge bg-success fs-6 shadow">Free</div>
                                    @elseif($course->paid_type->value == 'paid')
                                        <div class="position-absolute top-0 end-0 m-3 badge bg-warning text-dark fs-6 shadow">Paid</div>
                                    @endif
                                </div>
                                @if (count($course->gallery) > 0)
                                    @foreach ($course->gallery as $galleryImage)
                                        <div class="carousel-item">
                                            <img src="{{ asset($galleryImage) }}"
                                                 class="d-block w-100"
                                                 alt="Gallery Image"
                                                 style="height: 450px; object-fit: cover;"
                                                 onerror="this.src='{{ asset('resource/web/assets/media/default/default-img.png') }}'">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            @if (count($course->gallery) > 0)
                                <button class="carousel-control-prev" type="button" data-bs-target="#courseGalleryCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon bg-dark rounded-circle p-3" aria-hidden="true" style="background-color: rgba(0,0,0,0.3) !important"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#courseGalleryCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon bg-dark rounded-circle p-3" aria-hidden="true" style="background-color: rgba(0,0,0,0.3) !important"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <!-- Left Content -->
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <!-- Tabs -->
                    <div class="custom-card mb-4 min-h-screen">
                        <div class="card-header bg-white p-2 border-bottom-0">
                            <ul class="nav modern-tabs nav-fill" id="courseTabs" role="tablist">
                                <li class="nav-item ps-0" role="presentation">
                                    <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab">
                                        <i class="bi bi-info-circle"></i> Overview
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="curriculum-tab" data-bs-toggle="tab" data-bs-target="#curriculum" type="button" role="tab">
                                        <i class="bi bi-journal-richtext"></i> Curriculum
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab">
                                        <i class="bi bi-hdd-stack"></i> Details
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="eligibility-tab" data-bs-toggle="tab" data-bs-target="#eligibility" type="button" role="tab">
                                        <i class="bi bi-person-check"></i> Eligibility
                                    </button>
                                </li>
                                <li class="nav-item pe-0" role="presentation">
                                    <button class="nav-link" id="outcomes-tab" data-bs-toggle="tab" data-bs-target="#outcomes" type="button" role="tab">
                                        <i class="bi bi-lightbulb"></i> Outcomes
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body p-4 p-md-5">
                            <div class="tab-content" id="courseTabsContent">
                                <!-- Overview Tab -->
                                <div class="tab-pane fade show active" id="overview" role="tabpanel">
                                    <h4 class="fw-bold mb-4 text-dark">About This Course</h4>
                                    <div class="text-secondary lead fs-6" style="line-height: 1.8;">
                                        @if($course->long_description)
                                            {!! $course->long_description !!}
                                        @else
                                            <div class="text-center py-5">
                                                <i class="bi bi-file-text display-4 text-muted mb-3 opacity-50"></i>
                                                <p class="text-muted">Detailed description coming soon.</p>
                                            </div>
                                        @endif
                                    </div>

                                    @if($course->internship && $course->internship_note)
                                        <div class="mt-5 p-4 rounded-3 border border-success bg-soft-success" style="background: rgba(25, 135, 84, 0.05);">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0">
                                                    <i class="bi bi-briefcase-fill text-success fs-2"></i>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h5 class="alert-heading text-success fw-bold mb-1">Internship Opportunity</h5>
                                                    <p class="mb-0 text-dark">{{ $course->internship_note }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <!-- Curriculum Tab -->
                                <div class="tab-pane fade" id="curriculum" role="tabpanel">
                                    <h4 class="fw-bold mb-4 text-dark">Course Curriculum</h4>
                                    @if (!empty($course->topics) && count($course->topics) > 0)
                                        <div class="accordion custom-accordion" id="courseCurriculum">
                                            @foreach ($course->topics as $index => $topic)
                                                @if (!empty($topic['title']) || !empty($topic['description']))
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="heading{{ $index }}">
                                                            <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}">
                                                                <span class="me-3 badge bg-light text-primary border rounded-pill">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                                                {{ $topic['title'] ?? 'Module ' . ($index + 1) }}
                                                            </button>
                                                        </h2>
                                                        <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" data-bs-parent="#courseCurriculum">
                                                            <div class="accordion-body text-secondary">
                                                                {{ $topic['description'] ?? 'Detailed topics covered in this module.' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="text-center py-5">
                                            <i class="bi bi-journal-x display-4 text-muted mb-3 opacity-50"></i>
                                            <p class="text-muted">Curriculum details are being updated.</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Details Tab -->
                                <div class="tab-pane fade" id="details" role="tabpanel">
                                    <h4 class="fw-bold mb-4 text-dark">Course Specifications</h4>
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <div class="feature-box">
                                                <h6 class="text-primary fw-bold text-uppercase small mb-3">General Info</h6>
                                                <ul class="list-unstyled mb-0">
                                                    @if ($course->provider)
                                                    <li class="mb-3 d-flex justify-content-between border-bottom pb-2">
                                                        <span class="text-muted">Provider</span>
                                                        <span class="fw-semibold">{{ $course->provider }}</span>
                                                    </li>
                                                    @endif
                                                    @if ($course->certification_type)
                                                    <li class="mb-3 d-flex justify-content-between border-bottom pb-2">
                                                        <span class="text-muted">Certification</span>
                                                        <span class="fw-semibold">{{ $course->certification_type }}</span>
                                                    </li>
                                                    @endif
                                                    @if ($course->mode_of_study)
                                                    <li class="mb-3 d-flex justify-content-between border-bottom pb-2">
                                                        <span class="text-muted">Mode</span>
                                                        <span class="fw-semibold">{{ $course->mode_of_study->label() }}</span>
                                                    </li>
                                                    @endif
                                                    @if ($course->assessment_mode)
                                                    <li class="d-flex justify-content-between">
                                                        <span class="text-muted">Assessment</span>
                                                        <span class="fw-semibold">{{ $course->assessment_mode }}</span>
                                                    </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="feature-box">
                                                <h6 class="text-primary fw-bold text-uppercase small mb-3">Program Details</h6>
                                                <ul class="list-unstyled mb-0">
                                                    @if ($course->program_by)
                                                    <li class="mb-3 d-flex justify-content-between border-bottom pb-2">
                                                        <span class="text-muted">Program By</span>
                                                        <span class="fw-semibold">{{ $course->program_by }}</span>
                                                    </li>
                                                    @endif
                                                    @if ($course->initiative_of)
                                                    <li class="mb-3 d-flex justify-content-between border-bottom pb-2">
                                                        <span class="text-muted">Initiative Of</span>
                                                        <span class="fw-semibold">{{ $course->initiative_of }}</span>
                                                    </li>
                                                    @endif
                                                    @if ($course->domain)
                                                    <li class="mb-3 d-flex justify-content-between border-bottom pb-2">
                                                        <span class="text-muted">Domain</span>
                                                        <span class="fw-semibold">{{ $course->domain }}</span>
                                                    </li>
                                                    @endif
                                                    @if ($course->course_code)
                                                    <li class="mb-3 d-flex justify-content-between border-bottom pb-2">
                                                        <span class="text-muted">Code</span>
                                                        <span class="fw-semibold">{{ $course->course_code }}</span>
                                                    </li>
                                                    @endif
                                                    @if ($course->nsqf_level)
                                                    <li class="d-flex justify-content-between">
                                                        <span class="text-muted">NSQF Level</span>
                                                        <span class="fw-semibold">{{ $course->nsqf_level }}</span>
                                                    </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @if (!empty($course->location) && count($course->location) > 0)
                                        <div class="col-md-6">
                                        <div class="mt-4">
                                            <h6 class="fw-bold mb-3">Available Locations</h6>
                                            <div class="d-flex flex-wrap gap-2">
                                                @foreach ($course->location as $location)
                                                    <span class="badge bg-white text-dark border px-3 py-2 shadow-sm">{{ $location }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        </div>
                                        @endif

                                        @if (!empty($course->language) && count($course->language) > 0)
                                        <div class="col-md-6">
                                        <div class="mt-4">
                                            <h6 class="fw-bold mb-3">Languages</h6>
                                            <div class="d-flex flex-wrap gap-2">
                                                @foreach ($course->language as $lang)
                                                    <span class="badge bg-light text-dark border px-3 py-2">{{ $lang }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        </div>
                                        @endif

                                        @if (!empty($course->occupations) && count($course->occupations) > 0)
                                        <div class="col-md-12">
                                        <div class="mt-4">
                                            <h6 class="fw-bold mb-3">Target Occupations</h6>
                                            <div class="d-flex flex-wrap gap-2">
                                                @foreach ($course->occupations as $occupation)
                                                    <span class="badge badge-soft-primary text-primary border border-light px-3 py-2">{{ $occupation }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Eligibility Tab -->
                                <div class="tab-pane fade" id="eligibility" role="tabpanel">
                                    <h4 class="fw-bold mb-4 text-dark">Who Can Apply?</h4>
                                    <div class="row g-4">
                                        @if ($course->required_age)
                                            <div class="col-md-6">
                                                <div class="feature-box text-center">
                                                    <div class="mb-3">
                                                        <span class="d-inline-flex align-items-center justify-content-center bg-soft-primary text-primary rounded-circle" style="width: 60px; height: 60px; background: rgba(13, 110, 253, 0.1);">
                                                            <i class="bi bi-calendar-event fs-3"></i>
                                                        </span>
                                                    </div>
                                                    <h5>Required Age</h5>
                                                    <p class="mb-0 fw-bold">{{ $course->required_age }}</p>
                                                </div>
                                            </div>
                                        @endif
                                        @if (!empty($course->minimum_education) && count($course->minimum_education) > 0)
                                            <div class="col-md-6">
                                                <div class="feature-box text-center">
                                                    <div class="mb-3">
                                                        <span class="d-inline-flex align-items-center justify-content-center bg-soft-primary text-primary rounded-circle" style="width: 60px; height: 60px; background: rgba(13, 110, 253, 0.1);">
                                                            <i class="bi bi-mortarboard fs-3"></i>
                                                        </span>
                                                    </div>
                                                    <h5>Minimum Education</h5>
                                                    <p class="mb-0 fw-bold">{{ implode(', ', $course->minimum_education) }}</p>
                                                </div>
                                            </div>
                                        @endif
                                        
                                        @if ($course->industry_experience_years || $course->industry_experience_desc)
                                        <div class="col-md-6">
                                            <div class="feature-box text-center">
                                                <div class="mb-3">
                                                    <span class="d-inline-flex align-items-center justify-content-center bg-soft-primary text-primary rounded-circle" style="width: 60px; height: 60px; background: rgba(13, 110, 253, 0.1);">
                                                        <i class="bi bi-briefcase fs-3"></i>
                                                    </span>
                                                </div>
                                                <h5>Industry Experience</h5>
                                                <p class="mb-0 fw-bold">
                                                    @if($course->industry_experience_years) {{ $course->industry_experience_years }} Years @endif
                                                    @if($course->industry_experience_desc) <br><small class="text-muted fw-normal">({{ $course->industry_experience_desc }})</small> @endif
                                                </p>
                                            </div>
                                        </div>
                                        @endif

                                        @if (!empty($course->learning_tools) && count($course->learning_tools) > 0)
                                        <div class="col-md-6">
                                            <div class="feature-box text-center">
                                                <div class="mb-3">
                                                    <span class="d-inline-flex align-items-center justify-content-center bg-soft-primary text-primary rounded-circle" style="width: 60px; height: 60px; background: rgba(13, 110, 253, 0.1);">
                                                        <i class="bi bi-tools fs-3"></i>
                                                    </span>
                                                </div>
                                                <h5>Learning Tools</h5>
                                                <p class="mb-0 fw-bold">{{ implode(', ', $course->learning_tools) }}</p>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Learning Outcomes Tab -->
                                <div class="tab-pane fade" id="outcomes" role="tabpanel">
                                    <h4 class="fw-bold mb-4 text-dark">Special Features & Outcomes</h4>
                                    @if (!empty($course->other_specifications) && count($course->other_specifications) > 0)
                                        <div class="row g-4">
                                            @foreach ($course->other_specifications as $spec)
                                                @if (!empty($spec['label']) && !empty($spec['description']))
                                                    <div class="col-md-6">
                                                        <div class="feature-box h-100">
                                                            <div class="d-flex align-items-start">
                                                                <i class="bi bi-check-circle-fill text-success fs-4 me-3 mt-1"></i>
                                                                <div>
                                                                    <h5 class="fw-bold mb-2">{{ $spec['label'] }}</h5>
                                                                    <p class="mb-0 text-muted">{{ $spec['description'] }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="text-center py-5">
                                            <i class="bi bi-stars display-4 text-muted mb-3 opacity-50"></i>
                                            <p class="text-muted">Specific outcomes listed soon.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar -->
                <div class="col-lg-4">
                    <div class="sticky-sidebar">
                        <!-- Course Snapshot -->
                        <div class="custom-card mb-4">
                            <div class="card-header bg-primary text-white py-3 px-4">
                                <h5 class="mb-0 fw-bold text-white"><i class="bi bi-lightning-charge me-2"></i> Highlights</h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item px-4 py-3 d-flex align-items-center text-dark">
                                        <i class="bi bi-currency-rupee text-primary fs-5 me-3"></i>
                                        <div>
                                            <small class="text-muted d-block text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">Price</small>
                                            <span class="fw-bold fs-6">
                                                @if ($course->paid_type->value == 'free')
                                                    Free
                                                @elseif($course->paid_type->value == 'paid')
                                                    Paid Course
                                                @else
                                                    N/A
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    
                                    @if ($course->start_date || $course->end_date)
                                    <div class="list-group-item px-4 py-3 d-flex align-items-center text-dark">
                                        <i class="bi bi-calendar-range text-primary fs-5 me-3"></i>
                                        <div>
                                            <small class="text-muted d-block text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">Course Dates</small>
                                            <span class="fw-bold fs-6">
                                                @if($course->start_date) {{ $course->start_date->format('M d, Y') }} @endif
                                                @if($course->start_date && $course->end_date) - @endif
                                                @if($course->end_date) {{ $course->end_date->format('M d, Y') }} @endif
                                            </span>
                                        </div>
                                    </div>
                                    @endif

                                    @if ($course->provider)
                                    <div class="list-group-item px-4 py-3 d-flex align-items-center text-dark">
                                        <i class="bi bi-building text-primary fs-5 me-3"></i>
                                        <div>
                                            <small class="text-muted d-block text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">Partner</small>
                                            <span class="fw-bold fs-6">{{ $course->provider }}</span>
                                        </div>
                                    </div>
                                    @endif

                                    @if ($course->certification_type)
                                    <div class="list-group-item px-4 py-3 d-flex align-items-center text-dark">
                                        <i class="bi bi-award text-primary fs-5 me-3"></i>
                                        <div>
                                            <small class="text-muted d-block text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">Certificate</small>
                                            <span class="fw-bold fs-6">{{ $course->certification_type }}</span>
                                        </div>
                                    </div>
                                    @endif

                                    @if ($course->duration_number)
                                    <div class="list-group-item px-4 py-3 d-flex text-dark">
                                        <i class="bi bi-stopwatch text-primary fs-5 me-3"></i>
                                        <div>
                                            <small class="text-muted d-block text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">Duration</small>
                                            <span class="fw-bold fs-6">{{ $course->duration_number }} {{ $course->duration_unit }}</span>
                                        </div>
                                    </div>
                                    @endif

                                    @if ($course->internship)
                                    <div class="list-group-item px-4 py-3 d-flex text-dark">
                                        <i class="bi bi-briefcase text-primary fs-5 me-3"></i>
                                        <div>
                                            <small class="text-muted d-block text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">Internship</small>
                                            <span class="fw-bold fs-6 text-success">Available</span>
                                        </div>
                                    </div>
                                    @endif

                                    @if ($course->stipend_status)
                                    <div class="list-group-item px-4 py-3 d-flex text-dark">
                                        <i class="bi bi-cash-coin text-primary fs-5 me-3"></i>
                                        <div>
                                            <small class="text-muted d-block text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">Stipend</small>
                                            <span class="fw-bold fs-6 text-success">
                                                {{ $course->stipend_amount ? $course->stipend_amount : 'Yes' }}
                                            </span>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Enquiry Form -->
                        <div class="custom-card" id="enquiryForm">
                            <div class="card-body p-4">
                                <h4 class="fw-bold mb-1">Interested?</h4>
                                <p class="text-muted mb-4 small">Fill the form below and we'll get back to you.</p>
                                
                                <form class="needs-validation" action="{{ route('web.enquiry') }}" method="POST" novalidate>
                                    @csrf
                                    <input type="hidden" name="type" value="7">
                                    <input type="hidden" name="course_name" value="{{ $course->name }}">

                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control bg-light border-0" id="name" name="name" placeholder="Full Name" required minlength="2">
                                            <label for="name">Full Name</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input type="email" class="form-control bg-light border-0" id="email" name="email" placeholder="Email">
                                            <label for="email">Email Address</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input type="tel" class="form-control bg-light border-0" id="mobile" name="mobile" placeholder="Mobile" required pattern="[0-9]{10,15}">
                                            <label for="mobile">Phone Number</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <textarea class="form-control bg-light border-0" id="message" name="message" style="height: 100px" placeholder="Message" required></textarea>
                                            <label for="message">Your Message</label>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100 py-3 fw-bold rounded-3 shadow-sm">
                                        Submit Enquiry <i class="bi bi-arrow-right-short fs-4 align-middle"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Related Courses -->
             @if($relatedCourses->isNotEmpty())
             <div class="mt-5 pt-5 border-top">
                 <div class="d-flex justify-content-between align-items-end mb-4">
                     <div>
                         <h6 class="text-primary fw-bold text-uppercase letter-spacing-1 mb-2">Discover More</h6>
                         <h2 class="fw-bold mb-0">Related Courses</h2>
                     </div>
                     <a href="{{ route('web.course.index') }}" class="btn btn-outline-primary rounded-pill px-4">View All</a>
                 </div>
                 
                 <div class="row g-4">
                     @foreach ($relatedCourses->take(3) as $rcourse)
                         <div class="col-md-4">
                             <div class="card related-card h-100">
                                 <div class="badge-overlay">
                                    <span class="badge {{ $rcourse->paid_type->value == 'free' ? 'bg-success' : 'bg-warning text-dark' }}">
                                        {{ $rcourse->paid_type->value == 'free' ? 'FREE' : 'PAID' }}
                                    </span>
                                 </div>
                                 <img src="{{ $rcourse->image ? asset($rcourse->image) : asset('resource/web/assets/media/default/default-img.png') }}" class="card-img-top" alt="{{ $rcourse->name }}">
                                 <div class="card-body p-4 d-flex flex-column">
                                     <div class="mb-2">
                                         <span class="text-muted small"><i class="bi bi-grid me-1"></i> {{ $rcourse->sector->name ?? 'General' }}</span>
                                     </div>
                                     <h5 class="card-title fw-bold mb-3">
                                         <a href="{{ route('web.course.show', $rcourse->slug) }}" class="text-decoration-none text-dark stretched-link">
                                             {{ Str::limit($rcourse->name, 50) }}
                                         </a>
                                     </h5>
                                     <div class="mt-auto d-flex justify-content-between align-items-center text-muted small">
                                         <span><i class="bi bi-clock me-1"></i> {{ $rcourse->duration_number ?? 'Flex' }} {{ $rcourse->duration_unit ?? '' }}</span>
                                         <span><i class="bi bi-people me-1"></i> {{ $rcourse->enrollment_count ?? 0 }}</span>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     @endforeach
                 </div>
             </div>
             @endif
        </div>
    </section>

    <!-- Banners Bottom -->
    @if($banners->isNotEmpty())
    <section class="py-5 bg-white">
        <div class="container">
             <div id="bannerCarousel" class="carousel slide rounded-4 overflow-hidden shadow" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($banners as $index => $banner)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <img src="{{ asset($banner->image) }}"
                                 class="d-block w-100"
                                 alt="Featured Banner"
                                 style="height: 250px; object-fit: cover;"
                                 onerror="this.src='{{ asset('resource/web/assets/media/default/default-img.png') }}'">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif

@endsection

@push('scripts')
<script>
    // Form validation
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()

    // Mobile input mask
    document.querySelectorAll('input[type="tel"]').forEach(input => {
        input.addEventListener('input', e => {
            e.target.value = e.target.value.replace(/[^0-9]/g, '');
        });
    });
</script>
@endpush
