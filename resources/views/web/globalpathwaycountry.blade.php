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
            <!-- Title Banner Section Start -->
            <section class="title-banner mb-80">
                <div class="container-fluid">
                    <h1>All Sectors</h1>
                </div>
            </section>
            <!-- Title Banner Section End -->
            <!-- Couse Section Start -->
            <section class="couses-sec mb-120">
                <div class="container-fluid">
                    <h4 class="text-center mb-5">Please select country to expore skill courses</h4>
                    <form method="GET" action="{{ route('web.global.course') }}">
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
                    </style>
                    <div class="row row-gap-4 mb-48">
                        @foreach ($country as $item)
                             <div class="col-lg-3 col-md-6">
                                <div class="course-card">
                                    <a href="{{ route('web.global.course', ['countries[]' => $item->id]) }}" class="card-img">
                                       {!! $item->emoji !!}
                                    </a>
                                    <div class="card-content">
                                        <a href="{{ route('web.global.course', ['countries[]' => $item->id]) }}" class="h5 fw-500 mb-16">{{ $item->name }}</a>
                                        <p>{{ \Illuminate\Support\Str::limit(strip_tags($item->description), 100) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    @if ($country->hasPages())
                        <div class="pagination">
                            <ul id="border-pagination" class="mb-0">
                                {{-- Previous Page Link --}}
                                <li>
                                    @if ($country->onFirstPage())
                                        <span class="disabled">
                                            <svg> <!-- Your left-arrow SVG here --> </svg>
                                        </span>
                                    @else
                                        <a href="{{ $country->previousPageUrl() }}">
                                            <svg> <!-- Your left-arrow SVG here --> </svg>
                                        </a>
                                    @endif
                                </li>

                                {{-- Pagination Elements --}}
                                @foreach ($country->getUrlRange(1, $country->lastPage()) as $page => $url)
                                    <li>
                                        <a href="{{ $url }}" class="{{ $page == $country->currentPage() ? 'active' : '' }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                {{-- Next Page Link --}}
                                <li>
                                    @if ($country->hasMorePages())
                                        <a href="{{ $country->nextPageUrl() }}">
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
