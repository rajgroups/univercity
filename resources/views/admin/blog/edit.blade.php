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
                    <i class="bi bi-arrow-left me-2"></i>Back to List
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
        <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <!-- Left Column: Main Content -->
                <div class="col-lg-8">
                    <!-- General Information Card -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-bottom p-3">
                            <div class="d-flex align-items-center">
                                <div class="p-2 rounded me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(var(--bs-primary-rgb), 0.1);">
                                    <i class="bi bi-file-text text-primary fs-5"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0 fw-bold">General Information</h5>
                                    <span class="fs-13 text-muted">Basic details and categorization</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-md-6 mb-3">
                                    <label for="title" class="form-label fw-semibold">Blog Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control px-3 py-2 shadow-sm @error('title') is-invalid @enderror" id="title" value="{{ old('title', $blog->title) }}" required placeholder="Enter main title">
                                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="menu_title" class="form-label fw-semibold">Menu Title</label>
                                    <input type="text" name="menu_title" class="form-control px-3 py-2 shadow-sm @error('menu_title') is-invalid @enderror" id="menu_title" value="{{ old('menu_title', $blog->menu_title) }}" placeholder="Enter menu title">
                                    @error('menu_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="category_id" class="form-label fw-semibold">Category <span class="text-danger">*</span></label>
                                    <select name="category_id" id="category_id" class="form-select px-3 py-2 shadow-sm @error('category_id') is-invalid @enderror" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $blog->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="subtitle" class="form-label fw-semibold">Subtitle</label>
                                    <input type="text" name="subtitle" class="form-control px-3 py-2 shadow-sm @error('subtitle') is-invalid @enderror" id="subtitle" value="{{ old('subtitle', $blog->subtitle) }}" placeholder="Enter subtitle">
                                    @error('subtitle')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="slug" class="form-label fw-semibold">Slug (URL) <span class="text-danger">*</span></label>
                                    <div class="input-group shadow-sm rounded-3">
                                        <span class="input-group-text bg-light text-muted border-end-0">/</span>
                                        <input type="text" name="slug" class="form-control px-3 border-start-0 ps-0 @error('slug') is-invalid @enderror" id="slug" value="{{ old('slug', $blog->slug) }}" required placeholder="auto-generated-slug">
                                    </div>
                                    @error('slug')<div class="text-danger fs-14 mt-1">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="short_description" class="form-label fw-semibold">Short Description <span class="text-danger">*</span></label>
                                    <textarea name="short_description" class="form-control px-3 py-2 shadow-sm @error('short_description') is-invalid @enderror" id="short_description" rows="3" required placeholder="Brief summary for listings">{{ old('short_description', $blog->short_description) }}</textarea>
                                    @error('short_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Details Card -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-bottom p-3">
                            <div class="d-flex align-items-center">
                                <div class="p-2 rounded me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(var(--bs-primary-rgb), 0.1);">
                                    <i class="bi bi-pencil-square text-primary fs-5"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0 fw-bold">Content Details</h5>
                                    <span class="fs-13 text-muted">Full explanation and highlights</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="mb-5">
                                <label class="form-label fw-semibold">Full Description <span class="text-danger">*</span></label>
                                <textarea name="description" id="summernote" cols="30" rows="10" class="form-control shadow-sm @error('description') is-invalid @enderror">{{ old('description', $blog->description) }}</textarea>
                                <p class="fs-13 text-muted mt-2 mb-0"><i class="bi bi-info-circle me-1"></i> Maximum 300 Words</p>
                                @error('description')<div class="text-danger d-block mt-1 fs-14">{{ $message }}</div>@enderror
                            </div>

                            <!-- Bullet Points Repeater -->
                            <div class="mb-2">
                                <label class="form-label fw-semibold">Key Highlights (Bullet Points)</label>
                                <p class="fs-13 text-muted mb-3">Add structured bullet points to showcase main features or outcomes in a clear list format.</p>
                                
                                <div id="bullet-points-container">
                                    <div id="bullet-points">
                                        @php
                                            $points = old('points', $blog->points ? json_decode($blog->points, true) : []);
                                        @endphp

                                        @if(is_array($points) && count($points) > 0)
                                            @foreach ($points as $index => $point)
                                                @php
                                                    $parts = explode('-', $point, 2);
                                                    $title = trim($parts[0] ?? '');
                                                    $desc = trim($parts[1] ?? '');
                                                @endphp
                                                <div class="bullet-item border rounded-3 bg-white p-3 mb-3 position-relative shadow-sm transition-all hover-shadow">
                                                    <button type="button" class="btn btn-sm btn-outline-danger remove-bullet position-absolute" style="top: 10px; right: 10px; z-index: 2;" title="Remove this point">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                    <div class="row gx-3 align-items-end pe-4">
                                                        <div class="col-md-4 mb-2 mb-md-0">
                                                            <label class="form-label fs-13 text-muted fw-semibold mb-1">Highlight Title</label>
                                                            <input type="text" class="form-control form-control-sm point-title @error('points.' . $index) is-invalid @enderror" placeholder="e.g. Approach" value="{{ $title }}">
                                                        </div>
                                                        <div class="col-md-8">
                                                            <label class="form-label fs-13 text-muted fw-semibold mb-1">Highlight Description</label>
                                                            <input type="text" class="form-control form-control-sm point-desc @error('points.' . $index) is-invalid @enderror" placeholder="e.g. Hands-on learning experiences..." value="{{ $desc }}">
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="points[]" class="point-hidden" value="{{ $point }}">
                                                </div>
                                                @error('points.' . $index)
                                                    <div class="text-danger mt-1 mb-2 fs-14">{{ $message }}</div>
                                                @enderror
                                            @endforeach
                                        @else
                                            <div class="bullet-item border rounded-3 bg-white p-3 mb-3 position-relative shadow-sm transition-all hover-shadow">
                                                <button type="button" class="btn btn-sm btn-outline-danger remove-bullet position-absolute" style="top: 10px; right: 10px; z-index: 2;" title="Remove this point">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                                <div class="row gx-3 align-items-end pe-4">
                                                    <div class="col-md-4 mb-2 mb-md-0">
                                                        <label class="form-label fs-13 text-muted fw-semibold mb-1">Highlight Title</label>
                                                        <input type="text" class="form-control form-control-sm point-title" placeholder="e.g. Approach">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <label class="form-label fs-13 text-muted fw-semibold mb-1">Highlight Description</label>
                                                        <input type="text" class="form-control form-control-sm point-desc" placeholder="e.g. Hands-on learning experiences...">
                                                    </div>
                                                </div>
                                                <input type="hidden" name="points[]" class="point-hidden" value="">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="mt-3">
                                        <button type="button" class="btn border-primary text-primary w-100 add-bullet py-2" style="border-style: dashed; border-width: 2px; background: rgba(var(--bs-primary-rgb), 0.05);">
                                            <i class="bi bi-plus-circle me-1"></i> Add Another Highlight
                                        </button>
                                    </div>
                                </div>
                                @error('points')<div class="text-danger mt-1 fs-14">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Settings & Publishing -->
                <div class="col-lg-4">
                    
                    <!-- Publishing Card -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-bottom p-3">
                            <h5 class="mb-0 fw-bold d-flex align-items-center">
                                <i class="bi bi-gear text-primary me-2"></i> Publishing
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <label for="status" class="form-label fw-semibold">Visibility Status</label>
                                <select name="status" id="status" class="form-select px-3 py-2 shadow-sm @error('status') is-invalid @enderror">
                                    <option value="1" {{ old('status', $blog->status) == '1' ? 'selected' : '' }}>🟢 Published (Active)</option>
                                    <option value="0" {{ old('status', $blog->status) == '0' ? 'selected' : '' }}>🔴 Hidden (Inactive)</option>
                                </select>
                                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="mb-4">
                                <label for="type" class="form-label fw-semibold">Content Type</label>
                                <select name="type" id="type" class="form-select px-3 py-2 shadow-sm @error('type') is-invalid @enderror">
                                    <option value="1" {{ old('type', $blog->type) == '1' ? 'selected' : '' }}>Blog Post</option>
                                    <option value="2" {{ old('type', $blog->type) == '2' ? 'selected' : '' }}>News Article</option>
                                    <option value="4" {{ old('type', $blog->type) == '4' ? 'selected' : '' }}>Resources</option>
                                    <option value="5" {{ old('type', $blog->type) == '5' ? 'selected' : '' }}>Research / Publication</option>
                                    <option value="6" {{ old('type', $blog->type) == '6' ? 'selected' : '' }}>Case Studies</option>
                                    <option value="8" {{ old('type', $blog->type) == '8' ? 'selected' : '' }}>CSR Initiatives</option>
                                </select>
                                @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <hr class="text-muted border-dashed mb-4">

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary fw-semibold py-2 d-flex align-items-center justify-content-center shadow-sm">
                                    <i class="bi bi-check-circle me-2"></i> Update Content
                                </button>
                                <a href="{{ route('admin.blog.index') }}" class="btn btn-light fw-medium border shadow-sm py-2">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Media Assets Card -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-bottom p-3">
                            <h5 class="mb-0 fw-bold d-flex align-items-center">
                                <i class="bi bi-image text-primary me-2"></i> Media Assets
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="mb-4">
                                <label for="image" class="form-label fw-semibold">Thumbnail Cover</label>
                                <div class="p-3 border rounded-3 bg-light text-center" style="border-style: dashed !important; border-width: 2px !important;">
                                    @if($blog->image)
                                        <div class="mb-3 position-relative d-inline-block">
                                            <img src="{{ asset($blog->image) }}" class="img-thumbnail shadow-sm rounded-3" style="max-height: 120px; object-fit: cover;">
                                            <a href="#" class="btn btn-sm btn-danger remove-image position-absolute top-0 start-100 translate-middle rounded-circle shadow-sm" data-field="image" style="width:24px; height:24px; padding:0; display:flex; align-items:center; justify-content:center;" title="Remove Image"><i class="bi bi-x fs-14"></i></a>
                                            <input type="hidden" name="remove_image" id="remove_image" value="0">
                                        </div>
                                    @else
                                        <div class="bg-white rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center mb-2" style="width: 45px; height: 45px;">
                                            <i class="bi bi-image fs-5 text-primary"></i>
                                        </div>
                                    @endif
                                    <input type="file" name="image" class="form-control form-control-sm @error('image') is-invalid @enderror shadow-sm" id="image">
                                    <span class="fs-12 text-muted mt-2 d-block">Recommended: 800x600px. Max 5MB.</span>
                                </div>
                                @error('image')<div class="text-danger mt-1 fs-14">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="mb-4">
                                <label for="banner_image" class="form-label fw-semibold">Banner Image</label>
                                <div class="p-3 border rounded-3 bg-light text-center" style="border-style: dashed !important; border-width: 2px !important;">
                                    @if($blog->banner_image)
                                        <div class="mb-3 position-relative d-inline-block">
                                            <img src="{{ asset($blog->banner_image) }}" class="img-thumbnail shadow-sm rounded-3" style="max-height: 120px; width: 100%; object-fit: cover;">
                                            <a href="#" class="btn btn-sm btn-danger remove-image position-absolute top-0 start-100 translate-middle rounded-circle shadow-sm" data-field="banner_image" style="width:24px; height:24px; padding:0; display:flex; align-items:center; justify-content:center;" title="Remove Banner Image"><i class="bi bi-x fs-14"></i></a>
                                            <input type="hidden" name="remove_banner_image" id="remove_banner_image" value="0">
                                        </div>
                                    @else
                                        <div class="bg-white rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center mb-2" style="width: 45px; height: 45px;">
                                            <i class="bi bi-display fs-5 text-primary"></i>
                                        </div>
                                    @endif
                                    <input type="file" name="banner_image" class="form-control form-control-sm @error('banner_image') is-invalid @enderror shadow-sm" id="banner_image">
                                    <span class="fs-12 text-muted mt-2 d-block">Recommended: 1920x600px. Max 5MB.</span>
                                </div>
                                @error('banner_image')<div class="text-danger mt-1 fs-14">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Add New Gallery Images</label>
                                <div class="p-3 border rounded-3 bg-light text-center" style="border-style: dashed !important; border-width: 2px !important;">
                                    <div class="bg-white rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center mb-2" style="width: 45px; height: 45px;">
                                        <i class="bi bi-layers fs-5 text-primary"></i>
                                    </div>
                                    <input type="file" class="form-control form-control-sm @error('gallery') is-invalid @enderror shadow-sm" name="gallery[]" accept="image/*" multiple>
                                    <span class="fs-12 text-muted mt-2 d-block">Select multiple files to append. (Max 3MB each).</span>
                                </div>
                                @error('gallery')<div class="text-danger mt-1 fs-14">{{ $message }}</div>@enderror
                            </div>
                            
                            @if($blog->images && $blog->images->count() > 0)
                                <div class="mb-2">
                                    <label class="form-label fw-semibold d-block">Existing Gallery (Check to Delete)</label>
                                    <div class="d-flex flex-wrap gap-2 p-2 bg-light rounded border">
                                        @foreach($blog->images as $img)
                                            <div class="position-relative border p-1 rounded bg-white shadow-sm transition-all hover-shadow">
                                                <img src="{{ asset($img->file_name) }}" alt="Gallery Image" class="rounded" style="height: 70px; width: 70px; object-fit: cover;">
                                                <div class="form-check position-absolute mt-1 me-1 top-0 end-0 bg-white rounded shadow-sm d-flex align-items-center justify-content-center" style="width: 20px; height: 20px;">
                                                    <input class="form-check-input m-0" type="checkbox" name="delete_images[]" value="{{ $img->id }}" id="del_img_{{ $img->id }}" title="Delete this image" style="width: 14px; height: 14px;">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
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
                if (e.target.classList.contains('add-bullet') || e.target.closest('.add-bullet')) {
                    e.preventDefault();
                    const group = `
                    <div class="bullet-item border rounded-3 bg-light p-3 mb-3 position-relative shadow-sm" style="display: none;">
                        <button type="button" class="btn btn-sm btn-outline-danger remove-bullet position-absolute" style="top: 10px; right: 10px; z-index: 2;" title="Remove this point">
                            <i class="bi bi-trash"></i>
                        </button>
                        <div class="row gx-3 align-items-end pe-4">
                            <div class="col-md-4 mb-2 mb-md-0">
                                <label class="form-label fs-13 text-muted fw-semibold mb-1">Point Title</label>
                                <input type="text" class="form-control point-title" placeholder="e.g. Approach">
                            </div>
                            <div class="col-md-8">
                                <label class="form-label fs-13 text-muted fw-semibold mb-1">Point Description</label>
                                <input type="text" class="form-control point-desc" placeholder="e.g. Hands-on learning...">
                            </div>
                        </div>
                        <input type="hidden" name="points[]" class="point-hidden" value="">
                    </div>`;
                    const container = document.getElementById('bullet-points');
                    container.insertAdjacentHTML('beforeend', group);
                    $(container.lastElementChild).fadeIn(300);
                }

                if (e.target.classList.contains('remove-bullet') || e.target.closest('.remove-bullet')) {
                    e.preventDefault();
                    $(e.target.closest('.bullet-item')).fadeOut(300, function() { $(this).remove(); });
                }
            });

            // Sync hidden inputs
            document.addEventListener('input', function(e) {
                if (e.target.classList.contains('point-title') || e.target.classList.contains('point-desc')) {
                    const row = e.target.closest('.bullet-item');
                    let title = row.querySelector('.point-title').value.trim();
                    let desc = row.querySelector('.point-desc').value.trim();
                    const hidden = row.querySelector('.point-hidden');
                    
                    // Replace hyphens to prevent validation issues
                    title = title.replace(/-/g, ' ');
                    desc = desc.replace(/-/g, ' ');
                    
                    if (title || desc) {
                        hidden.value = title + ' - ' + desc;
                    } else {
                        hidden.value = '';
                    }
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
