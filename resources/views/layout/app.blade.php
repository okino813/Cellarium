<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cellarium - Pharmacie</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="content-mobile">
@include('components.bandeauTop')

<main>
    @yield('content')
</main>
</body>
<footer>
    @include('components.footer-user')
</footer>
</html>
