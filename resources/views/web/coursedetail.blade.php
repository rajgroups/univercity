@push('meta')
    <title>{{ $metaTitle ?? ($course->name ?? 'Default Page Title') }}</title>

    <meta name="description"
        content="{{ $metaDescription ?? Str::limit(strip_tags($course->short_description ?? ''), 150) }}">
    <meta name="keywords" content="{{ $metaKeywords ?? 'announcement, news, education' }}">
    <meta name="author" content="{{ $metaAuthor ?? 'YourSiteName' }}">
    <meta name="robots" content="{{ $metaRobots ?? 'index, follow' }}">

    <!-- Canonical Tag -->
    <link rel="canonical" href="{{ $metaCanonical ?? url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:title" content="{{ $metaOgTitle ?? ($course->name ?? 'Default OG Title') }}">
    <meta property="og:description"
        content="{{ $metaOgDescription ?? Str::limit(strip_tags($course->short_description ?? ''), 150) }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $metaOgUrl ?? url()->current() }}">
    <meta property="og:image" content="{{ $metaOgImage ?? asset($course->image ?? 'default.jpg') }}">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $metaTwitterTitle ?? ($course->name ?? 'Default Twitter Title') }}">
    <meta name="twitter:description"
        content="{{ $metaTwitterDescription ?? Str::limit(strip_tags($course->short_description ?? ''), 150) }}">
    <meta name="twitter:image" content="{{ $metaTwitterImage ?? asset($course->image ?? 'default.jpg') }}">
@endpush
@extends('layouts.web.app')
@section('content')
    <!-- Course Hero Section -->
    <section class="course-hero position-relative overflow-hidden mb-5">
        <div class="container-fluid">
            <div class="row align-items-center min-vh-50 py-5">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="hero-content pe-lg-5">
                        <div class="badge bg-primary text-white px-3 py-2 rounded-pill mb-3 d-inline-block">
                            {{ $course->sector->name ?? 'General Course' }}
                        </div>
                        <h1 class="display-5 fw-bold mb-3">{{ $course->name }}</h1>
                        <p class="lead mb-4">{{ $course->short_name }} <span class="text-primary">{{ $course->language }}</span></p>
                        <p class="text-muted mb-4">{{ Str::limit(strip_tags($course->short_description), 200) }}</p>

                        <div class="d-flex flex-wrap gap-3 mb-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-clock-fill text-primary me-2"></i>
                                <span>{{ $course->duration ?? 'N/A' }} Minutes</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-people-fill text-primary me-2"></i>
                                <span>{{ $course->enrollment_count ?? 0 }}+ Enrolled</span>
                            </div>
                            <div class="d-flex align-items-center">
                                @if ($course->paid_type == 'Free')
                                    <span class="badge bg-success fs-6">Free</span>
                                @else
                                    <span class="badge bg-warning text-dark fs-6">Paid</span>
                                @endif
                            </div>
                        </div>

                        <div class="d-flex flex-wrap gap-2">
                            <button class="btn btn-primary btn-lg px-4">Enroll Now</button>
                            <button class="btn btn-outline-primary btn-lg px-4">Share Course</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="course-image-wrapper rounded-4 overflow-hidden shadow-lg">
                        <img src="{{ asset($course->image) }}" alt="{{ $course->name }}" class="img-fluid w-100">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Course Details Section -->
    <section class="course-details mb-5">
        <div class="container-fluid">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <!-- Course Tabs -->
                    <div class="card shadow-sm border-0 rounded-4 overflow-hidden mb-4">
                        <div class="card-header bg-white p-0">
                            <ul class="nav nav-tabs nav-fill border-bottom" id="courseTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active py-3" id="overview-tab" data-bs-toggle="tab"
                                            data-bs-target="#overview" type="button" role="tab">
                                        <i class="bi bi-info-circle me-2"></i>Overview
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link py-3" id="curriculum-tab" data-bs-toggle="tab"
                                            data-bs-target="#curriculum" type="button" role="tab">
                                        <i class="bi bi-journal-text me-2"></i>Curriculum
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link py-3" id="details-tab" data-bs-toggle="tab"
                                            data-bs-target="#details" type="button" role="tab">
                                        <i class="bi bi-card-checklist me-2"></i>Details
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link py-3" id="eligibility-tab" data-bs-toggle="tab"
                                            data-bs-target="#eligibility" type="button" role="tab">
                                        <i class="bi bi-person-check me-2"></i>Eligibility
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body p-4">
                            <div class="tab-content" id="courseTabsContent">
                                <!-- Overview Tab -->
                                <div class="tab-pane fade show active" id="overview" role="tabpanel">
                                    <div class="course-description mb-4">
                                        {!! $course->long_description !!}
                                    </div>
                                    <div class="course-image mb-4">
                                        <img src="{{ asset($course->image) }}" alt="Course Image" class="img-fluid rounded-3 w-100">
                                    </div>
                                </div>

                                <!-- Curriculum Tab -->
                                <div class="tab-pane fade" id="curriculum" role="tabpanel">
                                    @php
                                        $topics = json_decode($course->topics, true);
                                    @endphp

                                    @if(!empty($topics))
                                        <div class="accordion" id="courseCurriculum">
                                            @foreach($topics as $index => $topic)
                                                <div class="accordion-item border-0 mb-2 rounded-3 overflow-hidden">
                                                    <h2 class="accordion-header" id="heading{{ $index }}">
                                                        <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }} bg-light shadow-none py-3"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#collapse{{ $index }}"
                                                                aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">
                                                            <div class="d-flex align-items-center w-100">
                                                                <span class="me-3 fw-bold text-primary">{{ $index + 1 }}.</span>
                                                                <span class="fw-medium">{{ $topic['title'] ?? 'Untitled Topic' }}</span>
                                                                <span class="badge bg-primary ms-auto">{{ $loop->iteration }}/{{ count($topics) }}</span>
                                                            </div>
                                                        </button>
                                                    </h2>
                                                    <div id="collapse{{ $index }}"
                                                         class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                                         data-bs-parent="#courseCurriculum">
                                                        <div class="accordion-body bg-white py-3">
                                                            <p class="mb-0">{{ $topic['description'] ?? 'No description available.' }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="alert alert-info text-center py-4">
                                            <i class="bi bi-info-circle display-4 text-primary mb-3"></i>
                                            <h5>Curriculum Not Available</h5>
                                            <p class="mb-0">The course curriculum will be updated soon.</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Details Tab -->
                                <div class="tab-pane fade" id="details" role="tabpanel">
                                    <div class="row g-4">
                                        <!-- Course Information -->
                                        <div class="col-md-6">
                                            <h5 class="mb-3 text-primary"><i class="bi bi-info-circle me-2"></i>Course Information</h5>
                                            <div class="list-group list-group-flush">
                                                @if($course->provider)
                                                    <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                        <span>Training Partner</span>
                                                        <span class="fw-medium">{{ $course->provider }}</span>
                                                    </div>
                                                @endif
                                                @if($course->language)
                                                    <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                        <span>Language</span>
                                                        <span class="fw-medium">{{ $course->language }}</span>
                                                    </div>
                                                @endif
                                                @if($course->certification_type)
                                                    <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                        <span>Certification</span>
                                                        <span class="fw-medium">{{ $course->certification_type }}</span>
                                                    </div>
                                                @endif
                                                @if($course->assessment_mode)
                                                    <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                        <span>Assessment</span>
                                                        <span class="fw-medium">{{ $course->assessment_mode }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Program Details -->
                                        <div class="col-md-6">
                                            <h5 class="mb-3 text-primary"><i class="bi bi-gear me-2"></i>Program Details</h5>
                                            <div class="list-group list-group-flush">
                                                @if($course->program_by)
                                                    <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                        <span>Program By</span>
                                                        <span class="fw-medium">{{ $course->program_by }}</span>
                                                    </div>
                                                @endif
                                                @if($course->initiative_of)
                                                    <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                        <span>Initiative Of</span>
                                                        <span class="fw-medium">{{ $course->initiative_of }}</span>
                                                    </div>
                                                @endif
                                                @if($course->domain)
                                                    <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                        <span>Domain</span>
                                                        <span class="fw-medium">{{ $course->domain }}</span>
                                                    </div>
                                                @endif
                                                @if($course->qp_code)
                                                    <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                        <span>QP Code</span>
                                                        <span class="fw-medium">{{ $course->qp_code }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Eligibility Tab -->
                                <div class="tab-pane fade" id="eligibility" role="tabpanel">
                                    <div class="row g-4">
                                        @if($course->required_age)
                                            <div class="col-md-6">
                                                <div class="card border-0 bg-light h-100">
                                                    <div class="card-body text-center p-4">
                                                        <i class="bi bi-calendar-check display-4 text-primary mb-3"></i>
                                                        <h5>Required Age</h5>
                                                        <p class="mb-0 fw-medium">{{ $course->required_age }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if($course->minimum_education)
                                            <div class="col-md-6">
                                                <div class="card border-0 bg-light h-100">
                                                    <div class="card-body text-center p-4">
                                                        <i class="bi bi-mortarboard display-4 text-primary mb-3"></i>
                                                        <h5>Minimum Education</h5>
                                                        <p class="mb-0 fw-medium">{{ $course->minimum_education }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if($course->industry_experience)
                                            <div class="col-md-6">
                                                <div class="card border-0 bg-light h-100">
                                                    <div class="card-body text-center p-4">
                                                        <i class="bi bi-briefcase display-4 text-primary mb-3"></i>
                                                        <h5>Industry Experience</h5>
                                                        <p class="mb-0 fw-medium">{{ $course->industry_experience }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if($course->learning_tools)
                                            <div class="col-md-6">
                                                <div class="card border-0 bg-light h-100">
                                                    <div class="card-body text-center p-4">
                                                        <i class="bi bi-tools display-4 text-primary mb-3"></i>
                                                        <h5>Learning Tools</h5>
                                                        <p class="mb-0 fw-medium">{{ $course->learning_tools }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    @if(!$course->required_age && !$course->minimum_education && !$course->industry_experience && !$course->learning_tools)
                                        <div class="alert alert-info text-center py-4">
                                            <i class="bi bi-info-circle display-4 text-primary mb-3"></i>
                                            <h5>No Specific Eligibility Requirements</h5>
                                            <p class="mb-0">This course is open to all interested learners.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">

                    <!-- Course Highlights -->
                    <div class="card shadow-sm border-0 rounded-4 overflow-hidden mb-4">
                        <div class="card-header bg-light py-3">
                            <h5 class="mb-0"><i class="bi bi-star me-2"></i>Course Highlights</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                @if($course->provider)
                                    <div class="list-group-item d-flex align-items-center">
                                        <i class="bi bi-building text-primary me-3 fs-5"></i>
                                        <div>
                                            <h6 class="mb-0">Training Partner</h6>
                                            <small class="text-muted">{{ $course->provider }}</small>
                                        </div>
                                    </div>
                                @endif

                                @if($course->certification_type)
                                    <div class="list-group-item d-flex align-items-center">
                                        <i class="bi bi-award text-primary me-3 fs-5"></i>
                                        <div>
                                            <h6 class="mb-0">Certification</h6>
                                            <small class="text-muted">{{ $course->certification_type }}</small>
                                        </div>
                                    </div>
                                @endif

                                @if($course->duration)
                                    <div class="list-group-item d-flex align-items-center">
                                        <i class="bi bi-clock text-primary me-3 fs-5"></i>
                                        <div>
                                            <h6 class="mb-0">Duration</h6>
                                            <small class="text-muted">{{ $course->duration }} Minutes</small>
                                        </div>
                                    </div>
                                @endif

                                @if($course->paid_type)
                                    <div class="list-group-item d-flex align-items-center">
                                        <i class="bi bi-currency-dollar text-primary me-3 fs-5"></i>
                                        <div>
                                            <h6 class="mb-0">Pricing</h6>
                                            <small class="text-muted">
                                                @if($course->paid_type == 'Free')
                                                    Free Course
                                                @else
                                                    Paid Course
                                                @endif
                                            </small>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Enquiry Form -->
                    <div class="card shadow-sm border-0 rounded-4 overflow-hidden mb-4">
                        <div class="card-header bg-primary text-white py-3">
                            <h5 class="mb-0"><i class="bi bi-info-circle me-2 text-white"></i>Request Information</h5>
                        </div>
                        <div class="card-body p-4">
                            <form class="needs-validation" action="{{ route('web.enquiry') }}" method="POST" novalidate>
                                @csrf
                                <input type="hidden" name="type" value="7">
                                <input type="hidden" name="course_name" value="{{ $course->name }}">

                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           placeholder="Enter your full name" required minlength="2" maxlength="255">
                                    <div class="invalid-feedback">Please provide a valid name (2-255 characters).</div>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                           placeholder="Enter your email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                                    <div class="invalid-feedback">Please provide a valid email address.</div>
                                </div>

                                <div class="mb-3">
                                    <label for="mobile" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" id="mobile" name="mobile"
                                           placeholder="Enter your phone number" required pattern="[0-9]{10,15}">
                                    <div class="invalid-feedback">Please provide a valid phone number (10-15 digits).</div>
                                </div>

                                <div class="mb-3">
                                    <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="message" name="message" rows="3"
                                              placeholder="Enter your message" required maxlength="1000"></textarea>
                                    <div class="invalid-feedback">Please enter your message (max 1000 characters).</div>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 py-2">
                                    <i class="bi bi-send me-2"></i>Submit Enquiry
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Sectors -->
                    <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                        <div class="card-header bg-light py-3">
                            <h5 class="mb-0"><i class="bi bi-grid me-2"></i>Explore Sectors</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-wrap gap-2">
                                @forelse($sectors as $sector)
                                    <a href="{{ route('web.sector') }}" class="badge bg-primary text-decoration-none px-3 py-2">
                                        {{ $sector->name ?? 'Sector' }}
                                    </a>
                                @empty
                                    <p class="text-muted mb-0">No sectors available at the moment.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                     <!-- Related Programs -->
                    <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                        <div class="card-header bg-primary text-white py-3">
                            <h4 class="mb-0"><i class="bi bi-collection-play me-2"></i>Related Programs</h4>
                        </div>
                        <div class="card-body p-4">
                            @if($programes->isNotEmpty())
                                <div class="row g-4">
                                    @foreach($programes as $program)
                                        <div class="col-md-12">
                                            <div class="card border-0 shadow-sm h-100">
                                                <div class="card-img-top overflow-hidden">
                                                    <img src="{{ $program->image ? asset($program->image) : asset('resource/web/assets/media/default/default-img.png') }}"
                                                         alt="{{ $program->title }}" class="img-fluid w-100" style="height: 180px; object-fit: cover;">
                                                </div>
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ Str::limit($program->title, 50) }}</h5>
                                                    <p class="card-text text-muted small">
                                                        {{ Str::limit(strip_tags($program->description), 100) }}
                                                    </p>
                                                </div>
                                                <div class="card-footer bg-transparent border-0 pt-0">
                                                    <a href="{{ route('web.announcement.program', [$program->category->slug, $program->slug]) }}"
                                                       class="btn btn-outline-primary btn-sm">View Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="alert alert-info text-center py-4">
                                    <i class="bi bi-info-circle display-4 text-primary mb-3"></i>
                                    <h5>No Related Programs</h5>
                                    <p class="mb-0">Check back later for related programs.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Ongoing Projects Section -->
    <section class="ongoing-projects py-5 bg-light">
        <div class="container-fluid">
            <div class="row mb-5">
                <div class="col-12">
                    <div class="text-center">
                        <span class="badge bg-primary text-white px-3 py-2 rounded-pill mb-3">
                            <i class="bi bi-lightbulb me-1"></i> Ongoing Projects
                        </span>
                        <h2 class="fw-bold mb-3">{{ $settings->on_going_project_main_title ?? 'Our Ongoing Projects' }}</h2>
                        <p class="lead text-muted mx-auto" style="max-width: 600px;">
                            {{ $settings->onging_final_titles ?? 'Explore our current initiatives and projects' }}
                        </p>
                    </div>
                </div>
            </div>

            @if($ongoingProjects->isEmpty())
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-warning text-center py-4">
                            <i class="bi bi-exclamation-triangle display-4 text-warning mb-3"></i>
                            <h4>No Projects Available</h4>
                            <p class="mb-0">Please check back later for ongoing projects.</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="row g-4">
                    @foreach($ongoingProjects as $project)
                        <div class="col-md-6 col-lg-4">
                            <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                                <div class="card-img-top position-relative overflow-hidden">
                                    <img src="{{ asset($project->image) }}" alt="{{ $project->title }}"
                                         class="img-fluid w-100" style="height: 220px; object-fit: cover;">
                                    <div class="position-absolute top-0 end-0 m-3">
                                        <span class="badge bg-primary">{{ $project->category->name ?? 'Project' }}</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $project->title }}</h5>
                                    <p class="card-text text-muted">
                                        {{ Str::limit(strip_tags($project->description), 120) }}
                                    </p>
                                </div>
                                <div class="card-footer bg-transparent border-0 pt-0">
                                    <a href="{{ route('web.ongoging.project', [$project->category->slug, $project->slug]) }}"
                                       class="btn btn-primary btn-sm">
                                        View Details <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection

@push('styles')
<style>
    .course-hero {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }

    .min-vh-50 {
        min-height: 50vh;
    }

    .course-image-wrapper {
        transition: transform 0.3s ease;
    }

    .course-image-wrapper:hover {
        transform: translateY(-5px);
    }

    .nav-tabs .nav-link {
        color: #6c757d;
        border: none;
        position: relative;
    }

    .nav-tabs .nav-link.active {
        color: #0d6efd;
        background: transparent;
        border: none;
    }

    .nav-tabs .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: #0d6efd;
    }

    .accordion-button:not(.collapsed) {
        background-color: #f8f9fa;
        color: #0d6efd;
        box-shadow: none;
    }

    .accordion-button:focus {
        box-shadow: none;
        border-color: rgba(0,0,0,.125);
    }

    .card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }

    @media (max-width: 768px) {
        .display-5 {
            font-size: 2rem;
        }

        .hero-content {
            text-align: center;
        }

        .nav-tabs .nav-link {
            font-size: 0.9rem;
            padding: 0.75rem 0.5rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Form validation
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })

        // Mobile number sanitization
        document.querySelectorAll('input[name="mobile"]').forEach(function(input) {
            input.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        });
    })()
</script>
@endpush
