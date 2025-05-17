<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Home Protegida</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @auth
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container">
            <span class="navbar-brand">Bem-vindo, {{ auth()->user()->name }}</span>
            <div class="ms-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-outline-danger btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>
    @endauth

    <main class="py-4">
        @yield('content')
    </main>
</body>
</html>
