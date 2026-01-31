@php
    use App\Models\Category;
    use App\Models\Blog;

    $educationPrograms = Category::where('type', '1')->where('status', 1)->get();
    $skillPrograms = Category::where('type', '2')->where('status', 1)->get();
    $csrPrograms = Category::where('type', '3')->where('status', 1)->get();

    $collaborations = Blog::where('type', '3')->where('status', 1)->get();
@endphp
<style>
    #preloader {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background-color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .zip-loader img {
        width: 100px;
        /* adjust size as needed */
        height: auto;
    }

    @media (max-width: 767.98px) {
        .col-md-4.d-flex.align-items-center.gap-3.order-2.order-md-1.justify-content-center.justify-content-md-start {
            display: flex !important;
            margin-top: 10px;
        }

        .justify-content-between-sm {
            justify-content: space-between !important;
        }

        .text-center-sm {
            text-align: center;
        }

        .d-none-tblet {
            display: none;
        }
    }

    @media only screen and (min-width: 768px) {
        .d-lg-block-one {
            display: none;
        }

        @media only screen and (min-width: 992px) {
            .d-lg-block-one {
                display: inline-block;
            }
        }
    }

    .swiper {
        width: 100%;
        padding-top: 50px;
        padding-bottom: 50px;
    }

    .swiper-slide {
        background-position: center;
        background-size: cover;
        width: 300px;
        height: auto;
    }

    .swiper-slide img {
        display: block;
        width: 100%;
    }
</style>
<!-- Main Wrapper Start -->
<div id="scroll-container" class="main-wrapper">
    <!-- Header Menu Start -->
    <div class="header-wrapper">
        @if ($defaultSettings->announcement_text)
            <div class="header-top">
                <div class="container-fluid">
                    <p class="white"> {{ $defaultSettings->announcement_text ?? null }}</p>
                </div>
            </div>
        @endif
        <div class="main-header" style="background-color: #fafafa;border-bottom: 1px solid rgb(202, 202, 202);">
            <div class="container-fluid">
                <div class="row p-2 bg-white text-dark justify-content-between align-items-center">
                    <div class="col-md-6 text-center-sm">
                        {{-- <img src="https://www.skillindiadigital.gov.in/assets/new-ux-img/india-flag.svg" alt="" srcset=""> | --}}
                        <img src="{{ asset('resource/web/assets/media/vector/india-flag.svg') }}" alt="flag"
                            srcset=""> |
                       ISICO | National Skill Development NGO
                    </div>
                    <div class="col-md-6 d-flex justify-content-between-sm" style="align-items: center;">
                        {{-- <p class="p-2 d-none d-lg-block">Skip To Main Content</p> --}}
                        {{-- <div class="item p-2">
                            <i class="bi bi-badge-ad p-2"></i>
                        </div> --}}
                        <div class="item p-2">
                            <i class="bi bi-geo-alt-fill"></i> Karaikudi
                        </div>
                        <div class="item p-2 text-light-gray">
                            <a href="{{ url('/') }}">
                                <i class="bi bi-house-fill"></i> Home </a>
                        </div>
                        <div class="item p-2 text-light-gray">
                            <div class="dropdown">
                                <button class="btn p-2 text-light-gray" id="moreMenu" data-bs-toggle="dropdown" aria-expanded="false">
                                    More <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="moreMenu">
                                    <li><a class="dropdown-item" href="{{ route('web.activity') }}">NTI Competetions/Events</a></li>
                                    <li><a class="dropdown-item" href="{{ route('contact') }}">Donate Now</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <header class="main-menu">
            <div class="header-section">
                <div class="container-fluid"
                    style="background-color: #fafafa;border-bottom: 0px solid rgb(202, 202, 202);">
                    <div class="hero-topbar-block py-2 bg-white"
                        style="background-color: #fafafa;border-bottom: 0px solid rgb(202, 202, 202);">
                        <div class="row align-items-center justify-content-between gy-2">
                            <!-- Search Bar (Always First on Mobile) -->
                            <form method="GET" action="{{ route('web.course.index') }}">
                                <div class="col-12 d-block d-md-none order-1">
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="fa fa-search"></i>
                                        </span>
                                        <input type="text" name="search" class="form-control border-start-0"
                                            placeholder="Search Skill Courses" value="{{ request('search') }}">
                                        <button type="submit" class="btn btn-outline-secondary d-none">Search</button>
                                    </div>
                                </div>
                            </form>
                            <!-- Logos -->
                            <div class="col-md-3">
                                <a href="/"> <img src="{{ asset($defaultSettings->site_logo ?? null) }}"
                                        alt="{{ $defaultSettings->site_title ?? null }}" style="height: 54px;"></a>
                            </div>

                            <!-- Search Bar (Visible on md+ screens only) -->
                            <div class="col-md-6 my-2 d-none d-md-block order-md-2 mt-2">
                                <form method="GET" action="{{ route('web.course.index') }}">
                                    <div class="input-group rounded-pill overflow-hidden shadow-sm border" style="background: #fff;">
                                        <span class="input-group-text bg-white border-0 ps-3">
                                            <i class="fa fa-search text-muted"></i>
                                        </span>
                                        <input type="text" name="search" class="form-control border-0 py-2 shadow-none"
                                            placeholder="Search Skill Courses..." value="{{ request('search') }}" style="font-size: 0.95rem;">
                                        <button class="btn btn-primary px-4 fw-bold" type="submit" style="background-color: {{ $defaultSettings->primary_color ?? '#0d6efd' }}; border: none;">
                                            Search
                                        </button>
                                    </div>
                            </div>

                            {{-- Preserve filters if needed --}}
                            @if (request()->has('category_id'))
                                <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                            @endif
                            @if (request()->has('type'))
                                <input type="hidden" name="type" value="{{ request('type') }}">
                            @endif
                            </form>

                            <!-- Right Buttons -->
                            <div class="col-md-3 text-end gap-2 order-3 d-flex justify-content-end align-items-center d-none-mobile">
                                <!-- Register Button -->
                                <button class="btn btn-warning text-white btn-sm fw-bold px-3 py-2 rounded-pill shadow-sm"
                                    data-bs-toggle="modal" data-bs-target="#registerModal" style="background-color: #FF671F; border: none; font-size: 0.85rem;">
                                    <i class="fas fa-user me-1"></i> Register
                                </button>

                                <!-- Login Button -->
                                <a href="#"
                                    class="btn btn-outline-success btn-sm px-3 py-2 rounded-pill fw-bold shadow-sm"
                                    data-bs-toggle="modal" data-bs-target="#comingSoonModal" style="font-size: 0.85rem;">
                                    <i class="fas fa-sign-in-alt me-1"></i> Login
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Coming Soon Modal -->
                <div class="modal fade" id="comingSoonModal" tabindex="-1"
                    aria-labelledby="comingSoonModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="comingSoonModalLabel">Login Feature</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <div class="mb-4">
                                    <i class="fas fa-clock fa-4x text-warning"></i>
                                </div>
                                <h4 class="mb-3">Coming Soon!</h4>
                                <p class="text-muted">We're currently working on this feature and it
                                    will be available shortly.</p>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-primary px-4"
                                    data-bs-dismiss="modal">Got It</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div style="border-top: 1px solid #d8d8dc;" class="row align-items-center">
                        <div class="col-lg-8 col-md-6 col-10 mt-3">
                            <div class="d-flex align-items-center justify-content-center justify-content-md-end gap-3 order-3 d-block d-md-none">
                                <!-- Register Button -->
                                <button class="btn btn-warning text-white btn-sm fw-bold px-3 py-2 fs-sm-12"
                                    data-bs-toggle="modal" data-bs-target="#registerModal" style="background-color: #FF671F">
                                    <i class="fas fa-user me-2"></i> REGISTER
                                </button>

                                <!-- Login Button -->
                                <a href="#"
                                    class="btn btn-outline-success btn-sm px-3 py-2 fs-sm-12"
                                    data-bs-toggle="modal" data-bs-target="#comingSoonModal">
                                    <i class="fas fa-sign-in-alt me-2"></i> LOGIN
                                </a>
                            </div>
                            <nav class="navigation d-md-flex d-none">
                                <div class="menu-button-right">
                                    <div class="main-menu__nav">
                                        <ul class="main-menu__list">
                                            <li>
                                                <a href="/" class="{{ request()->is('/') ? 'active' : '' }}"> Home</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}"> About</a>
                                            </li>
                                            <li class="dropdown">
                                                <a href="javascript:void(0);">Initiatives</a>
                                                <ul class="sub-menu">

                                                    {{-- Projects --}}
                                                    <li>
                                                        <a href="{{ route('web.projects') }}">1. Projects</a>
                                                    </li>

                                                    {{-- Programs & Schemes --}}
                                                    <li>
                                                        <a href="{{ route('web.announcements') }}">2. Programs & Schemes</a>
                                                    </li>

                                                    {{-- CSR Initiatives --}}
                                                    <li>
                                                        <a
                                                            href="{{ route('web.blog.filter', ['category_id' => '', 'type' => 8]) }}">3.
                                                            CSR Initiatives</a>
                                                        {{-- <ul class="sub-menu">
                                                            @foreach ($csrPrograms as $program)
                                                                <li><a
                                                                        href="{{ route('web.blog.filter', ['category_id' => '', 'type' => 6]) }}">{{ $program->name }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul> --}}
                                                    </li>

                                                </ul>
                                            </li>
                                            <li>
                                                <a href="{{ route('web.sector') }}" class="{{ request()->routeIs('web.sector') ? 'active' : '' }}"> Sectors</a>
                                            </li>
                                           <li>
                                                <a href="{{ route('web.collaboration') }}" class="{{ request()->routeIs('web.collaboration') ? 'active' : '' }}"> collaboration</a>
                                            </li>
                                            {{-- <li class="dropdown">
                                                <a href="{{ route('web.collaboration') }}">Collaborations</a>
                                                <ul>
                                                    @foreach ($collaborations as $collaboration)
                                                        <li><a
                                                                href="{{ route('web.blog.filter', ['category_id' => '', 'type' => 3]) }}">{{ $collaboration->menu_title ?? $collaboration->title }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li> --}}
                                            <li class="dropdown">
                                                <a href="javascript:void(0);">Resources </a>
                                                <ul>
                                                    <li><a
                                                            href="{{ route('web.blog.filter', ['category_id' => '', 'type' => '']) }}">Blogs</a>
                                                    </li>
                                                    <li><a
                                                            href="{{ route('web.blog.filter', ['category_id' => '', 'type' => 4]) }}">Training
                                                            Models</a></li>
                                                    <li><a
                                                            href="{{ route('web.blog.filter', ['category_id' => '', 'type' => 5]) }}">Research
                                                            & Publications</a></li>
                                                    <li><a
                                                            href="{{ route('web.blog.filter', ['category_id' => '', 'type' => 6]) }}">Best
                                                            Practices & Case Studies</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="{{ route('web.global.country') }}" class="{{ request()->routeIs('global') ? 'active' : '' }}">Global Pathways</a></li>
                                            <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                        </div>
                        <div class="col-lg-4 col-md-6 col-2 p-0 mt-3">
                            <div class="header-buttons">
                                <div class="right-nav d-sm-flex gap-16 align-items-center d-none">
                                    <a href="{{ route('contact') }}" class="cus-btn">
                                        <span class="text"> Donate Now</span>
                                    </a>
                                    <a href="{{ route('web.activity') }}" class="cus-btn-2">
                                        <span class="text">NTI Competetions/Events</span>
                                    </a>
                                </div>
                                <a href="#" class="main-menu__toggler mobile-nav__toggler">
                                    <img src="{{ asset('resource/web/assets/media/icons/menu-2.png') }}"
                                        alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>
    <!-- Header Menu End -->
    <div class="stricky-header stricked-menu">
        <div class="sticky-header__content"></div>
    </div>


    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl"> <!-- changed to modal-xl -->
        <div class="modal-content p-4 border-0 rounded-4">
                <!-- Close Button -->
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal"
                    aria-label="Close"></button>

                <!-- Logo & Heading -->
                <div class="text-center">
                    <a href="/"> <img src="{{ asset($defaultSettings->site_logo ?? null) }}"
                            alt="{{ $defaultSettings->site_title ?? null }}" style="height: auto;"></a>
                    <h4 class="mt-3 fw-bold">Welcome to ISICO Registration</h4>
                    <p class="text-muted">Be part of ISICO’s mission to transform rural communities through education, skills, and entrepreneurship. Register as a learner, partner, or volunteer to learn, collaborate, and empower.</p>
                </div>

                <!-- Card Options with Radios -->
                <form id="userTypeForm">
                    <div class="row justify-content-center g-3 mt-4">
                        <!-- Card Option - Student / Learner -->
                        <div class="col-md-5 mt-3">
                            <label class="w-100 border rounded-3 p-3 d-flex align-items-start gap-3 h-100"
                                style="cursor: pointer;" data-bs-toggle="modal"
                                data-bs-target="#studentDetailsModal">

                                <input type="radio" name="userType" value="student"
                                    class="form-check-input mt-1" />
                                <img src="{{ asset('resource/web/assets/media/images/graduated.png') }}" alt="Student"
                                    style="width: 50px; margin-left: 10px;">

                                <div class="ms-2">
                                    <h6 class="fw-bold mb-1">Student / Learner Registration Form</h6>
                                    <p class="mb-0 small text-muted">
                                        Register to gain skills, education, and opportunities for a sustainable future.
                                    </p>
                                </div>
                            </label>
                        </div>
                        <!-- Trigger Card -->
                        <div class="col-md-5 mt-3">
                            <label class="w-100 border rounded-3 p-3 d-flex align-items-start gap-3 h-100"
                                style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#cooperationModal">
                                <input type="radio" name="userType" value="partner"
                                    class="form-check-input mt-1" />
                                <img src="{{ asset('resource/web/assets/media/images/friendship.png') }}" alt="Partner"
                                    style="width: 50px; margin-left: 10px;">
                                <div class="ms-2">
                                    <h6 class="fw-bold mb-1">Co-Operation Registration Form</h6>
                                    <p class="mb-0 small text-muted">Collaborate with ISICO as an institution, industry, CSR, or NGO to strengthen rural skill ecosystems.
                                    </p>
                                </div>
                            </label>
                        </div>
                        <!-- ITI Partners -->
                        <div class="col-md-5 mt-3">
                            <label class="w-100 border rounded-3 p-3 d-flex align-items-start gap-3 h-100" data-bs-toggle="modal" data-bs-target="#volunteerModal"
                                style="cursor: pointer;">
                                <input type="radio" name="userType" value="iti"
                                    class="form-check-input mt-1 " />
                                <img src="{{ asset('resource/web/assets/media/images/volunteer.png') }}" alt="ITI Partner"
                                    style="width: 50px; margin-left: 10px;">
                                <div class="ms-2">
                                    <h6 class="fw-bold mb-1">Volunteer Partners Registration</h6>
                                    <p class="mb-0 small text-muted">Join ISICO as a mentor, examiner, Event Organiser or content creator to empower learners and communities.
                                    </p>
                                </div>
                            </label>
                        </div>
                    </div>
                </form>

                <!-- Terms -->
                <div class="text-center mt-4">
                    <p class="small text-muted mb-0">
                        By choosing to continue, you agree to accept all applicable
                        <a href="#" class="text-decoration-none">Terms & Conditions</a> and
                        <a href="#" class="text-decoration-none">Privacy Policy</a>.
                    </p>
                </div>

            </div>
        </div>
    </div>

    {{-- Model For Student Registration --}}
    <div class="modal fade" id="studentDetailsModal" tabindex="-1" aria-labelledby="studentDetailsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content p-4 rounded-4 border-0">

                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold" id="studentDetailsModalLabel">Student Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    {{-- ✅ Success Message --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- ❌ Error Messages --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('sendStudentDetails') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Student Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="student_name" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Father Name <span class="text-danger">*</span> </label>
                                <input type="text" class="form-control" name="father_name" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Mother Name</label>
                                <input type="text" class="form-control" name="mother_name">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Gender <span class="text-danger">*</span></label>
                                <select class="form-select" name="gender" required>
                                    <option selected disabled>Choose...</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                    <option>Other</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" name="dob">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Mobile Number <span class="text-danger">*</span> </label>
                                <input type="tel" class="form-control" name="mobile" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Email Id</label>
                                <input type="email" class="form-control" name="email">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">State</label>
                                <input type="text" class="form-control" name="state">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">District</label>
                                <input type="text" class="form-control" name="district">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">City/Town/Village</label>
                                <input type="text" class="form-control" name="city">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Interested Skill Sector</label>
                                <input type="text" class="form-control" name="skill_sector">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Level</label>
                                <select class="form-select" name="level">
                                    <option selected disabled>Choose your level</option>
                                    <option value="foundation">Foundation</option>
                                    <option value="middle">Middle</option>
                                    <option value="advanced">Advanced</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Highest Qualification</label>
                                <input type="text" class="form-control" name="qualification">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Current Status</label>
                                <select class="form-select" name="status">
                                    <option selected disabled>Choose your status</option>
                                    <option value="studying">Studying</option>
                                    <option value="working">Working</option>
                                    <option value="unemployed">Unemployed</option>
                                    <option value="business">Business</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Preferred Learning Mode</label>
                                <select class="form-select" name="learning_mode">
                                    <option selected disabled>Choose learning mode</option>
                                    <option value="online">Online</option>
                                    <option value="offline">Offline</option>
                                    <option value="hybrid">Hybrid</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Work Experience</label>
                                <select class="form-select" name="work_experience">
                                    <option selected disabled>Do you have work experience?</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>

                        <!-- Back & Submit Buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal"
                                data-bs-toggle="modal" data-bs-target="#registerModal">
                                Back
                            </button>
                            <button type="submit" class="btn btn-primary px-4">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal For Co-operation Registration Form -->
    <div class="modal fade" id="cooperationModal" tabindex="-1" aria-labelledby="cooperationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div style="overflow: scroll;" class="modal-content p-4 rounded-4 border-0">

                <!-- Close Button -->
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal"
                    aria-label="Close"></button>

                <!-- Modal Header -->
                <div class="text-center mb-4">
                    <h4 class="fw-bold">Organization Partnership Registration</h4>
                    <p class="text-muted">Please fill the details below</p>
                </div>

                <!-- Form -->
                {{-- ✅ Success Message --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif

                {{-- ❌ Error Messages --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif
                <form class="row g-3" action="{{ route('sendOrganizationDetails') }}" method="POST">
                    @csrf

                    <!-- Organization Details -->
                    <div class="col-12">
                        <h5 class="fw-bold">Organization Details</h5>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Organization / Institution / Company Name <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter name" name="name" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Type <span class="text-danger">*</span></label>
                        <select class="form-select" name="organization_type" required>
                            <option selected disabled>Select type</option>
                            <option>Institution</option>
                            <option>Industry</option>
                            <option>International Collaboration</option>
                            <option>CSR</option>
                            <option>NGO</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Website URL</label>
                        <input type="url" class="form-control" name="webiste" placeholder="https://example.com">
                    </div>

                    <!-- Contact Person Details -->
                    <div class="col-12 mt-4">
                        <h5 class="fw-bold">Contact Person Details</h5>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Contact Person Name</label>
                        <input type="text" class="form-control" placeholder="Full name" name="contact_name"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Designation</label>
                        <input type="text" class="form-control" placeholder="e.g. Manager"
                            name="contact_designation" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Contact Number <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control" placeholder="e.g. 9876543210"
                            name="contact_number" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email ID <span class="text-danger">*</span> </label>
                        <input type="email" class="form-control" placeholder="example@email.com"
                            name="contact_email">
                    </div>

                    <!-- Address Details -->
                    <div class="col-12 mt-4">
                        <h5 class="fw-bold">Address Details</h5>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Office Address <span class="text-danger">*</span> </label>
                        <textarea class="form-control" rows="2" placeholder="Full address" name="address" required></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Country <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" placeholder="Country" name="country">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">State <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" placeholder="State" name="state">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">District <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" placeholder="District" name="district">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">City / Village</label>
                        <input type="text" class="form-control" placeholder="City or Village"
                            name="city_village">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Pincode</label>
                        <input type="text" class="form-control" placeholder="Pincode" name="pincode">
                    </div>

                    <!-- Partnership Interest -->
                    <div class="col-12 mt-4">
                        <h5 class="fw-bold">Partnership Interest</h5>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Area of Collaboration</label>
                        <select class="form-select" name="collaboration" required>
                            <option>Skill Training</option>
                            <option>Internship</option>
                            <option>Placement</option>
                            <option>Funding</option>
                            <option>Curriculum Development</option>
                            <option>International Exchange</option>
                            <option>Infrastructure Support</option>
                            <option>CSR Support</option>
                            <option>Project Support</option>
                            <option>Volunteers</option>
                            <option>Research</option>
                            <option>Others</option>
                        </select>
                        <small class="text-muted">Hold Ctrl (Windows) or Cmd (Mac) to select multiple options</small>
                    </div>

                    <!-- Target Beneficiary Group -->
                    <div class="col-md-6">
                        <label class="form-label">Target Beneficiary Group</label>
                        <select class="form-select" name="beneficiary" required>
                            <option>School</option>
                            <option>College</option>
                            <option>Women SHG</option>
                            <option>Rural Youth</option>
                            <option>Others</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <!-- Back & Submit Buttons -->
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-secondary px-4" data-bs-toggle="modal"
                            data-bs-target="#registerModal" data-bs-dismiss="modal">Back</button>
                        <button type="submit" class="btn btn-primary px-4">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- Modal For Volunteer Registration Form -->
    <div class="modal fade" id="volunteerModal" tabindex="-1" aria-labelledby="volunteerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div style="overflow: scroll;" class="modal-content p-4 rounded-4 border-0">

                <!-- Close Button -->
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>

                <!-- Modal Header -->
                <div class="text-center mb-4">
                    <h4 class="fw-bold">Volunteer Registration</h4>
                    <p class="text-muted">Please fill the details below</p>
                </div>

                {{-- ✅ Success Message --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- ❌ Error Messages --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

               <!-- Form -->
            <form class="row g-3" action="{{ route('sendvolunteer') }}" method="POST">
                @csrf

                <!-- Name -->
                <div class="col-md-6">
                    <label class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter your name"
                        name="name" value="{{ old('name') }}" required>
                </div>

                <!-- Mobile Number -->
                <div class="col-md-6">
                    <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                    <input type="tel" class="form-control" placeholder="e.g. 9876543210"
                        name="mobile" value="{{ old('mobile') }}" required>
                </div>

                <!-- Gender -->
                <div class="col-md-6">
                    <label class="form-label">Gender <span class="text-danger">*</span></label>
                    <select class="form-select" name="gender" required>
                        <option disabled {{ old('gender') ? '' : 'selected' }}>Select Gender</option>
                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <!-- Date of Birth -->
                <div class="col-md-6">
                    <label class="form-label">Date of Birth <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="dob"
                        value="{{ old('dob') }}" required>
                </div>

                <!-- Qualification -->
                <div class="col-md-6">
                    <label class="form-label">Qualification</label>
                    <input type="text" class="form-control" placeholder="e.g. Graduate, Diploma"
                        name="qualification" value="{{ old('qualification') }}">
                </div>

                <!-- Location -->
                <div class="col-md-6">
                    <label class="form-label">Location <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter your location"
                        name="location" value="{{ old('location') }}" required>
                </div>

                <!-- Volunteer Experience -->
                <div class="col-md-6">
                    <label class="form-label">Volunteer Experience <span class="text-danger">*</span></label>
                    <select class="form-select" name="experience" required>
                        <option value="Yes" {{ old('experience') == 'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No" {{ old('experience') == 'No' ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <!-- Skills / Expertise -->
                <div class="col-md-12">
                    <label class="form-label">Skills / Expertise (select one or more):</label>
                    <div class="row">
                        @php
                            $skills = ["Teaching / Mentoring", "Content Creation", "Examination / Evaluation",
                                    "Community Support", "Technical Support", "Organising / Event Management"];
                        @endphp
                        @foreach($skills as $skill)
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="skills[]"
                                        value="{{ $skill }}" {{ (is_array(old('skills')) && in_array($skill, old('skills'))) ? 'checked' : '' }}>
                                    <label class="form-check-label">{{ $skill }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Area of Interest -->
                <div class="col-md-12">
                    <label class="form-label">Area of Interest:</label>
                    <div class="row">
                        @php
                            $interests = ["Education Support", "Skill Training", "Entrepreneurship Development",
                                        "Rural Development", "Women & Youth Empowerment"];
                        @endphp
                        @foreach($interests as $interest)
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="interests[]"
                                        value="{{ $interest }}" {{ (is_array(old('interests')) && in_array($interest, old('interests'))) ? 'checked' : '' }}>
                                    <label class="form-check-label">{{ $interest }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Preferred Mode -->
                <div class="col-md-12">
                    <label class="form-label">Preferred Mode:</label>
                    <div class="d-flex gap-3">
                        @php
                            $modes = ["Online", "On-site", "Both"];
                        @endphp
                        @foreach($modes as $mode)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="preferred_mode"
                                    value="{{ $mode }}" {{ old('preferred_mode') == $mode ? 'checked' : '' }}>
                                <label class="form-check-label">{{ $mode }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary px-4">Submit</button>
                </div>
            </form>
            </div>
        </div>
    </div>


    <script>
        document.getElementById("userTypeForm").addEventListener("change", function(e) {
            if (e.target.name === "userType") {
                console.log("Selected user type:", e.target.value);
                // You can redirect or handle based on selected value
            }
        });
    </script>
