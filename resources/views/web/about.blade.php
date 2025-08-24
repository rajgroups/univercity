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
    <!-- Title Banner Section Start -->
    <section class="title-banner mb-80">
        <div class="container-fluid">
            <h1>About Us</h1>
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
                                    <img src="https://d2twr397zv17p4.cloudfront.net/image/discovery-img/about/about3.jpg"
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
