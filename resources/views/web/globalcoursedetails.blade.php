@push('meta')
    <title>{{ $course->course_title ?? 'International Course' }} - ISICO</title>
    <meta name="description" content="{{ Str::limit(strip_tags($course->short_description ?? ''), 150) }}">
    <meta name="keywords" content="{{ $course->seo_keywords ?? 'international course, study abroad, education' }}">
    <meta name="author" content="ISICO">
    <meta name="robots" content="index, follow">

    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:title" content="{{ $course->course_title ?? 'International Course' }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($course->short_description ?? ''), 150) }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset($course->thumbnail_image ?? 'default.jpg') }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $course->course_title ?? 'International Course' }}">
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($course->short_description ?? ''), 150) }}">
    <meta name="twitter:image" content="{{ asset($course->thumbnail_image ?? 'default.jpg') }}">
@endpush

@extends('layouts.web.app')
@section('content')
    <!-- Hero Banner -->
    <section class="sm-title-banner py-5 py-lg-120 mb-5 mb-lg-120"
        style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('{{ asset($course->thumbnail_image ?? 'default-course-banner.jpg') }}') center/cover no-repeat;">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-12 col-lg-8 mb-4 mb-lg-0">
                    <div class="text-white">
                        <span class="badge bg-warning text-dark mb-3">{{ $course->pathway_type ?? 'International Course' }}</span>
                        <h1 class="fw-bold mb-3 display-6 display-lg-5 text-shadow text-white">{{ $course->course_title }}</h1>
                        <p class="lead mb-4 text-shadow text-white">{{ $course->short_description }}</p>

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
                                <span class="small fw-medium">{{ $course->category->name ?? 'Professional' }}</span>
                            </div>
                            <div class="d-flex align-items-center gap-2 bg-dark bg-opacity-50 px-2 px-lg-3 py-1 py-lg-2 rounded-pill">
                                <i class="bi bi-building-fill text-warning fs-6"></i>
                                <span class="small fw-medium">{{ $course->overseas_partner_institution }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="bg-white rounded-3 p-3 p-lg-4 shadow-lg">
                        <h5 class="fw-bold mb-3">Quick Details</h5>

                        <div class="d-flex justify-content-between align-items-center mb-2 py-1">
                            <span class="text-muted small">Course Code:</span>
                            <span class="fw-bold text-primary small">{{ $course->course_code }}</span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-2 py-1">
                            <span class="text-muted small">Pathway Type:</span>
                            <span class="fw-bold small">{{ $course->pathway_type }}</span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-2 py-1">
                            <span class="text-muted small">Language:</span>
                            <span class="fw-bold small">
                                @if($course->language_of_instruction)
                                    {{ implode(', ', $course->language_of_instruction) }}
                                @else
                                    English
                                @endif
                            </span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-2 py-1">
                            <span class="text-muted small">Study Mode:</span>
                            <span class="fw-bold small">
                                @if($course->mode_of_study)
                                    {{ implode(', ', $course->mode_of_study) }}
                                @else
                                    Flexible
                                @endif
                            </span>
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
                            <div class="col-12 col-sm-6 mb-3">
                                <label class="fw-semibold text-muted small">Admission Provider:</label>
                                <p class="mb-0">{{ $course->admission_provider }}</p>
                            </div>

                            <div class="col-12 col-sm-6 mb-3">
                                <label class="fw-semibold text-muted small">Partner Institution:</label>
                                <p class="mb-0">{{ $course->overseas_partner_institution }}</p>
                            </div>

                            @if($course->accreditation_recognition)
                            <div class="col-12 col-sm-6 mb-3">
                                <label class="fw-semibold text-muted small">Accreditation:</label>
                                <p class="mb-0">{{ $course->accreditation_recognition }}</p>
                            </div>
                            @endif

                            <div class="col-12 col-sm-6 mb-3">
                                <label class="fw-semibold text-muted small">Certification:</label>
                                <p class="mb-0">{{ $course->certification_type }}</p>
                            </div>
                        </div>

                        <div class="mt-3 mt-lg-4">
                            {!! $course->course_details !!}
                        </div>
                    </div>
                </div>

                <!-- Key Information Tabs -->
                <div class="card shadow-sm border-0">
                    <div class="card-body p-3 p-lg-4">
                        <ul class="nav nav-pills flex-nowrap overflow-auto pb-2 mb-3 mb-lg-4" id="courseTabs" role="tablist" style="scrollbar-width: none; -ms-overflow-style: none;">
                            <li class="nav-item flex-shrink-0" role="presentation">
                                <button class="nav-link active small" id="topics-tab" data-bs-toggle="pill" data-bs-target="#topics" type="button">Curriculum</button>
                            </li>
                            <li class="nav-item flex-shrink-0" role="presentation">
                                <button class="nav-link small" id="eligibility-tab" data-bs-toggle="pill" data-bs-target="#eligibility" type="button">Eligibility</button>
                            </li>
                            <li class="nav-item flex-shrink-0" role="presentation">
                                <button class="nav-link small" id="fees-tab" data-bs-toggle="pill" data-bs-target="#fees" type="button">Fees & Duration</button>
                            </li>
                            <li class="nav-item flex-shrink-0" role="presentation">
                                <button class="nav-link small" id="career-tab" data-bs-toggle="pill" data-bs-target="#career" type="button">Career Outcomes</button>
                            </li>
                        </ul>

                        <div class="tab-content" id="courseTabsContent">
                            <!-- Curriculum Tab -->
                            <div class="tab-pane fade show active" id="topics" role="tabpanel">
                                @if($course->topics_syllabus && count($course->topics_syllabus) > 0)
                                    <div class="accordion" id="topicsAccordion">
                                        @foreach($course->topics_syllabus as $index => $topic)
                                            <div class="accordion-item border-0 mb-2">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed bg-light py-3" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#topic{{ $index }}">
                                                        <i class="bi bi-bookmark-plus-fill text-primary me-2"></i>
                                                        <span class="text-start">{{ $topic['module_title'] ?? 'Module ' . ($index + 1) }}</span>
                                                    </button>
                                                </h2>
                                                <div id="topic{{ $index }}" class="accordion-collapse collapse"
                                                    data-bs-parent="#topicsAccordion">
                                                    <div class="accordion-body py-3">
                                                        {{ $topic['outline'] ?? 'No description available.' }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-4">
                                        <i class="bi bi-journal-x display-1 text-muted"></i>
                                        <p class="text-muted mt-3">Curriculum details coming soon.</p>
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
                                                        <h6 class="fw-bold mb-1">Minimum Age</h6>
                                                        <p class="mb-0 text-muted">{{ $course->minimum_age ?? 'Not specified' }}+ Years</p>
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
                                                        <h6 class="fw-bold mb-1">Work Experience</h6>
                                                        <p class="mb-0 text-muted">
                                                            {{ $course->work_experience_required ? ($course->work_experience_details ?? 'Required') : 'Not Required' }}
                                                        </p>
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
                                                        <p class="mb-0 text-muted">{{ $course->language_proficiency ?? 'Not specified' }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Fees & Duration Tab -->
                            <div class="tab-pane fade" id="fees" role="tabpanel">
                                <div class="row">
                                    <div class="col-12 col-sm-6 mb-3">
                                        <label class="fw-semibold text-muted small">Overseas Duration:</label>
                                        <p class="mb-0">{{ $course->course_duration_overseas }}</p>
                                    </div>

                                    <div class="col-12 col-sm-6 mb-3">
                                        <label class="fw-semibold text-muted small">Total Duration:</label>
                                        <p class="mb-0">{{ $course->total_duration }}</p>
                                    </div>

                                    @if($course->internship_included)
                                    <div class="col-12 col-sm-6 mb-3">
                                        <label class="fw-semibold text-muted small">Internship Duration:</label>
                                        <p class="mb-0">{{ $course->internship_duration ?? 'Included' }}</p>
                                    </div>
                                    @endif

                                    @if($course->local_training)
                                    <div class="col-12 col-sm-6 mb-3">
                                        <label class="fw-semibold text-muted small">Local Training:</label>
                                        <p class="mb-0">{{ $course->local_training_duration ?? 'Included' }}</p>
                                    </div>
                                    @endif

                                    @if($course->total_fees)
                                    <div class="col-12 mb-3">
                                        <label class="fw-semibold text-muted small">Total Fees:</label>
                                        <p class="mb-0 h5 text-primary">{{ $course->total_fees }}</p>
                                    </div>
                                    @endif

                                    @if($course->scholarship_available)
                                    <div class="col-12 mb-3">
                                        <label class="fw-semibold text-muted small">Scholarship:</label>
                                        <p class="mb-0 text-success">{{ $course->scholarship_notes ?? 'Available' }}</p>
                                    </div>
                                    @endif

                                    @if($course->bank_loan_assistance)
                                    <div class="col-12 mb-3">
                                        <label class="fw-semibold text-muted small">Loan Assistance:</label>
                                        <p class="mb-0 text-info">{{ $course->loan_assistance_notes ?? 'Available' }}</p>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Career Outcomes Tab -->
                            <div class="tab-pane fade" id="career" role="tabpanel">
                                @if($course->career_outcomes && count($course->career_outcomes) > 0)
                                    <div class="mb-4">
                                        <h6 class="fw-bold mb-3">Career Opportunities</h6>
                                        <div class="row">
                                            @foreach($course->career_outcomes as $outcome)
                                                <div class="col-12 col-sm-6 mb-2">
                                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                                    <span class="small">{{ $outcome }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                @if($course->next_pathways && count($course->next_pathways) > 0)
                                    <div class="mb-4">
                                        <h6 class="fw-bold mb-3">Further Education Pathways</h6>
                                        <div class="row">
                                            @foreach($course->next_pathways as $pathway)
                                                <div class="col-12 mb-2">
                                                    <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i>
                                                    <span class="small">{{ $pathway }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Information -->
                @if($course->visa_notes || $course->accommodation_notes)
                <div class="card shadow-sm border-0 mt-4">
                    <div class="card-body p-3 p-lg-4">
                        <h4 class="fw-bold mb-3 mb-lg-4">Support Services</h4>

                        <div class="row">
                            @if($course->visa_support_included && $course->visa_notes)
                            <div class="col-12 mb-4">
                                <h5 class="fw-semibold mb-2 mb-lg-3">
                                    <i class="bi bi-passport text-primary me-2"></i>Visa Support
                                </h5>
                                <div class="bg-light p-3 p-lg-4 rounded">
                                    {!! $course->visa_notes !!}
                                </div>
                            </div>
                            @endif

                            @if($course->accommodation_support && $course->accommodation_notes)
                            <div class="col-12">
                                <h5 class="fw-semibold mb-2 mb-lg-3">
                                    <i class="bi bi-house-door text-success me-2"></i>Accommodation Support
                                </h5>
                                <div class="bg-light p-3 p-lg-4 rounded">
                                    {!! $course->accommodation_notes !!}
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
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
                            <input type="hidden" name="course_name" value="{{ $course->course_title }}">

                            <div class="mb-3">
                                <input type="text" class="form-control form-control-sm" name="name" placeholder="Your Name" required>
                            </div>

                            <div class="mb-3">
                                <input type="email" class="form-control form-control-sm" name="email" placeholder="Your Email">
                            </div>

                            <div class="mb-3">
                                <input type="tel" class="form-control form-control-sm" name="mobile" placeholder="Phone Number" required>
                            </div>

                            <div class="mb-3">
                                <textarea class="form-control form-control-sm" name="message" rows="3" placeholder="Your Message" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 btn-sm">Submit Enquiry</button>
                        </form>
                    </div>
                </div>

                <!-- Related Courses -->
                @if($otherCourses->count() > 0)
                <div class="card shadow-sm border-0">
                    <div class="card-body p-3 p-lg-4">
                        <h5 class="card-title fw-bold mb-3">Related Courses</h5>
                        @foreach($otherCourses as $relatedCourse)
                            <div class="related-course-item mb-3">
                                @if($relatedCourse->thumbnail_image)
                                    <img src="{{ asset($relatedCourse->thumbnail_image) }}" alt="{{ $relatedCourse->course_title }}" class="related-course-img">
                                @else
                                    <div class="related-course-img bg-light d-flex align-items-center justify-content-center">
                                        <i class="bi bi-book text-muted"></i>
                                    </div>
                                @endif
                                <div class="related-course-info">
                                    <a href="{{ route('web.global.course.show', $relatedCourse->slug) }}" class="fw-semibold text-dark small">
                                        {{ Str::limit($relatedCourse->course_title, 35) }}
                                    </a>
                                    <small class="text-muted d-block">{{ $relatedCourse->country->name ?? 'International' }}</small>
                                    <small class="text-primary d-block">{{ $relatedCourse->course_duration_overseas }}</small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('styles')
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
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 6px;
            flex-shrink: 0;
        }

        .related-course-info {
            flex: 1;
        }

        .text-shadow {
            text-shadow: 2px 2px 4px rgba(0,0,0,0.8);
        }

        @media (max-width: 575.98px) {
            .display-6 {
                font-size: 1.5rem !important;
            }
        }
    </style>
@endpush
