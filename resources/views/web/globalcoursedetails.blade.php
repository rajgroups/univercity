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

@push('css')
<style>
    /* Modern Redesign Styles */
    .course-hero {
        position: relative;
        padding-top: 120px;
        padding-bottom: 120px;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
    .course-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.6) 100%);
    }
    
    .course-content-wrapper {
        margin-top: -80px; /* Overlap effect */
        position: relative;
        z-index: 10;
    }
    
    /* Sticky Sidebar */
    .sticky-sidebar {
        position: -webkit-sticky;
        position: sticky;
        top: 100px;
        z-index: 90;
    }
    
    .nav-tabs-modern {
        border-bottom: 1px solid #e9ecef;
    }
    .nav-tabs-modern .nav-link {
        border: none;
        color: #6c757d;
        font-weight: 600;
        padding: 1rem 1.5rem;
        position: relative;
        transition: all 0.3s ease;
    }
    .nav-tabs-modern .nav-link:hover {
        color: var(--bs-primary);
        background: transparent;
    }
    .nav-tabs-modern .nav-link.active {
        color: var(--bs-primary);
        background: transparent;
    }
    .nav-tabs-modern .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: var(--bs-primary);
        border-radius: 3px 3px 0 0;
    }
    
    .feature-icon-box {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 1.5rem;
    }
     .bg-purple { background-color: #6f42c1 !important; }
    .text-purple { color: #6f42c1 !important; }
    .bg-purple-subtle { background-color: rgba(111, 66, 193, 0.1) !important; color: #6f42c1 !important; }
    
    .accordion-modern .accordion-item {
        border: 1px solid #e9ecef;
        border-radius: 12px !important;
        margin-bottom: 1rem;
        overflow: hidden;
    }
    .accordion-modern .accordion-button {
        background-color: #fff;
        border-radius: 12px !important;
        font-weight: 600;
        box-shadow: none;
    }
    .accordion-modern .accordion-button:not(.collapsed) {
        background-color: #f8f9fa;
        color: var(--bs-primary);
    }
    .accordion-modern .accordion-body {
        background-color: #fcfcfc;
    }
    
    .hover-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.08) !important;
    }
</style>
@endpush

@section('content')
    <!-- Hero Banner -->
    <section class="course-hero d-flex align-items-center"
        style="background-image: url('{{ asset($course->thumbnail_image ?? 'default-course-banner.jpg') }}');">
        <div class="container position-relative text-white">
            <div class="row">
                <div class="col-lg-8">
                    <div class="mb-4 animate__animated animate__fadeInDown">
                        <span class="badge bg-white text-dark fw-bold px-3 py-2 rounded-pill mb-3">
                            <i class="bi bi-mortarboard-fill text-primary me-1"></i>
                            {{ $course->pathway_type ?? 'Global Pathway' }}
                        </span>
                        <h1 class="fw-bolder display-4 mb-3 text-white">{{ $course->course_title }}</h1>
                        <p class="lead opacity-90 mb-4 text-white">{{ $course->short_description }}</p>
                        
                        <div class="d-flex flex-wrap gap-2 gap-lg-4 text-white-50 small">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-geo-alt-fill text-warning me-2 fs-5"></i>
                                <span class="text-white fw-medium">{{ $course->country->name ?? 'Global' }}</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-building-fill text-warning me-2 fs-5"></i>
                                <span class="text-white fw-medium">{{ $course->sector->name ?? 'General' }}</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-award-fill text-warning me-2 fs-5"></i>
                                <span class="text-white fw-medium">{{ $course->category->name ?? 'Professional' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Area -->
    <section class="course-content-wrapper pb-5">
        <div class="container">
            <div class="row g-4">
                <!-- Left Details Column -->
                <div class="col-lg-8 order-2 order-lg-1">
                    <div class="bg-white rounded-4 shadow-sm p-4 p-md-5 mb-4">
                        <!-- Navigation Tabs -->
                        <ul class="nav nav-tabs-modern mb-4" id="courseTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#overview" type="button">Overview</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#curriculum" type="button">Curriculum</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#eligibility" type="button">Eligibility</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#fees" type="button">Fees</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#career" type="button">Outcomes</button>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <!-- Overview Tab -->
                            <div class="tab-pane fade show active" id="overview">
                                <h3 class="fw-bold mb-4 text-dark">About This Course</h3>
                                
                                <div class="row g-4 mb-5">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-start p-3 rounded-3 bg-light h-100">
                                            <div class="feature-icon-box bg-primary bg-opacity-10 text-primary me-3">
                                                <i class="bi bi-building"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted text-uppercase fw-bold">Provider</small>
                                                <h6 class="fw-bold mb-0 mt-1">{{ $course->admission_provider }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-start p-3 rounded-3 bg-light h-100">
                                            <div class="feature-icon-box bg-success bg-opacity-10 text-success me-3">
                                                <i class="bi bi-globe"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted text-uppercase fw-bold">Partner</small>
                                                <h6 class="fw-bold mb-0 mt-1">{{ $course->overseas_partner_institution }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Gallery Carousel -->
                                @if($course->gallery_images && count($course->gallery_images) > 0)
                                <div id="courseGalleryCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
                                    <div class="carousel-inner rounded-4 overflow-hidden">
                                        @foreach($course->gallery_images as $index => $image)
                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                            <img src="{{ asset($image) }}" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="Course Gallery Image">
                                        </div>
                                        @endforeach
                                    </div>
                                    @if(count($course->gallery_images) > 1)
                                    <button class="carousel-control-prev" type="button" data-bs-target="#courseGalleryCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#courseGalleryCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                    @endif
                                </div>
                                @endif

                                <div class="course-description text-secondary mb-5">
                                    {!! $course->course_details !!}
                                </div>

                                {{-- Program Structure (Internship & Local Training) --}}
                                @if($course->internship_included || $course->local_training)
                                <div class="mb-5">
                                    <h5 class="fw-bold mb-3">Program Structure</h5>
                                    <div class="row g-4">
                                        @if($course->internship_included)
                                        <div class="col-md-6">
                                            <div class="bg-light p-4 rounded-4 h-100">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="feature-icon-box bg-warning bg-opacity-10 text-warning me-3">
                                                        <i class="bi bi-briefcase"></i>
                                                    </div>
                                                    <h6 class="fw-bold mb-0">Internship Included</h6>
                                                </div>
                                                <p class="text-muted small mb-2">
                                                    <strong>Duration:</strong> {{ $course->internship_duration ?? 'Not specified' }}
                                                </p>
                                                @if($course->internship_summary)
                                                <p class="text-muted small mb-0">{{ $course->internship_summary }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        @endif

                                        @if($course->local_training)
                                        <div class="col-md-6">
                                            <div class="bg-light p-4 rounded-4 h-100">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="feature-icon-box bg-info bg-opacity-10 text-info me-3">
                                                        <i class="bi bi-laptop"></i>
                                                    </div>
                                                    <h6 class="fw-bold mb-0">Local Training</h6>
                                                </div>
                                                <p class="text-muted small mb-0">
                                                    <strong>Duration:</strong> {{ $course->local_training_duration ?? 'Not specified' }}
                                                </p>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endif
                                

                            </div>

                            <!-- Curriculum Tab -->
                            <div class="tab-pane fade" id="curriculum">
                                <h3 class="fw-bold mb-4 text-dark">Course Curriculum</h3>
                                @php
                                    $topics = $course->topics_syllabus ?? $course->topics;
                                @endphp
                                @if($topics && count($topics) > 0)
                                    <div class="accordion accordion-modern" id="topicsAccordion">
                                        @foreach($topics as $index => $topic)
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#topic{{ $index }}">
                                                        <span class="me-3 fw-bold text-muted">{{ sprintf('%02d', $index + 1) }}</span>
                                                        {{ $topic['module_title'] ?? 'Module ' . ($index + 1) }}
                                                    </button>
                                                </h2>
                                                <div id="topic{{ $index }}" class="accordion-collapse collapse" data-bs-parent="#topicsAccordion">
                                                    <div class="accordion-body">
                                                        {{ $topic['outline'] ?? 'Detailed syllabus available in brochure.' }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="alert alert-light text-center py-4">
                                        <i class="bi bi-journal-album fs-1 text-muted mb-3 d-block"></i>
                                        Syllabus details available upon request.
                                    </div>
                                @endif
                            </div>

                            <!-- Eligibility Tab -->
                            <div class="tab-pane fade" id="eligibility">
                                <h3 class="fw-bold mb-4 text-dark">Entry Requirements</h3>
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="card h-100 border-0 bg-light p-4">
                                            <div class="d-flex align-items-center mb-3">
                                                <i class="bi bi-person-check fs-3 text-primary me-3"></i>
                                                <h5 class="fw-bold mb-0">Age Limit</h5>
                                            </div>
                                            <p class="mb-0 text-muted">Minimum {{ $course->minimum_age ?? '18' }}+ years required at the time of admission.</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card h-100 border-0 bg-light p-4">
                                            <div class="d-flex align-items-center mb-3">
                                                <i class="bi bi-mortarboard fs-3 text-success me-3"></i>
                                                <h5 class="fw-bold mb-0">Education</h5>
                                            </div>
                                            <p class="mb-0 text-muted">{{ $course->minimum_education ?? 'High School Diploma or equivalent.' }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card h-100 border-0 bg-light p-4">
                                            <div class="d-flex align-items-center mb-3">
                                                <i class="bi bi-translate fs-3 text-info me-3"></i>
                                                <h5 class="fw-bold mb-0">Language</h5>
                                            </div>
                                            <p class="mb-0 text-muted">{{ $course->language_proficiency ?? 'English proficiency (IELTS/TOEFL) may be required.' }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card h-100 border-0 bg-light p-4">
                                            <div class="d-flex align-items-center mb-3">
                                                <i class="bi bi-briefcase fs-3 text-warning me-3"></i>
                                                <h5 class="fw-bold mb-0">Experience</h5>
                                            </div>
                                            <p class="mb-0 text-muted">
                                                {{ $course->work_experience_required ? ($course->work_experience_details ?? 'Work experience required.') : 'No prior work experience required.' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Fees Tab -->
                            <div class="tab-pane fade" id="fees">
                                <h3 class="fw-bold mb-4 text-dark">Fees & Funding</h3>
                                                                <!-- Total Cost Card -->
                                <div class="card border-0 bg-primary bg-gradient text-white overflow-hidden mb-5 shadow-lg rounded-4 position-relative">
                                    <div class="position-absolute top-0 end-0 p-4 opacity-10">
                                        <i class="bi bi-wallet2 display-1"></i>
                                    </div>
                                    <div class="card-body p-4 p-md-5 position-relative z-1">
                                        <div class="row align-items-center">
                                            <div class="col-md-7">
                                                <small class="text-uppercase fw-bold text-white-50 ls-2 mb-2 d-block">Estimated Total Investment</small>
                                                <h2 class="display-5 fw-bold mb-1 text-white">{{ $course->total_fees ?? 'Contact for Pricing' }}</h2>
                                                <p class="mb-0 text-white-50">*Includes tuition and estimated living expenses</p>
                                            </div>
                                            <div class="col-md-5 text-md-end mt-3 mt-md-0">
                                                <button class="btn btn-light text-primary fw-bold px-4 py-3 rounded-pill shadow-sm hover-scale" onclick="document.getElementById('enquiryForm').scrollIntoView({behavior: 'smooth'})">
                                                    Get Detailed Quote <i class="bi bi-arrow-right ms-2"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if($course->overseas_fee_breakdown && count($course->overseas_fee_breakdown) > 0)
                                <h5 class="fw-bold mb-3">Fee Breakdown</h5>
                                <div class="table-responsive mb-4">
                                    <table class="table table-borderless bg-light rounded-3 overflow-hidden">
                                        <thead class="bg-light border-bottom">
                                            <tr>
                                                <th class="ps-4 py-3 text-muted text-uppercase small fw-bold">Item</th>
                                                <th class="pe-4 py-3 text-end text-muted text-uppercase small fw-bold">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($course->overseas_fee_breakdown as $fee)
                                            <tr>
                                                <td class="ps-4 py-3 fw-medium">{{ $fee['label'] }}</td>
                                                <td class="pe-4 py-3 text-end fw-bold">{{ $fee['amount'] }} {{ $fee['currency'] ?? '' }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @endif

                                {{-- Local Training Fees --}}
                                @if($course->local_training && $course->local_training_fee && count($course->local_training_fee) > 0)
                                <h5 class="fw-bold mb-3">Local Training Fees</h5>
                                <div class="table-responsive mb-4">
                                    <table class="table table-borderless bg-light rounded-3 overflow-hidden">
                                        <thead class="bg-light border-bottom">
                                            <tr>
                                                <th class="ps-4 py-3 text-muted text-uppercase small fw-bold">Item</th>
                                                <th class="pe-4 py-3 text-end text-muted text-uppercase small fw-bold">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($course->local_training_fee as $fee)
                                            <tr>
                                                <td class="ps-4 py-3 fw-medium">{{ $fee['label'] ?? 'Fee' }}</td>
                                                <td class="pe-4 py-3 text-end fw-bold">{{ $fee['amount'] ?? '--' }} {{ $fee['currency'] ?? '' }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @endif

                                {{-- Living Costs --}}
                                @if($course->living_costs && count($course->living_costs) > 0)
                                <h5 class="fw-bold mb-3">Estimated Living Costs</h5>
                                <div class="table-responsive mb-4">
                                    <table class="table table-borderless bg-light rounded-3 overflow-hidden">
                                        <thead class="bg-light border-bottom">
                                            <tr>
                                                <th class="ps-4 py-3 text-muted text-uppercase small fw-bold">Expense</th>
                                                <th class="pe-4 py-3 text-end text-muted text-uppercase small fw-bold">Estimated Cost</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($course->living_costs as $cost)
                                            <tr>
                                                <td class="ps-4 py-3 fw-medium">{{ $cost['label'] ?? $cost['item'] ?? 'Expense' }}</td>
                                                <td class="pe-4 py-3 text-end fw-bold">{{ $cost['amount'] ?? $cost['cost'] ?? '--' }} {{ $cost['currency'] ?? '' }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @endif

                                <div class="row g-4 mt-2">
                                    @if($course->scholarship_available)
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-start">
                                            <i class="bi bi-award-fill text-success fs-4 me-3"></i>
                                            <div>
                                                <h6 class="fw-bold text-success">Scholarships Available</h6>
                                                <p class="small text-muted mb-0">{{ $course->scholarship_notes ?? 'Merit-based scholarships available for eligible candidates.' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if($course->bank_loan_assistance)
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-start">
                                            <i class="bi bi-bank2 text-purple fs-4 me-3"></i>
                                            <div>
                                                <h6 class="fw-bold text-purple">Loan Assistance</h6>
                                                <p class="small text-muted mb-0">{{ $course->loan_assistance_notes ?? 'We assist with documents for bank loan applications.' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Career Tab -->
                            <div class="tab-pane fade" id="career">
                                <h3 class="fw-bold mb-4 text-dark">Future Prospects</h3>
                                @if($course->career_outcomes && count($course->career_outcomes) > 0)
                                <div class="bg-light p-4 rounded-4 mb-4">
                                    <h5 class="fw-bold mb-3">Career Opportunities</h5>
                                    <div class="row g-3">
                                        @foreach($course->career_outcomes as $outcome)
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                                <span class="fw-medium">{{ $outcome }}</span>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                                
                                @if($course->next_pathways && count($course->next_pathways) > 0)
                                <div>
                                    <h5 class="fw-bold mb-3">Further Education</h5>
                                    <ul class="list-unstyled">
                                        @foreach($course->next_pathways as $pathway)
                                        <li class="mb-2 d-flex align-items-start">
                                            <i class="bi bi-arrow-right text-primary me-2 mt-1"></i>
                                            <span>{{ $pathway }}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Additional Info Cards -->
                    <div class="row g-4 mb-4">
                        @if($course->certification_type || $course->accreditation_recognition)
                        <div class="col-12">
                            <div class="bg-white rounded-4 shadow-sm p-4">
                                <h5 class="fw-bold mb-3">Accreditation & Certification</h5>
                                <div class="row g-4">
                                    @if($course->certification_type)
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center p-3 bg-light rounded-3">
                                            <i class="bi bi-patch-check-fill text-warning fs-3 me-3"></i>
                                            <div>
                                                <small class="text-muted d-block text-uppercase fw-bold">Certification</small>
                                                <span class="fw-bold">{{ $course->certification_type }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if($course->accreditation_recognition)
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center p-3 bg-light rounded-3">
                                            <i class="bi bi-award fs-3 text-info me-3"></i>
                                            <div>
                                                <small class="text-muted d-block text-uppercase fw-bold">Accreditation</small>
                                                <span class="fw-bold">{{ $course->accreditation_recognition }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($course->visa_notes || $course->accommodation_notes)
                        <div class="col-12">
                            <div class="bg-white rounded-4 shadow-sm p-4">
                                <div class="row g-4">
                                    @if($course->visa_support_included && $course->visa_notes)
                                    <div class="col-md-6">
                                        <h5 class="fw-bold mb-3"><i class="bi bi-passport text-danger me-2"></i>Visa Support</h5>
                                        <p class="text-muted small mb-0">{!! strip_tags($course->visa_notes) !!}</p>
                                    </div>
                                    @endif
                                    @if($course->accommodation_support && $course->accommodation_notes)
                                    <div class="col-md-6">
                                        <h5 class="fw-bold mb-3"><i class="bi bi-house-heart text-purple me-2"></i>Accommodation</h5>
                                        <p class="text-muted small mb-0">{!! strip_tags($course->accommodation_notes) !!}</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        @if($course->faqs && count($course->faqs) > 0)
                        <div class="col-12">
                            <div class="bg-white rounded-4 shadow-sm p-4">
                                <h5 class="fw-bold mb-4">Frequently Asked Questions</h5>
                                <div class="accordion accordion-modern" id="faqAccordion">
                                    @foreach($course->faqs as $index => $faq)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{ $index }}">
                                                    {{ $faq['question'] }}
                                                </button>
                                            </h2>
                                            <div id="faq{{ $index }}" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                                <div class="accordion-body">
                                                    {{ $faq['answer'] }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Right Sidebar Column -->
                <div class="col-lg-4 order-1 order-lg-2">
                    <div class="sticky-sidebar">
                        <!-- Quick Details Card (Overlapping Banner) -->
                        <div class="bg-white rounded-4 shadow-lg p-4 mb-4 border-top border-5 border-primary">
                            <h4 class="fw-bold mb-4">Quick Highlights</h4>
                            
                            <ul class="list-unstyled mb-4">
                                <li class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-muted">Course Code</span>
                                    <span class="fw-bold text-dark">{{ $course->course_code }}</span>
                                </li>
                                <li class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-muted">Duration</span>
                                    <span class="fw-bold text-dark">{{ $course->total_duration ?? $course->course_duration_overseas ?? 'Flexible' }}</span>
                                </li>
                                <li class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-muted">Language</span>
                                    <span class="fw-bold text-dark">
                                        @if($course->language_of_instruction)
                                            {{ is_array($course->language_of_instruction) ? implode(', ', $course->language_of_instruction) : $course->language_of_instruction }}
                                        @else
                                            English
                                        @endif
                                    </span>
                                </li>
                                <li class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-muted">Mode</span>
                                    <span class="fw-bold text-dark">
                                        @if($course->mode_of_study)
                                            {{ is_array($course->mode_of_study) ? implode(', ', $course->mode_of_study) : $course->mode_of_study }}
                                        @else
                                            On-Campus
                                        @endif
                                    </span>
                                </li>
                                <li class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-muted">Intakes</span>
                                    <div class="text-end">
                                        @if($course->intake_months)
                                            @foreach((array)$course->intake_months as $month)
                                                <span class="badge bg-light text-dark border me-1 mb-1">{{ $month }}</span>
                                            @endforeach
                                        @else
                                            <span class="fw-bold text-dark">Rolling</span>
                                        @endif
                                    </div>
                                </li>
                                <li class="d-flex justify-content-between py-2 pt-3">
                                    <span class="text-muted">Fee Type</span>
                                    <span class="badge {{ $course->paid_type == 'Free' ? 'bg-success' : 'bg-warning text-dark' }} px-3 py-2 rounded-pill">
                                        {{ $course->paid_type }}
                                    </span>
                                </li>
                            </ul>
                            
                            <button class="btn btn-primary w-100 btn-lg mb-2 shadow-sm lift-btn" onclick="document.getElementById('enquiryForm').scrollIntoView({behavior: 'smooth'})">
                                Enquire Now <i class="bi bi-arrow-right ms-2"></i>
                            </button>
                            
                            @if($course->course_brochures && count($course->course_brochures) > 0)
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary w-100 dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-download me-2"></i> Download Brochure
                                    </button>
                                    <ul class="dropdown-menu w-100 p-2 shadow border-0">
                                        @foreach($course->course_brochures as $brochure)
                                        <li>
                                            @php
                                                $url = is_string($brochure) ? $brochure : ($brochure['file_path'] ?? '#');
                                                $name = is_string($brochure) ? basename($brochure) : ($brochure['document_name'] ?? 'Brochure');
                                            @endphp
                                            <a class="dropdown-item rounded py-2" href="{{ asset($url) }}" download>
                                                <small><i class="bi bi-file-pdf text-danger me-2"></i> {{ $name }}</small>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Enquiry Form Card -->
                        <div class="bg-white rounded-4 shadow-sm p-4" id="enquiryForm">
                            <div class="text-center mb-4">
                                <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-circle mb-3" style="width: 50px; height: 50px;">
                                    <i class="bi bi-envelope-check-fill text-primary fs-4"></i>
                                </div>
                                <h5 class="fw-bold">Interested?</h5>
                                <p class="small text-muted mb-0">Fill the form and our expert will contact you shortly.</p>
                            </div>
                            
                            <form action="{{ route('web.enquiry') }}" method="POST">
                                @csrf
                                <input type="hidden" name="type" value="7">
                                <input type="hidden" name="course_name" value="{{ $course->course_title }}">
                                
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted">Full Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-person"></i></span>
                                        <input type="text" class="form-control bg-light border-start-0 ps-0" name="name" required placeholder="John Doe">
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted">Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope"></i></span>
                                        <input type="email" class="form-control bg-light border-start-0 ps-0" name="email" required placeholder="name@example.com">
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted">Mobile Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-phone"></i></span>
                                        <input type="tel" class="form-control bg-light border-start-0 ps-0" name="mobile" required placeholder="+1234567890">
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label small fw-bold text-muted">Message (Optional)</label>
                                    <textarea class="form-control bg-light" name="message" rows="3" placeholder="I am interested in this course..."></textarea>
                                </div>
                                
                                <button type="submit" class="btn btn-dark w-100">Submit Request</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Courses -->
    @if($otherCourses->count() > 0)
    <section class="py-5 bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <div>
                     <span class="text-primary fw-bold text-uppercase small ls-1">Discover More</span>
                     <h3 class="fw-bold mt-1">Similar Global Courses</h3>
                </div>
                <!-- Swiper Navigation Buttons Here if needed -->
            </div>
            
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach($otherCourses as $relatedCourse)
                    <div class="swiper-slide h-auto">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-card">
                            <div class="position-relative">
                                <img src="{{ $relatedCourse->thumbnail_image ? asset($relatedCourse->thumbnail_image) : asset('resource/web/assets/media/default/default-img.png') }}" 
                                     class="card-img-top" 
                                     style="height: 200px; object-fit: cover;"
                                     alt="{{ $relatedCourse->course_title }}"
                                     onerror="this.src='{{ asset('resource/web/assets/media/default/default-img.png') }}'">
                                <div class="position-absolute top-0 end-0 p-3">
                                    <span class="badge bg-white text-dark shadow-sm text-white">{{ $relatedCourse->category->name ?? 'Course' }}</span>
                                </div>
                            </div>
                            <div class="card-body p-4 d-flex flex-column">
                                <div class="mb-2">
                                    <span class="badge bg-primary bg-opacity-10 small mb-2 text-white">{{ $relatedCourse->country->name }}</span>
                                </div>
                                <h5 class="card-title fw-bold mb-3 flex-grow-1">
                                    <a href="{{ route('web.global.course.show', $relatedCourse->slug) }}" class="text-dark text-decoration-none stretched-link">
                                        {{ Str::limit($relatedCourse->course_title, 50) }}
                                    </a>
                                </h5>
                                
                                <div class="d-flex justify-content-between align-items-center text-muted small mt-auto pt-3 border-top">
                                    <span><i class="bi bi-clock me-1"></i> {{ $relatedCourse->course_duration_overseas ?? 'Flexible' }}</span>
                                    <span class="fw-bold text-dark">{{ $relatedCourse->paid_type }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination mt-4"></div>
            </div>
        </div>
    </section>
    @endif
@endsection
