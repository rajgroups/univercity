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
        <h3 class="fs-1 fw-500 mb-8 text-center pt-5 pb-5"> Empowering India for Socio-Economic Growth through <span class="color-primary fw-bold">Education & Skill Development</span> </h3>
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
                    </div>
                    <p class="mb-36"> The Indian Skill Institute Co-operation (ISICO), founded in 2020, is committed to advancing India’s socio-economic development through education, skill enhancement, and entrepreneurship. Focused on bridging gaps in rural and underprivileged areas, ISICO empowers individuals to secure sustainable livelihoods and contribute to national growth. </p>
                    <p class="mb-36"> Aligned with the National Education Policy (NEP) 2020, ISICO works to enhance the quality of education while preparing future generations for evolving challenges. The organization adheres to core values of inclusivity, innovation, and collaboration, and actively contributes to Sustainable Development Goals (SDGs), particularly SDG 4 (Quality Education), SDG 5 (Gender Equality), and SDG 8 (Decent Work and Economic Growth). </p>
                    <p class="mb-36"> ISICO supports national initiatives like Skill India and Make in India, collaborating with various sectors to build a skilled, inclusive workforce for India’s future. </p>
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
                    <div> <a href="about.html" class="cus-btn"> <span class="text">Learn More About ISICO</span> </a> </div>
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
            <h2 class="fw-bold">Learn anytime, anywhere with <span class="text-primary">Trusted Experts</span></h2>
        </div>
        <div class="row g-4">
            <!-- Step 1 -->
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm h-100 p-4 text-center">
                    <div class="mb-3"> <img src="{{ asset('resource/web/assets/media/images/tem-1-icon.png')}}" alt="" style="height: 50px;"> </div>
                    <h5 class="fw-semibold mb-3">1. Our Vision</h5>
                    <p>To facilitate equitable access to quality education and skill development programs, fostering a self-reliant India where every individual is equipped to thrive in a competitive global economy. </p>
                </div>
            </div> <!-- Step 2 -->
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm h-100 p-4 text-center">
                    <div class="mb-3"> <img src="{{ asset('resource/web/assets/media/images/eyeicon.png')}}" alt="" style="height: 50px;"> </div>
                    <h5 class="fw-semibold mb-3">2. Our Mission</h5>
                    <p>To become a leading institution in skill and education empowerment, bridging opportunities between rural and urban India, and nurturing talent to meet the aspirations of a dynamic and sustainable future. </p>
                </div>
            </div> <!-- Step 3 -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100 p-4 text-center">
                    <div class="mb-3"> <img src="{{ asset('resource/web/assets/media/images/tem-3-icon.png')}}" alt="" style="height: 50px;"> </div>
                    <h5 class="fw-semibold mb-3">3. Begin Your Journey</h5>
                    <p>Gain real-world skills, certification, and mentorship. Whether it’s employment, entrepreneurship, or further study—your journey begins here. </p>
                </div>
            </div>
        </div>
    </div>
</section> <!-- How We Operate Section End -->
<div class="blog-sec mt-80 mb-5">
    <div class="container-fluid">
        <div class="heading mb-10 text-start">
            <div class="tagblock mb-16"> <img src="{{ asset('resource/web/assets/media/hero/buld-vec.png')}}" class="bulb-vec" alt="">
                <p class="black">Ongoing Projects</p>
            </div>
            <div class="cds-119 css-1v1mgi3 cds-121 mt-2">Specializations and Professional Certificates</div>
            <h3 class="fw-bold mt-2 mb-2">Learn more with our curated <span class="color-primary"> Community Wisdom</span></h3>
            <p class="cds-119 css-lg65q1 cds-121">Explore our most popular programs, get job-ready for an in-demand career.</p>
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
                                <a href="{{ route('project.details', $project->slug) }}" class="card-img">
                                    <img src="{{ asset($project->image) }}" alt="{{ $project->title }}">
                                    <span class="date-block">
                                        <span class="h6 fw-400 light-black">{{ \Carbon\Carbon::parse($project->created_at)->format('d') }}</span>
                                        <span class="h6 fw-400 light-black">{{ \Carbon\Carbon::parse($project->created_at)->format('M') }}</span>
                                    </span>
                                </a>
                                <div class="card-content">
                                    <div class="d-flex align-items-center gap-8 mb-20">
                                        <img src="{{ asset('upload/project/'.$project->image) }}" class="card-user" alt="">
                                        <p>By Admin</p>
                                    </div>
                                    <a href="{{ route('project.details', $project->slug) }}" class="h6 fw-500 mb-8">{{ $project->title }}</a>
                                    <p class="light-gray mb-24">{{ \Illuminate\Support\Str::limit(strip_tags($project->description), 100) }}</p>
                                    <a href="{{ route('project.details', $project->slug) }}" class="card-btn"> Read More</a>
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
            <div class="text-white">Specializations and Professional Certificates</div>
            <h3 class="fw-bold text-white mt-2 mb-2">Learn more with our curated Community Wisdom</h3>
            <p class="text-white">Explore our most popular programs, get job-ready for an in-demand career.</p>
        </div> <!-- Swiper -->
        <div class="row align-items-center">
            <div class="col-md-12 col-lg-4">
                <div class="wow zoomIn animated mt-5 mb-5" data-wow-delay="590ms">
                    <div class="heading text-start justify-content-start mb-8">
                        <div class="tagblock mb-16 mt-1 mb-4"> <img src="{{ asset('resource/web/assets/media/hero/buld-vec.png')}}" class="bulb-vec" alt="">
                            <p class="black">Upcoming Projects</p>
                        </div>
                        <h3 class="fw-bold text-white">Join thousands who’ve<br> transformed their <span class="text-white">Careers with ISICO</span> </h3>
                    </div>
                    <p class="text-white">At ISICO, we empower individuals through skill-based training, real-world experience, and professional mentorship to build bright futures across India. </p>
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
                                        <a href="{{ route('project.details', $project->slug) }}" class="card-img">
                                            <img src="{{ asset($project->image) }}" alt="{{ $project->title }}">
                                            <span class="date-block">
                                                <span class="h6 fw-400 light-black">{{ \Carbon\Carbon::parse($project->created_at)->format('d') }}</span>
                                                <span class="h6 fw-400 light-black">{{ \Carbon\Carbon::parse($project->created_at)->format('M') }}</span>
                                            </span>
                                        </a>
                                        <div class="card-content bg-white">
                                            <div class="d-flex align-items-center gap-8 mb-20">
                                                <img src="{{ asset('upload/project/'.$project->image) }}" class="card-user" alt="">
                                                <p>By Admin</p>
                                            </div>
                                            <a href="{{ route('project.details', $project->slug) }}" class="h6 fw-500 mb-8">{{ $project->title }}</a>
                                            <p class="light-gray mb-24">{{ \Illuminate\Support\Str::limit(strip_tags($project->description), 100) }}</p>
                                            <a href="{{ route('project.details', $project->slug) }}" class="card-btn"> Read More</a>
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
</div> <!-- Our Programmes -->
<section class="out-team-sec mt-80 mb-120 wow fadeInUp animated animated" data-wow-delay="540ms" style="visibility: visible; animation-delay: 540ms; animation-name: fadeInUp;">
    <div class="container-fluid">
        <div class="heading mb-48">
            <div class="tagblock mb-16"> <img src="{{ asset('resource/web/assets/media/hero/buld-vec.png')}}" class="bulb-vec" alt="">
                <p class="black">Our Program</p>
            </div>
            <div class="text-start mt-2">Courses and Professional Certificates</div>
            <h3 class="fw-500 text-start mt-2 mb-2">Guided by passionate instructors, <span class="color-primary"> Leaders in their Fields</span> </h3>
            <p class="text-start">Explore free online courses from the world's top universities and companies.</p>
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
                                            src="{{ $program->image ? asset('uploads/announcements/' . $program->image) : asset('resource/web/assets/media/default/default-img.png') }}"
                                            alt="{{ $program->title }}">
                                    </div>
                                    <div class="team-content">
                                        <div>
                                            <a href="#" class="h6 fw-500 mb-4p">{{ $program->title }}</a>
                                            <p class="subtitle">{{ \Illuminate\Support\Str::limit(strip_tags($program->description), 80) }}</p>
                                        </div>
                                        <div class="d-flex gap-8 align-items-center">
                                            <a href="#"><img class="links-icon" src="{{ asset('resource/web/assets/media/vector/message.png') }}" alt=""></a>
                                            <a href="#"><img class="links-icon" src="{{ asset('resource/web/assets/media/vector/linkedin.png') }}" alt=""></a>
                                            <a href="#"><img class="links-icon" src="{{ asset('resource/web/assets/media/vector/facebook.png') }}" alt=""></a>
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
</section> <!-- end of our Programmes -->
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
            <div class="text-start mt-2">Courses and Professional Certificates</div>
            <h3 class="fw-500 text-start mt-2 mb-2">Guided by passionate instructors, <span class="color-primary"> Leaders in their Fields</span> </h3>
            <p class="text-start">Explore free online courses from the world's top universities and companies.</p>
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
                                                <a href="{{ route('scheme.details', $scheme->slug) }}" class="h6 fw-500 mb-4p">{{ $scheme->title }}</a>
                                                <p class="subtitle">{{ $scheme->subtitle }}</p>
                                            </div>
                                            <div class="d-flex gap-8 align-items-center">
                                                @if ($scheme->email)
                                                    <a href="mailto:{{ $scheme->email }}">
                                                        <img class="links-icon" src="{{ asset('resource/web/assets/media/vector/message.png') }}" alt="Email">
                                                    </a>
                                                @endif
                                                @if ($scheme->linkedin)
                                                    <a href="{{ $scheme->linkedin }}" target="_blank">
                                                        <img class="links-icon" src="{{ asset('resource/web/assets/media/vector/linkedin.png') }}" alt="LinkedIn">
                                                    </a>
                                                @endif
                                                @if ($scheme->facebook)
                                                    <a href="{{ $scheme->facebook }}" target="_blank">
                                                        <img class="links-icon" src="{{ asset('resource/web/assets/media/vector/facebook.png') }}" alt="Facebook">
                                                    </a>
                                                @endif
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
            <h2 class="fw-bold mb-3">Key Areas of <span class="text-primary">Focus</span></h2>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <div class="accordion" id="focusAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne"> <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> 1. Foundational Skills Development </button> </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#focusAccordion">
                            <div class="accordion-body"> Tailored programs for children and young learners to enhance cognitive skills and foster holistic development. </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo"> <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"> 2. Skill Development for Emerging Needs </button> </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#focusAccordion">
                            <div class="accordion-body"> Sector-specific training in future-ready domains, including green technology and digital industries. </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree"> <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"> 3. Rural Empowerment </button> </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#focusAccordion">
                            <div class="accordion-body"> Comprehensive programs for small-scale industries, agricultural productivity, and FPO awareness. </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour"> <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"> 4. Entrepreneurship Development </button> </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#focusAccordion">
                            <div class="accordion-body"> Empowering women and youth through targeted initiatives for self-employment and small business growth. </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFive"> <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive"> 5. Hybrid Education Models </button> </h2>
                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#focusAccordion">
                            <div class="accordion-body"> Bridging the digital divide with a blend of traditional and technology-driven learning approaches. </div>
                        </div>
                    </div>
                </div>
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
                    <div class="alert alert-primary"> "The cornerstone of any nation’s progress is its people. At ISICO, we believe in the transformative power of education and skill development to create an equitable society. Together, through collaboration and collective action, we can lay the foundation for a self-reliant India where opportunities know no boundaries."<br> <strong class="text-end" style="text-indent: 40px;    display: block;">R. Surendhren, <cite title="Source Title">Founder, ISICO</cite></strong> </div>
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
                <div class="accordion" id="futureGoalsAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="goalHeadingOne"> <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#goalCollapseOne" aria-expanded="true" aria-controls="goalCollapseOne"> 1. Expanding Green Job Access </button> </h2>
                        <div id="goalCollapseOne" class="accordion-collapse collapse show" aria-labelledby="goalHeadingOne" data-bs-parent="#futureGoalsAccordion">
                            <div class="accordion-body text-start"> Expanding access to green jobs for Indian youth to support sustainable development. </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="goalHeadingTwo"> <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#goalCollapseTwo" aria-expanded="false" aria-controls="goalCollapseTwo"> 2. Talent Identification Mission </button> </h2>
                        <div id="goalCollapseTwo" class="accordion-collapse collapse" aria-labelledby="goalHeadingTwo" data-bs-parent="#futureGoalsAccordion">
                            <div class="accordion-body text-start"> Building a robust Natural Talent Identification Mission to unlock the potential of children across India. </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="goalHeadingThree"> <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#goalCollapseThree" aria-expanded="false" aria-controls="goalCollapseThree"> 3. Rural Entrepreneurship & SHGs </button> </h2>
                        <div id="goalCollapseThree" class="accordion-collapse collapse" aria-labelledby="goalHeadingThree" data-bs-parent="#futureGoalsAccordion">
                            <div class="accordion-body"> Promoting women’s self-help groups (SHGs) and rural entrepreneurship as engines of local economic growth. </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- Categories Section Start -->
<!-- <section class="categories-sec mb-120 wow fadeInUp animated mt-5" data-wow-delay="290ms">
            <div class="container-fluid">
              <div class="heading mb-48">
                <div class="tagblock mb-16">
                  <img src="{{ asset('resource/web/assets/media/hero/buld-vec.png')}}" class="bulb-vec/)}}" alt="">
                  <p class="black">Our Course Categories</p>
                </div>
                <h3 class="fw-500">Chose from <span class="color-primary"> many industries</span> what to Learn</h3>
              </div>
              <div class="categories-wrapper">
                <a href="courses.html" class="c-block">
                  <img src="{{ asset('resource/web/assets/media/vector/c-1.png')}}" alt="">
                  <span class="h6 fw-500 text-hover">School Programs</span>
                </a>
                <a href="courses.html" class="c-block">
                  <img src="{{ asset('resource/web/assets/media/vector/c-2.png')}}" alt="">
                  <span class="h6 fw-500 text-hover">Collage Programs</span>
                </a>
                <a href="courses.html" class="c-block">
                  <img src="{{ asset('resource/web/assets/media/vector/c-3.png')}}" alt="">
                  <span class="h6 fw-500 text-hover">Digital Learning Programs</span>
                </a>
                <a href="courses.html" class="c-block">
                  <img src="{{ asset('resource/web/assets/media/vector/c-4.png')}}" alt="">
                  <span class="h6 fw-500 text-hover">Sector Specific Training Program</span>
                </a>
                <a href="courses.html" class="c-block">
                  <img src="{{ asset('resource/web/assets/media/vector/c-4.png')}}" alt="">
                  <span class="h6 fw-500 text-hover">On-the-Job Training (OJT)</span>
                </a>
                <a href="courses.html" class="c-block">
                  <img src="{{ asset('resource/web/assets/media/vector/c-5.png')}}" alt="">
                  <span class="h6 fw-500 text-hover">Entrepreneurship Development Program</span>
                </a>
                <a href="courses.html" class="c-block">
                  <img src="{{ asset('resource/web/assets/media/vector/c-6.png')}}" alt="">
                  <span class="h6 fw-500 text-hover">Women's Skill Development Program</span>
                </a>
                <a href="courses.html" class="c-block">
                  <img src="{{ asset('resource/web/assets/media/vector/c-7.png')}}" alt="">
                  <span class="h6 fw-500 text-hover">Skill Development for Persons with Disabilities (PWDs)</span>
                </a>
                <a href="courses.html" class="c-block">
                  <img src="{{ asset('resource/web/assets/media/vector/c-8.png')}}" alt="">
                  <span class="h6 fw-500 text-hover">Youth Empowerment Program</span>
                </a>
                <a href="courses.html" class="c-block">
                  <img src="{{ asset('resource/web/assets/media/vector/c-9.png')}}" alt="">
                  <span class="h6 fw-500 text-hover">Community and Rural Development Initiatives</span>
                </a>
                <a href="courses.html" class="c-block">
                  <img src="{{ asset('resource/web/assets/media/vector/c-10.png')}}" alt="">
                  <span class="h6 fw-500 text-hover">Transforming Rural Schools</span>
                </a>
                <a href="courses.html" class="c-block">
                  <img src="{{ asset('resource/web/assets/media/vector/c-11.png')}}" alt="">
                  <span class="h6 fw-500 text-hover">Women’s Self-Help Group Skill Development</span>
                </a>
                <a href="courses.html" class="c-block">
                  <img src="{{ asset('resource/web/assets/media/vector/c-12.png')}}" alt="">
                  <span class="h6 fw-500 text-hover">Farmer Producer Organizations (FPO) Awareness and Development</span>
                </a>
              </div>
            </div>
            </section> -->
<!-- Categories Section End -->
<!-- How We Operate Section Start -->
<!-- <section class="trusted-expert-sec py-5 bg-light wow fadeInUp animated" data-wow-delay="340ms">
            <div class="container">
              <div class="text-center mb-5">
                <div class="d-inline-flex align-items-center mb-3">
                  <img src="{{ asset('resource/web/assets/media/hero/buld-vec.png')}}" class="me-2" alt="" style="width: 30px;">
                  <p class="mb-0 fw-semibold text-dark">How We Operate</p>
                </div>
                <h2 class="fw-bold">Learn anytime, anywhere with <span class="text-primary">Trusted Experts</span></h2>
              </div>

              <div class="row g-4">

                <div class="col-lg-4 col-md-6">
                  <div class="card border-0 shadow-sm h-100 p-4 text-center">
                    <div class="mb-3">
                      <img src="{{ asset('resource/web/assets/media/images/tem-1-icon.png')}}" alt="" style="height: 50px;">
                    </div>
                    <h5 class="fw-semibold mb-3">1. Choose Your Program</h5>
                    <p>Explore a variety of skill and educational programs tailored to youth, women, rural communities, and
                      more—based on your needs and goals.</p>
                  </div>
                </div>


                <div class="col-lg-4 col-md-6">
                  <div class="card border-0 shadow-sm h-100 p-4 text-center">
                    <div class="mb-3">
                      <img src="{{ asset('resource/web/assets/media/images/tem-2-icon.png')}}" alt="" style="height: 50px;">
                    </div>
                    <h5 class="fw-semibold mb-3">2. Enroll and Learn</h5>
                    <p>Register for online or offline sessions with ease. Our hybrid model blends expert instruction with
                      practical exposure for maximum learning.</p>
                  </div>
                </div>


                <div class="col-lg-4">
                  <div class="card border-0 shadow-sm h-100 p-4 text-center">
                    <div class="mb-3">
                      <img src="{{ asset('resource/web/assets/media/images/tem-3-icon.png')}}" alt="" style="height: 50px;">
                    </div>
                    <h5 class="fw-semibold mb-3">3. Begin Your Journey</h5>
                    <p>Gain real-world skills, certification, and mentorship. Whether it’s employment, entrepreneurship, or
                      further study—your journey begins here.</p>
                  </div>
                </div>
              </div>
            </div>
            </section> -->
<!-- How We Operate Section End -->
<!-- Content Block Section Start -->
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
                    <h3 class="fw-500">Expert Answers for Your<br class="d-lg-block d-none"> <span class="color-primary d-inline">Learning Journey at ISICO</span> </h3>
                </div>
                <div id="learningjourney">
                    <div class="faq">
                        <div class="faq-block mb-24"> <a href="#" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#bc-faq1-left" aria-expanded="false" aria-controls="bc-faq1-left"> <span class="fw-500">01.</span> &nbsp; What types of courses does ISICO offer? </a>
                            <div id="bc-faq1-left" class="accordion-collapse collapse show" aria-labelledby="bc-faq1-left" data-bs-parent="#learningjourney">
                                <p>ISICO offers a wide range of skill-based courses including Electrical Technician, Tailoring, Fashion Design, IT Support, Beautician Training, and more. All programs are designed to meet industry standards and improve employability. </p>
                            </div>
                        </div>
                        <div class="faq-block mb-24"> <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#bc-faq2-left" aria-expanded="false" aria-controls="bc-faq2-left"> <span class="fw-500">02.</span> &nbsp; How do I enroll in a course at ISICO? </a>
                            <div id="bc-faq2-left" class="accordion-collapse collapse" aria-labelledby="bc-faq2-left" data-bs-parent="#learningjourney">
                                <p>You can enroll by visiting your nearest ISICO center or through our official website. Our counselors will guide you through the admission process, required documents, and available training batches. </p>
                            </div>
                        </div>
                        <div class="faq-block mb-24"> <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#bc-faq3-left" aria-expanded="false" aria-controls="bc-faq3-left"> <span class="fw-500">03.</span> &nbsp; Are there any prerequisites to join the programs? </a>
                            <div id="bc-faq3-left" class="accordion-collapse collapse" aria-labelledby="bc-faq3-left" data-bs-parent="#learningjourney">
                                <p>Most of our courses are beginner-friendly and do not require prior experience. However, for advanced programs, a minimum educational qualification or basic knowledge may be needed. </p>
                            </div>
                        </div>
                        <div class="faq-block mb-24"> <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#bc-faq5-left" aria-expanded="false" aria-controls="bc-faq5-left"> <span class="fw-500">04.</span> &nbsp; Can I access courses from my mobile phone? </a>
                            <div id="bc-faq5-left" class="accordion-collapse collapse" aria-labelledby="bc-faq5-left" data-bs-parent="#learningjourney">
                                <p>Yes, our learning platform is mobile-friendly. You can access learning materials, assignments, and even live sessions from any smartphone or tablet. </p>
                            </div>
                        </div>
                        <div class="faq-block"> <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#bc-faq6-left" aria-expanded="false" aria-controls="bc-faq6-left"> <span class="fw-500">05.</span> &nbsp; Are the courses self-paced or instructor-led? </a>
                            <div id="bc-faq6-left" class="accordion-collapse collapse" aria-labelledby="bc-faq6-left" data-bs-parent="#learningjourney">
                                <p>We offer both self-paced and instructor-led formats depending on the course. Live training sessions with expert mentors are also available for select programs. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> <!-- Online Learning Section End -->
<!-- Testimonial Section Start -->
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
                <div class="slider-arrows"> <a href="javascript:;" class="arrow-btn btn-prev" data-slide="testimonial-slider"></a>
                    <div class="testimonial-slider row">
                        <div class="testimonial-block col-12">
                            <h6 class="fw-500 mb-16">From Zero Skills to Certified Technician!</h6>
                            <p class="mb-24">"Joining ISICO was the turning point in my life. I enrolled in their Electrical Technician program without any background knowledge, but the hands-on training and industry exposure helped me land a job within two months of completing the course. Thank you ISICO for believing in me!" </p>
                            <div class="d-flex align-items-center gap-12"> <img src="{{ asset('resource/web/assets/media/user/card-user-1.png')}}" class="block-user" alt="">
                                <div>
                                    <h6 class="fw-500 mb-4p">Rahul Kumar</h6>
                                    <p class="subtitle dark-gray">Certified Technician</p>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-block col-12">
                            <h6 class="fw-500 mb-16">ISICO Helped Me Build a Career in Fashion Design</h6>
                            <p class="mb-24">"I always had a passion for design, but ISICO gave me the practical skills, portfolio, and industry insights I needed. Their faculty support and internship assistance helped me start my own small boutique. Highly recommend ISICO to anyone dreaming big!" </p>
                            <div class="d-flex align-items-center gap-12"> <img src="{{ asset('resource/web/assets/media/user/card-user-2.png')}}" class="block-user" alt="">
                                <div>
                                    <h6 class="fw-500 mb-4p">Meera Sinha</h6>
                                    <p class="subtitle dark-gray">Fashion Design Graduate</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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
<div class="text-center mt-5">
    <div class="d-inline-flex align-items-center mb-3"> <img src="{{ asset('resource/web/assets/media/hero/buld-vec.png')}}" class="me-2" alt="" style="width: 30px;">
        <p class="mb-0 fw-semibold text-dark">Our Partners</p>
    </div>
    <h2 class="fw-bold mb-3">Our Brand <span class="text-primary">Partners</span></h2>
</div>
<div class="Marquees">
    <div class="Marquee FirstRow">
        <div class="marquee Item"><i class="bi bi-amazon"></i></div>
        <div class="marquee Item"><i class="bi bi-microsoft"></i></div>
        <div class="marquee Item"><i class="bi bi-apple"></i></div>
        <div class="marquee Item"><i class="bi bi-google"></i></div>
        <div class="marquee Item"><i class="bi bi-facebook"></i></div>
        <div class="marquee Item"><i class="bi bi-twitter-x"></i></div>
        <div class="marquee Item"><i class="bi bi-youtube"></i></div>
        <div class="marquee Item"><i class="bi bi-linkedin"></i></div>
    </div>
    <div class="Marquee SecondRow">
        <div class="marquee Item"><i class="bi bi-instagram"></i></div>
        <div class="marquee Item"><i class="bi bi-discord"></i></div>
        <div class="marquee Item"><i class="bi bi-github"></i></div>
        <div class="marquee Item"><i class="bi bi-slack"></i></div>
        <div class="marquee Item"><i class="bi bi-dribbble"></i></div>
        <div class="marquee Item"><i class="bi bi-behance"></i></div>
        <div class="marquee Item"><i class="bi bi-skype"></i></div>
        <div class="marquee Item"><i class="bi bi-telegram"></i></div>
    </div>
</div> <!-- Main Sections -->
</div>

    <!-- content @e -->
    @endsection
