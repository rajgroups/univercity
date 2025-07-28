@extends('layouts.admin.app')
@section('content')
    <div class="container mt-4">
        <div class="page-header">
            <div class="add-item d-flex">
                <div class="page-title">
                    <h4 class="fw-bold">Edit Blog News</h4>
                    <h6>Edit Blog News: {{ $blog->title }}</h6>
                </div>
            </div>
            <ul class="table-top-head">
                <li>
                    <a data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Refresh"><i class="ti ti-refresh"></i></a>
                </li>
                <li>
                    <a data-bs-toggle="tooltip" data-bs-placement="top" id="collapse-header" aria-label="Collapse">
                        <i class="ti ti-chevron-up"></i>
                    </a>
                </li>
            </ul>
            <div class="page-btn mt-0">
                <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">
                    <i class="feather feather-arrow-left me-2"></i>Back to List
                </a>
            </div>
        </div>
        <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
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
                                        <span>Blog News Information</span>
                                    </h5>
                                </div>
                            </div>
                        </h2>
                        <div id="SpacingOne" class="accordion-collapse collapse show">
                            <div class="accordion-body border-top">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="title" class="form-label">Blog Title <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="title"
                                            class="form-control @error('title') is-invalid @enderror" id="title"
                                            value="{{ old('title', $blog->title) }}" required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="menu_title" class="form-label">Menu Title</label>
                                        <input type="text" name="menu_title"
                                            class="form-control @error('menu_title') is-invalid @enderror" id="menu_title"
                                            value="{{ old('menu_title', $blog->menu_title) }}">
                                        @error('menu_title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="category_id" class="form-label">Category</label>
                                        <select name="category_id" id="category_id"
                                            class="form-select @error('category_id') is-invalid @enderror">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id', $blog->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="subtitle" class="form-label">Subtitle</label>
                                        <input type="text" name="subtitle"
                                            class="form-control @error('subtitle') is-invalid @enderror" id="subtitle"
                                            value="{{ old('subtitle', $blog->subtitle) }}">
                                        @error('subtitle')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="mb-3">
                                        <label for="short_description" class="form-label">Short Description <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="short_description"
                                            class="form-control @error('short_description') is-invalid @enderror"
                                            id="short_description" value="{{ old('short_description', $blog->short_description) }}" required>
                                        @error('short_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                                    <input type="text" name="slug"
                                        class="form-control @error('slug') is-invalid @enderror" id="slug"
                                        value="{{ old('slug', $blog->slug) }}" required>
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="image" class="form-label">Thumbnail Image</label>
                                        <input type="file" name="image"
                                            class="form-control @error('image') is-invalid @enderror" id="image">
                                        @if($blog->image)
                                            <div class="mt-2">
                                                <img src="{{ asset($blog->image) }}" width="100" class="img-thumbnail">
                                                <a href="#" class="btn btn-sm btn-danger ms-2 remove-image" data-field="image">Remove</a>
                                                <input type="hidden" name="remove_image" id="remove_image" value="0">
                                            </div>
                                        @endif
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="banner_image" class="form-label">Banner Image</label>
                                        <input type="file" name="banner_image"
                                            class="form-control @error('banner_image') is-invalid @enderror"
                                            id="banner_image">
                                        @if($blog->banner_image)
                                            <div class="mt-2">
                                                <img src="{{ asset($blog->banner_image) }}" width="100" class="img-thumbnail">
                                                <a href="#" class="btn btn-sm btn-danger ms-2 remove-image" data-field="banner_image">Remove</a>
                                                <input type="hidden" name="remove_banner_image" id="remove_banner_image" value="0">
                                            </div>
                                        @endif
                                        @error('banner_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="type" class="form-label">Blog Type</label>
                                    <select name="type" id="type"
                                        class="form-select @error('type') is-invalid @enderror">
                                        <option value="1" {{ old('type', $blog->type) == '1' ? 'selected' : '' }}>Blog</option>
                                        <option value="2" {{ old('type', $blog->type) == '2' ? 'selected' : '' }}>News</option>
                                        <option value="3" {{ old('type', $blog->type) == '3' ? 'selected' : '' }}>Collaboration</option>
                                        <option value="4" {{ old('type', $blog->type) == '4' ? 'selected' : '' }}>Training Model</option>
                                        <option value="5" {{ old('type', $blog->type) == '5' ? 'selected' : '' }}>Research and Publication</option>
                                        <option value="6" {{ old('type', $blog->type) == '6' ? 'selected' : '' }}>Case Studies</option>
                                        <option value="7" {{ old('type', $blog->type) == '7' ? 'selected' : '' }}>Resource</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-12">
                                    <div class="summer-description-box">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" id="summernote" cols="30" rows="10"
                                            class="form-control @error('description') is-invalid @enderror">{{ old('description', $blog->description) }}</textarea>
                                        <p class="fs-14 mt-1">Maximum 60 Words</p>
                                        @error('description')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Bullet Points -->
                                <div class="mb-3">
                                    <label class="form-label">Bullet Points (key - value)</label>
                                    <div id="bullet-points">
                                        @php
                                            $points = old('points', $blog->points ? json_decode($blog->points, true) : []);
                                        @endphp

                                        @if(count($points) > 0)
                                            @foreach ($points as $index => $point)
                                                <div class="input-group mb-2">
                                                    <input type="text" name="points[]"
                                                        class="form-control @error('points.' . $index) is-invalid @enderror"
                                                        placeholder="Example: Curriculum Integration - Blending vocational skills with academics"
                                                        value="{{ $point }}">
                                                    <button type="button"
                                                        class="btn btn-outline-danger remove-bullet">−</button>
                                                    @error('points.' . $index)
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="input-group mb-2">
                                                <input type="text" name="points[]" class="form-control" placeholder="Example: Curriculum Integration - Blending vocational skills with academics">
                                                <button type="button" class="btn btn-outline-secondary add-bullet">+</button>
                                            </div>
                                        @endif
                                    </div>
                                    @error('points')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                                        <option value="1" {{ old('status', $blog->status) == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status', $blog->status) == '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.js"></script>
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

            // Add/Remove bullet points
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

            // Remove image functionality
            $('.remove-image').click(function(e) {
                e.preventDefault();
                const field = $(this).data('field');
                $(`#remove_${field}`).val('1');
                $(this).parent().hide();
            });
        });
    </script>
@endpush
