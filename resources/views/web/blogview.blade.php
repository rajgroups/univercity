   @extends('layouts.web.app')
   @push('meta')
       <title>{{ $metaTitle ?? ($blog->title ?? 'Default Page Title') }}</title>

       <meta name="description" content="{{ $metaDescription ?? Str::limit(strip_tags($blog->description ?? ''), 150) }}">
       <meta name="keywords" content="{{ $metaKeywords ?? 'announcement, news, education' }}">
       <meta name="author" content="{{ $metaAuthor ?? 'YourSiteName' }}">
       <meta name="robots" content="{{ $metaRobots ?? 'index, follow' }}">

       <!-- Canonical Tag -->
       <link rel="canonical" href="{{ $metaCanonical ?? url()->current() }}">

       <!-- Open Graph -->
       <meta property="og:title" content="{{ $metaOgTitle ?? ($blog->title ?? 'Default OG Title') }}">
       <meta property="og:description"
           content="{{ $metaOgDescription ?? Str::limit(strip_tags($blog->description ?? ''), 150) }}">
       <meta property="og:type" content="website">
       <meta property="og:url" content="{{ $metaOgUrl ?? url()->current() }}">
       <meta property="og:image" content="{{ $metaOgImage ?? asset($blog->image ?? 'default.jpg') }}">

       <!-- Twitter Card -->
       <meta name="twitter:card" content="summary_large_image">
       <meta name="twitter:title" content="{{ $metaTwitterTitle ?? ($blog->title ?? 'Default Twitter Title') }}">
       <meta name="twitter:description"
           content="{{ $metaTwitterDescription ?? Str::limit(strip_tags($blog->description ?? ''), 150) }}">
       <meta name="twitter:image" content="{{ $metaTwitterImage ?? asset($blog->image ?? 'default.jpg') }}">
   @endpush
   @section('content')
       <!-- Yout Content Here -->
        <section class="blog-banner" style="background-image: url({{ asset($blog->banner_image) }})">
            <div class="container-fluid px-md-5">
                <div class="row">
                    <div class="col-lg-10 col-xl-8">
                        <span class="blog-category-label">
                            @php
                                echo match($blog->type) {
                                    1 => 'Blog',
                                    2 => 'News',
                                    3 => 'Collaboration',
                                    4 => 'Training Model',
                                    5 => 'Research and Publication',
                                    6 => 'Case Studies',
                                    7 => 'Resource',
                                    default => 'Blog',
                                };
                            @endphp
                        </span>
                        <h1 class="blog-title-main text-white">{{ $blog->title }}</h1>
                        
                        <div class="d-flex align-items-center gap-4 flex-wrap">
                            <div class="blog-meta-item">
                                <i class="bi bi-calendar3 fs-5 text-primary"></i>
                                <span>{{ \Carbon\Carbon::parse($blog->created_at)->format('F jS, Y') }}</span>
                            </div>
                            <div class="blog-meta-item">
                                <i class="bi bi-person-circle fs-5 text-primary"></i>
                                <span>By Admin</span>
                            </div>
                            <div class="blog-meta-item">
                                <i class="bi bi-tag fs-5 text-primary"></i>
                                <span>{{ $blog->category->name ?? 'Uncategorized' }}</span>
                            </div>
                    </div>
                </div>
            </div>
        </section>
    @push('css')
    <style>
        :root {
            --blog-primary: #0d6efd;
            --text-dark: #0f172a;
            --text-light: #64748b;
            --accent-bg: #f8fafc;
        }

        /* Hero Banner */
        .blog-banner {
            position: relative;
            padding: 120px 0 80px;
            background-size: cover;
            background-position: center;
            color: #fff;
            margin-bottom: 60px;
            border-radius: 0 0 50px 50px;
            overflow: hidden;
        }

        .blog-banner::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.9) 0%, rgba(15, 23, 42, 0.7) 100%);
            z-index: 1;
        }

        .blog-banner .container-fluid {
            position: relative;
            z-index: 2;
        }

        .blog-category-label {
            display: inline-block;
            background: var(--blog-primary);
            color: #fff;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }

        .blog-title-main {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 24px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        .blog-meta-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.95rem;
        }

        /* Content Area */
        .blog-content-wrapper {
            font-size: 1.15rem;
            line-height: 1.8;
            color: var(--text-dark);
            max-width: 900px;
            margin: 0 auto;
        }

        .blog-content-wrapper p {
            margin-bottom: 1.8rem;
        }

        .blog-main-image {
            border-radius: 30px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            margin-bottom: 40px;
            width: 100%;
        }

        /* Accordion Customization */
        .accordion-item {
            border: none;
            margin-bottom: 15px;
            border-radius: 16px !important;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
            background: #fff;
        }

        .accordion-button {
            padding: 20px 25px;
            font-weight: 700;
            color: var(--text-dark);
            background: #fff;
            border: none;
        }

        .accordion-button:not(.collapsed) {
            background: var(--blog-primary);
            color: #fff;
            box-shadow: none;
        }

        .accordion-button::after {
            background-size: 1rem;
        }

        .accordion-button:not(.collapsed)::after {
            filter: brightness(0) invert(1);
        }

        .accordion-body {
            padding: 25px;
            color: var(--text-light);
            background: #fdfdfd;
        }

        /* Sidebar Improvement */
        .sidebar-card {
            background: #fff;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }

        .sidebar-title {
            font-size: 1.25rem;
            font-weight: 800;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f1f5f9;
            color: var(--text-dark);
        }

        .article-thumb {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            object-fit: cover;
        }

        .similar-article-title {
            font-size: 0.95rem;
            font-weight: 600;
            line-height: 1.4;
            color: var(--text-dark);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .similar-article-title:hover {
            color: var(--blog-primary);
        }

        /* Sticky Nav */
        .sticky-nav-card {
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 20px;
        }

        .sticky-nav-card .nav-link {
            padding: 10px 15px;
            color: var(--text-light);
            font-weight: 600;
            border-radius: 8px;
            margin-bottom: 5px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .sticky-nav-card .nav-link:hover, .sticky-nav-card .nav-link.active {
            background: rgba(13, 110, 253, 0.1);
            color: var(--blog-primary);
        }

        @media (max-width: 768px) {
            .blog-title-main {
                font-size: 2.2rem;
            }
        }
    </style>
    @endpush
        <!-- Blog Detail Section -->
        <section class="blog-detail-sec mb-5 pb-5">
            <div class="container-fluid px-md-5">
                <div class="row g-5">
                    
                    {{-- MAIN CONTENT --}}
                    <div class="col-lg-8">
                        <article class="blog-content-wrapper mb-5">
                            {!! $blog->description !!}
                        </article>

                        <div class="row g-4 mt-5 pt-4">
                            {{-- Sticky Navigation for Points --}}
                            @php
                                $points = [];
                                if (!empty($blog->points)) {
                                    $points = is_array($blog->points) ? $blog->points : json_decode($blog->points, true);
                                    if (!is_array($points)) $points = [];
                                }
                            @endphp

                            @if(count($points) > 0)
                            <div class="col-lg-4 mb-4">
                                <div class="sticky-top" style="top: 100px;">
                                    <div class="sticky-nav-card shadow-sm">
                                        <h5 class="fw-800 mb-3 px-3 text-dark">On this page</h5>
                                        <nav id="navbar-example" class="nav flex-column">
                                            @foreach ($points as $index => $item)
                                                @php
                                                    $parts = explode(' - ', $item, 2);
                                                    $shortTitle = $parts[0] ?? 'Point ' . ($index + 1);
                                                    $sectionId = 'section' . ($index + 1);
                                                @endphp
                                                <a class="nav-link" href="#{{ $sectionId }}">
                                                    <span class="text-primary me-2">{{ $index + 1 }}.</span> {{ $shortTitle }}
                                                </a>
                                            @endforeach
                                        </nav>
                                    </div>
                                </div>
                            </div>

                            {{-- Key Points Accordion --}}
                            <div class="col-lg-8">
                                <div class="mb-5">
                                    <h3 class="fw-800 mb-3 text-dark">Highlights & Key Takeaways</h3>
                                    <div class="text-secondary mb-4 fs-6">
                                        {!! $blog->short_description !!}
                                    </div>

                                    <div class="accordion custom-blog-accordion" id="blogAccordion">
                                        @foreach ($points as $index => $item)
                                            @php
                                                $parts = explode(' - ', $item, 2);
                                                $shortTitle = $parts[0] ?? 'Detail';
                                                $content = $parts[1] ?? '';
                                                $sectionId = 'section' . ($index + 1);
                                                $collapseId = 'collapse' . ($index + 1);
                                            @endphp
                                            <div class="accordion-item" id="{{ $sectionId }}">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}"
                                                        type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#{{ $collapseId }}">
                                                        {{ $shortTitle }}
                                                    </button>
                                                </h2>
                                                <div id="{{ $collapseId }}"
                                                    class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                                    data-bs-parent="#blogAccordion">
                                                    <div class="accordion-body">
                                                        {{ $content }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- SIDEBAR --}}
                    <div class="col-lg-4">
                        <aside class="sidebar-wrapper">
                            
                            {{-- Similar Programs --}}
                            <div class="sidebar-card mb-4">
                                <h5 class="sidebar-title">Recommended Reading</h5>
                                @forelse($similars as $similar)
                                    @php
                                        $sTypeSlug = match($similar->type) {
                                            1 => 'blog',
                                            2 => 'news',
                                            3 => 'collaboration',
                                            4 => 'training',
                                            5 => 'research',
                                            6 => 'case-study',
                                            7 => 'resource',
                                            default => 'blog',
                                        };
                                    @endphp
                                    <div class="d-flex align-items-center gap-3 mb-4">
                                        <img src="{{ asset($similar->image) }}" class="article-thumb shadow-sm" alt="{{ $similar->title }}">
                                        <div>
                                            <a href="{{ route('web.blog.show', [$sTypeSlug, $similar->slug]) }}" class="similar-article-title d-block mb-2">
                                                {{ Str::limit($similar->title, 55) }}
                                            </a>
                                            <span class="text-muted small">
                                                <i class="bi bi-clock me-1"></i>
                                                {{ \Carbon\Carbon::parse($similar->created_at)->format('M d, Y') }}
                                            </span>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted small">Stay tuned for more updates.</p>
                                @endforelse
                            </div>

                            {{-- Tags --}}
                            @php
                                $tags = collect($similars)->flatMap(function($s) {
                                    return explode(',', $s->category->name ?? '');
                                })->unique()->take(10);
                            @endphp
                            
                            <div class="sidebar-card">
                                <h5 class="sidebar-title">Explore Topics</h5>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($tags as $tag)
                                        <a href="#" class="btn btn-sm btn-outline-light text-dark border-secondary-subtle rounded-pill px-3">
                                            #{{ trim($tag) }}
                                        </a>
                                    @endforeach
                                    @forelse($similars as $similar)
                                        @php
                                            $sTypeSlug = match($similar->type) {
                                                1 => 'blog',
                                                2 => 'news',
                                                3 => 'collaboration',
                                                4 => 'training',
                                                5 => 'research',
                                                6 => 'case-study',
                                                7 => 'resource',
                                                default => 'blog',
                                            };
                                        @endphp
                                        <a href="{{ route('web.blog.show', [$sTypeSlug, $similar->slug]) }}" 
                                           class="btn btn-sm btn-light border-0 rounded-pill px-3 py-2 small fw-600">
                                            {{ Str::limit($similar->title, 20) }}
                                        </a>
                                    @empty
                                    @endforelse
                                </div>
                            </div>

                        </aside>
                    </div>

                </div>
            </div>
        </section>
   @endsection
