<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>@yield('title','Admin Panel')</title>

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">

</head>

<body>

@include('partials.header')

<div class="container-fluid">

<div class="row">

@include('admin.partials.sidebar')

<main class="col-md-10 ms-sm-auto px-md-4 py-4">

@yield('content')

</main>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@stack('scripts')

</body>

</html>