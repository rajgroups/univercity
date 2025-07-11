@extends('layouts.admin.app')

@section('content')
<div class="page-header">
    <div class="add-item d-flex">
        <div class="page-title">
            <h4 class="fw-bold">Customers</h4>
            <h6>Manage your customers</h6>
        </div>
    </div>
    {{-- <ul class="table-top-head">
        <li><a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img src="{{ asset('resource/admin/assets/img/icons/pdf.svg')}}" alt="img"></a></li>
        <li><a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><img src="{{ asset('resource/admin/assets/img/icons/excel.svg')}}" alt="img"></a></li>
        <li><a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i class="ti ti-refresh"></i></a></li>
        <li><a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i class="ti ti-chevron-up"></i></a></li>
    </ul> --}}
    <div class="page-btn">
        <a href="#" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#add-customer"><i class="ti ti-circle-plus me-1"></i>Add Customer</a>
    </div>
</div>

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
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="search-set">
            <div class="search-input">
                <span class="btn-searchset"><i class="ti ti-search fs-14 feather-search"></i></span>
            </div>
        </div>
        <div class="dropdown mb-3">
            <a href="javascript:void(0);" class="btn btn-white dropdown-toggle" data-bs-toggle="dropdown">Change Status</a>
            <ul class="dropdown-menu dropdown-menu-end p-3">
                <li><a href="#" class="dropdown-item change-status" data-status="1">Active</a></li>
                <li><a href="#" class="dropdown-item change-status" data-status="0">Inactive</a></li>
            </ul>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table datatable">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="select-all"></th>
                        <th>S.No</th>
                        <th>Customer</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $index => $customer)
                    <tr>
                        <td><input type="checkbox" name="selected[]" value="{{ $customer->id }}"></td>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $customer->full_name }}</td>
                        <td><a href="mailto:{{ $customer->email }}">{{ $customer->email }}</a></td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->address }}</td>
                        <td><span class="badge bg-{{ $customer->status ? 'success' : 'danger' }}">{{ $customer->status ? 'Active' : 'Inactive' }}</span></td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-outline-secondary me-1" title="View" data-bs-toggle="modal" data-bs-target="#view-customer-{{ $customer->id }}"><i data-feather="eye"></i></a>
                            <a class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#edit-customer-{{ $customer->id }}" title="Edit"><i data-feather="edit"></i></a>
                            <a class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delete-customer-{{ $customer->id }}" title="Delete"><i data-feather="trash-2"></i></a>
                        </td>
                    </tr>

                    <!-- View Modal -->
                    <div class="modal fade" id="view-customer-{{ $customer->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Customer Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body row g-3">
                                    <div class="col-md-6"><label class="form-label fw-bold">Full Name</label><p>{{ $customer->full_name }}</p></div>
                                    <div class="col-md-6"><label class="form-label fw-bold">Email</label><p>{{ $customer->email }}</p></div>
                                    <div class="col-md-6"><label class="form-label fw-bold">Phone</label><p>{{ $customer->phone }}</p></div>
                                    <div class="col-md-6"><label class="form-label fw-bold">Address</label><p>{{ $customer->address }}</p></div>
                                    <div class="col-md-6"><label class="form-label fw-bold">Status</label><p><span class="badge bg-{{ $customer->status ? 'success' : 'danger' }}">{{ $customer->status ? 'Active' : 'Inactive' }}</span></p></div>
                                </div>
                                <div class="modal-footer"><button class="btn btn-secondary" data-bs-dismiss="modal">Close</button></div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="edit-customer-{{ $customer->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form method="POST" action="{{ route('customers.update', $customer->id) }}">
                                    @csrf @method('PUT')
                                    <div class="modal-header"><h5 class="modal-title">Edit Customer</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                                    <div class="modal-body row">
                                        <div class="mb-3 col-6"><label class="form-label">First Name *</label><input type="text" name="first_name" id="edit-first-name-{{ $customer->id }}" class="form-control" value="{{ $customer->first_name }}" required></div>
                                        <div class="mb-3 col-6"><label class="form-label">Last Name</label><input type="text" name="last_name" id="edit-last-name-{{ $customer->id }}" class="form-control" value="{{ $customer->last_name }}"></div>
                                        <div class="mb-3 col-12"><label class="form-label">Full Name</label><input type="text" name="full_name" id="edit-full-name-{{ $customer->id }}" class="form-control" value="{{ $customer->full_name }}" readonly></div>
                                        <div class="mb-3 col-12"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="{{ $customer->email }}"></div>
                                        <div class="mb-3 col-12"><label class="form-label">Phone *</label><input type="tel" name="phone" class="form-control" value="{{ $customer->phone }}" required></div>
                                        <div class="mb-3 col-12"><label class="form-label">Address</label><textarea name="address" class="form-control">{{ $customer->address }}</textarea></div>
                                        
                                        <div class="form-check form-switch mb-3 col-12">
                                            <input type="hidden" name="status" value="0">
                                            <input class="form-check-input" type="checkbox" name="status" value="1" {{ $customer->status ? 'checked' : '' }}>
                                            <label class="form-check-label">Status</label>
                                        </div>
                                        {{-- <div class="form-check form-switch mb-3 col-12"><input type="hidden" name="status" value="0"><input class="form-check-input" type="checkbox" name="status" value="1" {{ $customer->status ? 'checked' : '' }}><label class="form-check-label">Status</label></div> --}}
                                    </div>
                                    <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button><button type="submit" class="btn btn-primary">Save</button></div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="delete-customer-{{ $customer->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content text-center p-4">
                                <span class="text-danger fs-2 mb-2"><i class="ti ti-trash"></i></span>
                                <h5 class="fw-bold">Delete Customer</h5>
                                <p>Are you sure you want to delete <strong>{{ $customer->full_name }}</strong>?</p>
                                <div class="d-flex justify-content-center gap-2">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form method="POST" action="{{ route('customers.destroy', $customer->id) }}">@csrf @method('DELETE')<button type="submit" class="btn btn-danger">Yes, Delete</button></form>
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

<!-- Add Customer Modal -->
<div class="modal fade" id="add-customer" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('customers.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row">
                    <div class="mb-3 col-6"><label class="form-label">First Name *</label><input type="text" name="first_name" id="add-first-name" class="form-control" required></div>
                    <div class="mb-3 col-6"><label class="form-label">Last Name</label><input type="text" name="last_name" id="add-last-name" class="form-control"></div>
                    <div class="mb-3 col-12"><label class="form-label">Full Name</label><input type="text" name="full_name" id="add-full-name" class="form-control" readonly></div>
                    <div class="mb-3 col-12"><label class="form-label">Email</label><input type="email" name="email" class="form-control"></div>
                    <div class="mb-3 col-12"><label class="form-label">Phone *</label><input type="tel" name="phone" class="form-control" required></div>
                    <div class="mb-3 col-12"><label class="form-label">Address</label><textarea name="address" class="form-control" rows="2"></textarea></div>
                    
                    <div class="form-check form-switch mb-3 col-12">
                        <input type="hidden" name="status" value="0">
                        <input class="form-check-input" type="checkbox" name="status" value="1" checked>
                        <label class="form-check-label">Status</label>
                    </div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button><button type="submit" class="btn btn-primary">Add</button></div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    @foreach($customers as $customer)
        const fn{{ $customer->id }} = document.getElementById('edit-first-name-{{ $customer->id }}');
        const ln{{ $customer->id }} = document.getElementById('edit-last-name-{{ $customer->id }}');
        const full{{ $customer->id }} = document.getElementById('edit-full-name-{{ $customer->id }}');
        if (fn{{ $customer->id }} && ln{{ $customer->id }} && full{{ $customer->id }}) {
            const updateFullName = () => full{{ $customer->id }}.value = `${fn{{ $customer->id }}.value} ${ln{{ $customer->id }}.value}`.trim();
            fn{{ $customer->id }}.addEventListener('input', updateFullName);
            ln{{ $customer->id }}.addEventListener('input', updateFullName);
        }
    @endforeach

    const addFn = document.getElementById('add-first-name');
    const addLn = document.getElementById('add-last-name');
    const addFull = document.getElementById('add-full-name');
    const updateAddFullName = () => addFull.value = `${addFn.value} ${addLn.value}`.trim();
    addFn.addEventListener('input', updateAddFullName);
    addLn.addEventListener('input', updateAddFullName);

    document.querySelectorAll('.change-status').forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();
            const status = btn.getAttribute('data-status');
            const selected = Array.from(document.querySelectorAll('input[name="selected[]"]:checked')).map(cb => cb.value);
            if (selected.length === 0) return alert("Please select at least one customer.");

            fetch("{{ route('customers.bulk-status-updatecus') }}", {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ ids: selected, status })
            }).then(res => res.json())
            .then(r => { alert(r.message); location.reload(); })
            .catch(err => alert("Error updating status."));
        });
    });

    document.getElementById('select-all')?.addEventListener('change', function () {
        document.querySelectorAll('input[name="selected[]"]').forEach(cb => cb.checked = this.checked);
    });
});
</script>
@endpush
