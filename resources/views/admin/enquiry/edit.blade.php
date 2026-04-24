@extends('layouts.admin.app')
@section('content')
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Edit Enquiry</h4>
                <h6>Update Enquiry Details</h6>
            </div>
        </div>
        <div class="page-btn mt-0">
            <a href="{{ route('admin.enquiry.index') }}" class="btn btn-secondary">
                <i class="feather feather-arrow-left me-2"></i>Back to List
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

    <div class="card p-4">
        <form action="{{ route('admin.enquiry.update', $enquiry->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $enquiry->name) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $enquiry->email) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Mobile <span class="text-danger">*</span></label>
                    <input type="text" name="mobile" class="form-control" value="{{ old('mobile', $enquiry->mobile) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Type</label>
                    <select name="type" class="form-select">
                        <option value="1" {{ $enquiry->type == 1 ? 'selected' : '' }}>General</option>
                        <option value="2" {{ $enquiry->type == 2 ? 'selected' : '' }}>Sponsorship</option>
                        <option value="3" {{ $enquiry->type == 3 ? 'selected' : '' }}>Volunteering</option>
                        <option value="4" {{ $enquiry->type == 4 ? 'selected' : '' }}>Partnership</option>
                        <option value="5" {{ $enquiry->type == 5 ? 'selected' : '' }}>Support</option>
                        <option value="6" {{ $enquiry->type == 6 ? 'selected' : '' }}>Feedback</option>
                        <option value="7" {{ $enquiry->type == 7 ? 'selected' : '' }}>Course</option>
                        <option value="8" {{ $enquiry->type == 8 ? 'selected' : '' }}>Event</option>
                        <option value="9" {{ $enquiry->type == 9 ? 'selected' : '' }}>Competition</option>
                        <option value="10" {{ $enquiry->type == 10 ? 'selected' : '' }}>Newsletter</option>
                        <option value="11" {{ $enquiry->type == 11 ? 'selected' : '' }}>Project Interest</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">Philanthropist</label>
                    <select name="is_philanthropist" class="form-select">
                        <option value="1" {{ $enquiry->is_philanthropist ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ !$enquiry->is_philanthropist ? 'selected' : '' }}>No</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">Paid</label>
                    <select name="paid" class="form-select">
                        <option value="1" {{ $enquiry->paid ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ !$enquiry->paid ? 'selected' : '' }}>No</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">Status</label>
                    <select name="status" class="form-select">
                        <option value="1" {{ $enquiry->status ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !$enquiry->status ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label fw-bold">Message</label>
                    <textarea name="message" class="form-control" rows="4">{{ old('message', $enquiry->message) }}</textarea>
                </div>
            </div>
            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('admin.enquiry.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Enquiry</button>
            </div>
        </form>
    </div>
@endsection
