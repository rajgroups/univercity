                               {{-- @dd($project->govt_schemes) --}}
@extends('layouts.web.app')
@section('content')
@push('css')
<style>
        :root {
            --prepare-color: #2E8B57;
            --deliver-color: #1E90FF;
            --validate-color: #9B59B6;
            --finished-color: #28a745;
            --current-color: #ffc107;
            --pending-color: #6c757d;
        }

        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }

        .container-wrapper {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Header Styles */
        .project-header {
            background: linear-gradient(135deg, #2c3e50 0%, #1a252f 100%);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            color: white;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .project-header h1 {
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .project-header .badge {
            font-size: 0.85rem;
            padding: 0.35rem 0.8rem;
        }

        /* Phase Bar */
        .phase-bar-container {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .phase-bar-title {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 1rem;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .phase-bar-title i {
            color: var(--prepare-color);
        }

        .phase-bar {
            height: 32px;
            border-radius: 20px;
            overflow: hidden;
            display: flex;
            border: 2px solid #e9ecef;
            margin-bottom: 0.5rem;
        }

        .phase {
            flex: 1;
            font-size: 13px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            transition: all 0.3s ease;
        }

        .phase:hover {
            transform: scale(1.05);
            z-index: 2;
        }

        .phase.completed {
            background: var(--finished-color);
            color: white;
        }

        .phase.current {
            background: var(--current-color);
            color: #000;
            border: 2px solid #e6b400;
            margin: -2px;
            z-index: 1;
        }

        .phase.upcoming {
            background: #f8f9fa;
            color: #6c757d;
        }

        .phase-label {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Phase Cards */
        .phase-card {
            border-radius: 12px;
            padding: 1.25rem;
            height: 100%;
            transition: all 0.3s ease;
            border: 1px solid transparent;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        .phase-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        .phase-finished {
            background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
            border-left: 4px solid var(--finished-color);
        }

        .phase-current {
            background: linear-gradient(135deg, #fff8e1 0%, #ffecb3 100%);
            border-left: 4px solid var(--current-color);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(255, 193, 7, 0.4);
            }

            70% {
                box-shadow: 0 0 0 6px rgba(255, 193, 7, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(255, 193, 7, 0);
            }
        }

        .phase-pending {
            background: white;
            border-left: 4px solid #dee2e6;
        }

        .phase-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.75rem;
        }

        .phase-number {
            font-weight: 800;
            font-size: 1.5rem;
            color: #2c3e50;
        }

        .phase-title {
            font-weight: 600;
            color: #2c3e50;
            line-height: 1.3;
        }

        .badge-finished,
        .badge-current,
        .badge-pending {
            font-size: 11px;
            border-radius: 20px;
            padding: 4px 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-finished {
            background: var(--finished-color);
            color: white;
        }

        .badge-current {
            background: var(--current-color);
            color: #000;
        }

        .badge-pending {
            background: #e9ecef;
            color: #495057;
        }

        .layer-badge {
            font-size: 10px;
            padding: 3px 8px;
            border-radius: 4px;
            font-weight: 600;
        }

        .layer-prepare {
            background: rgba(46, 139, 87, 0.1);
            color: var(--prepare-color);
        }

        .layer-deliver {
            background: rgba(30, 144, 255, 0.1);
            color: var(--deliver-color);
        }

        .layer-validate {
            background: rgba(155, 89, 182, 0.1);
            color: var(--validate-color);
        }

        /* Table Styles */
        .table-container {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-top: 2rem;
        }

        .table-header-custom {
            background: linear-gradient(135deg, #2c3e50 0%, #1a252f 100%);
            color: white;
            border: none;
            padding: 1rem 1.5rem;
        }

        .table thead th {
            background: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 0.75rem 1rem;
            color: #495057;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table tbody td {
            padding: 0.75rem 1rem;
            vertical-align: middle;
            border-color: #f1f3f4;
        }

        .table tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }

        .status-finished,
        .status-current,
        .status-pending {
            font-size: 11px;
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: 600;
            display: inline-block;
        }

        .status-finished {
            background: rgba(40, 167, 69, 0.1);
            color: var(--finished-color);
            border: 1px solid rgba(40, 167, 69, 0.3);
        }

        .status-current {
            background: rgba(255, 193, 7, 0.1);
            color: #b38600;
            border: 1px solid rgba(255, 193, 7, 0.3);
        }

        .status-pending {
            background: rgba(108, 117, 125, 0.1);
            color: var(--pending-color);
            border: 1px solid rgba(108, 117, 125, 0.3);
        }

        .phase-section-header {
            background: linear-gradient(135deg, #e8f5e9 0%, #d4edda 100%);
            font-weight: 700;
            color: #155724;
            font-size: 0.95rem;
        }

        .phase-section-header.deliver {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            color: #0d47a1;
        }

        .phase-section-header.validate {
            background: linear-gradient(135deg, #f3e5f5 0%, #e1bee7 100%);
            color: #4a148c;
        }

        /* Summary */
        .summary-box {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 8px;
            padding: 1rem;
            margin-top: 1rem;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .summary-item:last-child {
            border-bottom: none;
        }

        /* Footer */
        .footer {
            background: white;
            border-top: 1px solid #e9ecef;
            margin-top: 3rem;
            padding: 1.5rem 0;
        }

        .footer-logo {
            font-weight: 800;
            color: #2c3e50;
            font-size: 1.25rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .phase {
                font-size: 11px;
                padding: 0 4px;
            }

            .phase-bar {
                height: 28px;
            }

            .phase-card {
                margin-bottom: 1rem;
            }

            .table-responsive {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 576px) {
            .project-header {
                padding: 1rem;
            }

            .phase-bar-title {
                font-size: 1rem;
            }

            .phase-title {
                font-size: 0.95rem;
            }
        }
    .sdg-img {
    width: 50%;
}

@media (max-width: 576px) {
    .w-md-50 {
        width: 100% !important;
    }
}
</style>
@endpush
<!-- Hero Section - Modernized -->
<div class="project-hero position-relative overflow-hidden"
     style="@if($project->banner_images) background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.5)), url('{{ asset($project->banner_images) }}'); @else background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); @endif">
    <div class="container position-relative py-5 z-2">
        <div class="row align-items-center min-vh-70">
            <div class="col-lg-8">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('web.projects') }}" class="text-white text-decoration-none"><i class="bi bi-arrow-left me-1"></i> Back to Projects</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">{{ Str::limit($project->title, 30) }}</li>
                    </ol>
                </nav>

                <!-- Project Badges -->
                <div class="d-flex flex-wrap align-items-center gap-2 mb-4">
                    <span class="badge bg-warning bg-opacity-20 text-warning border border-warning border-opacity-25 px-3 py-2 rounded-pill text-white">
                        <i class="bi bi-rocket-takeoff me-1"></i>{{ strtoupper($project->stage) }}
                    </span>
                    @if($project->category)
                    <span class="badge bg-primary bg-opacity-20 border border-primary border-opacity-25 px-3 py-2 rounded-pill text-white">
                        <i class="bi bi-tag me-1"></i>{{ $project->category->name ?? 'N/A' }}
                    </span>
                    @endif
                </div>

                <!-- Project Title -->
                <h1 class="display-4 fw-bold mb-3 text-white">{{ $project->title }}</h1>

                @if($project->subtitle)
                <p class="lead mb-4 text-white">{{ $project->subtitle }}</p>
                @endif

                <!-- Quick Stats Cards -->
                <div class="row g-3 mt-4">
                    <div class="col-md-4">
                        <div class="card bg-white bg-opacity-10 border-0">
                            <div class="card-body py-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-25 rounded-circle p-2 me-3">
                                        <i class="bi bi-fingerprint text-white fs-5"></i>
                                    </div>
                                    <div>
                                        <small class="text-black-50 d-block">PROJECT ID</small>
                                        <strong class="text-black fs-6">{{ $project->project_code }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card bg-white bg-opacity-10 border-0">
                            <div class="card-body py-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-success bg-opacity-25 rounded-circle p-2 me-3">
                                        <i class="bi bi-geo-alt text-white fs-5"></i>
                                    </div>
                                    <div>
                                        <small class="text-black-50 d-block">LOCATION</small>
                                        <strong class="text-black fs-6">
                                            {{ Str::limit($project->resolved_location, 10) }}
                                        </strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card bg-white bg-opacity-10 border-0">
                            <div class="card-body py-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-info bg-opacity-25 rounded-circle p-2 me-3">
                                        <i class="bi bi-calendar-range text-white fs-5"></i>
                                    </div>
                                    <div>
                                        <small class="text-black-50 d-block">Tentative Start</small>
                                        <strong class="text-black fs-6">
                                            @if($project->planned_start_date)
                                                {{ date('M Y', strtotime($project->planned_start_date)) }}
                                            @else
                                                Ongoing
                                            @endif
                                        </strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="position-absolute bottom-0 start-0 end-0 text-center pb-3">
        <a href="#main-content" class="text-black text-decoration-none">
            <i class="bi bi-chevron-down fs-4 animate-bounce"></i>
        </a>
    </div>
</div>

<!-- Main Content -->
<div id="main-content" class="container py-5">
    <!-- Modern Tabs Navigation -->
    <div class="mb-4">
        <!-- Mobile/Tablet Filter Toggle -->
        <div class="d-lg-none mb-3">
            <button class="btn btn-primary d-flex align-items-center gap-2 px-4 rounded-pill shadow-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileTabMenu">
                <i class="bi bi-filter-left fs-4"></i>
                <span class="fw-bold">Explore Project Sections</span>
            </button>
        </div>

        <!-- Desktop Navigation -->
        <nav class="nav nav-pills d-none d-lg-flex flex-wrap gap-2 mb-4" id="projectTabs" role="tablist">
            <button class="nav-link btn btn-outline-primary rounded-pill px-4 active" id="overview-tab" data-bs-toggle="pill" data-bs-target="#overview" type="button" role="tab" aria-controls="overview" aria-selected="true">
                <i class="bi bi-info-circle me-2"></i>Overview
            </button>
            @if($project->learningPathway)
            <button class="nav-link btn btn-outline-primary rounded-pill px-4" id="pathway-tab" data-bs-toggle="pill" data-bs-target="#pathway" type="button" role="tab" aria-controls="pathway" aria-selected="false">
                <i class="bi bi-diagram-3 me-2"></i>Pathways
            </button>
            @endif

            @if((isset($project->sdg_goals) && count($project->sdg_goals) > 0) || !empty($project->alignment_categories) || !empty($project->govt_schemes) || $project->alignment_notes)
            <button class="nav-link btn btn-outline-success rounded-pill px-4" id="alignment-tab" data-bs-toggle="pill" data-bs-target="#alignment" type="button" role="tab" aria-controls="alignment" aria-selected="false">
                <i class="bi bi-globe-americas me-2"></i>SDG & Alignment
            </button>
            @endif
            <button class="nav-link btn btn-outline-info rounded-pill px-4" id="milestones-tab" data-bs-toggle="pill" data-bs-target="#milestones" type="button" role="tab" aria-controls="milestones" aria-selected="false">
                <i class="bi bi-calendar-check me-2"></i>Milestones
            </button>
            <button class="nav-link btn btn-outline-warning rounded-pill px-4" id="budget-tab" data-bs-toggle="pill" data-bs-target="#budget" type="button" role="tab" aria-controls="budget" aria-selected="false">
                <i class="bi bi-cash-coin me-2"></i>Budget
            </button>
            <button class="nav-link btn btn-outline-secondary rounded-pill px-4" id="gallery-tab" data-bs-toggle="pill" data-bs-target="#gallery" type="button" role="tab" aria-controls="gallery" aria-selected="false">
                <i class="bi bi-images me-2"></i>Gallery
            </button>
            <button class="nav-link btn btn-outline-dark rounded-pill px-4" id="documents-tab" data-bs-toggle="pill" data-bs-target="#documents" type="button" role="tab" aria-controls="documents" aria-selected="false">
                <i class="bi bi-file-text me-2"></i>Documents
            </button>
            @if($project->stage == 'ongoing' || $project->stage == 'completed')
            <button class="nav-link btn btn-outline-danger rounded-pill px-4" id="execution-tab" data-bs-toggle="pill" data-bs-target="#execution" type="button" role="tab" aria-controls="execution" aria-selected="false">
                <i class="bi bi-activity me-2"></i>{{ $project->stage == 'completed' ? 'Complete Overview' : 'Execution' }}
            </button>
            @endif
            <button class="nav-link btn btn-outline-purple rounded-pill px-4" id="resources-tab" data-bs-toggle="pill" data-bs-target="#resources" type="button" role="tab" aria-controls="resources" aria-selected="false">
                <i class="bi bi-shield-check me-2"></i>Resources & Risks
            </button>
            <button class="nav-link btn btn-outline-teal rounded-pill px-4" id="feedback-tab" data-bs-toggle="pill" data-bs-target="#feedback" type="button" role="tab" aria-controls="feedback" aria-selected="false">
                <i class="bi bi-chat-heart me-2"></i>Feedback <span class="badge bg-primary ms-1">{{ $feedbacks->count() }}</span>
            </button>
        </nav>
    </div>

    <!-- Mobile Off-canvas Menu -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileTabMenu" aria-labelledby="mobileTabMenuLabel">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title fw-bold" id="mobileTabMenuLabel">
                <i class="bi bi-grid-fill me-2 text-primary"></i>Project Sections
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-0">
            <div class="list-group list-group-flush" id="mobileProjectTabs" role="tablist">
                <button class="list-group-item list-group-item-action py-3 d-flex align-items-center gap-3 active" data-bs-toggle="pill" data-bs-target="#overview" role="tab">
                    <i class="bi bi-info-circle fs-5 text-primary"></i>
                    <div>
                        <span class="d-block fw-bold">Overview</span>
                        <small class="text-muted">General project details & impact</small>
                    </div>
                </button>
                @if($project->learningPathway)
                <button class="list-group-item list-group-item-action py-3 d-flex align-items-center gap-3" data-bs-toggle="pill" data-bs-target="#pathway" role="tab">
                    <i class="bi bi-diagram-3 fs-5 text-primary"></i>
                    <div>
                        <span class="d-block fw-bold">Pathways</span>
                        <small class="text-muted">Learning & Impact Model</small>
                    </div>
                </button>
                @endif

                @if((isset($project->sdg_goals) && count($project->sdg_goals) > 0) || !empty($project->alignment_categories) || !empty($project->govt_schemes) || $project->alignment_notes)
                <button class="list-group-item list-group-item-action py-3 d-flex align-items-center gap-3" data-bs-toggle="pill" data-bs-target="#alignment" role="tab">
                    <i class="bi bi-globe-americas fs-5 text-success"></i>
                    <div>
                        <span class="d-block fw-bold">SDG & Alignment</span>
                        <small class="text-muted">Global goals & strategic fit</small>
                    </div>
                </button>
                @endif
                <button class="list-group-item list-group-item-action py-3 d-flex align-items-center gap-3" data-bs-toggle="pill" data-bs-target="#milestones" role="tab">
                    <i class="bi bi-calendar-check fs-5 text-info"></i>
                    <div>
                        <span class="d-block fw-bold">Milestones</span>
                        <small class="text-muted">Timeline & roadmaps</small>
                    </div>
                </button>
                <button class="list-group-item list-group-item-action py-3 d-flex align-items-center gap-3" data-bs-toggle="pill" data-bs-target="#budget" role="tab">
                    <i class="bi bi-cash-coin fs-5 text-warning"></i>
                    <div>
                        <span class="d-block fw-bold">Budget</span>
                        <small class="text-muted">Financial plans & tracking</small>
                    </div>
                </button>
                <button class="list-group-item list-group-item-action py-3 d-flex align-items-center gap-3" data-bs-toggle="pill" data-bs-target="#gallery" role="tab">
                    <i class="bi bi-images fs-5 text-secondary"></i>
                    <div>
                        <span class="d-block fw-bold">Gallery</span>
                        <small class="text-muted">Photos & visualizations</small>
                    </div>
                </button>
                <button class="list-group-item list-group-item-action py-3 d-flex align-items-center gap-3" data-bs-toggle="pill" data-bs-target="#documents" role="tab">
                    <i class="bi bi-file-text fs-5 text-dark"></i>
                    <div>
                        <span class="d-block fw-bold">Documents</span>
                        <small class="text-muted">Official papers & resources</small>
                    </div>
                </button>
                @if($project->stage == 'ongoing' || $project->stage == 'completed')
                <button class="list-group-item list-group-item-action py-3 d-flex align-items-center gap-3" data-bs-toggle="pill" data-bs-target="#execution" role="tab">
                    <i class="bi bi-activity fs-5 text-danger"></i>
                    <div>
                        <span class="d-block fw-bold">{{ $project->stage == 'completed' ? 'Complete Overview' : 'Execution' }}</span>
                        <small class="text-muted">{{ $project->stage == 'completed' ? 'Final Report & Outcomes' : 'Live updates & challenges' }}</small>
                    </div>
                </button>
                @endif
                <button class="list-group-item list-group-item-action py-3 d-flex align-items-center gap-3" data-bs-toggle="pill" data-bs-target="#resources" role="tab">
                    <i class="bi bi-shield-check fs-5 text-purple" style="color: #6f42c1;"></i>
                    <div>
                        <span class="d-block fw-bold">Resources & Risks</span>
                        <small class="text-muted">Requirements & mitigation</small>
                    </div>
                </button>
                <button class="list-group-item list-group-item-action py-3 d-flex align-items-center gap-3" data-bs-toggle="pill" data-bs-target="#feedback" role="tab">
                    <i class="bi bi-chat-heart fs-5" style="color: #20c997;"></i>
                    <div>
                        <span class="d-block fw-bold">Feedback <span class="badge bg-primary">{{ $surveys->count() }}</span></span>
                        <small class="text-muted">Survey responses & insights</small>
                    </div>
                </button>
            </div>
        </div>
    </div>

    <!-- Tab Content -->
    <div class="tab-content" id="projectTabContent">
        <!-- Pathway Tab -->
        @if($project->learningPathway)
        <div class="tab-pane fade" id="pathway" role="tabpanel">
            @include('web.partials.project-pathway', ['learningPathway' => $project->learningPathway])
        </div>
        @endif

        <!-- Overview Tab -->
        <div class="tab-pane fade show active" id="overview" role="tabpanel">
            <div class="row g-4">
                <!-- Left Column -->
                <div class="col-lg-8">
                    <!-- Description Card -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h4 class="mb-4 fw-bold">Project Overview</h4>

                            @if($project->short_description)
                            <div class="alert alert-primary bg-primary-subtle border-0 mb-4">
                                <div class="d-flex">
                                    <i class="bi bi-quote fs-3 text-primary me-3"></i>
                                    <div>
                                        <h5 class="alert-heading fw-bold">About Project</h5>
                                        <p class="mb-0">{{ $project->short_description }}</p>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="project-description mb-4">
                                {!! $project->description !!}
                            </div>

                            <!-- Objectives -->
                            @if(!empty($project->objectives))
                            <div class="mb-5">
                                <h5 class="fw-bold mb-3 text-primary">
                                    <i class="bi bi-bullseye me-2"></i>Objectives
                                </h5>
                                <div class="row g-3">
                                    @foreach($project->objectives as $objective)
                                    <div class="col-md-6">
                                        <div class="card border-start border-1 m-1 border-primary h-100">
                                            <div class="card-body">
                                                <div class="d-flex align-items-start">
                                                    <i class="bi bi-check-circle-fill text-primary me-2 mt-1"></i>
                                                    <div>
                                                        {{ is_array($objective) ? ($objective['text'] ?? '') : $objective }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <!-- Reports -->
                            @if($project->baseline_survey || $project->sustainability_plan)
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-header bg-white border-0 py-3">
                                    <h5 class="card-title mb-0 fw-bold">Baseline Survey & Sustainability Plan</h5>
                                </div>
                      <div class="card-body">
    @if($project->baseline_survey)
    <div class="mb-4">
        <h6 class="fw-bold mb-2">Baseline Survey</h6>
        <div class="read-more-container">
            <p class="text-muted small mb-0" id="baseline-preview">
                {{ Str::limit($project->baseline_survey, 120) }}
            </p>
            @if(strlen($project->baseline_survey) > 120)
                <p class="text-muted small mb-0 d-none" id="baseline-full">
                    {{ $project->baseline_survey }}
                </p>
                <button type="button" class="btn btn-link btn-sm p-0 text-primary read-more-btn"
                        data-preview="baseline-preview" data-full="baseline-full">
                    Read more...
                </button>
            @endif
        </div>
    </div>
    @endif

    @if($project->sustainability_plan)
    <div class="mb-4">
        <h6 class="fw-bold mb-2">Sustainability Plan</h6>
        <div class="read-more-container">
            <p class="text-muted small mb-0" id="sustainability-preview">
                {{ Str::limit($project->sustainability_plan, 120) }}
            </p>
            @if(strlen($project->sustainability_plan) > 120)
                <p class="text-muted small mb-0 d-none" id="sustainability-full">
                    {{ $project->sustainability_plan }}
                </p>
                <button type="button" class="btn btn-link btn-sm p-0 text-primary read-more-btn"
                        data-preview="sustainability-preview" data-full="sustainability-full">
                    Read more...
                </button>
            @endif
        </div>
    </div>
    @endif

    @if($project->scalability_notes)
    <div>
        <h6 class="fw-bold mb-2">Scalability Plan</h6>
        <div class="read-more-container">
            <p class="text-muted small mb-0" id="scalability-preview">
                {{ Str::limit($project->scalability_notes, 120) }}
            </p>
            @if(strlen($project->scalability_notes) > 120)
                <p class="text-muted small mb-0 d-none" id="scalability-full">
                    {{ $project->scalability_notes }}
                </p>
                <button type="button" class="btn btn-link btn-sm p-0 text-primary read-more-btn"
                        data-preview="scalability-preview" data-full="scalability-full">
                    Read more...
                </button>
            @endif
        </div>
    </div>
    @endif
</div>
                            </div>
                            @endif
                            <!-- Problem & Solution Cards -->
                            @if($project->problem_statement || $project->expected_outcomes || $project->scalability_notes)
                            <div class="row g-3 mb-5">
                                @if($project->problem_statement)
                                <div class="col-md-6">
                                    <div class="card border-0 bg-danger bg-opacity-10 h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="bg-danger bg-opacity-25 rounded-circle p-2 me-3">
                                                    <i class="bi bi-exclamation-triangle text-danger"></i>
                                                </div>
                                                <h5 class="card-title mb-0 text-danger">Problem Statement</h5>
                                            </div>
                                            <p class="card-text">{{ $project->problem_statement }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @if($project->expected_outcomes)
                                <div class="col-md-6">
                                    <div class="card border-0 bg-success bg-opacity-10 h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="bg-success bg-opacity-25 rounded-circle p-2 me-3">
                                                    <i class="bi bi-lightbulb text-success"></i>
                                                </div>
                                                <h5 class="card-title mb-0 text-success">Expected Outcomes</h5>
                                            </div>
                                            <p class="card-text">{{ $project->expected_outcomes }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            @endif

                            <!-- Impact Image -->
                            @if($project->impact_image)
                            <div class="mb-5">
                                <h5 class="fw-bold mb-3">Proposed Impact Visualization</h5>
                                <div class="card border-0 overflow-hidden shadow-lg">
                                    <img src="{{ asset($project->impact_image) }}"
                                         alt="Impact Visual"
                                         class="img-fluid w-100"
                                         style="height: 300px; object-fit: cover;">
                                </div>
                            </div>
                            @endif

                            <!-- Target Groups -->
                            @php
                                // Safely decode target_groups
                                $targetGroups = [];

                                if (isset($project->target_groups)) {
                                    if (is_array($project->target_groups)) {
                                        $targetGroups = $project->target_groups;
                                    } elseif (is_string($project->target_groups)) {
                                        $decoded = json_decode($project->target_groups, true);
                                        $targetGroups = is_array($decoded) ? $decoded : [];
                                    }
                                }
                            @endphp

                            @if(count($targetGroups) > 0)
                            <div class="mb-5">
                                <h5 class="fw-bold mb-3">Beneficiaries</h5>
                                <div class="row g-3">
                                    @foreach($targetGroups as $group)
                                    <div class="col-6 col-md-3">
                                        <div class="card border-0 text-center h-100 hover-lift">
                                            <div class="card-body py-4">
                                                @switch($group['group'] ?? '')
                                                    @case('students')
                                                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 mb-3 mx-auto" style="width: 70px; height: 70px;">
                                                            <i class="bi bi-person fs-2 text-white"></i>
                                                        </div>
                                                        @break
                                                    @case('youth')
                                                        <div class="bg-success bg-opacity-10 rounded-circle p-3 mb-3 mx-auto" style="width: 70px; height: 70px;">
                                                            <i class="bi bi-person-standing fs-2 text-success"></i>
                                                        </div>
                                                        @break
                                                    @case('women')
                                                        <div class="bg-danger bg-opacity-10 rounded-circle p-3 mb-3 mx-auto" style="width: 70px; height: 70px;">
                                                            <i class="bi bi-gender-female fs-2 text-danger"></i>
                                                        </div>
                                                        @break
                                                    @case('schools')
                                                        <div class="bg-warning bg-opacity-10 rounded-circle p-3 mb-3 mx-auto" style="width: 70px; height: 70px;">
                                                            <i class="bi bi-building fs-2 text-warning"></i>
                                                        </div>
                                                        @break
                                                    @default
                                                        <div class="bg-secondary bg-opacity-10 rounded-circle p-3 mb-3 mx-auto" style="width: 70px; height: 70px;">
                                                            <i class="bi bi-person-circle fs-2 text-secondary"></i>
                                                        </div>
                                                @endswitch
                                                <h6 class="card-title fw-bold">{{ ucfirst($group['group'] ?? 'Unknown') }}</h6>
                                                <h3 class="fw-bold text-primary">{{ $group['count'] ?? 0 }}</h3>
                                                @if(isset($group['notes']) && !empty($group['notes']))
                                                <small class="text-muted">{{ $group['notes'] }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <!-- Donut Metrics -->
                            @if(!empty($project->donut_metrics))
                            <div class="mb-5">
                                <h5 class="fw-bold mb-4">Metrics</h5>
                                <div class="row g-4">
                                    @foreach((array) $project->donut_metrics as $metric)
                                    <div class="col-md-4">
                                        <div class="card border-0 shadow-sm h-100">
                                            <div class="card-body text-center p-4">
                                                <div class="position-relative d-inline-block mb-3">
                                                    <svg width="100" height="100" viewBox="0 0 36 36" class="circular-chart primary">
                                                        <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#e6e6e6" stroke-width="3"/>
                                                        <path class="circle" stroke-dasharray="{{ $metric['value'] ?? 0 }}, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#4e73df" stroke-width="3" stroke-linecap="round"/>
                                                        <text x="18" y="22" class="percentage" fill="#4e73df" font-size="8" text-anchor="middle" font-weight="bold">{{ $metric['value'] ?? 0 }}%</text>
                                                    </svg>
                                                </div>
                                                <h6 class="fw-bold mb-2">{{ $metric['label'] ?? 'Metric' }}</h6>
                                                <p class="text-muted small mb-0">{{ $metric['value'] ?? '' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right Column - Sidebar -->
                <div class="col-lg-4">
                    <div class="sticky-top" style="top: 20px;">
                        <!-- Quick Stats -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-primary bg-opacity-10 border-0 py-3">
                                <h5 class="card-title mb-0 fw-bold text-white">
                                    <i class="bi bi-speedometer2 me-2"></i>Quick Stats
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-calendar-check text-primary me-2"></i>
                                            <span>Start Date</span>
                                        </div>
                                        <strong>{{ $project->planned_start_date ? date('d M Y', strtotime($project->planned_start_date)) : 'TBA' }}</strong>
                                    </div>

                                    @if($project->planned_end_date)
                                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-calendar-x text-primary me-2"></i>
                                            <span>Planned End</span>
                                        </div>
                                        <strong>{{ date('d M Y', strtotime($project->planned_end_date)) }}</strong>
                                    </div>
                                    @endif

                                    @if($project->actual_start_date)
                                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-play-circle text-success me-2"></i>
                                            <span>Actual Start</span>
                                        </div>
                                        <strong>{{ date('d M Y', strtotime($project->actual_start_date)) }}</strong>
                                    </div>
                                    @endif

                                    @if($project->actual_end_date)
                                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-stop-circle text-danger me-2"></i>
                                            <span>Actual End</span>
                                        </div>
                                        <strong>{{ date('d M Y', strtotime($project->actual_end_date)) }}</strong>
                                    </div>
                                    @endif

                                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-people text-primary me-2"></i>
                                            <span>Stakeholders</span>
                                        </div>
                                        <strong>{{ $stakeholders->count() ?? 0 }}</strong>
                                    </div>

                                    @if(isset($estimation))
                                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-cash-stack text-primary me-2"></i>
                                            <span>Total Budget</span>
                                        </div>
                                        <strong>₹ {{ number_format($estimation->total_amount) }}</strong>
                                    </div>
                                    @endif

                                    @if($project->show_map_preview && $project->gps_coordinates)
                                    <div class="list-group-item border-0 px-0 pt-3 pb-0">
                                        <button class="btn btn-outline-primary w-100" onclick="showMap('{{ $project->gps_coordinates }}')">
                                            <i class="bi bi-map me-2"></i>View on Map
                                        </button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Top Supporters -->
                        @if($fundings->count() > 0)
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0 fw-bold">Top Contributors</h5>
                                <span class="badge bg-primary bg-opacity-10 text-text">Actual</span>
                            </div>
                            <div class="card-body">
                                <div class="list-group list-group-flush">
                                    @foreach($fundings->groupBy('source_type')->map(function($items) {
                                        return [
                                            'name' => $items->first()->source_type,
                                            'amount' => $items->sum('amount')
                                        ];
                                    })->sortByDesc('amount')->take(5) as $supporter)
                                    <div class="list-group-item border-0 px-0 py-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                                    <i class="bi bi-person text-white"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 fw-bold">{{ $supporter['name'] }}</h6>
                                                    <small class="text-muted text-uppercase" style="font-size: 10px;">Verified Contribution</small>
                                                </div>
                                            </div>
                                            <span class="badge bg-success bg-opacity-10 text-success border-0 py-2 px-3">
                                                ₹ {{ number_format($supporter['amount']) }}
                                            </span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @if($donors->count() > 0)
                            <div class="card-footer bg-white border-0 pt-0 pb-3 text-center">
                                <button class="btn btn-outline-primary btn-sm rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#donorsModal">
                                    <i class="bi bi-eye me-1"></i>View Pledged Donors
                                </button>
                            </div>
                            @endif
                        </div>
                        @elseif($donors->count() > 0)
                         <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-white border-0 py-3">
                                <h5 class="card-title mb-0 fw-bold">Pledged Supporters</h5>
                            </div>
                            <div class="card-body">
                                <div class="list-group list-group-flush">
                                    @foreach($donors->sortByDesc('amount')->take(5) as $donor)
                                    <div class="list-group-item border-0 px-0 py-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-0 fw-bold">{{ $donor->name }}</h6>
                                                <small class="text-muted">Pledged Amount</small>
                                            </div>
                                            <span class="badge bg-info bg-opacity-10 text-info border-0 py-2 px-3">
                                                ₹ {{ number_format($donor->amount) }}
                                            </span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="card-footer bg-white border-0 pt-0 pb-3 text-center">
                                <button class="btn btn-outline-primary btn-sm rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#donorsModal">
                                    <i class="bi bi-eye me-1"></i>View All Pledges
                                </button>
                            </div>
                        </div>
                        @else
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body text-center py-4">
                                <i class="bi bi-heart text-muted opacity-25 display-6 mb-3"></i>
                                <h6 class="text-muted">No supporters yet</h6>
                                <p class="small text-muted mb-0">Be the first to support this project!</p>
                            </div>
                        </div>
                        @endif
                        <!-- CSR Invitation -->
                        @if($project->csr_invitation)
                        <div class="card border-0 shadow-sm border-start border-3 border-success">
                            <div class="card-body">
                                <h5 class="card-title mb-3">
                                    <i class="bi bi-hand-thumbs-up text-success me-2"></i>
                                    Partner With Us
                                </h5>
                                <p class="card-text">{{ Str::limit($project->csr_invitation, 150) }}</p>
                                <button class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#contactModal">
                                    {{ $project->cta_button_text ?? 'Express Interest' }}
                                </button>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>

        <!-- Milestones Tab -->
        <div class="tab-pane fade" id="milestones" role="tabpanel">

            @if(isset($milestones) && $milestones->count() > 0)

                <!-- View Switch Tabs -->
                <ul class="nav nav-pills mb-4" id="milestoneViewTab" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="pill"
                            data-bs-target="#milestone-card-view" type="button">
                            <i class="bi bi-grid-3x3-gap me-1"></i> Card View
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="pill"
                            data-bs-target="#milestone-table-view" type="button">
                            <i class="bi bi-table me-1"></i> Table View
                        </button>
                    </li>

                     <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="pill"
                            data-bs-target="#milestone-list-view" type="button">
                            <i class="bi bi-table me-1"></i> list View
                        </button>
                    </li>
                </ul>

                <div class="tab-content">

                    <!-- ================= CARD VIEW ================= -->
                    <div class="tab-pane fade" id="milestone-card-view">

                        <div class="row g-4">
                            @foreach($milestones->sortBy('phase') as $milestone)
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body p-4">

                                        <div class="d-flex justify-content-between mb-3">
                                            <div>
                                                <span class="badge bg-primary bg-opacity-10 text-white mb-2">
                                                    {{ $milestone->phase }}
                                                </span>
                                                <h6 class="fw-bold mb-1">{{ $milestone->task_name }}</h6>
                                            </div>
                                            <span class="badge
                                                @switch($milestone->status)
                                                    @case('completed') bg-success @break
                                                    @case('in-progress') bg-warning text-dark @break
                                                    @default bg-secondary
                                                @endswitch">
                                                {{ ucfirst($milestone->status) }}
                                            </span>
                                        </div>

                                        <!-- Progress -->
                                        <div class="mb-3">
                                            <div class="progress" style="height:6px;">
                                                <div class="progress-bar
                                                    {{ $milestone->progress == 100 ? 'bg-success' : 'bg-primary' }}"
                                                    style="width: {{ $milestone->progress }}%">
                                                </div>
                                            </div>
                                            <small class="text-muted">{{ $milestone->progress }}% completed</small>
                                        </div>

                                        <!-- Dates -->
                                        <div class="d-flex justify-content-between small text-muted mb-2">
                                            <span>
                                                <i class="bi bi-calendar"></i>
                                                {{ $milestone->planned_start_date ? date('d M', strtotime($milestone->planned_start_date)) : 'TBD' }}
                                            </span>
                                            <span>
                                                <i class="bi bi-flag"></i>
                                                {{ ucfirst($milestone->priority) }}
                                            </span>
                                        </div>

                                        @if($milestone->notes)
                                        <div class="mt-3 p-2 bg-light rounded small">
                                            <i class="bi bi-sticky me-1"></i>{{ $milestone->notes }}
                                        </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                    </div>

                    <!-- ================= TABLE VIEW ================= -->
                    <div class="tab-pane fade show active" id="milestone-table-view">

                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Phase</th>
                                        <th>Task</th>
                                        <th>Status</th>
                                        <th>Progress</th>
                                        <th>Start</th>
                                        <th>End</th>
                                        <th>Priority</th>
                                        <th>In Charge</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($milestones->sortBy('phase') as $milestone)
                                    <tr>
                                        <td>
                                            <span class="badge bg-primary bg-opacity-10 text-white">
                                                {{ $milestone->phase }}
                                            </span>
                                        </td>
                                        <td class="fw-semibold">{{ $milestone->task_name }}</td>
                                        <td>
                                            <span class="badge
                                                @switch($milestone->status)
                                                    @case('completed') bg-success @break
                                                    @case('in-progress') bg-warning text-dark @break
                                                    @default bg-secondary
                                                @endswitch">
                                                {{ ucfirst($milestone->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="progress" style="height:5px;">
                                                <div class="progress-bar
                                                    {{ $milestone->progress == 100 ? 'bg-success' : 'bg-primary' }}"
                                                    style="width: {{ $milestone->progress }}%">
                                                </div>
                                            </div>
                                            <small>{{ $milestone->progress }}%</small>
                                        </td>
                                        <td>
                                            {{ $milestone->planned_start_date ? date('d M Y', strtotime($milestone->planned_start_date)) : 'TBD' }}
                                        </td>
                                        <td>
                                            {{ $milestone->planned_end_date ? date('d M Y', strtotime($milestone->planned_end_date)) : 'TBD' }}
                                        </td>
                                        <td>
                                            <span class="badge text-white
                                                @switch($milestone->priority)
                                                    @case('high') bg-danger @break
                                                    @case('urgent') bg-danger @break
                                                    @case('medium') bg-warning @break
                                                    @default bg-info
                                                @endswitch">
                                                {{ ucfirst($milestone->priority) }}
                                            </span>
                                        </td>
                                        <td>{{ $milestone->in_charge ?? '-' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>

                     <!-- ================= List VIEW ================= -->
                    <div class="tab-pane fade" id="milestone-list-view">
                        @php
                            $phasesList = ['P1', 'P2', 'P3', 'P4', 'P5', 'P6', 'P7'];

                            // Static knowledge mapping for phases
                            $phaseKnowledge = [
                                'P1' => ['title' => 'Need Assessment & Scoping', 'note' => 'Need assessment complete', 'layer' => 'Prepare'],
                                'P2' => ['title' => 'Partnerships & CSR Outreach', 'note' => 'MoUs with 2 CSR partners (in discussion)', 'layer' => 'Prepare'],
                                'P3' => ['title' => 'Procurement & Planning', 'note' => 'Procurement plan pending', 'layer' => 'Prepare'],
                                'P4' => ['title' => 'Installation & Launch', 'note' => 'Installation after funding closure', 'layer' => 'Deliver'],
                                'P5' => ['title' => 'Training & Mid Review', 'note' => 'Mid-term assessments scheduled', 'layer' => 'Deliver'],
                                'P6' => ['title' => 'Audit & External Review', 'note' => 'External audit planned', 'layer' => 'Validate'],
                                'P7' => ['title' => 'Handover & Sustainability', 'note' => 'Handover & sustainability kit.', 'layer' => 'Validate'],
                            ];

                            $phaseStatusesMap = [];
                            $foundActive = false;

                            foreach ($phasesList as $p) {
                                $pItems = $milestones->where('phase', $p);
                                if ($pItems->count() > 0) {
                                    $allDone = $pItems->where('status', '!=', 'completed')->count() === 0;
                                    if ($allDone) {
                                        $phaseStatusesMap[$p] = 'finished';
                                    } elseif (!$foundActive) {
                                        $phaseStatusesMap[$p] = 'current';
                                        $foundActive = true;
                                    } else {
                                        $phaseStatusesMap[$p] = 'pending';
                                    }
                                } else {
                                    $hasPastTasks = $milestones->where('phase', '<', $p)->where('status', '!=', 'completed')->count() == 0
                                                   && $milestones->where('phase', '<', $p)->count() > 0;
                                    $phaseStatusesMap[$p] = $hasPastTasks && !$foundActive ? 'finished' : 'pending';
                                }
                            }

                            $nextM = $milestones->where('status', '!=', 'completed')->sortBy('phase')->first();
                            $nextTaskName = $nextM ? $nextM->task_name : 'Project Completed';

                            $layers = [
                                'Prepare' => ['P1', 'P2', 'P3'],
                                'Deliver' => ['P4', 'P5'],
                                'Validate' => ['P6', 'P7']
                            ];
                        @endphp

                        <div class="container-wrapper py-4 px-3 px-md-4">

                            <!-- Phase Bar Card -->
                            <div class="phase-bar-container">
                                <div class="phase-bar-title">
                                    <i class="bi bi-diagram-3-fill"></i>
                                    Milestone (7-Phase)
                                </div>

                                <!-- Phase Bar -->
                                <div class="phase-bar">
                                    @foreach($phasesList as $p)
                                        @php
                                            $bClass = $phaseStatusesMap[$p] == 'finished' ? 'completed' : ($phaseStatusesMap[$p] == 'current' ? 'current' : 'upcoming');
                                        @endphp
                                        <div class="phase {{ $bClass }}">{{ $p }}</div>
                                    @endforeach
                                </div>

                                <!-- Layer Labels -->
                                <div class="d-flex justify-content-between small mt-2">
                                    <span class="phase-label text-prepare">
                                        <i class="bi bi-check-circle-fill me-1"></i>Prepare (P1–P3)
                                    </span>
                                    <span class="phase-label text-deliver">
                                        <i class="bi bi-send-fill me-1"></i>Deliver (P4–P5)
                                    </span>
                                    <span class="phase-label text-validate">
                                        <i class="bi bi-clipboard-check-fill me-1"></i>Validate (P6–P7)
                                    </span>
                                </div>

                                <!-- Next Step -->
                                <div class="alert alert-info mt-3 mb-0 py-2">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-arrow-right-circle-fill me-2 fs-5"></i>
                                        <div>
                                            <strong>Next Step:</strong> {{ $nextTaskName }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Phase Cards -->
                            <div class="row g-3">
                                @foreach($phasesList as $p)
                                    @php
                                        $status = $phaseStatusesMap[$p];
                                        $cardClass = $status == 'finished' ? 'phase-finished' : ($status == 'current' ? 'phase-current' : 'phase-pending');
                                        $badgeClass = 'badge-' . $status;
                                        $statusText = $status == 'current' ? 'Current phase' : ucfirst($status);

                                        $info = $phaseKnowledge[$p];
                                        $layerName = $info['layer'];
                                    @endphp
                                    <div class="col-lg-4 col-md-6">
                                        <div class="phase-card {{ $cardClass }}">
                                            <div class="phase-header">
                                                <div>
                                                    <div class="phase-number">{{ $p }}</div>
                                                    <div class="phase-title">{{ $info['title'] }}</div>
                                                </div>
                                                <span class="{{ $badgeClass }}">{{ $statusText }}</span>
                                            </div>
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="layer-badge layer-{{ strtolower($layerName) }} me-2">Layer: {{ $layerName }}</span>
                                            </div>
                                            <p class="small text-secondary mb-0">
                                                @if($status == 'finished')
                                                    <i class="bi bi-check-circle-fill text-success me-1"></i>
                                                @elseif($status == 'current')
                                                    <i class="bi bi-play-circle-fill text-warning me-1"></i>
                                                @else
                                                    <i class="bi bi-clock-history me-1"></i>
                                                @endif
                                                {{ $p }}: {{ $info['note'] }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Milestone Planner Table -->
                            <div class="table-container">
                                <div
                                    class="table-header-custom d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                                    <div class="d-flex align-items-center mb-2 mb-md-0">
                                        <i class="bi bi-list-task fs-5 me-2"></i>
                                        <h2 class="h5 mb-0">Admin · Milestone Planner</h2>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <small class="text-white-50 me-3 d-none d-md-block">Showing All – {{ $milestones->count() }} items</small>
                                        <select class="form-select form-select-sm w-auto">
                                            <option>All Phases</option>
                                            @foreach($milestones->pluck('phase')->unique()->sort() as $ph)
                                                <option>Phase {{ substr($ph, 1) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th width="10%">Phase</th>
                                                <th width="8%">Step</th>
                                                <th width="22%">Title</th>
                                                <th width="12%">Planned Date</th>
                                                <th width="15%">Owner</th>
                                                <th width="20%">Notes</th>
                                                <th width="13%">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($milestones->groupBy('phase')->sortBy(fn($val, $key) => $key) as $phaseName => $items)
                                                @php
                                                    $layerName = 'Unknown';
                                                    foreach($layers as $lname => $lphases) {
                                                        if(in_array($phaseName, $lphases)) $layerName = strtolower($lname);
                                                    }
                                                @endphp
                                                <tr class="phase-section-header {{ $layerName }}">
                                                    <td colspan="7" class="fw-bold">
                                                        <i class="bi bi-{{ substr($phaseName, 1) }}-circle-fill me-2"></i>Phase {{ substr($phaseName, 1) }} - {{ ucfirst($layerName) }}
                                                    </td>
                                                </tr>

                                                @foreach($items as $idx => $m)
                                                    @php
                                                        $mStatus = $m->status == 'completed' ? 'finished' : ($m->status == 'in-progress' ? 'current' : 'pending');
                                                    @endphp
                                                    <tr>
                                                        <td class="fw-medium">{{ $phaseName }}</td>
                                                        <td><span class="badge bg-light text-dark">{{ $idx + 1 }}/{{ $items->count() }}</span></td>
                                                        <td class="{{ $m->status == 'pending' ? 'text-muted' : '' }}">
                                                            @if($m->status == 'completed')
                                                                <i class="bi bi-check-circle-fill text-success me-1"></i>
                                                            @endif
                                                            {{ $m->task_name }}
                                                        </td>
                                                        <td>{{ $m->planned_start_date ? $m->planned_start_date->format('Y-m-d') : '—' }}</td>
                                                        <td><span class="badge bg-light text-dark">{{ $m->in_charge ?? '—' }}</span></td>
                                                        <td class="text-muted small">{{ Str::limit($m->notes, 40) ?? '—' }}</td>
                                                        <td><span class="status-{{ $mStatus }}">{{ ucfirst($mStatus) }}</span></td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Summary -->
                                <div class="summary-box m-3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="summary-item">
                                                <span><strong>Current Phase:</strong></span>
                                                <span class="badge-current">{{ collect($phaseStatusesMap)->search('current') ?: 'N/A' }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="summary-item">
                                                <span><strong>Completed Phases:</strong></span>
                                                <span class="text-success">
                                                    {{ collect($phaseStatusesMap)->filter(fn($s) => $s == 'finished')->keys()->implode(', ') ?: 'None' }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="summary-item">
                                                <span><strong>Pending Phases:</strong></span>
                                                <span class="text-danger">
                                                    {{ collect($phaseStatusesMap)->filter(fn($s) => $s == 'pending')->keys()->implode(', ') ?: 'None' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 small text-muted">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Tasks: {{ $milestones->count() }} total • {{ $milestones->where('status', 'completed')->count() }} finished • {{ $milestones->where('status', 'in-progress')->count() }} current • {{ $milestones->where('status', 'pending')->count() }} pending
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            // Add hover effect to phase bar segments
                            document.querySelectorAll('.phase').forEach(phase => {
                                phase.addEventListener('mouseenter', function () {
                                    const phaseNum = this.textContent;
                                    const tooltip = document.createElement('div');
                                    tooltip.className = 'phase-tooltip';
                                    tooltip.textContent = `Phase ${phaseNum}`;
                                    tooltip.style.position = 'absolute';
                                    tooltip.style.background = '#2c3e50';
                                    tooltip.style.color = 'white';
                                    tooltip.style.padding = '4px 8px';
                                    tooltip.style.borderRadius = '4px';
                                    tooltip.style.fontSize = '12px';
                                    tooltip.style.zIndex = '1000';
                                    tooltip.style.top = '-30px';

                                    this.style.position = 'relative';
                                    this.appendChild(tooltip);
                                });

                                phase.addEventListener('mouseleave', function () {
                                    const tooltip = this.querySelector('.phase-tooltip');
                                    if (tooltip) {
                                        tooltip.remove();
                                    }
                                });
                            });

                            // Add active state to table rows
                            document.querySelectorAll('tbody tr').forEach(row => {
                                row.addEventListener('click', function () {
                                    document.querySelectorAll('tbody tr').forEach(r => {
                                        r.classList.remove('table-active');
                                    });
                                    this.classList.add('table-active');
                                });
                            });
                        </script>
                        </div>
                </div>

            @else
                <div class="text-center py-5">
                    <i class="bi bi-calendar-x display-1 text-muted"></i>
                    <p class="text-muted mt-3">No milestones available</p>
                </div>
            @endif
            <!-- ================= ROADMAP VIEW ================= -->
            <div class="card border-0 shadow-sm mt-5 overflow-hidden rounded-4">
                <div class="card-header bg-white border-0 py-4 px-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="fw-bold mb-0 d-flex align-items-center">
                            <i class="bi bi-diagram-3-fill text-primary me-3 fs-4"></i>
                            Project Roadmap <span class="text-muted ms-2 fw-normal fs-6">(Execution Phases)</span>
                        </h5>
                        <div class="d-flex gap-2">
                            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3">P1 - P7</span>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="roadmap-wrapper p-4 p-lg-5 bg-light bg-opacity-10">
                        @php
                            // Group milestones by phase (P1, P2, ...)
                            $groupedMilestones = $milestones->groupBy('phase');

                            // Status helper for modern Roadmap
                            if (!function_exists('getPhaseStatus')) {
                                function getPhaseStatus($items) {
                                    if ($items->where('status', 'completed')->count() === $items->count()) {
                                        return 'completed';
                                    }
                                    if ($items->where('status', 'in-progress')->count() > 0) {
                                        return 'in-progress';
                                    }
                                    return 'pending';
                                }
                            }
                        @endphp

                        <div class="roadmap-track-container">
                            <div class="roadmap-track">
                                @foreach(['P1', 'P2', 'P3', 'P4', 'P5', 'P6', 'P7'] as $phase)
                                    @php
                                        $items = $groupedMilestones->get($phase) ?? collect();
                                        $status = $items->isEmpty() ? 'pending' : getPhaseStatus($items);
                                    @endphp
                                    <div class="roadmap-step {{ $status }}">
                                        <div class="roadmap-node" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $items->count() }} Milestones">
                                            {{ $phase }}
                                            @if($status == 'completed')
                                                <i class="bi bi-check-lg position-absolute top-0 start-100 translate-middle bg-success text-white rounded-circle p-1 shadow-sm" style="font-size: 0.8rem;"></i>
                                            @endif
                                        </div>
                                        <div class="roadmap-content">
                                            <h6 class="roadmap-title mb-1">{{ $items->isEmpty() ? 'Planned' : ($items->first()->task_name ?? 'Phase ' . $phase) }}</h6>
                                            <span class="roadmap-status">{{ ucfirst($status) }}</span>
                                            @if(!$items->isEmpty())
                                                <div class="mt-2">
                                                    <div class="progress" style="height: 4px; width: 40px; margin: 0 auto;">
                                                        <div class="progress-bar bg-{{ $status == 'completed' ? 'success' : ($status == 'in-progress' ? 'warning' : 'secondary') }}"
                                                             style="width: {{ $items->avg('progress') }}%"></div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @push('css')
            <style>
                .roadmap-track-container {
                    overflow-x: auto;
                    padding: 40px 0 20px;
                    scrollbar-width: thin;
                }

                .roadmap-track-container::-webkit-scrollbar {
                    height: 6px;
                }

                .roadmap-track-container::-webkit-scrollbar-thumb {
                    background: #dee2e6;
                    border-radius: 10px;
                }

                .roadmap-track {
                    display: flex;
                    justify-content: space-between;
                    min-width: 900px;
                    position: relative;
                }

                /* Background Connectors */
                .roadmap-track::before {
                    content: '';
                    position: absolute;
                    top: 30px;
                    left: 50px;
                    right: 50px;
                    height: 4px;
                    background: #f1f3f5;
                    z-index: 1;
                    border-radius: 10px;
                }

                .roadmap-step {
                    flex: 1;
                    position: relative;
                    z-index: 2;
                    text-align: center;
                }

                .roadmap-node {
                    width: 60px;
                    height: 60px;
                    background: #fff;
                    border-radius: 20px; /* Squircle shape */
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin: 0 auto 20px;
                    box-shadow: 0 8px 20px rgba(0,0,0,0.06);
                    font-weight: 800;
                    font-size: 1.1rem;
                    color: #adb5bd;
                    position: relative;
                    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
                    border: 2px solid #f8f9fa;
                }

                /* Connector Progress Enhancement */
                .roadmap-step.completed::after {
                    content: '';
                    position: absolute;
                    top: 30px;
                    left: 50%;
                    width: 100%;
                    height: 4px;
                    background: #198754;
                    z-index: -1;
                }

                .roadmap-step:last-child.completed::after {
                    display: none;
                }

                /* Status Variations */
                .roadmap-step.completed .roadmap-node {
                    background: linear-gradient(135deg, #198754 0%, #20c997 100%);
                    color: #fff;
                    box-shadow: 0 10px 20px rgba(25, 135, 84, 0.2);
                    border: none;
                }

                .roadmap-step.in-progress .roadmap-node {
                    background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
                    color: #fff;
                    box-shadow: 0 10px 20px rgba(245, 158, 11, 0.2);
                    border: none;
                    animation: roadmap-pulse 2s infinite;
                }

                .roadmap-step.completed .roadmap-title { color: #198754; }
                .roadmap-step.in-progress .roadmap-title { color: #d97706; }

                .roadmap-title {
                    font-weight: 700;
                    font-size: 0.85rem;
                    margin-bottom: 4px;
                    display: -webkit-box;
                    -webkit-line-clamp: 2;
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                    height: 2.4em;
                    padding: 0 10px;
                }

                .roadmap-status {
                    font-size: 0.7rem;
                    font-weight: 700;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                    color: #adb5bd;
                }

                .roadmap-step.completed .roadmap-status { color: #198754; opacity: 0.8; }
                .roadmap-step.in-progress .roadmap-status { color: #f59e0b; }

                @keyframes roadmap-pulse {
                    0% { transform: scale(1); box-shadow: 0 10px 20px rgba(245, 158, 11, 0.2); }
                    50% { transform: scale(1.05); box-shadow: 0 15px 30px rgba(245, 158, 11, 0.4); }
                    100% { transform: scale(1); box-shadow: 0 10px 20px rgba(245, 158, 11, 0.2); }
                }

                @media (max-width: 991px) {
                    .roadmap-track { min-width: 800px; }
                    .roadmap-node { width: 50px; height: 50px; border-radius: 15px; }
                }
            </style>
            @endpush
        </div>

        <!-- Budget Tab -->
        <div class="tab-pane fade" id="budget" role="tabpanel">
            @if(isset($estimation))
            <div class="row g-4">
                <div class="col-lg-8">
                    <!-- Cost Breakdown Card -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0 py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0 fw-bold">Cost Breakdown</h5>
                                <span class="badge bg-primary">Version {{ $estimation->version }}</span>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            @if($estimation->items->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr class="table-light">
                                            <th class="border-0 ps-4">Category</th>
                                            <th class="border-0">Item Description</th>
                                            <th class="border-0 text-end">Qty</th>
                                            <th class="border-0 text-end">Unit Cost</th>
                                            <th class="border-0 text-end">Total</th>
                                            <th class="border-0 pe-4">Phase</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($estimation->items as $item)
                                        <tr>
                                            <td class="ps-4">
                                                <span class="badge bg-light text-dark">{{ $item->category }}</span>
                                            </td>
                                            <td class="fw-medium">{{ $item->item_name }}</td>
                                            <td class="text-end">{{ $item->quantity }}</td>
                                            <td class="text-end">₹ {{ number_format($item->unit_cost) }}</td>
                                            <td class="text-end fw-bold">₹ {{ number_format($item->total_cost) }}</td>
                                            <td class="pe-4">
                                                <span class="badge bg-info bg-opacity-10 text-info">{{ $item->phase }}</span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="table-secondary">
                                        <tr>
                                            <td colspan="4" class="text-end fw-bold ps-4">Total Estimated Cost</td>
                                            <td class="text-end fw-bold pe-4">₹ {{ number_format($estimation->total_amount) }}</td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Utilization Table -->
                    @if(isset($utilizations) && $utilizations->count() > 0)
                    <div class="card border-0 shadow-sm mt-4">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="card-title mb-0 fw-bold">Actual vs Estimated Spending</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr class="table-light">
                                            <th class="border-0 ps-4">Category</th>
                                            <th class="border-0 text-end">Estimated</th>
                                            <th class="border-0 text-end">Actual Spent</th>
                                            <th class="border-0 text-center">Variance</th>
                                            {{-- <th class="border-0 pe-4">Status</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $categories = $utilizations->groupBy('category');
                                        @endphp
                                        @foreach($categories as $category => $items)
                                        @php
                                            $estimated = $items->sum('estimated_amount');
                                            $actual = $items->sum('actual_amount');
                                            $variance = $estimated > 0 ? (($actual - $estimated) / $estimated) * 100 : 0;
                                        @endphp
                                        <tr>
                                            <td class="fw-medium ps-4">{{ $category }}</td>
                                            <td class="text-end">₹ {{ number_format($estimated) }}</td>
                                            <td class="text-end">₹ {{ number_format($actual) }}</td>
                                            <td class="text-center">
                                                <span class="badge
                                                    @if($variance <= 0) bg-success bg-opacity-10 text-success
                                                    @elseif($variance <= 10) bg-warning bg-opacity-10 text-warning
                                                    @else bg-danger bg-opacity-10 text-danger
                                                    @endif border-0 py-2 px-3">
                                                    {{ number_format($variance, 1) }}%
                                                </span>
                                            </td>
                                            {{-- <td class="pe-4">
                                                @if($actual >= $estimated * 0.9)
                                                <span class="badge bg-success bg-opacity-10 text-success border-0">On Track</span>
                                                @elseif($actual >= $estimated * 0.5)
                                                <span class="badge bg-warning bg-opacity-10 text-warning border-0">Moderate</span>
                                                @else
                                                <span class="badge bg-danger bg-opacity-10 text-danger border-0">Behind</span>
                                                @endif
                                            </td> --}}
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="col-lg-4">
                    <!-- Budget Summary -->
                    <div class="sticky-top" style="top: 20px;">
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-white border-0 py-3">
                                <h5 class="card-title mb-0 fw-bold">Budget Summary</h5>
                            </div>
                            <div class="card-body">
                                <!-- Budget Chart -->
                                <div class="mb-4">
                                    <canvas id="budgetChart" height="200"></canvas>
                                </div>

                                <!-- Funding Status -->
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-3">
                                        <span>Total Budget</span>
                                        <strong class="fs-5">₹ {{ number_format($estimation->total_amount) }}</strong>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-3">
                                        <span>Funds Raised</span>
                                        <strong class="text-success">₹ {{ number_format($totalRaised ?? 0) }}</strong>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-3">
                                        <span>Funds Received</span>
                                        <strong class="text-info">₹ {{ number_format($totalReceived ?? 0) }}</strong>
                                    </div>
                                    @if(isset($utilizations))
                                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-3">
                                        <span>Amount Spent</span>
                                        <strong class="text-warning">₹ {{ number_format($utilizations->sum('actual_amount')) }}</strong>
                                    </div>
                                    @endif
                                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-3 bg-light rounded">
                                        <span>Balance Available</span>
                                        <strong class="text-primary fs-5">
                                            ₹ {{ number_format(($totalReceived ?? 0) - ($utilizations->sum('actual_amount') ?? 0)) }}
                                        </strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="bi bi-calculator display-1 text-muted opacity-25"></i>
                </div>
                <h5 class="fw-normal text-muted mb-2">Budget not estimated yet</h5>
                <p class="text-muted">Cost estimation is in progress</p>
            </div>
            @endif
        </div>

        <!-- Gallery Tab -->
        <div class="tab-pane fade" id="gallery" role="tabpanel">
            @if($project->banner_images || $project->gallery_images)
            <!-- Gallery Navigation -->
            <div class="mb-4">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-outline-primary active" onclick="filterGallery('all', event)">All</button>
                    @if($project->before_photo || $project->expected_photo)
                    <button type="button" class="btn btn-outline-primary" onclick="filterGallery('comparison', event)">Comparison</button>
                    @endif
                    @if($project->banner_images)
                    <button type="button" class="btn btn-outline-primary" onclick="filterGallery('banner', event)">Banner</button>
                    @endif
                    @if($project->gallery_images)
                    <button type="button" class="btn btn-outline-primary" onclick="filterGallery('gallery', event)">Gallery</button>
                    @endif
                </div>
            </div>

                        <!-- Before/After Comparison -->
            @if($project->before_photo || $project->expected_photo)
            <div class="gallery-section" id="comparison-section">
                <h5 class="fw-bold mb-4">Transformation Progress</h5>
                <div class="row">
                    @if($project->before_photo)
                    <div class="col-md-6 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body p-4">
                                <h6 class="card-title text-center mb-3">Before</h6>
                                <img src="{{ asset($project->before_photo) }}"
                                     alt="Before"
                                     class="img-fluid rounded"
                                     style="max-height: 300px; width: 100%; object-fit: cover;">
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($project->expected_photo)
                    <div class="col-md-6 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body p-4">
                                <h6 class="card-title text-center mb-3">Expected Outcome</h6>
                                <img src="{{ asset($project->expected_photo) }}"
                                     alt="Expected"
                                     class="img-fluid rounded"
                                     style="max-height: 300px; width: 100%; object-fit: cover;">
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif
            @else
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="bi bi-images display-1 text-muted opacity-25"></i>
                </div>
                <h5 class="fw-normal text-muted mb-2">No gallery images yet</h5>
                <p class="text-muted">Images will be added as project progresses</p>
            </div>
            @endif

            <!-- Banner Images -->
           @if(!empty($project->banner_images))
            <div class="mb-5 gallery-section" id="banner-section">
                <h5 class="fw-bold mb-4">Project Images</h5>

                <div class="row g-3">
                    <div class="col-6 col-md-4 col-lg-3">
                        <a href="{{ asset($project->banner_images) }}" data-lightbox="gallery" class="gallery-item">
                            <div class="card border-0 shadow-sm overflow-hidden">
                                <img src="{{ asset($project->banner_images) }}"
                                    alt="Project Banner"
                                    class="img-fluid"
                                    style="height: 200px; width: 100%; object-fit: cover;">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            @else
            <div class="text-center py-5">
                <i class="bi bi-images display-6 text-muted opacity-50 mb-2"></i>
                <h6 class="text-muted">No project image uploaded yet</h6>
            </div>
            @endif


            <!-- Gallery Images -->
            @if($project->gallery_images)
            <div class="mb-5 gallery-section" id="gallery-section">
                <h5 class="fw-bold mb-4">Additional Gallery</h5>
                <div class="row g-3">
                    @foreach((array)$project->gallery_images as $image)
                    <div class="col-6 col-md-4 col-lg-3">
                        <a href="{{ asset($image) }}" data-lightbox="gallery" class="gallery-item">
                            <div class="card border-0 shadow-sm overflow-hidden">
                                <img src="{{ asset($image) }}"
                                     alt="Gallery Image {{ $loop->iteration }}"
                                     class="img-fluid"
                                     style="height: 150px; width: 100%; object-fit: cover;">
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Documents Tab -->
        <div class="tab-pane fade" id="documents" role="tabpanel">
            <div class="row g-4">
                <!-- Documents Section -->
                <div class="col-lg-8">
                   @if(!empty($project->documents))
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="card-title mb-0 fw-bold">Supporting Documents</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                @foreach((array)$project->documents as $document)
                                <div class="col-md-6">
                                    <div class="card border h-100 hover-lift">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-primary bg-opacity-10 rounded p-3 me-3">
                                                    <i class="bi bi-file-earmark-text fs-2 text-white"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="card-title fw-bold mb-1">{{ $document['label'] ?? 'Document' }}</h6>
                                                    <small class="text-muted">
                                                        @if(isset($document['file']))
                                                        <a href="{{ asset($document['file']) }}"
                                                           target="_blank"
                                                           class="text-decoration-none d-flex align-items-center">
                                                            <i class="bi bi-download me-1"></i>Download File
                                                        </a>
                                                        @endif
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <div class="mb-3">
                            <i class="bi bi-file-earmark-text display-6 text-muted opacity-50"></i>
                        </div>
                        <h6 class="text-muted mb-1">No documents uploaded yet</h6>
                        <p class="small text-muted">Documents will appear here when added</p>
                    </div>
                    @endif

                    @if(!empty($project->links))
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="card-title mb-0 fw-bold">External Links & Resources</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                @foreach($project->links as $link)
                                <a href="{{ $link['url'] }}"
                                   target="_blank"
                                   class="list-group-item list-group-item-action border-0 py-3 px-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 fw-bold">{{ $link['label'] ?? 'External Link' }}</h6>
                                            <small class="text-muted text-truncate d-block">{{ $link['url'] }}</small>
                                        </div>
                                        <i class="bi bi-box-arrow-up-right text-primary"></i>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <div class="mb-3">
                            <i class="bi bi-file-earmark-text display-6 text-muted opacity-50"></i>
                        </div>
                        <h6 class="text-muted mb-1">No Link uploaded yet</h6>
                        <p class="small text-muted">Link will appear here when added</p>
                    </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="sticky-top" style="top: 20px;">
                        <!-- Share Project -->
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white border-0 py-3">
                                <h5 class="card-title mb-0 fw-bold">Share This Project</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <button class="btn btn-outline-primary btn-sm flex-grow-1"
                                            onclick="shareProject('facebook', '{{ url()->current() }}', '{{ $project->title }}')">
                                        <i class="bi bi-facebook me-1"></i>Facebook
                                    </button>
                                    <button class="btn btn-outline-info btn-sm flex-grow-1"
                                            onclick="shareProject('twitter', '{{ url()->current() }}', '{{ $project->title }}')">
                                        <i class="bi bi-twitter-x me-1"></i>Twitter
                                    </button>
                                    <button class="btn btn-outline-success btn-sm flex-grow-1"
                                            onclick="shareProject('whatsapp', '{{ url()->current() }}', '{{ $project->title }}')">
                                        <i class="bi bi-whatsapp me-1"></i>WhatsApp
                                    </button>
                                    <button class="btn btn-outline-primary btn-sm flex-grow-1"
                                            onclick="shareProject('linkedin', '{{ url()->current() }}', '{{ $project->title }}')">
                                        <i class="bi bi-linkedin me-1"></i>LinkedIn
                                    </button>
                                </div>
                                <div class="input-group">
                                    <input type="text"
                                           class="form-control form-control-sm"
                                           value="{{ url()->current() }}"
                                           readonly>
                                    <button class="btn btn-outline-secondary btn-sm"
                                            onclick="copyToClipboard('{{ url()->current() }}', this)">
                                        <i class="bi bi-clipboard"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Execution Update Tab -->
        @if($project->stage == 'ongoing' || $project->stage == 'completed')
        <div class="tab-pane fade" id="execution" role="tabpanel">
            @php
                // --- Dynamic Data Calculation ---
                $phases = ['P1', 'P2', 'P3', 'P4', 'P5', 'P6', 'P7'];
                $phaseProgress = [];
                $currentPhase = 'P1';
                $currentPhaseTitle = 'Need Assessment';
                $completedPhasesCount = 0;

                foreach($phases as $p) {
                    $pMs = $milestones->where('phase', $p);
                    if($pMs->count() > 0) {
                        $avg = $pMs->avg('progress') ?? 0;
                        $phaseProgress[] = round($avg);
                        if ($avg == 100) {
                            $completedPhasesCount++;
                        } elseif ($avg > 0 && $avg < 100) {
                            $currentPhase = $p;
                            // Map P code to Title roughly based on earlier arrays or milestone data
                            $firstM = $pMs->first();
                            $currentPhaseTitle = $firstM ? $firstM->phase : $p;
                        }
                    } else {
                        $phaseProgress[] = 0;
                    }
                }

                // Risk Calculation
                $riskScore = 0;
                $risks = $project->risks ?? [];
                $riskBreakdown = ['Infrastructure' => 0, 'Vendor' => 0, 'Schedule' => 0, 'Adoption' => 0, 'Resources' => 0, 'Compliance' => 0];

                if(is_array($risks)) {
                    foreach($risks as $r) {
                        $impact = strtolower($r['impact'] ?? 'low');
                        $val = ($impact == 'high') ? 30 : (($impact == 'medium') ? 20 : 10);
                        $riskScore += ($impact == 'high') ? 3 : (($impact == 'medium') ? 2 : 1);

                        // Try to categorize (very rough)
                        $desc = strtolower($r['risk'] ?? '');
                        if(str_contains($desc, 'infra')) $riskBreakdown['Infrastructure'] += $val;
                        elseif(str_contains($desc, 'vendor') || str_contains($desc, 'supplier')) $riskBreakdown['Vendor'] += $val;
                        elseif(str_contains($desc, 'time') || str_contains($desc, 'delay') || str_contains($desc, 'schedule')) $riskBreakdown['Schedule'] += $val;
                        elseif(str_contains($desc, 'adopt') || str_contains($desc, 'community')) $riskBreakdown['Adoption'] += $val;
                        elseif(str_contains($desc, 'resource') || str_contains($desc, 'fund')) $riskBreakdown['Resources'] += $val;
                        else $riskBreakdown['Compliance'] += $val; // Default bucket
                    }
                }
                // Normalizing risk breakdown to 0-100 for chart
                foreach($riskBreakdown as $k => $v) {
                    $riskBreakdown[$k] = min($v, 100);
                }

                $riskLevel = $riskScore > 10 ? 'High' : ($riskScore > 5 ? 'Medium' : 'Low');
                $riskColorText = $riskScore > 10 ? 'text-danger' : ($riskScore > 5 ? 'text-warning' : 'text-success');
                $riskColorBg = $riskScore > 10 ? 'bg-danger' : ($riskScore > 5 ? 'bg-warning' : 'bg-success');
                $riskLabel = $riskScore > 10 ? 'High Risk' : ($riskScore > 5 ? 'Medium Risk' : 'Low Risk');

                // Pipeline Counts (Approximation)
                $pipeIdentified = $milestones->count();
                $pipeAssessed = $milestones->whereIn('phase', ['P1', 'P2'])->where('status', 'completed')->count();
                $pipeApproved = $milestones->where('phase', 'P3')->where('status', 'completed')->count();
                $pipeInstalled = $milestones->whereIn('phase', ['P4', 'P5'])->where('status', 'completed')->count();
                $pipeInUse = $milestones->where('phase', 'P6')->where('status', 'completed')->count();
                $pipeReviewed = $milestones->where('phase', 'P7')->where('status', 'completed')->count();

                // Active Installations (Ongoing in P4/P5)
                $installationsInProgress = $milestones->whereIn('phase', ['P4', 'P5'])->where('status', 'in-progress')->count();

            @endphp

            <style>
            /* ==================================================
               ISICO EXECUTION STANDARD – ENHANCED DESIGN
               GREEN THEME | Govt / CSR Monitoring Grade
               ================================================== */

            .execution-dashboard {
                --isico-primary:#1a6b44;
                --isico-primary-light:#2a8a5c;
                --isico-accent:#2fa36a;
                --isico-bg:#f8fcf9;
                --isico-panel:#ffffff;
                --isico-border:#d9ece1;
                --isico-text:#1a2d21;
                --isico-muted:#5a7a67;
                --isico-good:#1a6b44;
                --isico-medium:#e9b213;
                --isico-low-risk:#d1f7e5;
                --isico-mod-risk:#fff3cd;
                --isico-card-shadow:0 4px 12px rgba(26, 107, 68, 0.08);
                --isico-card-hover:0 8px 24px rgba(26, 107, 68, 0.12);

                /* ISICO 7-PHASE VIBGYOR STANDARD */
                --p1:#8e44ad;
                --p2:#3f51b5;
                --p3:#1e88e5;
                --p4:#2ecc71;
                --p5:#f1c40f;
                --p6:#e67e22;
                --p7:#e53935;

                background:var(--isico-bg);
                font-family:'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
                color:var(--isico-text);
                line-height:1.5;
                border-radius: 12px;
                overflow: hidden;
            }

            /* Enhanced Header */
            .execution-dashboard .exec-header {
                background:linear-gradient(135deg, var(--isico-primary), var(--isico-accent));
                color:#fff;
                padding:1rem 1.5rem;
                box-shadow:0 2px 8px rgba(0,0,0,0.1);
                position:relative;
                overflow:hidden;
            }

            .execution-dashboard .exec-header::before{
                content:'';
                position:absolute;
                top:0;
                right:0;
                width:200px;
                height:200px;
                background:radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
                background-size:20px 20px;
                opacity:0.3;
            }

            /* Enhanced Cards */
            .execution-dashboard .enhanced-panel{
                background:var(--isico-panel);
                border:1px solid var(--isico-border);
                border-radius:12px;
                padding:1.5rem;
                margin-bottom:1.5rem;
                box-shadow:var(--isico-card-shadow);
                transition:transform 0.2s ease, box-shadow 0.2s ease;
            }

            .execution-dashboard .enhanced-panel:hover{
                transform:translateY(-2px);
                box-shadow:var(--isico-card-hover);
            }

            .execution-dashboard .panel-title{
                font-size:0.95rem;
                font-weight:700;
                color:var(--isico-primary);
                border-bottom:2px solid var(--isico-border);
                padding-bottom:0.75rem;
                margin-bottom:1.25rem;
                display:flex;
                align-items:center;
                gap:0.5rem;
            }

            .execution-dashboard .panel-title i{
                font-size:1.1rem;
            }

            /* Enhanced KPI Cards */
            .execution-dashboard .kpi-card{
                background:var(--isico-panel);
                border:1px solid var(--isico-border);
                border-radius:12px;
                padding:1.25rem;
                text-align:center;
                transition:all 0.3s ease;
                position:relative;
                overflow:hidden;
                height: 100%;
            }

            .execution-dashboard .kpi-card:hover{
                transform:translateY(-4px);
                box-shadow:var(--isico-card-hover);
            }

            .execution-dashboard .kpi-card::before{
                content:'';
                position:absolute;
                top:0;
                left:0;
                width:100%;
                height:4px;
                background:linear-gradient(90deg, var(--isico-primary), var(--isico-accent));
            }

            .execution-dashboard .kpi-label{
                font-size:0.8rem;
                text-transform:uppercase;
                color:var(--isico-muted);
                font-weight:600;
                letter-spacing:0.5px;
                margin-bottom:0.5rem;
            }

            .execution-dashboard .kpi-value{
                font-size:2.5rem;
                font-weight:800;
                margin:0.5rem 0;
                color:var(--isico-primary);
                line-height:1;
            }

            .execution-dashboard .kpi-trend{
                font-size:0.85rem;
                font-weight:600;
            }

            .execution-dashboard .kpi-grid {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 1rem;
            }

            /* Pipeline Enhancement */
            .execution-dashboard .pipeline{
                display:grid;
                grid-template-columns:repeat(6, 1fr);
                gap:0.5rem;
                margin-top:1rem;
            }

            .execution-dashboard .pipe-stage{
                background:#f0f9f4;
                border:2px solid var(--isico-border);
                border-radius:8px;
                text-align:center;
                padding:1rem 0.5rem;
                transition:all 0.3s ease;
                position:relative;
            }

            .execution-dashboard .pipe-stage:hover{
                background:#e6f5ed;
                border-color:var(--isico-primary-light);
            }

            .execution-dashboard .pipe-stage.current{
                background:var(--isico-primary);
                color:#fff;
                border-color:var(--isico-primary);
                transform:scale(1.05);
                box-shadow:0 4px 12px rgba(26, 107, 68, 0.2);
            }

            .execution-dashboard .pipe-stage.current::after{
                content:'';
                position:absolute;
                bottom:-8px;
                left:50%;
                transform:translateX(-50%);
                width:0;
                height:0;
                border-left:6px solid transparent;
                border-right:6px solid transparent;
                border-top:6px solid var(--isico-primary);
            }

            .execution-dashboard .pipe-count{
                display:block;
                font-size:1.5rem;
                font-weight:800;
                margin-bottom:0.25rem;
            }

            .execution-dashboard .pipe-label{
                font-size:0.85rem;
                font-weight:600;
            }

            /* Progress Bars */
            .execution-dashboard .custom-progress{
                height:8px;
                border-radius:4px;
                background-color:#f0f0f0;
                overflow:hidden;
            }

            .execution-dashboard .custom-progress-bar{
                height:100%;
                border-radius:4px;
                background:linear-gradient(90deg, var(--isico-primary), var(--isico-accent));
                transition:width 0.6s ease;
            }

            /* Risk Badges */
            .execution-dashboard .risk-badge{
                font-size:0.75rem;
                padding:0.25rem 0.75rem;
                border-radius:20px;
                font-weight:600;
            }

            /* Confidence Gauge */
            .execution-dashboard .confidence-gauge{
                width:140px;
                height:140px;
                position:relative;
            }

            .execution-dashboard .gauge-bg{
                width:100%;
                height:100%;
                border-radius:50%;
                /* Dynamic gauge background logic can be inline driven */
                position:relative;
            }

            .execution-dashboard .gauge-inner{
                position:absolute;
                top:50%;
                left:50%;
                transform:translate(-50%, -50%);
                width:100px;
                height:100px;
                border-radius:50%;
                background:#fff;
                display:flex;
                flex-direction:column;
                align-items:center;
                justify-content:center;
                box-shadow:0 4px 12px rgba(0,0,0,0.1);
            }

            /* Summary Card */
            .execution-dashboard .summary-card{
                background:linear-gradient(135deg, #f0f9f4, #e6f5ed);
                border:1px solid var(--isico-border);
                border-radius:12px;
                padding:1.25rem;
                margin-top:1.5rem;
                border-left:4px solid var(--isico-primary);
            }

            /* Responsive Grid */
            @media (max-width: 768px){
                .execution-dashboard .kpi-grid{
                    grid-template-columns:repeat(2, 1fr);
                    gap:1rem;
                }

                .execution-dashboard .pipeline{
                    grid-template-columns:repeat(3, 1fr);
                    gap:0.5rem;
                }

                .execution-dashboard .pipe-stage{
                    padding:0.75rem 0.25rem;
                }
            }

            @media (max-width: 576px){
                .execution-dashboard .kpi-grid{
                    grid-template-columns:1fr;
                }

                .execution-dashboard .pipeline{
                    grid-template-columns:repeat(2, 1fr);
                }
            }
            </style>

            <div class="execution-dashboard">

                <div class="exec-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-3">
                        <div style="width:40px;height:40px;background:#fff;border-radius:8px;display:flex;align-items:center;justify-content:center;z-index: 1;">
                            <i class="bi bi-speedometer2" style="color:var(--isico-primary);font-size:1.5rem;"></i>
                        </div>
                        <div style="z-index: 1;">
                            <h1 class="h5 mb-0 fw-bold text-white">Execution – Live Monitoring Dashboard</h1>
                            <div class="text-white-50" style="font-size:0.85rem;">Real-time project tracking & analytics</div>
                        </div>
                    </div>
                    <div class="text-end" style="z-index: 1;">
                        <div class="text-white-50" style="font-size:0.85rem;">Data Source: ISICO Field Teams</div>
                        <div class="badge bg-white text-primary fw-normal" style="font-size:0.8rem;">
                            <i class="bi bi-clock me-1"></i>Last Updated: <span id="lastUpdated">{{ $project->updated_at->format('d M Y, h:i A') }}</span>
                        </div>
                    </div>
                </div>

                <div class="container-fluid p-3 p-md-4">

                    <!-- Current Phase Banner -->
                    <div class="alert alert-success d-flex justify-content-between align-items-center mb-4 icon-link-hover">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-gear-fill fs-5"></i>
                            <div>
                                <strong>Current Focus Phase:</strong> {{ $currentPhase }} – {{ $currentPhaseTitle }}
                                <div class="text-muted" style="font-size:0.85rem;">
                                    {{ $completedPhasesCount }} phases completed, {{ $installationsInProgress > 0 ? $installationsInProgress . ' active tasks' : 'Transitioning' }}
                                </div>
                            </div>
                        </div>
                        <div class="badge bg-white text-success fs-6 px-3 py-2">
                            <i class="bi bi-lightning-charge-fill me-2"></i>Active Execution
                        </div>
                    </div>

                    <!-- Enhanced KPI Grid -->
                    <div class="kpi-grid mb-4">
                        <div class="kpi-card">
                            <div class="kpi-label"><i class="bi bi-heart-pulse me-1"></i>Execution Health</div>
                            <div class="kpi-value text-success">{{ $project->completion_readiness ?? 85 }}</div> <!-- Placeholder or readiness -->
                            <div class="kpi-trend text-success d-flex align-items-center justify-content-center gap-1">
                                <i class="bi bi-arrow-up-circle-fill"></i> Good
                            </div>
                            <div class="text-muted mt-2" style="font-size:0.75rem;">Composite score based on milestones</div>
                        </div>

                        <div class="kpi-card">
                            <div class="kpi-label"><i class="bi bi-clipboard-check me-1"></i>Project Progress</div>
                            <div class="kpi-value">{{ $project->project_progress ?? 0 }}%</div>
                            <div class="progress mt-2 custom-progress">
                                <div class="custom-progress-bar" style="width:{{ $project->project_progress ?? 0 }}%"></div>
                            </div>
                            <div class="text-muted mt-2" style="font-size:0.75rem;">Overall completion</div>
                        </div>

                        <div class="kpi-card">
                            <div class="kpi-label"><i class="bi bi-people-fill me-1"></i>Beneficiaries Reached</div>
                            <div class="kpi-value">{{ number_format($project->actual_beneficiary_count ?? 0) }}</div>
                            <div class="kpi-trend text-success d-flex align-items-center justify-content-center gap-1">
                                <i class="bi bi-graph-up-arrow"></i> Active
                            </div>
                            <div class="text-muted mt-2" style="font-size:0.75rem;">Total individuals reached</div>
                        </div>

                        <div class="kpi-card">
                            <div class="kpi-label"><i class="bi bi-shield-exclamation me-1"></i>Delivery Risk</div>
                            <div class="kpi-value {{ $riskColorText }}">{{ $riskLabel }}</div>
                            <div class="mt-2 text-wrap">

                                @foreach(array_keys(array_filter($riskBreakdown, function($v){ return $v > 0; })) as $rKey)
                                 @if($loop->iteration <= 2)
                                    <span class="risk-badge {{ $riskColorBg }} text-white d-inline-block mb-1">{{ $rKey }}</span>
                                 @endif
                                @endforeach
                                @if(count(array_filter($riskBreakdown, function($v){ return $v > 0; })) == 0)
                                    <span class="risk-badge bg-success text-white">None</span>
                                @endif
                            </div>
                            <div class="text-muted mt-2" style="font-size:0.75rem;">Risk level monitoring</div>
                        </div>
                    </div>

                    <!-- Execution Pipeline -->
                    <div class="enhanced-panel">
                        <div class="panel-title">
                            <i class="bi bi-diagram-3"></i>
                            Execution Pipeline
                        </div>
                        <div class="pipeline">
                            <div class="pipe-stage {{ $currentPhase == 'P1' ? 'current' : '' }}">
                                <span class="pipe-count">{{ $pipeIdentified }}</span>
                                <span class="pipe-label">Identified</span>
                            </div>
                            <div class="pipe-stage {{ $currentPhase == 'P2' ? 'current' : '' }}">
                                <span class="pipe-count">{{ $pipeAssessed }}</span>
                                <span class="pipe-label">Assessed</span>
                            </div>
                            <div class="pipe-stage {{ $currentPhase == 'P3' ? 'current' : '' }}">
                                <span class="pipe-count">{{ $pipeApproved }}</span>
                                <span class="pipe-label">Approved</span>
                            </div>
                            <div class="pipe-stage {{ ($currentPhase == 'P4' || $currentPhase == 'P5') ? 'current' : '' }}">
                                <span class="pipe-count">{{ $pipeInstalled }}</span>
                                <span class="pipe-label">Installed</span>
                            </div>
                            <div class="pipe-stage {{ $currentPhase == 'P6' ? 'current' : '' }}">
                                <span class="pipe-count">{{ $pipeInUse }}</span>
                                <span class="pipe-label">In Use</span>
                            </div>
                            <div class="pipe-stage {{ $currentPhase == 'P7' ? 'current' : '' }}">
                                <span class="pipe-count">{{ $pipeReviewed }}</span>
                                <span class="pipe-label">Reviewed</span>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Row -->
                    <div class="row g-3 mb-4">
                        <!-- Live Execution Monitor -->
                        <div class="col-lg-8">
                            <div class="enhanced-panel h-100">
                                <div class="panel-title">
                                    <i class="bi bi-activity"></i>
                                    Live Execution Monitor – Phase-wise Progress
                                </div>
                                <div class="row align-items-center mb-3">
                                    <div class="col-md-6">
                                        <div class="d-flex flex-wrap gap-2 align-items-center">
                                            <div class="d-flex align-items-center gap-1">
                                                <span class="badge" style="background:var(--p4);">●</span>
                                                <small>Completed</small>
                                            </div>
                                            <div class="d-flex align-items-center gap-1">
                                                <span class="badge" style="background:var(--p5);">◐</span>
                                                <small>In Progress</small>
                                            </div>
                                            <div class="d-flex align-items-center gap-1">
                                                <span class="badge bg-light text-dark">○</span>
                                                <small>Pending</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <small class="text-muted">Phase colors fixed across all ISICO projects</small>
                                    </div>
                                </div>
                                <div class="chart-container" style="position: relative; height:300px; width:100%">
                                    <canvas id="milestoneLiveChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Beneficiary Overview -->
                        <div class="col-lg-4">
                            <div class="enhanced-panel h-100">
                                <div class="panel-title">
                                    <i class="bi bi-pie-chart-fill"></i>
                                    Beneficiary Distribution
                                </div>
                                <h6 class="fw-bold small text-muted mb-2 text-uppercase">Target Groups</h6>
                                <div class="chart-container" style="position: relative; height:180px; width:100%">
                                    <canvas id="beneficiaryGroupsChart"></canvas>
                                </div>

                                <h6 class="fw-bold small text-muted mt-4 mb-2 text-uppercase">Target Individuals</h6>
                                <div class="chart-container" style="position: relative; height:180px; width:100%">
                                    <canvas id="beneficiaryIndividualsChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Beneficiary Growth Row -->
                    <div class="row g-3 mb-4">
                        <div class="col-12">
                            <div class="enhanced-panel h-100">
                                <div class="panel-title">
                                    <i class="bi bi-graph-up"></i>
                                    Cumulative Beneficiary Reach Over Time
                                </div>
                                <div class="chart-container" style="position: relative; height:350px; width:100%">
                                    @if(isset($beneficiaryChartData['values']) && count($beneficiaryChartData['values']) > 0)
                                        <div id="beneficiaryGrowthChart"></div>
                                    @else
                                        <div class="d-flex flex-column align-items-center justify-content-center h-100 text-muted">
                                            <i class="bi bi-graph-up display-4 opacity-25 mb-2"></i>
                                            <p class="mb-0">No beneficiary data recorded yet</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Progress & Risk Row -->
                    <div class="row g-3 mb-4">
                        <!-- Confidence Gauge -->
                        <div class="col-lg-6">
                            <div class="enhanced-panel h-100">
                                <div class="panel-title">
                                    <i class="bi bi-speedometer"></i>
                                    Execution Health
                                    <button class="btn btn-sm btn-link text-muted p-0 ms-2" data-bs-toggle="modal" data-bs-target="#calculationGuideModal" title="How is this calculated?">
                                        <i class="bi bi-info-circle"></i>
                                    </button>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-5 text-center">
                                        <div class="confidence-gauge mx-auto">
                                            @php
                                                $confidence = $project->completion_readiness ?? 0;
                                                $deg = ($confidence / 100) * 360;
                                            @endphp
                                            <div class="gauge-bg" style="background:conic-gradient(var(--isico-primary) 0deg {{ $deg }}deg, #e8f5ef {{ $deg }}deg 360deg);"></div>
                                            <div class="gauge-inner">
                                                <div class="fs-1 fw-bold text-primary">{{ $confidence }}%</div>
                                                <div class="text-muted" style="font-size:0.85rem;">Confidence</div>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <span class="badge bg-success px-3 py-2 fs-6">
                                                <i class="bi bi-check-circle-fill me-1"></i>{{ $confidence > 75 ? 'HIGH' : ($confidence > 50 ? 'MEDIUM' : 'LOW') }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between mb-1">
                                                <small class="fw-bold">Milestone Progress</small>
                                                <small class="text-success">Live</small>
                                            </div>
                                            <div class="progress custom-progress">
                                                <div class="custom-progress-bar" style="width:{{ $project->project_progress ?? 0 }}%;background:var(--p4);"></div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between mb-1">
                                                <small class="fw-bold">Field Execution Pace</small>
                                                <small class="text-success">Active</small>
                                            </div>
                                            <div class="progress custom-progress">
                                                <div class="custom-progress-bar" style="width:{{ ($project->project_progress ?? 0) * 0.9 }}%;background:var(--p5);"></div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between mb-1">
                                                <small class="fw-bold">Schedule Alignment</small>
                                                <small class="text-warning">Moderate</small>
                                            </div>
                                            <div class="progress custom-progress">
                                                <div class="custom-progress-bar" style="width:{{ ($project->project_progress ?? 0) * 0.8 }}%;background:var(--p6);"></div>
                                            </div>
                                        </div>
                                        <div class="alert alert-success mt-3" style="font-size:0.85rem;">
                                            <i class="bi bi-info-circle me-1"></i>
                                            Confidence reflects current execution momentum and milestone alignment
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Risk Radar -->
                        <div class="col-lg-6">
                            <div class="enhanced-panel h-100">
                                <div class="panel-title">
                                    <i class="bi bi-shield-check"></i>
                                    Project Risk Assessment
                                    <button class="btn btn-sm btn-link text-muted p-0 ms-2" data-bs-toggle="modal" data-bs-target="#calculationGuideModal" title="How is this calculated?">
                                        <i class="bi bi-info-circle"></i>
                                    </button>
                                </div>
                                <div class="chart-container" style="position: relative; height:250px; width:100%">
                                    @php
                                        $hasRiskData = collect($riskBreakdown)->sum() > 0;
                                    @endphp

                                    @if($hasRiskData)
                                        <canvas id="riskRadarChart"></canvas>
                                    @else
                                        <div class="d-flex flex-column align-items-center justify-content-center h-100 text-muted">
                                            <i class="bi bi-shield-check display-4 opacity-25 mb-2"></i>
                                            <p class="mb-0">No risk factors identified</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="mt-3">
                                    <div class="row g-2">
                                        @foreach($riskBreakdown as $bk => $bv)
                                        @if($bv > 0)
                                        <div class="col-6">
                                            <div class="p-2 border rounded">
                                                <small class="d-block fw-bold">{{ $bk }}</small>
                                                <span class="badge {{ $bv > 50 ? 'bg-danger' : ($bv > 20 ? 'bg-warning text-dark' : 'bg-success') }}">{{ $bv > 50 ? 'High' : ($bv > 20 ? 'Med' : 'Low') }}</span>
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Summary -->
                    <div class="summary-card">
                        <div class="d-flex align-items-start gap-2">
                            <i class="bi bi-info-circle-fill text-primary fs-5 mt-1"></i>
                            <div>
                                <h6 class="fw-bold mb-2">Current Status Summary</h6>
                                <p class="mb-0" style="font-size:0.95rem;">
                                    Execution is on track with {{ $project->project_progress }}% overall progress. {{ $currentPhaseTitle }} phase is active with {{ $installationsInProgress }} tasks in progress.
                                    Beneficiary reach is progressing well at {{ number_format($project->actual_beneficiary_count ?? 0) }} individuals. Confidence remains at {{ $confidence }}%.
                                    {{ $riskLevel }} risks being actively monitored.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- ApexCharts CDN -->
            <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

            <!-- Scripts for this tab specifically -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const executionTab = document.getElementById('execution-tab');
                    if(executionTab){
                        executionTab.addEventListener('shown.bs.tab', function (event) {
                             setTimeout(initExecutionCharts, 200);
                        });
                        // If already active (page load with active tab)
                        if(document.querySelector('#execution.active')){
                             setTimeout(initExecutionCharts, 200);
                        }
                    } else {
                         // Fallback if tab is not found (maybe directly active)
                         setTimeout(initExecutionCharts, 1000);
                    }
                });

                function initExecutionCharts() {

                    initBeneficiaryGrowthChart();

                    // Check if Chart.js is loaded
                    if (typeof Chart === 'undefined') {
                        console.error('Chart.js is not loaded. Cannot initialize execution charts.');
                        return;
                    }

                    if(window.executionChartsInitialized) return;
                    window.executionChartsInitialized = true;

                    console.log('Initializing Execution Charts...');

                    // Resolve CSS variables
                    const css = getComputedStyle(document.querySelector('.execution-dashboard') || document.documentElement);
                    const PHASE_COLORS = {
                        P1: css.getPropertyValue('--p1').trim(),
                        P2: css.getPropertyValue('--p2').trim(),
                        P3: css.getPropertyValue('--p3').trim(),
                        P4: css.getPropertyValue('--p4').trim(),
                        P5: css.getPropertyValue('--p5').trim(),
                        P6: css.getPropertyValue('--p6').trim(),
                        P7: css.getPropertyValue('--p7').trim()
                    };

                    // Register Chart.js plugins
                    if(typeof ChartDataLabels !== 'undefined'){
                         Chart.register(ChartDataLabels);
                    }

                    // Milestone Radar
                    const ctxM = document.getElementById('milestoneLiveChart');
                    if(ctxM) {
                        try {
                            new Chart(ctxM, {
                                type: 'radar',
                                data: {
                                    labels: [
                                        'P1: Need Assessment',
                                        'P2: Partnerships',
                                        'P3: Planning',
                                        'P4: Implementation',
                                        'P5: Capacity Building',
                                        'P6: Impact Audit',
                                        'P7: Handover'
                                    ],
                                    datasets: [{
                                        label: 'Planned',
                                        data: [100, 100, 100, 100, 100, 100, 100],
                                        borderColor: '#e0e0e0',
                                        backgroundColor: 'rgba(224, 224, 224, 0.1)',
                                        borderWidth: 1,
                                        pointRadius: 0
                                    }, {
                                        label: 'Current Progress',
                                        data: @json($phaseProgress),
                                        borderColor: css.getPropertyValue('--isico-primary').trim() || '#1a6b44',
                                        backgroundColor: 'rgba(26, 107, 68, 0.2)',
                                        borderWidth: 2,
                                        pointBackgroundColor: [
                                            PHASE_COLORS.P1,
                                            PHASE_COLORS.P2,
                                            PHASE_COLORS.P3,
                                            PHASE_COLORS.P4,
                                            PHASE_COLORS.P5,
                                            PHASE_COLORS.P6,
                                            PHASE_COLORS.P7
                                        ],
                                        pointRadius: 6,
                                        pointHoverRadius: 8
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    plugins: {
                                        legend: {
                                            position: 'bottom',
                                            labels: { padding: 20, usePointStyle: true }
                                        },
                                        tooltip: {
                                            callbacks: { label: function(context) { return `${context.dataset.label}: ${context.raw}%`; } }
                                        },
                                        datalabels: { display: false }
                                    },
                                    scales: {
                                        r: {
                                            beginAtZero: true,
                                            max: 100,
                                            ticks: { stepSize: 20, backdropColor: 'transparent' },
                                            pointLabels: { font: { size: 11, weight: '600' } }
                                        }
                                    }
                                }
                            });
                        } catch (e) {
                            console.error('Error initializing milestoneLiveChart', e);
                        }
                    }

                    // Beneficiary Groups Chart
                    const ctxGroups = document.getElementById('beneficiaryGroupsChart');
                    if(ctxGroups) {
                        const groupsData = @json($beneficiaryGroupsData);
                        try {
                            new Chart(ctxGroups, {
                                type: 'bar',
                                data: {
                                    labels: groupsData.labels,
                                    datasets: [{
                                        label: 'Target',
                                        data: groupsData.targets,
                                        backgroundColor: '#4e73df',
                                        borderRadius: 4
                                    }, {
                                        label: 'Reached',
                                        data: groupsData.reached,
                                        backgroundColor: '#1cc88a',
                                        borderRadius: 4
                                    }]
                                },
                                options: {
                                    indexAxis: 'y',
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    plugins: {
                                        legend: { position: 'bottom', labels: { boxWidth: 10 } },
                                        datalabels: { display: false }
                                    },
                                    scales: {
                                        x: { grid: { display: false } },
                                        y: { grid: { display: false }, ticks: { autoSkip: false } }
                                    }
                                }
                            });
                        } catch(e) { console.error('Error init groups chart', e); }
                    }

                    // Beneficiary Individuals Chart
                    const ctxIndividuals = document.getElementById('beneficiaryIndividualsChart');
                    if(ctxIndividuals) {
                        const individualsData = @json($beneficiaryIndividualsData);
                        try {
                            new Chart(ctxIndividuals, {
                                type: 'bar',
                                data: {
                                    labels: individualsData.labels,
                                    datasets: [{
                                        label: 'Target',
                                        data: individualsData.targets,
                                        backgroundColor: '#36b9cc',
                                        borderRadius: 4
                                    }, {
                                        label: 'Reached',
                                        data: individualsData.reached,
                                        backgroundColor: '#1cc88a',
                                        borderRadius: 4
                                    }]
                                },
                                options: {
                                    indexAxis: 'y',
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    plugins: {
                                        legend: { position: 'bottom', labels: { boxWidth: 10 } },
                                        datalabels: { display: false }
                                    },
                                    scales: {
                                        x: { grid: { display: false } },
                                        y: { grid: { display: false }, ticks: { autoSkip: false } }
                                    }
                                }
                            });
                        } catch(e) { console.error('Error init individuals chart', e); }
                    }

                    // Risk Radar Chart
                    const ctxR = document.getElementById('riskRadarChart');
                    if(ctxR) {
                        try {
                            new Chart(ctxR, {
                                type: 'radar',
                                data: {
                                    labels: ['Infrastructure', 'Vendor', 'Schedule', 'Adoption', 'Resources', 'Compliance'],
                                    datasets: [{
                                        label: 'Current Risk Level',
                                        data: [
                                            {{ $riskBreakdown['Infrastructure'] }},
                                            {{ $riskBreakdown['Vendor'] }},
                                            {{ $riskBreakdown['Schedule'] }},
                                            {{ $riskBreakdown['Adoption'] }},
                                            {{ $riskBreakdown['Resources'] }},
                                            {{ $riskBreakdown['Compliance'] }}
                                        ],
                                        borderColor: css.getPropertyValue('--isico-primary').trim() || '#1a6b44',
                                        backgroundColor: 'rgba(26, 107, 68, 0.2)',
                                        borderWidth: 2,
                                        pointBackgroundColor: css.getPropertyValue('--isico-primary').trim() || '#1a6b44',
                                        pointRadius: 4
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    scales: {
                                        r: {
                                            beginAtZero: true,
                                            max: 100,
                                            ticks: {
                                                stepSize: 20,
                                                callback: function(value) {
                                                    if (value <= 30) return 'Low';
                                                    if (value <= 60) return 'Medium';
                                                    return 'High';
                                                }
                                            }
                                        }
                                    },
                                    plugins: {
                                        legend: { position: 'bottom' },
                                        tooltip: {
                                            callbacks: {
                                                label: function(context) {
                                                    const riskLevel = context.raw <= 30 ? 'Low' : context.raw <= 60 ? 'Medium' : 'High';
                                                    return `${context.dataset.label}: ${context.raw} (${riskLevel})`;
                                                }
                                            }
                                        },
                                        datalabels: { display: false }
                                    }
                                }
                            });
                        } catch(e) { console.error('Error init risk chart', e); }
                    }

                    // Beneficiary Growth Line Chart
                    // const ctxG = document.getElementById('beneficiaryGrowthChart');
                    // if(ctxG) {
                    //     const growthData = @json($beneficiaryChartData);
                    //     console.log('Growth Data:', growthData);

                    //     try {
                    //         new Chart(ctxG, {
                    //             type: 'line',
                    //             data: {
                    //                 labels: growthData.labels,
                    //                 datasets: [{
                    //                     label: 'Total Beneficiaries Reached',
                    //                     data: growthData.values,
                    //                     borderColor: css.getPropertyValue('--isico-primary').trim() || '#1a6b44',
                    //                     backgroundColor: 'rgba(26, 107, 68, 0.1)',
                    //                     borderWidth: 2,
                    //                     fill: true,
                    //                     tension: 0.4,
                    //                     pointRadius: 4,
                    //                     pointBackgroundColor: '#fff',
                    //                     pointBorderColor: css.getPropertyValue('--isico-primary').trim() || '#1a6b44',
                    //                     pointBorderWidth: 2
                    //                 }]
                    //             },
                    //             options: {
                    //                 responsive: true,
                    //                 maintainAspectRatio: false,
                    //                 plugins: {
                    //                     legend: {
                    //                         position: 'top',
                    //                         align: 'end'
                    //                     },
                    //                     tooltip: {
                    //                         mode: 'index',
                    //                         intersect: false,
                    //                     },
                    //                     datalabels: {
                    //                         display: false
                    //                     }
                    //                 },
                    //                 scales: {
                    //                     y: {
                    //                         beginAtZero: true,
                    //                         grid: {
                    //                             borderDash: [2, 4],
                    //                             color: '#f0f0f0'
                    //                         },
                    //                         title: {
                    //                             display: true,
                    //                             text: 'Number of Individuals'
                    //                         }
                    //                     },
                    //                     x: {
                    //                         grid: {
                    //                             display: false
                    //                         }
                    //                     }
                    //                 }
                    //             }
                    //         });
                    //     } catch (e) {
                    //         console.error('Error initializing beneficiaryGrowthChart', e);
                    //     }
                    // }

                }

                function initBeneficiaryGrowthChart() {
                    const chartElement = document.querySelector("#beneficiaryGrowthChart");
                    if (!chartElement) return;

                    const growthData = @json($beneficiaryChartData);
                    console.log('Beneficiary Growth Data (Apex):', growthData);

                    // Check if we have valid data
                    if (!growthData.labels || growthData.labels.length === 0 ||
                        !growthData.values || growthData.values.length === 0) {
                        chartElement.innerHTML = `
                            <div class="d-flex flex-column align-items-center justify-content-center h-100 text-muted p-4">
                                <i class="bi bi-graph-up display-4 opacity-25 mb-3"></i>
                                <h6 class="text-muted mb-2">No beneficiary data recorded yet</h6>
                                <p class="text-muted small text-center">Beneficiary tracking will appear here once updates are added.</p>
                            </div>
                        `;
                        return;
                    }

                    // Clear previous chart if any (ApexCharts handles this usually but good to be safe if ensuring clean state)
                    chartElement.innerHTML = '';

                    var options = {
                        series: [{
                            name: "Beneficiaries Reached",
                            data: growthData.values
                        }],
                        chart: {
                            type: 'area',
                            height: 350,
                            fontFamily: 'inherit',
                            toolbar: {
                                show: false
                            },
                            animations: {
                                enabled: true,
                                easing: 'easeinout',
                                speed: 800
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: 'smooth',
                            width: 3,
                            colors: ['#1a6b44']
                        },
                        fill: {
                            type: 'gradient',
                            gradient: {
                                shadeIntensity: 1,
                                opacityFrom: 0.7,
                                opacityTo: 0.3,
                                stops: [0, 90, 100],
                                colorStops: [
                                    {
                                        offset: 0,
                                        color: "#1a6b44",
                                        opacity: 0.4
                                    },
                                    {
                                        offset: 100,
                                        color: "#1a6b44",
                                        opacity: 0.1
                                    }
                                ]
                            }
                        },
                        xaxis: {
                            categories: growthData.labels,
                            labels: {
                                style: {
                                    colors: '#6c757d',
                                    fontSize: '12px'
                                }
                            },
                             axisBorder: {
                                show: false
                            },
                            axisTicks: {
                                show: false
                            }
                        },
                        yaxis: {
                            labels: {
                                style: {
                                    colors: '#6c757d',
                                    fontSize: '12px'
                                },
                                formatter: function (val) {
                                    return val.toLocaleString();
                                }
                            }
                        },
                        grid: {
                            borderColor: '#e9ecef',
                            strokeDashArray: 4,
                            yaxis: {
                                lines: {
                                    show: true
                                }
                            }
                        },
                        colors: ['#1a6b44'],
                        tooltip: {
                            theme: 'light',
                            y: {
                                formatter: function (val) {
                                    return val.toLocaleString() + " Beneficiaries"
                                }
                            }
                        },
                        markers: {
                            size: 5,
                            colors: ['#1a6b44'],
                            strokeColors: '#fff',
                            strokeWidth: 2,
                            hover: {
                                size: 7
                            }
                        }
                    };

                    try {
                        var chart = new ApexCharts(document.querySelector("#beneficiaryGrowthChart"), options);
                        chart.render();
                        console.log('ApexCharts Beneficiary Growth Chart rendered');
                    } catch (error) {
                        console.error('Error rendering ApexCharts:', error);
                        chartElement.innerHTML = '<p class="text-danger text-center mt-5">Error loading chart</p>';
                    }
                }
            </script>
        </div>
        @endif

        <!-- Resources & Risks Tab -->
        <div class="tab-pane fade" id="resources" role="tabpanel">
            <div class="row g-4">
                <!-- Resources Needed -->
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="card-title mb-0 fw-bold">
                                <i class="bi bi-box-seam text-primary me-2"></i>Resources Needed
                            </h5>
                        </div>
                        <div class="card-body">
                            @if(!empty($project->resources_needed))
                            <div class="list-group list-group-flush">
                                @php
                                    $resources = is_array($project->resources_needed)
                                        ? $project->resources_needed
                                        : array_filter(explode("\n", $project->resources_needed));
                                @endphp
                                @foreach($resources as $resource)
                                <div class="list-group-item border-0 px-0 py-3">
                                    <div class="d-flex align-items-start">
                                        <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                            <i class="bi bi-check-circle text-success"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 text-secondary">{{ is_array($resource) ? ($resource['item'] ?? 'Resource') : trim($resource) }}</h6>
                                            @if(is_array($resource) && isset($resource['note']))
                                            <p class="text-muted small mb-0">{{ $resource['note'] }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div class="text-center py-4">
                                <i class="bi bi-inbox text-muted fs-1 mb-3 d-block"></i>
                                <p class="text-muted">No resource requirements specified</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Risk Management -->
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="card-title mb-0 fw-bold">
                                <i class="bi bi-shield-exclamation text-warning me-2"></i>Risk Management
                            </h5>
                        </div>
                        <div class="card-body">
                            @if(!empty($project->risks))
                            <div class="accordion accordion-flush" id="riskAccordion">
                                @foreach($project->risks as $index => $risk)
                                <div class="accordion-item border-0">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed bg-light rounded mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#risk{{ $index }}">
                                            <span class="badge
                                                @if(($risk['impact'] ?? '') == 'high') bg-danger
                                                @elseif(($risk['impact'] ?? '') == 'medium') bg-warning
                                                @else bg-secondary
                                                @endif me-2">
                                                {{ strtoupper($risk['impact'] ?? 'MED') }}
                                            </span>
                                            {{ $risk['risk'] ?? 'Risk Item' }}
                                        </button>
                                    </h2>
                                    <div id="risk{{ $index }}" class="accordion-collapse collapse" data-bs-parent="#riskAccordion">
                                        <div class="accordion-body pt-2 small">
                                            <strong class="text-muted">Responsible Person:</strong>
                                            <p class="mb-2">{{ $risk['responsible'] ?? 'N/A' }}</p>
                                            <strong class="text-muted">Mitigation:</strong>
                                            <p class="mb-0 text-success">{{ $risk['mitigation'] ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div class="text-center py-4">
                                <i class="bi bi-shield-check text-muted fs-1 mb-3 d-block"></i>
                                <p class="text-muted">No risks recorded</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Feedback Tab -->
        <!-- Feedback Tab -->
        <div class="tab-pane fade" id="feedback" role="tabpanel">
            <!-- Header Section -->
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
                <div>
                    <h4 class="mb-0 fw-bold"><i class="bi bi-chat-heart text-teal me-2"></i>Community Feedback</h4>
                    <p class="text-muted mb-0">Survey responses from stakeholders, beneficiaries & team members</p>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="badge bg-primary bg-opacity-10 text-white px-3 py-2 rounded-pill">
                        <i class="bi bi-people-fill me-1"></i>{{ $feedbacks->count() }} Responses
                    </span>
                    @if($feedbacks->count() > 0)
                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                        <i class="bi bi-calendar-check me-1"></i>
                        {{ $feedbacks->min('survey_date') ? \Carbon\Carbon::parse($feedbacks->min('survey_date'))->format('M Y') : 'N/A' }} -
                        {{ $feedbacks->max('survey_date') ? \Carbon\Carbon::parse($feedbacks->max('survey_date'))->format('M Y') : 'N/A' }}
                    </span>
                    @endif
                </div>
            </div>

            <div class="row g-4">
                <!-- Left Column: Charts -->
                <div class="col-lg-4">
                    <!-- Satisfaction Distribution Chart -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-0 py-3">
                            <h6 class="card-title mb-0 fw-bold">
                                <i class="bi bi-emoji-smile text-success me-2"></i>Satisfaction Levels
                            </h6>
                        </div>
                        <div class="card-body text-center">
                            <div style="height: 200px; position: relative;">
                                <canvas id="satisfactionChart"></canvas>
                            </div>
                            <div class="mt-3">
                                <div class="d-flex flex-wrap justify-content-center gap-2 small">
                                    <span><i class="bi bi-circle-fill text-success"></i> Very Satisfied</span>
                                    <span><i class="bi bi-circle-fill" style="color: #17a2b8"></i> Satisfied</span>
                                    <span><i class="bi bi-circle-fill text-secondary"></i> Neutral</span>
                                    <span><i class="bi bi-circle-fill text-danger"></i> Dissatisfied</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Project Success Rate -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-0 py-3">
                            <h6 class="card-title mb-0 fw-bold">
                                <i class="bi bi-trophy text-warning me-2"></i>Project Success Rating
                            </h6>
                        </div>
                        <div class="card-body">
                            @php
                                $yesPercent = $surveyStats['total'] > 0 ? round(($surveyStats['success']['Yes'] / $surveyStats['total']) * 100) : 0;
                            @endphp
                            <div class="text-center mb-4">
                                <div class="position-relative d-inline-block">
                                    <svg width="140" height="140" viewBox="0 0 36 36" class="circular-chart-success">
                                        <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#e6e6e6" stroke-width="3"/>
                                        <path class="circle" stroke-dasharray="{{ $yesPercent }}, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#28a745" stroke-width="3" stroke-linecap="round"/>
                                        <text x="18" y="20.5" fill="#28a745" font-size="8" text-anchor="middle" font-weight="bold">{{ $yesPercent }}%</text>
                                        <text x="18" y="25" fill="#6c757d" font-size="3" text-anchor="middle">SUCCESS</text>
                                    </svg>
                                </div>
                            </div>
                            <div class="row text-center g-2">
                                <div class="col-4">
                                    <div class="p-2 bg-success bg-opacity-10 rounded">
                                        <h5 class="mb-0 text-success">{{ $surveyStats['success']['Yes'] }}</h5>
                                        <small class="text-muted">Yes</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="p-2 bg-danger bg-opacity-10 rounded">
                                        <h5 class="mb-0 text-danger">{{ $surveyStats['success']['No'] }}</h5>
                                        <small class="text-muted">No</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="p-2 bg-warning bg-opacity-10 rounded">
                                        <h5 class="mb-0 text-warning">{{ $surveyStats['success']['Not Sure'] }}</h5>
                                        <small class="text-muted">Unsure</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Role Breakdown -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0 py-3">
                            <h6 class="card-title mb-0 fw-bold">
                                <i class="bi bi-person-badge text-primary me-2"></i>Respondents by Role
                            </h6>
                        </div>
                        <div class="card-body">
                            @foreach($surveyStats['roles'] as $role => $count)
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="small fw-medium">{{ $role }}</span>
                                        <span class="small text-muted">{{ $count }}</span>
                                    </div>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-gradient" style="width: {{ ($count / $surveyStats['total']) * 100 }}%; background: linear-gradient(90deg, #667eea, #764ba2);"></div>
                                    </div>f
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Right Column: Survey Responses -->
                <div class="col-lg-8">
                    <!-- Filter Bar -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body py-3">
                            <div class="d-flex flex-wrap align-items-center gap-3">
                                <span class="fw-bold small text-muted">Filter by:</span>
                                <div class="btn-group btn-group-sm" role="group">
                                    <input type="radio" class="btn-check" name="surveyFilter" id="filter-all-surveys" autocomplete="off" checked onclick="filterSurveys('all')">
                                    <label class="btn btn-outline-primary" for="filter-all-surveys">All</label>

                                    <input type="radio" class="btn-check" name="surveyFilter" id="filter-satisfied" autocomplete="off" onclick="filterSurveys('satisfied')">
                                    <label class="btn btn-outline-success" for="filter-satisfied">Satisfied</label>

                                    <input type="radio" class="btn-check" name="surveyFilter" id="filter-neutral" autocomplete="off" onclick="filterSurveys('neutral')">
                                    <label class="btn btn-outline-secondary" for="filter-neutral">Neutral</label>

                                    <input type="radio" class="btn-check" name="surveyFilter" id="filter-dissatisfied" autocomplete="off" onclick="filterSurveys('dissatisfied')">
                                    <label class="btn btn-outline-danger" for="filter-dissatisfied">Dissatisfied</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Survey Cards Grid -->
                    <div class="row g-3" id="surveyCardsGrid">
                        @forelse($feedbacks->sortByDesc('survey_date') as $survey)
                        <div class="col-md-12 survey-card-item"
                             data-satisfaction="{{ strtolower(str_replace(' ', '-', $survey->satisfaction)) }}"
                             data-role="{{ strtolower(str_replace(' ', '-', $survey->role)) }}">
                            <div class="card border-0 shadow-sm h-100 survey-feedback-card">
                                <div class="card-body p-4">
                                    <!-- Header with Avatar & Info -->
                                    <div class="d-flex align-items-start mb-3">
                                        <div class="survey-avatar me-3">
                                            @php
                                                $initials = collect(explode(' ', $survey->name))->map(fn($n) => strtoupper(substr($n, 0, 1)))->take(2)->join('');
                                                $colors = ['#667eea', '#764ba2', '#f093fb', '#f5576c', '#4facfe', '#00f2fe', '#43e97b', '#38f9d7'];
                                                $colorIndex = ord($initials[0] ?? 'A') % count($colors);
                                            @endphp
                                            <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width: 48px; height: 48px; background: linear-gradient(135deg, {{ $colors[$colorIndex] }}, {{ $colors[($colorIndex + 1) % count($colors)] }});">
                                                {{ $initials }}
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 fw-bold">{{ $survey->name }}</h6>
                                            <div class="d-flex flex-wrap gap-2 align-items-center">
                                                <span class="badge bg-primary bg-opacity-10 text-white small">{{ $survey->role }}</span>
                                                <small class="text-muted">
                                                    <i class="bi bi-calendar3 me-1"></i>{{ \Carbon\Carbon::parse($survey->survey_date)->format('d M Y') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Satisfaction Indicator -->
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        @switch($survey->satisfaction)
                                            @case('Very Satisfied')
                                                <span class="badge bg-success bg-opacity-15 text-white px-3 py-2">
                                                    <i class="bi bi-emoji-laughing me-1"></i>Very Satisfied
                                                </span>
                                                @break
                                            @case('Satisfied')
                                                <span class="badge px-3 py-2" style="background: rgba(23, 162, 184, 0.15); color: #17a2b8;">
                                                    <i class="bi bi-emoji-smile me-1"></i>Satisfied
                                                </span>
                                                @break
                                            @case('Neutral')
                                                <span class="badge bg-secondary bg-opacity-15 text-white px-3 py-2">
                                                    <i class="bi bi-emoji-neutral me-1"></i>Neutral
                                                </span>
                                                @break
                                            @case('Dissatisfied')
                                                <span class="badge bg-danger bg-opacity-15 text-danger px-3 py-2">
                                                    <i class="bi bi-emoji-frown me-1"></i>Dissatisfied
                                                </span>
                                                @break
                                        @endswitch

                                        <!-- Project Success Badge -->
                                        @switch($survey->project_success)
                                            @case('Yes')
                                                <span class="badge bg-success px-2 py-1">
                                                    <i class="bi bi-check-circle-fill me-1"></i>Success
                                                </span>
                                                @break
                                            @case('No')
                                                <span class="badge bg-danger px-2 py-1">
                                                    <i class="bi bi-x-circle-fill me-1"></i>Not Successful
                                                </span>
                                                @break
                                            @case('Not Sure')
                                                <span class="badge bg-warning text-dark px-2 py-1">
                                                    <i class="bi bi-question-circle-fill me-1"></i>Unsure
                                                </span>
                                                @break
                                        @endswitch
                                    </div>

                                    <!-- Comment -->
                                    @if($survey->comments)
                                    <div class="survey-comment p-3 bg-light rounded-3 border-start border-3 border-primary">
                                        <i class="bi bi-quote text-primary opacity-50 fs-5"></i>
                                        <p class="mb-0 text-secondary survey-comment-text" style="font-size: 0.9rem;">
                                            {{ Str::limit($survey->comments, 150) }}
                                        </p>
                                        @if(strlen($survey->comments) > 150)
                                        <button class="btn btn-link btn-sm p-0 text-primary expand-comment" data-full-text="{{ $survey->comments }}">
                                            Read more <i class="bi bi-chevron-down"></i>
                                        </button>
                                        @endif
                                    </div>
                                    @else
                                    <div class="text-muted text-center py-2 small">
                                        <i class="bi bi-chat-left-text me-1"></i>No comments provided
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12 py-5 text-center">
                            <div class="mb-3">
                                 <i class="bi bi-chat-square-text display-1 text-muted opacity-25"></i>
                            </div>
                            <h5 class="text-muted">No Feedback Yet</h5>
                            <p class="text-muted small">Be the first to share your experience with this project.</p>
                        </div>
                        @endforelse
                    </div>

                    <!-- Load More (if many surveys) -->
                    @if($feedbacks->count() > 6)
                    <div class="text-center mt-4" id="loadMoreSurveys">
                        <button class="btn btn-outline-primary rounded-pill px-4" onclick="showAllSurveys()">
                            <i class="bi bi-arrow-down-circle me-2"></i>Show All {{ $feedbacks->count() }} Responses
                        </button>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Survey Tab -->
        @if(isset($surveys) && $surveys->count() > 0)
        <div class="tab-pane fade" id="survey" role="tabpanel">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h4 class="mb-4 fw-bold">Project Surveys</h4>

                    <div class="accordion" id="surveyAccordion">
                        @foreach($surveys as $index => $survey)
                            @if($survey->is_active)
                                <div class="accordion-item mb-3 border rounded overflow-hidden">
                                    <h2 class="accordion-header" id="heading{{ $survey->id }}">
                                        <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }} fw-bold bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $survey->id }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $survey->id }}">
                                            <i class="bi bi-clipboard-data me-2 text-primary"></i> {{ $survey->title }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $survey->id }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="heading{{ $survey->id }}" data-bs-parent="#surveyAccordion">
                                        <div class="accordion-body p-4">
                                            @if($survey->description)
                                                <p class="text-muted mb-4">{{ $survey->description }}</p>
                                            @endif

                                            @php
                                                $userResponse = $survey->responses->first();
                                            @endphp

                                            @if($userResponse)
                                                <div class="scrutiny-form">
                                                    <div class="alert alert-success border-0 bg-success bg-opacity-10 mb-4 rounded-3 d-flex align-items-center">
                                                        <i class="bi bi-check-circle-fill text-success fs-4 me-3"></i>
                                                        <div>
                                                            <h5 class="fw-bold text-success mb-1">Response Submitted</h5>
                                                            <p class="mb-0 text-success text-opacity-75 small">You have already responded to this survey. Your answers are shown below.</p>
                                                        </div>
                                                    </div>
                                            @else
                                                <form class="scrutiny-form" action="{{ route('web.project.survey.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="survey_id" value="{{ $survey->id }}">
                                            @endif

                                                <div class="survey-conversation">
                                                    @foreach($survey->questions as $qIndex => $question)
                                                        <div class="conversation-item mb-4 animate__animated animate__fadeInUp" style="animation-delay: {{ $qIndex * 100 }}ms;">
                                                            <!-- Admin/System Question Bubble -->
                                                            <div class="d-flex align-items-start mb-3">
                                                                <div class="flex-shrink-0 me-3">
                                                                    <div class="avatar-sm bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center">
                                                                        <i class="bi bi-patch-question-fill text-primary fs-5"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <div class="bg-light p-3 rounded-3 rounded-top-0 border-start border-4 border-primary position-relative">
                                                                        <span class="badge bg-primary mb-2">Question {{ $qIndex + 1 }}</span>
                                                                        <p class="mb-0 fw-bold text-dark">{{ $question->question_text }}</p>
                                                                        @if($question->is_required)
                                                                            <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                                                                                <span class="visually-hidden">Required</span>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- User Answer Input Bubble -->
                                                            <div class="d-flex align-items-start justify-content-end mb-4 ms-5">
                                                                <div class="flex-grow-1">
                                                                    <div class="p-1">
                                                                        @if($userResponse)
                                                                            <div class="bg-primary text-white p-3 rounded-3 rounded-top-0 shadow-sm text-break">
                                                                                @php
                                                                                    $ans = isset($userResponse->answers) && is_array($userResponse->answers)
                                                                                        ? ($userResponse->answers[$question->id] ?? null)
                                                                                        : null;
                                                                                    if(is_array($ans)) $ans = implode(', ', $ans);
                                                                                @endphp
                                                                                <p class="mb-0">{{ $ans ?? 'No answer provided' }}</p>
                                                                            </div>
                                                                        @else
                                                                            @switch($question->type)
                                                                            @case('text')
                                                                                <div class="form-floating">
                                                                                    <input type="text" class="form-control border-0 shadow-sm bg-white" id="q_{{$question->id}}" name="answers[{{ $question->id }}]" placeholder="Your answer..." {{ $question->is_required ? 'required' : '' }}>
                                                                                    <label for="q_{{$question->id}}" class="text-muted">Type your answer here...</label>
                                                                                </div>
                                                                                @break

                                                                            @case('textarea')
                                                                                <div class="form-floating">
                                                                                    <textarea class="form-control border-0 shadow-sm bg-white" id="q_{{$question->id}}" name="answers[{{ $question->id }}]" placeholder="Your answer..." style="height: 100px" {{ $question->is_required ? 'required' : '' }}></textarea>
                                                                                    <label for="q_{{$question->id}}" class="text-muted">Type your detailed answer here...</label>
                                                                                </div>
                                                                                @break

                                                                            @case('number')
                                                                                <div class="form-floating">
                                                                                    <input type="number" class="form-control border-0 shadow-sm bg-white" id="q_{{$question->id}}" name="answers[{{ $question->id }}]" placeholder="0" {{ $question->is_required ? 'required' : '' }}>
                                                                                    <label for="q_{{$question->id}}" class="text-muted">Enter a number...</label>
                                                                                </div>
                                                                                @break

                                                                            @case('date')
                                                                                <div class="form-floating">
                                                                                    <input type="date" class="form-control border-0 shadow-sm bg-white" id="q_{{$question->id}}" name="answers[{{ $question->id }}]" {{ $question->is_required ? 'required' : '' }}>
                                                                                    <label for="q_{{$question->id}}" class="text-muted">Select Date</label>
                                                                                </div>
                                                                                @break

                                                                            @case('select')
                                                                                <div class="form-floating">
                                                                                    <select class="form-select border-0 shadow-sm bg-white" id="q_{{$question->id}}" name="answers[{{ $question->id }}]" {{ $question->is_required ? 'required' : '' }}>
                                                                                        <option value="">Select an option</option>
                                                                                        @if($question->options)
                                                                                            @foreach(json_decode($question->options) as $option)
                                                                                                <option value="{{ $option }}">{{ $option }}</option>
                                                                                            @endforeach
                                                                                        @endif
                                                                                    </select>
                                                                                    <label for="q_{{$question->id}}" class="text-muted">Choose from list</label>
                                                                                </div>
                                                                                @break

                                                                            @case('radio')
                                                                                <div class="bg-white p-3 rounded shadow-sm border-0">
                                                                                    <p class="mb-2 text-muted small fw-bold text-uppercase">Select One:</p>
                                                                                    @if($question->options)
                                                                                        <div class="d-flex flex-wrap gap-3">
                                                                                            @foreach(json_decode($question->options) as $optIndex => $option)
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" id="q{{ $question->id }}_opt{{ $optIndex }}" value="{{ $option }}" {{ $question->is_required ? 'required' : '' }}>
                                                                                                    <label class="form-check-label" for="q{{ $question->id }}_opt{{ $optIndex }}">
                                                                                                        {{ $option }}
                                                                                                    </label>
                                                                                                </div>
                                                                                            @endforeach
                                                                                        </div>
                                                                                    @endif
                                                                                </div>
                                                                                @break

                                                                            @case('checkbox')
                                                                                <div class="bg-white p-3 rounded shadow-sm border-0">
                                                                                    <p class="mb-2 text-muted small fw-bold text-uppercase">Select Multiple:</p>
                                                                                    @if($question->options)
                                                                                        <div class="d-flex flex-wrap gap-3">
                                                                                            @foreach(json_decode($question->options) as $optIndex => $option)
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input" type="checkbox" name="answers[{{ $question->id }}][]" id="q{{ $question->id }}_opt{{ $optIndex }}" value="{{ $option }}">
                                                                                                    <label class="form-check-label" for="q{{ $question->id }}_opt{{ $optIndex }}">
                                                                                                        {{ $option }}
                                                                                                    </label>
                                                                                                </div>
                                                                                            @endforeach
                                                                                        </div>
                                                                                    @endif
                                                                                </div>
                                                                                @break

                                                                            @case('rating')
                                                                                <div class="bg-white p-3 rounded shadow-sm border-0 text-center">
                                                                                    <p class="mb-2 text-muted small fw-bold text-uppercase">Rate 1-5:</p>
                                                                                    <div class="rating-input d-flex justify-content-center gap-2">
                                                                                        @for($i = 1; $i <= 5; $i++)
                                                                                            <div class="form-check form-check-inline me-0">
                                                                                                <input class="form-check-input btn-check" type="radio" name="answers[{{ $question->id }}]" id="q{{ $question->id }}_rate{{ $i }}" value="{{ $i }}" {{ $question->is_required ? 'required' : '' }}>
                                                                                                <label class="btn btn-outline-warning rounded-circle d-flex align-items-center justify-content-center p-0" style="width: 40px; height: 40px;" for="q{{ $question->id }}_rate{{ $i }}">
                                                                                                    {{ $i }}
                                                                                                </label>
                                                                                            </div>
                                                                                        @endfor
                                                                                    </div>
                                                                                </div>
                                                                                @break

                                                                            @default
                                                                                <input type="text" class="form-control" name="answers[{{ $question->id }}]" {{ $question->is_required ? 'required' : '' }}>
                                                                        @endswitch
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="flex-shrink-0 ms-3">
                                                                    <div class="avatar-sm bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center">
                                                                        <i class="bi bi-person-fill text-success fs-5"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                @if(!$userResponse)
                                                <div class="text-end mt-4 pt-3 border-top">
                                                    <button type="submit" class="btn btn-primary px-5 py-3 rounded-pill shadow fw-bold hover-scale">
                                                        <i class="bi bi-send-fill me-2"></i>Submit Response
                                                    </button>
                                                </div>
                                                </form>
                                                @else
                                                </div>
                                                @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- SDG & Alignment Tab -->
        <div class="tab-pane fade" id="alignment" role="tabpanel">
            <!-- SDG Alignment -->
            {{-- @dd($project->sdg_goals); --}}
            @if(isset($project->sdg_goals) && count($project->sdg_goals) > 0)
            <div class="mb-5">
                <div class="d-flex align-items-center mb-4">
                    <img
                        src="{{ asset('resource/web/assets/media/sdg_icon.png') }}"
                        class="img-fluid w-50 w-md-50"
                        alt="SDG Icon">
                    {{-- <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">
                        <i class="bi bi-globe-americas fs-2 text-success"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0">SDG Goals</h4>
                        <p class="text-muted mb-0">Sustainable Development Goals</p>
                    </div> --}}
                </div>

                <div class="row g-3">
                    @foreach($project->sdg_goals as $sdgId)
                    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                        <div class="card border-0 shadow-sm h-100 hover-lift text-center">
                            @php
                                $sdg = App\Helpers\SDGHelper::getSDGById($sdgId);
                                $sdgColor = $sdg['color'] ?? '4C9F38';
                            @endphp
                            <div class="card-body p-3">
                                <div class="mb-2">
                                    <img src="{{ $sdg['image_url'] ?? '' }}"
                                         alt="SDG {{ $sdgId }}"
                                         class="img-fluid rounded"
                                         style="    height: auto;
    width: 100%; object-fit: contain;">
                                </div>
                                <h6 class="fw-bold mb-1" style="color: #{{ $sdgColor }}">Goal {{ $sdgId }}</h6>
                                <small class="text-muted d-block" style="font-size: 0.7rem; line-height: 1.2;">
                                    {{ Str::limit($sdg['name'] ?? '', 30) }}
                                </small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Strategic Alignment -->
            @if(!empty($project->alignment_categories) || !empty($project->govt_schemes) || $project->alignment_notes)
            <div>
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                        <i class="bi bi-diagram-3 fs-2 text-white"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0">Strategic</h4>
                        <p class="text-muted mb-0">Government Schemes & Policies</p>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        @if(!empty($project->alignment_categories))
                        <div class="mb-4">
                            <h6 class="text-muted small text-uppercase mb-3 fw-bold">Focus Areas</h6>
                            <div class="d-flex flex-wrap gap-2 text-white">
                                @php
                                    $alignmentLabels = [
                                        'sdg' => 'SDG Goals',
                                        'nep2020' => 'NEP 2020',
                                        'skill_india' => 'Skill India',
                                        'nsqf' => 'NSQF',
                                        'govt_schemes' => 'Govt Schemes',
                                        'csr_schedule_vii' => 'CSR Schedule VII',
                                    ];
                                @endphp
                                @foreach($project->alignment_categories as $cat)
                                <span class="badge bg-primary bg-opacity-10 text- border border-primary border-opacity-25 px-3 py-2">
                                    {{ $alignmentLabels[$cat] ?? ucfirst(str_replace('_', ' ', $cat)) }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        @if(!empty($project->govt_schemes))
                        <div class="mb-4">
                            <h6 class="text-muted small text-uppercase mb-3 fw-bold">Government Schemes</h6>
                            <div class="d-flex flex-wrap gap-2">
                                @php
                                    $schemes = is_string($project->govt_schemes)
                                        ? json_decode($project->govt_schemes, true)
                                        : $project->govt_schemes;
                                @endphp

                                @if(!empty($schemes))
                                    @foreach($schemes as $scheme)
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2">
                                            {{ $govtSchemeTitles[$scheme] ?? ucfirst(str_replace('_', ' ', $scheme)) }}
                                        </span>
                                    @endforeach
                                @endif

                            </div>
                        </div>
                        @endif

                        @if($project->alignment_notes)
                        <div class="pt-3 border-top">
                            <h6 class="text-muted small text-uppercase mb-2 fw-bold">Alignment Notes</h6>
                            <p class="mb-0">{{ $project->alignment_notes }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Project Stats Overview -->
<div class="bg-light py-5 mt-5">
    <div class="container">
        <div class="row g-4">
            <!-- Funding Progress -->
            @if(isset($estimation) && $estimation->total_amount > 0)
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h5 class="card-title fw-bold mb-1">Funding Progress</h5>
                                <small class="text-muted">Goal: ₹ {{ number_format($estimation->total_amount) }}</small>
                            </div>
                            <span class="badge bg-success">Active</span>
                        </div>

                        @php
                            $progressPercentage = $estimation->total_amount > 0 ? ($totalRaised / $estimation->total_amount) * 100 : 0;
                        @endphp

                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Raised: ₹ {{ number_format($totalRaised) }}</span>
                                <span class="text-primary fw-bold">{{ number_format($progressPercentage, 1) }}%</span>
                            </div>
                            <div class="progress" style="height: 10px;">
                                <div class="progress-bar bg-success" role="progressbar"
                                     style="width: {{ min($progressPercentage, 100) }}%;"
                                     aria-valuenow="{{ $progressPercentage }}"
                                     aria-valuemin="0"
                                     aria-valuemax="100"></div>
                            </div>
                        </div>

                        <!-- Funding Sources Chart -->
                        @if($donors->count() > 0)
                        <div class="mt-4">
                            <h6 class="fw-bold mb-3">Funding Sources</h6>
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <canvas id="fundingChart" height="120"></canvas>
                                </div>
                                <div class="col-4">
                                    <div class="list-group list-group-flush">
                                        @foreach($donors->take(3) as $donor)
                                        <div class="list-group-item border-0 px-0 py-1">
                                            <div class="d-flex align-items-center mb-1">
                                                <div class="bg-primary rounded-circle me-2"
                                                     style="width: 8px; height: 8px; background-color: {{ ['#4e73df', '#1cc88a', '#36b9cc'][$loop->index] ?? '#e74a3b' }}!important"></div>
                                                <small class="text-truncate">{{ $donor->name }}</small>
                                            </div>
                                            <small class="text-muted">₹ {{ number_format($donor->amount) }}</small>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <!-- Milestone Progress -->
            @if(isset($milestones) && $milestones->count() > 0)
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h5 class="card-title fw-bold mb-1">Project Timeline</h5>
                                <small class="text-muted">{{ $milestones->count() }} milestones</small>
                            </div>
                            <span class="badge bg-info">Active</span>
                        </div>

                        @php
                            $completedMilestones = $milestones->where('status', 'completed')->count();
                            $inProgressMilestones = $milestones->where('status', 'in-progress')->count();
                            $totalMilestones = $milestones->count();
                            $overallProgress = $totalMilestones > 0 ? (($completedMilestones * 100) + ($inProgressMilestones * 50)) / $totalMilestones : 0;
                        @endphp

                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Overall Progress</span>
                                <span class="text-primary fw-bold">{{ number_format($overallProgress, 1) }}%</span>
                            </div>
                            <div class="progress" style="height: 10px;">
                                <div class="progress-bar bg-info progress-bar-striped" role="progressbar"
                                     style="width: {{ $overallProgress }}%;"
                                     aria-valuenow="{{ $overallProgress }}"
                                     aria-valuemin="0"
                                     aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <div class="text-center">
                                    <div class="bg-success bg-opacity-10 rounded-circle p-2 d-inline-block mb-2">
                                        <i class="bi bi-check-circle text-success"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold">{{ $completedMilestones }}</div>
                                        <small class="text-muted">Completed</small>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <div class="bg-warning bg-opacity-10 rounded-circle p-2 d-inline-block mb-2">
                                        <i class="bi bi-arrow-repeat text-warning"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold">{{ $inProgressMilestones }}</div>
                                        <small class="text-muted">In Progress</small>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <div class="bg-secondary bg-opacity-10 rounded-circle p-2 d-inline-block mb-2">
                                        <i class="bi bi-clock text-secondary"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold">{{ $totalMilestones - $completedMilestones - $inProgressMilestones }}</div>
                                        <small class="text-muted">Pending</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Missing Cursor Elements (Required by app.js) -->
<div id="cursor" style="position: fixed; pointer-events: none; z-index: 10000;"></div>
<div id="cursor-border" style="position: fixed; pointer-events: none; z-index: 9999;"></div>

<!-- Map Modal -->
<div class="modal fade" id="mapModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Project Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <div id="projectMap" style="height: 400px; width: 100%;"></div>
                @if($project->location_summary)
                <div class="p-4 border-top">
                    <p class="mb-0"><strong>Location Summary:</strong> {{ $project->location_summary }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Contact Modal -->
<!-- Donors Modal (Actual & Pledged) -->
<div class="modal fade" id="donorsModal" tabindex="-1" aria-labelledby="donorsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white border-0 py-4">
                <div class="d-flex align-items-center">
                    <div class="bg-white bg-opacity-25 rounded-circle p-2 me-3">
                        <i class="bi bi-people-fill text-black fs-4"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold mb-0 text-white" id="donorsModalLabel">Project Supporters</h5>
                        <small class="opacity-75">Every contribution brings us closer to our goal</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <!-- Tabs Navigation -->
                <ul class="nav nav-tabs nav-fill bg-light border-0" id="supporterTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active py-3 fw-bold border-0 rounded-0" id="actual-tab" data-bs-toggle="tab" data-bs-target="#actual-pane" type="button" role="tab" aria-controls="actual-pane" aria-selected="true">
                            <i class="bi bi-patch-check-fill me-2 text-success"></i>Major Contributions
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link py-3 fw-bold border-0 rounded-0" id="pledged-tab" data-bs-toggle="tab" data-bs-target="#pledged-pane" type="button" role="tab" aria-controls="pledged-pane" aria-selected="false">
                            <i class="bi bi-clock-history me-2 text-info"></i>Pledged Support
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="supporterTabsContent">
                    <!-- Actual Contributions Pane -->
                    <div class="tab-pane fade show active" id="actual-pane" role="tabpanel" aria-labelledby="actual-tab">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0 ps-4 py-3 text-uppercase small fw-bold text-muted">Contributor</th>
                                        <th class="border-0 py-3 text-uppercase small fw-bold text-muted text-end">Received Amount</th>
                                        <th class="border-0 py-3 text-uppercase small fw-bold text-muted text-center pe-4">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $groupedFundings = $fundings->groupBy('source_type')->map(function($items) {
                                            return [
                                                'name' => $items->first()->source_type,
                                                'amount' => $items->sum('amount')
                                            ];
                                        })->sortByDesc('amount');
                                    @endphp

                                    @forelse($groupedFundings as $supporter)
                                    <tr>
                                        <td class="ps-4 py-3">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle-sm bg-success bg-opacity-10 text-success fw-bold me-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                    {{ strtoupper(substr($supporter['name'], 0, 1)) }}
                                                </div>
                                                <div>
                                                    <span class="fw-bold d-block">{{ $supporter['name'] }}</span>
                                                    <small class="text-muted">Verified Source</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end py-3">
                                            <span class="fw-bold text-success fs-6">₹ {{ number_format($supporter['amount']) }}</span>
                                        </td>
                                        <td class="text-center pe-4 py-3">
                                            <span class="badge bg-success bg-opacity-10 text-success border-0 rounded-pill px-3">Verified</span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-5 text-muted">
                                            <i class="bi bi-info-circle mb-2 d-block fs-3"></i>
                                            No verified contributions recorded yet.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                @if($groupedFundings->count() > 0)
                                <tfoot class="bg-light">
                                    <tr>
                                        <td class="ps-4 py-3 fw-bold">Total Verified Funds</td>
                                        <td class="text-end py-3 fw-bold fs-5 text-success">₹ {{ number_format($totalReceived) }}</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                                @endif
                            </table>
                        </div>
                    </div>

                    <!-- Pledged Support Pane -->
                    <div class="tab-pane fade" id="pledged-pane" role="tabpanel" aria-labelledby="pledged-tab">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0 ps-4 py-3 text-uppercase small fw-bold text-muted">Donor Name</th>
                                        <th class="border-0 py-3 text-uppercase small fw-bold text-muted text-end">Pledged Amount</th>
                                        <th class="border-0 py-3 text-uppercase small fw-bold text-muted text-center pe-4">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($donors->sortByDesc('amount') as $donor)
                                    <tr>
                                        <td class="ps-4 py-3">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle-sm bg-info bg-opacity-10 text-info fw-bold me-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                    {{ strtoupper(substr($donor->name, 0, 1)) }}
                                                </div>
                                                <span class="fw-bold">{{ $donor->name }}</span>
                                            </div>
                                        </td>
                                        <td class="text-end py-3">
                                            <span class="fw-bold text-dark">₹ {{ number_format($donor->amount) }}</span>
                                        </td>
                                        <td class="text-center pe-4 py-3">
                                            <span class="badge bg-info bg-opacity-10 text-info border-0 rounded-pill px-3">Pledged</span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-5 text-muted">
                                            <i class="bi bi-info-circle mb-2 d-block fs-3"></i>
                                            No pledges recorded yet.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                @if($donors->count() > 0)
                                <tfoot class="bg-light">
                                    <tr>
                                        <td class="ps-4 py-3 fw-bold">Total Pledged Support</td>
                                        <td class="text-end py-3 fw-bold fs-5 text-primary">₹ {{ number_format($totalRaised) }}</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 bg-light py-3">
                <button type="button" class="btn btn-secondary px-4 rounded-pill" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-success px-4 rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#contactModal">
                    <i class="bi bi-hand-thumbs-up me-2"></i>I want to support!
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="contactModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Register Your Interest</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form id="interestForm">
                    @csrf
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Name *</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Email *</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Organization</label>
                        <input type="text" name="organization" class="form-control">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Message</label>
                        <textarea name="message" class="form-control" rows="3"
                                  placeholder="I'm interested in supporting this project..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-success w-100 py-2">
                        <i class="bi bi-send me-2"></i>Submit Interest
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightbox2@2.11.4/dist/css/lightbox.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
    /* Lightbox Fix - Force Modal to Center */
    .lightboxOverlay {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        width: 100vw !important;
        height: 100vh !important;
        z-index: 9999 !important;
        background: rgba(0,0,0,0.85) !important;
    }

    .lightbox {
        position: fixed !important;
        top: 50% !important;
        left: 50% !important;
        transform: translate(-50%, -50%) !important;
        z-index: 10000 !important;
        margin: 0 !important;
    }

    .lb-outerContainer {
        background-color: #fff;
        border-radius: 8px;
        overflow: hidden;
    }

    .lb-dataContainer {
        padding: 10px 0;
    }

    .project-hero {
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        min-height: 70vh;
        display: flex;
        align-items: center;
        position: relative;
    }

    .min-vh-70 {
        min-height: 70vh;
    }

    .z-2 {
        position: relative;
        z-index: 2;
    }

    .hover-lift {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }

    .btn-outline-purple {
        color: #6f42c1;
        border-color: #6f42c1;
    }

    .btn-outline-purple:hover {
        color: #fff;
        background-color: #6f42c1;
        border-color: #6f42c1;
    }

    .animate-bounce {
        animation: bounce 2s infinite;
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-10px);
        }
        60% {
            transform: translateY(-5px);
        }
    }

    /* Circular Charts */
    .circular-chart {
        display: block;
        margin: 10px auto;
    }

    .circle-bg {
        fill: none;
        stroke: #e6e6e6;
        stroke-width: 3.8;
    }

    .circle {
        fill: none;
        stroke-width: 2.8;
        stroke-linecap: round;
        animation: progress 1s ease-out forwards;
    }

    @keyframes progress {
        0% {
            stroke-dasharray: 0 100;
        }
    }

    .percentage {
        fill: #4e73df;
        font-family: sans-serif;
        font-size: 0.5em;
        text-anchor: middle;
        font-weight: bold;
    }

    /* Gallery Filter */
    .gallery-section {
        transition: opacity 0.3s ease;
    }

    /* Responsive Tables */
    @media (max-width: 768px) {
        .table-responsive {
            border: 0;
        }

        .table thead {
            display: none;
        }

        .table tr {
            display: block;
            margin-bottom: 1rem;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
        }

        .table td {
            display: block;
            text-align: right;
            padding: 0.75rem;
            position: relative;
            border: none;
            border-bottom: 1px solid #dee2e6;
        }

        .table td:last-child {
            border-bottom: 0;
        }

        .table td::before {
            content: attr(data-label);
            position: absolute;
            left: 0.75rem;
            width: 50%;
            padding-right: 0.75rem;
            text-align: left;
            font-weight: bold;
            color: #495057;
        }

        /* Add data-label attributes via JavaScript */
    }

    /* Improved Badges */
    .badge {
        font-weight: 500;
        letter-spacing: 0.5px;
    }

    /* Custom Scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }

    /* ========================================
       SURVEY FEEDBACK SECTION STYLES
       ======================================== */

    .btn-outline-teal {
        color: #20c997;
        border-color: #20c997;
    }

    .btn-outline-teal:hover,
    .btn-outline-teal.active {
        background-color: #20c997;
        border-color: #20c997;
        color: white;
    }

    .text-teal {
        color: #20c997 !important;
    }

    .survey-feedback-card {
        transition: all 0.3s ease;
        border-radius: 12px !important;
    }

    .survey-feedback-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1) !important;
    }

    .survey-avatar > div {
        transition: transform 0.3s ease;
    }

    .survey-feedback-card:hover .survey-avatar > div {
        transform: scale(1.1);
    }

    .survey-comment {
        position: relative;
    }

    .survey-comment .bi-quote {
        position: absolute;
        top: -5px;
        left: 10px;
        opacity: 0.3;
    }

    .expand-comment {
        font-size: 0.85rem;
        text-decoration: none;
    }

    .expand-comment:hover {
        text-decoration: underline;
    }

    #satisfactionChart {
        max-height: 200px;
    }

    .circular-chart-success .circle {
        animation: progress-success 1s ease-out forwards;
    }

    @keyframes progress-success {
        0% {
            stroke-dasharray: 0 100;
        }
    }

    .read-more-container {
    position: relative;
    padding-bottom: 20px;
}

.read-more-btn {
    position: absolute;
    bottom: 0;
    left: 0;
    font-size: 0.875rem;
    text-decoration: none;
}

.read-more-btn:hover {
    text-decoration: underline;
}

/* Course Card Unavailable State */
.course-card.unavailable .card-img-top,
.course-card.unavailable .card-body {
    filter: blur(3px) grayscale(100%);
    opacity: 0.7;
    pointer-events: none;
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightbox2@2.11.4/dist/js/lightbox.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key', 'YOUR_GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    // Initialize Swipers for Pathway Tab
    document.addEventListener('DOMContentLoaded', function() {
        // Sector Swiper
        new Swiper(".sector-swiper", {
            slidesPerView: "auto",
            spaceBetween: 10,
            freeMode: true,
        });

        // Course Swiper
        new Swiper(".course-swiper", {
            slidesPerView: 1,
            spaceBetween: 20,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                640: { slidesPerView: 2, spaceBetween: 20 },
                1024: { slidesPerView: 3, spaceBetween: 20 },
            }
        });

        // Roadmap Swiper
        new Swiper(".roadmap-swiper", {
            slidesPerView: 1,
            spaceBetween: 16,
            breakpoints: {
                640: { slidesPerView: 2, spaceBetween: 16 },
                1024: { slidesPerView: 4, spaceBetween: 16 },
            }
        });

        // Flow Swiper (Timeline)
        new Swiper(".flow-swiper", {
            slidesPerView: 1,
            spaceBetween: 20,
            breakpoints: {
                640: { slidesPerView: 2, spaceBetween: 20 },
                1024: { slidesPerView: 4, spaceBetween: 20 },
            }
        });
    });

// Initialize lightbox
lightbox.option({
    'resizeDuration': 200,
    'wrapAround': true,
    'albumLabel': "Image %1 of %2",
    'fadeDuration': 300,
    'positionFromTop': 0,
    'fitImagesInViewport': true
});

// Fix lightbox position after it opens
document.addEventListener('click', function(e) {
    const link = e.target.closest('[data-lightbox]');
    if (link) {
        setTimeout(function() {
            const lightbox = document.getElementById('lightbox');
            const overlay = document.getElementById('lightboxOverlay');
            if (lightbox) {
                lightbox.style.cssText = 'position: fixed !important; top: 50% !important; left: 50% !important; transform: translate(-50%, -50%) !important; z-index: 10000 !important; margin: 0 !important;';
            }
            if (overlay) {
                overlay.style.cssText = 'position: fixed !important; top: 0 !important; left: 0 !important; width: 100vw !important; height: 100vh !important; z-index: 9999 !important;';
            }
        }, 100);
    }
});

// Filter milestones
function filterMilestones(status) {
    const items = document.querySelectorAll('.milestone-item');
    items.forEach(item => {
        if (status === 'all' || item.dataset.status === status) {
            item.style.display = 'block';
            item.classList.add('animate__animated', 'animate__fadeIn');
        } else {
            item.style.display = 'none';
        }
    });
}

// Filter gallery sections
function filterGallery(section, event) {
    const sections = document.querySelectorAll('.gallery-section');
    sections.forEach(sec => {
        sec.style.display = 'none';
    });

    // Handle button active state
    if (event && event.target) {
        const buttons = event.target.closest('.btn-group').querySelectorAll('.btn');
        buttons.forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');
    }

    if (section === 'all') {
        sections.forEach(sec => {
            sec.style.display = 'block';
        });
    } else {
        const targetSec = document.getElementById(section + '-section');
        if (targetSec) targetSec.style.display = 'block';
    }
}

// Social sharing
function shareProject(platform, url, title) {
    let shareUrl = '';
    const encodedUrl = encodeURIComponent(url);
    const encodedTitle = encodeURIComponent(title);

    switch(platform) {
        case 'facebook':
            shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}`;
            break;
        case 'twitter':
            shareUrl = `https://twitter.com/intent/tweet?url=${encodedUrl}&text=${encodedTitle}`;
            break;
        case 'whatsapp':
            shareUrl = `https://api.whatsapp.com/send?text=${encodedTitle}%20${encodedUrl}`;
            break;
        case 'linkedin':
            shareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${encodedUrl}`;
            break;
    }

    if (shareUrl) {
        window.open(shareUrl, '_blank', 'width=600,height=400,menubar=no,toolbar=no,resizable=yes,scrollbars=yes');
    }
}

// Copy to clipboard
function copyToClipboard(text, element) {
    const target = element || (event ? event.target : null);
    if (!target) return;

    navigator.clipboard.writeText(text).then(() => {
        const originalText = target.innerHTML;
        target.innerHTML = '<i class="bi bi-check"></i>';
        target.classList.remove('btn-outline-secondary');
        target.classList.add('btn-success');

        setTimeout(() => {
            target.innerHTML = originalText;
            target.classList.remove('btn-success');
            target.classList.add('btn-outline-secondary');
        }, 2000);
    });
}

// Google Maps callback
function initMap() {
    console.log("Google Maps API ready");
}

// Show map modal
function showMap(coordinates) {
    $('#mapModal').modal('show');

    if (coordinates) {
        const [lat, lng] = coordinates.split(',').map(coord => parseFloat(coord.trim()));
        if (!isNaN(lat) && !isNaN(lng)) {
            setTimeout(() => {
                const map = new google.maps.Map(document.getElementById('projectMap'), {
                    center: { lat: lat, lng: lng },
                    zoom: 12,
                    styles: [
                        {
                            featureType: "all",
                            elementType: "labels.text.fill",
                            stylers: [{ color: "#7c93a3" }]
                        },
                        {
                            featureType: "all",
                            elementType: "labels.text.stroke",
                            stylers: [{ visibility: "on" }, { color: "#ffffff" }, { weight: 2 }]
                        }
                    ]
                });

                new google.maps.Marker({
                    position: { lat: lat, lng: lng },
                    map: map,
                    title: 'Project Location',
                    icon: {
                        path: google.maps.SymbolPath.CIRCLE,
                        fillColor: '#4e73df',
                        fillOpacity: 1,
                        strokeColor: '#ffffff',
                        strokeWeight: 2,
                        scale: 8
                    }
                });
            }, 500);
        }
    }
}

// Make tables responsive on mobile
document.addEventListener('DOMContentLoaded', function() {
    // Add data-labels to table cells for mobile view
    const tables = document.querySelectorAll('.table');
    tables.forEach(table => {
        if (window.innerWidth < 768) {
            const headers = Array.from(table.querySelectorAll('thead th')).map(th => th.textContent.trim());
            const rows = table.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                cells.forEach((cell, index) => {
                    if (headers[index]) {
                        cell.setAttribute('data-label', headers[index]);
                    }
                });
            });
        }
    });

    // Chart Initialization
    const fundingCtx = document.getElementById('fundingChart');
    if (fundingCtx) {
        @if(isset($donors) && $donors->count() > 0)
        const donors = @json($donors);
        const donorNames = donors.map(d => d.name.substring(0, 12) + (d.name.length > 12 ? '...' : ''));
        const donorAmounts = donors.map(d => d.amount);
        const colors = ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796'];

        new Chart(fundingCtx, {
            type: 'doughnut',
            data: {
                labels: donorNames,
                datasets: [{
                    data: donorAmounts,
                    backgroundColor: colors.slice(0, donorNames.length),
                    borderWidth: 1,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += '₹ ' + context.parsed.toLocaleString();
                                return label;
                            }
                        }
                    },
                    datalabels: { display: false }
                },
                cutout: '60%'
            }
        });
        @endif
    }

    // Budget Chart
    const budgetCtx = document.getElementById('budgetChart');
    if (budgetCtx) {
        @if(isset($estimation) && $estimation->items->count() > 0)
        const items = @json($estimation->items);
        const categories = {};
        items.forEach(item => {
            categories[item.category] = (categories[item.category] || 0) + item.total_cost;
        });

        const chartData = {
            labels: Object.keys(categories),
            datasets: [{
                data: Object.values(categories),
                backgroundColor: [
                    '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e',
                    '#e74a3b', '#858796', '#6f42c1', '#20c997'
                ],
                borderWidth: 1,
                borderColor: '#fff'
            }]
        };

        new Chart(budgetCtx, {
            type: 'pie',
            data: chartData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            padding: 15,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    datalabels: { display: false }
                }
            }
        });
        @endif
    }
});

// Interest Form Submission
$('#interestForm').on('submit', function(e) {
    e.preventDefault();

    const submitBtn = $(this).find('button[type="submit"]');
    const originalText = submitBtn.html();

    submitBtn.prop('disabled', true);
    submitBtn.html('<span class="spinner-border spinner-border-sm me-2"></span>Submitting...');

    $.ajax({
        url: '{{ route("web.project.interest") }}',
        method: 'POST',
        data: $(this).serialize(),
        success: function(response) {
            if (response.success) {
                submitBtn.removeClass('btn-success').addClass('btn-success');
                submitBtn.html('<i class="bi bi-check-lg me-2"></i>Submitted Successfully!');

                setTimeout(() => {
                    $('#contactModal').modal('hide');
                    submitBtn.html(originalText);
                    submitBtn.prop('disabled', false);
                    $('#interestForm')[0].reset();
                }, 1500);
            }
        },
        error: function() {
            submitBtn.html('<i class="bi bi-x-circle me-2"></i>Error! Try Again');
            submitBtn.removeClass('btn-success').addClass('btn-danger');

            setTimeout(() => {
                submitBtn.html(originalText);
                submitBtn.removeClass('btn-danger').addClass('btn-success');
                submitBtn.prop('disabled', false);
            }, 2000);
        }
    });
});

// Consolidated Tab navigation with URL hash
document.addEventListener('DOMContentLoaded', function() {
    const hash = window.location.hash;
    if (hash) {
        // Try to find a button trigger first (Bootstrap 5)
        const triggerEl = document.querySelector(`button[data-bs-target="${hash}"]`) ||
                          document.querySelector(`[href="${hash}"]`);

        if (triggerEl) {
            // Activate the tab
            const tab = new bootstrap.Tab(triggerEl);
            tab.show();

            // Scroll into view
            setTimeout(() => {
                triggerEl.scrollIntoView({behavior: 'smooth', block: 'center'});
            }, 100);
        }
    }

    // Update URL hash when tab changes
    const tabLinks = document.querySelectorAll('[data-bs-toggle="pill"], [data-bs-toggle="tab"]');
    tabLinks.forEach(tab => {
        tab.addEventListener('shown.bs.tab', function(e) {
            const targetId = e.target.getAttribute('data-bs-target') || e.target.getAttribute('href');
            if (targetId) {
                // Update hash without scrolling
                history.replaceState(null, null, targetId);

                // Helper: Sync active state for potential duplicate links (mobile/desktop)
                const allLinks = document.querySelectorAll(`[data-bs-target="${targetId}"], [href="${targetId}"]`);
                allLinks.forEach(link => {
                     // Ensure parent navs update active state if needed
                     const nav = link.closest('.nav, .list-group');
                     if(nav){
                         nav.querySelectorAll('.active').forEach(a => a.classList.remove('active'));
                         link.classList.add('active');
                     }
                });
            }
        });
    });

    // Read more/less functionality
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('read-more-btn')) {
            const previewId = e.target.getAttribute('data-preview');
            const fullId = e.target.getAttribute('data-full');
            const previewElement = document.getElementById(previewId);
            const fullElement = document.getElementById(fullId);
            const button = e.target;

            if (previewElement && fullElement) {
                if (previewElement.classList.contains('d-none')) {
                    previewElement.classList.remove('d-none');
                    fullElement.classList.add('d-none');
                    button.textContent = 'Read more...';
                } else {
                    previewElement.classList.add('d-none');
                    fullElement.classList.remove('d-none');
                    button.textContent = 'Read less';
                }
            }
        }
    });
});
</script>
@endpush

<!-- Execution Calculation Guide Modal -->
<div class="modal fade" id="calculationGuideModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold text-primary"><i class="bi bi-calculator me-2"></i>Dashboard Metrics Guide</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-4">
                    <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">1. Execution Confidence Index</h6>
                    <p class="small text-muted mb-2">
                        This index reflects the project's readiness and momentum. It is directly controlled by the Admin based on milestone completion and resource availability.
                    </p>
                    <div class="alert alert-light border-start border-primary border-3">
                        <small>
                            <strong>Formula:</strong> Direct input from Admin Panel ("Completion Readiness").<br>
                            <strong>Example:</strong> If the admin sets readiness to <strong>85%</strong>, the gauge shows 85%.
                        </small>
                    </div>
                </div>

                <div>
                    <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">2. Project Risk Assessment</h6>
                    <p class="small text-muted mb-2">
                        The risk score is a weighted sum of all identified risks. Each risk type has a severity multiplier.
                    </p>
                    <ul class="list-unstyled small text-muted mb-3">
                        <li><span class="badge bg-danger">High</span> Impact = 3 points</li>
                        <li><span class="badge bg-warning text-dark">Medium</span> Impact = 2 points</li>
                        <li><span class="badge bg-success">Low</span> Impact = 1 point</li>
                    </ul>
                    <div class="alert alert-light border-start border-warning border-3">
                        <small>
                            <strong>Calculation Example:</strong><br>
                            1 High Risk (3) + 2 Medium Risks (2+2) + 1 Low Risk (1)<br>
                            <strong>Total Score = 8</strong> (Medium Risk Level)
                        </small>
                    </div>
                    <div class="d-flex justify-content-between small text-muted mt-2">
                        <span>Low Risk: < 5</span>
                        <span>Medium Risk: 5 - 10</span>
                        <span>High Risk: > 10</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if($project->stage == 'upcoming' && isset($surveys) && $surveys->count() > 0)
<!-- Floating Survey Button -->
<div class="position-fixed animate__animated animate__fadeInUp" style="bottom: 30px; right: 30px; z-index: 9999;">
    <button type="button" 
            class="btn btn-primary rounded-circle shadow-lg d-flex align-items-center justify-content-center position-relative"
            style="width: 65px; height: 65px; border: 4px solid rgba(255,255,255,0.3);"
            data-bs-toggle="modal" 
            data-bs-target="#surveyModal">
        <i class="bi bi-clipboard-data-fill fs-3"></i>
        <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle animate__animated animate__pulse animate__infinite">
            <span class="visually-hidden">New Survey</span>
        </span>
    </button>
    <div class="bg-white px-3 py-1 rounded shadow-sm mt-2 text-center small fw-bold text-primary animate__animated animate__fadeIn animate__delay-1s border">
        Participate
    </div>
</div>

<!-- Survey Modal -->
<div class="modal fade" id="surveyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white border-0">
                <h5 class="modal-title fw-bold text-white"><i class="bi bi-clipboard-data me-2"></i>Project Scrutiny Survey</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light">
                <div class="accordion" id="surveyModalAccordion">
                    @foreach($surveys as $index => $survey)
                        @if($survey->is_active)
                            <div class="accordion-item mb-3 border-0 shadow-sm rounded overflow-hidden">
                                <h2 class="accordion-header" id="modalHeading{{ $survey->id }}">
                                    <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }} fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#modalCollapse{{ $survey->id }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="modalCollapse{{ $survey->id }}">
                                        <i class="bi bi-caret-right-fill me-2 text-primary"></i> {{ $survey->title }}
                                    </button>
                                </h2>
                                <div id="modalCollapse{{ $survey->id }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="modalHeading{{ $survey->id }}" data-bs-parent="#surveyModalAccordion">
                                    <div class="accordion-body p-4 bg-white">
                                        @if($survey->description)
                                            <p class="text-muted mb-4">{{ $survey->description }}</p>
                                        @endif

                                        @php
                                            $userResponse = $survey->responses->first();
                                        @endphp

                                        @if($userResponse)
                                            <div class="alert alert-success border-0 bg-success bg-opacity-10 mb-4 rounded-3 d-flex align-items-center">
                                                <i class="bi bi-check-circle-fill text-success fs-4 me-3"></i>
                                                <div>
                                                    <h5 class="fw-bold text-success mb-1">Response Submitted</h5>
                                                    <p class="mb-0 text-success text-opacity-75 small">You have already responded. Answers are shown below.</p>
                                                </div>
                                            </div>
                                        @else
                                            <form class="scrutiny-form" action="{{ route('web.project.survey.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="survey_id" value="{{ $survey->id }}">
                                        @endif

                                            <div class="survey-conversation">
                                                @foreach($survey->questions as $qIndex => $question)
                                                    <div class="mb-4 animate__animated animate__fadeInUp" style="animation-delay: {{ $qIndex * 100 }}ms;">
                                                        <div class="mb-2 d-flex align-items-center">
                                                            <span class="badge bg-primary me-2">Q{{ $qIndex + 1 }}</span>
                                                            <span class="fw-bold text-dark">{{ $question->question_text }}</span>
                                                            @if($question->is_required) <span class="text-danger ms-1">*</span> @endif
                                                        </div>
                                                        
                                                        <div class="ms-0 ms-md-4">
                                                            @if($userResponse)
                                                                <div class="p-3 bg-light rounded text-muted border-start border-4 border-success">
                                                                    @php
                                                                        $ans = isset($userResponse->answers) && is_array($userResponse->answers)
                                                                            ? ($userResponse->answers[$question->id] ?? null)
                                                                            : null;
                                                                        if(is_array($ans)) $ans = implode(', ', $ans);
                                                                    @endphp
                                                                    {{ $ans ?? 'No answer' }}
                                                                </div>
                                                            @else
                                                                @switch($question->type)
                                                                    @case('text')
                                                                        <input type="text" class="form-control" name="answers[{{ $question->id }}]" placeholder="Your answer..." {{ $question->is_required ? 'required' : '' }}>
                                                                        @break
                                                                    @case('textarea')
                                                                        <textarea class="form-control" name="answers[{{ $question->id }}]" rows="3" placeholder="Tell us more..." {{ $question->is_required ? 'required' : '' }}></textarea>
                                                                        @break
                                                                    @case('number')
                                                                        <input type="number" class="form-control" name="answers[{{ $question->id }}]" placeholder="0" {{ $question->is_required ? 'required' : '' }}>
                                                                        @break
                                                                    @case('date')
                                                                        <input type="date" class="form-control" name="answers[{{ $question->id }}]" {{ $question->is_required ? 'required' : '' }}>
                                                                        @break
                                                                    @case('select')
                                                                        <select class="form-select" name="answers[{{ $question->id }}]" {{ $question->is_required ? 'required' : '' }}>
                                                                            <option value="">Select option...</option>
                                                                            @if($question->options)
                                                                                @foreach(json_decode($question->options) as $opt)
                                                                                    <option value="{{ $opt }}">{{ $opt }}</option>
                                                                                @endforeach
                                                                            @endif
                                                                        </select>
                                                                        @break
                                                                    @case('radio')
                                                                        <div class="bg-light p-3 rounded">
                                                                            @if($question->options)
                                                                                @foreach(json_decode($question->options) as $opt)
                                                                                    <div class="form-check">
                                                                                        <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" value="{{ $opt }}" {{ $question->is_required ? 'required' : '' }}>
                                                                                        <label class="form-check-label">{{ $opt }}</label>
                                                                                    </div>
                                                                                @endforeach
                                                                            @endif
                                                                        </div>
                                                                        @break
                                                                    @case('checkbox')
                                                                        <div class="bg-light p-3 rounded">
                                                                            @if($question->options)
                                                                                @foreach(json_decode($question->options) as $opt)
                                                                                    <div class="form-check">
                                                                                        <input class="form-check-input" type="checkbox" name="answers[{{ $question->id }}][]" value="{{ $opt }}">
                                                                                        <label class="form-check-label">{{ $opt }}</label>
                                                                                    </div>
                                                                                @endforeach
                                                                            @endif
                                                                        </div>
                                                                        @break
                                                                    @case('rating')
                                                                        <div class="d-flex gap-2">
                                                                            @for($i=1; $i<=5; $i++)
                                                                                <div class="form-check form-check-inline">
                                                                                    <input class="form-check-input btn-check" type="radio" name="answers[{{ $question->id }}]" id="q{{$question->id}}_{{$i}}" value="{{ $i }}" {{ $question->is_required ? 'required' : '' }}>
                                                                                    <label class="btn btn-outline-warning rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;" for="q{{$question->id}}_{{$i}}">{{ $i }}</label>
                                                                                </div>
                                                                            @endfor
                                                                        </div>
                                                                        @break
                                                                @endswitch
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            @if(!$userResponse)
                                                <div class="text-end mt-4 pt-3 border-top">
                                                    <button type="submit" class="btn btn-primary rounded-pill px-5 shadow-sm">
                                                        <i class="bi bi-send-fill me-2"></i>Submit Response
                                                    </button>
                                                </div>
                                            </form>
                                            @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection
