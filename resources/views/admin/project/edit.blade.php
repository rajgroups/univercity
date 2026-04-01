@extends('layouts.admin.app')
@section('content')
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Edit Project</h4>
                <h6>Update project details - Current Stage: <span
                        class="badge bg-{{ $project->stage == 'upcoming' ? 'warning' : ($project->stage == 'ongoing' ? 'info' : 'success') }}">{{ ucfirst($project->stage) }}</span>
                </h6>
            </div>
        </div>
        <ul class="table-top-head">
            <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Refresh"><i class="ti ti-refresh"></i></a>
            </li>
            <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" id="collapse-header" aria-label="Collapse"><i
                        class="ti ti-chevron-up"></i></a>
            </li>
        </ul>
        <div class="page-btn mt-0">
            <a href="{{ route('admin.project.index') }}" class="btn btn-secondary">
                <i class="feather feather-arrow-left me-2"></i>Back to List
            </a>
        </div>
    </div>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Error Message (Session) --}}
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Error Message --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Please fix the following errors:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('admin.project.update', $project->id) }}" method="POST" enctype="multipart/form-data"
        class="add-product-form" id="projectForm">
        @csrf
        @method('PUT')

        <div class="add-product">

            <!-- Hidden Stage Input -->
            <input type="hidden" name="stage" value="{{ $project->stage }}">

            <!-- Range Meter / Stepper -->
            <div class="stage-stepper">
                <div class="step-item" id="step_upcoming" data-stage="upcoming">
                    <div class="step-circle">1</div>
                    <div class="step-label">Upcoming<br>(Planning)</div>
                </div>
                <div class="step-item" id="step_ongoing" data-stage="ongoing">
                    <div class="step-circle">2</div>
                    <div class="step-label">Ongoing<br>(Implementation)</div>
                </div>
                <div class="step-item" id="step_completed" data-stage="completed">
                    <div class="step-circle">3</div>
                    <div class="step-label">Completed<br>(Closed)</div>
                </div>
            </div>

            <!-- Nav Tabs -->
            <ul class="nav nav-tabs custom-tabs mb-4 px-3" id="projectTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="basic-tab-link" data-bs-toggle="tab" data-bs-target="#basic_tab"
                        type="button" role="tab" aria-controls="basic_tab" aria-selected="true">
                        <i class="feather feather-info"></i> Basic Details
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="location-tab-link" data-bs-toggle="tab" data-bs-target="#location_tab"
                        type="button" role="tab" aria-controls="location_tab" aria-selected="false">
                        <i class="feather feather-map-pin"></i> Location
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="strategic-tab-link" data-bs-toggle="tab" data-bs-target="#strategic_tab"
                        type="button" role="tab" aria-controls="strategic_tab" aria-selected="false">
                        <i class="feather feather-target"></i> Goals & Impact
                    </button>
                </li>
                <li class="nav-item" role="presentation" style="display: none;">
                    <button class="nav-link" id="ongoing-tab-link" data-bs-toggle="tab" data-bs-target="#ongoing_tab"
                        type="button" role="tab" aria-controls="ongoing_tab" aria-selected="false">
                        <i class="feather feather-clock"></i> Ongoing Updates
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="csr-tab-link" data-bs-toggle="tab" data-bs-target="#csr_tab"
                        type="button" role="tab" aria-controls="csr_tab" aria-selected="false">
                        <i class="feather feather-users"></i> CSR & Stakeholders
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="resources-tab-link" data-bs-toggle="tab"
                        data-bs-target="#resources_tab" type="button" role="tab" aria-controls="resources_tab"
                        aria-selected="false">
                        <i class="feather feather-shield"></i> Resources & Risks
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="media-tab-link" data-bs-toggle="tab" data-bs-target="#media_tab"
                        type="button" role="tab" aria-controls="media_tab" aria-selected="false">
                        <i class="feather feather-file-text"></i> Media
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="projectTabContent">
                @php
                    $isUpcoming = $project->stage === 'upcoming';
                    $beneficiaries = $project->beneficiaries;
                    $groups = $beneficiaries->where('type', 'group');
                    $individuals = $beneficiaries->where('type', 'individual');

                    // Dropdown Options
                    $groupOptions = [
                        'Schools',
                        'Colleges / Higher Education Institutions',
                        'Women Self-Help Groups (SHGs)',
                        'Farmer Producer Organizations (FPOs)',
                        'Village Communities / Panchayats',
                        'Rural Areas',
                        'Urban Areas',
                        'Metro Cities',
                        'Taluk / Block Level',
                        'District Level',
                        'Training / Skill Development Centers',
                        'Community-Based Organizations (CBOs) / NGOs',
                    ];

                    $individualOptions = [
                        'Children',
                        'Students',
                        'Youth',
                        'Job Seekers / Unemployed',
                        'Women',
                        'Girls',
                        'Men',
                        'Farmers',
                        'Entrepreneurs / Micro-Enterprise Owners',
                        'Self-Employed / Informal Workers',
                        'Elderly Persons',
                        'Persons with Disabilities (PwD)',
                        'Economically Weaker Section (EWS)',
                        'Migrant / Returned Migrant Workers',
                    ];
                @endphp

                <!-- MOVED FIELDS from Section 0 (Project ID, Location Type, Status) to Basic Details or kept global above tabs?
                                     User said "form fields not realted filed only tab active others tab".
                                     Let's keep the global fields (Project ID, Location Type, Status) inside the Basic Details tab for cleaner UI, or separate.
                                     The current Section 0 had these fields. I will move them to Basic Tab (Tab 1).
                                -->

                <div class="d-none">
                    <!-- Placeholder to swallow functionality of Section 0 -->
                </div>

                <!-- Tab 1: Basic Project Details -->
                <div class="tab-pane show active" id="basic_tab" role="tabpanel">
                    <div class="border p-4 rounded-3 bg-white mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="text-primary mb-0"><i class="feather feather-info me-2"></i> Basic Project Details
                            </h5>
                        </div>

                        <!-- Restored Global Fields -->
                        <div class="row mb-4 p-3 bg-light rounded-3 border">
                            <div class="col-md-4">
                                <label class="form-label small text-muted text-uppercase fw-bold">Project ID</label>
                                <input type="text" class="form-control form-control-sm fw-bold text-dark"
                                    name="project_code" value="{{ old('project_code', $project->project_code) }}"
                                    readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small text-muted text-uppercase fw-bold">Current Status</label>
                                <select name="status" class="form-select form-select-sm select2">
                                    <option value="active"
                                        {{ old('status', $project->status) == 'active' ? 'selected' : '' }}>Active (Visible)
                                    </option>
                                    <option value="inactive"
                                        {{ old('status', $project->status) == 'inactive' ? 'selected' : '' }}>Inactive
                                        (Hidden)</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small text-muted text-uppercase fw-bold">Location Scope</label>
                                <select name="location_type" class="form-select form-select-sm select2">
                                    <option value="RUR"
                                        {{ old('location_type', $project->location_type) == 'RUR' ? 'selected' : '' }}>
                                        Rural</option>
                                    <option value="URB"
                                        {{ old('location_type', $project->location_type) == 'URB' ? 'selected' : '' }}>
                                        Urban</option>
                                    <option value="MET"
                                        {{ old('location_type', $project->location_type) == 'MET' ? 'selected' : '' }}>
                                        Metro</option>
                                    <option value="MIX"
                                        {{ old('location_type', $project->location_type) == 'MIX' ? 'selected' : '' }}>
                                        Mixed</option>
                                </select>
                            </div>
                        </div>
                        <hr class="mb-4">
                        <div class="row">
                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Project Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        name="title" value="{{ old('title', $project->title) }}"
                                        placeholder="Enter Official Project Title">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Enter the official name of the project</div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Sub Title</label>
                                    <input type="text" class="form-control @error('subtitle') is-invalid @enderror"
                                        name="subtitle" value="{{ old('subtitle', $project->subtitle) }}"
                                        placeholder="Tagline or project vision one line">
                                    @error('subtitle')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Optional: A short tagline or vision statement</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Slug <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                        name="slug" value="{{ old('slug', $project->slug) }}"
                                        placeholder="URL-friendly version">
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">URL-friendly version of project title</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Category <span class="text-danger">*</span></label>
                                    <select name="category_id"
                                        class="form-select select2 @error('category_id') is-invalid @enderror">
                                        <option value="">Select Category</option>
                                        @if (isset($categories) && $categories->count())
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id', $project->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Select the primary category for this project</div>
                                </div>
                            </div>
                        </div>

                        <!-- Short Description -->
                        <div class="mb-3">
                            <label for="short_description" class="form-label">Short Description <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control @error('short_description') is-invalid @enderror" name="short_description"
                                id="short_description" rows="3" placeholder="Scope of Project / Outline of Intention (2-3 lines)">{{ old('short_description', $project->short_description) }}</textarea>
                            @error('short_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Brief summary of project scope and intention (2-3 lines)</div>
                        </div>

                        <!-- Full Description -->
                        <div class="mb-3">
                            <label class="form-label">Detailed Description <span class="text-danger">*</span></label>
                            <textarea name="description" id="summernote" class="form-control @error('description') is-invalid @enderror"
                                rows="6" placeholder="Detailed Overview of Project / full narrative purpose of project">{{ old('description', $project->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Complete narrative describing project purpose and details</div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Banner Images</label>
                                    <input type="file"
                                        class="form-control @error('banner_images') is-invalid @enderror"
                                        name="banner_images" accept="image/*" multiple>
                                    @error('banner_images')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @error('banner_images.*')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    {{-- @dd($project->banner_images); --}}
                                    @if ($project->banner_images && $project->banner_images !== '[]' && $project->banner_images !== '"[]"')
                                        <div class="mt-2">
                                            <label class="form-label small">Existing Banner Image:</label>

                                            <div class="position-relative d-inline-block" style="width: 80px;">
                                                <img src="{{ asset($project->banner_images) }}" alt="Banner"
                                                    class="img-thumbnail"
                                                    style="width: 80px; height: 60px; object-fit: cover;">

                                                <button type="button"
                                                    class="btn btn-sm btn-danger position-absolute top-0 end-0 p-0"
                                                    style="width: 20px; height: 20px; font-size: 10px;"
                                                    onclick="removeImage('banner', '{{ $project->banner_images }}')">
                                                    ×
                                                </button>
                                            </div>

                                            <input type="hidden" name="existing_banners"
                                                value="{{ $project->banner_images }}">
                                        </div>
                                    @endif

                                    <div class="form-text">Upload multiple real images of project area (schools, villages,
                                        etc.) - Max 5MB each</div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Thumbnail Image</label>
                                    <input type="file"
                                        class="form-control @error('thumbnail_image') is-invalid @enderror"
                                        name="thumbnail_image" accept="image/*">
                                    @error('thumbnail_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <!-- Existing Thumbnail -->
                                    @if ($project->thumbnail_image)
                                        <div class="mt-2">
                                            <label class="form-label small">Existing Thumbnail:</label>
                                            <div class="position-relative d-inline-block">
                                                <img src="{{ asset($project->thumbnail_image) }}" alt="Thumbnail"
                                                    class="img-thumbnail"
                                                    style="width: 100px; height: 100px; object-fit: cover;">
                                                <button type="button"
                                                    class="btn btn-sm btn-danger position-absolute top-0 end-0 p-0"
                                                    style="width: 20px; height: 20px; font-size: 10px;"
                                                    onclick="removeImage('thumbnail', '{{ $project->thumbnail_image }}')">×</button>
                                            </div>
                                            <input type="hidden" name="existing_thumbnail"
                                                value="{{ $project->thumbnail_image }}">
                                        </div>
                                    @endif
                                    <div class="form-text">Main thumbnail image for project listing - Max 5MB</div>
                                </div>
                            </div>
                        </div>

                        <!-- Dates Section -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Planned Start Date <span
                                            class="text-danger">*</span></label>
                                    <input type="date"
                                        class="form-control @error('planned_start_date') is-invalid @enderror"
                                        name="planned_start_date"
                                        value="{{ old('planned_start_date', $project->planned_start_date ? $project->planned_start_date->format('Y-m-d') : '') }}">
                                    @error('planned_start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Tentative start date for the project</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Planned End Date</label>
                                    <input type="date"
                                        class="form-control @error('planned_end_date') is-invalid @enderror"
                                        name="planned_end_date"
                                        value="{{ old('planned_end_date', $project->planned_end_date ? $project->planned_end_date->format('Y-m-d') : '') }}">
                                    @error('planned_end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Tentative completion date (optional)</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Auto Duration (days)</label>
                                    <input type="text" class="form-control" id="auto_duration" readonly
                                        value="{{ $project->planned_start_date && $project->planned_end_date ? \Carbon\Carbon::parse($project->planned_start_date)->diffInDays($project->planned_end_date) . ' days' : '' }}">
                                    <div class="form-text">Calculated based on start and end dates</div>
                                </div>
                            </div>
                        </div>

                        <!-- Actual Dates for Ongoing/Completed Projects -->
                        <div class="row mt-3" id="actual_dates_section"
                            style="{{ in_array($project->stage, ['ongoing', 'completed']) ? '' : 'display:none;' }}">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Actual Start Date <span class="text-danger">*</span></label>
                                    <input type="date"
                                        class="form-control @error('actual_start_date') is-invalid @enderror"
                                        name="actual_start_date"
                                        value="{{ old('actual_start_date', $project->actual_start_date ? $project->actual_start_date->format('Y-m-d') : '') }}">
                                    @error('actual_start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Actual project start date</div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Project Progress</label>
                                    <div class="input-group">
                                        <input type="number"
                                            class="form-control @error('project_progress') is-invalid @enderror"
                                            name="project_progress" min="0" max="100"
                                            value="{{ old('project_progress', $project->project_progress) }}">
                                        <span class="input-group-text">%</span>
                                    </div>
                                    @error('project_progress')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Current completion percentage</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab 2: Target Location -->
                <div class="tab-pane" id="location_tab" role="tabpanel">
                    <div class="border p-4 rounded-3 bg-white mb-4">
                        <h5 class="mb-4 text-primary"><i class="feather feather-map-pin me-2"></i> Target Location Details
                        </h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Location Type <span class="text-danger">*</span></label>
                                    <select name="target_location_type" id="target_location_type"
                                        class="form-select select2 @error('target_location_type') is-invalid @enderror">
                                        <option value="">Select Type</option>
                                        <option value="single"
                                            {{ old('target_location_type', $project->target_location_type) == 'single' ? 'selected' : '' }}>
                                            Single Location</option>
                                        <option value="multiple"
                                            {{ old('target_location_type', $project->target_location_type) == 'multiple' ? 'selected' : '' }}>
                                            Multiple Locations</option>
                                    </select>
                                    @error('target_location_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Select whether project has single or multiple locations</div>
                                </div>
                            </div>
                        </div>

                        <!-- Single Location -->
                        <div id="single_location_section"
                            style="display: {{ old('target_location_type', $project->target_location_type) == 'single' ? 'block' : 'none' }};">
                            <h6>Single Location Details</h6>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Pin Code</label>
                                        <input type="text" name="pincode"
                                            class="form-control @error('pincode') is-invalid @enderror"
                                            value="{{ old('pincode', $project->pincode) }}"
                                            placeholder="Enter 6-digit PIN code">
                                        @error('pincode')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">State</label>
                                        <input type="text" name="state"
                                            class="form-control @error('state') is-invalid @enderror"
                                            value="{{ old('state', $project->state) }}" placeholder="Enter state name">
                                        @error('state')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">District</label>
                                        <input type="text" name="district"
                                            class="form-control @error('district') is-invalid @enderror"
                                            value="{{ old('district', $project->district) }}"
                                            placeholder="Enter district name">
                                        @error('district')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Taluk</label>
                                        <input type="text" name="taluk"
                                            class="form-control @error('taluk') is-invalid @enderror"
                                            value="{{ old('taluk', $project->taluk) }}" placeholder="Enter taluk name">
                                        @error('taluk')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Panchayat</label>
                                        <input type="text" name="panchayat"
                                            class="form-control @error('panchayat') is-invalid @enderror"
                                            value="{{ old('panchayat', $project->panchayat) }}"
                                            placeholder="Enter panchayat name">
                                        @error('panchayat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Building Name</label>
                                        <input type="text" name="building_name"
                                            class="form-control @error('building_name') is-invalid @enderror"
                                            value="{{ old('building_name', $project->building_name) }}"
                                            placeholder="Enter building name">
                                        @error('building_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">GPS Map DIGI PIN (optional)</label>
                                        <input type="text" name="gps_coordinates"
                                            class="form-control @error('gps_coordinates') is-invalid @enderror"
                                            value="{{ old('gps_coordinates', $project->gps_coordinates) }}"
                                            placeholder="e.g., 12.3456, 78.9012">
                                        @error('gps_coordinates')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Optional: Enter latitude, longitude coordinates</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Multiple Locations -->
                        <div id="multiple_locations_section"
                            style="display: {{ old('target_location_type', $project->target_location_type) == 'multiple' ? 'block' : 'none' }};">
                            <h6>Multiple Locations</h6>
                            <div id="multiple_locations_wrapper">
                                @php
                                    $multipleLocations = old('multiple_locations', $project->multiple_locations);
                                @endphp

                                @if ($multipleLocations && is_array($multipleLocations) && count($multipleLocations) > 0)
                                    @foreach ($multipleLocations as $index => $location)
                                        <div class="location-group mb-3 border p-3">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label">Pin Code</label>
                                                    <input type="text"
                                                        name="multiple_locations[{{ $index }}][pincode]"
                                                        class="form-control @error('multiple_locations.' . $index . '.pincode') is-invalid @enderror"
                                                        value="{{ $location['pincode'] ?? '' }}"
                                                        placeholder="6-digit PIN">
                                                    @error('multiple_locations.' . $index . '.pincode')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">State</label>
                                                    <input type="text"
                                                        name="multiple_locations[{{ $index }}][state]"
                                                        class="form-control @error('multiple_locations.' . $index . '.state') is-invalid @enderror"
                                                        value="{{ $location['state'] ?? '' }}" placeholder="State name">
                                                    @error('multiple_locations.' . $index . '.state')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">District</label>
                                                    <input type="text"
                                                        name="multiple_locations[{{ $index }}][district]"
                                                        class="form-control @error('multiple_locations.' . $index . '.district') is-invalid @enderror"
                                                        value="{{ $location['district'] ?? '' }}"
                                                        placeholder="District name">
                                                    @error('multiple_locations.' . $index . '.district')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Taluk</label>
                                                    <input type="text"
                                                        name="multiple_locations[{{ $index }}][taluk]"
                                                        class="form-control @error('multiple_locations.' . $index . '.taluk') is-invalid @enderror"
                                                        value="{{ $location['taluk'] ?? '' }}" placeholder="Taluk name">
                                                    @error('multiple_locations.' . $index . '.taluk')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-6">
                                                    <label class="form-label">Panchayat</label>
                                                    <input type="text"
                                                        name="multiple_locations[{{ $index }}][panchayat]"
                                                        class="form-control @error('multiple_locations.' . $index . '.panchayat') is-invalid @enderror"
                                                        value="{{ $location['panchayat'] ?? '' }}"
                                                        placeholder="Panchayat name">
                                                    @error('multiple_locations.' . $index . '.panchayat')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Building Name</label>
                                                    <input type="text"
                                                        name="multiple_locations[{{ $index }}][building_name]"
                                                        class="form-control @error('multiple_locations.' . $index . '.building_name') is-invalid @enderror"
                                                        value="{{ $location['building_name'] ?? '' }}"
                                                        placeholder="Building name">
                                                    @error('multiple_locations.' . $index . '.building_name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <button type="button"
                                                class="btn btn-sm btn-danger mt-2 remove-location">Remove</button>
                                        </div>
                                    @endforeach
                                @elseif(old('multiple_locations') && is_array(old('multiple_locations')))
                                    @foreach (old('multiple_locations') as $index => $location)
                                        <div class="location-group mb-3 border p-3">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label">Pin Code</label>
                                                    <input type="text"
                                                        name="multiple_locations[{{ $index }}][pincode]"
                                                        class="form-control @error('multiple_locations.' . $index . '.pincode') is-invalid @enderror"
                                                        value="{{ $location['pincode'] ?? '' }}"
                                                        placeholder="6-digit PIN">
                                                    @error('multiple_locations.' . $index . '.pincode')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">State</label>
                                                    <input type="text"
                                                        name="multiple_locations[{{ $index }}][state]"
                                                        class="form-control @error('multiple_locations.' . $index . '.state') is-invalid @enderror"
                                                        value="{{ $location['state'] ?? '' }}" placeholder="State name">
                                                    @error('multiple_locations.' . $index . '.state')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">District</label>
                                                    <input type="text"
                                                        name="multiple_locations[{{ $index }}][district]"
                                                        class="form-control @error('multiple_locations.' . $index . '.district') is-invalid @enderror"
                                                        value="{{ $location['district'] ?? '' }}"
                                                        placeholder="District name">
                                                    @error('multiple_locations.' . $index . '.district')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Taluk</label>
                                                    <input type="text"
                                                        name="multiple_locations[{{ $index }}][taluk]"
                                                        class="form-control @error('multiple_locations.' . $index . '.taluk') is-invalid @enderror"
                                                        value="{{ $location['taluk'] ?? '' }}" placeholder="Taluk name">
                                                    @error('multiple_locations.' . $index . '.taluk')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-6">
                                                    <label class="form-label">Panchayat</label>
                                                    <input type="text"
                                                        name="multiple_locations[{{ $index }}][panchayat]"
                                                        class="form-control @error('multiple_locations.' . $index . '.panchayat') is-invalid @enderror"
                                                        value="{{ $location['panchayat'] ?? '' }}"
                                                        placeholder="Panchayat name">
                                                    @error('multiple_locations.' . $index . '.panchayat')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Building Name</label>
                                                    <input type="text"
                                                        name="multiple_locations[{{ $index }}][building_name]"
                                                        class="form-control @error('multiple_locations.' . $index . '.building_name') is-invalid @enderror"
                                                        value="{{ $location['building_name'] ?? '' }}"
                                                        placeholder="Building name">
                                                    @error('multiple_locations.' . $index . '.building_name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <button type="button"
                                                class="btn btn-sm btn-danger mt-2 remove-location">Remove</button>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" class="btn btn-primary" id="add_location">Add Location</button>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Target Location Summary (Optional)</label>
                                    <textarea class="form-control @error('location_summary') is-invalid @enderror" name="location_summary"
                                        rows="2" placeholder="e.g., We covered 10 schools across the Sivagangai district">{{ old('location_summary', $project->location_summary) }}</textarea>
                                    @error('location_summary')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Brief summary of geographical coverage</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3 form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="show_map_preview"
                                        value="1" id="show_map_preview"
                                        {{ old('show_map_preview', $project->show_map_preview) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="show_map_preview">
                                        Show Map Preview on Frontend
                                    </label>
                                    <div class="form-text">Enable to display map on the project page</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Location Tab -->

                <!-- Tab 3: Strategic Goals -->
                <div class="tab-pane" id="strategic_tab" role="tabpanel">
                    <div class="border p-4 rounded-3 bg-white mb-4">
                        <h5 class="mb-4 text-primary"><i class="feather feather-target me-2"></i> Strategic Goals,
                            Objective &
                            Impact</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Problem / Need Statement <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control @error('problem_statement') is-invalid @enderror" name="problem_statement"
                                        rows="3" placeholder="Describe the problem or need this project addresses">{{ old('problem_statement', $project->problem_statement) }}</textarea>
                                    @error('problem_statement')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Clear statement of the problem or need being addressed</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Baseline Survey - Metrics & Report</label>
                                    <textarea class="form-control @error('baseline_survey') is-invalid @enderror" name="baseline_survey" rows="3"
                                        placeholder="Summary of baseline survey findings">{{ old('baseline_survey', $project->baseline_survey) }}</textarea>
                                    @error('baseline_survey')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Summary of initial survey or assessment findings</div>
                                </div>
                            </div>
                        </div>

                        <!-- Donut Chart Metrics -->
                        <div class="mb-3">
                            <label class="form-label">Donut Chart Metrics (Optional)</label>
                            <div id="donut_metrics_wrapper">
                                @php
                                    $donutMetrics = old('donut_metrics', $project->donut_metrics);
                                @endphp

                                @if ($donutMetrics && is_array($donutMetrics) && count($donutMetrics) > 0)
                                    @foreach ($donutMetrics as $index => $metric)
                                        <div class="row mb-2 metric-item">
                                            <div class="col-md-4">
                                                <input type="text" name="donut_metrics[{{ $index }}][label]"
                                                    class="form-control @error('donut_metrics.' . $index . '.label') is-invalid @enderror"
                                                    placeholder="Label (e.g., Youth Interested)"
                                                    value="{{ $metric['label'] ?? '' }}">
                                                @error('donut_metrics.' . $index . '.label')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-3">
                                                <input type="number" name="donut_metrics[{{ $index }}][value]"
                                                    class="form-control @error('donut_metrics.' . $index . '.value') is-invalid @enderror"
                                                    placeholder="Value % (e.g., 80)"
                                                    value="{{ $metric['value'] ?? '' }}" min="0" max="100"
                                                    step="1">
                                                @error('donut_metrics.' . $index . '.value')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" name="donut_metrics[{{ $index }}][notes]"
                                                    class="form-control" placeholder="Small Notes (optional)"
                                                    value="{{ $metric['notes'] ?? '' }}">
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button"
                                                    class="btn btn-outline-danger remove-metric">−</button>
                                            </div>
                                        </div>
                                    @endforeach
                                @elseif(old('donut_metrics') && is_array(old('donut_metrics')))
                                    @foreach (old('donut_metrics') as $index => $metric)
                                        <div class="row mb-2 metric-item">
                                            <div class="col-md-4">
                                                <input type="text" name="donut_metrics[{{ $index }}][label]"
                                                    class="form-control @error('donut_metrics.' . $index . '.label') is-invalid @enderror"
                                                    placeholder="Label (e.g., Youth Interested)"
                                                    value="{{ $metric['label'] ?? '' }}">
                                                @error('donut_metrics.' . $index . '.label')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-3">
                                                <input type="number" name="donut_metrics[{{ $index }}][value]"
                                                    class="form-control @error('donut_metrics.' . $index . '.value') is-invalid @enderror"
                                                    placeholder="Value % (e.g., 80)"
                                                    value="{{ $metric['value'] ?? '' }}" min="0" max="100"
                                                    step="1">
                                                @error('donut_metrics.' . $index . '.value')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" name="donut_metrics[{{ $index }}][notes]"
                                                    class="form-control" placeholder="Small Notes (optional)"
                                                    value="{{ $metric['notes'] ?? '' }}">
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button"
                                                    class="btn btn-outline-danger remove-metric">−</button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" class="btn btn-sm btn-primary mt-2" id="add_metric">Add
                                Metric</button>
                            <div class="form-text">Add metrics for donut chart visualization (e.g., Youth Interested: 80%)
                            </div>
                        </div>

                        <!-- New Target Beneficiaries Section -->
@if ($isUpcoming)
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="mb-3 text-primary"><i class="feather feather-users me-2"></i> Target
                                    Beneficiaries</h5>

                                @php
                                    // Variables are now defined globally at the top of tab-content
                                @endphp

                                {{-- GROUPS SECTION --}}
                                <div class="mb-4 border p-3 rounded bg-light">
                                    <h6 class="fw-bold mb-3 text-secondary">Target Groups</h6>
                                    <div class="table-responsive">
                                        <table class="table table-bordered bg-white" id="beneficiary_groups_table">
                                            <thead>
                                                <tr>
                                                    <th style="width: 40%">Group Category</th>
                                                    <th style="width: 20%">Target Numbers</th>
                                                    @if (!$isUpcoming)
                                                        <th style="width: 20%">Reached</th>
                                                        <th style="width: 20%">Current Date</th>
                                                    @endif
                                                    @if ($isUpcoming)
                                                        <th style="width: 5%"></th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody id="beneficiary_groups_body">
                                                @foreach ($groups as $ben)
                                                    <tr>
                                                        <td>
                                                            @if ($isUpcoming)
                                                                <select
                                                                    name="beneficiary_groups[{{ $loop->index }}][category]"
                                                                    class="form-select select2">
                                                                    <option value="">Select Group</option>
                                                                    @foreach ($groupOptions as $opt)
                                                                        <option value="{{ $opt }}"
                                                                            {{ $ben->category == $opt ? 'selected' : '' }}>
                                                                            {{ $opt }}</option>
                                                                    @endforeach
                                                                </select>
                                                            @else
                                                                {{ $ben->category }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($isUpcoming)
                                                                <input type="number"
                                                                    name="beneficiary_groups[{{ $loop->index }}][target]"
                                                                    class="form-control"
                                                                    value="{{ $ben->target_number }}">
                                                            @else
                                                                {{ $ben->target_number }}
                                                            @endif
                                                        </td>
                                                        @if (!$isUpcoming)
                                                            <td>
                                                                <input type="number"
                                                                    name="beneficiary_reached[{{ $ben->id }}]"
                                                                    class="form-control bg-light"
                                                                    value="{{ $ben->reached_number }}"
                                                                    placeholder="Enter reached">
                                                            </td>
                                                            <td>
                                                                <input type="date"
                                                                    name="beneficiary_date[{{ $ben->id }}]"
                                                                    class="form-control" value="{{ date('Y-m-d') }}">
                                                                <small class="text-muted d-block mt-1">Auto-updates
                                                                    history</small>
                                                            </td>
                                                        @endif
                                                        @if ($isUpcoming)
                                                            <td>
                                                                <button type="button"
                                                                    class="btn btn-sm btn-outline-danger remove-row"><i
                                                                        class="bi bi-trash"></i></button>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            @if ($isUpcoming)
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="3">
                                                            <button type="button" class="btn btn-sm btn-primary"
                                                                id="add_group_btn">
                                                                ➕ Add Group
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            @endif
                                        </table>
                                    </div>
                                </div>

                                {{-- INDIVIDUALS SECTION --}}
                                <div class="mb-4 border p-3 rounded bg-light">
                                    <h6 class="fw-bold mb-3 text-secondary">Target Individuals</h6>
                                    <div class="table-responsive">
                                        <table class="table table-bordered bg-white" id="beneficiary_individuals_table">
                                            <thead>
                                                <tr>
                                                    <th style="width: 40%">Individual Category</th>
                                                    <th style="width: 20%">Target Numbers</th>
                                                    @if (!$isUpcoming)
                                                        <th style="width: 20%">Reached</th>
                                                        <th style="width: 20%">Current Date</th>
                                                    @endif
                                                    @if ($isUpcoming)
                                                        <th style="width: 5%"></th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody id="beneficiary_individuals_body">
                                                @foreach ($individuals as $ben)
                                                    <tr>
                                                        <td>
                                                            @if ($isUpcoming)
                                                                <select
                                                                    name="beneficiary_individuals[{{ $loop->index }}][category]"
                                                                    class="form-select select2">
                                                                    <option value="">Select Individual</option>
                                                                    @foreach ($individualOptions as $opt)
                                                                        <option value="{{ $opt }}"
                                                                            {{ $ben->category == $opt ? 'selected' : '' }}>
                                                                            {{ $opt }}</option>
                                                                    @endforeach
                                                                </select>
                                                            @else
                                                                {{ $ben->category }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($isUpcoming)
                                                                <input type="number"
                                                                    name="beneficiary_individuals[{{ $loop->index }}][target]"
                                                                    class="form-control"
                                                                    value="{{ $ben->target_number }}">
                                                            @else
                                                                {{ $ben->target_number }}
                                                            @endif
                                                        </td>
                                                        @if (!$isUpcoming)
                                                            <td>
                                                                <input type="number"
                                                                    name="beneficiary_reached[{{ $ben->id }}]"
                                                                    class="form-control bg-light"
                                                                    value="{{ $ben->reached_number }}"
                                                                    placeholder="Enter reached">
                                                            </td>
                                                            <td>
                                                                <input type="date"
                                                                    name="beneficiary_date[{{ $ben->id }}]"
                                                                    class="form-control" value="{{ date('Y-m-d') }}">
                                                                <small class="text-muted d-block mt-1">Auto-updates
                                                                    history</small>
                                                            </td>
                                                        @endif
                                                        @if ($isUpcoming)
                                                            <td>
                                                                <button type="button"
                                                                    class="btn btn-sm btn-outline-danger remove-row"><i
                                                                        class="bi bi-trash"></i></button>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            @if ($isUpcoming)
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="3">
                                                            <button type="button" class="btn btn-sm btn-primary"
                                                                id="add_individual_btn">
                                                                ➕ Add Individual
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            @endif
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @else
                            <div class="alert alert-info border-info">
                                <i class="feather feather-info me-2"></i> Target Beneficiaries & Reached counts are available in the <strong>Ongoing Updates</strong> tab for tracking.
                            </div>
                        @endif

                        <!-- Strategic Objectives -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Strategic Objectives <span
                                            class="text-danger">*</span></label>
                                    <div id="objectives_wrapper">
                                        @php
                                            $objectives = old('objectives', $project->objectives);
                                        @endphp

                                        @if ($objectives && is_array($objectives) && count($objectives) > 0)
                                            @foreach ($objectives as $index => $objective)
                                                <div class="input-group mb-2">
                                                    <input type="text" name="objectives[]"
                                                        class="form-control @error('objectives.' . $index) is-invalid @enderror"
                                                        placeholder="Enter strategic objective"
                                                        value="{{ $objective }}">
                                                    @error('objectives.' . $index)
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    <button type="button"
                                                        class="btn btn-outline-danger remove-objective">−</button>
                                                </div>
                                            @endforeach
                                        @elseif(old('objectives') && is_array(old('objectives')))
                                            @foreach (old('objectives') as $index => $objective)
                                                <div class="input-group mb-2">
                                                    <input type="text" name="objectives[]"
                                                        class="form-control @error('objectives.' . $index) is-invalid @enderror"
                                                        placeholder="Enter strategic objective"
                                                        value="{{ $objective }}">
                                                    @error('objectives.' . $index)
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    <button type="button"
                                                        class="btn btn-outline-danger remove-objective">−</button>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <button type="button" class="btn btn-sm btn-primary mt-2" id="add_objective">Add
                                        Objective</button>
                                    <div class="form-text">Add high-level objectives for this project</div>
                                </div>
                            </div>
                        </div>

                        <!-- Expected Outcomes / Impact -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Expected Outcomes / Impact</label>
                                    <textarea class="form-control @error('expected_outcomes') is-invalid @enderror" name="expected_outcomes"
                                        rows="4" placeholder="Transformation expected after implementation">{{ old('expected_outcomes', $project->expected_outcomes) }}</textarea>
                                    @error('expected_outcomes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Describe the expected transformation and impact</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Expected Impact Image (Optional)</label>
                                    <input type="file"
                                        class="form-control @error('impact_image') is-invalid @enderror"
                                        name="impact_image" accept="image/*">
                                    @error('impact_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <!-- Existing Impact Image -->
                                    @if ($project->impact_image)
                                        <div class="mt-2">
                                            <label class="form-label small">Existing Impact Image:</label>
                                            <div class="position-relative d-inline-block">
                                                <img src="{{ asset($project->impact_image) }}" alt="Impact"
                                                    class="img-thumbnail"
                                                    style="width: 100px; height: 100px; object-fit: cover;">
                                                <button type="button"
                                                    class="btn btn-sm btn-danger position-absolute top-0 end-0 p-0"
                                                    style="width: 20px; height: 20px; font-size: 10px;"
                                                    onclick="removeImage('impact', '{{ $project->impact_image }}')">×</button>
                                            </div>
                                            <input type="hidden" name="existing_impact_image"
                                                value="{{ $project->impact_image }}">
                                        </div>
                                    @endif
                                    <div class="form-text">AI generated image showing expected outcomes - Max 5MB</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Scalability Notes (Optional)</label>
                                    <textarea class="form-control @error('scalability_notes') is-invalid @enderror" name="scalability_notes"
                                        rows="2" placeholder="Notes on repeatability in other regions">{{ old('scalability_notes', $project->scalability_notes) }}</textarea>
                                    @error('scalability_notes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Notes on potential for replication in other regions</div>
                                </div>
                            </div>
                        </div>

                        <!-- Alignment Categories -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Alignment Categories</label>
                                    <select name="alignment_categories[]"
                                        class="form-select select2-multiple @error('alignment_categories') is-invalid @enderror"
                                        multiple>
                                        <option value="sdg"
                                            {{ in_array('sdg', old('alignment_categories', $project->alignment_categories ?? [])) ? 'selected' : 'selected' }}>
                                            SDG Goals</option>
                                        <option value="nep2020"
                                            {{ in_array('nep2020', old('alignment_categories', $project->alignment_categories ?? [])) ? 'selected' : '' }}>
                                            NEP 2020</option>
                                        <option value="skill_india"
                                            {{ in_array('skill_india', old('alignment_categories', $project->alignment_categories ?? [])) ? 'selected' : '' }}>
                                            Skill India</option>
                                        <option value="nsqf"
                                            {{ in_array('nsqf', old('alignment_categories', $project->alignment_categories ?? [])) ? 'selected' : '' }}>
                                            NSQF</option>
                                        <option value="govt_schemes"
                                            {{ in_array('govt_schemes', old('alignment_categories', $project->alignment_categories ?? [])) ? 'selected' : '' }}>
                                            Govt Schemes</option>
                                        <option value="csr_schedule_vii"
                                            {{ in_array('csr_schedule_vii', old('alignment_categories', $project->alignment_categories ?? [])) ? 'selected' : '' }}>
                                            CSR Schedule VII</option>
                                    </select>
                                    @error('alignment_categories')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Select applicable categories (hold Ctrl/Cmd to select multiple)
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SDG Goals (conditional) -->
                        <div id="sdg_section"
                            style="display: {{ in_array('sdg', old('alignment_categories', $project->alignment_categories ?? [])) ? 'block' : 'none' }};">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Sustainable Development Goals (SDGs)</label>
                                        <div class="form-text mb-3">Select multiple SDGs that align with this project.
                                            Click to
                                            select/unselect.</div>

                                        <!-- Hidden input to store selected SDG IDs -->
                                        <input type="hidden" name="sdg_goals" id="sdg_goals_input"
                                            value="{{ is_array(old('sdg_goals', $project->sdg_goals)) ? implode(',', old('sdg_goals', $project->sdg_goals)) : '' }}">

                                        <!-- SDG Grid Container -->
                                        <div id="sdg_grid"
                                            class="row row-cols-2 row-cols-md-3 row-cols-lg-5 row-cols-xl-6 g-3">
                                            @php
                                                $sdgs = App\Helpers\SDGHelper::getAllSDGs();
                                                $selectedSDGs = is_array(old('sdg_goals', $project->sdg_goals))
                                                    ? old('sdg_goals', $project->sdg_goals)
                                                    : [];
                                            @endphp

                                            @foreach ($sdgs as $sdg)
                                                @php
                                                    $isSelected = in_array($sdg['id'], $selectedSDGs);
                                                    $fallbackImage = "https://ui-avatars.com/api/?name=SDG+{$sdg['id']}&background={$sdg['color']}&color=fff&size=100&bold=true";
                                                @endphp
                                                <div class="col">
                                                    <div class="sdg-card card h-100 border rounded-3 p-2 position-relative
                                       {{ $isSelected ? 'border-primary border-2 selected' : 'border-light' }}"
                                                        data-sdg-id="{{ $sdg['id'] }}"
                                                        data-sdg-name="{{ $sdg['name'] }}"
                                                        data-sdg-description="{{ $sdg['description'] }}"
                                                        data-sdg-color="{{ $sdg['color'] }}"
                                                        style="cursor: pointer; transition: all 0.2s ease; min-height: 160px;">

                                                        <!-- Selected Checkmark -->
                                                        <div class="selected-check position-absolute top-0 end-0 m-2"
                                                            style="display: {{ $isSelected ? 'block' : 'none' }};">
                                                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                                                style="width: 24px; height: 24px;">
                                                                <i class="feather feather-check"
                                                                    style="font-size: 12px;"></i>
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="card-body p-2 text-center d-flex flex-column justify-content-between">
                                                            <!-- SDG Icon with Multiple Fallback Sources -->
                                                            <div class="sdg-icon mb-2">
                                                                <div class="position-relative"
                                                                    style="width: 80px; height: 80px; margin: 0 auto;">
                                                                    <!-- Primary Image -->
                                                                    <img src="{{ $sdg['image_url'] }}"
                                                                        alt="SDG {{ $sdg['id'] }}: {{ $sdg['name'] }}"
                                                                        class="sdg-img img-fluid rounded-circle"
                                                                        style="width: 100%; height: 100%; object-fit: cover;"
                                                                        loading="lazy" onerror="handleImageError(this)">

                                                                    <!-- SDG Number Badge -->
                                                                    <div class="position-absolute bottom-0 end-0">
                                                                        <span class="badge bg-dark"
                                                                            style="font-size: 0.7rem; padding: 2px 6px;">
                                                                            {{ $sdg['id'] }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- SDG Name -->
                                                            <div class="sdg-name mt-auto">
                                                                <small class="card-title fw-semibold d-block"
                                                                    style="font-size: 0.75rem; line-height: 1.2;">
                                                                    {{ $sdg['name'] }}
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <!-- Error Display -->
                                        @error('sdg_goals')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror

                                        <!-- Selected SDGs Summary -->
                                        <div class="mt-4" id="selected_sdg_summary"
                                            style="display: {{ !empty($selectedSDGs) ? 'block' : 'none' }};">
                                            <div class="card border-primary">
                                                <div
                                                    class="card-header bg-primary bg-opacity-10 border-primary d-flex justify-content-between align-items-center py-2">
                                                    <h6 class="mb-0 text-primary">
                                                        <i class="feather feather-check-circle me-2"></i>
                                                        <strong>Selected SDGs ({{ count($selectedSDGs) }})</strong>
                                                    </h6>
                                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                                        id="clear_all_sdgs">
                                                        <i class="feather feather-x me-1"></i> Clear All
                                                    </button>
                                                </div>
                                                <div class="card-body p-3">
                                                    <div id="selected_sdg_chips" class="d-flex flex-wrap gap-3">
                                                        @if (!empty($selectedSDGs))
                                                            @foreach ($selectedSDGs as $sdgId)
                                                                @php
                                                                    $sdg = App\Helpers\SDGHelper::getSDGById($sdgId);
                                                                    $color = $sdg['color'] ?? '4C9F38';
                                                                    $fallback = "https://ui-avatars.com/api/?name=SDG+{$sdgId}&background={$color}&color=fff&size=60&bold=true";
                                                                @endphp
                                                                @if ($sdg)
                                                                    <div class="sdg-chip position-relative">
                                                                        <div class="card border shadow-sm"
                                                                            style="width: 100px;">
                                                                            <div class="card-body p-2 text-center">
                                                                                <img src="{{ $sdg['image_url'] }}"
                                                                                    alt="SDG {{ $sdgId }}"
                                                                                    class="img-fluid rounded-circle mb-2"
                                                                                    style="width: 60px; height: 60px; object-fit: cover;"
                                                                                    onerror="this.src='{{ $fallback }}'">
                                                                                <small class="d-block fw-semibold"
                                                                                    style="font-size: 0.65rem;">
                                                                                    SDG {{ $sdgId }}
                                                                                </small>
                                                                                <small class="d-block text-muted"
                                                                                    style="font-size: 0.6rem;">
                                                                                    {{ Str::limit($sdg['name'], 10) }}
                                                                                </small>
                                                                                <button type="button"
                                                                                    class="btn-close btn-close-sm position-absolute top-0 end-0 m-1"
                                                                                    data-sdg-id="{{ $sdgId }}"
                                                                                    aria-label="Remove SDG {{ $sdgId }}"></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- SDG Preview Modal -->
                                        <div class="modal fade" id="sdgPreviewModal" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="previewModalTitle"></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <div id="previewModalImage" class="mb-3"
                                                            style="width: 120px; height: 120px; margin: 0 auto;"></div>
                                                        <p id="previewModalDescription" class="text-muted"></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary"
                                                            id="toggleSelectBtn">Select</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-text mt-2">
                                            <i class="feather feather-info text-info me-1"></i>
                                            Click on SDG icons to select/unselect. Click and hold for details.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End SDG Section -->

                        @php
                            // Normalize alignment_categories
                            $alignmentCategories = old('alignment_categories', $project->alignment_categories ?? []);
                            $alignmentCategories = is_array($alignmentCategories)
                                ? $alignmentCategories
                                : (array) json_decode($alignmentCategories ?: '[]', true);

                            // Normalize govt_schemes
                            $govtSchemes = old('govt_schemes', $project->govt_schemes ?? []);
                            $govtSchemes = is_array($govtSchemes)
                                ? $govtSchemes
                                : (array) json_decode($govtSchemes ?: '[]', true);
                        @endphp


                        <!-- Govt Schemes (conditional) -->
                        <div id="govt_schemes_section"
                            style="display: {{ in_array('govt_schemes', $alignmentCategories ?? []) ? 'block' : 'none' }};">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Government Schemes / Policies</label>

                                        <select name="govt_schemes[]"
                                            class="form-select select2-multiple @error('govt_schemes') is-invalid @enderror"
                                            multiple>

                                            @foreach ($schemes as $scheme)
                                                <option value="{{ $scheme->slug }}" @selected(in_array($scheme->slug, $govtSchemes ?? []))>
                                                    {{ $scheme->title }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('govt_schemes')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                        <div class="form-text">
                                            Select government schemes aligned with this project
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Alignment Notes (Optional)</label>
                                    <textarea class="form-control @error('alignment_notes') is-invalid @enderror" name="alignment_notes" rows="2"
                                        placeholder="Short summary of alignment (e.g., Aligned with NEP 2020 vocational exposure for Class 6-12)">{{ old('alignment_notes', $project->alignment_notes) }}</textarea>
                                    @error('alignment_notes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Additional notes about alignment with selected categories</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Sustainability Plan <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control @error('sustainability_plan') is-invalid @enderror" name="sustainability_plan"
                                        rows="3" placeholder="Ownership after project completion">{{ old('sustainability_plan', $project->sustainability_plan) }}</textarea>
                                    @error('sustainability_plan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Describe how the project will be sustained after completion
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- End Strategic Tab -->

                <!-- Tab 4: Ongoing Updates (Conditional) -->
                <div class="tab-pane" id="ongoing_tab" role="tabpanel">
                    <div class="border p-4 rounded-3 bg-white mb-4">
                        <div class="alert alert-info mb-3">
                            <i class="feather feather-info me-2"></i> This section is only relevant for Ongoing or
                            Completed
                            projects.
                        </div>

                        <!-- Execution Dashboard Guide -->
                        <div class="alert alert-light border-primary border-start border-4 mb-4 shadow-sm">
                            <h6 class="text-primary fw-bold mb-3"><i class="feather feather-activity me-2"></i>Live
                                Monitoring Dashboard Input Guide</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="p-3 bg-white rounded border h-100">
                                        <strong class="text-dark d-block mb-2">1. Execution Health</strong>
                                        <p class="small text-muted mb-2">Determines the "health" gauge on the dashboard.
                                        </p>
                                        <ul class="small text-muted mb-0 list-unstyled">
                                            <li><strong>Source:</strong> <code>Completion Readiness (%)</code> field below.
                                            </li>
                                            <li><strong>Frontend Label:</strong> "Execution Health"</li>
                                            <li class="mt-2 text-dark bg-light p-2 rounded">
                                                <strong>Example:</strong><br>
                                                Input: <code>100</code> &rarr; Frontend: <strong>100.00 (Good)</strong><br>
                                                <em>"Composite score based on milestones"</em>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 bg-white rounded border h-100">
                                        <strong class="text-dark d-block mb-2">2. Project Risk Assessment</strong>
                                        <p class="small text-muted mb-2">Calculates the overall risk level based on "Risks"
                                            below.</p>
                                        <ul class="small text-muted mb-0 list-unstyled">
                                            <li><strong>Source:</strong> Weighted sum of Risks & Impacts.</li>
                                            <li><strong>Formula:</strong> High(3) + Medium(2) + Low(1)</li>
                                            <li class="mt-2 text-dark bg-light p-2 rounded">
                                                <strong>Example:</strong><br>
                                                1x High, 1x Med, 1x Low &rarr; Score: <strong>6 (Medium Risk)</strong><br>
                                                <em>"Risk level monitoring"</em>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 bg-white rounded border h-100">
                                        <strong class="text-dark d-block mb-2">3. Project Progress</strong>
                                        <ul class="small text-muted mb-0 list-unstyled">
                                            <li><strong>Source:</strong> <code>Project Progress</code> (Basic Details Tab).
                                            </li>
                                            <li class="mt-1"><strong>Example:</strong> 89% &rarr; "89.00% Overall
                                                completion"</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 bg-white rounded border h-100">
                                        <strong class="text-dark d-block mb-2">4. Beneficiaries Reached</strong>
                                        <ul class="small text-muted mb-0 list-unstyled">
                                            <li><strong>Source:</strong> <code>Actual Beneficiary Count</code> field below.
                                            </li>
                                            <li class="mt-1"><strong>Example:</strong> 111 &rarr; "111 - Total
                                                individuals reached"</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        <fieldset id="ongoing_beneficiaries_fieldset" {{ $isUpcoming ? 'disabled' : '' }}>
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="mb-3 text-primary"><i class="feather feather-users me-2"></i> Target
                                    Beneficiaries</h5>

                                @php
                                    // Variables are now defined globally at the top of tab-content
                                @endphp

                                {{-- GROUPS SECTION --}}
                                <div class="mb-4 border p-3 rounded bg-light">
                                    <h6 class="fw-bold mb-3 text-secondary">Target Groups</h6>
                                    <div class="table-responsive">
                                        <table class="table table-bordered bg-white" id="ongoing_beneficiary_groups_table">
                                            <thead>
                                                <tr>
                                                    <th style="width: 40%">Group Category</th>
                                                    <th style="width: 20%">Target Numbers</th>
                                                    <th style="width: 20%">Reached</th>
                                                    <th style="width: 20%">Current Date</th>
                                                    {{-- Always show action column --}}
                                                    <th style="width: 5%"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="ongoing_beneficiary_groups_body">
                                                @foreach ($groups as $ben)
                                                    <tr>
                                                        <td>
                                                            <select
                                                                name="beneficiary_groups[{{ $loop->index }}][category]"
                                                                class="form-select select2">
                                                                <option value="">Select Group</option>
                                                                @foreach ($groupOptions as $opt)
                                                                    <option value="{{ $opt }}"
                                                                        {{ $ben->category == $opt ? 'selected' : '' }}>
                                                                        {{ $opt }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="number"
                                                                name="beneficiary_groups[{{ $loop->index }}][target]"
                                                                class="form-control"
                                                                value="{{ $ben->target_number }}">
                                                        </td>
                                                        <td>
                                                            <input type="number"
                                                                name="beneficiary_reached[{{ $ben->id }}]"
                                                                class="form-control bg-light"
                                                                value="{{ $ben->reached_number }}"
                                                                placeholder="Enter reached">
                                                        </td>
                                                        <td>
                                                            <input type="date"
                                                                name="beneficiary_date[{{ $ben->id }}]"
                                                                class="form-control" value="{{ date('Y-m-d') }}">
                                                            <small class="text-muted d-block mt-1">Auto-updates
                                                                history</small>
                                                        </td>
                                                        <td>
                                                            <button type="button"
                                                                class="btn btn-sm btn-outline-danger remove-row"><i
                                                                    class="bi bi-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="5">
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            id="add_ongoing_group_btn">
                                                            ➕ Add Group
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                                {{-- INDIVIDUALS SECTION --}}
                                <div class="mb-4 border p-3 rounded bg-light">
                                    <h6 class="fw-bold mb-3 text-secondary">Target Individuals</h6>
                                    <div class="table-responsive">
                                        <table class="table table-bordered bg-white" id="ongoing_beneficiary_individuals_table">
                                            <thead>
                                                <tr>
                                                    <th style="width: 40%">Individual Category</th>
                                                    <th style="width: 20%">Target Numbers</th>
                                                    <th style="width: 20%">Reached</th>
                                                    <th style="width: 20%">Current Date</th>
                                                    <th style="width: 5%"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="ongoing_beneficiary_individuals_body">
                                                @foreach ($individuals as $ben)
                                                    <tr>
                                                        <td>
                                                            <select
                                                                name="beneficiary_individuals[{{ $loop->index }}][category]"
                                                                class="form-select select2">
                                                                <option value="">Select Individual</option>
                                                                @foreach ($individualOptions as $opt)
                                                                    <option value="{{ $opt }}"
                                                                        {{ $ben->category == $opt ? 'selected' : '' }}>
                                                                        {{ $opt }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="number"
                                                                name="beneficiary_individuals[{{ $loop->index }}][target]"
                                                                class="form-control"
                                                                value="{{ $ben->target_number }}">
                                                        </td>
                                                        <td>
                                                            <input type="number"
                                                                name="beneficiary_reached[{{ $ben->id }}]"
                                                                class="form-control bg-light"
                                                                value="{{ $ben->reached_number }}"
                                                                placeholder="Enter reached">
                                                        </td>
                                                        <td>
                                                            <input type="date"
                                                                name="beneficiary_date[{{ $ben->id }}]"
                                                                class="form-control" value="{{ date('Y-m-d') }}">
                                                            <small class="text-muted d-block mt-1">Auto-updates
                                                                history</small>
                                                        </td>
                                                        <td>
                                                            <button type="button"
                                                                class="btn btn-sm btn-outline-danger remove-row"><i
                                                                    class="bi bi-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="5">
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            id="add_ongoing_individual_btn">
                                                            ➕ Add Individual
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                        </fieldset>
                        <div class="mb-4"></div>

                        <h5 class="mb-4 text-primary"><i class="feather feather-clock me-2"></i> Ongoing Project Updates &
                        Progress Tracking</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Last Update Summary <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('last_update_summary') is-invalid @enderror" name="last_update_summary"
                                    rows="3" placeholder="Summary of latest progress">{{ old('last_update_summary', $project->last_update_summary) }}</textarea>
                                @error('last_update_summary')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Brief summary of the latest progress</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6" id="actual_end_date_wrapper"
                            style="{{ $project->stage == 'completed' ? '' : 'display:none;' }}">
                            <div class="mb-3">
                                <label class="form-label">Actual End Date <span class="text-danger">*</span></label>
                                <input type="date"
                                    class="form-control @error('actual_end_date') is-invalid @enderror"
                                    name="actual_end_date"
                                    value="{{ old('actual_end_date', $project->actual_end_date ? $project->actual_end_date->format('Y-m-d') : '') }}">
                                @error('actual_end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Actual project completion date</div>
                            </div>
                        </div>
                        <div class="col-md-6" id="actual_beneficiary_count_wrapper" style="{{ $project->stage == 'completed' ? '' : 'display:none;' }}">
                            <div class="mb-3">
                                <label class="form-label">Actual Beneficiary Count <span
                                        class="text-danger">*</span></label>
                                <input type="number"
                                    class="form-control @error('actual_beneficiary_count') is-invalid @enderror"
                                    name="actual_beneficiary_count" min="0"
                                    value="{{ old('actual_beneficiary_count', $project->actual_beneficiary_count) }}">
                                @error('actual_beneficiary_count')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Actual number of beneficiaries reached</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Challenges Identified</label>
                                <textarea class="form-control @error('challenges_identified') is-invalid @enderror" name="challenges_identified"
                                    rows="2" placeholder="Any challenges faced during implementation">{{ old('challenges_identified', $project->challenges_identified) }}</textarea>
                                @error('challenges_identified')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Challenges faced during implementation</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Compliance Requirement Status</label>
                                <textarea class="form-control @error('compliance_requirement_status') is-invalid @enderror"
                                    name="compliance_requirement_status" rows="2" placeholder="Status of compliance requirements">{{ old('compliance_requirement_status', $project->compliance_requirement_status) }}</textarea>
                                @error('compliance_requirement_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Status of compliance requirements</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Solutions & Actions Taken</label>
                                <textarea class="form-control @error('solutions_actions_taken') is-invalid @enderror"
                                    name="solutions_actions_taken" rows="2" placeholder="Solutions implemented for challenges">{{ old('solutions_actions_taken', $project->solutions_actions_taken) }}</textarea>
                                @error('solutions_actions_taken')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Solutions implemented for challenges</div>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="completed_fields_wrapper"
                        style="{{ $project->stage == 'completed' ? '' : 'display:none;' }}">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Completion Readiness (%)</label>
                                <div class="input-group">
                                    <input type="number"
                                        class="form-control @error('completion_readiness') is-invalid @enderror"
                                        name="completion_readiness" min="0" max="100"
                                        value="{{ old('completion_readiness', $project->completion_readiness) }}">
                                    <span class="input-group-text">%</span>
                                </div>
                                @error('completion_readiness')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Readiness for project completion (0-100%)</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Handover & Sustainability Note <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control @error('handover_sustainability_note') is-invalid @enderror"
                                    name="handover_sustainability_note" rows="2" placeholder="Handover details and sustainability plan">{{ old('handover_sustainability_note', $project->handover_sustainability_note) }}</textarea>
                                @error('handover_sustainability_note')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Details about handover and sustainability</div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            <!-- End Ongoing Tab -->

            <!-- Tab 5: CSR & Stakeholders -->
            <div class="tab-pane" id="csr_tab" role="tabpanel">
                <div class="border p-4 rounded-3 bg-white mb-4">
                    <h5 class="mb-4 text-primary"><i class="feather feather-users me-2"></i> CSR & Stakeholders
                        Engagement</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">CSR Invitation <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('csr_invitation') is-invalid @enderror" name="csr_invitation" rows="4"
                                    placeholder="e.g., We seek funding from CSR...">{{ old('csr_invitation', $project->csr_invitation) }}</textarea>
                                @error('csr_invitation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Message inviting CSR partners to support this project</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">CTA Button Text</label>
                                <input type="text"
                                    class="form-control @error('cta_button_text') is-invalid @enderror"
                                    name="cta_button_text"
                                    value="{{ old('cta_button_text', $project->cta_button_text ?: 'Register Your Interest') }}"
                                    placeholder="Text for CTA button">
                                @error('cta_button_text')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Text for the call-to-action button</div>
                            </div>
                        </div>
                    </div>

                    <!-- Stakeholders -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Stakeholders (Optional)</label>
                                <div id="stakeholders_wrapper">
                                    @php
                                        $stakeholders = old('stakeholders', $project->stakeholders);
                                    @endphp

                                    @if ($stakeholders && is_array($stakeholders) && count($stakeholders) > 0)
                                        @foreach ($stakeholders as $index => $stakeholder)
                                            <div class="row mb-2 stakeholder-item">
                                                <div class="col-md-5">
                                                    <input type="text"
                                                        name="stakeholders[{{ $index }}][name]"
                                                        class="form-control @error('stakeholders.' . $index . '.name') is-invalid @enderror"
                                                        placeholder="Stakeholder Name"
                                                        value="{{ $stakeholder['name'] ?? '' }}">
                                                    @error('stakeholders.' . $index . '.name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text"
                                                        name="stakeholders[{{ $index }}][role]"
                                                        class="form-control" placeholder="Role/Contribution"
                                                        value="{{ $stakeholder['role'] ?? '' }}">
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button"
                                                        class="btn btn-outline-danger remove-stakeholder">−</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @elseif(old('stakeholders') && is_array(old('stakeholders')))
                                        @foreach (old('stakeholders') as $index => $stakeholder)
                                            <div class="row mb-2 stakeholder-item">
                                                <div class="col-md-5">
                                                    <input type="text"
                                                        name="stakeholders[{{ $index }}][name]"
                                                        class="form-control @error('stakeholders.' . $index . '.name') is-invalid @enderror"
                                                        placeholder="Stakeholder Name"
                                                        value="{{ $stakeholder['name'] ?? '' }}">
                                                    @error('stakeholders.' . $index . '.name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text"
                                                        name="stakeholders[{{ $index }}][role]"
                                                        class="form-control" placeholder="Role/Contribution"
                                                        value="{{ $stakeholder['role'] ?? '' }}">
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button"
                                                        class="btn btn-outline-danger remove-stakeholder">−</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <button type="button" class="btn btn-sm btn-primary mt-2" id="add_stakeholder">Add
                                    Stakeholder</button>
                                <div class="form-text">Add key stakeholders involved in the project</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End CSR Tab -->

            <!-- Tab 6: Resources & Risks -->
            <div class="tab-pane" id="resources_tab" role="tabpanel">
                <div class="border p-4 rounded-3 bg-white mb-4">
                    <h5 class="mb-4 text-primary"><i class="feather feather-shield me-2"></i> Resource & Operation
                        Compliance Risks</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Resources Needed (Optional)</label>
                                <textarea class="form-control @error('resources_needed') is-invalid @enderror" name="resources_needed"
                                    rows="3" placeholder="What resources are required (people / equipment / infra)">{{ old('resources_needed', $project->resources_needed) }}</textarea>
                                @error('resources_needed')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">List of required resources (people, equipment, infrastructure)
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Compliance Requirements (Optional)</label>
                                <textarea class="form-control @error('compliance_requirements') is-invalid @enderror"
                                    name="compliance_requirements" rows="3"
                                    placeholder="CSR Schedule VII / Govt Approval / NEP / NSQF / SHG / Bank process">{{ old('compliance_requirements', $project->compliance_requirements) }}</textarea>
                                @error('compliance_requirements')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Compliance requirements for this project</div>
                            </div>
                        </div>
                    </div>

                    <!-- Operational Risks -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Operational Risks & Ownership (Optional)</label>
                                <div id="risks_wrapper">
                                    @php
                                        $risks = old('risks', $project->risks);
                                    @endphp

                                    @if ($risks && is_array($risks) && count($risks) > 0)
                                        @foreach ($risks as $index => $risk)
                                            <div class="border p-3 mb-3 risk-item">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="mb-3">
                                                            <label class="form-label">Risk</label>
                                                            <input type="text"
                                                                name="risks[{{ $index }}][risk]"
                                                                class="form-control @error('risks.' . $index . '.risk') is-invalid @enderror"
                                                                placeholder="e.g., Funding delay"
                                                                value="{{ $risk['risk'] ?? '' }}">
                                                            @error('risks.' . $index . '.risk')
                                                                <div class="invalid-feedback">{{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <label class="form-label">Impact</label>
                                                            <select name="risks[{{ $index }}][impact]"
                                                                class="form-select select2">
                                                                <option value="low"
                                                                    {{ ($risk['impact'] ?? '') == 'low' ? 'selected' : '' }}>
                                                                    Low</option>
                                                                <option value="medium"
                                                                    {{ ($risk['impact'] ?? '') == 'medium' ? 'selected' : '' }}>
                                                                    Medium</option>
                                                                <option value="high"
                                                                    {{ ($risk['impact'] ?? '') == 'high' ? 'selected' : '' }}>
                                                                    High</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-3">
                                                            <label class="form-label">Mitigation</label>
                                                            <input type="text"
                                                                name="risks[{{ $index }}][mitigation]"
                                                                class="form-control @error('risks.' . $index . '.mitigation') is-invalid @enderror"
                                                                placeholder="e.g., Alternate CSR partner"
                                                                value="{{ $risk['mitigation'] ?? '' }}">
                                                            @error('risks.' . $index . '.mitigation')
                                                                <div class="invalid-feedback">{{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-3">
                                                            <label class="form-label">Responsible Person</label>
                                                            <input type="text"
                                                                name="risks[{{ $index }}][responsible]"
                                                                class="form-control @error('risks.' . $index . '.responsible') is-invalid @enderror"
                                                                placeholder="e.g., Project Manager"
                                                                value="{{ $risk['responsible'] ?? '' }}">
                                                            @error('risks.' . $index . '.responsible')
                                                                <div class="invalid-feedback">{{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <button type="button"
                                                            class="btn btn-outline-danger remove-risk">−</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @elseif(old('risks') && is_array(old('risks')))
                                        @foreach (old('risks') as $index => $risk)
                                            <div class="border p-3 mb-3 risk-item">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="mb-3">
                                                            <label class="form-label">Risk</label>
                                                            <input type="text"
                                                                name="risks[{{ $index }}][risk]"
                                                                class="form-control @error('risks.' . $index . '.risk') is-invalid @enderror"
                                                                placeholder="e.g., Funding delay"
                                                                value="{{ $risk['risk'] ?? '' }}">
                                                            @error('risks.' . $index . '.risk')
                                                                <div class="invalid-feedback">{{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <label class="form-label">Impact</label>
                                                            <select name="risks[{{ $index }}][impact]"
                                                                class="form-select select2">
                                                                <option value="low"
                                                                    {{ ($risk['impact'] ?? '') == 'low' ? 'selected' : '' }}>
                                                                    Low</option>
                                                                <option value="medium"
                                                                    {{ ($risk['impact'] ?? '') == 'medium' ? 'selected' : '' }}>
                                                                    Medium</option>
                                                                <option value="high"
                                                                    {{ ($risk['impact'] ?? '') == 'high' ? 'selected' : '' }}>
                                                                    High</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-3">
                                                            <label class="form-label">Mitigation</label>
                                                            <input type="text"
                                                                name="risks[{{ $index }}][mitigation]"
                                                                class="form-control @error('risks.' . $index . '.mitigation') is-invalid @enderror"
                                                                placeholder="e.g., Alternate CSR partner"
                                                                value="{{ $risk['mitigation'] ?? '' }}">
                                                            @error('risks.' . $index . '.mitigation')
                                                                <div class="invalid-feedback">{{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-3">
                                                            <label class="form-label">Responsible Person</label>
                                                            <input type="text"
                                                                name="risks[{{ $index }}][responsible]"
                                                                class="form-control @error('risks.' . $index . '.responsible') is-invalid @enderror"
                                                                placeholder="e.g., Project Manager"
                                                                value="{{ $risk['responsible'] ?? '' }}">
                                                            @error('risks.' . $index . '.responsible')
                                                                <div class="invalid-feedback">{{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <button type="button"
                                                            class="btn btn-outline-danger remove-risk">−</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <button type="button" class="btn btn-sm btn-primary mt-2" id="add_risk">Add
                                    Risk</button>
                                <div class="form-text">Add operational risks with mitigation strategies and
                                    responsible
                                    persons</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- End Resources Tab -->

            <!-- Tab 7: Media -->
            <div class="tab-pane" id="media_tab" role="tabpanel">
                <div class="border p-4 rounded-3 bg-white mb-4">
                    <h5 class="mb-4 text-primary"><i class="feather feather-file-text me-2"></i> Media and Documents
                    </h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Gallery Images</label>
                                <input type="file"
                                    class="form-control @error('gallery_images') is-invalid @enderror"
                                    name="gallery_images[]" accept="image/*" multiple>
                                @error('gallery_images')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @error('gallery_images.*')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <!-- Gallery Images -->
                                {{-- @dd($project->gallery_images) --}}
                                @if (!empty($project->gallery_images))
                                    <div class="mt-2">
                                        <label class="form-label small">Existing Gallery Images:</label>

                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach ($project->gallery_images as $galleryImage)
                                                <div class="position-relative" style="width: 80px;">
                                                    <img src="{{ asset($galleryImage) }}" class="img-thumbnail"
                                                        style="width: 80px; height: 60px; object-fit: cover;">

                                                    <button type="button"
                                                        class="btn btn-sm btn-danger position-absolute top-0 end-0 p-0"
                                                        style="width: 20px; height: 20px; font-size: 10px;"
                                                        onclick="removeImage('gallery', '{{ $galleryImage }}')">
                                                        ×
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>

                                        <input type="hidden" name="existing_gallery"
                                            value="{{ json_encode($project->gallery_images) }}">
                                    </div>
                                @else
                                    <div class="text-muted small">No gallery images uploaded yet</div>
                                @endif

                                <div class="form-text">Upload real photos of project implementation - Max 5 images,
                                    5MB
                                    each</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Comparison Photos (Optional)</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">Before Photo (Real)</label>
                                        <input type="file"
                                            class="form-control @error('before_photo') is-invalid @enderror"
                                            name="before_photo" accept="image/*">
                                        @error('before_photo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                        <!-- Existing Before Photo -->
                                        @if ($project->before_photo)
                                            <div class="mt-2">
                                                <label class="form-label small">Existing Before Photo:</label>
                                                <div class="position-relative d-inline-block">
                                                    <img src="{{ asset($project->before_photo) }}" alt="Before"
                                                        class="img-thumbnail"
                                                        style="width: 100px; height: 100px; object-fit: cover;">
                                                    <button type="button"
                                                        class="btn btn-sm btn-danger position-absolute top-0 end-0 p-0"
                                                        style="width: 20px; height: 20px; font-size: 10px;"
                                                        onclick="removeImage('before', '{{ $project->before_photo }}')">×</button>
                                                </div>
                                                <input type="hidden" name="existing_before_photo"
                                                    value="{{ $project->before_photo }}">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Expected Photo (AI)</label>
                                        <input type="file"
                                            class="form-control @error('expected_photo') is-invalid @enderror"
                                            name="expected_photo" accept="image/*">
                                        @error('expected_photo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                        <!-- Existing Expected Photo -->
                                        @if ($project->expected_photo)
                                            <div class="mt-2">
                                                <label class="form-label small">Existing Expected Photo:</label>
                                                <div class="position-relative d-inline-block">
                                                    <img src="{{ asset($project->expected_photo) }}" alt="Expected"
                                                        class="img-thumbnail"
                                                        style="width: 100px; height: 100px; object-fit: cover;">
                                                    <button type="button"
                                                        class="btn btn-sm btn-danger position-absolute top-0 end-0 p-0"
                                                        style="width: 20px; height: 20px; font-size: 10px;"
                                                        onclick="removeImage('expected', '{{ $project->expected_photo }}')">×</button>
                                                </div>
                                                <input type="hidden" name="existing_expected_photo"
                                                    value="{{ $project->expected_photo }}">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-text">Upload before photo (real) and expected outcome photo (AI
                                    generated)</div>
                            </div>
                        </div>
                    </div>

                    <!-- Supporting Documents -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Supporting Documents (Optional)</label>
                                <div id="documents_wrapper">
                                    @php
                                        $documents = old('documents', $project->documents);
                                    @endphp

                                    @if ($documents && is_array($documents) && count($documents) > 0)
                                        @foreach ($documents as $index => $document)
                                            <div class="row mb-2 document-item">
                                                <div class="col-md-5">
                                                    <input type="text" name="documents[{{ $index }}][label]"
                                                        class="form-control @error('documents.' . $index . '.label') is-invalid @enderror"
                                                        placeholder="Document Label (e.g., Approval Letter)"
                                                        value="{{ $document['label'] ?? '' }}">
                                                    @error('documents.' . $index . '.label')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="file" name="documents[{{ $index }}][file]"
                                                        class="form-control @error('documents.' . $index . '.file') is-invalid @enderror"
                                                        accept=".pdf,.doc,.docx">
                                                    @error('documents.' . $index . '.file')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror

                                                    <!-- Existing Document Link -->
                                                    @if (isset($document['file']))
                                                        <small class="text-muted d-block">
                                                            <a href="{{ Storage::url($document['file']) }}"
                                                                target="_blank" class="text-decoration-none">
                                                                <i class="feather feather-file me-1"></i>View existing
                                                                document
                                                            </a>
                                                        </small>
                                                        <input type="hidden"
                                                            name="existing_documents[{{ $index }}][file]"
                                                            value="{{ $document['file'] }}">
                                                        <input type="hidden"
                                                            name="existing_documents[{{ $index }}][label]"
                                                            value="{{ $document['label'] ?? '' }}">
                                                        <input type="hidden"
                                                            name="existing_documents[{{ $index }}][notes]"
                                                            value="{{ $document['notes'] ?? '' }}">
                                                    @endif
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button"
                                                        class="btn btn-outline-danger remove-document">−</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @elseif(old('documents') && is_array(old('documents')))
                                        @foreach (old('documents') as $index => $document)
                                            <div class="row mb-2 document-item">
                                                <div class="col-md-5">
                                                    <input type="text" name="documents[{{ $index }}][label]"
                                                        class="form-control @error('documents.' . $index . '.label') is-invalid @enderror"
                                                        placeholder="Document Label (e.g., Approval Letter)"
                                                        value="{{ $document['label'] ?? '' }}">
                                                    @error('documents.' . $index . '.label')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="file" name="documents[{{ $index }}][file]"
                                                        class="form-control @error('documents.' . $index . '.file') is-invalid @enderror"
                                                        accept=".pdf,.doc,.docx">
                                                    @error('documents.' . $index . '.file')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button"
                                                        class="btn btn-outline-danger remove-document">−</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <button type="button" class="btn btn-sm btn-primary mt-2" id="add_document">Add
                                    Document</button>
                                <div class="form-text">Add supporting documents like approval letters, NOC, survey
                                    reports, quotations</div>
                            </div>
                        </div>
                    </div>

                    <!-- Press Links -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Press / Other Links (Optional)</label>
                                <div id="links_wrapper">
                                    @php
                                        $links = old('links', $project->links);
                                    @endphp

                                    @if ($links && is_array($links) && count($links) > 0)
                                        @foreach ($links as $index => $link)
                                            <div class="row mb-2">
                                                <div class="col-md-5">
                                                    <input type="text" name="links[{{ $index }}][label]"
                                                        class="form-control @error('links.' . $index . '.label') is-invalid @enderror"
                                                        placeholder="Link Label (e.g., Press Coverage)"
                                                        value="{{ $link['label'] ?? '' }}">
                                                    @error('links.' . $index . '.label')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="url" name="links[{{ $index }}][url]"
                                                        class="form-control @error('links.' . $index . '.url') is-invalid @enderror"
                                                        placeholder="URL" value="{{ $link['url'] ?? '' }}">
                                                    @error('links.' . $index . '.url')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button"
                                                        class="btn btn-outline-danger remove-link">−</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @elseif(old('links') && is_array(old('links')))
                                        @foreach (old('links') as $index => $link)
                                            <div class="row mb-2">
                                                <div class="col-md-5">
                                                    <input type="text" name="links[{{ $index }}][label]"
                                                        class="form-control @error('links.' . $index . '.label') is-invalid @enderror"
                                                        placeholder="Link Label (e.g., Press Coverage)"
                                                        value="{{ $link['label'] ?? '' }}">
                                                    @error('links.' . $index . '.label')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="url" name="links[{{ $index }}][url]"
                                                        class="form-control @error('links.' . $index . '.url') is-invalid @enderror"
                                                        placeholder="URL" value="{{ $link['url'] ?? '' }}">
                                                    @error('links.' . $index . '.url')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button"
                                                        class="btn btn-outline-danger remove-link">−</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <button type="button" class="btn btn-sm btn-primary mt-2" id="add_link">Add
                                    Link</button>
                                <div class="form-text">Add press coverage, YouTube videos, social media links, live
                                    survey
                                    links</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- End Media Tab -->
        </div>
        </div> <!-- End Tab Content -->


        <!-- Submit Section -->
        <div class="col-lg-12">
            <div class="d-flex align-items-center justify-content-end mb-4">
                <a href="{{ route('admin.project.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Project</button>
            </div>
        </div>
    </form>
@endsection

@push('css')
    <style>
        /* Range Meter / Stepper */
        .stage-stepper {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin-bottom: 30px;
            padding: 0 20px;
        }

        .stage-stepper::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 40px;
            right: 40px;
            height: 4px;
            background: #e9ecef;
            z-index: 0;
        }

        .step-item {
            position: relative;
            z-index: 1;
            text-align: center;
            cursor: pointer;
            width: 120px;
        }

        .step-circle {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #e9ecef;
            color: #6c757d;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-weight: bold;
            font-size: 1.2rem;
            border: 4px solid #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .step-item.active .step-circle {
            background: #0d6efd;
            color: #fff;
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.2);
        }

        .step-item.completed .step-circle {
            background: #198754;
            color: #fff;
        }

        .step-label {
            font-size: 0.9rem;
            font-weight: 500;
            color: #6c757d;
            transition: color 0.3s;
        }

        .step-item.active .step-label {
            color: #0d6efd;
            font-weight: 700;
        }

        /* Custom Tabs */
        .custom-tabs {
            border-bottom: 2px solid #e9ecef;
        }

        .custom-tabs .nav-link {
            border: none;
            border-bottom: 3px solid transparent;
            color: #6c757d;
            font-weight: 500;
            padding: 12px 20px;
            margin-bottom: -2px;
            transition: all 0.2s;
        }

        .custom-tabs .nav-link:hover {
            color: #0d6efd;
            background: rgba(13, 110, 253, 0.05);
        }

        .custom-tabs .nav-link.active {
            color: #0d6efd;
            border-bottom-color: #0d6efd;
            background: transparent;
        }

        .custom-tabs .nav-link i {
            margin-right: 6px;
        }

        /* Tab Content Styling */
        .tab-pane {
            padding-top: 20px;
        }

        /* SDG Grid Enhanced Styling */
        #sdg_grid .sdg-card {
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            border-width: 2px !important;
            border-color: #dee2e6 !important;
            overflow: hidden;
        }

        #sdg_grid .sdg-card:hover {
            transform: translateY(-3px) !important;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15) !important;
            border-color: #0dcaf0 !important;
        }

        #sdg_grid .sdg-card.selected {
            box-shadow: 0 8px 20px rgba(13, 110, 253, 0.35) !important;
            border-color: #0d6efd !important;
            animation: pulse 2s infinite;
        }

        #sdg_grid .sdg-img {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        #sdg_grid .sdg-card:hover .sdg-img {
            transform: scale(1.05);
        }

        #sdg_grid .sdg-card.selected .sdg-img {
            border: 2px solid #0d6efd !important;
            box-shadow: 0 0 20px rgba(13, 110, 253, 0.5);
        }

        #sdg_grid .sdg-name {
            color: #495057;
            transition: color 0.3s ease;
        }

        #sdg_grid .sdg-card.selected .sdg-name {
            color: #0d6efd;
            font-weight: 600;
        }

        #sdg_grid .selected-check {
            animation: checkAppear 0.3s ease;
            z-index: 2;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 8px 20px rgba(13, 110, 253, 0.35);
            }

            50% {
                box-shadow: 0 8px 25px rgba(13, 110, 253, 0.5);
            }

            100% {
                box-shadow: 0 8px 20px rgba(13, 110, 253, 0.35);
            }
        }

        @keyframes checkAppear {
            from {
                opacity: 0;
                transform: scale(0.5);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Selected SDG Chips */
        #selected_sdg_chips .sdg-chip {
            transition: transform 0.2s ease;
        }

        #selected_sdg_chips .sdg-chip:hover {
            transform: translateY(-2px) scale(1.05);
        }

        #selected_sdg_chips .sdg-chip .card {
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        #selected_sdg_chips .sdg-chip:hover .card {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border-color: #0d6efd;
        }

        #selected_sdg_chips .btn-close-sm {
            opacity: 0.3;
            padding: 4px;
            font-size: 0.6rem;
            transition: all 0.2s ease;
        }

        #selected_sdg_chips .sdg-chip:hover .btn-close-sm {
            opacity: 1;
            background-color: rgba(220, 53, 69, 0.1);
        }

        /* Modal Styling */
        #sdgPreviewModal .modal-content {
            border: 2px solid #0d6efd;
            border-radius: 12px;
            overflow: hidden;
        }

        #sdgPreviewModal .modal-header {
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
            color: white;
            border-bottom: none;
        }

        #sdgPreviewModal .modal-title {
            font-weight: 600;
        }

        #sdgPreviewModal .modal-body {
            background-color: #f8f9fa;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            #sdg_grid {
                row-cols: 2 !important;
            }

            .sdg-card {
                min-height: 140px !important;
            }

            .sdg-img {
                width: 60px !important;
                height: 60px !important;
            }
        }

        @media (max-width: 576px) {
            #sdg_grid {
                row-cols: 2 !important;
                gap: 1rem !important;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Function to remove existing images
        function removeImage(type, path) {
            if (confirm('Are you sure you want to remove this image?')) {
                // Create a hidden input to track removed images
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                // Use array syntax for multiple removals
                if (type === 'banner' || type === 'gallery') {
                    hiddenInput.name = `removed_${type}_image[]`;
                } else {
                    hiddenInput.name = `removed_${type}`;
                }

                hiddenInput.value = path;
                document.getElementById('projectForm').appendChild(hiddenInput);

                // Remove the image preview
                const imageContainer = event.target.closest('.position-relative');
                if (imageContainer) {
                    imageContainer.remove();
                }
            }
        }

        $(document).ready(function() {
            // Global image fallback handler
            window.handleImageError = function(img) {
                const sdgId = $(img).closest('.sdg-card').data('sdg-id');
                const color = $(img).closest('.sdg-card').data('sdg-color') || '4C9F38';

                // Try alternative sources
                const altSrc =
                    `https://ui-avatars.com/api/?name=SDG+${sdgId}&background=${color}&color=fff&size=150&bold=true`;
                img.src = altSrc;

                // If still fails, use placeholder
                img.onerror = function() {
                    this.src = `https://via.placeholder.com/150/${color}/FFFFFF?text=SDG+${sdgId}`;
                };
            };

            // Initialize SDG selection
            function initializeSDGSelection() {
                const sdgGrid = $('#sdg_grid');
                const hiddenInput = $('#sdg_goals_input');
                const summarySection = $('#selected_sdg_summary');
                const chipsContainer = $('#selected_sdg_chips');

                // Get initial selected values
                let selectedSDGs = [];
                if (hiddenInput.val()) {
                    selectedSDGs = hiddenInput.val().split(',').map(id => parseInt(id.trim())).filter(id => !isNaN(
                        id));
                }

                // Function to update selection
                function updateSDGSelection(sdgId, select) {
                    const sdgIdNum = parseInt(sdgId);
                    const index = selectedSDGs.indexOf(sdgIdNum);

                    if (select && index === -1) {
                        selectedSDGs.push(sdgIdNum);
                    } else if (!select && index !== -1) {
                        selectedSDGs.splice(index, 1);
                    }

                    // Sort selected SDGs
                    selectedSDGs.sort((a, b) => a - b);

                    // Update hidden input
                    hiddenInput.val(selectedSDGs.join(','));

                    // Update UI
                    updateSDGSummary();
                    updateSDGCards();

                    // Trigger change event for form validation
                    hiddenInput.trigger('change');
                }

                // Function to update summary section
                function updateSDGSummary() {
                    if (selectedSDGs.length > 0) {
                        summarySection.show();

                        // Clear existing chips
                        chipsContainer.empty();

                        // Add new chips in order
                        selectedSDGs.forEach(sdgId => {
                            const sdgCard = $(`.sdg-card[data-sdg-id="${sdgId}"]`);
                            const sdgName = sdgCard.data('sdg-name') || `SDG ${sdgId}`;
                            const sdgColor = sdgCard.data('sdg-color') || '4C9F38';

                            // Get the image source from the card (or use fallback)
                            const imgSrc = sdgCard.find('.sdg-img').attr('src') ||
                                `https://ui-avatars.com/api/?name=SDG+${sdgId}&background=${sdgColor}&color=fff&size=60&bold=true`;

                            const chip = `
                        <div class="sdg-chip position-relative" data-sdg-id="${sdgId}">
                            <div class="card border shadow-sm" style="width: 100px;">
                                <div class="card-body p-2 text-center">
                                    <img src="${imgSrc}"
                                         alt="SDG ${sdgId}"
                                         class="img-fluid rounded-circle mb-2"
                                         style="width: 60px; height: 60px; object-fit: cover;"
                                         onerror="this.src='https://ui-avatars.com/api/?name=SDG+${sdgId}&background=${sdgColor}&color=fff&size=60&bold=true'">
                                    <small class="d-block fw-semibold" style="font-size: 0.65rem;">
                                        SDG ${sdgId}
                                    </small>
                                    <small class="d-block text-muted" style="font-size: 0.6rem;">
                                        ${sdgName.substring(0, 10)}${sdgName.length > 10 ? '...' : ''}
                                    </small>
                                    <button type="button"
                                            class="btn-close btn-close-sm position-absolute top-0 end-0 m-1"
                                            data-sdg-id="${sdgId}"
                                            aria-label="Remove SDG ${sdgId}"></button>
                                </div>
                            </div>
                        </div>`;
                            chipsContainer.append(chip);
                        });
                    } else {
                        summarySection.hide();
                    }
                }

                // Function to update card appearance
                function updateSDGCards() {
                    $('.sdg-card').each(function() {
                        const card = $(this);
                        const sdgId = parseInt(card.data('sdg-id'));
                        const isSelected = selectedSDGs.includes(sdgId);

                        // Update selection indicator
                        card.find('.selected-check').toggle(isSelected);

                        // Toggle visual states
                        card.toggleClass('border-primary border-2 selected', isSelected);
                        card.toggleClass('border-light', !isSelected);

                        // Add/remove shadow and background
                        if (isSelected) {
                            card.css({
                                'background-color': `#${card.data('sdg-color')}15`,
                                'box-shadow': '0 4px 12px rgba(13, 110, 253, 0.25)'
                            });
                            card.find('.sdg-img').css('border', '2px solid #0d6efd');
                        } else {
                            card.css({
                                'background-color': '',
                                'box-shadow': ''
                            });
                            card.find('.sdg-img').css('border', '');
                        }
                    });
                }

                // Function to show preview modal
                function showSDGPreview(sdgId) {
                    const card = $(`.sdg-card[data-sdg-id="${sdgId}"]`);
                    const sdgName = card.data('sdg-name');
                    const sdgDescription = card.data('sdg-description');
                    const isSelected = selectedSDGs.includes(parseInt(sdgId));
                    const imgSrc = card.find('.sdg-img').attr('src');

                    $('#previewModalTitle').html(`SDG ${sdgId}: ${sdgName}`);
                    $('#previewModalDescription').text(sdgDescription);

                    // Set image in modal
                    $('#previewModalImage').html(`
                <img src="${imgSrc}"
                     alt="SDG ${sdgId}"
                     class="img-fluid rounded-circle"
                     style="width: 100%; height: 100%; object-fit: cover;"
                     onerror="this.src='https://ui-avatars.com/api/?name=SDG+${sdgId}&background=${card.data('sdg-color')}&color=fff&size=120&bold=true'">
            `);

                    // Update select button text
                    $('#toggleSelectBtn')
                        .toggleClass('btn-danger', isSelected)
                        .toggleClass('btn-primary', !isSelected)
                        .html(isSelected ?
                            '<i class="feather feather-x me-1"></i>Remove Selection' :
                            '<i class="feather feather-check me-1"></i>Select SDG');

                    // Set button click handler
                    $('#toggleSelectBtn').off('click').on('click', function() {
                        updateSDGSelection(sdgId, !isSelected);
                        $('#sdgPreviewModal').modal('hide');
                    });

                    $('#sdgPreviewModal').modal('show');
                }

                // Card click events
                sdgGrid.off('click', '.sdg-card').on('click', '.sdg-card', function(e) {
                    const card = $(this);
                    const sdgId = card.data('sdg-id');

                    // Check if click is on remove button
                    if ($(e.target).closest('.btn-close').length) {
                        return;
                    }

                    // Single click toggles selection
                    const isSelected = selectedSDGs.includes(parseInt(sdgId));
                    updateSDGSelection(sdgId, !isSelected);
                });

                // Long press/right click for preview
                let pressTimer;
                sdgGrid.off('contextmenu', '.sdg-card').on('contextmenu', '.sdg-card', function(e) {
                    e.preventDefault();
                    const sdgId = $(this).data('sdg-id');
                    showSDGPreview(sdgId);
                });

                sdgGrid.off('mousedown', '.sdg-card').on('mousedown', '.sdg-card', function() {
                    const card = $(this);
                    pressTimer = setTimeout(function() {
                        const sdgId = card.data('sdg-id');
                        showSDGPreview(sdgId);
                    }, 1000); // 1 second for long press
                }).off('mouseup mouseleave').on('mouseup mouseleave', function() {
                    clearTimeout(pressTimer);
                });

                // Double click for preview
                sdgGrid.off('dblclick', '.sdg-card').on('dblclick', '.sdg-card', function() {
                    const sdgId = $(this).data('sdg-id');
                    showSDGPreview(sdgId);
                });

                // Remove chip event
                chipsContainer.off('click', '.btn-close').on('click', '.btn-close', function(e) {
                    e.stopPropagation();
                    const sdgId = $(this).data('sdg-id');
                    updateSDGSelection(sdgId, false);
                });

                // Clear all SDGs
                $('#clear_all_sdgs').off('click').on('click', function() {
                    if (confirm('Are you sure you want to clear all selected SDGs?')) {
                        selectedSDGs = [];
                        hiddenInput.val('');
                        updateSDGSelection(null, null); // Trigger updates
                    }
                });

                // Hover effects
                sdgGrid.off('mouseenter', '.sdg-card').on('mouseenter', '.sdg-card', function() {
                    const card = $(this);
                    if (!card.hasClass('selected')) {
                        card.addClass('border-info');
                        card.css('transform', 'translateY(-2px)');
                    }
                }).off('mouseleave', '.sdg-card').on('mouseleave', '.sdg-card', function() {
                    const card = $(this);
                    card.removeClass('border-info');
                    card.css('transform', '');
                });

                // Initialize UI
                updateSDGSummary();
                updateSDGCards();

                // Preload images for better UX
                setTimeout(() => {
                    $('.sdg-img').each(function() {
                        const img = new Image();
                        img.src = $(this).attr('src');
                    });
                }, 500);
            }

            // Listen for alignment category changes
            $('select[name="alignment_categories[]"]').off('change').on('change', function() {
                let selected = $(this).val() || [];
                $('#sdg_section').toggle(selected.includes('sdg'));
                $('#govt_schemes_section').toggle(selected.includes('govt_schemes'));

                setTimeout(() => {
                    if ($('#sdg_section').is(':visible')) {
                        initializeSDGSelection();
                    }
                }, 100);
            });

            // Initialize if SDG section is already visible
            if ($('#sdg_section').is(':visible')) {
                initializeSDGSelection();
            }

            // Reinitialize when Strategic Tab is shown
            $('button[data-bs-target="#strategic_tab"]').on('shown.bs.tab', function(e) {
                if ($('#sdg_section').is(':visible')) {
                    initializeSDGSelection();
                }
            });

            // Initialize Select2 for single select
            $('.select2').select2({
                placeholder: "Select an option",
                allowClear: true,
                width: '100%'
            });

            // Initialize Select2 for multiple select
            $('.select2-multiple').select2({
                placeholder: "Select options",
                allowClear: true,
                width: '100%'
            });

            // Initialize Summernote
            $('#summernote').summernote({
                height: 200,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview']]
                ],
                placeholder: 'Write your project description here...'
            });

            // Generate slug from title (only if empty)
            function generateSlug(text) {
                return text.toString().toLowerCase()
                    .replace(/\s+/g, '-')
                    .replace(/[^\w\-]+/g, '')
                    .replace(/\-\-+/g, '-')
                    .replace(/^-+/, '')
                    .replace(/-+$/, '');
            }

            $('input[name="title"]').on('input', function() {
                let title = $(this).val();
                let slugField = $('input[name="slug"]');
                if (title && !slugField.val()) {
                    let slug = generateSlug(title);
                    slugField.val(slug);
                }
            });

            // Auto calculate duration
            function calculateDuration() {
                let start = $('input[name="planned_start_date"]').val();
                let end = $('input[name="planned_end_date"]').val();

                if (start && end) {
                    let startDate = new Date(start);
                    let endDate = new Date(end);
                    let diffTime = Math.abs(endDate - startDate);
                    let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                    $('#auto_duration').val(diffDays + ' days');
                } else {
                    $('#auto_duration').val('');
                }
            }

            $('input[name="planned_start_date"], input[name="planned_end_date"]').on('change', calculateDuration);

            // Location type toggle
            function toggleLocationType() {
                let type = $('#target_location_type').val();
                if (type === 'single') {
                    $('#single_location_section').show(); // or .removeClass('d-none')
                    $('#multiple_locations_section').hide();
                } else if (type === 'multiple') {
                    $('#single_location_section').hide();
                    $('#multiple_locations_section').show();
                } else {
                    $('#single_location_section').hide();
                    $('#multiple_locations_section').hide();
                }
            }

            $('#target_location_type').on('change', toggleLocationType);
            // Initialize on load
            toggleLocationType();

            // Alignment categories toggle (redundant handled above)

            // Add/remove dynamic fields counters
            let locationCounter =
                {{ is_array(old('multiple_locations', $project->multiple_locations)) ? count(old('multiple_locations', $project->multiple_locations)) : 0 }};
            let metricCounter =
                {{ is_array(old('donut_metrics', $project->donut_metrics)) ? count(old('donut_metrics', $project->donut_metrics)) : 0 }};
            let targetGroupCounter =
                {{ is_array(old('target_groups', $project->target_groups)) ? count(old('target_groups', $project->target_groups)) : 0 }};
            let objectiveCounter =
                {{ is_array(old('objectives', $project->objectives)) ? count(old('objectives', $project->objectives)) : 0 }};
            let stakeholderCounter =
                {{ is_array(old('stakeholders', $project->stakeholders)) ? count(old('stakeholders', $project->stakeholders)) : 0 }};
            let riskCounter =
                {{ is_array(old('risks', $project->risks)) ? count(old('risks', $project->risks)) : 0 }};
            let documentCounter =
                {{ is_array(old('documents', $project->documents)) ? count(old('documents', $project->documents)) : 0 }};
            let linkCounter =
                {{ is_array(old('links', $project->links)) ? count(old('links', $project->links)) : 0 }};

            // Beneficiary Counters
            let benGroupCounter = {{ $project->beneficiaries->where('type', 'group')->count() }};
            let benIndCounter = {{ $project->beneficiaries->where('type', 'individual')->count() }};
            const isUpcoming = {{ $isUpcoming ? 'true' : 'false' }};

            const groupOptions = [
                'Schools', 'Colleges / Higher Education Institutions', 'Women Self-Help Groups (SHGs)',
                'Farmer Producer Organizations (FPOs)', 'Village Communities / Panchayats',
                'Rural Areas', 'Urban Areas', 'Metro Cities', 'Taluk / Block Level',
                'District Level', 'Training / Skill Development Centers',
                'Community-Based Organizations (CBOs) / NGOs'
            ];

            const individualOptions = [
                'Children', 'Students', 'Youth', 'Job Seekers / Unemployed', 'Women', 'Girls',
                'Men', 'Farmers', 'Entrepreneurs / Micro-Enterprise Owners',
                'Self-Employed / Informal Workers', 'Elderly Persons',
                'Persons with Disabilities (PwD)', 'Economically Weaker Section (EWS)',
                'Migrant / Returned Migrant Workers'
            ];

            // Add location
            $('#add_location').on('click', function() {
                let html = `
                <div class="location-group mb-3 border p-3">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label">Pin Code</label>
                            <input type="text" name="multiple_locations[${locationCounter}][pincode]"
                                class="form-control" placeholder="6-digit PIN">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">State</label>
                            <input type="text" name="multiple_locations[${locationCounter}][state]"
                                class="form-control" placeholder="State name">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">District</label>
                            <input type="text" name="multiple_locations[${locationCounter}][district]"
                                class="form-control" placeholder="District name">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Taluk</label>
                            <input type="text" name="multiple_locations[${locationCounter}][taluk]"
                                class="form-control" placeholder="Taluk name">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="form-label">Panchayat</label>
                            <input type="text" name="multiple_locations[${locationCounter}][panchayat]"
                                class="form-control" placeholder="Panchayat name">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Building Name</label>
                            <input type="text" name="multiple_locations[${locationCounter}][building_name]"
                                class="form-control" placeholder="Building name">
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-danger mt-2 remove-location">Remove</button>
                </div>`;
                $('#multiple_locations_wrapper').append(html);
                locationCounter++;
            });

            // Add metric
            $('#add_metric').on('click', function() {
                let html = `
                <div class="row mb-2 metric-item">
                    <div class="col-md-4">
                        <input type="text" name="donut_metrics[${metricCounter}][label]"
                            class="form-control" placeholder="Label (e.g., Youth Interested)">
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="donut_metrics[${metricCounter}][value]"
                            class="form-control" placeholder="Value % (e.g., 80)" min="0" max="100">
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="donut_metrics[${metricCounter}][notes]"
                            class="form-control" placeholder="Small Notes (optional)">
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-outline-danger remove-metric">−</button>
                    </div>
                </div>`;
                $('#donut_metrics_wrapper').append(html);
                metricCounter++;
            });

            // Add Beneficiary Group
            $('#add_group_btn').on('click', function() {
                let optionsHtml = '<option value="">Select Group</option>';
                groupOptions.forEach(opt => {
                    optionsHtml += `<option value="${opt}">${opt}</option>`;
                });

                let html = '';
                if (isUpcoming) {
                    html = `
                    <tr>
                        <td>
                            <select name="beneficiary_groups[${benGroupCounter}][category]" class="form-select select2">
                                ${optionsHtml}
                            </select>
                        </td>
                        <td>
                            <input type="number" name="beneficiary_groups[${benGroupCounter}][target]" class="form-control" placeholder="0">
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-danger remove-row"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>`;
                } else {
                    html = `
                    <tr>
                        <td>
                            <select name="beneficiary_groups[${benGroupCounter}][category]" class="form-select select2">
                                ${optionsHtml}
                            </select>
                        </td>
                        <td>
                            <input type="number" name="beneficiary_groups[${benGroupCounter}][target]" class="form-control" placeholder="0">
                        </td>
                        <td>
                            <input type="number" class="form-control bg-light" disabled value="0" placeholder="Save to edit">
                        </td>
                        <td>
                            <input type="date" class="form-control" disabled value="{{ date('Y-m-d') }}">
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-danger remove-row"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>`;
                }

                $('#beneficiary_groups_body').append(html);

                // Re-initialize Select2
                $('#beneficiary_groups_body .select2:last').select2({
                    placeholder: "Select Group",
                    allowClear: true,
                    width: '100%'
                });
                benGroupCounter++;
            });

            // Add Beneficiary Individual
            $('#add_individual_btn').on('click', function() {
                let optionsHtml = '<option value="">Select Individual</option>';
                individualOptions.forEach(opt => {
                    optionsHtml += `<option value="${opt}">${opt}</option>`;
                });

                let html = '';
                if (isUpcoming) {
                    html = `
                    <tr>
                        <td>
                            <select name="beneficiary_individuals[${benIndCounter}][category]" class="form-select select2">
                                ${optionsHtml}
                            </select>
                        </td>
                        <td>
                            <input type="number" name="beneficiary_individuals[${benIndCounter}][target]" class="form-control" placeholder="0">
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-danger remove-row"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>`;
                } else {
                     html = `
                    <tr>
                        <td>
                            <select name="beneficiary_individuals[${benIndCounter}][category]" class="form-select select2">
                                ${optionsHtml}
                            </select>
                        </td>
                        <td>
                            <input type="number" name="beneficiary_individuals[${benIndCounter}][target]" class="form-control" placeholder="0">
                        </td>
                        <td>
                            <input type="number" class="form-control bg-light" disabled value="0" placeholder="Save to edit">
                        </td>
                        <td>
                            <input type="date" class="form-control" disabled value="{{ date('Y-m-d') }}">
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-danger remove-row"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>`;
                }

                $('#beneficiary_individuals_body').append(html);

                // Re-initialize Select2
                $('#beneficiary_individuals_body .select2:last').select2({
                    placeholder: "Select Individual",
                    allowClear: true,
                    width: '100%'
                });
                benIndCounter++;
            });

            // Generic Remove Row
            $(document).on('click', '.remove-row', function() {
                $(this).closest('tr').remove();
            });

            // Add objective
            $('#add_objective').on('click', function() {
                let html = `
                <div class="input-group mb-2">
                    <input type="text" name="objectives[]" class="form-control" placeholder="Enter strategic objective">
                    <button type="button" class="btn btn-outline-danger remove-objective">−</button>
                </div>`;
                $('#objectives_wrapper').append(html);
                objectiveCounter++;
            });

            // Add stakeholder
            $('#add_stakeholder').on('click', function() {
                let html = `
                <div class="row mb-2 stakeholder-item">
                    <div class="col-md-5">
                        <input type="text" name="stakeholders[${stakeholderCounter}][name]"
                            class="form-control" placeholder="Stakeholder Name">
                    </div>
                    <div class="col-md-5">
                        <input type="text" name="stakeholders[${stakeholderCounter}][role]"
                            class="form-control" placeholder="Role/Contribution">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-outline-danger remove-stakeholder">−</button>
                    </div>
                </div>`;
                $('#stakeholders_wrapper').append(html);
                stakeholderCounter++;
            });

            // Add risk
            $('#add_risk').on('click', function() {
                let html = `
                <div class="border p-3 mb-3 risk-item">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Risk</label>
                                <input type="text" name="risks[${riskCounter}][risk]"
                                    class="form-control" placeholder="e.g., Funding delay">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label class="form-label">Impact</label>
                                <select name="risks[${riskCounter}][impact]" class="form-select select2">
                                    <option value="low">Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Mitigation</label>
                                <input type="text" name="risks[${riskCounter}][mitigation]"
                                    class="form-control" placeholder="e.g., Alternate CSR partner">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Responsible Person</label>
                                <input type="text" name="risks[${riskCounter}][responsible]"
                                    class="form-control" placeholder="e.g., Project Manager">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-outline-danger remove-risk">−</button>
                        </div>
                    </div>
                </div>`;
                $('#risks_wrapper').append(html);

                // Re-initialize Select2 for the new dropdown
                $('#risks_wrapper .select2:last').select2({
                    placeholder: "Select Impact",
                    minimumResultsForSearch: Infinity, // No search box for small lists
                    width: '100%'
                });

                riskCounter++;
            });

            // Add document
            $('#add_document').on('click', function() {
                let html = `
                <div class="row mb-2 document-item">
                    <div class="col-md-5">
                        <input type="text" name="documents[${documentCounter}][label]"
                            class="form-control" placeholder="Document Label (e.g., Approval Letter)">
                    </div>
                    <div class="col-md-5">
                        <input type="file" name="documents[${documentCounter}][file]"
                            class="form-control" accept=".pdf,.doc,.docx">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-outline-danger remove-document">−</button>
                    </div>
                </div>`;
                $('#documents_wrapper').append(html);
                documentCounter++;
            });

            // Add link
            $('#add_link').on('click', function() {
                let html = `
                <div class="row mb-2">
                    <div class="col-md-5">
                        <input type="text" name="links[${linkCounter}][label]"
                            class="form-control" placeholder="Link Label (e.g., Press Coverage)">
                    </div>
                    <div class="col-md-5">
                        <input type="url" name="links[${linkCounter}][url]"
                            class="form-control" placeholder="URL">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-outline-danger remove-link">−</button>
                    </div>
                </div>`;
                $('#links_wrapper').append(html);
                linkCounter++;
            });

            // Remove handlers with proper validation handling
            $(document).on('click', '.remove-location', function() {
                $(this).closest('.location-group').remove();
            });

            $(document).on('click', '.remove-metric', function() {
                $(this).closest('.metric-item').remove();
            });

            // Old handlers removed


            $(document).on('click', '.remove-objective', function() {
                $(this).closest('.input-group').remove();
            });

            $(document).on('click', '.remove-stakeholder', function() {
                $(this).closest('.stakeholder-item').remove();
            });

            $(document).on('click', '.remove-risk', function() {
                $(this).closest('.risk-item').remove();
            });

            $(document).on('click', '.remove-document', function() {
                $(this).closest('.document-item').remove();
            });

            $(document).on('click', '.remove-link', function() {
                $(this).closest('.row').remove();
            });

            // Initialize based on existing values
            calculateDuration();

            // Auto-show tabs that have validation errors
            $('.is-invalid').each(function() {
                let tabPane = $(this).closest('.tab-pane');
                if (tabPane.length) {
                    let tabId = tabPane.attr('id');
                    let tabButton = $(`button[data-bs-target="#${tabId}"]`);
                    if (tabButton.length) {
                        var tab = new bootstrap.Tab(tabButton[0]);
                        tab.show();
                    }
                }
            });
            // Stage Stepper Logic
            function updateStageUI(stage) {
                // Update Hidden Input
                $('input[name="stage"]').val(stage);

                // Update Stepper Visuals
                $('.step-item').removeClass('active completed');

                if (stage === 'upcoming') {
                    $('#step_upcoming').addClass('active');
                    // Hide Ongoing Tab
                    let ongoingTabLink = $('.nav-link[data-bs-target="#ongoing_tab"]');
                    ongoingTabLink.parent().hide();

                    // Also ensure the pane is inactive/hidden
                    $('#ongoing_tab').removeClass('active show');

                    // If active tab was ongoing, switch to basic
                    if (ongoingTabLink.hasClass('active')) {
                        var triggerEl = document.querySelector('#basic-tab-link');
                        var tab = new bootstrap.Tab(triggerEl);
                        tab.show();
                    }
                    // Disable ongoing beneficiaries inputs
                    $('#ongoing_beneficiaries_fieldset').prop('disabled', true);
                } else if (stage === 'ongoing') {
                    $('#step_upcoming').addClass('completed');
                    $('#step_ongoing').addClass('active');
                    // Show Ongoing Tab
                    $('.nav-link[data-bs-target="#ongoing_tab"]').parent().show();
                    // Enable ongoing beneficiaries inputs
                    $('#ongoing_beneficiaries_fieldset').prop('disabled', false);
                } else if (stage === 'completed') {
                    $('#step_upcoming').addClass('completed');
                    $('#step_ongoing').addClass('completed');
                    $('#step_completed').addClass('active');
                    // Show Ongoing Tab
                    $('.nav-link[data-bs-target="#ongoing_tab"]').parent().show();
                    // Enable ongoing beneficiaries inputs
                    $('#ongoing_beneficiaries_fieldset').prop('disabled', false);
                }

                // Toggle Completed Fields inside Ongoing Tab
                if (stage === 'completed') {
                    $('#completed_fields_wrapper').slideDown();
                    // $('#actual_end_date_wrapper').slideDown(); // Now handled with ongoing
                } else {
                    $('#completed_fields_wrapper').slideUp();
                }

                if (stage === 'completed') {
                    $('#actual_end_date_wrapper').slideDown();
                    $('#actual_beneficiary_count_wrapper').slideDown();
                } else {
                    $('#actual_end_date_wrapper').slideUp();
                    $('#actual_beneficiary_count_wrapper').slideUp();
                }
            }



            // Add Ongoing Group Handler
            $('#add_ongoing_group_btn').on('click', function() {
                let optionsHtml = '<option value="">Select Group</option>';
                groupOptions.forEach(opt => {
                    optionsHtml += `<option value="${opt}">${opt}</option>`;
                });
                
                let html = `
                <tr>
                    <td>
                        <select name="beneficiary_groups[${benGroupCounter}][category]" class="form-select select2">
                            ${optionsHtml}
                        </select>
                    </td>
                    <td>
                        <input type="number" name="beneficiary_groups[${benGroupCounter}][target]" class="form-control" placeholder="0">
                    </td>
                    <td>
                        <input type="number" class="form-control bg-light" disabled value="0" placeholder="Save to edit">
                    </td>
                    <td>
                        <input type="date" class="form-control" disabled value="{{ date('Y-m-d') }}">
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-outline-danger remove-row"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>`;

                $('#ongoing_beneficiary_groups_body').append(html);
                $('#ongoing_beneficiary_groups_body .select2:last').select2({ placeholder: "Select Group", allowClear: true, width: '100%' });
                benGroupCounter++;
            });

            // Add Ongoing Individual Handler
            $('#add_ongoing_individual_btn').on('click', function() {
                let optionsHtml = '<option value="">Select Individual</option>';
                individualOptions.forEach(opt => {
                    optionsHtml += `<option value="${opt}">${opt}</option>`;
                });
                
                let html = `
                <tr>
                    <td>
                        <select name="beneficiary_individuals[${benIndCounter}][category]" class="form-select select2">
                            ${optionsHtml}
                        </select>
                    </td>
                    <td>
                        <input type="number" name="beneficiary_individuals[${benIndCounter}][target]" class="form-control" placeholder="0">
                    </td>
                    <td>
                        <input type="number" class="form-control bg-light" disabled value="0" placeholder="Save to edit">
                    </td>
                    <td>
                        <input type="date" class="form-control" disabled value="{{ date('Y-m-d') }}">
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-outline-danger remove-row"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>`;

                $('#ongoing_beneficiary_individuals_body').append(html);
                $('#ongoing_beneficiary_individuals_body .select2:last').select2({ placeholder: "Select Individual", allowClear: true, width: '100%' });
                benIndCounter++;
            });

            // Click on Stepper
            $('.step-item').on('click', function() {
                let stage = $(this).data('stage');
                updateStageUI(stage);

                // If switching to Ongoing/Completed, user requested "that tab active"
                if (stage === 'ongoing' || stage === 'completed') {
                    var triggerEl = document.querySelector('#ongoing-tab-link');
                    var tab = new bootstrap.Tab(triggerEl);
                    tab.show();
                }
            });

            // Initialize Stage UI
            updateStageUI('{{ $project->stage }}');

        });
    </script>
@endpush
