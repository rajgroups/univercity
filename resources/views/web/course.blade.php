@extends('layouts.web.app')
@push('meta')
    <title>Courses - Indian Skill Institute Co-operation (ISICO)</title>

    <meta name="description"
        content="Explore professional courses offered by the Indian Skill Institute Co-operation (ISICO). Our programs focus on skill development, education, entrepreneurship, and innovation to prepare learners for future opportunities.">
    <meta name="keywords"
        content="ISICO courses, Indian Skill Institute courses, skill development training, education programs, entrepreneurship courses, professional learning, career development, innovation, NEP 2020">
    <meta name="author" content="Indian Skill Institute Co-operation (ISICO)">
    <meta name="robots" content="index, follow">

    <!-- Canonical Tag -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:title" content="Courses - Indian Skill Institute Co-operation (ISICO)">
    <meta property="og:description"
        content="Discover ISICO's skill development and professional courses designed to empower learners with practical knowledge, entrepreneurship, and career opportunities.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('default-courses.jpg') }}">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Courses - Indian Skill Institute Co-operation (ISICO)">
    <meta name="twitter:description"
        content="Join ISICO's education and skill development courses to build knowledge, innovation, and entrepreneurial skills for the future.">
    <meta name="twitter:image" content="{{ asset('default-courses.jpg') }}">
@endpush

@section('content')
    <!-- Title Banner Section Start -->
    <style>
        .modern-page-banner {
            position: relative;
            min-height: 350px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            overflow: hidden;
            margin-bottom: 80px;
        }

        .modern-page-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.5) 100%);
            z-index: 1;
        }

        .modern-banner-content {
            position: relative;
            z-index: 2;
            text-align: center;
            width: 100%;
            padding: 0 15px;
        }

        .modern-banner-title {
            font-size: 3.5rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 1rem;
            text-shadow: 0 4px 10px rgba(0,0,0,0.3);
            letter-spacing: -0.5px;
        }

        .modern-breadcrumb {
            display: inline-flex;
            padding: 8px 16px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            border-radius: 50px;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .modern-breadcrumb a, .modern-breadcrumb span {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
        }

        .modern-breadcrumb a:hover {
            color: #fff;
        }

        @media (max-width: 768px) {
            .modern-page-banner {
                min-height: 250px;
            }
            .modern-banner-title {
                font-size: 2.5rem;
            }
        }
            }
        }

        /* Course Availability Styling */
        .course-card.unavailable {
            user-select: none;
        }

        .course-card.unavailable .card-img-top,
        .course-card.unavailable .card-body {
            filter: blur(3px) grayscale(100%);
            opacity: 0.7;
            pointer-events: none;
        }

        .unavailable-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-align: center;
            max-width: 90%;
            white-space: normal;
        }

        /* Custom Badge Colors for Mode of Study and Paid Type */
        .badge.bg-secondary {
            background-color: #0d6efd !important; /* Blue */
            color: #fff !important;
        }
        .badge.bg-success {
            background-color: #dc3545 !important; /* Red */
            color: #fff !important;
        }
        .bg-purple {
            background-color: #6f42c1 !important;
        }
        .text-purple {
            color: #6f42c1 !important;
        }
        @media (max-width: 768px) {
            .mobile-space {
            margin-top: 20px; /* adjust as needed */
           }
        }
    </style>

    <!-- Title Banner Section Start -->
    <section class="modern-page-banner" style="background-image: url('{{ asset('resource/web/assets/media/banner/course-bg.jpg') }}'), url('https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=2070&auto=format&fit=crop');">
        <div class="modern-banner-content" data-aos="fade-up">
            <div class="modern-breadcrumb mobile-space">
                <a href="{{ url('/') }}">Home</a>
                <span class="mx-2">/</span>
                <span class="text-white">Courses</span>
            </div>
            @php
                 $bannerTitle = "Explore Our Courses";
                 $sectorName = null;
                 if (request()->has('sectors')) {
                     $sectorIds = request('sectors', []);
                     if (is_string($sectorIds)) {
                         $sectorIds = explode(',', $sectorIds);
                     }
                     if (is_array($sectorIds) && count($sectorIds) > 0) {
                        $firstSectorId = $sectorIds[0] ?? null;
                        $foundSector = isset($sectors) ? $sectors->firstWhere('id', $firstSectorId) : null;
                        if ($foundSector) {
                            $sectorName = $foundSector->name;
                            $bannerTitle = $sectorName . " Courses";
                        }
                     }
                 }
            @endphp
            <h1 class="modern-banner-title">{{ $bannerTitle }}</h1>
            <p class="text-white opacity-75 lead" style="max-width: 600px; margin: 0 auto;">Discover skill development programs designed to accelerate your career growth.</p>
        </div>
    </section>
    <!-- Title Banner Section End -->

    <!-- Courses Section Start -->
    <section class="courses-sec mb-120">
        <div class="container-fluid">
            <!-- Header Section -->
            <div class="row align-items-center mb-4 sticky-mobile-filter-bar py-2">
                <div class="col-6 col-lg-6">
                    <h4 class="text-primary mb-0 fs-6 fs-lg-4">Skill Development</h4>
                    <div class="d-lg-none text-muted smallest" style="font-size: 10px;">
                        <strong>{{ $courses->total() }}</strong> Courses
                    </div>
                    <p class="text-muted mb-0 d-none d-lg-block">Showing {{ $courses->total() }} courses</p>
                </div>
                <div class="col-6 col-lg-6">
                    <div class="d-flex align-items-center justify-content-end gap-2">
                        <!-- Mobile Filter Button -->
                        <button class="btn btn-sm btn-outline-primary d-lg-none" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#mobileFilters">
                            <i class="bi bi-funnel"></i>
                            @if (request()->anyFilled(['search', 'sectors', 'categories', 'languages', 'durations', 'prices', 'levels']))
                                <span class="badge bg-primary text-white p-1 ms-1" style="font-size: 8px;">!</span>
                            @endif
                        </button>

                        <!-- Sort Dropdown -->
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 12px;">
                                <i class="bi bi-sort-down"></i>
                            </button>
                            <ul class="dropdown-menu shadow-sm border-0">
                                <li><a class="dropdown-item small"
                                        href="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}">Newest First</a></li>
                                <li><a class="dropdown-item small"
                                        href="{{ request()->fullUrlWithQuery(['sort' => 'oldest']) }}">Oldest First</a></li>
                                <li><a class="dropdown-item small"
                                        href="{{ request()->fullUrlWithQuery(['sort' => 'name']) }}">Name A-Z</a></li>
                                <li><a class="dropdown-item small"
                                        href="{{ request()->fullUrlWithQuery(['sort' => 'name_desc']) }}">Name Z-A</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Sidebar Filters (Desktop) -->
                <div class="col-lg-3 d-none d-lg-block">
                    <div class="filter-sidebar card border-0 shadow-sm sticky-top" style="top: 100px;">
                        <div class="card-header bg-white border-bottom">
                            <h5 class="mb-0">
                                <i class="bi bi-funnel me-2 text-primary"></i>Filters
                                @if (request()->anyFilled(['search', 'sectors', 'categories', 'languages', 'durations', 'prices', 'levels']))
                                    <a href="{{ route('web.course.index') }}"
                                        class="btn btn-sm btn-outline-danger float-end">
                                        Clear All
                                    </a>
                                @endif
                            </h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('web.course.index') }}" method="GET" id="courseFiltersDesktop">
                                @php
                                    $selectedSectors = request('sectors', []);
                                    if (is_string($selectedSectors)) {
                                        $selectedSectors = explode(',', $selectedSectors);
                                    }
                                    if (!is_array($selectedSectors)) {
                                        $selectedSectors = [];
                                    }

                                    $selectedCategories = request('categories', []);
                                    if (is_string($selectedCategories)) {
                                        $selectedCategories = explode(',', $selectedCategories);
                                    }
                                    if (!is_array($selectedCategories)) {
                                        $selectedCategories = [];
                                    }
                                @endphp
                                <!-- Search -->
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Search Courses</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control border-end-0" name="search"
                                            placeholder="Course name, description..." value="{{ request('search') }}">
                                        <button class="btn btn-outline-primary border-start-0" type="submit">
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Active Filters -->
                                @if (request()->anyFilled(['sectors', 'languages', 'durations', 'prices', 'levels']))
                                    <div class="mb-4">
                                        <label class="form-label fw-semibold">Active Filters</label>
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach ($selectedSectors as $sectorId)
                                                @php $sector = isset($sectors) ? $sectors->firstWhere('id', $sectorId) : null; @endphp
                                                @if ($sector)
                                                    <span class="badge bg-primary">
                                                        {{ $sector->name }}
                                                        <a href="{{ request()->fullUrlWithQuery(['sectors' => array_diff($selectedSectors, [$sectorId])]) }}"
                                                            class="text-white ms-1">×</a>
                                                    </span>
                                                @endif
                                            @endforeach
                                            @foreach ($selectedCategories as $catId)
                                                @php $cat = isset($categories) ? $categories->firstWhere('id', $catId) : null; @endphp
                                                @if ($cat)
                                                    <span class="badge bg-purple text-white">
                                                        {{ $cat->name }}
                                                        <a href="{{ request()->fullUrlWithQuery(['categories' => array_diff($selectedCategories, [$catId])]) }}"
                                                            class="text-white ms-1">×</a>
                                                    </span>
                                                @endif
                                            @endforeach
                                            @foreach (request('languages', []) as $language)
                                                <span class="badge bg-info">
                                                    {{ $language }}
                                                    <a href="{{ request()->fullUrlWithQuery(['languages' => array_diff(request('languages', []), [$language])]) }}"
                                                        class="text-white ms-1">×</a>
                                                </span>
                                            @endforeach
                                            @foreach (request('durations', []) as $duration)
                                                <span class="badge bg-warning text-dark">
                                                    {{ $duration }}
                                                    <a href="{{ request()->fullUrlWithQuery(['durations' => array_diff(request('durations', []), [$duration])]) }}"
                                                        class="text-dark ms-1">×</a>
                                                </span>
                                            @endforeach
                                            @foreach (request('levels', []) as $level)
                                                <span class="badge bg-info">
                                                    {{ $level }}
                                                    <a href="{{ request()->fullUrlWithQuery(['levels' => array_diff(request('levels', []), [$level])]) }}"
                                                        class="text-white ms-1">×</a>
                                                </span>
                                            @endforeach
                                            @foreach (request('prices', []) as $price)
                                                <span class="badge bg-{{ $price == 'free' ? 'success' : 'warning' }}">
                                                    {{ ucfirst($price) }}
                                                    <a href="{{ request()->fullUrlWithQuery(['prices' => array_diff(request('prices', []), [$price])]) }}"
                                                        class="text-white ms-1">×</a>
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <!-- Filter Accordion -->
                                <div class="accordion" id="filterAccordion">
                                    <!-- Sector Filter -->
                                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                                        <h2 class="accordion-header" id="headingSector">
                                            <button class="accordion-button shadow-none bg-light fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSector" aria-expanded="{{ count($selectedSectors) > 0 ? 'true' : 'false' }}">
                                                <i class="bi bi-grid me-2 text-primary"></i> Sector
                                                @if(count($selectedSectors) > 0)
                                                    <span class="badge bg-primary ms-2">{{ count($selectedSectors) }}</span>
                                                @endif
                                            </button>
                                        </h2>
                                        <div id="collapseSector" class="accordion-collapse collapse {{ count($selectedSectors) > 0 ? 'show' : '' }}" aria-labelledby="headingSector" data-bs-parent="#filterAccordion">
                                            <div class="accordion-body pt-2 filter-options">
                                                @foreach ($sectors as $sector)
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="checkbox" name="sectors[]"
                                                            id="sectorDesktop{{ $sector->id }}" value="{{ $sector->id }}"
                                                            {{ in_array($sector->id, $selectedSectors) ? 'checked' : '' }}>
                                                        <label class="form-check-label d-flex justify-content-between w-100"
                                                            for="sectorDesktop{{ $sector->id }}">
                                                            <span class="text-dark small">{{ $sector->name }}</span>
                                                            <span class="text-muted smallest">{{ $sector->courses_count ?? 0 }}</span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Category Filter -->
                                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                                        <h2 class="accordion-header" id="headingCategory">
                                            <button class="accordion-button collapsed shadow-none bg-light fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCategory" aria-expanded="{{ count($selectedCategories) > 0 ? 'true' : 'false' }}">
                                                <i class="bi bi-tags me-2 text-primary"></i> Category
                                                @if(count($selectedCategories) > 0)
                                                    <span class="badge bg-primary ms-2">{{ count($selectedCategories) }}</span>
                                                @endif
                                            </button>
                                        </h2>
                                        <div id="collapseCategory" class="accordion-collapse collapse {{ count($selectedCategories) > 0 ? 'show' : '' }}" aria-labelledby="headingCategory" data-bs-parent="#filterAccordion">
                                            <div class="accordion-body pt-2 filter-options">
                                                @foreach ($categories as $category)
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="checkbox" name="categories[]"
                                                            id="categoryDesktop{{ $category->id }}" value="{{ $category->id }}"
                                                            {{ in_array($category->id, $selectedCategories) ? 'checked' : '' }}>
                                                        <label class="form-check-label d-flex justify-content-between w-100"
                                                            for="categoryDesktop{{ $category->id }}">
                                                            <span class="text-dark small">{{ $category->name }}</span>
                                                            <span class="text-muted smallest">{{ $category->courses_count ?? 0 }}</span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Language Filter -->
                                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                                        <h2 class="accordion-header" id="headingLanguage">
                                            <button class="accordion-button collapsed shadow-none bg-light fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLanguage" aria-expanded="{{ count(request('languages', [])) > 0 ? 'true' : 'false' }}">
                                                <i class="bi bi-translate me-2 text-primary"></i> Language
                                                @if(count(request('languages', [])) > 0)
                                                    <span class="badge bg-primary ms-2">{{ count(request('languages', [])) }}</span>
                                                @endif
                                            </button>
                                        </h2>
                                        <div id="collapseLanguage" class="accordion-collapse collapse {{ count(request('languages', [])) > 0 ? 'show' : '' }}" aria-labelledby="headingLanguage" data-bs-parent="#filterAccordion">
                                            <div class="accordion-body pt-2 filter-options">
                                                @foreach (['English', 'Hindi', 'Tamil', 'Telugu', 'Kannada', 'Malayalam', 'Marathi', 'Bengali'] as $language)
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="checkbox" name="languages[]"
                                                            id="langDesktop{{ $loop->index }}" value="{{ $language }}"
                                                            {{ in_array($language, request('languages', [])) ? 'checked' : '' }}>
                                                        <label class="form-check-label small" for="langDesktop{{ $loop->index }}">
                                                            {{ $language }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Level Filter -->
                                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                                        <h2 class="accordion-header" id="headingLevel">
                                            <button class="accordion-button collapsed shadow-none bg-light fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLevel" aria-expanded="{{ count(request('levels', [])) > 0 ? 'true' : 'false' }}">
                                                <i class="bi bi-bar-chart-steps me-2 text-primary"></i> Course Level
                                                @if(count(request('levels', [])) > 0)
                                                    <span class="badge bg-primary ms-2">{{ count(request('levels', [])) }}</span>
                                                @endif
                                            </button>
                                        </h2>
                                        <div id="collapseLevel" class="accordion-collapse collapse {{ count(request('levels', [])) > 0 ? 'show' : '' }}" aria-labelledby="headingLevel" data-bs-parent="#filterAccordion">
                                            <div class="accordion-body pt-2 filter-options">
                                                @foreach (['Awareness', 'Foundation', 'Intermediate', 'Professional', 'Advanced'] as $level)
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="checkbox" name="levels[]"
                                                            id="levelDesktop{{ $loop->index }}" value="{{ $level }}"
                                                            {{ in_array($level, request('levels', [])) ? 'checked' : '' }}>
                                                        <label class="form-check-label small" for="levelDesktop{{ $loop->index }}">
                                                            {{ $level }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Filter Actions -->
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-lg me-2"></i>Apply Filters
                                    </button>
                                    <a href="{{ route('web.course.index') }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-arrow-clockwise me-2"></i>Reset All
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Courses Grid -->
                <div class="col-lg-9">
                    @if ($courses->count() > 0)
                        <div class="row g-4">
                            @foreach ($courses as $course)
                                <div class="col-md-6 col-xl-4 mt-4">
                                    <div class="course-card card h-100 border-0 shadow-sm hover-lift {{ $course->availability_status == 'not_available' ? 'unavailable' : '' }}">
                                        @if($course->availability_status == 'not_available')
                                            <div class="unavailable-overlay">
                                                <div class="mb-2 text-white small" style="text-transform: none; font-weight: normal;">{{ $course->name }}</div>
                                                <span class="badge bg-danger">Currently Not Available</span>
                                            </div>
                                        @endif
                                        <div class="position-relative">
                                            <img src="{{ asset($course->image ?? 'default-course.jpg') }}"
                                                class="card-img-top" alt="{{ $course->name }}"
                                                style="height: 200px; object-fit: cover;">
                                            <div
                                                class="card-img-overlay d-flex justify-content-between align-items-start p-3">
                                               <span class="badge text-white bg-{{ $course->mode_of_study->value == 1 ? 'primary' : 'secondary' }}">
                                                    {{ $course->mode_of_study?->label() ?? 'N/A' }}
                                                </span>
                                                <span
                                                    class="badge bg-{{ $course->paid_type->value == 'free' ? 'success' : 'warning' }}">
                                                    {{ $course->paid_type->value == 'free' ? 'FREE' : 'PAID' }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="card-body d-flex flex-column">
                                            <h6 class="card-title text-primary mb-2 line-clamp-2"
                                                style="min-height: 3rem;">
                                                {{ Str::words($course->name, 3, '...') }}
                                            </h6>
                                            <p class="text-muted small mb-2">
                                                <i class="bi bi-building me-1"></i>{{ $course->provider ?? 'ISICO' }}
                                            </p>
                                            <p class="text-warning small mb-2">
                                                <i class="bi bi-tags me-1"></i>
                                                {{ $course->sector->name ?? 'General' }}
                                                @if($course->category)
                                                    <span class="mx-1 text-muted">|</span>
                                                    <span class="text-purple fw-semibold">{{ $course->category->name }}</span>
                                                @endif
                                            </p>
                                            <div class="course-meta d-flex justify-content-between text-muted small mb-3">
                                                <span class="d-flex align-items-center">
                                                    <i class="bi bi-translate me-1"></i>
                                                    @php
                                                        $languages = is_array($course->language)
                                                            ? $course->language
                                                            : (is_string($course->language)
                                                                ? json_decode($course->language, true)
                                                                : []);
                                                    @endphp

                                                    @if (count($languages) > 0)
                                                        <span class="language-trigger text-primary cursor-pointer"
                                                            data-bs-toggle="popover" data-bs-placement="top"
                                                            data-bs-content="
                    <div class='p-2'>
                        <strong>Available in:</strong>
                        <ul class='mb-0 mt-1 ps-3'>
                            @foreach ($languages as $lang)
<li>{{ $lang }}</li>
@endforeach
                        </ul>
                    </div>
                  "
                                                            data-bs-html="true">
                                                            {{ count($languages) }} Languages
                                                        </span>
                                                    @else
                                                        <span class="text-muted">Multiple Languages</span>
                                                    @endif
                                                </span>
                                              <span class="d-flex align-items-center">
    <i class="bi bi-clock me-1"></i>

    {{ $course->duration_number && $course->duration_unit
        ? $course->duration_number . ' ' . $course->duration_unit->label()
        : 'Flexible'
    }}
</span>

                                            </div>
                                            <div class="mt-auto">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <div class="rating">
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <small class="text-muted">
                                                            {{ $course->review_stars ?? '4.5' }}
                                                            ({{ $course->review_count ?? '120' }} reviews)
                                                        </small>
                                                    </div>
                                                    <div class="enrollment">
                                                        <small class="text-muted">
                                                            <i class="bi bi-people me-1"></i>
                                                            {{ $course->enrollment_count }} enrolled
                                                        </small>
                                                    </div>
                                                </div>
                                                <a href="{{ route('web.course.show', $course->slug) }}"
                                                    class="btn btn-primary w-100">
                                                    View Details <i class="bi bi-arrow-right ms-2"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-5">
                            <nav aria-label="Course pagination">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item {{ $courses->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $courses->previousPageUrl() }}">
                                            <i class="bi bi-chevron-left"></i> Previous
                                        </a>
                                    </li>

                                    @foreach ($courses->getUrlRange(1, $courses->lastPage()) as $page => $url)
                                        @if ($page == $courses->currentPage())
                                            <li class="page-item active">
                                                <span class="page-link">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach

                                    <li class="page-item {{ !$courses->hasMorePages() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $courses->nextPageUrl() }}">
                                            Next <i class="bi bi-chevron-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    @else
                        <!-- No Courses Found -->
                        <div class="text-center py-5">
                            <div class="empty-state">
                                <i class="bi bi-search display-1 text-muted"></i>
                                <h3 class="mt-4 text-muted">No courses found</h3>
                                <p class="text-muted mb-4">Try adjusting your search criteria or browse all courses.</p>
                                <a href="{{ route('web.course.index') }}" class="btn btn-primary">
                                    <i class="bi bi-arrow-clockwise me-2"></i>Reset Filters
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Mobile Filters Offcanvas -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileFilters">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title flex-grow-1">
                <i class="bi bi-funnel me-2 text-primary"></i>Filters
                @if (request()->anyFilled(['search', 'sectors', 'categories', 'languages', 'durations', 'prices', 'levels']))
                    <a href="{{ route('web.course.index') }}"
                        class="btn btn-sm btn-outline-danger float-end me-3">
                        Clear All
                    </a>
                @endif
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <!-- Mobile filter content will be loaded here via JavaScript -->
            <div id="mobileFilterContent"></div>
        </div>
    </div>

    <style>
        .language-display {
            cursor: help;
        }

        .cursor-pointer {
            cursor: pointer;
        }

        .language-trigger:hover {
            text-decoration: underline;
        }

        /* Badge styling for Option 2 */
        .badge.bg-light {
            font-size: 0.65rem;
            padding: 0.2rem 0.4rem;
        }

        /* Ensure tooltips and popovers work well on mobile */
        @media (max-width: 768px) {

            .language-display,
            .language-trigger {
                font-size: 0.8rem;
            }
        }

        .hover-lift {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .filter-sidebar {
            z-index: 100;
        }

        .sticky-mobile-filter-bar {
            transition: all 0.3s ease;
        }

        @media (max-width: 991.98px) {
            .sticky-mobile-filter-bar {
                position: sticky;
                top: 0px;
                z-index: 999;
                background: white;
                margin: 0 -15px 20px -15px;
                padding: 10px 15px;
                border-bottom: 1px solid #eee;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            }

            .stricky-fixed + .main-wrapper .sticky-mobile-filter-bar {
                top: 80px;
            }
        }

        .filter-options {
            max-height: 250px;
            overflow-y: auto;
            padding-right: 10px;
        }

        .accordion-button:not(.collapsed) {
            background-color: #f8f9fa;
            color: var(--bs-primary);
        }

        .accordion-button::after {
            background-size: 1rem;
            transition: transform 0.3s ease-in-out;
        }

        .accordion-item {
            transition: all 0.3s ease;
            border: 1px solid rgba(0,0,0,0.05) !important;
        }

        .accordion-item:hover {
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.08) !important;
        }

        .smallest {
            font-size: 0.7rem;
        }

        .filter-options::-webkit-scrollbar {
            width: 4px;
        }

        .filter-options::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .filter-options::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }

        .empty-state {
            max-width: 400px;
            margin: 0 auto;
        }

        .course-meta {
            font-size: 0.875rem;
        }

        .card-img-overlay .badge {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.9);
            color: #000;
        }
    </style>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-submit form only for search on Enter key (desktop)
            const desktopForm = document.getElementById('courseFiltersDesktop');
            if (desktopForm) {
                const searchInput = desktopForm.querySelector('input[name="search"]');
                if (searchInput) {
                    searchInput.addEventListener('keypress', function(e) {
                        if (e.key === 'Enter') {
                            desktopForm.submit();
                        }
                    });
                }
            }

            // Handle Apply Filters button loading state (using delegation for mobile compatibility)
            document.addEventListener('submit', function(e) {
                const form = e.target;
                if (form && (form.id === 'courseFiltersDesktop' || form.id === 'courseFiltersMobile')) {
                    const btn = form.querySelector('button[type="submit"]');
                    if (btn && btn.innerText.includes('Apply Filters')) {
                        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Loading...';
                        btn.disabled = true;
                    }
                }
            });

            // Mobile filter logic
            const mobileFilters = document.getElementById('mobileFilters');
            const mobileFilterContent = document.getElementById('mobileFilterContent');

            if (mobileFilters && mobileFilterContent) {
                mobileFilters.addEventListener('show.bs.offcanvas', function() {
                    // Check if content is already loaded/valid
                    if (!mobileFilterContent.innerHTML || !mobileFilterContent.innerHTML.trim()) {
                        const desktopForm = document.getElementById('courseFiltersDesktop');
                        if (desktopForm) {
                            try {
                                const mobileForm = desktopForm.cloneNode(true);
                                mobileForm.id = 'courseFiltersMobile';
                                
                                // 1. Global ID and Label update
                                const allElementsWithId = mobileForm.querySelectorAll('[id]');
                                allElementsWithId.forEach(el => {
                                    const oldId = el.id;
                                    if (oldId) {
                                        const newId = 'mobile_' + oldId;
                                        el.id = newId;
                                        
                                        // Update associated labels
                                        try {
                                            const label = mobileForm.querySelector(`label[for="${oldId}"]`);
                                            if (label) {
                                                label.setAttribute('for', newId);
                                            }
                                        } catch (e) { /* Ignore invalid selector errors */ }
                                    }
                                });

                                // 2. Accordion Root Update
                                mobileForm.querySelectorAll('.accordion').forEach(acc => {
                                    if (acc.id) {
                                        // Ensure it was updated in step 1, or do it here
                                        if (!acc.id.startsWith('mobile_')) acc.id = 'mobile_' + acc.id;
                                    }
                                });

                                // 3. Accordion Collapse Elements (CRITICAL for closing behavior)
                                mobileForm.querySelectorAll('.accordion-collapse').forEach(collapse => {
                                    if (collapse.id && !collapse.id.startsWith('mobile_')) {
                                        collapse.id = 'mobile_' + collapse.id;
                                    }
                                    
                                    // Update parent reference so items close correctly
                                    const parent = collapse.getAttribute('data-bs-parent');
                                    if (parent && parent.startsWith('#')) {
                                        collapse.setAttribute('data-bs-parent', '#mobile_' + parent.substring(1));
                                    }
                                    
                                    const labelledBy = collapse.getAttribute('aria-labelledby');
                                    if (labelledBy && !labelledBy.startsWith('mobile_')) {
                                        collapse.setAttribute('aria-labelledby', 'mobile_' + labelledBy);
                                    }
                                });

                                // 4. Accordion Triggers (buttons)
                                mobileForm.querySelectorAll('[data-bs-toggle="collapse"]').forEach(btn => {
                                    const target = btn.getAttribute('data-bs-target');
                                    if (target && target.startsWith('#')) {
                                        const newTarget = '#mobile_' + target.substring(1);
                                        btn.setAttribute('data-bs-target', newTarget);
                                        btn.setAttribute('aria-controls', newTarget.substring(1));
                                    }
                                    
                                    // Some themes put data-bs-parent on the button
                                    const btnParent = btn.getAttribute('data-bs-parent');
                                    if (btnParent && btnParent.startsWith('#')) {
                                        btn.setAttribute('data-bs-parent', '#mobile_' + btnParent.substring(1));
                                    }
                                });

                                // Clear and Mount
                                mobileFilterContent.innerHTML = '';
                                mobileFilterContent.appendChild(mobileForm);
                                
                            } catch (err) {
                                console.error('Error cloning mobile filters:', err);
                            }
                        }
                    }
                });
            }
            // Initialize tooltips and popovers (with safety check)
            if (typeof bootstrap !== 'undefined') {
                const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });

                const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
                popoverTriggerList.map(function(popoverTriggerEl) {
                    return new bootstrap.Popover(popoverTriggerEl);
                });
            }

            // Read more functionality
            const readMoreLinks = document.querySelectorAll('.read-more');
            readMoreLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const parent = this.closest('.language-truncate');
                    if (parent) {
                        const fullText = parent.getAttribute('data-full-text');
                        parent.innerHTML = fullText;
                    }
                });
            });
        });
    </script>
@endpush
