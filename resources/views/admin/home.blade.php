@extends('layouts.admin.app')

@section('content')

<!-- Dashboard Header -->
<div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
    <div>
        <h1 class="mb-1">Welcome, Admin</h1>
        <p class="fw-medium">You have <span class="text-primary fw-bold">
        {{-- {{ $totalOrders ?? '0' }} --}}
        </span> Items to Review Today</p>
    </div>
    <div class="input-icon-start position-relative">
        <span class="input-icon-addon fs-16 text-gray-9">
            <i class="ti ti-calendar"></i>
        </span>
        <input type="text" class="form-control date-range bookingrange" placeholder="Search...">
    </div>
</div>

<!-- Dashboard Cards -->
<div class="row g-4">
    @php
        $stats = [
            ['title' => 'Categories', 'total' => $totalCategories ?? 0, 'active' => $activeCategories ?? 0, 'inactive' => $inactiveCategories ?? 0, 'color' => 'secondary'],
            ['title' => 'Sectors', 'total' => $totalSectors ?? 0, 'active' => $activeSectors ?? 0, 'inactive' => $inactiveSectors ?? 0, 'color' => 'teal'],
            ['title' => 'Courses', 'total' => $totalCourses ?? 0, 'active' => $activeCourses ?? 0, 'inactive' => $inactiveCourses ?? 0, 'color' => 'info'],
            ['title' => 'Projects', 'total' => $totalProjects ?? 0, 'active' => $activeProjects ?? 0, 'inactive' => $inactiveProjects ?? 0, 'color' => 'success'],
            ['title' => 'Blogs', 'total' => $totalBlogs ?? 0, 'active' => $activeBlogs ?? 0, 'inactive' => $inactiveBlogs ?? 0, 'color' => 'dark'],
        ];
    @endphp

    @foreach ($stats as $stat)
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-light h-100">
                <div class="card-body">
                    <h5 class="mb-3 text-{{ $stat['color'] }}">{{ $stat['title'] }}</h5>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Total</span>
                        <span class="fw-bold text-dark">{{ $stat['total'] }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Active</span>
                        <span class="fw-bold text-success">{{ $stat['active'] }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Inactive</span>
                        <span class="fw-bold text-danger">{{ $stat['inactive'] }}</span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection
