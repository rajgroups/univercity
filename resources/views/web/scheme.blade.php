{{-- @dd($metaDescription) --}}
@extends('layouts.web.app')
@push('meta')
    <title>{{ $metaTitle ?? ($announcement->title ?? 'Default Page Title') }}</title>

    <meta name="description"
        content="{{ $metaDescription ?? Str::limit(strip_tags($announcement->description ?? ''), 150) }}">
    <meta name="keywords" content="{{ $metaKeywords ?? 'announcement, news, education' }}">
    <meta name="author" content="{{ $metaAuthor ?? 'YourSiteName' }}">
    <meta name="robots" content="{{ $metaRobots ?? 'index, follow' }}">

    <!-- Canonical Tag -->
    <link rel="canonical" href="{{ $metaCanonical ?? url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:title" content="{{ $metaOgTitle ?? ($announcement->title ?? 'Default OG Title') }}">
    <meta property="og:description"
        content="{{ $metaOgDescription ?? Str::limit(strip_tags($announcement->description ?? ''), 150) }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $metaOgUrl ?? url()->current() }}">
    <meta property="og:image" content="{{ $metaOgImage ?? asset($announcement->image ?? 'default.jpg') }}">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $metaTwitterTitle ?? ($announcement->title ?? 'Default Twitter Title') }}">
    <meta name="twitter:description"
        content="{{ $metaTwitterDescription ?? Str::limit(strip_tags($announcement->description ?? ''), 150) }}">
    <meta name="twitter:image" content="{{ $metaTwitterImage ?? asset($announcement->image ?? 'default.jpg') }}">
@endpush

@section('content')
<style>
    /* Enhanced Mobile-First Styles for Government Scheme */
    .title-banner {
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        padding: 4rem 0 2rem;
        position: relative;
    }

    .title-banner::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(13, 71, 161, 0.85) 0%, rgba(21, 101, 192, 0.7) 100%);
    }

    .title-banner .container-fluid {
        position: relative;
        z-index: 2;
    }

    .title-banner h2 {
        font-size: clamp(1.5rem, 4vw, 2.25rem);
        line-height: 1.3;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        color: white;
    }

    .color-primary {
        color: #FFD54F !important;
        font-weight: 600;
    }

    .light-gray {
        color: #e3f2fd !important;
        margin-bottom: 0;
    }

    /* Improved Carousel */
    .carousel-item img {
        height: min(50vh, 400px);
        object-fit: cover;
        border-radius: 0.75rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .carousel-indicators [data-bs-target] {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin: 0 0.25rem;
        background-color: #1565c0;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: #1565c0;
        border-radius: 50%;
        padding: 1rem;
    }

    /* Enhanced Navigation Sidebar */
    #navbar-example {
        border-radius: 0.75rem;
        box-shadow: 0 0.25rem 0.75rem rgba(0,0,0,0.1);
        border: 1px solid #e3f2fd;
        background: linear-gradient(135deg, #f8fbff 0%, #e3f2fd 100%);
        position: sticky;
        top: 6rem;
        max-height: calc(100vh - 8rem);
        overflow-y: auto;
    }

    #navbar-example .nav-link {
        color: #1565c0;
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        margin-bottom: 0.25rem;
        transition: all 0.2s ease-in-out;
        border-left: 3px solid transparent;
        font-weight: 500;
    }

    #navbar-example .nav-link:hover,
    #navbar-example .nav-link:focus {
        background-color: #bbdefb;
        color: #0d47a1;
        border-left-color: #0d47a1;
        transform: translateX(4px);
    }

    /* Content Sections */
    section[id^="section"] {
        padding: 1.5rem;
        background: white;
        border-radius: 0.75rem;
        box-shadow: 0 2px 8px rgba(13, 71, 161, 0.1);
        margin-bottom: 1.5rem;
        border-left: 4px solid #1565c0;
        transition: transform 0.2s ease-in-out;
    }

    section[id^="section"]:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(13, 71, 161, 0.15);
    }

    section[id^="section"] h4 {
        color: #0d47a1;
        margin-bottom: 1rem;
        font-size: clamp(1.25rem, 2vw, 1.5rem);
        border-bottom: 2px solid #e3f2fd;
        padding-bottom: 0.5rem;
    }

    section[id^="section"] p {
        line-height: 1.7;
        color: #455a64;
        font-size: 1rem;
        margin-bottom: 0;
    }

    /* Brief Description */
    .brife-description {
        background: white;
        padding: 2rem;
        border-radius: 0.75rem;
        box-shadow: 0 2px 8px rgba(13, 71, 161, 0.1);
        line-height: 1.7;
        border: 1px solid #e3f2fd;
    }

    .brife-description h1,
    .brife-description h2,
    .brife-description h3,
    .brife-description h4 {
        color: #0d47a1;
        margin-top: 1.5rem;
        margin-bottom: 1rem;
        border-bottom: 1px solid #e3f2fd;
        padding-bottom: 0.5rem;
    }

    .brife-description p {
        margin-bottom: 1rem;
        color: #455a64;
    }

    .brife-description ul,
    .brife-description ol {
        padding-left: 1.5rem;
        margin-bottom: 1rem;
    }

    .brife-description li {
        margin-bottom: 0.5rem;
        color: #455a64;
    }

    /* Icon Styles */
    .bi {
        font-size: 1.25rem;
    }

    /* Government Scheme Badge */
    .scheme-badge {
        background: linear-gradient(135deg, #FFD54F 0%, #FFC107 100%);
        color: #5d4037;
        padding: 0.5rem 1rem;
        border-radius: 2rem;
        font-weight: 600;
        font-size: 0.875rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: 0 2px 4px rgba(255, 193, 7, 0.3);
    }

    /* Responsive Design */
    @media (max-width: 991.98px) {
        .title-banner {
            padding: 3rem 0 1.5rem;
        }

        #navbar-example {
            position: static;
            margin-bottom: 2rem;
            max-height: none;
        }

        .carousel-item img {
            height: min(45vh, 350px);
        }

        .brife-description {
            padding: 1.5rem;
        }
    }

    @media (max-width: 767.98px) {
        .title-banner {
            padding: 2.5rem 0 1.25rem;
        }

        .title-banner h2 {
            font-size: clamp(1.25rem, 5vw, 1.5rem);
        }

        .carousel-item img {
            height: min(40vh, 300px);
            border-radius: 0.5rem;
        }

        section[id^="section"] {
            padding: 1.25rem;
            margin-bottom: 1.25rem;
        }

        .brife-description {
            padding: 1.25rem;
        }

        .title-banner .d-flex {
            flex-direction: row;
            align-items: flex-start;
            gap: 0.75rem !important;
        }

        .scheme-badge {
            font-size: 0.8rem;
            padding: 0.375rem 0.875rem;
        }
    }

    @media (max-width: 575.98px) {
        .title-banner {
            padding: 2rem 0 1rem;
        }

        .carousel-item img {
            height: min(35vh, 250px);
        }

        section[id^="section"] {
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .brife-description {
            padding: 1rem;
        }

        #navbar-example {
            padding: 1rem !important;
        }

        #navbar-example .nav-link {
            padding: 0.625rem 0.875rem;
            font-size: 0.9rem;
        }
    }

    /* Utility Classes */
    .mb-80 {
        margin-bottom: 5rem !important;
    }

    .mb-24 {
        margin-bottom: 1.5rem !important;
    }

    .gap-16 {
        gap: 1rem !important;
    }

    .gap-8 {
        gap: 0.5rem !important;
    }

    .row-gap-4 {
        row-gap: 0.25rem !important;
    }

    /* Print Styles for Government Documents */
    @media print {
        .title-banner {
            background: none !important;
            color: #000 !important;
            padding: 1rem 0 !important;
        }

        .title-banner::before {
            display: none;
        }

        .carousel,
        #navbar-example {
            display: none;
        }

        section[id^="section"],
        .brife-description {
            box-shadow: none;
            border: 1px solid #ddd;
            page-break-inside: avoid;
        }
    }
</style>

<!-- Your Content Here -->
<section class="title-banner mb-5" style="background-image: url({{ asset($announcement->banner_image) }})">
    <div class="container-fluid px-3 px-md-4 px-lg-5">
        <h2 class="fw-semibold mb-3">
            {{ $announcement->title ?? '' }}
            <br class="d-none d-sm-block">
            <span class="color-primary d-block mt-2">
                {{ $announcement->subtitle ?? '' }}
            </span>
        </h2>
        <div class="d-flex align-items-center flex-wrap gap-3">
            <div class="d-flex align-items-center gap-2 scheme-badge">
                <i class="bi bi-award-fill"></i>
                <span>Announcement Scheme</span>
            </div>
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-calendar-check text-white"></i>
                <p class="light-gray mb-0">{{ \Carbon\Carbon::parse($announcement->created_at)->format('F jS, Y') }}</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-building text-white"></i>
                <p class="light-gray mb-0">{{ $announcement->category->name ?? 'Government' }}</p>
            </div>
        </div>
    </div>
</section>

<div class="container-fluid px-3 px-md-4 px-lg-5">
    @if ($announcement->images && $announcement->images->count() > 0)
        <div class="mb-4">
            <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
                <!-- Indicators -->
                <div class="carousel-indicators">
                    @foreach ($announcement->images as $index => $image)
                        <button type="button" data-bs-target="#carouselId"
                            data-bs-slide-to="{{ $index }}"
                            class="{{ $index === 0 ? 'active' : '' }}"
                            aria-label="Slide {{ $index + 1 }}"></button>
                    @endforeach
                </div>

                <!-- Slides -->
                <div class="carousel-inner">
                    @foreach ($announcement->images as $index => $image)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <img src="{{ asset($image->file_name) }}" class="w-100 d-block"
                                alt="{{ $image->alt_text ?? 'Slide ' . ($index + 1) }}"
                                loading="lazy">
                        </div>
                    @endforeach
                </div>

                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    @endif

    <section class="brife-description mb-5">
        <div class="container px-0">
            <div class="d-flex align-items-center gap-3 mb-4">
                <i class="bi bi-info-circle-fill text-primary fs-4"></i>
                <h3 class="mb-0 text-primary">Scheme Overview</h3>
            </div>
            {!! $announcement->description !!}
        </div>
    </section>

    @php
        $points = [];
        if (!empty($announcement->points)) {
            $points = is_array($announcement->points)
                ? $announcement->points
                : json_decode($announcement->points, true);
        }
    @endphp

    @if (!empty($points))
        <div class="row g-4">
            <div class="col-lg-4">
                <nav id="navbar-example" class="navbar navbar-light flex-column align-items-stretch p-3 rounded">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <i class="bi bi-list-ul text-primary"></i>
                        <h5 class="fw-bold mb-0 text-primary">Scheme Details</h5>
                    </div>
                    <nav class="nav nav-pills flex-column">
                        @foreach ($points as $index => $point)
                            @php
                                [$title, $content] = explode(' - ', $point, 2);
                                $sectionId = 'section' . ($index + 1);
                            @endphp
                            <a class="nav-link" href="#{{ $sectionId }}">
                                <i class="bi bi-chevron-right me-2"></i>
                                {{ $index + 1 }}. {{ $title }}
                            </a>
                        @endforeach
                    </nav>
                </nav>
            </div>

            <div class="col-lg-8">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <i class="bi bi-card-checklist text-primary fs-4"></i>
                    <h3 class="mb-0 text-primary">Key Features & Benefits</h3>
                </div>

                @foreach ($points as $index => $point)
                    @php
                        [$title, $content] = explode(' - ', $point, 2);
                        $sectionId = 'section' . ($index + 1);
                    @endphp

                    <section id="{{ $sectionId }}" class="mb-4">
                        <div class="d-flex align-items-start gap-3">
                            <div class="bg-primary text-white rounded-circle p-2 mt-1 flex-shrink-0">
                                <i class="bi bi-check-lg"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-3">{{ $index + 1 }}. {{ $title }}</h4>
                                <p class="mb-0">{{ $content }}</p>
                            </div>
                        </div>
                    </section>
                @endforeach
            </div>
        </div>
    @endif
</div>

<!-- Similar Schemes Section -->
@if(isset($similars) && $similars->count() > 0)
<section class="mt-5 pt-5 border-top">
    <div class="container-fluid px-3 px-md-4 px-lg-5">
        <div class="d-flex align-items-center gap-3 mb-4">
            <i class="bi bi-collection-play-fill text-primary fs-4"></i>
            <h3 class="mb-0 text-primary">Similar Government Schemes</h3>
        </div>
        <div class="row g-4">
            @foreach($similars as $similar)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-start gap-3 mb-3">
                                <i class="bi bi-building text-primary mt-1"></i>
                                <h6 class="card-title mb-0">{{ Str::limit($similar->title, 50) }}</h6>
                            </div>
                            <p class="card-text text-muted small mb-3">
                                {{ \Carbon\Carbon::parse($similar->created_at)->format('M j, Y') }}
                            </p>
                            <a href="{{ route('web.announcement.scheme', [$similar->category->slug, $similar->slug]) }}"
                               class="btn btn-outline-primary btn-sm">
                                View Details <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
<!-- End Your Content here -->
@endsection
