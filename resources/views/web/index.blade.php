@extends('layouts.web.app')
@push('meta')
    <title>Indian Skill Institute Co-operation (ISICO)</title>

    <meta name="description" content="Welcome to the Indian Skill Institute Co-operation (ISICO). Founded in 2020, ISICO is dedicated to advancing India’s socio-economic growth through education, skill development, entrepreneurship, and innovation. Empowering communities across diverse sectors, aligned with NEP 2020 and national initiatives like Skill India and Make in India.">
    <meta name="keywords" content="ISICO, Indian Skill Institute, skill development, education, entrepreneurship, innovation, socio-economic growth, NEP 2020, Skill India, Make in India, SDGs, training, projects">
    <meta name="author" content="Indian Skill Institute Co-operation (ISICO)">
    <meta name="robots" content="index, follow">

    <!-- Canonical Tag -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:title" content="Home - Indian Skill Institute Co-operation (ISICO)">
    <meta property="og:description" content="ISICO works across education, skill development, entrepreneurship, and innovation to empower individuals and communities for India’s future.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('default-home.jpg') }}">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Home - Indian Skill Institute Co-operation (ISICO)">
    <meta name="twitter:description" content="Empowering India through education, skill development, entrepreneurship, and innovation. Explore ISICO’s initiatives for a skilled and inclusive future.">
    <meta name="twitter:image" content="{{ asset('default-home.jpg') }}">
@endpush

@section('content')

    <style>
        .sidebar-page-container .sidebar .sidebar-post .post-inner .post {
            position: relative;
            padding: 0px 0px 0px 75px;
            padding-bottom: 10px;
            margin-bottom: 6px;
            border-bottom: 1px solid #e5e5e5;
        }

        .sidebar-page-container .sidebar .sidebar-post .post-inner .post:last-child {
            border-bottom: none;
        }

        .sidebar-page-container .sidebar .sidebar-post .post-inner .post .post-date {
            position: absolute;
            left: 0px;
            top: 4px;
            width: 54px;
            height: 54px;
            text-align: center;
            border-radius: 5px;
        }

        .sidebar-page-container .sidebar .sidebar-post .post-inner .post .post-date {
            background: rgb(2, 0, 36);
            background: -moz-linear-gradient(rgb(0, 255, 119) 100%);
            background: -webkit-linear-gradient(rgb(30, 255, 0) 100%);
            background: linear-gradient(rgb(0, 153, 255) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#020024", endColorstr="#007bff", GradientType=1);
        }

        .sidebar-page-container .sidebar .sidebar-post .post-inner .post .post-date p {
            display: block;
            font-size: 18px;
            font-weight: 500;
            color: #fff;
            text-align: center;
            margin: 0px;
        }

        .sidebar-page-container .sidebar .sidebar-post .post-inner .post .post-date span {
            position: relative;
            display: block;
            font-size: 13px;
            line-height: 18px;
            text-transform: uppercase;
            color: #fff;
            margin: 0px;
            padding: 0px;
        }

        .sidebar-page-container .sidebar .sidebar-post .post-inner .post .file-box {
            position: relative;
            margin-bottom: 9px;
        }

        .sidebar-page-container .sidebar .sidebar-post .post-inner .post .file-box i {
            position: relative;
            display: inline-block;
            font-size: 14px;
            color: #666666 !important;
            margin-right: 10px;
        }

        .sidebar-page-container .sidebar .sidebar-post .post-inner .post .file-box p {
            position: relative;
            display: inline-block;
            margin-bottom: 0px;
        }

        .sidebar-page-container .sidebar .sidebar-post .post-inner .post h5 {
            position: relative;
            display: block;
            font-size: 18px;
            line-height: 28px;
            font-weight: 600;
            margin-bottom: 0px;
            color: #1d165c;
            margin: 0px;
        }

        .sidebar-page-container .sidebar .sidebar-post .post-inner .post h5 a {
            display: inline-block;
            color: #1d165c;
        }

        .sidebar-page-container .sidebar .sidebar-post .post-inner .post h5 a:hover {
            color: #e61819;
        }

        .carousel-inner-data {
            margin: 0px auto;
            height: 400px;
            overflow: hidden;
        }

        .carousel-inner-data ul {
            list-style: none;
            position: relative;
        }

        .carousel-inner-data li {
            height: auto;
        }

        /* Swiper Card Image Fix */
        .blog-card .card-img {
            display: block;
            overflow: hidden;
            border-radius: 15px 15px 0 0;
            height: 250px; /* Fixed height for uniformity */
            width: 100%;
            position: relative;
        }

        .blog-card .card-img img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Ensures image covers area without distortion */
            transition: transform 0.5s ease;
        }

        .blog-card:hover .card-img img {
            transform: scale(1.1); /* Smooth zoom effect */
        }
    </style> <!-- About Section Start -->

    @include('layouts.web.partition.slider')
    <section class="about-sec mt-5 mb-5">
        <div class="container-fluid">
            <h3 class="fs-1 fw-500 mb-8 text-center pt-5 pb-5">{{ $settings->about_main_title ?? null }}<span
                    class="color-primary fw-bold">{{ $settings->about_sub_title ?? null }}</span> </h3>
            <div class="row row-gap-4 align-items-center">
                <div class="col-lg-6 order-2">
                    <div class="row row-gap-4">
                        <div class="col-lg-12 col-md-12 col-sm-12 sidebar-page-container">
                            <div class="sidebar">
                                <div class="sidebar-widget sidebar-post">
                                    <div class="widget-title text-center p-5">
                                        <h3> <img
                                                src="https://uiparadox.co.uk/templates/educate/v4/assets/media/shapes/mic-speaker-2.png"
                                                alt="" srcset="" width="50px"> <span
                                                class="color-primary">Latest News</span> Feed</h3>
                                    </div>
                                    <div class="post-inner">
                                        <ul style="list-style: none">
                                            {{-- @dd($blogs) --}}
                                            @foreach ($blogs as $blog)
                                                <li>
                                                    <div class="post">
                                                        <div class="post-date">
                                                            <p>{{ \Carbon\Carbon::parse($blog->created_at)->format('d') }}
                                                            </p>
                                                            <span>{{ \Carbon\Carbon::parse($blog->created_at)->format('F') }}</span>
                                                        </div>
                                                        @php
                                                            $typeSlug = match($blog->type) {
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
                                                        <div class="file-box">
                                                            <i class="far fa-folder-open"></i>
                                                            <a href="{{ route('web.blog.show', [$typeSlug, $blog->slug]) }}" class="d-inline-block">
                                                                <p class="mb-0">{{ $blog->title ?? null }}</p>
                                                            </a>
                                                        </div>
                                                        <h5 class="text-light-gray mt-2">
                                                            <a href="{{ route('web.blog.show', [$typeSlug, $blog->slug]) }}">
                                                                {!! Str::words(strip_tags($blog->short_description), 12, '...') !!}
                                                            </a>
                                                        </h5>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 order-1">
                    <div class="ps-24">
                        <div class="heading text-start">
                            <div class="tagblock mb-16"> <img
                                    src="{{ asset('resource/web/assets/media/hero/buld-vec.png') }}" class="bulb-vec"
                                    alt="Lightbulb icon representing ideas and insight">
                                <p class="black">About ISICO</p>
                            </div>
                            <h2 class="fw-bold mb-3">{{ $settings->about_title ?? null }}</h2>
                        </div>
                        <p class="mb-36">{!! $settings->about_description ?? null !!}</p>
                        <div class="d-flex align-items-center gap-24 mb-36">
                            <div class="d-flex align-items-center gap-16"> <img
                                    src="{{ asset('resource/web/assets/media/vector/unique-course-vec.png') }}"
                                    class="content-vector" alt="Icon representing programs">
                                <div>
                                    <h4 class="fw-600 color-primary mb-2">Impactful</h4>
                                    <p>Skill Programs</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-16"> <img
                                    src="{{ asset('resource/web/assets/media/vector/student-vector.png') }}"
                                    class="content-vector" alt="Icon representing beneficiaries">
                                <div>
                                    <h4 class="fw-600 color-primary mb-2">Nation-wide</h4>
                                    <p>Reach & Empowerment</p>
                                </div>
                            </div>
                        </div>
                        <div> <a href="/about" class="cus-btn"> <span class="text">Learn More About ISICO</span> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- Our Courses Section End -->
    <section class="trusted-expert-sec py-5 bg-light wow fadeInUp animated" data-wow-delay="340ms">
        <div class="container">
            <div class="text-center mb-5">
                <div class="d-inline-flex align-items-center mb-3"> <img
                        src="{{ asset('resource/web/assets/media/hero/buld-vec.png') }}" class="me-2" alt=""
                        style="width: 30px;">
                    <p class="mb-0 fw-semibold text-dark">How We Operate</p>
                </div>
                <h2 class="fw-bold">{{ $settings->operate_main_title ?? null }} <span
                        class="text-primary ms-3">{{ $settings->operate_sub_title ?? null }}</span></h2>
            </div>
            <div class="row g-4">
                @php
                    // Decode JSON string to array (use true as second parameter)
                    $operateSections = is_string($settings->operate_sections)
                        ? json_decode($settings->operate_sections, true)
                        : $settings->operate_sections; // already array
                @endphp

                @if (!empty($operateSections) && is_array($operateSections))
                    @foreach ($operateSections as $index => $section)
                        <div class="col-lg-4 col-md-6">
                            <div class="card border-0 shadow-sm h-100 p-4 text-center">
                                <div class="mb-3">
                                    <img src="{{ asset($section['operate_icon'] ?? 'upload/icon/default-icon.png') }}"
                                        alt="icon" style="height: 50px;">
                                </div>
                                <h5 class="fw-semibold mb-3">{{ $index + 1 }}.
                                    {{ $section['operate_title'] ?? 'No Title' }}</h5>
                                <p>{{ $section['operate_desc'] ?? 'No description available.' }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted">No operation sections available.</p>
                @endif
            </div>
        </div>
    </section> <!-- How We Operate Section End -->
    <div class="blog-sec mt-80 mb-5">
        <div class="container-fluid">
            <div class="heading mb-10 text-start">
                <div class="tagblock mb-16"> <img src="{{ asset('resource/web/assets/media/hero/buld-vec.png') }}"
                        class="bulb-vec" alt="">
                    <p class="black">Ongoing Projects</p>
                </div>
                <div class="cds-119 css-1v1mgi3 cds-121 mt-2">{{ $settings->on_going_project_title ?? null }}</div>
                <h3 class="fw-bold mt-2 mb-2">{{ $settings->on_going_project_main_title ?? null }} <span
                        class="color-primary"> {{ $settings->on_going_project_main_sub_title ?? null }}</span></h3>
                <p class="cds-119 css-lg65q1 cds-121">{{ $settings->onging_final_titles ?? null }}</p>
            </div> <!-- Swiper -->
            <div class="swiper mySwipers">
                <div class="swiper-wrapper">
                    @if ($ongoingProjects->isEmpty())
                        <div class="w-100">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>No projects found.</strong> Please check back later.
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @else
                        @foreach ($ongoingProjects as $project)
                            <!-- Slide -->
                            <div class="swiper-slide" data-swiper-autoplay="2000">
                                <div class="blog-card">

                                    <a href="{{ route('web.project.show', [$project->category?->slug ?? 'uncategorized', $project->slug]) }}"
                                        class="card-img">
                                        <img src="{{ asset($project->thumbnail_image) }}" alt="{{ $project->title }}">
                                        <span class="date-block">
                                            <span
                                                class="h6 fw-400 light-black">{{ \Carbon\Carbon::parse($project->created_at)->format('d') }}</span>
                                            <span
                                                class="h6 fw-400 light-black">{{ \Carbon\Carbon::parse($project->created_at)->format('M') }}</span>
                                        </span>
                                    </a>
                                    <div class="card-content">
                                        {{-- <div class="d-flex align-items-center gap-8 mb-20">
                                        <img src="{{ asset('upload/project/'.$project->image) }}" class="card-user" alt="">
                                        <p>By Admin</p>
                                    </div> --}}
                                        <a href="{{ route('web.project.show', [$project->category?->slug ?? 'uncategorized', $project->slug]) }}"
                                            class="h6 fw-500 mb-8">{{ $project->title }}</a>
                                        <p class="light-gray mb-24">
                                            {{ \Illuminate\Support\Str::limit(strip_tags($project->description), 100) }}
                                        </p>
                                        <a href="{{ route('web.project.show', [$project->category?->slug ?? 'uncategorized', $project->slug]) }}"
                                            class="card-btn"> Read More</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <!-- Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div> <!-- Our Courses Section Start -->
    <style>
        .ai-background-section {
            position: relative;
            background-color: #017d02;
            padding: 50px 20px;
            overflow: hidden;
        }

        /* Abstract SVG shapes */
        .ai-background-section::before {
            content: "";
            position: absolute;
            top: -200px;
            left: 800px;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle at center, #c3f5ff 0%, #f4fff4 70%);
            border-radius: 50%;
            opacity: 0.4;
            z-index: 0;
            animation: float 6s ease-in-out infinite;
        }

        .ai-background-section::after {
            content: "";
            position: absolute;
            bottom: -60px;
            right: -60px;
            width: 300px;
            height: 300px;
            background: conic-gradient(from 90deg, #d1eaff, #c0ffd4, #f4fff4);
            border-radius: 50%;
            opacity: 0.3;
            z-index: 0;
            animation: floatReverse 8s ease-in-out infinite;
        }

        /* Optional animations */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes floatReverse {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(20px);
            }
        }
    </style> <!-- Upcoming Projects -->
    <div class="blog-sec mt-10 ai-background-section">
        <div class="container-fluid">
            <div class="heading mb-10 text-start">
                <div class="text-white">{{ $settings->upcoming_project_title ?? null }}</div>
                <h3 class="fw-bold text-white mt-2 mb-2">{!! $settings->upcoming_project_main_sub_title ?? null !!}</h3>
                <p class="text-white">{{ $settings->upcoming_final_title ?? null }}</p>
            </div> <!-- Swiper -->
            <div class="row align-items-center">
                <div class="col-md-12 col-lg-4">
                    <div class="wow zoomIn animated mt-5 mb-5" data-wow-delay="590ms">
                        <div class="heading text-start justify-content-start mb-8">
                            <div class="tagblock mb-16 mt-1 mb-4"> <img
                                    src="{{ asset('resource/web/assets/media/hero/buld-vec.png') }}" class="bulb-vec"
                                    alt="">
                                <p class="black">Upcoming Projects</p>
                            </div>
                            <h3 class="fw-bold text-white">{!! $settings->upcoming_secondary_title ?? null !!}</h3>
                        </div>
                        <p class="text-white">{{ $settings->upcoming_secondary_desc ?? null }}</p>
                    </div>
                </div>
                <div class="col-md-12 col-lg-8">
                    @if ($upcomingProjects->isEmpty())
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>No upcoming projects found.</strong> Please check back later.
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @else
                        <div class="swiper upcomingproject">
                            <div class="swiper-wrapper">
                                @foreach ($upcomingProjects as $project)
                                    @if (!$project->category)
                                        @continue
                                    @endif
                                    <div class="swiper-slide">
                                        <div class="blog-card">
                                            {{-- {{ route('project.details', $project->slug) }} --}}
                                            <a href="{{ route('web.project.show', [$project->category?->slug ?? 'uncategorized', $project->slug]) }}"
                                                class="card-img">
                                                <img src="{{ asset($project->thumbnail_image) }}" alt="{{ $project->title }}">
                                                <span class="date-block">
                                                    <span
                                                        class="h6 fw-400 light-black">{{ \Carbon\Carbon::parse($project->created_at)->format('d') }}</span>
                                                    <span
                                                        class="h6 fw-400 light-black">{{ \Carbon\Carbon::parse($project->created_at)->format('M') }}</span>
                                                </span>
                                            </a>
                                            <div class="card-content bg-white">
                                                {{-- <div class="d-flex align-items-center gap-8 mb-20">
                                                <img src="{{ asset('upload/project/'.$project->image) }}" class="card-user" alt="">
                                                <p>By Admin</p>
                                            </div> --}}
                                                <a href="{{ route('web.project.show', [$project->category?->slug ?? 'uncategorized', $project->slug]) }}"
                                                    class="h6 fw-500 mb-8">{{ $project->title }}</a>
                                                <p class="light-gray mb-24">
                                                    {{ \Illuminate\Support\Str::limit(strip_tags($project->description), 100) }}
                                                </p>
                                                <a href="{{ route('web.project.show', [$project->category?->slug ?? 'uncategorized', $project->slug]) }}"
                                                    class="card-btn"> Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Pagination -->
                            <div class="swiper-pagination"></div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <!-- Our Programmes -->
    <section class="out-team-sec mt-80 mb-120 wow fadeInUp animated" data-wow-delay="540ms"
        style="visibility: visible; animation-delay: 540ms; animation-name: fadeInUp;">
        <div class="container-fluid px-4">
            <div class="text-center mb-5">
                <div class="section-tag">
                    <img src="{{ asset('resource/web/assets/media/hero/buld-vec.png') }}" class="bulb-vec-mini" alt="">
                    <span>OUR EDUCATIONAL PROGRAMS</span>
                </div>
                <h3 class="vibrant-title mb-3">{{ $settings->program_project_main_title }} <span class="gradient-text">{{ $settings->program_project_main_sub_title }}</span></h3>
                <p class="text-muted">{{ $settings->program_final_title }}</p>
            </div>

            <div class="row align-items-stretch">
                @if ($programes->isNotEmpty())
                    <div class="swiper mySwiperstwo scheme-swiper p-0 m-0">
                        <div class="swiper-wrapper">
                            @foreach ($programes as $program)
                                @php
                                    $progCategorySlug = $program->category?->slug ?? 'general';
                                @endphp
                                <div class="swiper-slide mb-4">
                                    <div class="scheme-card">
                                        <div class="scheme-image-wrapper">
                                            <img src="{{ $program->image ? asset($program->image) : asset('resource/web/assets/media/default/default-img.png') }}" alt="{{ $program->title }}">
                                            <div class="scheme-badge">{{ $program->category->name ?? 'Program' }}</div>
                                        </div>
                                        <div class="p-4 flex-grow-1 d-flex flex-column">
                                            <h6 class="fw-bold mb-2">
                                                <a href="{{ route('web.announcement.program', [$progCategorySlug, $program->slug]) }}"
                                                   class="text-decoration-none text-dark hover-primary">{{ $program->title }}</a>
                                            </h6>
                                            <p class="text-muted small mb-3">{{ Str::limit(strip_tags($program->description), 100) }}</p>

                                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                                <div class="share-links-modern">
                                                    @php
                                                        $progUrl = urlencode(route('web.announcement.program', [$progCategorySlug, $program->slug]));
                                                        $progText = urlencode($program->title);
                                                    @endphp
                                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $progUrl }}" target="_blank" class="share-icon-circle">
                                                        <img src="{{ asset('resource/web/assets/media/vector/linkedin.png') }}" alt="LI">
                                                    </a>
                                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $progUrl }}" target="_blank" class="share-icon-circle">
                                                        <img src="{{ asset('resource/web/assets/media/vector/facebook.png') }}" alt="FB">
                                                    </a>
                                                </div>
                                                <a href="{{ route('web.announcement.program', [$progCategorySlug, $program->slug]) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">Explore Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                @else
                    <div class="col-12 text-center">
                        <div class="modern-card p-4">
                            <p class="text-muted mb-0">No educational programs available at the moment.</p>
                        </div>
                    </div>
                @endif
            </div>
    </section>
    </section>
    <!-- end of our Programmes -->
    <!-- End Upcoming Projects -->
    <style>
        :root {
            --primary-color: #018c01;
            --secondary-color: #6e8b38;
            --text-dark: #2d3436;
            --text-light: #636e72;
            --glass-bg: rgba(255, 255, 255, 0.8);
            --glass-border: rgba(255, 255, 255, 0.2);
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Modern Card Styling */
        .modern-card {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            overflow: hidden;
        }

        .modern-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }

        .icon-box {
            width: 60px;
            height: 60px;
            background: rgba(1, 140, 1, 0.1);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            transition: var(--transition);
        }

        .modern-card:hover .icon-box {
            background: var(--primary-color);
            transform: rotate(10deg);
        }

        .modern-card:hover .icon-box img {
            filter: brightness(0) invert(1);
        }

        /* Swiper Refinement */
        .scheme-swiper {
            padding: 40px 10px !important;
        }

        .scheme-card {
            height: 100%;
            display: flex;
            flex-direction: column;
            border-radius: 24px;
            background: #fff;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0,0,0,0.05);
            transition: var(--transition);
        }

        .scheme-card:hover {
            box-shadow: 0 16px 32px rgba(1, 140, 1, 0.15);
        }

        .scheme-image-wrapper {
            position: relative;
            height: 200px;
            overflow: hidden;
        }

        .scheme-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .scheme-card:hover .scheme-image-wrapper img {
            transform: scale(1.1);
        }

        .scheme-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(255,255,255,0.9);
            padding: 5px 15px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            color: var(--primary-color);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        /* Section Headings */
        .section-tag {
            background: rgba(1, 140, 1, 0.1);
            color: var(--primary-color);
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1rem;
        }

        .bulb-vec-mini {
            width: 20px;
            height: 20px;
        }

        /* Typography */
        .vibrant-title {
            font-size: 2.5rem;
            font-weight: 800;
            line-height: 1.2;
            color: var(--text-dark);
        }

        .gradient-text {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Focus Section */
        .focus-accordion .accordion-item {
            border: none;
            margin-bottom: 15px;
            background: #fff;
            border-radius: 15px !important;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
            overflow: hidden;
        }

        .focus-accordion .accordion-button {
            background: #fff;
            color: var(--text-dark);
            font-weight: 600;
            padding: 20px;
            box-shadow: none !important;
        }

        .focus-accordion .accordion-button:not(.collapsed) {
            color: var(--primary-color);
            background: rgba(1, 140, 1, 0.02);
        }

        /* Interactive Share Icons */
        .share-links-modern {
            display: flex;
            gap: 12px;
            margin-top: 15px;
        }

        .share-icon-circle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1f2f6;
            transition: var(--transition);
        }

        .share-icon-circle:hover {
            background: var(--primary-color);
            transform: scale(1.1);
        }

        .share-icon-circle:hover img {
            filter: brightness(0) invert(1);
        }

        .share-icon-circle img {
            width: 18px;
            height: 18px;
            transition: var(--transition);
        }
    </style>
    <div class="container py-5">
        <!-- Core Values -->
        <div class="text-center mb-5">
            <div class="section-tag">
                <img src="{{ asset('resource/web/assets/media/hero/buld-vec.png') }}" class="bulb-vec-mini" alt="">
                <span>OUR CORE VALUES</span>
            </div>
            <h2 class="vibrant-title mb-4">Smart Learning. Trusted Experts. <br><span class="gradient-text">Everywhere</span></h2>
        </div>

        <div class="row g-4 align-items-center">
            <div class="col-md-7">
                <div class="row g-4">
                    <div class="col-sm-6">
                        <div class="modern-card p-4 h-100">
                            <div class="icon-box">
                                <img src="{{ asset('resource/web/assets/media/images/equity.png') }}" alt="Equity" width="30">
                            </div>
                            <h5 class="fw-bold mb-3">Equity and Inclusion</h5>
                            <p class="text-muted small mb-0">Ensuring access to quality education for marginalized communities.</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="modern-card p-4 h-100">
                            <div class="icon-box">
                                <img src="{{ asset('resource/web/assets/media/images/innovation.png') }}" alt="Innovation" width="30">
                            </div>
                            <h5 class="fw-bold mb-3">Innovation</h5>
                            <p class="text-muted small mb-0">Promoting green jobs and environmentally sustainable practices.</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="modern-card p-4 h-100">
                            <div class="icon-box">
                                <img src="{{ asset('resource/web/assets/media/images/empowerment.png') }}" alt="Empowerment" width="30">
                            </div>
                            <h5 class="fw-bold mb-3">Empowerment</h5>
                            <p class="text-muted small mb-0">Enhancing capabilities for economic independence and impact.</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="modern-card p-4 h-100">
                            <div class="icon-box">
                                <img src="{{ asset('resource/web/assets/media/images/collarabration.png') }}" alt="Collaboration" width="30">
                            </div>
                            <h5 class="fw-bold mb-3">Collaboration</h5>
                            <p class="text-muted small mb-0">Partnering with corporate and govt bodies for shared goals.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="position-relative">
                    <img src="{{ asset('resource/web/assets/media/images/proccess.jfif') }}" class="img-fluid rounded-4 shadow-lg w-100" style="object-fit: cover; height: 450px;">
                    <div class="position-absolute bottom-0 start-0 p-4 w-100">
                        <div class="modern-card p-3 glass-bright">
                            <h6 class="mb-0 fw-bold"><i class="bi bi-check-circle-fill text-primary me-2"></i> Quality Education for All</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="out-team-sec mt-80 mb-120 wow fadeInUp animated animated" data-wow-delay="540ms"
        style="visibility: visible; animation-delay: 540ms; animation-name: fadeInUp;">
        <div class="container-fluid">
            <div class="heading mb-48">
                <div class="tagblock mb-16"> <img src="{{ asset('resource/web/assets/media/hero/buld-vec.png') }}"
                        class="bulb-vec" alt="">
                    <p class="black">Government Schemes We Support</p>
                </div>
                <div class="text-start mt-2">{{ $settings->gvt_scheme_title ?? null }}</div>
                <h3 class="fw-500 text-start mt-2 mb-2">{{ $settings->gvt_scheme_main_title ?? null }} <span
                        class="color-primary"> {{ $settings->gvt_scheme_main_sub_title ?? null }}</span> </h3>
                <p class="text-start">{{ $settings->gvt_scheme_final_title }}</p>
            </div>
            <div class="row align-items-stretch h-100">
                @if ($schemes->isEmpty())
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>No schemes available at the moment.</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @else
                    <div class="swiper mySwiperstwo p-0 m-0">
                        <div class="swiper-wrapper">
                            @foreach ($schemes as $scheme)
                                @php
                                    $categorySlug = $scheme->category?->slug ?? 'general';
                                @endphp
                                <div class="swiper-slide mb-4">
                                    <div class="scheme-card">
                                        <div class="scheme-image-wrapper">
                                            <img src="{{ asset($scheme->image) }}" alt="{{ $scheme->title }}">
                                            <div class="scheme-badge">{{ $scheme->category->name ?? 'Policy' }}</div>
                                        </div>
                                        <div class="p-4 flex-grow-1">
                                            <h6 class="fw-bold mb-2">
                                                <a href="{{ route('web.announcement.scheme', [$categorySlug, $scheme->slug]) }}"
                                                   class="text-decoration-none text-dark hover-primary">{{ $scheme->title }}</a>
                                            </h6>
                                            <p class="text-muted small mb-3">{{ Str::limit($scheme->subtitle, 80) }}</p>

                                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                                <div class="share-links-modern">
                                                    @php
                                                        $currentUrl = urlencode(route('web.announcement.scheme', [$categorySlug, $scheme->slug]));
                                                        $shareText = urlencode($scheme->title);
                                                    @endphp
                                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $currentUrl }}" target="_blank" class="share-icon-circle">
                                                        <img src="{{ asset('resource/web/assets/media/vector/linkedin.png') }}" alt="LI">
                                                    </a>
                                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $currentUrl }}" target="_blank" class="share-icon-circle">
                                                        <img src="{{ asset('resource/web/assets/media/vector/facebook.png') }}" alt="FB">
                                                    </a>
                                                    <a href="https://twitter.com/intent/tweet?url={{ $currentUrl }}&text={{ $shareText }}" target="_blank" class="share-icon-circle">
                                                        <img src="{{ asset('resource/web/assets/media/vector/twitter.webp') }}" alt="X">
                                                    </a>
                                                </div>
                                                <a href="{{ route('web.announcement.scheme', [$categorySlug, $scheme->slug]) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">View Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination if needed -->
                        <div class="swiper-pagination"></div>
                    </div>
                @endif

    </section>
    <style>
        /* Base Container */
        .ai-background-v {
            position: relative;
            background-color: #f4f4f4;
            background-image: radial-gradient(#ccc 1px, transparent 1px);
            background-size: 20px 20px;
            overflow: hidden;
            padding: 10px 10px;
            text-align: center;
        }

        /* Content Styling */
        .ai-background-v .content {
            position: relative;
            z-index: 10;
        }

        .ai-background h2 {
            font-size: 2.5rem;
            color: #333;
        }

        .ai-background-v p {
            font-size: 1.2rem;
            color: #555;
        }

        /* Floating AI Shapes */
        .shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.15;
            z-index: 1;
            filter: blur(30px);
            animation: float 12s ease-in-out infinite;
        }

        .shape-1 {
            width: 200px;
            height: 200px;
            background: #c0ffd4;
            top: -50px;
            left: -50px;
        }

        .shape-2 {
            width: 300px;
            height: 300px;
            background: #aee7ff;
            bottom: -80px;
            right: -60px;
            animation-delay: 4s;
        }

        .shape-3 {
            width: 150px;
            height: 150px;
            background: #ffd6e0;
            top: 50%;
            left: 60%;
            transform: translate(-50%, -50%);
            animation-delay: 7s;
        }

        /* Animation */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0) scale(1);
            }

            50% {
                transform: translateY(-30px) scale(1.05);
            }
        }
    </style> <!-- end of our Programmes -->
    <div class="ai-background-v py-5">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
        <div class="container content">
            <div class="text-center mb-5">
                <div class="section-tag">
                    <img src="{{ asset('resource/web/assets/media/hero/buld-vec.png') }}" class="bulb-vec-mini" alt="">
                    <span>OUR FOCUS AREAS</span>
                </div>
                <h2 class="vibrant-title mb-3">Driving <span class="gradient-text">Sustainable Impact</span></h2>
            </div>

            <div class="row g-5">
                <div class="col-lg-6">
                    @php
                        $focusAreas = [];
                        if (!empty($settings->focus_areas)) {
                            $decoded = is_string($settings->focus_areas) ? json_decode($settings->focus_areas, true) : $settings->focus_areas;
                            if (is_array($decoded)) $focusAreas = $decoded;
                        }
                    @endphp

                    @if (!empty($focusAreas))
                        <div class="accordion focus-accordion" id="focusAccordion">
                            @foreach ($focusAreas as $index => $item)
                                <div class="accordion-item shadow-sm">
                                    <h2 class="accordion-header" id="heading{{ $index }}">
                                        <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $index }}"
                                            aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                            aria-controls="collapse{{ $index }}">
                                            <span class="me-3 text-primary fw-bold">{{ sprintf('%02d', $index + 1) }}</span>
                                            {{ $item['focus_title'] ?? 'Strategic Focus' }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $index }}"
                                        class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                        aria-labelledby="heading{{ $index }}" data-bs-parent="#focusAccordion">
                                        <div class="accordion-body text-muted">
                                            {{ $item['focus_description'] ?? 'Implementation details under review.' }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="col-lg-6">
                    <div class="modern-card p-5 h-100">
                        <h3 class="fw-bold mb-4">Collaborative Approach</h3>
                        <p class="text-muted mb-5">ISICO aligns its initiatives with national priorities, including the NEP 2020, through strategic synergy.</p>

                        <div class="d-flex flex-column gap-4">
                            <div class="d-flex align-items-start gap-3">
                                <div class="icon-box m-0 flex-shrink-0" style="width: 45px; height: 45px;">
                                    <i class="bi bi-building text-primary"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">Government Schemes</h6>
                                    <p class="small text-muted mb-0">Partnering with central programs for education and skills.</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start gap-3">
                                <div class="icon-box m-0 flex-shrink-0" style="width: 45px; height: 45px;">
                                    <i class="bi bi-people text-primary"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">CSR Initiatives</h6>
                                    <p class="small text-muted mb-0">Leveraging corporate support for community projects.</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start gap-3">
                                <div class="icon-box m-0 flex-shrink-0" style="width: 45px; height: 45px;">
                                    <i class="bi bi-globe text-primary"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">International Body</h6>
                                    <p class="small text-muted mb-0">Exchanging global best practices with Indian expertise.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            <div class="row g-5 p-2 m-3">
                <div class="col-md-6">
                    <!-- Message from the Founder -->
                    <div class="text-center mb-4">
                        <div class="section-tag">
                            <img src="{{ asset('resource/web/assets/media/hero/buld-vec.png') }}" class="bulb-vec-mini" alt="">
                            <span>FOUNDER'S MESSAGE</span>
                        </div>
                        <h3 class="fw-bold mb-4">Vision for <span class="text-primary">ISICO</span></h3>
                    </div>
                    <div class="modern-card p-5 border-start border-primary border-5">
                        <div class="mb-4">
                            <i class="bi bi-quote text-primary opacity-25" style="font-size: 3rem; line-height: 1;"></i>
                        </div>
                        <p class="fs-5 text-muted fst-italic mb-4" style="line-height: 1.8;">
                            "{{ $settings->founder_message ?? 'Empowering the youth through skill development and quality education for a brighter future.' }}"
                        </p>
                        <hr class="opacity-10 my-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="avatar-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 50px; height: 50px; border-radius: 50%;">
                                {{ substr($settings->founder_name ?? 'F', 0, 1) }}
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0 text-dark">{{ $settings->founder_name ?? 'Founder' }}</h6>
                                <p class="small text-muted mb-0">Founder, ISICO</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="text-center mb-4">
                        <div class="section-tag">
                            <img src="{{ asset('resource/web/assets/media/hero/buld-vec.png') }}" class="bulb-vec-mini" alt="">
                            <span>FUTURE GOALS</span>
                        </div>
                        <h3 class="fw-bold mb-4">Strategic <span class="text-primary">Roadmap</span></h3>
                    </div>

                    @php
                        $futureGoals = is_array($settings->future_goals) ? $settings->future_goals : json_decode($settings->future_goals, true);
                    @endphp

                    @if (!empty($futureGoals) && is_array($futureGoals))
                        <div class="accordion focus-accordion" id="futureGoalsAccordion">
                            @foreach ($futureGoals as $index => $goal)
                                @php $goalId = 'goal' . $index; @endphp
                                <div class="accordion-item shadow-sm">
                                    <h2 class="accordion-header" id="heading{{ $goalId }}">
                                        <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $goalId }}"
                                            aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                            aria-controls="collapse{{ $goalId }}">
                                            <span class="me-3 text-primary fw-bold">{{ sprintf('%02d', $index + 1) }}</span>
                                            {{ $goal['goal_title'] ?? 'Strategic Objective' }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $goalId }}"
                                        class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                        aria-labelledby="heading{{ $goalId }}"
                                        data-bs-parent="#futureGoalsAccordion">
                                        <div class="accordion-body text-muted">
                                            {{ $goal['goal_description'] ?? 'Detailing the implementation strategies for this goal.' }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="modern-card p-4 text-center">
                            <p class="text-muted mb-0">Strategic goals are currently being updated.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="stats-section py-5 mb-5 wow fadeInUp animated d-none d-lg-block" data-wow-delay="440ms">
        <div class="container">
            <div class="modern-card p-4 py-5 bg-primary text-white">
                <div class="row text-center g-4">
                    <div class="col-md-3">
                        <div class="px-3 border-end border-white border-opacity-25">
                            <h2 class="fw-bold mb-1">250+</h2>
                            <p class="small mb-0 opacity-75">Certified Trainers</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="px-3 border-end border-white border-opacity-25">
                            <h2 class="fw-bold mb-1">1,000+</h2>
                            <p class="small mb-0 opacity-75">Student Reviews</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="px-3 border-end border-white border-opacity-25">
                            <h2 class="fw-bold mb-1">5,000+</h2>
                            <p class="small mb-0 opacity-75">Skilled Students</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="px-3">
                            <h2 class="fw-bold mb-1">15+</h2>
                            <p class="small mb-0 opacity-75">National Recognitions</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- Content Block Section End -->
    <!-- Online Learning Section Start -->
    <section class="learnig-journey-sec mb-120 wow fadeInUp animated" data-wow-delay="490ms">
        <div class="container-fluid">
            <div class="row row-gap-4">
                <div class="col-lg-6">
                    <div class="row row-gap-4"> <img
                            src="https://cms-images.udemycdn.com/96883mtakkm8/4VtZJzu6lTsioWNxHT7InO/96f1940aef37c7cbab353650fbf89eed/UB_Case_Studies_Booz_Allen_image.png"
                            alt="" srcset=""> </div>
                </div>
                <div class="col-lg-6">
                    <div class="heading text-start justify-content-start mb-36">
                        <div class="tagblock mb-16"> <img
                                src="{{ asset('resource/web/assets/media/hero/buld-vec.png') }}" class="bulb-vec"
                                alt="">
                            <p class="black"> International Collaboration</p>
                        </div>
                        <h3 class="fw-500">{{ $settings->collaboration_main_title ?? null }}<br
                                class="d-lg-block d-none"> <span
                                class="color-primary d-inline">{{ $settings->collaboration_sub_title ?? null }}</span>
                        </h3>
                    </div>
                    @php
                        $collaborations = is_string($settings->international_collaborations)
                            ? json_decode($settings->international_collaborations, true)
                            : $settings->international_collaborations;
                    @endphp

                    @if (!empty($collaborations) && is_array($collaborations))
                        <div id="learningjourney">
                            <div class="faq">
                                @foreach ($collaborations as $index => $faq)
                                    @php
                                        $faqId = 'bc-faq' . ($index + 1) . '-left';
                                    @endphp
                                    <div class="faq-block mb-24">
                                        <a href="#" class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}"
                                            data-bs-toggle="collapse" data-bs-target="#{{ $faqId }}"
                                            aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                            aria-controls="{{ $faqId }}">
                                            <span class="fw-500">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}.</span>
                                            &nbsp; {{ $faq['question'] ?? 'Untitled Question' }}
                                        </a>
                                        <div id="{{ $faqId }}"
                                            class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                            aria-labelledby="{{ $faqId }}" data-bs-parent="#learningjourney">
                                            <p>{{ $faq['answer'] ?? 'No answer provided.' }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <p>No international collaborations listed.</p>
                    @endif
                </div>
            </div>
        </div>
    </section> <!-- Online Learning Section End -->
    <!-- Testimonial Section Start -->
    @if (!$testimonials->isEmpty())
        <section class="testimonial-sec bg-light">
            <div class="container-fluid">
                <div class="text-center mt-4">
                    <div class="d-inline-flex align-items-center mt-3"> <img
                            src="{{ asset('resource/web/assets/media/hero/buld-vec.png') }}" class="me-2"
                            alt="" style="width: 30px;">
                        <p class="mb-0 fw-semibold text-dark">Testimonial</p>
                    </div>
                    <h2 class="fw-bold text-center">Students Say <span class="text-primary">Testimonial</span></h2>
                </div>
                <div class="row row-gap-4 align-items-center">
                    <div class="col-lg-4 wow zoomIn animated mt-5 mb-5" data-wow-delay="590ms">
                        <div class="heading text-start justify-content-start mb-8">
                            <div class="tagblock mb-16 mt-5 mb-4"> <img
                                    src="{{ asset('resource/web/assets/media/hero/buld-vec.png') }}" class="bulb-vec"
                                    alt="">
                                <p class="black">Hear What Our Students Say</p>
                            </div>
                            <h3 class="fw-500">Join thousands who’ve transformed their <span class="color-primary">Careers
                                    with ISICO</span> </h3>
                        </div>
                        <p>At ISICO, we empower individuals through skill-based training, real-world experience, and
                            professional mentorship to build bright futures across India. </p>
                    </div>
                    <div class="col-lg-8 mt-5 mb-5">
                        <div class="slider-arrows">
                            <a href="javascript:;" class="arrow-btn btn-prev" data-slide="testimonial-slider"></a>
                            <div class="testimonial-slider row">
                                @foreach ($testimonials as $testimonial)
                                    <div class="testimonial-block col-12">
                                        <h6 class="fw-500 mb-16">{{ $testimonial->title ?? 'User Feedback' }}</h6>
                                        <p class="mb-24">"{{ Str::limit($testimonial->comment, 400, '...') }}"</p>
                                        <div class="d-flex align-items-center gap-12">
                                            <img src="{{ asset($testimonial->image) }}" class="block-user"
                                                alt="{{ $testimonial->name }}">
                                            <div>
                                                <h6 class="fw-500 mb-4p">{{ $testimonial->name }}</h6>
                                                <p class="subtitle dark-gray">{{ $testimonial->designation }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <style>
        .Marquees {
            overflow: hidden;
            background: #f8f9fa;
            padding: 20px 0;
        }

        .Marquee {
            display: flex;
            width: max-content;
            animation: scroll 20s linear infinite;
        }

        .SecondRow {
            animation-direction: reverse;
            animation-duration: 25s;
        }

        .marquee.Item {
            margin: 0 30px;
            font-size: 20px;
            padding: 40px;
            font-size: 30px;
        }

        /* Brand Colors */
        .bi-amazon {
            color: #ff9900;
        }

        .bi-microsoft {
            color: #f65314;
        }

        .bi-apple {
            color: #333333;
        }

        .bi-google {
            color: #4285F4;
        }

        .bi-facebook {
            color: #3b5998;
        }

        .bi-twitter-x {
            color: #000000;
        }

        .bi-youtube {
            color: #FF0000;
        }

        .bi-linkedin {
            color: #0077b5;
        }

        .bi-instagram {
            color: #E1306C;
        }

        .bi-discord {
            color: #7289da;
        }

        .bi-github {
            color: #333;
        }

        .bi-slack {
            color: #4A154B;
        }

        .bi-dribbble {
            color: #ea4c89;
        }

        .bi-behance {
            color: #1769ff;
        }

        .bi-skype {
            color: #00aff0;
        }

        .bi-telegram {
            color: #0088cc;
        }

        @keyframes scroll {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(-100%);
            }
        }
    </style> <!-- Testimonial Section End -->
    @if ($brands->isNotEmpty())
        <div class="container py-5 mt-5">
            <div class="text-center mb-5">
                <div class="section-tag">
                    <img src="{{ asset('resource/web/assets/media/hero/buld-vec.png') }}" class="bulb-vec-mini" alt="">
                    <span>OUR PARTNERS</span>
                </div>
                <h2 class="vibrant-title mb-3">Our Dedicated <span class="gradient-text">Brand Partners</span></h2>
            </div>

            <div class="Marquees modern-card p-4 overflow-hidden">
                <div class="Marquee FirstRow d-flex align-items-center gap-5">
                    @foreach ($brands as $brand)
                        <div class="marquee-item px-4 grayscale-hover">
                            <img src="{{ asset($brand->image) }}" alt="{{ $brand->name }}" height="50" style="object-fit: contain;">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <style>
            .grayscale-hover {
                filter: grayscale(100%);
                opacity: 0.6;
                transition: var(--transition);
            }
            .grayscale-hover:hover {
                filter: grayscale(0%);
                opacity: 1;
                transform: scale(1.1);
            }
        </style>
    @endif
    </div>

    <!-- content @e -->
@endsection
