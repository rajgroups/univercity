@extends('layouts.admin.app')

@push('css')
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.css"> --}}
    <style>
        .project-group {
            position: relative;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .remove-project {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
@endpush

@section('content')
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Create Banner</h4>
                <h6>Create new Banner</h6>
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
            <a href="{{ route('admin.banner.index') }}" class="btn btn-secondary">
                <i class="feather feather-arrow-left me-2"></i>Back to Banners
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

    <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data" class="add-product-form">
        @csrf
        <div class="add-product">
            <div class="accordions-items-seperate" id="accordionSpacingExample">
                <div class="accordion-item border mb-4">
                    <h2 class="accordion-header" id="headingSpacingOne">
                        <div class="accordion-button collapsed bg-white" data-bs-toggle="collapse"
                            data-bs-target="#SpacingOne" aria-expanded="true" aria-controls="SpacingOne">
                            <div class="d-flex align-items-center justify-content-between flex-fill">
                                <h5 class="d-flex align-items-center">
                                    <i class="feather feather-info text-primary me-2"></i>
                                    <span>Banner Information</span>
                                </h5>
                            </div>
                        </div>
                    </h2>

                    <div id="projectRepeater" class="p-3">
                        <div class="project-group">
                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <label class="form-label">Banner Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title[]" required>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <label class="form-label">Banner Image <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="image[]" accept="image/*" required>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <label class="form-label">Banner Link (optional)</label>
                                    <input type="url" class="form-control" name="link[]" placeholder="https://example.com">
                                </div>

                                 <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Status <span class="text-danger">*</span></label>
                                        <select name="status" class="form-select">
                                            <option value="">Select</option>
                                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-3">
                                <div class="summer-description-box">
                                    <label class="form-label">Description</label>
                                    <textarea name="description[]" class="form-control" rows="4" maxlength="600"></textarea>
                                    <p class="fs-14 mt-1">Maximum 60 Words</p>
                                </div>
                            </div>

                            <button type="button" class="btn btn-danger btn-sm remove-project mt-3">Remove</button>
                        </div>
                    </div>

                    <!-- Add More Button -->
                    <button type="button" class="btn btn-success mt-3 m-3 ms-3" id="addProjectBtn">+ Add Banner</button>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="d-flex align-items-center justify-content-end mb-4">
                <a href="{{ route('admin.banner.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary">Create Banners</button>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        function initializeEditors(context) {
            // Uncomment for summernote
            // context.find('textarea').summernote({ height: 150 });
        }

        $(document).ready(function () {
            initializeEditors($(document));

            $('#addProjectBtn').on('click', function () {
                let $clone = $('.project-group:first').clone();

                $clone.find('input').val('');
                $clone.find('textarea').val('');
                $clone.find('input[type="file"]').val('');
                $clone.find('select').val('1'); // default to active

                $('#projectRepeater').append($clone);
                initializeEditors($clone);
            });

            $(document).on('click', '.remove-project', function () {
                if ($('.project-group').length > 1) {
                    $(this).closest('.project-group').remove();
                } else {
                    alert("At least one banner is required.");
                }
            });
        });
    </script>
@endpush
