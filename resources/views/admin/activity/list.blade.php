@extends('layouts.admin.app')

@section('content')
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Activities</h4>
                <h6>Manage your Events & Competitions</h6>
            </div>
        </div>
        <ul class="table-top-head">
            <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img
                        src="{{ asset('resource/admin/assets/img/icons/pdf.svg') }}" alt="img"></a>
            </li>
            <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><img
                        src="{{ asset('resource/admin/assets/img/icons/excel.svg') }}" alt="img"></a>
            </li>
            <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i class="ti ti-refresh"></i></a>
            </li>
            <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i
                        class="ti ti-chevron-up"></i></a>
            </li>
        </ul>
        <div class="page-btn">
            <a href="{{ route('admin.activity.create') }}" class="btn btn-primary">
                <i class="ti ti-circle-plus me-1"></i>Add Activity
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
    @if ($errors->any()))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <div class="search-set">
                <div class="search-input">
                    <span class="btn-searchset"><i class="ti ti-search fs-14 feather-search"></i></span>
                    <div class="dataTables_filter">
                        <label>
                            <input type="search" class="form-control form-control-sm" placeholder="Search"
                                aria-controls="DataTables_Table_0">
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table datatable">
                    <thead class="thead-light">
                        <tr>
                            <th>S.No</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Dates</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th class="no-sort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activities as $activity)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>
                                    <span class="text-gray-9">{{ $activity->title }}</span>
                                    <small class="d-block text-muted">{{ Str::limit($activity->short_description, 50) }}</small>
                                </td>
                                <td>
                                    @if($activity->type == 1)
                                        <span class="badge bg-info">Event</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Competition</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $activity->start_date->format('M d') }} - 
                                    {{ $activity->end_date->format('M d, Y') }}
                                </td>
                                <td>{{ Str::limit($activity->location, 20) }}</td>
                                <td>
                                    @if($activity->status == 1)
                                        <span class="badge bg-primary">Active</span>
                                    @elseif($activity->status == 0)
                                        <span class="badge bg-danger">Inactive</span>
                                    @elseif($activity->status == 2)
                                        <span class="badge bg-warning">Upcoming</span>
                                    @elseif($activity->status == 3)
                                        <span class="badge bg-info">Ongoing</span>
                                    @elseif($activity->status == 4)
                                        <span class="badge bg-success">Completed</span>
                                    @endif
                                </td>
                                <td class="action-table-data">
                                    <div class="edit-delete-action">
                                        <a class="me-2 p-2" href="{{ route('admin.activity.edit', $activity->id) }}"
                                           data-bs-toggle="tooltip" title="Edit">
                                            <i data-feather="edit" class="feather-edit"></i>
                                        </a>
                                        {{-- <a class="me-2 p-2" href="{{ route('admin.activity.show', $activity->id) }}"
                                           data-bs-toggle="tooltip" title="View">
                                            <i data-feather="eye" class="feather-eye"></i>
                                        </a> --}}
                                        <form action="{{ route('admin.activity.destroy', $activity->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn p-2"
                                                onclick="return confirm('Are you sure you want to delete this activity?')"
                                                data-bs-toggle="tooltip" title="Delete">
                                                <i data-feather="trash-2" class="feather-trash-2"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Initialize tooltips
        $(function () {
            $('[data-bs-toggle="tooltip"]').tooltip()
        });
    </script>
@endpush