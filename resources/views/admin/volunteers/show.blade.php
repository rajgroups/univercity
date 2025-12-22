@extends('layouts.admin.app')

@section('content')
<div class="page-header">
    <div class="add-item d-flex">
        <div class="page-title">
            <h4 class="fw-bold">Volunteer Details</h4>
            <h6>View volunteer information</h6>
        </div>
    </div>
    <div class="page-btn mt-0">
        <a href="{{ route('admin.volunteer.index') }}" class="btn btn-secondary">
            <i class="feather feather-arrow-left me-2"></i>Back to List
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-6">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th width="30%">Name</th>
                                <td>{{ $volunteer->name }}</td>
                            </tr>
                            <tr>
                                <th>Mobile</th>
                                <td>{{ $volunteer->mobile ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td>{{ ucfirst($volunteer->gender) }}</td>
                            </tr>
                            <tr>
                                <th>Date of Birth</th>
                                <td>{{ $volunteer->dob }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-6">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th width="30%">Qualification</th>
                                <td>{{ $volunteer->qualification ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Location</th>
                                <td>{{ $volunteer->location ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Experience</th>
                                <td>{{ $volunteer->experience ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Preferred Mode</th>
                                <td>{{ $volunteer->preferred_mode ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <span class="badge bg-{{ $volunteer->status == 'active' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($volunteer->status) }}
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Skills & Interests -->
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Skills / Expertise</h5>
                    </div>
                    <div class="card-body">
                        @if($volunteer->skills)
                            @foreach(json_decode($volunteer->skills, true) as $skill)
                                <span class="badge bg-primary me-1">{{ $skill }}</span>
                            @endforeach
                        @else
                            <p>No skills provided.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Areas of Interest</h5>
                    </div>
                    <div class="card-body">
                        @if($volunteer->interests)
                            @foreach(json_decode($volunteer->interests, true) as $interest)
                                <span class="badge bg-info me-1">{{ $interest }}</span>
                            @endforeach
                        @else
                            <p>No interests provided.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Information -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Additional Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="p-3 bg-light rounded">
                            <p><strong>Created At:</strong> {{ $volunteer->created_at->format('d M Y h:i A') }}</p>
                            <p><strong>Updated At:</strong> {{ $volunteer->updated_at->format('d M Y h:i A') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="row mt-4">
            <div class="col-12 text-end">
                <a href="{{ route('admin.volunteer.edit', $volunteer->id) }}" class="btn btn-primary me-2">
                    <i class="feather feather-edit me-2"></i>Edit
                </a>
                <form action="{{ route('admin.volunteer.destroy', $volunteer->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this volunteer?')">
                        <i class="feather feather-trash-2 me-2"></i>Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
