<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    @PwaHead
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cellarium - Pharmacie</title>
    @vite(['resources/css/app.scss', 'resources/js/app.jsx'])
</head>

<body class="content-mobile">
<main>
    @yield('content')
</main>
@RegisterServiceWorkerScript
</body>
</html>
