
@extends('layouts.admin.app')

@section('content')
    <!-- Page content start-->
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Product List</h4>
                <h6>Manage your products</h6>
            </div>
        </div>
        {{-- <ul class="table-top-head">
            <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img src="{{ asset('resource/admin/assets/img/icons/pdf.svg')}}" alt="img"></a>
            </li>
            <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><img src="{{ asset('resource/admin/assets/img/icons/excel.svg')}}" alt="img"></a>
            </li>
            <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i class="ti ti-refresh"></i></a>
            </li>
            <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i class="ti ti-chevron-up"></i></a>
            </li>
        </ul> --}}
        <div class="page-btn">
            <a href="{{route('products.create')}}" class="btn btn-primary"><i class="ti ti-circle-plus me-1"></i>Add Product</a>
        </div>	
        {{-- <div class="page-btn import">
            <a href="#" class="btn btn-secondary color" data-bs-toggle="modal" data-bs-target="#view-notes"><i
                data-feather="download" class="me-1"></i>Import Product</a>
        </div> --}}
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

    <!-- /product list -->
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
                    <thead class="thead-light">
                        <tr>
                            <th>
                                <label class="checkboxs">
                                    <input type="checkbox" id="select-all" onchange="toggleAll(this)">
                                    <span class="checkmarks"></span>
                                </label>
                            </th>
                            <th>SKU </th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Unit</th>
                            <th>Status</th>
                            <th class="no-sort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            
                            <td>
                                <label class="checkboxs">
                                    <input type="checkbox" class="store-checkbox" name="ids[]" value="{{ $product->id }}">
                                    <span class="checkmarks"></span>
                                </label>
                            </td>
                            <td>{{ $product->sku }} </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="javascript:void(0);" class="avatar avatar-md me-2">
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                    </a>
                                    <a href="javascript:void(0);">{{ $product->name }}</a>
                                </div>												
                            </td>							
                            <td>{{ $product->category->name ?? 'N/A' }}</td>
                            <td><i class="fa fa-inr"></i> {{ number_format($product->price, 2) }}</td>
                            <td>{{ $product->unit->short_name ?? 'N/A' }}</td>
                            <td><span class="badge bg-{{ $product->status ? 'success' : 'danger' }}">{{ $product->status ? 'Active' : 'Inactive' }}</span></td>
                            <td class="action-table-data">
                                <div class="edit-delete-action">
                                    {{-- <a class="me-2 edit-icon  p-2" href="product-details.html">
                                        <i data-feather="eye" class="feather-eye"></i>
                                    </a> --}}
                                    <a class="me-2 p-2" href="{{ route('products.edit', $product->id) }}">
                                        <i data-feather="edit" class="feather-edit"></i>
                                    </a>
                                    
                                    {{-- <a data-bs-toggle="modal" data-bs-target="#delete-modal" class="p-2" href="javascript:void(0);">
                                        <i data-feather="trash-2" class="feather-trash-2"></i>
                                    </a> --}}
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /product list -->    
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
            alert("Please select at least one product.");
            return;
        }

        sendStatusUpdate(selectedIds, status);
    }

    function sendStatusUpdate(ids, status) {
        fetch('/admin/products/bulk-status-updateproduct', {
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