@extends('layouts.admin.app')

@section('content')
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Edit Project</h4>
                <h6>Update existing Project</h6>
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

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

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

    <form action="{{ route('admin.project.update', $project->id) }}" method="POST" enctype="multipart/form-data"
        class="add-product-form">
        @csrf
        @method('PUT')

        <div class="add-product">
            <div class="accordions-items-seperate" id="accordionSpacingExample">
                <div class="accordion-item border mb-4">
                    <h2 class="accordion-header" id="headingSpacingOne">
                        <div class="accordion-button collapsed bg-white" data-bs-toggle="collapse"
                            data-bs-target="#SpacingOne">
                            <div class="d-flex align-items-center justify-content-between flex-fill">
                                <h5 class="d-flex align-items-center">
                                    <i class="feather feather-info text-primary me-2"></i>
                                    <span>Project Information</span>
                                </h5>
                            </div>
                        </div>
                    </h2>

                    <div id="SpacingOne" class="accordion-collapse collapse show">
                        <div class="accordion-body border-top">
                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Project Title <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            name="title" value="{{ old('title', $project->title) }}">
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

                            <div class="mb-3">
                                <label class="form-label">Short Description</label>
                                <textarea class="form-control @error('short_description') is-invalid @enderror" name="short_description" rows="3">{{ old('short_description', $project->short_description) }}</textarea>
                                @error('short_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Image </label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror"
                                            name="image" accept="image/*">
                                        @if ($project->image)
                                            <img src="{{ asset($project->image) }}" class="mt-2" height="80">
                                        @endif
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Maximum file size: 5MB. Allowed types: JPG, PNG, JPEG, etc.</small>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Banner Image </label>
                                        <input type="file"
                                            class="form-control @error('banner_image') is-invalid @enderror"
                                            name="banner_image" accept="image/*">
                                        @if ($project->banner_image)
                                            <img src="{{ asset($project->banner_image) }}" class="mt-2" height="80">
                                        @endif
                                        @error('banner_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Maximum file size: 5MB. Allowed types: JPG, PNG, JPEG, etc.</small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Type <span class="text-danger">*</span></label>
                                        <select name="type" class="form-select @error('type') is-invalid @enderror">
                                            <option value="">Select Type</option>
                                            <option value="1" {{ old('type', $project->type) == '1' ? 'selected' : '' }}>On Going</option>
                                            <option value="2" {{ old('type', $project->type) == '2' ? 'selected' : '' }}>Up Coming</option>
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
                                            <option value="">Select Status</option>
                                            <option value="1"
                                                {{ old('status', $project->status) == '1' ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="0"
                                                {{ old('status', $project->status) == '0' ? 'selected' : '' }}>Inactive
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
                                    <div class="mb-3">
                                        <label class="form-label">Sub Title</label>
                                        <input type="text" name="subtitle"
                                            class="form-control @error('subtitle') is-invalid @enderror"
                                            value="{{ old('subtitle', $project->subtitle) }}">
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
                            <div class="mb-3">
                                <label class="form-label">Bullet Points (key - value)</label>
                                <div id="bullet-points">
                                    @php
                                        $points = old(
                                            'points',
                                            is_array($project->points ?? null)
                                                ? $project->points
                                                : json_decode($project->points ?? '[]', true),
                                        );
                                    @endphp

                                    @if (!empty($points))
                                        @foreach ($points as $index => $point)
                                            <div class="input-group mb-2">
                                                <input type="text" name="points[]"
                                                    class="form-control @error('points.' . $index) is-invalid @enderror"
                                                    value="{{ $point }}" placeholder="Example: Key - Value">
                                                <button type="button"
                                                    class="btn btn-outline-danger remove-bullet">−</button>
                                                @error('points.' . $index)
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        @endforeach
                                        <div class="input-group mb-2">
                                            <input type="text" name="points[]" class="form-control"
                                                placeholder="Example: Key - Value">
                                            <button type="button" class="btn btn-outline-secondary add-bullet">+</button>
                                        </div>
                                    @else
                                        <div class="input-group mb-2">
                                            <input type="text" name="points[]" class="form-control"
                                                placeholder="Example: Key - Value">
                                            <button type="button" class="btn btn-outline-secondary add-bullet">+</button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="summer-description-box">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" id="summernote" class="form-control @error('description') is-invalid @enderror"
                                        rows="6">{{ old('description', $project->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
                            
                            <div class="col-lg-12 mt-3">
                                <div class="d-flex align-items-center justify-content-end mb-4">
                                    <a href="{{ route('admin.project.index') }}"
                                        class="btn btn-secondary me-2">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Update Project</button>
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

            $('input[name="title"]').on('input', function() {
                let title = $(this).val();
                let slug = title.toString().toLowerCase()
                    .replace(/\s+/g, '-')
                    .replace(/[^\w\-]+/g, '')
                    .replace(/\-\-+/g, '-')
                    .replace(/^-+/, '')
                    .replace(/-+$/, '');
                $('input[name="slug"]').val(slug);
            });

            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('add-bullet')) {
                    e.preventDefault();
                    const group = `
                        <div class="input-group mb-2">
                            <input type="text" name="points[]" class="form-control" placeholder="Key - Value">
                            <button type="button" class="btn btn-outline-danger remove-bullet">−</button>
                        </div>`;
                    document.getElementById('bullet-points').insertAdjacentHTML('beforeend', group);
                }

                if (e.target.classList.contains('remove-bullet')) {
                    e.preventDefault();
                    e.target.closest('.input-group').remove();
                }
            });
        });
    </script>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bulletPointsContainer = document.getElementById('bullet-points');

            bulletPointsContainer.addEventListener('click', function(e) {
                if (e.target.classList.contains('add-bullet')) {
                    const newField = document.createElement('div');
                    newField.classList.add('input-group', 'mb-2');
                    newField.innerHTML = `
                    <input type="text" name="points[]" class="form-control" placeholder="Example: Key - Value">
                    <button type="button" class="btn btn-outline-danger remove-bullet">−</button>
                `;
                    bulletPointsContainer.appendChild(newField);
                    // e.target.remove(); // remove the `+` button from the previous input
                }

                if (e.target.classList.contains('remove-bullet')) {
                    const inputGroup = e.target.closest('.input-group');
                    if (inputGroup) {
                        inputGroup.remove();
                    }
                }
            });
        });
    </script>
@endpush
