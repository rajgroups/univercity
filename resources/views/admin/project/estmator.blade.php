@extends('layouts.admin.app')

@section('content')
<div class="page-header">
    <div class="page-title">
        <h4 class="fw-bold">Cost Breakdown Estimator</h4>
    </div>
    <div class="page-btn">
        <a href="{{ route('admin.project.index') }}" class="btn btn-secondary">
            <i class="ti ti-arrow-left me-1"></i>Back to Projects
        </a>
    </div>
</div>

{{-- Custom Notification Toast --}}
<div id="notificationToast" class="toast align-items-center text-bg-success border-0 position-fixed"
     style="top: 20px; right: 20px; z-index: 9999;" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
        <div class="toast-body">
            <span id="toastMessage"></span>
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
</div>

<input type="hidden" id="project_id" value="{{ $project->id }}">
<input type="hidden" id="estimation_id" value="{{ $estimation->id }}">
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- ================= PROJECT DETAILS ================= --}}
<div class="card mt-3">
    <div class="card-header">
        <h5 class="mb-0">Project Details</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <label class="form-label">Project Code</label>
                <input type="text" class="form-control" value="{{ $project->project_code }}" readonly>
            </div>
            <div class="col-md-4">
                <label class="form-label">Project Name</label>
                <input type="text" class="form-control" value="{{ $project->title }}" readonly>
            </div>
            <div class="col-md-4">
                <label class="form-label">Cost Version</label>
                <select id="cost_version" class="form-control" disabled>
                    <option selected>{{ $estimation->version }}</option>
                </select>
            </div>
        </div>
    </div>
</div>

{{-- ================= SECTION 1: ESTIMATION TABLE ================= --}}
<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Cost Estimation Breakdown</h5>
        <button class="btn btn-success" onclick="addEstimationRow()">
            <i class="ti ti-plus me-1"></i>Add Item
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">S.No</th>
                        <th width="15%">Category</th>
                        <th width="20%">Name of Procurement/Item</th>
                        <th width="10%">Qty/Nos</th>
                        <th width="10%">Unit Cost (₹)</th>
                        <th width="10%">Total (₹)</th>
                        <th width="10%">Phase</th>
                        <th width="15%">Upload File</th>
                        <th width="5%">Status</th>
                        <th width="5%">Actions</th>
                    </tr>
                </thead>
                <tbody id="estimationTable">
                    @foreach($estimation->items as $index => $item)
                    <tr data-id="{{ $item->id }}">
                        <td class="row-index">{{ $index + 1 }}</td>
                        <td>
                            <select class="form-control form-control-sm category" onchange="markUnsaved(this)">
                                @foreach(['Hardware', 'Software & Content', 'Training', 'Logistics', 'Travel Allowance', 'Survey', 'Food & Beverage', 'Marketing & Advertisements', 'Salary-HR', 'Admin Cost', 'Miscellaneous'] as $cat)
                                <option {{ $item->category == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="text" class="form-control form-control-sm item" value="{{ $item->item_name }}" oninput="markUnsaved(this)"></td>
                        <td><input type="number" class="form-control form-control-sm qty" value="{{ $item->quantity }}" oninput="calculateRow(this); markUnsaved(this)"></td>
                        <td><input type="number" class="form-control form-control-sm unit" value="{{ $item->unit_cost }}" oninput="calculateRow(this); markUnsaved(this)"></td>
                        <td><input type="number" class="form-control form-control-sm total" value="{{ $item->total_cost }}" readonly></td>
                        <td>
                            <select class="form-control form-control-sm phase" onchange="markUnsaved(this)">
                                @foreach(['P1','P2','P3','P4','P5','P6','P7'] as $phase)
                                <option {{ $item->phase == $phase ? 'selected' : '' }}>{{ $phase }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="file" class="form-control form-control-sm file-input" onchange="markUnsaved(this)">
                            @if($item->file_path)
                            <small><a href="{{ asset($item->file_path) }}" target="_blank">View File</a></small>
                            @endif
                        </td>
                        <td class="text-center">
                            <span class="badge bg-success status-badge"><i class="ti ti-check"></i></span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-success" onclick="saveEstimationRow(this)">Save</button>
                            <button class="btn btn-sm btn-danger" onclick="deleteEstimationRow(this)">Del</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-secondary">
                    <tr>
                        <td colspan="5" class="text-end fw-bold">Total Project Estimation</td>
                        <td class="fw-bold" id="totalEstimation">₹ {{ number_format($estimation->total_amount, 2) }}</td>
                        <td colspan="3">P1-P7</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

{{-- ================= SECTION 2: CROWDFUNDING ================= --}}
<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Crowdfunding Status</h5>
        <div>
            <button class="btn btn-sm btn-info ms-3" onclick="toggleDonorList()">
                <i class="ti ti-eye me-1"></i>Toggle Donor List
            </button>
        </div>
    </div>
    <div class="card-body">
        <!-- Progress Bar & Summary -->
        <div class="row mb-4">
            <div class="col-md-8">
                <div class="progress" style="height: 30px;">
                    <div id="fundingProgress" class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                         role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                        0%
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-1">
                    <small>Raised: <span id="raisedAmount">₹ 0</span></small>
                    <small>Goal: <span id="goalAmount">₹ {{ number_format($estimation->total_amount, 2) }}</span></small>
                    <small><span id="fundingPercentage">0%</span> Funded</small>
                </div>
            </div>
            <div class="col-md-4 text-end">
                <h4 id="totalEstimatedCost">₹ {{ number_format($estimation->total_amount, 2) }}</h4>
                <small class="text-muted">Total Estimated Cost</small>
            </div>
        </div>

        <div id="donorSection" class="mt-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6>Donor List (Pledged)</h6>
                <button class="btn btn-sm btn-primary" onclick="addDonorRow()">
                    <i class="ti ti-user-plus me-1"></i>Add Donor
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Pledged Amt (₹)</th>
                            <th>Contribution %</th>
                            <th>Leader Board</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="donorTable">
                        @foreach($donors as $index => $donor)
                        <tr data-id="{{ $donor->id }}">
                            <td class="row-index">{{ $index + 1 }}</td>
                            <td><input type="text" class="form-control form-control-sm donor-name" value="{{ $donor->name }}" oninput="markUnsaved(this)"></td>
                            <td><input type="number" class="form-control form-control-sm donor-amount" value="{{ $donor->amount }}" oninput="updateDonorContribution(this); markUnsaved(this)"></td>
                            <td class="contribution-percent">0%</td>
                            <td><span class="badge bg-secondary">-</span></td>
                            <td class="text-center">
                                <span class="badge bg-success status-badge"><i class="ti ti-check"></i></span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" onclick="saveDonorRow(this)">Save</button>
                                <button class="btn btn-sm btn-outline-danger" onclick="deleteDonorRow(this)">Del</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Funds Received Tracker -->
        <div class="mt-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6>Funds Received History (Actual)</h6>
                <button class="btn btn-sm btn-success" onclick="addFundingRow()">
                    <i class="ti ti-cash me-1"></i>Add Received Fund
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped">
                    <thead class="table-info">
                        <tr>
                            <th>Date Received</th>
                            <th>Source / Donor Name</th>
                            <th>Amount Received (₹)</th>
                            <th>Notes</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="fundingTable">
                        @foreach($fundings as $funding)
                        <tr data-id="{{ $funding->id }}">
                            <td><input type="date" class="form-control form-control-sm funding-date" value="{{ $funding->received_date }}" oninput="markUnsaved(this)"></td>
                            <td><input type="text" class="form-control form-control-sm funding-source" value="{{ $funding->source_type }}" oninput="markUnsaved(this)"></td>
                            <td><input type="number" class="form-control form-control-sm funding-amount" value="{{ $funding->amount }}" oninput="updateFundingTotals(); markUnsaved(this)"></td>
                            <td><input type="text" class="form-control form-control-sm funding-notes" value="{{ $funding->notes }}" oninput="markUnsaved(this)"></td>
                            <td class="text-center">
                                <span class="badge bg-success status-badge"><i class="ti ti-check"></i></span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" onclick="saveFundingRow(this)">Save</button>
                                <button class="btn btn-sm btn-outline-danger" onclick="deleteFundingRow(this)">Del</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <td colspan="2" class="text-end fw-bold">Total Pledged: <span id="totalPledged" class="text-primary">₹ 0</span></td>
                            <td colspan="3" class="fw-bold">Total Received: <span id="totalReceived" class="text-success">₹ 0</span></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- ================= SECTION 3: UTILIZATION BREAKDOWN ================= --}}
<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Utilization Breakdown (Ongoing/Completed)</h5>
        <div>
            <button class="btn btn-sm btn-info" onclick="importFromEstimation()">
                <i class="ti ti-download me-1"></i>Import Fetch
            </button>
            <button class="btn btn-sm btn-success ms-2" onclick="addUtilizationRow()">
                <i class="ti ti-plus me-1"></i>Add Record
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Category</th>
                        <th>Procurement/Item</th>
                        <th>Estimated Total (₹)</th>
                        <th>Actual Spent (₹)</th>
                        <th>Phase</th>
                        <th>Invoice</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="utilizationTable">
                    @foreach($utilizations as $item)
                    <tr data-id="{{ $item->id }}">
                        <td>
                            <select class="form-control form-control-sm category" onchange="markUnsaved(this)">
                                @foreach(['Hardware', 'Software & Content', 'Training', 'Logistics', 'Travel Allowance', 'Survey', 'Food & Beverage', 'Marketing & Advertisements', 'Salary-HR', 'Admin Cost', 'Miscellaneous'] as $cat)
                                <option {{ $item->category == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="text" class="form-control form-control-sm item" value="{{ $item->item_name }}" oninput="markUnsaved(this)"></td>
                        <td><input type="number" class="form-control form-control-sm estimated" value="{{ $item->estimated_amount }}" oninput="markUnsaved(this)"></td>
                        <td><input type="number" class="form-control form-control-sm actual" value="{{ $item->actual_amount }}" oninput="updateUtilizationTotals(); markUnsaved(this)"></td>
                        <td>
                            <select class="form-control form-control-sm phase" onchange="markUnsaved(this)">
                                @foreach(['P1','P2','P3','P4','P5','P6','P7'] as $phase)
                                <option {{ $item->phase == $phase ? 'selected' : '' }}>{{ $phase }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="file" class="form-control form-control-sm file-input" onchange="markUnsaved(this)">
                            @if($item->file_path)
                            <small><a href="{{ asset($item->file_path) }}" target="_blank">View File</a></small>
                            @endif
                        </td>
                        <td class="text-center">
                            <span class="badge bg-success status-badge"><i class="ti ti-check"></i></span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary" onclick="saveUtilizationRow(this)">Save</button>
                            <button class="btn btn-sm btn-danger" onclick="deleteUtilizationRow(this)">Del</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-secondary">
                    <tr>
                        <td colspan="3" class="text-end fw-bold">Total Actual Amount Spent</td>
                        <td class="fw-bold text-success" id="totalActualSpent">₹ 0</td>
                        <td colspan="3"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const PROJECT_ID = document.getElementById('project_id').value;
const ESTIMATION_ID = document.getElementById('estimation_id').value;
const CATEGORIES = [
    'Hardware', 'Software & Content', 'Training', 'Logistics',
    'Travel Allowance', 'Survey', 'Food & Beverage',
    'Marketing & Advertisements', 'Salary-HR', 'Admin Cost',
    'Miscellaneous'
];

// Custom Notification Function
function showNotification(message, type = 'success') {
    const toastEl = document.getElementById('notificationToast');
    const toastMessage = document.getElementById('toastMessage');
    const toast = new bootstrap.Toast(toastEl);

    // Set message and type
    toastMessage.textContent = message;

    // Change background color based on type
    if (type === 'success') {
        toastEl.className = 'toast align-items-center text-bg-success border-0 position-fixed';
    } else if (type === 'error') {
        toastEl.className = 'toast align-items-center text-bg-danger border-0 position-fixed';
    } else if (type === 'warning') {
        toastEl.className = 'toast align-items-center text-bg-warning border-0 position-fixed';
    } else if (type === 'info') {
        toastEl.className = 'toast align-items-center text-bg-info border-0 position-fixed';
    }

    // Show toast
    toast.show();
}

$(document).ready(function () {
    updateTotals();
    updateFundingProgress();
    updateFundingTotals();
    updateUtilizationTotals();
});

// ================= HELPER FUNCTIONS FOR STATUS =================
function markUnsaved(input) {
    const row = $(input).closest('tr');
    const badge = row.find('.status-badge');
    badge.removeClass('bg-success').addClass('bg-warning').html('!');
}

function markSaved(row) {
    const badge = $(row).find('.status-badge');
    badge.removeClass('bg-warning').addClass('bg-success').html('<i class="ti ti-check"></i>');
}

// ================= ESTIMATION FUNCTIONS =================
function addEstimationRow() {
    const rowCount = $('#estimationTable tr').length + 1;
    const row = `
    <tr data-id="">
        <td class="row-index">${rowCount}</td>
        <td>
            <select class="form-control form-control-sm category" onchange="markUnsaved(this)">
                ${CATEGORIES.map(cat => `<option>${cat}</option>`).join('')}
            </select>
        </td>
        <td><input type="text" class="form-control form-control-sm item" placeholder="Item name" oninput="markUnsaved(this)"></td>
        <td><input type="number" class="form-control form-control-sm qty" oninput="calculateRow(this); markUnsaved(this)" min="0" step="0.01"></td>
        <td><input type="number" class="form-control form-control-sm unit" oninput="calculateRow(this); markUnsaved(this)" min="0" step="0.01"></td>
        <td><input type="number" class="form-control form-control-sm total" readonly></td>
        <td>
            <select class="form-control form-control-sm phase" onchange="markUnsaved(this)">
                <option>P1</option><option>P2</option><option>P3</option>
                <option>P4</option><option>P5</option><option>P6</option><option>P7</option>
            </select>
        </td>
        <td><input type="file" class="form-control form-control-sm file-input" onchange="markUnsaved(this)"></td>
        <td class="text-center">
            <span class="badge bg-warning status-badge">!</span>
        </td>
        <td>
            <button class="btn btn-sm btn-success" onclick="saveEstimationRow(this)">Save</button>
            <button class="btn btn-sm btn-danger" onclick="deleteEstimationRow(this)">Del</button>
        </td>
    </tr>`;
    $('#estimationTable').append(row);
}

function calculateRow(input) {
    const row = $(input).closest('tr');
    const qty = parseFloat(row.find('.qty').val()) || 0;
    const unit = parseFloat(row.find('.unit').val()) || 0;
    const total = qty * unit;
    row.find('.total').val(total.toFixed(2));
    updateTotals();
}

function updateTotals() {
    let total = 0;
    $('#estimationTable .total').each(function() {
        total += parseFloat($(this).val()) || 0;
    });
    $('#totalEstimation').text('₹ ' + total.toLocaleString('en-IN'));
    $('#totalEstimatedCost').text('₹ ' + total.toLocaleString('en-IN'));
    $('#goalAmount').text('₹ ' + total.toLocaleString('en-IN'));
    updateFundingProgress();
}

function saveEstimationRow(btn) {
    const row = $(btn).closest('tr');
    const formData = new FormData();
    formData.append('_token', CSRF_TOKEN);
    formData.append('estimation_id', ESTIMATION_ID);
    formData.append('id', row.data('id'));
    formData.append('category', row.find('.category').val());
    formData.append('item_name', row.find('.item').val());
    formData.append('quantity', row.find('.qty').val());
    formData.append('unit_cost', row.find('.unit').val());
    formData.append('phase', row.find('.phase').val());

    const fileInput = row.find('.file-input')[0];
    if (fileInput.files.length > 0) {
        formData.append('file', fileInput.files[0]);
    }

    $(btn).prop('disabled', true).text('Saving...');

    $.ajax({
        url: "{{ route('admin.project.estmator.item.store') }}",
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            if (response.success) {
                row.data('id', response.item.id);
                $(btn).prop('disabled', false).text('Save');
                showNotification('Item saved successfully', 'success');
                updateTotals();
                markSaved(row);
            }
        },
        error: function(err) {
            $(btn).prop('disabled', false).text('Save');
            showNotification('Error saving item', 'error');
            console.error(err);
        }
    });
}

function deleteEstimationRow(btn) {
    const row = $(btn).closest('tr');
    const id = row.data('id');

    if (!id) {
        row.remove();
        updateTotals();
        showNotification('Item removed', 'info');
        return;
    }

    if (!confirm('Are you sure?')) return;

    $.ajax({
        url: "{{ route('admin.project.estmator.item.delete', ':id') }}".replace(':id', id),
        type: 'DELETE',
        data: { _token: CSRF_TOKEN },
        success: function(response) {
            row.remove();
            updateTotals();
            showNotification('Item deleted successfully', 'success');
        },
        error: function() {
            showNotification('Error deleting item', 'error');
        }
    });
}

// ================= DONOR FUNCTIONS =================
function addDonorRow() {
    const rowCount = $('#donorTable tr').length + 1;
    const row = `
    <tr data-id="">
        <td class="row-index">${rowCount}</td>
        <td><input type="text" class="form-control form-control-sm donor-name" placeholder="Donor name" oninput="markUnsaved(this)"></td>
        <td><input type="number" class="form-control form-control-sm donor-amount" oninput="updateDonorContribution(this); markUnsaved(this)" min="0"></td>
        <td class="contribution-percent">0%</td>
        <td><span class="badge bg-secondary">-</span></td>
        <td class="text-center">
            <span class="badge bg-warning status-badge">!</span>
        </td>
        <td>
            <button class="btn btn-sm btn-outline-primary" onclick="saveDonorRow(this)">Save</button>
            <button class="btn btn-sm btn-outline-danger" onclick="deleteDonorRow(this)">Del</button>
        </td>
    </tr>`;
    $('#donorTable').append(row);
}

function updateDonorContribution(input) {
    const amount = parseFloat($(input).val()) || 0;
    const total = parseFloat($('#totalEstimation').text().replace(/[^0-9.]/g, '')) || 0;
    const percent = total > 0 ? ((amount / total) * 100).toFixed(1) : 0;
    $(input).closest('tr').find('.contribution-percent').text(percent + '%');
    updateFundingProgress();
}

function updateFundingProgress() {
    let raised = 0;
    $('#donorTable .donor-amount').each(function() {
        raised += parseFloat($(this).val()) || 0;
    });
    const total = parseFloat($('#totalEstimatedCost').text().replace(/[^0-9.]/g, '')) || 0;
    const percent = total > 0 ? ((raised / total) * 100).toFixed(1) : 0;

    $('#fundingProgress').css('width', Math.min(percent, 100) + '%').text(percent + '%');
    $('#raisedAmount').text('₹ ' + raised.toLocaleString('en-IN'));
    $('#fundingPercentage').text(percent + '%');

    $('#totalPledged').text('₹ ' + raised.toLocaleString('en-IN'));
    updateDonorLeaderboard();
}

function updateDonorLeaderboard() {
    const donors = [];
    $('#donorTable tr').each(function() {
        const amount = parseFloat($(this).find('.donor-amount').val()) || 0;
        if (amount > 0) {
            donors.push({ row: $(this), amount: amount });
        }
    });

    donors.sort((a, b) => b.amount - a.amount);

    $('#donorTable tr').each(function() {
        $(this).find('td:eq(4) .badge').removeClass('bg-warning').addClass('bg-secondary').text('-');
    });

    donors.forEach((donor, index) => {
        const rank = index + 1;
        const badge = donor.row.find('td:eq(4) .badge');
        if (index < 3) {
            badge.removeClass('bg-secondary').addClass('bg-warning').text(rank);
        } else {
             badge.text(rank);
        }
    });
}

function saveDonorRow(btn) {
    const row = $(btn).closest('tr');
    const data = {
        _token: CSRF_TOKEN,
        id: row.data('id'),
        project_id: PROJECT_ID,
        name: row.find('.donor-name').val(),
        amount: row.find('.donor-amount').val()
    };

    $(btn).prop('disabled', true);

    $.ajax({
        url: "{{ route('admin.project.estmator.donor.store') }}",
        type: 'POST',
        data: data,
        success: function(response) {
            row.data('id', response.donor.id);
            $(btn).prop('disabled', false);
            showNotification('Donor saved successfully', 'success');
            markSaved(row);
        },
        error: function(err) {
            $(btn).prop('disabled', false);
            showNotification('Error saving donor', 'error');
        }
    });
}

function deleteDonorRow(btn) {
    const row = $(btn).closest('tr');
    const id = row.data('id');

    if (!id) {
        row.remove();
        updateFundingProgress();
        showNotification('Donor removed', 'info');
        return;
    }

    if (!confirm('Are you sure?')) return;

    $.ajax({
        url: "{{ route('admin.project.estmator.donor.delete', ':id') }}".replace(':id', id),
        type: 'DELETE',
        data: { _token: CSRF_TOKEN },
        success: function(response) {
            row.remove();
            updateFundingProgress();
            showNotification('Donor deleted successfully', 'success');
        },
        error: function() {
            showNotification('Error deleting donor', 'error');
        }
    });
}

function toggleDonorList() {
    $('#donorSection').toggle();
    showNotification('Donor list toggled', 'info');
}

// ================= FUNDING RECEIVED FUNCTIONS =================
function addFundingRow() {
    const row = `
    <tr data-id="">
        <td><input type="date" class="form-control form-control-sm funding-date" oninput="markUnsaved(this)"></td>
        <td><input type="text" class="form-control form-control-sm funding-source" placeholder="Donor/Source" oninput="markUnsaved(this)"></td>
        <td><input type="number" class="form-control form-control-sm funding-amount" oninput="updateFundingTotals(); markUnsaved(this)" min="0"></td>
        <td><input type="text" class="form-control form-control-sm funding-notes" placeholder="Notes" oninput="markUnsaved(this)"></td>
        <td class="text-center">
            <span class="badge bg-warning status-badge">!</span>
        </td>
        <td>
            <button class="btn btn-sm btn-outline-primary" onclick="saveFundingRow(this)">Save</button>
            <button class="btn btn-sm btn-outline-danger" onclick="deleteFundingRow(this)">Del</button>
        </td>
    </tr>`;
    $('#fundingTable').append(row);
}

function updateFundingTotals() {
    let totalReceived = 0;
    $('#fundingTable .funding-amount').each(function() {
        totalReceived += parseFloat($(this).val()) || 0;
    });
    $('#totalReceived').text('₹ ' + totalReceived.toLocaleString('en-IN'));
}

function saveFundingRow(btn) {
    const row = $(btn).closest('tr');
    const data = {
        _token: CSRF_TOKEN,
        id: row.data('id'),
        project_id: PROJECT_ID,
        received_date: row.find('.funding-date').val(),
        source_type: row.find('.funding-source').val(),
        amount: row.find('.funding-amount').val(),
        notes: row.find('.funding-notes').val()
    };

    $(btn).prop('disabled', true);

    $.ajax({
        url: "{{ route('admin.project.estmator.funding.store') }}",
        type: 'POST',
        data: data,
        success: function(response) {
            row.data('id', response.funding.id);
            $(btn).prop('disabled', false);
            showNotification('Funding Record saved successfully', 'success');
            updateFundingTotals();
            markSaved(row);
        },
        error: function(err) {
            $(btn).prop('disabled', false);
            showNotification('Error saving funding record', 'error');
        }
    });
}

function deleteFundingRow(btn) {
    const row = $(btn).closest('tr');
    const id = row.data('id');

    if (!id) {
        row.remove();
        updateFundingTotals();
        showNotification('Funding record removed', 'info');
        return;
    }

    if (!confirm('Are you sure?')) return;

    $.ajax({
        url: "{{ route('admin.project.estmator.funding.delete', ':id') }}".replace(':id', id),
        type: 'DELETE',
        data: { _token: CSRF_TOKEN },
        success: function(response) {
            row.remove();
            updateFundingTotals();
            showNotification('Funding Record deleted successfully', 'success');
        },
        error: function() {
            showNotification('Error deleting funding record', 'error');
        }
    });
}

// ================= UTILIZATION FUNCTIONS =================
function addUtilizationRow() {
    appendUtilizationRow(null);
    showNotification('New utilization row added', 'info');
}

function updateUtilizationTotals() {
    let total = 0;
    $('#utilizationTable .actual').each(function() {
        total += parseFloat($(this).val()) || 0;
    });
    $('#totalActualSpent').text('₹ ' + total.toLocaleString('en-IN'));
}

function saveUtilizationRow(btn) {
    const row = $(btn).closest('tr');
    const formData = new FormData();
    formData.append('_token', CSRF_TOKEN);
    formData.append('project_id', PROJECT_ID);
    formData.append('id', row.data('id'));
    formData.append('category', row.find('.category').val());
    formData.append('item_name', row.find('.item').val());
    formData.append('estimated_amount', row.find('.estimated').val());
    formData.append('actual_amount', row.find('.actual').val());
    formData.append('phase', row.find('.phase').val());

    const fileInput = row.find('.file-input')[0];
    if (fileInput.files.length > 0) {
        formData.append('file', fileInput.files[0]);
    }

    $(btn).prop('disabled', true).text('Saving...');

    $.ajax({
        url: "{{ route('admin.project.estmator.utilization.store') }}",
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            row.data('id', response.utilization.id);
            $(btn).prop('disabled', false).text('Save');
            showNotification('Utilization saved successfully', 'success');
            updateUtilizationTotals();
            markSaved(row);
        },
        error: function(err) {
            $(btn).prop('disabled', false).text('Save');
            showNotification('Error saving utilization', 'error');
        }
    });
}

function deleteUtilizationRow(btn) {
    const row = $(btn).closest('tr');
    const id = row.data('id');

    if (!id) {
        row.remove();
        updateUtilizationTotals();
        showNotification('Utilization record removed', 'info');
        return;
    }

    if (!confirm('Are you sure?')) return;

    $.ajax({
        url: "{{ route('admin.project.estmator.utilization.delete', ':id') }}".replace(':id', id),
        type: 'DELETE',
        data: { _token: CSRF_TOKEN },
        success: function(response) {
            row.remove();
            updateUtilizationTotals();
            showNotification('Utilization record deleted successfully', 'success');
        },
        error: function() {
            showNotification('Error deleting utilization record', 'error');
        }
    });
}

function importFromEstimation() {
    if (!confirm('This will import all items from the Cost Estimation table. Continue?')) return;

    const btn = $('button[onclick="importFromEstimation()"]');
    const originalText = btn.html();
    btn.prop('disabled', true).text('Importing...');

    $.ajax({
        url: "{{ route('admin.project.estmator.import') }}",
        type: 'POST',
        data: {
            _token: CSRF_TOKEN,
            project_id: PROJECT_ID,
            estimation_id: ESTIMATION_ID
        },
        success: function(response) {
            btn.prop('disabled', false).html(originalText);
            if (response.success) {
                showNotification(response.message, 'success');

                // Dynamically append new items
                if (response.items && response.items.length > 0) {
                    response.items.forEach(item => {
                        appendUtilizationRow(item);
                    });
                    updateUtilizationTotals();
                }
            } else {
                showNotification(response.message, 'error');
            }
        },
        error: function(err) {
            btn.prop('disabled', false).html(originalText);
            showNotification('Error importing items', 'error');
        }
    });
}

function appendUtilizationRow(data = null) {
    const categoriesOptions = CATEGORIES.map(cat =>
        `<option ${data && data.category === cat ? 'selected' : ''}>${cat}</option>`
    ).join('');

    const phaseOptions = ['P1','P2','P3','P4','P5','P6','P7'].map(phase =>
        `<option ${data && data.phase === phase ? 'selected' : ''}>${phase}</option>`
    ).join('');

    const badgeClass = data ? 'bg-success' : 'bg-warning';
    const badgeContent = data ? '<i class="ti ti-check"></i>' : '!';

    const row = `
    <tr data-id="${data ? data.id : ''}">
        <td>
            <select class="form-control form-control-sm category" onchange="markUnsaved(this)">
                ${categoriesOptions}
            </select>
        </td>
        <td><input type="text" class="form-control form-control-sm item" value="${data ? data.item_name : ''}" placeholder="Item" oninput="markUnsaved(this)"></td>
        <td><input type="number" class="form-control form-control-sm estimated" value="${data ? data.estimated_amount : 0}" oninput="markUnsaved(this)"></td>
        <td><input type="number" class="form-control form-control-sm actual" value="${data ? data.actual_amount : ''}" min="0" oninput="updateUtilizationTotals(); markUnsaved(this)"></td>
        <td>
            <select class="form-control form-control-sm phase" onchange="markUnsaved(this)">
                ${phaseOptions}
            </select>
        </td>
        <td>
            <input type="file" class="form-control form-control-sm file-input" onchange="markUnsaved(this)">
            ${data && data.file_path ? `<small><a href="{{ asset('') }}${data.file_path}" target="_blank">View File</a></small>` : ''}
        </td>
        <td class="text-center">
            <span class="badge ${badgeClass} status-badge">${badgeContent}</span>
        </td>
        <td>
            <button class="btn btn-sm btn-primary" onclick="saveUtilizationRow(this)">Save</button>
            <button class="btn btn-sm btn-danger" onclick="deleteUtilizationRow(this)">Del</button>
        </td>
    </tr>`;
    $('#utilizationTable').append(row);
}

</script>
@endpush
