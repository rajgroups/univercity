@extends('layouts.web.app')
@push('meta')
    <title>Courses - Indian Skill Institute Co-operation (ISICO)</title>

    <meta name="description" content="Explore professional courses offered by the Indian Skill Institute Co-operation (ISICO). Our programs focus on skill development, education, entrepreneurship, and innovation to prepare learners for future opportunities.">
    <meta name="keywords" content="ISICO courses, Indian Skill Institute courses, skill development training, education programs, entrepreneurship courses, professional learning, career development, innovation, NEP 2020">
    <meta name="author" content="Indian Skill Institute Co-operation (ISICO)">
    <meta name="robots" content="index, follow">

    <!-- Canonical Tag -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:title" content="Courses - Indian Skill Institute Co-operation (ISICO)">
    <meta property="og:description" content="Discover ISICO’s skill development and professional courses designed to empower learners with practical knowledge, entrepreneurship, and career opportunities.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('default-courses.jpg') }}">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Courses - Indian Skill Institute Co-operation (ISICO)">
    <meta name="twitter:description" content="Join ISICO’s education and skill development courses to build knowledge, innovation, and entrepreneurial skills for the future.">
    <meta name="twitter:image" content="{{ asset('default-courses.jpg') }}">
@endpush

@section('content')
    <!-- Title Banner Section Start -->
    <section class="title-banner mb-80">
        <div class="container-fluid">
            <h1>All Courses</h1>
        </div>
    </section>
    <!-- Title Banner Section End -->
    <!-- Couse Section Start -->
    <section class="couses-sec mb-120">
        <div class="container-fluid">
            <div
                class="d-flex align-items-center justify-content-sm-between justify-content-center row-gap-4 flex-wrap mb-24">
                <h4 class="text-center">Skill courses</h4>
                <div class="d-flex align-items-center gap-8">
                    <p class="flex-shrink-0 m-4">Sort By:</p>
                    <div class="w-100 drop-container">
                        <div class="wrapper-dropdown form-control" id="dropdown-l2">
                            <div class=" d-flex align-items-center justify-content-between gap-64">
                                <span class="selected-display black" id="desation112">Newest First</span>
                                <svg id="drop-down2" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 20 20" fill="none">
                                    <path
                                        d="M19.7337 4.81165C19.3788 4.45668 18.8031 4.45662 18.4481 4.81171L10.0002 13.2598L1.55191 4.81165C1.19694 4.45668 0.621303 4.45662 0.266273 4.81171C-0.0887576 5.16674 -0.0887576 5.74232 0.266273 6.09735L9.35742 15.1883C9.52791 15.3587 9.75912 15.4545 10.0002 15.4545C10.2413 15.4545 10.4726 15.3587 10.643 15.1882L19.7337 6.09729C20.0888 5.74232 20.0888 5.16668 19.7337 4.81165Z"
                                        fill="#92949F" />
                                </svg>
                            </div>
                            <ul class="topbar-dropdown">
                                <li class="item">Newest First</li>
                                <li class="item">Newest Last</li>
                                <li class="item">End</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Sidebar Filters -->
                <div class="col-md-3">
                    <form action="{{ route('web.course.index') }}" method="GET" id="courseFilters">
                        <!-- Search Bar with Functional Input -->
                        <div class="mb-4">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search"
                                    placeholder="Search by course name..." value="{{ request('search') }}">
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>

                        <div class="accordion" id="filterAccordion">
                            <!-- Sector Filter -->
                            <div class="accordion-item border-0 mb-3 shadow-sm">
                                <h2 class="accordion-header" id="headingSector">
                                    <button class="accordion-button collapsed shadow-none" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseSector" aria-expanded="false">
                                        <i class="bi bi-grid me-2"></i> Sector
                                        <span class="badge bg-primary ms-auto">{{ count(request('sectors', [])) }}</span>
                                    </button>
                                </h2>
                                <div id="collapseSector"
                                    class="accordion-collapse collapse {{ count(request('sectors', [])) ? 'show' : '' }}"
                                    aria-labelledby="headingSector" data-bs-parent="#filterAccordion">
                                    <div class="accordion-body pt-2">
                                        @foreach ($sectors as $sector)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" name="sectors[]"
                                                    id="sector{{ $sector->id }}" value="{{ $sector->id }}"
                                                    {{ in_array($sector->id, request('sectors', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label d-flex justify-content-between w-100"
                                                    for="sector{{ $sector->id }}">
                                                    <span>{{ $sector->name }}</span>
                                                    <span class="text-muted small">{{ $sector->courses_count ?? 0 }}</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Language Filter -->
                            <div class="accordion-item border-0 mb-3 shadow-sm">
                                <h2 class="accordion-header" id="headingLang">
                                    <button class="accordion-button collapsed shadow-none" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseLang" aria-expanded="false">
                                        <i class="bi bi-translate me-2"></i> Language
                                        <span class="badge bg-primary ms-auto">{{ count(request('languages', [])) }}</span>
                                    </button>
                                </h2>
                                <div id="collapseLang"
                                    class="accordion-collapse collapse {{ count(request('languages', [])) ? 'show' : '' }}"
                                    aria-labelledby="headingLang" data-bs-parent="#filterAccordion">
                                    <div class="accordion-body pt-2">
                                        @foreach (['English', 'Tamil', 'Hindi'] as $language)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" name="languages[]"
                                                    id="lang{{ $loop->index }}" value="{{ $language }}"
                                                    {{ in_array($language, request('languages', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="lang{{ $loop->index }}">{{ $language }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Duration Filter -->
                            <div class="accordion-item border-0 mb-3 shadow-sm">
                                <h2 class="accordion-header" id="headingDuration">
                                    <button class="accordion-button collapsed shadow-none" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseDuration" aria-expanded="false">
                                        <i class="bi bi-clock me-2"></i> Duration
                                        <span class="badge bg-primary ms-auto">{{ count(request('durations', [])) }}</span>
                                    </button>
                                </h2>
                                <div id="collapseDuration"
                                    class="accordion-collapse collapse {{ count(request('durations', [])) ? 'show' : '' }}"
                                    aria-labelledby="headingDuration" data-bs-parent="#filterAccordion">
                                    <div class="accordion-body pt-2">
                                        @foreach (['1-2 Hours', '3+ Hours', '1-2 Weeks', '3+ Weeks'] as $duration)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" name="durations[]"
                                                    id="dur{{ $loop->index }}" value="{{ $duration }}"
                                                    {{ in_array($duration, request('durations', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="dur{{ $loop->index }}">{{ $duration }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Price Filter -->
                            <div class="accordion-item border-0 mb-3 shadow-sm">
                                <h2 class="accordion-header" id="headingPrice">
                                    <button class="accordion-button collapsed shadow-none" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapsePrice" aria-expanded="false">
                                        <i class="bi bi-currency-rupee me-2"></i> Price
                                        <span class="badge bg-primary ms-auto">{{ count(request('prices', [])) }}</span>
                                    </button>
                                </h2>
                                <div id="collapsePrice"
                                    class="accordion-collapse collapse {{ count(request('prices', [])) ? 'show' : '' }}"
                                    aria-labelledby="headingPrice" data-bs-parent="#filterAccordion">
                                    <div class="accordion-body pt-2">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="prices[]"
                                                id="priceFree" value="Free"
                                                {{ in_array('Free', request('prices', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="priceFree">Free</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="prices[]"
                                                id="pricePaid" value="Paid"
                                                {{ in_array('Paid', request('prices', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="pricePaid">Paid</label>
                                        </div>
                                        <div class="mt-3">
                                            <label class="form-label small">Price Range</label>
                                            <div class="d-flex align-items-center">
                                                <input type="number" name="min_price"
                                                    class="form-control form-control-sm" placeholder="Min"
                                                    value="{{ request('min_price') }}">
                                                <span class="mx-2">-</span>
                                                <input type="number" name="max_price"
                                                    class="form-control form-control-sm" placeholder="Max"
                                                    value="{{ request('max_price') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Filter Controls -->
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-funnel me-1"></i> Apply Filters
                            </button>
                            <a href="{{ route('web.course.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-counterclockwise me-1"></i> Reset All
                            </a>
                        </div>
                    </form>
                </div>
                <!-- Courses Cards -->
                <div class="col-md-9">
                    <div class="row g-4">
                        <div class="row">
                            @foreach ($courses as $course)
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="course-card position-relative bg-white">
                                        <!-- Course Image -->
                                        <img src="{{ asset($course->image) }}" class="w-100" alt="{{ $course->name }}">

                                        <!-- Badges -->
                                        <span class="badge badge-online bg-danger">
                                            {{ $course->learning_product_type === 'Online' ? 'Online' : 'Offline' }}
                                        </span>
                                        <span
                                            class="badge badge-price {{ $course->paid_type === 'Free' ? 'badge-free' : 'badge-paid' }}">
                                            {{ $course->paid_type }}
                                        </span>

                                        <div class="p-3">
                                            <!-- Course Title -->
                                            <h6 class="mb-1">{{ $course->name }}</h6>

                                            <!-- Provider -->
                                            <p class="text-muted small mb-1">{{ $course->provider }}</p>

                                            <!-- Sector -->
                                            <p class="text-warning small mb-1">
                                                {{ $course->sector->name ?? 'No Sector' }}
                                            </p>

                                            <!-- Language and Duration -->
                                            <div class="d-flex justify-content-between small text-muted">
                                                <span>{{ $course->language }}</span>
                                                <span><i class="bi bi-clock"></i> {{ $course->duration }}</span>
                                            </div>

                                            <!-- Credits and Rating -->
                                            <div class="d-flex justify-content-between mt-2">
                                                <span class="text-muted small">
                                                    {{ $course->credits_assigned ?? 'No Credit' }}
                                                </span>
                                                <span class="rating-stars">★ 0.0 (0 review)</span>
                                            </div>

                                            <!-- Apply Button -->
                                            <div class="mt-2">
                                                <a href="{{ route('web.course.show', $course->slug) }}" class="apply-link">
                                                    Apply →
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <style>
                .course-card {
                    border: 1px solid #dee2e6;
                    border-radius: 10px;
                    overflow: hidden;
                    transition: 0.3s;
                }

                .course-card:hover {
                    transform: translateY(-5px);
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }

                .badge-online {
                    position: absolute;
                    top: 10px;
                    left: 10px;
                    background: white;
                    font-size: 0.75rem;
                    border-radius: 20px;
                    padding: 3px 10px;
                    font-weight: 500;
                }

                .badge-price {
                    position: absolute;
                    top: 10px;
                    right: 10px;
                    font-size: 0.75rem;
                    border-radius: 20px;
                    padding: 3px 10px;
                    font-weight: 500;
                }

                .badge-free {
                    background-color: #28a745;
                    color: #fff;
                }

                .badge-paid {
                    background-color: #0039a6;
                    color: #fff;
                }

                .apply-link {
                    color: #f27e00;
                    font-weight: 600;
                    font-size: 0.875rem;
                }

                .rating-stars {
                    font-size: 0.875rem;
                    color: #007bff;
                }
            </style>
            <div class="pagination mt-3">
                <ul id="border-pagination" class="mb-0">
                    {{-- Previous Page Link --}}
                    <li>
                        <a href="{{ $courses->previousPageUrl() }}"
                            class="{{ $courses->onFirstPage() ? 'disabled' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="14" viewBox="0 0 19 14"
                                fill="none">
                                <path
                                    d="M0.876656 6.61218L6.70999 0.778849C6.86716 0.62705 7.07766 0.543055 7.29616 0.544953C7.51465 0.546852 7.72366 0.634493 7.87817 0.789C8.03268 0.943507 8.12032 1.15252 8.12222 1.37101C8.12412 1.58951 8.04012 1.80001 7.88832 1.95718L3.47749 6.36801H18.1325C18.3535 6.36801 18.5655 6.45581 18.7217 6.61209C18.878 6.76837 18.9658 6.98033 18.9658 7.20135C18.9658 7.42236 18.878 7.63432 18.7217 7.7906C18.5655 7.94688 18.3535 8.03468 18.1325 8.03468H3.47749L7.88832 12.4455C7.96791 12.5224 8.0314 12.6143 8.07507 12.716C8.11875 12.8177 8.14174 12.927 8.1427 13.0377C8.14366 13.1483 8.12257 13.2581 8.08067 13.3605C8.03877 13.4629 7.9769 13.5559 7.89865 13.6342C7.82041 13.7124 7.72736 13.7743 7.62495 13.8162C7.52254 13.8581 7.4128 13.8792 7.30215 13.8782C7.19151 13.8773 7.08216 13.8543 6.98048 13.8106C6.87882 13.7669 6.78686 13.7034 6.70999 13.6238L0.876656 7.79051C0.72043 7.63424 0.632668 7.42232 0.632668 7.20135C0.632668 6.98038 0.72043 6.76845 0.876656 6.61218Z"
                                    fill="{{ $courses->onFirstPage() ? '#CCCCCC' : '#F59300' }}" />
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
                        <a href="{{ $courses->nextPageUrl() }}"
                            class="{{ !$courses->hasMorePages() ? 'disabled' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21"
                                fill="none">
                                <path
                                    d="M19.1233 9.61218L13.29 3.77885C13.1328 3.62705 12.9223 3.54305 12.7038 3.54495C12.4853 3.54685 12.2763 3.63449 12.1218 3.789C11.9673 3.94351 11.8797 4.15252 11.8778 4.37101C11.8759 4.58951 11.9599 4.80001 12.1117 4.95718L16.5225 9.36801H1.86751C1.6465 9.36801 1.43454 9.45581 1.27826 9.61209C1.12198 9.76837 1.03418 9.98033 1.03418 10.2013C1.03418 10.4224 1.12198 10.6343 1.27826 10.7906C1.43454 10.9469 1.6465 11.0347 1.86751 11.0347H16.5225L12.1117 15.4455C12.0321 15.5224 11.9686 15.6143 11.9249 15.716C11.8813 15.8177 11.8583 15.927 11.8573 16.0377C11.8563 16.1483 11.8774 16.2581 11.9193 16.3605C11.9612 16.4629 12.0231 16.5559 12.1013 16.6342C12.1796 16.7124 12.2726 16.7743 12.375 16.8162C12.4775 16.8581 12.5872 16.8792 12.6978 16.8782C12.8085 16.8773 12.9178 16.8543 13.0195 16.8106C13.1212 16.7669 13.2131 16.7034 13.29 16.6238L19.1233 10.7905C19.2796 10.6342 19.3673 10.4223 19.3673 10.2013C19.3673 9.98038 19.2796 9.76845 19.1233 9.61218Z"
                                    fill="{{ !$courses->hasMorePages() ? '#CCCCCC' : '#F59300' }}" />
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Couse Section End -->

    <!-- content @e -->
@endsection
