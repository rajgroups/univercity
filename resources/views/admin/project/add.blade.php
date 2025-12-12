@extends('layouts.admin.app')
@section('content')
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Create Project</h4>
                <h6>Create new Project - Starts in Upcoming Stage</h6>
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

    <form action="{{ route('admin.project.store') }}" method="POST" enctype="multipart/form-data" class="add-product-form" id="projectForm">
        @csrf

        {{-- Hidden field to set initial stage as upcoming --}}
        <input type="hidden" name="stage" value="upcoming">

        <div class="add-product">
            <div class="accordions-items-seperate" id="accordionSpacingExample">

                <!-- Section 0: Project Stage Indicator -->
                <div class="accordion-item border mb-4">
                    <h2 class="accordion-header" id="headingStage">
                        <div class="accordion-button collapsed bg-white" data-bs-toggle="collapse"
                            data-bs-target="#stageSection">
                            <div class="d-flex align-items-center justify-content-between flex-fill">
                                <h5 class="d-flex align-items-center">
                                    <i class="feather feather-layers text-primary me-2"></i>
                                    <span>Project Stage: <span class="badge bg-warning text-dark">Upcoming
                                            (Planning)</span></span>
                                </h5>
                            </div>
                        </div>
                    </h2>
                    <div id="stageSection" class="accordion-collapse collapse show">
                        <div class="accordion-body border-top">
                            <div class="alert alert-info">
                                <i class="feather feather-info me-2"></i>
                                <strong>Note:</strong> All projects start in "Upcoming" stage. You can update the stage to
                                "Ongoing" or "Completed" later with additional details.
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Project ID <span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('project_code') is-invalid @enderror"
                                            name="project_code" value="{{ old('project_code', $project_code ?? '') }}"
                                            placeholder="Auto-generated" readonly>
                                        <div class="form-text">Format: ISICO-YYYY-LOC-SEQ</div>
                                        @error('project_code')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Project Location Type <span class="text-danger">*</span></label>
                                        <select name="location_type"
                                            class="form-select select2 @error('location_type') is-invalid @enderror">
                                            <option value="">Select Location Type</option>
                                            <option value="RUR" {{ old('location_type') == 'RUR' ? 'selected' : '' }}>Rural (RUR)</option>
                                            <option value="URB" {{ old('location_type') == 'URB' ? 'selected' : '' }}>Urban (URB)</option>
                                            <option value="MET" {{ old('location_type') == 'MET' ? 'selected' : '' }}>Metro (MET)</option>
                                            <option value="MIX" {{ old('location_type') == 'MIX' ? 'selected' : '' }}>Other - Mixed (MIX)</option>
                                        </select>
                                        <div class="form-text">Format: DATE + Project Location Type</div>
                                        @error('location_type')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 1: Basic Project Details -->
                <div class="accordion-item border mb-4">
                    <h2 class="accordion-header" id="headingBasic">
                        <div class="accordion-button collapsed bg-white" data-bs-toggle="collapse"
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
                                            name="title" value="{{ old('title') }}" placeholder="Enter Official Project Title">
                                        <div class="form-text">Enter the official name of the project</div>
                                        @error('title')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Sub Title</label>
                                        <input type="text" class="form-control @error('subtitle') is-invalid @enderror"
                                            name="subtitle" value="{{ old('subtitle') }}" placeholder="Tagline or project vision one line">
                                        <div class="form-text">Optional: A short tagline or vision statement</div>
                                        @error('subtitle')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Slug <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                            name="slug" value="{{ old('slug') }}" placeholder="Auto-generated from title">
                                        <div class="form-text">URL-friendly version of project title</div>
                                        @error('slug')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Category <span class="text-danger">*</span></label>
                                        <select name="category_id"
                                            class="form-select select2 @error('category_id') is-invalid @enderror">
                                            <option value="">Select Category</option>
                                            @if(isset($categories) && $categories->count())
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            @else
                                                <option value="education" {{ old('category_id') == 'education' ? 'selected' : '' }}>Education</option>
                                                <option value="shg" {{ old('category_id') == 'shg' ? 'selected' : '' }}>SHG</option>
                                                <option value="youth" {{ old('category_id') == 'youth' ? 'selected' : '' }}>Youth</option>
                                                <option value="skill" {{ old('category_id') == 'skill' ? 'selected' : '' }}>Skill</option>
                                            @endif
                                        </select>
                                        <div class="form-text">Select the primary category for this project</div>
                                        @error('category_id')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Short Description -->
                            <div class="mb-3">
                                <label for="short_description" class="form-label">Short Description <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('short_description') is-invalid @enderror" name="short_description"
                                    id="short_description" rows="3" placeholder="Scope of Project / Outline of Intention (2-3 lines)">{{ old('short_description') }}</textarea>
                                <div class="form-text">Brief summary of project scope and intention (2-3 lines)</div>
                                @error('short_description')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Full Description -->
                            <div class="mb-3">
                                <label class="form-label">Detailed Description <span class="text-danger">*</span></label>
                                <textarea name="description" id="summernote" class="form-control @error('description') is-invalid @enderror"
                                    rows="6" placeholder="Detailed Overview of Project / full narrative purpose of project">{{ old('description') }}</textarea>
                                <div class="form-text">Complete narrative describing project purpose and details</div>
                                @error('description')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Banner Images <span class="text-danger">*</span></label>
                                        <input type="file"
                                            class="form-control @error('banner_images') is-invalid @enderror"
                                            name="banner_images[]" accept="image/*" multiple>
                                        <div class="form-text">Upload multiple real images of project area (schools, villages, etc.) - Max 5MB each</div>
                                        @error('banner_images')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        @error('banner_images.*')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Thumbnail Image <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control @error('thumbnail_image') is-invalid @enderror"
                                            name="thumbnail_image" accept="image/*">
                                        <div class="form-text">Main thumbnail image for project listing - Max 5MB</div>
                                        @error('thumbnail_image')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Upcoming Project Fields -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Planned Start Date <span class="text-danger">*</span></label>
                                        <input type="date"
                                            class="form-control @error('planned_start_date') is-invalid @enderror"
                                            name="planned_start_date" value="{{ old('planned_start_date') }}">
                                        <div class="form-text">Tentative start date for the project</div>
                                        @error('planned_start_date')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Planned End Date</label>
                                        <input type="date"
                                            class="form-control @error('planned_end_date') is-invalid @enderror"
                                            name="planned_end_date" value="{{ old('planned_end_date') }}">
                                        <div class="form-text">Tentative completion date (optional)</div>
                                        @error('planned_end_date')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Auto Duration (days)</label>
                                        <input type="text" class="form-control" id="auto_duration" readonly placeholder="Will calculate automatically">
                                        <div class="form-text">Calculated based on start and end dates</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Target Location Details -->
                <div class="accordion-item border mb-4">
                    <h2 class="accordion-header" id="headingLocation">
                        <div class="accordion-button collapsed bg-white" data-bs-toggle="collapse"
                            data-bs-target="#locationSection">
                            <div class="d-flex align-items-center justify-content-between flex-fill">
                                <h5 class="d-flex align-items-center">
                                    <i class="feather feather-map-pin text-primary me-2"></i>
                                    <span>Section 2: Target Location Details</span>
                                </h5>
                            </div>
                        </div>
                    </h2>
                    <div id="locationSection" class="accordion-collapse collapse">
                        <div class="accordion-body border-top">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Location Type <span class="text-danger">*</span></label>
                                        <select name="target_location_type" id="target_location_type"
                                            class="form-select select2 @error('target_location_type') is-invalid @enderror">
                                            <option value="">Select Type</option>
                                            <option value="single" {{ old('target_location_type') == 'single' ? 'selected' : '' }}>Single Location</option>
                                            <option value="multiple" {{ old('target_location_type') == 'multiple' ? 'selected' : '' }}>Multiple Locations</option>
                                        </select>
                                        <div class="form-text">Select whether project has single or multiple locations</div>
                                        @error('target_location_type')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Single Location -->
                            <div id="single_location_section" style="display: {{ old('target_location_type') == 'single' ? 'block' : 'none' }};">
                                <h6>Single Location Details</h6>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Pin Code</label>
                                            <input type="text" name="pincode"
                                                class="form-control @error('pincode') is-invalid @enderror"
                                                value="{{ old('pincode') }}" placeholder="Enter 6-digit PIN code">
                                            @error('pincode')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">State</label>
                                            <input type="text" name="state"
                                                class="form-control @error('state') is-invalid @enderror"
                                                value="{{ old('state') }}" placeholder="Enter state name">
                                            @error('state')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">District</label>
                                            <input type="text" name="district"
                                                class="form-control @error('district') is-invalid @enderror"
                                                value="{{ old('district') }}" placeholder="Enter district name">
                                            @error('district')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Taluk</label>
                                            <input type="text" name="taluk"
                                                class="form-control @error('taluk') is-invalid @enderror"
                                                value="{{ old('taluk') }}" placeholder="Enter taluk name">
                                            @error('taluk')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
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
                                                value="{{ old('panchayat') }}" placeholder="Enter panchayat name">
                                            @error('panchayat')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Building Name</label>
                                            <input type="text" name="building_name"
                                                class="form-control @error('building_name') is-invalid @enderror"
                                                value="{{ old('building_name') }}" placeholder="Enter building name">
                                            @error('building_name')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
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
                                                value="{{ old('gps_coordinates') }}" placeholder="e.g., 12.3456, 78.9012">
                                            <div class="form-text">Optional: Enter latitude, longitude coordinates</div>
                                            @error('gps_coordinates')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Multiple Locations -->
                            <div id="multiple_locations_section" style="display: {{ old('target_location_type') == 'multiple' ? 'block' : 'none' }};">
                                <h6>Multiple Locations</h6>
                                <div id="multiple_locations_wrapper">
                                    @if(old('multiple_locations') && is_array(old('multiple_locations')))
                                        @foreach(old('multiple_locations') as $index => $location)
                                            <div class="location-group mb-3 border p-3">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Pin Code</label>
                                                        <input type="text" name="multiple_locations[{{ $index }}][pincode]"
                                                            class="form-control @error('multiple_locations.' . $index . '.pincode') is-invalid @enderror"
                                                            value="{{ $location['pincode'] ?? '' }}" placeholder="6-digit PIN">
                                                        @error('multiple_locations.' . $index . '.pincode')
                                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">State</label>
                                                        <input type="text" name="multiple_locations[{{ $index }}][state]"
                                                            class="form-control @error('multiple_locations.' . $index . '.state') is-invalid @enderror"
                                                            value="{{ $location['state'] ?? '' }}" placeholder="State name">
                                                        @error('multiple_locations.' . $index . '.state')
                                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">District</label>
                                                        <input type="text" name="multiple_locations[{{ $index }}][district]"
                                                            class="form-control @error('multiple_locations.' . $index . '.district') is-invalid @enderror"
                                                            value="{{ $location['district'] ?? '' }}" placeholder="District name">
                                                        @error('multiple_locations.' . $index . '.district')
                                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Taluk</label>
                                                        <input type="text" name="multiple_locations[{{ $index }}][taluk]"
                                                            class="form-control @error('multiple_locations.' . $index . '.taluk') is-invalid @enderror"
                                                            value="{{ $location['taluk'] ?? '' }}" placeholder="Taluk name">
                                                        @error('multiple_locations.' . $index . '.taluk')
                                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Panchayat</label>
                                                        <input type="text" name="multiple_locations[{{ $index }}][panchayat]"
                                                            class="form-control @error('multiple_locations.' . $index . '.panchayat') is-invalid @enderror"
                                                            value="{{ $location['panchayat'] ?? '' }}" placeholder="Panchayat name">
                                                        @error('multiple_locations.' . $index . '.panchayat')
                                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">Building Name</label>
                                                        <input type="text" name="multiple_locations[{{ $index }}][building_name]"
                                                            class="form-control @error('multiple_locations.' . $index . '.building_name') is-invalid @enderror"
                                                            value="{{ $location['building_name'] ?? '' }}" placeholder="Building name">
                                                        @error('multiple_locations.' . $index . '.building_name')
                                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-sm btn-danger mt-2 remove-location">Remove</button>
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
                                            rows="2" placeholder="e.g., We covered 10 schools across the Sivagangai district">{{ old('location_summary') }}</textarea>
                                        <div class="form-text">Brief summary of geographical coverage</div>
                                        @error('location_summary')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3 form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="show_map_preview"
                                            id="show_map_preview" {{ old('show_map_preview') ? 'checked' : '' }}>
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
                        <div class="accordion-button collapsed bg-white" data-bs-toggle="collapse"
                            data-bs-target="#strategicSection">
                            <div class="d-flex align-items-center justify-content-between flex-fill">
                                <h5 class="d-flex align-items-center">
                                    <i class="feather feather-target text-primary me-2"></i>
                                    <span>Section 3: Strategic Goals, Objective & Impact Alignment</span>
                                </h5>
                            </div>
                        </div>
                    </h2>
                    <div id="strategicSection" class="accordion-collapse collapse">
                        <div class="accordion-body border-top">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Problem / Need Statement <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('problem_statement') is-invalid @enderror" name="problem_statement"
                                            rows="3" placeholder="Describe the problem or need this project addresses">{{ old('problem_statement') }}</textarea>
                                        <div class="form-text">Clear statement of the problem or need being addressed</div>
                                        @error('problem_statement')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Baseline Survey - Metrics & Report</label>
                                        <textarea class="form-control @error('baseline_survey') is-invalid @enderror" name="baseline_survey"
                                            rows="3" placeholder="Summary of baseline survey findings">{{ old('baseline_survey') }}</textarea>
                                        <div class="form-text">Summary of initial survey or assessment findings</div>
                                        @error('baseline_survey')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Donut Chart Metrics -->
                            <div class="mb-3">
                                <label class="form-label">Donut Chart Metrics (Optional)</label>
                                <div id="donut_metrics_wrapper">
                                    @if(old('donut_metrics') && is_array(old('donut_metrics')))
                                        @foreach(old('donut_metrics') as $index => $metric)
                                            <div class="row mb-2 metric-item">
                                                <div class="col-md-4">
                                                    <input type="text" name="donut_metrics[{{ $index }}][label]"
                                                        class="form-control @error('donut_metrics.' . $index . '.label') is-invalid @enderror"
                                                        placeholder="Label (e.g., Youth Interested)"
                                                        value="{{ $metric['label'] ?? '' }}">
                                                    @error('donut_metrics.' . $index . '.label')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="number" name="donut_metrics[{{ $index }}][value]"
                                                        class="form-control @error('donut_metrics.' . $index . '.value') is-invalid @enderror"
                                                        placeholder="Value % (e.g., 80)"
                                                        value="{{ $metric['value'] ?? '' }}" min="0" max="100" step="1">
                                                    @error('donut_metrics.' . $index . '.value')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" name="donut_metrics[{{ $index }}][notes]"
                                                        class="form-control" placeholder="Small Notes (optional)"
                                                        value="{{ $metric['notes'] ?? '' }}">
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="button" class="btn btn-outline-danger remove-metric">−</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <button type="button" class="btn btn-sm btn-primary mt-2" id="add_metric">Add Metric</button>
                                <div class="form-text">Add metrics for donut chart visualization (e.g., Youth Interested: 80%)</div>
                            </div>

                            <!-- Target Groups -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Target Groups (with icons) <span class="text-danger">*</span></label>
                                        <div id="target_groups_wrapper">
                                            @if(old('target_groups') && is_array(old('target_groups')))
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
                                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="number" name="target_groups[{{ $index }}][count]"
                                                                class="form-control @error('target_groups.' . $index . '.count') is-invalid @enderror"
                                                                placeholder="Count"
                                                                value="{{ $group['count'] ?? '' }}">
                                                            @error('target_groups.' . $index . '.count')
                                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="text" name="target_groups[{{ $index }}][notes]"
                                                                class="form-control" placeholder="Notes (e.g., Class 6-12)"
                                                                value="{{ $group['notes'] ?? '' }}">
                                                        </div>
                                                        <div class="col-md-1">
                                                            <button type="button" class="btn btn-outline-danger remove-target-group">−</button>
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
                                            @if(old('objectives') && is_array(old('objectives')))
                                                @foreach(old('objectives') as $index => $objective)
                                                    <div class="input-group mb-2">
                                                        <input type="text" name="objectives[]"
                                                            class="form-control @error('objectives.' . $index) is-invalid @enderror"
                                                            placeholder="Enter strategic objective"
                                                            value="{{ $objective }}">
                                                        @error('objectives.' . $index)
                                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                                        @enderror
                                                        <button type="button" class="btn btn-outline-danger remove-objective">−</button>
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
                                            rows="4" placeholder="Transformation expected after implementation">{{ old('expected_outcomes') }}</textarea>
                                        <div class="form-text">Describe the expected transformation and impact</div>
                                        @error('expected_outcomes')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Expected Impact Image (Optional)</label>
                                        <input type="file" class="form-control @error('impact_image') is-invalid @enderror"
                                            name="impact_image" accept="image/*">
                                        <div class="form-text">AI generated image showing expected outcomes - Max 5MB</div>
                                        @error('impact_image')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Scalability Notes (Optional)</label>
                                        <textarea class="form-control @error('scalability_notes') is-invalid @enderror" name="scalability_notes"
                                            rows="2" placeholder="Notes on repeatability in other regions">{{ old('scalability_notes') }}</textarea>
                                        <div class="form-text">Notes on potential for replication in other regions</div>
                                        @error('scalability_notes')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Alignment Categories -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Alignment Categories <span class="text-danger">*</span></label>
                                        <select name="alignment_categories[]" class="form-select select2-multiple @error('alignment_categories') is-invalid @enderror" multiple>
                                            <option value="sdg" {{ in_array('sdg', old('alignment_categories', [])) ? 'selected' : '' }}>SDG Goals</option>
                                            <option value="nep2020" {{ in_array('nep2020', old('alignment_categories', [])) ? 'selected' : '' }}>NEP 2020</option>
                                            <option value="skill_india" {{ in_array('skill_india', old('alignment_categories', [])) ? 'selected' : '' }}>Skill India</option>
                                            <option value="nsqf" {{ in_array('nsqf', old('alignment_categories', [])) ? 'selected' : '' }}>NSQF</option>
                                            <option value="govt_schemes" {{ in_array('govt_schemes', old('alignment_categories', [])) ? 'selected' : '' }}>Govt Schemes</option>
                                            <option value="csr_schedule_vii" {{ in_array('csr_schedule_vii', old('alignment_categories', [])) ? 'selected' : '' }}>CSR Schedule VII</option>
                                        </select>
                                        <div class="form-text">Select applicable categories (hold Ctrl/Cmd to select multiple)</div>
                                        @error('alignment_categories')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- SDG Goals (conditional) -->
                            <div id="sdg_section" style="display: {{ in_array('sdg', old('alignment_categories', [])) ? 'block' : 'none' }};">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">SDG Goals</label>
                                            <select name="sdg_goals[]" class="form-select select2-multiple @error('sdg_goals') is-invalid @enderror" multiple>
                                                @for($i = 1; $i <= 17; $i++)
                                                    <option value="{{ $i }}" {{ in_array($i, old('sdg_goals', [])) ? 'selected' : '' }}>SDG {{ $i }}</option>
                                                @endfor
                                            </select>
                                            <div class="form-text">Select SDG goals aligned with this project</div>
                                            @error('sdg_goals')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Govt Schemes (conditional) -->
                            <div id="govt_schemes_section" style="display: {{ in_array('govt_schemes', old('alignment_categories', [])) ? 'block' : 'none' }};">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Government Schemes / Policies</label>
                                            <select name="govt_schemes[]" class="form-select select2-multiple @error('govt_schemes') is-invalid @enderror" multiple>
                                                <option value="skill_india_mission" {{ in_array('skill_india_mission', old('govt_schemes', [])) ? 'selected' : '' }}>Skill India Mission</option>
                                                <option value="nsp" {{ in_array('nsp', old('govt_schemes', [])) ? 'selected' : '' }}>National Skill Development Policy</option>
                                                <option value="pmkvy" {{ in_array('pmkvy', old('govt_schemes', [])) ? 'selected' : '' }}>Pradhan Mantri Kaushal Vikas Yojana</option>
                                                <option value="nlm" {{ in_array('nlm', old('govt_schemes', [])) ? 'selected' : '' }}>National Livelihood Mission</option>
                                                <option value="beti_bachao" {{ in_array('beti_bachao', old('govt_schemes', [])) ? 'selected' : '' }}>Beti Bachao Beti Padhao</option>
                                            </select>
                                            <div class="form-text">Select government schemes aligned with this project</div>
                                            @error('govt_schemes')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Alignment Notes (Optional)</label>
                                        <textarea class="form-control @error('alignment_notes') is-invalid @enderror" name="alignment_notes"
                                            rows="2" placeholder="Short summary of alignment (e.g., Aligned with NEP 2020 vocational exposure for Class 6-12)">{{ old('alignment_notes') }}</textarea>
                                        <div class="form-text">Additional notes about alignment with selected categories</div>
                                        @error('alignment_notes')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Sustainability Plan <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('sustainability_plan') is-invalid @enderror" name="sustainability_plan"
                                            rows="3" placeholder="Ownership after project completion">{{ old('sustainability_plan') }}</textarea>
                                        <div class="form-text">Describe how the project will be sustained after completion</div>
                                        @error('sustainability_plan')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 5: CSR & Stakeholders Engagement -->
                <div class="accordion-item border mb-4">
                    <h2 class="accordion-header" id="headingCSR">
                        <div class="accordion-button collapsed bg-white" data-bs-toggle="collapse"
                            data-bs-target="#csrSection">
                            <div class="d-flex align-items-center justify-content-between flex-fill">
                                <h5 class="d-flex align-items-center">
                                    <i class="feather feather-users text-primary me-2"></i>
                                    <span>Section 5: CSR & Stakeholders Engagement (Expectations)</span>
                                </h5>
                            </div>
                        </div>
                    </h2>
                    <div id="csrSection" class="accordion-collapse collapse">
                        <div class="accordion-body border-top">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">CSR Invitation <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('csr_invitation') is-invalid @enderror" name="csr_invitation"
                                            rows="4" placeholder="e.g., We seek funding from CSR...">{{ old('csr_invitation') }}</textarea>
                                        <div class="form-text">Message inviting CSR partners to support this project</div>
                                        @error('csr_invitation')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">CTA Button Text</label>
                                        <input type="text" class="form-control @error('cta_button_text') is-invalid @enderror"
                                            name="cta_button_text" value="{{ old('cta_button_text', 'Register Your Interest') }}"
                                            placeholder="Text for CTA button">
                                        <div class="form-text">Text for the call-to-action button</div>
                                        @error('cta_button_text')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Stakeholders -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Stakeholders (Optional)</label>
                                        <div id="stakeholders_wrapper">
                                            @if(old('stakeholders') && is_array(old('stakeholders')))
                                                @foreach(old('stakeholders') as $index => $stakeholder)
                                                    <div class="row mb-2 stakeholder-item">
                                                        <div class="col-md-5">
                                                            <input type="text" name="stakeholders[{{ $index }}][name]"
                                                                class="form-control @error('stakeholders.' . $index . '.name') is-invalid @enderror"
                                                                placeholder="Stakeholder Name"
                                                                value="{{ $stakeholder['name'] ?? '' }}">
                                                            @error('stakeholders.' . $index . '.name')
                                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="text" name="stakeholders[{{ $index }}][role]"
                                                                class="form-control" placeholder="Role/Contribution"
                                                                value="{{ $stakeholder['role'] ?? '' }}">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <button type="button" class="btn btn-outline-danger remove-stakeholder">−</button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <button type="button" class="btn btn-sm btn-primary mt-2" id="add_stakeholder">Add Stakeholder</button>
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
                        <div class="accordion-button collapsed bg-white" data-bs-toggle="collapse"
                            data-bs-target="#resourcesSection">
                            <div class="d-flex align-items-center justify-content-between flex-fill">
                                <h5 class="d-flex align-items-center">
                                    <i class="feather feather-shield text-primary me-2"></i>
                                    <span>Section 6: Resource & Operation Compliance Risks</span>
                                </h5>
                            </div>
                        </div>
                    </h2>
                    <div id="resourcesSection" class="accordion-collapse collapse">
                        <div class="accordion-body border-top">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Resources Needed (Optional)</label>
                                        <textarea class="form-control @error('resources_needed') is-invalid @enderror" name="resources_needed"
                                            rows="3" placeholder="What resources are required (people / equipment / infra)">{{ old('resources_needed') }}</textarea>
                                        <div class="form-text">List of required resources (people, equipment, infrastructure)</div>
                                        @error('resources_needed')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Compliance Requirements (Optional)</label>
                                        <textarea class="form-control @error('compliance_requirements') is-invalid @enderror" name="compliance_requirements"
                                            rows="3" placeholder="CSR Schedule VII / Govt Approval / NEP / NSQF / SHG / Bank process">{{ old('compliance_requirements') }}</textarea>
                                        <div class="form-text">Compliance requirements for this project</div>
                                        @error('compliance_requirements')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Operational Risks -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Operational Risks & Ownership (Optional)</label>
                                        <div id="risks_wrapper">
                                            @if(old('risks') && is_array(old('risks')))
                                                @foreach(old('risks') as $index => $risk)
                                                    <div class="border p-3 mb-3 risk-item">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Risk</label>
                                                                    <input type="text" name="risks[{{ $index }}][risk]"
                                                                        class="form-control @error('risks.' . $index . '.risk') is-invalid @enderror"
                                                                        placeholder="e.g., Funding delay"
                                                                        value="{{ $risk['risk'] ?? '' }}">
                                                                    @error('risks.' . $index . '.risk')
                                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Mitigation</label>
                                                                    <input type="text" name="risks[{{ $index }}][mitigation]"
                                                                        class="form-control @error('risks.' . $index . '.mitigation') is-invalid @enderror"
                                                                        placeholder="e.g., Alternate CSR partner"
                                                                        value="{{ $risk['mitigation'] ?? '' }}">
                                                                    @error('risks.' . $index . '.mitigation')
                                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Responsible Person</label>
                                                                    <input type="text" name="risks[{{ $index }}][responsible]"
                                                                        class="form-control @error('risks.' . $index . '.responsible') is-invalid @enderror"
                                                                        placeholder="e.g., Project Manager"
                                                                        value="{{ $risk['responsible'] ?? '' }}">
                                                                    @error('risks.' . $index . '.responsible')
                                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <button type="button" class="btn btn-outline-danger remove-risk">−</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <button type="button" class="btn btn-sm btn-primary mt-2" id="add_risk">Add Risk</button>
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
                        <div class="accordion-button collapsed bg-white" data-bs-toggle="collapse"
                            data-bs-target="#mediaSection">
                            <div class="d-flex align-items-center justify-content-between flex-fill">
                                <h5 class="d-flex align-items-center">
                                    <i class="feather feather-file-text text-primary me-2"></i>
                                    <span>Section 7: Media and Documents</span>
                                </h5>
                            </div>
                        </div>
                    </h2>
                    <div id="mediaSection" class="accordion-collapse collapse">
                        <div class="accordion-body border-top">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Gallery Images</label>
                                        <input type="file" class="form-control @error('gallery_images') is-invalid @enderror"
                                            name="gallery_images[]" accept="image/*" multiple>
                                        <div class="form-text">Upload real photos of project implementation - Max 5 images, 5MB each</div>
                                        @error('gallery_images')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        @error('gallery_images.*')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
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
                                                <input type="file" class="form-control @error('before_photo') is-invalid @enderror"
                                                    name="before_photo" accept="image/*">
                                                @error('before_photo')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Expected Photo (AI)</label>
                                                <input type="file" class="form-control @error('expected_photo') is-invalid @enderror"
                                                    name="expected_photo" accept="image/*">
                                                @error('expected_photo')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
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
                                            @if(old('documents') && is_array(old('documents')))
                                                @foreach(old('documents') as $index => $document)
                                                    <div class="row mb-2 document-item">
                                                        <div class="col-md-5">
                                                            <input type="text" name="documents[{{ $index }}][label]"
                                                                class="form-control @error('documents.' . $index . '.label') is-invalid @enderror"
                                                                placeholder="Document Label (e.g., Approval Letter)"
                                                                value="{{ $document['label'] ?? '' }}">
                                                            @error('documents.' . $index . '.label')
                                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="file" name="documents[{{ $index }}][file]"
                                                                class="form-control @error('documents.' . $index . '.file') is-invalid @enderror"
                                                                accept=".pdf,.doc,.docx">
                                                            @error('documents.' . $index . '.file')
                                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-2">
                                                            <button type="button" class="btn btn-outline-danger remove-document">−</button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <button type="button" class="btn btn-sm btn-primary mt-2" id="add_document">Add Document</button>
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
                                            @if(old('links') && is_array(old('links')))
                                                @foreach(old('links') as $index => $link)
                                                    <div class="row mb-2">
                                                        <div class="col-md-5">
                                                            <input type="text" name="links[{{ $index }}][label]"
                                                                class="form-control @error('links.' . $index . '.label') is-invalid @enderror"
                                                                placeholder="Link Label (e.g., Press Coverage)"
                                                                value="{{ $link['label'] ?? '' }}">
                                                            @error('links.' . $index . '.label')
                                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="url" name="links[{{ $index }}][url]"
                                                                class="form-control @error('links.' . $index . '.url') is-invalid @enderror"
                                                                placeholder="URL" value="{{ $link['url'] ?? '' }}">
                                                            @error('links.' . $index . '.url')
                                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-2">
                                                            <button type="button" class="btn btn-outline-danger remove-link">−</button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <button type="button" class="btn btn-sm btn-primary mt-2" id="add_link">Add Link</button>
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
                        <button type="submit" class="btn btn-primary">Create Project</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
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

            // Generate slug from title
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
                if (title) {
                    let slug = generateSlug(title);
                    $('input[name="slug"]').val(slug);
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

            // Alignment categories toggle
            $('select[name="alignment_categories[]"]').on('change', function() {
                let selected = $(this).val() || [];
                $('#sdg_section').toggle(selected.includes('sdg'));
                $('#govt_schemes_section').toggle(selected.includes('govt_schemes'));
            });

// Add/remove dynamic fields counters
            @php
                $locationCount = is_array(old('multiple_locations')) ? count(old('multiple_locations')) : 0;
                $metricCount = is_array(old('donut_metrics')) ? count(old('donut_metrics')) : 0;
                $targetGroupCount = is_array(old('target_groups')) ? count(old('target_groups')) : 0;
                $objectiveCount = is_array(old('objectives')) ? count(old('objectives')) : 0;
                $stakeholderCount = is_array(old('stakeholders')) ? count(old('stakeholders')) : 0;
                $riskCount = is_array(old('risks')) ? count(old('risks')) : 0;
                $documentCount = is_array(old('documents')) ? count(old('documents')) : 0;
                $linkCount = is_array(old('links')) ? count(old('links')) : 0;
            @endphp

            let locationCounter = {{ $locationCount }};
            let metricCounter = {{ $metricCount }};
            let targetGroupCounter = {{ $targetGroupCount }};
            let objectiveCounter = {{ $objectiveCount }};
            let stakeholderCounter = {{ $stakeholderCount }};
            let riskCounter = {{ $riskCount }};
            let documentCounter = {{ $documentCount }};
            let linkCounter = {{ $linkCount }};
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
                $(this).closest('.link-item').remove();
            });

            // Form validation before submit
            $('#projectForm').on('submit', function(e) {
                // Clear previous validation styling
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').remove();

                // Check required fields
                let isValid = true;

                // Check project title
                if (!$('input[name="title"]').val().trim()) {
                    $('input[name="title"]').addClass('is-invalid');
                    isValid = false;
                }

                // Check category
                if (!$('select[name="category_id"]').val()) {
                    $('select[name="category_id"]').addClass('is-invalid');
                    isValid = false;
                }

                // Check location type
                if (!$('select[name="location_type"]').val()) {
                    $('select[name="location_type"]').addClass('is-invalid');
                    isValid = false;
                }

                // Check required text areas
                if (!$('textarea[name="short_description"]').val().trim()) {
                    $('textarea[name="short_description"]').addClass('is-invalid');
                    isValid = false;
                }

                if (!$('textarea[name="description"]').val().trim()) {
                    $('textarea[name="description"]').addClass('is-invalid');
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault();
                    alert('Please fill in all required fields marked with *');
                    return false;
                }
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
        });
    </script>
@endpush
