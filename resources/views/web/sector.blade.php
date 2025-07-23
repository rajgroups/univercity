@extends('layouts.web.app')
@section('content')
            <!-- Title Banner Section Start -->
            <section class="title-banner mb-80">
                <div class="container-fluid">
                    <h1>All Courses</h1>
                </div>
            </section>
            <!-- Title Banner Section End -->
            <!-- Couse Section Start -->
            <section class="couses-sec mb-120">
                <div class="container-fluid">
                    <h4 class="text-center mb-2">Please select sectoy to expore skill courses</h4>
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
                    </style>
                    <div class="row row-gap-4 mb-48">
                        @foreach ($sectors as $item)
                             <div class="col-lg-3 col-md-6">
                                <div class="course-card">
                                    <a href="{{ route('web.course.index', ['sectors[]' => $item->id]) }}" class="card-img">
                                        <img src="{{ asset($item->image)}}" alt="">
                                    </a>
                                    <div class="card-content">
                                        <a href="{{ route('web.course.index', ['sectors[]' => $item->id]) }}" class="h5 fw-500 mb-16">{{ $item->name }}</a>
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