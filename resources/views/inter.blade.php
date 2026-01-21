<h1>Retours d'intervention</h1>
<p>Ici, renseignes les éléments pris dans la réserves !</p>

@foreach($items as $item)
    <p>{{ $item->name }}</p>
@endforeach
