@extends('layouts.web.app')

@section('content')
    @push('meta')
        <title>About ISICO - Indian Skill Institute Co-operation</title>

        <meta name="description"
            content="Indian Skill Institute Co-operation (ISICO), founded in 2020, is a mission-driven social development platform connecting education, industry, and government initiatives to enable accessible skill development and sustainable livelihoods.">
        <meta name="keywords"
            content="Indian Skill Institute, ISICO, skill development, NGO, Skill India, NEP 2020, vocational training, sustainable livelihoods, entrepreneurship, global skill certification">
        <meta name="author" content="Indian Skill Institute Co-operation (ISICO)">
        <meta name="robots" content="index, follow">

        <!-- Canonical Tag -->
        <link rel="canonical" href="{{ url()->current() }}">

        <!-- Open Graph -->
        <meta property="og:title" content="About ISICO - Indian Skill Institute Co-operation">
        <meta property="og:description"
            content="Founded in 2020, ISICO builds a structured ecosystem connecting education, industry, and government initiatives to enable accessible, outcome-oriented skill development.">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:image" content="{{ asset('resource/web/assets/media/logo/isico-logo-main.png') }}">

        <!-- Twitter Card -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="About ISICO - Indian Skill Institute Co-operation">
        <meta name="twitter:description"
            content="ISICO is a mission-driven social development platform working as a Skill Ecosystem Enabler and Implementation Partner.">
    @endpush

    <style>
        :root {
            --isico-primary: #004274;
            --isico-secondary: #ff6b35;
            --isico-accent: #00a8cc;
            --isico-body: #6c757d;
            --isico-heading: #1a1a1a;
            --glass-bg: rgba(255, 255, 255, 0.9);
        }

        /* Banner Styles */
        .page-header-banner {
            position: relative;
            padding: 120px 0 80px;
            background: linear-gradient(135deg, #008c01 0%, #005019 100%);
            overflow: hidden;
            color: #fff;
        }

        .page-header-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url("https://www.transparenttextures.com/patterns/cubes.png");
            opacity: 0.1;
        }

        .banner-shape {
            position: absolute;
            bottom: -50px;
            right: -50px;
            width: 300px;
            height: 300px;
            background: var(--isico-secondary);
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.3;
            z-index: 0;
        }

        .breadcrumb-custom {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            padding: 8px 20px;
            border-radius: 50px;
            display: inline-flex;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        .breadcrumb-custom a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: 0.3s;
        }

        .breadcrumb-custom a:hover {
            color: #fff;
        }

        .banner-title {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 800;
            margin-bottom: 20px;
            line-height: 1.1;
        }

        .banner-subtitle {
            font-size: 1.25rem;
            max-width: 800px;
            color: rgba(255, 255, 255, 0.85);
            font-weight: 300;
        }

        /* Section Header */
        .section-tag {
            display: inline-block;
            padding: 5px 15px;
            background: rgba(0, 66, 116, 0.1);
            color: var(--isico-primary);
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 1px;
            font-size: 0.75rem;
            border-radius: 4px;
            margin-bottom: 15px;
        }

        .section-title {
            font-weight: 800;
            color: var(--isico-heading);
            margin-bottom: 20px;
            position: relative;
        }

        /* Cards and Items */
        .feature-card {
            background: #fff;
            padding: 30px;
            border-radius: 20px;
            border: 1px solid #f0f0f0;
            height: 100%;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            border-color: var(--isico-primary);
        }

        .feature-icon-wrapper {
            width: 70px;
            height: 70px;
            background: #f8f9fa;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: var(--isico-primary);
            margin-bottom: 25px;
            transition: 0.3s;
        }

        .feature-card:hover .feature-icon-wrapper {
            background: var(--isico-primary);
            color: #fff;
        }

        /* Ecosystem Grid */
        .eco-grid-item {
            border-radius: 12px;
            padding: 30px;
            background: #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            height: 100%;
            border-top: 4px solid var(--isico-primary);
            text-align: center;
        }

        .eco-grid-item h5 {
            color: var(--isico-primary);
            font-weight: 700;
        }

        /* Quote Section */
        .quote-box {
            background: var(--isico-primary);
            padding: 50px;
            border-radius: 30px;
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .quote-box blockquote {
            font-size: 1.5rem;
            font-style: italic;
            font-weight: 300;
            margin: 0;
            position: relative;
            z-index: 1;
        }

        /* Mission Vision Cards */
        .mv-card {
            padding: 30px;
            border-radius: 15px;
            color: #fff;
            height: 100%;
        }

        .vision-card { background: linear-gradient(45deg, #ff671f, #ff8459) }
        .mission-card { background: linear-gradient(45deg, #ff6b35, #ff9e7d); }

        /* Icon List */
        .check-list {
            list-style: none;
            padding: 0;
        }
        .check-list li {
            position: relative;
            padding-left: 35px;
            margin-bottom: 12px;
            color: var(--isico-body);
        }
        .check-list li::before {
            content: '\F633';
            font-family: 'bootstrap-icons';
            position: absolute;
            left: 0;
            top: 2px;
            color: var(--isico-secondary);
            font-weight: bold;
            font-size: 1.2rem;
        }

        /* Stats Section */
        .stats-item h2 {
            font-weight: 800;
            color: var(--isico-primary);
        }

        @media (max-width: 991px) {
            .page-header-banner { padding: 80px 0 60px; }
            .banner-title { font-size: 27px; }
            .quote-box { padding: 30px; }
            .quote-box blockquote { font-size: 1.25rem; }
        }
        @media (max-width: 576px) {
            .banner-title { font-size: 27px; }
        }
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important;
        }
    </style>

    <!-- Hero Section -->
    <section class="page-header-banner">
        <div class="banner-shape"></div>
        <div class="container text-center text-lg-start">
            <div class="row align-items-center mt-3">
                <div class="col-lg-10 mx-auto text-center">
                    <div class="breadcrumb-custom wow fadeInDown">
                        <a href="{{ url('/') }}">Home</a>
                        <span class="mx-2 text-white-50">/</span>
                        <span class="text-white">About Us</span>
                    </div>
                    <h1 class="banner-title wow fadeInUp text-white" data-wow-delay="0.1s">Indian Skill Institute <br>Co-operation (ISICO)<sup>&reg;</sup></h1>
                    <p class="banner-subtitle mx-auto wow fadeInUp text-white" data-wow-delay="0.2s">
                        Building a connected skill ecosystem that transforms learning into livelihood and capability into national growth.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Overview Section -->
    <section class="py-100 overflow-hidden">
        <div class="container">
            <div class="row align-items-center mt-3 mb-3">
                <div class="col-lg-6 mb-4 mb-lg-0 wow fadeInLeft">
                    <div class="position-relative">
                        <img src="{{ asset('resource/web/assets/media/images/isico_overview.png') }}"
                             alt="Skill Development" class="img-fluid rounded-4 shadow-lg">
                        <div class="position-absolute bottom-0 end-0 bg-white p-4 rounded-4 shadow-lg m-4 d-none d-md-block">
                            <h2 class="text-primary fw-800 mb-0">2020</h2>
                            <p class="text-muted small mb-0">Year Founded</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 ps-lg-5 wow fadeInRight">
                    <span class="section-tag">Who We Are</span>
                    <h2 class="section-title">Enabling a Nation-wide Skill Ecosystem</h2>
                    <p class="lead text-dark mb-4">
                        ISICO, founded in 2020 as a startup NGO, is a mission-driven social development platform working as a Skill Ecosystem Enabler and Implementation Partner.
                    </p>
                    <p class="text-muted mb-4 text-justify">
                        ISICO builds a structured ecosystem connecting education, industry, government initiatives, and global opportunities to enable accessible, outcome oriented skill development and sustainable livelihoods.
                    </p>
                    <p class="text-muted mb-4 text-justify">
                        We operate as a registered non-profit organization dedicated to strengthening national skill development, community empowerment, and inclusive economic growth. Rather than functioning as a standalone training institution, ISICO integrates multiple stakeholders into a unified platform that connects learners, training providers, industries, and institutions.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Vision & Mission -->
    <section class="bg-light py-100">
        <div class="container text-center">
            <div class="row justify-content-center mb-60">
                <div class="col-lg-8">
                    <span class="section-tag mt-4">Purpose & Direction</span>
                    <h2 class="section-title">Our Vision & Mission</h2>
                </div>
            </div>
            <div class="row g-1">
                <div class="col-md-6 wow fadeInUp mt-2" data-wow-delay="0.1s">
                    <div class="mv-card vision-card text-start">
                        <div class="fs-1 mb-3"><i style="display: flex !important; justify-content: flex-start;" class="bi bi-eye"></i></div>
                        <h3>Our Vision</h3>
                        <p class="mb-0 text-white mt-3">
                            To create a skill-powered society by building an integrated ecosystem where education, skills, entrepreneurship, and global collaboration enable sustainable livelihoods and inclusive national development.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 wow fadeInUp mt-2" data-wow-delay="0.2s">
                    <div class="mv-card mission-card text-start">
                        <div class="fs-1 mb-3"><i style="display: flex !important; justify-content: flex-start;" class="bi bi-bullseye d-flex"></i></div>
                        <h3>Our Mission</h3>
                        <ul class="list-unstyled mb-0 mt-3">
                            <li class="mb-2 d-flex"><i class="bi bi-check2-circle fs-4 me-2"></i> Develop a nationwide sector-wise skill ecosystem platform</li>
                            <li class="mb-2 d-flex"><i class="bi bi-check2-circle fs-4 me-2"></i> Connect training partners and communities through accessible learning hubs</li>
                            <li class="mb-2 d-flex"><i class="bi bi-check2-circle fs-4 me-2"></i> Support State and Central Government skill initiatives</li>
                            <li class="mb-2 d-flex"><i class="bi bi-check2-circle fs-4 me-2"></i> Promote volunteering and community participation</li>
                            <li class="mb-0 d-flex"><i class="bi bi-check2-circle fs-4 me-2"></i> Enable international skill certification and higher education pathways</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why ISICO -->
    <section class="py-100 mt-5 mb-4">
        <div class="container">
            <div class="row align-items-center mb-3">
                <div class="col-lg-5 wow fadeInDown">
                    <span class="section-tag">The Need</span>
                    <h2 class="section-title">Why ISICO Was Created</h2>
                    <p class="text-muted mb-4">
                        Across India, particularly in rural and Tier-2 and Tier-3 regions, education and skill opportunities often exist without coordinated access. While government schemes and industry demand are available, communities frequently struggle to connect with these pathways.
                    </p>
                    <div class="p-4 rounded-4 bg-opacity-10 border border-primary border-opacity-10">
                        <h5 class="fw-bold color-primary">Bridging the Gap</h5>
                        <p class="small mb-0 text-dark">We create a connected ecosystem where opportunities reach underserved communities and translate into real outcomes.</p>
                    </div>
                </div>
                <div class="col-lg-7 mt-4 mt-lg-0 wow fadeInUp">
                    <div class="row g-4 ps-lg-5">
                        <div class="col-sm-6 mt-3">
                            <div class="feature-card">
                                <span class="badge bg-primary-soft text-primary mb-2 fs-6">Outcome</span>
                                <h5 class="fw-800">Underserved Outreach</h5>
                                <p class="small text-muted mb-0">Skill opportunities reaching those who need them most in rural heartlands.</p>
                            </div>
                        </div>
                        <div class="col-sm-6 mt-3">
                            <div class="feature-card">
                                <span class="badge bg-secondary-soft text-secondary mb-2 fs-6">Impact</span>
                                <h5 class="fw-800">Govt Translations</h5>
                                <p class="small text-muted mb-0">Converting government initiatives into tangible vocational outcomes.</p>
                            </div>
                        </div>
                        <div class="col-sm-6 mt-3">
                            <div class="feature-card">
                                <span class="badge bg-info-soft text-info mb-2 fs-6">Scale</span>
                                <h5 class="fw-800">Structured Training</h5>
                                <p class="small text-muted mb-0">Enabling training partners with structured outreach and platform visibility.</p>
                            </div>
                        </div>
                        <div class="col-sm-6 mt-3 mb-3">
                            <div class="feature-card">
                                <span class="badge bg-warning-soft text-warning mb-2 fs-6">Future</span>
                                <h5 class="fw-800">Global Accessibility</h5>
                                <p class="small text-muted mb-0">Bringing international learning beyond the reach of metropolitan cities.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Ecosystem Model -->
    <section class="py-100 bg-light">
        <div class="container">
            <div class="row mb-60 text-center mt-2">
                <div class="col-lg-8 mx-auto">
                    <span class="section-tag mt-4">Operational Framework</span>
                    <h2 class="section-title">The ISICO Skill Ecosystem Model</h2>
                    <p class="text-muted mb-2">A multi-layer framework connecting stakeholders into one unified ecosystem.</p>
                </div>
            </div>
            <div class="row g-4 mt-3">
                <div class="col-md-4 col-sm-6 mt-3 wow fadeInUp mb-3" data-wow-delay="0.1s">
                    <div class="eco-grid-item">
                        <div class="fs-2 mb-3 text-secondary"><i class="bi bi-diagram-3 mlt"></i></div>
                        <h5>Skill Sector Platform</h5>
                        <p class="small text-muted mb-0">Sector-wise organization across manufacturing, agriculture, digital technology, and more.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mt-3 wow fadeInUp mb-3" data-wow-delay="0.2s">
                    <div class="eco-grid-item">
                        <div class="fs-2 mb-3 text-secondary"><i class="bi bi-people mlt"></i></div>
                        <h5>Training Partner Integration</h5>
                        <p class="small text-muted mb-0">Collaboration with certified training institutes delivering programs through our platform.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mt-3 wow fadeInUp mb-3" data-wow-delay="0.3s">
                    <div class="eco-grid-item">
                        <div class="fs-2 mb-3 text-secondary"><i class="bi bi-building mlt"></i></div>
                        <h5>Learning Infrastructure</h5>
                        <p class="small text-muted mb-0">Activation of schools, panchayat halls, and centers as accessible learning hubs.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mt-3 wow fadeInUp mb-4" data-wow-delay="0.4s">
                    <div class="eco-grid-item">
                        <div class="fs-2 mb-3 text-secondary"><i class="bi bi-journal-check mlt"></i></div>
                        <h5>Scheme Alignment</h5>
                        <p class="small text-muted mb-0">Implementation aligned with NEP 2020, Skill India, and State/Central schemes.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mt-3 wow fadeInUp mb-4" data-wow-delay="0.5s">
                    <div class="eco-grid-item">
                        <div class="fs-2 mb-3 text-secondary"><i class="bi bi-hand-thumbs-up mlt"></i></div>
                        <h5>Volunteering Participation</h5>
                        <p class="small text-muted mb-0">Structured opportunities for professionals and community members to contribute.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mt-3 wow fadeInUp mb-4" data-wow-delay="0.6s">
                    <div class="eco-grid-item">
                        <div class="fs-2 mb-3 text-secondary"><i class="bi bi-globe mlt"></i></div>
                        <h5>Global Pathways</h5>
                        <p class="small text-muted mb-0">Collaborations enabling global certifications and vocational programs abroad.</p>
                    </div>
                </div>
            </div>
        </div>
        <style>
            i.bi.bi.mlt {
                text-align: center;
                display: flex;
                justify-content: center;
                font-size: xxx-large;
            }
        </style>
    </section>

    <!-- Global Course Platform -->
    <section class="py-100 overflow-hidden mt-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0 wow fadeInLeft">
                    <span class="section-tag">Skill Network</span>
                    <h2 class="section-title">Global Course Platform</h2>
                    <p class="text-muted mb-4">
                        ISICO operates a sector-wise skill network model that organizes training opportunities by industry sectors and connects approved training partners through a unified platform.
                    </p>
                    <div class="row g-4 mb-3">
                        <div class="col-sm-6 text-center mt-3">
                            <h5 class="fw-bold"><i class="bi bi-shop me-2 text-primary mb-3"></i> Partner Showcase</h5>
                            <p class="small text-muted">Institutions gain wider rural outreach and structured visibility for their programs.</p>
                        </div>
                        <div class="col-sm-6 text-center mt-3">
                            <h5 class="fw-bold"><i class="bi bi-airplane me-2 text-primary mb-3"></i> Global Access</h5>
                            <p class="small text-muted">Explore international programs including vocational pathways and certifications.</p>
                        </div>
                    </div>
                    <!-- <a href="{{ url('/catalog') }}" class="btn btn-primary rounded-pill px-4 mt-4 py-2">Explore Courses</a> -->
                </div>
                <div class="col-lg-6 wow fadeInRight text-lg-end">
                    <img src="{{ asset('resource/web/assets/media/images/isico_teamwork.png') }}"
                         alt="Teamwork" class="img-fluid rounded-4 shadow-lg w-75">
                </div>
            </div>
        </div>
    </section>

    <!-- Project Initiatives & Roles -->
    <section class="py-100 bg-dark text-white mt-2">
        <div class="container">
            <div class="row g-5 mt-3">
                <div class="col-lg-4 wow fadeInUp">
                    <h2 class="fw-800 mb-4 mt-3 text-white">Our Role in the Value Chain</h2>
                    <ul class="check-list text-white">
                        <li class="text-white-50"><strong class="text-white">Facilitator</strong> — Enables access to learning opportunities</li>
                        <li class="text-white-50"><strong class="text-white">Integrator</strong> — Connects stakeholders into one ecosystem</li>
                        <li class="text-white-50"><strong class="text-white">Implementation Partner</strong> — Supports on-ground execution</li>
                        <li class="text-white-50"><strong class="text-white">Global Connector</strong> — Links learners with international pathways</li>
                    </ul>
                </div>
                <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="quote-box mb-4 mt-3">
                        <div class="fs-1 text-white-50 opacity-25 mb-3"><i class="bi bi-quote"></i></div>
                        <blockquote>
                            ISICO initiatives bring together CSR partners, philanthropists, public contributors, and volunteers to jointly build a sustainable skill ecosystem for future generations through collaborative participation and social investment.
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Alignment Section -->
    <section class="py-100 mt-5">
        <div class="container">
            <div class="row text-center mb-60">
                <div class="col-lg-8 mx-auto">
                    <span class="section-tag">Impact Focus</span>
                    <h2 class="section-title">Alignment with National & Global Goals</h2>
                </div>
            </div>
            <div class="row g-4 align-items-center">
                <div class="col-md-6 wow fadeInLeft">
                    <div class="bg-light p-5 rounded-4 h-100 mb-4">
                        <h4 class="fw-bold mb-4">National Initiatives</h4>
                        <ul class="check-list">
                            <li>National Education Policy (NEP) 2020</li>
                            <li>Skill India Mission</li>
                            <li>Digital India & Make in India</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 wow fadeInRight">
                    <div class="bg-primary bg-opacity-10 p-5 rounded-4 h-100">
                        <h4 class="fw-bold mb-4 text-white">Global SDG Contribution</h4>
                        <div class="row g-2">
                            @php
                                $aboutSdgs = [4, 5, 8, 17];
                            @endphp
                            @foreach($aboutSdgs as $sdgId)
                                @php
                                    $sdg = App\Helpers\SDGHelper::getSDGById($sdgId);
                                @endphp
                                <div class="col-6 col-md-3">
                                    <a href="https://sdgs.un.org/goals" target="_blank" class="d-block hover-lift">
                                        <img src="{{ $sdg['image_url'] ?? '' }}" 
                                             alt="SDG {{ $sdgId }}" 
                                             class="img-fluid rounded shadow-sm">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-100 bg-primary position-relative overflow-hidden mt-2 mb-2">
        <div class="banner-shape" style="bottom: auto; top: -100px; left: -100px;"></div>
        <div class="mt-3 mb-3 container position-relative z-1 text-center text-white">
            <h2 class="fw-800 display-5 mb-3 text-white">Partner With ISICO</h2>
            <p class="lead mb-5 opacity-75 text-white">Together, we connect learning to livelihood and skills to sustainable progress.</p>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="{{ url('/contact') }}" class="btn btn-light rounded-pill px-5 py-3 fw-bold">Contact Us</a>
                <a href="{{ url('/collaboration') }}" class="btn btn-outline-light rounded-pill px-5 py-3 fw-bold">Collaborate</a>
            </div>
        </div>
    </section>
@endsection
