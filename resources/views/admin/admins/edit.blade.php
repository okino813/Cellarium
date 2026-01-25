<form action="{{route("admin.admins.update", $admin->id)}}" method="POST">
    @csrf

    <label for="firstname">Prénom</label>
    <input type="text" name="firstname" id="firstname" value="{{$admin->firstname}}">

    <label for="lastname">Nom</label>
    <input type="text" name="lastname" id="lastname" value="{{$admin->lastname}}">

    <label for="email">Email</label>
    <input type="text" name="email" id="email" value="{{$admin->email}}">

    <input type="submit" name="submit">

</form>

<form action="{{route("admin.admins.updatePassword", $admin->id)}}" method="POST">
    @csrf

    <label for="newPassword">Nouveau mot de passe</label>
    <input type="password" name="newPassword" id="newPassword">

    <label for="ConfNewPassword">Confirmation du nouveau mot de passe</label>
    <input type="password" name="ConfNewPassword" id="ConfNewPassword">

    <input type="submit" name="submit">

</form>
<style>
    form{
        display: flex;
        flex-direction: column;
    }

</style>
