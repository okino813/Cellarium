<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    @PwaHead
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cellarium - Pharmacie</title>
    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/app.jsx'])
    @inertiaHead
</head>
<body>
@inertia
@RegisterServiceWorkerScript
</body>
</html>
