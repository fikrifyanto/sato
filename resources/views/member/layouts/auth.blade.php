<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Member Auth' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-200">
    <main class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
        @yield('content')
    </main>
</body>
</html>
