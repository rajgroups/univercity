@extends('layouts.admin.app')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center flex-wrap">
    <div class="add-item d-flex align-items-start flex-column">
        <div class="page-title">
            <h4 class="fw-bold mb-1">Category</h4>
            <h6 class="text-muted">Manage your categories</h6>
        </div>
    </div>

    {{-- <ul class="table-top-head list-unstyled d-flex align-items-center gap-3 mb-0">
        <li>
            <a href="#" id="btn-export-pdf" data-bs-toggle="tooltip" data-bs-placement="top" title="PDF">
                <img src="{{ asset('resource/admin/assets/img/icons/pdf.svg') }}" alt="pdf icon">
            </a>
        </li>
        <li>
            <a href="#" id="btn-export-excel" data-bs-toggle="tooltip" data-bs-placement="top" title="Excel">
                <img src="{{ asset('resource/admin/assets/img/icons/excel.svg') }}" alt="excel icon">
            </a>
        </li>
        <li>
            <a href="javascript:void(0);" id="btn-refresh" data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh">
                <i class="ti ti-refresh"></i>
            </a>
        </li>
        <li>
            <a href="javascript:void(0);" id="collapse-header" data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse">
                <i class="ti ti-chevron-up"></i>
            </a>
        </li>
    </ul> --}}


    <div class="page-btn">
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-category">
            <i class="ti ti-circle-plus me-1"></i>Add Category
        </a>
    </div>
</div>

<div class="card">
    <!-- Filter & Search -->
    <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
        <div class="search-set">
            <div class="search-input d-flex">
                <span class="btn-searchset"><i class="ti ti-search fs-14 feather-search"></i></span>
                {{-- <input type="text" class="form-control" placeholder="Search category..."> --}}
            </div>
        </div>
        <div class="d-flex table-dropdown my-xl-auto right-content align-items-center flex-wrap row-gap-3">
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
    {{-- <button id="change-status-btn" class="btn btn-sm btn-warning mb-3">Change Status</button> --}}

    <!-- Table Section -->
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table datatable">
                <thead class="thead-light">
                    <tr>
                        <th><input type="checkbox" id="select-all"></th>
                        <th>Category</th>
                        <th>Slug</th>
                        <th>Created On</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td><input type="checkbox" class="select-item" value="{{ $category->id }}"></td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ \Carbon\Carbon::parse($category->created_at)->format('d M Y') }}</td>
                        <td>
                            @if($category->status)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="edit-delete-action d-flex">
                                <a href="#" class="me-2 p-2" data-bs-toggle="modal" data-bs-target="#edit-category-{{ $category->id }}">
                                    <i data-feather="edit"></i>
                                </a>
                                <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-link text-danger p-2 border-0">
                                        <i data-feather="trash-2"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="edit-category-{{ $category->id }}">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form method="POST" action="{{ route('category.update', $category->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5>Edit Category</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label>Category Name</label>
                                            <input type="text" name="name" class="form-control edit-name" value="{{ $category->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Slug</label>
                                            <input type="text" name="slug" class="form-control edit-slug" value="{{ $category->slug }}" required>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="status" value="1" {{ $category->status ? 'checked' : '' }}>
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
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="add-category">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('category.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Category Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control" required readonly>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="status" value="1" id="status" checked>
                        <label class="form-check-label" for="status">Active</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add Category</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#name').on('keyup', function() {
            var name = $(this).val();
            var slug = name.toLowerCase()
                           .replace(/[^a-z0-9\s-]/g, '')  // special characters remove
                           .replace(/\s+/g, '-')          // space to hyphen
                           .replace(/-+/g, '-')           // multiple - to single -
                           .trim();
            $('#slug').val(slug);
        });    });
</script>

<script>
    // Select All
    $('#select-all').on('change', function () {
        $('.select-item').prop('checked', this.checked);
    });

    // Handle dropdown status update
    $('.change-status').on('click', function (e) {
        e.preventDefault();

        const status = $(this).data('status');
        const selectedIds = [];

        $('.select-item:checked').each(function () {
            selectedIds.push($(this).val());
        });

        if (selectedIds.length === 0) {
            alert("Please select at least one category.");
            return;
        }

        $.ajax({
            url: "{{ route('category.bulk-status-update') }}",
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
</script>



@endsection

@section('scripts')
<script>
    document.getElementById('name')?.addEventListener('input', function () {
        const slug = this.value.toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/(^-|-$)+/g, '');
        document.getElementById('slug').value = slug;
    });

    document.querySelectorAll('.edit-name').forEach(function (input) {
        input.addEventListener('input', function () {
            const modal = input.closest('.modal-body');
            const slugInput = modal.querySelector('.edit-slug');
            const slug = input.value.toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/(^-|-$)+/g, '');
            slugInput.value = slug;
        });
    });

    window.addEventListener('load', () => {
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    });
    // pdf
        $(document).ready(function() {
        var table = $('#categories-table').DataTable({
            dom: 'Bfrtip',  // enable buttons
            buttons: [
                'pdfHtml5',
                'excelHtml5',
            ],
        });

        // Bind export icons
        $('#btn-export-pdf').on('click', function(e){
            e.preventDefault();
            table.button('.buttons-pdf').trigger();
        });

        $('#btn-export-excel').on('click', function(e){
            e.preventDefault();
            table.button('.buttons-excel').trigger();
        });

        // Refresh reload page
        $('#btn-refresh').on('click', function(e){
            e.preventDefault();
            location.reload();
        });

        // Collapse toggle
        $('#collapse-header').on('click', function(){
            $('.card-body').slideToggle();
            // Optionally toggle the icon:
            $(this).find('i').toggleClass('ti-chevron-up ti-chevron-down');
        });
    });

</script>
@endsection
