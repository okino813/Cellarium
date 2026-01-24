<h1>Voici la liste des contenants</h1>

<a href="{{route("admin.containings.create")}}">Ajouter</a>
<table>
    <thead>
    <tr>
        <td>Nom</td>
        <td>Source associé</td>
        <td>Action</td>
    </tr>
    </thead>
    <tbody>
    @foreach($containings as $containing)
        <tr>
            <td>{{$containing->name}}</td>
            <td>{{$containing->source->name}}</td>
            <td><a href="{{route("admin.containings.edit", $containing->id)}}">Modifer</a><br>
            <a href="{{route("admin.containings.delete", $containing->id)}}">Suprimé</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
