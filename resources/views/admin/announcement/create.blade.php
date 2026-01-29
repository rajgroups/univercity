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
        class="add-product-form">
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
                                            name="title" value="{{ old('title') }}" placeholder="Please Enter Announcement title">
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

                            <!-- Description -->
                            <div class="mb-3">
                                <label for="short_description" class="form-label">Short Description <span class="text-danger">*</span> </label>
                                <textarea class="form-control @error('short_description') is-invalid @enderror" name="short_description"
                                    id="short_description" rows="3" class="form-control" placeholder="Brief short_description...">{{ old('short_description') }}</textarea>
                                @error('slug')
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
                                        <small class="form-text text-muted">Maximum file size: 5MB. Allowed types: JPG, PNG, JPEG, etc.</small>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Banner Image <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror"
                                            name="banner_image" accept="image/*">
                                        @error('banner_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Maximum file size: 5MB. Allowed types: JPG, PNG, JPEG, etc.</small>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Type <span class="text-danger">*</span></label>
                                        <select name="type" class="form-select @error('type') is-invalid @enderror"
                                            test>
                                            <option value="">Select Type</option>
                                            <option value="1" {{ old('type') == '1' ? 'selected' : '' }}>Program
                                            </option>
                                            <option value="2" {{ old('type') == '2' ? 'selected' : '' }}>Scheme
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
                                        <select name="status" class="form-select @error('status') is-invalid @enderror"
                                            test>
                                            <option value="">Select Status</option>
                                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive
                                            </option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
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
                                        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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

                            <!-- Bullet Points -->
                            <div class="mb-3">
                                <label class="form-label">Bullet Points (key - value)</label>
                                <div id="bullet-points">
                                    {{-- Loop through old 'points' to repopulate existing ones --}}
                                    @if (old('points'))
                                        @foreach (old('points') as $index => $point)
                                            <div class="input-group mb-2">
                                                <input type="text" name="points[]"
                                                    class="form-control @error('points.' . $index) is-invalid @enderror"
                                                    placeholder="Example: Curriculum Integration - Blending vocational skills with academics"
                                                    value="{{ $point }}">
                                                <button type="button"
                                                    class="btn btn-outline-danger remove-bullet">−</button>
                                            </div>
                                                @error('points.' . $index)
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                        @endforeach
                                    @else
                                        {{-- Initial empty input for new announcement --}}
                                        <div class="input-group mb-2">
                                            <input type="text" name="points[]" class="form-control" placeholder="Example: Curriculum Integration - Blending vocational skills with academics">
                                            <button type="button" class="btn btn-outline-secondary add-bullet">+</button>
                                        </div>
                                    @endif
                                </div>
                                {{-- This is for a general error related to the 'points' array itself (e.g., if it's test) --}}
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
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('add-bullet')) {
                e.preventDefault();
                const group = `
                <div class="input-group mb-2">
                    <input type="text" name="bullets[]" class="form-control" placeholder="Key - Value">
                    <button type="button" class="btn btn-outline-danger remove-bullet">−</button>
                </div>`;
                document.getElementById('bullet-points').insertAdjacentHTML('beforeend', group);
            }

            if (e.target.classList.contains('remove-bullet')) {
                e.preventDefault();
                e.target.closest('.input-group').remove();
            }
        });
    </script>
@endpush
