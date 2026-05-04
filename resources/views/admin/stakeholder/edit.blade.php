@extends('layouts.admin.app')
@section('content')
    @php
        $communicationPreferencesText = old(
            'communication_preferences_text',
            is_array($stakeholder->communication_preferences)
                ? implode("\n", $stakeholder->communication_preferences)
                : ($stakeholder->communication_preferences ?? '')
        );
        $assignedProjectsText = old(
            'assigned_projects_text',
            is_array($stakeholder->assigned_projects)
                ? implode("\n", $stakeholder->assigned_projects)
                : ($stakeholder->assigned_projects ?? '')
        );
        $involvedPhasesText = old(
            'involved_phases_text',
            is_array($stakeholder->involved_phases)
                ? implode("\n", $stakeholder->involved_phases)
                : ($stakeholder->involved_phases ?? '')
        );
        $metadataText = old(
            'metadata_text',
            !empty($stakeholder->metadata)
                ? json_encode($stakeholder->metadata, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
                : ''
        );
    @endphp

    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Edit Stakeholder</h4>
                <h6>Update stakeholder details</h6>
            </div>
        </div>
        <div class="page-btn mt-0">
            <a href="{{ route('admin.stakeholder.index') }}" class="btn btn-secondary">
                <i class="feather feather-arrow-left me-2"></i>Back to List
            </a>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Please fix the following errors:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.stakeholder.update', $stakeholder->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <h5 class="mb-3 text-primary border-bottom pb-2">Basic Information</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">First Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="first_name" value="{{ old('first_name', $stakeholder->first_name) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Last Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="last_name" value="{{ old('last_name', $stakeholder->last_name) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" value="{{ old('email', $stakeholder->email) }}" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" value="{{ old('phone', $stakeholder->phone) }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Alternate Phone</label>
                        <input type="text" class="form-control" name="alternate_phone" value="{{ old('alternate_phone', $stakeholder->alternate_phone) }}">
                    </div>
                </div>

                <h5 class="mb-3 text-primary border-bottom pb-2 mt-4">Role & Organization</h5>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Type <span class="text-danger">*</span></label>
                        <select class="form-select" name="type" required>
                            <option value="1" {{ old('type', $stakeholder->type) == '1' ? 'selected' : '' }}>ISICO Core</option>
                            <option value="2" {{ old('type', $stakeholder->type) == '2' ? 'selected' : '' }}>Training Partner</option>
                            <option value="3" {{ old('type', $stakeholder->type) == '3' ? 'selected' : '' }}>Learner</option>
                            <option value="4" {{ old('type', $stakeholder->type) == '4' ? 'selected' : '' }}>Volunteer</option>
                            <option value="5" {{ old('type', $stakeholder->type) == '5' ? 'selected' : '' }}>Funding Partner</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Company Name</label>
                        <input type="text" class="form-control" name="company_name" value="{{ old('company_name', $stakeholder->company_name) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Designation</label>
                        <input type="text" class="form-control" name="designation" value="{{ old('designation', $stakeholder->designation) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Department</label>
                        <input type="text" class="form-control" name="department" value="{{ old('department', $stakeholder->department) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Classification (Sub Type)</label>
                        <input type="number" class="form-control" name="classification" value="{{ old('classification', $stakeholder->classification) }}" min="1" max="14">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select" name="status" required>
                            <option value="1" {{ old('status', $stakeholder->status) == '1' ? 'selected' : '' }}>Active</option>
                            <option value="2" {{ old('status', $stakeholder->status) == '2' ? 'selected' : '' }}>Inactive</option>
                            <option value="3" {{ old('status', $stakeholder->status) == '3' ? 'selected' : '' }}>Pending</option>
                            <option value="4" {{ old('status', $stakeholder->status) == '4' ? 'selected' : '' }}>Archived</option>
                            <option value="5" {{ old('status', $stakeholder->status) == '5' ? 'selected' : '' }}>Blocked</option>
                        </select>
                    </div>
                </div>

                <h5 class="mb-3 text-primary border-bottom pb-2 mt-4">Professional Details</h5>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Industry</label>
                        <input type="text" class="form-control" name="industry" value="{{ old('industry', $stakeholder->industry) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Expertise Area</label>
                        <input type="text" class="form-control" name="expertise_area" value="{{ old('expertise_area', $stakeholder->expertise_area) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Preferred Language</label>
                        <input type="text" class="form-control" name="preferred_language" value="{{ old('preferred_language', $stakeholder->preferred_language) }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Biography</label>
                        <textarea class="form-control" name="biography" rows="3">{{ old('biography', $stakeholder->biography) }}</textarea>
                    </div>
                </div>

                <h5 class="mb-3 text-primary border-bottom pb-2 mt-4">Address</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Address Line 1</label>
                        <input type="text" class="form-control" name="address_line_1" value="{{ old('address_line_1', $stakeholder->address_line_1) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Address Line 2</label>
                        <input type="text" class="form-control" name="address_line_2" value="{{ old('address_line_2', $stakeholder->address_line_2) }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">City</label>
                        <input type="text" class="form-control" name="city" value="{{ old('city', $stakeholder->city) }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">State</label>
                        <input type="text" class="form-control" name="state" value="{{ old('state', $stakeholder->state) }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Country</label>
                        <input type="text" class="form-control" name="country" value="{{ old('country', $stakeholder->country) }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Postal Code</label>
                        <input type="text" class="form-control" name="postal_code" value="{{ old('postal_code', $stakeholder->postal_code) }}">
                    </div>
                </div>

                <h5 class="mb-3 text-primary border-bottom pb-2 mt-4">Links & Engagement</h5>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">LinkedIn URL</label>
                        <input type="url" class="form-control" name="linkedin_url" value="{{ old('linkedin_url', $stakeholder->linkedin_url) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Twitter/X URL</label>
                        <input type="url" class="form-control" name="twitter_url" value="{{ old('twitter_url', $stakeholder->twitter_url) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Website URL</label>
                        <input type="url" class="form-control" name="website_url" value="{{ old('website_url', $stakeholder->website_url) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Engagement Level (1-5)</label>
                        <input type="number" class="form-control" name="engagement_level" value="{{ old('engagement_level', $stakeholder->engagement_level) }}" min="1" max="5">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Influence Level (1-4)</label>
                        <input type="number" class="form-control" name="influence_level" value="{{ old('influence_level', $stakeholder->influence_level) }}" min="1" max="4">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Interest Level (1-3)</label>
                        <input type="number" class="form-control" name="interest_level" value="{{ old('interest_level', $stakeholder->interest_level) }}" min="1" max="3">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Last Contacted</label>
                        <input type="date" class="form-control" name="last_contacted" value="{{ old('last_contacted', optional($stakeholder->last_contacted)->format('Y-m-d')) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Next Follow Up</label>
                        <input type="date" class="form-control" name="next_follow_up" value="{{ old('next_follow_up', optional($stakeholder->next_follow_up)->format('Y-m-d')) }}">
                    </div>
                </div>

                <h5 class="mb-3 text-primary border-bottom pb-2 mt-4">Additional Data</h5>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Communication Preferences</label>
                        <textarea class="form-control" name="communication_preferences_text" rows="4" placeholder="Email&#10;Phone&#10;WhatsApp">{{ $communicationPreferencesText }}</textarea>
                        <small class="text-muted">Enter one item per line or comma separated.</small>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Assigned Projects</label>
                        <textarea class="form-control" name="assigned_projects_text" rows="4" placeholder="Project Alpha&#10;Project Beta">{{ $assignedProjectsText }}</textarea>
                        <small class="text-muted">Enter one project per line or comma separated.</small>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Involved Phases</label>
                        <textarea class="form-control" name="involved_phases_text" rows="4" placeholder="Planning&#10;Execution&#10;Review">{{ $involvedPhasesText }}</textarea>
                        <small class="text-muted">Enter one phase per line or comma separated.</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Metadata (JSON)</label>
                        <textarea class="form-control font-monospace" name="metadata_text" rows="4" placeholder='{"source":"manual","priority":"high"}'>{{ $metadataText }}</textarea>
                        <small class="text-muted">Optional JSON object for extra structured details.</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Internal Notes</label>
                        <textarea class="form-control" name="notes" rows="4" placeholder="Add any internal notes about this stakeholder...">{{ old('notes', $stakeholder->notes) }}</textarea>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 text-end">
                        <a href="{{ route('admin.stakeholder.index') }}" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary px-4">Update Stakeholder</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
