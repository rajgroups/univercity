@extends('layouts.admin.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title mb-0">Learning Pathways</h4>
                        <a href="{{ route('admin.learningpathways.create', $project->id) }}" class="btn btn-primary">
                            <i class="feather icon-plus me-1"></i> Create New
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th width="50">#</th>
                                    <th>Primary Sector</th>
                                    <th>Learning Outcomes (Preview)</th>
                                    <th width="150" class="text-center">Courses</th>
                                    <th width="150" class="text-center">Steps</th>
                                    <th width="150" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($learningPathways as $index => $pathway)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <span class="badge bg-light-primary text-primary">{{ $pathway->primarySector->name ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <div class="text-truncate" style="max-width: 300px;">
                                            {{ strip_tags($pathway->learning_outcomes) }}
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-secondary">{{ $pathway->courses()->count() }}</span>
                                    </td>
                                    <td class="text-center">
                                         <span class="badge bg-secondary">{{ $pathway->flows()->count() }}</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.learningpathways.edit', ['project_id' => $project->id, 'id' => $pathway->id]) }}" class="btn btn-outline-primary" title="Edit">
                                                <i class="feather icon-edit-2"></i>
                                            </a>
                                            <form action="{{ route('admin.learningpathways.destroy', ['project_id' => $project->id, 'id' => $pathway->id]) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this pathway?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" title="Delete">
                                                    <i class="feather icon-trash-2"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="feather icon-layers display-4 mb-3 d-block"></i>
                                            <p class="h5">No Learning Pathways Found</p>
                                            <p>Click "Create New" to add a learning pathway to this project.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
