@extends('layouts.admin.app')

@section('content')

<!-- Dashboard Header -->
<div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
    <div>
        <h1 class="mb-1">Welcome, Admin</h1>
        <p class="fw-medium">You have <span class="text-primary fw-bold">0</span> Items to Review Today</p>
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
        $cards = ['Categories', 'Sectors', 'Courses', 'Projects', 'Blogs'];
        $colors = ['secondary', 'teal', 'info', 'success', 'dark'];
    @endphp

    @foreach ($cards as $index => $title)
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-light h-100">
                <div class="card-body">
                    <h5 class="mb-3 text-{{ $colors[$index] }}">{{ $title }}</h5>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Total</span>
                        <span class="fw-bold text-dark total-count">0</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Active</span>
                        <span class="fw-bold text-success active-count">0</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Inactive</span>
                        <span class="fw-bold text-danger inactive-count">0</span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const keys = ['categories','sectors','courses','projects','blogs'];

    function fetchStats() {
        fetch("{{ route('admin.dashboard.stats') }}")
            .then(response => response.json())
            .then(data => {
                document.querySelectorAll('.card').forEach((card, index) => {
                    const key = keys[index];
                    if(data[key]){
                        card.querySelector('.total-count').textContent = data[key].total;
                        card.querySelector('.active-count').textContent = data[key].active;
                        card.querySelector('.inactive-count').textContent = data[key].inactive;
                    }
                });
            })
            .catch(err => console.error('Error fetching stats:', err));
    }

    fetchStats();
    setInterval(fetchStats, 30000); // Refresh every 30 seconds
});
</script>

@endsection
