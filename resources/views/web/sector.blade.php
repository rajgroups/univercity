@extends('layouts.web.app')
@push('meta')
    <title>Education Sectors - Indian Skill Institute Co-operation (ISICO)</title>

    <meta name="description" content="Explore the education sectors covered by the Indian Skill Institute Co-operation (ISICO). From skill development to entrepreneurship and innovation, ISICO works across diverse sectors to empower communities and strengthen India’s socio-economic growth.">
    <meta name="keywords" content="ISICO education sectors, Indian Skill Institute, skill development sectors, education initiatives, entrepreneurship sectors, vocational training, innovation, socio-economic development, NEP 2020">
    <meta name="author" content="Indian Skill Institute Co-operation (ISICO)">
    <meta name="robots" content="index, follow">

    <!-- Canonical Tag -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:title" content="Education Sectors - Indian Skill Institute Co-operation (ISICO)">
    <meta property="og:description" content="Discover ISICO’s initiatives across various education sectors including skill training, entrepreneurship, and innovation to build a skilled and inclusive India.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('default-sectors.jpg') }}">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Education Sectors - Indian Skill Institute Co-operation (ISICO)">
    <meta name="twitter:description" content="Learn about ISICO’s focus on diverse education sectors to advance skill development, entrepreneurship, and socio-economic progress.">
    <meta name="twitter:image" content="{{ asset('default-sectors.jpg') }}">
@endpush

@section('content')
    <style>
        .modern-page-banner {
            position: relative;
            min-height: 350px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            overflow: hidden;
            margin-bottom: 80px;
        }

        .modern-page-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.5) 100%);
            z-index: 1;
        }

        .modern-banner-content {
            position: relative;
            z-index: 2;
            text-align: center;
            width: 100%;
            padding: 0 15px;
        }

        .modern-banner-title {
            font-size: 3.5rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 1rem;
            text-shadow: 0 4px 10px rgba(0,0,0,0.3);
            letter-spacing: -0.5px;
        }

        .modern-breadcrumb {
            display: inline-flex;
            padding: 8px 16px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            border-radius: 50px;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .modern-breadcrumb span {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .modern-page-banner {
                min-height: 250px;
            }
            .modern-banner-title {
                font-size: 2.5rem;
            }
        }
    </style>

    <!-- Title Banner Section Start -->
    <section class="modern-page-banner" style="background-image: url('{{ asset('resource/web/assets/media/banner/sector-bg.jpg') }}'), url('https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=2070&auto=format&fit=crop');">
        <div class="modern-banner-content" data-aos="fade-up">
            <div class="modern-breadcrumb">
                <a href="{{ url('/') }}">Home</a>
                <span class="mx-2">/</span>
                <span class="text-white">Skill Courses</span>
            </div>
            <h1 class="modern-banner-title p-0">Our sectors</h1>
            <small class="text-white fs-3">Skill Courses</small>
            <p class="text-white opacity-75 lead" style="max-width: 600px; margin: 0 auto;">Dedicated to empowering growth across diverse industries through specialized skill development.</p>
        </div>
    </section>
    <!-- Title Banner Section End -->
            <!-- Couse Section Start -->
            <section class="couses-sec mb-120">
                <div class="container-fluid">
                    <h4 class="text-center mb-5">Please select sector to explore skill courses</h4>
                    <form method="GET" action="{{ route('web.sector') }}">
                        @csrf
                        <div class="wrapper">
                            <div class="searchBar mb-4">
                                <input id="searchQueryInput" type="text" name="searchQueryInput" placeholder="Search"
                                    value="{{ request('searchQueryInput') }}" />
                                <button id="searchQuerySubmit" type="submit" name="searchQuerySubmit">
                                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                        <path fill="#666666"
                                            d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                    <style>
                        .wrapper {
                            width: 100%;
                            max-width: 31.25rem;
                            margin: 1rem auto;
                        }

                        .label {
                            font-size: .625rem;
                            font-weight: 400;
                            text-transform: uppercase;
                            letter-spacing: +1.3px;
                            margin-bottom: 1rem;
                        }

                        .searchBar {
                            width: 100%;
                            display: flex;
                            flex-direction: row;
                            align-items: center;
                        }

                        #searchQueryInput {
                            width: 100%;
                            height: 2.8rem;
                            background: #f5f5f5;
                            outline: none;
                            border: none;
                            border-radius: 1.625rem;
                            padding: 0 3.5rem 0 1.5rem;
                            font-size: 1rem;
                        }

                        #searchQuerySubmit {
                            width: 3.5rem;
                            height: 2.8rem;
                            margin-left: -3.5rem;
                            background: none;
                            border: none;
                            outline: none;
                        }

                        #searchQuerySubmit:hover {
                            cursor: pointer;
                        }

                        .card-img img {
                            width: 100%;
                            height: 180px;
                            object-fit: cover;
                            border-radius: 8px 8px 0 0;
                        }
                        .course-card {
                            border: 1px solid #e0e0e0;
                            border-radius: 8px;
                            overflow: hidden;
                            transition: transform 0.3s ease;
                        }
                        .course-card:hover {
                            transform: translateY(-5px);
                            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
                        }
                    </style>
                    <div class="row row-gap-4 mb-48">
                        @foreach ($sectors as $item)
                             <div class="col-lg-3 col-md-6">
                                <div class="course-card">
                                    <a href="{{ route('web.course.index', ['sectors' => $item->id]) }}" class="card-img">
                                        <img src="{{ asset($item->image)}}" alt="img">
                                    </a>
                                    <div class="card-content">
                                        <a href="{{ route('web.course.index', ['sectors' => $item->id]) }}" class="h5 fw-500 mb-16">{{ $item->name }}</a>
                                        <p>{{ \Illuminate\Support\Str::limit(strip_tags($item->description), 100) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    @if ($sectors->hasPages())
                        <div class="pagination">
                            <ul id="border-pagination" class="mb-0">
                                {{-- Previous Page Link --}}
                                <li>
                                    @if ($sectors->onFirstPage())
                                        <span class="disabled">
                                            <svg> <!-- Your left-arrow SVG here --> </svg>
                                        </span>
                                    @else
                                        <a href="{{ $sectors->previousPageUrl() }}">
                                            <svg> <!-- Your left-arrow SVG here --> </svg>
                                        </a>
                                    @endif
                                </li>

                                {{-- Pagination Elements --}}
                                @foreach ($sectors->getUrlRange(1, $sectors->lastPage()) as $page => $url)
                                    <li>
                                        <a href="{{ $url }}" class="{{ $page == $sectors->currentPage() ? 'active' : '' }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                {{-- Next Page Link --}}
                                <li>
                                    @if ($sectors->hasMorePages())
                                        <a href="{{ $sectors->nextPageUrl() }}">
                                            <svg> <!-- Your right-arrow SVG here --> </svg>
                                        </a>
                                    @else
                                        <span class="disabled">
                                            <svg> <!-- Your right-arrow SVG here --> </svg>
                                        </span>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    @endif

                </div>
            </section>
            <!-- Couse Section End -->

    <!-- content @e -->
    @endsection
