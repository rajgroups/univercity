@extends('layouts.admin.app')

@section('content')

<!-- Dashboard Header -->
<div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
    <div>
        <h1 class="mb-1">Welcome, Admin</h1>
        <p class="fw-medium">You have <span class="text-primary fw-bold">
        {{-- {{ $totalOrders ?? '0' }} --}}
        </span> Orders Today</p>
    </div>
    <div class="input-icon-start position-relative">
        <span class="input-icon-addon fs-16 text-gray-9">
            <i class="ti ti-calendar"></i>
        </span>
        <input type="text" class="form-control date-range bookingrange" placeholder="Search Product">
    </div>
</div>

<!-- Dashboard Cards -->
<div class="row g-4">
    {{-- CARD GROUP --}}
    @php
        $stats = [
            // ['title' => 'Orders', 'total' => $totalOrders ?? 0, 'active' => $activeOrders ?? 0, 'inactive' => $inactiveOrders ?? 0, 'color' => 'primary'],
            ['title' => 'Categories', 'total' => $totalCategories ?? 0, 'active' => $activeCategories ?? 0, 'inactive' => $inactiveCategories ?? 0, 'color' => 'secondary'],
            ['title' => 'Subcategories', 'total' => $totalSubCategories ?? 0, 'active' => $activeSubCategories ?? 0, 'inactive' => $inactiveSubCategories ?? 0, 'color' => 'teal'],
            ['title' => 'Products', 'total' => $totalProducts ?? 0, 'active' => $activeProducts ?? 0, 'inactive' => $inactiveProducts ?? 0, 'color' => 'info'],
            ['title' => 'Customers', 'total' => $totalCustomers ?? 0, 'active' => $activeCustomers ?? 0, 'inactive' => $inactiveCustomers ?? 0, 'color' => 'success'],
            ['title' => 'Stores', 'total' => $totalStores ?? 0, 'active' => $activeStores ?? 0, 'inactive' => $inactiveStores ?? 0, 'color' => 'dark'],
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
