@extends('layouts.admin.app')
@section('content')
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Edit Activity</h4>
                <h6>Update Activity (Event or Competition)</h6>
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
    @if ($errors->any())
        )
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('admin.activity.update', $activity->id) }}" method="POST" enctype="multipart/form-data"
        class="edit-activity-form">
        @csrf
        @method('PUT')
        <div class="edit-activity">
            <div class="accordions-items-seperate" id="accordionSpacingExample">
                <div class="accordion-item border mb-4">
                    <h2 class="accordion-header" id="headingSpacingOne">
                        <div class="accordion-button collapsed bg-white" data-bs-toggle="collapse"
                            data-bs-target="#SpacingOne">
                            <div class="d-flex align-items-center justify-content-between flex-fill">
                                <h5 class="d-flex align-items-center">
                                    <i class="feather feather-info text-primary me-2"></i>
                                    <span>Activity Information</span>
                                </h5>
                            </div>
                        </div>
                    </h2>

                    <div id="SpacingOne" class="accordion-collapse collapse show">
                        <div class="accordion-body border-top">
                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Title(Event & competition) <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            name="title" value="{{ old('title', $activity->title) }}"
                                            placeholder="Enter Activity title" id="activity-title">
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Slug <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                            name="slug" value="{{ old('slug', $activity->slug) }}" id="activity-slug">
                                        @error('slug')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Short Description -->
                            <div class="mb-3">
                                <label for="short_description" class="form-label">Short Description<span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control @error('short_description') is-invalid @enderror" name="short_description"
                                    id="short_description" rows="3" placeholder="Brief description for listings...">{{ old('short_description', $activity->short_description) }}</textarea>
                                @error('short_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Sponsor Information -->
                            <div class="row">
                                <div class="col-12">
                                    <h6 class="mb-3">Sponsor Information</h6>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Sponsor Name</label>
                                        <input type="text"
                                            class="form-control @error('sponsor_name') is-invalid @enderror"
                                            name="sponsor_name" value="{{ old('sponsor_name', $activity->sponsor_name) }}"
                                            placeholder="Enter sponsor name">
                                        @error('sponsor_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Sponsor Details</label>
                                        <input type="text"
                                            class="form-control @error('sponsor_details') is-invalid @enderror"
                                            name="sponsor_details"
                                            value="{{ old('sponsor_details', $activity->sponsor_details) }}"
                                            placeholder="e.g., Gold Sponsor, CSR Partner">
                                        @error('sponsor_details')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Sponsor Logo/Image</label>
                                        <input type="file"
                                            class="form-control @error('sponsor_logo') is-invalid @enderror"
                                            name="sponsor_logo" accept="image/*">
                                        @error('sponsor_logo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Recommended: 300×150px (Max 1MB)</small>
                                        @if ($activity->sponsor_logo)
                                            <div class="mt-2">
                                                <img src="{{ asset($activity->sponsor_logo) }}" class="img-thumbnail"
                                                    width="100">
                                                <a href="{{ asset($activity->sponsor_logo) }}" target="_blank"
                                                    class="ms-2">View Current</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Start Date <span class="text-danger">*</span></label>
                                        <input type="datetime-local"
                                            class="form-control @error('start_date') is-invalid @enderror"
                                            name="start_date"
                                            value="{{ old('start_date', $activity->start_date->format('Y-m-d\TH:i')) }}">
                                        @error('start_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">End Date <span class="text-danger">*</span></label>
                                        <input type="datetime-local"
                                            class="form-control @error('end_date') is-invalid @enderror" name="end_date"
                                            value="{{ old('end_date', $activity->end_date->format('Y-m-d\TH:i')) }}">
                                        @error('end_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Location <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('location') is-invalid @enderror"
                                            name="location" value="{{ old('location', $activity->location) }}"
                                            placeholder="Physical or virtual location">
                                        @error('location')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Registration Deadline</label>
                                        <input type="datetime-local"
                                            class="form-control @error('registration_deadline') is-invalid @enderror"
                                            name="registration_deadline"
                                            value="{{ old('registration_deadline', optional($activity->registration_deadline ?? null)->format('Y-m-d\TH:i')) }}">
                                        @error('registration_deadline')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Thumbnail Image</label>
                                        <input type="file"
                                            class="form-control @error('thumbnail_image') is-invalid @enderror"
                                            name="thumbnail_image" accept="image/*">
                                        @error('thumbnail_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Recommended: 600×600px (Max 2MB)</small>
                                        @if ($activity->thumbnail_image)
                                            <div class="mt-2">
                                                <img src="{{ asset($activity->thumbnail_image) }}" class="img-thumbnail"
                                                    width="100">
                                                <a href="{{ asset($activity->thumbnail_image) }}" target="_blank"
                                                    class="ms-2">View Current</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Banner Image</label>
                                        <input type="file"
                                            class="form-control @error('banner_image') is-invalid @enderror"
                                            name="banner_image" accept="image/*">
                                        @error('banner_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Recommended: 1200×400px (Max 3MB)</small>
                                        @if ($activity->banner_image)
                                            <div class="mt-2">
                                                <img src="{{ asset($activity->banner_image) }}" class="img-thumbnail"
                                                    width="200">
                                                <a href="{{ asset($activity->banner_image) }}" target="_blank"
                                                    class="ms-2">View Current</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Activity Type <span class="text-danger">*</span></label>
                                        <select name="type" id="activity-type"
                                            class="form-select @error('type') is-invalid @enderror">
                                            <option value="1"
                                                {{ old('type', $activity->type) == '1' ? 'selected' : '' }}>Event</option>
                                            <option value="2"
                                                {{ old('type', $activity->type) == '2' ? 'selected' : '' }}>Competition
                                            </option>
                                        </select>
                                        @error('type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Status <span class="text-danger">*</span></label>
                                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                                            <option value="0"
                                                {{ old('status', $activity->status) == '0' ? 'selected' : '' }}>Draft
                                            </option>
                                            <option value="1"
                                                {{ old('status', $activity->status) == '1' ? 'selected' : '' }}>Upcoming
                                            </option>
                                            <option value="2"
                                                {{ old('status', $activity->status) == '2' ? 'selected' : '' }}>Ongoing
                                            </option>
                                            <option value="3"
                                                {{ old('status', $activity->status) == '3' ? 'selected' : '' }}>Completed
                                            </option>
                                            <option value="4"
                                                {{ old('status', $activity->status) == '4' ? 'selected' : '' }}>Cancelled
                                            </option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Organizer</label>
                                        <select name="organizer_id"
                                            class="form-select @error('organizer_id') is-invalid @enderror">
                                            <option value="">Select Organizer</option>
                                            @foreach ($organizers as $organizer)
                                                <option value="{{ $organizer->id }}"
                                                    {{ old('organizer_id', $activity->organizer_id) == $organizer->id ? 'selected' : '' }}>
                                                    {{ $organizer->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('organizer_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Category <span class="text-danger">*</span></label>
                                        <select name="category_id"
                                            class="form-select @error('category_id') is-invalid @enderror">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id', $activity->category_id) == $category->id ? 'selected' : '' }}>
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

                            <!-- Competition Specific Fields -->
                            <div id="competition-fields"
                                class="{{ old('type', $activity->type) == '2' ? '' : 'd-none' }}">
                                <div class="row">
                                    <div class="col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Max Participants</label>
                                            <input type="number"
                                                class="form-control @error('max_participants') is-invalid @enderror"
                                                name="max_participants"
                                                value="{{ old('max_participants', $activity->max_participants) }}"
                                                placeholder="Leave empty for unlimited">
                                            @error('max_participants')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Entry Fee</label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" step="0.01"
                                                    class="form-control @error('entry_fee') is-invalid @enderror"
                                                    name="entry_fee"
                                                    value="{{ old('entry_fee', $activity->entry_fee ?? 0) }}">
                                                @error('entry_fee')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Competition Rules</label>
                                    <textarea class="form-control @error('rules') is-invalid @enderror" name="rules" rows="3">{{ old('rules', $activity->rules) }}</textarea>
                                    @error('rules')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Activity Highlights -->
                            <div class="mb-3">
                                <label class="form-label">Activity Highlights</label>
                                <div id="highlight-points">
                                    @php
                                        $highlights = old('highlights', $activity->highlights ?? []);
                                        if (is_string($highlights)) {
                                            $highlights = json_decode($highlights, true) ?? [];
                                        }
                                    @endphp

                                    @if (count($highlights) > 0)
                                        @foreach ($highlights as $index => $highlight)
                                            <div class="input-group mb-2">
                                                <input type="text" name="highlights[]"
                                                    class="form-control @error('highlights.' . $index) is-invalid @enderror"
                                                    placeholder="Example: Keynote speech by industry leader"
                                                    value="{{ $highlight }}">
                                                <button type="button"
                                                    class="btn btn-outline-danger remove-highlight">−</button>
                                                @error('highlights.' . $index)
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="input-group mb-2">
                                            <input type="text" name="highlights[]" class="form-control"
                                                placeholder="Example: Keynote speech by industry leader">
                                            <button type="button"
                                                class="btn btn-outline-secondary add-highlight">+</button>
                                        </div>
                                    @endif
                                </div>
                                @error('highlights')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Full Description -->
                            <div class="col-lg-12">
                                <div class="summer-description-box">
                                    <label class="form-label">Full Description <span class="text-danger">*</span></label>
                                    <textarea name="description" id="summernote" class="form-control @error('description') is-invalid @enderror"
                                        rows="6">{{ old('description', $activity->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Gallery Images <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control @error('images') is-invalid @enderror"
                                        name="images[]" accept="image/*" multiple>
                                    @error('images')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Recommended: 1200×400px (Max 3MB)</small>
                                </div>
                            </div>

                            <div class="col-lg-12 mt-3">
                                <div class="d-flex align-items-center justify-content-end mb-4">
                                    <a href="{{ route('admin.activity.index') }}"
                                        class="btn btn-secondary me-2">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Update Activity</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize Summernote with existing content
            $('#summernote').summernote({
                height: 300,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview']]
                ]
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
            $('#activity-type').change(function() {
                if ($(this).val() == '2') {
                    $('#competition-fields').removeClass('d-none');
                } else {
                    $('#competition-fields').addClass('d-none');
                }
            }).trigger('change'); // Trigger on load to set initial state

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
        });
    </script>
@endpush
