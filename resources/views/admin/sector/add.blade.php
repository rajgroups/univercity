@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.css">
@endpush

@extends('layouts.admin.app')

@section('content')
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Create Sector</h4>
                <h6>Create new Sector</h6>
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


    <form action="{{ route('admin.sectors.store') }}" method="POST" enctype="multipart/form-data" class="add-product-form">
        @csrf
        <div class="add-product">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Sector Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" value="{{ old('name') }}"
                                        class="form-control form-control-lg @error('name') is-invalid @enderror" id="sector-name" placeholder="Enter sector name">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Prefix <span class="text-danger">*</span></label>
                                    <input type="text" name="prefix" value="{{ old('prefix') }}"
                                        class="form-control form-control-lg @error('prefix') is-invalid @enderror" id="prefix-name" placeholder="E.g., SEC-01">
                                    @error('prefix')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Position <span class="text-danger">*</span></label>
                                    <input type="number" name="position" value="{{ old('position') }}"
                                        class="form-control form-control-lg @error('position') is-invalid @enderror" id="position" placeholder="Order position">
                                    @error('position')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Slug <span class="text-danger">*</span></label>
                                    <input type="text" name="slug" value="{{ old('slug') }}"
                                        class="form-control form-control-lg @error('slug') is-invalid @enderror" id="sector-slug" readonly style="background-color: #e9ecef;">
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Type <span class="text-danger">*</span></label>
                                    <select name="type" class="form-select form-select-lg @error('type') is-invalid @enderror">
                                        <option value="">Select Type</option>
                                        <option value="1" {{ old('type') == 1 ? 'selected' : '' }}>Normal</option>
                                        <option value="2" {{ old('type') == 2 ? 'selected' : '' }}>INTL</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                                    <select name="status" class="form-select form-select-lg @error('status') is-invalid @enderror">
                                        <option value="">Select Status</option>
                                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Context Image <span class="text-danger">*</span></label>
                                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Description <span class="text-danger">*</span></label>
                                    <textarea name="description" id="summernote" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                    <div class="form-text text-muted">Maximum 60 Words recommended for optimal display.</div>
                                    @error('description')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
    
                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('admin.sectors.index') }}" class="btn btn-outline-secondary me-3 px-4">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4">Create New</button>
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
        });
    </script>
@endpush
@push('scripts')
<script>
    $(document).ready(function () {
        $('#sector-name').on('input', function () {
            let name = $(this).val();
            let slug = name.toLowerCase()
                           .replace(/[^a-z0-9\s-]/g, '')     // Remove non-alphanumerics
                           .trim()
                           .replace(/\s+/g, '-')             // Replace spaces with hyphens
                           .replace(/-+/g, '-');             // Remove multiple hyphens
            $('#sector-slug').val(slug);
        });
    });
</script>
@endpush

