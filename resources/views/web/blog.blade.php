@extends('layouts.web.app')
@push('meta')
    <title>Blog - Indian Skill Institute Co-operation (ISICO)</title>
    {{-- ... (Your existing meta tags) ... --}}
    <meta name="description" content="Read the latest blogs from the Indian Skill Institute Co-operation (ISICO). Explore insights on education, skill development, entrepreneurship, innovation, and national growth initiatives.">
    <meta name="keywords" content="ISICO blog, Indian Skill Institute, skill development articles, education blogs, entrepreneurship insights, innovation, socio-economic growth, NEP 2020, Skill India, Make in India">
    <meta name="author" content="Indian Skill Institute Co-operation (ISICO)">
    <meta name="robots" content="index, follow">

    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:title" content="Blog - Indian Skill Institute Co-operation (ISICO)">
    <meta property="og:description" content="Stay updated with ISICO’s blogs covering education, skill enhancement, entrepreneurship, and India’s socio-economic development.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('default-blog.jpg') }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Blog - Indian Skill Institute Co-operation (ISICO)">
    <meta name="twitter:description" content="Explore the ISICO blog for articles and insights on skill development, innovation, entrepreneurship, and education in India.">
    <meta name="twitter:image" content="{{ asset('default-blog.jpg') }}">
@endpush

@section('content')
<div class="container py-5">
    <h2 class="mb-4 d-flex justify-content-between align-items-center fs-xs-16">
        Blog & Publications
        {{-- MOBILE FILTER BUTTON (Hidden on desktop) --}}
        <button class="btn btn-primary d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileBlogFilterOffcanvas" aria-controls="mobileBlogFilterOffcanvas">
            <i class="bi bi-funnel"></i> Filter
        </button>
        {{-- END MOBILE FILTER BUTTON --}}
    </h2>

    {{-- DESKTOP FILTER FORM (Hidden on mobile) --}}
    <div class="d-none d-md-block">
        <form method="GET" action="{{ route('web.blog.filter') }}" id="blogFilterFormDesktop" class="row g-3 mb-4 p-3 border rounded shadow-sm">

            <h5 class="mb-3 text-primary"><i class="bi bi-sliders me-2"></i> Refine Results</h5>

            {{-- Filter Inputs Group --}}
            <div class="row g-3">

                {{-- Category Filter --}}
                {{-- <div class="col-md-4">
                    <label for="category_id_desktop" class="form-label small text-muted">Filter by Category</label>
                    <select name="category_id" id="category_id_desktop" class="form-select">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div> --}}

                {{-- Type Filter --}}
                <div class="col-md-4">
                    <label for="type_desktop" class="form-label small text-muted">Filter by Type</label>
                    <select name="type" id="type_desktop" class="form-select">
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

                {{-- Search Input --}}
                <div class="col-md-4">
                    <label for="search_desktop" class="form-label small text-muted">Search by Title</label>
                    <div class="input-group">
                        <input type="text" name="search" id="search_desktop" value="{{ request('search') }}" class="form-control" placeholder="Enter keyword...">
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>

            </div>

            {{-- Submit and Reset Controls --}}
            <div class="col-12 mt-4 text-end">
                <a href="{{ route('web.blog.filter') }}" class="btn btn-outline-secondary me-2">
                    <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Filters
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle me-1"></i> Apply
                </button>
            </div>
        </form>
    </div>
    {{-- END DESKTOP FILTER FORM --}}


    {{-- Results --}}
    <div class="row">
        @forelse($blogs as $blog)
            {{-- ... (Your existing blog card loop) ... --}}
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

{{-- ---------------------------------------------------------------------------------------------------------------------------------------------------------- --}}
{{-- MOBILE FILTER OFFCANVAS START --}}
<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileBlogFilterOffcanvas" aria-labelledby="mobileBlogFilterOffcanvasLabel">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="mobileBlogFilterOffcanvasLabel">
            <i class="bi bi-funnel me-2"></i> Filter Blog Posts
        </h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body" id="offcanvasFilterBody">
        {{-- The content of the desktop form will be cloned and inserted here by jQuery --}}
    </div>
</div>
{{-- MOBILE FILTER OFFCANVAS END --}}

{{-- ---------------------------------------------------------------------------------------------------------------------------------------------------------- --}}
{{-- JQUERY SCRIPT TO CLONE AND INSERT THE FORM --}}
@push('scripts')
<script>
    $(document).ready(function() {
        var $desktopForm = $('#blogFilterFormDesktop');

        if ($desktopForm.length) {
            // 1. Clone the entire desktop form, including the form tag itself.
            var $mobileForm = $desktopForm.clone();

            // 2. Update the form ID for mobile context
            $mobileForm.attr('id', 'blogFilterFormMobile');

            // 3. Update element IDs and add a dedicated submit/reset button for the offcanvas footer
            $mobileForm.find('select, input, button, a').each(function() {
                var currentId = $(this).attr('id');
                if (currentId) {
                    // Change element IDs to ensure HTML validity when cloned
                    $(this).attr('id', 'mobile_' + currentId);
                }
            });

            // 4. Remove the desktop apply/reset buttons from the cloned form body
            // as we will place them in the offcanvas footer for better sticky behavior.
            $mobileForm.find('.col-12.mt-4.text-end').remove();

            // 5. Insert the cleaned, cloned form into the offcanvas body
            $('#offcanvasFilterBody').append($mobileForm);

            // 6. Add a sticky footer with the controls for the mobile form
            var $offcanvasFooter = $('<div class="offcanvas-footer p-3 border-top d-grid gap-2"></div>');

            // Recreate the Apply and Reset buttons targeting the cloned form
            var $applyButton = $('<button type="submit" form="blogFilterFormMobile" class="btn btn-primary"><i class="bi bi-check-circle me-1"></i> Apply Filters</button>');
            var $resetLink = $('<a href="{{ route('web.blog.filter') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-counterclockwise me-1"></i> Reset All</a>');

            $offcanvasFooter.append($applyButton).append($resetLink);

            // Append the new footer container directly after the offcanvas body
            $('#mobileBlogFilterOffcanvas').append($offcanvasFooter);

            // OPTIONAL: Adjust styling for offcanvas layout if needed
            $('#blogFilterFormMobile').removeClass('p-3 border rounded shadow-sm').addClass('p-0');
            $('#blogFilterFormMobile h5').removeClass('mb-3').addClass('mb-3');
        }
    });
</script>
@endpush
