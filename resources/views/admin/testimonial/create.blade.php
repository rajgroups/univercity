@extends('layouts.admin.app')
@section('content')
    <div class="container mt-4">
        <div class="page-header">
            <div class="add-item d-flex">
                <div class="page-title">
                    <h4 class="fw-bold">Create Testimonial</h4>
                    <h6>Add a new client testimonial</h6>
                </div>
            </div>
            <ul class="table-top-head">
                <li><a data-bs-toggle="tooltip" title="Refresh"><i class="ti ti-refresh"></i></a></li>
                <li><a data-bs-toggle="tooltip" title="Collapse" id="collapse-header"><i class="ti ti-chevron-up"></i></a></li>
            </ul>
            <div class="page-btn mt-0">
                <a href="{{ route('admin.testimonial.index') }}" class="btn btn-secondary">
                    <i class="feather feather-arrow-left me-2"></i>Back to List
                </a>
            </div>
        </div>

        <form action="{{ route('admin.testimonial.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="add-product">
                <div class="accordion-item border mb-4">
                    <h2 class="accordion-header">
                        <div class="accordion-button collapsed bg-white" data-bs-toggle="collapse" data-bs-target="#TestimonialForm">
                            <h5 class="d-flex align-items-center">
                                <i class="feather feather-info text-primary me-2"></i>
                                <span>Testimonial Information</span>
                            </h5>
                        </div>
                    </h2>
                    <div id="TestimonialForm" class="accordion-collapse collapse show">
                        <div class="accordion-body border-top">

                            <div class="mb-3">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="designation" class="form-label">Position</label>
                                <input type="text" name="designation" class="form-control" value="{{ old('designation') }}">
                            </div>

                            <div class="mb-3">
                                <label for="company" class="form-label">Company</label>
                                <input type="text" name="company" class="form-control" value="{{ old('company') }}">
                            </div>

                            <div class="mb-3">
                                <label for="comment" class="form-label">Comment <span class="text-danger">*</span></label>
                                <textarea name="comment" rows="4" class="form-control @error('comment') is-invalid @enderror" required>{{ old('comment') }}</textarea>
                                @error('comment')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Photo (optional)</label>
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="ratsing" class="form-label">Rating (1 to 5)</label>
                                <select name="rating" class="form-select">
                                    <option value="">Select rating</option>
                                    @for($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror">
                                    <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Create Testimonial</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
