<!DOCTYPE html>
<html lang="en">

<head>
    @stack('meta')
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $defaultSettings->site_title ?? null }}</title>
    {{-- <title>ISICO - INDIAN SKILL INSTUTUTE CO-OPERATION</title> --}}
    @include('layouts.web.dependency.css')
</head>

<body>
    {{-- @include('layouts.web.loader.index') --}}

    @include('layouts.web.partition.header')
    <!-- Main Sections -->
    <main class="main-wrapper">
        @section('content')

        @show

        @include('layouts.web.partition.footer')

    </main>
    @include('layouts.web.partition.menu')
    @include('layouts.web.dependency.js')
    @stack('scripts')
</body>

</html>
