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

<div class="row g-4">
    @php
        // Dynamically define widget config
        $cards = [
            'categories' => ['title' => 'Categories', 'color' => 'secondary', 'icon' => 'ti ti-category'],
            'sectors'    => ['title' => 'Sectors', 'color' => 'teal', 'icon' => 'ti ti-briefcase'],
            'courses'    => ['title' => 'Courses', 'color' => 'info', 'icon' => 'ti ti-book'],
            'projects'   => ['title' => 'Projects', 'color' => 'success', 'icon' => 'ti ti-clipboard-list'],
            'blogs'      => ['title' => 'Blogs', 'color' => 'dark', 'icon' => 'ti ti-edit'],
            'enquiries'  => ['title' => 'Enquiries', 'color' => 'warning', 'icon' => 'ti ti-help-circle'],
            'students'   => ['title' => 'Students', 'color' => 'primary', 'icon' => 'ti ti-users'],
        ];
    @endphp

    @foreach ($cards as $key => $card)
        <div class="col-xl-3 col-md-4">
            <div class="card border-0 shadow-sm bg-light h-100 position-relative outline-{{ $card['color'] }}">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="mb-0 text-{{ $card['color'] }}">{{ $card['title'] }}</h5>
                        <div class="text-{{ $card['color'] }} fs-24 bg-white p-2 rounded shadow-sm">
                            <i class="{{ $card['icon'] }}"></i>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted">Total</span>
                        <span class="fw-bold text-dark fs-18" id="{{ $key }}-total">0</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted">Active</span>
                        <span class="fw-bold text-success" id="{{ $key }}-active">0</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">Inactive</span>
                        <span class="fw-bold text-danger" id="{{ $key }}-inactive">0</span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Dashboard Charts -->
<div class="row g-4 mt-2">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white align-items-center d-flex justify-content-between">
                <h5 class="mb-0">Website Traffic & Enquiries</h5>
                <select class="form-select form-select-sm w-auto">
                    <option>This Week</option>
                    <option>This Month</option>
                    <option>This Year</option>
                </select>
            </div>
            <div class="card-body">
                <canvas id="mainChart" height="100"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Content Distribution</h5>
            </div>
            <div class="card-body d-flex justify-content-center">
                <canvas id="pieChart" height="250"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const keys = ['categories','sectors','courses','projects','blogs'];

    function fetchStats() {
        fetch("{{ route('admin.dashboard.stats') }}")
            .then(response => response.json())
            .then(data => {
                const keys = Object.keys(data);
                keys.forEach(key => {
                    if (document.getElementById(`${key}-total`)) {
                        document.getElementById(`${key}-total`).textContent = data[key].total || 0;
                        document.getElementById(`${key}-active`).textContent = data[key].active || 0;
                        document.getElementById(`${key}-inactive`).textContent = data[key].inactive || 0;
                    }
                });

                // Update charts if data exists logic here
                initCharts();
            })
            .catch(err => console.error('Error fetching stats:', err));
    }

    fetchStats();
    setInterval(fetchStats, 60000); // Refresh every 60 seconds

    function initCharts() {
        if(window.chartsInitialized) return;
        window.chartsInitialized = true;

        const ctx = document.getElementById('mainChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Website Visits',
                    data: [120, 190, 150, 220, 180, 250, 300],
                    borderColor: '#2196f3',
                    tension: 0.4,
                    fill: false
                }, {
                    label: 'New Enquiries',
                    data: [30, 50, 40, 60, 45, 70, 90],
                    borderColor: '#4caf50',
                    tension: 0.4,
                    fill: false
                }]
            },
            options: { responsive: true }
        });

        const ctxPie = document.getElementById('pieChart').getContext('2d');
        new Chart(ctxPie, {
            type: 'doughnut',
            data: {
                labels: ['Courses', 'Events', 'Blogs'],
                datasets: [{
                    data: [45, 25, 30],
                    backgroundColor: ['#0dcaf0', '#20c997', '#212529']
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });
    }
});
</script>

@endsection
