{{-- @dd($project->sdg_goals); --}}
@extends('layouts.web.app')
@section('content')

<!-- Hero Section - Modernized -->
<div class="project-hero position-relative overflow-hidden"
     style="@if($project->thumbnail_image) background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.5)), url('{{ asset($project->thumbnail_image) }}'); @else background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); @endif">
    <div class="container position-relative py-5 z-2">
        <div class="row align-items-center min-vh-70">
            <div class="col-lg-8">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('web.catalog') }}" class="text-white text-decoration-none"><i class="bi bi-arrow-left me-1"></i> Back to Projects</a></li>
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
                                            @if($project->location_summary)
                                                {{ Str::limit($project->location_summary, 15) }}
                                            @else
                                                {{ Str::limit($project->district ?? 'N/A', 10) }}
                                            @endif
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
                                        <small class="text-black-50 d-block">TIMELINE</small>
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
            @if($project->stage == 'ongoing')
            <button class="nav-link btn btn-outline-danger rounded-pill px-4" id="execution-tab" data-bs-toggle="pill" data-bs-target="#execution" type="button" role="tab" aria-controls="execution" aria-selected="false">
                <i class="bi bi-activity me-2"></i>Execution
            </button>
            @endif
            <button class="nav-link btn btn-outline-purple rounded-pill px-4" id="resources-tab" data-bs-toggle="pill" data-bs-target="#resources" type="button" role="tab" aria-controls="resources" aria-selected="false">
                <i class="bi bi-shield-check me-2"></i>Resources & Risks
            </button>
            @if(isset($surveys) && $surveys->count() > 0)
            <button class="nav-link btn btn-outline-teal rounded-pill px-4" id="feedback-tab" data-bs-toggle="pill" data-bs-target="#feedback" type="button" role="tab" aria-controls="feedback" aria-selected="false">
                <i class="bi bi-chat-heart me-2"></i>Feedback <span class="badge bg-primary ms-1">{{ $surveys->count() }}</span>
            </button>
            @endif
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
                @if($project->stage == 'ongoing')
                <button class="list-group-item list-group-item-action py-3 d-flex align-items-center gap-3" data-bs-toggle="pill" data-bs-target="#execution" role="tab">
                    <i class="bi bi-activity fs-5 text-danger"></i>
                    <div>
                        <span class="d-block fw-bold">Execution</span>
                        <small class="text-muted">Live updates & challenges</small>
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
                @if(isset($surveys) && $surveys->count() > 0)
                <button class="list-group-item list-group-item-action py-3 d-flex align-items-center gap-3" data-bs-toggle="pill" data-bs-target="#feedback" role="tab">
                    <i class="bi bi-chat-heart fs-5" style="color: #20c997;"></i>
                    <div>
                        <span class="d-block fw-bold">Feedback <span class="badge bg-primary">{{ $surveys->count() }}</span></span>
                        <small class="text-muted">Survey responses & insights</small>
                    </div>
                </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Tab Content -->
    <div class="tab-content" id="projectTabContent">

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
                                        <h5 class="alert-heading fw-bold">In a Nutshell</h5>
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
                                    <i class="bi bi-bullseye me-2"></i>Key Objectives
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
                                <h5 class="fw-bold mb-3">Target Beneficiaries</h5>
                                <div class="row g-3">
                                    @foreach($targetGroups as $group)
                                    <div class="col-6 col-md-3">
                                        <div class="card border-0 text-center h-100 hover-lift">
                                            <div class="card-body py-4">
                                                @switch($group['group'] ?? '')
                                                    @case('students')
                                                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 mb-3 mx-auto" style="width: 70px; height: 70px;">
                                                            <i class="bi bi-mortarboard fs-2 text-primary"></i>
                                                        </div>
                                                        @break
                                                    @case('youth')
                                                        <div class="bg-success bg-opacity-10 rounded-circle p-3 mb-3 mx-auto" style="width: 70px; height: 70px;">
                                                            <i class="bi bi-people fs-2 text-success"></i>
                                                        </div>
                                                        @break
                                                    @case('women')
                                                        <div class="bg-danger bg-opacity-10 rounded-circle p-3 mb-3 mx-auto" style="width: 70px; height: 70px;">
                                                            <i class="bi bi-gender-female fs-2 text-danger"></i>
                                                        </div>
                                                        @break
                                                    @case('shg')
                                                        <div class="bg-warning bg-opacity-10 rounded-circle p-3 mb-3 mx-auto" style="width: 70px; height: 70px;">
                                                            <i class="bi bi-shop-window fs-2 text-warning"></i>
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
                                <h5 class="fw-bold mb-4">Key Performance Metrics</h5>
                                <div class="row g-4">
                                    @foreach((array) $project->donut_metrics as $metric)
                                    <div class="col-md-4">
                                        <div class="card border-0 shadow-sm h-100">
                                            <div class="card-body text-center p-4">
                                                <div class="position-relative d-inline-block mb-3">
                                                    <svg width="100" height="100" viewBox="0 0 36 36" class="circular-chart primary">
                                                        <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#e6e6e6" stroke-width="3"/>
                                                        <path class="circle" stroke-dasharray="{{ $metric['percentage'] ?? 0 }}, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#4e73df" stroke-width="3" stroke-linecap="round"/>
                                                        <text x="18" y="22" class="percentage" fill="#4e73df" font-size="8" text-anchor="middle" font-weight="bold">{{ $metric['percentage'] ?? 0 }}%</text>
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
            <div class="mb-4">
                <!-- Filter Buttons -->
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
                    <div>
                        <h4 class="mb-0 fw-bold">Project Milestones</h4>
                        <p class="text-muted mb-0">Track project progress and timelines</p>
                    </div>
                    <div class="btn-group btn-group-sm" role="group">
                        <input type="radio" class="btn-check" name="milestone-filter" id="filter-all" autocomplete="off" checked onclick="filterMilestones('all')">
                        <label class="btn btn-outline-primary" for="filter-all">All</label>

                        <input type="radio" class="btn-check" name="milestone-filter" id="filter-completed" autocomplete="off" onclick="filterMilestones('completed')">
                        <label class="btn btn-outline-success" for="filter-completed">Completed</label>

                        <input type="radio" class="btn-check" name="milestone-filter" id="filter-progress" autocomplete="off" onclick="filterMilestones('in-progress')">
                        <label class="btn btn-outline-warning" for="filter-progress">In Progress</label>

                        <input type="radio" class="btn-check" name="milestone-filter" id="filter-pending" autocomplete="off" onclick="filterMilestones('pending')">
                        <label class="btn btn-outline-secondary" for="filter-pending">Pending</label>
                    </div>
                </div>

                <!-- Milestones Grid -->
                <div class="row g-4" id="milestone-container">
                    @foreach($milestones->sortBy('phase') as $milestone)
                    <div class="col-12 col-md-6 col-lg-4 milestone-item" data-status="{{ $milestone->status }}">
                        <div class="card border-0 shadow-sm h-100 hover-lift">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div>
                                        <span class="badge bg-primary bg-opacity-10 text-white mb-2">{{ $milestone->phase }}</span>
                                        <h6 class="card-title fw-bold mb-2">{{ $milestone->task_name }}</h6>
                                    </div>
                                    <span class="badge
                                        @switch($milestone->status)
                                            @case('completed') bg-success @break
                                            @case('in-progress') bg-warning text-dark @break
                                            @case('on-hold') bg-danger @break
                                            @default bg-secondary
                                        @endswitch rounded-pill">
                                        {{ ucfirst($milestone->status) }}
                                    </span>
                                </div>

                                <!-- Progress -->
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted small">Progress</span>
                                        <span class="fw-bold {{ $milestone->progress == 100 ? 'text-success' : 'text-primary' }}">
                                            {{ $milestone->progress }}%
                                        </span>
                                    </div>
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar {{ $milestone->progress == 100 ? 'bg-success' : 'bg-primary' }} progress-bar-striped"
                                             style="width: {{ $milestone->progress }}%"></div>
                                    </div>
                                </div>

                                <!-- Details -->
                                <div class="row g-2 mb-3">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-calendar-event text-muted me-2 fs-6"></i>
                                            <div>
                                                <small class="text-muted d-block" style="font-size: 0.7rem;">Timeline</small>
                                                <span class="fw-semibold d-block" style="font-size: 0.8rem;">
                                                    {{ $milestone->planned_start_date ? date('d M', strtotime($milestone->planned_start_date)) : 'TBD' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-flag text-muted me-2 fs-6"></i>
                                            <div>
                                                <small class="text-muted d-block" style="font-size: 0.7rem;">Priority</small>
                                                <span class="badge
                                                    @switch($milestone->priority)
                                                        @case('high') bg-danger @break
                                                        @case('urgent') bg-danger @break
                                                        @case('medium') bg-warning @break
                                                        @default bg-info
                                                    @endswitch rounded-pill py-0 px-2" style="font-size: 0.7rem;">
                                                    {{ ucfirst($milestone->priority) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- People -->
                                @if($milestone->in_charge || ($milestone->stakeholder_id && isset($stakeholders[$milestone->stakeholder_id])))
                                <div class="border-top pt-3">
                                    <div class="d-flex justify-content-between">
                                        @if($milestone->in_charge)
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-person-check text-primary me-2"></i>
                                            <div>
                                                <small class="text-muted d-block">In Charge</small>
                                                <span class="fw-semibold">{{ $milestone->in_charge }}</span>
                                            </div>
                                        </div>
                                        @endif

                                        @if($milestone->stakeholder_id && isset($stakeholders[$milestone->stakeholder_id]))
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-building text-primary me-2"></i>
                                            <div>
                                                <small class="text-muted d-block">Stakeholder</small>
                                                <span class="fw-semibold">{{ $stakeholders[$milestone->stakeholder_id]->name }}</span>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endif

                                @if($milestone->notes)
                                <div class="mt-3 p-2 bg-light rounded border-start border-3 border-info">
                                    <div class="d-flex">
                                        <i class="bi bi-sticky text-info mt-1 me-2"></i>
                                        <small class="text-secondary">{{ $milestone->notes }}</small>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Roadmap Visualization -->
            <div class="card border-0 shadow-sm mt-5">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="card-title mb-0 fw-bold">
                        <i class="bi bi-diagram-3 me-2"></i>Project Roadmap
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="position-relative">
                        <div class="d-flex flex-wrap justify-content-between">
                            @foreach($milestones->sortBy('phase')->take(6) as $milestone)
                            <div class="text-center mb-4" style="flex: 1; min-width: 150px;">
                                <div class="position-relative mb-3">
                                    <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center
                                        @switch($milestone->status)
                                            @case('completed') bg-success border-success @break
                                            @case('in-progress') bg-warning border-warning @break
                                            @default bg-secondary border-secondary
                                        @endswitch border border-3 border-white shadow-sm"
                                        style="width: 40px; height: 40px;"
                                        data-bs-toggle="tooltip" title="{{ ucfirst($milestone->status) }}">
                                        @if($milestone->status == 'completed')
                                        <i class="bi bi-check-lg text-white"></i>
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <span class="badge bg-light text-dark mb-2">{{ $milestone->phase }}</span>
                                    <h6 class="fw-bold mb-1">{{ Str::limit($milestone->task_name, 20) }}</h6>
                                    <small class="text-muted">
                                        {{ $milestone->planned_end_date ? date('M d', strtotime($milestone->planned_end_date)) : 'TBD' }}
                                    </small>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="bi bi-calendar-check display-1 text-muted opacity-25"></i>
                </div>
                <h5 class="fw-normal text-muted mb-2">No milestones planned yet</h5>
                <p class="text-muted">Check back later for project timeline updates</p>
            </div>
            @endif
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
                                            <th class="border-0 pe-4">Status</th>
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
                                            <td class="pe-4">
                                                @if($actual >= $estimated * 0.9)
                                                <span class="badge bg-success bg-opacity-10 text-success border-0">On Track</span>
                                                @elseif($actual >= $estimated * 0.5)
                                                <span class="badge bg-warning bg-opacity-10 text-warning border-0">Moderate</span>
                                                @else
                                                <span class="badge bg-danger bg-opacity-10 text-danger border-0">Behind</span>
                                                @endif
                                            </td>
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

                        <!-- Top Donors -->
                        @if($donors->count() > 0)
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white border-0 py-3">
                                <h5 class="card-title mb-0 fw-bold">Top Supporters</h5>
                            </div>
                            <div class="card-body">
                                <div class="list-group list-group-flush">
                                    @foreach($donors->sortByDesc('amount')->take(5) as $donor)
                                    <div class="list-group-item border-0 px-0 py-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-0">{{ $donor->name }}</h6>
                                                <small class="text-muted">Pledged Amount</small>
                                            </div>
                                            <span class="badge bg-success bg-opacity-10 text-success border-0 py-2 px-3">
                                                ₹ {{ number_format($donor->amount) }}
                                            </span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
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
                    @if($project->banner_images)
                    <button type="button" class="btn btn-outline-primary" onclick="filterGallery('banner', event)">Banner</button>
                    @endif
                    @if($project->gallery_images)
                    <button type="button" class="btn btn-outline-primary" onclick="filterGallery('gallery', event)">Gallery</button>
                    @endif
                    @if($project->before_photo || $project->expected_photo)
                    <button type="button" class="btn btn-outline-primary" onclick="filterGallery('comparison', event)">Comparison</button>
                    @endif
                </div>
            </div>

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
                        <!-- Reports -->
                        @if($project->baseline_survey || $project->sustainability_plan)
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-white border-0 py-3">
                                <h5 class="card-title mb-0 fw-bold">Reports & Updates</h5>
                            </div>
                            <div class="card-body">
                                @if($project->baseline_survey)
                                <div class="mb-4">
                                    <h6 class="fw-bold mb-2">Baseline Survey</h6>
                                    <p class="text-muted small mb-0">{{ Str::limit($project->baseline_survey, 120) }}</p>
                                </div>
                                @endif

                                @if($project->sustainability_plan)
                                <div>
                                    <h6 class="fw-bold mb-2">Sustainability Plan</h6>
                                    <p class="text-muted small mb-0">{{ Str::limit($project->sustainability_plan, 120) }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif

                        <!-- Share Project -->
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white border-0 py-3">
                                <h5 class="card-title mb-0 fw-bold">Share This Project</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <button class="btn btn-outline-primary btn-sm flex-grow-1">
                                        <i class="bi bi-facebook me-1"></i>Facebook
                                    </button>
                                    <button class="btn btn-outline-info btn-sm flex-grow-1">
                                        <i class="bi bi-twitter me-1"></i>Twitter
                                    </button>
                                    <button class="btn btn-outline-success btn-sm flex-grow-1">
                                        <i class="bi bi-whatsapp me-1"></i>WhatsApp
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
        @if($project->stage == 'ongoing')
        <div class="tab-pane fade" id="execution" role="tabpanel">
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0 py-3">
                            <h4 class="card-title mb-0 fw-bold">Recent Progress Updates</h4>
                        </div>
                        <div class="card-body">
                            @if($project->last_update_summary)
                            <div class="alert alert-primary bg-primary-subtle border-0 mb-4">
                                <div class="d-flex">
                                    <i class="bi bi-megaphone fs-4 text-primary me-3"></i>
                                    <div>
                                        <h5 class="alert-heading fw-bold mb-2">Latest Update</h5>
                                        <p class="mb-0">{{ $project->last_update_summary }}</p>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="row g-4 mb-4">
                                @if($project->challenges_identified)
                                <div class="col-md-6">
                                    <div class="card border-0 bg-danger bg-opacity-10 h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="bg-danger bg-opacity-25 rounded-circle p-2 me-3">
                                                    <i class="bi bi-exclamation-octagon text-danger"></i>
                                                </div>
                                                <h6 class="card-title mb-0 text-danger fw-bold">Challenges Identified</h6>
                                            </div>
                                            <p class="card-text small mb-0">{{ $project->challenges_identified }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @if($project->solutions_actions_taken)
                                <div class="col-md-6">
                                    <div class="card border-0 bg-success bg-opacity-10 h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="bg-success bg-opacity-25 rounded-circle p-2 me-3">
                                                    <i class="bi bi-tools text-success"></i>
                                                </div>
                                                <h6 class="card-title mb-0 text-success fw-bold">Actions Taken</h6>
                                            </div>
                                            <p class="card-text small mb-0">{{ $project->solutions_actions_taken }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <!-- @if($project->operational_risks_ongoing)
                            <div class="mb-4">
                                <h5 class="fw-bold mb-3">Operational Risks</h5>
                                <div class="p-3 bg-light rounded border">
                                    <p class="mb-0">{{ $project->operational_risks_ongoing }}</p>
                                </div>
                            </div>
                            @endif

                            @if($project->resources_needed_ongoing)
                            <div class="mb-4">
                                <h5 class="fw-bold mb-3 text-warning">
                                    <i class="bi bi-plus-circle me-2"></i>Additional Resources Needed
                                </h5>
                                <div class="p-3 bg-warning bg-opacity-10 rounded border border-warning border-opacity-25">
                                    {{ $project->resources_needed_ongoing }}
                                </div>
                            </div>
                            @endif -->
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- Execution Health -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="card-title mb-0 fw-bold">Execution Health</h5>
                        </div>
                        <div class="card-body text-center">
                            <!-- Progress Circles -->
                            <div class="mb-4">
                                <div class="position-relative d-inline-block mb-3">
                                    <svg width="120" height="120" viewBox="0 0 36 36">
                                        <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#e6e6e6" stroke-width="3"/>
                                        <path class="circle" stroke-dasharray="{{ $project->project_progress ?? 0 }}, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#4e73df" stroke-width="3" stroke-linecap="round"/>
                                        <text x="18" y="22" fill="#4e73df" font-size="5" text-anchor="middle" font-weight="bold">{{ $project->project_progress ?? 0 }}%</text>
                                    </svg>
                                </div>
                                <small class="text-muted d-block mb-2">Overall Progress</small>
                            </div>

                            <!-- Completion Readiness -->
                            <div class="mb-4">
                                <div class="position-relative d-inline-block mb-3">
                                    <svg width="100" height="100" viewBox="0 0 36 36">
                                        <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#e6e6e6" stroke-width="3"/>
                                        <path class="circle" stroke-dasharray="{{ $project->completion_readiness ?? 0 }}, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#28a745" stroke-width="3" stroke-linecap="round"/>
                                        <text x="18" y="22" fill="#28a745" font-size="5" text-anchor="middle" font-weight="bold">{{ $project->completion_readiness ?? 0 }}%</text>
                                    </svg>
                                </div>
                                <small class="text-muted d-block mb-2">Completion Readiness</small>
                            </div>

                            <!-- Beneficiaries -->
                            <div class="p-3 bg-light rounded mb-3">
                                <small class="text-muted d-block mb-1">Actual Beneficiaries</small>
                                <h3 class="fw-bold mb-0">{{ number_format($project->actual_beneficiary_count ?? 0) }}</h3>
                                <small class="text-success">Reachable</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                            {{ $risk['category'] ?? 'Risk Item' }}
                                        </button>
                                    </h2>
                                    <div id="risk{{ $index }}" class="accordion-collapse collapse" data-bs-parent="#riskAccordion">
                                        <div class="accordion-body pt-2 small">
                                            <strong class="text-muted">Description:</strong>
                                            <p class="mb-2">{{ $risk['description'] ?? 'N/A' }}</p>
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
        @if(isset($surveys) && $surveys->count() > 0)
        <div class="tab-pane fade" id="feedback" role="tabpanel">
            <!-- Header Section -->
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
                <div>
                    <h4 class="mb-0 fw-bold"><i class="bi bi-chat-heart text-teal me-2"></i>Community Feedback</h4>
                    <p class="text-muted mb-0">Survey responses from stakeholders, beneficiaries & team members</p>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="badge bg-primary bg-opacity-10 text-white px-3 py-2 rounded-pill">
                        <i class="bi bi-people-fill me-1"></i>{{ $surveyStats['total'] }} Responses
                    </span>
                    @if($surveys->count() > 0)
                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                        <i class="bi bi-calendar-check me-1"></i>
                        {{ $surveys->min('survey_date') ? \Carbon\Carbon::parse($surveys->min('survey_date'))->format('M Y') : 'N/A' }} -
                        {{ $surveys->max('survey_date') ? \Carbon\Carbon::parse($surveys->max('survey_date'))->format('M Y') : 'N/A' }}
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
                                    </div>
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
                        @foreach($surveys->sortByDesc('survey_date') as $survey)
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
                        @endforeach
                    </div>

                    <!-- Load More (if many surveys) -->
                    @if($surveys->count() > 6)
                    <div class="text-center mt-4" id="loadMoreSurveys">
                        <button class="btn btn-outline-primary rounded-pill px-4" onclick="showAllSurveys()">
                            <i class="bi bi-arrow-down-circle me-2"></i>Show All {{ $surveys->count() }} Responses
                        </button>
                    </div>
                    @endif
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
                    <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">
                        <i class="bi bi-globe-americas fs-2 text-success"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0">SDG Alignment</h4>
                        <p class="text-muted mb-0">Sustainable Development Goals</p>
                    </div>
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
                                         style="height: 80px; width: 80px; object-fit: contain;">
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
                        <h4 class="fw-bold mb-0">Strategic Alignment</h4>
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
                                    $schemeLabels = [
                                        'skill_india_mission' => 'Skill India Mission',
                                        'nsp' => 'National Skill Policy',
                                        'pmkvy' => 'PM Kaushal Vikas',
                                        'nlm' => 'National Livelihood',
                                        'beti_bachao' => 'Beti Bachao',
                                    ];
                                @endphp
                                @foreach($project->govt_schemes as $scheme)
                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2">
                                    {{ $schemeLabels[$scheme] ?? ucfirst(str_replace('_', ' ', $scheme)) }}
                                </span>
                                @endforeach
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
                            $totalRaised = $donors->sum('amount');
                            $progressPercentage = $estimation->total_amount > 0 ? ($totalRaised / $estimation->total_amount) * 100 : 0;
                            $totalReceived = $fundings->sum('amount');
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
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightbox2@2.11.4/dist/js/lightbox.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key', 'YOUR_GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer></script>

<script>
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
                    }
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
                    }
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

// Tab navigation with URL hash
document.addEventListener('DOMContentLoaded', function() {
    const hash = window.location.hash;
    if (hash) {
        const tab = document.querySelector(`[href="${hash}"]`);
        if (tab) {
            tab.click();
        }
    }

    // Update URL hash when tab changes
    document.querySelectorAll('[data-bs-toggle="pill"]').forEach(tab => {
        tab.addEventListener('shown.bs.tab', function(e) {
            const targetId = e.target.getAttribute('data-bs-target') || e.target.getAttribute('href');
            if (targetId) {
                window.location.hash = targetId;

                // Close offcanvas if it's open
                const mobileMenu = document.getElementById('mobileTabMenu');
                if (mobileMenu && mobileMenu.classList.contains('show')) {
                    const bsOffcanvas = bootstrap.Offcanvas.getInstance(mobileMenu);
                    if (bsOffcanvas) bsOffcanvas.hide();
                }

                // Sync active state between mobile and desktop triggers
                document.querySelectorAll(`[data-bs-target="${targetId}"], [href="${targetId}"]`).forEach(el => {
                    const parent = el.closest('.nav, .list-group');
                    if (parent) {
                        parent.querySelectorAll('.active').forEach(a => a.classList.remove('active'));
                        el.classList.add('active');
                    }
                });
            }
        });
    });
});

// ========================================
// SURVEY FEEDBACK SECTION - Chart & Functions
// ========================================

// Initialize Satisfaction Chart
@if(isset($surveys) && $surveys->count() > 0)
document.addEventListener('DOMContentLoaded', function() {
    const satisfactionCtx = document.getElementById('satisfactionChart');
    if (satisfactionCtx) {
        new Chart(satisfactionCtx, {
            type: 'doughnut',
            data: {
                labels: ['Very Satisfied', 'Satisfied', 'Neutral', 'Dissatisfied'],
                datasets: [{
                    data: [
                        {{ $surveyStats['satisfaction']['Very Satisfied'] }},
                        {{ $surveyStats['satisfaction']['Satisfied'] }},
                        {{ $surveyStats['satisfaction']['Neutral'] }},
                        {{ $surveyStats['satisfaction']['Dissatisfied'] }}
                    ],
                    backgroundColor: ['#28a745', '#17a2b8', '#6c757d', '#dc3545'],
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                aspectRatio: 1,
                cutout: '65%',
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = total > 0 ? Math.round((context.raw / total) * 100) : 0;
                                return `${context.label}: ${context.raw} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
    }
});
@endif

// Filter Survey Cards
function filterSurveys(filter) {
    const cards = document.querySelectorAll('.survey-card-item');
    cards.forEach(card => {
        const satisfaction = card.dataset.satisfaction;
        let show = false;

        switch(filter) {
            case 'all':
                show = true;
                break;
            case 'satisfied':
                show = satisfaction === 'very-satisfied' || satisfaction === 'satisfied';
                break;
            case 'neutral':
                show = satisfaction === 'neutral';
                break;
            case 'dissatisfied':
                show = satisfaction === 'dissatisfied';
                break;
        }

        if (show) {
            card.style.display = 'block';
            card.classList.add('animate__animated', 'animate__fadeIn');
        } else {
            card.style.display = 'none';
        }
    });
}

// Expand Comment Text
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.expand-comment').forEach(btn => {
        btn.addEventListener('click', function() {
            const fullText = this.dataset.fullText;
            const commentText = this.previousElementSibling;
            if (commentText) {
                commentText.textContent = fullText;
                this.style.display = 'none';
            }
        });
    });
});

// Show All Surveys (if using load more)
function showAllSurveys() {
    const cards = document.querySelectorAll('.survey-card-item');
    cards.forEach((card, index) => {
        card.style.display = 'block';
        card.style.animationDelay = `${index * 50}ms`;
        card.classList.add('animate__animated', 'animate__fadeInUp');
    });
    document.getElementById('loadMoreSurveys').style.display = 'none';
}
</script>
@endpush

@endsection
