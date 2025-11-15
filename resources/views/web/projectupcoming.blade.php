{{-- @dd($announcement) --}}
@extends('layouts.web.app')
@push('meta')
    <title>{{ $metaTitle ?? ($announcement->title ?? 'Default Page Title') }}</title>

    <meta name="description"
        content="{{ $metaDescription ?? Str::limit(strip_tags($announcement->description ?? ''), 150) }}">
    <meta name="keywords" content="{{ $metaKeywords ?? 'announcement, news, education' }}">
    <meta name="author" content="{{ $metaAuthor ?? 'YourSiteName' }}">
    <meta name="robots" content="{{ $metaRobots ?? 'index, follow' }}">

    <!-- Canonical Tag -->
    <link rel="canonical" href="{{ $metaCanonical ?? url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:title" content="{{ $metaOgTitle ?? ($announcement->title ?? 'Default OG Title') }}">
    <meta property="og:description"
        content="{{ $metaOgDescription ?? Str::limit(strip_tags($announcement->description ?? ''), 150) }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $metaOgUrl ?? url()->current() }}">
    <meta property="og:image" content="{{ $metaOgImage ?? asset($announcement->image ?? 'default.jpg') }}">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $metaTwitterTitle ?? ($announcement->title ?? 'Default Twitter Title') }}">
    <meta name="twitter:description"
        content="{{ $metaTwitterDescription ?? Str::limit(strip_tags($announcement->description ?? ''), 150) }}">
    <meta name="twitter:image" content="{{ $metaTwitterImage ?? asset($announcement->image ?? 'default.jpg') }}">
@endpush

@section('content')
    <style>
        :root {
            --primary-color: #1a4f8c;
            --secondary-color: #2e7d32;
            --accent-color: #ff6f00;
            --light-bg: #f8f9fa;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .hero-banner {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://via.placeholder.com/1920x800') center/cover no-repeat;
            color: white;
            padding: 4rem 0;
        }

        .text-shadow {
            text-shadow: 2px 2px 4px rgba(0,0,0,0.8);
        }

        .badge-pill {
            border-radius: 50rem;
            padding: 0.5rem 1rem;
        }

        .info-pill {
            background-color: rgba(0,0,0,0.5);
            padding: 0.5rem 1rem;
            border-radius: 50rem;
            font-size: 0.875rem;
        }

        .quick-details-card {
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border: none;
        }

        .card {
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 1.5rem;
            border-radius: 12px;
        }

        .card-body {
            padding: 1.5rem;
        }

        .section-title {
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--light-bg);
        }

        .nav-pills .nav-link {
            color: #6c757d;
            border-radius: 6px;
            margin-right: 0.5rem;
            white-space: nowrap;
            font-size: 0.875rem;
            padding: 0.5rem 1rem;
        }

        .nav-pills .nav-link.active {
            background-color: var(--primary-color);
            color: white;
        }

        .accordion-button {
            border-radius: 8px;
            padding: 1rem 1.25rem;
            font-weight: 500;
        }

        .accordion-button:not(.collapsed) {
            background-color: #e7f1ff;
            color: var(--primary-color);
            box-shadow: none;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: #f8f9fa;
            border-radius: 8px;
            margin-bottom: 0.75rem;
            transition: all 0.3s ease;
        }

        .detail-item:hover {
            background: #e9ecef;
            transform: translateY(-2px);
        }

        .detail-item i {
            font-size: 1.25rem;
            width: 24px;
            text-align: center;
        }

        .hover-card {
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            border-color: rgba(0, 0, 0, 0.125);
        }

        .related-project-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            border-radius: 8px;
            transition: all 0.3s ease;
            margin-bottom: 0.75rem;
        }

        .related-project-item:hover {
            background: #f8f9fa;
        }

        .related-project-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 6px;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.75rem 1.5rem;
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: #0d3b6c;
            border-color: #0d3b6c;
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.75rem 1.5rem;
            font-weight: 600;
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .project-stage-badge {
            font-size: 0.875rem;
            padding: 0.5rem 1rem;
            border-radius: 50rem;
        }

        .stage-upcoming {
            background-color: #ffc107;
            color: #000;
        }

        .stage-ongoing {
            background-color: #0d6efd;
            color: #fff;
        }

        .stage-completed {
            background-color: #198754;
            color: #fff;
        }

        .progress-container {
            background-color: #e9ecef;
            border-radius: 10px;
            height: 10px;
            margin-bottom: 1rem;
        }

        .progress-bar {
            border-radius: 10px;
            height: 100%;
        }

        .sdg-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.5rem;
            font-size: 1.5rem;
            color: white;
        }

        /* Responsive adjustments */
        @media (max-width: 991.98px) {
            .hero-banner {
                padding: 3rem 0;
            }

            .display-5 {
                font-size: 2rem;
            }
        }

        @media (max-width: 767.98px) {
            .hero-banner {
                padding: 2rem 0;
            }

            .display-5 {
                font-size: 1.75rem;
            }

            .info-pills-container {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .info-pill {
                width: 100%;
                text-align: center;
            }

            .nav-pills {
                flex-wrap: nowrap;
                overflow-x: auto;
                padding-bottom: 0.5rem;
            }

            .nav-pills .nav-link {
                font-size: 0.8rem;
                padding: 0.4rem 0.8rem;
            }
        }

        @media (max-width: 575.98px) {
            .hero-banner {
                padding: 1.5rem 0;
            }

            .display-5 {
                font-size: 1.5rem;
            }

            .card-body {
                padding: 1rem;
            }

            .btn-primary, .btn-outline-primary {
                width: 100%;
                margin-bottom: 0.5rem;
            }
        }

        /* Custom colors for icons */
        .text-purple {
            color: #6f42c1 !important;
        }

        .text-teal {
            color: #20c997 !important;
        }

        .text-indigo {
            color: #6610f2 !important;
        }
    </style>
</head>
<body>
    <!-- Hero Banner -->
    <section class="hero-banner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-8 mb-4 mb-lg-0">
                    <div class="text-white">
                        <span class="badge bg-warning text-dark mb-3 project-stage-badge stage-ongoing">Ongoing Project</span>
                        <h1 class="fw-bold mb-3 display-5 text-shadow">Smart Digital Board Transformation for Rural Schools</h1>
                        <p class="lead mb-4 text-shadow">Digitally empowering rural classrooms for 21st century learning with interactive tools and modern teaching methodologies.</p>

                        <div class="d-flex flex-wrap align-items-center gap-3 info-pills-container">
                            <div class="info-pill d-flex align-items-center gap-2">
                                <i class="bi bi-geo-alt-fill text-warning"></i>
                                <span class="fw-medium">Multiple Locations</span>
                            </div>
                            <div class="info-pill d-flex align-items-center gap-2">
                                <i class="bi bi-clock-fill text-warning"></i>
                                <span class="fw-medium">6 Months Duration</span>
                            </div>
                            <div class="info-pill d-flex align-items-center gap-2">
                                <i class="bi bi-people-fill text-warning"></i>
                                <span class="fw-medium">500+ Beneficiaries</span>
                            </div>
                            <div class="info-pill d-flex align-items-center gap-2">
                                <i class="bi bi-building-fill text-warning"></i>
                                <span class="fw-medium">ISICO Partners</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="quick-details-card bg-white rounded-3 p-4">
                        <h5 class="fw-bold mb-3">Project Quick Facts</h5>

                        <div class="d-flex justify-content-between align-items-center mb-2 py-1">
                            <span class="text-muted small">Project Code:</span>
                            <span class="fw-bold text-primary small">ISC-DB-2024</span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-2 py-1">
                            <span class="text-muted small">Project Type:</span>
                            <span class="fw-bold small">Rural Education Transformation</span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-2 py-1">
                            <span class="text-muted small">Funding Type:</span>
                            <span class="fw-bold small">CSR Partnership</span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-2 py-1">
                            <span class="text-muted small">Project Stage:</span>
                            <span class="badge bg-primary small">Ongoing</span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3 py-1">
                            <span class="text-muted small">Project Cost:</span>
                            <span class="fw-bold text-success small">₹15,00,000</span>
                        </div>

                        <div class="progress-container">
                            <div class="progress-bar bg-success" style="width: 65%"></div>
                        </div>
                        <div class="d-flex justify-content-between small mb-3">
                            <span>Funding Progress</span>
                            <span>65% (₹9,75,000 raised)</span>
                        </div>

                        <button class="btn btn-primary w-100 mb-2">Support This Project</button>
                        <button class="btn btn-outline-primary w-100">Download Project Report</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container mt-5">
        <div class="row g-4 g-lg-5">
            <!-- Left Content -->
            <div class="col-12 col-lg-8">
                <!-- Project Overview -->
                <div class="card">
                    <div class="card-body">
                        <h3 class="section-title">Project Overview</h3>
                        <div class="row">
                            <div class="col-12 col-sm-6 mb-3">
                                <label class="fw-semibold text-muted small">Implementing Organization:</label>
                                <p class="mb-0">ISICO Education Foundation</p>
                            </div>
                            <div class="col-12 col-sm-6 mb-3">
                                <label class="fw-semibold text-muted small">Project Lead:</label>
                                <p class="mb-0">Dr. Priya Sharma</p>
                            </div>
                            <div class="col-12 col-sm-6 mb-3">
                                <label class="fw-semibold text-muted small">Actual Start Date:</label>
                                <p class="mb-0">March 15, 2024</p>
                            </div>
                            <div class="col-12 col-sm-6 mb-3">
                                <label class="fw-semibold text-muted small">Expected Completion:</label>
                                <p class="mb-0">September 15, 2024</p>
                            </div>
                        </div>

                        <div class="mt-4">
                            <p>This comprehensive project focuses on transforming traditional classrooms in rural schools into modern digital learning environments. We are installing smart digital boards, training teachers, and creating interactive content to enhance the learning experience for students.</p>
                            <p>The project combines infrastructure development with capacity building, ensuring that educators can confidently integrate digital tools into their daily teaching practices. Through this transformation, rural schools can provide 21st-century learning experiences to students who would otherwise lack access to such technologies.</p>
                            <p>By the end of this project, we aim to have equipped 50 rural schools with digital infrastructure and trained over 200 teachers in digital pedagogy.</p>
                        </div>

                        <div class="mt-4">
                            <h5 class="fw-semibold mb-3">Key Project Points</h5>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="d-flex align-items-start mb-2">
                                        <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                                        <span>Installation of 100 smart digital boards</span>
                                    </div>
                                    <div class="d-flex align-items-start mb-2">
                                        <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                                        <span>Training for 200+ teachers</span>
                                    </div>
                                    <div class="d-flex align-items-start mb-2">
                                        <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                                        <span>Development of localized digital content</span>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="d-flex align-items-start mb-2">
                                        <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                                        <span>Ongoing technical support for 1 year</span>
                                    </div>
                                    <div class="d-flex align-items-start mb-2">
                                        <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                                        <span>Community engagement programs</span>
                                    </div>
                                    <div class="d-flex align-items-start mb-2">
                                        <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                                        <span>Impact assessment and reporting</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Project Details Tabs -->
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-pills flex-nowrap overflow-auto pb-2 mb-4" id="projectTabs" role="tablist">
                            <li class="nav-item flex-shrink-0" role="presentation">
                                <button class="nav-link active small" id="progress-tab" data-bs-toggle="pill"
                                    data-bs-target="#progress" type="button">Progress</button>
                            </li>
                            <li class="nav-item flex-shrink-0" role="presentation">
                                <button class="nav-link small" id="beneficiaries-tab" data-bs-toggle="pill"
                                    data-bs-target="#beneficiaries" type="button">Beneficiaries</button>
                            </li>
                            <li class="nav-item flex-shrink-0" role="presentation">
                                <button class="nav-link small" id="funding-tab" data-bs-toggle="pill"
                                    data-bs-target="#funding" type="button">Funding</button>
                            </li>
                            <li class="nav-item flex-shrink-0" role="presentation">
                                <button class="nav-link small" id="impact-tab" data-bs-toggle="pill"
                                    data-bs-target="#impact" type="button">Impact</button>
                            </li>
                        </ul>

                        <div class="tab-content" id="projectTabsContent">
                            <!-- Progress Tab -->
                            <div class="tab-pane fade show active" id="progress" role="tabpanel">
                                <div class="mb-4">
                                    <h5 class="fw-semibold mb-3">Current Project Status</h5>
                                    <div class="row">
                                        <div class="col-12 col-sm-4 mb-3">
                                            <div class="text-center p-3 bg-light rounded">
                                                <div class="fs-4 fw-bold text-primary">65%</div>
                                                <div class="small text-muted">Overall Completion</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4 mb-3">
                                            <div class="text-center p-3 bg-light rounded">
                                                <div class="fs-4 fw-bold text-success">40</div>
                                                <div class="small text-muted">Schools Equipped</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4 mb-3">
                                            <div class="text-center p-3 bg-light rounded">
                                                <div class="fs-4 fw-bold text-info">150</div>
                                                <div class="small text-muted">Teachers Trained</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h5 class="fw-semibold mb-3">Recent Updates</h5>
                                <div class="accordion" id="progressAccordion">
                                    <div class="accordion-item border-0 mb-2">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed bg-light py-3" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#update1">
                                                <i class="bi bi-megaphone-fill text-primary me-2"></i>
                                                <span class="text-start">June 2024 - Teacher Training Completion</span>
                                            </button>
                                        </h2>
                                        <div id="update1" class="accordion-collapse collapse"
                                            data-bs-parent="#progressAccordion">
                                            <div class="accordion-body py-3">
                                                <p>Completed the second phase of teacher training in the northern region. 75 teachers from 20 schools have been trained in digital pedagogy and smart board operation.</p>
                                                <div class="d-flex align-items-center text-muted small">
                                                    <i class="bi bi-calendar me-1"></i>
                                                    <span>June 15, 2024</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item border-0 mb-2">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed bg-light py-3" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#update2">
                                                <i class="bi bi-megaphone-fill text-primary me-2"></i>
                                                <span class="text-start">May 2024 - Equipment Installation</span>
                                            </button>
                                        </h2>
                                        <div id="update2" class="accordion-collapse collapse"
                                            data-bs-parent="#progressAccordion">
                                            <div class="accordion-body py-3">
                                                <p>Successfully installed smart digital boards in 15 additional schools across three districts. The installation process included setting up necessary infrastructure and conducting initial orientation for school staff.</p>
                                                <div class="d-flex align-items-center text-muted small">
                                                    <i class="bi bi-calendar me-1"></i>
                                                    <span>May 28, 2024</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item border-0 mb-2">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed bg-light py-3" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#update3">
                                                <i class="bi bi-megaphone-fill text-primary me-2"></i>
                                                <span class="text-start">April 2024 - Community Engagement</span>
                                            </button>
                                        </h2>
                                        <div id="update3" class="accordion-collapse collapse"
                                            data-bs-parent="#progressAccordion">
                                            <div class="accordion-body py-3">
                                                <p>Conducted community awareness programs in project villages to ensure parental support and student engagement. Received positive feedback and increased community participation.</p>
                                                <div class="d-flex align-items-center text-muted small">
                                                    <i class="bi bi-calendar me-1"></i>
                                                    <span>April 10, 2024</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Beneficiaries Tab -->
                            <div class="tab-pane fade" id="beneficiaries" role="tabpanel">
                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <h5 class="fw-semibold mb-3">Direct Beneficiaries</h5>
                                        <div class="row">
                                            <div class="col-12 col-sm-6 mb-3">
                                                <div class="card border-0 bg-light h-100 hover-card">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-start">
                                                            <div class="flex-shrink-0 me-3">
                                                                <i class="bi bi-people-fill text-primary fs-4"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <h6 class="fw-bold mb-1">Students</h6>
                                                                <p class="mb-0 text-muted">5,000+ students across 50 rural schools</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 mb-3">
                                                <div class="card border-0 bg-light h-100 hover-card">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-start">
                                                            <div class="flex-shrink-0 me-3">
                                                                <i class="bi bi-person-badge text-success fs-4"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <h6 class="fw-bold mb-1">Teachers</h6>
                                                                <p class="mb-0 text-muted">200+ teachers receiving training</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <h5 class="fw-semibold mb-3">Geographical Coverage</h5>
                                        <div class="bg-light p-4 rounded">
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <h6 class="fw-semibold">States Covered</h6>
                                                    <ul class="mb-0">
                                                        <li>Rajasthan</li>
                                                        <li>Madhya Pradesh</li>
                                                        <li>Uttar Pradesh</li>
                                                        <li>Bihar</li>
                                                    </ul>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <h6 class="fw-semibold">School Types</h6>
                                                    <ul class="mb-0">
                                                        <li>Government Schools (70%)</li>
                                                        <li>Rural Private Schools (20%)</li>
                                                        <li>Tribal Residential Schools (10%)</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Funding Tab -->
                            <div class="tab-pane fade" id="funding" role="tabpanel">
                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <h5 class="fw-semibold mb-3">Funding Overview</h5>
                                        <div class="row">
                                            <div class="col-12 col-sm-6 mb-3">
                                                <label class="fw-semibold text-muted small">Total Project Cost:</label>
                                                <p class="mb-0 fs-5 fw-bold text-success">₹15,00,000</p>
                                            </div>
                                            <div class="col-12 col-sm-6 mb-3">
                                                <label class="fw-semibold text-muted small">Amount Raised:</label>
                                                <p class="mb-0 fs-5 fw-bold text-primary">₹9,75,000</p>
                                            </div>
                                            <div class="col-12 col-sm-6 mb-3">
                                                <label class="fw-semibold text-muted small">Funding Type:</label>
                                                <p class="mb-0">CSR Partnership</p>
                                            </div>
                                            <div class="col-12 col-sm-6 mb-3">
                                                <label class="fw-semibold text-muted small">Main Donor:</label>
                                                <p class="mb-0">TechSolutions India Ltd.</p>
                                            </div>
                                        </div>

                                        <div class="progress-container mt-3">
                                            <div class="progress-bar bg-success" style="width: 65%"></div>
                                        </div>
                                        <div class="d-flex justify-content-between small mb-3">
                                            <span>Funding Progress</span>
                                            <span>65% (₹9,75,000 raised)</span>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <h5 class="fw-semibold mb-3">Budget Allocation</h5>
                                        <div class="row">
                                            <div class="col-12 col-sm-6 mb-3">
                                                <div class="card border-0 bg-light h-100">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-start">
                                                            <div class="flex-shrink-0 me-3">
                                                                <i class="bi bi-laptop text-primary fs-4"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <h6 class="fw-bold mb-1">Equipment</h6>
                                                                <p class="mb-0 text-muted">₹8,00,000 (53%)</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 mb-3">
                                                <div class="card border-0 bg-light h-100">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-start">
                                                            <div class="flex-shrink-0 me-3">
                                                                <i class="bi bi-person-video text-success fs-4"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <h6 class="fw-bold mb-1">Training</h6>
                                                                <p class="mb-0 text-muted">₹4,00,000 (27%)</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 mb-3">
                                                <div class="card border-0 bg-light h-100">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-start">
                                                            <div class="flex-shrink-0 me-3">
                                                                <i class="bi bi-tools text-warning fs-4"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <h6 class="fw-bold mb-1">Support & Maintenance</h6>
                                                                <p class="mb-0 text-muted">₹2,00,000 (13%)</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 mb-3">
                                                <div class="card border-0 bg-light h-100">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-start">
                                                            <div class="flex-shrink-0 me-3">
                                                                <i class="bi bi-clipboard-data text-info fs-4"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <h6 class="fw-bold mb-1">Monitoring & Evaluation</h6>
                                                                <p class="mb-0 text-muted">₹1,00,000 (7%)</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Impact Tab -->
                            <div class="tab-pane fade" id="impact" role="tabpanel">
                                <div class="mb-4">
                                    <h5 class="fw-semibold mb-3">Expected Outcomes</h5>
                                    <div class="row">
                                        <div class="col-12 col-sm-6 mb-3">
                                            <div class="card border-0 bg-light h-100 hover-card">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-start">
                                                        <div class="flex-shrink-0 me-3">
                                                            <i class="bi bi-graph-up-arrow text-success fs-4"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h6 class="fw-bold mb-1">Improved Learning Outcomes</h6>
                                                            <p class="mb-0 text-muted">Expected 25% improvement in student engagement and comprehension</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 mb-3">
                                            <div class="card border-0 bg-light h-100 hover-card">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-start">
                                                        <div class="flex-shrink-0 me-3">
                                                            <i class="bi bi-award text-primary fs-4"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h6 class="fw-bold mb-1">Teacher Capacity Building</h6>
                                                            <p class="mb-0 text-muted">200+ teachers trained in digital pedagogy and technology integration</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 mb-3">
                                            <div class="card border-0 bg-light h-100 hover-card">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-start">
                                                        <div class="flex-shrink-0 me-3">
                                                            <i class="bi bi-building text-warning fs-4"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h6 class="fw-bold mb-1">Infrastructure Enhancement</h6>
                                                            <p class="mb-0 text-muted">50 schools equipped with modern digital learning tools</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 mb-3">
                                            <div class="card border-0 bg-light h-100 hover-card">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-start">
                                                        <div class="flex-shrink-0 me-3">
                                                            <i class="bi bi-people text-info fs-4"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h6 class="fw-bold mb-1">Community Engagement</h6>
                                                            <p class="mb-0 text-muted">Increased parental involvement in children's education</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h5 class="fw-semibold mb-3">Alignment with Sustainable Development Goals</h5>
                                    <div class="row text-center">
                                        <div class="col-6 col-sm-4 col-md-3 mb-3">
                                            <div class="sdg-icon bg-primary">
                                                <i class="bi bi-book"></i>
                                            </div>
                                            <small class="fw-semibold">Quality Education</small>
                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 mb-3">
                                            <div class="sdg-icon bg-success">
                                                <i class="bi bi-gender-ambiguous"></i>
                                            </div>
                                            <small class="fw-semibold">Gender Equality</small>
                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 mb-3">
                                            <div class="sdg-icon bg-warning">
                                                <i class="bi bi-arrow-left-right"></i>
                                            </div>
                                            <small class="fw-semibold">Reduced Inequalities</small>
                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 mb-3">
                                            <div class="sdg-icon bg-info">
                                                <i class="bi bi-tools"></i>
                                            </div>
                                            <small class="fw-semibold">Industry & Innovation</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gallery Section -->
                <div class="card">
                    <div class="card-body">
                        <h4 class="section-title">Project Gallery</h4>
                        <div class="row g-3">
                            <div class="col-12 col-sm-6 col-md-4">
                                <img src="https://via.placeholder.com/300x200" class="img-fluid rounded" alt="Teacher Training Session">
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                <img src="https://via.placeholder.com/300x200" class="img-fluid rounded" alt="Smart Board Installation">
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                <img src="https://via.placeholder.com/300x200" class="img-fluid rounded" alt="Student Engagement">
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                <img src="https://via.placeholder.com/300x200" class="img-fluid rounded" alt="Community Meeting">
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                <img src="https://via.placeholder.com/300x200" class="img-fluid rounded" alt="Digital Classroom">
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                <img src="https://via.placeholder.com/300x200" class="img-fluid rounded" alt="Before & After">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-12 col-lg-4">
                <!-- Project Details Sidebar -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="section-title">Project Details</h5>

                        <div class="detail-item">
                            <i class="bi bi-building text-primary"></i>
                            <div>
                                <small class="text-muted d-block">Implementing Organization</small>
                                <p class="mb-0 fw-semibold small">ISICO Education Foundation</p>
                            </div>
                        </div>

                        <div class="detail-item">
                            <i class="bi bi-bullseye text-success"></i>
                            <div>
                                <small class="text-muted d-block">Initiative Of</small>
                                <p class="mb-0 fw-semibold small">Digital India Campaign</p>
                            </div>
                        </div>

                        <div class="detail-item">
                            <i class="bi bi-diagram-3 text-warning"></i>
                            <div>
                                <small class="text-muted d-block">Project Category</small>
                                <p class="mb-0 fw-semibold small">Rural Education Transformation</p>
                            </div>
                        </div>

                        <div class="detail-item">
                            <i class="bi bi-people-fill text-info"></i>
                            <div>
                                <small class="text-muted d-block">Target Beneficiaries</small>
                                <p class="mb-0 fw-semibold small">Students & Teachers in Rural Schools</p>
                            </div>
                        </div>

                        <div class="detail-item">
                            <i class="bi bi-code-slash text-danger"></i>
                            <div>
                                <small class="text-muted d-block">QP Code</small>
                                <p class="mb-0 fw-semibold small">SSC/Q0605</p>
                            </div>
                        </div>

                        <div class="detail-item">
                            <i class="bi bi-layers text-secondary"></i>
                            <div>
                                <small class="text-muted d-block">NSQF Level</small>
                                <p class="mb-0 fw-semibold small">Level 5</p>
                            </div>
                        </div>

                        <div class="detail-item">
                            <i class="bi bi-journal-check text-dark"></i>
                            <div>
                                <small class="text-muted d-block">Project Duration</small>
                                <p class="mb-0 fw-semibold small">6 Months (Mar - Sep 2024)</p>
                            </div>
                        </div>

                        <div class="detail-item">
                            <i class="bi bi-clipboard-check text-primary"></i>
                            <div>
                                <small class="text-muted d-block">Monitoring</small>
                                <p class="mb-0 fw-semibold small">Monthly Progress Reports</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="section-title">Get Involved</h5>
                        <form>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="name" placeholder="Your Name" required>
                            </div>

                            <div class="mb-3">
                                <input type="email" class="form-control" name="email" placeholder="Your Email">
                            </div>

                            <div class="mb-3">
                                <input type="tel" class="form-control" name="mobile" placeholder="Phone Number" required>
                            </div>

                            <div class="mb-3">
                                <select class="form-control" name="interest">
                                    <option value="">Select Interest</option>
                                    <option value="volunteer">Volunteer</option>
                                    <option value="donor">Potential Donor</option>
                                    <option value="partner">Partnership</option>
                                    <option value="info">More Information</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <textarea class="form-control" name="message" rows="3" placeholder="Your Message" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Submit Enquiry</button>
                        </form>
                    </div>
                </div>

                <!-- Related Projects -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="section-title">Related Projects</h5>

                        <div class="related-project-item">
                            <img src="https://via.placeholder.com/50" alt="Digital Literacy for Rural Women" class="related-project-img">
                            <div class="related-project-info">
                                <a href="#" class="fw-semibold text-dark small">
                                    Digital Literacy for Rural Women
                                </a>
                                <small class="text-muted d-block">Ongoing Project</small>
                            </div>
                        </div>

                        <div class="related-project-item">
                            <img src="https://via.placeholder.com/50" alt="STEM Education in Tribal Areas" class="related-project-img">
                            <div class="related-project-info">
                                <a href="#" class="fw-semibold text-dark small">
                                    STEM Education in Tribal Areas
                                </a>
                                <small class="text-muted d-block">Completed Project</small>
                            </div>
                        </div>

                        <div class="related-project-item">
                            <img src="https://via.placeholder.com/50" alt="Mobile Science Labs" class="related-project-img">
                            <div class="related-project-info">
                                <a href="#" class="fw-semibold text-dark small">
                                    Mobile Science Labs
                                </a>
                                <small class="text-muted d-block">Upcoming Project</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- End Your Content here -->
@endsection

