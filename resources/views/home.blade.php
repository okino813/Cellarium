<html>
<head>
    <title>Cellarium</title>
</head>

<body>

{{-- Ici on va avoir deux choix : Retours d'inter ou Vérificaiton de l'engin--}}
<div class="container">
    <h1>Phramarcie du Centre de secours de {{ $caserne->city }}</h1>

    <div class="row">
        <a href="{{route("front.return-inter.index")}}">Retours d'intervention</a>
        <a href="{{route("front.verif.index")}}">Vérification des engins</a>
    </div>
</div>
<a href="{{route("logout")}}">Se déconnnecter ?</a>
</body>
</html>
