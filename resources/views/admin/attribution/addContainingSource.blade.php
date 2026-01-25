
    <h1>Associer un contenant à une source</h1>

    <form action="{{ route('admin.attribution.addContainingSource.validate') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="contenant">Contenant</label>
            <select name="contenant" id="contenant" class="form-control" required>
                @foreach($contenants as $contenant)
                    <option value="{{ $contenant->id }}">{{ $contenant->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="source">Source</label>
            <select name="source" id="source" class="form-control" required>
                @foreach($sources as $source)
                    <option value="{{ $source->id }}">{{ $source->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Associer</button>
    </form>

    <a href="{{ route('admin.attribution.index') }}" class="btn btn-secondary">Retour</a>
