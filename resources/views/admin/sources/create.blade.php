<form action="{{route("admin.sources.store")}}" method="POST">
    @csrf

    <label for="name">Nom</label>
    <input type="text" name="name" id="name">

    <input type="submit" name="submit">


</form>
<style>
    form{
        display: flex;
        flex-direction: column;
    }

</style>
