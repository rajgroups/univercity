@extends('layouts.web.app')
@push('meta')
    <title>{{ $metaTitle ?? ($event->title ?? 'Event Details') }}</title>
    <meta name="description" content="{{ $metaDescription ?? Str::limit(strip_tags($event->description ?? ''), 150) }}">
    <meta name="keywords" content="{{ $metaKeywords ?? 'event, competition, registration' }}">
    <meta name="author" content="{{ $metaAuthor ?? 'YourSiteName' }}">
    <meta name="robots" content="{{ $metaRobots ?? 'index, follow' }}">

    <!-- Canonical Tag -->
    <link rel="canonical" href="{{ $metaCanonical ?? url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:title" content="{{ $metaOgTitle ?? ($event->title ?? 'Event Details') }}">
    <meta property="og:description"
        content="{{ $metaOgDescription ?? Str::limit(strip_tags($event->description ?? ''), 150) }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $metaOgUrl ?? url()->current() }}">
    <meta property="og:image" content="{{ $metaOgImage ?? asset($event->thumbnail_image ?? 'default.jpg') }}">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $metaTwitterTitle ?? ($event->title ?? 'Event Details') }}">
    <meta name="twitter:description"
        content="{{ $metaTwitterDescription ?? Str::limit(strip_tags($event->description ?? ''), 150) }}">
    <meta name="twitter:image" content="{{ $metaTwitterImage ?? asset($event->thumbnail_image ?? 'default.jpg') }}">
@endpush

@section('content')
    <style>
        .event-banner {
            background-size: cover;
            background-position: center;
            padding: 80px 0;
            position: relative;
        }

        .event-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
        }

        .event-banner-content {
            position: relative;
            z-index: 1;
            color: white;
        }

        .event-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: 600;
            margin-right: 10px;
            margin-bottom: 10px;
        }

        .event-detail-icon {
            width: 24px;
            height: 24px;
            margin-right: 8px;
        }

        .event-detail-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .enquiry-form {
            background: #f9f9f9;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        }

        .similar-event-card {
            transition: transform 0.3s;
            margin-bottom: 20px;
        }

        .similar-event-card:hover {
            transform: translateY(-5px);
        }

        .sticky-sidebar {
            position: sticky;
            top: 101px;
        }

        .register-btn {
            background: linear-gradient(45deg, #FF5F6D, #FFC371);
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            letter-spacing: 1px;
        }
    </style>

    <!-- Event Banner Section -->
    <section class="event-banner mb-80" style="background-image: url({{ asset($event->banner_image ?? $event->image) }})">
        <div class="container-fluid event-banner-content">
            <div class="d-flex flex-wrap align-items-center gap-16 mb-3">
                @if ($event->type == 2)
                    <span class="event-badge bg-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="me-2 bi bi-trophy-fill" viewBox="0 0 16 16">
                            <path d="M2 1a1 1 0 0 0-1 1v1a3 3 0 0 0 3 3h.184a5.978
                    5.978 0 0 0 2.223 2.223A5.978
                    5.978 0 0 0 5 10.816V12h6v-1.184a5.978
                    5.978 0 0 0-2.223-2.223A5.978
                    5.978 0 0 0 10.816 6H11a3 3 0 0
                    0 3-3V2a1 1 0 0 0-1-1H2zm3 12a1 1 0 0
                    0-1 1v1h8v-1a1 1 0 0 0-1-1H5z" />
                        </svg>
                        Competition
                    </span>
                @else
                    <span class="event-badge bg-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="me-2 bi bi-calendar-event" viewBox="0 0 16 16">
                            <path d="M11 6a1 1 0 0 1 1 1v1a1 1 0 0
                    1-1 1H5a1 1 0 0 1-1-1V7a1 1 0
                    1 1 1h6z" />
                            <path d="M3.5 0a.5.5 0 0 1
                    .5.5V1h8V.5a.5.5 0 0
                    1 1 0V1h1a2 2 0 0
                    1 2 2v11a2 2 0 0
                    1-2 2H2a2 2 0 0
                    1-2-2V3a2 2 0 0
                    1 2-2h1V.5a.5.5
                    0 0 1 .5-.5zM1
                    4v10a1 1 0 0 0 1
                    1h12a1 1 0 0 0
                    1-1V4H1z" />
                        </svg>
                        Event
                    </span>
                @endif


                <span class="event-badge {{ $event->entry_fee > 0 ? 'bg-success' : 'bg-warning' }}">
                    <i class="fas {{ $event->entry_fee > 0 ? 'fa-ticket-alt' : 'fa-gift' }} me-2"></i>
                    {{ $event->entry_fee > 0 ? 'Paid: ₹' . number_format($event->entry_fee, 2) : 'Free' }}
                </span>
                <span class="event-badge bg-info">
                    <i class="fas fa-users me-2"></i>
                    {{ $event->max_participants ?? 'Unlimited' }} spots
                </span>
            </div>

            <h1 class="fw-500 mb-3 text-white">{{ $event->title }}</h1>
            <h4 class="text-white">{{ $event->subtitle }}</h4>
        </div>
    </section>

    <!-- Event Detail Section -->
    <section class="event-detail-sec mb-120">
        <div class="container-fluid">
            <div class="row row-gap-4">
                <!-- Main Content -->
                <div class="col-lg-8">

                    <!-- Event Highlights -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h3 class="fw-bold mb-4">Key Details</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="event-detail-item">
                                        <svg class="event-detail-icon" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24" fill="#6c757d">
                                            <path
                                                d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zM9 14H7v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2zm-8 4H7v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2z" />
                                        </svg>
                                        <div>
                                            <h6 class="mb-1">Date & Time</h6>
                                            <p class="mb-0">
                                                {{ \Carbon\Carbon::parse($event->start_date)->format('l, F j, Y') }}<br>
                                                {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }} -
                                                {{ \Carbon\Carbon::parse($event->end_time)->format('g:i A') }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="event-detail-item">
                                        <svg class="event-detail-icon" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24" fill="#6c757d">
                                            <path
                                                d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                                        </svg>
                                        <div>
                                            <h6 class="mb-1">Location</h6>
                                            <p class="mb-0">
                                                {{ $event->location }}<br>
                                                <span class="badge bg-light text-dark">{{ $event->location_type }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="event-detail-item">
                                        <svg class="event-detail-icon" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24" fill="#6c757d">
                                            <path
                                                d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z" />
                                        </svg>
                                        <div>
                                            <h6 class="mb-1">Registration Deadline</h6>
                                            <p class="mb-0">
                                                {{ \Carbon\Carbon::parse($event->registration_deadline)->format('F j, Y g:i A') }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="event-detail-item">
                                        <svg class="event-detail-icon" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24" fill="#6c757d">
                                            <path
                                                d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z" />
                                        </svg>
                                        <div>
                                            <h6 class="mb-1">Event Type</h6>
                                            <p class="mb-0">
                                                @if ($event->type == 1)
                                                    Event
                                                @elseif ($event->type == 2)
                                                    Competition
                                                @else
                                                    Unknown
                                                @endif
                                                <br>
                                                @if ($event->type == 2 && $event->is_competition)
                                                    <span class="badge bg-danger">
                                                        Prize: {{ $event->prize ?? 'TBD' }}
                                                    </span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h3 class="fw-bold mb-4">About This {{ $event->is_competition ? 'Competition' : 'Event' }}</h3>
                            {!! $event->description !!}
                        </div>
                    </div>

                    <!-- Event Schedule/Agenda -->
                    @if ($event->agenda)
                        <div class="card mb-4">
                            <div class="card-body">
                                <h3 class="fw-bold mb-4">Event Agenda</h3>
                                <div class="accordion" id="agendaAccordion">
                                    @foreach (json_decode($event->agenda, true) as $index => $item)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#agendaCollapse{{ $index }}">
                                                    <span
                                                        class="fw-bold me-3">{{ \Carbon\Carbon::parse($item['time'])->format('h:i A') }}</span>
                                                    {{ $item['title'] }}
                                                </button>
                                            </h2>
                                            <div id="agendaCollapse{{ $index }}"
                                                class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                                data-bs-parent="#agendaAccordion">
                                                <div class="accordion-body">
                                                    <p>{{ $item['description'] }}</p>
                                                    @if ($item['speaker'])
                                                        <p class="mb-0"><strong>Speaker:</strong> {{ $item['speaker'] }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Event Rules (for competitions) -->
                    @if ($event->is_competition && $event->rules)
                        <div class="card mb-4">
                            <div class="card-body">
                                <h3 class="fw-bold mb-4">Competition Rules</h3>
                                <ul class="list-group list-group-flush">
                                    @foreach (json_decode($event->rules, true) as $rule)
                                        <li class="list-group-item d-flex">
                                            <span class="badge bg-primary me-3">{{ $loop->iteration }}</span>
                                            {{ $rule }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="sticky-sidebar">
                        <!-- Registration Card -->
                        <div class="card mb-4">
                            <div class="card-body text-center">
                                @if (\Carbon\Carbon::now()->gt($event->registration_deadline))
                                    <button class="btn btn-secondary w-100 py-3 mb-3" disabled>
                                        Registration Closed
                                    </button>
                                    <p class="text-muted">The registration deadline has passed</p>
                                @else
                                    <button class="btn register-btn w-100 py-3 mb-3" data-bs-toggle="modal"
                                        data-bs-target="#registrationModal">
                                        Register Now
                                    </button>
                                    <p class="text-muted">Limited spots available</p>
                                @endif

                                <hr>

                                <div class="d-flex justify-content-between mb-2">
                                    <span>Start Date:</span>
                                    <strong>{{ \Carbon\Carbon::parse($event->start_date)->format('M j, Y') }}</strong>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Location:</span>
                                    <strong>{{ $event->location }}</strong>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Duration:</span>
                                    <strong>
                                        @php
                                            use Carbon\Carbon;
                                            $start = Carbon::parse($event->start_date);
                                            $end = Carbon::parse($event->end_date);
                                            $days = $start->diffInDays($end) + 1; // +1 if inclusive
                                        @endphp

                                        {{ $days }} {{ Str::plural('day', $days) }}
                                    </strong>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <span
                                        class="event-badge text-white {{ $event->entry_fee > 0 ? 'bg-success' : 'bg-warning' }}">
                                        <i class="fas {{ $event->entry_fee > 0 ? 'fa-ticket-alt' : 'fa-gift' }} me-2"></i>
                                        {{ $event->entry_fee > 0 ? 'Paid: ₹' . number_format($event->entry_fee, 2) : 'Free' }}
                                    </span>
                                </div>
                            </div>
                            @if ($event->organizer || $event->organizer_description || $event->organizer_logo)
                                <!-- Organizer Info -->
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="fw-500 mb-3">Organized By</h5>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset($event->organizer_logo ?? 'images/default-organizer.png') }}"
                                                class="rounded-circle me-3" width="60" height="60"
                                                alt="Organizer">
                                            <div>
                                                @if ($event->organizer)
                                                    <h6 class="mb-1">{{ $event->organizer }}</h6>
                                                @endif

                                                @if ($event->organizer_description)
                                                    <p class="text-muted small mb-0">{{ $event->organizer_description }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <!-- Enquiry Form -->
                            <div class="enquiry-form card">
                                <h5 class="fw-500 mb-3">Have Questions?</h5>
                                <form id="eventEnquiryForm" action="{{ route('web.enquiry') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="event_id" value="{{ $event->id }}">
                                    <input type="hidden" name="type" value="1">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Your Name" required>
                                    </div>

                                    <div class="mb-3">
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Your Email" required>
                                    </div>

                                    <div class="mb-3">
                                        <input type="tel" class="form-control" name="mobile"
                                            placeholder="Phone Number">
                                    </div>

                                    <div class="mb-3">
                                        <textarea class="form-control" name="message" rows="3" placeholder="Your Question" required></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100">Submit Enquiry</button>
                                </form>

                            </div>

                            <!-- Similar Events -->
                            @if ($similarEvents->count() > 0)
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <h5 class="fw-500 mb-3">Similar
                                            {{ $event->is_competition ? 'Competitions' : 'Events' }}</h5>
                                        @foreach ($similarEvents as $similar)
                                            <div class="similar-event-card">
                                                <div class="d-flex">
                                                    <img src="{{ asset($similar->image) }}" class="rounded me-3"
                                                        width="80" height="80" alt="{{ $similar->title }}">
                                                    <div>
                                                        <h6 class="mb-1">
                                                            <a href="{{ route('web.events.show', $similar->slug) }}"
                                                                class="text-dark">
                                                                {{ Str::limit($similar->title, 40) }}
                                                            </a>
                                                        </h6>
                                                        <p class="small text-muted mb-1">
                                                            <i class="far fa-calendar-alt me-1"></i>
                                                            {{ \Carbon\Carbon::parse($similar->start_date)->format('M j, Y') }}
                                                        </p>
                                                        <span
                                                            class="badge {{ $similar->is_free ? 'bg-success' : 'bg-warning' }}">
                                                            {{ $similar->is_free ? 'Free' : '₹' . $similar->price }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <!-- Registration Modal -->
    <div class="modal fade" id="registrationModal" tabindex="-1" aria-labelledby="registrationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registrationModalLabel">Register for {{ $event->title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="enquiryForm" action="{{ route('web.enquiry') }}" method="POST" novalidate>
                        @csrf
                        <input type="hidden" name="type" value="{{ $event->type == 1 ? 8 : 9 }}">

                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" required minlength="2"
                                    maxlength="255" pattern="[A-Za-z\s]+"
                                    title="Please enter a valid name (letters and spaces only)">
                                <div class="invalid-feedback">Please enter your full name (2-255 characters)</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email"
                                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                    title="Please enter a valid email address">
                                <div class="invalid-feedback">Please enter a valid email address</div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Mobile <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" name="mobile" required
                                    pattern="[0-9]{10,15}" title="Please enter a valid phone number (10-15 digits)">
                                <div class="invalid-feedback">Please enter a valid phone number (10-15 digits)</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea class="form-control" name="message" rows="3" maxlength="1000"></textarea>
                            <div class="invalid-feedback">Message cannot exceed 1000 characters</div>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="termsCheck" required>
                            <label class="form-check-label" for="termsCheck">
                                I agree to the <a href="#" data-bs-toggle="modal"
                                    data-bs-target="#termsModal">terms and conditions</a>
                                <span class="text-danger">*</span>
                            </label>
                            <div class="invalid-feedback">You must accept the terms and conditions</div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-3">
                            Submit Enquiry
                        </button>
                    </form>

                    <script>
                        // Enhanced client-side validation
                        (function() {
                            'use strict';
                            const form = document.getElementById('enquiryForm');

                            form.addEventListener('submit', function(event) {
                                if (!form.checkValidity()) {
                                    event.preventDefault();
                                    event.stopPropagation();
                                }

                                form.classList.add('was-validated');
                            }, false);

                            // Real-time validation for mobile number
                            const mobileInput = form.querySelector('input[name="mobile"]');
                            mobileInput.addEventListener('input', function() {
                                this.value = this.value.replace(/[^0-9]/g, '');
                            });
                        })();
                    </script>
                </div>

            </div>
        </div>
    </div>

    <!-- Terms Modal -->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {!! $event->terms_conditions !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Handle enquiry form submission
            $('#eventEnquiryForm').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('web.enquiry') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        alert('Thank you for your enquiry. We will get back to you soon.');
                        $('#eventEnquiryForm')[0].reset();
                    },
                    error: function(xhr) {
                        alert('An error occurred. Please try again.');
                    }
                });
            });

            // Handle registration form submission
            $('#eventRegistrationForm').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('web.enquiry') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            alert('Registration successful! ' + response.message);
                            $('#registrationModal').modal('hide');
                        } else {
                            alert('Registration failed: ' + response.message);
                        }
                    },
                    error: function(xhr) {
                        alert('An error occurred. Please try again.');
                    }
                });
            });
        });
    </script>
    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var registrationModal = new bootstrap.Modal(document.getElementById('registrationModal'));
                registrationModal.show();
            });
        </script>
    @endif

    @if (session('success'))
        <script>
            toastr.success("{{ session('success') }}");
        </script>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                toastr.error("{{ $error }}");
            </script>
        @endforeach
    @endif

@endsection
