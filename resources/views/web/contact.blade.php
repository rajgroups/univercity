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
    <section class="contact-sec mb-120 bg-transparent p-0">
        <div class="container-fluid">
            <div class="row row-gap-4 align-items-center">
                <div class="col-lg-6">
                    <div class="heading text-start justify-content-start p-0">
                        <h3 class="fw-500 mb-16">Get in touch with us</h3>
                        <p class="mb-48">{{ $defaultSettings->footer_text ?? null }}
                        </p>
                        <p class="fw-500 black mb-16">Our Location</p>
                        <h4 class="fw-500 mb-48">{{ $defaultSettings->contact_address ?? null }}</h4>
                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                            <div>
                                <p class="fw-500 black mb-16">Support Center 24/7</p>
                                <a href="tel:{{ $defaultSettings->contact_phone ?? null }}"
                                    class="h4 fw-500 hover-content light-black">{{ $defaultSettings->contact_phone ?? null }}</a>
                                    <br>
                                     <br>
                                <a href="tel:{{ $defaultSettings->contact_secondary_phone ?? null }}"
                                    class="h4 fw-500 hover-content light-black">{{ $defaultSettings->contact_secondary_phone ?? null }}</a>
                            </div>
                            <div>
                                <p class="fw-500 black mb-16">Write To Us</p>
                                <a href="mailto:demo@mentoria.com"
                                    class="h4 fw-500 light-black hover-content">{{ $defaultSettings->contact_email ?? null }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="google-map-container mb-0">
                        {!! $defaultSettings->contact_map_embed ?? null !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- content @e -->
@endsection
