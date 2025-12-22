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
<style>
        :root {
            --primary-color: #1e3a8a;
            --primary-light: #3b82f6;
            --secondary-color: #64748b;
            --success-color: #059669;
            --warning-color: #d97706;
            --danger-color: #dc2626;
            --light-color: #f8fafc;
            --dark-color: #0f172a;
            --accent-color: #8b5cf6;
            --border-color: #e2e8f0;
        }

        body {
            font-family: 'Georgia', 'Times New Roman', serif;
            background-color: #f1f5f9;
            color: #334155;
            line-height: 1.6;
        }

        /* Navigation - Classic Header */
        .navbar {
            background: linear-gradient(135deg, var(--primary-color), #1d4ed8);
            border-bottom: 3px solid var(--warning-color);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 0.8rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
            letter-spacing: 1px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        .navbar-brand i {
            background: rgba(255, 255, 255, 0.15);
            padding: 8px;
            border-radius: 8px;
            margin-right: 10px;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            padding: 0.5rem 1.2rem !important;
            margin: 0 4px;
            border-radius: 6px;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
            color: white !important;
            transform: translateY(-2px);
        }

        .nav-link.active {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        /* Buttons - Classic Style */
        .btn {
            border-radius: 6px;
            font-weight: 500;
            padding: 0.5rem 1.5rem;
            border: 2px solid transparent;
            transition: all 0.3s ease;
            font-family: 'Georgia', serif;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            border-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(30, 58, 138, 0.3);
            border-color: var(--primary-light);
        }

        .btn-outline-primary {
            border-color: var(--primary-color);
            color: var(--primary-color);
            background: transparent;
        }

        .btn-outline-primary:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Dashboard Stats - Classic Cards */
        .card {
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            background: white;
            overflow: hidden;
            position: relative;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
        }

        .card.project-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
            border-color: var(--primary-light);
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Project Status Badges */
        .project-status-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 0.75rem;
            padding: 6px 16px;
            border-radius: 20px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border: 2px solid white;
        }

        .status-upcoming {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }

        .status-ongoing {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
        }

        .status-completed {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        /* Section Headers - Classic Style */
        .section-header {
            position: relative;
            padding-left: 20px;
            margin: 40px 0 25px 0;
            color: var(--primary-color);
            font-weight: 700;
            font-size: 1.8rem;
        }

        .section-header::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 6px;
            background: linear-gradient(to bottom, var(--primary-color), var(--primary-light));
            border-radius: 3px;
        }

        .section-header::after {
            content: '';
            position: absolute;
            left: 20px;
            bottom: -10px;
            width: 60px;
            height: 3px;
            background: var(--warning-color);
            border-radius: 1.5px;
        }

        /* Milestone Phases - Classic Design */
        .milestone-phase {
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
            border: 1px solid var(--border-color);
            background: linear-gradient(135deg, #f8fafc, white);
            position: relative;
            overflow: hidden;
        }

        .milestone-phase::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 6px;
            background: linear-gradient(to bottom, var(--secondary-color), var(--primary-light));
        }

        .phase-prepare {
            border-left: 6px solid var(--primary-light);
        }

        .phase-deliver {
            border-left: 6px solid var(--success-color);
        }

        .phase-validate {
            border-left: 6px solid var(--accent-color);
        }

        /* Task Items - Classic List */
        .task-item {
            padding: 12px 16px;
            margin: 8px 0;
            background: white;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            border-left: 4px solid #ddd;
            transition: all 0.3s ease;
            position: relative;
        }

        .task-item:hover {
            transform: translateX(4px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .task-pending {
            border-left-color: var(--danger-color);
            background: linear-gradient(135deg, #fff, #fef2f2);
        }

        .task-inprogress {
            border-left-color: var(--warning-color);
            background: linear-gradient(135deg, #fff, #fffbeb);
        }

        .task-finished {
            border-left-color: var(--success-color);
            background: linear-gradient(135deg, #fff, #f0fdf4);
        }

        /* Cost Table - Classic Design */
        .cost-table {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .cost-table thead th {
            background: linear-gradient(135deg, var(--primary-color), #1d4ed8);
            color: white;
            font-weight: 600;
            padding: 16px;
            border: none;
            font-family: 'Georgia', serif;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .cost-table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid var(--border-color);
        }

        .cost-table tbody tr:last-child {
            border-bottom: none;
        }

        .cost-table tbody tr:hover {
            background: linear-gradient(135deg, #f8fafc, white);
        }

        .cost-table tbody td {
            padding: 14px 16px;
            vertical-align: middle;
            font-family: 'Georgia', serif;
        }

        /* Progress Bars - Classic Style */
        .progress {
            background-color: #e2e8f0;
            border-radius: 10px;
            height: 10px;
            overflow: hidden;
        }

        .progress-bar {
            background: linear-gradient(90deg, var(--primary-light), var(--primary-color));
            border-radius: 10px;
        }

        .progress-lg {
            height: 16px;
            border-radius: 8px;
        }

        /* Donut Charts Container */
        .donut-chart-container {
            position: relative;
            width: 140px;
            height: 140px;
            margin: 0 auto;
            background: white;
            border-radius: 50%;
            padding: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 2px solid var(--border-color);
        }

        /* Impact Metrics */
        .impact-metric {
            text-align: center;
            padding: 20px;
            background: linear-gradient(135deg, white, #f8fafc);
            border-radius: 12px;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .impact-metric:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .impact-metric h4 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 8px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Location Map */
        .location-map {
            height: 300px;
            background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--secondary-color);
            border: 2px dashed #cbd5e1;
            position: relative;
            overflow: hidden;
        }

        .location-map::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: repeating-linear-gradient(
                45deg,
                transparent,
                transparent 20px,
                rgba(255, 255, 255, 0.5) 20px,
                rgba(255, 255, 255, 0.5) 40px
            );
            animation: mapLines 20s linear infinite;
        }

        @keyframes mapLines {
            0% { transform: translateX(0) translateY(0); }
            100% { transform: translateX(-50%) translateY(-50%); }
        }

        .location-map i {
            position: relative;
            z-index: 2;
        }

        /* Comparison Images */
        .comparison-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .comparison-img:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        /* Stakeholder Avatar */
        .stakeholder-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-light), var(--primary-color));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2rem;
            border: 3px solid white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Filter Buttons */
        .filter-btn {
            padding: 8px 20px;
            border: 2px solid var(--border-color);
            border-radius: 6px;
            background: white;
            color: var(--secondary-color);
            font-weight: 500;
            transition: all 0.3s ease;
            font-family: 'Georgia', serif;
        }

        .filter-btn:hover {
            border-color: var(--primary-light);
            color: var(--primary-color);
            transform: translateY(-2px);
        }

        .filter-btn.active {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            color: white;
            border-color: var(--primary-color);
            box-shadow: 0 4px 8px rgba(30, 58, 138, 0.2);
        }

        /* Tab Content */
        .tab-content {
            padding: 30px;
            background: white;
            border-radius: 0 0 12px 12px;
            border: 1px solid var(--border-color);
            border-top: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .nav-tabs {
            border-bottom: 2px solid var(--border-color);
        }

        .nav-tabs .nav-link {
            border: 2px solid transparent;
            border-bottom: none;
            border-radius: 8px 8px 0 0;
            padding: 12px 24px;
            color: var(--secondary-color);
            font-weight: 500;
            transition: all 0.3s ease;
            margin-bottom: -2px;
        }

        .nav-tabs .nav-link:hover {
            border-color: var(--border-color);
            background: #f8fafc;
        }

        .nav-tabs .nav-link.active {
            background: white;
            border-color: var(--border-color);
            border-bottom-color: white;
            color: var(--primary-color);
            font-weight: 600;
        }

        /* Badges */
        .badge {
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 500;
            letter-spacing: 0.3px;
        }

        .badge.bg-primary {
            background: linear-gradient(135deg, var(--primary-light), var(--primary-color)) !important;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .badge.bg-success {
            background: linear-gradient(135deg, #10b981, #059669) !important;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .badge.bg-warning {
            background: linear-gradient(135deg, #f59e0b, #d97706) !important;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .badge.bg-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626) !important;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .badge.bg-info {
            background: linear-gradient(135deg, #0ea5e9, #0284c7) !important;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Form Controls */
        .form-control {
            border: 2px solid var(--border-color);
            border-radius: 6px;
            padding: 10px 16px;
            transition: all 0.3s ease;
            font-family: 'Georgia', serif;
        }

        .form-control:focus {
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        /* Input Group */
        .input-group {
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .input-group .form-control {
            border: 2px solid var(--border-color);
            border-right: none;
        }

        .input-group .btn {
            border: 2px solid var(--primary-color);
        }

        /* List Group */
        .list-group-item {
            border: 1px solid var(--border-color);
            padding: 12px 16px;
            transition: all 0.3s ease;
        }

        .list-group-item:hover {
            background: linear-gradient(135deg, #f8fafc, white);
            transform: translateX(4px);
        }

        .list-group-item-action {
            color: var(--primary-color);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .section-header {
                font-size: 1.5rem;
                margin: 30px 0 20px;
            }

            .card-body {
                padding: 1.25rem;
            }

            .milestone-phase {
                padding: 20px;
            }

            .tab-content {
                padding: 20px;
            }
        }

        /* Animation for stats */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, var(--primary-light), var(--primary-color));
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
        }
    </style>
@section('content')
    <!-- Projects Section -->
    <div class="container mt-4" id="projects">
        <h2 class="section-header">Project Portfolio</h2>
            <!-- Project Details Tabs -->
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-white">
                <ul class="nav nav-tabs card-header-tabs" id="projectTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button">Project Details</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="milestones-tab" data-bs-toggle="tab" data-bs-target="#milestones" type="button">Milestones</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="cost-tab" data-bs-toggle="tab" data-bs-target="#cost" type="button">Cost Breakdown</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="media-tab" data-bs-toggle="tab" data-bs-target="#media" type="button">Media & Docs</button>
                    </li>
                </ul>
            </div>
            <div class="tab-content" id="projectTabContent">
                <!-- Project Details Tab -->
                <div class="tab-pane fade show active" id="details" role="tabpanel">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>Digital Literacy for Rural Schools</h4>
                            <p class="text-muted">Empowering rural education through technology integration</p>

                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <h6 class="text-primary">Problem Statement</h6>
                                    <p>Limited digital infrastructure and computer literacy in rural schools leading to educational disparity.</p>

                                    <h6 class="text-primary mt-3">Strategic Objectives</h6>
                                    <ul>
                                        <li>Establish 10 digital classrooms in rural schools</li>
                                        <li>Train 20 teachers in digital pedagogy</li>
                                        <li>Provide computer access to 500+ students</li>
                                        <li>Integrate digital content in curriculum</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-primary">Target Groups</h6>
                                    <div class="d-flex flex-wrap gap-2 mb-3">
                                        <span class="badge bg-info p-2"><i class="bi bi-people-fill me-1"></i> Students</span>
                                        <span class="badge bg-warning p-2"><i class="bi bi-person-badge-fill me-1"></i> Teachers</span>
                                        <span class="badge bg-success p-2"><i class="bi bi-gender-female me-1"></i> Girls</span>
                                        <span class="badge bg-secondary p-2"><i class="bi bi-building me-1"></i> Schools</span>
                                    </div>

                                    <h6 class="text-primary mt-3">SDG Alignment</h6>
                                    <div class="d-flex flex-wrap gap-2">
                                        <span class="badge bg-primary p-2">SDG 4: Quality Education</span>
                                        <span class="badge bg-success p-2">SDG 5: Gender Equality</span>
                                        <span class="badge bg-info p-2">SDG 10: Reduced Inequality</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Location Map -->
                            <div class="mt-4">
                                <h6 class="text-primary">Target Locations</h6>
                                <div class="location-map">
                                    <i class="bi bi-map display-4"></i>
                                    <div class="ms-3">
                                        <h5>Project Locations Map</h5>
                                        <p class="mb-0">Sivagangai District - 10 Schools</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title text-primary">Quick Stats</h6>

                                    <div class="mb-3">
                                        <small class="text-muted">Project ID</small>
                                        <p class="mb-1"><strong>ISICO/2025/RUR/001</strong></p>
                                    </div>

                                    <div class="mb-3">
                                        <small class="text-muted">Timeline</small>
                                        <p class="mb-1"><strong>Jun 2025 - Dec 2025</strong></p>
                                        <small>6 months duration</small>
                                    </div>

                                    <div class="mb-3">
                                        <small class="text-muted">Estimated Budget</small>
                                        <p class="mb-1"><strong>₹3,40,000</strong></p>
                                    </div>

                                    <div class="mb-3">
                                        <small class="text-muted">CSR Invitation</small>
                                        <p class="mb-1">Open for CSR funding</p>
                                        <button class="btn btn-sm btn-primary w-100">Register Interest</button>
                                    </div>

                                    <hr>

                                    <h6 class="text-primary mt-3">Stakeholders</h6>
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="stakeholder-avatar me-2">PM</div>
                                        <div>
                                            <small class="d-block"><strong>Project Manager</strong></small>
                                            <small class="text-muted">John Abraham</small>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="stakeholder-avatar me-2">TC</div>
                                        <div>
                                            <small class="d-block"><strong>Technical Coordinator</strong></small>
                                            <small class="text-muted">Priya Sharma</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Milestones Tab -->
                <div class="tab-pane fade" id="milestones" role="tabpanel">
                    <h4>7-Phase Milestone Tracker</h4>
                    <p class="text-muted">Track project progress through defined phases</p>

                    <!-- Overall Progress -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="mb-0">Overall Project Progress</h6>
                                        <span class="badge bg-primary">35% Complete</span>
                                    </div>
                                    <div class="progress progress-lg">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 35%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Milestone Phases -->
                    <div class="row">
                        <!-- Phase 1 -->
                        <div class="col-md-6">
                            <div class="milestone-phase phase-prepare">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="mb-0">P1: Need Assessment & Baseline</h5>
                                    <span class="badge bg-success">Completed</span>
                                </div>
                                <p class="text-muted"><i class="bi bi-layer-forward me-1"></i> Layer: Prepare</p>

                                <div class="task-item task-finished">
                                    <div class="d-flex justify-content-between">
                                        <span><strong>P1.1</strong> - Initial Survey Design</span>
                                        <small class="text-success">Finished</small>
                                    </div>
                                    <small class="text-muted">Assigned to: Survey Team</small>
                                </div>

                                <div class="task-item task-finished">
                                    <div class="d-flex justify-content-between">
                                        <span><strong>P1.2</strong> - Field Data Collection</span>
                                        <small class="text-success">Finished</small>
                                    </div>
                                    <small class="text-muted">Assigned to: Field Coordinators</small>
                                </div>

                                <div class="task-item task-finished">
                                    <div class="d-flex justify-content-between">
                                        <span><strong>P1.3</strong> - Analysis Report</span>
                                        <small class="text-success">Finished</small>
                                    </div>
                                    <small class="text-muted">Assigned to: Data Analyst</small>
                                </div>
                            </div>
                        </div>

                        <!-- Phase 2 -->
                        <div class="col-md-6">
                            <div class="milestone-phase phase-prepare">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="mb-0">P2: Partnerships & Resources</h5>
                                    <span class="badge bg-success">Completed</span>
                                </div>
                                <p class="text-muted"><i class="bi bi-layer-forward me-1"></i> Layer: Prepare</p>

                                <div class="task-item task-finished">
                                    <div class="d-flex justify-content-between">
                                        <span><strong>P2.1</strong> - CSR Partner Identification</span>
                                        <small class="text-success">Finished</small>
                                    </div>
                                </div>

                                <div class="task-item task-finished">
                                    <div class="d-flex justify-content-between">
                                        <span><strong>P2.2</strong> - MoU Finalization</span>
                                        <small class="text-success">Finished</small>
                                    </div>
                                </div>

                                <div class="task-item task-finished">
                                    <div class="d-flex justify-content-between">
                                        <span><strong>P2.3</strong> - Initial Funding</span>
                                        <small class="text-success">Finished</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Phase 3 -->
                        <div class="col-md-6">
                            <div class="milestone-phase phase-prepare">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="mb-0">P3: Planning & Procurement</h5>
                                    <span class="badge bg-warning">In Progress</span>
                                </div>
                                <p class="text-muted"><i class="bi bi-layer-forward me-1"></i> Layer: Prepare</p>

                                <div class="task-item task-finished">
                                    <div class="d-flex justify-content-between">
                                        <span><strong>P3.1</strong> - Vendor Selection</span>
                                        <small class="text-success">Finished</small>
                                    </div>
                                </div>

                                <div class="task-item task-inprogress">
                                    <div class="d-flex justify-content-between">
                                        <span><strong>P3.2</strong> - Equipment Procurement</span>
                                        <small class="text-warning">In Progress</small>
                                    </div>
                                </div>

                                <div class="task-item task-pending">
                                    <div class="d-flex justify-content-between">
                                        <span><strong>P3.3</strong> - Logistics Setup</span>
                                        <small class="text-danger">Pending</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Phase 4 -->
                        <div class="col-md-6">
                            <div class="milestone-phase phase-deliver">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="mb-0">P4: Implementation & Launch</h5>
                                    <span class="badge bg-secondary">Pending</span>
                                </div>
                                <p class="text-muted"><i class="bi bi-layer-forward me-1"></i> Layer: Deliver</p>

                                <div class="task-item task-pending">
                                    <div class="d-flex justify-content-between">
                                        <span><strong>P4.1</strong> - Infrastructure Setup</span>
                                        <small class="text-danger">Pending</small>
                                    </div>
                                </div>

                                <div class="task-item task-pending">
                                    <div class="d-flex justify-content-between">
                                        <span><strong>P4.2</strong> - System Installation</span>
                                        <small class="text-danger">Pending</small>
                                    </div>
                                </div>

                                <div class="task-item task-pending">
                                    <div class="d-flex justify-content-between">
                                        <span><strong>P4.3</strong> - Launch Event</span>
                                        <small class="text-danger">Pending</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cost Breakdown Tab -->
                <div class="tab-pane fade" id="cost" role="tabpanel">
                    <h4>Cost Breakdown & Funding Status</h4>
                    <p class="text-muted">Detailed budget estimation and actual expenditure tracking</p>

                    <div class="row mb-4">
                        <div class="col-md-8">
                            <!-- Funding Progress -->
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="mb-0">Fundraising Status</h6>
                                        <span class="badge bg-success">Active</span>
                                    </div>
                                    <div class="progress progress-lg mb-3">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 65%">65% Funded</div>
                                    </div>
                                    <div class="row text-center">
                                        <div class="col-4">
                                            <h5 class="text-primary">₹3,40,000</h5>
                                            <small class="text-muted">Total Estimated</small>
                                        </div>
                                        <div class="col-4">
                                            <h5 class="text-success">₹2,21,000</h5>
                                            <small class="text-muted">Amount Raised</small>
                                        </div>
                                        <div class="col-4">
                                            <h5 class="text-danger">₹1,19,000</h5>
                                            <small class="text-muted">Balance Required</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Cost Breakdown Table -->
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title mb-3">Cost Breakdown Estimator</h6>
                                    <div class="table-responsive">
                                        <table class="table table-bordered cost-table">
                                            <thead>
                                                <tr>
                                                    <th>Category</th>
                                                    <th>Item Description</th>
                                                    <th>Qty</th>
                                                    <th>Unit Cost</th>
                                                    <th>Total</th>
                                                    <th>Phase</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><span class="badge bg-secondary">Survey</span></td>
                                                    <td>Baseline Survey</td>
                                                    <td>4</td>
                                                    <td>₹2,500</td>
                                                    <td>₹10,000</td>
                                                    <td>P1</td>
                                                </tr>
                                                <tr>
                                                    <td><span class="badge bg-primary">Hardware</span></td>
                                                    <td>Computer Systems</td>
                                                    <td>5</td>
                                                    <td>₹20,000</td>
                                                    <td>₹1,00,000</td>
                                                    <td>P3</td>
                                                </tr>
                                                <tr>
                                                    <td><span class="badge bg-primary">Hardware</span></td>
                                                    <td>Smart Boards</td>
                                                    <td>2</td>
                                                    <td>₹80,000</td>
                                                    <td>₹1,60,000</td>
                                                    <td>P3</td>
                                                </tr>
                                                <tr>
                                                    <td><span class="badge bg-info">Logistics</span></td>
                                                    <td>Transportation</td>
                                                    <td>2</td>
                                                    <td>₹5,000</td>
                                                    <td>₹10,000</td>
                                                    <td>P3</td>
                                                </tr>
                                                <tr>
                                                    <td><span class="badge bg-success">Software</span></td>
                                                    <td>Educational Software</td>
                                                    <td>1</td>
                                                    <td>₹20,000</td>
                                                    <td>₹20,000</td>
                                                    <td>P4</td>
                                                </tr>
                                                <tr>
                                                    <td><span class="badge bg-warning">Training</span></td>
                                                    <td>Teacher Training</td>
                                                    <td>10 days</td>
                                                    <td>₹1,000</td>
                                                    <td>₹10,000</td>
                                                    <td>P5</td>
                                                </tr>
                                                <tr class="table-active">
                                                    <td colspan="4" class="text-end"><strong>Total Estimated Cost</strong></td>
                                                    <td colspan="2"><strong>₹3,40,000</strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- Donors List -->
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h6 class="card-title mb-3">Top Donors</h6>
                                    <div class="list-group">
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-1">ABC Corporation</h6>
                                                <small class="text-muted">CSR Partner</small>
                                            </div>
                                            <span class="badge bg-primary rounded-pill">₹1,00,000</span>
                                        </div>
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-1">XYZ Foundation</h6>
                                                <small class="text-muted">Philanthropy</small>
                                            </div>
                                            <span class="badge bg-primary rounded-pill">₹75,000</span>
                                        </div>
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-1">Individual Donors</h6>
                                                <small class="text-muted">Crowdfunding</small>
                                            </div>
                                            <span class="badge bg-primary rounded-pill">₹46,000</span>
                                        </div>
                                    </div>
                                    <button class="btn btn-outline-primary w-100 mt-3">
                                        <i class="bi bi-plus-circle"></i> Add Donor
                                    </button>
                                </div>
                            </div>

                            <!-- Utilization Chart -->
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title mb-3">Budget Utilization</h6>
                                    <canvas id="utilizationChart" height="200"></canvas>
                                    <div class="mt-3">
                                        <div class="d-flex justify-content-between mb-1">
                                            <small>Utilization: 42%</small>
                                            <small>Balance: 58%</small>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-info" style="width: 42%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Media Tab -->
                <div class="tab-pane fade" id="media" role="tabpanel">
                    <h4>Media Gallery & Documents</h4>
                    <p class="text-muted">Project photos, documents, and supporting materials</p>

                    <div class="row">
                        <!-- Gallery -->
                        <div class="col-md-8">
                            <h6 class="text-primary mb-3">Project Gallery</h6>
                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <img src="https://via.placeholder.com/300x200/3498db/FFFFFF?text=School+Visit" class="img-thumbnail comparison-img" alt="Project Image">
                                </div>
                                <div class="col-md-4">
                                    <img src="https://via.placeholder.com/300x200/2ecc71/FFFFFF?text=Training+Session" class="img-thumbnail comparison-img" alt="Project Image">
                                </div>
                                <div class="col-md-4">
                                    <img src="https://via.placeholder.com/300x200/e74c3c/FFFFFF?text=Community+Meeting" class="img-thumbnail comparison-img" alt="Project Image">
                                </div>
                            </div>

                            <!-- Before/After Comparison -->
                            <h6 class="text-primary mb-3">Impact Comparison</h6>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-light">
                                            <h6 class="mb-0">Before Implementation</h6>
                                        </div>
                                        <div class="card-body text-center">
                                            <img src="https://via.placeholder.com/400x250/95a5a6/FFFFFF?text=Traditional+Classroom" class="img-fluid rounded mb-2" alt="Before">
                                            <p class="text-muted">Traditional classroom setup</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-light">
                                            <h6 class="mb-0">Expected Outcome (AI Visualization)</h6>
                                        </div>
                                        <div class="card-body text-center">
                                            <img src="https://via.placeholder.com/400x250/3498db/FFFFFF?text=Digital+Classroom+AI" class="img-fluid rounded mb-2" alt="After AI">
                                            <p class="text-muted">Digital classroom visualization</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Documents -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title text-primary mb-3">Supporting Documents</h6>
                                    <div class="list-group">
                                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="bi bi-file-pdf text-danger me-2"></i>
                                                Baseline Survey Report
                                            </div>
                                            <i class="bi bi-download"></i>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="bi bi-file-text text-primary me-2"></i>
                                                Project Proposal
                                            </div>
                                            <i class="bi bi-download"></i>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="bi bi-file-earmark-text text-success me-2"></i>
                                                Budget Approval
                                            </div>
                                            <i class="bi bi-download"></i>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="bi bi-file-earmark-pdf text-danger me-2"></i>
                                                Vendor Quotations
                                            </div>
                                            <i class="bi bi-download"></i>
                                        </a>
                                    </div>

                                    <hr class="my-3">

                                    <h6 class="text-primary mb-3">External Links</h6>
                                    <div class="list-group">
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <i class="bi bi-newspaper me-2"></i>
                                            Press Coverage
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <i class="bi bi-youtube me-2 text-danger"></i>
                                            Project Video
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <i class="bi bi-facebook me-2 text-primary"></i>
                                            Social Media Updates
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- Project Filters -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-2">
                            <div class="col-md-8">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-outline-primary filter-btn active" data-filter="all">All Projects</button>
                                    <button type="button" class="btn btn-outline-warning filter-btn" data-filter="upcoming">Upcoming</button>
                                    <button type="button" class="btn btn-outline-info filter-btn" data-filter="ongoing">Ongoing</button>
                                    <button type="button" class="btn btn-outline-success filter-btn" data-filter="completed">Completed</button>
                                </div>
                                <div class="btn-group ms-2" role="group">
                                    <button type="button" class="btn btn-outline-secondary filter-btn" data-category="education">Education</button>
                                    <button type="button" class="btn btn-outline-secondary filter-btn" data-category="shg">SHG</button>
                                    <button type="button" class="btn btn-outline-secondary filter-btn" data-category="youth">Youth</button>
                                    <button type="button" class="btn btn-outline-secondary filter-btn" data-category="skill">Skill</button>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search projects...">
                                    <button class="btn btn-primary" type="button">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Project Cards -->
        <div class="row">
            <!-- Upcoming Project Card -->
            <div class="col-md-4 project-item" data-status="upcoming" data-category="education">
                <div class="card project-card h-100">
                    <span class="project-status-badge status-upcoming">Upcoming</span>
                    <img src="https://via.placeholder.com/400x200/FFA500/FFFFFF?text=Education+Project" class="card-img-top" alt="Project Banner">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <span class="badge bg-primary">Education</span>
                                <span class="badge bg-secondary ms-1">Rural</span>
                            </div>
                            <small class="text-muted">ID: ISICO/2025/RUR/001</small>
                        </div>
                        <h5 class="card-title">Digital Literacy for Rural Schools</h5>
                        <p class="card-text text-muted">Empowering 10 schools in Sivagangai district with digital classrooms and computer education.</p>

                        <div class="mb-3">
                            <small class="d-block"><strong>Location:</strong> Sivagangai District</small>
                            <small class="d-block"><strong>Start Date:</strong> June 2025</small>
                            <small class="d-block"><strong>Beneficiaries:</strong> 500+ Students</small>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="progress w-50">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 25%"></div>
                            </div>
                            <button class="btn btn-sm btn-outline-primary">View Details</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ongoing Project Card -->
            <div class="col-md-4 project-item" data-status="ongoing" data-category="skill">
                <div class="card project-card h-100">
                    <span class="project-status-badge status-ongoing">Ongoing</span>
                    <img src="https://via.placeholder.com/400x200/3498db/FFFFFF?text=Skill+Development" class="card-img-top" alt="Project Banner">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <span class="badge bg-success">Skill</span>
                                <span class="badge bg-secondary ms-1">Urban</span>
                            </div>
                            <small class="text-muted">ID: ISICO/2025/URB/002</small>
                        </div>
                        <h5 class="card-title">Youth Vocational Training Program</h5>
                        <p class="card-text text-muted">Providing NSQF-aligned skill training to unemployed youth in urban areas.</p>

                        <div class="mb-3">
                            <small class="d-block"><strong>Location:</strong> Chennai, Madurai</small>
                            <small class="d-block"><strong>Progress:</strong> 65% Complete</small>
                            <small class="d-block"><strong>Beneficiaries:</strong> 150 Youth</small>
                        </div>

                        <!-- Donut Chart for Metrics -->
                        <div class="row text-center mb-3">
                            <div class="col-4">
                                <div class="donut-chart-container">
                                    <canvas id="donutChart1"></canvas>
                                </div>
                                <small>Completion</small>
                            </div>
                            <div class="col-4">
                                <div class="donut-chart-container">
                                    <canvas id="donutChart2"></canvas>
                                </div>
                                <small>Training</small>
                            </div>
                            <div class="col-4">
                                <div class="donut-chart-container">
                                    <canvas id="donutChart3"></canvas>
                                </div>
                                <small>Placement</small>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="progress w-50">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 65%"></div>
                            </div>
                            <button class="btn btn-sm btn-outline-primary">View Details</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Completed Project Card -->
            <div class="col-md-4 project-item" data-status="completed" data-category="shg">
                <div class="card project-card h-100">
                    <span class="project-status-badge status-completed">Completed</span>
                    <img src="https://via.placeholder.com/400x200/27ae60/FFFFFF?text=Women+SHG" class="card-img-top" alt="Project Banner">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <span class="badge bg-danger">SHG</span>
                                <span class="badge bg-secondary ms-1">Mixed</span>
                            </div>
                            <small class="text-muted">ID: ISICO/2024/MIX/005</small>
                        </div>
                        <h5 class="card-title">Women Entrepreneurship Development</h5>
                        <p class="card-text text-muted">Empowering 200 women through SHG formation and micro-enterprise training.</p>

                        <div class="mb-3">
                            <small class="d-block"><strong>Location:</strong> Multiple Districts</small>
                            <small class="d-block"><strong>Completed:</strong> Dec 2024</small>
                            <small class="d-block"><strong>Impact:</strong> 15 Enterprises Started</small>
                        </div>

                        <div class="row text-center mb-3">
                            <div class="col-6">
                                <div class="impact-metric">
                                    <h4 class="text-success">200</h4>
                                    <small>Women Trained</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="impact-metric">
                                    <h4 class="text-success">₹25L</h4>
                                    <small>Loans Generated</small>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="progress w-50">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                            </div>
                            <button class="btn btn-sm btn-outline-primary">View Report</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <!-- Bootstrap Icons -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css"> --}}
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
        // Initialize charts
        document.addEventListener('DOMContentLoaded', function() {
            // Project Status Chart
            const projectStatusEl = document.getElementById('projectStatusChart');
            if (projectStatusEl) {
                const projectStatusCtx = projectStatusEl.getContext('2d');
                const projectStatusChart = new Chart(projectStatusCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Education', 'SHG', 'Youth', 'Skill'],
                        datasets: [{
                            label: 'Upcoming',
                            data: [4, 3, 2, 3],
                            backgroundColor: '#f39c12'
                        }, {
                            label: 'Ongoing',
                            data: [2, 1, 3, 2],
                            backgroundColor: '#3498db'
                        }, {
                            label: 'Completed',
                            data: [5, 4, 3, 3],
                            backgroundColor: '#27ae60'
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    display: false
                                }
                            },
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 2
                                }
                            }
                        }
                    }
                });
            }

            // Location Chart
            const locationEl = document.getElementById('locationChart');
            if (locationEl) {
                const locationCtx = locationEl.getContext('2d');
                const locationChart = new Chart(locationCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Rural', 'Urban', 'Metro', 'Mixed'],
                        datasets: [{
                            data: [12, 8, 5, 10],
                            backgroundColor: [
                                '#e74c3c',
                                '#3498db',
                                '#9b59b6',
                                '#f39c12'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
            }

            // Small Donut Charts
            const createDonutChart = (id, value, color) => {
                const ctx = document.getElementById(id).getContext('2d');
                return new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        datasets: [{
                            data: [value, 100-value],
                            backgroundColor: [color, '#ecf0f1'],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        cutout: '70%',
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                enabled: false
                            }
                        }
                    }
                });
            };

            // Create donut charts
            createDonutChart('donutChart1', 65, '#3498db');
            createDonutChart('donutChart2', 80, '#2ecc71');
            createDonutChart('donutChart3', 45, '#e74c3c');

            // Utilization Chart
            const utilizationCtx = document.getElementById('utilizationChart').getContext('2d');
            const utilizationChart = new Chart(utilizationCtx, {
                type: 'pie',
                data: {
                    labels: ['Hardware', 'Software', 'Training', 'Logistics', 'Survey', 'Admin'],
                    datasets: [{
                        data: [45, 15, 10, 12, 8, 10],
                        backgroundColor: [
                            '#3498db',
                            '#2ecc71',
                            '#f39c12',
                            '#9b59b6',
                            '#e74c3c',
                            '#34495e'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // Filter functionality
            const filterButtons = document.querySelectorAll('.filter-btn');
            const projectItems = document.querySelectorAll('.project-item');

            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Remove active class from all buttons
                    filterButtons.forEach(btn => btn.classList.remove('active'));

                    // Add active class to clicked button
                    this.classList.add('active');

                    const filter = this.getAttribute('data-filter');
                    const category = this.getAttribute('data-category');

                    projectItems.forEach(item => {
                        const status = item.getAttribute('data-status');
                        const itemCategory = item.getAttribute('data-category');

                        let showItem = true;

                        if (filter && filter !== 'all') {
                            showItem = status === filter;
                        }

                        if (category) {
                            showItem = itemCategory === category;
                        }

                        if (showItem) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            });

            // Tab switching with URL hash
            const hash = window.location.hash;
            if (hash) {
                const tabTrigger = document.querySelector(`[data-bs-target="${hash}"]`);
                if (tabTrigger) {
                    new bootstrap.Tab(tabTrigger).show();
                }
            }
        });
    </script>
@endpush
