@push('css')
    {{-- Summernote CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

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
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('admin.project.store') }}" method="POST" enctype="multipart/form-data" class="add-product-form">
        @csrf

        {{-- Hidden field to set initial stage as upcoming --}}
        <input type="hidden" name="stage" value="upcoming">

        <div class="add-product">
            <div class="accordions-items-seperate" id="accordionSpacingExample">

                <!-- Project Stage Indicator -->
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
    name="project_code" value="{{ old('project_code', $project_code) }}"
    placeholder="Auto-generated" readonly>
                                        @error('project_code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Project Type</label>
                                        <select name="type" class="form-select @error('type') is-invalid @enderror">
                                            <option value="">Select Type</option>
                                            <option value="1" {{ old('type') == '1' ? 'selected' : '' }}>On Going
                                            </option>
                                            <option value="2" {{ old('type') == '2' ? 'selected' : '' }}>Up Coming
                                            </option>
                                        </select>
                                        @error('type')
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
                                            name="title" value="{{ old('title') }}" placeholder="Enter Project title">
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Slug <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                            name="slug" value="{{ old('slug') }}">
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
                                            value="{{ old('subtitle') }}" placeholder="Enter project sub title">
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
                                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                                    id="short_description" rows="3" placeholder="Brief short_description...">{{ old('short_description') }}</textarea>
                                @error('short_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Image <span class="text-danger">*</span></label>
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
                                        <label class="form-label">Banner Image <span class="text-danger">*</span></label>
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
                                            <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive
                                            </option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Milestone Stage <span class="text-danger">*</span></label>
                                            <select name="level" class="form-select @error('level') is-invalid @enderror">
                                                <option value="">Select Stage</option>
                                                <option value="1" {{ old('level') == 1 ? 'selected' : '' }}>Stage 1 - Planning</option>
                                                <option value="2" {{ old('level') == 2 ? 'selected' : '' }}>Stage 2 - Design</option>
                                                <option value="3" {{ old('level') == 3 ? 'selected' : '' }}>Stage 3 - Development</option>
                                                <option value="4" {{ old('level') == 4 ? 'selected' : '' }}>Stage 4 - Testing</option>
                                                <option value="5" {{ old('level') == 5 ? 'selected' : '' }}>Stage 5 - Deployment</option>
                                                <option value="6" {{ old('level') == 6 ? 'selected' : '' }}>Stage 6 - Review</option>
                                                <option value="7" {{ old('level') == 7 ? 'selected' : '' }}>Stage 7 - Completed</option>
                                            </select>
                                            @error('stage')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Bullet Points -->
                            <div class="mb-3">
                                <label class="form-label">Bullet Points (Title & Description)</label>
                                <div id="bullet-points">
                                    @if (old('points'))
                                        @foreach (old('points') as $index => $point)
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
                                        rows="6" maxlength="600">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- UPCOMING PROJECT FIELDS (Initial Stage) -->
                <div class="accordion-item border mb-4">
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
                    <div id="upcomingFields" class="accordion-collapse collapse show">
                        <div class="accordion-body border-top">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Estimated Project Cost <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('cost') is-invalid @enderror"
                                            name="cost" value="{{ old('cost') }}"
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
                                            name="start_date" value="{{ old('start_date') }}">
                                        @error('start_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Planned End Date <span
                                                class="text-danger">*</span></label>
                                        <input type="date"
                                            class="form-control @error('end_date') is-invalid @enderror" name="end_date"
                                            value="{{ old('end_date') }}">
                                        @error('end_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Beneficiaries Section -->
                            <div class="mb-3">
                                <label class="form-label">Beneficiaries (Name, Count, Description)</label>
                                <div id="beneficiaries-wrapper">
                                    @if (old('beneficiaries'))
                                        @foreach (old('beneficiaries') as $index => $beneficiary)
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
                                                    <button type="button"
                                                        class="btn btn-outline-danger remove-beneficiary">−</button>
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
                                            <option value="csr" {{ old('funding_type') == 'csr' ? 'selected' : '' }}>
                                                CSR</option>
                                            <option value="crowdfunding"
                                                {{ old('funding_type') == 'crowdfunding' ? 'selected' : '' }}>Crowdfunding
                                            </option>
                                            <option value="self-funded"
                                                {{ old('funding_type') == 'self-funded' ? 'selected' : '' }}>Self-Funded
                                            </option>
                                            <option value="donation"
                                                {{ old('funding_type') == 'donation' ? 'selected' : '' }}>Donation</option>
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
                                                {{ old('csr_partner_type') == 'corporate' ? 'selected' : '' }}>Corporate
                                            </option>
                                            <option value="ngo"
                                                {{ old('csr_partner_type') == 'ngo' ? 'selected' : '' }}>NGO</option>
                                            <option value="government"
                                                {{ old('csr_partner_type') == 'government' ? 'selected' : '' }}>Government
                                            </option>
                                            <option value="individual"
                                                {{ old('csr_partner_type') == 'individual' ? 'selected' : '' }}>Individual
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
                                    placeholder="Message for CSR partners...">{{ old('csr_invitation') }}</textarea>
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
                                                {{ old('crowdfunding_status') == 'opening_soon' ? 'selected' : '' }}>
                                                Opening Soon</option>
                                            <option value="not_started"
                                                {{ old('crowdfunding_status') == 'not_started' ? 'selected' : '' }}>Not
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
                                            value="{{ old('cta_button_text', 'Register Your Interest →') }}"
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
                                            name="interest_link" value="{{ old('interest_link') }}"
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
                                        <input type="file" class="form-control @error('gallery') is-invalid @enderror"
                                            name="gallery[]" accept="image/*" multiple>
                                        @error('gallery')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Maximum 5 images, 5MB each. Allowed types: JPG,
                                            PNG, JPEG.</small>
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
            // Initialize select2 for better multi-select (if you have select2)
            // $('select[name="sdgs[]"]').select2({
            //     placeholder: "Select SDGs",
            //     allowClear: true
            // });

            // Or add custom search functionality
            $('select[name="sdgs[]"]').before(
                '<input type="text" id="sdgSearch" class="form-control mb-2" placeholder="Search SDGs...">');

            $('#sdgSearch').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('select[name="sdgs[]"] option').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
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
                let slug = generateSlug(title);
                $('input[name="slug"]').val(slug);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            let container = $('#bullet-points');

            // Add new bullet point
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

                // Remove "+" from all existing rows
                container.find('.add-bullet')
                    .removeClass('btn-outline-secondary add-bullet')
                    .addClass('btn-outline-danger remove-bullet')
                    .text('−');

                // Append new group at the bottom
                container.append(newGroup);
            });

            // Remove bullet point
            container.on('click', '.remove-bullet', function() {
                $(this).closest('.input-group').remove();

                // Ensure only the last row has "+"
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
        });

        let wrapper = $('#beneficiaries-wrapper');

        // Add new beneficiary row
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

            // Change last "+" to "−"
            wrapper.find('.add-beneficiary')
                .removeClass('btn-outline-secondary add-beneficiary')
                .addClass('btn-outline-danger remove-beneficiary')
                .text('−');

            wrapper.append(newRow);
        });

        // Remove beneficiary row
        wrapper.on('click', '.remove-beneficiary', function() {
            $(this).closest('.beneficiary-item').remove();

            // Ensure only the last row has "+"
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
    </script>
@endpush
