@extends('layouts.admin.app')
@section('content')
@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    :root {
        --primary-color: #4361ee;
        --secondary-color: #3f37c9;
        --success-color: #4cc9f0;
        --bg-color: #f8f9fa;
        --card-bg: #ffffff;
        --text-color: #2b2d42;
        --border-radius: 16px;
    }

    body {
        background-color: var(--bg-color);
        color: var(--text-color);
    }

    .learning-pathway-shell {
        background-color: var(--bg-color);
    }

    .learning-pathway-card {
        background: var(--card-bg);
        border-radius: var(--border-radius);
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.04);
        border: none;
        overflow: hidden;
    }

    .learning-pathway-header {
        background: #fff;
        border-bottom: 1px solid #f0f0f0 !important;
        padding: 2rem !important;
    }

    .learning-pathway-header h4 {
        color: var(--text-color);
        font-weight: 800;
        font-size: 1.5rem;
    }

    .learning-pathway-header p {
        color: #8d99ae;
        font-size: 0.95rem;
    }

    .learning-pathway-header .btn-light {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        color: var(--text-color);
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .learning-pathway-header .btn-light:hover {
        background: #e9ecef;
        transform: translateY(-2px);
    }

    .pathway-nav {
        background: transparent;
        padding: 3rem 1rem;
        box-shadow: none;
        border-radius: 0;
    }

    .step-circle {
        background-color: #fff;
        border: 4px solid #e9ecef;
        color: #adb5bd;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .step-icon {
        transition: all 0.3s ease;
    }

    .pathway-step-trigger {
        z-index: 1;
    }

    .pathway-step-trigger.active-step .step-circle {
        border-color: var(--primary-color);
        background-color: var(--primary-color);
        transform: scale(1.15);
        box-shadow: 0 0 20px rgba(67, 97, 238, 0.4);
    }

    .pathway-step-trigger.active-step .step-icon {
        color: #fff !important;
    }

    .pathway-step-trigger.active-step .step-text {
        color: var(--primary-color) !important;
        font-weight: 700;
    }

    .pathway-step-trigger.completed-step .step-circle {
        border-color: var(--success-color);
        background-color: var(--success-color);
        color: #fff;
    }

    .pathway-step-trigger.completed-step .step-icon {
        color: #fff !important;
    }

    .pathway-step-trigger.completed-step .step-icon::before {
        content: "\f26a"; /* Bootstrap icon check */
    }

    .pathway-step-trigger.has-error .step-circle {
        border-color: #ef233c;
        background-color: #fff;
    }

    .pathway-step-trigger.has-error .step-icon {
        color: #ef233c !important;
    }

    .pathway-step-trigger.has-error.active-step .step-circle {
        background-color: #ef233c;
    }
    
    .pathway-step-trigger.has-error.active-step .step-icon {
        color: #fff !important;
    }

    .step-text {
        letter-spacing: 1px;
        margin-top: 10px;
        font-size: 0.8rem;
    }

    .pathway-panel {
        border-radius: var(--border-radius);
        box-shadow: 0 8px 30px rgba(0,0,0,0.03);
        border: 1px solid #f0f0f0 !important;
        background: #fff;
        transition: all 0.3s ease;
    }

    .pathway-panel:hover {
        box-shadow: 0 10px 40px rgba(0,0,0,0.06);
    }

    .pathway-panel .card-header {
        background: transparent !important;
        border-bottom: 1px dashed #e9ecef !important;
        padding: 1.5rem 2rem;
    }

    .pathway-panel .card-body {
        padding: 2rem;
    }

    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.5rem;
    }

    .form-control, .form-select {
        border-radius: 10px;
        border: 1px solid #ced4da;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        transition: all 0.2s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.1);
    }

    .btn-next, .btn-prev, .btn-submit {
        border-radius: 50px;
        padding: 12px 35px;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .btn-next {
        background: var(--primary-color);
        border: none;
    }

    .btn-next:hover {
        background: var(--secondary-color);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(67, 97, 238, 0.3);
    }

    .btn-prev {
        background: #fff;
        border: 2px solid #e9ecef;
        color: #6c757d;
    }

    .btn-prev:hover {
        background: #f8f9fa;
        border-color: #ced4da;
        color: #495057;
        transform: translateY(-2px);
    }

    .step-action-bar {
        background: #fff;
        padding: 1.5rem 2rem;
        border-top: 1px solid #f0f0f0;
        border-radius: 0 0 var(--border-radius) var(--border-radius);
    }

    /* Course Card Styles */
    .course-card {
        border-radius: 15px;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        background: #fff;
    }

    .course-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
    }

    .course-card.selected-course {
        border-color: var(--primary-color);
        background-color: #f8faff;
    }

    .course-selected-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: var(--primary-color);
        color: #fff;
        padding: 5px 12px;
        border-radius: 30px;
        font-size: 0.8rem;
        font-weight: bold;
        box-shadow: 0 4px 10px rgba(67, 97, 238, 0.3);
        z-index: 10;
        display: none;
    }

    .course-card.selected-course .course-selected-badge {
        display: block;
        animation: fadeInDown 0.3s ease;
    }

    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .course-image-container {
        border-radius: 13px 13px 0 0;
        overflow: hidden;
        position: relative;
    }

    .course-image-container img {
        transition: transform 0.5s ease;
    }

    .course-card:hover .course-image-container img {
        transform: scale(1.05);
    }

    .badge-blur {
        backdrop-filter: blur(8px);
        background-color: rgba(255, 255, 255, 0.85);
        color: #333;
        font-weight: 600;
        border: 1px solid rgba(255,255,255,0.5);
    }

    .pathway-validation-summary {
        display: none;
        border: 1px solid rgba(239, 35, 60, 0.2);
        background: rgba(239, 35, 60, 0.05);
        color: #ef233c;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(239, 35, 60, 0.05);
    }

    .pathway-validation-summary.show {
        display: block;
        animation: fadeIn 0.4s ease;
    }

    .is-invalid {
        border-color: #ef233c !important;
        background-image: none !important;
    }

    .invalid-feedback.dynamic-feedback {
        display: block;
        color: #ef233c;
        font-size: 0.85rem;
        margin-top: 0.4rem;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .required-asterisk {
        color: #ef233c;
        margin-left: 2px;
    }
</style>
@endpush

<div class="container-fluid learning-pathway-shell py-1 py-lg-2">
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <!-- Main Card -->
            <div class="card learning-pathway-card">
                <div class="card-header learning-pathway-header d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                    <div>
                        <h4 class="mb-1">
                            <i class="bi bi-pencil-square text-primary me-2"></i>Edit Learning Pathway
                        </h4>
                        <p class="mb-0">Update the structured learning path</p>
                    </div>
                    <a href="{{ route('admin.project.index', $project->id) }}" class="btn btn-light rounded-pill px-4">
                        <i class="bi bi-arrow-left me-2"></i>Back to Projects
                    </a>
                </div>
                
                <div class="card-body p-0">
                    <form action="{{ route('admin.learningpathways.update', ['project_id' => $project->id, 'id' => $learningPathway->id]) }}" method="POST" id="learningPathwayForm" novalidate>
                        @csrf

                        <div class="px-4 pt-4">
                            <div id="pathway-validation-summary" class="pathway-validation-summary px-4 py-3 mb-0">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="fs-3 text-danger">
                                        <i class="bi bi-exclamation-triangle-fill"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold mb-1">Action Required</div>
                                        <div class="small mb-0" id="pathway-validation-summary-text">Please complete all mandatory fields before proceeding to the next step.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Progress Indicator -->
                        <div class="pathway-nav">
                            <div class="d-none d-md-flex justify-content-between align-items-center position-relative w-100 mx-auto">
                                <div class="position-absolute start-0 end-0 translate-middle-y" style="z-index: 0; padding: 0 30px; top: 32%;">
                                    <div class="progress" style="height: 4px; border-radius: 10px; background-color: #e9ecef;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 0%; transition: width 0.5s ease-in-out;" id="progress-bar"></div>
                                    </div>
                                </div>
                                
                                @foreach(['sector', 'flow', 'courses', 'roadmap', 'outcomes'] as $index => $tab)
                                <button type="button"
                                        class="btn p-0 border-0 bg-transparent d-flex flex-column align-items-center position-relative pathway-step-trigger"
                                        data-target="#{{ $tab }}"
                                        data-step="{{ $index + 1 }}">
                                    <div class="step-circle rounded-circle d-flex align-items-center justify-content-center mb-2 shadow-sm"
                                         style="width: 55px; height: 55px;">
                                        <i class="bi {{ ['bi-bullseye', 'bi-diagram-3', 'bi-book', 'bi-map', 'bi-check-circle'][$index] }} fs-3 step-icon"></i>
                                    </div>
                                    <span class="small fw-bold text-muted step-text text-uppercase">{{ ucfirst($tab) }}</span>
                                </button>
                                @endforeach
                            </div>
                            
                            <!-- Mobile Progress -->
                            <div class="d-md-none px-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted small fw-bold">Step <span id="current-step">1</span> of 5</span>
                                    <span class="badge bg-primary rounded-pill px-3 py-2" id="current-step-label">Sector</span>
                                </div>
                                <div class="progress" style="height: 8px; border-radius: 10px;">
                                    <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" style="width: 20%" id="progress-bar-mobile"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Tabs Content -->
                        <div class="tab-content px-4 pb-4" id="pathwayTabsContent">
                            <!-- Tab 1: Sectors -->
                            <div class="tab-pane fade show active" id="sector" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="pathway-panel mb-4">
                                            <div class="card-header">
                                                <h5 class="mb-0 text-dark fw-bold">
                                                    <i class="bi bi-building text-primary me-2"></i>Primary Sector Selection
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-0">
                                                    <label class="form-label">Primary Sector <span class="required-asterisk">*</span></label>
                                                    <select class="form-select form-select-lg" id="primary_sector_id" name="primary_sector_id" required>
                                                        <option value="" disabled>Choose the main sector for this pathway...</option>
                                                        @foreach($sectors as $sector)
                                                            <option value="{{ $sector->id }}" {{ $learningPathway->primary_sector_id == $sector->id ? 'selected' : '' }}>{{ $sector->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="form-text mt-2"><i class="bi bi-info-circle me-1"></i>This determines the core focus and filters available courses.</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="pathway-panel">
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <h5 class="mb-0 text-dark fw-bold">
                                                    <i class="bi bi-layers text-info me-2"></i>Associated Sectors (Optional)
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <p class="text-muted mb-4">Add secondary sectors if this pathway covers multidisciplinary topics. These will expand the available course pool.</p>
                                                
                                                <div class="row g-3 align-items-end mb-4">
                                                    <div class="col-md-9">
                                                        <label class="form-label">Add Sector</label>
                                                        <select class="form-select" id="sector_adder">
                                                            <option value="" selected disabled>Select an additional sector...</option>
                                                            @foreach($sectors as $sector)
                                                                <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <button type="button" class="btn btn-dark w-100 h-100 py-2" id="btn-add-sector">
                                                            <i class="bi bi-plus-lg me-1"></i> Add
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="table-responsive border rounded-3 bg-light">
                                                    <table class="table table-borderless table-hover mb-0 align-middle">
                                                        <thead class="bg-white border-bottom">
                                                            <tr>
                                                                <th width="50" class="text-center"><i class="bi bi-grip-vertical text-muted"></i></th>
                                                                <th>Sector Name</th>
                                                                <th width="80" class="text-end">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="sector-list" class="sortable-list">
                                                            @foreach($learningPathway->sectors as $index => $sector)
                                                            <tr data-id="{{ $sector->id }}">
                                                                <td class="text-center"><i class="bi bi-grip-vertical text-muted cursor-pointer" style="cursor: grab;"></i></td>
                                                                <td class="fw-semibold text-dark">
                                                                    <span class="badge bg-secondary rounded-pill me-2">{{ $index + 1 }}</span>
                                                                    {{ $sector->name }}
                                                                </td>
                                                                <td class="text-end">
                                                                    <button type="button" class="btn btn-sm btn-outline-danger remove-sector rounded-circle" style="width:32px;height:32px;padding:0;">
                                                                        <i class="bi bi-x-lg"></i>
                                                                    </button>
                                                                    <input type="hidden" name="sector_ids[]" value="{{ $sector->id }}">
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    <div id="no-sectors-msg" class="text-center py-4 text-muted" style="display: {{ $learningPathway->sectors->count() > 0 ? 'none' : 'block' }}">
                                                        No additional sectors added yet.
                                                    </div>
                                                    <input type="hidden" name="sector_order" id="sector_order" value="{{ $learningPathway->sectors->pluck('id')->implode(',') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Navigation -->
                                <div class="step-action-bar d-flex justify-content-between mt-4">
                                    <div></div>
                                    <button type="button" class="btn btn-next px-5" data-next="#flow">
                                        Next Step <i class="bi bi-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Tab 2: Flow -->
                            <div class="tab-pane fade" id="flow" role="tabpanel">
                                <div class="row justify-content-center">
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <div>
                                                <h4 class="fw-bold mb-1">Learning Flow Steps</h4>
                                                <p class="text-muted mb-0">Define the sequential phases of this pathway.</p>
                                            </div>
                                            <button type="button" class="btn btn-dark" id="add-flow-step">
                                                <i class="bi bi-plus-circle me-2"></i> Add Step
                                            </button>
                                        </div>

                                        <div id="flow-container">
                                            @foreach($learningPathway->flows as $index => $flow)
                                            <div class="pathway-panel mb-4 flow-item">
                                                <div class="card-header bg-light d-flex justify-content-between align-items-center py-3">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="badge bg-primary rounded-circle p-2" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;"><span class="step-number fw-bold">{{ $index + 1 }}</span></span>
                                                        <h6 class="mb-0 fw-bold text-dark">Flow Step</h6>
                                                    </div>
                                                    <button type="button" class="btn btn-sm btn-outline-danger remove-flow-step rounded-pill px-3">
                                                        <i class="bi bi-trash me-1"></i> Remove
                                                    </button>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row g-4">
                                                        <div class="col-md-4">
                                                            <label class="form-label">Sector <span class="required-asterisk">*</span></label>
                                                            <select class="form-select flow-sector" name="flows[{{ $index }}][sector_id]" required>
                                                                <option value="" disabled>Select Sector</option>
                                                                @foreach($sectors as $sector)
                                                                    <option value="{{ $sector->id }}" {{ $flow->sector_id == $sector->id ? 'selected' : '' }}>{{ $sector->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <label class="form-label">Step Title <span class="required-asterisk">*</span></label>
                                                            <input type="text" class="form-control" name="flows[{{ $index }}][step_title]" value="{{ $flow->step_title }}" required>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label">Description <span class="required-asterisk">*</span></label>
                                                            <textarea class="form-control" name="flows[{{ $index }}][description]" rows="3" required>{{ $flow->description }}</textarea>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label">Skills Acquired <span class="required-asterisk">*</span></label>
                                                            <input type="text" class="form-control" name="flows[{{ $index }}][skills_text]" value="{{ $flow->skills_text }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="text-center mt-3 mb-4">
                                            <button type="button" class="btn btn-outline-dark w-100 py-3" id="add-flow-step-bottom" style="border-style: dashed !important; border-width: 2px;">
                                                <i class="bi bi-plus-circle me-2"></i> Add Another Step
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Navigation -->
                                <div class="step-action-bar d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-prev px-4" data-prev="#sector">
                                        <i class="bi bi-arrow-left me-2"></i> Previous
                                    </button>
                                    <button type="button" class="btn btn-next px-5" data-next="#courses">
                                        Next Step <i class="bi bi-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Tab 3: Courses -->
                            <div class="tab-pane fade" id="courses" role="tabpanel">
                                <div class="row justify-content-center">
                                    <div class="col-lg-12">
                                        <div class="pathway-panel">
                                            <div class="card-header bg-white d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                                                <div>
                                                    <h5 class="mb-0 text-dark fw-bold">
                                                        <i class="bi bi-journal-bookmark-fill text-primary me-2"></i>Course Selection
                                                    </h5>
                                                    <p class="text-muted small mb-0 mt-1">Select the required courses for this pathway.</p>
                                                </div>
                                                <div class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 rounded-pill px-4 py-2 fs-6">
                                                    Selected: <span id="selected-count" class="fw-bold">{{ $learningPathway->courses->count() }}</span>
                                                </div>
                                            </div>
                                            <div class="card-body bg-light">
                                                <div class="alert alert-primary align-items-center mb-4 border-0 shadow-sm" role="alert" id="course-fetching-msg" style="display:none">
                                                    <div class="spinner-border spinner-border-sm me-3" role="status"></div>
                                                    <strong>Fetching courses based on your sector selection...</strong>
                                                </div>

                                                <div class="row g-3 mb-4 align-items-end bg-white p-3 rounded-3 shadow-sm border">
                                                    <div class="col-md-5">
                                                        <label class="form-label small text-muted text-uppercase fw-bold">Search Course</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text bg-transparent border-end-0"><i class="bi bi-search text-muted"></i></span>
                                                            <input type="text" id="course-search-input" class="form-control border-start-0 ps-0" placeholder="Type course name...">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <label class="form-label small text-muted text-uppercase fw-bold">Filter by Sector</label>
                                                        <select id="course-sector-filter" class="form-select">
                                                            <option value="">All Sectors</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="button" class="btn btn-outline-secondary w-100" id="clear-course-filters">Clear</button>
                                                    </div>
                                                </div>

                                                <div class="row g-4" id="courses-grid">
                                                    <!-- Course cards dynamically added -->
                                                </div>
                                            </div>
                                            
                                            <!-- Hidden inputs wrapper -->
                                            <div id="selected-courses-inputs">
                                                @foreach($learningPathway->courses as $course)
                                                <input type="hidden" name="courses[]" value="{{ $course->id }}">
                                                @if($course->pivot->is_featured)
                                                <input type="hidden" name="course_featured[{{ $course->id }}]" value="1">
                                                @endif
                                                @endforeach
                                            </div>
                                            <input type="hidden" name="course_order" id="course_order" value="{{ $learningPathway->courses->pluck('id')->implode(',') }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Navigation -->
                                <div class="step-action-bar d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-prev px-4" data-prev="#flow">
                                        <i class="bi bi-arrow-left me-2"></i> Previous
                                    </button>
                                    <button type="button" class="btn btn-next px-5" data-next="#roadmap">
                                        Next Step <i class="bi bi-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Tab 4: Roadmap -->
                            <div class="tab-pane fade" id="roadmap" role="tabpanel">
                                <div class="row justify-content-center">
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <div>
                                                <h4 class="fw-bold mb-1">Visual Roadmap</h4>
                                                <p class="text-muted mb-0">Create the milestones for the student's journey.</p>
                                            </div>
                                            <button type="button" class="btn btn-dark" id="add-roadmap-step">
                                                <i class="bi bi-plus-circle me-2"></i> Add Milestone
                                            </button>
                                        </div>

                                        <div id="roadmap-container">
                                            @foreach($learningPathway->roadmaps as $index => $roadmap)
                                            <div class="pathway-panel mb-4 roadmap-item">
                                                <div class="card-header bg-light d-flex justify-content-between align-items-center py-3">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="badge bg-dark rounded-circle p-2" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;"><span class="step-number fw-bold">{{ $index + 1 }}</span></span>
                                                        <h6 class="mb-0 fw-bold text-dark">Roadmap Milestone</h6>
                                                    </div>
                                                    <button type="button" class="btn btn-sm btn-outline-danger remove-roadmap-step rounded-pill px-3">
                                                        <i class="bi bi-trash me-1"></i> Remove
                                                    </button>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row g-4">
                                                        <div class="col-md-5">
                                                            <label class="form-label">Title <span class="required-asterisk">*</span></label>
                                                            <input type="text" class="form-control" name="roadmaps[{{ $index }}][title]" value="{{ $roadmap->title }}" required>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Badge Text <span class="required-asterisk">*</span></label>
                                                            <input type="text" class="form-control" name="roadmaps[{{ $index }}][badge_text]" value="{{ $roadmap->badge_text }}" required>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">Color <span class="required-asterisk">*</span></label>
                                                            <div class="input-group">
                                                                <input type="color" class="form-control form-control-color" name="roadmaps[{{ $index }}][color]" value="{{ $roadmap->color ?? '#4361ee' }}" required>
                                                                <span class="input-group-text bg-white">{{ $roadmap->color ?? '#4361ee' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label">Description <span class="required-asterisk">*</span></label>
                                                            <textarea class="form-control" name="roadmaps[{{ $index }}][description]" rows="3" required>{{ $roadmap->description }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="text-center mt-3 mb-4">
                                            <button type="button" class="btn btn-outline-dark w-100 py-3" id="add-roadmap-step-bottom" style="border-style: dashed !important; border-width: 2px;">
                                                <i class="bi bi-plus-circle me-2"></i> Add Another Milestone
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Navigation -->
                                <div class="step-action-bar d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-prev px-4" data-prev="#courses">
                                        <i class="bi bi-arrow-left me-2"></i> Previous
                                    </button>
                                    <button type="button" class="btn btn-next px-5" data-next="#outcomes">
                                        Next Step <i class="bi bi-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Tab 5: Outcomes -->
                            <div class="tab-pane fade" id="outcomes" role="tabpanel">
                                <div class="row justify-content-center">
                                    <div class="col-lg-12">
                                        <div class="pathway-panel mb-4">
                                            <div class="card-header">
                                                <h5 class="mb-0 text-dark fw-bold">
                                                    <i class="bi bi-trophy text-warning me-2"></i>Learning Outcomes
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-4">
                                                    <label class="form-label fs-6">What will students achieve? <span class="required-asterisk">*</span></label>
                                                    <textarea name="learning_outcomes" id="editor" class="form-control" rows="8" required>{{ $learningPathway->learning_outcomes }}</textarea>
                                                    <div class="invalid-feedback dynamic-feedback" id="editor-feedback" style="display: none;">Learning outcomes description is required.</div>
                                                </div>

                                                <div class="alert alert-success border-0 shadow-sm d-flex align-items-start gap-3 p-4">
                                                    <i class="bi bi-check-circle-fill fs-2 text-success"></i>
                                                    <div>
                                                        <h5 class="fw-bold mb-1 text-success">Ready to Publish</h5>
                                                        <p class="mb-0 text-dark opacity-75">You have completed all the necessary steps. Review your inputs and click update to save changes.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Navigation -->
                                <div class="step-action-bar d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-prev px-4" data-prev="#roadmap">
                                        <i class="bi bi-arrow-left me-2"></i> Previous
                                    </button>
                                    <button type="submit" class="btn btn-success btn-submit px-5" id="submit-btn">
                                        <i class="bi bi-send-fill me-2"></i> Update Pathway
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
    <div class="pathway-panel mb-4 flow-item">
        <div class="card-header bg-light d-flex justify-content-between align-items-center py-3">
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-primary rounded-circle p-2" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;"><span class="step-number fw-bold">1</span></span>
                <h6 class="mb-0 fw-bold text-dark">Flow Step</h6>
            </div>
            <button type="button" class="btn btn-sm btn-outline-danger remove-flow-step rounded-pill px-3">
                <i class="bi bi-trash me-1"></i> Remove
            </button>
        </div>
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-4">
                    <label class="form-label">Sector <span class="required-asterisk">*</span></label>
                    <select class="form-select flow-sector" name="flows[INDEX][sector_id]" required>
                        <option value="" selected disabled>Select Sector</option>
                        @foreach($sectors as $sector)
                            <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-8">
                    <label class="form-label">Step Title <span class="required-asterisk">*</span></label>
                    <input type="text" class="form-control" name="flows[INDEX][step_title]" 
                           placeholder="e.g., Foundation Phase" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Description <span class="required-asterisk">*</span></label>
                    <textarea class="form-control" name="flows[INDEX][description]" rows="3" 
                              placeholder="Describe what learners will achieve..." required></textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">Skills Acquired <span class="required-asterisk">*</span></label>
                    <input type="text" class="form-control" name="flows[INDEX][skills_text]" 
                           placeholder="e.g., Communication, Problem-solving" required>
                </div>
            </div>
        </div>
    </div>
</template>

<template id="roadmap-step-template">
    <div class="pathway-panel mb-4 roadmap-item">
        <div class="card-header bg-light d-flex justify-content-between align-items-center py-3">
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-dark rounded-circle p-2" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;"><span class="step-number fw-bold">1</span></span>
                <h6 class="mb-0 fw-bold text-dark">Roadmap Milestone</h6>
            </div>
            <button type="button" class="btn btn-sm btn-outline-danger remove-roadmap-step rounded-pill px-3">
                <i class="bi bi-trash me-1"></i> Remove
            </button>
        </div>
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-5">
                    <label class="form-label">Title <span class="required-asterisk">*</span></label>
                    <input type="text" class="form-control" name="roadmaps[INDEX][title]" 
                           placeholder="e.g., Beginner Level" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Badge Text <span class="required-asterisk">*</span></label>
                    <input type="text" class="form-control" name="roadmaps[INDEX][badge_text]" 
                           placeholder="e.g., Certified" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Color <span class="required-asterisk">*</span></label>
                    <div class="input-group">
                        <input type="color" class="form-control form-control-color" name="roadmaps[INDEX][color]" value="#4361ee" required>
                        <span class="input-group-text bg-white">#4361ee</span>
                    </div>
                </div>
                <div class="col-12">
                    <label class="form-label">Description <span class="required-asterisk">*</span></label>
                    <textarea class="form-control" name="roadmaps[INDEX][description]" rows="3"
                              placeholder="Describe this milestone..." required></textarea>
                </div>
            </div>
        </div>
    </div>
</template>

<template id="course-card-template">
    <div class="col-md-6 col-lg-4 col-xl-3 course-card-wrapper-col">
        <div class="course-card card h-100 shadow-sm cursor-pointer select-course-wrapper" data-id="COURSE_ID" data-name="COURSE_NAME" data-sector="SECTOR_ID">
            <div class="course-selected-badge">
                <i class="bi bi-check-circle-fill me-1"></i>Selected
            </div>
            <div class="course-image-container position-relative">
                <img src="PLACEHOLDER_IMAGE" class="card-img-top w-100" alt="COURSE_NAME" style="height: 180px; object-fit: cover;">
                <div class="position-absolute top-0 start-0 w-100 h-100 p-3 d-flex flex-column justify-content-between pointer-events-none">
                    <div class="d-flex justify-content-between">
                        <span class="badge badge-blur rounded-pill px-3 py-2 text-uppercase" style="font-size: 0.7rem;">MODE_LABEL</span>
                        <span class="badge badge-blur rounded-pill px-3 py-2 text-uppercase bg-badge-paid" style="font-size: 0.7rem; color: #fff;">PAID_LABEL</span>
                    </div>
                </div>
            </div>
            <div class="card-body d-flex flex-column p-4">
                <h6 class="card-title fw-bold text-dark mb-2" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; min-height: 2.5rem;">COURSE_NAME</h6>
                <div class="d-flex align-items-center text-muted small mb-1">
                    <i class="bi bi-building me-2"></i> <span class="text-truncate">PROVIDER_NAME</span>
                </div>
                <div class="d-flex align-items-center text-primary small mb-3 fw-semibold">
                    <i class="bi bi-tags me-2"></i> <span class="text-truncate">SECTOR_NAME</span>
                </div>
                
                <div class="d-flex justify-content-between text-muted small mb-4 py-2 border-top border-bottom">
                    <span class="d-flex align-items-center"><i class="bi bi-translate me-1"></i> LANGUAGE_COUNT</span>
                    <span class="d-flex align-items-center"><i class="bi bi-clock me-1"></i> DURATION</span>
                </div>
                
                <div class="mt-auto">
                    <button type="button" class="btn btn-outline-primary w-100 rounded-pill select-course-btn" data-id="COURSE_ID">
                        <i class="bi bi-plus-lg me-1"></i> Select Course
                    </button>
                    
                    <div class="form-check form-switch mt-3 d-flex align-items-center justify-content-center bg-light rounded-pill py-2">
                        <input class="form-check-input course-featured-check m-0 me-2" type="checkbox" role="switch" id="feat_COURSE_ID">
                        <label class="form-check-label small fw-bold text-dark cursor-pointer" for="feat_COURSE_ID">Highlight Featured</label>
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
        // Initialize Select2 if present
        if($.fn.select2) {
            $('.select2').select2({
                theme: 'bootstrap-5',
                placeholder: 'Select an option',
                allowClear: true
            });
        }

        // Existing data
        let addedSectors = @json($learningPathway->sectors->pluck('id')->toArray());
        let selectedCourses = @json($learningPathway->courses->pluck('id')->toArray());
        let featuredCourses = @json($learningPathway->courses->keyBy('id')->map(function($course) {
            return $course->pivot->is_featured;
        })->toArray());

        // --- Wizard Logic ---
        let currentStep = 1;
        const totalSteps = 5;
        const stepLabels = {1: 'Sector', 2: 'Flow', 3: 'Courses', 4: 'Roadmap', 5: 'Outcomes'};
        
        function updateProgress() {
            const progress = ((currentStep - 1) / (totalSteps - 1)) * 100;
            $('#progress-bar').css('width', progress + '%');
            $('#progress-bar-mobile').css('width', progress + '%');
            $('#current-step').text(currentStep);
            $('#current-step-label').text(stepLabels[currentStep]);
            
            $('.pathway-step-trigger').each(function() {
                const step = parseInt($(this).data('step'));
                $(this).removeClass('active-step completed-step');
                if (step === currentStep) {
                    $(this).addClass('active-step');
                } else if (step < currentStep) {
                    $(this).addClass('completed-step');
                }
            });
        }

        function goToStep(target) {
            const $targetTab = $(target);
            if ($targetTab.length === 0) return;

            const nextStep = parseInt($(`.pathway-step-trigger[data-target="${target}"]`).data('step'));
            $('.tab-pane').removeClass('show active');
            $targetTab.addClass('show active');

            currentStep = nextStep;
            updateProgress();

            if (target === '#courses') {
                fetchCourses();
            }
        }

        function validateRequiredFields($scope) {
            let firstInvalidField = null;
            // Also validate Summernote if it's in this scope
            const $editor = $scope.find('#editor');
            if ($editor.length > 0) {
                 const isEmpty = $('#editor').summernote('isEmpty');
                 if(isEmpty) {
                     $('#editor-feedback').show();
                     firstInvalidField = $('#editor').next('.note-editor');
                 } else {
                     $('#editor-feedback').hide();
                 }
            }

            const $requiredFields = $scope.find('input[required], select[required], textarea[required]:not(#editor)').filter(':visible');

            $requiredFields.each(function() {
                const $field = $(this);
                $field.removeClass('is-invalid');
                $field.siblings('.dynamic-feedback').remove();

                if (!this.checkValidity() || ($field.is('select') && !$field.val())) {
                    $field.addClass('is-invalid');
                    const msg = this.validationMessage || 'This field is required.';
                    $field.after(`<div class="invalid-feedback dynamic-feedback">${msg}</div>`);

                    if (!firstInvalidField) {
                        firstInvalidField = $field;
                    }
                }
            });

            return firstInvalidField;
        }

        $('.btn-next').on('click', function(e) {
            e.preventDefault();
            const $currentTab = $('.tab-pane.active');
            const firstInvalid = validateRequiredFields($currentTab);

            if (firstInvalid) {
                const step = parseInt($(`.pathway-step-trigger[data-target="#${$currentTab.attr('id')}"]`).data('step'));
                $('#pathway-validation-summary').addClass('show');
                $(`.pathway-step-trigger[data-step="${step}"]`).addClass('has-error');
                
                $('html, body').animate({ scrollTop: firstInvalid.offset().top - 150 }, 300);
                return;
            }

            $('#pathway-validation-summary').removeClass('show');
            $('.pathway-step-trigger').removeClass('has-error');
            goToStep($(this).data('next'));
        });

        $('.btn-prev').on('click', function(e) {
            e.preventDefault();
            goToStep($(this).data('prev'));
        });

        $('.pathway-step-trigger').on('click', function(e) {
            e.preventDefault();
            // Optional: Prevent skipping ahead if current step is invalid
            const targetStep = parseInt($(this).data('step'));
            if(targetStep > currentStep) {
                const firstInvalid = validateRequiredFields($('.tab-pane.active'));
                if(firstInvalid) {
                    $('#pathway-validation-summary').addClass('show');
                    $(`.pathway-step-trigger[data-step="${currentStep}"]`).addClass('has-error');
                    return;
                }
            }
            $('#pathway-validation-summary').removeClass('show');
            $('.pathway-step-trigger').removeClass('has-error');
            goToStep($(this).data('target'));
        });

        // Clear validation on input
        $('#learningPathwayForm').on('input change', ':input[required]', function() {
            if (this.checkValidity() && ($(this).val() !== '')) {
                $(this).removeClass('is-invalid');
                $(this).siblings('.dynamic-feedback').remove();
            }
        });

        // --- Sector Management ---
        $('#btn-add-sector').on('click', function() {
            const select = $('#sector_adder');
            const sectorId = select.val();
            const sectorName = select.find('option:selected').text();
            
            if (sectorId && !addedSectors.includes(parseInt(sectorId))) {
                addSectorRow(sectorId, sectorName);
                addedSectors.push(parseInt(sectorId));
                select.val('');
                $('#no-sectors-msg').hide();
                updateSectorOrder();
            }
        });

        function addSectorRow(id, name) {
            const rowCount = $('#sector-list tr').length + 1;
            const row = `
                <tr data-id="${id}">
                    <td class="text-center"><i class="bi bi-grip-vertical text-muted cursor-pointer" style="cursor: grab;"></i></td>
                    <td class="fw-semibold text-dark">
                        <span class="badge bg-secondary rounded-pill me-2">${rowCount}</span>
                        ${name}
                    </td>
                    <td class="text-end">
                        <button type="button" class="btn btn-sm btn-outline-danger remove-sector rounded-circle" style="width:32px;height:32px;padding:0;">
                            <i class="bi bi-x-lg"></i>
                        </button>
                        <input type="hidden" name="sector_ids[]" value="${id}">
                    </td>
                </tr>`;
            
            $('#sector-list').append(row);
            bindSectorRemove();
            
            if(document.getElementById('sector-list')) {
                new Sortable(document.getElementById('sector-list'), {
                    animation: 150,
                    ghostClass: 'bg-light',
                    onEnd: function() {
                        updateSectorOrder();
                        reindexSectors();
                    }
                });
            }
        }

        function bindSectorRemove() {
            $('.remove-sector').off('click').on('click', function() {
                const tr = $(this).closest('tr');
                const rowId = tr.data('id');
                tr.fadeOut(300, function() {
                    $(this).remove();
                    addedSectors = addedSectors.filter(s => s != rowId);
                    if(addedSectors.length === 0) $('#no-sectors-msg').show();
                    updateSectorOrder();
                    reindexSectors();
                });
            });
        }
        
        function reindexSectors() {
            $('#sector-list tr').each(function(index) {
                $(this).find('.badge').text(index + 1);
            });
        }
        
        function updateSectorOrder() {
            const order = [];
            $('#sector-list tr').each(function() {
                order.push($(this).data('id'));
            });
            $('#sector_order').val(order.join(','));
        }

        bindSectorRemove();
        
        if(document.getElementById('sector-list')) {
            new Sortable(document.getElementById('sector-list'), {
                animation: 150,
                ghostClass: 'bg-light',
                onEnd: function() {
                    updateSectorOrder();
                    reindexSectors();
                }
            });
        }

        // --- Flow Management ---
        let flowIndex = {{ $learningPathway->flows->count() }};
        
        $('#add-flow-step, #add-flow-step-bottom').on('click', function() {
            const template = $('#flow-step-template').html();
            const newStep = template.replace(/INDEX/g, flowIndex++);
            const $newStep = $(newStep);
            
            const stepNumber = $('#flow-container .flow-item').length + 1;
            $newStep.find('.step-number').text(stepNumber);
            
            $('#flow-container').append($newStep.hide().slideDown(300));
            bindFlowRemove();
        });

        function bindFlowRemove() {
            $('.remove-flow-step').off('click').on('click', function() {
                $(this).closest('.flow-item').slideUp(300, function() {
                    $(this).remove();
                    updateFlowNumbers();
                });
            });
        }

        function updateFlowNumbers() {
            $('#flow-container .flow-item').each(function(index) {
                const stepNum = index + 1;
                $(this).find('.step-number').text(stepNum);
            });
        }
        
        bindFlowRemove();

        // --- Roadmap Management ---
        let roadmapIndex = {{ $learningPathway->roadmaps->count() }};
        
        $('#add-roadmap-step, #add-roadmap-step-bottom').on('click', function() {
            const template = $('#roadmap-step-template').html();
            const newStep = template.replace(/INDEX/g, roadmapIndex++);
            const $newStep = $(newStep);
            
            const stepNumber = $('#roadmap-container .roadmap-item').length + 1;
            $newStep.find('.step-number').text(stepNumber);
            
            $newStep.find('input[type="color"]').on('input', function() {
                $(this).closest('.input-group').find('.input-group-text').text($(this).val());
            });
            
            $('#roadmap-container').append($newStep.hide().slideDown(300));
            bindRoadmapRemove();
        });

        function bindRoadmapRemove() {
            $('.remove-roadmap-step').off('click').on('click', function() {
                $(this).closest('.roadmap-item').slideUp(300, function() {
                    $(this).remove();
                    updateRoadmapNumbers();
                });
            });
            
            $('#roadmap-container input[type="color"]').off('input').on('input', function() {
                $(this).closest('.input-group').find('.input-group-text').text($(this).val());
            });
        }

        function updateRoadmapNumbers() {
            $('#roadmap-container .roadmap-item').each(function(index) {
                $(this).find('.step-number').text(index + 1);
            });
        }
        
        bindRoadmapRemove();

        // --- Course Management ---
        window.fetchCourses = function() {
            let primarySectorId = $('#primary_sector_id').val();
            let sectorsToFetch = [...addedSectors];
            
            if (primarySectorId && !sectorsToFetch.includes(parseInt(primarySectorId))) {
                sectorsToFetch.push(parseInt(primarySectorId));
            }

            if (sectorsToFetch.length === 0) {
                $('#courses-grid').html(`
                    <div class="col-12 text-center py-5 bg-white rounded-3 border border-dashed">
                        <i class="bi bi-inboxes text-muted" style="font-size: 3rem;"></i>
                        <h5 class="text-muted mt-3 mb-2">No Sectors Selected</h5>
                        <p class="text-muted small">Please select a primary sector in Step 1 to view relevant courses.</p>
                        <button class="btn btn-outline-primary btn-sm btn-prev mt-2 px-4 rounded-pill" data-prev="#sector">Go to Sectors</button>
                    </div>`);
                return;
            }

            $('#course-fetching-msg').fadeIn();
            
            $.ajax({
                url: "{{ route('admin.courses.by.sectors') }}",
                method: 'POST',
                data: {
                    sectors: sectorsToFetch,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#course-fetching-msg').hide();
                    updateSectorFilterDropdown(data);
                    renderCourses(data);
                },
                error: function(xhr, status, error) {
                    $('#course-fetching-msg').hide();
                    $('#courses-grid').html(`
                    <div class="col-12 text-center py-5 bg-white rounded-3 border border-dashed">
                        <i class="bi bi-exclamation-triangle text-danger" style="font-size: 3rem;"></i>
                        <h5 class="text-danger mt-3 mb-2">Error fetching courses</h5>
                        <p class="text-muted small">Please try again later.</p>
                    </div>`);
                }
            });
        }
        
        function updateSectorFilterDropdown(courses) {
            const filterDropdown = $('#course-sector-filter');
            filterDropdown.empty().append('<option value="">All Sectors</option>');
            
            let uniqueSectors = {};
            courses.forEach(c => {
                if(c.sector) uniqueSectors[c.sector_id] = c.sector.name;
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
                    <div class="col-12 text-center py-5 bg-white rounded-3 border border-dashed">
                        <i class="bi bi-search text-muted" style="font-size: 3rem;"></i>
                        <h5 class="text-muted mt-3 mb-2">No Courses Found</h5>
                        <p class="text-muted small">We couldn't find any courses for the selected sectors.</p>
                    </div>`);
                return;
            }

            courses.forEach(course => {
                const template = $('#course-card-template').html();
                const isSelected = selectedCourses.includes(course.id);
                const isFeatured = featuredCourses[course.id] || false;
                
                let imageUrl = 'https://via.placeholder.com/400x300/f8f9fa/adb5bd?text=No+Image';
                if (course.image) {
                    imageUrl = course.image.startsWith('http') ? course.image : "{{ asset('') }}" + course.image;
                }

                const modes = {1: 'Online', 2: 'In-Centre', 3: 'Hybrid', 4: 'On-Demand'};
                const modeLabel = modes[course.mode_of_study] || 'N/A';
                
                const paidLabel = course.paid_type === 'free' ? 'FREE' : 'PAID';
                const paidBadgeColor = course.paid_type === 'free' ? 'background-color: rgba(25, 135, 84, 0.85) !important;' : 'background-color: rgba(220, 53, 69, 0.85) !important;';

                let duration = course.duration_number && course.duration_unit ? course.duration_number + ' ' + course.duration_unit : 'Flexible';

                let langCount = 0;
                try {
                    const langs = typeof course.language === 'string' ? JSON.parse(course.language) : course.language;
                    langCount = Array.isArray(langs) ? langs.length : 0;
                } catch(e) {}
                 
                const provider = course.provider || 'ISICO';
                const sectorName = course.sector ? course.sector.name : 'General';

                let cardHtml = template
                    .replace(/PLACEHOLDER_IMAGE/g, imageUrl)
                    .replace(/COURSE_NAME/g, course.name.replace(/"/g, '&quot;'))
                    .replace(/PROVIDER_NAME/g, provider)
                    .replace(/SECTOR_NAME/g, sectorName)
                    .replace(/SECTOR_ID/g, course.sector_id || '')
                    .replace(/LANGUAGE_COUNT/g, langCount)
                    .replace(/DURATION/g, duration)
                    .replace(/COURSE_ID/g, course.id)
                    .replace(/MODE_LABEL/g, modeLabel)
                    .replace(/PAID_LABEL/g, paidLabel)
                    .replace(/bg-badge-paid/g, '') // remove class
                    .replace('class="badge badge-blur rounded-pill px-3 py-2 text-uppercase bg-badge-paid"', `class="badge badge-blur rounded-pill px-3 py-2 text-uppercase" style="${paidBadgeColor}"`);
                
                const $card = $(cardHtml);
                
                if (isSelected) {
                    $card.find('.course-card').addClass('selected-course');
                    $card.find('.select-course-btn')
                        .removeClass('btn-outline-primary').addClass('btn-primary')
                        .html('<i class="bi bi-check2-circle me-1"></i> Selected');
                }
                
                if (isFeatured) {
                    $card.find('.course-featured-check').prop('checked', true);
                }
                
                $card.find('.select-course-btn').on('click', function() {
                    toggleCourseSelection($(this), course.id);
                });
                
                $card.find('.course-featured-check').on('change', function() {
                    if(this.checked) {
                        featuredCourses[course.id] = true;
                    } else {
                        delete featuredCourses[course.id];
                    }
                    updateSelectedCount();
                });
                
                grid.append($card);
            });
            updateSelectedCount();
        }

        function toggleCourseSelection($btn, courseId) {
             const $courseCard = $btn.closest('.course-card');
             if (selectedCourses.includes(courseId)) {
                selectedCourses = selectedCourses.filter(id => id !== courseId);
                delete featuredCourses[courseId];
                $courseCard.find('.course-featured-check').prop('checked', false);
                $courseCard.removeClass('selected-course');
                $btn.removeClass('btn-primary').addClass('btn-outline-primary')
                    .html('<i class="bi bi-plus-lg me-1"></i> Select Course');
            } else {
                selectedCourses.push(courseId);
                $courseCard.addClass('selected-course');
                $btn.removeClass('btn-outline-primary').addClass('btn-primary')
                    .html('<i class="bi bi-check2-circle me-1"></i> Selected');
            }
            updateSelectedCount();
        }

        function updateSelectedCount() {
            $('#selected-count').text(selectedCourses.length);
            
            let container = $('#selected-courses-inputs');
            container.empty();
            
            selectedCourses.forEach(id => {
                container.append(`<input type="hidden" name="courses[]" value="${id}">`);
                if (featuredCourses[id]) {
                    container.append(`<input type="hidden" name="course_featured[${id}]" value="1">`);
                }
            });
            $('#course_order').val(selectedCourses.join(','));
        }

        // --- Submission ---
        $('#learningPathwayForm').on('submit', function(e) {
            // First check basic HTML5 validity
            if (!this.checkValidity()) {
                 e.preventDefault();
            }
            
            let hasError = false;
            let firstErrorTab = null;

            // Validate all tabs explicitly to catch hidden ones
            $('#pathwayTabsContent .tab-pane').each(function() {
                 const invalidField = validateRequiredFields($(this));
                 if (invalidField) {
                     hasError = true;
                     if (!firstErrorTab) {
                         firstErrorTab = $(this);
                     }
                 }
            });

            if (hasError) {
                e.preventDefault();
                $('#pathway-validation-summary').addClass('show');
                if (firstErrorTab) {
                    const targetId = '#' + firstErrorTab.attr('id');
                    const stepNum = $(`.pathway-step-trigger[data-target="${targetId}"]`).data('step');
                    $(`.pathway-step-trigger[data-step="${stepNum}"]`).addClass('has-error');
                    goToStep(targetId);
                }
                return;
            }

            // Show loading
            const submitBtn = $('#submit-btn');
            submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Updating...');
        });

        // Init
        if($('#editor').length > 0 && $.fn.summernote) {
            $('#editor').summernote({
                height: 250,
                placeholder: 'Describe the learning outcomes...',
                toolbar: [
                    ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']],
                    ['view', ['fullscreen']]
                ]
            });
            
            $('#editor').on('summernote.change', function(we, contents, $editable) {
                if ($('#editor').summernote('isEmpty')) {
                    $('#editor-feedback').show();
                } else {
                    $('#editor-feedback').hide();
                }
            });
        }

        updateProgress();
        
        if(typeof fetchCourses !== 'undefined') {
            setTimeout(fetchCourses, 500); 
        }
    });
</script>
@endpush