<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $defaultSettings->site_title ?? null }}</title>
    @include('layouts.admin.dependency.css')
    @stack('css')
</head>

<body>
    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- sidebar @s -->
        @include('layouts.admin.partition.header')

        @include('layouts.admin.partition.left-menu')

        @include('layouts.admin.partition.horizontal')

        <div class="page-wrapper">
            <div class="content">
                <!-- start Page-content -->
                @section('content')
                @show
                <!-- end main content-->
            </div>
            <!-- footer @s -->
            @include('layouts.admin.partition.footer')
            <!-- footer @e -->
        </div>
        <!-- wrap @e -->
    </div>

    <!-- JAVASCRIPT -->
    @include('layouts.admin.dependency.js')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                notyf.error("{{ $error }}");
            </script>
        @endforeach
    @endif

    @if (session('success'))
        <script>
            notyf.success("{{ session('success') }}");
        </script>
    @endif
    @stack('scripts')
</body>

</html>
