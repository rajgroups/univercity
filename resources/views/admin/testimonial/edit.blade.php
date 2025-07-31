@extends('layouts.admin.app')
@section('content')
    <div class="container mt-4">
        <div class="page-header">
            <div class="add-item d-flex">
                <div class="page-title">
                    <h4 class="fw-bold">Edit Testimonial</h4>
                    <h6>Update client testimonial</h6>
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

        <form action="{{ route('admin.testimonial.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
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
                                    value="{{ old('name', $testimonial->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="designation" class="form-label">Position</label>
                                <input type="text" name="designation" class="form-control" value="{{ old('designation', $testimonial->designation) }}">
                            </div>

                            <div class="mb-3">
                                <label for="company" class="form-label">Company</label>
                                <input type="text" name="company" class="form-control" value="{{ old('company', $testimonial->company) }}">
                            </div>

                            <div class="mb-3">
                                <label for="comment" class="form-label">Comment <span class="text-danger">*</span></label>
                                <textarea name="comment" rows="4" class="form-control @error('comment') is-invalid @enderror" required>{{ old('comment', $testimonial->comment) }}</textarea>
                                @error('comment')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Photo (optional)</label>
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                @if($testimonial->image)
                                    <div class="mt-2">
                                        <img src="{{ asset($testimonial->image) }}" alt="Current photo" style="max-width: 150px;">
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="checkbox" name="remove_image" id="remove_image">
                                            <label class="form-check-label" for="remove_image">
                                                Remove current photo
                                            </label>
                                        </div>
                                    </div>
                                @endif
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="rating" class="form-label">Rating (1 to 5)</label>
                                <select name="rating" class="form-select">
                                    <option value="">Select rating</option>
                                    @for($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}" {{ old('rating', $testimonial->rating) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror">
                                    <option value="1" {{ old('status', $testimonial->status) == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status', $testimonial->status) == '0' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Update Testimonial</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection