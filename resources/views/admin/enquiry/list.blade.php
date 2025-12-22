@extends('layouts.admin.app')

@section('content')
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Students</h4>
                <h6>Manage your Students</h6>
            </div>
        </div>
        <ul class="table-top-head">
            <li><a data-bs-toggle="tooltip" title="Pdf"><img src="{{ asset('resource/admin/assets/img/icons/pdf.svg') }}" alt="img"></a></li>
            <li><a data-bs-toggle="tooltip" title="Excel"><img src="{{ asset('resource/admin/assets/img/icons/excel.svg') }}" alt="img"></a></li>
            <li><a data-bs-toggle="tooltip" title="Refresh"><i class="ti ti-refresh"></i></a></li>
            <li><a data-bs-toggle="tooltip" title="Collapse" id="collapse-header"><i class="ti ti-chevron-up"></i></a></li>
        </ul>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card p-2">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table datatable">
                    <thead class="thead-light">
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Type</th>
                            <th>Message</th>
                            <th>Philanthropist</th>
                            <th>Paid</th>
                            <th>Status</th>
                            <th>Created On</th>
                            <th class="no-sort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($enquiry as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->email ?? 'N/A' }}</td>
                                <td>{{ $row->mobile }}</td>
                                <td>
                                    @switch($row->type)
                                        @case(1) General @break
                                        @case(2) Sponsorship @break
                                        @case(3) Volunteering @break
                                        @case(4) Partnership @break
                                        @case(5) Support @break
                                        @case(6) Feedback @break
                                        @case(7) Course @break
                                        @case(8) Event @break
                                        @case(9) Competition @break
                                        @default Unknown
                                    @endswitch
                                </td>
                                <td>{{ Str::limit($row->message, 50) ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge bg-{{ $row->is_philanthropist ? 'success' : 'secondary' }}">
                                        {{ $row->is_philanthropist ? 'Yes' : 'No' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $row->paid ? 'success' : 'secondary' }}">
                                        {{ $row->paid ? 'Yes' : 'No' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $row->status ? 'success' : 'danger' }}">
                                        {{ $row->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>{{ $row->created_at->format('d M Y') }}</td>
                               <td class="action-table-data">
                                    <div class="d-flex">
                                        <a href="{{ route('admin.enquiry.show', $row->id) }}" class="btn p-2 me-1" data-bs-toggle="tooltip" title="View">
                                            <i data-feather="eye" class="feather-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.enquiry.edit', $row->id) }}" class="btn p-2 me-1" data-bs-toggle="tooltip" title="Edit">
                                            <i data-feather="edit" class="feather-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.enquiry.destroy', $row->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn p-2" onclick="return confirm('Are you sure?')" data-bs-toggle="tooltip" title="Delete">
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