<html>
<head>
    <title>Cellarium</title>
</head>

<body>

<div class="container">
    <h1>Cellarium</h1>

    <div class="formulaire">
        <form method="POST" action="/login">
            @csrf
            <label for="code">Code :</label>
            <input type="text" name="code" id="code" value="{{ $code ?? '' }}" required>
            <label for="firstname">Prénom :</label>
            <input type="text" id="firstname" name="firstname" required>
            <button type="submit">Valider</button>
        </form>
    </div>
</div>

</body>
</html>
