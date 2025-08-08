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
        @if($defaultSettings->announcement_text)
            <div class="header-top">
                <div class="container-fluid">
                    <p class="white"> {{ $defaultSettings->announcement_text ?? null}}</p>
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
                        Indian Skill Institute
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
                            <i class="bi bi-three-dots-vertical"></i> More
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
                            <form method="GET" action="{{ route('web.blog.filter') }}">
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
                            <div class="col-md-4">
                                {{-- class="col-md-4 d-flex align-items-center gap-3 order-2 order-md-1 justify-content-center justify-content-md-start"> --}}
                                <a href="/"> <img src="{{ asset($defaultSettings->site_logo ?? null) }}"
                                        alt="{{ $defaultSettings->site_title ?? null }}" style="height: 92px;"></a>
                                {{-- <img src="https://www.skillindiadigital.gov.in/assets/new-ux-img/skill-india-big-logo.svg"
                    alt="Skill India Logo" style="height: 44px;"> --}}
                            </div>
                            <!-- Search Bar (Visible on md+ screens only) -->
                            <div class="col-md-4 my-2 d-none d-md-block order-md-2 mt-2">
                                <form method="GET" action="{{ route('web.blog.filter') }}">
                                    <div class="input-group mt-2 rounded-1">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="fa fa-search"></i>
                                        </span>
                                        <input type="text" name="search" class="form-control border-start-0 p-2"
                                            placeholder="Search Skill Courses" value="{{ request('search') }}">
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
                            <div class="col-md-4 text-end gap-3 order-3 d-none d-md-block">
                                <a href="#" class="btn btn-outline-success btn-sm d-none-tblet d-lg-block-one">
                                    <i class="fa fa-tachometer-alt me-1 p-2"></i> Dashboards
                                </a>
                               <button class="btn btn-warning text-white btn-sm fw-bold p-2" data-bs-toggle="modal" data-bs-target="#registerModal">
                                <i class="fa fa-user"></i> REGISTER
                                </button>


                                {{-- <button class="btn btn-outline-warning btn-sm fw-bold p-2">LOGIN</button> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <!-- <div class="hero-topbar-block">
                     <div class="row align-items-center">
                       <div class="col-xl-5 col-lg-3 col-1">
                         <a href="#" class="header-logo d-lg-flex d-none">
                           <img src="assets/media/logo.png" alt="">
                         </a>
                       </div>
                       <div class="col-xl-7 col-lg-9 col-md-11">
                         <div class="d-flex align-items-center gap-24">
                           <div class="dropdown flex-shrink-0">
                             <a href="javascript:void(0);" class="fw-600 black"><svg xmlns="http://www.w3.org/2000/svg" width="33" height="32" viewBox="0 0 33 32" fill="none">
                               <g clip-path="url(#clip0_9539_215)">
                                 <path d="M31.25 5H1.75C1.05963 5 0.5 5.4477 0.5 6C0.5 6.5523 1.05963 7 1.75 7H31.25C31.9404 7 32.5 6.5523 32.5 6C32.5 5.4477 31.9404 5 31.25 5Z" fill="#141516"/>
                                 <path d="M31.25 15H1.75C1.05963 15 0.5 15.4477 0.5 16C0.5 16.5523 1.05963 17 1.75 17H31.25C31.9404 17 32.5 16.5523 32.5 16C32.5 15.4477 31.9404 15 31.25 15Z" fill="#141516"/>
                                 <path d="M31.25 25H1.75C1.05963 25 0.5 25.4477 0.5 26C0.5 26.5523 1.05963 27 1.75 27H31.25C31.9404 27 32.5 26.5523 32.5 26C32.5 25.4477 31.9404 25 31.25 25Z" fill="#141516"/>
                               </g>
                               <defs>
                                 <clipPath>
                                   <rect width="32" height="32" fill="white" transform="translate(0.5)"/>
                                 </clipPath>
                               </defs>
                             </svg>&nbsp;&nbsp;&nbsp;Categories&nbsp;<i
                                 class="fa-solid fa-chevron-down"></i></a>
                             <ul class="sub-menu unstyled">
                               <li><a href="#">Programming & IT</a></li>
                               <li><a href="#">Business & Marketing</a></li>
                               <li><a href="#">Design & Creativity</a></li>
                               <li><a href="#">Copy Writing</a></li>
                               <li><a href="#">Business Studies</a></li>
                             </ul>
                           </div>
                           <form class="searchbar">
                             <svg class="searchbar-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                               viewBox="0 0 20 20" fill="none">
                               <path
                                 d="M17.5 17.5L14.5834 14.5833M16.6667 9.58333C16.6667 13.4954 13.4954 16.6667 9.58333 16.6667C5.67132 16.6667 2.5 13.4954 2.5 9.58333C2.5 5.67132 5.67132 2.5 9.58333 2.5C13.4954 2.5 16.6667 5.67132 16.6667 9.58333Z"
                                 stroke="#92949F" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round" />
                             </svg>
                             <input type="text" name="search" id="searchbar" placeholder="Search for a course">
                           </form>
                         </div>
                       </div>
                     </div>
                     </div> -->
                    <div style="border-top: 1px solid #d8d8dc;" class="row align-items-center">
                        <div class="col-lg-8 col-8 mt-3">
                            <!-- <a href="#" class="header-logo d-lg-none d-block">
                           <img src="assets/media/logo.png" alt="">
                           </a> -->
                            <div
                                class="d-flex align-items-center justify-content-center justify-content-md-end gap-3 order-3 d-block d-md-none">
                                <button class="btn btn-warning text-white btn-sm fw-bold p-2" data-bs-toggle="modal" data-bs-target="#registerModal">
                                <i class="fa fa-user"></i> REGISTER
                                </button>

                                <button class="btn btn-outline-warning btn-sm fw-bold">LOGIN</button>
                            </div>
                            <nav class="navigation d-md-flex d-none">
                                <div class="menu-button-right">
                                    <div class="main-menu__nav">
                                        <ul class="main-menu__list">
                                            <li>
                                                <a href="/" class="active"> Home</a>
                                            </li>
                                            <li><a href="{{ route('about') }}"> About</a></li>
                                            <li class="dropdown">
                                                <a href="javascript:void(0);">Initiatives</a>
                                                <ul class="sub-menu">

                                                    {{-- Educational Programs --}}
                                                    <li>
                                                        {{-- {{ route('programe') }} --}}
                                                        <a href="{{ route('web.catalog') }}">1. Educational
                                                            Programs</a>
                                                        <ul class="sub-menu">
                                                            {{-- {{ route('programe.details', $program->slug) }}" --}}
                                                            @foreach ($educationPrograms as $program)
                                                                <li><a
                                                                        href="{{ route('web.catalog') }}">{{ $program->name }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>

                                                    {{-- Skill Development Programs --}}
                                                    <li>
                                                        <a href="{{ route('web.catalog') }}">2. Skill Development
                                                            Programs</a>
                                                        <ul class="sub-menu">
                                                            @foreach ($skillPrograms as $program)
                                                                <li><a
                                                                        href="{{ route('web.catalog') }}">{{ $program->name }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>

                                                    {{-- CSR Initiatives --}}
                                                    <li>
                                                        <a href="{{ route('web.blog.filter', ['category_id' => '', 'type' => 6]) }}">3. CSR Initiatives</a>
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
                                            <li class="dropdown">
                                                <a href="{{ route('web.sector') }}"> Sectors </a>
                                            </li>
                                            <li class="dropdown">
                                                <a href="javascript:void(0);">Collaborations</a>
                                                <ul>
                                                    @foreach ($collaborations as $collaboration)
                                                        <li><a
                                                                href="{{ route('web.blog.filter', ['category_id' => '', 'type' => 3]) }}">{{ $collaboration->menu_title }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            <li class="dropdown">
                                                <a href="javascript:void(0);">Resources </a>
                                                <ul>
                                                    <li><a
                                                            href="{{ route('web.blog.filter', ['category_id' => '', 'type' => 1]) }}">Blogs</a>
                                                    </li>
                                                    <li><a
                                                            href="{{ route('web.blog.filter', ['category_id' => '', 'type' => 7]) }}">Training
                                                            Models</a></li>
                                                    <li><a
                                                            href="{{ route('web.blog.filter', ['category_id' => '', 'type' => 5]) }}">Research
                                                            & Publications</a></li>
                                                    <li><a
                                                            href="{{ route('web.blog.filter', ['category_id' => '', 'type' => 6]) }}">Best
                                                            Practices & Case Studies</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">Global Pathways</a></li>
                                            <li><a href="{{ route('contact') }}">Contact</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                        </div>
                        <div class="col-lg-4 col-4 p-0 mt-3">
                            <div class="header-buttons">
                                <div class="right-nav d-sm-flex gap-16 align-items-center d-none">
                                    <a style="background-color: red;" href="#" class="cus-btn">
                                        <span class="text"> Donate Now</span>
                                    </a>
                                    <a href="#" class="cus-btn-2">
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
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content p-4 border-0 rounded-4">

      <!-- Close Button -->
      <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>

      <!-- Logo & Heading -->
      <div class="text-center">
        <img src="https://www.skillindiadigital.gov.in/assets/images/logo.svg" alt="Skill India Logo" style="height: 50px;">
        <h4 class="mt-3 fw-bold">Welcome to Skill India Digital Hub (SIDH)</h4>
        <p class="text-muted">A platform to meet all your skilling needs digitally anytime anywhere</p>
      </div>

      <!-- Card Options with Radios -->
      <form id="userTypeForm">
        <div class="row justify-content-center g-3 mt-4">

          <!-- Learner -->
            <!-- Card Option - Partner -->
            <div class="col-md-5 mt-3">
            <label class="w-100 border rounded-3 p-3 d-flex align-items-start gap-3 h-100"
                    style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#studentDetailsModal">
                <input type="radio" name="userType" value="partner" class="form-check-input mt-1" />
                <img src="https://cdn-icons-png.flaticon.com/512/2922/2922510.png" alt="Partner" style="width: 50px; margin-left: 10px;">
                <div class="ms-2">
                <h6 class="fw-bold mb-1">Student / Learner Registration Form</h6>
                <p class="mb-0 small text-muted">Learning partner, Employer, Content Provider etc.</p>
                </div>
            </label>
            </div>


          <!-- Partner -->
        <!-- Trigger Card -->
        <div class="col-md-5 mt-3">
            <label class="w-100 border rounded-3 p-3 d-flex align-items-start gap-3 h-100" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#cooperationModal">
                <input type="radio" name="userType" value="partner" class="form-check-input mt-1" />
                <img src="https://cdn-icons-png.flaticon.com/512/2922/2922510.png" alt="Partner" style="width: 50px; margin-left: 10px;">
                <div class="ms-2">
                <h6 class="fw-bold mb-1">Co-Operation Registration Form</h6>
                <p class="mb-0 small text-muted">Learning partner, Employer, Content Provider etc.</p>
                </div>
            </label>
        </div>

          <!-- ITI Partners -->
          <div class="col-md-5 mt-3">
            <label class="w-100 border rounded-3 p-3 d-flex align-items-start gap-3 h-100" style="cursor: pointer;">
              <input type="radio" name="userType" value="iti" class="form-check-input mt-1 " />
              <img src="https://cdn-icons-png.flaticon.com/512/1087/1087929.png" alt="ITI Partner" style="width: 50px; margin-left: 10px;">
              <div class="ms-2">
                <h6 class="fw-bold mb-1">ITI Partners</h6>
                <p class="mb-0 small text-muted">Exam Controller, ITI/NSTI Creator, NIMI Admin etc.</p>
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

    {{-- student details --}}
    <!-- Student Details Modal -->
    <div class="modal fade" id="studentDetailsModal" tabindex="-1" aria-labelledby="studentDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content p-4 rounded-4 border-0">
        <div class="modal-header border-0">
            <h5 class="modal-title fw-bold" id="studentDetailsModalLabel">Student Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form>
            <div class="row g-3">

                <div class="col-md-6">
                <label class="form-label">Student Name</label>
                <input type="text" class="form-control">
                </div>

                <div class="col-md-6">
                <label class="form-label">Father Name</label>
                <input type="text" class="form-control">
                </div>

                <div class="col-md-6">
                <label class="form-label">Mother Name</label>
                <input type="text" class="form-control">
                </div>

                <div class="col-md-6">
                <label class="form-label">Gender</label>
                <select class="form-select">
                    <option selected disabled>Choose...</option>
                    <option>Male</option>
                    <option>Female</option>
                    <option>Other</option>
                </select>
                </div>

                <div class="col-md-6">
                <label class="form-label">Date of Birth</label>
                <input type="date" class="form-control">
                </div>

                <div class="col-md-6">
                <label class="form-label">Mobile Number</label>
                <input type="tel" class="form-control">
                </div>

                <div class="col-md-6">
                <label class="form-label">Email Id</label>
                <input type="email" class="form-control">
                </div>

                <div class="col-md-6">
                <label class="form-label">State</label>
                <input type="text" class="form-control">
                </div>

                <div class="col-md-6">
                <label class="form-label">District</label>
                <input type="text" class="form-control">
                </div>

                <div class="col-md-6">
                <label class="form-label">City/Town/Village</label>
                <input type="text" class="form-control">
                </div>

                <div class="col-md-6">
                <label class="form-label">Interested Skill Sector</label>
                <input type="text" class="form-control">
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
                <input type="text" class="form-control">
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
                <select class="form-select" name="learningMode">
                    <option selected disabled>Choose learning mode</option>
                    <option value="online">Online</option>
                    <option value="offline">Offline</option>
                    <option value="hybrid">Hybrid</option>
                </select>
                </div>

                <div class="col-md-6">
                <label class="form-label">Work Experience</label>
                <select class="form-select" name="workExp">
                    <option selected disabled>Do you have work experience?</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
                </div>


            </div>

            <!-- Back & Submit Buttons -->
            <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-secondary px-4" data-bs-toggle="modal" data-bs-target="#registerModal"  data-bs-dismiss="modal">Back</button>
                <button type="submit" class="btn btn-primary px-4">Submit</button>
            </div>

            </form>
        </div>
        </div>
    </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="cooperationModal" tabindex="-1" aria-labelledby="cooperationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div style="overflow: scroll;" class="modal-content p-4 rounded-4 border-0">

        <!-- Close Button -->
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>

        <!-- Modal Header -->
        <div class="text-center mb-4">
            <h4 class="fw-bold">Organization Partnership Registration</h4>
            <p class="text-muted">Please fill the details below</p>
        </div>

        <!-- Form -->
        <form class="row g-3">

            <!-- Organization Details -->
            <div class="col-12">
            <h5 class="fw-bold">Organization Details</h5>
            </div>

            <div class="col-md-6">
            <label class="form-label">Organization / Institution / Company Name</label>
            <input type="text" class="form-control" placeholder="Enter name">
            </div>

            <div class="col-md-6">
            <label class="form-label">Type</label>
            <select class="form-select">
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
            <input type="url" class="form-control" placeholder="https://example.com">
            </div>

            <!-- Contact Person Details -->
            <div class="col-12 mt-4">
            <h5 class="fw-bold">Contact Person Details</h5>
            </div>

            <div class="col-md-6">
            <label class="form-label">Contact Person Name</label>
            <input type="text" class="form-control" placeholder="Full name">
            </div>

            <div class="col-md-6">
            <label class="form-label">Designation</label>
            <input type="text" class="form-control" placeholder="e.g. Manager">
            </div>

            <div class="col-md-6">
            <label class="form-label">Contact Number</label>
            <input type="tel" class="form-control" placeholder="e.g. 9876543210">
            </div>

            <div class="col-md-6">
            <label class="form-label">Email ID</label>
            <input type="email" class="form-control" placeholder="example@email.com">
            </div>

            <!-- Address Details -->
            <div class="col-12 mt-4">
            <h5 class="fw-bold">Address Details</h5>
            </div>

            <div class="col-12">
            <label class="form-label">Office Address</label>
            <textarea class="form-control" rows="2" placeholder="Full address"></textarea>
            </div>

            <div class="col-md-6">
            <label class="form-label">Country</label>
            <input type="text" class="form-control" placeholder="Country">
            </div>

            <div class="col-md-6">
            <label class="form-label">State</label>
            <input type="text" class="form-control" placeholder="State">
            </div>

            <div class="col-md-6">
            <label class="form-label">District</label>
            <input type="text" class="form-control" placeholder="District">
            </div>

            <div class="col-md-6">
            <label class="form-label">City / Village</label>
            <input type="text" class="form-control" placeholder="City or Village">
            </div>

            <div class="col-md-6">
            <label class="form-label">Pincode</label>
            <input type="text" class="form-control" placeholder="Pincode">
            </div>

            <!-- Partnership Interest -->
            <div class="col-12 mt-4">
            <h5 class="fw-bold">Partnership Interest</h5>
            </div>

            <div class="col-md-6">
            <label class="form-label">Area of Collaboration</label>
            <select class="form-select">
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
            <select class="form-select">
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
                <button type="button" class="btn btn-secondary px-4" data-bs-toggle="modal" data-bs-target="#registerModal" data-bs-dismiss="modal">Back</button>
                <button type="submit" class="btn btn-primary px-4">Submit</button>
            </div>

        </form>
        </div>
    </div>
    </div>

<script>
document.getElementById("userTypeForm").addEventListener("change", function (e) {
  if (e.target.name === "userType") {
    console.log("Selected user type:", e.target.value);
    // You can redirect or handle based on selected value
  }
});
</script>
<style>
    .form-check-input{
        width: 3em;
        height: 20px;
    }
</style>
