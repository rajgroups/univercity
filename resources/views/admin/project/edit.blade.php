@push('css')
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.css"> --}}
@endpush

@extends('layouts.admin.app')
@section('content')
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Edit Project</h4>
                <h6>Edit the Project</h6>
            </div>
        </div>
        <ul class="table-top-head">
            <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Refresh" data-bs-original-title="Refresh"><i
                        class="ti ti-refresh"></i></a>
            </li>
            <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" id="collapse-header" aria-label="Collapse"
                    data-bs-original-title="Collapse"><i class="ti ti-chevron-up"></i></a>
            </li>
        </ul>
        <div class="page-btn mt-0">
            <a href="product-list.html" class="btn btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left me-2">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>Back to Sector</a>
        </div>
    </div>
    <form action="add-product.html" class="add-product-form">
        <div class="add-product">
            <div class="accordions-items-seperate" id="accordionSpacingExample">
                <div class="accordion-item border mb-4">
                    <h2 class="accordion-header" id="headingSpacingOne">
                        <div class="accordion-button collapsed bg-white" data-bs-toggle="collapse"
                            data-bs-target="#SpacingOne" aria-expanded="true" aria-controls="SpacingOne">
                            <div class="d-flex align-items-center justify-content-between flex-fill">
                                <h5 class="d-flex align-items-center"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-info text-primary me-2">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="16" x2="12" y2="12"></line>
                                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                    </svg><span>Sector Information</span></h5>
                            </div>
                        </div>
                    </h2>
                    <div id="SpacingOne" class="accordion-collapse collapse show" aria-labelledby="headingSpacingOne">
                        <div class="accordion-body border-top">
                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Project title<span class="text-danger ms-1">*</span></label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Slug<span class="text-danger ms-1">*</span></label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Image<span class="text-danger ms-1">*</span></label>
                                        <input type="file" class="form-control" accept="image">
                                    </div>
                                </div>
                                                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Banner Image<span class="text-danger ms-1">*</span></label>
                                        <input type="file" class="form-control" accept="image">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Type<span class="text-danger ms-1">*</span></label>
                                        <select name="" id="" class="form-select">
                                            <option value="1">On Going</option>
                                            <option value="0">Up Coming</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-12">
    <div class="summer-description-box">
        <label class="form-label">Description</label>
        <textarea name="summernote" id="summernote" cols="30" rows="10"></textarea>
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
                <button type="button" class="btn btn-secondary me-2">Cancel</button>
                <button type="submit" class="btn btn-primary">Add Product</button>
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
@endpush
