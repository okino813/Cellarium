<h1>Modifier la quantité pour {{ $item->name }} dans {{ $containing->name }}</h1>

<form action="{{ route('admin.attribution.addItemContaining.update', $containing->id) }}" method="POST">
    @csrf
    <input type="hidden" name="item_id" value="{{ $item->id }}">

    <div>
        <label for="qty">Quantité</label>
        <input type="number" name="qty" id="qty" value="{{ $currentQty }}" min="1" required>
    </div>

    <button type="submit">Mettre à jour</button>
</form>

<a href="{{ route('admin.attribution.index') }}">Retour</a>
