@extends('layouts.web.app')

@push('meta')
    <title>{{ $metaTitle ?? ($program->title ?? 'Educational Program - ISICO') }}</title>
    <meta name="description" content="{{ $metaDescription ?? Str::limit(strip_tags($program->description ?? ''), 160) }}">
    <meta name="keywords" content="{{ $metaKeywords ?? 'educational program, training, skill development, ISICO' }}">
    <meta name="author" content="ISICO">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:title" content="{{ $program->title ?? 'Educational Program' }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($program->description ?? ''), 160) }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    @if(isset($program->image))
    <meta property="og:image" content="{{ asset($program->image) }}">
    @endif
@endpush

@section('content')
<style>
    :root {
        --prog-primary: #6a1b9a;
        --prog-secondary: #4a148c;
        --prog-accent: #FFD54F;
        --prog-light: #faf4ff;
        --prog-glass: rgba(255, 255, 255, 0.9);
        --prog-shadow: 0 10px 30px rgba(106, 27, 154, 0.08);
        --transition-soft: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Modern Hero Banner */
    .prog-hero {
        position: relative;
        padding: 100px 0 60px;
        background-color: #1a1a1a;
        overflow: hidden;
        color: white;
    }

    .prog-hero-bg {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-size: cover;
        background-position: center;
        filter: brightness(0.4) saturate(1.1);
        z-index: 1;
    }

    .prog-hero-overlay {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(135deg, rgba(106, 27, 154, 0.9) 0%, rgba(74, 20, 140, 0.4) 100%);
        z-index: 2;
    }

    .prog-hero .container-fluid {
        position: relative;
        z-index: 3;
    }

    .prog-badge-premium {
        background: rgba(255, 213, 79, 0.2);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 213, 79, 0.3);
        color: var(--prog-accent);
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

    .prog-title-main {
        font-size: clamp(2rem, 5vw, 3.5rem);
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 20px;
        text-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .prog-subtitle-modern {
        font-size: 1.25rem;
        color: rgba(255,255,255,0.85);
        max-width: 800px;
        margin-bottom: 32px;
        font-weight: 400;
    }

    .prog-meta-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 40px;
        border-top: 1px solid rgba(255,255,255,0.1);
        padding-top: 24px;
    }

    .prog-meta-item {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .prog-meta-item i {
        font-size: 1.5rem;
        color: var(--prog-accent);
    }

    .prog-meta-text span {
        display: block;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: rgba(255,255,255,0.6);
    }

    .prog-meta-text strong {
        display: block;
        font-size: 1rem;
        color: white;
    }

    /* Main Content Area */
    .prog-content-wrapper {
        background: var(--prog-light);
        padding: 80px 0;
    }

    .prog-card-main {
        background: white;
        border-radius: 30px;
        padding: 50px;
        box-shadow: var(--prog-shadow);
        border: 1px solid rgba(106, 27, 154, 0.05);
        margin-bottom: 40px;
    }

    .section-label {
        color: var(--prog-primary);
        font-weight: 700;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 16px;
        display: block;
    }

    .prog-heading-section {
        font-size: 2.25rem;
        font-weight: 800;
        color: var(--prog-secondary);
        margin-bottom: 30px;
        line-height: 1.2;
    }

    .rich-text-content {
        font-size: 1.15rem;
        line-height: 1.8;
        color: #455a64;
    }

    /* Curriculum Accordion */
    .prog-accordion .accordion-item {
        border: none;
        background: white;
        margin-bottom: 16px;
        border-radius: 20px !important;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(106, 27, 154, 0.04);
        border: 1px solid rgba(106, 27, 154, 0.08);
    }

    .prog-accordion .accordion-button {
        padding: 24px 30px;
        font-weight: 700;
        font-size: 1.1rem;
        color: var(--prog-secondary);
        background: white;
        box-shadow: none;
    }

    .prog-accordion .accordion-button:not(.collapsed) {
        background: var(--prog-primary);
        color: white;
    }

    .prog-accordion .accordion-button::after {
        filter: grayscale(1) invert(1);
    }

    .prog-accordion .accordion-body {
        padding: 30px;
        line-height: 1.8;
        color: #546e7a;
        background: #fafafa;
    }

    /* Sidebar Blocks */
    .prog-sidebar-card {
        background: white;
        border-radius: 24px;
        padding: 30px;
        box-shadow: var(--prog-shadow);
        border: 1px solid rgba(106, 27, 154, 0.05);
        margin-bottom: 30px;
    }

    .prog-mini-card {
        display: flex;
        gap: 15px;
        padding: 15px 0;
        border-bottom: 1px solid #f3e5f5;
        transition: var(--transition-soft);
        text-decoration: none;
    }

    .prog-mini-card:last-child { border-bottom: none; }

    .prog-mini-card:hover {
        transform: translateX(5px);
    }

    .prog-mini-img {
        width: 70px;
        height: 70px;
        border-radius: 12px;
        object-fit: cover;
    }

    .prog-mini-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--prog-secondary);
        margin-bottom: 5px;
        line-height: 1.3;
    }

    .prog-tag-cloud {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .prog-tag {
        padding: 8px 16px;
        background: #f3e5f5;
        color: var(--prog-primary);
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition-soft);
        border: 1px solid transparent;
    }

    .prog-tag:hover {
        background: var(--prog-primary);
        color: white;
        transform: translateY(-2px);
    }

    @media (max-width: 991.98px) {
        .prog-card-main { padding: 30px; }
        .prog-hero { padding: 80px 0 40px; }
        .prog-meta-grid { gap: 20px; }
    }
</style>
    @media (max-width: 767.98px) {
        .title-banner {
            padding: 2.5rem 0 1.25rem;
        }

        .head-title {
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

        .program-badge {
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

        .sidebar-block {
            padding: 1rem;
        }

        #navbar-example {
            padding: 1rem !important;
        }

        #navbar-example .nav-link {
            padding: 0.625rem 0.875rem;
            font-size: 0.9rem;
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
    .mb-80 {
        margin-bottom: 5rem !important;
    }

    .mb-120 {
        margin-bottom: 7.5rem !important;
    }

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

<!-- Modern Hero Section -->
<section class="prog-hero">
    <div class="prog-hero-bg" style="background-image: url({{ asset($program->banner_image ?? $program->image ?? 'assets/images/placeholder.jpg') }})"></div>
    <div class="prog-hero-overlay"></div>
    <div class="container-fluid px-3 px-md-4 px-lg-5">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="prog-badge-premium">
                    <i class="bi bi-mortarboard"></i>
                    Educational Program
                </div>
                <h1 class="prog-title-main">{{ $program->title ?? 'Untitled Program' }}</h1>
                <p class="prog-subtitle-modern">{{ $program->subtitle ?? 'Advanced training and skill development program for career growth.' }}</p>

                <div class="prog-meta-grid">
                    <div class="prog-meta-item">
                        <i class="bi bi-calendar-check"></i>
                        <div class="prog-meta-text">
                            <span>Published On</span>
                            <strong>{{ $program->created_at ? \Carbon\Carbon::parse($program->created_at)->format('M d, Y') : 'N/A' }}</strong>
                        </div>
                    </div>
                    <div class="prog-meta-item">
                        <i class="bi bi-bookmarks"></i>
                        <div class="prog-meta-text">
                            <span>Category</span>
                            <strong>{{ $category->name ?? 'Education' }}</strong>
                        </div>
                    </div>
                    <div class="prog-meta-item">
                        <i class="bi bi-clock"></i>
                        <div class="prog-meta-text">
                            <span>Duration</span>
                            <strong>Self-Paced / Guided</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="prog-content-wrapper">
    <div class="container-fluid px-3 px-md-4 px-lg-5">
        <div class="row g-5">
            <!-- Main Content -->
            <div class="col-lg-8">
                @if ($program->images && $program->images->count() > 0)
                    <div class="mb-5">
                        <div id="progCarousel" class="carousel slide shadow-lg rounded-4 overflow-hidden" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($program->images as $index => $image)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ asset($image->file_name) }}" class="d-block w-100" style="height: 450px; object-fit: cover;" alt="Program Image {{ $index + 1 }}">
                                    </div>
                                @endforeach
                            </div>
                            @if($program->images->count() > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#progCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon p-3 rounded-circle bg-dark bg-opacity-25" aria-hidden="true"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#progCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon p-3 rounded-circle bg-dark bg-opacity-25" aria-hidden="true"></span>
                                </button>
                            @endif
                        </div>
                    </div>
                @endif

                <div class="prog-card-main" id="overview">
                    <span class="section-label">Program Overview</span>
                    <h2 class="prog-heading-section">About the Program</h2>
                    <div class="rich-text-content">
                        {!! $program->description ?? '<p class="text-muted">No description available for this program.</p>' !!}
                    </div>
                </div>

                @php
                    $points = [];
                    if (!empty($program->points)) {
                        $points = is_string($program->points) ? json_decode($program->points, true) : $program->points;
                    }
                @endphp

                @if (!empty($points))
                    <div class="mt-5 pt-4">
                        <span class="section-label">Learning Path</span>
                        <h2 class="prog-heading-section">Program Curriculum</h2>

                        <div class="accordion prog-accordion" id="curriculumAccordion">
                            @foreach($points as $index => $item)
                                @php
                                    $parts = explode(' - ', $item, 2);
                                    $title = $parts[0] ?? 'Module';
                                    $content = $parts[1] ?? '';
                                    $collapseId = 'collapse' . ($index + 1);
                                @endphp
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}">
                                            <i class="bi bi-journal-check me-3"></i>
                                            {{ $index + 1 }}. {{ $title }}
                                        </button>
                                    </h2>
                                    <div id="{{ $collapseId }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" data-bs-parent="#curriculumAccordion">
                                        <div class="accordion-body">
                                            {{ $content }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="prog-sidebar-card shadow-sm border-0">
                    <h5 class="fw-bold mb-4 d-flex align-items-center gap-2">
                        <i class="bi bi-collection-play text-primary"></i> Similar Programs
                    </h5>
                    @forelse($similars as $similar)
                        <a href="{{ route('web.announcement.program', [$similar->category?->slug ?? 'general', $similar->slug]) }}" class="prog-mini-card">
                            <img src="{{ asset($similar->image ?? 'assets/images/placeholder.jpg') }}" class="prog-mini-img" alt="{{ $similar->title }}">
                            <div>
                                <h6 class="prog-mini-title">{{ Str::limit($similar->title, 50) }}</h6>
                                <p class="small text-muted mb-0">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    {{ \Carbon\Carbon::parse($similar->created_at)->format('d/m/Y') }}
                                </p>
                            </div>
                        </a>
                    @empty
                        <p class="text-muted small">No related programs found.</p>
                    @endforelse
                </div>

                <div class="prog-sidebar-card shadow-sm border-0">
                    <h5 class="fw-bold mb-4 d-flex align-items-center gap-2">
                        <i class="bi bi-tags text-primary"></i> Program Tags
                    </h5>
                    <div class="prog-tag-cloud">
                        @foreach($similars as $similar)
                            @php $tagTitle = explode(' ', $similar->title)[0] ?? 'Tag'; @endphp
                            <a href="{{ route('web.announcement.program', [$similar->category?->slug ?? 'general', $similar->slug]) }}" class="prog-tag">
                                #{{ $tagTitle }}
                            </a>
                        @endforeach
                        @if($similars->isEmpty())
                           <span class="text-muted small">No tags available.</span>
                        @endif
                    </div>
                </div>

                <div class="p-4 bg-white rounded-4 shadow-sm border-0 mt-4 text-center">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle w-60 h-60 d-inline-flex align-items-center justify-content-center mb-3">
                        <i class="bi bi-patch-question fs-3"></i>
                    </div>
                    <h6 class="fw-bold">Ready to Elevate?</h6>
                    <p class="small text-muted mb-4">Enroll today and start your journey towards excellence.</p>
                    <a href="{{ route('contact') }}" class="btn btn-primary w-100 rounded-pill fw-bold py-2 shadow-sm">Get Started</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Content -->
@endsection
