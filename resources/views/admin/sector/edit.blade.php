@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.css">
@endpush

@extends('layouts.admin.app')

@section('content')
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Edit Sector</h4>
                <h6>Update existing Sector</h6>
            </div>
        </div>
        <ul class="table-top-head">
            <li><a data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Refresh"><i class="ti ti-refresh"></i></a></li>
            <li><a data-bs-toggle="tooltip" data-bs-placement="top" id="collapse-header" aria-label="Collapse"><i class="ti ti-chevron-up"></i></a></li>
        </ul>
        <div class="page-btn mt-0">
            <a href="{{ route('admin.sectors.index') }}" class="btn btn-secondary">
                <i class="feather feather-arrow-left me-2"></i>Back to Sector
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

    <form action="{{ route('admin.sectors.update', $sector->id) }}" method="POST" enctype="multipart/form-data" class="add-product-form">
        @csrf
        @method('PATCH')
        <div class="add-product">
            <div class="accordions-items-seperate" id="accordionSpacingExample">
                <div class="accordion-item border mb-4">
                    <h2 class="accordion-header" id="headingSpacingOne">
                        <div class="accordion-button collapsed bg-white" data-bs-toggle="collapse" data-bs-target="#SpacingOne" aria-expanded="true" aria-controls="SpacingOne">
                            <div class="d-flex align-items-center justify-content-between flex-fill">
                                <h5 class="d-flex align-items-center">
                                    <i class="feather feather-info text-primary me-2"></i>
                                    <span>Sector Information</span>
                                </h5>
                            </div>
                        </div>
                    </h2>

                    <div id="SpacingOne" class="accordion-collapse collapse show" aria-labelledby="headingSpacingOne">
                        <div class="accordion-body border-top">
                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Sector Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" value="{{ old('name', $sector->name) }}"
                                            class="form-control @error('name') is-invalid @enderror" id="sector-name">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Slug <span class="text-danger">*</span></label>
                                        <input type="text" name="slug" value="{{ old('slug', $sector->slug) }}"
                                            class="form-control @error('slug') is-invalid @enderror" id="sector-slug">
                                        @error('slug')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Image <span class="text-danger">*</span></label>
                                            <input type="file" name="image"
                                                class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            @if($sector->image)
                                                <img src="{{ asset('uploads/sectors/' . $sector->image) }}" class="mt-2 w-75" height="80" alt="Current Image">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Status <span class="text-danger">*</span></label>
                                            <select name="status" class="form-select @error('status') is-invalid @enderror">
                                                <option value="">Select</option>
                                                <option value="1" {{ old('status', $sector->status) == 1 ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ old('status', $sector->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="summer-description-box">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" id="summernote" cols="30" rows="10" class="form-control @error('description') is-invalid @enderror">{{ old('description', $sector->description) }}</textarea>
                                        <p class="fs-14 mt-1">Maximum 60 Words</p>
                                        @error('description')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="modal-footer mt-4">
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('admin.sectors.index') }}" class="btn btn-light me-3">Cancel</a>
                                        <button type="submit" class="btn btn-primary">Update Sector</button>
                                    </div>
                                </div>
                            </div> <!-- row -->
                        </div> <!-- accordion-body -->
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.js"></script>
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
@endpush

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#sector-name').on('input', function () {
                let name = $(this).val();
                let slug = name.toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .trim()
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
                $('#sector-slug').val(slug);
            });
        });
    </script>
@endpush
