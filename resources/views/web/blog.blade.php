@extends('layouts.web.app')
@push('meta')
    <title>CSR Initiatives - Indian Skill Institute Co-operation (ISICO)</title>
    {{-- ... (Your existing meta tags) ... --}}
    <meta name="description" content="Read the latest blogs from the Indian Skill Institute Co-operation (ISICO). Explore insights on education, skill development, entrepreneurship, innovation, and national growth initiatives.">
    <meta name="keywords" content="ISICO blog, Indian Skill Institute, skill development articles, education blogs, entrepreneurship insights, innovation, socio-economic growth, NEP 2020, Skill India, Make in India">
    <meta name="author" content="Indian Skill Institute Co-operation (ISICO)">
    <meta name="robots" content="index, follow">

    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:title" content="CSR Initiatives - Indian Skill Institute Co-operation (ISICO)">
    <meta property="og:description" content="Stay updated with ISICO’s CSR Initiatives covering education, skill enhancement, entrepreneurship, and India’s socio-economic development.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('default-blog.jpg') }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="CSR Initiatives - Indian Skill Institute Co-operation (ISICO)">
    <meta name="twitter:description" content="Explore the ISICO CSR Initiatives for articles and insights on skill development, innovation, entrepreneurship, and education in India.">
    <meta name="twitter:image" content="{{ asset('default-blog.jpg') }}">
@endpush

@section('content')
@push('css')
<style>
    :root {
        --blog-primary: #0d6efd;
        --blog-secondary: #6c757d;
        --blog-accent: #ffc107;
        --glass-bg: rgba(255, 255, 255, 0.8);
        --glass-border: rgba(255, 255, 255, 0.3);
        --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        --card-hover-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    /* Hero Section */
    .blog-hero {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        padding: 80px 0;
        margin-bottom: 60px;
        position: relative;
        overflow: hidden;
        border-radius: 0 0 50px 50px;
    }

    .blog-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -20%;
        width: 100%;
        height: 200%;
        background: radial-gradient(circle, rgba(13, 110, 253, 0.1) 0%, transparent 70%);
        z-index: 0;
    }

    .blog-hero .container {
        position: relative;
        z-index: 1;
    }

    .blog-hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        color: #fff;
        margin-bottom: 1.5rem;
        letter-spacing: -1px;
    }

    .blog-hero-subtitle {
        font-size: 1.25rem;
        color: rgba(255, 255, 255, 0.7);
        max-width: 600px;
        margin-bottom: 2.5rem;
    }

    /* Modern Search & Filter */
    .filter-wrapper {
        background: var(--glass-bg);
        backdrop-filter: blur(10px);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        padding: 30px;
        box-shadow: var(--card-shadow);
        margin-top: -60px;
        position: relative;
        z-index: 2;
    }

    .form-label-custom {
        font-size: 0.85rem;
        font-weight: 600;
        color: #475569;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-control-custom, .form-select-custom {
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        padding: 12px 16px;
        transition: all 0.3s ease;
    }

    .form-control-custom:focus, .form-select-custom:focus {
        border-color: var(--blog-primary);
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
    }

    /* Blog Card */
    .blog-card {
        border: none;
        border-radius: 24px;
        overflow: hidden;
        background: #fff;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: var(--card-shadow);
        height: 100%;
    }

    .blog-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--card-hover-shadow);
    }

    .blog-card-img-wrapper {
        position: relative;
        overflow: hidden;
        height: 240px;
    }

    .blog-card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .blog-card:hover .blog-card-img {
        transform: scale(1.1);
    }

    .blog-card-badge {
        position: absolute;
        top: 20px;
        left: 20px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(5px);
        color: #0f172a;
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        z-index: 1;
    }

    .blog-card-body {
        padding: 30px;
    }

    .blog-card-category {
        color: var(--blog-primary);
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 12px;
        display: block;
    }

    .blog-card-title {
        font-size: 1.4rem;
        font-weight: 700;
        line-height: 1.3;
        margin-bottom: 15px;
        color: #0f172a;
        transition: color 0.3s ease;
    }

    .blog-card:hover .blog-card-title {
        color: var(--blog-primary);
    }

    .blog-card-text {
        color: #64748b;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 25px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .blog-card-footer {
        background: none;
        border-top: 1px solid #f1f5f9;
        padding: 20px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn-read-more {
        font-weight: 600;
        padding: 0;
        color: var(--blog-primary);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: gap 0.3s ease;
    }

    .btn-read-more:hover {
        gap: 12px;
        color: #0056b3;
    }

    .blog-date {
        font-size: 0.8rem;
        color: #94a3b8;
    }

    /* Mobile Tweaks */
    @media (max-width: 768px) {
        .blog-hero-title {
            font-size: 2.5rem;
        }
        .filter-wrapper {
            margin-top: 0;
            border-radius: 0;
            box-shadow: none;
            background: #fff;
        }
        .blog-hero {
            border-radius: 0;
            padding: 60px 0;
        }
    }
</style>
@endpush

<div class="blog-hero">
    <div class="container text-center text-md-start">
        <h1 class="blog-hero-title">Insights & <br class="d-none d-md-block"> Perspectives</h1>
        <p class="blog-hero-subtitle text-white">Exploring the future of skill development, innovation, and entrepreneurship in the modern Indian landscape.</p>
    </div>
</div>

<div class="container pb-5">
    
    {{-- FILTER FORM --}}
    <div class="filter-wrapper mb-5">
        <form method="GET" action="{{ route('web.blog.filter') }}" id="blogFilterFormDesktop">
            <div class="row g-4">
                {{-- Type Filter --}}
                <div class="col-md-4">
                    <label for="type_desktop" class="form-label-custom">Content Type</label>
                    <select name="type" id="type_desktop" class="form-select form-select-custom">
                        <option value="">All Types</option>
                        <option value="1" {{ request('type') == '1' ? 'selected' : '' }}>CSR Initiatives</option>
                        <option value="2" {{ request('type') == '2' ? 'selected' : '' }}>News</option>
                        {{-- <option value="3" {{ request('type') == '3' ? 'selected' : '' }}>Collaboration</option> --}}
                        <option value="4" {{ request('type') == '4' ? 'selected' : '' }}>Training Model</option>
                        <option value="5" {{ request('type') == '5' ? 'selected' : '' }}>Research and Publication</option>
                        <option value="6" {{ request('type') == '6' ? 'selected' : '' }}>Case Studies</option>
                        {{-- <option value="7" {{ request('type') == '7' ? 'selected' : '' }}>Resource</option> --}}
                        <option value="8" {{ request('type') == '8' ? 'selected' : '' }}>CSR Initiatives</option>
                    </select>
                </div>

                {{-- Search Input --}}
                <div class="col-md-5">
                    <label for="search_desktop" class="form-label-custom">Search Articles</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 border-radius-custom-left">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="text" name="search" id="search_desktop" value="{{ request('search') }}" 
                               class="form-control form-control-custom border-start-0" placeholder="Keywords...">
                    </div>
                </div>

                {{-- Actions --}}
                <div class="col-md-3 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-3 shadow-sm">
                        Apply Filters
                    </button>
                    <a href="{{ route('web.blog.filter') }}" class="btn btn-light py-3 px-4 rounded-3" title="Reset">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>

    {{-- RESULTS GRID --}}
    <div class="row g-4">
        @forelse($blogs as $blog)
            <div class="col-lg-4 col-md-6">
                <article class="blog-card">
                    <div class="blog-card-img-wrapper">
                        @php
                            $typeText = match($blog->type) {
                                1 => 'Blog',
                                2 => 'News',
                                3 => 'Collaboration',
                                4 => 'Training Model',
                                5 => 'Research and Publication',
                                6 => 'Case Studies',
                                7 => 'Resource',
                                default => 'Blog',
                            };
                            $typeSlug = match($blog->type) {
                                1 => 'CSR Initiatives',
                                2 => 'news',
                                // 3 => 'collaboration',
                                4 => 'training',
                                5 => 'research',
                                6 => 'case-study',
                                // 7 => 'resource',
                                8 => 'csr-initiatives',
                                default => 'blog',
                            };
                        @endphp
                        <span class="blog-card-badge">{{ $typeText }}</span>
                        @php
                            $imagePath = $blog->image ? asset($blog->image) : asset('uploads/blogs/default.png');
                        @endphp
                        <img src="{{ $imagePath }}" class="blog-card-img" alt="{{ $blog->title }}">
                    </div>

                    <div class="blog-card-body">
                        <span class="blog-card-category">{{ $blog->category->name ?? 'Uncategorized' }}</span>
                        <h2 class="blog-card-title">{{ $blog->title }}</h2>
                        <p class="blog-card-text">{{ $blog->short_description }}</p>
                    </div>

                    <div class="blog-card-footer">
                        <span class="blog-date">
                            <i class="bi bi-calendar3 me-1"></i>
                            {{ \Carbon\Carbon::parse($blog->created_at)->format('M d, Y') }}
                        </span>
                        <a href="{{ route('web.blog.show', [$typeSlug, $blog->slug]) }}" class="btn-read-more">
                            Read More <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </article>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="mb-4">
                    <i class="bi bi-search-heart display-1 text-muted"></i>
                </div>
                <h3 class="fw-bold">No results found</h3>
                <p class="text-muted">Try adjusting your filters or keywords to find what you're looking for.</p>
                <a href="{{ route('web.blog.filter') }}" class="btn btn-outline-primary mt-3">Reset all filters</a>
            </div>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    <div class="d-flex justify-content-center mt-5">
        {{ $blogs->withQueryString()->links() }}
    </div>
</div>

@endsection

{{-- ---------------------------------------------------------------------------------------------------------------------------------------------------------- --}}
{{-- MOBILE FILTER OFFCANVAS START --}}
<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileBlogFilterOffcanvas" aria-labelledby="mobileBlogFilterOffcanvasLabel">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="mobileBlogFilterOffcanvasLabel">
            <i class="bi bi-funnel me-2"></i> Filter CSR Initiatives
        </h5>
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
        var $desktopForm = $('#blogFilterFormDesktop');

        if ($desktopForm.length) {
            // 1. Clone the entire desktop form, including the form tag itself.
            var $mobileForm = $desktopForm.clone();

            // 2. Update the form ID for mobile context
            $mobileForm.attr('id', 'blogFilterFormMobile');

            // 3. Update element IDs and add a dedicated submit/reset button for the offcanvas footer
            $mobileForm.find('select, input, button, a').each(function() {
                var currentId = $(this).attr('id');
                if (currentId) {
                    // Change element IDs to ensure HTML validity when cloned
                    $(this).attr('id', 'mobile_' + currentId);
                }
            });

            // 4. Remove the desktop apply/reset buttons from the cloned form body
            // as we will place them in the offcanvas footer for better sticky behavior.
            $mobileForm.find('.col-12.mt-4.text-end').remove();

            // 5. Insert the cleaned, cloned form into the offcanvas body
            $('#offcanvasFilterBody').append($mobileForm);

            // 6. Add a sticky footer with the controls for the mobile form
            var $offcanvasFooter = $('<div class="offcanvas-footer p-3 border-top d-grid gap-2"></div>');

            // Recreate the Apply and Reset buttons targeting the cloned form
            var $applyButton = $('<button type="submit" form="blogFilterFormMobile" class="btn btn-primary"><i class="bi bi-check-circle me-1"></i> Apply Filters</button>');
            var $resetLink = $('<a href="{{ route('web.blog.filter') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-counterclockwise me-1"></i> Reset All</a>');

            $offcanvasFooter.append($applyButton).append($resetLink);

            // Append the new footer container directly after the offcanvas body
            $('#mobileBlogFilterOffcanvas').append($offcanvasFooter);

            // OPTIONAL: Adjust styling for offcanvas layout if needed
            $('#blogFilterFormMobile').removeClass('p-3 border rounded shadow-sm').addClass('p-0');
            $('#blogFilterFormMobile h5').removeClass('mb-3').addClass('mb-3');
        }
    });
</script>
@endpush
