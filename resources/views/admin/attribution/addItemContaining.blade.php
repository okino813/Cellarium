<h1>Attribuer des items à des contenants</h1>

<form action="{{ route('admin.attribution.addItemContaining.validate') }}" method="POST">
    @csrf
    <div>
        <label>Item</label>
        <select name="item">
            @foreach($items as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Contenant</label>
        <select name="contenant">
            @foreach($contenants as $contenant)
                <option value="{{ $contenant->id }}">{{ $contenant->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Quantité</label>
        <input type="number" name="qty" min="1" required>
    </div>

    <button type="submit">Ajouter</button>
</form>
