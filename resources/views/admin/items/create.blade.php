<form action="{{route("admin.items.store")}}" method="POST">
    @csrf

    <label for="name">Nom</label>
    <input type="text" name="name" id="name">

    <label for="total_qty">Quantité en stock</label>
    <input type="number" name="total_qty" id="total_qty">

    <label for="state">Etats</label>
    <select name="state" id="state">
        <option value="1">Activer</option>
        <option value="0">Désactiver</option>
    </select>

    <label for="is_stock">Est stocké ?</label>
    <select name="is_stock" id="is_stock">
        <option value="1">Oui</option>
        <option value="0">Non</option>
    </select>


    <input type="submit" name="submit">


</form>
<style>
    form{
        display: flex;
        flex-direction: column;
    }

</style>
