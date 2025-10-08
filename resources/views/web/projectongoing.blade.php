{{-- @dd($announcement) --}}
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
    /* Enhanced Mobile-First Styles for Bootstrap 5 */
    .title-banner {
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        padding: 5rem 0 2.5rem;
        position: relative;
    }

    .title-banner::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(44, 62, 80, 0.85) 0%, rgba(44, 62, 80, 0.7) 100%);
    }

    .title-banner .container-fluid {
        position: relative;
        z-index: 2;
    }

    .title-banner h2 {
        font-size: clamp(1.75rem, 4vw, 2.5rem);
        line-height: 1.3;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }

    .color-primary {
        color: #4CAF50 !important;
    }

    /* Improved Carousel */
    .carousel-item img {
        height: min(60vh, 400px);
        object-fit: cover;
        border-radius: 0.75rem;
    }

    .carousel-indicators [data-bs-target] {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin: 0 0.25rem;
    }

    /* Enhanced Navigation Sidebar */
    #navbar-example {
        border-radius: 0.75rem;
        box-shadow: 0 0.25rem 0.75rem rgba(0,0,0,0.1);
        border: 1px solid #dee2e6;
        position: sticky;
        top: 6rem;
        max-height: calc(100vh - 8rem);
        overflow-y: auto;
    }

    #navbar-example .nav-link {
        color: #495057;
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        margin-bottom: 0.25rem;
        transition: all 0.2s ease-in-out;
        border-left: 3px solid transparent;
    }

    #navbar-example .nav-link:hover,
    #navbar-example .nav-link:focus {
        background-color: #e9ecef;
        color: #0d6efd;
        border-left-color: #0d6efd;
    }

    /* Improved Content Sections */
    section[id^="section"] {
        padding: 1.5rem;
        background: #fff;
        border-radius: 0.75rem;
        box-shadow: 0 0.125rem 0.5rem rgba(0,0,0,0.08);
        margin-bottom: 1.5rem;
        border-left: 4px solid #0d6efd;
    }

    section[id^="section"] h4 {
        color: #0d6efd;
        margin-bottom: 1rem;
        font-size: clamp(1.25rem, 2vw, 1.5rem);
    }

    section[id^="section"] p {
        line-height: 1.7;
        color: #495057;
        font-size: 1rem;
        margin-bottom: 0;
    }

    /* Enhanced Brief Description */
    .brife-description {
        background: #fff;
        padding: 2rem;
        border-radius: 0.75rem;
        box-shadow: 0 0.125rem 0.75rem rgba(0,0,0,0.1);
        line-height: 1.7;
    }

    .brife-description h1,
    .brife-description h2,
    .brife-description h3,
    .brife-description h4 {
        color: #0d6efd;
        margin-top: 1.5rem;
        margin-bottom: 1rem;
    }

    .brife-description p {
        margin-bottom: 1rem;
    }

    .brife-description ul,
    .brife-description ol {
        padding-left: 1.5rem;
        margin-bottom: 1rem;
    }

    .brife-description li {
        margin-bottom: 0.5rem;
    }

    /* Responsive Utilities */
    .gap-16 {
        gap: 1rem !important;
    }

    .row-gap-4 {
        row-gap: 0.25rem !important;
    }

    /* Mobile-First Responsive Design */
    @media (max-width: 991.98px) {
        .title-banner {
            padding: 4rem 0 2rem;
        }

        #navbar-example {
            position: static;
            margin-bottom: 2rem;
            max-height: none;
        }

        .carousel-item img {
            height: min(50vh, 350px);
        }
    }

    @media (max-width: 767.98px) {
        .title-banner {
            padding: 3rem 0 1.5rem;
        }

        .title-banner h2 {
            font-size: clamp(1.5rem, 5vw, 1.75rem);
        }

        .carousel-item img {
            height: min(45vh, 300px);
            border-radius: 0.5rem;
        }

        section[id^="section"] {
            padding: 1.25rem;
            margin-bottom: 1.25rem;
        }

        .brife-description {
            padding: 1.5rem;
        }

        .title-banner .d-flex {
            flex-direction: column;
            align-items: flex-start;
        }

        .title-banner .gap-16 {
            gap: 0.75rem !important;
        }
    }

    @media (max-width: 575.98px) {
        .title-banner {
            padding: 2.5rem 0 1.25rem;
        }

        .carousel-item img {
            height: min(40vh, 250px);
        }

        section[id^="section"] {
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .brife-description {
            padding: 1.25rem;
        }

        #navbar-example {
            padding: 1rem !important;
        }

        #navbar-example .nav-link {
            padding: 0.625rem 0.875rem;
            font-size: 0.9rem;
        }
    }

    /* Print Styles */
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
        }
    }
</style>

<!-- Your Content Here -->
<section class="title-banner mb-5" style="background-image: url({{ asset($announcement->banner_image) }})">
    <div class="container-fluid px-3 px-md-4 px-lg-5">
        <h2 class="fw-semibold mb-3 mb-md-4">
            {{ $announcement && $announcement->title ? Str::limit($announcement->title, 200, '...') : '' }}
            <br class="d-none d-sm-block">
            <span class="color-primary d-block mt-1 mt-md-2">
                {{ $announcement && $announcement->subtitle ? Str::limit($announcement->subtitle, 200, '...') : '' }}
            </span>
        </h2>
        <div class="d-flex align-items-center flex-wrap gap-3 gap-md-4">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-folder text-white fw-bold"></i>
                <p class="text-white fw-semibold mb-0">Scheme</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-calendar text-white fw-bold"></i>
                <p class="text-white mb-0">{{ \Carbon\Carbon::parse($announcement->created_at)->format('F jS, Y') }}</p>
            </div>
        </div>
    </div>
</section>

<div class="container my-4 my-md-5">
    @if ($announcement->images && $announcement->images->count() > 0)
        <div class="mb-4 mb-md-5">
            <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
                <!-- Indicators -->
                <div class="carousel-indicators">
                    @foreach ($announcement->images as $index => $image)
                        <button type="button" data-bs-target="#carouselId"
                            data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"
                            aria-current="{{ $index === 0 ? 'true' : 'false' }}"
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
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselId"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselId"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    @endif

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
                <nav id="navbar-example" class="navbar navbar-light flex-column align-items-stretch p-3 p-md-4">
                    <h5 class="fw-bold mb-3">Topics</h5>
                    <nav class="nav nav-pills flex-column">
                        @foreach ($points as $index => $point)
                            @php
                                [$title, $content] = explode(' - ', $point, 2);
                                $sectionId = 'section' . ($index + 1);
                            @endphp
                            <a class="nav-link" href="#{{ $sectionId }}">
                                {{ $index + 1 }}. {{ $title }}
                            </a>
                        @endforeach
                    </nav>
                </nav>
            </div>

            <div class="col-lg-8">
                @foreach ($points as $index => $point)
                    @php
                        [$title, $content] = explode(' - ', $point, 2);
                        $sectionId = 'section' . ($index + 1);
                    @endphp

                    <section id="{{ $sectionId }}" class="mb-4">
                        <h4 class="fw-bold mb-3">{{ $index + 1 }}. {{ $title }}</h4>
                        <p class="mb-0">{{ $content }}</p>
                    </section>
                @endforeach
            </div>
        </div>
    @endif

    <section class="brife-description mt-4 mt-md-5">
        {!! $announcement->description !!}
    </section>
</div>
<!-- End Your Content here -->
@endsection
