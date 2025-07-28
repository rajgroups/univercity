@extends('layouts.web.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Blog & Publications</h2>

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
            <select name="type" class="form-select">
                <option value="">All Types</option>
                <option value="1" {{ request('type') == '1' ? 'selected' : '' }}>Blog</option>
                <option value="2" {{ request('type') == '2' ? 'selected' : '' }}>News</option>
                <option value="3" {{ request('type') == '3' ? 'selected' : '' }}>Collaboration</option>
                <option value="4" {{ request('type') == '4' ? 'selected' : '' }}>Training Model</option>
                <option value="5" {{ request('type') == '5' ? 'selected' : '' }}>Research & Publication</option>
                <option value="6" {{ request('type') == '6' ? 'selected' : '' }}>Case Studies</option>
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
                        <h5 class="card-title">{{ $blog->title }}</h5>

                        @php
                            $imagePath = $blog->image
                                ? asset($blog->image)
                                : asset('uploads/blogs/default.png');
                        @endphp

                        <img src="{{ $imagePath }}" class="card-img-top" alt="{{ $blog->title }}" style="height: 200px; object-fit: cover;">

                        <p class="mb-2"><strong>Type:</strong>
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

                        <p class="mb-2"><strong>Category:</strong> {{ $blog->category->name ?? '-' }}</p>
                        <p class="mb-2"><strong>Short Description:</strong> {{ $blog->short_description }}</p>
                        <p>{{ \Illuminate\Support\Str::limit(strip_tags($blog->description), 100) }}</p>
                    </div>
                    <div class="card-footer bg-white border-top-0">
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
