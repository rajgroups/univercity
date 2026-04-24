@extends('layouts.admin.app')

@section('content')
<div class="page-header">
    <div class="add-item d-flex">
        <div class="page-title">
            <h4 class="fw-bold">Edit Student</h4>
            <h6>Update student information</h6>
        </div>
    </div>
    <div class="page-btn mt-0">
        <a href="{{ route('admin.student.index') }}" class="btn btn-secondary">
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
    <form action="{{ route('admin.student.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Student Name <span class="text-danger">*</span></label>
                <input type="text" name="student_name" class="form-control" value="{{ old('student_name', $student->student_name) }}" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Father's Name</label>
                <input type="text" name="father_name" class="form-control" value="{{ old('father_name', $student->father_name) }}">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Mother's Name</label>
                <input type="text" name="mother_name" class="form-control" value="{{ old('mother_name', $student->mother_name) }}">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Gender</label>
                <select name="gender" class="form-select">
                    <option value="male" {{ $student->gender == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ $student->gender == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ $student->gender == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Date of Birth</label>
                <input type="date" name="dob" class="form-control" value="{{ old('dob', $student->dob ? \Carbon\Carbon::parse($student->dob)->format('Y-m-d') : '') }}">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Mobile</label>
                <input type="text" name="mobile" class="form-control" value="{{ old('mobile', $student->mobile) }}">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $student->email) }}">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Skill Sector</label>
                <input type="text" name="skill_sector" class="form-control" value="{{ old('skill_sector', $student->skill_sector) }}">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Level</label>
                <input type="text" name="level" class="form-control" value="{{ old('level', $student->level) }}">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Qualification</label>
                <input type="text" name="qualification" class="form-control" value="{{ old('qualification', $student->qualification) }}">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">State</label>
                <input type="text" name="state" class="form-control" value="{{ old('state', $student->state) }}">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">District</label>
                <input type="text" name="district" class="form-control" value="{{ old('district', $student->district) }}">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">City</label>
                <input type="text" name="city" class="form-control" value="{{ old('city', $student->city) }}">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Learning Mode</label>
                <input type="text" name="learning_mode" class="form-control" value="{{ old('learning_mode', $student->learning_mode) }}">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Work Experience</label>
                <input type="text" name="work_experience" class="form-control" value="{{ old('work_experience', $student->work_experience) }}">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Status</label>
                <select name="status" class="form-select">
                    <option value="active" {{ $student->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $student->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>
        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('admin.student.index') }}" class="btn btn-secondary me-2">Cancel</a>
            <button type="submit" class="btn btn-primary">Update Student</button>
        </div>
    </form>
</div>
@endsection
