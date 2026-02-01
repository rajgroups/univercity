@extends('layouts.web.app')

@push('meta')
    <title>{{ $metaTitle ?? ($announcement->title ?? 'Government Scheme - ISICO') }}</title>
    <meta name="description" content="{{ $metaDescription ?? Str::limit(strip_tags($announcement->description ?? ''), 160) }}">
    <meta name="keywords" content="{{ $metaKeywords ?? 'government scheme, skill development, ISICO, India' }}">
    <meta name="author" content="ISICO">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:title" content="{{ $announcement->title ?? 'Government Scheme' }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($announcement->description ?? ''), 160) }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    @if(isset($announcement->image))
    <meta property="og:image" content="{{ asset($announcement->image) }}">
    @endif
@endpush

@section('content')
<style>
    :root {
        --scheme-primary: #66bb6a;
        --scheme-secondary: #2e7d32;
        --scheme-accent: #ffeb3b;
        --scheme-light: #f1f8e9;
        --scheme-glass: rgba(255, 255, 255, 0.9);
        --scheme-shadow: 0 10px 30px rgba(46, 125, 50, 0.1);
        --transition-soft: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Modern Hero Banner */
    .scheme-hero {
        position: relative;
        padding: 100px 0 60px;
        background-color: #1a1a1a;
        overflow: hidden;
        color: white;
    }

    .scheme-hero-bg {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-size: cover;
        background-position: center;
        filter: brightness(0.4) saturate(1.2);
        z-index: 1;
    }

    .scheme-hero-overlay {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(135deg, rgba(76, 175, 80, 0.9) 0%, rgba(46, 125, 50, 0.6) 100%);
        z-index: 2;
    }

    .scheme-hero .container-fluid {
        position: relative;
        z-index: 3;
    }

    .scheme-badge-premium {
        background: rgba(255, 193, 7, 0.2);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 193, 7, 0.3);
        color: var(--scheme-accent);
        padding: 8px 18px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 24px;
    }

    .scheme-title-main {
        font-size: clamp(2rem, 5vw, 3.5rem);
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 20px;
        text-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .scheme-subtitle-modern {
        font-size: 1.25rem;
        color: rgba(255,255,255,0.85);
        max-width: 800px;
        margin-bottom: 32px;
        font-weight: 400;
    }

    .scheme-meta-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 40px;
        border-top: 1px solid rgba(255,255,255,0.1);
        padding-top: 24px;
    }

    .scheme-meta-item {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .scheme-meta-item i {
        font-size: 1.5rem;
        color: var(--scheme-accent);
    }

    .scheme-meta-text span {
        display: block;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: rgba(255,255,255,0.6);
    }

    .scheme-meta-text strong {
        display: block;
        font-size: 1rem;
        color: white;
    }

    /* Main Content Area */
    .scheme-content-wrapper {
        background: var(--scheme-light);
        padding: 80px 0;
    }

    .scheme-card-main {
        background: white;
        border-radius: 30px;
        padding: 50px;
        box-shadow: var(--scheme-shadow);
        border: 1px solid rgba(21, 101, 192, 0.05);
        margin-bottom: 40px;
    }

    .section-label {
        color: var(--scheme-primary);
        font-weight: 700;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 16px;
        display: block;
    }

    .scheme-heading-section {
        font-size: 2.25rem;
        font-weight: 800;
        color: var(--scheme-secondary);
        margin-bottom: 30px;
        line-height: 1.2;
    }

    .rich-text-content {
        font-size: 1.15rem;
        line-height: 1.8;
        color: #455a64;
    }

    .rich-text-content p {
        margin-bottom: 24px;
    }

    /* Sidebar Navigation */
    .sticky-nav-card {
        background: white;
        border-radius: 24px;
        padding: 30px;
        box-shadow: var(--scheme-shadow);
        border: 1px solid rgba(21, 101, 192, 0.05);
        position: sticky;
        top: 100px;
    }

    .nav-pill-custom {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .nav-link-custom {
        padding: 14px 20px;
        border-radius: 12px;
        color: #455a64;
        font-weight: 600;
        transition: var(--transition-soft);
        display: flex;
        align-items: center;
        gap: 12px;
        border: 1px solid transparent;
        text-decoration: none;
    }

    .nav-link-custom:hover {
        background: #f1f7ff;
        color: var(--scheme-primary);
        transform: translateX(5px);
    }

    .nav-link-custom.active {
        background: var(--scheme-primary);
        color: white;
        box-shadow: 0 4px 15px rgba(21, 101, 192, 0.2);
    }

    /* Key Points Items */
    .point-item {
        background: white;
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 24px;
        border: 1px solid rgba(21, 101, 192, 0.1);
        transition: var(--transition-soft);
        display: flex;
        gap: 20px;
    }

    .point-item:hover {
        border-color: var(--scheme-primary);
        box-shadow: 0 8px 25px rgba(21, 101, 192, 0.08);
        transform: translateY(-5px);
    }

    .point-icon {
        width: 50px;
        height: 50px;
        background: #f1f7ff;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--scheme-primary);
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .point-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--scheme-secondary);
        margin-bottom: 12px;
    }

    /* Similar Schemes */
    .similar-card {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        border: 1px solid rgba(0,0,0,0.05);
        transition: var(--transition-soft);
        height: 100%;
    }

    .similar-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }

    .similar-img-wrapper {
        height: 180px;
        overflow: hidden;
        position: relative;
    }

    .similar-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .similar-card:hover .similar-img {
        transform: scale(1.1);
    }

    .similar-body {
        padding: 24px;
    }

    .similar-category {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        color: var(--scheme-primary);
        margin-bottom: 10px;
        display: block;
    }

    .similar-title {
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--scheme-secondary);
        margin-bottom: 15px;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .btn-scheme-link {
        color: var(--scheme-primary);
        text-decoration: none;
        font-weight: 700;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: var(--transition-soft);
    }

    .btn-scheme-link:hover {
        color: var(--scheme-secondary);
        gap: 12px;
    }

    @media (max-width: 991.98px) {
        .scheme-card-main { padding: 30px; }
        .sticky-nav-card { position: static; margin-bottom: 30px; }
        .scheme-meta-grid { gap: 20px; }
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

<!-- Modern Hero Section -->
<section class="scheme-hero">
    <div class="scheme-hero-bg" style="background-image: url({{ asset($announcement->banner_image ?? $announcement->image ?? 'assets/images/placeholder.jpg') }})"></div>
    <div class="scheme-hero-overlay"></div>
    <div class="container-fluid px-3 px-md-4 px-lg-5">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="scheme-badge-premium">
                    <i class="bi bi-award"></i>
                    Government Scheme
                </div>
                <h1 class="scheme-title-main text-white">{{ $announcement->title ?? 'Untitled Scheme' }}</h1>
                <p class="scheme-subtitle-modern text-white">{{ $announcement->subtitle ?? 'Skill development and empowerment initiative by the government.' }}</p>

                <div class="scheme-meta-grid">
                    <div class="scheme-meta-item">
                        <i class="bi bi-calendar-check"></i>
                        <div class="scheme-meta-text">
                            <span>Published On</span>
                            <strong>{{ $announcement->created_at ? \Carbon\Carbon::parse($announcement->created_at)->format('M d, Y') : 'N/A' }}</strong>
                        </div>
                    </div>
                    <div class="scheme-meta-item">
                        <i class="bi bi-building"></i>
                        <div class="scheme-meta-text">
                            <span>Department</span>
                            <strong>{{ $announcement->category?->name ?? 'N/A' }}</strong>
                        </div>
                    </div>
                    <div class="scheme-meta-item">
                        <i class="bi bi-geo-alt"></i>
                        <div class="scheme-meta-text">
                            <span>Availability</span>
                            <strong>Pan India</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="scheme-content-wrapper">
    <div class="container-fluid px-3 px-md-4 px-lg-5">
        <div class="row g-5">
            <!-- Main Content -->
            <div class="col-lg-8">
                @if ($announcement->images && $announcement->images->count() > 0)
                    <div class="mb-5">
                        <div id="announcementCarousel" class="carousel slide shadow-lg rounded-4 overflow-hidden" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($announcement->images as $index => $image)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ asset($image->file_name) }}" class="d-block w-100" style="height: 450px; object-fit: cover;" alt="Scheme Image {{ $index + 1 }}">
                                    </div>
                                @endforeach
                            </div>
                            @if($announcement->images->count() > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#announcementCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon p-3 rounded-circle bg-dark bg-opacity-25" aria-hidden="true"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#announcementCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon p-3 rounded-circle bg-dark bg-opacity-25" aria-hidden="true"></span>
                                </button>
                            @endif
                        </div>
                    </div>
                @endif

                <div class="scheme-card-main" id="overview">
                    <span class="section-label">Overview</span>
                    <h2 class="scheme-heading-section">About the Scheme</h2>
                    @if(!empty($announcement->short_description))
                        <div class="mb-4 p-3 bg-light rounded-3 border-start border-4 border-success">
                            <p class="mb-0 fw-medium text-secondary">{{ $announcement->short_description }}</p>
                        </div>
                    @endif
                    <div class="rich-text-content">
                        {!! $announcement->description ?? '<p class="text-muted">No description available for this scheme.</p>' !!}
                    </div>
                </div>

                @php
                    $points = [];
                    if (!empty($announcement->points)) {
                        $points = is_array($announcement->points) ? $announcement->points : json_decode($announcement->points, true);
                    }
                @endphp

                @if (!empty($points))
                    <div class="mt-5 pt-4" id="details">
                        <span class="section-label">Features & Benefits</span>
                        <h2 class="scheme-heading-section">Key Highlights</h2>

                        @foreach ($points as $index => $point)
                            @php
                                $parts = explode(' - ', $point, 2);
                                $title = $parts[0] ?? 'Feature';
                                $content = $parts[1] ?? '';
                                $sectionId = 'section-' . ($index + 1);
                            @endphp
                            <div class="point-item" id="{{ $sectionId }}">
                                <div class="point-icon">
                                    <i class="bi bi-check2-circle"></i>
                                </div>
                                <div class="point-content">
                                    <h3 class="point-title">{{ $title }}</h3>
                                    <p class="text-muted mb-0">{{ $content }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sticky-nav-card shadow-sm border-0">
                    <h5 class="fw-bold mb-4 d-flex align-items-center gap-2">
                        <i class="bi bi-list-stars text-primary"></i> Quick Navigation
                    </h5>
                    <div class="nav-pill-custom">
                        <a href="#overview" class="nav-link-custom active">
                            <i class="bi bi-info-circle"></i> Scheme Overview
                        </a>
                        @if (!empty($points))
                            <a href="#details" class="nav-link-custom">
                                <i class="bi bi-stars"></i> Key Highlights
                            </a>
                            @foreach ($points as $index => $point)
                                @php
                                    $title = explode(' - ', $point)[0] ?? 'Detail';
                                @endphp
                                <a href="#section-{{ $index + 1 }}" class="nav-link-custom ps-5 small">
                                    <i class="bi bi-dot"></i> {{ Str::limit($title, 30) }}
                                </a>
                            @endforeach
                        @endif
                    </div>

                    <div class="mt-5 p-4 bg-light rounded-4">
                        <h6 class="fw-bold mb-3"><i class="bi bi-headset me-2 text-primary"></i>Need Assistance?</h6>
                        <p class="small text-muted mb-4">Contact our support desk for registration help and more details.</p>
                        <a href="{{ route('contact') }}" class="btn btn-primary w-100 rounded-pill fw-bold py-2">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Similar Schemes -->
        @if(isset($similars) && $similars->count() > 0)
            <div class="mt-5 pt-5 border-top">
                <span class="section-label">Recommended</span>
                <h2 class="scheme-heading-section mb-5">Similar Government Schemes</h2>

                <div class="row g-4">
                    @foreach($similars as $similar)
                        <div class="col-md-6 col-lg-4">
                            <div class="similar-card">
                                <div class="similar-img-wrapper">
                                    <img src="{{ asset($similar->image ?? 'assets/images/placeholder.jpg') }}" class="similar-img" alt="{{ $similar->title ?? 'Scheme' }}">
                                    <div class="position-absolute top-0 end-0 m-3">
                                        <span class="badge bg-white text-primary rounded-pill px-3 py-2 shadow-sm small">
                                            {{ $similar->category?->name ?? 'N/A' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="similar-body">
                                    <span class="similar-category">{{ $similar->category?->name ?? 'N/A' }}</span>
                                    <h4 class="similar-title">{{ $similar->title ?? 'Untitled Scheme' }}</h4>
                                    <p class="text-muted small mb-4 line-clamp-2">
                                        {{ Str::limit(strip_tags($similar->description ?? ''), 100) }}
                                    </p>
                                    <hr class="opacity-10 my-4">
                                    <a href="{{ route('web.announcement.scheme', [$similar->category?->slug ?? 'N/A', $similar->slug]) }}"
                                       class="btn-scheme-link">
                                        View Details <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
<!-- End Content -->
@endsection
