@extends('layouts.admin.app')
@section('content')
@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    .learning-pathway-shell {
        background:
            radial-gradient(circle at top left, rgba(13, 110, 253, 0.14), transparent 30%),
            radial-gradient(circle at top right, rgba(25, 135, 84, 0.12), transparent 28%),
            linear-gradient(180deg, #f8fbff 0%, #f7f8fc 100%);
    }
    .learning-pathway-card {
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.95);
        border: 1px solid rgba(255, 255, 255, 0.8);
    }
    .learning-pathway-header {
        background: linear-gradient(135deg, #0f4c81 0%, #0d6efd 52%, #1aa179 100%);
    }
    .top-32 {
        top: 32%;
    }
    .pathway-validation-summary {
        display: none;
        border: 1px solid rgba(220, 53, 69, 0.18);
        background: linear-gradient(135deg, rgba(220, 53, 69, 0.08), rgba(255, 243, 205, 0.7));
        color: #842029;
        border-radius: 1rem;
        box-shadow: 0 20px 45px rgba(132, 32, 41, 0.08);
    }
    .pathway-validation-summary.show {
        display: block;
    }
    .pathway-panel {
        border-radius: 1.25rem;
        box-shadow: 0 18px 45px rgba(15, 76, 129, 0.08);
        overflow: hidden;
    }
    .pathway-nav {
        background: rgba(255, 255, 255, 0.72);
        border-radius: 1.5rem;
        padding: 1.25rem 1rem;
        box-shadow: inset 0 0 0 1px rgba(13, 110, 253, 0.08), 0 16px 40px rgba(15, 76, 129, 0.07);
    }
    /* Course Card Styles */
    .hover-lift {
        transition: all 0.3s ease;
    }
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .cursor-pointer {
        cursor: pointer;
    }
    .pathway-step-trigger {
        cursor: pointer;
        transition: transform 0.2s ease, opacity 0.2s ease;
    }
    .pathway-step-trigger:hover {
        transform: translateY(-2px);
    }
    .pathway-step-trigger:not(.active-step) {
        opacity: 0.75;
    }
    .pathway-step-trigger.active-step .rounded-circle {
        box-shadow: 0 0 0 0.35rem rgba(13, 110, 253, 0.15);
    }
    .pathway-step-trigger.active-step .small {
        color: #0d6efd !important;
    }
    .pathway-step-trigger.has-error .rounded-circle {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 0.35rem rgba(220, 53, 69, 0.15);
    }
    .pathway-step-trigger.has-error .small,
    .pathway-step-trigger.has-error .fs-2 {
        color: #dc3545 !important;
    }
    .step-action-bar {
        background: linear-gradient(180deg, rgba(255, 255, 255, 0), rgba(13, 110, 253, 0.03));
    }
    .step-title {
        letter-spacing: -0.02em;
    }
    .is-invalid {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.12) !important;
    }
    .invalid-feedback.dynamic-feedback {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        margin-top: 0.55rem;
    }
    .card-img-overlay .badge {
        backdrop-filter: blur(10px);
        background-color: rgba(255, 255, 255, 0.9);
        color: #000;
        margin-right: 5px;
    }
    /* Selection Overlay */
    /* .course-card.border-primary .selection-overlay {
        display: flex !important;
    } */
</style>
@endpush


<div class="container-fluid learning-pathway-shell py-4 py-lg-5">
    <div class="row">
        <div class="col-12">
            <!-- Main Card with gradient header -->
            <div class="card learning-pathway-card shadow-lg border-0 rounded-4">
                <div class="card-header learning-pathway-header text-white py-4 rounded-top-4 border-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="card-title mb-0 fw-bold">
                                <i class="bi bi-diagram-3 me-2"></i>Create Learning Pathway
                            </h4>
                            <p class="mb-0 opacity-75">Step-by-step pathway builder for structured learning</p>
                        </div>
                        <a href="{{ route('admin.project.index', $project->id) }}" class="btn btn-light rounded-pill px-4">
                            <i class="bi bi-arrow-left me-1"></i> Back to List
                        </a>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <form action="{{ route('admin.learningpathways.store', $project->id) }}" method="POST" id="learningPathwayForm">
                        @csrf

                        <div id="pathway-validation-summary" class="pathway-validation-summary mb-4 px-4 py-3">
                            <div class="d-flex align-items-start gap-3">
                                <div class="fs-4 pt-1">
                                    <i class="bi bi-exclamation-octagon-fill"></i>
                                </div>
                                <div>
                                    <div class="fw-bold mb-1">Please complete the required fields before continuing.</div>
                                    <div class="small mb-0" id="pathway-validation-summary-text">Some mandatory fields are still empty.</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Progress Indicator -->
                        <div class="mb-5 pathway-nav">
                            <div class="d-none d-md-flex justify-content-between align-items-center position-relative">
                                <div class="position-absolute top-32 start-0 end-0 translate-middle-y">
                                    <div class="progress" style="height: 4px;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 20%" id="progress-bar"></div>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-between w-100">
                                    @foreach(['sector', 'flow', 'courses', 'roadmap', 'outcomes'] as $index => $tab)
                                    <button type="button"
                                            class="btn p-0 border-0 bg-transparent d-flex flex-column align-items-center position-relative pathway-step-trigger"
                                            data-target="#{{ $tab }}"
                                            data-step="{{ $index + 1 }}">
                                        <div class="rounded-circle bg-white border border-3 border-primary d-flex align-items-center justify-content-center mb-2"
                                             style="width: 50px; height: 50px; z-index: 1;">
                                            <span class="fs-2 fw-bold text-primary">{{ $index + 1 }}</span>
                                        </div>
                                        <span class="small fw-semibold text-muted">{{ ucfirst($tab) }}</span>
                                    </button>
                                    @endforeach
                                </div>
                            </div>
                            
                            <!-- Mobile Progress -->
                            <div class="d-md-none">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-muted small">Step <span id="current-step">1</span> of 5</span>
                                    <span class="badge bg-primary rounded-pill" id="current-step-label">Sector</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 20%" id="progress-bar-mobile"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Tabs Content -->
                        <div class="tab-content" id="pathwayTabsContent">
                            <!-- Tab 1: Sectors -->
                            <div class="tab-pane fade show active" id="sector" role="tabpanel">
                                <div class="row g-4">
                                    <div class="col-lg-12">
                                        <div class="card pathway-panel border-primary border-2">
                                            <div class="card-body p-4">
                                                <h5 class="card-title step-title text-primary mb-4">
                                                    <i class="bi bi-building me-2"></i>Select Primary Sector
                                                </h5>
                                                <div class="mb-4">
                                                    <label class="form-label fw-semibold">Primary Sector <span class="text-danger">*</span></label>
                                                    <div class="input-group input-group-lg">
                                                        <span class="input-group-text bg-primary text-white">
                                                            <i class="bi bi-bullseye"></i>
                                                        </span>
                                                        <select class="form-select form-select-lg" id="primary_sector_id" name="primary_sector_id" required>
                                                            <option value="" selected disabled>Choose primary sector...</option>
                                                            @foreach($sectors as $sector)
                                                                <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-text">This will be the main focus of your learning pathway</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card pathway-panel mt-4 border-warning border-2">
                                            <div class="card-body p-4">
                                                <h5 class="card-title text-warning mb-4">
                                                    <i class="bi bi-layers me-2"></i>Associated Sectors
                                                </h5>
                                                
                                                <div class="alert alert-info d-flex align-items-center mb-4">
                                                    <i class="bi bi-info-circle-fill me-3 fs-4"></i>
                                                    <div>Add related sectors to create a multidisciplinary learning experience</div>
                                                </div>

                                                <div class="mb-4">
                                                    <label class="form-label fw-semibold">Add New Sector</label>
                                                    <div class="input-group">
                                                        <select class="form-select" id="sector_adder">
                                                            <option value="" selected disabled>Select sector to add...</option>
                                                            @foreach($sectors as $sector)
                                                                <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <button type="button" class="btn btn-warning" id="btn-add-sector">
                                                            <i class="bi bi-plus-circle me-1"></i> Add Sector
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="mt-4">
                                                    <h6 class="fw-semibold mb-3">Selected Sectors <span class="badge bg-warning rounded-pill" id="sector-count">0</span></h6>
                                                    
                                                    <div class="table-responsive border rounded-3">
                                                        <table class="table table-hover mb-0">
                                                            <thead class="table-warning">
                                                                <tr>
                                                                    <th width="60" class="text-center">#</th>
                                                                    <th>Sector Name</th>
                                                                    <th width="100" class="text-end">Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="sector-list" class="sortable-list">
                                                                <!-- Dynamic rows will be added here -->
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    
                                                    <div class="alert alert-light mt-3">
                                                        <div class="d-flex align-items-center">
                                                            <i class="bi bi-arrow-down-up text-muted me-2"></i>
                                                            <small class="text-muted">Drag and drop rows to reorder sectors according to importance</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Navigation -->
                                <div class="d-flex justify-content-between mt-5 pt-4 border-top step-action-bar">
                                    <div></div>
                                    <button type="button" class="btn btn-primary btn-lg px-5 btn-next" data-next="#flow">
                                        Next: Flow <i class="bi bi-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Tab 2: Flow -->
                            <div class="tab-pane fade" id="flow" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-10 mx-auto">
                                        <div class="card pathway-panel border-info">
                                            <div class="card-header bg-info bg-opacity-10 border-bottom">
                                                <h5 class="mb-0 text-info">
                                                    <i class="bi bi-diagram-3 me-2"></i>Multidisciplinary Flow Design
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="alert alert-info d-flex align-items-center mb-4">
                                                    <i class="bi bi-lightbulb me-3 fs-4"></i>
                                                    <div>Design the flow of learning across multiple sectors. Each step represents a phase in the learning journey.</div>
                                                </div>

                                                <div id="flow-container" class="mb-4">
                                                    <!-- Flow steps will be dynamically added here -->
                                                </div>

                                                <button type="button" class="btn btn-outline-info w-100 py-3 border-2" id="add-flow-step">
                                                    <i class="bi bi-plus-circle me-2"></i> Add New Flow Step
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Navigation -->
                                <div class="d-flex justify-content-between mt-5 pt-4 border-top step-action-bar">
                                    <button type="button" class="btn btn-outline-primary btn-lg px-5 btn-prev" data-prev="#sector">
                                        <i class="bi bi-arrow-left me-2"></i> Previous
                                    </button>
                                    <button type="button" class="btn btn-primary btn-lg px-5 btn-next" data-next="#courses">
                                        Next: Courses <i class="bi bi-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Tab 3: Courses -->
                            <div class="tab-pane fade" id="courses" role="tabpanel">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-warning" role="alert" id="course-fetching-msg" style="display:none">
                                            <div class="d-flex align-items-center">
                                                <div class="spinner-border spinner-border-sm me-3" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                                <strong>Fetching courses based on selected sectors...</strong>
                                            </div>
                                        </div>

                                        <div class="card pathway-panel border-success">
                                            <div class="card-header bg-success bg-opacity-10 border-bottom">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h5 class="mb-0 text-success">
                                                        <i class="bi bi-book me-2"></i>Select Training Courses
                                                    </h5>
                                                    <div>
                                                        <span class="badge bg-success rounded-pill fs-6 px-3 py-2">
                                                            Selected: <span id="selected-count">0</span> courses
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row align-items-center mb-4 bg-light p-3 rounded-3">
                                                    <div class="col-md-5">
                                                        <label class="form-label fw-semibold text-muted small mb-1">Search Course</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                                                            <input type="text" id="course-search-input" class="form-control border-start-0" placeholder="Type course name...">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <label class="form-label fw-semibold text-muted small mb-1">Filter by Sector</label>
                                                        <select id="course-sector-filter" class="form-select">
                                                            <option value="">All Sectors</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2 mt-4 text-end">
                                                        <button type="button" class="btn btn-outline-secondary w-100" id="clear-course-filters">Clear</button>
                                                    </div>
                                                </div>

                                                <div class="row g-4" id="courses-grid">
                                                    <!-- Course cards will be dynamically added here -->
                                                    <div class="col-12 text-center py-5">
                                                        <div class="display-1 text-muted mb-4">
                                                            <i class="bi bi-book"></i>
                                                        </div>
                                                        <h5 class="text-muted mb-3">No Courses Available</h5>
                                                        <p class="text-muted">Please select sectors in Step 1 to view available courses</p>
                                                        <a href="#" class="btn btn-outline-primary btn-prev" data-prev="#sector">
                                                            <i class="bi bi-arrow-left me-1"></i> Go to Sectors
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Navigation -->
                                <div class="d-flex justify-content-between mt-5 pt-4 border-top step-action-bar">
                                    <button type="button" class="btn btn-outline-primary btn-lg px-5 btn-prev" data-prev="#flow">
                                        <i class="bi bi-arrow-left me-2"></i> Previous
                                    </button>
                                    <button type="button" class="btn btn-primary btn-lg px-5 btn-next" data-next="#roadmap">
                                        Next: Roadmap <i class="bi bi-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Tab 4: Roadmap -->
                            <div class="tab-pane fade" id="roadmap" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-10 mx-auto">
                                        <div class="card pathway-panel border-purple">
                                            <div class="card-header bg-purple bg-opacity-10 border-bottom">
                                                <h5 class="mb-0 text-purple">
                                                    <i class="bi bi-map me-2"></i>Learning Roadmap
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="alert alert-purple d-flex align-items-center mb-4">
                                                    <i class="bi bi-info-circle me-3 fs-4"></i>
                                                    <div>Create a visual roadmap for learners to follow. Each step represents a milestone in their journey.</div>
                                                </div>

                                                <div id="roadmap-container" class="mb-4">
                                                    <!-- Roadmap steps will be dynamically added here -->
                                                </div>

                                                <button type="button" class="btn btn-outline-purple w-100 py-3 border-2" id="add-roadmap-step">
                                                    <i class="bi bi-plus-circle me-2"></i> Add Roadmap Step
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Navigation -->
                                <div class="d-flex justify-content-between mt-5 pt-4 border-top step-action-bar">
                                    <button type="button" class="btn btn-outline-primary btn-lg px-5 btn-prev" data-prev="#courses">
                                        <i class="bi bi-arrow-left me-2"></i> Previous
                                    </button>
                                    <button type="button" class="btn btn-primary btn-lg px-5 btn-next" data-next="#outcomes">
                                        Next: Outcomes <i class="bi bi-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Tab 5: Outcomes -->
                            <div class="tab-pane fade" id="outcomes" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-10 mx-auto">
                                        <div class="card pathway-panel border-success">
                                            <div class="card-header bg-success bg-opacity-10 border-bottom">
                                                <h5 class="mb-0 text-success">
                                                    <i class="bi bi-check-circle me-2"></i>Learning Outcomes & Finalization
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-4">
                                                    <label class="form-label fw-semibold fs-5">Learning Outcomes</label>
                                                    <div class="form-text mb-3">Describe what learners will achieve by completing this pathway</div>
                                                    <textarea name="learning_outcomes" id="editor" class="form-control" rows="10" 
                                                              placeholder="Example: By completing this learning pathway, students will be able to...
• Demonstrate proficiency in...
• Apply knowledge of...
• Develop skills in...
• Create projects involving..."></textarea>
                                                </div>

                                                <div class="alert alert-success">
                                                    <h6 class="fw-semibold mb-3"><i class="bi bi-check-lg me-2"></i>Ready to Publish</h6>
                                                    <p class="mb-0">Review all the information before creating your learning pathway. You can always edit it later.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Navigation -->
                                <div class="d-flex justify-content-between mt-5 pt-4 border-top step-action-bar">
                                    <button type="button" class="btn btn-outline-primary btn-lg px-5 btn-prev" data-prev="#roadmap">
                                        <i class="bi bi-arrow-left me-2"></i> Previous
                                    </button>
                                    <button type="submit" class="btn btn-success btn-lg px-5">
                                        <i class="bi bi-check-circle me-2"></i> Create Learning Pathway
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hidden Templates -->
<template id="flow-step-template">
    <div class="card border-start border-4 border-start-info mb-3 flow-item shadow-sm">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <span class="badge bg-info rounded-pill me-3">Step <span class="step-number">1</span></span>
                    <h6 class="mb-0 text-info">New Flow Step</h6>
                </div>
                <button type="button" class="btn btn-sm btn-outline-danger remove-flow-step">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Sector</label>
                    <select class="form-select flow-sector" name="flows[INDEX][sector_id]" required>
                        <option value="" selected disabled>Select Sector</option>
                        @foreach($sectors as $sector)
                            <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-8">
                    <label class="form-label fw-semibold">Step Title</label>
                    <input type="text" class="form-control" name="flows[INDEX][step_title]" 
                           placeholder="e.g., Foundation Phase, Core Concepts, Advanced Topics" required>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea class="form-control" name="flows[INDEX][description]" rows="2" 
                              placeholder="Describe what learners will achieve in this step..."></textarea>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Skills Acquired</label>
                    <input type="text" class="form-control" name="flows[INDEX][skills_text]" 
                           placeholder="e.g., Communication, Problem-solving, Technical skills (comma separated)">
                    <div class="form-text">Enter skills that learners will gain in this step</div>
                </div>
            </div>
        </div>
    </div>
</template>

<template id="roadmap-step-template">
    <div class="card border-start border-4 border-start-purple mb-3 roadmap-item shadow-sm">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <span class="badge bg-purple rounded-pill me-3">Step <span class="step-number">1</span></span>
                    <h6 class="mb-0 text-purple">New Roadmap Step</h6>
                </div>
                <button type="button" class="btn btn-sm btn-outline-danger remove-roadmap-step">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Title</label>
                    <input type="text" class="form-control" name="roadmaps[INDEX][title]" 
                           placeholder="e.g., Beginner Level, Project Submission" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Badge Text</label>
                    <input type="text" class="form-control" name="roadmaps[INDEX][badge_text]" 
                           placeholder="e.g., Beginner, Certified">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Color</label>
                    <div class="input-group">
                                        <input type="color" class="form-control form-control-color" name="roadmaps[INDEX][color]" value="#5664d2">
                                        <span class="input-group-text">#5664d2</span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Description</label>
                                    <textarea class="form-control" name="roadmaps[INDEX][description]" rows="2"
                                              placeholder="Describe this roadmap milestone..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
</template>

<template id="course-card-template">
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="course-card card h-100 border-0 shadow-sm hover-lift cursor-pointer select-course-wrapper" data-id="COURSE_ID" data-name="COURSE_NAME" data-sector="SECTOR_ID">
            <div class="position-absolute top-0 end-0 p-2 course-selected-badge" style="display: none; z-index: 10;">
                <span class="badge bg-primary fs-6 shadow"><i class="bi bi-check-circle-fill me-1"></i>Selected</span>
            </div>
            <div class="position-relative">
                <img src="PLACEHOLDER_IMAGE" class="card-img-top" alt="COURSE_NAME" style="height: 200px; object-fit: cover;">
                <div class="card-img-overlay d-flex justify-content-between align-items-start p-3">
                    <span class="badge bg-badge-mode">MODE_LABEL</span>
                    <span class="badge bg-badge-paid">PAID_LABEL</span>
                </div>
            </div>
            <div class="card-body d-flex flex-column">
                <h6 class="card-title text-primary mb-2 line-clamp-2" style="min-height: 3rem;">COURSE_NAME</h6>
                <p class="text-muted small mb-2">
                    <i class="bi bi-building me-1"></i>PROVIDER_NAME
                </p>
                <p class="text-warning small mb-2">
                    <i class="bi bi-tags me-1"></i>SECTOR_NAME
                </p>
                <div class="course-meta d-flex justify-content-between text-muted small mb-3">
                    <span class="d-flex align-items-center" title="Languages">
                        <i class="bi bi-translate me-1"></i> LANGUAGE_COUNT Languages
                    </span>
                    <span class="d-flex align-items-center">
                        <i class="bi bi-clock me-1"></i> DURATION
                    </span>
                </div>
                <div class="mt-auto">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="rating">
                            <i class="bi bi-star-fill text-warning"></i>
                            <small class="text-muted">4.5 (120)</small>
                        </div>
                        <div class="enrollment">
                            <small class="text-muted">
                                <i class="bi bi-people me-1"></i> ENROLLMENT_COUNT
                            </small>
                        </div>
                    </div>
                    
                    
                    <button type="button" class="btn btn-outline-primary w-100 select-course-btn" data-id="COURSE_ID">
                        <i class="bi bi-plus-circle me-1"></i> Select Course
                    </button>
                    
                    <div class="form-check form-switch mt-3 py-2 px-3 bg-light rounded" style="border: 1px solid #e9ecef;">
                        <input class="form-check-input course-featured-check" type="checkbox" role="switch" id="feat_COURSE_ID" style="margin-top: 0.3em;">
                        <label class="form-check-label small fw-semibold text-dark ms-2" for="feat_COURSE_ID">Highlight as Featured</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.select2').select2({
            theme: 'bootstrap-5',
            placeholder: 'Select an option',
            allowClear: true
        });

        // Progress tracking
        let currentStep = 1;
        const totalSteps = 5;
        const stepLabels = {
            1: 'Sector',
            2: 'Flow',
            3: 'Courses',
            4: 'Roadmap',
            5: 'Outcomes'
        };
        
        function updateProgress() {
            const progress = (currentStep / totalSteps) * 100;
            $('#progress-bar').css('width', progress + '%');
            $('#progress-bar-mobile').css('width', progress + '%');
            $('#current-step').text(currentStep);
            $('#current-step-label').text(stepLabels[currentStep] || 'Step');
            $('.pathway-step-trigger').removeClass('active-step');
            $(`.pathway-step-trigger[data-step="${currentStep}"]`).addClass('active-step');
        }

        function goToStep(target, options = {}) {
            const $targetTab = $(target);

            if ($targetTab.length === 0) {
                return;
            }

            const nextStep = parseInt($(`.pathway-step-trigger[data-target="${target}"]`).data('step'), 10);
            const $currentTab = $('.tab-pane.active');

            if ($currentTab.attr('id') === $targetTab.attr('id')) {
                return;
            }

            $('.tab-pane').removeClass('show active animate__animated animate__fadeInLeft animate__fadeInRight animate__fadeOutLeft animate__fadeOutRight');
            $targetTab.addClass(`show active animate__animated ${options.animationClass || 'animate__fadeInRight'}`);

            currentStep = nextStep || currentStep;
            updateProgress();

            if (target === '#courses') {
                fetchCourses();
            }
        }

        function getValidationMessage(field) {
            if (field.validationMessage) {
                return field.validationMessage;
            }

            return 'This field is required.';
        }

        function getStepNumberFromTab($tab) {
            if (!$tab || !$tab.length) {
                return null;
            }

            return parseInt($(`.pathway-step-trigger[data-target="#${$tab.attr('id')}"]`).data('step'), 10) || null;
        }

        function showValidationSummary(message, stepNumber = null) {
            const defaultMessage = 'Some mandatory fields are still empty.';
            $('#pathway-validation-summary-text').text(message || defaultMessage);
            $('#pathway-validation-summary').addClass('show');

            $('.pathway-step-trigger').removeClass('has-error');
            if (stepNumber) {
                $(`.pathway-step-trigger[data-step="${stepNumber}"]`).addClass('has-error');
            }
        }

        function hideValidationSummary() {
            $('#pathway-validation-summary').removeClass('show');
            $('.pathway-step-trigger').removeClass('has-error');
        }

        function clearFieldValidation($field) {
            $field.removeClass('is-invalid');
            $field.siblings('.invalid-feedback.dynamic-feedback').remove();

            if ($field.parent().hasClass('input-group')) {
                $field.parent().siblings('.invalid-feedback.dynamic-feedback').remove();
            }
        }

        function showFieldValidation($field, message) {
            clearFieldValidation($field);
            $field.addClass('is-invalid');

            const feedback = $(`<div class="invalid-feedback dynamic-feedback">${message}</div>`);

            if ($field.parent().hasClass('input-group')) {
                $field.parent().after(feedback);
            } else {
                $field.after(feedback);
            }
        }

        function validateLearningPathwayForm() {
            let firstInvalidField = null;

            $('#learningPathwayForm').find('[required]').each(function() {
                const $field = $(this);

                clearFieldValidation($field);

                if (!this.checkValidity()) {
                    showFieldValidation($field, getValidationMessage(this));

                    if (!firstInvalidField) {
                        firstInvalidField = $field;
                    }
                }
            });

            return firstInvalidField;
        }

        function validateRequiredFields($scope) {
            let firstInvalidField = null;
            const $requiredFields = $scope.find('[required]').filter(':visible');

            $requiredFields.each(function() {
                const $field = $(this);

                clearFieldValidation($field);

                if (!this.checkValidity()) {
                    showFieldValidation($field, getValidationMessage(this));

                    if (!firstInvalidField) {
                        firstInvalidField = $field;
                    }
                }
            });

            return firstInvalidField;
        }

        // Wizard navigation
        $('.btn-next').on('click', function(e) {
            e.preventDefault();
            const $currentTab = $('.tab-pane.active');
            const firstInvalid = validateRequiredFields($currentTab);

            if (firstInvalid) {
                const stepNumber = getStepNumberFromTab($currentTab);
                showValidationSummary('Please fill all mandatory fields in this step before moving to the next one.', stepNumber);
                setTimeout(() => {
                    firstInvalid.trigger('focus');
                }, 50);
                return;
            }

            hideValidationSummary();
            goToStep($(this).data('next'), { animationClass: 'animate__fadeInRight' });
        });

        $('.btn-prev').on('click', function(e) {
            e.preventDefault();
            goToStep($(this).data('prev'), { animationClass: 'animate__fadeInLeft' });
        });

        $('.pathway-step-trigger').on('click', function(e) {
            e.preventDefault();
            goToStep($(this).data('target'));
        });

        // Sector Management
        let addedSectors = [];
        let selectedCourses = [];
        
        $('#btn-add-sector').on('click', function() {
            const select = $('#sector_adder');
            const sectorId = select.val();
            const sectorName = select.find('option:selected').text();
            
            if (sectorId && !addedSectors.includes(sectorId)) {
                addSectorRow(sectorId, sectorName);
                addedSectors.push(sectorId);
                select.val(null).trigger('change');
                updateSectorCount();
            }
        });

        function addSectorRow(id, name) {
            const rowCount = $('#sector-list tr').length + 1;
            const row = `
                <tr data-id="${id}">
                    <td class="text-center align-middle">
                        <i class="bi bi-grip-vertical text-muted handle" style="cursor: move;"></i>
                    </td>
                    <td class="align-middle">
                        <div class="d-flex align-items-center">
                            <span class="badge bg-secondary rounded-pill me-2">${rowCount}</span>
                            ${name}
                        </div>
                    </td>
                    <td class="text-end align-middle">
                        <button type="button" class="btn btn-sm btn-outline-danger remove-sector">
                            <i class="bi bi-trash"></i>
                        </button>
                        <input type="hidden" name="sector_ids[]" value="${id}">
                    </td>
                </tr>`;
            
            $('#sector-list').append(row);
            
            // Add remove functionality
            $('#sector-list tr:last-child .remove-sector').on('click', function() {
                const tr = $(this).closest('tr');
                const id = tr.data('id');
                tr.addClass('animate__animated animate__fadeOut').on('animationend', function() {
                    tr.remove();
                    addedSectors = addedSectors.filter(s => s != id);
                    updateSectorCount();
                });
            });
            
            // Make sortable
            new Sortable(document.getElementById('sector-list'), {
                handle: '.handle',
                animation: 150,
                onEnd: function() {
                    updateSectorOrder();
                }
            });
        }

        function updateSectorCount() {
            $('#sector-count').text(addedSectors.length);
        }

        function updateSectorOrder() {
            const order = [];
            $('#sector-list tr').each(function(index) {
                order.push($(this).data('id'));
            });
            $('input[name="sector_order"]').val(order.join(','));
        }

        // Flow Management
        let flowIndex = 0;
        
        $('#add-flow-step').on('click', function() {
            const template = $('#flow-step-template').html();
            const newStep = template.replace(/INDEX/g, flowIndex++);
            const $newStep = $(newStep);
            
            // Update step number
            const stepNumber = $('#flow-container .flow-item').length + 1;
            $newStep.find('.step-number').text(stepNumber);
            $newStep.find('h6').text(`Flow Step ${stepNumber}`);
            
            // Add remove functionality
            $newStep.find('.remove-flow-step').on('click', function() {
                $(this).closest('.flow-item').addClass('animate__animated animate__fadeOut').on('animationend', function() {
                    $(this).remove();
                    updateFlowNumbers();
                });
            });
            
            // Add to container with animation
            $('#flow-container').append($newStep.hide().fadeIn(300));
        });

        function updateFlowNumbers() {
            $('#flow-container .flow-item').each(function(index) {
                const stepNum = index + 1;
                $(this).find('.step-number').text(stepNum);
                $(this).find('h6').text(`Flow Step ${stepNum}`);
            });
        }

        // Roadmap Management
        let roadmapIndex = 0;
        
        $('#add-roadmap-step').on('click', function() {
            const template = $('#roadmap-step-template').html();
            const newStep = template.replace(/INDEX/g, roadmapIndex++);
            const $newStep = $(newStep);
            
            // Update step number
            const stepNumber = $('#roadmap-container .roadmap-item').length + 1;
            $newStep.find('.step-number').text(stepNumber);
            $newStep.find('h6').text(`Roadmap Step ${stepNumber}`);
            
            // Add remove functionality
            $newStep.find('.remove-roadmap-step').on('click', function() {
                $(this).closest('.roadmap-item').addClass('animate__animated animate__fadeOut').on('animationend', function() {
                    $(this).remove();
                    updateRoadmapNumbers();
                });
            });
            
            // Color input change
            $newStep.find('input[type="color"]').on('change', function() {
                $(this).closest('.input-group').find('.input-group-text').text($(this).val());
            });
            
            // Add to container with animation
            $('#roadmap-container').append($newStep.hide().fadeIn(300));
        });

        function updateRoadmapNumbers() {
            $('#roadmap-container .roadmap-item').each(function(index) {
                const stepNum = index + 1;
                $(this).find('.step-number').text(stepNum);
                $(this).find('h6').text(`Roadmap Step ${stepNum}`);
            });
        }

        // Course Management
        let fetchedCoursesData = [];
        
        function fetchCourses() {
            let primarySectorId = $('#primary_sector_id').val();
            let sectorsToFetch = [...addedSectors];
            
            if (primarySectorId && !sectorsToFetch.includes(primarySectorId)) {
                sectorsToFetch.push(primarySectorId);
            }

            if (sectorsToFetch.length === 0) {
                $('#courses-grid').html(`
                    <div class="col-12 text-center py-5">
                        <div class="display-1 text-muted mb-4">
                            <i class="bi bi-exclamation-circle"></i>
                        </div>
                        <h5 class="text-muted mb-3">No Sectors Selected</h5>
                        <p class="text-muted">Please add sectors in Step 1 to view available courses</p>
                        <button class="btn btn-outline-primary btn-prev" data-prev="#sector">
                            <i class="bi bi-arrow-left me-1"></i> Go to Sectors
                        </button>
                    </div>`);
                return;
            }

            $('#course-fetching-msg').show();
            
            $.ajax({
                url: "{{ route('admin.courses.by.sectors') }}",
                method: 'POST',
                data: {
                    sectors: sectorsToFetch,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#course-fetching-msg').hide();
                    fetchedCoursesData = data;
                    updateSectorFilterDropdown(data);
                    renderCourses(data);
                },
                error: function(xhr, status, error) {
                    $('#course-fetching-msg').hide();
                    console.error('Error fetching courses:', error);
                     $('#courses-grid').html(`
                    <div class="col-12 text-center py-5">
                        <div class="display-1 text-danger mb-4">
                            <i class="bi bi-wifi-off"></i>
                        </div>
                        <h5 class="text-danger mb-3">Error fetching courses</h5>
                        <p class="text-muted">Please try again later.</p>
                    </div>`);
                }
            });
        }
        
        function updateSectorFilterDropdown(courses) {
            const filterDropdown = $('#course-sector-filter');
            filterDropdown.empty();
            filterDropdown.append('<option value="">All Sectors</option>');
            
            let uniqueSectors = {};
            courses.forEach(c => {
                if(c.sector) {
                    uniqueSectors[c.sector_id] = c.sector.name;
                }
            });
            
            for(let id in uniqueSectors) {
                filterDropdown.append(`<option value="${id}">${uniqueSectors[id]}</option>`);
            }
        }
        
        $('#course-search-input').on('keyup', filterRenderedCourses);
        $('#course-sector-filter').on('change', filterRenderedCourses);
        $('#clear-course-filters').on('click', function() {
            $('#course-search-input').val('');
            $('#course-sector-filter').val('');
            filterRenderedCourses();
        });
        
        function filterRenderedCourses() {
            let searchTerm = $('#course-search-input').val().toLowerCase();
            let sectorFilter = $('#course-sector-filter').val();
            
            $('.course-card-wrapper-col').each(function() {
                let card = $(this).find('.select-course-wrapper');
                let name = card.data('name').toLowerCase();
                let sector = card.data('sector').toString();
                
                let matchesSearch = name.includes(searchTerm);
                let matchesSector = sectorFilter === '' || sector === sectorFilter;
                
                if (matchesSearch && matchesSector) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }

        function renderCourses(courses) {
            const grid = $('#courses-grid');
            grid.empty();
            
            if (!courses || courses.length === 0) {
                grid.html(`
                    <div class="col-12 text-center py-5">
                        <div class="display-1 text-muted mb-4">
                            <i class="bi bi-search"></i>
                        </div>
                        <h5 class="text-muted mb-3">No Courses Found</h5>
                        <p class="text-muted">No courses available for the selected sectors</p>
                    </div>`);
                return;
            }

            courses.forEach(course => {
                const template = $('#course-card-template').html();
                const isSelected = selectedCourses.includes(course.id);
                
                // Image handling
                let imageUrl = 'https://via.placeholder.com/400x300/cccccc/666666?text=No+Image';
                if (course.image) {
                    if (course.image.startsWith('http')) {
                        imageUrl = course.image;
                    } else {
                        // Assuming images are stored in storage/app/public and linked to public/storage
                        if (course.image.includes('storage/')) {
                             imageUrl = "{{ asset('') }}" + course.image;
                        } else {
                             // Correct path construction
                             imageUrl = "{{ asset('') }}" + course.image;
                        }
                    }
                }

                // Data Formatting
                // Mode
                const modes = {1: 'Online', 2: 'In-Centre', 3: 'Hybrid', 4: 'On-Demand'};
                const modeLabel = modes[course.mode_of_study] || 'N/A';
                const modeBadgeClass = course.mode_of_study == 1 ? 'primary' : 'secondary';

                // Paid
                const paidLabel = course.paid_type === 'free' ? 'FREE' : 'PAID';
                const paidBadgeClass = course.paid_type === 'free' ? 'success' : 'warning';

                // Duration
                let duration = 'Flexible';
                if (course.duration_number && course.duration_unit) {
                    duration = course.duration_number + ' ' + course.duration_unit;
                }

                // Languages
                 let langCount = 0;
                 try {
                     const langs = typeof course.language === 'string' ? JSON.parse(course.language) : course.language;
                     langCount = Array.isArray(langs) ? langs.length : 0;
                 } catch(e) { langCount = 0; }
                 
                 const provider = course.provider || 'ISICO';
                 const sectorName = course.sector ? course.sector.name : 'General';


                let card = template
                    .replace(/PLACEHOLDER_IMAGE/g, imageUrl)
                    .replace(/COURSE_NAME/g, course.name.replace(/"/g, '&quot;'))
                    .replace(/PROVIDER_NAME/g, provider)
                    .replace(/SECTOR_NAME/g, sectorName)
                    .replace(/SECTOR_ID/g, course.sector_id || '')
                    .replace(/LANGUAGE_COUNT/g, langCount)
                    .replace(/DURATION/g, duration)
                    .replace(/ENROLLMENT_COUNT/g, course.enrollment_count || 0)
                    .replace(/COURSE_ID/g, course.id)
                    .replace(/MODE_LABEL/g, modeLabel)
                    .replace(/PAID_LABEL/g, paidLabel)
                    .replace(/bg-badge-paid/g, 'bg-' + paidBadgeClass)
                    .replace(/bg-badge-mode/g, 'bg-' + modeBadgeClass)
                    .replace('col-md-6 col-lg-4 col-xl-3', 'col-md-6 col-lg-4 col-xl-3 course-card-wrapper-col');
                
                const $card = $(card);
                
                // Initialize Selection State
                if (isSelected) {
                    $card.find('.course-card').addClass('border-primary border-3');
                    $card.find('.course-selected-badge').show();
                    $card.find('.select-course-btn')
                        .removeClass('btn-outline-primary')
                        .addClass('btn-primary')
                        .html('<i class="bi bi-check-circle me-1"></i> Selected');
                }
                
                // Course selection handler
                // Handler attached to both card and button for better UX? No, just button as requested in my thought process, 
                // but usually clicking card is nice. Let's stick to button to avoid conflicts with 'Featured' toggle.
                $card.find('.select-course-btn').on('click', function(e) {
                    // e.stopPropagation(); // prevent card click if we had one
                    toggleCourseSelection($(this), course.id);
                });
                
                grid.append($card);
            });
            
            updateSelectedCount();
        }

        function toggleCourseSelection($btn, courseId) {
             const $courseCard = $btn.closest('.course-card');
             
             if (selectedCourses.includes(courseId)) {
                // Deselect
                selectedCourses = selectedCourses.filter(id => id !== courseId);
                $courseCard.removeClass('border-primary border-3').addClass('animate__animated animate__headShake');
                $courseCard.find('.course-selected-badge').hide();
                $btn.removeClass('btn-primary').addClass('btn-outline-primary')
                    .html('<i class="bi bi-plus-circle me-1"></i> Select Course');
            } else {
                // Select
                selectedCourses.push(courseId);
                $courseCard.addClass('border-primary border-3 animate__animated animate__bounceIn');
                $courseCard.find('.course-selected-badge').show();
                $btn.removeClass('btn-outline-primary').addClass('btn-primary')
                    .html('<i class="bi bi-check-circle me-1"></i> Selected');
            }
             updateSelectedCount();
        }

        function updateSelectedCount() {
            $('#selected-count').text(selectedCourses.length);
            
            // Let's create/update a container for inputs
            let container = $('#selected-courses-inputs');
            if (container.length === 0) {
                 $('<div id="selected-courses-inputs"></div>').appendTo('#learningPathwayForm');
                 container = $('#selected-courses-inputs');
            }
            container.empty();
            
            selectedCourses.forEach(id => {
                container.append(`<input type="hidden" name="courses[]" value="${id}">`);
                // Check if this course is marked as featured
                if ($(`#feat_${id}`).is(':checked')) {
                    container.append(`<input type="hidden" name="course_featured[${id}]" value="1">`);
                }
            });
        }

        // Form submission
        $('#learningPathwayForm').on('submit', function(e) {
            const firstInvalid = validateLearningPathwayForm();

            if (firstInvalid) {
                e.preventDefault();
                e.stopPropagation();
                const invalidTab = firstInvalid.closest('.tab-pane');
                const stepNumber = getStepNumberFromTab(invalidTab);

                showValidationSummary('Please complete the highlighted mandatory fields before creating the learning pathway.', stepNumber);

                if (invalidTab.length) {
                    goToStep(`#${invalidTab.attr('id')}`);
                }

                setTimeout(() => {
                    firstInvalid.trigger('focus');
                }, 50);

                return;
            }

            hideValidationSummary();
            
            // Show loading state
            const submitBtn = $(this).find('button[type="submit"]');
            submitBtn.prop('disabled', true).html(`
                <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                Creating Pathway...
            `);
            
            // Simulate API call
            setTimeout(() => {
                // For demo purposes - actually submit the form
                this.submit();
            }, 1500);
        });

        // Clear invalid styling as soon as a field becomes valid.
        $('#learningPathwayForm').on('input change', ':input', function() {
            if (this.checkValidity()) {
                clearFieldValidation($(this));

                if ($('#learningPathwayForm').find('.is-invalid').length === 0) {
                    hideValidationSummary();
                }
            }
        });

        // Initialize with one flow step
        $('#add-flow-step').trigger('click');
        $('#add-roadmap-step').trigger('click');
        
        // Add custom color class
        $('<style>')
            .prop('type', 'text/css')
            .html(`
                .border-purple { border-color: #8b5cf6 !important; }
                .bg-purple { background-color: #8b5cf6 !important; }
                .text-purple { color: #8b5cf6 !important; }
                .btn-outline-purple { 
                    border-color: #8b5cf6;
                    color: #8b5cf6;
                }
                .btn-outline-purple:hover {
                    background-color: #8b5cf6;
                    color: white;
                }
                .alert-purple {
                    background-color: rgba(139, 92, 246, 0.1);
                    border-color: rgba(139, 92, 246, 0.2);
                    color: #7c3aed;
                }
            `)
            .appendTo('head');

        // Summernote initialization
        if($('#editor').length > 0) {
            $('#editor').summernote({
                height: 300,
                placeholder: 'Describe the learning outcomes...',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        }

        updateProgress();
    });
</script>
@endpush
