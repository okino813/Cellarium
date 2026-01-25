<h1>La listes des attibutions</h1>

<p>Associé des Item à des Contenants : <a href="{{route("admin.attribution.addItemContaining")}}">Ici</a></p>
<p>Associé des Contenants à des Sources : <a href="{{route("admin.attribution.addContainingSource")}}">Ici</a></p>


<h2>La liste des items associé aux contenants</h2>
<table>
    <thead>
    <tr>
        <td>Item</td>
        <td>Contenant</td>
        <td>Quantité</td>
        <td>Action</td>
    </tr>
    </thead>
    <tbody>
    @foreach($containingWithItems as $containing)
        @foreach($containing->items as $item)
            <tr>
                <td>{{$item->name}}</td>
                <td>{{$containing->name}}</td>
                <td>{{$item->pivot->qty_affect}}</td>
                <td>
                    <a href="{{route("admin.attribution.addItemContaining.edit", [$containing->id, $item->id])}}">Modifié</a><br>
                    <a href="{{route("admin.attribution.ItemContaining.delete", [$containing->id, $item->id])}}">Supprimer</a>
                </td>
            </tr>
        @endforeach
    @endforeach
    </tbody>
</table>

<h2>La liste des contenants associé aux sources</h2>
<table>
    <thead>
    <tr>
        <td>Contenant</td>
        <td>Sources</td>
        <td>Action</td>
    </tr>
    </thead>
    <tbody>
    @foreach($sourcesWithContainings as $source)
        @foreach($source->containings as $containing)
            <tr>
                <td>{{$containing->name}}</td>
                <td>{{$source->name}}</td>
                <td>
                    <a href="{{route("admin.attribution.editContainingSource", [$containing->id, $source->id])}}">Modifié</a><br>
                    <a href="{{route("admin.attribution.deleteContainingSource", [$containing->id])}}">Supprimer</a>
                </td>
            </tr>
        @endforeach
    @endforeach
    </tbody>
</table>
