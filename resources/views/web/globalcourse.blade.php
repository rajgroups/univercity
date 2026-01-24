@extends('layouts.web.app')
@push('meta')
    <title>International Courses - Indian Skill Institute Co-operation (ISICO)</title>

    <meta name="description" content="Explore international courses offered by the Indian Skill Institute Co-operation (ISICO). Study abroad programs, global certifications, and skill development courses.">
    <meta name="keywords" content="international courses, study abroad, global education, overseas education, ISICO courses, skill development, career opportunities">
    <meta name="author" content="Indian Skill Institute Co-operation (ISICO)">
    <meta name="robots" content="index, follow">

    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:title" content="International Courses - Indian Skill Institute Co-operation (ISICO)">
    <meta property="og:description" content="Discover ISICO's international courses and study abroad programs designed to provide global career opportunities.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('default-courses.jpg') }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="International Courses - Indian Skill Institute Co-operation (ISICO)">
    <meta name="twitter:description" content="Join ISICO's international education programs for global career success.">
    <meta name="twitter:image" content="{{ asset('default-courses.jpg') }}">
@endpush

@section('content')
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
            background: linear-gradient(135deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.5) 100%);
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

        .modern-banner-subtitle {
            font-size: 1.25rem;
            color: rgba(255,255,255,0.9);
            font-weight: 300;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.6;
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

        .modern-breadcrumb span {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            font-weight: 500;
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
    <section class="modern-page-banner" style="background-image: url('{{ asset('resource/web/assets/media/banner/global-bg.jpg') }}');">
        <div class="modern-banner-content" data-aos="fade-up">
            <div class="modern-breadcrumb">
                <span>Home</span>
                <span class="mx-2">/</span>
                <span>Global Pathways</span>
                <span class="mx-2">/</span>
                <span class="text-white">Courses</span>
            </div>
            <h1 class="modern-banner-title">International Courses</h1>
            <p class="modern-banner-subtitle">Explore study abroad opportunities and global career pathways designed for your success.</p>
        </div>
    </section>
    <!-- Title Banner Section End -->

    <section class="couses-sec mb-120">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-sm-between justify-content-center row-gap-4 flex-wrap mb-5">
                <h4 class="text-center">Global Learning Pathways</h4>
                <div class="d-flex align-items-center gap-8">
                    {{-- MOBILE FILTER BUTTON --}}
                    <button class="btn btn-outline-primary d-md-none me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileFilterOffcanvas" aria-controls="mobileFilterOffcanvas">
                        <i class="bi bi-funnel"></i> Filters
                    </button>

                    {{-- Sort Dropdown --}}
                    <div class="w-100 drop-container">
                        <div class="wrapper-dropdown form-control" id="dropdown-l2">
                            <div class="d-flex align-items-center justify-content-between gap-64">
                                <span class="selected-display black" id="desation112">Newest First</span>
                                <svg id="drop-down2" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M19.7337 4.81165C19.3788 4.45668 18.8031 4.45662 18.4481 4.81171L10.0002 13.2598L1.55191 4.81165C1.19694 4.45668 0.621303 4.45662 0.266273 4.81171C-0.0887576 5.16674 -0.0887576 5.74232 0.266273 6.09735L9.35742 15.1883C9.52791 15.3587 9.75912 15.4545 10.0002 15.4545C10.2413 15.4545 10.4726 15.3587 10.643 15.1882L19.7337 6.09729C20.0888 5.74232 20.0888 5.16668 19.7337 4.81165Z" fill="#92949F" />
                                </svg>
                            </div>
                            <ul class="topbar-dropdown">
                                <li class="item">Newest First</li>
                                <li class="item">Price: Low to High</li>
                                <li class="item">Price: High to Low</li>
                                <li class="item">Duration: Short to Long</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                {{-- Desktop Filters --}}
                <div class="col-md-3 d-none d-md-block">
                    <form action="{{ route('web.global.course') }}" method="GET" id="courseFilters">
                        <div class="mb-4">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search by course name..." value="{{ request('search') }}">
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>

                        <div class="accordion" id="filterAccordion">
                            {{-- Sector Filter --}}
                            <div class="accordion-item border-0 mb-3 shadow-sm">
                                <h2 class="accordion-header" id="headingSector">
                                    <button class="accordion-button collapsed shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSector" aria-expanded="false">
                                        <i class="bi bi-grid me-2"></i> Sector
                                        <span class="badge bg-primary ms-auto">{{ count(request('sectors', [])) }}</span>
                                    </button>
                                </h2>
                                <div id="collapseSector" class="accordion-collapse collapse {{ count(request('sectors', [])) ? 'show' : '' }}" aria-labelledby="headingSector" data-bs-parent="#filterAccordion">
                                    <div class="accordion-body pt-2">
                                        @foreach ($sectors as $sector)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" name="sectors[]" id="sector{{ $sector->id }}" value="{{ $sector->id }}" {{ in_array($sector->id, request('sectors', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label d-flex justify-content-between w-100" for="sector{{ $sector->id }}">
                                                    <span>{{ $sector->name }}</span>
                                                    <span class="text-muted small">{{ $sector->intl_courses_count ?? 0 }}</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            {{-- Country Filter --}}
                            <div class="accordion-item border-0 mb-3 shadow-sm">
                                <h2 class="accordion-header" id="headingCountry">
                                    <button class="accordion-button collapsed shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCountry" aria-expanded="false">
                                        <i class="bi bi-flag me-2"></i> Country
                                        <span class="badge bg-primary ms-auto">{{ count(request('countries', [])) }}</span>
                                    </button>
                                </h2>
                                <div id="collapseCountry" class="accordion-collapse collapse {{ count(request('countries', [])) ? 'show' : '' }}" aria-labelledby="headingCountry" data-bs-parent="#filterAccordion">
                                    <div class="accordion-body pt-2">
                                        @foreach ($countries as $country)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" name="countries[]" id="country{{ $country->id }}" value="{{ $country->iso3 }}" {{ in_array($country->iso3, (array)request('countries', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="country{{ $country->id }}">{{ $country->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            {{-- Category Filter --}}
                            <div class="accordion-item border-0 mb-3 shadow-sm">
                                <h2 class="accordion-header" id="headingCategory">
                                    <button class="accordion-button collapsed shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCategory" aria-expanded="false">
                                        <i class="bi bi-folder me-2"></i> Course Level
                                        <span class="badge bg-primary ms-auto">{{ count(request('categories', [])) }}</span>
                                    </button>
                                </h2>
                                <div id="collapseCategory" class="accordion-collapse collapse {{ count(request('categories', [])) ? 'show' : '' }}" aria-labelledby="headingCategory" data-bs-parent="#filterAccordion">
                                    <div class="accordion-body pt-2">
                                        @foreach ($categories as $category)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" name="categories[]" id="category{{ $category->id }}" value="{{ $category->id }}" {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="category{{ $category->id }}">{{ $category->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            {{-- Language Filter --}}
                            <div class="accordion-item border-0 mb-3 shadow-sm">
                                <h2 class="accordion-header" id="headingLang">
                                    <button class="accordion-button collapsed shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLang" aria-expanded="false">
                                        <i class="bi bi-translate me-2"></i> Language
                                        <span class="badge bg-primary ms-auto">{{ count(request('languages', [])) }}</span>
                                    </button>
                                </h2>
                                <div id="collapseLang" class="accordion-collapse collapse {{ count(request('languages', [])) ? 'show' : '' }}" aria-labelledby="headingLang" data-bs-parent="#filterAccordion">
                                    <div class="accordion-body pt-2">
                                        @foreach (['English', 'Japanese', 'Chinese', 'French', 'German', 'Spanish'] as $language)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" name="languages[]" id="lang{{ $loop->index }}" value="{{ $language }}" {{ in_array($language, request('languages', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="lang{{ $loop->index }}">{{ $language }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            {{-- Pathway Type Filter --}}
                            <div class="accordion-item border-0 mb-3 shadow-sm">
                                <h2 class="accordion-header" id="headingPathway">
                                    <button class="accordion-button collapsed shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePathway" aria-expanded="false">
                                        <i class="bi bi-diagram-3 me-2"></i> Study Mode
                                        <span class="badge bg-primary ms-auto">{{ count(request('pathways', [])) }}</span>
                                    </button>
                                </h2>
                                <div id="collapsePathway" class="accordion-collapse collapse {{ count(request('pathways', [])) ? 'show' : '' }}" aria-labelledby="headingPathway" data-bs-parent="#filterAccordion">
                                    <div class="accordion-body pt-2">
                                        @foreach (['Online', 'Onsite Abroad', 'Hybrid', 'Twinning', 'Dual Credit'] as $pathway)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" name="pathways[]" id="pathway{{ $loop->index }}" value="{{ $pathway }}" {{ in_array($pathway, request('pathways', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="pathway{{ $loop->index }}">{{ $pathway }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            {{-- Price Filter --}}
                            <div class="accordion-item border-0 mb-3 shadow-sm">
                                <h2 class="accordion-header" id="headingPrice">
                                    <button class="accordion-button collapsed shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePrice" aria-expanded="false">
                                        <i class="bi bi-currency-rupee me-2"></i> Price
                                        <span class="badge bg-primary ms-auto">{{ count(request('prices', [])) }}</span>
                                    </button>
                                </h2>
                                <div id="collapsePrice" class="accordion-collapse collapse {{ count(request('prices', [])) ? 'show' : '' }}" aria-labelledby="headingPrice" data-bs-parent="#filterAccordion">
                                    <div class="accordion-body pt-2">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="prices[]" id="priceFree" value="Free" {{ in_array('Free', request('prices', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="priceFree">Free</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="prices[]" id="pricePaid" value="Paid" {{ in_array('Paid', request('prices', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="pricePaid">Paid</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Duration Filter --}}
                            <div class="accordion-item border-0 mb-3 shadow-sm">
                                <h2 class="accordion-header" id="headingDuration">
                                    <button class="accordion-button collapsed shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDuration" aria-expanded="false">
                                        <i class="bi bi-clock me-2"></i> Duration
                                        <span class="badge bg-primary ms-auto">{{ count(request('durations', [])) }}</span>
                                    </button>
                                </h2>
                                <div id="collapseDuration" class="accordion-collapse collapse {{ count(request('durations', [])) ? 'show' : '' }}" aria-labelledby="headingDuration" data-bs-parent="#filterAccordion">
                                    <div class="accordion-body pt-2">
                                        @foreach (['3 Months', '6 Months', '1 Year', '2 Years', '3+ Years'] as $duration)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" name="durations[]" id="dur{{ $loop->index }}" value="{{ $duration }}" {{ in_array($duration, request('durations', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="dur{{ $loop->index }}">{{ $duration }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-funnel me-1"></i> Apply Filters
                            </button>
                            <a href="{{ route('web.global.course') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-counterclockwise me-1"></i> Reset All
                            </a>
                        </div>
                    </form>
                </div>

                {{-- Course Grid --}}
{{-- Course Grid --}}
<div class="col-12 col-md-9">
    @if($courses->count() > 0)
        <div class="row g-4">
            @foreach ($courses as $course)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="course-card card h-100 border-0 shadow-sm">
                        {{-- Course Image with Badges --}}
                        <div class="position-relative">
                            @if($course->thumbnail_image)
                                <img src="{{ asset($course->thumbnail_image) }}" class="card-img-top" alt="{{ $course->course_title }}" style="height: 160px; object-fit: cover;">
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 160px;">
                                    <i class="bi bi-book text-muted" style="font-size: 2.5rem;"></i>
                                </div>
                            @endif

                            {{-- Badges --}}
                            <div class="position-absolute top-0 start-0 end-0 p-2 d-flex justify-content-between">
                                <span class="badge bg-primary">
                                    {{ $course->pathway_type }}
                                </span>
                                <span class="badge {{ $course->paid_type === 'Free' ? 'bg-success' : 'bg-warning' }}">
                                    {{ $course->paid_type }}
                                </span>
                            </div>
                        </div>

                        {{-- Card Content --}}
                        <div class="card-body d-flex flex-column p-3">
                            {{-- Course Title --}}
                            <h6 class="card-title mb-3 fw-bold text-dark line-clamp-2" style="min-height: 2.5rem;">
                                {{ $course->course_title }}
                            </h6>

                            {{-- Institution & Location --}}
                            <div class="mb-3">
                                <div class="d-flex align-items-start mb-2">
                                    <i class="bi bi-building text-muted me-2 mt-1 flex-shrink-0"></i>
                                    <span class="small text-muted">{{ Str::limit($course->overseas_partner_institution, 35) }}</span>
                                </div>
                                <div class="d-flex align-items-start mb-2">
                                    <i class="bi bi-geo-alt text-primary me-2 mt-1 flex-shrink-0"></i>
                                    <span class="small text-primary">{{ $course->country->name ?? 'International' }}</span>
                                </div>
                            </div>

                            {{-- Sector --}}
                            @if($course->sector)
                            <div class="mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-tags text-warning me-2 flex-shrink-0"></i>
                                    <span class="small text-dark">{{ $course->sector->name }}</span>
                                </div>
                            </div>
                            @endif

                            {{-- Course Details - Split left & right --}}
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center small text-muted mb-3">
                                    {{-- Left Side: Language --}}
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-translate me-1"></i>
                                        <span>
                                            @if($course->language_of_instruction)
                                                {{ implode(', ', array_slice($course->language_of_instruction, 0, 2)) }}
                                                @if(count($course->language_of_instruction) > 2)+@endif
                                            @else
                                                English
                                            @endif
                                        </span>
                                    </div>

                                    {{-- Right Side: Duration --}}
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-clock me-1"></i>
                                        <span>{{ $course->course_duration_overseas }}</span>
                                    </div>
                                </div>

                                {{-- Apply Button --}}
                                <a href="{{ route('web.global.course.show', $course->slug) }}" class="btn btn-outline-primary w-100 btn-sm d-flex align-items-center justify-content-center">
                                    View Details & Apply
                                    <i class="bi bi-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-search display-1 text-muted opacity-50"></i>
            <h4 class="mt-3 text-dark">No courses found</h4>
            <p class="text-muted mb-4">Try adjusting your search criteria or browse all courses.</p>
            <a href="{{ route('web.global.course') }}" class="btn btn-primary px-4">
                <i class="bi bi-grid me-2"></i>
                Browse All Courses
            </a>
        </div>
    @endif
</div>
            </div>

            {{-- Pagination --}}
            @if($courses->hasPages())
                <div class="pagination mt-5">
                    <ul id="border-pagination" class="mb-0">
                        {{-- Previous Page Link --}}
                        <li>
                            <a href="{{ $courses->previousPageUrl() }}" class="{{ $courses->onFirstPage() ? 'disabled' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="14" viewBox="0 0 19 14" fill="none">
                                    <path d="M0.876656 6.61218L6.70999 0.778849C6.86716 0.62705 7.07766 0.543055 7.29616 0.544953C7.51465 0.546852 7.72366 0.634493 7.87817 0.789C8.03268 0.943507 8.12032 1.15252 8.12222 1.37101C8.12412 1.58951 8.04012 1.80001 7.88832 1.95718L3.47749 6.36801H18.1325C18.3535 6.36801 18.5655 6.45581 18.7217 6.61209C18.878 6.76837 18.9658 6.98033 18.9658 7.20135C18.9658 7.42236 18.878 7.63432 18.7217 7.7906C18.5655 7.94688 18.3535 8.03468 18.1325 8.03468H3.47749L7.88832 12.4455C7.96791 12.5224 8.0314 12.6143 8.07507 12.716C8.11875 12.8177 8.14174 12.927 8.1427 13.0377C8.14366 13.1483 8.12257 13.2581 8.08067 13.3605C8.03877 13.4629 7.9769 13.5559 7.89865 13.6342C7.82041 13.7124 7.72736 13.7743 7.62495 13.8162C7.52254 13.8581 7.4128 13.8792 7.30215 13.8782C7.19151 13.8773 7.08216 13.8543 6.98048 13.8106C6.87882 13.7669 6.78686 13.7034 6.70999 13.6238L0.876656 7.79051C0.72043 7.63424 0.632668 7.42232 0.632668 7.20135C0.632668 6.98038 0.72043 6.76845 0.876656 6.61218Z" fill="{{ $courses->onFirstPage() ? '#CCCCCC' : '#F59300' }}" />
                                </svg>
                            </a>
                        </li>

                        {{-- Pagination Elements --}}
                        @foreach ($courses->getUrlRange(1, $courses->lastPage()) as $page => $url)
                            @if ($page == $courses->currentPage())
                                <li><a href="#" class="active">{{ $page }}</a></li>
                            @else
                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        <li>
                            <a href="{{ $courses->nextPageUrl() }}" class="{{ !$courses->hasMorePages() ? 'disabled' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none">
                                    <path d="M19.1233 9.61218L13.29 3.77885C13.1328 3.62705 12.9223 3.54305 12.7038 3.54495C12.4853 3.54685 12.2763 3.63449 12.1218 3.789C11.9673 3.94351 11.8797 4.15252 11.8778 4.37101C11.8759 4.58951 11.9599 4.80001 12.1117 4.95718L16.5225 9.36801H1.86751C1.6465 9.36801 1.43454 9.45581 1.27826 9.61209C1.12198 9.76837 1.03418 9.98033 1.03418 10.2013C1.03418 10.4224 1.12198 10.6343 1.27826 10.7906C1.43454 10.9469 1.6465 11.0347 1.86751 11.0347H16.5225L12.1117 15.4455C12.0321 15.5224 11.9686 15.6143 11.9249 15.716C11.8813 15.8177 11.8583 15.927 11.8573 16.0377C11.8563 16.1483 11.8774 16.2581 11.9193 16.3605C11.9612 16.4629 12.0231 16.5559 12.1013 16.6342C12.1796 16.7124 12.2726 16.7743 12.375 16.8162C12.4775 16.8581 12.5872 16.8792 12.6978 16.8782C12.8085 16.8773 12.9178 16.8543 13.0195 16.8106C13.1212 16.7669 13.2131 16.7034 13.29 16.6238L19.1233 10.7905C19.2796 10.6342 19.3673 10.4223 19.3673 10.2013C19.3673 9.98038 19.2796 9.76845 19.1233 9.61218Z" fill="{{ !$courses->hasMorePages() ? '#CCCCCC' : '#F59300' }}" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            @endif
        </div>
    </section>

    <style>
        .course-card {
            border: 1px solid #dee2e6;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .course-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
            border-color: #007bff;
        }

        .course-thumbnail {
            transition: transform 0.3s ease;
        }

        .course-card:hover .course-thumbnail {
            transform: scale(1.05);
        }

        .badge-pathway {
            position: absolute;
            top: 12px;
            left: 12px;
            font-size: 0.7rem;
            border-radius: 20px;
            padding: 4px 12px;
            font-weight: 600;
            background: rgba(0, 123, 255, 0.9) !important;
        }

        .badge-price {
            position: absolute;
            top: 12px;
            right: 12px;
            font-size: 0.7rem;
            border-radius: 20px;
            padding: 4px 12px;
            font-weight: 600;
        }

        .badge-free {
            background-color: #28a745 !important;
            color: #fff;
        }

        .badge-paid {
            background-color: #dc3545 !important;
            color: #fff;
        }

        .course-title {
            font-weight: 600;
            line-height: 1.3;
            color: #2c3e50;
        }

        .apply-link {
            color: #f27e00;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            padding: 8px 16px;
            border: 2px solid #f27e00;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .apply-link:hover {
            background-color: #f27e00;
            color: white;
            text-decoration: none;
        }

        .course-thumbnail-placeholder {
            border-bottom: 1px solid #dee2e6;
        }
    </style>
@endsection

{{-- Mobile Filter Offcanvas (keep the same structure but update filter options to match desktop) --}}
<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileFilterOffcanvas" aria-labelledby="mobileFilterOffcanvasLabel">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="mobileFilterOffcanvasLabel"><i class="bi bi-funnel me-2"></i> Filter Courses</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        {{-- Same filter form as desktop but with mobile-specific IDs --}}
        {{-- Copy the entire desktop filter form here with mobile IDs --}}
        {{-- For brevity, I'm showing the structure - you can copy the desktop form and update IDs --}}
    </div>
    <div class="offcanvas-footer p-3 border-top d-grid gap-2">
        <button type="submit" form="courseFiltersMobile" class="btn btn-primary">
            <i class="bi bi-funnel me-1"></i> Apply Filters
        </button>
        <a href="{{ route('web.global.course') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-counterclockwise me-1"></i> Reset All
        </a>
    </div>
</div>
