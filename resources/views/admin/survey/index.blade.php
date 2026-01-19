@extends('layouts.admin.app')
@section('content')
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Survey for {{ $project->title }}</h4>
                <h6>Manage surveys for this project</h6>
            </div>
        </div>
        <div class="page-btn mt-0">
            <a href="{{ route('admin.survey.create', $project->id) }}" class="btn btn-primary">
                <i class="feather feather-plus me-2"></i>Create New Survey
            </a>
            <a href="{{ route('admin.project.index') }}" class="btn btn-secondary ms-2">
                <i class="feather feather-arrow-left me-2"></i>Back to Projects
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
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Active</th>
                            <th>Created At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($surveys as $survey)
                            <tr>
                                <td>
                                    <h6 class="mb-0">{{ $survey->title }}</h6>
                                </td>
                                <td>{{ Str::limit($survey->description, 50) }}</td>
                                <td>
                                    @if($survey->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $survey->created_at->format('M d, Y') }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <!-- Edit -->
                                        <a href="{{ route('admin.survey.edit', ['project_id' => $project->id, 'id' => $survey->id]) }}"
                                           class="btn btn-sm btn-outline-info"
                                           data-bs-toggle="tooltip" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <!-- Delete -->
                                        <form action="{{ route('admin.survey.destroy', ['project_id' => $project->id, 'id' => $survey->id]) }}"
                                              method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    data-bs-toggle="tooltip" title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <h5 class="text-muted">No surveys found for this project</h5>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
