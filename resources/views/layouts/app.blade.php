<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    @yield('styles')
</head>
<body>
    <div class="container">
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    @yield('scripts')
</body>
</html>
