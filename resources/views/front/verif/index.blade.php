Choisissez la source
@foreach($sources as $source)
    <p>{{$source->name}} : <a href="{{route("front.verif.show", $source->id)}}">Voir</a></p>
@endforeach
