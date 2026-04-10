<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>@yield('title','Admin Panel')</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">

</head>

<body>

@include('admin.partials.adminheader')

<div class="main-wrapper">

    @include('admin.partials.sidebar')

    <main class="main-content px-md-4">
        @yield('content')
    </main>

</div>

@include('partials.footer')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/admin-dashboard.js') }}"></script>
<script src="{{ asset('js/admin.js') }}"></script>
@stack('scripts')
</body>
</html>