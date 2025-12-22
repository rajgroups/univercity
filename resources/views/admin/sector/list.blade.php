@extends('layouts.admin.app')

@section('content')
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Sector</h4>
                <h6>Manage your categories</h6>
            </div>
        </div>
        <ul class="table-top-head">
            <li><a data-bs-toggle="tooltip" title="Pdf"><img src="{{ asset('resource/admin/assets/img/icons/pdf.svg') }}"
                        alt="img"></a></li>
            <li><a data-bs-toggle="tooltip" title="Excel"><img
                        src="{{ asset('resource/admin/assets/img/icons/excel.svg') }}" alt="img"></a></li>
            <li><a data-bs-toggle="tooltip" title="Refresh"><i class="ti ti-refresh"></i></a></li>
            <li><a data-bs-toggle="tooltip" title="Collapse" id="collapse-header"><i class="ti ti-chevron-up"></i></a></li>
        </ul>
        <div class="page-btn">
            <a href="{{ route('admin.sectors.create') }}" class="btn btn-primary"><i class="ti ti-circle-plus me-1"></i>Add
                Sector</a>
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

    <!--  Sector List -->
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
                            <th>Sector</th>
                            <th>Position</th>
                            <th>Type</th>
                            <th>Slug</th>
                            <th>Created On</th>
                            <th>Status</th>
                            <th class="no-sort text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sectors as $index => $sector)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $sector->name }}</td>
                                <td>{{ $sector->position ?? NULL }}</td>
                                <td>
                                    @if($sector->type == 1)
                                        Normal
                                    @else
                                        INTL
                                    @endif
                                </td>
                                <td>{{ $sector->slug }}</td>
                                <td>{{ $sector->created_at->format('d M Y') }}</td>
                                <td>
                                    @if ($sector->status == '1')
                                        <span class="badge bg-success fw-medium fs-10">Active</span>
                                    @else
                                        <span class="badge bg-danger fw-medium fs-10">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="edit-delete-action">
                                        <a class="me-2 p-2" href="{{ route('admin.sectors.edit', $sector->id) }}">
                                            <i data-feather="edit" class="feather-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.sectors.destroy', $sector->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn p-2 text-danger btn-link"
                                                onclick="return confirm('Are you sure you want to delete this sector?')">
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
        document.addEventListener('DOMContentLoaded', function() {
            const selectAll = document.getElementById('select-all');
            const checkboxes = document.querySelectorAll('.sector-checkbox');

            selectAll.addEventListener('change', function() {
                checkboxes.forEach(checkbox => checkbox.checked = selectAll.checked);
            });
        });
    </script>
@endpush
