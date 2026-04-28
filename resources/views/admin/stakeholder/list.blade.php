@extends('layouts.admin.app')
@section('content')
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Stakeholders</h4>
                <h6>Manage and track all stakeholders</h6>
            </div>
        </div>
        <ul class="table-top-head">
            <li>
                <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh" onclick="location.reload()">
                    <i class="feather feather-rotate-ccw"></i>
                </a>
            </li>
            <li>
                <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" id="collapse-header" title="Collapse">
                    <i class="feather feather-chevron-up"></i>
                </a>
            </li>
        </ul>
        <div class="page-btn mt-0">
            <a href="{{ route('admin.stakeholder.create') }}" class="btn btn-primary">
                <i class="feather feather-plus me-2"></i>Create New Stakeholder
            </a>
        </div>
    </div>

    {{-- Messages --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Filters Card -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('admin.stakeholder.index') }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Search</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="feather feather-search"></i></span>
                        <input type="text" class="form-control" name="search" placeholder="Search by name, email..."
                            value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Type</label>
                    <select class="form-select" name="type">
                        <option value="">All Types</option>
                        <option value="1" {{ request('type') == '1' ? 'selected' : '' }}>ISICO Core</option>
                        <option value="2" {{ request('type') == '2' ? 'selected' : '' }}>Training Partner</option>
                        <option value="3" {{ request('type') == '3' ? 'selected' : '' }}>Learner</option>
                        <option value="4" {{ request('type') == '4' ? 'selected' : '' }}>Volunteer</option>
                        <option value="5" {{ request('type') == '5' ? 'selected' : '' }}>Funding Partner</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select class="form-select" name="status">
                        <option value="">All Statuses</option>
                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                        <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Inactive</option>
                        <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="feather feather-filter me-1"></i> Filter
                    </button>
                </div>
            </form>
            @if (request()->anyFilled(['search', 'type', 'status']))
                <div class="mt-3">
                    <a href="{{ route('admin.stakeholder.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="feather feather-x me-1"></i> Clear Filters
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Stakeholders Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="100">ID</th>
                            <th>Name / Email</th>
                            <th>Type</th>
                            <th>Company / Role</th>
                            <th>Status</th>
                            <th width="150" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stakeholders ?? [] as $stakeholder)
                            <tr>
                                <td>
                                    <span class="badge bg-light text-dark">#{{ $stakeholder->stakeholder_id }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">
                                                <a href="{{ route('admin.stakeholder.show', $stakeholder->id) }}" class="text-dark">
                                                    {{ $stakeholder->full_name }}
                                                </a>
                                            </h6>
                                            <p class="text-muted mb-0 small">
                                                <i class="feather feather-mail me-1"></i> {{ $stakeholder->email }}
                                                <br>
                                                <i class="feather feather-phone me-1"></i> {{ $stakeholder->phone ?? 'N/A' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @switch($stakeholder->type)
                                        @case(1) <span class="badge bg-primary">ISICO Core</span> @break
                                        @case(2) <span class="badge bg-info">Training Partner</span> @break
                                        @case(3) <span class="badge bg-warning text-dark">Learner</span> @break
                                        @case(4) <span class="badge bg-success">Volunteer</span> @break
                                        @case(5) <span class="badge bg-secondary">Funding Partner</span> @break
                                        @default <span class="badge bg-light text-dark">Other</span>
                                    @endswitch
                                </td>
                                <td>
                                    <div class="text-dark">{{ $stakeholder->company_name ?? 'N/A' }}</div>
                                    <small class="text-muted">{{ $stakeholder->designation ?? 'No Designation' }}</small>
                                </td>
                                <td>
                                    @if($stakeholder->status == 1)
                                        <span class="badge bg-success">Active</span>
                                    @elseif($stakeholder->status == 2)
                                        <span class="badge bg-secondary">Inactive</span>
                                    @elseif($stakeholder->status == 3)
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @else
                                        <span class="badge bg-dark">Other</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.stakeholder.show', $stakeholder->id) }}" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="View">
                                            <i class="feather feather-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.stakeholder.edit', $stakeholder->id) }}" class="btn btn-sm btn-outline-info" data-bs-toggle="tooltip" title="Edit">
                                            <i class="feather feather-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.stakeholder.destroy', $stakeholder->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this stakeholder?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip" title="Delete">
                                                <i class="feather feather-trash-2"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="empty-state">
                                        <i class="feather feather-users text-muted" style="font-size: 48px;"></i>
                                        <h5 class="mt-3">No stakeholders found</h5>
                                        <p class="text-muted">Get started by creating a new stakeholder.</p>
                                        <a href="{{ route('admin.stakeholder.create') }}" class="btn btn-primary mt-2">
                                            <i class="feather feather-plus me-2"></i>Create Stakeholder
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if(isset($stakeholders) && $stakeholders instanceof \Illuminate\Pagination\LengthAwarePaginator && $stakeholders->count() > 0)
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="pagination-info">
                        {{ $stakeholders->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
