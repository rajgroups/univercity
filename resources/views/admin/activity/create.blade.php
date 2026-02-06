@extends('layouts.admin.app')
@section('content')
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Create Activity</h4>
                <h6>Create new Activity Details</h6>
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
            <a href="{{ route('admin.activity.index') }}" class="btn btn-secondary">
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
    @if ($errors->any()))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('admin.activity.store') }}" method="POST" enctype="multipart/form-data" class="add-activity-form">
        @csrf
        
        <div class="row">
            <!-- Left Column: Basic Info & Details -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-transparent border-bottom p-3">
                        <h5 class="card-title mb-0"><i class="feather feather-info me-2 text-primary"></i>Basic Information</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Activity Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg @error('title') is-invalid @enderror"
                                    name="title" value="{{ old('title') }}"
                                    placeholder="Enter Activity Title" id="activity-title">
                                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Slug <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                    name="slug" value="{{ old('slug') }}" id="activity-slug" readonly style="background-color: #f8f9fa;">
                                @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Short Description <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('short_description') is-invalid @enderror" 
                                    name="short_description" id="short_description" rows="3" 
                                    placeholder="Brief description for listings...">{{ old('short_description') }}</textarea>
                                @error('short_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                             <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Full Description <span class="text-danger">*</span></label>
                                <textarea name="description" id="summernote" class="form-control @error('description') is-invalid @enderror"
                                    rows="6">{{ old('description') }}</textarea>
                                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Setup & Logistics -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-transparent border-bottom p-3">
                         <h5 class="card-title mb-0"><i class="feather feather-calendar me-2 text-primary"></i>Schedule & Location</h5>
                    </div>
                    <div class="card-body p-4">
                         <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Start Date <span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control @error('start_date') is-invalid @enderror"
                                    name="start_date" value="{{ old('start_date') }}">
                                @error('start_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">End Date <span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control @error('end_date') is-invalid @enderror" 
                                    name="end_date" value="{{ old('end_date') }}">
                                @error('end_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Reg. Deadline</label>
                                <input type="datetime-local" class="form-control @error('registration_deadline') is-invalid @enderror"
                                    name="registration_deadline" value="{{ old('registration_deadline') }}">
                                @error('registration_deadline') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Location <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i class="feather feather-map-pin"></i></span>
                                    <input type="text" class="form-control @error('location') is-invalid @enderror"
                                        name="location" value="{{ old('location') }}"
                                        placeholder="Physical or virtual location">
                                </div>
                                @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                
                 <!-- Highlights & Rules -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-transparent border-bottom p-3">
                         <h5 class="card-title mb-0"><i class="feather feather-list me-2 text-primary"></i>Highlights & Rules</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Activity Highlights</label>
                            <div id="highlight-points" class="mb-2">
                                @if (old('highlights'))
                                    @foreach (old('highlights') as $index => $highlight)
                                        <div class="input-group mb-2">
                                            <span class="input-group-text"><i class="ti ti-star"></i></span>
                                            <input type="text" name="highlights[]"
                                                class="form-control @error('highlights.' . $index) is-invalid @enderror"
                                                placeholder="Example: Keynote speech by industry leader"
                                                value="{{ $highlight }}">
                                            <button type="button" class="btn btn-outline-danger remove-highlight"><i class="ti ti-trash"></i></button>
                                            @error('highlights.' . $index) <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" class="btn btn-light text-primary btn-sm add-highlight">
                                <i class="ti ti-plus me-1"></i> Add Highlight
                            </button>
                            @error('highlights') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                             <label class="form-label fw-bold">Rules & Guidelines</label>
                             <textarea class="form-control @error('rules') is-invalid @enderror" name="rules" rows="3">{{ old('rules') }}</textarea>
                             @error('rules') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
                
                 <!-- Sponsors -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-transparent border-bottom p-3 d-flex justify-content-between align-items-center">
                         <h5 class="card-title mb-0"><i class="feather feather-users me-2 text-primary"></i>Sponsors</h5>
                         <button type="button" class="btn btn-sm btn-primary" id="add-sponsor-btn">
                            <i class="ti ti-plus"></i> Add Sponsor
                        </button>
                    </div>
                    <div class="card-body p-4">
                        <div id="sponsor-repeater"></div>
                    </div>
                </div>

            </div>
            
            <!-- Right Column: Settings & Media -->
             <div class="col-lg-4">
                 <!-- Categorization -->
                 <div class="card border-0 shadow-sm mb-4">
                     <div class="card-header bg-transparent border-bottom p-3">
                        <h5 class="card-title mb-0"><i class="feather feather-settings me-2 text-primary"></i>Configuration</h5>
                     </div>
                     <div class="card-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Status</label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                         <div class="mb-3">
                            <label class="form-label fw-bold">Activity Type</label>
                            <select name="type" id="activity-type" class="form-select @error('type') is-invalid @enderror">
                                <option value="1" {{ old('type') == '1' ? 'selected' : '' }}>Event</option>
                                <option value="2" {{ old('type') == '2' ? 'selected' : '' }}>Competition</option>
                            </select>
                            @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                         <div class="mb-3">
                            <label class="form-label fw-bold">Category</label>
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Organizer</label>
                            <select name="organizer_id" class="form-select @error('organizer_id') is-invalid @enderror">
                                <option value="">Select Organizer</option>
                                @foreach ($organizers as $organizer)
                                    <option value="{{ $organizer->id }}" {{ old('organizer_id') == $organizer->id ? 'selected' : '' }}>{{ $organizer->name }}</option>
                                @endforeach
                            </select>
                            @error('organizer_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                 <label class="form-label fw-bold">Max Participants</label>
                                 <input type="number" class="form-control @error('max_participants') is-invalid @enderror"
                                    name="max_participants" value="{{ old('max_participants') }}" placeholder="Unlimited">
                                @error('max_participants') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label fw-bold">Entry Fee</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" class="form-control @error('entry_fee') is-invalid @enderror"
                                        name="entry_fee" value="{{ old('entry_fee', 0) }}">
                                </div>
                                @error('entry_fee') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                     </div>
                 </div>

                 <!-- Media -->
                 <div class="card border-0 shadow-sm mb-4">
                     <div class="card-header bg-transparent border-bottom p-3">
                        <h5 class="card-title mb-0"><i class="feather feather-image me-2 text-primary"></i>Media</h5>
                     </div>
                     <div class="card-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Thumbnail</label>
                            <input type="file" class="form-control mb-2 @error('thumbnail_image') is-invalid @enderror" name="thumbnail_image" accept="image/*">
                            @error('thumbnail_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Banner</label>
                             <input type="file" class="form-control mb-2 @error('banner_image') is-invalid @enderror" name="banner_image" accept="image/*">
                            @error('banner_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                         <div class="mb-3">
                             <label class="form-label fw-bold">Gallery</label>
                             <input type="file" class="form-control mb-2 @error('images') is-invalid @enderror" name="images[]" accept="image/*" multiple>
                              @error('images') <div class="invalid-feedback">{{ $message }}</div> @enderror
                         </div>
                     </div>
                 </div>

             </div>
        </div>

        <!-- Hidden Template for Sponsor Item -->
        <template id="sponsor-template">
            <div class="sponsor-item border rounded p-3 mb-3 bg-white shadow-sm position-relative">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-sponsor-btn" aria-label="Remove"></button>
                <div class="row align-items-center">
                    <div class="col-md-5 mb-2 mb-md-0">
                        <label class="form-label small text-muted">Sponsor Name</label>
                        <input type="text" class="form-control form-control-sm" name="sponsors[INDEX][name]" placeholder="Enter Name">
                    </div>
                    <div class="col-md-5 mb-2 mb-md-0">
                        <label class="form-label small text-muted">Details/Type</label>
                        <input type="text" class="form-control form-control-sm" name="sponsors[INDEX][details]" placeholder="e.g. Gold Partner">
                    </div>
                    <div class="col-md-2 text-center">
                         <label class="form-label small text-muted d-block">Logo</label>
                         <label class="btn btn-light btn-sm w-100 border">
                             <input type="file" class="d-none" name="sponsors[INDEX][logo]" accept="image/*">
                             <i class="ti ti-upload"></i>
                         </label>
                    </div>
                </div>
            </div>
        </template>
        
        <div class="d-flex justify-content-end mb-5">
            <a href="{{ route('admin.activity.index') }}" class="btn btn-light me-2 btn-lg">Cancel</a>
            <button type="submit" class="btn btn-primary btn-lg px-5">
                <i class="feather feather-save me-2"></i>Create Activity
            </button>
        </div>

    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize Summernote
            $('#summernote').summernote({
                height: 300,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview']]
                ],
                placeholder: 'Write detailed activity description here...'
            });

            // Auto-generate slug from title
            $('#activity-title').on('input', function() {
                const title = $(this).val();
                const slug = title.toLowerCase()
                    .replace(/\s+/g, '-')
                    .replace(/[^\w\-]+/g, '')
                    .replace(/\-\-+/g, '-')
                    .replace(/^-+/, '')
                    .replace(/-+$/, '');
                $('#activity-slug').val(slug);
            });

            // Toggle competition fields based on activity type
            // Toggle competition fields - REMOVED
            /*
            $('#activity-type').change(function() {
                if ($(this).val() == '2') {
                    $('#competition-fields').removeClass('d-none');
                } else {
                    $('#competition-fields').addClass('d-none');
                }
            });
            */

            // Highlight points management
            $(document).on('click', '.add-highlight', function() {
                const newHighlight = `
                    <div class="input-group mb-2">
                        <input type="text" name="highlights[]" class="form-control"
                            placeholder="Example: Keynote speech by industry leader">
                        <button type="button" class="btn btn-outline-danger remove-highlight">−</button>
                    </div>`;
                $('#highlight-points').append(newHighlight);
            });

            $(document).on('click', '.remove-highlight', function() {
                $(this).closest('.input-group').remove();
            });

            // Sponsor Repeater Logic
            let sponsorIndex = 0;
            const $sponsorRepeater = $('#sponsor-repeater');
            const $sponsorTemplate = $('#sponsor-template');

            $('#add-sponsor-btn').on('click', function() {
                const templateContent = $sponsorTemplate.html();
                const newItem = templateContent.replace(/INDEX/g, sponsorIndex);
                $sponsorRepeater.append(newItem);
                sponsorIndex++;
            });

            $(document).on('click', '.remove-sponsor-btn', function() {
                $(this).closest('.sponsor-item').remove();
            });

            // Add one empty sponsor by default if needed (optional)
            // $('#add-sponsor-btn').click();
        });
    </script>
@endpush
