<h1>Retours d'intervention</h1>
<p>Ici, renseignes les éléments pris dans la réserves !</p>
<body>
<div class="return-inter">
    <div class="container listItem">

    @foreach($items as $item)
            <p>{{ $item->name }}</p>
    @endforeach

    </div>

</div>

</body>
