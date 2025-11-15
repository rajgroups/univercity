@push('css')
    {{-- Summernote CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

@extends('layouts.admin.app')
@section('content')
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Edit Project</h4>
                <h6>Update Project - Current Stage:
                    @if($project->stage == 'upcoming')
                        <span class="badge bg-warning text-dark">Upcoming (Planning)</span>
                    @elseif($project->stage == 'ongoing')
                        <span class="badge bg-primary">Ongoing (Execution)</span>
                    @else
                        <span class="badge bg-success">Completed (Impact)</span>
                    @endif
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

    {{-- Error Message --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('admin.project.update', $project->id) }}" method="POST" enctype="multipart/form-data" class="add-product-form">
        @csrf
        @method('PUT')

        <div class="add-product">
            <div class="accordions-items-seperate" id="accordionSpacingExample">

                <!-- Project Stage Selection -->
                <div class="accordion-item border mb-4">
                    <h2 class="accordion-header" id="headingStage">
                        <div class="accordion-button collapsed bg-white" data-bs-toggle="collapse"
                            data-bs-target="#stageSection">
                            <div class="d-flex align-items-center justify-content-between flex-fill">
                                <h5 class="d-flex align-items-center">
                                    <i class="feather feather-layers text-primary me-2"></i>
                                    <span>Project Stage Management</span>
                                </h5>
                            </div>
                        </div>
                    </h2>
                    <div id="stageSection" class="accordion-collapse collapse show">
                        <div class="accordion-body border-top">
                            <div class="alert alert-info">
                                <i class="feather feather-info me-2"></i>
                                <strong>Note:</strong> Update project stage to show additional fields for Ongoing or Completed projects.
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Project Stage <span class="text-danger">*</span></label>
                                        <select name="stage" id="projectStage" class="form-select @error('stage') is-invalid @enderror">
                                            <option value="upcoming" {{ old('stage', $project->stage) == 'upcoming' ? 'selected' : '' }}>Upcoming (Planning)</option>
                                            <option value="ongoing" {{ old('stage', $project->stage) == 'ongoing' ? 'selected' : '' }}>Ongoing (Execution)</option>
                                            <option value="completed" {{ old('stage', $project->stage) == 'completed' ? 'selected' : '' }}>Completed (Impact)</option>
                                        </select>
                                        @error('stage')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Project ID <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('project_code') is-invalid @enderror"
                                            name="project_code" value="{{ old('project_code', $project->project_code) }}"
                                            placeholder="Auto-generated" readonly>
                                        @error('project_code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Basic Information Section -->
                <div class="accordion-item border mb-4">
                    <h2 class="accordion-header" id="headingBasic">
                        <div class="accordion-button collapsed bg-white" data-bs-toggle="collapse"
                            data-bs-target="#basicSection">
                            <div class="d-flex align-items-center justify-content-between flex-fill">
                                <h5 class="d-flex align-items-center">
                                    <i class="feather feather-info text-primary me-2"></i>
                                    <span>Basic Information</span>
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
                                            name="title" value="{{ old('title', $project->title) }}" placeholder="Enter Project title">
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Slug <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                            name="slug" value="{{ old('slug', $project->slug) }}">
                                        @error('slug')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="subtitle" class="form-label">Sub Title</label>
                                        <input type="text" name="subtitle" id="subtitle"
                                            class="form-control @error('subtitle') is-invalid @enderror"
                                            value="{{ old('subtitle', $project->subtitle) }}" placeholder="Enter project sub title">
                                        @error('subtitle')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Category <span class="text-danger">*</span></label>
                                        <select name="category_id"
                                            class="form-select @error('category_id') is-invalid @enderror">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id', $project->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label for="short_description" class="form-label">Short Description<span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control @error('short_description') is-invalid @enderror" name="short_description"
                                    id="short_description" rows="3" placeholder="Brief short_description...">{{ old('short_description', $project->short_description) }}</textarea>
                                @error('short_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Image</label>
                                        @if($project->image)
                                            <div class="mb-2">
                                                <img src="{{ asset($project->image) }}" alt="Current Image" class="img-thumbnail" style="max-height: 100px;">
                                            </div>
                                        @endif
                                        <input type="file" class="form-control @error('image') is-invalid @enderror"
                                            name="image" accept="image/*">
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Maximum file size: 5MB. Allowed types: JPG,
                                            PNG, JPEG, etc.</small>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Banner Image</label>
                                        @if($project->banner_image)
                                            <div class="mb-2">
                                                <img src="{{ asset($project->banner_image) }}" alt="Current Banner" class="img-thumbnail" style="max-height: 100px;">
                                            </div>
                                        @endif
                                        <input type="file"
                                            class="form-control @error('banner_image') is-invalid @enderror"
                                            name="banner_image" accept="image/*">
                                        @error('banner_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Maximum file size: 5MB. Allowed types: JPG,
                                            PNG, JPEG, etc.</small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Status <span class="text-danger">*</span></label>
                                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                                            <option value="">Select</option>
                                            <option value="1" {{ old('status', $project->status) == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ old('status', $project->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <select name="level" class="form-select @error('stage') is-invalid @enderror">
                                    <option value="">Select Stage</option>
                                    <option value="1" {{ old('level', $project->stage ?? '') == 1 ? 'selected' : '' }}>Stage 1 - Planning</option>
                                    <option value="2" {{ old('level', $project->stage ?? '') == 2 ? 'selected' : '' }}>Stage 2 - Design</option>
                                    <option value="3" {{ old('level', $project->stage ?? '') == 3 ? 'selected' : '' }}>Stage 3 - Development</option>
                                    <option value="4" {{ old('level', $project->stage ?? '') == 4 ? 'selected' : '' }}>Stage 4 - Testing</option>
                                    <option value="5" {{ old('level', $project->stage ?? '') == 5 ? 'selected' : '' }}>Stage 5 - Deployment</option>
                                    <option value="6" {{ old('level', $project->stage ?? '') == 6 ? 'selected' : '' }}>Stage 6 - Review</option>
                                    <option value="7" {{ old('level', $project->stage ?? '') == 7 ? 'selected' : '' }}>Stage 7 - Completed</option>
                                </select>
                                @error('stage')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Bullet Points -->
                            <div class="mb-3">
                                <label class="form-label">Bullet Points (Title & Description)</label>
                                <div id="bullet-points">
                                    @php
                                        $points = old('points', $project->points ?? []);
                                        if (is_string($points)) {
                                            $points = json_decode($points, true) ?? [];
                                        }
                                    @endphp

                                    @if(count($points) > 0)
                                        @foreach ($points as $index => $point)
                                            <div class="input-group mb-2">
                                                <input type="text" name="points[{{ $index }}][title]"
                                                    class="form-control @error('points.' . $index . '.title') is-invalid @enderror"
                                                    placeholder="Title (e.g. Curriculum Integration)"
                                                    value="{{ $point['title'] ?? '' }}">
                                                <input type="text" name="points[{{ $index }}][description]"
                                                    class="form-control @error('points.' . $index . '.description') is-invalid @enderror"
                                                    placeholder="Description (e.g. Blending vocational skills with academics)"
                                                    value="{{ $point['description'] ?? '' }}">
                                                <button type="button"
                                                    class="btn btn-outline-danger remove-bullet">−</button>

                                                @error('points.' . $index . '.title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                @error('points.' . $index . '.description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="input-group mb-2">
                                            <input type="text" name="points[0][title]" class="form-control"
                                                placeholder="Title (e.g. Curriculum Integration)">
                                            <input type="text" name="points[0][description]" class="form-control"
                                                placeholder="Description (e.g. Blending vocational skills with academics)">
                                            <button type="button" class="btn btn-outline-secondary add-bullet">+</button>
                                        </div>
                                    @endif
                                </div>
                                @error('points')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-12">
                                <div class="summer-description-box">
                                    <label class="form-label">Description <span class="text-danger">*</span></label>
                                    <textarea name="description" id="summernote" class="form-control @error('description') is-invalid @enderror"
                                        rows="6" maxlength="600">{{ old('description', $project->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- UPCOMING PROJECT FIELDS -->
                <div class="accordion-item border mb-4 stage-section" id="upcoming-section">
                    <h2 class="accordion-header" id="headingUpcoming">
                        <div class="accordion-button collapsed bg-white" data-bs-toggle="collapse"
                            data-bs-target="#upcomingFields">
                            <div class="d-flex align-items-center justify-content-between flex-fill">
                                <h5 class="d-flex align-items-center">
                                    <i class="feather feather-calendar text-primary me-2"></i>
                                    <span>Upcoming Project Details</span>
                                </h5>
                            </div>
                        </div>
                    </h2>
                    <div id="upcomingFields" class="accordion-collapse collapse {{ $project->stage == 'upcoming' ? 'show' : '' }}">
                        <div class="accordion-body border-top">
                            <div class="row">
                            <!-- Cost Field (nullable) -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Estimated Project Cost</label>
                                    <input type="number" class="form-control @error('cost') is-invalid @enderror"
                                        name="cost" value="{{ old('cost', $project->cost ?? '') }}"
                                        placeholder="Enter estimated cost">
                                    @error('cost')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Planned Start Date <span
                                                class="text-danger">*</span></label>
                                        <input type="date"
                                            class="form-control @error('start_date') is-invalid @enderror"
                                            name="start_date" value="{{ old('start_date', $project->start_date) }}">
                                        @error('start_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
<!-- Start Date Field (nullable) -->
<div class="col-md-6">
    <div class="mb-3">
        <label class="form-label">Planned Start Date</label>
        <input type="date"
            class="form-control @error('start_date') is-invalid @enderror"
            name="start_date" value="{{ old('start_date', $project->start_date ?? '') }}">
        @error('start_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
                            </div>

                            <!-- Beneficiaries Section -->
                            <div class="mb-3">
                                <label class="form-label">Beneficiaries (Name, Count, Description)</label>
                                <div id="beneficiaries-wrapper">
                                    @php
                                        $beneficiaries = old('beneficiaries', $project->beneficiaries ?? []);
                                        if (is_string($beneficiaries)) {
                                            $beneficiaries = json_decode($beneficiaries, true) ?? [];
                                        }
                                    @endphp

                                    @if(count($beneficiaries) > 0)
                                        @foreach ($beneficiaries as $index => $beneficiary)
                                            <div class="row mb-2 beneficiary-item">
                                                <div class="col-md-3">
                                                    <input type="text" name="beneficiaries[{{ $index }}][name]"
                                                        class="form-control" placeholder="Name (e.g. Students)"
                                                        value="{{ $beneficiary['name'] ?? '' }}">
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="number"
                                                        name="beneficiaries[{{ $index }}][count]"
                                                        class="form-control" placeholder="Count (e.g. 100)"
                                                        value="{{ $beneficiary['count'] ?? '' }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text"
                                                        name="beneficiaries[{{ $index }}][description]"
                                                        class="form-control" placeholder="Description (optional)"
                                                        value="{{ $beneficiary['description'] ?? '' }}">
                                                </div>
                                                <div class="col-md-2">
                                                    @if($loop->last)
                                                        <button type="button"
                                                            class="btn btn-outline-secondary add-beneficiary">+</button>
                                                    @else
                                                        <button type="button"
                                                            class="btn btn-outline-danger remove-beneficiary">−</button>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="row mb-2 beneficiary-item">
                                            <div class="col-md-3">
                                                <input type="text" name="beneficiaries[0][name]" class="form-control"
                                                    placeholder="Name (e.g. Students)">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="number" name="beneficiaries[0][count]" class="form-control"
                                                    placeholder="Count (e.g. 100)">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" name="beneficiaries[0][description]"
                                                    class="form-control" placeholder="Description (optional)">
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button"
                                                    class="btn btn-outline-secondary add-beneficiary">+</button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Funding Type <span class="text-danger">*</span></label>
                                        <select name="funding_type"
                                            class="form-select @error('funding_type') is-invalid @enderror">
                                            <option value="">Select Funding Type</option>
                                            <option value="csr" {{ old('funding_type', $project->funding_type) == 'csr' ? 'selected' : '' }}>
                                                CSR</option>
                                            <option value="crowdfunding"
                                                {{ old('funding_type', $project->funding_type) == 'crowdfunding' ? 'selected' : '' }}>Crowdfunding
                                            </option>
                                            <option value="self-funded"
                                                {{ old('funding_type', $project->funding_type) == 'self-funded' ? 'selected' : '' }}>Self-Funded
                                            </option>
                                            <option value="donation"
                                                {{ old('funding_type', $project->funding_type) == 'donation' ? 'selected' : '' }}>Donation</option>
                                        </select>
                                        @error('funding_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">CSR Partner Type</label>
                                        <select name="csr_partner_type"
                                            class="form-select @error('csr_partner_type') is-invalid @enderror">
                                            <option value="">Select Partner Type</option>
                                            <option value="corporate"
                                                {{ old('csr_partner_type', $project->csr_partner_type) == 'corporate' ? 'selected' : '' }}>Corporate
                                            </option>
                                            <option value="ngo"
                                                {{ old('csr_partner_type', $project->csr_partner_type) == 'ngo' ? 'selected' : '' }}>NGO</option>
                                            <option value="government"
                                                {{ old('csr_partner_type', $project->csr_partner_type) == 'government' ? 'selected' : '' }}>Government
                                            </option>
                                            <option value="individual"
                                                {{ old('csr_partner_type', $project->csr_partner_type) == 'individual' ? 'selected' : '' }}>Individual
                                            </option>
                                        </select>
                                        @error('csr_partner_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">CSR Invitation Message</label>
                                <textarea class="form-control @error('csr_invitation') is-invalid @enderror" name="csr_invitation" rows="3"
                                    placeholder="Message for CSR partners...">{{ old('csr_invitation', $project->csr_invitation) }}</textarea>
                                @error('csr_invitation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Crowdfunding Status</label>
                                        <select name="crowdfunding_status"
                                            class="form-select @error('crowdfunding_status') is-invalid @enderror">
                                            <option value="">Select Status</option>
                                            <option value="opening_soon"
                                                {{ old('crowdfunding_status', $project->crowdfunding_status) == 'opening_soon' ? 'selected' : '' }}>
                                                Opening Soon</option>
                                            <option value="not_started"
                                                {{ old('crowdfunding_status', $project->crowdfunding_status) == 'not_started' ? 'selected' : '' }}>Not
                                                Started</option>
                                        </select>
                                        @error('crowdfunding_status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">CTA Button Text</label>
                                        <input type="text"
                                            class="form-control @error('cta_button_text') is-invalid @enderror"
                                            name="cta_button_text"
                                            value="{{ old('cta_button_text', $project->cta_button_text ?? 'Register Your Interest →') }}"
                                            placeholder="Button text for call to action">
                                        @error('cta_button_text')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Register Interest Link</label>
                                        <input type="url"
                                            class="form-control @error('interest_link') is-invalid @enderror"
                                            name="interest_link" value="{{ old('interest_link', $project->interest_link) }}"
                                            placeholder="URL for interest form">
                                        @error('interest_link')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Supported SDGs</label>
                                <select name="sdgs[]" class="form-select @error('sdgs') is-invalid @enderror" multiple>
                                    @foreach ($sdgs as $sdg)
                                        <option value="{{ $sdg['id'] }}"
                                            {{ in_array($sdg['id'], old('sdgs', $selectedSDGs ?? [])) ? 'selected' : '' }}>
                                            SDG {{ $sdg['id'] }}: {{ $sdg['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('sdgs')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Hold Ctrl/Cmd to select multiple SDGs</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ONGOING PROJECT FIELDS -->
                <div class="accordion-item border mb-4 stage-section" id="ongoing-section">
                    <h2 class="accordion-header" id="headingOngoing">
                        <div class="accordion-button collapsed bg-white" data-bs-toggle="collapse"
                            data-bs-target="#ongoingFields">
                            <div class="d-flex align-items-center justify-content-between flex-fill">
                                <h5 class="d-flex align-items-center">
                                    <i class="feather feather-play-circle text-primary me-2"></i>
                                    <span>Ongoing Project Details</span>
                                </h5>
                            </div>
                        </div>
                    </h2>
                    <div id="ongoingFields" class="accordion-collapse collapse {{ $project->stage == 'ongoing' ? 'show' : '' }}">
                        <div class="accordion-body border-top">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Project Lead / Coordinator <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('project_lead') is-invalid @enderror"
                                            name="project_lead" value="{{ old('project_lead', $project->project_lead) }}" placeholder="Name of project lead">
                                        @error('project_lead')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Actual Start Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control @error('actual_start_date') is-invalid @enderror"
                                            name="actual_start_date" value="{{ old('actual_start_date', $project->actual_start_date) }}">
                                        @error('actual_start_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Expected End Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control @error('expected_end_date') is-invalid @enderror"
                                            name="expected_end_date" value="{{ old('expected_end_date', $project->expected_end_date) }}">
                                        @error('expected_end_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Number of Beneficiaries <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('ongoing_beneficiaries') is-invalid @enderror"
                                            name="ongoing_beneficiaries" value="{{ old('ongoing_beneficiaries', $project->ongoing_beneficiaries) }}" placeholder="Actual beneficiaries in progress">
                                        @error('ongoing_beneficiaries')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Project Cost <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('project_cost') is-invalid @enderror"
                                            name="project_cost" value="{{ old('project_cost', $project->project_cost) }}" placeholder="Approved/final cost">
                                        @error('project_cost')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Funding Target <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('funding_target') is-invalid @enderror"
                                            name="funding_target" value="{{ old('funding_target', $project->funding_target) }}" placeholder="Set funding target">
                                        @error('funding_target')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Amount Raised</label>
                                        <input type="number" class="form-control @error('amount_raised') is-invalid @enderror"
                                            name="amount_raised" value="{{ old('amount_raised', $project->amount_raised ?? 0) }}" placeholder="Amount raised so far">
                                        @error('amount_raised')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Funding Progress (%)</label>
                                        <input type="text" class="form-control" id="funding_progress" readonly value="{{ $project->funding_target > 0 ? round(($project->amount_raised / $project->funding_target) * 100, 2) . '%' : '0%' }}">
                                        <small class="form-text text-muted">Auto-calculated: (Raised ÷ Target × 100)</small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Crowdfunding Status</label>
                                        <select name="ongoing_crowdfunding_status" class="form-select @error('ongoing_crowdfunding_status') is-invalid @enderror">
                                            <option value="">Select Status</option>
                                            <option value="active" {{ old('ongoing_crowdfunding_status', $project->ongoing_crowdfunding_status) == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="on_hold" {{ old('ongoing_crowdfunding_status', $project->ongoing_crowdfunding_status) == 'on_hold' ? 'selected' : '' }}>On Hold</option>
                                            <option value="closed" {{ old('ongoing_crowdfunding_status', $project->ongoing_crowdfunding_status) == 'closed' ? 'selected' : '' }}>Closed</option>
                                        </select>
                                        @error('ongoing_crowdfunding_status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Main Donor (CSR Partner)</label>
                                        <input type="text" class="form-control @error('main_donor') is-invalid @enderror"
                                            name="main_donor" value="{{ old('main_donor', $project->main_donor) }}" placeholder="CSR donor name">
                                        @error('main_donor')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">ISICO Message</label>
                                <textarea class="form-control @error('isico_message') is-invalid @enderror"
                                    name="isico_message" rows="3" placeholder="We thank our supporters...">{{ old('isico_message', $project->isico_message) }}</textarea>
                                @error('isico_message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Progress Updates (Milestone Log) -->
                            <div class="mb-3">
                                <label class="form-label">Progress Updates (Milestones)</label>
                                <div id="progress-updates">
                                    @php
                                        $progress_updates = old('progress_updates', $project->progress_updates ?? []);
                                        if (is_string($progress_updates)) {
                                            $progress_updates = json_decode($progress_updates, true) ?? [];
                                        }
                                    @endphp

                                    @if(count($progress_updates) > 0)
                                        @foreach ($progress_updates as $index => $update)
                                            <div class="progress-update-item border p-3 mb-3">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="mb-3">
                                                            <label class="form-label">Date</label>
                                                            <input type="date" name="progress_updates[{{ $index }}][date]" class="form-control" value="{{ $update['date'] ?? '' }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="mb-3">
                                                            <label class="form-label">Title</label>
                                                            <input type="text" name="progress_updates[{{ $index }}][title]" class="form-control" placeholder="Milestone title" value="{{ $update['title'] ?? '' }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label class="form-label">Status</label>
                                                            <select name="progress_updates[{{ $index }}][status]" class="form-control">
                                                                <option value="pending" {{ ($update['status'] ?? '') == 'pending' ? 'selected' : '' }}>Pending</option>
                                                                <option value="in_progress" {{ ($update['status'] ?? '') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                                                <option value="completed" {{ ($update['status'] ?? '') == 'completed' ? 'selected' : '' }}>Completed</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Description</label>
                                                    <textarea name="progress_updates[{{ $index }}][description]" class="form-control" rows="2" placeholder="Milestone description">{{ $update['description'] ?? '' }}</textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Image</label>
                                                    <input type="file" name="progress_updates[{{ $index }}][image]" class="form-control" accept="image/*">
                                                    @if(isset($update['image']) && $update['image'])
                                                        <div class="mt-2">
                                                            <img src="{{ asset('storage/' . $update['image']) }}" alt="Milestone Image" class="img-thumbnail" style="max-height: 100px;">
                                                        </div>
                                                    @endif
                                                </div>

                                                <button type="button" class="btn btn-outline-danger btn-sm remove-progress">Remove Milestone</button>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="progress-update-item border p-3 mb-3">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Date</label>
                                                        <input type="date" name="progress_updates[0][date]" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="mb-3">
                                                        <label class="form-label">Title</label>
                                                        <input type="text" name="progress_updates[0][title]" class="form-control" placeholder="Milestone title">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Status</label>
                                                        <select name="progress_updates[0][status]" class="form-control">
                                                            <option value="pending">Pending</option>
                                                            <option value="in_progress">In Progress</option>
                                                            <option value="completed">Completed</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Description</label>
                                                <textarea name="progress_updates[0][description]" class="form-control" rows="2" placeholder="Milestone description"></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Image</label>
                                                <input type="file" name="progress_updates[0][image]" class="form-control" accept="image/*">
                                            </div>

                                            <button type="button" class="btn btn-outline-danger btn-sm remove-progress">Remove Milestone</button>
                                        </div>
                                    @endif

                                </div>
                                <button type="button" class="btn btn-outline-secondary" id="add-progress">Add Milestone</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- COMPLETED PROJECT FIELDS -->
                <div class="accordion-item border mb-4 stage-section" id="completed-section">
                    <h2 class="accordion-header" id="headingCompleted">
                        <div class="accordion-button collapsed bg-white" data-bs-toggle="collapse"
                            data-bs-target="#completedFields">
                            <div class="d-flex align-items-center justify-content-between flex-fill">
                                <h5 class="d-flex align-items-center">
                                    <i class="feather feather-check-circle text-primary me-2"></i>
                                    <span>Completed Project Details</span>
                                </h5>
                            </div>
                        </div>
                    </h2>
                    <div id="completedFields" class="accordion-collapse collapse {{ $project->stage == 'completed' ? 'show' : '' }}">
                        <div class="accordion-body border-top">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Project Lead / Coordinator <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('completed_project_lead') is-invalid @enderror"
                                            name="completed_project_lead" value="{{ old('completed_project_lead', $project->completed_project_lead) }}" placeholder="Name of project lead">
                                        @error('completed_project_lead')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Actual Start Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control @error('completed_start_date') is-invalid @enderror"
                                            name="completed_start_date" value="{{ old('completed_start_date', $project->completed_start_date) }}">
                                        @error('completed_start_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Actual End Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control @error('completed_end_date') is-invalid @enderror"
                                            name="completed_end_date" value="{{ old('completed_end_date', $project->completed_end_date) }}">
                                        @error('completed_end_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Final Cost <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('final_cost') is-invalid @enderror"
                                            name="final_cost" value="{{ old('final_cost', $project->final_cost) }}" placeholder="Actual expenditure">
                                        @error('final_cost')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Number of Beneficiaries <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('completed_beneficiaries') is-invalid @enderror"
                                            name="completed_beneficiaries" value="{{ old('completed_beneficiaries', $project->completed_beneficiaries) }}" placeholder="Total people reached">
                                        @error('completed_beneficiaries')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">CSR Partner</label>
                                        <input type="text" class="form-control @error('completed_csr_partner') is-invalid @enderror"
                                            name="completed_csr_partner" value="{{ old('completed_csr_partner', $project->completed_csr_partner) }}" placeholder="CSR partner name">
                                        @error('completed_csr_partner')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Impact Summary</label>
                                <textarea class="form-control @error('impact_summary') is-invalid @enderror"
                                    name="impact_summary" rows="4" placeholder="200-300 words summary of impact...">{{ old('impact_summary', $project->impact_summary) }}</textarea>
                                @error('impact_summary')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Outcome Metrics -->
                            <div class="mb-3">
                                <label class="form-label">Outcome Metrics</label>
                                <div id="outcome-metrics">
                                    @php
                                        $outcome_metrics = old('outcome_metrics', $project->outcome_metrics ?? []);
                                        if (is_string($outcome_metrics)) {
                                            $outcome_metrics = json_decode($outcome_metrics, true) ?? [];
                                        }
                                    @endphp

                                    @if(count($outcome_metrics) > 0)
                                        @foreach ($outcome_metrics as $index => $metric)
                                            <div class="input-group mb-2">
                                                <input type="text" name="outcome_metrics[{{ $index }}][metric]" class="form-control" placeholder="Metric (e.g., Students Trained)" value="{{ $metric['metric'] ?? '' }}">
                                                <input type="text" name="outcome_metrics[{{ $index }}][value]" class="form-control" placeholder="Value (e.g., 500)" value="{{ $metric['value'] ?? '' }}">
                                                <button type="button" class="btn btn-outline-danger remove-outcome">−</button>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="input-group mb-2">
                                            <input type="text" name="outcome_metrics[0][metric]" class="form-control" placeholder="Metric (e.g., Students Trained)">
                                            <input type="text" name="outcome_metrics[0][value]" class="form-control" placeholder="Value (e.g., 500)">
                                            <button type="button" class="btn btn-outline-secondary add-outcome">+</button>
                                        </div>
                                    @endif
                                </div>
                                <button type="button" class="btn btn-outline-secondary" id="add-outcome">Add Metric</button>
                            </div>

                            <!-- Beneficiary Testimonials -->
                            <div class="mb-3">
                                <label class="form-label">Beneficiary Testimonials</label>
                                <div id="testimonials">
                                    @php
                                        $testimonials = old('testimonials', $project->testimonials ?? []);
                                        if (is_string($testimonials)) {
                                            $testimonials = json_decode($testimonials, true) ?? [];
                                        }
                                    @endphp

                                    @if(count($testimonials) > 0)
                                        @foreach ($testimonials as $index => $testimonial)
                                            <div class="testimonial-item border p-3 mb-3">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Name</label>
                                                            <input type="text" name="testimonials[{{ $index }}][name]" class="form-control" placeholder="Beneficiary name" value="{{ $testimonial['name'] ?? '' }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Quote</label>
                                                            <textarea name="testimonials[{{ $index }}][quote]" class="form-control" rows="2" placeholder="Testimonial quote">{{ $testimonial['quote'] ?? '' }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-outline-danger btn-sm remove-testimonial">Remove Testimonial</button>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="testimonial-item border p-3 mb-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Name</label>
                                                        <input type="text" name="testimonials[0][name]" class="form-control" placeholder="Beneficiary name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Quote</label>
                                                        <textarea name="testimonials[0][quote]" class="form-control" rows="2" placeholder="Testimonial quote"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-outline-danger btn-sm remove-testimonial">Remove Testimonial</button>
                                        </div>
                                    @endif
                                </div>
                                <button type="button" class="btn btn-outline-secondary" id="add-testimonial">Add Testimonial</button>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Sustainability Plan</label>
                                <textarea class="form-control @error('sustainability_plan') is-invalid @enderror"
                                    name="sustainability_plan" rows="3" placeholder="Long-term sustainability plan...">{{ old('sustainability_plan', $project->sustainability_plan) }}</textarea>
                                @error('sustainability_plan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Lessons Learned</label>
                                <textarea class="form-control @error('lessons_learned') is-invalid @enderror"
                                    name="lessons_learned" rows="3" placeholder="Key takeaways from the project...">{{ old('lessons_learned', $project->lessons_learned) }}</textarea>
                                @error('lessons_learned')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Completion Report (PDF)</label>
                                        @if($project->completion_report)
                                            <div class="mb-2">
                                                <a href="{{ asset('storage/' . $project->completion_report) }}" target="_blank" class="btn btn-sm btn-outline-primary">View Current Report</a>
                                            </div>
                                        @endif
                                        <input type="file" class="form-control @error('completion_report') is-invalid @enderror"
                                            name="completion_report" accept=".pdf">
                                        @error('completion_report')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Utilization Certificate (PDF)</label>
                                        @if($project->utilization_certificate)
                                            <div class="mb-2">
                                                <a href="{{ asset('storage/' . $project->utilization_certificate) }}" target="_blank" class="btn btn-sm btn-outline-primary">View Current Certificate</a>
                                            </div>
                                        @endif
                                        <input type="file" class="form-control @error('utilization_certificate') is-invalid @enderror"
                                            name="utilization_certificate" accept=".pdf">
                                        @error('utilization_certificate')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Impact Stories -->
                            <div class="mb-3">
                                <label class="form-label">Impact Stories</label>
                                <div id="impact-stories">
                                    @php
                                        $impact_stories = old('impact_stories', $project->impact_stories ?? []);
                                        if (is_string($impact_stories)) {
                                            $impact_stories = json_decode($impact_stories, true) ?? [];
                                        }
                                    @endphp

                                    @if(count($impact_stories) > 0)
                                        @foreach ($impact_stories as $index => $story)
                                            <div class="impact-story-item border p-3 mb-3">
                                                <div class="mb-3">
                                                    <label class="form-label">Story Title</label>
                                                    <input type="text" name="impact_stories[{{ $index }}][title]" class="form-control" placeholder="Impact story title" value="{{ $story['title'] ?? '' }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Description</label>
                                                    <textarea name="impact_stories[{{ $index }}][description]" class="form-control" rows="3" placeholder="Impact story description">{{ $story['description'] ?? '' }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Image</label>
                                                    <input type="file" name="impact_stories[{{ $index }}][image]" class="form-control" accept="image/*">
                                                    @if(isset($story['image']) && $story['image'])
                                                        <div class="mt-2">
                                                            <img src="{{ asset('storage/' . $story['image']) }}" alt="Impact Story Image" class="img-thumbnail" style="max-height: 100px;">
                                                        </div>
                                                    @endif
                                                </div>
                                                <button type="button" class="btn btn-outline-danger btn-sm remove-impact-story">Remove Story</button>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="impact-story-item border p-3 mb-3">
                                            <div class="mb-3">
                                                <label class="form-label">Story Title</label>
                                                <input type="text" name="impact_stories[0][title]" class="form-control" placeholder="Impact story title">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Description</label>
                                                <textarea name="impact_stories[0][description]" class="form-control" rows="3" placeholder="Impact story description"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Image</label>
                                                <input type="file" name="impact_stories[0][image]" class="form-control" accept="image/*">
                                            </div>
                                            <button type="button" class="btn btn-outline-danger btn-sm remove-impact-story">Remove Story</button>
                                        </div>
                                    @endif
                                </div>
                                <button type="button" class="btn btn-outline-secondary" id="add-impact-story">Add Impact Story</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Common Fields -->
                <div class="accordion-item border mb-4">
                    <h2 class="accordion-header" id="headingCommon">
                        <div class="accordion-button collapsed bg-white" data-bs-toggle="collapse"
                            data-bs-target="#commonFields">
                            <div class="d-flex align-items-center justify-content-between flex-fill">
                                <h5 class="d-flex align-items-center">
                                    <i class="feather feather-image text-primary me-2"></i>
                                    <span>Media & Additional Information</span>
                                </h5>
                            </div>
                        </div>
                    </h2>
                    <div id="commonFields" class="accordion-collapse collapse show">
                        <div class="accordion-body border-top">
                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Gallery Images</label>
                                        @if($project->gallery && count(json_decode($project->gallery, true)) > 0)
                                            <div class="mb-2">
                                                @foreach(json_decode($project->gallery, true) as $galleryImage)
                                                    <img src="{{ asset($galleryImage) }}" alt="Gallery Image" class="img-thumbnail me-2" style="max-height: 80px;">
                                                @endforeach
                                            </div>
                                        @endif
                                        <input type="file" class="form-control @error('gallery') is-invalid @enderror"
                                            name="gallery[]" accept="image/*" multiple>
                                        @error('gallery')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Maximum 5 images, 5MB each. Allowed types: JPG,
                                            PNG, JPEG.</small>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Before/After Images</label>
                                        @if($project->before_after_images && count(json_decode($project->before_after_images, true)) > 0)
                                            <div class="mb-2">
                                                @foreach(json_decode($project->before_after_images, true) as $beforeAfterImage)
                                                    <img src="{{ asset('storage/' . $beforeAfterImage) }}" alt="Before/After Image" class="img-thumbnail me-2" style="max-height: 80px;">
                                                @endforeach
                                            </div>
                                        @endif
                                        <input type="file" class="form-control @error('before_after_images') is-invalid @enderror"
                                            name="before_after_images[]" accept="image/*" multiple>
                                        @error('before_after_images')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Upload pairs of before/after images.</small>
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

@push('scripts')
    <script>
        $(document).ready(function() {
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

            // Show/hide stage-specific sections
            function toggleStageSections() {
                let stage = $('#projectStage').val();
                $('.stage-section').hide();

                if (stage) {
                    $('#' + stage + '-section').show();
                    $('#' + stage + 'Fields').addClass('show');
                }
            }

            $('#projectStage').change(function() {
                toggleStageSections();
            });

            // Initialize stage sections
            toggleStageSections();

            // Calculate funding progress
            function calculateFundingProgress() {
                let target = parseFloat($('input[name="funding_target"]').val()) || 0;
                let raised = parseFloat($('input[name="amount_raised"]').val()) || 0;

                if (target > 0) {
                    let progress = (raised / target) * 100;
                    $('#funding_progress').val(progress.toFixed(2) + '%');
                } else {
                    $('#funding_progress').val('0%');
                }
            }

            $('input[name="funding_target"], input[name="amount_raised"]').on('input', function() {
                calculateFundingProgress();
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
                let slug = generateSlug(title);
                $('input[name="slug"]').val(slug);
            });

            // SDG Search functionality
            $('select[name="sdgs[]"]').before(
                '<input type="text" id="sdgSearch" class="form-control mb-2" placeholder="Search SDGs...">');

            $('#sdgSearch').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('select[name="sdgs[]"] option').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            // Bullet points functionality
            let container = $('#bullet-points');

            container.on('click', '.add-bullet', function() {
                let index = container.find('.input-group').length;

                let newGroup = `
            <div class="input-group mb-2">
                <input type="text" name="points[${index}][title]" class="form-control"
                    placeholder="Title (e.g. Curriculum Integration)">
                <input type="text" name="points[${index}][description]" class="form-control"
                    placeholder="Description (e.g. Blending vocational skills with academics)">
                <button type="button" class="btn btn-outline-secondary add-bullet">+</button>
            </div>
        `;

                container.find('.add-bullet')
                    .removeClass('btn-outline-secondary add-bullet')
                    .addClass('btn-outline-danger remove-bullet')
                    .text('−');

                container.append(newGroup);
            });

            container.on('click', '.remove-bullet', function() {
                $(this).closest('.input-group').remove();

                let groups = container.find('.input-group');
                container.find('.remove-bullet')
                    .removeClass('btn-outline-secondary add-bullet')
                    .addClass('btn-outline-danger remove-bullet')
                    .text('−');

                if (groups.length > 0) {
                    let lastGroup = groups.last();
                    let button = lastGroup.find('button');
                    button.removeClass('btn-outline-danger remove-bullet')
                        .addClass('btn-outline-secondary add-bullet')
                        .text('+');
                }
            });

            // Beneficiaries functionality
            let wrapper = $('#beneficiaries-wrapper');

            wrapper.on('click', '.add-beneficiary', function() {
                let index = wrapper.find('.beneficiary-item').length;

                let newRow = `
            <div class="row mb-2 beneficiary-item">
                <div class="col-md-3">
                    <input type="text" name="beneficiaries[${index}][name]" class="form-control"
                        placeholder="Name (e.g. Students)">
                </div>
                <div class="col-md-3">
                    <input type="number" name="beneficiaries[${index}][count]" class="form-control"
                        placeholder="Count (e.g. 100)">
                </div>
                <div class="col-md-4">
                    <input type="text" name="beneficiaries[${index}][description]" class="form-control"
                        placeholder="Description (optional)">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-outline-secondary add-beneficiary">+</button>
                </div>
            </div>
        `;

                wrapper.find('.add-beneficiary')
                    .removeClass('btn-outline-secondary add-beneficiary')
                    .addClass('btn-outline-danger remove-beneficiary')
                    .text('−');

                wrapper.append(newRow);
            });

            wrapper.on('click', '.remove-beneficiary', function() {
                $(this).closest('.beneficiary-item').remove();

                let items = wrapper.find('.beneficiary-item');
                wrapper.find('.remove-beneficiary')
                    .removeClass('btn-outline-secondary add-beneficiary')
                    .addClass('btn-outline-danger remove-beneficiary')
                    .text('−');

                if (items.length > 0) {
                    let lastItem = items.last().find('button');
                    lastItem.removeClass('btn-outline-danger remove-beneficiary')
                        .addClass('btn-outline-secondary add-beneficiary')
                        .text('+');
                }
            });

            // Progress updates functionality
            $('#add-progress').click(function() {
                let index = $('#progress-updates .progress-update-item').length;

                const progressItem = `
                <div class="progress-update-item border p-3 mb-3">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Date</label>
                                <input type="date" name="progress_updates[${index}][date]" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="progress_updates[${index}][title]" class="form-control" placeholder="Milestone title">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="progress_updates[${index}][status]" class="form-control">
                                    <option value="pending">Pending</option>
                                    <option value="in_progress">In Progress</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="progress_updates[${index}][description]" class="form-control" rows="2" placeholder="Milestone description"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" name="progress_updates[${index}][image]" class="form-control" accept="image/*">
                    </div>

                    <button type="button" class="btn btn-outline-danger btn-sm remove-progress">Remove Milestone</button>
                </div>`;

                $('#progress-updates').append(progressItem);
            });

            $(document).on('click', '.remove-progress', function() {
                $(this).closest('.progress-update-item').remove();
            });

            // Outcome metrics functionality
            $('#add-outcome').click(function() {
                let index = $('#outcome-metrics .input-group').length;

                const outcomeItem = `
                <div class="input-group mb-2">
                    <input type="text" name="outcome_metrics[${index}][metric]" class="form-control" placeholder="Metric (e.g., Students Trained)">
                    <input type="text" name="outcome_metrics[${index}][value]" class="form-control" placeholder="Value (e.g., 500)">
                    <button type="button" class="btn btn-outline-secondary add-outcome">+</button>
                </div>`;
                $('#outcome-metrics').append(outcomeItem);
            });

            $(document).on('click', '.add-outcome', function() {
                let index = $('#outcome-metrics .input-group').length;

                const outcomeItem = `
                <div class="input-group mb-2">
                    <input type="text" name="outcome_metrics[${index}][metric]" class="form-control" placeholder="Metric (e.g., Students Trained)">
                    <input type="text" name="outcome_metrics[${index}][value]" class="form-control" placeholder="Value (e.g., 500)">
                    <button type="button" class="btn btn-outline-secondary add-outcome">+</button>
                </div>`;
                $('#outcome-metrics').append(outcomeItem);

                $(this).removeClass('btn-outline-secondary add-outcome')
                    .addClass('btn-outline-danger remove-outcome')
                    .text('−');
            });

            $(document).on('click', '.remove-outcome', function() {
                $(this).closest('.input-group').remove();
            });

            // Testimonials functionality
            $('#add-testimonial').click(function() {
                let index = $('#testimonials .testimonial-item').length;

                const testimonialItem = `
                <div class="testimonial-item border p-3 mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="testimonials[${index}][name]" class="form-control" placeholder="Beneficiary name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Quote</label>
                                <textarea name="testimonials[${index}][quote]" class="form-control" rows="2" placeholder="Testimonial quote"></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-outline-danger btn-sm remove-testimonial">Remove Testimonial</button>
                </div>`;
                $('#testimonials').append(testimonialItem);
            });

            $(document).on('click', '.remove-testimonial', function() {
                $(this).closest('.testimonial-item').remove();
            });

            // Impact stories functionality
            $('#add-impact-story').click(function() {
                let index = $('#impact-stories .impact-story-item').length;

                const impactStoryItem = `
                <div class="impact-story-item border p-3 mb-3">
                    <div class="mb-3">
                        <label class="form-label">Story Title</label>
                        <input type="text" name="impact_stories[${index}][title]" class="form-control" placeholder="Impact story title">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="impact_stories[${index}][description]" class="form-control" rows="3" placeholder="Impact story description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" name="impact_stories[${index}][image]" class="form-control" accept="image/*">
                    </div>
                    <button type="button" class="btn btn-outline-danger btn-sm remove-impact-story">Remove Story</button>
                </div>`;
                $('#impact-stories').append(impactStoryItem);
            });

            $(document).on('click', '.remove-impact-story', function() {
                $(this).closest('.impact-story-item').remove();
            });
        });
    </script>
@endpush
