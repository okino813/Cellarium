<html>
<head>
    <title>Cellarium</title>
</head>

<body>

<div class="container">
    <h1>Cellarium</h1>

    <div class="formulaire">
        <form method="POST" action="{{route("admin.login.validate")}}">
            @csrf
            <label for="code">Code :</label>
            <input type="text" name="code" id="code" value="{{ $code ?? '' }}" required>
            <label for="email">Adresse mail :</label>
            <input type="text" id="email" name="email" required>
            <label for="password">Mot de passe :</label>
            <input type="text" id="password" name="password" required>
            <button type="submit">Valider</button>
        </form>
    </div>
</div>

</body>
</html>
