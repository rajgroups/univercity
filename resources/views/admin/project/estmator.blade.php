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

<style>
    .bg-primary-light { background-color: rgba(13, 110, 253, 0.1); }
    .bg-success-light { background-color: rgba(25, 135, 84, 0.1); }
    .bg-info-light { background-color: rgba(13, 202, 240, 0.1); }
    .bg-warning-light { background-color: rgba(255, 193, 7, 0.1); }
    .bg-danger-light { background-color: rgba(220, 53, 69, 0.1); }
    .x-small { font-size: 0.75rem; }
    .accordion-button:not(.collapsed) {
        background-color: rgba(13, 110, 253, 0.05);
        color: #0d6efd;
    }
    .accordion-button:focus { border-color: rgba(13, 110, 253, 0.25); box-shadow: none; }
    .table-hover tbody tr:hover { background-color: rgba(0,0,0,0.02); }
    .fw-bold { font-weight: 700 !important; }
    .status-badge { width: 24px; height: 24px; line-height: 24px; padding: 0; border-radius: 50%; display: inline-block; }
</style>

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

{{-- ================= PROJECT DETAILS & STAGE CONTROL ================= --}}
<div class="card mt-3">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-md-3">
                <label class="form-label mb-0 small text-muted">Project ID</label>
                <div class="fw-bold">{{ $project->project_code }}</div>
            </div>
            <div class="col-md-4">
                <label class="form-label mb-0 small text-muted">Project Name</label>
                <div class="fw-bold text-truncate">{{ $project->title }}</div>
            </div>
            <div class="col-md-2 text-center">
                <label class="form-label mb-0 small text-muted">Current Stage</label>
                <div>
                    <span class="badge {{ $project->stage == 'Ongoing' ? 'bg-success' : 'bg-info' }}" id="stageBadge">
                        {{ $project->stage ?? 'Upcoming' }}
                    </span>
                </div>
            </div>
            <div class="col-md-3 text-end">
                @if($project->stage != 'Ongoing')
                <button class="btn btn-primary" onclick="moveToOngoing()">
                    <i class="ti ti-player-play me-1"></i>Move to Ongoing
                </button>
                @else
                <button class="btn btn-outline-secondary" disabled>
                    <i class="ti ti-check me-1"></i>Project is Ongoing
                </button>
                @endif
            </div>
        </div>
        <div class="mt-2">
            <small class="text-warning d-none" id="stageWarning">
                <i class="ti ti-alert-triangle me-1"></i> Ensure sufficient funds before starting the project
            </small>
        </div>
    </div>
</div>

{{-- ================= 1. BUDGET OVERVIEW ================= --}}
<div class="row mt-4 g-3">
    <div class="col-md-4">
        <div class="card bg-primary-light border-0">
            <div class="card-body">
                <h6 class="text-primary mb-2">Total Estimated Cost</h6>
                <h3 class="mb-0" id="overviewTotalCost">₹ {{ number_format($estimation->total_amount, 0) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success-light border-0">
            <div class="card-body">
                <h6 class="text-success mb-2">Total Funds Available</h6>
                @php
                    $csrFunds = $fundings->sum('amount');
                    $crowdFunds = $project->amount_raised;
                    $totalAvailable = $csrFunds + $crowdFunds;
                @endphp
                <h3 class="mb-0" id="overviewTotalAvailable">₹ {{ number_format($totalAvailable, 0) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-info-light border-0">
            <div class="card-body">
                <h6 class="text-info mb-2">Funding Status</h6>
                @php
                    $statusText = 'Not Funded';
                    $statusClass = 'text-danger';
                    if($estimation->total_amount > 0) {
                        $percent = ($totalAvailable / $estimation->total_amount) * 100;
                        if($percent >= 100) { $statusText = 'Fully Funded'; $statusClass = 'text-success'; }
                        elseif($percent > 0) { $statusText = 'Partially Funded'; $statusClass = 'text-warning'; }
                    }
                @endphp
                <h3 class="mb-0 {{ $statusClass }}" id="overviewFundingStatus">{{ $statusText }}</h3>
            </div>
        </div>
    </div>
</div>

{{-- ================= 2. COST BREAKDOWN (Phase-wise Accordion) ================= --}}
<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center bg-white">
        <h5 class="mb-0"><i class="ti ti-list-check me-2"></i>Cost Estimation Breakdown</h5>
        <div class="d-flex align-items-center">
            <span class="text-muted small me-3">All amounts must be whole numbers (₹)</span>
            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#addItemModal">
                <i class="ti ti-plus me-1"></i>Add Item
            </button>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="accordion accordion-flush" id="estimationAccordion">
            @foreach(['P1','P2','P3','P4','P5','P6','P7'] as $phase)
            @php
                $phaseItems = $estimation->items->where('phase', $phase);
                $phaseTotal = $phaseItems->sum('total_cost');
            @endphp
            <div class="accordion-item border-bottom">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed py-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $phase }}">
                        <div class="d-flex justify-content-between w-100 pe-3">
                            <span><strong>{{ $phase }}</strong> - Phase Details</span>
                            <span class="text-primary fw-bold">₹ {{ number_format($phaseTotal, 0) }}</span>
                        </div>
                    </button>
                </h2>
                <div id="collapse{{ $phase }}" class="accordion-collapse collapse" data-bs-parent="#estimationAccordion">
                    <div class="accordion-body p-0">
                        <table class="table table-hover table-sm mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-3">Category</th>
                                    <th>Procurement/Item</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-end">Unit Cost</th>
                                    <th class="text-end">Total</th>
                                    <th class="text-center">Doc</th>
                                    <th class="text-end pe-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="phaseTable{{ $phase }}">
                                @foreach($phaseItems as $item)
                                <tr data-id="{{ $item->id }}">
                                    <td class="ps-3 small">{{ $item->category }}</td>
                                    <td class="small">{{ $item->item_name }}</td>
                                    <td class="text-center">{{ number_format($item->quantity, 0) }}</td>
                                    <td class="text-end small">₹{{ number_format($item->unit_cost, 0) }}</td>
                                    <td class="text-end fw-bold small">₹{{ number_format($item->total_cost, 0) }}</td>
                                    <td class="text-center">
                                        @if($item->file_path)
                                        <a href="{{ asset($item->file_path) }}" target="_blank" class="text-primary"><i class="ti ti-file-text"></i></a>
                                        @else
                                        <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-end pe-3">
                                        <div class="btn-group">
                                            <button class="btn btn-link py-0" onclick="editEstimationItem({{ $item->id }}, '{{ addslashes($item->item_name) }}', {{ $item->quantity }}, {{ $item->unit_cost }}, '{{ $item->category }}', '{{ $item->phase }}')"><i class="ti ti-edit text-info"></i></button>
                                            <button class="btn btn-link py-0" onclick="deleteEstimationRow(this)"><i class="ti ti-trash text-danger"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="card-footer bg-light">
        <div class="d-flex justify-content-between align-items-center">
            <span class="fw-bold">GRAND TOTAL ESTIMATED COST</span>
            <span class="h4 mb-0 text-primary fw-bold" id="grandTotalDisplay">₹ {{ number_format($estimation->total_amount, 0) }}</span>
        </div>
    </div>
</div>

{{-- ================= 3. CSR FUNDING & INSTITUTIONAL SUPPORT ================= --}}
<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">CSR Funding & Institutional Support</h5>
        <button class="btn btn-sm btn-primary" onclick="addFundingRow()">
            <i class="ti ti-plus me-1"></i>Add Partner Record
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm table-bordered">
                <thead class="table-info">
                    <tr>
                        <th>Organization Name</th>
                        <th>Committed Amt (₹)</th>
                        <th>Total Received (₹)</th>
                        <th>Balance (₹)</th>
                        <th>Status</th>
                        <th>Latest Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="fundingTable">
                    @foreach($fundings as $funding)
                    <tr data-id="{{ $funding->id }}">
                        <td><input type="text" class="form-control form-control-sm funding-source" value="{{ $funding->source_type }}" oninput="markUnsaved(this)"></td>
                        <td><input type="number" class="form-control form-control-sm funding-sanction" value="{{ $funding->sanction_amount }}" oninput="calculateFundingBalance(this); markUnsaved(this)"></td>
                        <td><input type="number" class="form-control form-control-sm funding-amount" value="{{ $funding->amount }}" oninput="calculateFundingBalance(this); updateFundingTotals(); markUnsaved(this)"></td>
                        <td class="funding-balance fw-bold">₹ {{ number_format($funding->sanction_amount - $funding->amount, 0) }}</td>
                        <td>
                            @php
                                $status = 'Committed';
                                if($funding->amount >= $funding->sanction_amount && $funding->sanction_amount > 0) $status = 'Received';
                                elseif($funding->amount > 0) $status = 'Partially Received';
                            @endphp
                            <select class="form-select form-select-sm funding-status-select" disabled>
                                <option {{ $status == 'Committed' ? 'selected' : '' }}>Committed</option>
                                <option {{ $status == 'Partially Received' ? 'selected' : '' }}>Partially Received</option>
                                <option {{ $status == 'Received' ? 'selected' : '' }}>Received</option>
                            </select>
                        </td>
                        <td><input type="date" class="form-control form-control-sm funding-date" value="{{ $funding->received_date }}" oninput="markUnsaved(this)"></td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-success" onclick="saveFundingRow(this)">Save</button>
                                <button class="btn btn-sm btn-danger" onclick="deleteFundingRow(this)">Del</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-2 small text-muted">
            <i class="ti ti-info-circle me-1"></i> Supports multiple payments per CSR partner. Status updates automatically.
        </div>
    </div>
</div>

{{-- ================= 4. CROWDFUNDING SECTION (Optional) ================= --}}
<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Crowdfunding Activation</h5>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="crowdfundingToggle" 
                   {{ $project->crowdfunding_active ? 'checked' : '' }} onchange="toggleCrowdfunding(this)">
            <label class="form-check-label" for="crowdfundingToggle">Enable Crowdfunding Section</label>
        </div>
    </div>
    <div id="crowdfundingContainer" class="card-body {{ $project->crowdfunding_active ? '' : 'd-none' }}">
        <div class="row align-items-center mb-4">
            <div class="col-md-6">
                <label class="form-label text-muted small">Fundraising Target (₹)</label>
                <div class="input-group">
                    <span class="input-group-text">₹</span>
                    <input type="number" class="form-control" id="fundraisingTarget" value="{{ $project->funding_target ?: $estimation->total_amount }}" onchange="updateCrowdTarget(this)">
                </div>
            </div>
            <div class="col-md-6">
                @php
                    $crowdPercent = $project->funding_target > 0 ? ($project->amount_raised / $project->funding_target) * 100 : 0;
                @endphp
                <label class="form-label text-muted small">Progress: <span id="crowdProgressVal">{{ number_format($crowdPercent, 1) }}%</span> (₹{{ number_format($project->amount_raised, 0) }} Raised)</label>
                <div class="progress" style="height: 12px;">
                    <div id="crowdProgressBar" class="progress-bar bg-info" style="width: {{ $crowdPercent }}%"></div>
                </div>
            </div>
        </div>

        <h6>Donor Contributions Table</h6>
        <div class="table-responsive">
            <table class="table table-sm table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Donor Name</th>
                        <th>Amount (₹)</th>
                        <th>Status</th>
                        <th>Date Received</th>
                        <th>Contrib %</th>
                        <th>Rank</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="donorTable">
                    @foreach($donors as $donor)
                    @php
                        $contrib = $project->funding_target > 0 ? ($donor->amount / $project->funding_target) * 100 : 0;
                    @endphp
                    <tr data-id="{{ $donor->id }}">
                        <td><input type="text" class="form-control form-control-sm donor-name" value="{{ $donor->name }}" oninput="markUnsaved(this)"></td>
                        <td><input type="number" class="form-control form-control-sm donor-amount" value="{{ $donor->amount }}" oninput="markUnsaved(this)"></td>
                        <td>
                            <select class="form-select form-select-sm donor-status">
                                <option value="Committed" {{ $donor->payment_status == 'Committed' ? 'selected' : '' }}>Committed</option>
                                <option value="Partially Received" {{ $donor->payment_status == 'Partially Received' ? 'selected' : '' }}>Partially Received</option>
                                <option value="Received" {{ $donor->payment_status == 'Received' ? 'selected' : '' }}>Received</option>
                            </select>
                        </td>
                        <td><input type="date" class="form-control form-control-sm donor-date" value="{{ $donor->received_date }}" oninput="markUnsaved(this)"></td>
                        <td class="small">{{ number_format($contrib, 1) }}%</td>
                        <td class="text-center"><span class="badge bg-secondary">-</span></td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-primary" onclick="saveDonorRow(this)">Save</button>
                                <button class="btn btn-sm btn-danger" onclick="deleteDonorRow(this)">Del</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <button class="btn btn-link btn-sm p-0" onclick="addDonorRow()"><i class="ti ti-plus me-1"></i>Add New Donor</button>
    </div>
</div>

{{-- ================= 5. PROJECT FINANCIAL SUMMARY (AUDIT) ================= --}}
<div class="card mt-4 border-primary">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Project Financial Summary</h5>
    </div>
    <div class="card-body">
        <div class="row g-4">
            <div class="col-md-3">
                <div class="p-3 bg-light rounded text-center">
                    <div class="text-muted small mb-1">Total Estimated Cost</div>
                    <h5 class="fw-bold mb-0" id="summaryTotalCost">₹ {{ number_format($estimation->total_amount, 0) }}</h5>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-3 bg-light rounded text-center">
                    <div class="text-muted small mb-1">CSR Funds Received</div>
                    <h5 class="fw-bold mb-0 text-success" id="summaryCSR">₹ {{ number_format($csrFunds, 0) }}</h5>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-3 bg-light rounded text-center">
                    <div class="text-muted small mb-1">Crowdfunding Raised</div>
                    <h5 class="fw-bold mb-0 text-info" id="summaryCrowd">₹ {{ number_format($crowdFunds, 0) }}</h5>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-3 bg-primary-light rounded text-center">
                    <div class="text-primary small mb-1 fw-bold">Total Available Funds</div>
                    <h5 class="fw-bold mb-0" id="summaryAvailable">₹ {{ number_format($totalAvailable, 0) }}</h5>
                </div>
            </div>
        </div>
        <div class="mt-4 p-3 bg-warning-light rounded border border-warning border-opacity-25 row align-items-center">
             <div class="col-md-6">
                 <h6 class="mb-0"><i class="ti ti-report-money me-2"></i>Financial Utilization</h6>
                 <div class="small text-muted">Formula: Total Available = CSR + Crowd</div>
             </div>
             <div class="col-md-6 text-end">
                 @php
                     $totalSpent = $utilizations->sum('actual_amount');
                     $balance = $totalAvailable - $totalSpent;
                 @endphp
                 <div class="h5 fw-bold mb-0">Balance Available: <span class="{{ $balance < 0 ? 'text-danger' : 'text-success' }}" id="summaryBalance">₹ {{ number_format($balance, 0) }}</span></div>
                 <div class="small text-muted">Total Spent: ₹ {{ number_format($totalSpent, 0) }}</div>
             </div>
        </div>
    </div>
</div>

{{-- ================= 6. UTILIZATION (Ongoing Stage Only) ================= --}}
<div class="card mt-4 {{ $project->stage == 'Ongoing' ? '' : 'd-none' }}" id="utilizationSection">
    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Financial Utilization Details (Ongoing)</h5>
        <div>
            <button class="btn btn-sm btn-outline-light me-2" onclick="importFromEstimation()">
                <i class="ti ti-download me-1"></i>Import Estimates
            </button>
            <button class="btn btn-sm btn-success" onclick="addUtilizationRow()">
                <i class="ti ti-plus me-1"></i>Add Expense Record
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Actual Spending Details</th>
                        <th>Phase</th>
                        <th>Budgeted (₹)</th>
                        <th>Source</th>
                        <th>Status</th>
                        <th>Actual Spent (₹)</th>
                        <th width="15%">Upload Quote/Invoice</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="utilizationTable">
                    @foreach($utilizations as $item)
                    <tr data-id="{{ $item->id }}">
                        <td>
                            <input type="text" class="form-control form-control-sm item-name mb-2" value="{{ $item->item_name }}" placeholder="Expense Description" oninput="markUnsaved(this)">
                            <select class="form-select form-select-sm category" onchange="markUnsaved(this)">
                                @foreach(['Hardware', 'Software & Content', 'Training', 'Logistics', 'Travel Allowance', 'Survey', 'Food & Beverage', 'Marketing & Advertisements', 'Salary-HR', 'Admin Cost', 'Miscellaneous'] as $cat)
                                <option value="{{ $cat }}" {{ $item->category == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm phase" onchange="markUnsaved(this)">
                                @foreach(['P1','P2','P3','P4','P5','P6','P7'] as $phase)
                                <option value="{{ $phase }}" {{ $item->phase == $phase ? 'selected' : '' }}>{{ $phase }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="number" class="form-control form-control-sm estimated-amount" value="{{ floor($item->estimated_amount) }}" min="0" step="1" oninput="markUnsaved(this)"></td>
                        <td>
                            <select class="form-select form-select-sm funding-source-select" onchange="markUnsaved(this)">
                                <option value="CSR" {{ $item->funding_source == 'CSR' ? 'selected' : '' }}>CSR</option>
                                <option value="Crowdfunding" {{ $item->funding_source == 'Crowdfunding' ? 'selected' : '' }}>Crowdfunding</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm utilization-status" onchange="markUnsaved(this)">
                                @foreach(['Pending', 'Approved', 'Paid'] as $status)
                                <option value="{{ $status }}" {{ ($item->status ?? 'Pending') == $status ? 'selected' : '' }}>{{ $status }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="number" class="form-control form-control-sm actual-amount" value="{{ floor($item->actual_amount) }}" min="0" step="1" oninput="markUnsaved(this)"></td>
                        <td>
                            <input type="file" class="form-control form-control-sm file-input" onchange="markUnsaved(this)">
                            @if($item->file_path)
                            <a href="{{ asset($item->file_path) }}" target="_blank" class="small"><i class="ti ti-link"></i> View Invoice</a>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-primary" onclick="saveUtilizationRow(this)">Save</button>
                                <button class="btn btn-sm btn-danger" onclick="deleteUtilizationRecord(this)">Del</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-2 text-danger small d-none" id="fundLimitError">
            <i class="ti ti-info-circle me-1"></i> Insufficient Funds in selected source!
        </div>
    </div>
</div>

<!-- Add Item Modal -->
<div class="modal fade" id="addItemModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="itemForm" onsubmit="event.preventDefault(); submitItemForm();">
                <div class="modal-header">
                    <h5 class="modal-title">Add/Edit Estimation Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_item_id">
                    <div class="mb-3">
                        <label class="form-label">Procurement/Item Name</label>
                        <input type="text" name="item_name" id="edit_item_name" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label">Category</label>
                            <select name="category" id="edit_category" class="form-select">
                                @foreach(['Hardware', 'Software & Content', 'Training', 'Logistics', 'Travel Allowance', 'Survey', 'Food & Beverage', 'Marketing & Advertisements', 'Salary-HR', 'Admin Cost', 'Miscellaneous'] as $cat)
                                <option>{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Phase</label>
                            <select name="phase" id="edit_phase" class="form-select">
                                <option>P1</option><option>P2</option><option>P3</option>
                                <option>P4</option><option>P5</option><option>P6</option><option>P7</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label">Qty (Whole Number)</label>
                            <input type="number" name="quantity" id="edit_qty" class="form-control" required min="1" step="1">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Unit Cost (₹)</label>
                            <input type="number" name="unit_cost" id="edit_unit" class="form-control" required min="1" step="1">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Upload Quote / Invoice</label>
                        <input type="file" name="file" id="edit_file" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveItemBtn">Save Item</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const PROJECT_ID = "{{ $project->id }}";
const ESTIMATION_ID = "{{ $estimation->id }}";

// Custom Notification
function showNotification(message, type = 'success') {
    const toastEl = document.getElementById('notificationToast');
    const toastMessage = document.getElementById('toastMessage');
    const toast = new bootstrap.Toast(toastEl);
    toastMessage.textContent = message;
    toastEl.className = `toast align-items-center text-bg-${type === 'error' ? 'danger' : type} border-0 position-fixed`;
    toast.show();
}

$(document).ready(function () {
    updateFinancialSummary();
});

// ================= STAGE CONTROL =================
function moveToOngoing() {
    const available = parseFloat($('#summaryAvailable').text().replace(/[^0-9.]/g, '')) || 0;
    const estimated = parseFloat($('#summaryTotalCost').text().replace(/[^0-9.]/g, '')) || 0;

    if (available < estimated) {
        if (!confirm('Warning: Available funds are less than estimated cost. Proceed to move to Ongoing stage?')) return;
    } else {
        if (!confirm('Move project to Ongoing stage? This will enable utilization tracking.')) return;
    }

    $.post("{{ route('admin.project.estmator.stage.update') }}", {
        _token: CSRF_TOKEN,
        project_id: PROJECT_ID,
        stage: 'Ongoing'
    }, function(res) {
        if (res.success) {
            showNotification(res.message);
            location.reload();
        }
    });
}

// ================= CROWDFUNDING TOGGLE =================
function toggleCrowdfunding(el) {
    const active = el.checked ? 1 : 0;
    $.post("{{ route('admin.project.estmator.crowdfunding.toggle') }}", {
        _token: CSRF_TOKEN,
        project_id: PROJECT_ID,
        active: active
    }, function(res) {
        if (res.success) {
            $('#crowdfundingContainer').toggleClass('d-none', !el.checked);
            showNotification('Crowdfunding section ' + (active ? 'enabled' : 'disabled'));
        }
    });
}

function updateCrowdTarget(el) {
    const val = $(el).val();
    // Simplified: save target to project table
    $.post("{{ route('admin.project.estmator.crowdfunding.toggle') }}", { // Reusing stage or creating target route? 
        _token: CSRF_TOKEN,
        project_id: PROJECT_ID,
        active: $('#crowdfundingToggle').is(':checked') ? 1 : 0, 
        target: val // Controller needs to handle target if passed
    }, function(res) {
        updateFinancialSummary();
    });
}

// ================= ESTIMATION FUNCTIONS =================
function submitItemForm() {
    const btn = $('#saveItemBtn');
    const formData = new FormData($('#itemForm')[0]);
    formData.append('_token', CSRF_TOKEN);
    formData.append('estimation_id', ESTIMATION_ID);

    btn.prop('disabled', true).text('Saving...');

    $.ajax({
        url: "{{ route('admin.project.estmator.item.store') }}",
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(res) {
            if (res.success) {
                showNotification(res.message);
                location.reload(); // Simplest way to update accordion structure
            }
        },
        error: function(err) {
            btn.prop('disabled', false).text('Save Item');
            const msg = err.responseJSON ? err.responseJSON.message : 'Error saving item';
            showNotification(msg, 'error');
        }
    });
}

function editEstimationItem(id, name, qty, unit, cat, phase) {
    $('#edit_item_id').val(id);
    $('#edit_item_name').val(name);
    $('#edit_qty').val(qty);
    $('#edit_unit').val(unit);
    $('#edit_category').val(cat);
    $('#edit_phase').val(phase);
    $('#addItemModal').modal('show');
}

function deleteEstimationRow(btn) {
    const row = $(btn).closest('tr');
    const id = row.data('id');
    if (!id) { row.remove(); return; }

    if (!confirm('Delete this estimation item?')) return;

    $.ajax({
        url: "{{ route('admin.project.estmator.item.delete', ':id') }}".replace(':id', id),
        type: 'DELETE',
        data: { _token: CSRF_TOKEN },
        success: function() {
            showNotification('Item deleted');
            location.reload();
        }
    });
}

// ================= CSR FUNDING FUNCTIONS =================
function addFundingRow() {
    const row = `
    <tr data-id="">
        <td><input type="text" class="form-control form-control-sm funding-source" placeholder="Partner Name" oninput="markUnsaved(this)"></td>
        <td><input type="number" class="form-control form-control-sm funding-sanction" value="0" oninput="calculateFundingBalance(this); markUnsaved(this)"></td>
        <td><input type="number" class="form-control form-control-sm funding-amount" value="0" oninput="calculateFundingBalance(this); updateFundingTotals(); markUnsaved(this)"></td>
        <td class="funding-balance fw-bold">₹ 0</td>
        <td>
            <select class="form-select form-select-sm funding-status-select" disabled>
                <option selected>Committed</option>
                <option>Partially Received</option>
                <option>Received</option>
            </select>
        </td>
        <td><input type="date" class="form-control form-control-sm funding-date" oninput="markUnsaved(this)"></td>
        <td>
            <div class="btn-group">
                <button class="btn btn-sm btn-success" onclick="saveFundingRow(this)">Save</button>
                <button class="btn btn-sm btn-danger" onclick="deleteFundingRow(this)">Del</button>
            </div>
        </td>
    </tr>`;
    $('#fundingTable').append(row);
}

function calculateFundingBalance(el) {
    const row = $(el).closest('tr');
    const sanction = parseFloat(row.find('.funding-sanction').val()) || 0;
    const received = parseFloat(row.find('.funding-amount').val()) || 0;
    const balance = sanction - received;
    
    row.find('.funding-balance').text('₹ ' + balance.toLocaleString());
    
    const statusSelect = row.find('.funding-status-select');
    if (received >= sanction && sanction > 0) statusSelect.val('Received');
    else if (received > 0) statusSelect.val('Partially Received');
    else statusSelect.val('Committed');
}

function updateFundingTotals() {
    let total = 0;
    $('#fundingTable .funding-amount').each(function() {
        total += parseFloat($(this).val()) || 0;
    });
    $('#summaryCSR').text('₹ ' + total.toLocaleString());
    updateFinancialSummary();
}

function saveFundingRow(btn) {
    const row = $(btn).closest('tr');
    const data = {
        _token: CSRF_TOKEN,
        id: row.data('id'),
        project_id: PROJECT_ID,
        source_type: row.find('.funding-source').val(),
        sanction_amount: row.find('.funding-sanction').val(),
        amount: row.find('.funding-amount').val(),
        received_date: row.find('.funding-date').val(),
    };

    $(btn).prop('disabled', true).text('...');

    $.post("{{ route('admin.project.estmator.funding.store') }}", data, function(res) {
        if (res.success) {
            row.data('id', res.funding.id);
            $(btn).prop('disabled', false).text('Save');
            showNotification('Partner record saved');
            markSaved(row);
            updateFundingTotals();
        }
    }).fail(function() {
        $(btn).prop('disabled', false).text('Save');
        showNotification('Error saving record', 'error');
    });
}

function deleteFundingRow(btn) {
    const row = $(btn).closest('tr');
    const id = row.data('id');
    if (!id) { row.remove(); updateFundingTotals(); return; }
    if (!confirm('Delete this partner record?')) return;
    $.ajax({
        url: "{{ route('admin.project.estmator.funding.delete', ':id') }}".replace(':id', id),
        type: 'DELETE',
        data: { _token: CSRF_TOKEN },
        success: function() { row.remove(); updateFundingTotals(); showNotification('Record deleted'); }
    });
}

// ================= DONOR FUNCTIONS =================
function addDonorRow() {
    const row = `
    <tr data-id="">
        <td><input type="text" class="form-control form-control-sm donor-name" placeholder="Donor Name" oninput="markUnsaved(this)"></td>
        <td><input type="number" class="form-control form-control-sm donor-amount" value="0" oninput="markUnsaved(this)"></td>
        <td>
            <select class="form-select form-select-sm donor-status">
                <option value="Committed">Committed</option>
                <option value="Partially Received">Partially Received</option>
                <option value="Received">Received</option>
            </select>
        </td>
        <td><input type="date" class="form-control form-control-sm donor-date" oninput="markUnsaved(this)"></td>
        <td class="small">-</td>
        <td class="text-center"><span class="badge bg-secondary">-</span></td>
        <td>
            <div class="btn-group">
                <button class="btn btn-sm btn-primary" onclick="saveDonorRow(this)">Save</button>
                <button class="btn btn-sm btn-danger" onclick="deleteDonorRow(this)">Del</button>
            </div>
        </td>
    </tr>`;
    $('#donorTable').append(row);
}

function saveDonorRow(btn) {
    const row = $(btn).closest('tr');
    const data = {
        _token: CSRF_TOKEN,
        id: row.data('id'),
        project_id: PROJECT_ID,
        name: row.find('.donor-name').val(),
        amount: row.find('.donor-amount').val(),
        payment_status: row.find('.donor-status').val(),
        received_date: row.find('.donor-date').val(),
    };

    $(btn).prop('disabled', true).text('...');
    $.post("{{ route('admin.project.estmator.donor.store') }}", data, function(res) {
        if (res.success) {
            row.data('id', res.donor.id);
            $(btn).prop('disabled', false).text('Save');
            showNotification('Donor record saved');
            markSaved(row);
            updateCrowdSummary();
        }
    }).fail(function(err) {
        $(btn).prop('disabled', false).text('Save');
        showNotification(err.responseJSON ? err.responseJSON.message : 'Error', 'error');
    });
}

function deleteDonorRow(btn) {
    const row = $(btn).closest('tr');
    const id = row.data('id');
    if (!id) { row.remove(); return; }
    if (!confirm('Delete this donor?')) return;
    $.ajax({
        url: "{{ route('admin.project.estmator.donor.delete', ':id') }}".replace(':id', id),
        type: 'DELETE',
        data: { _token: CSRF_TOKEN },
        success: function() { row.remove(); updateCrowdSummary(); showNotification('Donor deleted'); }
    });
}

function updateCrowdSummary() {
    let raised = 0;
    $('#donorTable tr').each(function() {
        const amt = parseFloat($(this).find('.donor-amount').val()) || 0;
        const status = $(this).find('.donor-status').val();
        if (status === 'Received' || status === 'Partially Received') raised += amt;
    });
    
    // Update labels and progress
    const target = parseFloat($('#fundraisingTarget').val()) || 1; // avoid div by 0
    const percent = (raised / target) * 100;
    
    $('#summaryCrowd').text('₹ ' + raised.toLocaleString());
    $('#crowdProgressVal').text(percent.toFixed(1) + '%');
    $('#crowdProgressBar').css('width', Math.min(percent, 100) + '%');
    
    updateFinancialSummary();
}

// ================= UTILIZATION FUNCTIONS =================
function addUtilizationRow() {
    const row = `
    <tr data-id="">
        <td>
            <input type="text" class="form-control form-control-sm item-name" placeholder="Expense Description" oninput="markUnsaved(this)">
            <select class="form-select form-select-sm mt-1 category" onchange="markUnsaved(this)">
                @foreach(['Hardware', 'Software & Content', 'Training', 'Logistics', 'Travel Allowance', 'Survey', 'Food & Beverage', 'Marketing & Advertisements', 'Salary-HR', 'Admin Cost', 'Miscellaneous'] as $cat)
                <option>{{ $cat }}</option>
                @endforeach
            </select>
        </td>
        <td>
            <select class="form-select form-select-sm phase" onchange="markUnsaved(this)">
                <option>P1</option><option>P2</option><option>P3</option><option>P4</option><option>P5</option><option>P6</option><option>P7</option>
            </select>
        </td>
        <td><input type="number" class="form-control form-control-sm estimated-amount" value="0" min="0" step="1" oninput="markUnsaved(this)"></td>
        <td>
            <select class="form-select form-select-sm funding-source-select" onchange="markUnsaved(this)">
                <option value="CSR">CSR</option>
                <option value="Crowdfunding">Crowdfunding</option>
            </select>
        </td>
        <td>
            <select class="form-select form-select-sm utilization-status" onchange="markUnsaved(this)">
                <option value="Pending">Pending</option>
                <option value="Approved">Approved</option>
                <option value="Paid">Paid</option>
            </select>
        </td>
        <td><input type="number" class="form-control form-control-sm actual-amount" value="0" min="0" step="1" oninput="markUnsaved(this)"></td>
        <td><input type="file" class="form-control form-control-sm file-input" onchange="markUnsaved(this)"></td>
        <td>
            <div class="btn-group">
                <button class="btn btn-sm btn-primary" onclick="saveUtilizationRow(this)">Save</button>
                <button class="btn btn-sm btn-danger" onclick="deleteUtilizationRecord(this)">Del</button>
            </div>
        </td>
    </tr>`;
    $('#utilizationTable').append(row);
}

function saveUtilizationRow(btn) {
    const row = $(btn).closest('tr');
    const formData = new FormData();
    formData.append('_token', CSRF_TOKEN);
    formData.append('project_id', PROJECT_ID);
    formData.append('id', row.data('id'));
    formData.append('item_name', row.find('.item-name').val());
    formData.append('category', row.find('.category').val());
    formData.append('estimated_amount', row.find('.estimated-amount').val());
    formData.append('actual_amount', row.find('.actual-amount').val());
    formData.append('phase', row.find('.phase').val());
    formData.append('funding_source', row.find('.funding-source-select').val());
    formData.append('status', row.find('.utilization-status').val());

    const fileInput = row.find('.file-input')[0];
    if (fileInput.files.length > 0) formData.append('file', fileInput.files[0]);

    $(btn).prop('disabled', true).text('...');
    $.ajax({
        url: "{{ route('admin.project.estmator.utilization.store') }}",
        type: 'POST', data: formData, contentType: false, processData: false,
        success: function(res) {
            row.data('id', res.utilization.id);
            $(btn).prop('disabled', false).text('Save');
            showNotification('Expense record saved');
            markSaved(row);
            updateUtilizationTotals();
        },
        error: function(err) {
            $(btn).prop('disabled', false).text('Save');
            showNotification(err.responseJSON ? err.responseJSON.message : 'Error', 'error');
        }
    });
}

function deleteUtilizationRecord(btn) {
    const row = $(btn).closest('tr');
    const id = row.data('id');
    if (!id) { row.remove(); updateUtilizationTotals(); return; }
    if (!confirm('Delete this record?')) return;
    $.ajax({
        url: "{{ route('admin.project.estmator.utilization.delete', ':id') }}".replace(':id', id),
        type: 'DELETE',
        data: { _token: CSRF_TOKEN },
        success: function() { row.remove(); updateUtilizationTotals(); showNotification('Record deleted'); }
    });
}

function updateUtilizationTotals() {
    let total = 0;
    $('#utilizationTable .actual-amount').each(function() {
        total += parseFloat($(this).val()) || 0;
    });
    updateFinancialSummary();
}

// ================= GLOBAL SUMMARY =================
function updateFinancialSummary() {
    const csr = parseFloat($('#summaryCSR').text().replace(/[^0-9.]/g, '')) || 0;
    const crowd = parseFloat($('#summaryCrowd').text().replace(/[^0-9.]/g, '')) || 0;
    const est = parseFloat($('#overviewTotalCost').text().replace(/[^0-9.]/g, '')) || 0;
    
    const available = csr + crowd;
    $('#summaryAvailable, #overviewTotalAvailable').text('₹ ' + available.toLocaleString());
    
    let spent = 0;
    $('#utilizationTable tr').each(function() {
        const val = parseFloat($(this).find('.actual-amount').val());
        if (!isNaN(val)) spent += val;
    });
    
    const balance = available - spent;
    $('#summaryBalance').text('₹ ' + balance.toLocaleString());
    $('#summaryBalance').toggleClass('text-danger', balance < 0).toggleClass('text-success', balance >= 0);
    
    // Progress status in header
    const statusEl = $('#overviewFundingStatus');
    if (est > 0) {
        const p = (available / est) * 100;
        if (p >= 100) statusEl.text('Fully Funded').removeClass('text-warning text-danger').addClass('text-success');
        else if (p > 0) statusEl.text('Partially Funded').removeClass('text-success text-danger').addClass('text-warning');
        else statusEl.text('Not Funded').removeClass('text-success text-warning').addClass('text-danger');
    }
}

// ================= HELPERS =================
function markUnsaved(input) {
    $(input).closest('tr').find('.status-badge').removeClass('bg-success').addClass('bg-warning').html('!');
}
function markSaved(row) {
    $(row).find('.status-badge').removeClass('bg-warning').addClass('bg-success').html('<i class="ti ti-check"></i>');
}
function importFromEstimation() {
    if (!confirm('Import items from Estimation?')) return;
    $.post("{{ route('admin.project.estmator.import') }}", {
        _token: CSRF_TOKEN, project_id: PROJECT_ID, estimation_id: ESTIMATION_ID
    }, function(res) {
        if (res.success) { showNotification(res.message); location.reload(); }
    });
}
</script>
@endpush
