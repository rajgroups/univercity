@extends('layouts.web.app')
@push('meta')
    <title>Blog - Indian Skill Institute Co-operation (ISICO)</title>

    <meta name="description" content="Read the latest blogs from the Indian Skill Institute Co-operation (ISICO). Explore insights on education, skill development, entrepreneurship, innovation, and national growth initiatives.">
    <meta name="keywords" content="ISICO blog, Indian Skill Institute, skill development articles, education blogs, entrepreneurship insights, innovation, socio-economic growth, NEP 2020, Skill India, Make in India">
    <meta name="author" content="Indian Skill Institute Co-operation (ISICO)">
    <meta name="robots" content="index, follow">

    <!-- Canonical Tag -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:title" content="Blog - Indian Skill Institute Co-operation (ISICO)">
    <meta property="og:description" content="Stay updated with ISICO’s blogs covering education, skill enhancement, entrepreneurship, and India’s socio-economic development.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('default-blog.jpg') }}">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Blog - Indian Skill Institute Co-operation (ISICO)">
    <meta name="twitter:description" content="Explore the ISICO blog for articles and insights on skill development, innovation, entrepreneurship, and education in India.">
    <meta name="twitter:image" content="{{ asset('default-blog.jpg') }}">
@endpush

@section('content')
<div class="container py-5">
    {{-- <h2 class="mb-4">Blog & Publications</h2> --}}

    <form method="GET" action="{{ route('web.blog.filter') }}" class="row g-3 mb-4">
        {{-- Category Filter --}}
        <div class="col-md-4">
            <select name="category_id" class="form-select">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Type Filter --}}
        <div class="col-md-4">
            {{-- <option value="1" {{ old('type', $blog->type) == '1' ? 'selected' : '' }}>Blog</option>
            <option value="2" {{ old('type', $blog->type) == '2' ? 'selected' : '' }}>News</option>
            <option value="3" {{ old('type', $blog->type) == '3' ? 'selected' : '' }}>Collaboration</option>
            <option value="4" {{ old('type', $blog->type) == '4' ? 'selected' : '' }}>Training Model</option>
            <option value="5" {{ old('type', $blog->type) == '5' ? 'selected' : '' }}>Research and Publication</option>
            <option value="6" {{ old('type', $blog->type) == '6' ? 'selected' : '' }}>Case Studies</option>
            <option value="7" {{ old('type', $blog->type) == '7' ? 'selected' : '' }}>Resource</option>
            <option value="8" {{ old('type', $blog->type) == '8' ? 'selected' : '' }}>CSR Initiatives</option> --}}
            <select name="type" class="form-select">
                <option value="">All Types</option>
                <option value="1" {{ request('type') == '1' ? 'selected' : '' }}>Blog</option>
                <option value="2" {{ request('type') == '2' ? 'selected' : '' }}>News</option>
                <option value="3" {{ request('type') == '3' ? 'selected' : '' }}>Collaboration</option>
                <option value="4" {{ request('type') == '4' ? 'selected' : '' }}>Training Model</option>
                <option value="5" {{ request('type') == '5' ? 'selected' : '' }}>Research & Publication</option>
                <option value="6" {{ request('type') == '6' ? 'selected' : '' }}>Case Studies</option>
                <option value="8" {{ request('type') == '8' ? 'selected' : '' }}>CSR Initiatives</option>
            </select>
        </div>

        {{-- Search --}}
        <div class="col-md-4">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by title">
        </div>

        {{-- Submit --}}
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('web.blog.filter') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    {{-- Results --}}
    <div class="row">
        @forelse($blogs as $blog)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">

                        @php
                            $imagePath = $blog->image
                                ? asset($blog->image)
                                : asset('uploads/blogs/default.png');
                        @endphp

                        <img src="{{ $imagePath }}" class="card-img-top" alt="{{ $blog->title }}" style="height: 200px; object-fit: cover;">

                        <h5 class="card-title mt-3">{{ $blog->title }}</h5>
                        <p style="text-indent: 35px;" class="mb-2">
                            {{-- <strong>Short Description :</strong> --}}
                             {{ $blog->short_description }}</p>
                        {{-- <p>{{ \Illuminate\Support\Str::limit(strip_tags($blog->description), 100) }}</p> --}}
                        <div class="d-flex justify-content-between">
                            <p class="mb-2"><strong class="text-danger">Type :</strong>
                            @switch($blog->type)
                                @case(1) Blog @break
                                @case(2) News @break
                                @case(3) Collaboration @break
                                @case(4) Training Model @break
                                @case(5) Research & Publication @break
                                @case(6) Case Studies @break
                                @default Unknown
                            @endswitch
                         </p>

                            <p class="mt-1"><strong class="text-danger">Category :</strong> {{ $blog->category->name ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top-0 mt-0 mb-2">
                        @php
                            $categorySlug = $blog->category->slug ?? 'uncategorized';
                        @endphp

                        <a href="{{ route('web.blog.show', [$categorySlug, $blog->slug]) }}" class="btn btn-outline-primary btn-sm">
                            Read More
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-muted">No blog posts found.</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $blogs->withQueryString()->links() }}
    </div>
</div>
@endsection
