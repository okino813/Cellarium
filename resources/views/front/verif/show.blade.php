
@foreach($contenants as $contenant)
    <h2>{{$contenant->name}}</h2>
    <ul>
        @foreach($contenant->items as $item)
            <li><input type="checkbox"> {{$item->pivot->qty_affect}} {{$item->name}} </li>
        @endforeach
    </ul>
@endforeach
