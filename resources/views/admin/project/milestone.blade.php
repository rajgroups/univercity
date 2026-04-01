{{-- @dd($project); --}}
@extends('layouts.admin.app')
@section('content')
<div class="page-header">
    <div class="add-item d-flex">
        <div class="page-title">
            <h4 class="fw-bold">7-Phase Milestone Planner</h4>
            <h6 class="text-muted">Project: {{ $project->title }}</h6>
        </div>
    </div>
    <ul class="table-top-head">
        <li>
            <a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf" onclick="exportTasks('pdf')">
                <img src="{{ asset('resource/admin/assets/img/icons/pdf.svg') }}" alt="img">
            </a>
        </li>
        <li>
            <a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel" onclick="exportTasks('excel')">
                <img src="{{ asset('resource/admin/assets/img/icons/excel.svg') }}" alt="img">
            </a>
        </li>
        <li>
            <a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh" onclick="refreshPage()">
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
        <a href="{{ route('admin.project.index', $project->id) }}" class="btn btn-outline-secondary me-2">
            <i class="ti ti-arrow-left me-1"></i>Back to Project
        </a>
        <button class="btn btn-primary" onclick="loadExistingMilestones()">
            <i class="ti ti-database me-1"></i>Load Existing Milestones
        </button>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title mb-0">Project Information</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- Project ID -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="project_id" class="form-label">
                        Project ID <span class="text-danger">*</span>
                    </label>
                    <input type="text" id="project_id" class="form-control"
                           value="{{ $project->project_code }}" readonly>
                    <input type="hidden" id="project_id_hidden" value="{{ $project->id }}">
                </div>
            </div>

            <!-- Project Name -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="project_name" class="form-label">Project Name</label>
                    <input type="text" id="project_name" class="form-control"
                           value="{{ $project->title }}" readonly>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Milestone Tasks</h5>
        <div>
            <button class="btn btn-success me-2" onclick="addTaskCard()">
                <i class="ti ti-circle-plus me-1"></i>Add New Task
            </button>
            <button class="btn btn-info" onclick="saveAllTasks()">
                <i class="ti ti-device-floppy me-1"></i>Save All Tasks
            </button>
        </div>
    </div>
    <div class="card-body">
        <div id="taskCardsContainer">
            <!-- Task cards will be dynamically added here -->
            @if($milestones->count() > 0)
                @foreach($milestones as $milestone)
                    <div class="card task-card mb-4" data-task-id="{{ $milestone->id }}" data-db-id="{{ $milestone->id }}">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0">
                                    <span class="task-number">Task #{{ $loop->iteration }}</span>
                                    <span class="task-phase-badge badge bg-primary ms-2">{{ $milestone->phase }}</span>
                                    <small class="text-muted ms-2">ID: {{ $milestone->id }}</small>
                                </h6>
                            </div>
                            <div class="card-actions">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-primary" onclick="saveTask(this)">
                                        <i class="ti ti-check me-1"></i>Save
                                    </button>
                                    <button type="button" class="btn btn-sm btn-warning" onclick="editTask(this)">
                                        <i class="ti ti-edit me-1"></i>Edit
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="deleteTask(this)">
                                        <i class="ti ti-trash me-1"></i>Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Phase Selection -->
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label small fw-semibold">
                                            Phase <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control select2-dynamic phase-select" required>
                                            <option value="">Select Phase</option>
                                            <option value="P1" {{ $milestone->phase == 'P1' ? 'selected' : '' }}>P1 - Initiation</option>
                                            <option value="P2" {{ $milestone->phase == 'P2' ? 'selected' : '' }}>P2 - Planning</option>
                                            <option value="P3" {{ $milestone->phase == 'P3' ? 'selected' : '' }}>P3 - Design</option>
                                            <option value="P4" {{ $milestone->phase == 'P4' ? 'selected' : '' }}>P4 - Development</option>
                                            <option value="P5" {{ $milestone->phase == 'P5' ? 'selected' : '' }}>P5 - Testing</option>
                                            <option value="P6" {{ $milestone->phase == 'P6' ? 'selected' : '' }}>P6 - Deployment</option>
                                            <option value="P7" {{ $milestone->phase == 'P7' ? 'selected' : '' }}>P7 - Maintenance</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Task Name -->
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label small fw-semibold">
                                            Task Name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control task-name"
                                               value="{{ $milestone->task_name }}" required>
                                    </div>
                                </div>

                                <!-- Date Range -->
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label small fw-semibold">
                                            Planned Date Range
                                        </label>
                                        @php
                                            $dateRange = '';
                                            // Use planned_start_date from DB
                                            $start = $milestone->planned_start_date ?? $milestone->start_date;
                                            $end = $milestone->planned_end_date ?? $milestone->end_date;

                                            if($start && $end) {
                                                $dateRange = date('Y-m-d', strtotime($start)) . ' - ' . date('Y-m-d', strtotime($end));
                                            }
                                        @endphp
                                        <input type="text" class="form-control date-range-picker"
                                               value="{{ $dateRange }}">
                                    </div>
                                </div>

                                <!-- In-Charge Name -->
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label small fw-semibold">
                                            In-Charge Name
                                        </label>
                                        <input type="text" class="form-control incharge-name"
                                               value="{{ $milestone->in_charge }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Stakeholder Selection -->
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label small fw-semibold">
                                            Stakeholder
                                        </label>
                                        <select class="form-control stakeholder-select-task">
                                            <option value="">Select Stakeholder</option>
                                            @foreach($stakeholders as $stakeholder)
                                                <option value="{{ $stakeholder->id }}"
                                                    {{ $milestone->stakeholder_id == $stakeholder->id ? 'selected' : '' }}
                                                    data-code="{{ $stakeholder->stakeholder_code ?? '' }}">
                                                    {{ $stakeholder->first_name }} {{ $stakeholder->last_name }}
                                                    @if($stakeholder->stakeholder_code)
                                                        ({{ $stakeholder->stakeholder_code }})
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Priority -->
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label small fw-semibold">Priority</label>
                                        <select class="form-control priority-select">
                                            <option value="low" {{ $milestone->priority == 'low' ? 'selected' : '' }}>Low</option>
                                            <option value="medium" {{ $milestone->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                                            <option value="high" {{ $milestone->priority == 'high' ? 'selected' : '' }}>High</option>
                                            <option value="urgent" {{ $milestone->priority == 'urgent' ? 'selected' : '' }}>Urgent</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label small fw-semibold">Status</label>
                                        <select class="form-control status-select">
                                            <option value="pending" {{ $milestone->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="in-progress" {{ $milestone->status == 'in-progress' ? 'selected' : '' }}>In-Progress</option>
                                            <option value="completed" {{ $milestone->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="on-hold" {{ $milestone->status == 'on-hold' ? 'selected' : '' }}>On Hold</option>
                                            <option value="cancelled" {{ $milestone->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Percentage Complete -->
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label small fw-semibold">Progress</label>
                                        <div class="d-flex align-items-center">
                                            <input type="range" class="form-range progress-slider me-2"
                                                   min="0" max="100" step="10" value="{{ $milestone->progress ?? 0 }}">
                                            <span class="progress-value badge bg-info">{{ $milestone->progress ?? 0 }}%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Notes -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-0">
                                        <label class="form-label small fw-semibold">Notes</label>
                                        <textarea class="form-control notes" rows="2">{{ $milestone->notes }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Last Updated -->
                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="text-end">
                                        <small class="text-muted last-updated">
                                            Last updated: <span class="update-time">
                                                {{ $milestone->updated_at ? $milestone->updated_at->format('Y-m-d H:i:s') : 'Never' }}
                                            </span>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

<!-- Task Card Template (Hidden) -->
<div id="taskCardTemplate" class="d-none">
    <div class="card task-card mb-4" data-task-id="" data-db-id="">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <div>
                <h6 class="mb-0">
                    <span class="task-number">Task #</span>
                    <span class="task-phase-badge badge bg-primary ms-2"></span>
                </h6>
            </div>
            <div class="card-actions">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-primary" onclick="saveTask(this)">
                        <i class="ti ti-check me-1"></i>Save
                    </button>
                    <button type="button" class="btn btn-sm btn-warning" onclick="editTask(this)">
                        <i class="ti ti-edit me-1"></i>Edit
                    </button>
                    <button type="button" class="btn btn-sm btn-danger" onclick="deleteTask(this)">
                        <i class="ti ti-trash me-1"></i>Delete
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Phase Selection -->
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">
                            Phase <span class="text-danger">*</span>
                        </label>
                        <select class="form-control select2-dynamic phase-select" required>
                            <option value="">Select Phase</option>
                            <option value="P1">P1 - Initiation</option>
                            <option value="P2">P2 - Planning</option>
                            <option value="P3">P3 - Design</option>
                            <option value="P4">P4 - Development</option>
                            <option value="P5">P5 - Testing</option>
                            <option value="P6">P6 - Deployment</option>
                            <option value="P7">P7 - Maintenance</option>
                        </select>
                    </div>
                </div>

                <!-- Task Name -->
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">
                            Task Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control task-name" placeholder="Enter task name" required>
                    </div>
                </div>

                <!-- Date Range -->
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">
                            Planned Date Range
                        </label>
                        <input type="text" class="form-control date-range-picker"
                            placeholder="Start Date - End Date">
                    </div>
                </div>

                <!-- In-Charge Name -->
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">
                            In-Charge Name
                        </label>
                        <input type="text" class="form-control incharge-name" placeholder="Enter name">
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Stakeholder Selection -->
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">
                            Stakeholder
                        </label>
                        <select class="form-control stakeholder-select-task">
                            <option value="">Select Stakeholder</option>
                            @foreach($stakeholders as $stakeholder)
                                <option value="{{ $stakeholder->id }}"
                                        data-code="{{ $stakeholder->stakeholder_code ?? '' }}">
                                    {{ $stakeholder->first_name }} {{ $stakeholder->last_name }}
                                    @if($stakeholder->stakeholder_code)
                                        ({{ $stakeholder->stakeholder_code }})
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Priority -->
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Priority</label>
                        <select class="form-control priority-select">
                            <option value="low">Low</option>
                            <option value="medium" selected>Medium</option>
                            <option value="high">High</option>
                            <option value="urgent">Urgent</option>
                        </select>
                    </div>
                </div>

                <!-- Status -->
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Status</label>
                        <select class="form-control status-select">
                            <option value="pending" selected>Pending</option>
                            <option value="in-progress">In-Progress</option>
                            <option value="completed">Completed</option>
                            <option value="on-hold">On Hold</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                </div>

                <!-- Percentage Complete -->
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Progress</label>
                        <div class="d-flex align-items-center">
                            <input type="range" class="form-range progress-slider me-2"
                                   min="0" max="100" step="10" value="0">
                            <span class="progress-value badge bg-info">0%</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notes -->
            <div class="row">
                <div class="col-12">
                    <div class="mb-0">
                        <label class="form-label small fw-semibold">Notes</label>
                        <textarea class="form-control notes" rows="2" placeholder="Add notes..."></textarea>
                    </div>
                </div>
            </div>

            <!-- Last Updated -->
            <div class="row mt-3">
                <div class="col-12">
                    <div class="text-end">
                        <small class="text-muted last-updated">
                            Last updated: <span class="update-time">Never</span>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style>
    .select2-container--default .select2-selection--single {
        height: 38px;
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 36px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px;
    }

    .task-card {
        border-left: 4px solid #0d6efd;
        transition: all 0.3s ease;
    }

    .task-card:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    .task-card .card-header {
        background-color: #f8f9fa !important;
        border-bottom: 1px solid #dee2e6;
    }

    .task-card .form-label.small {
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 0.3rem;
    }

    .task-card .progress-slider {
        height: 6px;
        cursor: pointer;
    }

    .task-card .progress-value {
        min-width: 45px;
        text-align: center;
    }

    .task-card .is-invalid {
        border-color: #dc3545;
    }

    .task-phase-badge {
        font-size: 0.7rem;
        padding: 0.25em 0.6em;
    }

    .stakeholder-tag {
        background-color: #e9ecef;
        border-radius: 20px;
        padding: 5px 12px;
        font-size: 0.875rem;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .stakeholder-tag .remove-tag {
        cursor: pointer;
        color: #dc3545;
        font-size: 1.2rem;
        line-height: 1;
    }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
$(document).ready(function () {
    // Initialize select2 for all existing stakeholder dropdowns
    $('.select2-stakeholder').select2({
        placeholder: "Search and select stakeholder",
        allowClear: true,
        width: '100%',
        dropdownParent: $('#stakeholderContainer'),
        matcher: function(params, data) {
            if ($.trim(params.term) === '') return data;

            const searchTerm = params.term.toLowerCase();
            const name = data.text.toLowerCase();
            const element = $(data.element);
            const code = element.data('code') ? element.data('code').toLowerCase() : '';
            const email = element.data('email') ? element.data('email').toLowerCase() : '';

            return name.includes(searchTerm) ||
                   code.includes(searchTerm) ||
                   email.includes(searchTerm) ? data : null;
        }
    });

    // Initialize select2 for existing task cards
    $('.select2-dynamic').select2({
        width: '100%',
        placeholder: "Select Phase"
    });

    $('.stakeholder-select-task').select2({
        width: '100%',
        placeholder: "Select Stakeholder"
    });

    // Initialize date range pickers for existing cards (exclude template)
    $('#taskCardsContainer .task-card .date-range-picker').daterangepicker({
        autoUpdateInput: false,
        opens: 'left',
        locale: {
            cancelLabel: 'Clear',
            format: 'YYYY-MM-DD'
        }
    }).on('apply.daterangepicker', function(ev, picker) {
        $(this).val(
            picker.startDate.format('YYYY-MM-DD') +
            ' - ' +
            picker.endDate.format('YYYY-MM-DD')
        );
    }).on('cancel.daterangepicker', function() {
        $(this).val('');
    });

    // Update phase badges for existing cards
    $('.task-card').each(function() {
        updatePhaseBadge($(this));
    });

    // Handle stakeholder selection changes
    $(document).on('change', '.stakeholder-select', updateSelectedStakeholders);
    $(document).on('change', '.stakeholder-select-task', function() {
        updatePhaseBadge($(this).closest('.task-card'));
    });

    // Update progress display for existing cards
    $('.progress-slider').on('input', function() {
        const value = $(this).val();
        $(this).siblings('.progress-value').text(value + '%');

        const $card = $(this).closest('.task-card');
        if (value == 100) {
            $card.find('.status-select').val('completed');
        } else if (value > 0) {
            $card.find('.status-select').val('in-progress');
        }
    });

    // Disable editing for existing cards
    $('.task-card').each(function() {
        disableEditing($(this));
    });
});

let taskCounter = {{ $milestones->count() }};
let stakeholderCounter = 0;

// Add new stakeholder field
function addStakeholderField() {
    stakeholderCounter++;

    const newRow = `
        <div class="row stakeholder-row mb-3" data-index="${stakeholderCounter}">
            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label">
                        Stakeholder <span class="text-danger">*</span>
                        <small class="text-muted">(Select a stakeholder)</small>
                    </label>
                    <select class="form-control select2-stakeholder stakeholder-select" data-index="${stakeholderCounter}">
                        <option value="">Select Stakeholder</option>
                        @foreach($stakeholders as $stakeholder)
                            <option value="{{ $stakeholder->id }}"
                                    data-code="{{ $stakeholder->stakeholder_code ?? '' }}"
                                    data-email="{{ $stakeholder->email ?? '' }}"
                                    data-phone="{{ $stakeholder->phone ?? '' }}">
                                {{ $stakeholder->first_name }} {{ $stakeholder->last_name }}
                                @if($stakeholder->stakeholder_code)
                                    ({{ $stakeholder->stakeholder_code }})
                                @endif
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3 d-flex align-items-end h-100">
                    <button type="button" class="btn btn-danger btn-sm remove-stakeholder" onclick="removeStakeholderField(this)">
                        <i class="ti ti-trash me-1"></i>Remove
                    </button>
                </div>
            </div>
        </div>`;

    $('#stakeholderContainer').append(newRow);

    // Initialize select2 for new field
    $('#stakeholderContainer .stakeholder-row:last .select2-stakeholder').select2({
        placeholder: "Search and select stakeholder",
        allowClear: true,
        width: '100%',
        dropdownParent: $('#stakeholderContainer'),
        matcher: function(params, data) {
            if ($.trim(params.term) === '') return data;

            const searchTerm = params.term.toLowerCase();
            const name = data.text.toLowerCase();
            const element = $(data.element);
            const code = element.data('code') ? element.data('code').toLowerCase() : '';
            const email = element.data('email') ? element.data('email').toLowerCase() : '';

            return name.includes(searchTerm) ||
                   code.includes(searchTerm) ||
                   email.includes(searchTerm) ? data : null;
        }
    }).on('change', updateSelectedStakeholders);
}

// Remove stakeholder field
function removeStakeholderField(button) {
    const $row = $(button).closest('.stakeholder-row');
    const index = $row.data('index');

    $row.fadeOut(300, function() {
        $(this).remove();
        updateSelectedStakeholders();
    });
}

// Update selected stakeholders display
function updateSelectedStakeholders() {
    const selectedStakeholders = [];
    const stakeholderMap = {};

    $('.stakeholder-select').each(function() {
        const value = $(this).val();
        if (value) {
            const text = $(this).find('option:selected').text();
            const code = $(this).find('option:selected').data('code') || '';

            if (!stakeholderMap[value]) {
                stakeholderMap[value] = {
                    id: value,
                    name: text,
                    code: code
                };
                selectedStakeholders.push(stakeholderMap[value]);
            }
        }
    });

    // Update display
    const $container = $('#stakeholdersList');
    const $summary = $('#selectedStakeholders');

    if (selectedStakeholders.length > 0) {
        $container.empty();
        selectedStakeholders.forEach(stakeholder => {
            const tag = `
                <div class="stakeholder-tag">
                    ${stakeholder.name} ${stakeholder.code ? '(' + stakeholder.code + ')' : ''}
                </div>`;
            $container.append(tag);
        });
        $summary.removeClass('d-none');

        // Show remove button for all except first
        $('.remove-stakeholder').show();
        $('.stakeholder-row:first .remove-stakeholder').hide();
    } else {
        $summary.addClass('d-none');
        $('.remove-stakeholder').hide();
    }
}

// Add new task card
function addTaskCard() {
    taskCounter++;

    // Clone the template
    const template = document.getElementById('taskCardTemplate').innerHTML;
    const newCard = template.replace('data-task-id=""', `data-task-id="${taskCounter}"`);

    // Append to container
    $('#taskCardsContainer').append(newCard);

    // Get the newly added card
    const $newCard = $('#taskCardsContainer .task-card').last();

    // Update task number
    $newCard.find('.task-number').text(`Task #${taskCounter}`);

    // Initialize select2 for phase dropdown
    $newCard.find('.select2-dynamic').select2({
        width: '100%',
        placeholder: "Select Phase"
    });

    // Initialize select2 for stakeholder dropdown
    $newCard.find('.stakeholder-select-task').select2({
        width: '100%',
        placeholder: "Select Stakeholder"
    });

    // Initialize date range picker
    $newCard.find('.date-range-picker').daterangepicker({
        autoUpdateInput: false,
        opens: 'left',
        locale: {
            cancelLabel: 'Clear',
            format: 'YYYY-MM-DD'
        }
    }).on('apply.daterangepicker', function(ev, picker) {
        $(this).val(
            picker.startDate.format('YYYY-MM-DD') +
            ' - ' +
            picker.endDate.format('YYYY-MM-DD')
        );
    }).on('cancel.daterangepicker', function() {
        $(this).val('');
    });

    // Update phase badge when phase changes
    $newCard.find('.phase-select').on('change', function() {
        updatePhaseBadge($newCard);
    });

    // Update progress display
    $newCard.find('.progress-slider').on('input', function() {
        const value = $(this).val();
        $newCard.find('.progress-value').text(value + '%');

        // Update status based on progress
        if (value == 100) {
            $newCard.find('.status-select').val('completed');
        } else if (value > 0) {
            $newCard.find('.status-select').val('in-progress');
        }
    });

    // Make card editable by default
    enableEditing($newCard);

    // Show success message
    showToast('New task card added!', 'success');

    // Scroll to new card
    $newCard[0].scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}

// Update phase badge
function updatePhaseBadge($card) {
    const phase = $card.find('.phase-select').val();
    const phaseText = $card.find('.phase-select option:selected').text();
    const $badge = $card.find('.task-phase-badge');

    if (phase) {
        $badge.text(phaseText.split(' - ')[0]).show();
        // Update badge color based on phase
        const phaseColors = {
            'P1': 'bg-primary',
            'P2': 'bg-info',
            'P3': 'bg-success',
            'P4': 'bg-warning',
            'P5': 'bg-danger',
            'P6': 'bg-dark',
            'P7': 'bg-secondary'
        };
        $badge.removeClass().addClass('badge ' + (phaseColors[phase] || 'bg-primary'));
    } else {
        $badge.text('').hide();
    }
}

// Save task
function saveTask(button) {
    const $card = $(button).closest('.task-card');
    const taskId = $card.data('task-id');

    // Validate required fields
    if (!validateTask($card)) {
        showToast('Please fill in all required fields!', 'warning');
        return;
    }

    // Disable editing
    disableEditing($card);

    // Update last updated time
    const now = new Date();
    $card.find('.update-time').text(now.toLocaleString());

    // Show save button and hide edit button
    $(button).hide();
    $card.find('.btn-warning').show();

    // Update phase badge
    updatePhaseBadge($card);

    showToast(`Task #${taskId} saved successfully!`, 'success');

    // Log saved data (for debugging)
    const taskData = getTaskData($card);
    console.log(`Saved Task #${taskId}:`, taskData);

    // Save to server immediately
    saveToServer([taskData], []);
}

// Edit task
function editTask(button) {
    const $card = $(button).closest('.task-card');
    enableEditing($card);

    $(button).hide();
    $card.find('.btn-primary').show();

    showToast('Task is now editable', 'info');
}

// Delete task
function deleteTask(button) {
    if (confirm('Are you sure you want to delete this task? This action cannot be undone.')) {
        const $card = $(button).closest('.task-card');
        const taskId = $card.data('task-id');
        const dbId = $card.data('db-id');

        // If it's a saved task, delete immediately from server
        if (dbId) {
            // Send deletion request
            saveToServer([], [dbId]);
        } else {
            // If it's a new task, just remove it
            $card.fadeOut(300, function() {
                $(this).remove();
                updateTaskNumbers();
                showToast(`Task #${taskId} deleted!`, 'info');
            });
        }
    }
}

// Enable editing for a card
function enableEditing($card) {
    $card.find('input:not(.progress-slider), select, textarea').prop('disabled', false);
    $card.find('.select2-dynamic, .stakeholder-select-task').prop('disabled', false).trigger('change.select2');
    $card.find('.date-range-picker').prop('disabled', false);
}

// Disable editing for a card
function disableEditing($card) {
    $card.find('input:not(.progress-slider), select, textarea').prop('disabled', true);
    $card.find('.select2-dynamic, .stakeholder-select-task').prop('disabled', true).trigger('change.select2');
    $card.find('.date-range-picker').prop('disabled', true);
}

// Validate task card
function validateTask($card) {
    let isValid = true;

    // Check required fields
    if (!$card.find('.phase-select').val()) {
        $card.find('.phase-select').addClass('is-invalid');
        isValid = false;
    } else {
        $card.find('.phase-select').removeClass('is-invalid');
    }

    if (!$card.find('.task-name').val().trim()) {
        $card.find('.task-name').addClass('is-invalid');
        isValid = false;
    } else {
        $card.find('.task-name').removeClass('is-invalid');
    }

    return isValid;
}

// Get task data
function getTaskData($card) {
    const dateRange = $card.find('.date-range-picker').val();
    let startDate = null;
    let endDate = null;

    if (dateRange) {
        const dates = dateRange.split(' - ');
        if (dates.length === 2) {
            startDate = dates[0];
            endDate = dates[1];
        }
    }

    return {
        id: $card.data('db-id') || null,
        project_id: $('#project_id_hidden').val(),
        stakeholder_id: $card.find('.stakeholder-select-task').val(),
        phase: $card.find('.phase-select').val(),
        task_name: $card.find('.task-name').val(),
        start_date: startDate,
        end_date: endDate,
        in_charge: $card.find('.incharge-name').val(),
        priority: $card.find('.priority-select').val(),
        status: $card.find('.status-select').val(),
        progress: $card.find('.progress-slider').val(),
        notes: $card.find('.notes').val(),
        marked_for_delete: $card.data('marked-for-delete') || false
    };
}

// Update task numbers after deletion
function updateTaskNumbers() {
    $('.task-card').each(function(index) {
        const newIndex = index + 1;
        $(this).data('task-id', newIndex);
        $(this).find('.task-number').text(`Task #${newIndex}`);
    });
}

// Save all tasks
function saveAllTasks() {
    const tasks = [];
    const tasksToDelete = [];
    let allValid = true;
    let savedCount = 0;

    // Collect all tasks
    $('.task-card').each(function() {
        const $card = $(this);

        if ($card.data('marked-for-delete')) {
            tasksToDelete.push($card.data('db-id'));
            return;
        }

        if (validateTask($card)) {
            tasks.push(getTaskData($card));
            disableEditing($card);
            const now = new Date();
            $card.find('.update-time').text(now.toLocaleString());
            savedCount++;
        } else {
            allValid = false;
        }
    });

    if (allValid) {
        // Send to server via AJAX
        saveToServer(tasks, tasksToDelete);

        showToast(`All ${savedCount} tasks saved successfully!`, 'success');
    } else {
        showToast('Some tasks have validation errors. Please check required fields.', 'warning');
    }
}

// Save tasks to server
function saveToServer(tasksData, tasksToDelete) {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "{{ route('admin.project.milestones.store') }}",
        type: 'POST',
        data: {
            _token: csrfToken,
            project_id: $('#project_id_hidden').val(),
            tasks: tasksData,
            delete_tasks: tasksToDelete
        },
        success: function(response) {
            if (response.success) {
                // Update task cards with database IDs
                if (response.updated_tasks) {
                    response.updated_tasks.forEach(task => {
                        $(`.task-card[data-task-id="${task.client_id}"]`).data('db-id', task.id);
                    });
                }

                // Remove deleted tasks from UI
                tasksToDelete.forEach(id => {
                    $(`.task-card[data-db-id="${id}"]`).remove();
                });

                // Update task numbers
                updateTaskNumbers();

                showToast('Tasks saved to database successfully!', 'success');
            } else {
                showToast('Error saving tasks: ' + response.message, 'error');
            }
        },
        error: function(xhr) {
            let errorMsg = 'Error saving tasks to server';
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                // Parse validation errors
                const errors = xhr.responseJSON.errors;
                const firstError = Object.values(errors).flat()[0];
                errorMsg = 'Validation Error: ' + firstError;

                // Highlight invalid fields
                Object.keys(errors).forEach(key => {
                    // key format: tasks.0.field_name
                    const parts = key.split('.');
                    if (parts.length === 3 && parts[0] === 'tasks') {
                        const index = parseInt(parts[1]);
                        const field = parts[2];
                        const $card = $('.task-card').eq(index);

                        // Map field names to classes
                        let inputSelector = '';
                        if (field === 'stakeholder_id') inputSelector = '.stakeholder-select-task';
                        else if (field === 'phase') inputSelector = '.phase-select';
                        else if (field === 'task_name') inputSelector = '.task-name';
                        // Add more mappings as needed

                        if (inputSelector) {
                            $card.find(inputSelector).addClass('is-invalid');
                            // Add change listener to remove invalid class
                            $card.find(inputSelector).one('change input', function() {
                                $(this).removeClass('is-invalid');
                            });
                        }
                    }
                });
            } else if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMsg += ': ' + xhr.responseJSON.message;
            }
            showToast(errorMsg, 'error');
            console.error('Server error:', xhr.responseText);
        }
    });
}

// Load existing milestones
function loadExistingMilestones() {
    $.ajax({
        url: "{{ route('admin.project.milestones.list', $project->id) }}",
        type: 'GET',
        success: function(response) {
            if (response.success && response.milestones.length > 0) {
                // Clear existing task cards
                $('#taskCardsContainer').empty();

                // Add loaded milestones
                response.milestones.forEach((milestone, index) => {
                    addMilestoneCard(milestone, index + 1);
                });

                showToast('Existing milestones loaded successfully!', 'success');
            } else {
                showToast('No existing milestones found.', 'info');
            }
        },
        error: function(xhr) {
            showToast('Error loading milestones', 'error');
            console.error('Server error:', xhr.responseText);
        }
    });
}

// Add milestone card from loaded data
function addMilestoneCard(milestone, index) {
    taskCounter++;

    // Clone the template
    const template = document.getElementById('taskCardTemplate').innerHTML;
    const newCard = template.replace('data-task-id=""', `data-task-id="${taskCounter}" data-db-id="${milestone.id}"`);

    // Append to container
    $('#taskCardsContainer').append(newCard);

    // Get the newly added card
    const $newCard = $('#taskCardsContainer .task-card').last();

    // Update task number
    $newCard.find('.task-number').text(`Task #${index}`);

    // Fill in data
    $newCard.find('.phase-select').val(milestone.phase);
    $newCard.find('.task-name').val(milestone.task_name);

    // Use planned_start_date from JSON response
    const start = milestone.planned_start_date || milestone.start_date;
    const end = milestone.planned_end_date || milestone.end_date;

    if (start && end) {
        const startDate = moment(start).format('YYYY-MM-DD');
        const endDate = moment(end).format('YYYY-MM-DD');
        $newCard.find('.date-range-picker').val(`${startDate} - ${endDate}`);
    }

    $newCard.find('.incharge-name').val(milestone.in_charge);
    $newCard.find('.stakeholder-select-task').val(milestone.stakeholder_id);
    $newCard.find('.priority-select').val(milestone.priority);
    $newCard.find('.status-select').val(milestone.status);
    $newCard.find('.progress-slider').val(milestone.progress || 0);
    $newCard.find('.progress-value').text((milestone.progress || 0) + '%');
    $newCard.find('.notes').val(milestone.notes);
    $newCard.find('.update-time').text(moment(milestone.updated_at).format('YYYY-MM-DD HH:mm:ss'));

    // Initialize select2
    $newCard.find('.select2-dynamic').select2({
        width: '100%',
        placeholder: "Select Phase"
    });

    $newCard.find('.stakeholder-select-task').select2({
        width: '100%',
        placeholder: "Select Stakeholder"
    });

    // Initialize date range picker
    $newCard.find('.date-range-picker').daterangepicker({
        autoUpdateInput: false,
        opens: 'left',
        locale: {
            cancelLabel: 'Clear',
            format: 'YYYY-MM-DD'
        }
    }).on('apply.daterangepicker', function(ev, picker) {
        $(this).val(
            picker.startDate.format('YYYY-MM-DD') +
            ' - ' +
            picker.endDate.format('YYYY-MM-DD')
        );
    }).on('cancel.daterangepicker', function() {
        $(this).val('');
    });

    // Event listeners
    $newCard.find('.phase-select').on('change', function() {
        updatePhaseBadge($newCard);
    });

    $newCard.find('.progress-slider').on('input', function() {
        const value = $(this).val();
        $newCard.find('.progress-value').text(value + '%');

        if (value == 100) {
            $newCard.find('.status-select').val('completed');
        } else if (value > 0) {
            $newCard.find('.status-select').val('in-progress');
        }
    });

    // Update phase badge
    updatePhaseBadge($newCard);

    // Disable editing
    disableEditing($newCard);
}

// Export tasks
function exportTasks(format) {
    const tasks = [];
    $('.task-card').each(function() {
        if (!$(this).data('marked-for-delete')) {
            tasks.push(getTaskData($(this)));
        }
    });

    if (tasks.length === 0) {
        showToast('No tasks to export!', 'warning');
        return;
    }

    if (format === 'pdf') {
        // In a real implementation, you would send data to server for PDF generation
        console.log('Exporting to PDF:', tasks);
        showToast('PDF export initiated!', 'info');
    } else if (format === 'excel') {
        // In a real implementation, you would send data to server for Excel generation
        console.log('Exporting to Excel:', tasks);
        showToast('Excel export initiated!', 'info');
    }
}

// Refresh page
function refreshPage() {
    if (confirm('Are you sure you want to refresh? Unsaved changes will be lost.')) {
        location.reload();
    }
}

// Toast notification function
function showToast(message, type = 'info') {
    // Remove existing toasts
    $('.toast-container').remove();

    // Create toast container
    const toastContainer = $('<div class="toast-container position-fixed bottom-0 end-0 p-3"></div>');

    // Create toast
    const toastId = 'toast-' + Date.now();
    const toast = $(`
    <div id="${toastId}" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-${type} text-white">
            <strong class="me-auto">Notification</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
        </div>
        <div class="toast-body">
            ${message}
        </div>
    </div>`);

    // Append to body and show
    toastContainer.append(toast);
    $('body').append(toastContainer);

    // Initialize and show toast
    const toastElement = new bootstrap.Toast(toast[0]);
    toastElement.show();

    // Remove after hide
    toast.on('hidden.bs.toast', function () {
        $(this).closest('.toast-container').remove();
    });
}
</script>
@endpush
@endsection
