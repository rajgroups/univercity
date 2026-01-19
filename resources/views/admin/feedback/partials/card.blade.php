<div class="card mb-3 survey-card" data-index="{{ $index }}">
    <div class="card-header bg-light d-flex justify-content-between align-items-center py-2">
        <h6 class="mb-0 text-primary">
            <i class="feather feather-user me-2"></i>
            Response #{{ is_numeric($index) ? $index + 1 : 'New' }}
        </h6>
        <button type="button" class="btn btn-sm btn-outline-danger remove-card-btn" onclick="removeCard(this)">
            <i class="bi bi-trash"></i>
        </button>
    </div>
    <div class="card-body">
        <input type="hidden" name="surveys[{{ $index }}][id]" value="{{ $survey['id'] ?? '' }}">

        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label small fw-bold">Surveyor Name <span class="text-danger">*</span></label>
                    <input type="text" name="surveys[{{ $index }}][name]" class="form-control form-control-sm @error("surveys.$index.name") is-invalid @enderror" value="{{ $survey['name'] ?? '' }}" placeholder="Enter name">
                    @error("surveys.$index.name")
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label small fw-bold">Email <span class="text-danger">*</span></label>
                    <input type="email" name="surveys[{{ $index }}][email]" class="form-control form-control-sm @error("surveys.$index.email") is-invalid @enderror" value="{{ $survey['email'] ?? '' }}" placeholder="Enter email">
                    @error("surveys.$index.email")
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label small fw-bold">Role <span class="text-danger">*</span></label>
                    <select name="surveys[{{ $index }}][role]" class="form-select form-select-sm @error("surveys.$index.role") is-invalid @enderror">
                        <option value="">Select Role</option>
                        @foreach(['Project Manager', 'Stakeholder', 'Beneficiary', 'Donor', 'Other'] as $role)
                            <option value="{{ $role }}" {{ ($survey['role'] ?? '') == $role ? 'selected' : '' }}>{{ $role }}</option>
                        @endforeach
                    </select>
                    @error("surveys.$index.role")
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3">
                    <label class="form-label small fw-bold">Survey Date <span class="text-danger">*</span></label>
                    <input type="date" name="surveys[{{ $index }}][survey_date]" class="form-control form-control-sm @error("surveys.$index.survey_date") is-invalid @enderror" value="{{ $survey['survey_date'] ?? date('Y-m-d') }}">
                    @error("surveys.$index.survey_date")
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-5">
                <div class="mb-3">
                    <label class="form-label small fw-bold d-block">Overall Satisfaction <span class="text-danger">*</span></label>
                    @foreach(['Very Satisfied', 'Satisfied', 'Neutral', 'Dissatisfied'] as $sat)
                        <div class="form-check form-check-inline mt-1">
                            <input class="form-check-input" type="radio" name="surveys[{{ $index }}][satisfaction]" id="sat_{{ $index }}_{{ $loop->index }}" value="{{ $sat }}" {{ ($survey['satisfaction'] ?? '') == $sat ? 'checked' : '' }}>
                            <label class="form-check-label small" for="sat_{{ $index }}_{{ $loop->index }}">{{ $sat }}</label>
                        </div>
                    @endforeach
                    @error("surveys.$index.satisfaction")
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label small fw-bold d-block">Project Success <span class="text-danger">*</span></label>
                    <div class="btn-group" role="group">
                        @foreach(['Yes' => 'success', 'No' => 'danger', 'Not Sure' => 'secondary'] as $val => $color)
                            <input type="radio" class="btn-check" name="surveys[{{ $index }}][project_success]" id="succ_{{ $index }}_{{ $loop->index }}" value="{{ $val }}" {{ ($survey['project_success'] ?? '') == $val ? 'checked' : '' }}>
                            <label class="btn btn-sm btn-outline-{{ $color }}" for="succ_{{ $index }}_{{ $loop->index }}">{{ $val }}</label>
                        @endforeach
                    </div>
                    @error("surveys.$index.project_success")
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="mb-0">
                    <label class="form-label small fw-bold">Comments</label>
                    <textarea name="surveys[{{ $index }}][comments]" class="form-control form-control-sm" rows="2" placeholder="Write comments...">{{ $survey['comments'] ?? '' }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
