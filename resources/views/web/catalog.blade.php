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
    {{-- Filter Button for Mobile --}}
    <div class="d-md-none mb-3 text-end">
        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileFilterCanvas">
            <i class="bi bi-funnel"></i> Filters
        </button>
    </div>

    <div class="row">
        {{-- Desktop Filters Sidebar --}}
        <div class="col-md-3 d-none d-md-block">
            <div class="sticky-top" style="top: 90px;">
                <form method="GET" action="{{ route('web.catalog') }}" id="desktopFilters">
                    <div class="mb-3">
                        <label class="form-label">Search by title</label>
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search...">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Type</label>
                        <select name="type" class="form-select">
                            <option value="">All Types</option>
                            <option value="project_1" {{ request('type')=='project_1'?'selected':'' }}>Ongoing Projects</option>
                            <option value="project_2" {{ request('type')=='project_2'?'selected':'' }}>Upcoming Projects</option>
                            <option value="announcement_1" {{ request('type')=='announcement_1'?'selected':'' }}>Programs</option>
                            <option value="announcement_2" {{ request('type')=='announcement_2'?'selected':'' }}>Schemes</option>
                        </select>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Apply Filter</button>
                        <a href="{{ route('web.catalog') }}" class="btn btn-outline-secondary">Reset</a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Results --}}
        <div class="col-md-9">
            <div class="row g-4">
                @forelse($results as $item)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm">
                            @php
                                $imagePath = $item->item_type === 'project'
                                    ? asset($item->image ?? 'uploads/projects/default.png')
                                    : asset($item->image ?? 'uploads/announcements/default.png');
                            @endphp
                            <img src="{{ $imagePath }}" class="card-img-top" alt="{{ $item->title }}" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->title }}</h5>
                                <p style="text-indent: 25px;">{{ \Illuminate\Support\Str::limit(strip_tags($item->description), 100) }}</p>
                                <div class="d-flex justify-content-between">
                                    <small class="text-muted">Type: {{ $item->type_label }}</small>
                                    <small class="text-muted">Category: {{ $item->category->name ?? '-' }}</small>
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
    </div>

    {{-- Mobile Offcanvas Filters --}}
    <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileFilterCanvas">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title"><i class="bi bi-funnel"></i> Filters</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <form method="GET" action="{{ route('web.catalog') }}" id="mobileFilters">
                <div class="filter-content">
                    {{-- Filters will be dynamically appended here --}}
                </div>
                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">Apply Filter</button>
                    <a href="{{ route('web.catalog') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function () {
    // Append desktop filters to mobile offcanvas on first open
    $('[data-bs-target="#mobileFilterCanvas"]').on('click', function () {
        let $mobileContent = $('#mobileFilters .filter-content');

        if ($mobileContent.children().length === 0) {
            let $desktopFilters = $('#desktopFilters').clone();

            // Remove buttons from desktop clone (we keep mobile buttons)
            $desktopFilters.find('button[type="submit"]').remove();
            $desktopFilters.find('a.btn').remove();

            $mobileContent.append($desktopFilters.html());

            // Optional: Copy selected values from desktop to mobile
            $('#desktopFilters select, #desktopFilters input').each(function () {
                let name = $(this).attr('name');
                let val = $(this).val();
                $mobileContent.find('[name="'+name+'"]').val(val);
            });
        }
    });
});
</script>
@endpush
@endsection

