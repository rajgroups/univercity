@extends('layouts.web.app')
@push('meta')
    <title>Contact Us - Indian Skill Institute Co-operation (ISICO)</title>

    <meta name="description" content="Get in touch with the Indian Skill Institute Co-operation (ISICO) for inquiries, collaborations, or support. Connect with us to learn more about our initiatives in education, skill development, and entrepreneurship.">
    <meta name="keywords" content="ISICO contact, Indian Skill Institute contact, ISICO support, ISICO office, skill development contact, education institute contact, partnerships, collaborations, get in touch">
    <meta name="author" content="Indian Skill Institute Co-operation (ISICO)">
    <meta name="robots" content="index, follow">

    <!-- Canonical Tag -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:title" content="Contact Us - Indian Skill Institute Co-operation (ISICO)">
    <meta property="og:description" content="Reach out to ISICO for inquiries, collaborations, or support related to education, skill development, and entrepreneurship.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('default-contact.jpg') }}">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Contact Us - Indian Skill Institute Co-operation (ISICO)">
    <meta name="twitter:description" content="Contact ISICO to learn more about our programs, initiatives, and collaborations for education, skills, and entrepreneurship.">
    <meta name="twitter:image" content="{{ asset('default-contact.jpg') }}">
@endpush

@section('content')
    <style>
        /* Modern Banner Styling */
        .modern-page-banner {
            position: relative;
            min-height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin-bottom: 60px;
            overflow: hidden;
        }

        .modern-page-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(88, 214, 141, 0.8) 0%, rgba(40, 180, 99, 0.8) 100%); /* Light green overlay */
            z-index: 1;
        }

        .modern-banner-content {
            position: relative;
            z-index: 2;
            text-align: center;
            width: 100%;
            padding: 0 20px;
        }

        .modern-banner-title {
            font-size: 3.5rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 1rem;
            text-shadow: 0 2px 10px rgba(0,0,0,0.3);
            letter-spacing: -1px;
        }

        .modern-breadcrumb {
            display: inline-flex;
            align-items: center;
            padding: 8px 20px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 50px;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .modern-breadcrumb span {
            color: #fff;
            font-size: 0.95rem;
            font-weight: 600;
        }

        /* Contact Details Styling */
        .contact-info-card {
            background: #fff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08); /* Softer, larger shadow */
            height: 100%;
            transition: transform 0.3s ease;
        }

        .contact-info-card:hover {
            transform: translateY(-5px);
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 35px;
        }

        .info-icon {
            width: 50px;
            height: 50px;
            background: rgba(13, 110, 253, 0.1); /* Light primary color bg */
            color: #0d6efd;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-right: 20px;
            flex-shrink: 0;
        }

        .info-content h5 {
            font-weight: 700;
            margin-bottom: 8px;
            color: #333;
        }

        .info-content p, .info-content a {
            color: #666;
            font-size: 1.05rem;
            text-decoration: none;
            line-height: 1.6;
        }

        .info-content a:hover {
            color: #0d6efd;
        }

        .map-container {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            height: 100%;
            min-height: 500px;
        }

        .map-container iframe {
            width: 100%;
            height: 100%;
            min-height: 500px;
            border: 0;
        }

        @media (max-width: 768px) {
            .modern-page-banner {
                min-height: 300px;
            }
            .modern-banner-title {
                font-size: 2.5rem;
            }
            .contact-info-card {
                padding: 30px;
            }
        }
    </style>

    <!-- Title Banner Section Start -->
    <section class="modern-page-banner" style="background-image: url('{{ asset('resource/web/assets/media/images/title-banner.jpg') }}');">
        <div class="modern-banner-content" data-aos="fade-up">
            <div class="modern-breadcrumb">
                <span>Home</span>
                <span class="mx-3 text-white-50"><i class="bi bi-chevron-right" style="font-size: 0.8em;"></i></span>
                <span class="text-white">Contact Us</span>
            </div>
            <h1 class="modern-banner-title">Get in Touch</h1>
            <p class="text-white lead fw-normal opacity-75" style="max-width: 600px; margin: 0 auto;">We'd love to hear from you. Reach out for inquiries, collaborations, or support.</p>
        </div>
    </section>
    <!-- Title Banner Section End -->

    <section class="contact-sec mb-120">
        <div class="container">
            <div class="row g-5">
                <!-- Contact Information -->
                <div class="col-lg-5">
                    <div class="contact-info-card">
                        <h3 class="fw-bold mb-4 text-dark">Contact Information</h3>
                        <p class="text-muted mb-5">{{ $defaultSettings->footer_text ?? 'Reach out to us for any queries or assistance.' }}</p>

                        <div class="info-item">
                            <div class="info-icon">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                            <div class="info-content">
                                <h5>Our Location</h5>
                                <p>{{ $defaultSettings->contact_address ?? 'Not Available' }}</p>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon">
                                <i class="bi bi-telephone-fill"></i>
                            </div>
                            <div class="info-content">
                                <h5>Phone Number</h5>
                                @if($defaultSettings->contact_phone)
                                    <a href="tel:{{ $defaultSettings->contact_phone }}" class="d-block">{{ $defaultSettings->contact_phone }}</a>
                                @endif
                                @if($defaultSettings->contact_secondary_phone)
                                    <a href="tel:{{ $defaultSettings->contact_secondary_phone }}" class="d-block">{{ $defaultSettings->contact_secondary_phone }}</a>
                                @endif
                                @if(!$defaultSettings->contact_phone && !$defaultSettings->contact_secondary_phone)
                                    <p>Not Available</p>
                                @endif
                            </div>
                        </div>

                        <div class="info-item mb-0">
                            <div class="info-icon">
                                <i class="bi bi-envelope-fill"></i>
                            </div>
                            <div class="info-content">
                                <h5>Email Address</h5>
                                <a href="mailto:{{ $defaultSettings->contact_email ?? '#' }}">{{ $defaultSettings->contact_email ?? 'Not Available' }}</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modern Contact Form -->
                <div class="col-lg-7">
                    <div class="contact-form-card bg-white p-4 p-md-5 rounded-4 shadow-sm border h-100" style="position: relative; overflow: hidden;">
                        <div class="position-absolute top-0 end-0 p-4 opacity-10">
                            <i class="bi bi-send-check display-1"></i>
                        </div>

                        <div class="position-relative z-1">
                            <h3 class="fw-bold mb-2">Send us a Message</h3>
                            <p class="text-muted mb-4">Fill out the form below and we will get back to you as soon as possible.</p>

                            <form action="{{ route('web.enquiry') }}" method="POST">
                                @csrf
                                <!-- Type 1 is a general enquiry type in the EnquiryController -->
                                <input type="hidden" name="type" value="1">

                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="name" id="name"
                                                placeholder="Your Name"
                                                required minlength="3" maxlength="30">

                                            <div class="invalid-feedback">
                                                Name must contain only letters (no numbers).
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Your Email" required>
                                        <div class="invalid-feedback">
                                            Please enter a valid email address.
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <input type="tel" class="form-control" name="mobile" id="mobile"
                                            placeholder="Phone Number" maxlength="10">
                                        <div class="invalid-feedback">
                                            Enter a valid 10-digit phone number.
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <textarea class="form-control" name="message" id="message"
                                            rows="3" placeholder="Your Question"
                                            required minlength="10" maxlength="200"></textarea>
                                        <div class="invalid-feedback">
                                            Message must be 10–200 characters.
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold shadow-sm d-flex align-items-center justify-content-center py-3" style="border-radius: 12px; transition: all 0.3s ease;">
                                            <span>Send Message</span>
                                            <i class="bi bi-arrow-right ms-2 fs-5"></i>
                                        </button>
                                        <p class="text-center small text-muted mt-3 mb-0">
                                            <i class="bi bi-shield-lock me-1"></i> Your information is safe and secure.
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="map-sec pb-120">
        <div class="container-fluid px-0">
            <div class="map-container" style="border-radius: 0; box-shadow: none;">
                @if(!empty($defaultSettings->contact_map_embed))
                    {!! $defaultSettings->contact_map_embed !!}
                @else
                    {{-- Placeholder Map if none provided --}}
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14008.11235948332!2d77.209021!3d28.613939!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce2db961be393%3A0xf6c250060fadcd!2sNew%20Delhi%2C%20Delhi!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                @endif
            </div>
        </div>
    </section>

    <!-- content @e -->
    <script>
        const nameInput = document.getElementById("name");

// Block numbers while typing
nameInput.addEventListener("keypress", function(e) {
    if (/\d/.test(e.key)) {
        e.preventDefault();
        showError();
    }
});

// Handle paste (in case user pastes numbers)
nameInput.addEventListener("input", function() {
    if (/\d/.test(this.value)) {
        this.value = this.value.replace(/\d/g, '');
        showError();
    } else {
        clearError();
    }
});

function showError() {
    nameInput.classList.add("is-invalid");
}

function clearError() {
    nameInput.classList.remove("is-invalid");
}
const email = document.getElementById("email");
const mobile = document.getElementById("mobile");
const message = document.getElementById("message");

// Email validation
email.addEventListener("input", function () {
    const pattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    if (!this.value.match(pattern)) {
        this.classList.add("is-invalid");
    } else {
        this.classList.remove("is-invalid");
    }
});

// Mobile validation (only numbers + max 10 digits)
mobile.addEventListener("input", function () {
    // remove non-numbers
    this.value = this.value.replace(/\D/g, '');

    if (this.value.length > 0 && this.value.length !== 10) {
        this.classList.add("is-invalid");
    } else {
        this.classList.remove("is-invalid");
    }
});

// Message validation
message.addEventListener("input", function () {
    if (this.value.length < 10 || this.value.length > 200) {
        this.classList.add("is-invalid");
    } else {
        this.classList.remove("is-invalid");
    }
});
</script>
@endsection
