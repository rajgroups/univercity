@extends('layouts.admin.app')
@section('content')
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Stakeholder Details</h4>
                <h6>View stakeholder profile and details</h6>
            </div>
        </div>
        <div class="page-btn mt-0">
            <a href="{{ route('admin.stakeholder.index') }}" class="btn btn-secondary me-2 fs-6">
                <i class="bi bi-arrow-left me-2"></i>Back to List
            </a>
            <a href="{{ route('admin.stakeholder.edit', $stakeholder->id) }}" class="btn btn-info fs-6">
                <i class="bi bi-pencil-square me-2"></i>Edit
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Profile Card -->
        <div class="col-lg-4 col-md-12 mb-4">
            <div class="card h-100">
                <div class="card-body text-center mt-3">
                    <div class="avatar avatar-xxl bg-light text-primary rounded-circle mb-3" style="font-size: 3rem; width: 100px; height: 100px; line-height: 100px; margin: 0 auto;">
                        {{ strtoupper(substr($stakeholder->first_name, 0, 1)) }}{{ strtoupper(substr($stakeholder->last_name, 0, 1)) }}
                    </div>
                    <h3 class="mb-1 fw-bold">{{ $stakeholder->full_name }}</h3>
                    <p class="text-muted mb-2 fs-5">{{ $stakeholder->designation ?? 'Stakeholder' }} at {{ $stakeholder->company_name ?? 'N/A' }}</p>
                    
                    <span class="badge bg-light text-dark mb-3 px-3 py-2 border fs-6">#{{ $stakeholder->stakeholder_id }}</span>
                    
                    <div class="d-flex justify-content-center gap-2 mb-4">
                        @if($stakeholder->status == 1)
                            <span class="badge bg-success fs-6">Active</span>
                        @elseif($stakeholder->status == 2)
                            <span class="badge bg-secondary fs-6">Inactive</span>
                        @else
                            <span class="badge bg-warning text-dark fs-6">Status: {{ $stakeholder->status }}</span>
                        @endif

                        @switch($stakeholder->type)
                            @case(1) <span class="badge bg-primary fs-6">ISICO Core</span> @break
                            @case(2) <span class="badge bg-info fs-6">Training Partner</span> @break
                            @case(3) <span class="badge bg-warning text-dark fs-6">Learner</span> @break
                            @case(4) <span class="badge bg-success fs-6">Volunteer</span> @break
                            @case(5) <span class="badge bg-secondary fs-6">Funding Partner</span> @break
                        @endswitch
                    </div>

                    <ul class="list-group list-group-flush text-start fs-6">
                        <li class="list-group-item px-0">
                            <strong><i class="bi bi-envelope me-2 text-muted"></i>Email</strong><br>
                            <a href="mailto:{{ $stakeholder->email }}">{{ $stakeholder->email }}</a>
                        </li>
                        <li class="list-group-item px-0">
                            <strong><i class="bi bi-telephone me-2 text-muted"></i>Phone</strong><br>
                            {{ $stakeholder->phone ?? 'N/A' }}
                            @if($stakeholder->alternate_phone)
                                <br><span class="text-muted">Alt: {{ $stakeholder->alternate_phone }}</span>
                            @endif
                        </li>
                    </ul>

                    @if($stakeholder->linkedin_url || $stakeholder->twitter_url || $stakeholder->website_url)
                        <div class="mt-4 pt-3 border-top d-flex justify-content-center gap-3">
                            @if($stakeholder->linkedin_url)
                                <a href="{{ $stakeholder->linkedin_url }}" target="_blank" class="text-primary fs-3"><i class="bi bi-linkedin"></i></a>
                            @endif
                            @if($stakeholder->twitter_url)
                                <a href="{{ $stakeholder->twitter_url }}" target="_blank" class="text-info fs-3"><i class="bi bi-twitter"></i></a>
                            @endif
                            @if($stakeholder->website_url)
                                <a href="{{ $stakeholder->website_url }}" target="_blank" class="text-dark fs-3"><i class="bi bi-globe"></i></a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Details Card -->
        <div class="col-lg-8 col-md-12 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-tabs-solid mb-4 fs-6" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#basic-info" role="tab">Overview</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#professional" role="tab">Professional Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#address" role="tab">Address</a>
                        </li>
                    </ul>

                    <div class="tab-content fs-6">
                        <!-- Overview Tab -->
                        <div class="tab-pane show active" id="basic-info" role="tabpanel">
                            <h4 class="mb-3">Organizational Details</h4>
                            <div class="row mb-4">
                                <div class="col-sm-4 text-muted mb-1 fs-6">Company/Organization</div>
                                <div class="col-sm-8 fw-semibold mb-3 fs-6">{{ $stakeholder->company_name ?? 'N/A' }}</div>
                                
                                <div class="col-sm-4 text-muted mb-1 fs-6">Department</div>
                                <div class="col-sm-8 fw-semibold mb-3 fs-6">{{ $stakeholder->department ?? 'N/A' }}</div>

                                <div class="col-sm-4 text-muted mb-1 fs-6">Classification ID</div>
                                <div class="col-sm-8 fw-semibold mb-3 fs-6">{{ $stakeholder->classification }}</div>
                                
                                <div class="col-sm-4 text-muted mb-1 fs-6">Engagement Level</div>
                                <div class="col-sm-8 fw-semibold mb-3 fs-6">
                                    <div class="progress mt-1" style="height: 8px; width: 120px;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{ ($stakeholder->engagement_level / 5) * 100 }}%"></div>
                                    </div>
                                    <span class="fs-6">{{ $stakeholder->engagement_level }} / 5</span>
                                </div>
                            </div>
                            
                            <h4 class="mb-3">Biography</h4>
                            <p class="text-muted fs-6">{{ $stakeholder->biography ?? 'No biography provided.' }}</p>
                        </div>

                        <!-- Professional Tab -->
                        <div class="tab-pane" id="professional" role="tabpanel">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <h5 class="text-muted mb-2">Industry</h5>
                                    <div class="fs-5 fw-medium">{{ $stakeholder->industry ?? 'N/A' }}</div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <h5 class="text-muted mb-2">Expertise Area</h5>
                                    <div class="fs-5 fw-medium">{{ $stakeholder->expertise_area ?? 'N/A' }}</div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <h5 class="text-muted mb-2">Preferred Language</h5>
                                    <div class="fs-5 fw-medium">{{ strtoupper($stakeholder->preferred_language) }}</div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <h5 class="text-muted mb-2">Influence Level</h5>
                                    <div class="fs-5 fw-medium">{{ $stakeholder->influence_level }} / 4</div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <h5 class="text-muted mb-2">Interest Level</h5>
                                    <div class="fs-5 fw-medium">{{ $stakeholder->interest_level }} / 3</div>
                                </div>
                            </div>
                        </div>

                        <!-- Address Tab -->
                        <div class="tab-pane" id="address" role="tabpanel">
                            <div class="card bg-light border-0">
                                <div class="card-body">
                                    @if($stakeholder->address_line_1 || $stakeholder->city || $stakeholder->state)
                                        <address class="mb-0 fs-5">
                                            <strong>{{ $stakeholder->address_line_1 }}</strong><br>
                                            @if($stakeholder->address_line_2)
                                                {{ $stakeholder->address_line_2 }}<br>
                                            @endif
                                            {{ $stakeholder->city ?? '' }}@if($stakeholder->city && $stakeholder->state), @endif{{ $stakeholder->state ?? '' }} {{ $stakeholder->postal_code ?? '' }}<br>
                                            @if($stakeholder->country)
                                                {{ $stakeholder->country }}
                                            @endif
                                        </address>
                                    @else
                                        <p class="text-muted mb-0 fs-5">No address details provided.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection