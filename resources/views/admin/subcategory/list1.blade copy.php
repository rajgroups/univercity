@extends('layouts.admin.app')
@section('content')

<!-- content @s -->
<div class="page-header">
	<div class="add-item d-flex">
		<div class="page-title">
			<h4 class="fw-bold">Sub Category</h4>
			<h6>Manage your sub categories</h6>
		</div>
	</div>
	<ul class="table-top-head">
		<li>
			<a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf">
				<img src="{{ asset('resource/admin/assets/img/icons/pdf.svg')}}" alt="img">
				</a>
        </li>
        <li>
            <a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel">
                <img src="{{ asset('resource/admin/assets/img/icons/excel.svg')}}" alt="img">
                </a>
        </li>
        <li>
            <a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh">
                <i class="ti ti-refresh"></i>
            </a>
        </li>
        <li>
            <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header">
                <i class="ti ti-chevron-up"></i>
            </a>
        </li>
	</ul>
    <div class="page-btn">
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-category">
            <i class="ti ti-circle-plus me-1"></i>Add Sub Category
        </a>
    </div>
</div>
<!-- /product list -->
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
        <div class="search-set">
            <div class="search-input">
                <span class="btn-searchset">
                    <i class="ti ti-search fs-14 feather-search"></i>
                </span>
            </div>
        </div>
        {{-- 

        <div class="search-set">
        <div class="search-input d-flex">
            <span class="btn-searchset">
                <i class="ti ti-search fs-14 feather-search"></i>
            </span>
            <input type="text" class="form-control" placeholder="Search category...">
            </div>
        </div>
        --}}

        <div class="d-flex table-dropdown my-xl-auto right-content align-items-center flex-wrap row-gap-3">
            <!-- Category Filter -->
            <div class="dropdown me-2">
                <a href="javascript:void(0);" class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown">Category</a>
                <ul class="dropdown-menu dropdown-menu-end p-3 filter-category">
                    @foreach($categories as $categoryItem)

                    <li>
                        <a href="#" class="dropdown-item rounded-1" data-category="{{ $categoryItem->name }}">
                        {{ $categoryItem->name }}
                        </a>
                    </li>
                    @endforeach

                </ul>
            </div>
            <!-- Status Filter -->
            <div class="dropdown">
                <a href="javascript:void(0);" class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown">
                Status
                </a>
                <ul class="dropdown-menu dropdown-menu-end p-3 filter-status">
                    <li>
                        <a href="#" class="dropdown-item rounded-1" data-status="1">Active</a>
                    </li>
                    <li>
                        <a href="#" class="dropdown-item rounded-1" data-status="0">Inactive</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="card-body p-0">
<div class="table-responsive">
<table class="table datatable">
    <thead class="thead-light">
        <tr>
            <th class="no-sort">
                <label class="checkboxs">
                    <input type="checkbox" id="select-all">
                        <span class="checkmarks"></span>
                    </label>
                </th>
                <th>Sub Category</th>
                <th>Category</th>
                <th>Description</th>
                <th>Status</th>
                <th class="no-sort"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <label class="checkboxs">
                        <input type="checkbox">
                            <span class="checkmarks"></span>
                        </label>
                    </td>
                    <td>Laptop</td>
                    <td>Computers</td>
                    <td>Efficient Productivity</td>
                    <td>
                        <span class="badge bg-success fw-medium fs-10">Active</span>
                    </td>
                    <td class="action-table-data">
                        <div class="edit-delete-action">
                            <a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-category">
                                <i data-feather="edit" class="feather-edit"></i>
                            </a>
                            <a data-bs-toggle="modal" data-bs-target="#delete-modal" class="p-2" href="javascript:void(0);">
                                <i data-feather="trash-2" class="feather-trash-2"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- /Main Wrapper -->
<!-- Add Sub Category Modal -->
<div class="modal fade" id="add-category">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="page-title">
                    <h4>Add Sub Category</h4>
                </div>
                <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('subcategory.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Category <span class="text-danger ms-1">*</span></label>
                        <select class="form-select" name="category_id" required>
                            <option value="">Select</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sub Category <span class="text-danger ms-1">*</span></label>
                        <input type="text" name="sub_category_name" class="form-control" required>
                    </div>
                    <div class="mb-0">
                        <div class="status-toggle modal-status d-flex justify-content-between align-items-center">
                            <span class="status-label">Status</span>
                            <input type="checkbox" id="status" name="status" class="check" checked>
                            <label for="status" class="checktoggle"></label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-2 btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Sub Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

        <!-- Edit Sub Category Modal -->
<div class="modal fade" id="edit-category">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="page-title">
                    <h4>Edit Sub Category</h4>
                </div>
                <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

           <!-- Edit Sub Category Modal -->

            <!-- Form Start -->
            <form method="POST" action="{{ route('subcategory.update', $subcategories[0]->id) }}">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <!-- Category Select -->
                    <div class="mb-3">
                        <label class="form-label">Category <span class="text-danger ms-1">*</span></label>
                        <select name="category_id" class="form-select" required>
                            <option value="">Select</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $subcategory->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Subcategory Name -->
                    <div class="mb-3">
                        <label class="form-label">Sub Category <span class="text-danger ms-1">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ $subcategory->name }}" required>
                    </div>

                    <!-- Status -->
                    <div class="mb-0">
                        <div class="status-toggle modal-status d-flex justify-content-between align-items-center">
                            <span class="status-label">Status</span>
                            <input type="checkbox" name="status" id="edit-status" class="check" {{ $subcategory->status ? 'checked' : '' }}>
                            <label for="edit-status" class="checktoggle"></label>
                        </div>
                    </div>
                </div>

                <!-- Footer Buttons -->
                <div class="modal-footer">
                    <button type="button" class="btn me-2 btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
            <!-- Form End -->
        </div>
    </div>
</div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section('scripts')

<script>
   $(document).ready(function () {
       // Cache reference to the table rows
       const $rows = $('table tbody tr');
   
       function filterTable(category, status) {
           $rows.show().filter(function () {
               const rowCategory = $(this).find('td:nth-child(2)').text().trim();
               const rowStatus = $(this).find('td:nth-child(5) .badge').text().trim();
   
               const categoryMatch = category ? rowCategory === category : true;
               const statusMatch = status !== null
                   ? (status === "1" ? rowStatus === "Active" : rowStatus === "Inactive")
                   : true;
   
               return !(categoryMatch && statusMatch);
           }).hide();
       }
   
       let selectedCategory = null;
       let selectedStatus = null;
   
       $('.filter-category a').on('click', function (e) {
           e.preventDefault();
           selectedCategory = $(this).data('category');
           filterTable(selectedCategory, selectedStatus);
       });
   
       $('.filter-status a').on('click', function (e) {
           e.preventDefault();
           selectedStatus = $(this).data('status');
           filterTable(selectedCategory, selectedStatus);
       });
   });
</script>
@endsection