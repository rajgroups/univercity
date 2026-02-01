@extends('layouts.web.app')
@push('meta')
    <title>Explore Projects, Schemes & Programs - ISICO Catalog</title>
    <meta name="description" content="Discover ISICO’s ongoing and upcoming projects, schemes, and programs that drive skill development, education, and entrepreneurship across India.">
    <link rel="canonical" href="{{ url()->current() }}">
@endpush

@section('content')
<!-- Hero Header -->
<div class="catalog-hero py-5 mb-5 position-relative overflow-hidden">
    <div class="hero-backdrop"></div>
    <div class="container position-relative z-2 py-4">
        <div class="row align-items-center">
            <div class="col-lg-7 text-white">
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white-50">Home</a></li>
                        {{-- <li class="breadcrumb-item active text-white" aria-current="page">
                            @if(isset($pageType) && $pageType === 'projects') Projects
                            @elseif(isset($pageType) && $pageType === 'announcements') Programs & Schemes
                            @else Catalog
                            @endif
                        </li> --}}
                    </ol>
                </nav>
                <h1 class="display-4 fw-bold mb-3 text-white">
                    @if(isset($pageType) && $pageType === 'projects') Our <span class="text-warning">Projects</span>
                    @elseif(isset($pageType) && $pageType === 'announcements') Programs <span class="text-warning">&</span> Schemes
                    @else Initiatives <span class="text-warning">&</span> Impact
                    @endif
                </h1>
                <p class="lead text-white-50 mb-4">
                    @if(isset($pageType) && $pageType === 'projects') Explore our ongoing, upcoming and completed projects.
                    @elseif(isset($pageType) && $pageType === 'announcements') Discover government schemes and educational programs.
                    @else Explore our growing catalog of projects, government schemes, and educational programs across India.
                    @endif
                </p>

                <!-- Hero Search -->
                <form method="GET" action="{{ url()->current() }}" class="hero-search-wrapper shadow-lg rounded-pill bg-white p-2 d-flex">
                    <div class="flex-grow-1 px-3 d-flex align-items-center">
                        <i class="bi bi-search text-muted me-2"></i>
                        <input type="text" name="search" value="{{ request('search') }}"
                               class="form-control border-0 shadow-none border-0"
                               placeholder="Search for projects, schemes or programs...">
                    </div>
                    @if(request('type')) <input type="hidden" name="type" value="{{ request('type') }}"> @endif
                    @if(request('category_id')) <input type="hidden" name="category_id" value="{{ request('category_id') }}"> @endif
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Search</button>
                </form>
            </div>
            <div class="col-lg-5 d-none d-lg-block text-center">
                <div class="hero-stat-bubble glass-light p-4 rounded-4 shadow-sm inline-block">
                    <h3 class="fw-bold text-white mb-0">{{ $results->total() }}</h3>
                    <small class="text-white-50">Total Initiatives</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container pb-5">
    <div class="row g-4">
        <!-- Sidebar Filters -->
        <div class="col-lg-3">
           <div class="sticky-top d-none d-lg-block" style="top: 100px;">
                <div class="filter-sidebar card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-header bg-white border-0 py-3 px-4">
                        <h5 class="mb-0 fw-bold d-flex align-items-center">
                            <i class="bi bi-funnel text-primary me-2"></i>Filters
                        </h5>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <form method="GET" action="{{ url()->current() }}" id="catalogFilters">
                            <!-- Preserve Search if current -->
                            @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif

                            <!-- Initiative Type -->
                            <div class="mb-4">
                                <label class="form-label small fw-bold text-uppercase text-muted mb-3">
                                    @if($pageType === 'projects') Project Status
                                    @elseif($pageType === 'announcements') Announcement Type
                                    @else Initiative Type
                                    @endif
                                </label>
                                <div class="filter-pills d-flex flex-column gap-2">
                                    <label class="filter-pill-label">
                                        <input type="radio" name="type" value="" {{ !request('type') ? 'checked' : '' }} onchange="this.form.submit()">
                                        <span class="pill-content">
                                            <i class="bi bi-grid me-2"></i>All Results
                                        </span>
                                    </label>
                                    @if($pageType === 'projects' || !$pageType)
                                    <label class="filter-pill-label">
                                        <input type="radio" name="type" value="project_1" {{ request('type') == 'project_1' ? 'checked' : '' }} onchange="this.form.submit()">
                                        <span class="pill-content">
                                            <i class="bi bi-activity me-2"></i>Ongoing Projects
                                        </span>
                                    </label>
                                    <label class="filter-pill-label">
                                        <input type="radio" name="type" value="project_2" {{ request('type') == 'project_2' ? 'checked' : '' }} onchange="this.form.submit()">
                                        <span class="pill-content">
                                            <i class="bi bi-rocket me-2"></i>Upcoming Projects
                                        </span>
                                    </label>
                                    <label class="filter-pill-label">
                                        <input type="radio" name="type" value="project_3" {{ request('type') == 'project_3' ? 'checked' : '' }} onchange="this.form.submit()">
                                        <span class="pill-content">
                                            <i class="bi bi-check-circle me-2"></i>Completed Projects
                                        </span>
                                    </label>
                                    @endif

                                    @if($pageType === 'announcements' || !$pageType)
                                    <label class="filter-pill-label">
                                        <input type="radio" name="type" value="announcement_1" {{ request('type') == 'announcement_1' ? 'checked' : '' }} onchange="this.form.submit()">
                                        <span class="pill-content">
                                            <i class="bi bi-book me-2"></i>Programs
                                        </span>
                                    </label>
                                    <label class="filter-pill-label">
                                        <input type="radio" name="type" value="announcement_2" {{ request('type') == 'announcement_2' ? 'checked' : '' }} onchange="this.form.submit()">
                                        <span class="pill-content">
                                            <i class="bi bi-patch-check me-2"></i>Schemes
                                        </span>
                                    </label>
                                    @endif
                                </div>
                            </div>

                            <!-- Categories -->
                            <div class="mb-4">
                                <label class="form-label small fw-bold text-uppercase text-muted mb-3">Categories</label>
                                <select name="category_id" class="form-select border-0 bg-light rounded-3" onchange="this.form.submit()">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <a href="{{ url()->current() }}" class="btn btn-outline-danger btn-sm w-100 rounded-pill">
                                <i class="bi bi-arrow-counterclockwise me-1"></i>Reset All
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Results Grid -->
        <div class="col-lg-9">
            <!-- Results Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <p class="text-muted mb-0">Showing <strong>{{ $results->firstItem() ?? 0 }}-{{ $results->lastItem() ?? 0 }}</strong> of <strong>{{ $results->total() }}</strong> initiatives</p>
                <div class="d-md-block d-lg-none">
                    <button class="btn btn-primary btn-sm rounded-pill px-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileFilterCanvas">
                        <i class="bi bi-funnel"></i> Filters
                    </button>
                </div>
            </div>

            <div class="row g-4">
                @forelse($results as $item)
                    <div class="col-md-6 col-xl-4">
                        <div class="card catalog-card h-100 border-0 shadow-sm overflow-hidden transition-all">
                            <!-- Card Image -->
                            <div class="position-relative card-img-wrapper">
                                @php
                                    $image = $item->item_type === 'project' ? $item->thumbnail_image : $item->image;
                                    $placeholder = $item->item_type === 'project' ? 'assets/images/project-placeholder.jpg' : 'assets/images/announcement-placeholder.jpg';
                                    $typeClass = $item->item_type === 'project' ? 'bg-primary' : 'bg-success';
                                @endphp
                                <img src="{{ asset($image ?? $placeholder) }}"
                                     class="card-img-top"
                                     alt="{{ $item->title }}"
                                     style="height: 200px; width:100%; object-fit: cover;">

                                <span class="badge {{ $typeClass }} position-absolute top-0 start-0 m-3 shadow-sm px-3 py-2 rounded-pill">
                                    {{ $item->type_label }}
                                </span>
                            </div>

                            <!-- Card Body -->
                            <div class="card-body p-4 d-flex flex-column">
                                <small class="text-muted text-uppercase fw-bold mb-2">{{ $item->category->name ?? 'Uncategorized' }}</small>
                                <h5 class="card-title fw-bold mb-3 line-clamp-2">{{ $item->title }}</h5>
                                <p class="card-text text-muted line-clamp-3 mb-4">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($item->description), 120) }}
                                </p>

                                <div class="mt-auto pt-3 border-top">
                                    @php
                                        $categorySlug = $item->category?->slug ?? 'general';
                                        $slug = $item->slug;

                                        if ($item->item_type === 'project') {
                                            $link = route('web.project.show', [$categorySlug, $slug]);
                                        } else {
                                            $link = $item->type == 1
                                                ? route('web.announcement.program', [$categorySlug, $slug])
                                                : route('web.announcement.scheme', [$categorySlug, $slug]);
                                        }
                                    @endphp
                                    <a href="{{ $link }}" class="btn btn-link text-primary p-0 fw-bold text-decoration-none d-flex align-items-center group">
                                        View Details <i class="bi bi-arrow-right ms-2 transition-all group-hover-translate-x"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 py-5 text-center">
                        <div class="empty-state py-5">
                            <i class="bi bi-search display-1 text-muted opacity-25 mb-4 d-block"></i>
                            <h4>No matching initiatives found</h4>
                            <p class="text-muted">Try adjusting your filters or search terms.</p>
                            <a href="{{ route('web.catalog') }}" class="btn btn-primary rounded-pill px-4 mt-3">Reset Filters</a>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="pagination-wrapper mt-5 d-flex justify-content-center">
                {{ $results->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Mobile Filters Offcanvas -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileFilterCanvas">
    <div class="offcanvas-header bg-light">
        <h5 class="offcanvas-title fw-bold"><i class="bi bi-funnel me-2 text-primary"></i>Filters</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <div id="mobileFilterContainer">
            <!-- Filter content will be injected by JS or replicated here -->
        </div>
    </div>
</div>

<style>
    .catalog-hero {
        background: #1a1a1a;
        min-height: 350px;
        display: flex;
        align-items: center;
    }
    .hero-backdrop {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(135deg, rgba(13, 110, 253, 0.9) 0%, rgba(26, 26, 46, 0.95) 100%),
                    url('https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=1200&q=80');
        background-size: cover;
        background-position: center;
    }
    .hero-search-wrapper {
        border: 4px solid rgba(255,255,255,0.1);
        max-width: 600px;
    }
    .glass-light {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    .catalog-card {
        border-radius: 20px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .catalog-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }
    .card-img-wrapper {
        border-radius: 20px 20px 0 0;
        overflow: hidden;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .filter-pill-label {
        cursor: pointer;
    }
    .filter-pill-label input {
        display: none;
    }
    .pill-content {
        display: block;
        padding: 10px 15px;
        background: #f8f9fa;
        border-radius: 12px;
        color: #495057;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        border: 1px solid transparent;
    }
    .filter-pill-label input:checked + .pill-content {
        background: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
        border-color: rgba(13, 110, 253, 0.2);
        font-weight: 600;
    }
    .group:hover .group-hover-translate-x {
        transform: translateX(5px);
    }

    /* Pagination Styling Override */
    .pagination-wrapper nav .pagination {
        margin-bottom: 0;
        gap: 5px;
    }
    .pagination-wrapper .page-item .page-link {
        border: 0;
        border-radius: 8px;
        color: #495057;
        font-weight: 600;
        padding: 10px 18px;
    }
    .pagination-wrapper .page-item.active .page-link {
        background-color: #0d6efd;
        color: white;
        box-shadow: 0 4px 10px rgba(13, 110, 253, 0.3);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const desktopFilters = document.getElementById('catalogFilters');
    const mobileContainer = document.getElementById('mobileFilterContainer');

    if (desktopFilters && mobileContainer) {
        mobileContainer.innerHTML = desktopFilters.outerHTML;
        // Ensure unique IDs in mobile clone if necessary
        const clonedForm = mobileContainer.querySelector('form');
        clonedForm.id = 'catalogFiltersMobile';
    }
});
</script>
@endsection

