@extends('layouts.admin.app')
@section('content')
 <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">7-Phase Milestone Planner</h4>
            </div>
        </div>
        <ul class="table-top-head">
            <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img
                        src="{{ asset('resource/admin/assets/img/icons/pdf.svg') }}" alt="img"></a>
            </li>
            <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><img
                        src="{{ asset('resource/admin/assets/img/icons/excel.svg') }}" alt="img"></a>
            </li>
            <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i class="ti ti-refresh"></i></a>
            </li>
            <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i
                        class="ti ti-chevron-up"></i></a>
            </li>
        </ul>
        <div class="page-btn">
            <a href="{{ route('admin.project.create') }}" class="btn btn-primary"><i class="ti ti-circle-plus me-1"></i>Add
                Project</a>
        </div>
    </div>
      <div class="row">

        <!-- Project ID -->
        <div class="col-md-6">
            <div class="mb-3">
                <label for="project_id" class="form-label">
                    Project ID <span class="text-danger">*</span>
                </label>
                <select id="project_id" class="form-control select2" required>
                    <option value="">Search & Select Project</option>
                    <option value="1">PRJ-001</option>
                    <option value="2">PRJ-002</option>
                    <option value="3">PRJ-003</option>
                </select>
            </div>
        </div>



        <!-- Project Name -->
        <div class="col-md-6">
            <div class="mb-3">
                <label for="project_name" class="form-label">
                    Project Name
                </label>
                <input type="text" id="project_name"
                       class="form-control" readonly>
            </div>
        </div>

    </div>
        <div class="container mt-4">

        <button class="btn btn-success mb-3" onclick="addTaskRow()">➕ Add Task</button>

        <table class="table table-bordered align-middle">
            <thead class="table-light">
            <tr>
                <th>Step Task ID</th>
                <th>Task Name</th>
                <th>Step Planned / Tentative End Date</th>
                <th>In-Charge Name</th>
                <th>Notes</th>
                <th>Assign to Stakeholder  ID</th>
                <th>Priority</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>

            <tbody id="taskTable"></tbody>
        </table>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">

    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

       <script>
    $(document).ready(function () {

        // Enable searchable dropdown
        $('.select2').select2({
            placeholder: "Search & Select Project",
            allowClear: true,
            width: '100%'
        });

        // Autofill Project Name
        $('#project_id').on('change', function () {
            let projectName = $(this).find(':selected').data('name') || '';
            $('#project_name').val(projectName);
        });

    });
</script>
<script>
$(function () {
    $('#project_id').select2({
        placeholder: 'Search & Select Project',
        width: '100%'
    });
});
</script>
<script>
let taskIndex = 0;

// Enable select2 for new elements
function initSelect2() {
    $('.select2').select2({ width: '100%' });
}

// Add new row
function addTaskRow() {
    taskIndex++;

    const row = `
    <tr id="row_${taskIndex}">
        <td>
            <select class="form-control select2">
                <option value="">Select</option>
                <option>STEP-001</option>
                <option>STEP-002</option>
                <option>STEP-003</option>
            </select>
        </td>

        <td><input type="text" class="form-control"></td>
       <td>
            <input type="text"
                class="form-control"
                name="step_date"
                id="step_date"
                placeholder="Start Date - End Date">
        </td>


        <td><input type="text" class="form-control"></td>

        <td>
            <textarea class="form-control" rows="1"></textarea>
        </td>

        <td><input type="text" class="form-control"></td>

        <td>
            <select class="form-control">
                <option>Low</option>
                <option>Medium</option>
                <option>High</option>
            </select>
        </td>

        <td>
            <select class="form-control">
                <option>Pending</option>
                <option>In-Progress</option>
                <option>Finished</option>
            </select>
        </td>

        <td>
            <button class="btn btn-primary btn-sm" onclick="saveRow(this)">Save</button>
            <button class="btn btn-warning btn-sm" onclick="editRow(this)">Edit</button>
            <button class="btn btn-danger btn-sm" onclick="deleteRow(this)">Delete</button>
        </td>
    </tr>`;

    document.getElementById('taskTable').insertAdjacentHTML('beforeend', row);
    initSelect2();
}

// Save row
function saveRow(btn) {
    const row = btn.closest('tr');
    row.querySelectorAll('input, select, textarea').forEach(el => el.disabled = true);
}

// Edit row
function editRow(btn) {
    const row = btn.closest('tr');
    row.querySelectorAll('input, select, textarea').forEach(el => el.disabled = false);
}

// Delete row
function deleteRow(btn) {
    btn.closest('tr').remove();
}

// Add first row on load
document.addEventListener('DOMContentLoaded', addTaskRow);
</script>
<script>
$(function () {
    $('#step_date').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear',
            format: 'YYYY-MM-DD'
        }
    });

    $('#step_date').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(
            picker.startDate.format('YYYY-MM-DD') +
            ' - ' +
            picker.endDate.format('YYYY-MM-DD')
        );
    });

    $('#step_date').on('cancel.daterangepicker', function () {
        $(this).val('');
    });
});
</script>

@endsection
