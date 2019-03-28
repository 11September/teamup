<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>TeamUp Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">

    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="_token" content="{{ csrf_token() }}" />

    @include('partials.css')

    @yield('css')

</head>

<body>

<div id="preloader">
    <div class="loader"></div>
</div>

<div class="page-container">

    @include('partials.sidebar')

    <div class="main-content">

        @include('partials.header')

        @yield('content')

    </div>

    @include('partials.footer')
</div>

@include('partials.scripts')

@yield('scripts')

@yield('section-script')

</body>
</html>
