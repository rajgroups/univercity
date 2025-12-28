{{-- @dd($project->alignment_categories) --}}
@extends('layouts.admin.app')
@section('content')
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Edit Project</h4>
                <h6>Update project details - Current Stage: <span class="badge bg-{{ $project->stage == 'upcoming' ? 'warning' : ($project->stage == 'ongoing' ? 'info' : 'success') }}">{{ ucfirst($project->stage) }}</span></h6>
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

    <form action="{{ route('admin.project.update', $project->id) }}" method="POST" enctype="multipart/form-data" class="add-product-form" id="projectForm">
        @csrf
        @method('PUT')

        <div class="add-product">
            <div class="accordions-items-seperate" id="accordionSpacingExample">

                <!-- Section 0: Project Stage Indicator -->
                <div class="accordion-item border mb-4">
                    <h2 class="accordion-header" id="headingStage">
                        <div class="accordion-button bg-white" data-bs-toggle="collapse"
                            data-bs-target="#stageSection">
                            <div class="d-flex align-items-center justify-content-between flex-fill">
                                <h5 class="d-flex align-items-center">
                                    <i class="feather feather-layers text-primary me-2"></i>
                                    <span>Project Stage:
                                        <span class="badge bg-{{ $project->stage == 'upcoming' ? 'warning text-dark' : ($project->stage == 'ongoing' ? 'info' : 'success') }}">
                                            {{ ucfirst($project->stage) }}
                                        </span>
                                    </span>
                                </h5>
                            </div>
                        </div>
                    </h2>
                    <div id="stageSection" class="accordion-collapse collapse show">
                        <div class="accordion-body border-top">
                            <div class="alert alert-info">
                                <i class="feather feather-info me-2"></i>
                                <strong>Note:</strong> Update the project stage as it progresses.
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Project ID <span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('project_code') is-invalid @enderror"
                                            name="project_code" value="{{ old('project_code', $project->project_code) }}"
                                            placeholder="Auto-generated" readonly>
                                        @error('project_code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Format: ISICO-YYYY-LOC-SEQ</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Project Location Type <span class="text-danger">*</span></label>
                                        <select name="location_type"
                                            class="form-select select2 @error('location_type') is-invalid @enderror">
                                            <option value="">Select Location Type</option>
                                            <option value="RUR" {{ old('location_type', $project->location_type) == 'RUR' ? 'selected' : '' }}>Rural (RUR)</option>
                                            <option value="URB" {{ old('location_type', $project->location_type) == 'URB' ? 'selected' : '' }}>Urban (URB)</option>
                                            <option value="MET" {{ old('location_type', $project->location_type) == 'MET' ? 'selected' : '' }}>Metro (MET)</option>
                                            <option value="MIX" {{ old('location_type', $project->location_type) == 'MIX' ? 'selected' : '' }}>Other - Mixed (MIX)</option>
                                        </select>
                                        @error('location_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Format: DATE + Project Location Type</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Project Stage Selection -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Project Stage <span class="text-danger">*</span></label>
                                        <select name="stage"
                                            class="form-select select2 @error('stage') is-invalid @enderror">
                                            <option value="upcoming" {{ old('stage', $project->stage) == 'upcoming' ? 'selected' : '' }}>Upcoming (Planning)</option>
                                            <option value="ongoing" {{ old('stage', $project->stage) == 'ongoing' ? 'selected' : '' }}>Ongoing (Implementation)</option>
                                            <option value="completed" {{ old('stage', $project->stage) == 'completed' ? 'selected' : '' }}>Completed (Closed)</option>
                                        </select>
                                        @error('stage')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Update the current stage of the project</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Project Status</label>
                                        <select name="status"
                                            class="form-select select2 @error('status') is-invalid @enderror">
                                            <option value="active" {{ old('status', $project->status) == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ old('status', $project->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Set project visibility</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 1: Basic Project Details -->
                <div class="accordion-item border mb-4">
                    <h2 class="accordion-header" id="headingBasic">
                        <div class="accordion-button bg-white" data-bs-toggle="collapse"
                            data-bs-target="#basicSection">
                            <div class="d-flex align-items-center justify-content-between flex-fill">
                                <h5 class="d-flex align-items-center">
                                    <i class="feather feather-info text-primary me-2"></i>
                                    <span>Section 1: Basic Project Details</span>
                                </h5>
                            </div>
                        </div>
                    </h2>
                    <div id="basicSection" class="accordion-collapse collapse show">
                        <div class="accordion-body border-top">
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
                                <label for="short_description" class="form-label">Short Description <span class="text-danger">*</span></label>
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
                                        @if($project->banner_images && $project->banner_images !== '[]' && $project->banner_images !== '"[]"')
                                            <div class="mt-2">
                                                <label class="form-label small">Existing Banner Image:</label>

                                                <div class="position-relative d-inline-block" style="width: 80px;">
                                                    <img src="{{ asset($project->banner_images) }}"
                                                        alt="Banner"
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

                                        <div class="form-text">Upload multiple real images of project area (schools, villages, etc.) - Max 5MB each</div>
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
                                        @if($project->thumbnail_image)
                                            <div class="mt-2">
                                                <label class="form-label small">Existing Thumbnail:</label>
                                                <div class="position-relative d-inline-block">
                                                    <img src="{{ asset($project->thumbnail_image) }}" alt="Thumbnail" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                                                    <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 p-0" style="width: 20px; height: 20px; font-size: 10px;" onclick="removeImage('thumbnail', '{{ $project->thumbnail_image }}')">×</button>
                                                </div>
                                                <input type="hidden" name="existing_thumbnail" value="{{ $project->thumbnail_image }}">
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
                                        <label class="form-label">Planned Start Date <span class="text-danger">*</span></label>
                                        <input type="date"
                                            class="form-control @error('planned_start_date') is-invalid @enderror"
                                            name="planned_start_date" value="{{ old('planned_start_date', $project->planned_start_date ? $project->planned_start_date->format('Y-m-d') : '') }}">
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
                                            name="planned_end_date" value="{{ old('planned_end_date', $project->planned_end_date ? $project->planned_end_date->format('Y-m-d') : '') }}">
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
                            <div class="row mt-3" id="actual_dates_section" style="{{ in_array($project->stage, ['ongoing', 'completed']) ? '' : 'display:none;' }}">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Actual Start Date <span class="text-danger">*</span></label>
                                        <input type="date"
                                            class="form-control @error('actual_start_date') is-invalid @enderror"
                                            name="actual_start_date" value="{{ old('actual_start_date', $project->actual_start_date ? $project->actual_start_date->format('Y-m-d') : '') }}">
                                        @error('actual_start_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Actual project start date</div>
                                    </div>
                                </div>
                                <div class="col-md-4" id="actual_end_date_wrapper" style="{{ $project->stage == 'completed' ? '' : 'display:none;' }}">
                                    <div class="mb-3">
                                        <label class="form-label">Actual End Date <span class="text-danger">*</span></label>
                                        <input type="date"
                                            class="form-control @error('actual_end_date') is-invalid @enderror"
                                            name="actual_end_date" value="{{ old('actual_end_date', $project->actual_end_date ? $project->actual_end_date->format('Y-m-d') : '') }}">
                                        @error('actual_end_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Actual project completion date</div>
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
                </div>

                <!-- Section 2: Target Location Details -->
                <div class="accordion-item border mb-4">
                    <h2 class="accordion-header" id="headingLocation">
                        <div class="accordion-button bg-white" data-bs-toggle="collapse"
                            data-bs-target="#locationSection">
                            <div class="d-flex align-items-center justify-content-between flex-fill">
                                <h5 class="d-flex align-items-center">
                                    <i class="feather feather-map-pin text-primary me-2"></i>
                                    <span>Section 2: Target Location Details</span>
                                </h5>
                            </div>
                        </div>
                    </h2>
                    <div id="locationSection" class="accordion-collapse collapse show">
                        <div class="accordion-body border-top">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Location Type <span class="text-danger">*</span></label>
                                        <select name="target_location_type" id="target_location_type"
                                            class="form-select select2 @error('target_location_type') is-invalid @enderror">
                                            <option value="">Select Type</option>
                                            <option value="single" {{ old('target_location_type', $project->target_location_type) == 'single' ? 'selected' : '' }}>Single Location</option>
                                            <option value="multiple" {{ old('target_location_type', $project->target_location_type) == 'multiple' ? 'selected' : '' }}>Multiple Locations</option>
                                        </select>
                                        @error('target_location_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Select whether project has single or multiple locations</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Single Location -->
                            <div id="single_location_section" style="display: {{ old('target_location_type', $project->target_location_type) == 'single' ? 'block' : 'none' }};">
                                <h6>Single Location Details</h6>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Pin Code</label>
                                            <input type="text" name="pincode"
                                                class="form-control @error('pincode') is-invalid @enderror"
                                                value="{{ old('pincode', $project->pincode) }}" placeholder="Enter 6-digit PIN code">
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
                                                value="{{ old('district', $project->district) }}" placeholder="Enter district name">
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
                                                value="{{ old('panchayat', $project->panchayat) }}" placeholder="Enter panchayat name">
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
                                                value="{{ old('building_name', $project->building_name) }}" placeholder="Enter building name">
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
                            <div id="multiple_locations_section" style="display: {{ old('target_location_type', $project->target_location_type) == 'multiple' ? 'block' : 'none' }};">
                                <h6>Multiple Locations</h6>
                                <div id="multiple_locations_wrapper">
                                    @php
                                        $multipleLocations = old('multiple_locations', $project->multiple_locations);
                                    @endphp

                                    @if($multipleLocations && is_array($multipleLocations) && count($multipleLocations) > 0)
                                        @foreach($multipleLocations as $index => $location)
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
                                                            value="{{ $location['state'] ?? '' }}"
                                                            placeholder="State name">
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
                                                            value="{{ $location['taluk'] ?? '' }}"
                                                            placeholder="Taluk name">
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
                                        @foreach(old('multiple_locations') as $index => $location)
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
                                                            value="{{ $location['state'] ?? '' }}"
                                                            placeholder="State name">
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
                                                            value="{{ $location['taluk'] ?? '' }}"
                                                            placeholder="Taluk name">
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
                                        <input class="form-check-input" type="checkbox" name="show_map_preview" value="1"
                                            id="show_map_preview" {{ old('show_map_preview', $project->show_map_preview) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="show_map_preview">
                                            Show Map Preview on Frontend
                                        </label>
                                        <div class="form-text">Enable to display map on the project page</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Strategic Goals, Objective & Impact Alignment -->
                <div class="accordion-item border mb-4">
                    <h2 class="accordion-header" id="headingStrategic">
                        <div class="accordion-button bg-white" data-bs-toggle="collapse"
                            data-bs-target="#strategicSection">
                            <div class="d-flex align-items-center justify-content-between flex-fill">
                                <h5 class="d-flex align-items-center">
                                    <i class="feather feather-target text-primary me-2"></i>
                                    <span>Section 3: Strategic Goals, Objective & Impact Alignment</span>
                                </h5>
                            </div>
                        </div>
                    </h2>
                    <div id="strategicSection" class="accordion-collapse collapse show">
                        <div class="accordion-body border-top">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Problem / Need Statement <span class="text-danger">*</span></label>
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

                                    @if($donutMetrics && is_array($donutMetrics) && count($donutMetrics) > 0)
                                        @foreach($donutMetrics as $index => $metric)
                                            <div class="row mb-2 metric-item">
                                                <div class="col-md-4">
                                                    <input type="text"
                                                        name="donut_metrics[{{ $index }}][label]"
                                                        class="form-control @error('donut_metrics.' . $index . '.label') is-invalid @enderror"
                                                        placeholder="Label (e.g., Youth Interested)"
                                                        value="{{ $metric['label'] ?? '' }}">
                                                    @error('donut_metrics.' . $index . '.label')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="number"
                                                        name="donut_metrics[{{ $index }}][value]"
                                                        class="form-control @error('donut_metrics.' . $index . '.value') is-invalid @enderror"
                                                        placeholder="Value % (e.g., 80)"
                                                        value="{{ $metric['value'] ?? '' }}" min="0"
                                                        max="100" step="1">
                                                    @error('donut_metrics.' . $index . '.value')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text"
                                                        name="donut_metrics[{{ $index }}][notes]"
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
                                        @foreach(old('donut_metrics') as $index => $metric)
                                            <div class="row mb-2 metric-item">
                                                <div class="col-md-4">
                                                    <input type="text"
                                                        name="donut_metrics[{{ $index }}][label]"
                                                        class="form-control @error('donut_metrics.' . $index . '.label') is-invalid @enderror"
                                                        placeholder="Label (e.g., Youth Interested)"
                                                        value="{{ $metric['label'] ?? '' }}">
                                                    @error('donut_metrics.' . $index . '.label')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="number"
                                                        name="donut_metrics[{{ $index }}][value]"
                                                        class="form-control @error('donut_metrics.' . $index . '.value') is-invalid @enderror"
                                                        placeholder="Value % (e.g., 80)"
                                                        value="{{ $metric['value'] ?? '' }}" min="0"
                                                        max="100" step="1">
                                                    @error('donut_metrics.' . $index . '.value')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text"
                                                        name="donut_metrics[{{ $index }}][notes]"
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
                                <div class="form-text">Add metrics for donut chart visualization (e.g., Youth Interested: 80%)</div>
                            </div>

                            <!-- Target Groups -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Target Groups (with icons) <span class="text-danger">*</span></label>
                                        <div id="target_groups_wrapper">
                                            @php
                                                $targetGroups = old('target_groups', $project->target_groups);
                                            @endphp

                                            @if($targetGroups && is_array($targetGroups) && count($targetGroups) > 0)
                                                @foreach($targetGroups as $index => $group)
                                                    <div class="row mb-2 target-group-item">
                                                        <div class="col-md-5">
                                                            <select name="target_groups[{{ $index }}][group]"
                                                                class="form-select select2 @error('target_groups.' . $index . '.group') is-invalid @enderror">
                                                                <option value="">Select Group</option>
                                                                <option value="students" {{ ($group['group'] ?? '') == 'students' ? 'selected' : '' }}>Students</option>
                                                                <option value="youth" {{ ($group['group'] ?? '') == 'youth' ? 'selected' : '' }}>Youth</option>
                                                                <option value="women" {{ ($group['group'] ?? '') == 'women' ? 'selected' : '' }}>Women</option>
                                                                <option value="girls" {{ ($group['group'] ?? '') == 'girls' ? 'selected' : '' }}>Girls</option>
                                                                <option value="children" {{ ($group['group'] ?? '') == 'children' ? 'selected' : '' }}>Children</option>
                                                                <option value="schools" {{ ($group['group'] ?? '') == 'schools' ? 'selected' : '' }}>Schools</option>
                                                                <option value="colleges" {{ ($group['group'] ?? '') == 'colleges' ? 'selected' : '' }}>Colleges</option>
                                                                <option value="shg" {{ ($group['group'] ?? '') == 'shg' ? 'selected' : '' }}>Women SHG</option>
                                                            </select>
                                                            @error('target_groups.' . $index . '.group')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="number"
                                                                name="target_groups[{{ $index }}][count]"
                                                                class="form-control @error('target_groups.' . $index . '.count') is-invalid @enderror"
                                                                placeholder="Count" value="{{ $group['count'] ?? '' }}">
                                                            @error('target_groups.' . $index . '.count')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="text"
                                                                name="target_groups[{{ $index }}][notes]"
                                                                class="form-control"
                                                                placeholder="Notes (e.g., Class 6-12)"
                                                                value="{{ $group['notes'] ?? '' }}">
                                                        </div>
                                                        <div class="col-md-1">
                                                            <button type="button"
                                                                class="btn btn-outline-danger remove-target-group">−</button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @elseif(old('target_groups') && is_array(old('target_groups')))
                                                @foreach(old('target_groups') as $index => $group)
                                                    <div class="row mb-2 target-group-item">
                                                        <div class="col-md-5">
                                                            <select name="target_groups[{{ $index }}][group]"
                                                                class="form-select select2 @error('target_groups.' . $index . '.group') is-invalid @enderror">
                                                                <option value="">Select Group</option>
                                                                <option value="students" {{ ($group['group'] ?? '') == 'students' ? 'selected' : '' }}>Students</option>
                                                                <option value="youth" {{ ($group['group'] ?? '') == 'youth' ? 'selected' : '' }}>Youth</option>
                                                                <option value="women" {{ ($group['group'] ?? '') == 'women' ? 'selected' : '' }}>Women</option>
                                                                <option value="girls" {{ ($group['group'] ?? '') == 'girls' ? 'selected' : '' }}>Girls</option>
                                                                <option value="children" {{ ($group['group'] ?? '') == 'children' ? 'selected' : '' }}>Children</option>
                                                                <option value="schools" {{ ($group['group'] ?? '') == 'schools' ? 'selected' : '' }}>Schools</option>
                                                                <option value="colleges" {{ ($group['group'] ?? '') == 'colleges' ? 'selected' : '' }}>Colleges</option>
                                                                <option value="shg" {{ ($group['group'] ?? '') == 'shg' ? 'selected' : '' }}>Women SHG</option>
                                                            </select>
                                                            @error('target_groups.' . $index . '.group')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="number"
                                                                name="target_groups[{{ $index }}][count]"
                                                                class="form-control @error('target_groups.' . $index . '.count') is-invalid @enderror"
                                                                placeholder="Count" value="{{ $group['count'] ?? '' }}">
                                                            @error('target_groups.' . $index . '.count')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="text"
                                                                name="target_groups[{{ $index }}][notes]"
                                                                class="form-control"
                                                                placeholder="Notes (e.g., Class 6-12)"
                                                                value="{{ $group['notes'] ?? '' }}">
                                                        </div>
                                                        <div class="col-md-1">
                                                            <button type="button"
                                                                class="btn btn-outline-danger remove-target-group">−</button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <button type="button" class="btn btn-sm btn-primary mt-2" id="add_target_group">Add Target Group</button>
                                        <div class="form-text">Add target beneficiary groups with count and notes</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Strategic Objectives -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Strategic Objectives <span class="text-danger">*</span></label>
                                        <div id="objectives_wrapper">
                                            @php
                                                $objectives = old('objectives', $project->objectives);
                                            @endphp

                                            @if($objectives && is_array($objectives) && count($objectives) > 0)
                                                @foreach($objectives as $index => $objective)
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
                                                @foreach(old('objectives') as $index => $objective)
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
                                        <button type="button" class="btn btn-sm btn-primary mt-2" id="add_objective">Add Objective</button>
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
                                        @if($project->impact_image)
                                            <div class="mt-2">
                                                <label class="form-label small">Existing Impact Image:</label>
                                                <div class="position-relative d-inline-block">
                                                    <img src="{{ asset($project->impact_image) }}" alt="Impact" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                                                    <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 p-0" style="width: 20px; height: 20px; font-size: 10px;" onclick="removeImage('impact', '{{ $project->impact_image }}')">×</button>
                                                </div>
                                                <input type="hidden" name="existing_impact_image" value="{{ $project->impact_image }}">
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
                                        <div class="form-text">Select applicable categories (hold Ctrl/Cmd to select multiple)</div>
                                    </div>
                                </div>
                            </div>

                            <!-- SDG Goals (conditional) -->
                            <div id="sdg_section" style="display: {{ in_array('sdg', old('alignment_categories', $project->alignment_categories ?? [])) ? 'block' : 'none' }};">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Sustainable Development Goals (SDGs)</label>
                                            <div class="form-text mb-3">Select multiple SDGs that align with this project. Click to select/unselect.</div>

                                            <!-- Hidden input to store selected SDG IDs -->
                                            <input type="hidden" name="sdg_goals" id="sdg_goals_input"
                                                value="{{ is_array(old('sdg_goals', $project->sdg_goals)) ? implode(',', old('sdg_goals', $project->sdg_goals)) : '' }}">

                                            <!-- SDG Grid Container -->
                                            <div id="sdg_grid"
                                                class="row row-cols-2 row-cols-md-3 row-cols-lg-5 row-cols-xl-6 g-3">
                                                @php
                                                    $sdgs = App\Helpers\SDGHelper::getAllSDGs();
                                                    $selectedSDGs = is_array(old('sdg_goals', $project->sdg_goals)) ? old('sdg_goals', $project->sdg_goals) : [];
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
                                                                            loading="lazy"
                                                                            onerror="handleImageError(this)">

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
                                                                        $sdg = App\Helpers\SDGHelper::getSDGById(
                                                                            $sdgId,
                                                                        );
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
                                            <div class="modal fade" id="sdgPreviewModal" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="previewModalTitle"></h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
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

                    <option value="skill_india_mission"
                        @selected(in_array('skill_india_mission', $govtSchemes ?? []))>
                        Skill India Mission
                    </option>

                    <option value="nsp"
                        @selected(in_array('nsp', $govtSchemes ?? []))>
                        National Skill Development Policy
                    </option>

                    <option value="pmkvy"
                        @selected(in_array('pmkvy', $govtSchemes ?? []))>
                        Pradhan Mantri Kaushal Vikas Yojana
                    </option>

                    <option value="nlm"
                        @selected(in_array('nlm', $govtSchemes ?? []))>
                        National Livelihood Mission
                    </option>

                    <option value="beti_bachao"
                        @selected(in_array('beti_bachao', $govtSchemes ?? []))>
                        Beti Bachao Beti Padhao
                    </option>
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
                                        <label class="form-label">Sustainability Plan <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('sustainability_plan') is-invalid @enderror" name="sustainability_plan"
                                            rows="3" placeholder="Ownership after project completion">{{ old('sustainability_plan', $project->sustainability_plan) }}</textarea>
                                        @error('sustainability_plan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Describe how the project will be sustained after completion</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 4: Ongoing Project Updates (Conditional) -->
                <div class="accordion-item border mb-4" id="section_ongoing" style="{{ in_array($project->stage, ['ongoing', 'completed']) ? '' : 'display:none;' }}">
                    <h2 class="accordion-header" id="headingOngoing">
                        <div class="accordion-button bg-white" data-bs-toggle="collapse"
                            data-bs-target="#ongoingSection">
                            <div class="d-flex align-items-center justify-content-between flex-fill">
                                <h5 class="d-flex align-items-center">
                                    <i class="feather feather-clock text-primary me-2"></i>
                                    <span>Section 4: Ongoing Project Updates & Progress Tracking</span>
                                </h5>
                            </div>
                        </div>
                    </h2>
                    <div id="ongoingSection" class="accordion-collapse collapse show">
                        <div class="accordion-body border-top">
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
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Actual Beneficiary Count <span class="text-danger">*</span></label>
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
                                        <textarea class="form-control @error('compliance_requirement_status') is-invalid @enderror" name="compliance_requirement_status"
                                            rows="2" placeholder="Status of compliance requirements">{{ old('compliance_requirement_status', $project->compliance_requirement_status) }}</textarea>
                                        @error('compliance_requirement_status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Status of compliance requirements</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Solutions & Actions Taken</label>
                                        <textarea class="form-control @error('solutions_actions_taken') is-invalid @enderror" name="solutions_actions_taken"
                                            rows="2" placeholder="Solutions implemented for challenges">{{ old('solutions_actions_taken', $project->solutions_actions_taken) }}</textarea>
                                        @error('solutions_actions_taken')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Solutions implemented for challenges</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="completed_fields_wrapper" style="{{ $project->stage == 'completed' ? '' : 'display:none;' }}">
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
                                        <label class="form-label">Handover & Sustainability Note <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('handover_sustainability_note') is-invalid @enderror" name="handover_sustainability_note"
                                            rows="2" placeholder="Handover details and sustainability plan">{{ old('handover_sustainability_note', $project->handover_sustainability_note) }}</textarea>
                                        @error('handover_sustainability_note')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Details about handover and sustainability</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 5: CSR & Stakeholders Engagement -->
                <div class="accordion-item border mb-4">
                    <h2 class="accordion-header" id="headingCSR">
                        <div class="accordion-button bg-white" data-bs-toggle="collapse"
                            data-bs-target="#csrSection">
                            <div class="d-flex align-items-center justify-content-between flex-fill">
                                <h5 class="d-flex align-items-center">
                                    <i class="feather feather-users text-primary me-2"></i>
                                    <span>Section 5: CSR & Stakeholders Engagement</span>
                                </h5>
                            </div>
                        </div>
                    </h2>
                    <div id="csrSection" class="accordion-collapse collapse show">
                        <div class="accordion-body border-top">
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

                                            @if($stakeholders && is_array($stakeholders) && count($stakeholders) > 0)
                                                @foreach($stakeholders as $index => $stakeholder)
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
                                                @foreach(old('stakeholders') as $index => $stakeholder)
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
                                        <button type="button" class="btn btn-sm btn-primary mt-2"
                                            id="add_stakeholder">Add Stakeholder</button>
                                        <div class="form-text">Add key stakeholders involved in the project</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 6: Resource & Operation Compliance Risks -->
                <div class="accordion-item border mb-4">
                    <h2 class="accordion-header" id="headingResources">
                        <div class="accordion-button bg-white" data-bs-toggle="collapse"
                            data-bs-target="#resourcesSection">
                            <div class="d-flex align-items-center justify-content-between flex-fill">
                                <h5 class="d-flex align-items-center">
                                    <i class="feather feather-shield text-primary me-2"></i>
                                    <span>Section 6: Resource & Operation Compliance Risks</span>
                                </h5>
                            </div>
                        </div>
                    </h2>
                    <div id="resourcesSection" class="accordion-collapse collapse show">
                        <div class="accordion-body border-top">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Resources Needed (Optional)</label>
                                        <textarea class="form-control @error('resources_needed') is-invalid @enderror" name="resources_needed"
                                            rows="3" placeholder="What resources are required (people / equipment / infra)">{{ old('resources_needed', $project->resources_needed) }}</textarea>
                                        @error('resources_needed')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">List of required resources (people, equipment, infrastructure)</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Compliance Requirements (Optional)</label>
                                        <textarea class="form-control @error('compliance_requirements') is-invalid @enderror" name="compliance_requirements"
                                            rows="3" placeholder="CSR Schedule VII / Govt Approval / NEP / NSQF / SHG / Bank process">{{ old('compliance_requirements', $project->compliance_requirements) }}</textarea>
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

                                            @if($risks && is_array($risks) && count($risks) > 0)
                                                @foreach($risks as $index => $risk)
                                                    <div class="border p-3 mb-3 risk-item">
                                                        <div class="row">
                                                            <div class="col-md-4">
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
                                                            <div class="col-md-4">
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
                                                @foreach(old('risks') as $index => $risk)
                                                    <div class="border p-3 mb-3 risk-item">
                                                        <div class="row">
                                                            <div class="col-md-4">
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
                                                            <div class="col-md-4">
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
                                        <div class="form-text">Add operational risks with mitigation strategies and responsible persons</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 7: Media and Documents -->
                <div class="accordion-item border mb-4">
                    <h2 class="accordion-header" id="headingMedia">
                        <div class="accordion-button bg-white" data-bs-toggle="collapse"
                            data-bs-target="#mediaSection">
                            <div class="d-flex align-items-center justify-content-between flex-fill">
                                <h5 class="d-flex align-items-center">
                                    <i class="feather feather-file-text text-primary me-2"></i>
                                    <span>Section 7: Media and Documents</span>
                                </h5>
                            </div>
                        </div>
                    </h2>
                    <div id="mediaSection" class="accordion-collapse collapse show">
                        <div class="accordion-body border-top">
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
                                    @if(!empty($project->gallery_images))
                                    <div class="mt-2">
                                        <label class="form-label small">Existing Gallery Images:</label>

                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach($project->gallery_images as $galleryImage)
                                                <div class="position-relative" style="width: 80px;">
                                                    <img src="{{ asset($galleryImage) }}"
                                                        class="img-thumbnail"
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

                                        <input type="hidden"
                                            name="existing_gallery"
                                            value="{{ json_encode($project->gallery_images) }}">
                                    </div>
                                    @else
                                    <div class="text-muted small">No gallery images uploaded yet</div>
                                    @endif

                                        <div class="form-text">Upload real photos of project implementation - Max 5 images, 5MB each</div>
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
                                                @if($project->before_photo)
                                                    <div class="mt-2">
                                                        <label class="form-label small">Existing Before Photo:</label>
                                                        <div class="position-relative d-inline-block">
                                                            <img src="{{ asset($project->before_photo) }}" alt="Before" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                                                            <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 p-0" style="width: 20px; height: 20px; font-size: 10px;" onclick="removeImage('before', '{{ $project->before_photo }}')">×</button>
                                                        </div>
                                                        <input type="hidden" name="existing_before_photo" value="{{ $project->before_photo }}">
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
                                                @if($project->expected_photo)
                                                    <div class="mt-2">
                                                        <label class="form-label small">Existing Expected Photo:</label>
                                                        <div class="position-relative d-inline-block">
                                                            <img src="{{ asset($project->expected_photo) }}" alt="Expected" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                                                            <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 p-0" style="width: 20px; height: 20px; font-size: 10px;" onclick="removeImage('expected', '{{ $project->expected_photo }}')">×</button>
                                                        </div>
                                                        <input type="hidden" name="existing_expected_photo" value="{{ $project->expected_photo }}">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-text">Upload before photo (real) and expected outcome photo (AI generated)</div>
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

                                            @if($documents && is_array($documents) && count($documents) > 0)
                                                @foreach($documents as $index => $document)
                                                    <div class="row mb-2 document-item">
                                                        <div class="col-md-5">
                                                            <input type="text"
                                                                name="documents[{{ $index }}][label]"
                                                                class="form-control @error('documents.' . $index . '.label') is-invalid @enderror"
                                                                placeholder="Document Label (e.g., Approval Letter)"
                                                                value="{{ $document['label'] ?? '' }}">
                                                            @error('documents.' . $index . '.label')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="file"
                                                                name="documents[{{ $index }}][file]"
                                                                class="form-control @error('documents.' . $index . '.file') is-invalid @enderror"
                                                                accept=".pdf,.doc,.docx">
                                                            @error('documents.' . $index . '.file')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror

                                                            <!-- Existing Document Link -->
                                                            @if(isset($document['file']))
                                                                <small class="text-muted d-block">
                                                                    <a href="{{ Storage::url($document['file']) }}" target="_blank" class="text-decoration-none">
                                                                        <i class="feather feather-file me-1"></i>View existing document
                                                                    </a>
                                                                </small>
                                                                <input type="hidden" name="existing_documents[{{ $index }}][file]" value="{{ $document['file'] }}">
                                                                <input type="hidden" name="existing_documents[{{ $index }}][label]" value="{{ $document['label'] ?? '' }}">
                                                                <input type="hidden" name="existing_documents[{{ $index }}][notes]" value="{{ $document['notes'] ?? '' }}">
                                                            @endif
                                                        </div>
                                                        <div class="col-md-2">
                                                            <button type="button"
                                                                class="btn btn-outline-danger remove-document">−</button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @elseif(old('documents') && is_array(old('documents')))
                                                @foreach(old('documents') as $index => $document)
                                                    <div class="row mb-2 document-item">
                                                        <div class="col-md-5">
                                                            <input type="text"
                                                                name="documents[{{ $index }}][label]"
                                                                class="form-control @error('documents.' . $index . '.label') is-invalid @enderror"
                                                                placeholder="Document Label (e.g., Approval Letter)"
                                                                value="{{ $document['label'] ?? '' }}">
                                                            @error('documents.' . $index . '.label')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="file"
                                                                name="documents[{{ $index }}][file]"
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
                                        <div class="form-text">Add supporting documents like approval letters, NOC, survey reports, quotations</div>
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

                                            @if($links && is_array($links) && count($links) > 0)
                                                @foreach($links as $index => $link)
                                                    <div class="row mb-2">
                                                        <div class="col-md-5">
                                                            <input type="text"
                                                                name="links[{{ $index }}][label]"
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
                                                @foreach(old('links') as $index => $link)
                                                    <div class="row mb-2">
                                                        <div class="col-md-5">
                                                            <input type="text"
                                                                name="links[{{ $index }}][label]"
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
                                        <div class="form-text">Add press coverage, YouTube videos, social media links, live survey links</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Section -->
                <div class="col-lg-12">
                    <div class="d-flex align-items-center justify-content-end mb-4">
                        <a href="{{ route('admin.project.index') }}" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Project</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('css')
    <style>
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

            // Reinitialize on accordion expand
            $('.accordion-collapse').off('shown.bs.collapse').on('shown.bs.collapse', function() {
                if ($(this).attr('id') === 'sdg_section') {
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
            $('#target_location_type').on('change', function() {
                let type = $(this).val();
                $('#single_location_section').toggle(type === 'single');
                $('#multiple_locations_section').toggle(type === 'multiple');
            });

            // Alignment categories toggle (redundant handled above)

            // Add/remove dynamic fields counters
            let locationCounter = {{ is_array(old('multiple_locations', $project->multiple_locations)) ? count(old('multiple_locations', $project->multiple_locations)) : 0 }};
            let metricCounter = {{ is_array(old('donut_metrics', $project->donut_metrics)) ? count(old('donut_metrics', $project->donut_metrics)) : 0 }};
            let targetGroupCounter = {{ is_array(old('target_groups', $project->target_groups)) ? count(old('target_groups', $project->target_groups)) : 0 }};
            let objectiveCounter = {{ is_array(old('objectives', $project->objectives)) ? count(old('objectives', $project->objectives)) : 0 }};
            let stakeholderCounter = {{ is_array(old('stakeholders', $project->stakeholders)) ? count(old('stakeholders', $project->stakeholders)) : 0 }};
            let riskCounter = {{ is_array(old('risks', $project->risks)) ? count(old('risks', $project->risks)) : 0 }};
            let documentCounter = {{ is_array(old('documents', $project->documents)) ? count(old('documents', $project->documents)) : 0 }};
            let linkCounter = {{ is_array(old('links', $project->links)) ? count(old('links', $project->links)) : 0 }};

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

            // Add target group
            $('#add_target_group').on('click', function() {
                let html = `
                <div class="row mb-2 target-group-item">
                    <div class="col-md-5">
                        <select name="target_groups[${targetGroupCounter}][group]" class="form-select select2">
                            <option value="">Select Group</option>
                            <option value="students">Students</option>
                            <option value="youth">Youth</option>
                            <option value="women">Women</option>
                            <option value="girls">Girls</option>
                            <option value="children">Children</option>
                            <option value="schools">Schools</option>
                            <option value="colleges">Colleges</option>
                            <option value="shg">Women SHG</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="target_groups[${targetGroupCounter}][count]"
                            class="form-control" placeholder="Count">
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="target_groups[${targetGroupCounter}][notes]"
                            class="form-control" placeholder="Notes (e.g., Class 6-12)">
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-outline-danger remove-target-group">−</button>
                    </div>
                </div>`;
                $('#target_groups_wrapper').append(html);
                // Re-initialize Select2 for new dropdown
                $('#target_groups_wrapper .select2:last').select2({
                    placeholder: "Select Group",
                    allowClear: true,
                    width: '100%'
                });
                targetGroupCounter++;
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
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Risk</label>
                                <input type="text" name="risks[${riskCounter}][risk]"
                                    class="form-control" placeholder="e.g., Funding delay">
                            </div>
                        </div>
                        <div class="col-md-4">
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

            $(document).on('click', '.remove-target-group', function() {
                $(this).closest('.target-group-item').remove();
            });

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

            // Auto-show sections that have validation errors
            $('.is-invalid').each(function() {
                let section = $(this).closest('.accordion-collapse');
                if (section.length) {
                    section.collapse('show');
                }
            });
            // Stage change listener
            $('select[name="stage"]').on('change', function() {
                var stage = $(this).val();

                // Toggle Ongoing Section (Dashboard section)
                if (stage === 'ongoing' || stage === 'completed') {
                    $('#section_ongoing').slideDown();
                    $('#actual_dates_section').slideDown();
                } else {
                    $('#section_ongoing').slideUp();
                    $('#actual_dates_section').slideUp();
                }

                // Toggle Completed Fields
                if (stage === 'completed') {
                    $('#completed_fields_wrapper').slideDown();
                    $('#actual_end_date_wrapper').slideDown();
                } else {
                    $('#completed_fields_wrapper').slideUp();
                    $('#actual_end_date_wrapper').slideUp();
                }
            });

        });
    </script>
@endpush
