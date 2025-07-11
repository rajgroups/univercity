
@extends('layouts.admin.app')

@section('content')
    <!-- Page content start-->
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Units</h4>
                <h6>Manage your units</h6>
            </div>
        </div>
        {{-- <ul class="table-top-head">
            <li><a data-bs-toggle="tooltip" title="Pdf"><img src="{{ asset('resource/admin/assets/img/icons/pdf.svg')}}" alt="PDF"></a></li>
            <li><a data-bs-toggle="tooltip" title="Excel"><img src="{{ asset('resource/admin/assets/img/icons/excel.svg')}}" alt="Excel"></a></li>
            <li><a data-bs-toggle="tooltip" title="Print"><i data-feather="printer"></i></a></li>
            <li><a data-bs-toggle="tooltip" title="Refresh"><i class="ti ti-refresh"></i></a></li>
            <li><a data-bs-toggle="tooltip" title="Collapse" id="collapse-header"><i class="ti ti-chevron-up"></i></a></li>
        </ul> --}}
        <div class="page-btn">
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-units"><i class="ti ti-circle-plus me-1"></i>Add Unit</a>
        </div>
    </div>
    <!-- Alerts -->
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show">{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show">
    <ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <div class="search-set">
                <div class="search-input">
                    <span class="btn-searchset"><i class="ti ti-search fs-14 feather-search"></i></span>
                </div>
            </div>
            <div class="table-dropdown my-xl-auto right-content">
                <div class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown">
                        Status
                    </a>
                    <ul class="dropdown-menu  dropdown-menu-end p-3">
                        <li><a href="javascript:void(0);" class="dropdown-item change-status" data-status="1">Active</a></li>
                        <li><a href="javascript:void(0);" class="dropdown-item change-status" data-status="0">Inactive</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table datatable">
                    <thead class="thead-light">
                        <tr>
                            <th>
                                <label class="checkboxs">
                                    <input type="checkbox" id="select-all" onchange="toggleAll(this)">
                                    <span class="checkmarks"></span>
                                </label>
                            </th>
                            <th>No</th>
                            <th>Unit</th>
                            <th>Short name</th>
                            {{-- <th>No of Products</th> --}}
                            <th>Created Date</th>
                            <th>Status</th>
                            <th class="no-sort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    @foreach($units as $unit)
                   
                    <tr>     
                        <td>
                            <label class="checkboxs">
                                <input type="checkbox" class="unit-checkbox" name="ids[]" value="{{ $unit->id }}">
                                <span class="checkmarks"></span>
                            </label>
                        </td>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $unit->unit_name }}</td>
                        <td>{{ $unit->short_name }}</td>
                        <td>{{ $unit->created_at->format('d M Y') }}</td>
                        <td>
                            <span class="badge bg-{{ $unit->status ? 'success' : 'danger' }}">
                                {{ $unit->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="text-end">
                            <div class="edit-delete-action">
                                <a class="me-2 p-2" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#edit-units-{{ $unit->id }}"><i data-feather="edit"></i></a>
                                <a class="p-2" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete-modal-{{ $unit->id }}"><i data-feather="trash-2"></i></a>
                            </div>
                        </td>
                    </tr>
                    <!-- Edit Unit -->
                    <div class="modal fade" id="edit-units-{{ $unit->id }}">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form method="POST" action="{{ route('units.update', $unit->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <div class="page-title">
                                            <h4>Edit Unit</h4>
                                        </div>
                                        <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">		
                                        <div class="mb-3">
                                            <label class="form-label">Unit<span class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="unit_name" value="{{ $unit->unit_name }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Short Name<span class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control"  name="short_name" value="{{ $unit->short_name }}">
                                        </div>
                                        <div class="form-check form-switch mb-3 col-12">
                                            <input type="hidden" name="status" value="0">
                                            <input class="form-check-input" type="checkbox" name="status" value="1" {{ $unit->status ? 'checked' : '' }}>
                                            <label class="form-check-label">Status</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /Edit Unit -->

                    <!-- delete modal -->
                    <div class="modal fade" id="delete-modal-{{ $unit->id }}">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="page-wrapper-new p-0">
                                    <div class="content p-5 px-3 text-center">
                                        <span class="rounded-circle d-inline-flex p-2 bg-danger-transparent mb-2"><i class="ti ti-trash fs-24 text-danger"></i></span>
                                        <h4 class="fs-20 fw-bold mb-2 mt-1">Delete Unit</h4>
                                        <p class="mb-0 fs-16">Are you sure you want to delete unit?</p> 
                                        <form method="POST" action="{{ route('units.destroy', $unit->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <div class="d-flex justify-content-center mt-3">
                                                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                            </div>
                                        </form>					
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /product list -->
    <!-- Add Unit -->
		<div class="modal fade" id="add-units">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
                    <form action="{{ route('units.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <div class="page-title">
                                <h4>Add Unit</h4>
                            </div>
                            <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
						<div class="modal-body">
                            <div class="mb-3">
                                <label>Unit Name</label>
                                <input type="text" name="unit_name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Short Name</label>
                                <input type="text" name="short_name" class="form-control" required>
                            </div>
                            <div class="form-check form-switch mb-3 col-12">
                                <input type="hidden" name="status" value="0">
                                <input class="form-check-input" type="checkbox" name="status" value="1" checked>
                                <label class="form-check-label">Status</label>
                            </div>
						</div>
						<div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Add Store</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
					</form>
				</div>
			</div>
		</div>
		<!-- /Add Unit -->

		
    <!-- Page content end-->
@endsection
@push('scripts')
     

<script>
    function toggleAll(source) {
        document.querySelectorAll('input[name="ids[]"]').forEach(checkbox => {
            checkbox.checked = source.checked;
        });
    }

    function updateStatus(status) {
        let selectedIds = Array.from(document.querySelectorAll('input[name="ids[]"]:checked'))
            .map(checkbox => checkbox.value);

        if (selectedIds.length === 0) {
            alert("Please select at least one store.");
            return;
        }

        sendStatusUpdate(selectedIds, status);
    }

    function sendStatusUpdate(ids, status) {
        fetch("{{ url('/admin/units/bulk-status-updateunit') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                ids: ids,
                status: status
            })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to update status.');
        });
    }

    document.querySelectorAll('.change-status').forEach(item => {
        item.addEventListener('click', function (e) {
            e.preventDefault();
            let status = this.getAttribute('data-status');
            updateStatus(status);
        });
    });
</script>
@endpush
