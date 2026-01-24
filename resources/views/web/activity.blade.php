@extends('layouts.web.app')
@push('meta')
    <title>Events & Competitions - Indian Skill Institute Co-operation (ISICO)</title>

    <meta name="description" content="Explore events and competitions by the Indian Skill Institute Co-operation (ISICO), designed to promote skill development, innovation, and entrepreneurship. Join national-level contests, workshops, and challenges that empower individuals to showcase their talents and contribute to India’s growth.">
    <meta name="keywords" content="ISICO events, ISICO competitions, skill competitions, workshops, innovation, entrepreneurship, contests, Indian Skill Institute, national competitions, youth empowerment">
    <meta name="author" content="Indian Skill Institute Co-operation (ISICO)">
    <meta name="robots" content="index, follow">

    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:title" content="Events & Competitions - Indian Skill Institute Co-operation (ISICO)">
    <meta property="og:description" content="Discover ISICO’s events and competitions that foster skill development, creativity, and entrepreneurship. Participate in workshops, challenges, and contests shaping India’s future talent.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('default-event.jpg') }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Events & Competitions - Indian Skill Institute Co-operation (ISICO)">
    <meta name="twitter:description" content="Be part of ISICO’s national-level events and competitions that drive innovation, entrepreneurship, and skill development across India.">
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
    <section class="modern-page-banner" style="background-image: url('{{ asset('resource/web/assets/media/banner/event-bg.jpg') }}'), url('https://images.unsplash.com/photo-1544531586-fde5298cdd40?q=80&w=2070&auto=format&fit=crop');">
        <div class="modern-banner-content" data-aos="fade-up">
            <div class="modern-breadcrumb">
                <a href="{{ url('/') }}">Home</a>
                <span class="mx-2">/</span>
                <span class="text-white">Events & Competitions</span>
            </div>
            <h1 class="modern-banner-title">Events & Competitions</h1>
            <p class="text-white opacity-75 lead" style="max-width: 600px; margin: 0 auto;">Join ISICO’s national-level events and competitions that drive innovation, entrepreneurship, and skill development.</p>
        </div>
    </section>
    <section class="events-sec mb-120">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-sm-between justify-content-center row-gap-4 flex-wrap mb-24">
                <h4 class="text-center">Upcoming Events & Competitions</h4>
                <div class="d-flex align-items-center gap-8">
                    {{-- MOBILE FILTER BUTTON: Visible only on devices smaller than md (d-md-none) --}}
                    <button class="btn btn-outline-primary d-md-none me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileFilterOffcanvas" aria-controls="mobileFilterOffcanvas">
                        <i class="bi bi-funnel"></i> Filters
                    </button>
                    {{-- END MOBILE FILTER BUTTON --}}

                    {{-- <p class="flex-shrink-0 m-4">Sort By:</p> --}}
                    <div class="w-100 drop-container">
                        <div class="wrapper-dropdown form-control" id="dropdown-l2">
                            <div class="d-flex align-items-center justify-content-between gap-64">
                                <span class="selected-display black" id="desation112">Newest First</span>
                                <svg id="drop-down2" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M19.7337 4.81165C19.3788 4.45668 18.8031 4.45662 18.4481 4.81171L10.0002 13.2598L1.55191 4.81165C1.19694 4.45668 0.621303 4.45662 0.266273 4.81171C-0.0887576 5.16674 -0.0887576 5.74232 0.266273 6.09735L9.35742 15.1883C9.52791 15.3587 9.75912 15.4545 10.0002 15.4545C10.2413 15.4545 10.4726 15.3587 10.643 15.1882L19.7337 6.09729C20.0888 5.74232 20.0888 5.16668 19.7337 4.81165Z" fill="#92949F"/>
                                </svg>
                            </div>
                            <ul class="topbar-dropdown">
                                <li class="item">Newest First</li>
                                <li class="item">Date (Soonest)</li>
                                <li class="item">Popular</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 d-none d-md-block">
                    <form action="{{ route('web.activity') }}" method="GET" id="eventFiltersDesktop">
                        <div class="mb-4">
                            <label for="search_desktop" class="form-label small text-muted">Search Events</label>
                            <div class="input-group">
                                <input type="text" id="search_desktop" class="form-control" name="search" placeholder="Search events..." value="{{ request('search') }}">
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>

                        <div class="accordion" id="filterAccordionDesktop">
                            <div class="accordion-item border-0 mb-3 shadow-sm">
                                <h2 class="accordion-header" id="headingTypeDesktop">
                                    <button class="accordion-button collapsed shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTypeDesktop" aria-expanded="false" data-bs-parent="#filterAccordionDesktop">
                                        <i class="bi bi-tag me-2"></i> Event Type
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

                <div class="col-12 col-md-9">
                    <div class="row g-4">
                        @forelse ($events as $event)
                            <div class="col-sm-6 col-lg-4 mb-4">
                                <div class="event-card position-relative bg-white">
                                    <img src="{{ asset($event->thumbnail_image) }}" class="w-100 event-image" alt="{{ $event->title }}">

                                    <span class="badge badge-type bg-primary">
                                        {{ $event->type }}
                                    </span>
                                    @if($event->is_competition)
                                        <span class="badge badge-competition bg-danger">
                                            Competition
                                        </span>
                                    @endif

                                    <div class="event-date">
                                        <span class="event-day">{{ $event->start_date->format('d') }}</span>
                                        <span class="event-month">{{ $event->start_date->format('M') }}</span>
                                    </div>

                                    <div class="p-3">
                                        <h6 class="mb-1">{{ $event->title }}</h6>

                                        <p class="text-muted small mb-1">{{ $event->organizer }}</p>

                                        <div class="d-flex justify-content-between small text-muted mb-2">
                                            <span><i class="bi bi-geo-alt"></i> {{ $event->location }}</span>
                                            <span><i class="bi bi-people"></i> {{ $event->max_participants ?? 'Unlimited' }}</span>
                                        </div>

                                        <div class="d-flex justify-content-between small text-muted mb-2">
                                            <span><i class="bi bi-calendar"></i> {{ $event->start_date->format('M d, Y') }}</span>
                                            <span><i class="bi bi-clock"></i> {{ $event->start_date->format('h:i A') }}</span>
                                        </div>

                                        <div class="small text-muted mb-2">
                                            <i class="bi bi-alarm"></i> Reg. until: {{ $event->registration_deadline->format('M d, Y') }}
                                        </div>

                                       <div class="d-flex justify-content-between align-items-center mt-3">
                                            @if($event->entry_fee > 0)
                                                <span class="text-primary fw-bold">₹{{ fmod($event->entry_fee, 1) == 0 ? number_format($event->entry_fee, 0) : number_format($event->entry_fee, 2) }}</span>
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
                                <div class="alert alert-info">
                                    No events found matching your criteria.
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="pagination mt-3">
                <ul id="border-pagination" class="mb-0">
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
        </div>
    </section>

    <style>
        .event-card {
            border: 1px solid #dee2e6;
            border-radius: 10px;
            overflow: hidden;
            transition: 0.3s;
            height: 100%;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .event-image {
            height: 180px;
            object-fit: cover;
        }

        .badge-type {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 0.75rem;
            border-radius: 20px;
            padding: 3px 10px;
            font-weight: 500;
        }

        .badge-competition {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 0.75rem;
            border-radius: 20px;
            padding: 3px 10px;
            font-weight: 500;
        }

        .event-date {
            position: absolute;
            top: 150px;
            left: 10px;
            background: white;
            border-radius: 8px;
            padding: 5px 10px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .event-day {
            display: block;
            font-weight: bold;
            font-size: 1.2rem;
            line-height: 1;
        }

        .event-month {
            display: block;
            font-size: 0.8rem;
            text-transform: uppercase;
            color: #666;
        }
    </style>
@endsection

{{-- ---------------------------------------------------------------------------------------------------------------------------------------------------------- --}}
{{-- MOBILE FILTER OFFCANVAS START --}}
<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileFilterOffcanvas" aria-labelledby="mobileFilterOffcanvasLabel">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="mobileFilterOffcanvasLabel"><i class="bi bi-sliders me-2"></i> Filter Events</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body" id="offcanvasFilterBody">
        {{-- The content of the desktop form will be cloned and inserted here by jQuery --}}
    </div>
</div>
{{-- MOBILE FILTER OFFCANVAS END --}}

{{-- ---------------------------------------------------------------------------------------------------------------------------------------------------------- --}}
{{-- JQUERY SCRIPT TO CLONE AND INSERT THE FORM --}}
@push('scripts')
<script>
    $(document).ready(function() {
        // 1. Target the desktop form
        var $desktopForm = $('#eventFiltersDesktop');

        if ($desktopForm.length) {
            // 2. Clone the entire desktop form, including the form tag and its current state/values
            var $mobileForm = $desktopForm.clone();

            // 3. Update the ID of the cloned form to ensure it's unique
            $mobileForm.attr('id', 'eventFiltersMobile');

            // 4. Update the IDs of all elements inside the cloned form to maintain HTML validity
            $mobileForm.find('input, select, button, a, div, h2').each(function() {
                var currentId = $(this).attr('id');
                if (currentId) {
                    $(this).attr('id', 'mobile_' + currentId);

                    // Also update the data-bs-target and aria-labelledby for accordion
                    if($(this).is('[data-bs-target]')) {
                        var target = $(this).attr('data-bs-target');
                        $(this).attr('data-bs-target', '#mobile_' + target.substring(1));
                    }
                    if($(this).is('[aria-labelledby]')) {
                        var labelledby = $(this).attr('aria-labelledby');
                        $(this).attr('aria-labelledby', 'mobile_' + labelledby);
                    }
                }
            });

            // Special handling for collapse elements to update data-bs-parent attribute
            $mobileForm.find('.accordion-collapse').each(function() {
                var parentId = $(this).attr('data-bs-parent');
                if(parentId) {
                    $(this).attr('data-bs-parent', '#mobile_' + parentId.substring(1));
                }
            });

            // 5. Remove the desktop submit/reset buttons from the cloned form body
            // We will add them to the offcanvas footer instead for a better mobile experience.
            $mobileForm.find('.d-grid.gap-2.mt-4').remove();

            // 6. Insert the cleaned, cloned form into the offcanvas body
            $('#offcanvasFilterBody').append($mobileForm);

            // 7. Add a sticky footer with the controls for the mobile form
            var $offcanvasFooter = $('<div class="offcanvas-footer p-3 border-top d-grid gap-2"></div>');

            // Recreate the Apply and Reset buttons targeting the cloned form ID
            var $applyButton = $(`
                <button type="submit" form="eventFiltersMobile" class="btn btn-primary">
                    <i class="bi bi-funnel me-1"></i> Apply Filters
                </button>
            `);
            var $resetLink = $(`
                <a href="{{ route('web.activity') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-counterclockwise me-1"></i> Reset All
                </a>
            `);

            $offcanvasFooter.append($applyButton).append($resetLink);

            // Append the new footer container directly to the offcanvas element
            $('#mobileFilterOffcanvas').append($offcanvasFooter);
        }
    });
</script>
@endpush
