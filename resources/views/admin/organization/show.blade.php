@extends('layouts.admin.app')

@section('content')
<div class="page-header">
    <div class="add-item d-flex">
        <div class="page-title">
            <h4 class="fw-bold">Organization Details</h4>
            <h6>View complete organization information</h6>
        </div>
    </div>
    <div class="page-btn mt-0">
        <a href="{{ route('admin.organization.index') }}" class="btn btn-secondary">
            <i class="feather feather-arrow-left me-2"></i>Back to List
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Organization Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th width="35%">Organization Name</th>
                                        <td>{{ $organization->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Type</th>
                                        <td>{{ $organization->organization_type }}</td>
                                    </tr>
                                    <tr>
                                        <th>Website</th>
                                        <td>
                                            @if($organization->website)
                                                <a href="{{ $organization->website }}" target="_blank">
                                                    {{ $organization->website }}
                                                </a>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Contact Person Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th width="35%">Contact Person</th>
                                        <td>{{ $organization->contact_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Designation</th>
                                        <td>{{ $organization->contact_designation }}</td>
                                    </tr>
                                    <tr>
                                        <th>Contact Number</th>
                                        <td>{{ $organization->contact_number }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email Address</th>
                                        <td>{{ $organization->contact_email }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Address Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th width="35%">Full Address</th>
                                        <td>{{ $organization->address }}</td>
                                    </tr>
                                    <tr>
                                        <th>Country</th>
                                        <td>{{ $organization->country }}</td>
                                    </tr>
                                    <tr>
                                        <th>State</th>
                                        <td>{{ $organization->state }}</td>
                                    </tr>
                                    <tr>
                                        <th>District</th>
                                        <td>{{ $organization->district }}</td>
                                    </tr>
                                    @if($organization->city_village)
                                    <tr>
                                        <th>City/Village</th>
                                        <td>{{ $organization->city_village }}</td>
                                    </tr>
                                    @endif
                                    @if($organization->pincode)
                                    <tr>
                                        <th>Pincode</th>
                                        <td>{{ $organization->pincode }}</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Partnership Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th width="35%">Area of Collaboration</th>
                                        <td>{{ $organization->collaboration }}</td>
                                    </tr>
                                    <tr>
                                        <th>Target Beneficiary</th>
                                        <td>{{ $organization->beneficiary }}</td>
                                    </tr>
                                    <tr>
                                        <th>Registered On</th>
                                        <td>{{ $organization->created_at->format('d M Y, h:i A') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Last Updated</th>
                                        <td>{{ $organization->updated_at->format('d M Y, h:i A') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 text-end">
                {{-- <a href="{{ route('admin.organization.edit', $organization->id) }}" class="btn btn-primary me-2">
                    <i class="feather feather-edit me-2"></i>Edit
                </a> --}}
                <form action="{{ route('admin.organization.destroy', $organization->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this organization?')">
                        <i class="feather feather-trash-2 me-2"></i>Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection