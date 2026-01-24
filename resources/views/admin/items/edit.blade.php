<form action="{{route("admin.items.update", $item->id)}}" method="POST">
    @csrf

    <label for="name">Nom</label>
    <input type="text" name="name" id="name" value="{{$item->name}}">

    <label for="total_qty">Quantité en stock</label>
    <input type="number" name="total_qty" id="total_qty" value="{{$item->total_qty}}">

    <label for="state">Etats</label>
    <select name="state" id="state">
        <option value="1" {{ $item->state == 1 ? "selected" : "" }}>Activer</option>
        <option value="0" {{ $item->state == 0 ? "selected" : "" }}>Désactiver</option>

    </select>

    <label for="is_stock">Est stocké ?</label>
    <select name="is_stock" id="is_stock">
        <option value="1" {{$item->is_stock == 1 ? "selected" : ''}}>Oui</option>
        <option value="0" {{$item->is_stock == 0 ? "selected" : ''}}>Non</option>
    </select>


    <input type="submit" name="submit">


</form>
<style>
    form{
        display: flex;
        flex-direction: column;
    }

</style>
