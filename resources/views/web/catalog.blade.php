@extends('layouts.web.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Catalog</h2>

    <form method="GET" action="{{ route('web.catalog') }}" class="row g-3 mb-4">
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
                <option value="project_1" {{ request('type') == 'project_1' ? 'selected' : '' }}>Ongoing Projects</option>
                <option value="project_2" {{ request('type') == 'project_2' ? 'selected' : '' }}>Upcoming Projects</option>
                <option value="announcement_1" {{ request('type') == 'announcement_1' ? 'selected' : '' }}>Programs</option>
                <option value="announcement_2" {{ request('type') == 'announcement_2' ? 'selected' : '' }}>Schemes</option>
            </select>
        </div>

        {{-- Search --}}
        <div class="col-md-4">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by title">
        </div>

        {{-- Submit --}}
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('web.catalog') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    {{-- Results --}}
    <div class="row">
        @forelse($results as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>
                    @php
                        $imagePath = $item->item_type === 'project'
                            ? asset($item->image ?? 'uploads/projects/default.png')
                            : asset($item->image ?? 'uploads/announcements/default.png');
                    @endphp

                    <img src="{{ $imagePath }}" class="card-img-top" alt="{{ $item->title }}" style="height: 200px; object-fit: cover;">



                        <p class="mb-2"><strong>Type:</strong> {{ $item->type_label }}</p>
                        <p class="mb-2"><strong>Category:</strong> {{ $item->category->name ?? '-' }}</p>
                        <p>{{ \Illuminate\Support\Str::limit(strip_tags($item->description), 100) }}</p>
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
