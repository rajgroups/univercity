@extends('layouts.web.app')
@push('meta')
   <title>{{ $metaTitle ?? $program->title ?? 'Default Page Title' }}</title>

    <meta name="description" content="{{ $metaDescription ?? Str::limit(strip_tags($program->description ?? ''), 150) }}">
    <meta name="keywords" content="{{ $metaKeywords ?? 'announcement, news, education' }}">
    <meta name="author" content="{{ $metaAuthor ?? 'YourSiteName' }}">
    <meta name="robots" content="{{ $metaRobots ?? 'index, follow' }}">

    <!-- Canonical Tag -->
    <link rel="canonical" href="{{ $metaCanonical ?? url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:title" content="{{ $metaOgTitle ?? $program->title ?? 'Default OG Title' }}">
    <meta property="og:description" content="{{ $metaOgDescription ?? Str::limit(strip_tags($program->description ?? ''), 150) }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $metaOgUrl ?? url()->current() }}">
    <meta property="og:image" content="{{ $metaOgImage ?? asset($program->image ?? 'default.jpg') }}">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $metaTwitterTitle ?? $program->title ?? 'Default Twitter Title' }}">
    <meta name="twitter:description" content="{{ $metaTwitterDescription ?? Str::limit(strip_tags($program->description ?? ''), 150) }}">
    <meta name="twitter:image" content="{{ $metaTwitterImage ?? asset($program->image ?? 'default.jpg') }}">
@endpush

@section('content')
<style>
    /* Enhanced Mobile-First Styles for Programs */
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
        background: linear-gradient(135deg, rgba(106, 27, 154, 0.85) 0%, rgba(123, 31, 162, 0.7) 100%);
    }

    .title-banner .container-fluid {
        position: relative;
        z-index: 2;
    }

    .head-title {
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
        color: #f3e5f5 !important;
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
        background-color: #7b1fa2;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: #7b1fa2;
        border-radius: 50%;
        padding: 1rem;
    }

    /* Enhanced Navigation Sidebar */
    #navbar-example {
        border-radius: 0.75rem;
        box-shadow: 0 0.25rem 0.75rem rgba(0,0,0,0.1);
        border: 1px solid #e1bee7;
        background: linear-gradient(135deg, #faf4ff 0%, #f3e5f5 100%);
        position: sticky;
        top: 6rem;
        max-height: calc(100vh - 8rem);
        overflow-y: auto;
    }

    #navbar-example .nav-link {
        color: #7b1fa2;
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        margin-bottom: 0.25rem;
        transition: all 0.2s ease-in-out;
        border-left: 3px solid transparent;
        font-weight: 500;
    }

    #navbar-example .nav-link:hover,
    #navbar-example .nav-link:focus {
        background-color: #e1bee7;
        color: #4a148c;
        border-left-color: #4a148c;
        transform: translateX(4px);
    }

    /* Enhanced Accordion */
    .accordion-button {
        background: linear-gradient(135deg, #f3e5f5 0%, #e1bee7 100%);
        border: 1px solid #ce93d8;
        font-weight: 600;
        color: #4a148c;
        padding: 1rem 1.25rem;
        transition: all 0.3s ease;
    }

    .accordion-button:not(.collapsed) {
        background: linear-gradient(135deg, #4a148c 0%, #7b1fa2 100%);
        color: white;
        border-color: #4a148c;
        box-shadow: 0 2px 8px rgba(123, 31, 162, 0.3);
    }

    .accordion-button:focus {
        box-shadow: 0 0 0 0.25rem rgba(123, 31, 162, 0.25);
        border-color: #7b1fa2;
    }

    .accordion-body {
        padding: 1.25rem;
        background-color: #fafafa;
        border-left: 1px solid #e1bee7;
        border-right: 1px solid #e1bee7;
        border-bottom: 1px solid #e1bee7;
        line-height: 1.7;
    }

    /* Program Badge */
    .program-badge {
        background: linear-gradient(135deg, #FFD54F 0%, #FFC107 100%);
        color: #4a148c;
        padding: 0.5rem 1rem;
        border-radius: 2rem;
        font-weight: 600;
        font-size: 0.875rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: 0 2px 4px rgba(255, 193, 7, 0.3);
    }

    /* Sidebar Improvements */
    .siderbar {
        position: sticky;
        top: 6rem;
    }

    .sidebar-block {
        background: white;
        padding: 1.5rem;
        border-radius: 0.75rem;
        box-shadow: 0 2px 8px rgba(123, 31, 162, 0.1);
        margin-bottom: 2rem;
        border: 1px solid #f3e5f5;
    }

    .recent-article {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        padding: 0.75rem 0;
        border-bottom: 1px solid #f3e5f5;
        transition: all 0.2s ease;
    }

    .recent-article:hover {
        background-color: #faf4ff;
        border-radius: 0.5rem;
        padding: 0.75rem;
        margin: 0 -0.5rem;
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
        color: #4a148c;
        text-decoration: none;
        transition: color 0.2s ease-in-out;
        display: block;
        margin-bottom: 0.25rem;
        font-size: 0.9rem;
        line-height: 1.4;
        font-weight: 500;
    }

    .hover-content:hover {
        color: #7b1fa2;
    }

    .subtitle {
        font-size: 0.8rem;
        color: #78909c !important;
        margin-bottom: 0;
    }

    .tag-block {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .tag-block a {
        background: #f3e5f5;
        color: #7b1fa2;
        padding: 0.375rem 0.75rem;
        border-radius: 2rem;
        text-decoration: none;
        font-size: 0.8rem;
        border: 1px solid #e1bee7;
        transition: all 0.2s ease-in-out;
        font-weight: 500;
    }

    .tag-block a:hover {
        background: #7b1fa2;
        color: #fff;
        border-color: #7b1fa2;
        transform: translateY(-1px);
    }

    /* Content Improvements */
    .br-24 {
        border-radius: 1.5rem !important;
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

<!-- Your Content Here -->
<section class="title-banner mb-5" style="background-image: url({{ asset($program->banner_image) }})">
   <div class="container-fluid px-3 px-md-4 px-lg-5">
      <h2 class="fw-semibold mb-3 head-title">
         {{ $program->title ?? '' }}
         <br class="d-none d-sm-block">
         <span class="color-primary d-block mt-2">
            {{ $program->subtitle ?? '' }}
         </span>
      </h2>
      <div class="d-flex align-items-center flex-wrap gap-3">
         <div class="d-flex align-items-center gap-2 program-badge">
            <i class="bi bi-mortarboard-fill"></i>
            <span>Educational Program</span>
         </div>
         <div class="d-flex align-items-center gap-2">
            <i class="bi bi-calendar-check text-white"></i>
            <p class="light-gray mb-0">{{ \Carbon\Carbon::parse($program->created_at)->format('F jS, Y') }}</p>
         </div>
         <div class="d-flex align-items-center gap-2">
            <i class="bi bi-bookmarks text-white"></i>
            <p class="light-gray mb-0">{{ $category->name ?? 'Program' }}</p>
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
                     <button type="button" data-bs-target="#carouselId" data-bs-slide-to="{{ $index }}"
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

            <div class="content-area mb-4">
               {!! $program->description !!}
            </div>

            @if($program->image)
            <img src="{{ asset($program->image) }}" class="br-24 w-100 mb-4" alt="{{ $program->title }}" loading="lazy">
            @endif

            @php
            $points = [];
            if (!empty($program->points)) {
               $points = is_string($program->points) ? json_decode($program->points, true) : $program->points;
            }
            @endphp

            @if (!empty($points))
            <div class="container px-0">
               <div class="row g-4">
                  <!-- Sidebar -->
                  <div class="col-lg-4">
                     <nav id="navbar-example" class="navbar navbar-light flex-column align-items-stretch p-3 rounded">
                        <div class="d-flex align-items-center gap-2 mb-3">
                           <i class="bi bi-list-check text-primary"></i>
                           <h5 class="fw-bold mb-0 text-primary">Program Curriculum</h5>
                        </div>
                        <nav class="nav nav-pills flex-column">
                           @foreach($points as $index => $item)
                           @php
                           [$shortTitle, $content] = explode(' - ', $item, 2);
                           $sectionId = 'section' . ($index + 1);
                           @endphp
                           <a class="nav-link" href="#{{ $sectionId }}">
                              <i class="bi bi-chevron-right me-2"></i>
                              {{ $index + 1 }}. {{ $shortTitle }}
                           </a>
                           @endforeach
                        </nav>
                     </nav>
                  </div>

                  <!-- Content -->
                  <div class="col-lg-8">
                     <div class="d-flex align-items-center gap-3 mb-4">
                        <i class="bi bi-journal-text text-primary fs-4"></i>
                        <h3 class="mb-0 text-primary">Program Details</h3>
                     </div>

                     <div class="mb-4 p-4 bg-light rounded">
                        <h5 class="fw-semibold mb-3">Program Overview</h5>
                        {!! $program->short_description !!}
                     </div>

                     <div class="accordion" id="accordionExample">
                        @foreach($points as $index => $item)
                        @php
                        [$shortTitle, $content] = explode(' - ', $item, 2);
                        $sectionId = 'section' . ($index + 1);
                        $collapseId = 'collapse' . ($index + 1);
                        @endphp
                        <div class="accordion-item mb-3" id="{{ $sectionId }}">
                           <h2 class="accordion-header">
                              <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}" type="button"
                                 data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}"
                                 aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">
                                 <i class="bi bi-file-text me-2"></i>
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
                        @endforeach
                     </div>
                  </div>
               </div>
            </div>
            @endif
         </div>

         <div class="col-lg-4">
            <div class="siderbar">
               <div class="sidebar-block">
                  <div class="d-flex align-items-center gap-2 mb-3">
                     <i class="bi bi-collection-play text-primary"></i>
                     <h5 class="fw-semibold mb-0">Similar Programs</h5>
                  </div>

                  @forelse($similars as $similar)
                  <div class="recent-article">
                     <img src="{{ asset($similar->image) }}" class="article-img" alt="{{ $similar->title }}" loading="lazy">
                     <div>
                        <a href="{{ route('web.announcement.program', [$similar->category?->slug ?? 'general', $similar->slug]) }}"
                           class="hover-content">
                           {{ Str::limit($similar->title, 60) }}
                        </a>
                        <p class="subtitle">
                           <i class="bi bi-calendar3 me-1"></i>
                           {{ \Carbon\Carbon::parse($similar->created_at)->format('d/m/Y') }}
                        </p>
                     </div>
                  </div>
                  @empty
                  <div class="text-center py-3">
                     <i class="bi bi-inbox display-4 text-muted mb-2"></i>
                     <p class="text-muted mb-0">No similar programs found</p>
                  </div>
                  @endforelse
               </div>

               <div class="sidebar-block">
                  <div class="d-flex align-items-center gap-2 mb-3">
                     <i class="bi bi-tags text-primary"></i>
                     <h5 class="fw-semibold mb-0">Program Tags</h5>
                  </div>

                  <div class="tag-block">
                     @forelse($similars as $similar)
                     <a href="{{ route('web.announcement.program', [$similar->category?->slug ?? 'general', $similar->slug]) }}">
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
