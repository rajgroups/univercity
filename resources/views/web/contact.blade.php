@extends('layouts.web.app')
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
                                <a href="tel:+91{{ $defaultSettings->contact_phone ?? null }}"
                                    class="h4 fw-500 hover-content light-black">+91{{ $defaultSettings->contact_phone ?? null }}</a>
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
