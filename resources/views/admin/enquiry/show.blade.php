@extends('layouts.admin.app')

@section('content')
<div class="page-header">
    <div class="add-item d-flex">
        <div class="page-title">
            <h4 class="fw-bold">Enquiry Details</h4>
            <h6>View enquiry information</h6>
        </div>
    </div>
    <div class="page-btn mt-0">
        <a href="{{ route('admin.enquiry.index') }}" class="btn btn-secondary">
            <i class="feather feather-arrow-left me-2"></i>Back to List
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th width="30%">Name</th>
                                <td>{{ $enquiry->name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $enquiry->email ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Mobile</th>
                                <td>{{ $enquiry->mobile }}</td>
                            </tr>
                            <tr>
                                <th>Enquiry Type</th>
                                <td>
                                    @switch($enquiry->type)
                                        @case(1) General @break
                                        @case(2) Sponsorship @break
                                        @case(3) Volunteering @break
                                        @case(4) Partnership @break
                                        @case(5) Support @break
                                        @case(6) Feedback @break
                                        @case(7) Course @break
                                        @case(8) Event @break
                                        @case(9) Competition @break
                                        @case(10) Newsletter @break
                                        @case(11) Project Interest @break
                                        @default Unknown
                                    @endswitch
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th width="30%">Philanthropist</th>
                                <td>
                                    <span class="badge bg-{{ $enquiry->is_philanthropist ? 'success' : 'secondary' }}">
                                        {{ $enquiry->is_philanthropist ? 'Yes' : 'No' }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Payment Status</th>
                                <td>
                                    <span class="badge bg-{{ $enquiry->paid ? 'success' : 'warning' }}">
                                        {{ $enquiry->paid ? 'Paid' : 'Unpaid' }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <span class="badge bg-{{ $enquiry->status ? 'success' : 'danger' }}">
                                        {{ $enquiry->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td>{{ $enquiry->created_at->format('d M Y, h:i A') }}</td>
                            </tr>
                            <tr>
                                <th>Last Updated</th>
                                <td>{{ $enquiry->updated_at->format('d M Y, h:i A') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Message</h5>
                    </div>
                    <div class="card-body">
                        <div class="p-3 bg-light rounded">
                            {{ $enquiry->message ?? 'No message provided' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 text-end">
                <a href="{{ route('admin.enquiry.edit', $enquiry->id) }}" class="btn btn-primary me-2">
                    <i class="feather feather-edit me-2"></i>Edit
                </a>
                <form action="{{ route('admin.enquiry.destroy', $enquiry->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this enquiry?')">
                        <i class="feather feather-trash-2 me-2"></i>Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection