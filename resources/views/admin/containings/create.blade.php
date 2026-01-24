<form action="{{route("admin.containings.store")}}" method="POST">
    @csrf

    <label for="name">Nom</label>
    <input type="text" name="name" id="name">

    <label for="source_id">Nom</label>
    <select name="source_id" id="source_id">
        @foreach($sources as $source)
            <option value="{{$source->id}}">{{$source->name}}</option>
        @endforeach
    </select>

    <input type="submit" name="submit">


</form>
<style>
    form{
        display: flex;
        flex-direction: column;
    }

</style>
