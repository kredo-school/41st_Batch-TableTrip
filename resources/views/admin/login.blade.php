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

<body class="d-flex align-items-center justify-content-center vh-100">

<div class="card shadow-sm login-card" style="width:400px;">
    <h1 class="text-center mb-4">Admin Portal</h3>

    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="mb-4">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="d-flex justify-content-center">
            <button type="submit"  class="btn btn-admin w-25 d-block max-auto mt-1">
                Login
            </button>
        </div>
    </form>
</div>

</body>
</html>