@push('meta')
    <title>{{ $metaTitle ?? ($course->name ?? 'International Course') }}</title>
    <meta name="description"
        content="{{ $metaDescription ?? Str::limit(strip_tags($course->short_description ?? ''), 150) }}">
    <meta name="keywords" content="{{ $metaKeywords ?? 'international course, education, study abroad' }}">
    <meta name="author" content="{{ $metaAuthor ?? 'YourSiteName' }}">
    <meta name="robots" content="{{ $metaRobots ?? 'index, follow' }}">

    <!-- Canonical Tag -->
    <link rel="canonical" href="{{ $metaCanonical ?? url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:title" content="{{ $metaOgTitle ?? ($course->name ?? 'International Course') }}">
    <meta property="og:description"
        content="{{ $metaOgDescription ?? Str::limit(strip_tags($course->short_description ?? ''), 150) }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $metaOgUrl ?? url()->current() }}">
    <meta property="og:image" content="{{ $metaOgImage ?? asset($course->image ?? 'default.jpg') }}">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $metaTwitterTitle ?? ($course->name ?? 'International Course') }}">
    <meta name="twitter:description"
        content="{{ $metaTwitterDescription ?? Str::limit(strip_tags($course->short_description ?? ''), 150) }}">
    <meta name="twitter:image" content="{{ $metaTwitterImage ?? asset($course->image ?? 'default.jpg') }}">
@endpush

@extends('layouts.web.app')
@section('content')
    <!-- Hero Banner -->
    <section class="sm-title-banner py-5 py-lg-120 mb-5 mb-lg-120"
        style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('{{ asset($course->image) }}') center/cover no-repeat;">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-12 col-lg-8 mb-4 mb-lg-0">
                    <div class="text-white">
                        <span
                            class="badge bg-warning text-dark mb-3">{{ $course->pathway_type ? ucfirst(str_replace('_', ' ', $course->pathway_type)) : 'International Course' }}</span>
                        <h1 class="fw-bold mb-3 display-6 display-lg-5 text-shadow">{{ $course->course_name }}</h1>
                        <p class="lead mb-4 text-shadow">{{ $course->short_description }}</p>

                        <div class="d-flex flex-wrap align-items-center gap-3 gap-lg-4 text-white">
                            <div class="d-flex align-items-center gap-2 bg-dark bg-opacity-50 px-2 px-lg-3 py-1 py-lg-2 rounded-pill">
                                <i class="bi bi-geo-alt-fill text-warning fs-6"></i>
                                <span class="small fw-medium">{{ $course->country->name ?? 'Multiple Locations' }}</span>
                            </div>
                            <div class="d-flex align-items-center gap-2 bg-dark bg-opacity-50 px-2 px-lg-3 py-1 py-lg-2 rounded-pill">
                                <i class="bi bi-clock-fill text-warning fs-6"></i>
                                <span class="small fw-medium">{{ $course->total_duration ?? 'Flexible Duration' }}</span>
                            </div>
                            <div class="d-flex align-items-center gap-2 bg-dark bg-opacity-50 px-2 px-lg-3 py-1 py-lg-2 rounded-pill">
                                <i class="bi bi-mortarboard-fill text-warning fs-6"></i>
                                <span class="small fw-medium">{{ $course->level }}</span>
                            </div>
                            @if ($course->partner)
                                <div class="d-flex align-items-center gap-2 bg-dark bg-opacity-50 px-2 px-lg-3 py-1 py-lg-2 rounded-pill">
                                    <i class="bi bi-building-fill text-warning fs-6"></i>
                                    <span class="small fw-medium">{{ $course->partner }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="bg-white rounded-3 p-3 p-lg-4 shadow-lg">
                        <h5 class="fw-bold mb-3">Quick Details</h5>

                        @if ($course->isico_course_code)
                            <div class="d-flex justify-content-between align-items-center mb-2 py-1">
                                <span class="text-muted small">Course Code:</span>
                                <span class="fw-bold text-primary small">{{ $course->isico_course_code }}</span>
                            </div>
                        @endif

                        <div class="d-flex justify-content-between align-items-center mb-2 py-1">
                            <span class="text-muted small">Pathway Type:</span>
                            <span class="fw-bold small">{{ $course->pathway_type ? ucfirst(str_replace('_', ' ', $course->pathway_type)) : 'N/A' }}</span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-2 py-1">
                            <span class="text-muted small">Language:</span>
                            <span class="fw-bold small">{{ $course->language_instruction }}</span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-2 py-1">
                            <span class="text-muted small">Study Mode:</span>
                            <span class="fw-bold small">{{ $course->provider }}</span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3 py-1">
                            <span class="text-muted small">Fee Type:</span>
                            <span class="badge {{ $course->paid_type == 'Free' ? 'bg-success' : 'bg-warning text-dark' }} small">
                                {{ $course->paid_type }}
                            </span>
                        </div>

                        <button class="btn btn-primary w-100 btn-lg">Enroll Now</button>
                        <button class="btn btn-outline-primary w-100 mt-2">Download Brochure</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container mt-4 mt-lg-5">
        <div class="row g-4 g-lg-5">
            <!-- Left Content -->
            <div class="col-12 col-lg-8">
                <!-- Course Overview -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-3 p-lg-4">
                        <h3 class="card-title fw-bold mb-3 mb-lg-4">Course Overview</h3>
                        <div class="row">
                            @if ($course->admin_provider)
                                <div class="col-12 col-sm-6 mb-3">
                                    <label class="fw-semibold text-muted small">Admission Provider:</label>
                                    <p class="mb-0">{{ $course->admin_provider }}</p>
                                </div>
                            @endif

                            @if ($course->accreditation_recognition)
                                <div class="col-12 col-sm-6 mb-3">
                                    <label class="fw-semibold text-muted small">Accreditation:</label>
                                    <p class="mb-0">{{ $course->accreditation_recognition }}</p>
                                </div>
                            @endif

                            @if ($course->learning_product_type)
                                <div class="col-12 col-sm-6 mb-3">
                                    <label class="fw-semibold text-muted small">Learning Product:</label>
                                    <p class="mb-0">{{ $course->learning_product_type }}</p>
                                </div>
                            @endif

                            @if ($course->certification_type)
                                <div class="col-12 col-sm-6 mb-3">
                                    <label class="fw-semibold text-muted small">Certification:</label>
                                    <p class="mb-0">{{ $course->certification_type }}</p>
                                </div>
                            @endif
                        </div>

                        <div class="mt-3 mt-lg-4">
                            {!! $course->long_description !!}
                        </div>
                    </div>
                </div>

                <!-- Key Information Tabs -->
                <div class="card shadow-sm border-0">
                    <div class="card-body p-3 p-lg-4">
                        <ul class="nav nav-pills flex-nowrap overflow-auto pb-2 mb-3 mb-lg-4" id="courseTabs" role="tablist" style="scrollbar-width: none; -ms-overflow-style: none;">
                            <li class="nav-item flex-shrink-0" role="presentation">
                                <button class="nav-link active small" id="topics-tab" data-bs-toggle="pill"
                                    data-bs-target="#topics" type="button">Topics</button>
                            </li>
                            <li class="nav-item flex-shrink-0" role="presentation">
                                <button class="nav-link small" id="eligibility-tab" data-bs-toggle="pill"
                                    data-bs-target="#eligibility" type="button">Eligibility</button>
                            </li>
                            <li class="nav-item flex-shrink-0" role="presentation">
                                <button class="nav-link small" id="logistics-tab" data-bs-toggle="pill"
                                    data-bs-target="#logistics" type="button">Logistics</button>
                            </li>
                            <li class="nav-item flex-shrink-0" role="presentation">
                                <button class="nav-link small" id="pathway-tab" data-bs-toggle="pill"
                                    data-bs-target="#pathway" type="button">Career</button>
                            </li>
                        </ul>

                        <div class="tab-content" id="courseTabsContent">
                            <!-- Topics Tab -->
                            <div class="tab-pane fade show active" id="topics" role="tabpanel">
                                @php
                                    $topics = json_decode($course->topics, true) ?? [];
                                @endphp

                                @if (count($topics) > 0)
                                    <div class="accordion" id="topicsAccordion">
                                        @foreach ($topics as $index => $topic)
                                            <div class="accordion-item border-0 mb-2">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed bg-light py-3" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#topic{{ $index }}">
                                                        <i class="bi bi-bookmark-plus-fill text-primary me-2"></i>
                                                        <span class="text-start">{{ $topic['title'] ?? 'Topic ' . ($index + 1) }}</span>
                                                    </button>
                                                </h2>
                                                <div id="topic{{ $index }}" class="accordion-collapse collapse"
                                                    data-bs-parent="#topicsAccordion">
                                                    <div class="accordion-body py-3">
                                                        {{ $topic['description'] ?? 'No description available.' }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-4">
                                        <i class="bi bi-journal-x display-1 text-muted"></i>
                                        <p class="text-muted mt-3">No topics available for this course.</p>
                                    </div>
                                @endif
                            </div>

                            <!-- Eligibility Tab -->
                            <div class="tab-pane fade" id="eligibility" role="tabpanel">
                               <div class="row">
    <div class="col-12 col-sm-6">
        <div class="card border-0 bg-light h-100 hover-card">
            <div class="card-body">
                <div class="d-flex align-items-start">
                    <div class="flex-shrink-0 me-3">
                        <i class="bi bi-calendar2-check text-primary fs-4"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="fw-bold mb-1">Required Age</h6>
                        <p class="mb-0 text-muted">{{ $course->required_age ?? 'Not specified' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6">
        <div class="card border-0 bg-light h-100 hover-card">
            <div class="card-body">
                <div class="d-flex align-items-start">
                    <div class="flex-shrink-0 me-3">
                        <i class="bi bi-mortarboard text-success fs-4"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="fw-bold mb-1">Minimum Education</h6>
                        <p class="mb-0 text-muted">{{ $course->minimum_education ?? 'Not specified' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6">
        <div class="card border-0 bg-light h-100 hover-card">
            <div class="card-body">
                <div class="d-flex align-items-start">
                    <div class="flex-shrink-0 me-3">
                        <i class="bi bi-briefcase text-warning fs-4"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="fw-bold mb-1">Industry Experience</h6>
                        <p class="mb-0 text-muted">{{ $course->industry_experience ?? 'Not specified' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6">
        <div class="card border-0 bg-light h-100 hover-card">
            <div class="card-body">
                <div class="d-flex align-items-start">
                    <div class="flex-shrink-0 me-3">
                        <i class="bi bi-translate text-info fs-4"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="fw-bold mb-1">Language Proficiency</h6>
                        <p class="mb-0 text-muted">{{ $course->language_proficiency_requirement ?? 'Not specified' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if ($course->learning_tools)
<div class="mt-4">
    <div class="card border-0 bg-light hover-card">
        <div class="card-body">
            <div class="d-flex align-items-start">
                <div class="flex-shrink-0 me-3">
                    <i class="bi bi-tools text-purple fs-4"></i>
                </div>
                <div class="flex-grow-1">
                    <h6 class="fw-bold mb-2">Learning Tools</h6>
                    <p class="mb-0 text-muted">{{ $course->learning_tools }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<style>
.hover-card {
    transition: all 0.3s ease;
    border: 1px solid transparent;
}

.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    border-color: rgba(0, 0, 0, 0.125);
}

.text-purple {
    color: #6f42c1 !important;
}
</style>
                            </div>

                            <!-- Logistics & Costs Tab -->
                            <div class="tab-pane fade" id="logistics" role="tabpanel">
                                <div class="row">
                                    @if ($course->duration_local)
                                        <div class="col-12 col-sm-6 mb-3">
                                            <label class="fw-semibold text-muted small">Local Duration:</label>
                                            <p class="mb-0">{{ $course->duration_local }}</p>
                                        </div>
                                    @endif

                                    @if ($course->duration_overseas)
                                        <div class="col-12 col-sm-6 mb-3">
                                            <label class="fw-semibold text-muted small">Overseas Duration:</label>
                                            <p class="mb-0">{{ $course->duration_overseas }}</p>
                                        </div>
                                    @endif

                                    @if ($course->fee_structure)
                                        <div class="col-12 col-sm-6 mb-3">
                                            <label class="fw-semibold text-muted small">Fee Structure:</label>
                                            <p class="mb-0">{{ $course->fee_structure }}</p>
                                        </div>
                                    @endif

                                    @if ($course->scholarship_funding)
                                        <div class="col-12 col-sm-6 mb-3">
                                            <label class="fw-semibold text-muted small">Scholarship:</label>
                                            <p class="mb-0">{{ $course->scholarship_funding }}</p>
                                        </div>
                                    @endif

                                    @if ($course->accommodation_cost)
                                        <div class="col-12 col-sm-6 mb-3">
                                            <label class="fw-semibold text-muted small">Accommodation:</label>
                                            <p class="mb-0">{{ $course->accommodation_cost }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Career Pathway Tab -->
                            <div class="tab-pane fade" id="pathway" role="tabpanel">
                                @if ($course->next_degree)
                                    <div class="mb-3">
                                        <h6 class="fw-bold">Next Degree/Diploma Options</h6>
                                        <p class="mb-0">{{ $course->next_degree }}</p>
                                    </div>
                                @endif

                                @php
                                    $career_outcomes = json_decode($course->career_outcomes, true) ?? [];
                                @endphp

                                @if (count($career_outcomes) > 0)
                                    <div>
                                        <h6 class="fw-bold">Career Outcomes</h6>
                                        <div class="row">
                                            @foreach ($career_outcomes as $outcome)
                                                <div class="col-12 col-sm-6 mb-2">
                                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                                    <span class="small">{{ $outcome }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                @if ($course->international_recognition)
                                    <div class="mt-3">
                                        <h6 class="fw-bold">International Recognition</h6>
                                        <p class="mb-0">{{ $course->international_recognition }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="card shadow-sm border-0 mt-4">
                    <div class="card-body p-3 p-lg-4">
                        <h4 class="fw-bold mb-3 mb-lg-4">Additional Information</h4>

                        <div class="row">
                            @if ($course->visa_proccess)
                                <div class="col-12 mb-4">
                                    <h5 class="fw-semibold mb-2 mb-lg-3">Visa Process</h5>
                                    <div class="bg-light p-3 p-lg-4 rounded">
                                        {!! $course->visa_proccess !!}
                                    </div>
                                </div>
                            @endif

                            @if ($course->other_info)
                                <div class="col-12">
                                    <h5 class="fw-semibold mb-2 mb-lg-3">Important Updates</h5>
                                    <div class="bg-light p-3 p-lg-4 rounded">
                                        {!! $course->other_info !!}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-12 col-lg-4">
                <!-- Contact Form -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-3 p-lg-4">
                        <h5 class="card-title fw-bold mb-3">Request Information</h5>
                        <form class="search-form" action="{{ route('web.enquiry') }}" method="POST" novalidate>
                            @csrf
                            <input type="hidden" name="type" value="7">
                            <input type="hidden" name="course_name" value="{{ $course->course_name }}">

                            <div class="mb-3">
                                <input type="text" class="form-control form-control-sm" name="name" placeholder="Your Name"
                                    required>
                            </div>

                            <div class="mb-3">
                                <input type="email" class="form-control form-control-sm" name="email" placeholder="Your Email">
                            </div>

                            <div class="mb-3">
                                <input type="tel" class="form-control form-control-sm" name="mobile" placeholder="Phone Number"
                                    required>
                            </div>

                            <div class="mb-3">
                                <textarea class="form-control form-control-sm" name="message" rows="3" placeholder="Your Message" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 btn-sm">Submit Enquiry</button>
                        </form>
                    </div>
                </div>

                <!-- Course Details Sidebar -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-3 p-lg-4">
                        <h5 class="card-title fw-bold mb-3">Course Details</h5>

                        @if ($course->program_by)
                            <div class="detail-item mb-3 p-2 p-lg-3 bg-light rounded">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-building text-primary fs-6 me-2 me-lg-3"></i>
                                    <div>
                                        <small class="text-muted d-block">Program By</small>
                                        <p class="mb-0 fw-semibold small">{{ $course->program_by }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($course->initiative_of)
                            <div class="detail-item mb-3 p-2 p-lg-3 bg-light rounded">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-bullseye text-success fs-6 me-2 me-lg-3"></i>
                                    <div>
                                        <small class="text-muted d-block">Initiative Of</small>
                                        <p class="mb-0 fw-semibold small">{{ $course->initiative_of }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($course->program)
                            <div class="detail-item mb-3 p-2 p-lg-3 bg-light rounded">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-diagram-3 text-warning fs-6 me-2 me-lg-3"></i>
                                    <div>
                                        <small class="text-muted d-block">Program</small>
                                        <p class="mb-0 fw-semibold small">{{ $course->program }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($course->occupations)
                            <div class="detail-item mb-3 p-2 p-lg-3 bg-light rounded">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-people-fill text-info fs-6 me-2 me-lg-3"></i>
                                    <div>
                                        <small class="text-muted d-block">Occupations</small>
                                        <p class="mb-0 fw-semibold small">{{ $course->occupations }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($course->qp_code)
                            <div class="detail-item mb-3 p-2 p-lg-3 bg-light rounded">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-code-slash text-danger fs-6 me-2 me-lg-3"></i>
                                    <div>
                                        <small class="text-muted d-block">QP Code</small>
                                        <p class="mb-0 fw-semibold small">{{ $course->qp_code }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($course->nsqf_level)
                            <div class="detail-item mb-3 p-2 p-lg-3 bg-light rounded">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-layers text-secondary fs-6 me-2 me-lg-3"></i>
                                    <div>
                                        <small class="text-muted d-block">NSQF Level</small>
                                        <p class="mb-0 fw-semibold small">{{ $course->nsqf_level }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($course->credits_assigned)
                            <div class="detail-item mb-3 p-2 p-lg-3 bg-light rounded">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-journal-check text-dark fs-6 me-2 me-lg-3"></i>
                                    <div>
                                        <small class="text-muted d-block">Credits Assigned</small>
                                        <p class="mb-0 fw-semibold small">{{ $course->credits_assigned }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($course->assessment_mode)
                            <div class="detail-item p-2 p-lg-3 bg-light rounded">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-clipboard-check text-primary fs-6 me-2 me-lg-3"></i>
                                    <div>
                                        <small class="text-muted d-block">Assessment Mode</small>
                                        <p class="mb-0 fw-semibold small">{{ $course->assessment_mode }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Related Courses -->
                <div class="card shadow-sm border-0">
                    <div class="card-body p-3 p-lg-4">
                        <h5 class="card-title fw-bold mb-3">Related Courses</h5>
                        @forelse($otherCourses as $relatedCourse)
                            <div class="related-course-item mb-3">
                                <img src="{{ asset($relatedCourse->image) }}" alt="{{ $relatedCourse->course_name }}"
                                    class="related-course-img">
                                <div class="related-course-info">
                                    <a href="{{ route('web.global.course.show', $relatedCourse->slug) }}"
                                        class="fw-semibold text-dark small">
                                        {{ Str::limit($relatedCourse->course_name, 35) }}
                                    </a>
                                    <small class="text-muted d-block">{{ $relatedCourse->level }}</small>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted small">No related courses found.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Mobile First Responsive Design */
        .title-banner {
            position: relative;
        }

        .py-lg-120 {
            padding-top: 120px !important;
            padding-bottom: 120px !important;
        }

        .mb-lg-120 {
            margin-bottom: 120px !important;
        }

        @media (max-width: 991.98px) {
            .title-banner {
                padding-top: 80px !important;
                padding-bottom: 80px !important;
                margin-bottom: 60px !important;
            }

            .display-lg-5 {
                font-size: calc(1.375rem + 1.5vw) !important;
            }
        }

        @media (max-width: 767.98px) {
            .title-banner {
                padding-top: 60px !important;
                padding-bottom: 60px !important;
                margin-bottom: 40px !important;
            }
        }

        .text-shadow {
            text-shadow: 2px 2px 4px rgba(0,0,0,0.8);
        }

        /* Hide scrollbar for horizontal tabs */
        .nav-pills::-webkit-scrollbar {
            display: none;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 0;
        }

        .info-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #007bff;
        }

        .info-card i {
            font-size: 1.25rem;
        }

        .related-course-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .related-course-item:hover {
            background: #f8f9fa;
        }

        .related-course-img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 6px;
        }

        .related-course-info {
            flex: 1;
        }

        .accordion-button {
            border-radius: 8px !important;
            padding: 12px 16px;
        }

        .accordion-button:not(.collapsed) {
            background-color: #e7f1ff;
            color: #0d6efd;
        }

        .nav-pills .nav-link.active {
            background-color: #0d6efd;
            border-radius: 6px;
        }

        .nav-pills .nav-link {
            color: #6c757d;
            border-radius: 6px;
            margin-right: 8px;
            white-space: nowrap;
        }

        /* Responsive font sizes */
        @media (max-width: 575.98px) {
            .display-6 {
                font-size: 1.5rem !important;
            }

            .lead {
                font-size: 0.9rem !important;
            }

            .btn-lg {
                padding: 0.5rem 1rem !important;
                font-size: 0.9rem !important;
            }
        }
    </style>
@endpush
