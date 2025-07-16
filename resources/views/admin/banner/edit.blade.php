@extends('layouts.admin.app')

@push('css')
    <style>
        .banner-preview {
            max-width: 200px;
            max-height: 120px;
            margin-top: 10px;
        }
    </style>
@endpush

@section('content')
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Edit Banner</h4>
                <h6>Update existing banner</h6>
            </div>
        </div>
        <ul class="table-top-head">
            <li><a data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Refresh"><i class="ti ti-refresh"></i></a></li>
            <li><a data-bs-toggle="tooltip" data-bs-placement="top" id="collapse-header" aria-label="Collapse"><i class="ti ti-chevron-up"></i></a></li>
        </ul>
        <div class="page-btn mt-0">
            <a href="{{ route('admin.banner.index') }}" class="btn btn-secondary">
                <i class="feather feather-arrow-left me-2"></i>Back to Banners
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

    <form action="{{ route('admin.banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data" class="add-product-form">
        @csrf
        @method('PUT')
        <div class="add-product">
            <div class="accordion-item border mb-4">
                <h2 class="accordion-header">
                    <div class="accordion-button bg-white">
                        <h5 class="d-flex align-items-center">
                            <i class="feather feather-info text-primary me-2"></i>
                            <span>Edit Banner Information</span>
                        </h5>
                    </div>
                </h2>

                <div class="p-3">
                    <div class="row">
                        <div class="col-sm-6 col-12">
                            <label class="form-label">Banner Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" value="{{ old('title', $banner->title) }}" required>
                        </div>

                        <div class="col-sm-6 col-12">
                            <label class="form-label">Banner Image</label>
                            <input type="file" class="form-control" name="image" accept="image/*">
                            @if ($banner->image)
                                <img src="{{ asset('/storage/' . $banner->image) }}" alt="Banner" class="banner-preview">
                            @endif
                        </div>

                        <div class="col-sm-6 col-12">
                            <label class="form-label">Banner Link</label>
                            <input type="url" class="form-control" name="link" value="{{ old('link', $banner->link) }}">
                        </div>

                        <div class="col-sm-6 col-12">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select">
                                <option value="1" {{ $banner->status ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ !$banner->status ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="col-12 mt-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="4" maxlength="600">{{ old('description', $banner->description) }}</textarea>
                            <p class="fs-14 mt-1">Maximum 60 Words</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="d-flex align-items-center justify-content-end mb-4">
                <a href="{{ route('admin.banner.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Banner</button>
            </div>
        </div>
    </form>
@endsection
