@extends('layouts.web.app')
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
</style> <!-- About Section Start -->

    @include('layouts.web.partition.slider')
<section class="about-sec mt-5 mb-5">
    <div class="container-fluid">
        <h3 class="fs-1 fw-500 mb-8 text-center pt-5 pb-5">{{ $settings->about_main_title ?? null}}<span class="color-primary fw-bold">{{ $settings->about_sub_title ?? null}}</span> </h3>
        <div class="row row-gap-4 align-items-center">
            <div class="col-lg-6 order-2">
                <div class="row row-gap-4">
                    <div class="col-lg-12 col-md-12 col-sm-12 sidebar-page-container">
                        <div class="sidebar">
                            <div class="sidebar-widget sidebar-post">
                                <div class="widget-title text-center p-5">
                                    <h3> <img src="https://uiparadox.co.uk/templates/educate/v4/assets/media/shapes/mic-speaker-2.png" alt="" srcset="" width="50px"> <span class="color-primary">Latest News</span> Feed</h3>
                                </div>
                                <div class="post-inner">
                                    <div class="carousel-inner-data">
                                        <ul>
                                            <li>
                                                <div class="post">
                                                    <div class="post-date">
                                                        <p>06</p> <span>july</span>
                                                    </div>
                                                    <div class="file-box"> <i class="far fa-folder-open"></i>
                                                        <p>Subject</p>
                                                    </div>
                                                    <h5 class="text-light-gray"><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a> </h5>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="post">
                                                    <div class="post-date">
                                                        <p>25</p> <span>April</span>
                                                    </div>
                                                    <div class="file-box"> <i class="far fa-folder-open"></i>
                                                        <p>Subject</p>
                                                    </div>
                                                    <h5 class="text-light-gray"><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a> </h5>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="post">
                                                    <div class="post-date">
                                                        <p>05</p> <span>Jan</span>
                                                    </div>
                                                    <div class="file-box"> <i class="far fa-folder-open"></i>
                                                        <p>Subject</p>
                                                    </div>
                                                    <h5 class="text-light-gray"><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a> </h5>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="post">
                                                    <div class="post-date">
                                                        <p>06</p> <span>July</span>
                                                    </div>
                                                    <div class="file-box"> <i class="far fa-folder-open"></i>
                                                        <p>Subject</p>
                                                    </div>
                                                    <h5 class="text-light-gray"><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a> </h5>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="post">
                                                    <div class="post-date">
                                                        <p>06</p> <span>July</span>
                                                    </div>
                                                    <div class="file-box"> <i class="far fa-folder-open"></i>
                                                        <p>Subject</p>
                                                    </div>
                                                    <h5 class="text-light-gray"><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a> </h5>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="post">
                                                    <div class="post-date">
                                                        <p>06</p> <span>July</span>
                                                    </div>
                                                    <div class="file-box"> <i class="far fa-folder-open"></i>
                                                        <p>Subject</p>
                                                    </div>
                                                    <h5 class="text-light-gray"><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a> </h5>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="post">
                                                    <div class="post-date">
                                                        <p>06</p> <span>July</span>
                                                    </div>
                                                    <div class="file-box"> <i class="far fa-folder-open"></i>
                                                        <p>Subject</p>
                                                    </div>
                                                    <h5 class="text-light-gray"><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a> </h5>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 order-1">
                <div class="ps-24">
                    <div class="heading text-start">
                        <div class="tagblock mb-16"> <img src="{{ asset('resource/web/assets/media/hero/buld-vec.png')}}" class="bulb-vec" alt="Lightbulb icon representing ideas and insight">
                            <p class="black">About ISICO</p>
                        </div>
                        <h2 class="fw-bold mb-3">{{ $settings->about_title ?? null }}</h2>
                    </div>
                    <p class="mb-36">{{ $defaultSettings->footer_text ?? null}}</p>
                    <div class="d-flex align-items-center gap-24 mb-36">
                        <div class="d-flex align-items-center gap-16"> <img src="{{ asset('resource/web/assets/media/vector/unique-course-vec.png')}}" class="content-vector" alt="Icon representing programs">
                            <div>
                                <h4 class="fw-600 color-primary mb-2">Impactful</h4>
                                <p>Skill Programs</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-16"> <img src="{{ asset('resource/web/assets/media/vector/student-vector.png')}}" class="content-vector" alt="Icon representing beneficiaries">
                            <div>
                                <h4 class="fw-600 color-primary mb-2">Nation-wide</h4>
                                <p>Reach & Empowerment</p>
                            </div>
                        </div>
                    </div>
                    <div> <a href="/about" class="cus-btn"> <span class="text">Learn More About ISICO</span> </a> </div>
                </div>
            </div>
        </div>
    </div>
</section> <!-- Our Courses Section End -->
<section class="trusted-expert-sec py-5 bg-light wow fadeInUp animated" data-wow-delay="340ms">
    <div class="container">
        <div class="text-center mb-5">
            <div class="d-inline-flex align-items-center mb-3"> <img src="{{ asset('resource/web/assets/media/hero/buld-vec.png')}}" class="me-2" alt="" style="width: 30px;">
                <p class="mb-0 fw-semibold text-dark">How We Operate</p>
            </div>
            <h2 class="fw-bold">{{ $settings->operate_main_title ??  null}} <span class="text-primary ms-3">{{ $settings->operate_sub_title ??  null}}</span></h2>
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
                            <img src="{{ asset($section['operate_icon'] ?? 'upload/icon/default-icon.png') }}" alt="icon" style="height: 50px;">
                        </div>
                        <h5 class="fw-semibold mb-3">{{ $index + 1 }}. {{ $section['operate_title'] ?? 'No Title' }}</h5>
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
            <div class="tagblock mb-16"> <img src="{{ asset('resource/web/assets/media/hero/buld-vec.png')}}" class="bulb-vec" alt="">
                <p class="black">Ongoing Projects</p>
            </div>
            <div class="cds-119 css-1v1mgi3 cds-121 mt-2">{{ $settings->on_going_project_title ?? null }}</div>
            <h3 class="fw-bold mt-2 mb-2">{{ $settings->on_going_project_main_title ?? null }} <span class="color-primary"> {{ $settings->on_going_project_main_sub_title ?? null }}</span></h3>
            <p class="cds-119 css-lg65q1 cds-121">{{ $settings->onging_final_titles ?? null }}</p>
        </div> <!-- Swiper -->
        <div class="swiper mySwipers">
            <div class="swiper-wrapper">
                @if ($ongoingProjects->isEmpty())
                    <div class="w-100">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>No projects found.</strong> Please check back later.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @else
                    @foreach ($ongoingProjects as $project)

                        <!-- Slide -->
                        <div class="swiper-slide" data-swiper-autoplay="2000">
                            <div class="blog-card">

                                <a href="{{ route('web.ongoging.project', [$project->category->slug, $project->slug]) }}" class="card-img">
                                    <img src="{{ asset($project->image) }}" alt="{{ $project->title }}">
                                    <span class="date-block">
                                        <span class="h6 fw-400 light-black">{{ \Carbon\Carbon::parse($project->created_at)->format('d') }}</span>
                                        <span class="h6 fw-400 light-black">{{ \Carbon\Carbon::parse($project->created_at)->format('M') }}</span>
                                    </span>
                                </a>
                                <div class="card-content">
                                    {{-- <div class="d-flex align-items-center gap-8 mb-20">
                                        <img src="{{ asset('upload/project/'.$project->image) }}" class="card-user" alt="">
                                        <p>By Admin</p>
                                    </div> --}}
                                    <a href="{{ route('web.ongoging.project', [$project->category->slug, $project->slug]) }}" class="h6 fw-500 mb-8">{{ $project->title }}</a>
                                    <p class="light-gray mb-24">{{ \Illuminate\Support\Str::limit(strip_tags($project->description), 100) }}</p>
                                    <a href="{{ route('web.ongoging.project', [$project->category->slug, $project->slug]) }}" class="card-btn"> Read More</a>
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
            <div class="text-white">{{ $settings->upcoming_project_title ?? null}}</div>
            <h3 class="fw-bold text-white mt-2 mb-2">{!! $settings->upcoming_project_main_sub_title ?? null !!}</h3>
            <p class="text-white">{{ $settings->upcoming_final_title ?? null }}</p>
        </div> <!-- Swiper -->
        <div class="row align-items-center">
            <div class="col-md-12 col-lg-4">
                <div class="wow zoomIn animated mt-5 mb-5" data-wow-delay="590ms">
                    <div class="heading text-start justify-content-start mb-8">
                        <div class="tagblock mb-16 mt-1 mb-4"> <img src="{{ asset('resource/web/assets/media/hero/buld-vec.png')}}" class="bulb-vec" alt="">
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
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @else
                    <div class="swiper upcomingproject">
                        <div class="swiper-wrapper">
                            @foreach ($upcomingProjects as $project)
                                <div class="swiper-slide">
                                    <div class="blog-card">
                                        {{-- {{ route('project.details', $project->slug) }} --}}
                                        <a href="{{ route('web.upcoming.project', [$project->category->slug, $project->slug]) }}" class="card-img">
                                            <img src="{{ asset($project->image) }}" alt="{{ $project->title }}">
                                            <span class="date-block">
                                                <span class="h6 fw-400 light-black">{{ \Carbon\Carbon::parse($project->created_at)->format('d') }}</span>
                                                <span class="h6 fw-400 light-black">{{ \Carbon\Carbon::parse($project->created_at)->format('M') }}</span>
                                            </span>
                                        </a>
                                        <div class="card-content bg-white">
                                            {{-- <div class="d-flex align-items-center gap-8 mb-20">
                                                <img src="{{ asset('upload/project/'.$project->image) }}" class="card-user" alt="">
                                                <p>By Admin</p>
                                            </div> --}}
                                            <a href="{{ route('web.upcoming.project', [$project->category->slug, $project->slug]) }}" class="h6 fw-500 mb-8">{{ $project->title }}</a>
                                            <p class="light-gray mb-24">{{ \Illuminate\Support\Str::limit(strip_tags($project->description), 100) }}</p>
                                            <a href="{{ route('web.upcoming.project', [$project->category->slug, $project->slug]) }}" class="card-btn"> Read More</a>
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
<section class="out-team-sec mt-80 mb-120 wow fadeInUp animated animated" data-wow-delay="540ms" style="visibility: visible; animation-delay: 540ms; animation-name: fadeInUp;">
    <div class="container-fluid">
        <div class="heading mb-48">
            <div class="tagblock mb-16"> <img src="{{ asset('resource/web/assets/media/hero/buld-vec.png')}}" class="bulb-vec" alt="">
                <p class="black">Our Program</p>
            </div>
            <div class="text-start mt-2">{{ $settings->program_project_title }}</div>
            <h3 class="fw-500 text-start mt-2 mb-2">{{ $settings->program_project_main_title }}<span class="color-primary"> {{ $settings->program_project_main_sub_title }}</span> </h3>
            <p class="text-start">{{ $settings->program_final_title }}</p>
        </div>
        <div class="row align-items-stretch h-100">
            @if ($programes->isNotEmpty())
                <div class="swiper mySwiperstwo p-0 m-0">
                    <div class="swiper-wrapper">
                        @foreach ($programes as $program)
                        <div class="swiper-slide">
                            <div class="col-md-*">
                                <div class="team-block">
                                    <div class="img-block">
                                        <img class="w-100"
                                            src="{{ $program->image ? asset($program->image) : asset('resource/web/assets/media/default/default-img.png') }}"
                                            alt="{{ $program->title }}">
                                    </div>
                                    <div class="team-content">
                                        <div>
                                            <a href="{{ route('web.announcement.program', [$program->category->slug, $program->slug]) }}" class="h6 fw-500 mb-4p">{{ $program->title }}</a>
                                            <p class="subtitle">{{ \Illuminate\Support\Str::limit(strip_tags($program->description), 80) }}</p>
                                        </div>
                                       @php
                                                    $currentUrl = urlencode(request()->fullUrl()); // Dynamically get current page URL
                                                    $shareText = urlencode($scheme->title ?? 'Check this out!');
                                                @endphp

                                            <div class="d-flex gap-8 align-items-center">
                                                {{-- LinkedIn Share --}}
                                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $currentUrl }}" target="_blank">
                                                    <img class="links-icon" src="{{ asset('resource/web/assets/media/vector/linkedin.png') }}" alt="LinkedIn">
                                                </a>

                                                {{-- Facebook Share --}}
                                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ $currentUrl }}" target="_blank">
                                                    <img class="links-icon" src="{{ asset('resource/web/assets/media/vector/facebook.png') }}" alt="Facebook">
                                                </a>

                                                {{-- Twitter (X) Share --}}
                                                <a href="https://twitter.com/intent/tweet?url={{ $currentUrl }}&text={{ $shareText }}" target="_blank">
                                                    <img class="links-icon" src="{{ asset('resource/web/assets/media/vector/twitter.png') }}" alt="Twitter">
                                                </a>

                                                {{-- Instagram: Not directly shareable via URL --}}
                                                <a href="https://www.instagram.com/" target="_blank">
                                                    <img class="links-icon" src="{{ asset('resource/web/assets/media/vector/instagram.png') }}" alt="Instagram">
                                                </a>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- Swiper Controls -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-pagination"></div>
                </div>
                @else
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>No educational</strong> Programs available at the moment.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

        </div>
</section>
<!-- end of our Programmes -->
<!-- End Upcoming Projects -->
<style>
    .background-bubbles {
      position: fixed;
      width: 100%;
      height: 100%;
      z-index: 0;
      overflow: hidden;
    }

    .background-bubbles span {
      position: absolute;
      display: block;
      width: 20px;
      height: 20px;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 50%;
      animation: float 20s linear infinite;
    }

    @keyframes float {
      0% {
        transform: translateY(100vh) scale(0.5);
        opacity: 0;
      }

      50% {
        opacity: 0.3;
      }

      100% {
        transform: translateY(-10vh) scale(1);
        opacity: 0;
      }
    }

    .circle-container {
      position: relative;
      width: 100%;
      max-width: 700px;
      height: 700px;
      margin: auto;
      top: 70%;
      transform: translateY(-50%);
      z-index: 2;
      margin-top: 70%;
    }

    .orbit-ring {
      position: absolute;
      top: 50%;
      left: 50%;
      width: 100%;
      height: 100%;
      transform: translate(-50%, -50%);
      border: 2px dashed rgba(255, 255, 255, 0.2);
      border-radius: 50%;
      z-index: 1;
    }

    .central-circle {
      position: absolute;
      top: 50%;
      left: 50%;
      width: 180px;
      height: 180px;
      transform: translate(-50%, -50%);
      background-color: #fff;
      border-radius: 50%;
      text-align: center;
      padding: 20px;
      color: #1e5631;
      font-weight: bold;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
      z-index: 3;
    }

    .orbit-wrapper {
      position: absolute;
      top: 50%;
      left: 50%;
      width: 100%;
      height: 100%;
      transform: translate(-50%, -50%);
      transform-origin: center center;
      z-index: 2;
    }

    .orbiting-box {
      position: absolute;
      width: 160px;
      background-color: #fff;
      color: #1e5631;
      padding: 12px;
      border-radius: 15px;
      text-align: center;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.15);
      transition: background 0.3s;
    }

    .orbiting-box h6 {
      font-weight: bold;
      font-size: 15px;
    }

    .orbiting-box:hover {
      background-color: #6e8b38;
      cursor: pointer;
    }

    .orbiting-box button {
      background: none;
      border: none;
      color: #1e5631;
      font-weight: 600;
      text-decoration: underline;
      margin-top: 5px;
    }

    .box1 {
      top: 0%;
      left: 50%;
      transform: translate(-50%, -50%) rotate(0deg);
    }

    .box2 {
      top: 25%;
      left: 92%;
      transform: translate(-50%, -50%) rotate(0deg);
    }

    .box3 {
      top: 75%;
      left: 92%;
      transform: translate(-50%, -50%) rotate(0deg);
    }

    .box4 {
      top: 100%;
      left: 50%;
      transform: translate(-50%, -50%) rotate(0deg);
    }

    .box5 {
      top: 75%;
      left: 8%;
      transform: translate(-50%, -50%) rotate(0deg);
    }

    .box6 {
      top: 25%;
      left: 8%;
      transform: translate(-50%, -50%) rotate(0deg);
    }

    .block {
        /* background: rgba(39, 48, 126, 0.897); */
        color: #fff;
        padding-top: 20px;
        padding-bottom: 20px;
    }

    .flow {
        position: relative;
        width: 100%;
    }

    .flow .item {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        position: relative;
        padding-top: 20px;
        padding-bottom: 20px;
        word-break: break-all;
    }

    .flow .item:first-child {
        padding-top: 40px;
    }

    .flow .item:last-child {
        padding-bottom: 40px;
    }

    .text h3 {
        color: white;
        font-size: 21px;
    }
    .flow .item::after {
        content: "";
        width: 6px;
        height: 100%;
        left: calc(50% - 8px);
        top: 0;
        border-right: 4px dashed rgb(240, 240, 240);
        z-index: 1;
        position: absolute;
    }

    .flow .item .circle {
        width: 24px;
        height: 24px;
        border-radius: 24px;
        background: #008c01;
        position: relative;
        z-index: 2;
    }

    .flow .item .text {
        position: absolute;
        padding: 20px;
        background: #008c01;
        border-radius: 8px;
    }

    .flow .item:nth-child(odd) .text {
        left: calc(50% + 44px);
    }

    .flow .item:nth-child(even) .text {
        right: calc(50% + 44px);
        text-align: right;
    }

    @media screen and (max-width: 478px) {
        .flow .item {
    justify-content: flex-start;
        }

        .flow .item::after {
    left: 20px;
        }

        .flow .item .circle {
    margin-left: 16px;
        }

        .flow .item .text {
    position: relative;
    left: 30px;
    padding: 20px;
    background: #008c01;
        }

        .flow .item:nth-child(even) .text {
    position: relative;
    text-align: left;
    left: 30px;
        }

        .flow .item:nth-child(odd) .text {
    position: relative;
    text-align: left;
    left: 30px;
        }
    }


    @media (max-width: 768px) {
      .circle-container {
        width: 100%;
        height: 100%;
        max-height: none;
        transform: none;
        top: unset;
        padding-top: 60px;
      }

      .orbiting-box {
        width: 130px;
        padding: 10px;
        font-size: 14px;
      }

      .central-circle {
        width: 140px;
        height: 140px;
        font-size: 14px;
      }
    }
</style>
<div class="container">
    <!-- Core Values -->
    <div class="text-center mb-5">
        <div class="d-inline-flex align-items-center mb-3"> <img src="{{ asset('resource/web/assets/media/hero/buld-vec.png')}}" class="me-2" alt="" style="width: 30px;">
            <p class="mb-0 fw-semibold text-dark">Our Core Values</p>
        </div>
        <h2 class="fw-bold">Smart Learning. Trusted Experts. <span class="text-primary">Everywhere</span></h2>
    </div>
    <div class="row ">
        <div class="col-md-4">
            <div class="row">
                <div class="col-12">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body pt-3 pb-3">
                            <div class="row align-items-center">
                                <div class="col-2 text-center"> <img src="{{ asset('resource/web/assets/media/images/equity.png')}}" alt="" srcset=""> </div>
                                <div class="col-10">
                                    <h5 class="card-title mb-1 fw-semibold">Equity and Inclusion</h5>
                                    <p class="card-text small mb-0 p-2 text-light-gray"> Ensuring access to quality education and training for all, with a focus on marginalized communities. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-2 text-center"> <img src="{{ asset('resource/web/assets/media/images/innovation.png')}}" alt="" srcset=""> </div>
                                <div class="col-10">
                                    <h5 class="card-title mb-1 fw-semibold">Innovation and Sustainability</h5>
                                    <p class="card-text small mb-0 p-2 text-light-gray">Promoting green jobs, emerging technologies, and environmentally sustainable practices. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-2 text-center"> <img src="{{ asset('resource/web/assets/media/images/empowerment.png')}}" alt="" srcset=""> </div>
                                <div class="col-10">
                                    <h5 class="card-title mb-1 fw-semibold">Empowerment</h5>
                                    <p class="card-text small mb-0 p-2 text-light-gray"> Enhancing the capabilities of children, youth, women, and farmers to achieve economic independence and social impact. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-2 text-center"> <img src="{{ asset('resource/web/assets/media/images/collarabration.png')}}" alt="" srcset=""> </div>
                                <div class="col-10">
                                    <h5 class="card-title mb-1 fw-semibold">Collaboration</h5>
                                    <p class="card-text small mb-0 p-2 text-light-gray"> Partnering with government bodies, corporate entities, and international organizations to achieve shared goals. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="d-block d-md-block d-lg-block">
                <!-- <h1>CSS Flow</h1> -->
                <div class="block container-fluid">
                    <div class="flow">
                        <div class="item">
                            <div class="circle"></div>
                            <div class="text">
                                <h3>Step 1</h3>
                                <div>Educational Institutions</div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="circle" style="background: yellow"></div>
                            <div class="text">
                                <h3>Step 2</h3>
                                <div>EdTech Platforms</div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="circle" style="background: rgb(9, 156, 137)"></div>
                            <div class="text">
                                <h3>Step 3</h3>
                                <div>Infrastructure Support</div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="circle" style="background: rgb(255, 0, 170)"></div>
                            <div class="text">
                                <h3>Step 4</h3>
                                <div>Community Building</div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="circle" style="background: rgb(255, 60, 0)"></div>
                            <div class="text">
                                <h3>Step 5</h3>
                                <div>Empowerment</div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="circle" style="background: rgb(255, 0, 157)"></div>
                            <div class="text">
                                <h3>Step 6</h3>
                                <div>Equity and Inclution</div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="circle" style="background: rgb(0, 204, 255)"></div>
                            <div class="text">
                                <h3>Step 7</h3>
                                <div>Collaboration</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-none d-md-none d-lg-none">
                <div class="background-bubbles"> <span style="left: 10%; animation-delay: 0s;"></span> <span style="left: 30%; animation-delay: 2s;"></span> <span style="left: 50%; animation-delay: 4s;"></span> <span style="left: 70%; animation-delay: 1s;"></span> <span style="left: 90%; animation-delay: 3s;"></span> </div>
                <div class="circle-container">
                    <div class="orbit-ring"></div>
                    <div class="central-circle">ISICO<br>Core Framework</div>
                    <div class="orbit-wrapper" id="orbit">
                        <div class="orbiting-box box1" data-bs-toggle="tooltip" title="Hosts learners & infra">
                            <h6>Educational Institutions</h6>
                            <p>Provide learners & centers</p> <button data-bs-toggle="modal" data-bs-target="#modal1">Learn more</button>
                        </div>
                        <div class="orbiting-box box2" data-bs-toggle="tooltip" title="Job alignment & internships">
                            <h6>Industry Partners</h6>
                            <p>Internships & alignment</p> <button data-bs-toggle="modal" data-bs-target="#modal2">Learn more</button>
                        </div>
                        <div class="orbiting-box box3" data-bs-toggle="tooltip" title="Global best practices">
                            <h6>International Collaboration</h6>
                            <p>Exchanges & Certs</p> <button data-bs-toggle="modal" data-bs-target="#modal3">Learn more</button>
                        </div>
                        <div class="orbiting-box box4" data-bs-toggle="tooltip" title="Hybrid & digital content">
                            <h6>EdTech Platforms</h6>
                            <p>Track progress, access</p> <button data-bs-toggle="modal" data-bs-target="#modal4">Learn more</button>
                        </div>
                        <div class="orbiting-box box5" data-bs-toggle="tooltip" title="Labs & infrastructure">
                            <h6>Infrastructure Support</h6>
                            <p>Labs, internet, tools</p> <button data-bs-toggle="modal" data-bs-target="#modal5">Learn more</button>
                        </div>
                        <div class="orbiting-box box6" data-bs-toggle="tooltip" title="Mobilizing learners">
                            <h6>Community Building</h6>
                            <p>Entrepreneurship</p> <button data-bs-toggle="modal" data-bs-target="#modal6">Learn more</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="out-team-sec mt-80 mb-120 wow fadeInUp animated animated" data-wow-delay="540ms" style="visibility: visible; animation-delay: 540ms; animation-name: fadeInUp;">
    <div class="container-fluid">
        <div class="heading mb-48">
            <div class="tagblock mb-16"> <img src="{{ asset('resource/web/assets/media/hero/buld-vec.png')}}" class="bulb-vec" alt="">
                <p class="black">Government Schemes We Support</p>
            </div>
            <div class="text-start mt-2">{{ $settings->gvt_scheme_title ?? null }}</div>
            <h3 class="fw-500 text-start mt-2 mb-2">{{ $settings->gvt_scheme_main_title ?? null }} <span class="color-primary"> {{ $settings->gvt_scheme_main_sub_title ?? null }}</span> </h3>
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
                            <div class="swiper-slide">
                                <div class="col-md-*">
                                    <div class="team-block">
                                        <div class="img-block">
                                            <img class="w-100" src="{{ asset($scheme->image) }}" alt="{{ $scheme->title }}">
                                        </div>
                                        <div class="team-content">
                                            <div>
                                                {{-- {{ route('scheme.details', $scheme->slug) }} --}}
                                                <a href="{{ route('web.announcement.scheme', [$scheme->category->slug, $scheme->slug]) }}" class="h6 fw-500 mb-4p">{{ $scheme->title }}</a>
                                                <p class="subtitle">{{ $scheme->subtitle }}</p>
                                            </div>
                                                @php
                                                    $currentUrl = urlencode(request()->fullUrl()); // Dynamically get current page URL
                                                    $shareText = urlencode($scheme->title ?? 'Check this out!');
                                                @endphp

                                                <div class="d-flex gap-8 align-items-center">
                                                    {{-- LinkedIn Share --}}
                                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $currentUrl }}" target="_blank">
                                                        <img class="links-icon" src="{{ asset('resource/web/assets/media/vector/linkedin.png') }}" alt="LinkedIn">
                                                    </a>

                                                    {{-- Facebook Share --}}
                                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $currentUrl }}" target="_blank">
                                                        <img class="links-icon" src="{{ asset('resource/web/assets/media/vector/facebook.png') }}" alt="Facebook">
                                                    </a>

                                                    {{-- Twitter (X) Share --}}
                                                    <a href="https://twitter.com/intent/tweet?url={{ $currentUrl }}&text={{ $shareText }}" target="_blank">
                                                        <img class="links-icon" src="{{ asset('resource/web/assets/media/vector/twitter.png') }}" alt="Twitter">
                                                    </a>

                                                    {{-- Instagram: Not directly shareable via URL --}}
                                                    <a href="https://www.instagram.com/" target="_blank">
                                                        <img class="links-icon" src="{{ asset('resource/web/assets/media/vector/instagram.png') }}" alt="Instagram">
                                                    </a>
                                                </div>

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
<div class="ai-background-v">
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="shape shape-3"></div>
    <div class="container content">
        <div class="text-center mt-5 mb-3">
            <div class="d-inline-flex align-items-center mb-3"> <img src="{{ asset('resource/web/assets/media/hero/buld-vec.png')}}" class="me-2" alt="" style="width: 30px;">
                <p class="mb-0 fw-semibold text-dark">Our Focus</p>
            </div>
            <h2 class="fw-bold mb-3"><span class="text-primary">{{ $settings->focus_main_title }}</span></h2>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-6">
            @php
                $focusAreas = [];

                if (!empty($settings->focus_areas)) {
                    if (is_string($settings->focus_areas)) {
                        $decoded = json_decode($settings->focus_areas, true);
                        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                            $focusAreas = $decoded;
                        }
                    } elseif (is_array($settings->focus_areas)) {
                        $focusAreas = $settings->focus_areas;
                    }
                }
            @endphp


            @if (!empty($focusAreas))
                <div class="accordion" id="focusAccordion">
                    @foreach($focusAreas as $index => $item)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $index }}">
                                <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{ $index }}"
                                        aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                        aria-controls="collapse{{ $index }}">
                                    {{ $index + 1 }}. {{ $item['focus_title'] ?? 'No Title' }}
                                </button>
                            </h2>
                            <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                aria-labelledby="heading{{ $index }}"
                                data-bs-parent="#focusAccordion">
                                <div class="accordion-body">
                                    {{ $item['focus_description'] ?? 'No Description available.' }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif


            </div>
            <div class="col-md-12 col-lg-6">
                <!-- Our Collaborative Approach -->
                <h2 class="fw-400 mt-2 mb-1">Our Collaborative Approach</h2>
                <p>ISICO aligns its initiatives with national priorities, including the NEP 2020, and works closely with: </p>
                <div id="partnershipsSection bg-white">
                    <h2 class="mt-5 mb-4 text-primary">Partnerships</h2>
                    <div class="faq card">
                        <div class="card-body">
                            <div class="faq-block mb-24"> <a href="#" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#partner1" aria-expanded="true" aria-controls="partner1"> <span class="fw-500">01.</span> &nbsp; Government Schemes </a>
                                <div id="partner1" class="accordion-collapse collapse show" aria-labelledby="partner1" data-bs-parent="#partnershipsSection">
                                    <p class="text-start">Partnering with state and central programs to implement skill and education initiatives.</p>
                                </div>
                            </div>
                            <div class="faq-block mb-24"> <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#partner2" aria-expanded="false" aria-controls="partner2"> <span class="fw-500">02.</span> &nbsp; Corporate Social Responsibility (CSR) </a>
                                <div id="partner2" class="accordion-collapse collapse" aria-labelledby="partner2" data-bs-parent="#partnershipsSection">
                                    <p>Leveraging CSR support for community-based projects in education and skill-building.</p>
                                </div>
                            </div>
                            <div class="faq-block"> <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#partner3" aria-expanded="false" aria-controls="partner3"> <span class="fw-500">03.</span> &nbsp; International Partnerships </a>
                                <div id="partner3" class="accordion-collapse collapse" aria-labelledby="partner3" data-bs-parent="#partnershipsSection">
                                    <p>Facilitating knowledge exchange and technical expertise to bring global best practices to Indian communities. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- Future Goals -->
        <div class="row">
            <div class="col-md-6">
                <!-- Message from the Founder -->
                <div class="text-center mt-5">
                    <div class="d-inline-flex align-items-center mb-3"> <img src="{{ asset('resource/web/assets/media/hero/buld-vec.png')}}" class="me-2" alt="" style="width: 30px;">
                        <p class="mb-0 fw-semibold text-dark">Our Message</p>
                    </div>
                    <h2 class="fw-bold mb-3">A Message from the <span class="text-primary">Founder</span></h2>
                </div>
                <div class="mt-5 p-4 bg-white border-start border-5 shadow-sm">
                    <div class="alert alert-primary"> "{{ $settings->founder_message ?? null }}"<br> <strong class="text-end" style="text-indent: 40px;    display: block;">{{ $settings->founder_name }}, <cite title="Source Title">Founder, ISICO</cite></strong> </div>
                </div>
                <style>
                    .alert-primary {
                      --bs-alert-color: #018c01;
                      --bs-alert-bg: #f3fff3;
                      --bs-alert-border-color: #018c01;
                      -alert-link-color: #018c01;
                    }
                </style>
            </div>
            <div class="col-md-6">
                <h2 class="mt-5 mb-4 text-primary"></h2> <!-- Message from the Founder -->
                <div class="text-center mt-5">
                    <div class="d-inline-flex align-items-center mb-3"> <img src="{{ asset('resource/web/assets/media/hero/buld-vec.png')}}" class="me-2" alt="" style="width: 30px;">
                        <p class="mb-0 fw-semibold text-dark">Our Future</p>
                    </div>
                    <h2 class="fw-bold mb-3">Future <span class="text-primary">Goals</span></h2>
                </div>
                <p>ISICO is steadfast in its commitment to:</p>
                @if(!empty($settings->future_goals) && is_array($settings->future_goals))
                <div class="accordion" id="futureGoalsAccordion">
                    @foreach($settings->future_goals as $index => $goal)
                        @php
                            $goalId = 'goal' . $index;
                        @endphp
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $goalId }}">
                                <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{ $goalId }}"
                                        aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                        aria-controls="collapse{{ $goalId }}">
                                    {{ $index + 1 }}. {{ $goal['goal_title'] ?? 'No Title' }}
                                </button>
                            </h2>
                            <div id="collapse{{ $goalId }}"
                                class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                aria-labelledby="heading{{ $goalId }}"
                                data-bs-parent="#futureGoalsAccordion">
                                <div class="accordion-body text-start">
                                    {{ $goal['goal_description'] ?? 'No Description' }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>No future goals found.</p>
            @endif

            </div>
        </div>
    </div>
</div>
<div class="scontent-block mb-120 wow fadeInUp animated d-none d-md-none d-lg-block" data-wow-delay="440ms">
    <div class="container-fluid">
        <div class="block-content">
            <div class="block-1"> <img class="num-vector" src="{{ asset('resource/web/assets/media/vector/instructor.png')}}" alt="Expert Trainers">
                <div>
                    <h3 class="fw-500 mb-8">250+</h3>
                    <h6 class="fw-500 dark-gray">Certified Trainers</h6>
                </div>
            </div>
            <div class="vr-line"></div>
            <div class="block-1"> <img class="num-vector" src="{{ asset('resource/web/assets/media/vector/review.png')}}" alt="Student Feedback">
                <div>
                    <h3 class="fw-500 mb-8">1,000+</h3>
                    <h6 class="fw-500 dark-gray">Positive Student Reviews</h6>
                </div>
            </div>
            <div class="vr-line d-sm-block d-none"></div>
            <div class="block-1"> <img class="num-vector" src="{{ asset('resource/web/assets/media/vector/happy-student.png')}}" alt="Trained Students">
                <div>
                    <h3 class="fw-500 mb-8">5,000+</h3>
                    <h6 class="fw-500 dark-gray">Skilled Students Trained</h6>
                </div>
            </div>
            <div class="vr-line"></div>
            <div class="block-1"> <img class="num-vector" src="{{ asset('resource/web/assets/media/vector/winning-award.png')}}" alt="Recognition">
                <div>
                    <h3 class="fw-500 mb-8">15+</h3>
                    <h6 class="fw-500 dark-gray">National Recognitions</h6>
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
                <div class="row row-gap-4"> <img src="https://cms-images.udemycdn.com/96883mtakkm8/4VtZJzu6lTsioWNxHT7InO/96f1940aef37c7cbab353650fbf89eed/UB_Case_Studies_Booz_Allen_image.png" alt="" srcset=""> </div>
            </div>
            <div class="col-lg-6">
                <div class="heading text-start justify-content-start mb-36">
                    <div class="tagblock mb-16"> <img src="{{ asset('resource/web/assets/media/hero/buld-vec.png')}}" class="bulb-vec" alt="">
                        <p class="black"> International Collaboration</p>
                    </div>
                    <h3 class="fw-500">{{ $settings->collaboration_main_title ?? null }}<br class="d-lg-block d-none"> <span class="color-primary d-inline">{{ $settings->collaboration_sub_title ?? null }}</span> </h3>
                </div>
                @php
                    $collaborations = is_string($settings->international_collaborations)
                        ? json_decode($settings->international_collaborations, true)
                        : $settings->international_collaborations;
                @endphp

                @if(!empty($collaborations) && is_array($collaborations))
                    <div id="learningjourney">
                        <div class="faq">
                            @foreach($collaborations as $index => $faq)
                                @php
                                    $faqId = 'bc-faq' . ($index + 1) . '-left';
                                @endphp
                                <div class="faq-block mb-24">
                                    <a href="#" class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#{{ $faqId }}"
                                    aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                    aria-controls="{{ $faqId }}">
                                        <span class="fw-500">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}.</span>
                                        &nbsp; {{ $faq['question'] ?? 'Untitled Question' }}
                                    </a>
                                    <div id="{{ $faqId }}"
                                        class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                        aria-labelledby="{{ $faqId }}"
                                        data-bs-parent="#learningjourney">
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
@if(!$testimonials->isEmpty())
<section class="testimonial-sec bg-light">
    <div class="container-fluid">
        <div class="text-center mt-4">
            <div class="d-inline-flex align-items-center mt-3"> <img src="{{ asset('resource/web/assets/media/hero/buld-vec.png')}}" class="me-2" alt="" style="width: 30px;">
                <p class="mb-0 fw-semibold text-dark">Testimonial</p>
            </div>
            <h2 class="fw-bold text-center">Students Say <span class="text-primary">Testimonial</span></h2>
        </div>
        <div class="row row-gap-4 align-items-center">
            <div class="col-lg-4 wow zoomIn animated mt-5 mb-5" data-wow-delay="590ms">
                <div class="heading text-start justify-content-start mb-8">
                    <div class="tagblock mb-16 mt-5 mb-4"> <img src="{{ asset('resource/web/assets/media/hero/buld-vec.png')}}" class="bulb-vec" alt="">
                        <p class="black">Hear What Our Students Say</p>
                    </div>
                    <h3 class="fw-500">Join thousands who’ve transformed their <span class="color-primary">Careers with ISICO</span> </h3>
                </div>
                <p>At ISICO, we empower individuals through skill-based training, real-world experience, and professional mentorship to build bright futures across India. </p>
            </div>
            <div class="col-lg-8 mt-5 mb-5">
                <div class="slider-arrows">
                    <a href="javascript:;" class="arrow-btn btn-prev" data-slide="testimonial-slider"></a>
                    <div class="testimonial-slider row">
                        @foreach($testimonials as $testimonial)
                            <div class="testimonial-block col-12">
                                <h6 class="fw-500 mb-16">{{ $testimonial->title ?? 'User Feedback' }}</h6>
                                <p class="mb-24">"{{ $testimonial->message }}"</p>
                                <div class="d-flex align-items-center gap-12">
                                    <img src="{{ asset($testimonial->image) }}" class="block-user" alt="{{ $testimonial->name }}">
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
@if($brands->isNotEmpty())
<div class="text-center mt-5">
    <div class="d-inline-flex align-items-center mb-3"> <img src="{{ asset('resource/web/assets/media/hero/buld-vec.png')}}" class="me-2" alt="" style="width: 30px;">
        <p class="mb-0 fw-semibold text-dark">Our Partners</p>
    </div>
    <h2 class="fw-bold mb-3">Our Brand <span class="text-primary">Partners</span></h2>
</div>
<div class="Marquees">
    <div class="Marquee FirstRow">
        @foreach($brands as $brand)
            <div class="marquee Item">
                <img src="{{ asset($brand->image) }}" alt="{{ $brand->name }}" height="40">
            </div>
        @endforeach
    </div>
    {{-- <div class="Marquee SecondRow">
        <div class="marquee Item"><i class="bi bi-instagram"></i></div>
        <div class="marquee Item"><i class="bi bi-discord"></i></div>
        <div class="marquee Item"><i class="bi bi-github"></i></div>
        <div class="marquee Item"><i class="bi bi-slack"></i></div>
        <div class="marquee Item"><i class="bi bi-dribbble"></i></div>
        <div class="marquee Item"><i class="bi bi-behance"></i></div>
        <div class="marquee Item"><i class="bi bi-skype"></i></div>
        <div class="marquee Item"><i class="bi bi-telegram"></i></div>
    </div> --}}
</div> <!-- Main Sections -->
@endif
</div>

    <!-- content @e -->
    @endsection
