<h1>Voici la liste des items</h1>

<a href="{{route("admin.items.create")}}">Ajouter</a>
<table>
    <thead>
    <tr>
        <td>Nom</td>
        <td>Quantité stocké</td>
        <td>Etats</td>
        <td>Est stocké ?</td>
        <td>Action</td>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $item)
        <tr>
            <td>{{$item->name}}</td>
            <td>{{$item->total_qty}}</td>
            <td>{{$item->state  ? "Oui" : "Non"}}</td>
            <td>{{$item->is_stock ? "Oui" : "Non"}}</td>
            <td><a href="{{route("admin.items.edit", $item->id)}}">Modifer</a><br>
            <a href="{{route("admin.items.delete", $item->id)}}">Suprimé</a></td>
        </tr>
    @endforeach
    </tbody>
</table>


