@extends('layouts.admin.app')

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="add-item d-flex">
        <div class="page-title">
            <h4>Stores</h4>
            <h6>Manage your Store</h6>
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
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-store"><i class="ti ti-circle-plus me-1"></i>Add Store</a>
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
<!-- Store Table -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="search-set">
            <div class="search-input">
                <span class="btn-searchset"><i class="ti ti-search fs-14 feather-search"></i></span>
            </div>
        </div>
        <div class="dropdown mb-3">
            <a href="javascript:void(0);" class="btn btn-white dropdown-toggle" data-bs-toggle="dropdown">Change Status</a>
            <ul class="dropdown-menu dropdown-menu-end p-3">
                <li><a href="javascript:void(0);" class="dropdown-item change-status" data-status="1">Active</a></li>
                <li><a href="javascript:void(0);" class="dropdown-item change-status" data-status="0">Inactive</a></li>
            </ul>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>
                            <label class="checkboxs">
                                <input type="checkbox" id="select-all" onchange="toggleAll(this)">
                                <span class="checkmarks"></span>
                            </label>
                        </th>
                        <th>Store</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stores as $store)
                    <tr>
                        <td>
                            <label class="checkboxs">
                                <input type="checkbox" class="store-checkbox" name="ids[]" value="{{ $store->id }}">
                                <span class="checkmarks"></span>
                            </label>
                        </td>
                        <td>{{ $store->store_name }}</td>
                        <td>{{ $store->customer->first_name }}</td>
                        <td>{{ $store->email }}</td>
                        <td>{{ $store->phone }}</td>
                        <td>
                            <span class="badge bg-{{ $store->status ? 'success' : 'danger' }}">
                                {{ $store->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="text-end">
                            <div class="edit-delete-action">
                                <a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#view-store-{{ $store->id }}"><i data-feather="eye"></i></a>
                                <a class="me-2 p-2" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#edit-store-{{ $store->id }}"><i data-feather="edit"></i></a>
                                <a class="p-2" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete-modal-{{ $store->id }}"><i data-feather="trash-2"></i></a>
                            </div>
                        </td>
                    </tr>

                    <!-- View Modal -->
                    <div class="modal fade" id="view-store-{{ $store->id }}">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4>View Store</h4>
                                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>Store Name:</strong> {{ $store->store_name }}</li>

                                        <li class="list-group-item"><strong>User Name:</strong> {{ $store->customer->first_name }}</li>
                                        <li class="list-group-item"><strong>Email:</strong> {{ $store->email }}</li>
                                        <li class="list-group-item"><strong>Phone:</strong> {{ $store->phone }}</li>
                                        <li class="list-group-item"><strong>Status:</strong> <span class="badge bg-{{ $store->status ? 'success' : 'danger' }}">{{ $store->status ? 'Active' : 'Inactive' }}</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="edit-store-{{ $store->id }}">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form method="POST" action="{{ route('stores.update', $store->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h4>Edit Store</h4>
                                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3"><label>Store Name</label><input type="text" class="form-control" name="store_name" value="{{ $store->store_name }}"></div>
                                        <div class="mb-3"><label>User Name</label><input type="text" class="form-control" name="user_name" value="{{ $store->customer->first_name }}"></div>
                                        <div class="mb-3"><label>Email</label><input type="email" class="form-control" name="email" value="{{ $store->email }}"></div>
                                        <div class="mb-3"><label>Phone</label><input type="text" class="form-control" name="phone" value="{{ $store->phone }}"></div>
                                        <div class="form-check form-switch mb-3 col-12">
                                            <input type="hidden" name="status" value="0">
                                            <input class="form-check-input" type="checkbox" name="status" value="1" {{ $store->status ? 'checked' : '' }}>
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

                    <!-- Delete Modal -->
                    <div class="modal fade" id="delete-modal-{{ $store->id }}">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content p-5">
                                <div class="modal-body text-center p-0">
                                    <span class="rounded-circle d-inline-flex p-2 bg-danger-transparent mb-2">
                                        <i class="ti ti-trash fs-24 text-danger"></i>
                                    </span>
                                    <h4 class="fs-20 fw-bold">Delete Store</h4>
                                    <p>Are you sure you want to delete this store?</p>
                                    <form method="POST" action="{{ route('stores.destroy', $store->id) }}">
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

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Store Modal -->
<div class="modal fade" id="add-store">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('stores.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h4>Add Store</h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="mb-3"><label>Store Name</label><input type="text" class="form-control" name="store_name" required></div>
                    @php
                    use Illuminate\Support\Facades\DB;

                    // Get status = 1 customers
                    $customers = DB::table('customers')->where('status', 1)->get();
                @endphp

                {{-- <select class="form-control" name="user_name" required>
                    <option value="" disabled selected>Choose customer</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->full_name }}</option>
                    @endforeach
                </select> --}}

                <div class="mb-3">
                    <label>Select Customer</label>
                    <select class="form-select" name="user_name" required>
                        <option value="" disabled selected>Choose customer</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->full_name }}</option>
                        @endforeach
                    </select>
                </div>

                    {{-- <div class="mb-3"><label>User Name</label><input type="text" class="form-control" name="user_name" required></div> --}}
                    <div class="mb-3"><label>Email</label><input type="email" class="form-control" name="email" required></div>
                    <div class="mb-3"><label>Phone</label><input type="text" class="form-control" name="phone" required></div>
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
        fetch('/admin/stores/bulk-status-updatestore', {
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
