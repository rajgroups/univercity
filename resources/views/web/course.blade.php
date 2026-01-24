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
    </style>

    <!-- Title Banner Section Start -->
    <section class="modern-page-banner" style="background-image: url('{{ asset('resource/web/assets/media/banner/course-bg.jpg') }}'), url('https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=2070&auto=format&fit=crop');">
        <div class="modern-banner-content" data-aos="fade-up">
            <div class="modern-breadcrumb">
                <a href="{{ url('/') }}">Home</a>
                <span class="mx-2">/</span>
                <span class="text-white">Courses</span>
            </div>
            <h1 class="modern-banner-title">Explore Our Courses</h1>
            <p class="text-white opacity-75 lead" style="max-width: 600px; margin: 0 auto;">Discover skill development programs designed to accelerate your career growth.</p>
        </div>
    </section>
    <!-- Title Banner Section End -->

    <!-- Courses Section Start -->
    <section class="courses-sec mb-120">
        <div class="container-fluid">
            <!-- Header Section -->
            <div class="row align-items-center mb-4">
                <div class="col-md-6">
                    <h4 class="text-primary mb-2">Skill Development Courses</h4>
                    <p class="text-muted mb-0">Showing {{ $courses->total() }} courses</p>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-center justify-content-md-end gap-3">
                        <!-- Mobile Filter Button -->
                        <button class="btn btn-outline-primary d-md-none" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#mobileFilters">
                            <i class="bi bi-funnel me-2"></i>Filters
                            @if (request()->anyFilled(['search', 'sectors', 'languages', 'durations', 'prices']))
                                <span class="badge bg-primary ms-1">!</span>
                            @endif
                        </button>

                        <!-- Sort Dropdown -->
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-sort-down me-2"></i>Sort By
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item"
                                        href="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}">Newest First</a></li>
                                <li><a class="dropdown-item"
                                        href="{{ request()->fullUrlWithQuery(['sort' => 'oldest']) }}">Oldest First</a></li>
                                <li><a class="dropdown-item"
                                        href="{{ request()->fullUrlWithQuery(['sort' => 'name']) }}">Name A-Z</a></li>
                                <li><a class="dropdown-item"
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
                                @if (request()->anyFilled(['search', 'sectors', 'languages', 'durations', 'prices']))
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
                                @if (request()->anyFilled(['sectors', 'languages', 'durations', 'prices']))
                                    <div class="mb-4">
                                        <label class="form-label fw-semibold">Active Filters</label>
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach ($selectedSectors as $sectorId)
                                                @php $sector = $sectors->firstWhere('id', $sectorId); @endphp
                                                @if ($sector)
                                                    <span class="badge bg-primary">
                                                        {{ $sector->name }}
                                                        <a href="{{ request()->fullUrlWithQuery(['sectors' => array_diff($selectedSectors, [$sectorId])]) }}"
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
                                            @foreach (request('prices', []) as $price)
                                                <span class="badge bg-success">
                                                    {{ $price }}
                                                    <a href="{{ request()->fullUrlWithQuery(['prices' => array_diff(request('prices', []), [$price])]) }}"
                                                        class="text-white ms-1">×</a>
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <!-- Sector Filter -->
                                <div class="mb-4">
                                    <label class="form-label fw-semibold d-flex justify-content-between">
                                        <span>Sector</span>
                                        <span class="badge bg-primary">{{ count($selectedSectors) }}</span>
                                    </label>
                                    <div class="filter-options">
                                        @foreach ($sectors as $sector)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="sectors[]"
                                                    id="sectorDesktop{{ $sector->id }}" value="{{ $sector->id }}"
                                                    {{ in_array($sector->id, $selectedSectors) ? 'checked' : '' }}>
                                                <label class="form-check-label d-flex justify-content-between w-100"
                                                    for="sectorDesktop{{ $sector->id }}">
                                                    <span>{{ $sector->name }}</span>
                                                    <span
                                                        class="text-muted small">{{ $sector->courses_count ?? 0 }}</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Language Filter -->
                                <div class="mb-4">
                                    <label class="form-label fw-semibold d-flex justify-content-between">
                                        <span>Language</span>
                                        <span class="badge bg-primary">{{ count(request('languages', [])) }}</span>
                                    </label>
                                    <div class="filter-options">
                                        @foreach (['English', 'Hindi', 'Tamil', 'Telugu', 'Kannada', 'Malayalam', 'Marathi', 'Bengali'] as $language)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="languages[]"
                                                    id="langDesktop{{ $loop->index }}" value="{{ $language }}"
                                                    {{ in_array($language, request('languages', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="langDesktop{{ $loop->index }}">
                                                    {{ $language }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Duration Filter -->
                                <div class="mb-4">
                                    <label class="form-label fw-semibold d-flex justify-content-between">
                                        <span>Duration</span>
                                        <span class="badge bg-primary">{{ count(request('durations', [])) }}</span>
                                    </label>
                                    <div class="filter-options">
                                        @foreach (['1-3 months', '3-6 months', '6-12 months', '1+ years'] as $duration)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="durations[]"
                                                    id="durDesktop{{ $loop->index }}" value="{{ $duration }}"
                                                    {{ in_array($duration, request('durations', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="durDesktop{{ $loop->index }}">
                                                    {{ $duration }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Price Filter -->
                                <div class="mb-4">
                                    <label class="form-label fw-semibold d-flex justify-content-between">
                                        <span>Price Type</span>
                                        <span class="badge bg-primary">{{ count(request('prices', [])) }}</span>
                                    </label>
                                    <div class="filter-options">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="prices[]"
                                                id="priceFreeDesktop" value="free"
                                                {{ in_array('free', request('prices', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="priceFreeDesktop">
                                                Free Courses
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="prices[]"
                                                id="pricePaidDesktop" value="paid"
                                                {{ in_array('paid', request('prices', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="pricePaidDesktop">
                                                Paid Courses
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Mode of Study Filter -->
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Mode of Study</label>
                                    <div class="filter-options">
                                        @foreach ([1 => 'Online', 2 => 'In-Centre', 3 => 'Hybrid', 4 => 'On-Demand'] as $value => $label)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="modes[]"
                                                    id="modeDesktop{{ $value }}" value="{{ $value }}"
                                                    {{ in_array($value, request('modes', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="modeDesktop{{ $value }}">
                                                    {{ $label }}
                                                </label>
                                            </div>
                                        @endforeach
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
                                <div class="col-md-6 col-xl-4">
                                    <div class="course-card card h-100 border-0 shadow-sm hover-lift">
                                        <div class="position-relative">
                                            <img src="{{ asset($course->image ?? 'default-course.jpg') }}"
                                                class="card-img-top" alt="{{ $course->name }}"
                                                style="height: 200px; object-fit: cover;">
                                            <div
                                                class="card-img-overlay d-flex justify-content-between align-items-start p-3">
                                               <span class="badge bg-{{ $course->mode_of_study->value == 1 ? 'primary' : 'secondary' }}">
                                                    @switch($course->mode_of_study->value)
                                                        @case(1) {{ $learningTypes[1] ?? 'Online' }} @break
                                                        @case(2) {{ $learningTypes[2] ?? 'Offline' }} @break
                                                        @case(3) {{ $learningTypes[3] ?? 'Hybrid' }} @break
                                                        @case(4) {{ $learningTypes[4] ?? 'Flexible' }} @break
                                                        @default {{ $learningTypes[$course->mode_of_study->value] ?? 'N/A' }}
                                                    @endswitch
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
                                                {{ $course->name }}
                                            </h6>
                                            <p class="text-muted small mb-2">
                                                <i class="bi bi-building me-1"></i>{{ $course->provider ?? 'ISICO' }}
                                            </p>
                                            <p class="text-warning small mb-2">
                                                <i class="bi bi-tags me-1"></i>{{ $course->sector->name ?? 'General' }}
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
                                                        <small class="text-muted">4.5 (120 reviews)</small>
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
            <h5 class="offcanvas-title">
                <i class="bi bi-funnel me-2 text-primary"></i>Filters
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

        .filter-options {
            max-height: 200px;
            overflow-y: auto;
            padding-right: 10px;
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
            // Auto-submit form when filters change (desktop)
            const desktopForm = document.getElementById('courseFiltersDesktop');
            if (desktopForm) {
                const inputs = desktopForm.querySelectorAll('input[type="checkbox"], input[type="text"]');
                inputs.forEach(input => {
                    if (input.type === 'text') {
                        input.addEventListener('keypress', function(e) {
                            if (e.key === 'Enter') {
                                desktopForm.submit();
                            }
                        });
                    } else {
                        input.addEventListener('change', function() {
                            desktopForm.submit();
                        });
                    }
                });
            }

            // Load mobile filters
            const mobileFilters = document.getElementById('mobileFilters');
            const mobileFilterContent = document.getElementById('mobileFilterContent');

            mobileFilters.addEventListener('show.bs.offcanvas', function() {
                if (!mobileFilterContent.innerHTML) {
                    // Clone desktop form content for mobile
                    const desktopForm = document.getElementById('courseFiltersDesktop');
                    if (desktopForm) {
                        mobileFilterContent.innerHTML = desktopForm.innerHTML;

                        // Add auto-submit for mobile filters too
                        const mobileInputs = mobileFilterContent.querySelectorAll('input[type="checkbox"]');
                        mobileInputs.forEach(input => {
                            input.addEventListener('change', function() {
                                document.getElementById('courseFiltersDesktop').submit();
                            });
                        });
                    }
                }
            });

            // Show loading state on form submit
            const forms = document.querySelectorAll('form[id*="Filters"]');
            forms.forEach(form => {
                form.addEventListener('submit', function() {
                    const submitBtn = this.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        submitBtn.innerHTML =
                        '<i class="bi bi-hourglass-split me-2"></i>Loading...';
                        submitBtn.disabled = true;
                    }
                });
            });
        });

        // Initialize tooltips and popovers
        document.addEventListener('DOMContentLoaded', function() {
            // Tooltip initialization
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Popover initialization
            const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
            const popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl);
            });

            // Read more functionality for Option 4
            const readMoreLinks = document.querySelectorAll('.read-more');
            readMoreLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const parent = this.closest('.language-truncate');
                    const fullText = parent.getAttribute('data-full-text');
                    parent.innerHTML = fullText;
                });
            });
        });
    </script>
@endpush
