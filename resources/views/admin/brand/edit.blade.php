@extends('layouts.admin.app')

@section('content')
<div class="container mt-4">
        <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Create Category</h4>
                <h6>Create new Category</h6>
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
            <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">
                <i class="feather feather-arrow-left me-2"></i>Back to List
            </a>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.brand.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Brand Name --}}
        <div class="mb-3">
            <label for="name" class="form-label">Brand Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $brand->name) }}" required>
        </div>

        {{-- Image --}}
        <div class="mb-3">
            <label for="image" class="form-label">Brand Image</label>
            <input type="file" name="image" class="form-control">

            @if($brand->image)
                <div class="mt-2">
                    <img src="{{ $brand->image }}" alt="Brand Image" style="max-width: 120px;">
                </div>
            @endif
        </div>

        {{-- Status --}}
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="1" {{ $brand->status == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $brand->status == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn btn-primary">Update Brand</button>
        <a href="{{ route('admin.brand.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
