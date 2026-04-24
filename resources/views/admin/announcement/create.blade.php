@push('css')
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.css"> --}}
@endpush

@extends('layouts.admin.app')
@section('content')
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Create Announcement</h4>
                <h6>Create new Announcement</h6>
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
            <a href="{{ route('admin.announcement.index') }}" class="btn btn-secondary">
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

    <form action="{{ route('admin.announcement.store') }}" method="POST" enctype="multipart/form-data"
        id="announcement-form"
        class="add-product-form needs-validation" novalidate>
        @csrf
        <div class="add-product">
            <div class="accordions-items-seperate" id="accordionSpacingExample">
                <div class="accordion-item border mb-4">
                    <h2 class="accordion-header" id="headingSpacingOne">
                        <div class="accordion-button collapsed bg-white" data-bs-toggle="collapse"
                            data-bs-target="#SpacingOne">
                            <div class="d-flex align-items-center justify-content-between flex-fill">
                                <h5 class="d-flex align-items-center">
                                    <i class="feather feather-info text-primary me-2"></i>
                                    <span>Announcement Information</span>
                                </h5>
                            </div>
                        </div>
                    </h2>

                    <div id="SpacingOne" class="accordion-collapse collapse show">
                        <div class="accordion-body border-top">
                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Announcement Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control  @error('title') is-invalid @enderror"
                                            name="title" value="{{ old('title') }}" placeholder="Please Enter Announcement title" required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @else
                                            <div class="invalid-feedback">Please enter the announcement title.</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Slug <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                            name="slug" value="{{ old('slug') }}" required>
                                        @error('slug')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @else
                                            <div class="invalid-feedback">Please provide a valid slug.</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label for="short_description" class="form-label">Short Description <span class="text-danger">*</span> </label>
                                <textarea class="form-control @error('short_description') is-invalid @enderror" name="short_description"
                                    id="short_description" rows="3" placeholder="Brief short description..." required>{{ old('short_description') }}</textarea>
                                @error('short_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Please enter a short description.</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Image <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror"
                                            name="image" accept="image/*" required>
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @else
                                            <div class="invalid-feedback">Please upload an image.</div>
                                        @enderror
                                        <small class="form-text text-muted">Maximum file size: 5MB. Allowed types: JPG, PNG, JPEG, etc.</small>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Banner Image <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control @error('banner_image') is-invalid @enderror"
                                            name="banner_image" accept="image/*" required>
                                        @error('banner_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @else
                                            <div class="invalid-feedback">Please upload a banner image.</div>
                                        @enderror
                                        <small class="form-text text-muted">Maximum file size: 5MB. Allowed types: JPG, PNG, JPEG, etc.</small>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Type <span class="text-danger">*</span></label>
                                        <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                                            <option value="">Select Type</option>
                                            <option value="1" {{ old('type') == '1' ? 'selected' : '' }}>Program
                                            </option>
                                            <option value="2" {{ old('type') == '2' ? 'selected' : '' }}>Scheme
                                            </option>
                                        </select>
                                        @error('type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @else
                                            <div class="invalid-feedback">Please select a type.</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Status <span class="text-danger">*</span></label>
                                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                            <option value="">Select Status</option>
                                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive
                                            </option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @else
                                            <div class="invalid-feedback">Please select a status.</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                                                       <div class="row">
                                <div class="col-md-6">
                                    <!-- /Editor -->
                                    <div class="mb-3">
                                        <label for="subtitle" class="form-label">Sub Title <span class="text-danger">*</span></label>
                                        <input type="text" name="subtitle" id="subtitle" class="form-control @error('subtitle') is-invalid @enderror" value="{{ old('subtitle') }}" placeholder="Enter program sub title" required>
                                        @error('subtitle')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @else
                                            <div class="invalid-feedback">Please enter a sub title.</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="duration" class="form-label">Duration</label>
                                        <input type="text" name="duration" id="duration" class="form-control @error('duration') is-invalid @enderror" value="{{ old('duration') }}" placeholder="e.g. 6 Months / Self-Paced">
                                        @error('duration')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                     <!-- Category Select Dropdown -->
                                    <div class="mb-3">
                                        <label class="form-label">Category <span class="text-danger">*</span></label>
                                        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @else
                                            <div class="invalid-feedback">Please select a category.</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Bullet Points -->
                            <div class="mb-3">
                                <label class="form-label">Bullet Points</label>
                                <p class="text-muted small mb-2">Add separate title and description for each highlight.</p>
                                <div id="bullet-points">
                                    @php
                                        $points = old('points', [['title' => '', 'description' => '']]);
                                    @endphp

                                    @foreach ($points as $index => $point)
                                        <div class="bullet-point-item border rounded p-3 mb-3">
                                            <div class="row g-2 align-items-start">
                                                <div class="col-md-4">
                                                    <input type="text"
                                                        name="points[{{ $index }}][title]"
                                                        class="form-control bullet-title @error('points.' . $index . '.title') is-invalid @enderror"
                                                        placeholder="Title"
                                                        value="{{ $point['title'] ?? '' }}">
                                                    @error('points.' . $index . '.title')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-7">
                                                    <input type="text"
                                                        name="points[{{ $index }}][description]"
                                                        class="form-control bullet-description @error('points.' . $index . '.description') is-invalid @enderror"
                                                        placeholder="Description"
                                                        value="{{ $point['description'] ?? '' }}">
                                                    @error('points.' . $index . '.description')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="button"
                                                        class="btn btn-outline-{{ $loop->first ? 'secondary add' : 'danger remove' }}-bullet w-100">
                                                        {{ $loop->first ? '+' : '−' }}
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="bullet-row-error text-danger small mt-2 d-none"></div>
                                        </div>
                                    @endforeach
                                </div>
                                @error('points')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <div class="summer-description-box">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" id="summernote" class="form-control @error('description') is-invalid @enderror"
                                        rows="6" maxlength="600">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <p class="fs-14 mt-1">Maximum 60 Words</p>
                                </div>
                            </div>
                            <!-- Attachments (PDF) -->
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label class="form-label mb-0 fw-bold">Attachments (PDF Only)</label>
                                    <button type="button" class="btn btn-outline-primary btn-sm add-attachment">
                                        <i class="ti ti-plus"></i> Add More
                                    </button>
                                </div>
                                <div id="attachment-repeater">
                                    <div class="row align-items-center mb-2 attachment-item">
                                        <div class="col-md-5">
                                            <input type="text" name="attachments[0][name]" class="form-control" placeholder="Document Name (e.g. Brochure)">
                                        </div>
                                        <div class="col-md-5">
                                            <input type="file" name="attachments[0][file]" class="form-control" accept="application/pdf">
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-outline-danger remove-attachment w-100" disabled>−</button>
                                        </div>
                                    </div>
                                </div>
                                @error('attachments')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Source Links -->
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label class="form-label mb-0 fw-bold">Source Links</label>
                                    <button type="button" class="btn btn-outline-primary btn-sm add-source-link">
                                        <i class="ti ti-plus"></i> Add More
                                    </button>
                                </div>
                                <div id="source-link-repeater">
                                    <div class="row align-items-center mb-2 source-link-item">
                                        <div class="col-md-5">
                                            <input type="text" name="source_links[0][label]" class="form-control" placeholder="Link Label (e.g. Official Website)">
                                        </div>
                                        <div class="col-md-5">
                                            <input type="url" name="source_links[0][url]" class="form-control" placeholder="https://example.com">
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-outline-danger remove-source-link w-100" disabled>−</button>
                                        </div>
                                    </div>
                                </div>
                                @error('source_links')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Gallery Images </label>
                                    <input type="file" class="form-control @error('gallery') is-invalid @enderror" name="gallery[]" accept="image/*" multiple>
                                    @error('gallery')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Recommended: 1200×400px (Max 3MB)</small>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="d-flex align-items-center justify-content-end mb-4">
                                    <a href="{{ route('admin.announcement.index') }}" class="btn btn-secondary me-2">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Create Announcement</button>
                                </div>
                            </div>
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
            $('#summernote').summernote({
                height: 200,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview']]
                ],
                placeholder: 'Write your project description here (max 60 words)...'
            });
        });
    </script>
    <script>
        function generateSlug(text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-') // Replace spaces with -
                .replace(/[^\w\-]+/g, '') // Remove all non-word characters
                .replace(/\-\-+/g, '-') // Replace multiple - with single -
                .replace(/^-+/, '') // Trim - from start of text
                .replace(/-+$/, ''); // Trim - from end of text
        }

        $(document).ready(function() {
            $('input[name="title"]').on('input', function() {
                let title = $(this).val();
                let slug = generateSlug(title);
                $('input[name="slug"]').val(slug);
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bulletContainer = document.getElementById('bullet-points');
            const announcementForm = document.getElementById('announcement-form');

            function bulletRowTemplate(index) {
                return `
                <div class="bullet-point-item border rounded p-3 mb-3">
                    <div class="row g-2 align-items-start">
                        <div class="col-md-4">
                            <input type="text" name="points[${index}][title]" class="form-control bullet-title" placeholder="Title">
                        </div>
                        <div class="col-md-7">
                            <input type="text" name="points[${index}][description]" class="form-control bullet-description" placeholder="Description">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-outline-danger remove-bullet w-100">−</button>
                        </div>
                    </div>
                    <div class="bullet-row-error text-danger small mt-2 d-none"></div>
                </div>`;
            }

            function resetBulletValidation(row) {
                row.querySelectorAll('.bullet-title, .bullet-description').forEach((input) => {
                    input.classList.remove('is-invalid');
                });

                const errorBox = row.querySelector('.bullet-row-error');
                errorBox.textContent = '';
                errorBox.classList.add('d-none');
            }

            function validateBulletRows() {
                let isValid = true;

                bulletContainer.querySelectorAll('.bullet-point-item').forEach((row) => {
                    resetBulletValidation(row);

                    const title = row.querySelector('.bullet-title');
                    const description = row.querySelector('.bullet-description');
                    const titleValue = title.value.trim();
                    const descriptionValue = description.value.trim();

                    if (!titleValue && !descriptionValue) {
                        return;
                    }

                    if (!titleValue || !descriptionValue) {
                        isValid = false;
                        title.classList.toggle('is-invalid', !titleValue);
                        description.classList.toggle('is-invalid', !descriptionValue);

                        const errorBox = row.querySelector('.bullet-row-error');
                        errorBox.textContent = 'Both title and description are required for each bullet point.';
                        errorBox.classList.remove('d-none');
                    }
                });

                return isValid;
            }

            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('add-bullet')) {
                    e.preventDefault();
                    const index = bulletContainer.querySelectorAll('.bullet-point-item').length;
                    bulletContainer.insertAdjacentHTML('beforeend', bulletRowTemplate(index));
                }

                if (e.target.classList.contains('remove-bullet')) {
                    e.preventDefault();
                    e.target.closest('.bullet-point-item').remove();
                }

                // Attachment Logic
                if (e.target.closest('.add-attachment')) {
                    e.preventDefault();
                    const container = document.getElementById('attachment-repeater');
                    const index = container.getElementsByClassName('attachment-item').length;
                    const html = `
                    <div class="row align-items-center mb-2 attachment-item">
                        <div class="col-md-5">
                            <input type="text" name="attachments[${index}][name]" class="form-control" placeholder="Document Name">
                        </div>
                        <div class="col-md-5">
                            <input type="file" name="attachments[${index}][file]" class="form-control" accept="application/pdf">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-outline-danger remove-attachment w-100">−</button>
                        </div>
                    </div>`;
                    container.insertAdjacentHTML('beforeend', html);
                }
                if (e.target.closest('.remove-attachment')) {
                    e.preventDefault();
                    e.target.closest('.attachment-item').remove();
                }

                // Source Link Logic
                if (e.target.closest('.add-source-link')) {
                    e.preventDefault();
                    const container = document.getElementById('source-link-repeater');
                    const index = container.getElementsByClassName('source-link-item').length;
                    const html = `
                    <div class="row align-items-center mb-2 source-link-item">
                        <div class="col-md-5">
                            <input type="text" name="source_links[${index}][label]" class="form-control" placeholder="Link Label">
                        </div>
                        <div class="col-md-5">
                            <input type="url" name="source_links[${index}][url]" class="form-control" placeholder="https://example.com">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-outline-danger remove-source-link w-100">−</button>
                        </div>
                    </div>`;
                    container.insertAdjacentHTML('beforeend', html);
                }
                if (e.target.closest('.remove-source-link')) {
                    e.preventDefault();
                    e.target.closest('.source-link-item').remove();
                }
            });

            bulletContainer.addEventListener('input', function(e) {
                const row = e.target.closest('.bullet-point-item');
                if (row && (e.target.classList.contains('bullet-title') || e.target.classList.contains('bullet-description'))) {
                    resetBulletValidation(row);
                }
            });

            announcementForm.addEventListener('submit', function(e) {
                if (!announcementForm.checkValidity() || !validateBulletRows()) {
                    e.preventDefault();
                    e.stopPropagation();
                }
                announcementForm.classList.add('was-validated');
            }, false);
        });
    </script>
@endpush
