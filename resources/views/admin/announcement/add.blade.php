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

<form action="{{ route('admin.announcement.store') }}" method="POST" enctype="multipart/form-data" class="add-product-form">
    @csrf
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
                                    <input type="text" class="form-control" name="title" required>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Slug <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="slug" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Image <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="image" accept="image/*" required>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Banner Image <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="banner_image" accept="image/*" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Type <span class="text-danger">*</span></label>
                                    <select name="type" class="form-select" required>
                                        <option value="">Select Type</option>
                                        <option value="Program">Program</option>
                                        <option value="Scheme">Scheme</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Status <span class="text-danger">*</span></label>
                                    <select name="status" class="form-select" required>
                                        <option value="">Select Status</option>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="summer-description-box">
                                <label class="form-label">Description</label>
                                <textarea name="description" id="summernote" class="form-control" rows="6" maxlength="600"></textarea>
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
            <button type="submit" class="btn btn-primary">Create Announcement</button>
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
            .replace(/[^\w\-]+/g, '')       // Remove all non-word characters
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
