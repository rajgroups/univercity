@push('meta')
    <title>{{ $metaTitle ?? ($course->name ?? 'Default Page Title') }}</title>

    <meta name="description"
        content="{{ $metaDescription ?? Str::limit(strip_tags($course->short_description ?? ''), 150) }}">
    <meta name="keywords" content="{{ $metaKeywords ?? 'announcement, news, education' }}">
    <meta name="author" content="{{ $metaAuthor ?? 'YourSiteName' }}">
    <meta name="robots" content="{{ $metaRobots ?? 'index, follow' }}">

    <!-- Canonical Tag -->
    <link rel="canonical" href="{{ $metaCanonical ?? url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:title" content="{{ $metaOgTitle ?? ($course->name ?? 'Default OG Title') }}">
    <meta property="og:description"
        content="{{ $metaOgDescription ?? Str::limit(strip_tags($course->short_description ?? ''), 150) }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $metaOgUrl ?? url()->current() }}">
    <meta property="og:image" content="{{ $metaOgImage ?? asset($course->image ?? 'default.jpg') }}">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $metaTwitterTitle ?? ($course->name ?? 'Default Twitter Title') }}">
    <meta name="twitter:description"
        content="{{ $metaTwitterDescription ?? Str::limit(strip_tags($course->short_description ?? ''), 150) }}">
    <meta name="twitter:image" content="{{ $metaTwitterImage ?? asset($course->image ?? 'default.jpg') }}">
@endpush
@extends('layouts.web.app')
@section('content')
    <!-- Yout Content Here -->
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <div id="prodetailsslider" class="carousel slide" data-bs-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active" aria-current="true"
                            aria-label="First slide"></li>
                        <li data-bs-target="#carouselId" data-bs-slide-to="1" aria-label="Second slide"></li>
                        <li data-bs-target="#carouselId" data-bs-slide-to="2" aria-label="Third slide"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img src="{{ asset($course->image) }}" class="w-100 d-block" alt="First slide" />
                        </div>
                    </div>
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
            <div class="col-md-12 col-lg-6">
                <div class="card text-start">
                    <!-- <img class="card-img-top" src="holder.js/100px180/" alt="Title" /> -->
                    <div class="card-body">
                        <div class="pt-3 pb-3 course-info">
                            <h4 class="card-title">{{ $course->name ?? null }}</h4>
                        </div>
                        <div class="course-provider d-flex align-items-center gap-20">
                            <div class="course-provider-name"><a>{{ $course->provider ?? null }}</a></div>
                            <div class="course-ratings"><!----></div>
                            <div class="course-payment">
                                <h6>
                                    @if ($course->paid_type == 'Free')
                                        <i class="fas fa-badge-check text-success"></i> Free
                                    @else
                                        <i class="fas fa-money-bill-wave text-warning"></i> Paid
                                    @endif
                                </h6>
                            </div>
                        </div>
                        <div
                            class="course-sector-info d-flex flex-column flex-md-row justify-content-evenly align-items-center text-light-gray pt-2 pb-2">
                            <p>{{ $course->program_by ?? null }}</p>
                            <p><i class="fa fa-users"></i>&nbsp;&nbsp;{{ $course->enrollment_count ?? null }}+ Enrolled
                            </p>

                            <p><i class="fa fa-clock" aria-hidden="true"></i>&nbsp;&nbsp; {{ $course->duration ?? null }}
                                Minutes</p>
                        </div>
                        <div class="course-short-desc pt-3 text-secondary">
                            <p class="">{!! $course->short_description ?? null !!}</p>
                        </div>
                        {{-- <hr class="mt-2 mb-2">
                        <div class="mt-2">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="" id=""
                                            aria-describedby="helpId" placeholder="" />
                                        <!-- <small id="helpId" class="form-text text-muted">Help text</small> -->
                                    </div>

                                </div>
                                <div class="col-md-2">
                                    <a name="" id="" class="mt-4 btn btn-primary" href="#"
                                        role="button">Enrolle</a>

                                </div>
                            </div>
                        </div> --}}
                    </div>

                </div>
            </div>

        </div>
    </div>
    <!-- BLog Detail Section Start -->
    <section class="blog-detail-sec mt-5">
        <div class="container-fluid">
            <div class="row row-gap-4">
                <div class="col-lg-8">
                    {!! $course->long_description !!}
                    <img src="{{ asset($course->image) }}" alt="Course Image" class="img-fluid mb-3"
                        style="width: 100%">
                </div>
                <div class="col-lg-4">
                    <div class="siderbar">
                        {{-- <div class="sidebar-block mb-48">
                            <form class="search-form">
                                <input type="text" name="search" id="search" placeholder="Search">
                                <button type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="20"
                                        height="21" viewBox="0 0 20 21" fill="none">
                                        <path
                                            d="M17.5 18L14.5834 15.0833M16.6667 10.0833C16.6667 13.9954 13.4954 17.1667 9.58333 17.1667C5.67132 17.1667 2.5 13.9954 2.5 10.0833C2.5 6.17132 5.67132 3 9.58333 3C13.4954 3 16.6667 6.17132 16.6667 10.0833Z"
                                            stroke="#92949F" stroke-width="1.66667" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg></button>
                            </form>
                        </div> --}}
                        <div class="sidebar-block mb-48">
                            <h5 class="fw-500 mb-24">Sectors</h5>
                            <ul>
                                @forelse ($sectors as $sector)
                                    <li>
                                        <a href="{{ route('web.sector') }}"
                                            class="mb-12 light-gray">{{ $sector->name ?? null }}</a>
                                    </li>
                                @empty
                                    <div class="alert alert-warning mt-3" role="alert">
                                        No sectors available at the moment.
                                    </div>
                                @endforelse

                            </ul>
                        </div>
                        {{-- @if ($blogs->count())
                            <div class="sidebar-block mb-48">
                                <h5 class="fw-500 mb-24">Similar Blogs</h5>
                                @foreach ($blogs as $blog)
                                    <div class="recent-article mb-12">
                                        <img src="{{ asset('uploads/blogs/' . $blog->image) }}" class="article-img"
                                            alt="{{ $blog->title }}">
                                        <div>
                                            <a href="{{ route('web.blog.show', $blog->slug) }}"
                                                class="fw-500 black mb-8 hover-content">
                                                {{ Str::limit($blog->title, 50) }}
                                            </a>
                                            <p class="light-gray subtitle">
                                                {{ \Carbon\Carbon::parse($blog->created_at)->format('d/m/Y') }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif --}}

                        <div class="sidebar-block">
                            <h5 class="fw-500 mb-24">Other Courses</h5>
                            <div class="tag-block">
                                @forelse ($otherCourses as $other)
                                    <a href="{{ route('web.course.show', $other->slug) }}">
                                        {{ $other->title }}
                                    </a>
                                @empty
                                    <div class="alert alert-warning">No other courses found.</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- BLog Detail Section End -->
    <!-- Our Programmes -->
    <section class="out-team-sec mt-80 mb-120 wow fadeInUp animated animated" data-wow-delay="540ms"
        style="visibility: visible; animation-delay: 540ms; animation-name: fadeInUp;">
        <div class="container-fluid">
            <div class="heading mb-48">
                <div class="tagblock mb-16"> <img src="{{ asset('resource/web/assets/media/hero/buld-vec.png') }}"
                        class="bulb-vec" alt="">
                    <p class="black">Our Program</p>
                </div>
                <div class="text-start mt-2">{{ $settings->program_project_title }}</div>
                <h3 class="fw-500 text-start mt-2 mb-2">{{ $settings->program_project_main_title }}<span
                        class="color-primary"> {{ $settings->program_project_main_sub_title }}</span> </h3>
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
                                                    <a href="{{ route('web.announcement.program', [$program->category->slug, $program->slug]) }}"
                                                        class="h6 fw-500 mb-4p">{{ $program->title }}</a>
                                                    <p class="subtitle">
                                                        {{ \Illuminate\Support\Str::limit(strip_tags($program->description), 80) }}
                                                    </p>
                                                </div>
                                                @php
                                                    $currentUrl = urlencode(request()->fullUrl()); // Dynamically get current page URL
                                                    $shareText = urlencode($scheme->title ?? 'Check this out!');
                                                @endphp

                                                <div class="d-flex gap-8 align-items-center">
                                                    {{-- LinkedIn Share --}}
                                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $currentUrl }}"
                                                        target="_blank">
                                                        <img class="links-icon"
                                                            src="{{ asset('resource/web/assets/media/vector/linkedin.png') }}"
                                                            alt="LinkedIn">
                                                    </a>

                                                    {{-- Facebook Share --}}
                                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $currentUrl }}"
                                                        target="_blank">
                                                        <img class="links-icon"
                                                            src="{{ asset('resource/web/assets/media/vector/facebook.png') }}"
                                                            alt="Facebook">
                                                    </a>

                                                    {{-- Twitter (X) Share --}}
                                                    <a href="https://twitter.com/intent/tweet?url={{ $currentUrl }}&text={{ $shareText }}"
                                                        target="_blank">
                                                        <img class="links-icon"
                                                            src="{{ asset('resource/web/assets/media/vector/twitter.webp') }}"
                                                            alt="Twitter">
                                                    </a>

                                                    {{-- Instagram: Not directly shareable via URL --}}
                                                    <a href="https://www.instagram.com/" target="_blank">
                                                        <img class="links-icon"
                                                            src="{{ asset('resource/web/assets/media/vector/instagram.webp') }}"
                                                            alt="Instagram">
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

    <!-- How We Operate Section End -->
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

                                    <a href="{{ route('web.ongoging.project', [$project->category->slug, $project->slug]) }}"
                                        class="card-img">
                                        <img src="{{ asset($project->image) }}" alt="{{ $project->title }}">
                                        <span class="date-block">
                                            <span
                                                class="h6 fw-400 light-black">{{ \Carbon\Carbon::parse($project->created_at)->format('d') }}</span>
                                            <span
                                                class="h6 fw-400 light-black">{{ \Carbon\Carbon::parse($project->created_at)->format('M') }}</span>
                                        </span>
                                    </a>
                                    <div class="card-content">
                                        {{-- <div class="d-flex align-items-center gap-8 mb-20">
                                            <img src="{{ asset('upload/project/' . $project->image) }}" class="card-user"
                                                alt="">
                                            <p>By Admin</p>
                                        </div> --}}
                                        <a href="{{ route('web.ongoging.project', [$project->category->slug, $project->slug]) }}"
                                            class="h6 fw-500 mb-8">{{ $project->title }}</a>
                                        <p class="light-gray mb-24">
                                            {{ \Illuminate\Support\Str::limit(strip_tags($project->description), 100) }}
                                        </p>
                                        <a href="{{ route('web.ongoging.project', [$project->category->slug, $project->slug]) }}"
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
    </div>
    <!-- Our Courses Section Start -->
        <div class="container mt-5">
        <ul class="nav nav-tabs justify-content-start" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1"
                    type="button" role="tab">Course Details</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2" type="button"
                    role="tab">Addition details</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab3-tab" data-bs-toggle="tab" data-bs-target="#tab3" type="button"
                    role="tab">Topics</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab4-tab" data-bs-toggle="tab" data-bs-target="#tab4" type="button"
                    role="tab">Elibibility Criteria</button>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                <div class="container mt-4">
                    <div class="row bg-light p-3 rounded shadow-sm">
                        @if($course->provider)
                        <div class="col-md-3 mb-3">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-person-badge fs-3 me-3 text-primary"></i>
                                <div>
                                    <h6 class="mb-1">Training Partner</h6>
                                    <p class="mb-0 text-muted">{{ $course->provider ?? null }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($course->language)
                        <div class="col-md-3 mb-3">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-translate fs-3 me-3 text-success"></i>
                                <div>
                                    <h6 class="mb-1">Languages</h6>
                                    <p class="mb-0 text-muted">{{ $course->language ?? null }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($course->certification_type)
                        <div class="col-md-3 mb-3">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-award fs-3 me-3 text-warning"></i>
                                <div>
                                    <h6 class="mb-1">Certification Type</h6>
                                    <p class="mb-0 text-muted">{{ $course->certification_type ?? null }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($course->assessment_mode)
                        <div class="col-md-3 mb-3">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-person-check-fill fs-3 me-3 text-info"></i>
                                <div>
                                    <h6 class="mb-1">Assessment Mode</h6>
                                    <p class="mb-0 text-muted">{{ $course->assessment_mode ?? null }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($course->qp_code)
                        <div class="col-md-3 mb-3">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-code-slash fs-3 me-3 text-danger"></i>
                                <div>
                                    <h6 class="mb-1">QP Code</h6>
                                    <p class="mb-0 text-muted">{{ $course->qp_code ?? null }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($course->nsqf_level)
                        <div class="col-md-3 mb-3">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-layers fs-3 me-3 text-secondary"></i>
                                <div>
                                    <h6 class="mb-1">NSQF Level</h6>
                                    <p class="mb-0 text-muted">{{ $course->nsqf_level ?? null }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($course->credits_assigned)
                        <div class="col-md-3 mb-3">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-journal-x fs-3 me-3 text-dark"></i>
                                <div>
                                    <h6 class="mb-1">Credits Assigned</h6>
                                    <p class="mb-0 text-muted">{{ $course->credits_assigned ?? null }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

            </div>
            <div class="tab-pane fade" id="tab2" role="tabpanel">
                <div class="row bg-light p-3 rounded shadow-sm">
                    @if($course->learning_product_type)
                    <div class="col-md-3 mb-3">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-book fs-3 me-3 text-primary"></i>
                            <div>
                                <h6 class="mb-1">Learning Product Type</h6>
                                <p class="mb-0 text-muted">{{ $course->learning_product_type ?? null }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($course->program_by)
                    <div class="col-md-3 mb-3">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-award-fill fs-3 me-3 text-success"></i>
                            <div>
                                <h6 class="mb-1">Program By</h6>
                                <p class="mb-0 text-muted">{{ $course->program_by ?? null }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($course->initiative_of)
                    <div class="col-md-3 mb-3">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-bullseye fs-3 me-3 text-warning"></i>
                            <div>
                                <h6 class="mb-1">Initiative of</h6>
                                <p class="mb-0 text-muted">{{ $course->initiative_of ?? null }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($course->program)
                    <div class="col-md-3 mb-3">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-building fs-3 me-3 text-danger"></i>
                            <div>
                                <h6 class="mb-1">Program</h6>
                                <p class="mb-0 text-muted">{{ $course->program ?? null }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($course->domain)
                    <div class="col-md-3 mb-3">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-globe2 fs-3 me-3 text-info"></i>
                            <div>
                                <h6 class="mb-1">Domain</h6>
                                <p class="mb-0 text-muted">{{ $course->domain ?? null }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($course->occupations)
                    <div class="col-md-3 mb-3">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-people-fill fs-3 me-3 text-secondary"></i>
                            <div>
                                <h6 class="mb-1">Occupations</h6>
                                <p class="mb-0 text-muted">{{ $course->occupations ?? null }}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
            <div class="tab-pane fade" id="tab3" role="tabpanel">
                @php
                    $topics = json_decode($course->topics, true);
                @endphp

                <div class="accordion" id="courseTopicsAccordion">
                    @foreach ($topics as $index => $topic)
                        @php
                            $headingId = 'heading' . $index;
                            $collapseId = 'collapse' . $index;
                            $show = $index === 0 ? 'show' : '';
                            $collapsed = $index === 0 ? '' : 'collapsed';
                        @endphp

                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header" id="{{ $headingId }}">
                                <button class="accordion-button {{ $collapsed }} bg-transparent shadow-none"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}"
                                    aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">
                                    {{ $topic['title'] }}
                                </button>
                            </h2>
                            <div id="{{ $collapseId }}" class="accordion-collapse collapse {{ $show }}"
                                data-bs-parent="#courseTopicsAccordion">
                                <div class="accordion-body text-muted">
                                    {{ $topic['description'] }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
            <div class="tab-pane fade" id="tab4" role="tabpanel">
                <div class="row bg-light p-3 rounded shadow-sm">
                    @if($course->required_age)
                    <div class="col-md-3 mb-3">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-calendar2-week fs-3 me-3 text-primary"></i>
                            <div>
                                <h6 class="mb-1">Required Age</h6>
                                <p class="mb-0 text-muted">{{ $course->required_age ?? null }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($course->minimum_education)
                    <div class="col-md-3 mb-3">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-mortarboard-fill fs-3 me-3 text-success"></i>
                            <div>
                                <h6 class="mb-1">Minimum Education</h6>
                                <p class="mb-0 text-muted">{{ $course->minimum_education ?? null }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($course->industry_experience)
                    <div class="col-md-3 mb-3">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-briefcase-fill fs-3 me-3 text-warning"></i>
                            <div>
                                <h6 class="mb-1">Industry Experience</h6>
                                <p class="mb-0 text-muted">{{ $course->industry_experience ?? null }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($course->learning_tools)
                    <div class="col-md-3 mb-3">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-tools fs-3 me-3 text-danger"></i>
                            <div>
                                <h6 class="mb-1">Learning Tools</h6>
                                <p class="mb-0 text-muted">{{ $course->learning_tools ?? null }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

    <section class="title-banner mb-120">
        <div class="container-fluid">
            <h2 class="fw-500 mb-24">{{ $course->name }}<br class="d-sm-block d-none">
                {{ $course->short_name }} <span class="color-primary"> {{ $course->language }}</span></h2>
            <div class="d-flex align-items-center gap-16 flex-wrap row-gap-4">
                <div class="d-flex align-items-center gap-8">
                    <i class="bi bi-folder-fill text-warning"></i>
                    <p class="light-gray">{{ $course->name }}</p>
                </div>
                <div class="d-flex align-items-center gap-8">
                    <p class="text-muted">
                        <i class="bi bi-calendar-event me-2 text-primary"></i>
                        {{ \Carbon\Carbon::parse($course->created_at)->format('F jS, Y') }}
                    </p>
                </div>
                {{-- <div class="d-flex align-items-center gap-8">
                    <p class="light-gray">Emily Watson</p>
                </div> --}}
            </div>
        </div>
    </section>
    </div>
@endsection
