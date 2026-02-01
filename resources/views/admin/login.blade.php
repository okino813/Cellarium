<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Cellarium</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="container">
    <div class="card" style="max-width: 500px; margin: 50px auto;">
        <div style="text-align: center; margin-bottom: 30px;">
            <h1 style="font-size: 32px; color: #2c3e50; margin-bottom: 10px;">
                🔧 Administration
            </h1>
            <p style="color: #7f8c8d;">
                Connectez-vous pour accéder au back-office
            </p>
        </div>

        @if($errors->any())
            <div class="alert-error">
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        @if(session('error'))
            <div class="alert-error">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.validate') }}">
            @csrf

            <div style="margin-bottom: 20px;">
                <label for="code" style="display: block; margin-bottom: 5px; font-weight: bold;">
                    Code caserne :
                </label>
                <input
                    type="text"
                    name="code"
                    id="code"
                    class="input-field"
                    value="{{ old('code', $code ?? '') }}"
                    placeholder="Ex: 123456"
                    required
                >
            </div>

            <div style="margin-bottom: 20px;">
                <label for="email" style="display: block; margin-bottom: 5px; font-weight: bold;">
                    Adresse email :
                </label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="input-field"
                    value="{{ old('email') }}"
                    placeholder="admin@caserne.fr"
                    required
                >
            </div>

            <div style="margin-bottom: 20px;">
                <label for="password" style="display: block; margin-bottom: 5px; font-weight: bold;">
                    Mot de passe :
                </label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="input-field"
                    placeholder="••••••••"
                    required
                >
            </div>

            <button type="submit" class="btn" style="width: 100%; margin-top: 30px; background-color: #2c3e50;">
                Se connecter
            </button>
        </form>

        <div style="text-align: center; margin-top: 20px;">
            <a href="/" style="color: #7f8c8d; text-decoration: underline; font-size: 14px;">
                ← Retour à l'accueil
            </a>
        </div>
    </div>
</div>
</body>
</html>
