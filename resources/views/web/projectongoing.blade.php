{{-- @dd($announcement) --}}
@extends('layouts.web.app')
@push('meta')
    <title>{{ $metaTitle ?? ($announcement->title ?? 'Default Page Title') }}</title>

    <meta name="description"
        content="{{ $metaDescription ?? Str::limit(strip_tags($announcement->description ?? ''), 150) }}">
    <meta name="keywords" content="{{ $metaKeywords ?? 'announcement, news, education' }}">
    <meta name="author" content="{{ $metaAuthor ?? 'YourSiteName' }}">
    <meta name="robots" content="{{ $metaRobots ?? 'index, follow' }}">

    <!-- Canonical Tag -->
    <link rel="canonical" href="{{ $metaCanonical ?? url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:title" content="{{ $metaOgTitle ?? ($announcement->title ?? 'Default OG Title') }}">
    <meta property="og:description"
        content="{{ $metaOgDescription ?? Str::limit(strip_tags($announcement->description ?? ''), 150) }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $metaOgUrl ?? url()->current() }}">
    <meta property="og:image" content="{{ $metaOgImage ?? asset($announcement->image ?? 'default.jpg') }}">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $metaTwitterTitle ?? ($announcement->title ?? 'Default Twitter Title') }}">
    <meta name="twitter:description"
        content="{{ $metaTwitterDescription ?? Str::limit(strip_tags($announcement->description ?? ''), 150) }}">
    <meta name="twitter:image" content="{{ $metaTwitterImage ?? asset($announcement->image ?? 'default.jpg') }}">
@endpush

@section('content')
<style>

</style>
    <!-- Yout Content Here -->
    <section class="title-banner mb-80" style="background-image: url({{ asset($announcement->banner_image) }})">
        <div class="container-fluid">
            <h2 class="fw-500 mb-24 fs-xs-18">{{ $announcement && $announcement->title ? Str::limit($announcement->title, 200, '...') : '' }}<br class="d-sm-block d-none">
                <span class="color-primary">{{ $announcement && $announcement->subtitle ? Str::limit($announcement->subtitle, 200, '...') : '' }}</span>
            </h2>
            <div class="d-flex align-items-center gap-16 flex-wrap row-gap-4">
                <div class="d-flex align-items-center gap-8">
                    <i class="bi bi-folder text-white fw-bold"></i>
                    <p class="text-white fw-bold">Scheme</p>
                </div>
                <div class="d-flex align-items-center gap-8">
                    <i class="bi bi-calendar text-white fw-bold"></i>
                    <p class="text-white">{{ \Carbon\Carbon::parse($announcement->created_at)->format('F jS, Y') }}</p>
                </div>
                <div class="d-flex align-items-center gap-8">
                </div>
            </div>
        </div>
    </section>
    <div class="container my-5">
         <div class="mb-3">
                {{-- Event Or Compition Images --}}
                @if ($announcement->images && $announcement->images->count() > 0)
                    <div id="carouselId" class="carousel slide" data-bs-ride="carousel">

                        {{-- Indicators --}}
                        <div class="carousel-indicators">
                            @foreach ($announcement->images as $index => $image)
                                <button type="button" data-bs-target="#carouselId"
                                    data-bs-slide-to="{{ $index }}" @class(['active' => $index === 0])
                                    aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                                    aria-label="Slide {{ $index + 1 }}"></button>
                            @endforeach
                        </div>

                        {{-- Slides --}}
                        <div class="carousel-inner" role="listbox">
                            @foreach ($announcement->images as $index => $image)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <img src="{{ asset($image->file_name) }}" class="w-100 d-block"
                                        alt="{{ $image->alt_text ?? 'Slide ' . ($index + 1) }}">
                                </div>
                            @endforeach
                        </div>

                        {{-- Controls --}}
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselId"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hsidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselId"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                @endif
            </div>

        @php
            $points = [];

            if (!empty($announcement->points)) {
                $points = is_array($announcement->points)
                    ? $announcement->points
                    : json_decode($announcement->points, true);
            }
        @endphp
        @if (!empty($points))
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <nav id="navbar-example"
                        class="navbar sticky-top flex-column align-items-stretch p-3 bg-light rounded">
                        <h5 class="fw-bold mb-3">Topics</h5>
                        @foreach ($points as $index => $point)
                            @php
                                [$title, $content] = explode(' - ', $point, 2);
                                $sectionId = 'section' . ($index + 1);
                            @endphp
                            <a class="nav-link" href="#{{ $sectionId }}">{{ $index + 1 }}.
                                {{ $title }}</a>
                        @endforeach
                    </nav>
                </div>

                <div class="col-lg-8">
                    @foreach ($points as $index => $point)
                        @php
                            [$title, $content] = explode(' - ', $point, 2);
                            $sectionId = 'section' . ($index + 1);
                        @endphp

                        <section id="{{ $sectionId }}" class="mb-4">
                            <h4 class="fw-bold mt-4">{{ $index + 1 }}. {{ $title }}</h4>
                            <p>{{ $content }}</p>
                        </section>
                    @endforeach
                </div>
            </div>
        @endif
        <section class="brife-description mt-5">
            {!! $announcement->description !!}
        </section>
    </div>
    <!-- End Yout Content here -->
@endsection
