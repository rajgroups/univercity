@extends('layouts.admin.app')
@section('content')
@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endpush


<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Main Card with gradient header -->
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary bg-gradient text-white py-4 rounded-top-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="card-title mb-0 fw-bold">
                                <i class="bi bi-diagram-3 me-2"></i>Create Learning Pathway
                            </h4>
                            <p class="mb-0 opacity-75">Step-by-step pathway builder for structured learning</p>
                        </div>
                        <a href="{{ route('admin.learningpathways.index', $project->id) }}" class="btn btn-light rounded-pill px-4">
                            <i class="bi bi-arrow-left me-1"></i> Back to List
                        </a>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <form action="{{ route('admin.learningpathways.store', $project->id) }}" method="POST" id="learningPathwayForm">
                        @csrf
                        
                        <!-- Progress Indicator -->
                        <div class="mb-5">
                            <div class="d-none d-md-flex justify-content-between align-items-center position-relative">
                                <div class="position-absolute top-50 start-0 end-0 translate-middle-y">
                                    <div class="progress" style="height: 4px;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 20%" id="progress-bar"></div>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-between w-100">
                                    @foreach(['sector', 'flow', 'courses', 'roadmap', 'outcomes'] as $index => $tab)
                                    <div class="d-flex flex-column align-items-center position-relative">
                                        <div class="rounded-circle bg-white border border-3 border-primary d-flex align-items-center justify-content-center mb-2" 
                                             style="width: 50px; height: 50px; z-index: 1;">
                                            <span class="fs-2 fw-bold text-primary">{{ $index + 1 }}</span>
                                        </div>
                                        <span class="small fw-semibold text-muted">{{ ucfirst($tab) }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <!-- Mobile Progress -->
                            <div class="d-md-none">
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

                                        <div class="card mt-4 border-warning border-2">
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
                                <div class="d-flex justify-content-between mt-5 pt-4 border-top">
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
                                        <div class="card border-info">
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
                                <div class="d-flex justify-content-between mt-5 pt-4 border-top">
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

                                        <div class="card border-success">
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
                                <div class="d-flex justify-content-between mt-5 pt-4 border-top">
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
                                        <div class="card border-purple">
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
                                <div class="d-flex justify-content-between mt-5 pt-4 border-top">
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
                                        <div class="card border-success">
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
                                <div class="d-flex justify-content-between mt-5 pt-4 border-top">
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
        <div class="card h-100 border course-card">
            <div class="position-absolute top-0 end-0 m-3">
                <span class="badge bg-primary">Course</span>
            </div>
            <img src="PLACEHOLDER_IMAGE" class="card-img-top course-img" alt="Course" style="height: 150px; object-fit: cover;">
            <div class="card-body">
                <h6 class="card-title text-truncate" title="COURSE_NAME">COURSE_NAME</h6>
                <p class="card-text small text-muted mb-2">COURSE_CODE</p>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="badge bg-info">LEVEL</span>
                    <small class="text-muted">Duration</small>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input course-featured-check" type="checkbox" role="switch" id="feat_COURSE_ID">
                    <label class="form-check-label small" for="feat_COURSE_ID">Mark as Featured</label>
                </div>
            </div>
            <div class="card-footer bg-transparent border-top-0">
                <button type="button" class="btn btn-outline-primary w-100 select-course-btn" data-id="COURSE_ID">
                    <i class="bi bi-plus-circle me-1"></i> Select Course
                </button>
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
        
        function updateProgress() {
            const progress = (currentStep / totalSteps) * 100;
            $('#progress-bar').css('width', progress + '%');
            $('#current-step').text(currentStep);
        }

        // Wizard navigation
        $('.btn-next').on('click', function(e) {
            e.preventDefault();
            const target = $(this).data('next');
            const currentTab = $('.tab-pane.active');
            
            // Simple validation for current tab
            let isValid = true;
            currentTab.find('[required]').each(function() {
                if (!$(this).val()) {
                    isValid = false;
                    $(this).addClass('is-invalid');
                    $(this).after('<div class="invalid-feedback">This field is required</div>');
                }
            });
            
            if (isValid) {
                // Add animation
                currentTab.removeClass('show active').addClass('animate__animated animate__fadeOutLeft');
                
                setTimeout(() => {
                    $(target).addClass('show active animate__animated animate__fadeInRight');
                    currentStep++;
                    updateProgress();
                    
                    // If moving to courses tab, fetch courses
                    if (target === '#courses') {
                        fetchCourses();
                    }
                }, 300);
            }
        });

        $('.btn-prev').on('click', function(e) {
            e.preventDefault();
            const target = $(this).data('prev');
            const currentTab = $('.tab-pane.active');
            
            currentTab.removeClass('show active').addClass('animate__animated animate__fadeOutRight');
            
            setTimeout(() => {
                $(target).addClass('show active animate__animated animate__fadeInLeft');
                currentStep--;
                updateProgress();
            }, 300);
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
        function fetchCourses() {
            if (addedSectors.length === 0) {
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
            
            // Simulate AJAX call - replace with actual API call
            setTimeout(() => {
                $('#course-fetching-msg').hide();
                renderCourses(getSampleCourses());
            }, 1000);
        }

        function getSampleCourses() {
            // Sample data - replace with actual API response
            return [
                {
                    id: 1,
                    name: 'Introduction to Web Development',
                    course_code: 'WEB-101',
                    level: 'Beginner',
                    image: 'https://via.placeholder.com/400x300/5664d2/ffffff?text=Web+Dev'
                },
                {
                    id: 2,
                    name: 'Data Science Fundamentals',
                    course_code: 'DS-201',
                    level: 'Intermediate',
                    image: 'https://via.placeholder.com/400x300/10b981/ffffff?text=Data+Science'
                },
                {
                    id: 3,
                    name: 'Mobile App Development',
                    course_code: 'MOB-301',
                    level: 'Advanced',
                    image: 'https://via.placeholder.com/400x300/f59e0b/ffffff?text=Mobile+App'
                },
                {
                    id: 4,
                    name: 'UI/UX Design Principles',
                    course_code: 'UX-102',
                    level: 'Beginner',
                    image: 'https://via.placeholder.com/400x300/ef4444/ffffff?text=UI/UX'
                }
            ];
        }

        function renderCourses(courses) {
            const grid = $('#courses-grid');
            grid.empty();
            
            if (courses.length === 0) {
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
                
                let card = template
                    .replace(/PLACEHOLDER_IMAGE/g, course.image || 'https://via.placeholder.com/400x300/cccccc/666666?text=No+Image')
                    .replace(/COURSE_NAME/g, course.name)
                    .replace(/COURSE_CODE/g, course.course_code)
                    .replace(/LEVEL/g, course.level)
                    .replace(/COURSE_ID/g, course.id);
                
                const $card = $(card);
                
                if (isSelected) {
                    $card.find('.course-card').addClass('border-primary border-3');
                    $card.find('.select-course-btn')
                        .removeClass('btn-outline-primary')
                        .addClass('btn-primary')
                        .html('<i class="bi bi-check-circle me-1"></i> Selected');
                }
                
                // Course selection
                $card.find('.select-course-btn').on('click', function() {
                    const courseId = $(this).data('id');
                    const $btn = $(this);
                    const $courseCard = $btn.closest('.course-card');
                    
                    if (selectedCourses.includes(courseId)) {
                        // Deselect
                        selectedCourses = selectedCourses.filter(id => id !== courseId);
                        $courseCard.removeClass('border-primary border-3').addClass('animate__animated animate__headShake');
                        $btn.removeClass('btn-primary').addClass('btn-outline-primary')
                            .html('<i class="bi bi-plus-circle me-1"></i> Select Course');
                    } else {
                        // Select
                        selectedCourses.push(courseId);
                        $courseCard.addClass('border-primary border-3 animate__animated animate__bounceIn');
                        $btn.removeClass('btn-outline-primary').addClass('btn-primary')
                            .html('<i class="bi bi-check-circle me-1"></i> Selected');
                    }
                    
                    updateSelectedCount();
                });
                
                grid.append($card);
            });
            
            updateSelectedCount();
        }

        function updateSelectedCount() {
            $('#selected-count').text(selectedCourses.length);
            // Update hidden inputs for selected courses
            let inputs = '';
            selectedCourses.forEach(id => {
                inputs += `<input type="hidden" name="courses[]" value="${id}">`;
                // Check if this course is marked as featured
                if ($(`#feat_${id}`).is(':checked')) {
                    inputs += `<input type="hidden" name="course_featured[${id}]" value="1">`;
                }
            });
            $('#selected-courses-inputs').html(inputs);
        }

        // Form submission
        $('#learningPathwayForm').on('submit', function(e) {
            e.preventDefault();
            
            // Show loading state
            const submitBtn = $(this).find('button[type="submit"]');
            const originalText = submitBtn.html();
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
    });
</script>
@endpush