@extends('layouts.admin.app')
@section('content')
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Survey List</h4>
                <h6>Manage project surveys</h6>
            </div>
        </div>
        <div class="page-btn mt-0">
            <a href="{{ route('admin.feedback.create') }}" class="btn btn-primary">
                <i class="feather feather-plus me-2"></i>Create Survey
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

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Project</th>
                            <th>Surveyor</th>
                            <th>Role</th>
                            <th>Date</th>
                            <th>Satisfaction</th>
                            <th>Success?</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($surveys as $survey)
                            <tr>
                                <td>{{ $survey->id }}</td>
                                <td>
                                    @if($survey->project)
                                        <a href="{{ route('admin.project.edit', $survey->project->id) }}">
                                            {{ $survey->project->project_code }}
                                        </a>
                                        <br>
                                        <small class="text-muted">{{ Str::limit($survey->project->title, 30) }}</small>
                                    @else
                                        <span class="text-danger">Project Deleted</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $survey->name }}
                                    <br>
                                    <small class="text-muted">{{ $survey->email }}</small>
                                </td>
                                <td>{{ $survey->role }}</td>
                                <td>{{ \Carbon\Carbon::parse($survey->survey_date)->format('d M Y') }}</td>
                                <td>
                                    @if($survey->satisfaction == 'Very Satisfied')
                                        <span class="badge bg-success">Very Satisfied</span>
                                    @elseif($survey->satisfaction == 'Satisfied')
                                        <span class="badge bg-info">Satisfied</span>
                                    @elseif($survey->satisfaction == 'Neutral')
                                        <span class="badge bg-warning">Neutral</span>
                                    @else
                                        <span class="badge bg-danger">{{ $survey->satisfaction }}</span>
                                    @endif
                                </td>
                                <td>{{ $survey->project_success }}</td>
                                <td>
                                    <form action="{{ route('admin.feedback.destroy', $survey->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">No surveys found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $surveys->links() }}
            </div>
        </div>
    </div>
@endsection
