
    <h1>Modifier l'association pour {{ $containing->name }}</h1>

    <form action="{{ route('admin.attribution.updateContainingSource', $containing->id) }}" method="POST">
        @csrf
        @method('POST') <!-- ou PUT si tu préfères -->

        <div class="form-group">
            <label for="source">Source actuelle : {{ $source->name }}</label>
            <select name="source_id" id="source" class="form-control" required>
                @foreach(\App\Models\Source::all() as $availableSource)
                    <option value="{{ $availableSource->id }}"
                        {{ $availableSource->id === $source->id ? 'selected' : '' }}>
                        {{ $availableSource->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>

    <a href="{{ route('admin.attribution.index') }}" class="btn btn-secondary">Retour</a>

