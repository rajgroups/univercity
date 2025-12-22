@extends('layouts.admin.app')

@section('content')

<div class="page-header">
    <div class="page-title">
        <h4 class="fw-bold">Estmator</h4>
    </div>

    <div class="page-btn">
        <a href="{{ route('admin.project.create') }}" class="btn btn-primary">
            <i class="ti ti-circle-plus me-1"></i>Add Project
        </a>
    </div>
</div>

{{-- ================= PROJECT DETAILS ================= --}}
<div class="row mt-3">

    <div class="col-md-4">
        <label class="form-label">Project ID <span class="text-danger">*</span></label>
        <select id="project_id" class="form-control select2" required>
            <option value="">Search & Select Project</option>
            <option value="1" data-name="Hospital Project">PRJ-001</option>
            <option value="2" data-name="Mall Project">PRJ-002</option>
            <option value="3" data-name="IT Park Project">PRJ-003</option>
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label">Project Name</label>
        <input type="text" id="project_name" class="form-control" readonly>
    </div>

    <div class="col-md-4">
        <label class="form-label">Cost Version</label>
        <select class="form-control">
            <option value="">Select</option>
            <option>V1</option>
            <option>Revised</option>
            <option>Final</option>
        </select>
    </div>

</div>

{{-- ================= PROCUREMENT TABLE ================= --}}
<div class="container-fluid mt-4">

    <button class="btn btn-success mb-3" onclick="addRow()">➕ Add Item</button>

    <table class="table table-bordered align-middle">
        <thead class="table-light">
        <tr>
            <th>Category</th>
            <th>Procurement / Item</th>
            <th>Qty / Nos</th>
            <th>Unit Cost</th>
            <th>Total</th>
            <th>Phase</th>
            <th>Upload (PI / Vendor / Quotation)</th>
            <th>Actions</th>
        </tr>
        </thead>

        <tbody id="costTable"></tbody>
    </table>

</div>

@endsection

{{-- ================= SCRIPTS ================= --}}
@push('scripts')


    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">

    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
let rowIndex = 0;

$(document).ready(function () {
    $('.select2').select2({ width: '100%' });

    $('#project_id').on('change', function () {
        $('#project_name').val($(this).find(':selected').data('name') || '');
    });

    addRow(); // first row auto
});

function addRow() {
    rowIndex++;

    const row = `
    <tr id="row_${rowIndex}">
        <td>
            <select class="form-control">
                <option>Material</option>
                <option>Service</option>
                <option>Equipment</option>
            </select>
        </td>

        <td>
            <input type="text" class="form-control" placeholder="Item name">
        </td>

        <td>
            <input type="number" class="form-control qty" oninput="calcTotal(this)">
        </td>

        <td>
            <input type="number" class="form-control unit" oninput="calcTotal(this)">
        </td>

        <td>
            <input type="number" class="form-control total" readonly>
        </td>

        <td>
            <select class="form-control">
                <option>P1</option><option>P2</option><option>P3</option>
                <option>P4</option><option>P5</option><option>P6</option><option>P7</option>
            </select>
        </td>

        <td>
            <input type="file" class="form-control">
        </td>

        <td>
            <button class="btn btn-primary btn-sm" onclick="saveRow(this)">Save</button>
            <button class="btn btn-warning btn-sm" onclick="editRow(this)">Edit</button>
            <button class="btn btn-danger btn-sm" onclick="deleteRow(this)">Delete</button>
        </td>
    </tr>`;

    $('#costTable').append(row);
}

function calcTotal(el) {
    const row = el.closest('tr');
    const qty = row.querySelector('.qty').value || 0;
    const unit = row.querySelector('.unit').value || 0;
    row.querySelector('.total').value = qty * unit;
}

function saveRow(btn) {
    btn.closest('tr').querySelectorAll('input,select').forEach(e => e.disabled = true);
}

function editRow(btn) {
    btn.closest('tr').querySelectorAll('input,select').forEach(e => e.disabled = false);
}

function deleteRow(btn) {
    btn.closest('tr').remove();
}
</script>

@endpush
