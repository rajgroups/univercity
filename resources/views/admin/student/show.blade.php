@extends('layouts.admin.app')

@section('content')
<div class="page-header">
    <div class="add-item d-flex">
        <div class="page-title">
            <h4 class="fw-bold">Student Details</h4>
            <h6>View student information</h6>
        </div>
    </div>
    <div class="page-btn mt-0">
        <a href="{{ route('admin.student.index') }}" class="btn btn-secondary">
            <i class="feather feather-arrow-left me-2"></i>Back to List
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th width="30%">Student Name</th>
                                <td>{{ $student->student_name }}</td>
                            </tr>
                            <tr>
                                <th>Father's Name</th>
                                <td>{{ $student->father_name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Mother's Name</th>
                                <td>{{ $student->mother_name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td>{{ ucfirst($student->gender) }}</td>
                            </tr>
                            <tr>
                                <th>Date of Birth</th>
                                <td>{{ $student->dob ? $student->dob->format('d M Y') : 'N/A' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th width="30%">Mobile</th>
                                <td>{{ $student->mobile ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $student->email ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Skill Sector</th>
                                <td>{{ $student->skill_sector ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Level</th>
                                <td>{{ $student->level ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Qualification</th>
                                <td>{{ $student->qualification ?? 'N/A' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Address Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="p-3 bg-light rounded">
                            <p><strong>State:</strong> {{ $student->state ?? 'N/A' }}</p>
                            <p><strong>District:</strong> {{ $student->district ?? 'N/A' }}</p>
                            <p><strong>City:</strong> {{ $student->city ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Education Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="p-3 bg-light rounded">
                            <p><strong>Status:</strong> {{ $student->status ?? 'N/A' }}</p>
                            <p><strong>Learning Mode:</strong> {{ $student->learning_mode ?? 'N/A' }}</p>
                            <p><strong>Work Experience:</strong> {{ $student->work_experience ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 text-end">
                <a href="{{ route('admin.student.edit', $student->id) }}" class="btn btn-primary me-2">
                    <i class="feather feather-edit me-2"></i>Edit
                </a>
                <form action="{{ route('admin.student.destroy', $student->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this student?')">
                        <i class="feather feather-trash-2 me-2"></i>Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection