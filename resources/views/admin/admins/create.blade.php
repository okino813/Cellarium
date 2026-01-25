<form action="{{route("admin.admins.store")}}" method="POST">
    @csrf

    <label for="firstname">Prénom</label>
    <input type="text" name="firstname" id="firstname">

    <label for="lastname">Nom</label>
    <input type="text" name="lastname" id="lastname">

    <label for="email">Email</label>
    <input type="text" name="email" id="email">

    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password">

    <input type="submit" name="submit">


</form>
<style>
    form{
        display: flex;
        flex-direction: column;
    }

</style>
