@extends('layouts.web.app')

@push('meta')
    <title>{{ $metaTitle ?? ($blog->title ?? 'Default Page Title') }}</title>
    <meta name="description" content="{{ $metaDescription ?? Str::limit(strip_tags($blog->description ?? ''), 150) }}">
    <meta name="keywords" content="{{ $metaKeywords ?? 'announcement, news, education' }}">
    <meta name="author" content="{{ $metaAuthor ?? 'YourSiteName' }}">
    <meta property="og:title" content="{{ $metaOgTitle ?? ($blog->title ?? 'Default OG Title') }}">
    <meta property="og:description" content="{{ $metaOgDescription ?? Str::limit(strip_tags($blog->description ?? ''), 150) }}">
    <meta property="og:image" content="{{ $metaOgImage ?? asset($blog->image ?? 'default.jpg') }}">
    <meta name="twitter:card" content="summary_large_image">
@endpush

@section('content')

@php
    $typeLabel = match($blog->type) {
        1 => 'Blog',
        2 => 'News',
        3 => 'Collaboration',
        4 => 'Training Model',
        5 => 'Research',
        6 => 'Case Studies',
        7 => 'Resource',
        8 => 'CSR Initiatives',
        default => 'Blog',
    };
@endphp

<!-- Hero Section -->
<section class="modern-hero position-relative d-flex align-items-center justify-content-center text-center text-white" 
    style="background-image: url('{{ asset($blog->banner_image) }}');">
    <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100"></div>
    <div class="container position-relative z-2">
        <span class="badge bg-primary px-3 py-2 rounded-pill text-uppercase fw-bold mb-3 tracking-wide">{{ $typeLabel }}</span>
        <h1 class="display-3 fw-bold mb-4 hero-title text-white">{{ $blog->title }}</h1>
        <div class="d-flex align-items-center justify-content-center gap-4 text-white-50 fs-6 fw-medium">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-person-circle"></i>
                <span>By Admin</span>
            </div>
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-calendar-event"></i>
                <span>{{ \Carbon\Carbon::parse($blog->created_at)->format('F j, Y') }}</span>
            </div>
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-folder2-open"></i>
                <span>{{ $blog->category->name ?? 'Uncategorized' }}</span>
            </div>
        </div>
    </div>
</section>

<!-- Main Content Area -->
<section class="content-section position-relative">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Content Wrapper -->
            <div class="col-lg-12 col-xl-12">
                <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm content-card">
                    
                    <div class="row g-5">
                        <!-- Left Content Column -->
                        <div class="col-lg-8">
                            <!-- Gallery -->
                            @if($blog->images && $blog->images->count() > 0)
                                <div class="mb-5">
                                    <h3 class="fw-bold mb-4 text-dark">Visual Gallery</h3>
                                    <div class="swiper blog-gallery-swiper rounded-4 overflow-hidden shadow-lg">
                                        <div class="swiper-wrapper">
                                            @foreach($blog->images as $image)
                                                <div class="swiper-slide">
                                                    <img src="{{ asset($image->file_name) }}" class="d-block w-100 object-fit-cover" style="height: 500px;" alt="{{ $image->alt_text }}">
                                                    {{-- <div class="position-absolute bottom-0 start-0 w-100 p-3 bg-dark bg-opacity-50 text-white">
                                                        <small>{{ $image->alt_text }}</small>
                                                    </div> --}}
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="swiper-button-next text-white"></div>
                                        <div class="swiper-button-prev text-white"></div>
                                        <div class="swiper-pagination"></div>
                                    </div>
                                </div>
                            @endif

                            <!-- Article Intro -->
                            <div class="lead text-dark fw-medium mb-4 lh-lg border-start border-4 border-primary ps-4">
                                {!! $blog->short_description !!}
                            </div>

                            <!-- Main Body -->
                            <article class="blog-body lh-lg text-secondary mb-5">
                                {!! $blog->description !!}
                            </article>

                            <!-- Key Points / Highlights -->
                            @php
                                $points = !empty($blog->points) ? (is_array($blog->points) ? $blog->points : json_decode($blog->points, true)) : [];
                            @endphp

                            @if(count($points) > 0)
                                <div class="mb-5" id="highlights">
                                    <h3 class="fw-bold mb-4 text-dark d-flex align-items-center gap-2">
                                        <i class="bi bi-lightning-charge-fill text-warning"></i> Key Highlights
                                    </h3>
                                    <div class="d-flex flex-column gap-3">
                                        @foreach($points as $index => $point)
                                            @php
                                                $parts = explode(' - ', $point, 2);
                                                $title = $parts[0] ?? 'Point ' . ($index + 1);
                                                $desc = $parts[1] ?? '';
                                            @endphp
                                            <div class="highlight-card p-4 rounded-3 bg-light border-start border-4 border-success d-flex flex-column gap-2" id="point-{{ $index + 1 }}">
                                                <h5 class="fw-bold text-dark mb-0">{{ $title }}</h5>
                                                @if($desc)
                                                    <p class="text-secondary mb-0">{{ $desc }}</p>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Gallery was here -->
                        </div>

                        <!-- Right Sidebar Column -->
                        <div class="col-lg-4">
                            <aside class="sidebar-wrapper position-sticky top-0" style="padding-top: 2rem;">
                                
                                <!-- Table of Contents -->
                                @if(count($points) > 0)
                                <div class="sidebar-widget mb-4 p-4 rounded-4 bg-white border border-light shadow-sm">
                                    <h6 class="fw-bold text-uppercase text-primary mb-3 ls-1">Contents</h6>
                                    <nav class="nav flex-column gap-2 toc-nav">
                                        @foreach($points as $index => $point)
                                            @php
                                                $parts = explode(' - ', $point, 2);
                                                $title = $parts[0] ?? 'Point ' . ($index + 1);
                                            @endphp
                                            <a class="nav-link text-secondary py-1 px-0 d-flex align-items-center gap-2" href="#point-{{ $index + 1 }}">
                                                <i class="bi bi-chevron-right small text-black-50"></i> {{ Str::limit($title, 30) }}
                                            </a>
                                        @endforeach
                                    </nav>
                                </div>
                                @endif

                                <!-- Recommended Reading -->
                                <div class="sidebar-widget mb-4">
                                    <h6 class="fw-bold text-uppercase text-dark mb-3 ls-1 px-2">Read Next</h6>
                                    <div class="d-flex flex-column gap-3">
                                        @forelse($similars as $similar)
                                            @php
                                                $sTypeSlug = match($similar->type) {
                                                    1 => 'blog', 2 => 'news', 3 => 'collaboration', 4 => 'training',
                                                    5 => 'research', 6 => 'case-study', 7 => 'resource', default => 'blog',
                                                };
                                            @endphp
                                            <a href="{{ route('web.blog.show', [$sTypeSlug, $similar->slug]) }}" class="card border-0 shadow-sm overflow-hidden hover-lift h-100 text-decoration-none">
                                                <div class="row g-0 align-items-center">
                                                    <div class="col-4">
                                                        <img src="{{ asset($similar->image) }}" class="img-fluid h-100 object-fit-cover" style="min-height: 80px;" alt="{{ $similar->title }}">
                                                    </div>
                                                    <div class="col-8">
                                                        <div class="card-body py-2 px-3">
                                                            <h6 class="card-title text-dark fs-6 fw-bold mb-1 clamp-2">{{ Str::limit($similar->title, 40) }}</h6>
                                                            <small class="text-muted">{{ \Carbon\Carbon::parse($similar->created_at)->format('M d') }}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        @empty
                                            <p class="text-muted px-2">No similar articles found.</p>
                                        @endforelse
                                    </div>
                                </div>

                                <!-- Tags -->
                                @php
                                    $tags = collect($similars)->flatMap(function($s) {
                                        return explode(',', $s->category->name ?? '');
                                    })->unique()->take(8);
                                @endphp
                                @if($tags->count() > 0)
                                <div class="sidebar-widget">
                                    <h6 class="fw-bold text-uppercase text-dark mb-3 ls-1 px-2">Trending Topics</h6>
                                    <div class="d-flex flex-wrap gap-2 px-2">
                                        @foreach($tags as $tag)
                                            <span class="badge bg-light text-dark border fw-normal px-3 py-2">{{ trim($tag) }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                            </aside>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('css')
<style>
    /* Hero & Layout */
    .modern-hero {
        height: 60vh;
        min-height: 400px;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }
    .hero-overlay {
        background: linear-gradient(180deg, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.7) 100%);
        backdrop-filter: blur(2px);
    }
    .hero-title {
        text-shadow: 0 4px 12px rgba(0,0,0,0.3);
        letter-spacing: -1px;
    }
    .content-section {
        margin-top: -5rem;
        padding-bottom: 5rem;
    }
    .content-card {
        border: 1px solid rgba(0,0,0,0.05);
    }
    
    /* Typography */
    .tracking-wide { letter-spacing: 0.1em; }
    .ls-1 { letter-spacing: 1px; }
    .blog-body p { margin-bottom: 1.5rem; font-size: 1.1rem; }
    .blog-body h2 { margin-top: 2rem; margin-bottom: 1rem; font-weight: 800; color: #1e293b; }
    .blog-body h3 { margin-top: 1.5rem; margin-bottom: 1rem; font-weight: 700; color: #334155; }
    .blog-body img { border-radius: 12px; max-width: 100%; margin: 2rem 0; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
    .blog-body ul, .blog-body ol { margin-bottom: 1.5rem; padding-left: 1.5rem; }
    .blog-body li { margin-bottom: 0.5rem; }

    /* Highlights Cards */
    .highlight-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .highlight-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    }

    /* Sidebar */
    .toc-nav .nav-link:hover {
        color: var(--bs-primary) !important;
        padding-left: 5px !important;
        transition: all 0.2s;
    }
    .hover-lift {
        transition: transform 0.2s;
    }
    .hover-lift:hover {
        transform: translateY(-3px);
    }
    .clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Responsive */
    @media (max-width: 991px) {
        .modern-hero { height: 50vh; }
        .content-section { margin-top: -3rem; }
        .content-card { padding: 1.5rem !important; }
        .hero-title { font-size: 2.5rem; }
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize Swiper
        var swiper = new Swiper(".blog-gallery-swiper", {
            effect: "fade",
            fadeEffect: { crossFade: true },
            speed: 1000,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            loop: true,
        });

        // Smooth Scroll for TOC
        $('.toc-nav a').on('click', function(e) {
            e.preventDefault();
            var target = $($(this).attr('href'));
            if(target.length){
                $('html, body').animate({
                    scrollTop: target.offset().top - 120
                }, 800);
            }
        });
    });
</script>
@endpush
