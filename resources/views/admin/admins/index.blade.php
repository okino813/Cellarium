<h1>Voici la liste des Admins</h1>

<a href="{{route("admin.admins.create")}}">Ajouter</a>
<table>
    <thead>
    <tr>
        <td>Prénom</td>
        <td>Nom</td>
        <td>email</td>
        <td>Action</td>
    </tr>
    </thead>
    <tbody>
    @foreach($admins as $admin)
        <tr>
            <td>{{$admin->firstname}}</td>
            <td>{{$admin->lastname}}</td>
            <td>{{$admin->email}}</td>
            <td><a href="{{route("admin.admins.edit", $admin->id)}}">Modifer</a><br>
            <a href="{{route("admin.admins.delete", $admin->id)}}">Suprimé</a></td>
        </tr>
    @endforeach
    </tbody>
</table>


