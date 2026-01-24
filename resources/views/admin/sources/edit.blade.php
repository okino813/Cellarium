<form action="{{route("admin.sources.update", $source->id)}}" method="POST">
    @csrf

    <label for="name">Nom</label>
    <input type="text" name="name" id="name" value="{{$source->name}}">

    <input type="submit" name="submit">


</form>
<style>
    form{
        display: flex;
        flex-direction: column;
    }

</style>
