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

<div class="card p-2">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table datatable">
                <thead class="thead-light">
                    <tr>
                        <th>S.No</th>
                        <th>Student Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Skill Sector</th>
                        <th>Qualification</th>
                        {{-- <th>Status</th> --}}
                        <th class="no-sort">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $student->student_name }}</td>
                        <td>{{ $student->mobile ?? 'N/A' }}</td>
                        <td>{{ $student->email ?? 'N/A' }}</td>
                        <td>{{ $student->skill_sector ?? 'N/A' }}</td>
                        <td>{{ $student->qualification ?? 'N/A' }}</td>
                        {{-- <td>
                            <span class="badge bg-{{ $student->status == 'active' ? 'success' : 'secondary' }}">
                                {{ ucfirst($student->status ?? 'inactive') }}
                            </span>
                        </td> --}}
                        <td class="action-table-data">
                            <div class="d-flex">
                                <a href="{{ route('admin.student.show', $student->id) }}" class="btn p-2 me-1" data-bs-toggle="tooltip" title="View">
                                    <i data-feather="eye" class="feather-eye"></i>
                                </a>
                                {{-- <a href="{{ route('admin.student.edit', $student->id) }}" class="btn p-2 me-1" data-bs-toggle="tooltip" title="Edit">
                                    <i data-feather="edit" class="feather-edit"></i>
                                </a> --}}
                                <form action="{{ route('admin.student.destroy', $student->id) }}" method="POST" style="display:inline;">
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