<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    @PwaHead
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cellarium - Pharmacie</title>
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="icon" type="image/png" href="{{ asset('trans_logo.png') }}">
    @viteReactRefresh
    @vite(['resources/css/app.scss', 'resources/js/app.jsx'])
    @inertiaHead
</head>
<body>
@inertia
@RegisterServiceWorkerScript
</body>
</html>
