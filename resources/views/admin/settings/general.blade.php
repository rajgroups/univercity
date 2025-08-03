@extends('layouts.admin.app')
@section('content')
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Edit Home Settings</h4>
                <h6>Update website home page settings</h6>
            </div>
        </div>
        <ul class="table-top-head">
            <li><a data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Refresh"><i class="ti ti-refresh"></i></a></li>
            <li><a data-bs-toggle="tooltip" data-bs-placement="top" id="collapse-header" aria-label="Collapse"><i
                        class="ti ti-chevron-up"></i></a></li>
        </ul>
        <div class="page-btn mt-0">
            <a href="{{ route('admin.home') }}" class="btn btn-secondary">
                <i class="feather feather-arrow-left me-2"></i>Back to Dashboard
            </a>
        </div>
    </div>
    <ul class="nav nav-tabs nav-tabs-solid bg-transparent border-bottom mb-3">
        <li class="nav-item">
            <a class="nav-link active" href="#"><i class="ti ti-settings me-2"></i>General Settings</a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" href="#"><i class="ti ti-world-cog me-2"></i>Website
                Settings</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#"><i class="ti ti-device-ipad-horizontal-cog me-2"></i>App
                Settings</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="3"><i class="ti ti-server-cog me-2"></i>System Settings</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#"><i class="ti ti-settings-dollar me-2"></i>Financial
                Settings</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#"><i class="ti ti-settings-2 me-2"></i>Other Settings</a>
        </li> --}}
    </ul>
    <div class="row" style="transform: none;">
        <div class="col-xl-3 theiaStickySidebar"
            style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">

            <div class="theiaStickySidebar"
                style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none; left: 276px; top: 0px;">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column list-group settings-list">
                            <a href="#"
                                class="d-inline-flex align-items-center rounded active py-2 px-3"><i
                                    class="ti ti-arrow-badge-right me-2"></i>Basic Settings</a>
                        </div>
                    </div>
                </div>
                <div dir="ltr" class="resize-sensor"
                    style="pointer-events: none; position: absolute; inset: 0px; overflow: hidden; z-index: -1; visibility: hidden; max-width: 100%;">
                    <div class="resize-sensor-expand"
                        style="pointer-events: none; position: absolute; inset: 0px; overflow: hidden; z-index: -1; visibility: hidden; max-width: 100%;">
                        <div style="position: absolute; left: 0px; top: 0px; transition: all; width: 277px; height: 409px;">
                        </div>
                    </div>
                    <div class="resize-sensor-shrink"
                        style="pointer-events: none; position: absolute; inset: 0px; overflow: hidden; z-index: -1; visibility: hidden; max-width: 100%;">
                        <div style="position: absolute; left: 0px; top: 0px; transition: all; width: 200%; height: 200%;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9">
            <div class="card">
                <div class="card-body">
                    <div class="border-bottom mb-3 pb-3">
                        <h4>General Settings</h4>
                    </div>
                        {{-- Success Message --}}
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        {{-- Error Message --}}
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    <form action="{{ route('admin.setting.general.update') }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('POST')

                        <div class="container mt-4">

                            <!-- Site Settings -->
                            <h4 class="mb-3">Site Settings</h4>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="site_title" class="form-label">Site Title</label>
                                    <input type="text" class="form-control" id="site_title" name="site_title"
                                        value="{{ old('site_title', $settings->site_title ?? '') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="site_logo" class="form-label">Site Logo</label>
                                    <input type="file" class="form-control" id="site_logo" name="site_logo"
                                        accept="image/*">
                                </div>
                                <div class="col-md-6">
                                    <label for="favicon" class="form-label">Favicon</label>
                                    <input type="file" class="form-control" id="favicon" name="favicon"
                                        accept="image/*">
                                </div>
                                <div class="col-md-6">
                                    <label for="loader_image" class="form-label">Loader Image</label>
                                    <input type="file" class="form-control" id="loader_image" name="loader_image"
                                        accept="image/*">
                                </div>
                            </div>

                            <!-- Contact Info -->
                            <h4 class="mb-3">Contact Info</h4>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="contact_email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="contact_email" name="contact_email"
                                        value="{{ old('contact_email', $settings->contact_email ?? '') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="contact_phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="contact_phone" name="contact_phone"
                                        value="{{ old('contact_phone', $settings->contact_phone ?? '') }}" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="contact_address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="contact_address"
                                        name="contact_address"
                                        value="{{ old('contact_address', $settings->contact_address ?? '') }}">
                                </div>
                                <div class="col-md-12">
                                    <label for="contact_map_embed" class="form-label">Google Map Embed Code</label>
                                    <textarea class="form-control" name="contact_map_embed" id="contact_map_embed" rows="3">{{ old('contact_map_embed', $settings->contact_map_embed ?? '') }}</textarea>
                                </div>
                            </div>

                            <!-- About Page -->
                            <h4 class="mb-3">About Section</h4>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="about_title" class="form-label">About Title</label>
                                    <input type="text" class="form-control" id="about_title" name="about_title"
                                        value="{{ old('about_title', $settings->about_title ?? '') }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="about_image" class="form-label">About Image</label>
                                    <input type="file" class="form-control" id="about_image" name="about_image"
                                        accept="image/*">
                                </div>

                                <div class="col-md-12">
                                    <label for="about_description" class="form-label">Description</label>
                                    <textarea class="form-control" name="about_description" id="about_description" rows="4">{{ old('about_description', $settings->about_description ?? '') }}</textarea>
                                </div>
                            </div>

                            <!-- Social Media -->
                            <h4 class="mb-3">Social Media</h4>
                            <div class="row g-3 mb-4">
                                @php
                                    $socials = ['facebook', 'twitter', 'instagram', 'linkedin', 'youtube'];
                                @endphp
                                @foreach ($socials as $platform)
                                    <div class="col-md-6">
                                        <label for="{{ $platform }}"
                                            class="form-label text-capitalize">{{ ucfirst($platform) }}</label>
                                        <input type="url" class="form-control" id="{{ $platform }}"
                                            name="{{ $platform }}"
                                            value="{{ old($platform, $settings->$platform ?? '') }}">
                                    </div>
                                @endforeach
                            </div>

                            <!-- Currency -->
                            <h4 class="mb-3">Currency Settings</h4>
                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label for="currency_name" class="form-label">Currency Name</label>
                                    <input type="text" class="form-control" id="currency_name" name="currency_name"
                                        value="{{ old('currency_name', $settings->currency_name ?? '') }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="currency_symbol" class="form-label">Currency Symbol</label>
                                    <input type="text" class="form-control" id="currency_symbol"
                                        name="currency_symbol"
                                        value="{{ old('currency_symbol', $settings->currency_symbol ?? '') }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="currency_rate" class="form-label">Currency Rate</label>
                                    <input type="number" step="0.01" class="form-control" id="currency_rate"
                                        name="currency_rate"
                                        value="{{ old('currency_rate', $settings->currency_rate ?? 1) }}">
                                </div>
                            </div>

                            <!-- SMTP Settings -->
                            <h4 class="mb-3">SMTP Settings</h4>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="smtp_enabled" class="form-label">SMTP Enabled</label>
                                    <select class="form-select" name="smtp_enabled" id="smtp_enabled">
                                        <option value="0"
                                            {{ old('smtp_enabled', $settings->smtp_enabled ?? 0) == 0 ? 'selected' : '' }}>
                                            No</option>
                                        <option value="1"
                                            {{ old('smtp_enabled', $settings->smtp_enabled ?? 0) == 1 ? 'selected' : '' }}>
                                            Yes</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="smtp_host" class="form-label">SMTP Host</label>
                                    <input type="text" class="form-control" id="smtp_host" name="smtp_host"
                                        value="{{ old('smtp_host', $settings->smtp_host ?? '') }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="smtp_port" class="form-label">Port</label>
                                    <input type="number" class="form-control" id="smtp_port" name="smtp_port"
                                        value="{{ old('smtp_port', $settings->smtp_port ?? '') }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="smtp_encryption" class="form-label">Encryption</label>
                                    <select class="form-select" name="smtp_encryption" id="smtp_encryption">
                                        <option value="">None</option>
                                        <option value="ssl"
                                            {{ old('smtp_encryption', $settings->smtp_encryption ?? '') == 'ssl' ? 'selected' : '' }}>
                                            SSL</option>
                                        <option value="tls"
                                            {{ old('smtp_encryption', $settings->smtp_encryption ?? '') == 'tls' ? 'selected' : '' }}>
                                            TLS</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="smtp_username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="smtp_username" name="smtp_username"
                                        value="{{ old('smtp_username', $settings->smtp_username ?? '') }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="smtp_password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="smtp_password" name="smtp_password">
                                </div>
                                <div class="col-md-4">
                                    <label for="smtp_from_email" class="form-label">From Email</label>
                                    <input type="email" class="form-control" id="smtp_from_email"
                                        name="smtp_from_email"
                                        value="{{ old('smtp_from_email', $settings->smtp_from_email ?? '') }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="smtp_from_name" class="form-label">From Name</label>
                                    <input type="text" class="form-control" id="smtp_from_name" name="smtp_from_name"
                                        value="{{ old('smtp_from_name', $settings->smtp_from_name ?? '') }}">
                                </div>
                            </div>

                            <!-- Footer and SEO -->
                            <h4 class="mb-3">SEO & Footer</h4>
                            <div class="row g-3 mb-4">
                                <div class="col-md-12">
                                    <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                    <textarea class="form-control" name="meta_keywords" rows="2">{{ old('meta_keywords', $settings->meta_keywords ?? '') }}</textarea>
                                </div>
                                <div class="col-md-12">
                                    <label for="meta_description" class="form-label">Meta Description</label>
                                    <textarea class="form-control" name="meta_description" rows="2">{{ old('meta_description', $settings->meta_description ?? '') }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="google_analytics_id" class="form-label">Google Analytics ID</label>
                                    <input type="text" class="form-control" id="google_analytics_id"
                                        name="google_analytics_id"
                                        value="{{ old('google_analytics_id', $settings->google_analytics_id ?? '') }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="footer_gateway_image" class="form-label">Footer Payment Icons</label>
                                    <input type="file" class="form-control" id="footer_gateway_image"
                                        name="footer_gateway_image">
                                </div>
                                <div class="col-md-12">
                                    <label for="footer_text" class="form-label">Footer About Text</label>
                                    <textarea class="form-control" name="footer_text" rows="2">{{ old('footer_text', $settings->footer_text ?? '') }}</textarea>
                                </div>
                                <div class="col-md-12">
                                    <label for="footer_copyright" class="form-label">Footer Copyright</label>
                                    <textarea class="form-control" name="footer_copyright" rows="2">{{ old('footer_copyright', $settings->footer_copyright ?? '') }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="footer_email" class="form-label">Footer Email</label>
                                    <input type="email" class="form-control" id="footer_email" name="footer_email"
                                        value="{{ old('footer_email', $settings->footer_email ?? '') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="footer_phone" class="form-label">Footer Phone</label>
                                    <input type="text" class="form-control" id="footer_phone" name="footer_phone"
                                        value="{{ old('footer_phone', $settings->footer_phone ?? '') }}" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="footer_address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="footer_address" name="footer_address"
                                        value="{{ old('footer_address', $settings->footer_address ?? '') }}">
                                </div>
                            </div>

                            <!-- Maintenance Mode -->
                            <h4 class="mb-3">Maintenance & Announcement</h4>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="maintenance_mode" class="form-label">Maintenance Mode</label>
                                    <select class="form-select" name="maintenance_mode" id="maintenance_mode">
                                        <option value="0"
                                            {{ old('maintenance_mode', $settings->maintenance_mode ?? 0) == 0 ? 'selected' : '' }}>
                                            Off</option>
                                        <option value="1"
                                            {{ old('maintenance_mode', $settings->maintenance_mode ?? 0) == 1 ? 'selected' : '' }}>
                                            On</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="announcement_enabled" class="form-label">Announcement Enabled</label>
                                    <select class="form-select" name="announcement_enabled" id="announcement_enabled">
                                        <option value="0"
                                            {{ old('announcement_enabled', $settings->announcement_enabled ?? 0) == 0 ? 'selected' : '' }}>
                                            No</option>
                                        <option value="1"
                                            {{ old('announcement_enabled', $settings->announcement_enabled ?? 0) == 1 ? 'selected' : '' }}>
                                            Yes</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label for="announcement_text" class="form-label">Announcement Text</label>
                                    <textarea class="form-control" name="announcement_text" rows="2">{{ old('announcement_text', $settings->announcement_text ?? '') }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="maintenance_image" class="form-label">Maintenance Image</label>
                                    <input type="file" class="form-control" name="maintenance_image"
                                        id="maintenance_image" accept="image/*">
                                </div>
                                <div class="col-md-6">
                                    <label for="maintenance_text" class="form-label">Maintenance Text</label>
                                    <textarea class="form-control" name="maintenance_text" rows="2">{{ old('maintenance_text', $settings->maintenance_text ?? '') }}</textarea>
                                </div>
                            </div>

                            <!-- Submit -->
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary px-4">Save Settings</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
