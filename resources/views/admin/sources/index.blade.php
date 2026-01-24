<h1>Voici la liste des sources</h1>

<a href="{{route("admin.sources.create")}}">Ajouter</a>
<table>
    <thead>
    <tr>
        <td>Nom</td>
        <td>Action</td>
    </tr>
    </thead>
    <tbody>
    @foreach($sources as $source)
        <tr>
            <td>{{$source->name}}</td>
            <td><a href="{{route("admin.sources.edit", $source->id)}}">Modifer</a><br>
            <a href="{{route("admin.sources.delete", $source->id)}}">Suprimé</a></td>
        </tr>
    @endforeach
    </tbody>
</table>


