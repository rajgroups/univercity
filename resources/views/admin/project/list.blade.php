@extends('layouts.admin.app')
@section('content')
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Projects</h4>
                <h6>Manage and track all projects</h6>
            </div>
        </div>
        <ul class="table-top-head">
            <li>
                <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh" onclick="location.reload()">
                    <i class="ti ti-refresh"></i>
                </a>
            </li>
            <li>
                <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" id="collapse-header" title="Collapse">
                    <i class="ti ti-chevron-up"></i>
                </a>
            </li>
        </ul>
        <div class="page-btn mt-0">
            <a href="{{ route('admin.project.create') }}" class="btn btn-primary">
                <i class="feather feather-plus me-2"></i>Create New Project
            </a>
            <a href="{{ route('admin.project.export') }}" class="btn btn-outline-secondary ms-2">
                <i class="feather feather-download me-2"></i>Export CSV
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

    {{-- Error Message --}}
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Filters Card -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('admin.project.index') }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Search</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="feather feather-search"></i></span>
                        <input type="text" class="form-control" name="search" placeholder="Search projects..."
                            value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Stage</label>
                    <select class="form-select" name="stage">
                        <option value="">All Stages</option>
                        <option value="upcoming" {{ request('stage') == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                        <option value="ongoing" {{ request('stage') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                        <option value="completed" {{ request('stage') == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Category</label>
                    <select class="form-select" name="category">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Location Type</label>
                    <select class="form-select" name="location_type">
                        <option value="">All Types</option>
                        <option value="RUR" {{ request('location_type') == 'RUR' ? 'selected' : '' }}>Rural</option>
                        <option value="URB" {{ request('location_type') == 'URB' ? 'selected' : '' }}>Urban</option>
                        <option value="MET" {{ request('location_type') == 'MET' ? 'selected' : '' }}>Metro</option>
                        <option value="MIX" {{ request('location_type') == 'MIX' ? 'selected' : '' }}>Mixed</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Status</label>
                    <select class="form-select" name="status">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') == 1 ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="feather feather-filter me-1"></i> Filter
                    </button>
                </div>
            </form>
            @if (request()->anyFilled(['search', 'stage', 'category', 'location_type', 'status']))
                <div class="mt-3">
                    <a href="{{ route('admin.project.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="feather feather-x me-1"></i> Clear Filters
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-sm-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avatar-sm bg-soft-warning rounded">
                                <span class="avatar-title bg-warning rounded-circle fs-4">
                                    <i class="feather feather-clock text-white"></i>
                                </span>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="text-muted mb-1">Upcoming</h5>
                            <h2 class="mb-0">{{ $stats['upcoming'] ?? 0 }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avatar-sm bg-soft-info rounded">
                                <span class="avatar-title bg-info rounded-circle fs-4">
                                    <i class="feather feather-play-circle text-white"></i>
                                </span>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="text-muted mb-1">Ongoing</h5>
                            <h2 class="mb-0">{{ $stats['ongoing'] ?? 0 }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avatar-sm bg-soft-success rounded">
                                <span class="avatar-title bg-success rounded-circle fs-4">
                                    <i class="feather feather-check-circle text-white"></i>
                                </span>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="text-muted mb-1">Completed</h5>
                            <h2 class="mb-0">{{ $stats['completed'] ?? 0 }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avatar-sm bg-soft-primary rounded">
                                <span class="avatar-title bg-primary rounded-circle fs-4">
                                    <i class="feather feather-users text-white"></i>
                                </span>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="text-muted mb-1">Total Projects</h5>
                            <h2 class="mb-0">{{ $stats['total'] ?? 0 }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Projects Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" width="60">
                                <input type="checkbox" id="selectAll">
                            </th>
                            <th width="100">ID</th>
                            <th>Project Details</th>
                            <th width="150">Category</th>
                            <th width="120">Stage</th>
                            <th width="120">Progress</th>
                            <th width="120">Beneficiaries</th>
                            <th width="100">Status</th>
                            <th width="150" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($projects as $project)
                        {{-- @dd($project->status); --}}
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" class="select-item" value="{{ $project->id }}">
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark">#{{ $project->project_code }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <!-- @if ($project->thumbnail_image)
    <div class="flex-shrink-0 me-3">
                                                    <img src="{{ asset($project->thumbnail_image) }}"
                                                         alt="{{ $project->title }}"
                                                         class="avatar-md rounded">
                                                </div>
    @endif -->
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">
                                                <a href="{{ route('admin.project.show', $project->id) }}"
                                                    class="text-dark">
                                                    {{ Str::limit($project->title, 50) }}
                                                </a>
                                            </h6>
                                            <p class="text-muted mb-0 small">
                                                <i class="feather feather-calendar me-1"></i>
                                                {{ \Carbon\Carbon::parse($project->planned_start_date)->format('M d, Y') }}
                                                @if ($project->planned_end_date)
                                                    -
                                                    {{ \Carbon\Carbon::parse($project->planned_end_date)->format('M d, Y') }}
                                                @endif
                                            </p>
                                            <p class="text-muted mb-0 small">
                                                <i class="feather feather-map-pin me-1"></i>
                                                {{ $project->location_type }} |
                                                @if ($project->state)
                                                    {{ $project->state }},
                                                @endif
                                                @if ($project->district)
                                                    {{ $project->district }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark">
                                        {{ $project->category->name ?? 'N/A' }}
                                    </span>
                                </td>
                                <td>
                                    @if ($project->stage === 'upcoming')
                                        <span class="badge bg-warning text-dark">
                                            <i class="feather feather-clock me-1"></i> Upcoming
                                        </span>
                                    @elseif($project->stage === 'ongoing')
                                        <span class="badge bg-info">
                                            <i class="feather feather-play-circle me-1"></i> Ongoing
                                        </span>
                                    @else
                                        <span class="badge bg-success">
                                            <i class="feather feather-check-circle me-1"></i> Completed
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar
                                            @if ($project->stage === 'completed') bg-success
                                            @elseif($project->project_progress >= 50) bg-info
                                            @else bg-warning @endif"
                                            role="progressbar" style="width: {{ $project->project_progress }}%"
                                            aria-valuenow="{{ $project->project_progress }}" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                    <small class="text-muted">{{ $project->project_progress }}%</small>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="feather feather-users text-primary"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-2">
                                            <h6 class="mb-0">{{ number_format($project->actual_beneficiary_count) }}
                                            </h6>
                                            <small class="text-muted">Beneficiaries</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input status-toggle"
                                            data-id="{{ $project->id }}" id="status{{ $project->id }}"
                                            {{ $project->status == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status{{ $project->id }}"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">

                                        <!-- View -->
                                        {{-- <a href="{{ route('admin.project.show', $project->id) }}"
                                        class="btn btn-sm btn-outline-primary"
                                        data-bs-toggle="tooltip" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a> --}}

                                        <!-- Edit -->
                                        <a href="{{ route('admin.project.edit', $project->id) }}"
                                        class="btn btn-sm btn-outline-info"
                                        data-bs-toggle="tooltip" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <!-- Survey -->
                                        <a href="{{ route('admin.survey.index', $project->id) }}"
                                        class="btn btn-sm btn-outline-secondary"
                                        data-bs-toggle="tooltip" title="Manage Surveys">
                                            <i class="bi bi-clipboard-check"></i>
                                        </a>

                                        <!-- Learning Pathways -->
                                        <a href="{{ route('admin.learningpathways.index', $project->id) }}"
                                        class="btn btn-sm btn-outline-primary"
                                        data-bs-toggle="tooltip" title="Learning Pathways">
                                            <i class="bi bi-layers"></i>
                                        </a>

                                        <!-- Feedback -->
                                        <a href="{{ route('admin.feedback.create', ['project_id' => $project->id]) }}"
                                        class="btn btn-sm btn-outline-info"
                                        data-bs-toggle="tooltip" title="Manage Feedback">
                                            <i class="bi bi-chat-text"></i>
                                        </a>

                                        <!-- Estimation -->
                                        <a href="{{ route('admin.project.estmator.index', $project->id) }}"
                                        class="btn btn-sm btn-outline-warning"
                                        data-bs-toggle="tooltip" title="Estimation">
                                            <i class="bi bi-cash-coin"></i>
                                        </a>

                                        <!-- Milestones -->
                                        <a href="{{ route('admin.project.milestones.create', $project->id) }}"
                                        class="btn btn-sm btn-outline-success"
                                        data-bs-toggle="tooltip" title="Milestones">
                                            <i class="bi bi-flag"></i>
                                        </a>

                                        <!-- Delete -->
                                        <button type="button"
                                        class="btn btn-sm btn-outline-danger delete-btn"
                                        data-id="{{ $project->id }}"
                                        data-title="{{ $project->title }}"
                                        data-bs-toggle="tooltip" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>

                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4">
                                    <div class="empty-state">
                                        <i class="feather feather-folder text-muted" style="font-size: 48px;"></i>
                                        <h5 class="mt-3">No projects found</h5>
                                        <p class="text-muted">Get started by creating a new project</p>
                                        <a href="{{ route('admin.project.create') }}" class="btn btn-primary mt-2">
                                            <i class="feather feather-plus me-2"></i>Create Project
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Bulk Actions -->
            @if ($projects->count() > 0)
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="bulk-actions">
                        <select class="form-select form-select-sm" style="width: auto;" id="bulkAction">
                            <option value="">Bulk Actions</option>
                            <option value="activate">Activate</option>
                            <option value="deactivate">Deactivate</option>
                            <option value="delete">Delete</option>
                        </select>
                        <button class="btn btn-sm btn-outline-primary ms-2" id="applyBulkAction">
                            Apply
                        </button>
                    </div>

                    <!-- Pagination -->
                    {{-- <div class="pagination-info">
                        <nav aria-label="Page navigation">
                            {{ $projects->links('vendor.pagination.bootstrap-5') }}
                        </nav>
                    </div> --}}

                    <!-- Results Count -->
                    <div class="text-muted small">
                        Showing {{ $projects->firstItem() }} to {{ $projects->lastItem() }}
                        of {{ $projects->total() }} entries
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete project "<span id="projectTitle"></span>"?</p>
                    <p class="text-danger"><small>This action cannot be undone. All related data will be permanently
                            deleted.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Project</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .avatar-md {
            width: 60px;
            height: 60px;
            object-fit: cover;
        }

        .progress {
            border-radius: 10px;
        }

        .empty-state {
            padding: 40px 0;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }

        .form-switch .form-check-input {
            width: 3em;
            height: 1.5em;
        }

        .bulk-actions {
            display: flex;
            align-items: center;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });

            // Select All checkbox
            $('#selectAll').on('change', function() {
                $('.select-item').prop('checked', $(this).prop('checked'));
            });

            // Individual checkbox - uncheck selectAll if any unchecked
            $('.select-item').on('change', function() {
                if (!$(this).prop('checked')) {
                    $('#selectAll').prop('checked', false);
                }
            });

            // Status toggle
            $('.status-toggle').on('change', function() {
                const projectId = $(this).data('id');
                const isActive = $(this).prop('checked');

                $.ajax({
                    url: "{{ route('admin.project.toggle-status', ':id') }}".replace(':id', projectId),
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        _method: 'PATCH'
                    },
                    success: function(response) {
                        toastr.success('Project status updated successfully!');
                    },
                    error: function(xhr) {
                        $(this).prop('checked', !isActive);
                        toastr.error('Error updating project status');
                    }
                });
            });

            // Delete button click
            $('.delete-btn').on('click', function() {
                const projectId = $(this).data('id');
                const projectTitle = $(this).data('title');

                $('#projectTitle').text(projectTitle);
                $('#deleteForm').attr('action', "{{ route('admin.project.destroy', '') }}/" + projectId);

                const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
                deleteModal.show();
            });

            // Bulk actions
            $('#applyBulkAction').on('click', function() {
                const action = $('#bulkAction').val();
                const selectedIds = [];

                $('.select-item:checked').each(function() {
                    selectedIds.push($(this).val());
                });

                if (selectedIds.length === 0) {
                    toastr.warning('Please select at least one project');
                    return;
                }

                if (!action) {
                    toastr.warning('Please select an action');
                    return;
                }

                if (action === 'delete') {
                    if (!confirm('Are you sure you want to delete ' + selectedIds.length +
                            ' selected project(s)?')) {
                        return;
                    }
                }

                $.ajax({
                    url: "{{ route('admin.project.bulk-action') }}",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        action: action,
                        ids: selectedIds
                    },
                    success: function(response) {
                        toastr.success(response.message);
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    },
                    error: function(xhr) {
                        toastr.error('Error performing bulk action');
                    }
                });
            });

            // Auto refresh stats every 30 seconds
            setInterval(function() {
                $.get("{{ route('admin.project.stats') }}", function(data) {
                    // Update stats cards if needed
                    console.log('Stats refreshed');
                });
            }, 30000);
        });
    </script>
@endpush
