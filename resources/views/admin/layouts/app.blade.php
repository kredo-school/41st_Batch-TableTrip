<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>

    <!-- Bootstrap -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>

<div class="container-fluid">
<div class="row">

@include('admin.partials.sidebar')

<main class="px-md-4 py-4">

@yield('content')

</main>

</div>
</div>

<script>

document.querySelectorAll('.menu-title').forEach(item => {

item.addEventListener('click', () => {

item.parentElement.classList.toggle('active');

});

});

</script>

</body>
</html>