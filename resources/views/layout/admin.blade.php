<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Cellarium</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background-color: #f8f9fa;">
@include('components.menu-admin')

<main style="padding-top: 20px;">
    @yield('content')
</main>
</body>
</html>
