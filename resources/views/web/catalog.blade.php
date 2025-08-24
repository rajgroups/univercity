@extends('layouts.web.app')
@push('meta')
    <title>Upcoming & Ongoing Projects, Schemes & Programs - Indian Skill Institute Co-operation (ISICO)</title>

    <meta name="description" content="Discover upcoming and ongoing projects, schemes, and programs by the Indian Skill Institute Co-operation (ISICO). Focused on education, skill development, entrepreneurship, and socio-economic growth, ISICO initiatives aim to empower communities and build a sustainable future for India.">
    <meta name="keywords" content="ISICO projects, ISICO schemes, ISICO programs, upcoming initiatives, ongoing projects, Indian Skill Institute, skill development schemes, education programs, entrepreneurship initiatives, socio-economic growth">
    <meta name="author" content="Indian Skill Institute Co-operation (ISICO)">
    <meta name="robots" content="index, follow">

    <!-- Canonical Tag -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:title" content="Upcoming & Ongoing Projects, Schemes & Programs - Indian Skill Institute Co-operation (ISICO)">
    <meta property="og:description" content="Stay updated with ISICO’s ongoing and upcoming projects, schemes, and programs that drive skill development, education, and entrepreneurship across India.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('default-projects.jpg') }}">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Upcoming & Ongoing Projects, Schemes & Programs - Indian Skill Institute Co-operation (ISICO)">
    <meta name="twitter:description" content="Explore ISICO’s initiatives including projects, schemes, and programs dedicated to skill development, education, and entrepreneurship.">
    <meta name="twitter:image" content="{{ asset('default-projects.jpg') }}">
@endpush

@section('content')
<div class="container py-5">
    {{-- <h2 class="mb-4">Catalog</h2> --}}

    <form method="GET" action="{{ route('web.catalog') }}" class="row gx-3 mb-4">
        {{-- Category Filter --}}
        <div class="col-md-4 mb-1">
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
        <div class="col-md-4 mb-1">
            <select name="type" class="form-select">
                <option value="">All Types</option>
                <option value="project_1" {{ request('type') == 'project_1' ? 'selected' : '' }}>Ongoing Projects</option>
                <option value="project_2" {{ request('type') == 'project_2' ? 'selected' : '' }}>Upcoming Projects</option>
                <option value="announcement_1" {{ request('type') == 'announcement_1' ? 'selected' : '' }}>Programs</option>
                <option value="announcement_2" {{ request('type') == 'announcement_2' ? 'selected' : '' }}>Schemes</option>
            </select>
        </div>

        {{-- Search --}}
        <div class="col-md-4 mb-1">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by title">
        </div>

        {{-- Submit --}}
        <div class="col-12 mb-1">
            <button type="submit" class="btn btn-primary">Apply Filter</button>
            <a href="{{ route('web.catalog') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    {{-- Results --}}
    <div class="row">
        @forelse($results as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                    @php
                        $imagePath = $item->item_type === 'project'
                            ? asset($item->image ?? 'uploads/projects/default.png')
                            : asset($item->image ?? 'uploads/announcements/default.png');
                    @endphp

                    <img src="{{ $imagePath }}" class="card-img-top" alt="{{ $item->title }}" style="height: 200px; object-fit: cover;">

                        <h5 class="card-title mt-3">{{ $item->title }}</h5>

                        <p style="text-indent: 35px;">{{ \Illuminate\Support\Str::limit(strip_tags($item->description), 100) }}</p>
                        <div class="d-flex justify-content-between mt-2">
                            <p class="mb-2"><strong>Type:</strong> {{ $item->type_label }}</p>
                            <p class="mb-2"><strong>Category:</strong> {{ $item->category->name ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top-0">
                        @php
                            $categorySlug = $item->category->slug ?? 'category';
                            $slug = $item->slug;
                        @endphp

                        @if ($item instanceof \App\Models\Project)
                            @if ($item->type == 1)
                                <a href="{{ route('web.ongoging.project', [$categorySlug, $slug]) }}" class="btn btn-outline-primary btn-sm">View More</a>
                            @else
                                <a href="{{ route('web.upcoming.project', [$categorySlug, $slug]) }}" class="btn btn-outline-primary btn-sm">View More</a>
                            @endif
                        @elseif ($item instanceof \App\Models\Announcement)
                            @if ($item->type == 1)
                                <a href="{{ route('web.announcement.program', [$categorySlug, $slug]) }}" class="btn btn-outline-success btn-sm">View More</a>
                            @else
                                <a href="{{ route('web.announcement.scheme', [$categorySlug, $slug]) }}" class="btn btn-outline-success btn-sm">View More</a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-muted">No records found.</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $results->withQueryString()->links() }}
    </div>
</div>
@endsection
