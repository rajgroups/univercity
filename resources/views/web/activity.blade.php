@extends('layouts.web.app')
@push('meta')
    <title>Events & Competitions - Indian Skill Institute Co-operation (ISICO)</title>

    <meta name="description" content="Explore events and competitions by the Indian Skill Institute Co-operation (ISICO), designed to promote skill development, innovation, and entrepreneurship. Join national-level contests, workshops, and challenges that empower individuals to showcase their talents and contribute to India's growth.">
    <meta name="keywords" content="ISICO events, ISICO competitions, skill competitions, workshops, innovation, entrepreneurship, contests, Indian Skill Institute, national competitions, youth empowerment">
    <meta name="author" content="Indian Skill Institute Co-operation (ISICO)">
    <meta name="robots" content="index, follow">

    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:title" content="Events & Competitions - Indian Skill Institute Co-operation (ISICO)">
    <meta property="og:description" content="Discover ISICO's events and competitions that foster skill development, creativity, and entrepreneurship. Participate in workshops, challenges, and contests shaping India's future talent.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('default-event.jpg') }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Events & Competitions - Indian Skill Institute Co-operation (ISICO)">
    <meta name="twitter:description" content="Be part of ISICO's national-level events and competitions that drive innovation, entrepreneurship, and skill development across India.">
    <meta name="twitter:image" content="{{ asset('default-event.jpg') }}">
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

        /* Modern event card styling */
        .event-card {
            border: 1px solid #e9ecef;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            background: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .event-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
            border-color: #dee2e6;
        }

        .event-image {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }

        .badge-type {
            font-size: 0.75rem;
            border-radius: 20px;
            padding: 4px 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            z-index: 10;
        }

        .badge {
            border-radius: 20px;
            padding: 4px 12px;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .event-date {
            bottom: -15px;
            left: 15px;
            background: white;
            border-radius: 10px;
            padding: 8px 12px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            z-index: 10;
            width: 60px;
        }

        .event-day {
            display: block;
            font-weight: 800;
            font-size: 1.5rem;
            line-height: 1;
            color: #333;
        }

        .event-month {
            display: block;
            font-size: 0.85rem;
            text-transform: uppercase;
            color: #666;
            font-weight: 600;
            margin-top: 2px;
        }

        /* Make cards equal height */
        .row.g-4 {
            display: flex;
            flex-wrap: wrap;
        }

        .row.g-4 > div {
            display: flex;
        }

        /* Mobile responsive adjustments */
        @media (max-width: 768px) {
            .modern-page-banner {
                min-height: 250px;
            }
            .modern-banner-title {
                font-size: 2.5rem;
            }
            .event-image {
                height: 180px;
            }
            .event-date {
                width: 55px;
                padding: 6px 10px;
            }
            .event-day {
                font-size: 1.3rem;
            }
            .event-month {
                font-size: 0.8rem;
            }
        }

        @media (max-width: 576px) {
            .event-image {
                height: 160px;
            }
            .event-date {
                bottom: -12px;
                left: 10px;
                width: 50px;
                padding: 5px 8px;
            }
        }

        /* Custom Dropdown Styles */
        .wrapper-dropdown {
            position: relative;
            cursor: pointer;
            padding: 8px 15px;
            background: #fff;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            user-select: none;
            min-width: 180px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 42px; /* Match standard input height */
        }

        .wrapper-dropdown .topbar-dropdown {
            position: absolute;
            top: 105%;
            left: 0;
            right: 0;
            background: #fff;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            list-style: none;
            padding: 5px 0;
            margin: 0;
            display: none;
            z-index: 1050; /* Higher than most Bootstrap elements */
            box-shadow: 0 10px 15px rgba(0,0,0,0.1);
        }

        .wrapper-dropdown.active .topbar-dropdown {
            display: block !important;
        }

        .wrapper-dropdown .topbar-dropdown .item {
            padding: 8px 15px;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 0.95rem;
            color: #212529;
        }

        .wrapper-dropdown .topbar-dropdown .item:hover {
            background-color: #f8f9fa;
            color: var(--bs-primary);
        }

        .wrapper-dropdown .selected-display {
            font-weight: 500;
            font-size: 0.95rem;
            color: #212529;
        }

        .wrapper-dropdown svg {
            transition: transform 0.3s ease;
        }

        .wrapper-dropdown.active svg {
            transform: rotate(180deg);
        }
    </style>

    <!-- Title Banner Section Start -->
    <section class="modern-page-banner" style="background-image: url('{{ asset('resource/web/assets/media/banner/event-bg.jpg') }}'), url('https://images.unsplash.com/photo-1544531586-fde5298cdd40?q=80&w=2070&auto=format&fit=crop');">
        <div class="modern-banner-content" data-aos="fade-up">
            <div class="modern-breadcrumb">
                <a href="{{ url('/') }}">Home</a>
                <span class="mx-2">/</span>
                <span class="text-white">Events & Competitions</span>
            </div>
            <h1 class="modern-banner-title">Events & Competitions</h1>
            <p class="text-white opacity-75 lead" style="max-width: 600px; margin: 0 auto;">Join ISICO's national-level events and competitions that drive innovation, entrepreneurship, and skill development.</p>
        </div>
    </section>

    <!-- Events Section -->
    <section class="events-sec mb-120">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-sm-between justify-content-center row-gap-4 flex-wrap mb-24">
                <h4 class="text-center">Upcoming Events & Competitions</h4>
                <div class="d-flex align-items-center gap-8">
                    {{-- MOBILE FILTER BUTTON --}}
                    <button class="btn btn-outline-primary d-md-none me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileFilterOffcanvas" aria-controls="mobileFilterOffcanvas">
                        <i class="bi bi-funnel"></i> Filters
                    </button>
                    {{-- END MOBILE FILTER BUTTON --}}

                    {{-- BOOTSTRAP DROPDOWN REPLACEMENT --}}
                    <div class="dropdown w-100 drop-container" style="max-width: 250px;">
                        <button class="btn bg-white border d-flex align-items-center justify-content-between w-100 py-2 px-3 rounded-3" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="selected-display text-dark fw-medium" id="currentSortLabel">Newest First</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M19.7337 4.81165C19.3788 4.45668 18.8031 4.45662 18.4481 4.81171L10.0002 13.2598L1.55191 4.81165C1.19694 4.45668 0.621303 4.45662 0.266273 4.81171C-0.0887576 5.16674 -0.0887576 5.74232 0.266273 6.09735L9.35742 15.1883C9.52791 15.3587 9.75912 15.4545 10.0002 15.4545C10.2413 15.4545 10.4726 15.3587 10.643 15.1882L19.7337 6.09729C20.0888 5.74232 20.0888 5.16668 19.7337 4.81165Z" fill="#92949F"/>
                            </svg>
                        </button>
                        <ul class="dropdown-menu w-100 shadow border-0 mt-1 p-1" style="border-radius: 8px;">
                            <li><a class="dropdown-item sort-option rounded-2 py-2" href="#" data-value="newest_first">Newest First</a></li>
                            <li><a class="dropdown-item sort-option rounded-2 py-2" href="#" data-value="date_soonest">Date (Soonest)</a></li>
                            <li><a class="dropdown-item sort-option rounded-2 py-2" href="#" data-value="popular">Popular</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Desktop Filters Column -->
                <div class="col-md-3 d-none d-md-block">
                    <form action="{{ route('web.activity') }}" method="GET" id="eventFiltersDesktop">
                        <input type="hidden" name="sort" id="sortInput" value="{{ request('sort', 'newest_first') }}">
                        
                        <!-- Search Box -->
                        <div class="mb-4">
                            <label for="search_desktop" class="form-label small text-muted">Search Events</label>
                            <div class="input-group">
                                <input type="text" id="search_desktop" class="form-control" name="search" placeholder="Search events..." value="{{ request('search') }}">
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Filters Accordion -->
                        <div class="accordion" id="filterAccordionDesktop">
                            <!-- Activity Type Filter -->
                            <div class="accordion-item border-0 mb-3 shadow-sm">
                                <h2 class="accordion-header" id="headingTypeDesktop">
                                    <button class="accordion-button collapsed shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTypeDesktop" aria-expanded="false" data-bs-parent="#filterAccordionDesktop">
                                        <i class="bi bi-tag me-2"></i> Activity Type
                                        <span class="badge bg-primary ms-auto">{{ count(request('types', [])) }}</span>
                                    </button>
                                </h2>
                                <div id="collapseTypeDesktop" class="accordion-collapse collapse {{ count(request('types', [])) ? 'show' : '' }}" aria-labelledby="headingTypeDesktop" data-bs-parent="#filterAccordionDesktop">
                                    <div class="accordion-body pt-2">
                                        @foreach ([1 => 'Event', 2 => 'Competition'] as $value => $label)
                                            <div class="form-check mb-2">
                                                <input
                                                    class="form-check-input"
                                                    type="checkbox"
                                                    name="types[]"
                                                    id="typeDesktop{{ $value }}"
                                                    value="{{ $value }}"
                                                    {{ in_array($value, request('types', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="typeDesktop{{ $value }}">
                                                    {{ $label }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Date Range Filter -->
                            <div class="accordion-item border-0 mb-3 shadow-sm">
                                <h2 class="accordion-header" id="headingDateDesktop">
                                    <button class="accordion-button collapsed shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDateDesktop" aria-expanded="false" data-bs-parent="#filterAccordionDesktop">
                                        <i class="bi bi-calendar me-2"></i> Date Range
                                    </button>
                                </h2>
                                <div id="collapseDateDesktop" class="accordion-collapse collapse" aria-labelledby="headingDateDesktop" data-bs-parent="#filterAccordionDesktop">
                                    <div class="accordion-body pt-2">
                                        <div class="mb-3">
                                            <label class="form-label small">From</label>
                                            <input type="date" class="form-control form-control-sm" name="start_date" value="{{ request('start_date') }}">
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label small">To</label>
                                            <input type="date" class="form-control form-control-sm" name="end_date" value="{{ request('end_date') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Category Filter -->
                            <div class="accordion-item border-0 mb-3 shadow-sm">
                                <h2 class="accordion-header" id="headingCategoryDesktop">
                                    <button class="accordion-button collapsed shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCategoryDesktop" aria-expanded="false" data-bs-parent="#filterAccordionDesktop">
                                        <i class="bi bi-collection me-2"></i> Category
                                        <span class="badge bg-primary ms-auto">{{ count(request('categories', [])) }}</span>
                                    </button>
                                </h2>
                                <div id="collapseCategoryDesktop" class="accordion-collapse collapse {{ count(request('categories', [])) ? 'show' : '' }}" aria-labelledby="headingCategoryDesktop" data-bs-parent="#filterAccordionDesktop">
                                    <div class="accordion-body pt-2">
                                        @foreach ($categories as $category)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" name="categories[]" id="catDesktop{{ $category->id }}" value="{{ $category->id }}" {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label d-flex justify-content-between w-100" for="catDesktop{{ $category->id }}">
                                                    <span>{{ $category->name }}</span>
                                                    <span class="text-muted small">{{ $category->events_count ?? 0 }}</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-funnel me-1"></i> Apply Filters
                            </button>
                            <a href="{{ route('web.activity') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-counterclockwise me-1"></i> Reset All
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Events Grid Column -->
                <div class="col-12 col-md-9">
                    <div class="row g-2">
                        @forelse ($events as $event)
                            <div class="col-sm-6 col-lg-4 mb-4">
                                <!-- Event Card Container -->
                                <div class="event-card position-relative h-100">
                                    <!-- Event Image Section -->
                                    <div class="position-relative">
                                        <img src="{{ asset($event->thumbnail_image) }}" class="w-100 event-image" alt="{{ $event->title }}">
                                        
                                        <!-- Event Type Badge -->
                                        <span class="badge badge-type bg-primary position-absolute top-0 start-0 m-2">
                                            {{ $event->type == 1 ? 'Event' : 'Competition' }}
                                        </span>
                                        
                                        <!-- Event Status Badge -->
                                        @php
                                            $statusLabel = match($event->status) {
                                                1 => 'Upcoming',
                                                2 => 'Ongoing',
                                                3 => 'Completed',
                                                4 => 'Cancelled',
                                                default => 'Draft'
                                            };
                                            $statusClass = match($event->status) {
                                                1 => 'bg-info',
                                                2 => 'bg-success',
                                                3 => 'bg-secondary',
                                                4 => 'bg-danger',
                                                default => 'bg-secondary'
                                            };
                                        @endphp
                                        <span class="badge position-absolute top-0 end-0 m-2 {{ $statusClass }}">
                                            {{ $statusLabel }}
                                        </span>

                                        <!-- Event Date Badge -->
                                        <div class="event-date position-absolute start-0">
                                            <span class="event-day d-block">{{ $event->start_date->format('d') }}</span>
                                            <span class="event-month d-block">{{ $event->start_date->format('M') }}</span>
                                        </div>
                                    </div>

                                    <!-- Event Details Section -->
                                    <div class="p-3 d-flex flex-column flex-grow-1">
                                        <h6 class="mb-1 fw-bold text-dark">{{ Str::limit($event->title, 50) }}</h6>
                                        
                                        <p class="text-muted small mb-2">
                                            <i class="bi bi-building me-1"></i>{{ Str::limit($event->organizer, 40) }}
                                        </p>

                                        <!-- Location & Participants -->
                                        <div class="d-flex justify-content-between small text-muted mb-2">
                                            <span><i class="bi bi-geo-alt"></i> {{ Str::limit($event->location, 20) }}</span>
                                            <span><i class="bi bi-people"></i> {{ $event->max_participants ?? '∞' }}</span>
                                        </div>

                                        <!-- Date & Time -->
                                        <div class="d-flex justify-content-between small text-muted mb-2">
                                            <span><i class="bi bi-calendar"></i> {{ $event->start_date->format('M d') }}</span>
                                            <span><i class="bi bi-clock"></i> {{ $event->start_date->format('h:i A') }}</span>
                                        </div>

                                        <!-- Registration Deadline -->
                                        <div class="small text-muted mb-3">
                                            <i class="bi bi-alarm"></i> Reg. until: {{ $event->registration_deadline->format('M d, Y') }}
                                        </div>

                                        <!-- Price & Action Button -->
                                        <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top">
                                            @if($event->entry_fee > 0)
                                                <span class="text-primary fw-bold fs-6">
                                                    ₹{{ fmod($event->entry_fee, 1) == 0 ? number_format($event->entry_fee, 0) : number_format($event->entry_fee, 2) }}
                                                </span>
                                            @else
                                                <span class="badge bg-success">Free</span>
                                            @endif

                                            <a href="{{ route('web.activity.show', $event->slug) }}" class="btn btn-sm btn-outline-primary">
                                                Details <i class="bi bi-arrow-right ms-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info text-center py-5">
                                    <i class="bi bi-calendar-x fs-1 d-block mb-3 text-primary"></i>
                                    <h5 class="mb-2">No events found</h5>
                                    <p class="mb-0 text-muted">Try adjusting your filters or check back later for upcoming events.</p>
                                    <a href="{{ route('web.activity') }}" class="btn btn-primary mt-3">
                                        <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Filters
                                    </a>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    @if($events->count())
                        <div class="pagination mt-5">
                            <ul id="border-pagination" class="mb-0 justify-content-center">
                                {{-- Previous Page Link --}}
                                <li>
                                    <a href="{{ $events->previousPageUrl() }}" class="{{ $events->onFirstPage() ? 'disabled' : '' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="14" viewBox="0 0 19 14" fill="none">
                                            <path d="M0.876656 6.61218L6.70999 0.778849C6.86716 0.62705 7.07766 0.543055 7.29616 0.544953C7.51465 0.546852 7.72366 0.634493 7.87817 0.789C8.03268 0.943507 8.12032 1.15252 8.12222 1.37101C8.12412 1.58951 8.04012 1.80001 7.88832 1.95718L3.47749 6.36801H18.1325C18.3535 6.36801 18.5655 6.45581 18.7217 6.61209C18.878 6.76837 18.9658 6.98033 18.9658 7.20135C18.9658 7.42236 18.878 7.63432 18.7217 7.7906C18.5655 7.94688 18.3535 8.03468 18.1325 8.03468H3.47749L7.88832 12.4455C7.96791 12.5224 8.0314 12.6143 8.07507 12.716C8.11875 12.8177 8.14174 12.927 8.1427 13.0377C8.14366 13.1483 8.12257 13.2581 8.08067 13.3605C8.03877 13.4629 7.9769 13.5559 7.89865 13.6342C7.82041 13.7124 7.72736 13.7743 7.62495 13.8162C7.52254 13.8581 7.4128 13.8792 7.30215 13.8782C7.19151 13.8773 7.08216 13.8543 6.98048 13.8106C6.87882 13.7669 6.78686 13.7034 6.70999 13.6238L0.876656 7.79051C0.72043 7.63424 0.632668 7.42232 0.632668 7.20135C0.632668 6.98038 0.72043 6.76845 0.876656 6.61218Z" fill="{{ $events->onFirstPage() ? '#CCCCCC' : '#F59300' }}"/>
                                        </svg>
                                    </a>
                                </li>

                                {{-- Pagination Elements --}}
                                @foreach ($events->getUrlRange(1, $events->lastPage()) as $page => $url)
                                    @if ($page == $events->currentPage())
                                        <li><a href="#" class="active">{{ $page }}</a></li>
                                    @else
                                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                <li>
                                    <a href="{{ $events->nextPageUrl() }}" class="{{ !$events->hasMorePages() ? 'disabled' : '' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none">
                                            <path d="M19.1233 9.61218L13.29 3.77885C13.1328 3.62705 12.9223 3.54305 12.7038 3.54495C12.4853 3.54685 12.2763 3.63449 12.1218 3.789C11.9673 3.94351 11.8797 4.15252 11.8778 4.37101C11.8759 4.58951 11.9599 4.80001 12.1117 4.95718L16.5225 9.36801H1.86751C1.6465 9.36801 1.43454 9.45581 1.27826 9.61209C1.12198 9.76837 1.03418 9.98033 1.03418 10.2013C1.03418 10.4224 1.12198 10.6343 1.27826 10.7906C1.43454 10.9469 1.6465 11.0347 1.86751 11.0347H16.5225L12.1117 15.4455C12.0321 15.5224 11.9686 15.6143 11.9249 15.716C11.8813 15.8177 11.8583 15.927 11.8573 16.0377C11.8563 16.1483 11.8774 16.2581 11.9193 16.3605C11.9612 16.4629 12.0231 16.5559 12.1013 16.6342C12.1796 16.7124 12.2726 16.7743 12.375 16.8162C12.4775 16.8581 12.5872 16.8792 12.6978 16.8782C12.8085 16.8773 12.9178 16.8543 13.0195 16.8106C13.1212 16.7669 13.2131 16.7034 13.29 16.6238L19.1233 10.7905C19.2796 10.6342 19.3673 10.4223 19.3673 10.2013C19.3673 9.98038 19.2796 9.76845 19.1233 9.61218Z" fill="{{ !$events->hasMorePages() ? '#CCCCCC' : '#F59300' }}"/>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

<!-- Mobile Filter Offcanvas -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileFilterOffcanvas" aria-labelledby="mobileFilterOffcanvasLabel">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="mobileFilterOffcanvasLabel"><i class="bi bi-sliders me-2"></i> Filter Events</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body" id="offcanvasFilterBody">
        {{-- Mobile filter form will be inserted here by JavaScript --}}
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Sorting functionality for Bootstrap dropdown
        $('.sort-option').on('click', function(e) {
            e.preventDefault();
            var sortValue = $(this).data('value');
            var sortText = $(this).text();
            
            // Update dropdown display
            $('#currentSortLabel').text(sortText);
            
            // Update hidden input
            $('#sortInput').val(sortValue);
            
            // Submit form
            $('#eventFiltersDesktop').submit();
        });

        // Initialize current sort label
        var currentSort = "{{ request('sort', 'newest_first') }}";
        var currentItem = $('.sort-option[data-value="' + currentSort + '"]');
        if(currentItem.length) {
            $('#currentSortLabel').text(currentItem.text());
        }

        // Mobile filter form cloning
        var $desktopForm = $('#eventFiltersDesktop');
        
        if ($desktopForm.length) {
            // Clone the desktop form
            var $mobileForm = $desktopForm.clone();
            
            // Update IDs to avoid conflicts
            $mobileForm.attr('id', 'eventFiltersMobile');
            
            // Update all element IDs
            $mobileForm.find('[id]').each(function() {
                var oldId = $(this).attr('id');
                var newId = 'mobile_' + oldId;
                $(this).attr('id', newId);
                
                // Update related attributes
                var $this = $(this);
                
                // Update for attributes
                if ($this.is('label')) {
                    var forAttr = $this.attr('for');
                    if (forAttr) {
                        $this.attr('for', 'mobile_' + forAttr);
                    }
                }
                
                // Update data-bs-target attributes
                var target = $this.attr('data-bs-target');
                if (target) {
                    $this.attr('data-bs-target', target.replace('#', '#mobile_'));
                }
                
                // Update aria-labelledby attributes
                var labelledBy = $this.attr('aria-labelledby');
                if (labelledBy) {
                    $this.attr('aria-labelledby', 'mobile_' + labelledBy);
                }
                
                // Update aria-controls attributes
                var controls = $this.attr('aria-controls');
                if (controls) {
                    $this.attr('aria-controls', 'mobile_' + controls);
                }
            });
            
            // Update data-bs-parent attributes
            $mobileForm.find('[data-bs-parent]').each(function() {
                var parent = $(this).attr('data-bs-parent');
                if (parent) {
                    $(this).attr('data-bs-parent', parent.replace('#', '#mobile_'));
                }
            });
            
            // Remove desktop action buttons
            $mobileForm.find('.d-grid.gap-2.mt-4').remove();
            
            // Insert into offcanvas
            $('#offcanvasFilterBody').html($mobileForm);
            
            // Add mobile action buttons
            var $footer = $(`
                <div class="offcanvas-footer p-3 border-top bg-white sticky-bottom">
                    <div class="d-grid gap-2">
                        <button type="submit" form="eventFiltersMobile" class="btn btn-primary">
                            <i class="bi bi-funnel me-1"></i> Apply Filters
                        </button>
                        <a href="{{ route('web.activity') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-counterclockwise me-1"></i> Reset All
                        </a>
                    </div>
                </div>
            `);
            
            $('#mobileFilterOffcanvas').append($footer);
        }
            $('#desation112').text(sortText);
            
            // Update hidden input
            $('#sortInput').val(sortValue);
            
            // Close dropdown
            $('#dropdown-l2').removeClass('active');
            
            // Submit form
            $('#eventFiltersDesktop').submit();
        });
        
        // Initialize current sort display
        var currentSort = "{{ request('sort', 'newest_first') }}";
        var currentItem = $('.topbar-dropdown .item[data-value="' + currentSort + '"]');
        if(currentItem.length) {
            $('#desation112').text(currentItem.text());
        }
        
        // Dropdown toggle
        $('#dropdown-l2').on('click', function(e) {
            e.preventDefault();
            $(this).toggleClass('active');
        });
        
        // Close dropdown when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#dropdown-l2').length) {
                $('#dropdown-l2').removeClass('active');
            }
        });
    });
</script>
@endpush