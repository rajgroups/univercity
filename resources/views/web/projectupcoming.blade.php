@extends('layouts.web.app')
@push('meta')
    <title>{{ $metaTitle ?? ($program->title ?? 'Default Page Title') }}</title>

    <meta name="description" content="{{ $metaDescription ?? Str::limit(strip_tags($program->description ?? ''), 150) }}">
    <meta name="keywords" content="{{ $metaKeywords ?? 'announcement, news, education' }}">
    <meta name="author" content="{{ $metaAuthor ?? 'YourSiteName' }}">
    <meta name="robots" content="{{ $metaRobots ?? 'index, follow' }}">

    <!-- Canonical Tag -->
    <link rel="canonical" href="{{ $metaCanonical ?? url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:title" content="{{ $metaOgTitle ?? ($program->title ?? 'Default OG Title') }}">
    <meta property="og:description"
        content="{{ $metaOgDescription ?? Str::limit(strip_tags($program->description ?? ''), 150) }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $metaOgUrl ?? url()->current() }}">
    <meta property="og:image" content="{{ $metaOgImage ?? asset($program->image ?? 'default.jpg') }}">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $metaTwitterTitle ?? ($program->title ?? 'Default Twitter Title') }}">
    <meta name="twitter:description"
        content="{{ $metaTwitterDescription ?? Str::limit(strip_tags($program->description ?? ''), 150) }}">
    <meta name="twitter:image" content="{{ $metaTwitterImage ?? asset($program->image ?? 'default.jpg') }}">
@endpush

@section('content')
<style>
    /* Enhanced Mobile-First Styles */
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
        background: linear-gradient(135deg, rgba(44, 62, 80, 0.85) 0%, rgba(44, 62, 80, 0.7) 100%);
    }

    .title-banner .container-fluid {
        position: relative;
        z-index: 2;
    }

    .title-banner h2 {
        font-size: clamp(1.5rem, 4vw, 2.25rem);
        line-height: 1.3;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }

    .color-primary {
        color: #4CAF50 !important;
    }

    .light-gray {
        color: #e9ecef !important;
        margin-bottom: 0;
    }

    /* Improved Carousel */
    .carousel-item img {
        height: min(50vh, 400px);
        object-fit: cover;
        border-radius: 0.75rem;
    }

    .carousel-indicators [data-bs-target] {
        width: 10px;
        height: 10px;
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
        font-size: 0.9rem;
    }

    #navbar-example .nav-link:hover,
    #navbar-example .nav-link:focus {
        background-color: #e9ecef;
        color: #0d6efd;
        border-left-color: #0d6efd;
    }

    /* Enhanced Accordion */
    .accordion-button {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        font-weight: 500;
        padding: 1rem 1.25rem;
    }

    .accordion-button:not(.collapsed) {
        background-color: #e7f1ff;
        color: #0d6efd;
        border-color: #0d6efd;
    }

    .accordion-button:focus {
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        border-color: #0d6efd;
    }

    .accordion-body {
        padding: 1.25rem;
        background-color: #fff;
        border-left: 1px solid #dee2e6;
        border-right: 1px solid #dee2e6;
        border-bottom: 1px solid #dee2e6;
    }

    /* Sidebar Improvements */
    .siderbar {
        position: sticky;
        top: 6rem;
    }

    .sidebar-block {
        background: #fff;
        padding: 1.5rem;
        border-radius: 0.75rem;
        box-shadow: 0 0.125rem 0.5rem rgba(0,0,0,0.08);
        margin-bottom: 1.5rem;
    }

    .recent-article {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        padding: 0.75rem 0;
        border-bottom: 1px solid #e9ecef;
    }

    .recent-article:last-child {
        border-bottom: none;
    }

    .article-img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 0.5rem;
        flex-shrink: 0;
    }

    .recent-article div {
        flex: 1;
    }

    .hover-content {
        color: #212529;
        text-decoration: none;
        transition: color 0.2s ease-in-out;
        display: block;
        margin-bottom: 0.25rem;
        font-size: 0.9rem;
        line-height: 1.4;
    }

    .hover-content:hover {
        color: #0d6efd;
    }

    .subtitle {
        font-size: 0.8rem;
        color: #6c757d !important;
        margin-bottom: 0;
    }

    .tag-block {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .tag-block a {
        background: #f8f9fa;
        color: #495057;
        padding: 0.375rem 0.75rem;
        border-radius: 2rem;
        text-decoration: none;
        font-size: 0.8rem;
        border: 1px solid #dee2e6;
        transition: all 0.2s ease-in-out;
    }

    .tag-block a:hover {
        background: #0d6efd;
        color: #fff;
        border-color: #0d6efd;
    }

    /* Content Improvements */
    .overflow-auto {
        line-height: 1.7;
        color: #495057;
    }

    .overflow-auto h1,
    .overflow-auto h2,
    .overflow-auto h3,
    .overflow-auto h4 {
        color: #2c5aa0;
        margin-top: 1.5rem;
        margin-bottom: 1rem;
    }

    .overflow-auto p {
        margin-bottom: 1rem;
    }

    .overflow-auto ul,
    .overflow-auto ol {
        padding-left: 1.5rem;
        margin-bottom: 1rem;
    }

    .overflow-auto li {
        margin-bottom: 0.5rem;
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

        .siderbar {
            position: static;
            margin-top: 2rem;
        }

        .carousel-item img {
            height: min(45vh, 350px);
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

        .sidebar-block {
            padding: 1.25rem;
        }

        .recent-article {
            padding: 0.5rem 0;
        }

        .article-img {
            width: 50px;
            height: 50px;
        }

        .title-banner .d-flex {
            flex-direction: row;
            align-items: flex-start;
            gap: 0.75rem !important;
        }
    }

    @media (max-width: 575.98px) {
        .title-banner {
            padding: 2rem 0 1rem;
        }

        .carousel-item img {
            height: min(35vh, 250px);
        }

        .sidebar-block {
            padding: 1rem;
        }

        #navbar-example {
            padding: 1rem !important;
        }

        .accordion-button {
            padding: 0.875rem 1rem;
            font-size: 0.9rem;
        }

        .accordion-body {
            padding: 1rem;
        }

        .tag-block {
            gap: 0.375rem;
        }

        .tag-block a {
            padding: 0.25rem 0.625rem;
            font-size: 0.75rem;
        }
    }

    /* Utility Classes */
    .mb-48 {
        margin-bottom: 3rem !important;
    }

    .mb-24 {
        margin-bottom: 1.5rem !important;
    }

    .mb-12 {
        margin-bottom: 0.75rem !important;
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
</style>

<!-- Your Content Here -->
<section class="title-banner mb-5" style="background-image: url({{ asset($program->banner_image) }})">
    <div class="container-fluid px-3 px-md-4 px-lg-5">
        <h2 class="fw-semibold mb-3">
            {{ $program && $program->title ? Str::limit($program->title, 200, '...') : '' }}
            <br class="d-none d-sm-block">
            <span class="color-primary d-block mt-2">
                {{ $program && $program->subtitle ? Str::limit($program->subtitle, 200, '...') : '' }}
            </span>
        </h2>
        <div class="d-flex align-items-center flex-wrap gap-3">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-folder text-white fw-bold"></i>
                <p class="light-gray mb-0">Announcement</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-calendar text-white fw-bold"></i>
                <p class="light-gray mb-0">{{ \Carbon\Carbon::parse($program->created_at)->format('F jS, Y') }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Blog Detail Section Start -->
<section class="blog-detail-sec mb-5">
    <div class="container-fluid px-3 px-md-4 px-lg-5">
        <div class="row g-4">
            <div class="col-lg-8">
                @if ($program->images && $program->images->count() > 0)
                    <div class="mb-4">
                        <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
                            <!-- Indicators -->
                            <div class="carousel-indicators">
                                @foreach ($program->images as $index => $image)
                                    <button type="button" data-bs-target="#carouselId"
                                        data-bs-slide-to="{{ $index }}"
                                        class="{{ $index === 0 ? 'active' : '' }}"
                                        aria-label="Slide {{ $index + 1 }}"></button>
                                @endforeach
                            </div>

                            <!-- Slides -->
                            <div class="carousel-inner">
                                @foreach ($program->images as $index => $image)
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

                <div class="overflow-auto mb-4">
                    {!! $program->description !!}
                </div>

                @php
                    $points = [];
                    if (!empty($program->points)) {
                        $points = is_string($program->points)
                            ? json_decode($program->points, true)
                            : $program->points;
                    }
                @endphp

                @if(!empty($points))
                    <div class="container px-0">
                        <div class="row g-4">
                            <!-- Sidebar -->
                            <div class="col-lg-4">
                                <nav id="navbar-example" class="navbar navbar-light flex-column align-items-stretch p-3 rounded">
                                    <h5 class="fw-bold mb-3">About Topics</h5>
                                    <nav class="nav nav-pills flex-column">
                                        @foreach ($points as $index => $item)
                                            @php
                                                $parts = explode(' - ', $item, 2);
                                                $shortTitle = $parts[0] ?? '';
                                                $sectionId = 'section' . ($index + 1);
                                            @endphp
                                            @if (trim($shortTitle) !== '')
                                                <a class="nav-link" href="#{{ $sectionId }}">
                                                    {{ $index + 1 }}. {{ $shortTitle }}
                                                </a>
                                            @endif
                                        @endforeach
                                    </nav>
                                </nav>
                            </div>

                            <!-- Content -->
                            <div class="col-lg-8">
                                <h3 class="fw-bold mb-3">{{ $program->title }} - Highlights</h3>
                                <p class="mb-4">
                                    {!! $program->short_description !!}
                                </p>
                                <div class="accordion" id="accordionExample">
                                    @foreach ($points as $index => $item)
                                        @php
                                            $parts = explode(' - ', $item, 2);
                                            $shortTitle = $parts[0] ?? null;
                                            $content = $parts[1] ?? null;
                                            $sectionId = 'section' . ($index + 1);
                                            $collapseId = 'collapse' . ($index + 1);
                                        @endphp

                                        @if ($shortTitle && $content)
                                            <div class="accordion-item" id="{{ $sectionId }}">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}"
                                                        type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#{{ $collapseId }}"
                                                        aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">
                                                        {{ $index + 1 }}. {{ $shortTitle }}
                                                    </button>
                                                </h2>
                                                <div id="{{ $collapseId }}"
                                                    class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                                    data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        {{ $content }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-lg-4">
                <div class="siderbar">
                    <div class="sidebar-block mb-4">
                        <h5 class="fw-semibold mb-3">Similar Programs</h5>
                        @forelse($similars as $similar)
                            <div class="recent-article">
                                <img src="{{ asset($similar->image) }}" class="article-img"
                                    alt="{{ $similar->title }}" loading="lazy">
                                <div>
                                    <a href="{{ route('web.upcoming.project', [$similar->category->slug, $similar->slug]) }}"
                                        class="hover-content">
                                        {{ Str::limit($similar->title, 60) }}
                                    </a>
                                    <p class="subtitle">
                                        {{ \Carbon\Carbon::parse($similar->created_at)->format('d/m/Y') }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted mb-0">No similar programs found.</p>
                        @endforelse
                    </div>

                    <div class="sidebar-block">
                        <h5 class="fw-semibold mb-3">Tags</h5>
                        <div class="tag-block">
                            @forelse($similars as $similar)
                                <a href="{{ route('web.announcement.program', [$similar->category->slug, $similar->slug]) }}">
                                    {{ Str::limit($similar->title, 25, '...') }}
                                </a>
                            @empty
                                <span class="text-muted">No tags available</span>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
