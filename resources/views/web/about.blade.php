@extends('layouts.web.app')
@section('content')
  @push('meta')
      <title>About - Indian Skill Institute Co-operation (ISICO)</title>

      <meta name="description" content="The Indian Skill Institute Co-operation (ISICO), founded in 2020, is committed to advancing India’s socio-economic development through education, skill enhancement, and entrepreneurship. Focused on bridging gaps in rural and underprivileged areas, ISICO empowers individuals to secure sustainable livelihoods and contribute to national growth.">
      <meta name="keywords" content="Indian Skill Institute, ISICO, skill development, education, entrepreneurship, socio-economic development, NEP 2020, sustainable livelihoods, SDG 4, SDG 5, SDG 8, Skill India, Make in India">
      <meta name="author" content="Indian Skill Institute Co-operation (ISICO)">
      <meta name="robots" content="index, follow">

      <!-- Canonical Tag -->
      <link rel="canonical" href="{{ url()->current() }}">

      <!-- Open Graph -->
      <meta property="og:title" content="About - Indian Skill Institute Co-operation (ISICO)">
      <meta property="og:description" content="The Indian Skill Institute Co-operation (ISICO), founded in 2020, is committed to advancing India’s socio-economic development through education, skill enhancement, and entrepreneurship. Focused on bridging gaps in rural and underprivileged areas, ISICO empowers individuals to secure sustainable livelihoods and contribute to national growth.">
      <meta property="og:type" content="website">
      <meta property="og:url" content="{{ url()->current() }}">
      <meta property="og:image" content="{{ asset('default.jpg') }}">

      <!-- Twitter Card -->
      <meta name="twitter:card" content="summary_large_image">
      <meta name="twitter:title" content="About - Indian Skill Institute Co-operation (ISICO)">
      <meta name="twitter:description" content="The Indian Skill Institute Co-operation (ISICO), founded in 2020, is committed to advancing India’s socio-economic development through education, skill enhancement, and entrepreneurship. Focused on bridging gaps in rural and underprivileged areas, ISICO empowers individuals to secure sustainable livelihoods and contribute to national growth.">
      <meta name="twitter:image" content="{{ asset('default.jpg') }}">
  @endpush
    <style>
        .modern-page-banner {
            position: relative;
            min-height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            overflow: hidden;
            margin-bottom: 80px;
        }

        .modern-page-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(0,0,0,0.85) 0%, rgba(255, 107, 107, 0.2) 100%);
            z-index: 1;
        }

        .modern-banner-content {
            position: relative;
            z-index: 2;
            text-align: center;
            width: 100%;
            padding: 0 15px;
        }

        .modern-banner-title {
            font-size: 3.5rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 1rem;
            text-shadow: 0 4px 10px rgba(0,0,0,0.3);
            letter-spacing: -1px;
        }
        
        .modern-banner-subtitle {
             font-size: 1.25rem;
             color: rgba(255,255,255,0.9);
             font-weight: 300;
             max-width: 700px;
             margin: 0 auto;
             line-height: 1.6;
        }

        .modern-breadcrumb {
            display: inline-flex;
            padding: 8px 16px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            border-radius: 50px;
            margin-bottom: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .modern-breadcrumb span {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .modern-page-banner {
                min-height: 250px;
            }
            .modern-banner-title {
                font-size: 2.5rem;
            }
        }
    </style>

    <!-- Title Banner Section Start -->
    <section class="modern-page-banner" style="background-image: url('{{ asset('resource/web/assets/media/banner/about-bg.jpg') }}'), url('https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=2084&auto=format&fit=crop');">
        <div class="modern-banner-content" data-aos="fade-up">
            <div class="modern-breadcrumb">
                <span>Home</span>
                <span class="mx-2">/</span>
                <span class="text-white">About Us</span>
            </div>
            <h1 class="modern-banner-title">About ISICO</h1>
            <p class="modern-banner-subtitle">Advancing India’s socio-economic development through education, skill enhancement, and entrepreneurship.</p>
        </div>
    </section>
    <!-- Title Banner Section End -->

    <!-- About Section Start -->
    <section class="about-sec mb-120">
        <div class="container-fluid">
            <div class="row row-gap-4 align-items-center">

                <div class="col-lg-12 order-1">
                    <div class="ps-24">
                        <div class="heading text-start">
                            <div class="tagblock mb-16">
                                <img src="{{ asset('resource/web/assets/media/hero/buld-vec.png') }}" class="bulb-vec"
                                    alt="Lightbulb icon representing ideas and insight">
                                <p class="black">About ISICO</p>
                            </div>
                        </div>
                        <p class="mb-36">
                            {{ $defaultSettings->about_description ?? null }}
                        </p>
                        {{-- <p class="mb-36">
                                Aligned with the National Education Policy (NEP) 2020, ISICO works to enhance the quality of education
                                while preparing future generations for evolving challenges. The organization adheres to core values of
                                inclusivity, innovation, and collaboration, and actively contributes to Sustainable Development Goals
                                (SDGs), particularly SDG 4 (Quality Education), SDG 5 (Gender Equality), and SDG 8 (Decent Work and
                                Economic Growth).
                              </p>
                              <p class="mb-36">
                                ISICO supports national initiatives like Skill India and Make in India, collaborating with various
                                sectors to build a skilled, inclusive workforce for India’s future.
                              </p> --}}
                        <div class="d-flex align-items-center gap-24 mb-36">
                            <div class="d-flex align-items-center gap-16">
                                <img src="{{ asset('resource/web/assets/media/vector/unique-course-vec.') }}png"
                                    class="content-vector" alt="Icon representing programs">
                                <div>
                                    <h4 class="fw-600 color-primary mb-2">Impactful</h4>
                                    <p>Skill Programs</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-16">
                                <img src="{{ asset('resource/web/assets/media/vector/student-vector.png') }}"
                                    class="content-vector" alt="Icon representing beneficiaries">
                                <div>
                                    <h4 class="fw-600 color-primary mb-2">Nation-wide</h4>
                                    <p>Reach & Empowerment</p>
                                </div>
                            </div>
                        </div>
                        <!-- <div>
                                    <a href="#" class="cus-btn">
                                      <span class="text">Learn More About ISICO</span>
                                    </a>
                                  </div> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="w-100 mb-24">
                            <img src="https://d2twr397zv17p4.cloudfront.net/image/discovery-img/about/about1.jpg"
                                class="" alt="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="w-100 mb-24">
                                    <img src="https://d2twr397zv17p4.cloudfront.net/image/discovery-img/about/about2.jpg"
                                        class="" alt="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="w-100">
                                    <img src="https://static.vecteezy.com/system/resources/thumbnails/023/060/798/small_2x/farming-tractor-spraying-plants-in-a-field-photo.jpg"
                                        class="" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- About Section End -->
@endsection
