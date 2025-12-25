<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Sato - Login' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/app-logo.png') }}">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen flex items-center justify-center bg-white">
    @yield('content')
</body>

</html>
