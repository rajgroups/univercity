@extends('layouts.admin.app')
@section('content')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</style>
@endpush

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Main Card -->
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-gradient text-white py-4 rounded-top-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="card-title mb-0 fw-bold">
                                <i class="feather icon-edit me-2"></i>Edit Learning Pathway
                            </h4>
                            <p class="mb-0 text-black">Update the structured learning path</p>
                        </div>
                        <a href="{{ route('admin.learningpathways.index', $project->id) }}" class="btn btn-light rounded-pill px-4">
                            <i class="feather icon-arrow-left me-1"></i> Back to List
                        </a>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <form action="{{ route('admin.learningpathways.update', ['project_id' => $project->id, 'id' => $learningPathway->id]) }}" method="POST" id="learningPathwayForm">
                        @csrf

                        
                        <!-- Progress Indicator -->
                        <div class="mb-5">
                            <div class="d-none d-md-flex justify-content-between align-items-center position-relative mb-4">
                                <div class="position-absolute top-50 start-0 end-0 translate-middle-y">
                                    <div class="progress" style="height: 4px;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 20%" id="progress-bar"></div>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-between w-100">
                                    @php
                                        $tabs = ['Sectors', 'Flow', 'Courses', 'Roadmap', 'Outcomes'];
                                    @endphp
                                    @foreach($tabs as $index => $tab)
                                    <div class="d-flex flex-column align-items-center position-relative">
                                        <div class="rounded-circle bg-white border border-3 border-primary d-flex align-items-center justify-content-center mb-2" 
                                             style="width: 50px; height: 50px; z-index: 1;">
                                            <span class="fs-2 fw-bold text-primary">{{ $index + 1 }}</span>
                                        </div>
                                        <span class="small fw-semibold text-muted">{{ $tab }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <!-- Mobile Progress -->
                            <div class="d-md-none mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-muted small">Step <span id="current-step">1</span> of 5</span>
                                    <span class="badge bg-primary rounded-pill">Sectors</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 20%"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Tabs Content -->
                        <div class="tab-content" id="pathwayTabsContent">
                            <!-- Tab 1: Sectors -->
                            <div class="tab-pane fade show active" id="sector" role="tabpanel">
                                <div class="row g-4">
                                    <div class="col-lg-12">
                                        <div class="card border-primary border-2">
                                            <div class="card-body p-4">
                                                <h5 class="card-title text-primary mb-4">
                                                    <i class="feather icon-target me-2"></i>Select Primary Sector
                                                </h5>
                                                <div class="mb-4">
                                                    <label class="form-label fw-semibold">Primary Sector <span class="text-danger">*</span></label>
                                                    <div class="input-group input-group-lg">
                                                        <span class="input-group-text bg-primary text-white">
                                                            <i class="feather icon-disc"></i>
                                                        </span>
                                                        <select class="form-select form-select-lg select2" id="primary_sector_id" name="primary_sector_id" required>
                                                            <option value="" disabled>Choose primary sector...</option>
                                                            @foreach($sectors as $sector)
                                                                <option value="{{ $sector->id }}" {{ $learningPathway->primary_sector_id == $sector->id ? 'selected' : '' }}>{{ $sector->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">Please select a primary sector</div>
                                                    </div>
                                                    <div class="form-text">This will be the main focus of your learning pathway</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card mt-4 border-warning border-2">
                                            <div class="card-body p-4">
                                                <h5 class="card-title text-warning mb-4">
                                                    <i class="feather icon-layers me-2"></i>Associated Sectors
                                                </h5>
                                                
                                                <div class="alert alert-info d-flex align-items-center mb-4">
                                                    <i class="feather icon-info me-3 fs-4"></i>
                                                    <div>Add related sectors to create a multidisciplinary learning experience</div>
                                                </div>

                                                <div class="mb-4">
                                                    <label class="form-label fw-semibold">Add New Sector</label>
                                                    <div class="input-group">
                                                        <select class="form-select select2" id="sector_adder">
                                                            <option value="">Select sector to add...</option>
                                                            @foreach($sectors as $sector)
                                                                <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <button type="button" class="btn btn-warning" id="btn-add-sector">
                                                            <i class="feather icon-plus-circle me-1"></i> Add Sector
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="mt-4">
                                                    <h6 class="fw-semibold mb-3">Selected Sectors <span class="badge bg-warning rounded-pill" id="sector-count">{{ count($learningPathway->sectors) }}</span></h6>
                                                    
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
                                                                @foreach($learningPathway->sectors as $index => $sector)
                                                                <tr data-id="{{ $sector->id }}">
                                                                    <td class="text-center align-middle">
                                                                        <i class="bi bi-grip-vertical text-muted handle"></i>
                                                                    </td>
                                                                    <td class="align-middle">
                                                                        <div class="d-flex align-items-center">
                                                                            <span class="badge bg-secondary rounded-pill me-2">{{ $index + 1 }}</span>
                                                                            {{ $sector->name }}
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-end align-middle">
                                                                        <button type="button" class="btn btn-sm btn-outline-danger remove-sector">
                                                                            <i class="bi bi-trash"></i>
                                                                        </button>
                                                                        <input type="hidden" name="sector_ids[]" value="{{ $sector->id }}">
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    
                                                    <div class="alert alert-light mt-3">
                                                        <div class="d-flex align-items-center">
                                                            <i class="feather icon-move text-muted me-2"></i>
                                                            <small class="text-muted">Drag and drop rows to reorder sectors according to importance</small>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="sector_order" id="sector_order" value="{{ $learningPathway->sectors->pluck('id')->implode(',') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Navigation -->
                                <div class="d-flex justify-content-between mt-5 pt-4 border-top">
                                    <div></div>
                                    <button type="button" class="btn btn-primary btn-lg px-5 btn-next" data-next="#flow">
                                        Next: Flow <i class="feather icon-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Tab 2: Flow -->
                            <div class="tab-pane fade" id="flow" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card border-info">
                                            <div class="card-header bg-info bg-opacity-10 border-bottom">
                                                <h5 class="mb-0 text-info">
                                                    <i class="feather icon-git-merge me-2"></i>Multidisciplinary Flow Design
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="alert alert-info d-flex align-items-center mb-4">
                                                    <i class="feather icon-help-circle me-3 fs-4"></i>
                                                    <div>Design the flow of learning across multiple sectors. Each step represents a phase in the learning journey.</div>
                                                </div>

                                                <div id="flow-container" class="mb-4">
                                                    @foreach($learningPathway->flows as $index => $flow)
                                                    <div class="card border-start border-4 border-start-info mb-3 flow-item shadow-sm">
                                                        <div class="card-body p-4">
                                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                                <div class="d-flex align-items-center">
                                                                    <span class="badge bg-info rounded-pill me-3">Step <span class="step-number">{{ $index + 1 }}</span></span>
                                                                    <h6 class="mb-0 text-info">Flow Step {{ $index + 1 }}</h6>
                                                                </div>
                                                                <button type="button" class="btn btn-sm btn-outline-danger remove-flow-step">
                                                                    <i class="bi bi-trash"></i>
                                                                </button>
                                                            </div>
                                                            <div class="row g-3">
                                                                <div class="col-md-4">
                                                                    <label class="form-label fw-semibold">Sector</label>
                                                                    <select class="form-select flow-sector" name="flows[{{ $index }}][sector_id]" required>
                                                                        <option value="">Select Sector</option>
                                                                        @foreach($sectors as $sector)
                                                                            <option value="{{ $sector->id }}" {{ $flow->sector_id == $sector->id ? 'selected' : '' }}>{{ $sector->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <label class="form-label fw-semibold">Step Title</label>
                                                                    <input type="text" class="form-control" name="flows[{{ $index }}][step_title]" value="{{ $flow->step_title }}" required>
                                                                </div>
                                                                <div class="col-12">
                                                                    <label class="form-label fw-semibold">Description</label>
                                                                    <textarea class="form-control" name="flows[{{ $index }}][description]" rows="2">{{ $flow->description }}</textarea>
                                                                </div>
                                                                <div class="col-12">
                                                                    <label class="form-label fw-semibold">Skills Acquired</label>
                                                                    <input type="text" class="form-control" name="flows[{{ $index }}][skills_text]" value="{{ $flow->skills_text }}">
                                                                    <div class="form-text">Enter skills separated by commas</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>

                                                <button type="button" class="btn btn-outline-info w-100 py-3 border-2" id="add-flow-step">
                                                    <i class="feather icon-plus-circle me-2"></i> Add New Flow Step
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Navigation -->
                                <div class="d-flex justify-content-between mt-5 pt-4 border-top">
                                    <button type="button" class="btn btn-outline-primary btn-lg px-5 btn-prev" data-prev="#sector">
                                        <i class="feather icon-arrow-left me-2"></i> Previous
                                    </button>
                                    <button type="button" class="btn btn-primary btn-lg px-5 btn-next" data-next="#courses">
                                        Next: Courses <i class="feather icon-arrow-right ms-2"></i>
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

                                        <div class="card border-success">
                                            <div class="card-header bg-success bg-opacity-10 border-bottom">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h5 class="mb-0 text-success">
                                                        <i class="feather icon-book me-2"></i>Select Training Courses
                                                    </h5>
                                                    <div>
                                                        <span class="badge bg-success rounded-pill fs-6 px-3 py-2">
                                                            Selected: <span id="selected-count">{{ $learningPathway->courses->count() }}</span> courses
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div id="courses-container">
                                                    <div class="row g-4" id="courses-grid">
                                                        <!-- Initial load from JS -->
                                                    </div>
                                                </div>
                                            </div>
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
                                <div class="d-flex justify-content-between mt-5 pt-4 border-top">
                                    <button type="button" class="btn btn-outline-primary btn-lg px-5 btn-prev" data-prev="#flow">
                                        <i class="feather icon-arrow-left me-2"></i> Previous
                                    </button>
                                    <button type="button" class="btn btn-primary btn-lg px-5 btn-next" data-next="#roadmap">
                                        Next: Roadmap <i class="feather icon-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Tab 4: Roadmap -->
                            <div class="tab-pane fade" id="roadmap" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card border-purple">
                                            <div class="card-header bg-purple bg-opacity-10 border-bottom">
                                                <h5 class="mb-0 text-purple">
                                                    <i class="feather icon-map me-2"></i>Learning Roadmap
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="alert alert-purple d-flex align-items-center mb-4">
                                                    <i class="feather icon-info me-3 fs-4"></i>
                                                    <div>Create a visual roadmap for learners to follow. Each step represents a milestone in their journey.</div>
                                                </div>

                                                <div id="roadmap-container" class="mb-4">
                                                    @foreach($learningPathway->roadmaps as $index => $roadmap)
                                                    <div class="card border-start border-4 border-start-purple mb-3 roadmap-item shadow-sm">
                                                        <div class="card-body p-4">
                                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                                <div class="d-flex align-items-center">
                                                                    <span class="badge bg-purple rounded-pill me-3">Step <span class="step-number">{{ $index + 1 }}</span></span>
                                                                    <h6 class="mb-0 text-purple">Roadmap Step {{ $index + 1 }}</h6>
                                                                </div>
                                                                <button type="button" class="btn btn-sm btn-outline-danger remove-roadmap-step">
                                                                    <i class="bi bi-trash"></i>
                                                                </button>
                                                            </div>
                                                            <div class="row g-3">
                                                                <div class="col-md-6">
                                                                    <label class="form-label fw-semibold">Title</label>
                                                                    <input type="text" class="form-control" name="roadmaps[{{ $index }}][title]" value="{{ $roadmap->title }}" required>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label fw-semibold">Badge Text</label>
                                                                    <input type="text" class="form-control" name="roadmaps[{{ $index }}][badge_text]" value="{{ $roadmap->badge_text }}">
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label fw-semibold">Color</label>
                                                                    <div class="input-group">
                                                                        <input type="color" class="form-control form-control-color" name="roadmaps[{{ $index }}][color]" value="{{ $roadmap->color ?? '#5664d2' }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <label class="form-label fw-semibold">Description</label>
                                                                    <textarea class="form-control" name="roadmaps[{{ $index }}][description]" rows="2">{{ $roadmap->description }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>

                                                <button type="button" class="btn btn-outline-purple w-100 py-3 border-2" id="add-roadmap-step">
                                                    <i class="feather icon-plus-circle me-2"></i> Add Roadmap Step
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Navigation -->
                                <div class="d-flex justify-content-between mt-5 pt-4 border-top">
                                    <button type="button" class="btn btn-outline-primary btn-lg px-5 btn-prev" data-prev="#courses">
                                        <i class="feather icon-arrow-left me-2"></i> Previous
                                    </button>
                                    <button type="button" class="btn btn-primary btn-lg px-5 btn-next" data-next="#outcomes">
                                        Next: Outcomes <i class="feather icon-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Tab 5: Outcomes -->
                            <div class="tab-pane fade" id="outcomes" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card border-success">
                                            <div class="card-header bg-success bg-opacity-10 border-bottom">
                                                <h5 class="mb-0 text-success">
                                                    <i class="feather icon-check-circle me-2"></i>Learning Outcomes & Finalization
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-4">
                                                    <label class="form-label fw-semibold fs-5">Learning Outcomes</label>
                                                    <div class="form-text mb-3">Describe what learners will achieve by completing this pathway</div>
                                                    <textarea name="learning_outcomes" id="editor" class="form-control" rows="10">{{ $learningPathway->learning_outcomes }}</textarea>
                                                </div>

                                                <div class="alert alert-success">
                                                    <h6 class="fw-semibold mb-3"><i class="feather icon-check me-2"></i>Ready to Publish</h6>
                                                    <p class="mb-0">Review all the information before updating your learning pathway. You can always edit it later.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Navigation -->
                                <div class="d-flex justify-content-between mt-5 pt-4 border-top">
                                    <button type="button" class="btn btn-outline-primary btn-lg px-5 btn-prev" data-prev="#roadmap">
                                        <i class="feather icon-arrow-left me-2"></i> Previous
                                    </button>
                                    <button type="submit" class="btn btn-success btn-lg px-5">
                                        <i class="feather icon-check-circle me-2"></i> Update Learning Pathway
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

<!-- Templates -->
<template id="flow-step-template">
    <div class="card border-start border-4 border-start-info mb-3 flow-item shadow-sm">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <span class="badge bg-info rounded-pill me-3">Step <span class="step-number"></span></span>
                    <h6 class="mb-0 text-info">New Flow Step</h6>
                </div>
                <button type="button" class="btn btn-sm btn-outline-danger remove-flow-step">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Sector</label>
                    <select class="form-select flow-sector" name="flows[INDEX][sector_id]">
                        <option value="">Select Sector</option>
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
                    <div class="form-text">Enter skills separated by commas</div>
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
                    <span class="badge bg-purple rounded-pill me-3">Step <span class="step-number"></span></span>
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
@push('scripts')
<!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script>
    $(document).ready(function() {
        // Initialize variables
        let addedSectors = @json($learningPathway->sectors->pluck('id')->toArray());
        let selectedCourses = @json($learningPathway->courses->pluck('id')->toArray());
        let featuredCourses = @json($learningPathway->courses->keyBy('id')->map(function($course) {
            return $course->pivot->is_featured;
        })->toArray());
        
        let flowIndex = {{ $learningPathway->flows->count() }};
        let roadmapIndex = {{ $learningPathway->roadmaps->count() }};
        let currentStep = 1;
        const totalSteps = 5;

        // Initialize Select2
        $('.select2').select2({
            width: '100%',
            placeholder: 'Select an option',
            allowClear: true
        });

        // Fix Select2 validation styling on change
        $('.select2').on('change', function() {
            if($(this).val()) {
                $(this).removeClass('is-invalid');
                $(this).next('.select2-container').removeClass('is-invalid-select');
                $(this).siblings('.invalid-feedback').remove();
            }
        });

        // Progress tracking
        function updateProgress() {
            const progress = (currentStep / totalSteps) * 100;
            $('#progress-bar').css('width', progress + '%');
            $('#current-step').text(currentStep);
        }

        // Wizard navigation
        $(document).on('click', '.btn-next', function(e) {
            e.preventDefault();
            const target = $(this).data('next');
            const currentTab = $('.tab-pane.show.active');
            
            // Validation
            let isValid = true;
            currentTab.find('[required]').each(function() {
                const $input = $(this);
                // Check if empty
                if (!$input.val() || $input.val().length === 0) {
                    isValid = false;
                    $input.addClass('is-invalid');
                    
                    // Handle Select2 specifically
                    if ($input.hasClass('select2-hidden-accessible')) {
                        $input.next('.select2-container').addClass('is-invalid-select');
                        if(!$input.siblings('.invalid-feedback').length) {
                             $input.parent().append('<div class="invalid-feedback d-block">This field is required</div>');
                        }
                    } else {
                        // Normal inputs
                        if(!$input.next('.invalid-feedback').length) {
                            $input.after('<div class="invalid-feedback">This field is required</div>');
                        }
                    }
                } else {
                    $input.removeClass('is-invalid');
                    if ($input.hasClass('select2-hidden-accessible')) {
                        $input.next('.select2-container').removeClass('is-invalid-select');
                        $input.siblings('.invalid-feedback').remove();
                    } else {
                        $input.next('.invalid-feedback').remove();
                    }
                }
            });
            
            if (isValid) {
                // Animation transition
                currentTab.removeClass('show active').addClass('animate__animated animate__fadeOutLeft');
                
                setTimeout(() => {
                    $('.tab-pane').removeClass('show active animate__animated animate__fadeOutLeft animate__fadeOutRight animate__fadeInLeft animate__fadeInRight');
                    $(target).addClass('show active animate__animated animate__fadeInRight');
                    
                    // Update current step
                    const steps = ['#sector', '#flow', '#courses', '#roadmap', '#outcomes'];
                    currentStep = steps.indexOf(target) + 1;
                    updateProgress();
                    
                    if (target === '#courses') fetchCourses();
                }, 300);
            } else {
                // Shake effect for invalid
                currentTab.addClass('animate__animated animate__headShake');
                setTimeout(() => {
                    currentTab.removeClass('animate__animated animate__headShake');
                }, 800);
            }
        });

        $(document).on('click', '.btn-prev', function(e) {
            e.preventDefault();
            const target = $(this).data('prev');
            const currentTab = $('.tab-pane.show.active');
            
            currentTab.removeClass('show active').addClass('animate__animated animate__fadeOutRight');
            
            setTimeout(() => {
                $('.tab-pane').removeClass('show active animate__animated animate__fadeOutLeft animate__fadeOutRight animate__fadeInLeft animate__fadeInRight');
                $(target).addClass('show active animate__animated animate__fadeInLeft');
                
                const steps = ['#sector', '#flow', '#courses', '#roadmap', '#outcomes'];
                currentStep = steps.indexOf(target) + 1;
                updateProgress();
            }, 300);
        });

        // Make functions globally available or attach events here
        
        // Sector Management
        $('#btn-add-sector').on('click', function() {
            const select = $('#sector_adder');
            const sectorId = select.val();
            const sectorName = select.find('option:selected').text();
            
            if (sectorId && !addedSectors.includes(parseInt(sectorId))) {
                addSectorRow(sectorId, sectorName);
                addedSectors.push(parseInt(sectorId));
                select.val(null).trigger('change');
                updateSectorCount();
                updateSectorOrder();
            }
        });

        // Remove Sector
        $(document).on('click', '.remove-sector', function() {
            const tr = $(this).closest('tr');
            const id = tr.data('id');
            tr.addClass('animate__animated animate__fadeOut').one('animationend', function() {
                tr.remove();
                addedSectors = addedSectors.filter(s => s != id);
                updateSectorCount();
                updateSectorOrder();
                reindexSectors();
            });
        });

        // Initialize Sortable
        const sectorList = document.getElementById('sector-list');
        if(sectorList) {
            new Sortable(sectorList, {
                handle: '.handle',
                animation: 150,
                onEnd: function() {
                    updateSectorOrder();
                    reindexSectors();
                }
            });
        }

        function addSectorRow(id, name) {
            const row = `
                <tr data-id="${id}" class="animate__animated animate__fadeIn">
                    <td class="text-center align-middle">
                        <i class="feather icon-menu text-muted handle"></i>
                    </td>
                    <td class="align-middle">
                        <div class="d-flex align-items-center">
                            <span class="badge bg-secondary rounded-pill me-2">${$('#sector-list tr').length + 1}</span>
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
        }

        function reindexSectors() {
            $('#sector-list tr').each(function(index) {
                $(this).find('.badge').text(index + 1);
            });
        }

        function updateSectorCount() {
            $('#sector-count').text(addedSectors.length);
        }

        function updateSectorOrder() {
            const order = [];
            $('#sector-list tr').each(function() {
                order.push($(this).data('id'));
            });
            $('#sector_order').val(order.join(','));
        }

        // Flow Management
        $(document).on('click', '.remove-flow-step', function() {
            $(this).closest('.flow-item').addClass('animate__animated animate__fadeOut').one('animationend', function() {
                $(this).remove();
                reindexFlows();
            });
        });

        $('#add-flow-step').on('click', function() {
            const template = document.getElementById('flow-step-template').innerHTML;
            const newStep = template.replace(/INDEX/g, flowIndex++);
            const $newStep = $(newStep);
            
            $newStep.find('.step-number').text($('#flow-container .flow-item').length + 1);
            
            $('#flow-container').append($newStep);
            
            // Re-bind select2 logic if we add new select2s (current template doesn't seem to use select2, but if it did)
            reindexFlows();
        });

        function reindexFlows() {
            $('#flow-container .flow-item').each(function(index) {
                $(this).find('.step-number').text(index + 1);
                $(this).find('h6').text(`Flow Step ${index + 1}`);
            });
        }

        // Roadmap Management
        $(document).on('click', '.remove-roadmap-step', function() {
            $(this).closest('.roadmap-item').addClass('animate__animated animate__fadeOut').one('animationend', function() {
                $(this).remove();
                reindexRoadmaps();
            });
        });

        $('#add-roadmap-step').on('click', function() {
            const template = document.getElementById('roadmap-step-template').innerHTML;
            const newStep = template.replace(/INDEX/g, roadmapIndex++);
            const $newStep = $(newStep);
            
            $newStep.find('.step-number').text($('#roadmap-container .roadmap-item').length + 1);
            
            $('#roadmap-container').append($newStep);
            reindexRoadmaps();
        });

        function reindexRoadmaps() {
            $('#roadmap-container .roadmap-item').each(function(index) {
                $(this).find('.step-number').text(index + 1);
                $(this).find('h6').text(`Roadmap Step ${index + 1}`);
            });
        }

        // Course Management
        window.fetchCourses = function() { // Expose to global so retry button works if needed
            if (addedSectors.length === 0) {
                $('#courses-grid').html(`
                    <div class="col-12 text-center py-5">
                        <div class="display-1 text-muted mb-4">
                            <i class="feather icon-alert-circle"></i>
                        </div>
                        <h5 class="text-muted mb-3">No Sectors Selected</h5>
                        <p class="text-muted">Please add sectors in Step 1 to view available courses</p>
                    </div>`);
                return;
            }

            $('#course-fetching-msg').show();
            
            $.ajax({
                url: "{{ route('admin.courses.by.sectors') }}",
                method: 'POST',
                data: {
                    sectors: addedSectors,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#course-fetching-msg').hide();
                    renderCourses(data);
                },
                error: function(xhr, status, error) {
                    $('#course-fetching-msg').hide();
                    console.error('Error fetching courses:', error);
                     $('#courses-grid').html(`
                    <div class="col-12 text-center py-5">
                        <div class="display-1 text-danger mb-4">
                            <i class="feather icon-wifi-off"></i>
                        </div>
                        <h5 class="text-danger mb-3">Error fetching courses</h5>
                        <p class="text-muted">Please try again later.</p>
                    </div>`);
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
                            <i class="feather icon-search"></i>
                        </div>
                        <h5 class="text-muted mb-3">No Courses Found</h5>
                        <p class="text-muted">No courses available for the selected sectors</p>
                    </div>`);
                return;
            }

            courses.forEach(course => {
                const isSelected = selectedCourses.includes(course.id);
                const isFeatured = featuredCourses[course.id] || false;
                
                const cardHtml = `
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="card h-100 border course-card ${isSelected ? 'border-primary border-3' : ''}" data-id="${course.id}">
                        <div class="position-absolute top-0 end-0 m-3">
                            <span class="badge bg-primary">Course</span>
                        </div>
                        <img src="${course.image || 'https://placehold.co/400x300?text=No+Image'}" class="card-img-top course-img" alt="Course" style="height: 150px; object-fit: cover;">
                        <div class="card-body">
                            <h6 class="card-title text-truncate" title="${course.name}">${course.name}</h6>
                            <p class="card-text small text-muted mb-2">${course.course_code}</p>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge bg-info">${course.level}</span>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input course-featured-check" type="checkbox" id="feat_${course.id}" ${isFeatured ? 'checked' : ''}>
                                <label class="form-check-label small" for="feat_${course.id}">Mark as Featured</label>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <button type="button" class="btn w-100 select-course-btn ${isSelected ? 'btn-primary' : 'btn-outline-primary'}">
                                ${isSelected ? '<i class="feather icon-check-circle me-1"></i> Selected' : '<i class="feather icon-plus-circle me-1"></i> Select Course'}
                            </button>
                        </div>
                    </div>
                </div>`;
                
                const $card = $(cardHtml);

                // Featured toggle
                $card.find('.course-featured-check').on('change', function() {
                    const id = course.id;
                    if(this.checked) {
                        featuredCourses[id] = true;
                    } else {
                        delete featuredCourses[id];
                    }
                    updateSelectedInputs();
                });
                
                // Course selection
                $card.find('.select-course-btn').on('click', function() {
                    toggleCourseSelection(course.id, $card);
                });
                
                grid.append($card);
            });
        }

        function toggleCourseSelection(id, $card) {
            const $btn = $card.find('.select-course-btn');
            const $inner = $card.find('.course-card');
            
            if (selectedCourses.includes(id)) {
                // Deselect
                selectedCourses = selectedCourses.filter(cid => cid !== id);
                delete featuredCourses[id];
                $inner.removeClass('border-primary border-3');
                $btn.removeClass('btn-primary').addClass('btn-outline-primary')
                    .html('<i class="feather icon-plus-circle me-1"></i> Select Course');
            } else {
                // Select
                selectedCourses.push(id);
                $inner.addClass('border-primary border-3');
                $btn.removeClass('btn-outline-primary').addClass('btn-primary')
                    .html('<i class="feather icon-check-circle me-1"></i> Selected');
            }
            
            $('#selected-count').text(selectedCourses.length);
            updateSelectedInputs();
        }

        function updateSelectedInputs() {
            const container = $('#selected-courses-inputs');
            container.empty();
            
            selectedCourses.forEach(id => {
                container.append(`<input type="hidden" name="courses[]" value="${id}">`);
                if (featuredCourses[id]) {
                    container.append(`<input type="hidden" name="course_featured[${id}]" value="1">`);
                }
            });
            $('#course_order').val(selectedCourses.join(','));
        }

        // CKEditor initialization
        if(document.querySelector('#editor')) {
            ClassicEditor.create(document.querySelector('#editor'))
                .catch(error => {
                    console.error('CKEditor initialization error:', error);
                });
        }

        // Form submission handling
        $('#learningPathwayForm').on('submit', function(e) {
            e.preventDefault();
            
            // Show loading state
            const submitBtn = $(this).find('button[type="submit"]');
            submitBtn.prop('disabled', true).html(`
                <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                Updating Pathway...
            `);
            
            // Submit the form
            this.submit();
        });
        
        // Add custom styles for select2 error
        $('head').append(`
            <style>
                .is-invalid-select .select2-selection {
                    border-color: #dc3545 !important;
                }
            </style>
        `);
    });

    // Run courses fetch initially
    if(typeof fetchCourses !== 'undefined') {
         setTimeout(fetchCourses, 500); 
    }
</script>
@endpush
@endsection