@push('css')
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.css"> --}}
@endpush

@extends('layouts.admin.app')

@section('content')
<div class="page-header">
    <div class="add-item d-flex">
        <div class="page-title">
            <h4 class="fw-bold">Edit Announcement</h4>
            <h6>Update existing announcement</h6>
        </div>
    </div>
    <ul class="table-top-head">
        <li>
            <a data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Refresh"><i class="ti ti-refresh"></i></a>
        </li>
        <li>
            <a data-bs-toggle="tooltip" data-bs-placement="top" id="collapse-header" aria-label="Collapse"><i class="ti ti-chevron-up"></i></a>
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

<form action="{{ route('admin.announcement.update', $announcement->id) }}" method="POST" enctype="multipart/form-data" class="add-product-form">
    @csrf
    @method('PUT')

    <div class="add-product">
        <div class="accordions-items-seperate" id="accordionSpacingExample">
            <div class="accordion-item border mb-4">
                <h2 class="accordion-header" id="headingSpacingOne">
                    <div class="accordion-button collapsed bg-white" data-bs-toggle="collapse" data-bs-target="#SpacingOne">
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
                                    <input type="text" class="form-control" name="title" value="{{ old('title', $announcement->title) }}" required>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Slug <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="slug" value="{{ old('slug', $announcement->slug) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Image</label>
                                    <input type="file" class="form-control" name="image" accept="image/*">
                                    @if ($announcement->image)
                                        <img src="{{ asset('uploads/announcements/' . $announcement->image) }}" alt="Image" class="img-thumbnail mt-2" style="max-width: 100px;">
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Banner Image</label>
                                    <input type="file" class="form-control" name="banner_image" accept="image/*">
                                    @if ($announcement->banner_image)
                                        <img src="{{ asset('uploads/announcements/' . $announcement->banner_image) }}" alt="Banner" class="img-thumbnail mt-2" style="max-width: 100px;">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Type <span class="text-danger">*</span></label>
                                    <select name="type" class="form-select" required>
                                        <option value="">Select Type</option>
                                        <option value="Program" {{ old('type', $announcement->type) == 'Program' ? 'selected' : '' }}>Program</option>
                                        <option value="Scheme" {{ old('type', $announcement->type) == 'Scheme' ? 'selected' : '' }}>Scheme</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Status <span class="text-danger">*</span></label>
                                    <select name="status" class="form-select" required>
                                        <option value="">Select Status</option>
                                        <option value="Active" {{ old('status', $announcement->status) == 'Active' ? 'selected' : '' }}>Active</option>
                                        <option value="Inactive" {{ old('status', $announcement->status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="summer-description-box">
                                <label class="form-label">Description</label>
                                <textarea name="description" id="summernote" class="form-control" rows="6" maxlength="600">{{ old('description', $announcement->description) }}</textarea>
                                <p class="fs-14 mt-1">Maximum 60 Words</p>
                            </div>
                        </div>
                        <!-- /Editor -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="d-flex align-items-center justify-content-end mb-4">
            <a href="{{ route('admin.announcement.index') }}" class="btn btn-secondary me-2">Cancel</a>
            <button type="submit" class="btn btn-primary">Update Announcement</button>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
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
            .replace(/\s+/g, '-')           // Replace spaces with -
            .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
            .replace(/\-\-+/g, '-')         // Replace multiple - with single -
            .replace(/^-+/, '')             // Trim - from start of text
            .replace(/-+$/, '');            // Trim - from end of text
    }

    $(document).ready(function () {
        $('input[name="title"]').on('input', function () {
            let title = $(this).val();
            let slug = generateSlug(title);
            $('input[name="slug"]').val(slug);
        });
    });
</script>
@endpush
