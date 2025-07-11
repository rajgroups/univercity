@extends('layouts.admin.app')
@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="add-item d-flex">
        <div class="page-title">
            <h4 class="fw-bold">Sub Category</h4>
            <h6>Manage your sub categories</h6>
        </div>
    </div>
    <ul class="table-top-head">
        <li><a data-bs-toggle="tooltip" title="Pdf"><img src="{{ asset('resource/admin/assets/img/icons/pdf.svg')}}" alt="PDF"></a></li>
        <li><a data-bs-toggle="tooltip" title="Excel"><img src="{{ asset('resource/admin/assets/img/icons/excel.svg')}}" alt="Excel"></a></li>
        <li><a data-bs-toggle="tooltip" title="Refresh"><i class="ti ti-refresh"></i></a></li>
        <li><a data-bs-toggle="tooltip" title="Collapse" id="collapse-header"><i class="ti ti-chevron-up"></i></a></li>
    </ul>
    <div class="page-btn">
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-category">
            <i class="ti ti-circle-plus me-1"></i>Add Sub Category
        </a>
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

<!-- Card Table -->
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="search-set">
            <div class="search-input">
                <span class="btn-searchset"><i class="ti ti-search"></i></span>
            </div>
        </div>

        <!-- Filters -->
        <div class="d-flex table-dropdown my-xl-auto right-content align-items-center flex-wrap row-gap-3">
            
            {{-- <div class="dropdown me-2">
                <a class="btn btn-white dropdown-toggle" data-bs-toggle="dropdown">Category</a>
                <ul class="dropdown-menu p-3 filter-category">
                    @foreach($categories as $categoryItem)
                        <li><a href="#" class="dropdown-item" data-category="{{ $categoryItem->name }}">{{ $categoryItem->name }}</a></li>
                    @endforeach
                </ul>
            </div> --}}
            <div class="dropdown mb-3">
                <a href="javascript:void(0);" class="dropdown-toggle btn btn-white btn-md" data-bs-toggle="dropdown">
                    Change Status
                </a>
                <ul class="dropdown-menu dropdown-menu-end p-3">
                    <li><a href="#" class="dropdown-item rounded-1 change-status" data-status="1">Active</a></li>
                    <li><a href="#" class="dropdown-item rounded-1 change-status" data-status="0">Inactive</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table datatable">
                <thead class="thead-light">
                    <tr>
                        <th><input type="checkbox" id="select-all"></th>
                        <th>Sub Category</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($subcategories as $subcategory)
                    <tr>
                        <td><input type="checkbox" class="select-item" value="{{ $subcategory->id }}"></td>
                        <td class="sub-name">{{ $subcategory->sub_category_name }}</td>
                        <td class="cat-name">{{ $subcategory->category->name ?? 'N/A' }}</td>
                        <td class="sub-desc">{{ $subcategory->description }}</td>
                        <td class="sub-status">
                            @if ($subcategory->status)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            {{-- <a href="#" class="edit-btn me-2"
                               data-id="{{ $subcategory->id }}"
                               data-category="{{ $subcategory->category_id }}"
                               data-name="{{ $subcategory->sub_category_name }}"
                               data-status="{{ $subcategory->status }}"
                               data-bs-toggle="modal"
                               data-bs-target="#edit-category">
                               <i data-feather="edit"></i>
                            </a> --}}
                            <a href="#" class="me-2" data-bs-toggle="modal" data-bs-target="#edit-category-{{ $subcategory->id }}">
                                <i data-feather="edit"></i>
                            </a>
                            
                            <form action="{{ route('subcategory.destroy', $subcategory->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger p-0"><i data-feather="trash-2"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="add-category">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('subcategory.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h4>Add Sub Category</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Category <span class="text-danger">*</span></label>
                        <select class="form-select" name="category_id" required>
                            <option value="">Select</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Sub Category Name <span class="text-danger">*</span></label>
                        <input type="text" name="sub_category_name" class="form-control" required>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="status" checked>
                        <label class="form-check-label">Status</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<!-- Edit Modal -->
@foreach($subcategories as $subcategory)
<div class="modal fade" id="edit-category-{{ $subcategory->id }}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('subcategory.update', $subcategory->id) }}">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5>Edit Sub Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Category <span class="text-danger">*</span></label>
                        <select class="form-select" name="category_id" required>
                            <option value="">Select</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $subcategory->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Sub Category Name <span class="text-danger">*</span></label>
                        <input type="text" name="sub_category_name" class="form-control" value="{{ $subcategory->sub_category_name }}" required>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="status" value="1" {{ $subcategory->status ? 'checked' : '' }}>
                        <label class="form-check-label">Active</label>
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
@endforeach


@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {

// Select All
$('#select-all').on('change', function () {
    $('.select-item').prop('checked', this.checked);
});

// Change status via dropdown
$(document).on('click', '.change-status', function (e) {
    e.preventDefault();
    // alert('good'); // for debugging

    const status = $(this).data('status');
    const selectedIds = [];

    $('.select-item:checked').each(function () {
        selectedIds.push($(this).val());
    });

    if (selectedIds.length === 0) {
        alert("Please select at least one subcategory.");
        return;
    }

    $.ajax({
        url: "{{ route('subcategory.bulk-status-updatesub') }}",
        method: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            ids: selectedIds,
            status: status
        },
        success: function (response) {
            alert(response.message);
            location.reload();
        },
        error: function () {
            alert("Something went wrong while updating status.");
        }
    });
});

});

</script>
<script>
    $(document).ready(function () {
        // Edit modal set data
        $('.edit-btn').on('click', function () {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const categoryId = $(this).data('category');
            const status = $(this).data('status');

            $('#edit-id').val(id);
            $('#edit-name').val(name);
            $('#edit-status').prop('checked', status == 1);

            const actionUrl = "{{ url('admin/subcategory') }}/" + id;
            $('#editSubCategoryForm').attr('action', actionUrl);
        });


        // Filters
        const $rows = $('table tbody tr');
        let selectedCategory = null;
        let selectedStatus = null;

        function filterTable() {
            $rows.show().filter(function () {
                const rowCategory = $(this).find('td.cat-name').text().trim();
                const rowStatus = $(this).find('td.sub-status span').text().trim();
                const matchCategory = selectedCategory ? rowCategory === selectedCategory : true;
                const matchStatus = selectedStatus !== null ? (selectedStatus == "1" ? rowStatus === "Active" : rowStatus === "Inactive") : true;
                return !(matchCategory && matchStatus);
            }).hide();
        }

        $('.filter-category a').on('click', function (e) {
            e.preventDefault();
            selectedCategory = $(this).data('category');
            filterTable();
        });

        $('.filter-status a').on('click', function (e) {
            e.preventDefault();
            selectedStatus = $(this).data('status');
            filterTable();
        });
    });
</script>
