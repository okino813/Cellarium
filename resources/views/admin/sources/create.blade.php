@extends('layout.app')
@section('content')
    <div class="admin-page">
        <h1 class="title-user">
            Ajouter une Source
        </h1>
        <p class="instruction">
            Créez une nouvelle source (véhicule, local, etc.)
        </p>

            @if($errors->any())
                <div class="alert-error" style="margin-bottom: 20px;">
                    <strong>Erreurs :</strong>
                    <ul style="margin: 10px 0 0 20px; padding: 0;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.sources.store') }}" method="POST">
                @csrf
                <div class="card form-item" >
                <!-- Nom -->
                    <label for="name" style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                        Nom de la source <span style="color: #e74c3c;">*</span>
                    </label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="input-field"
                        placeholder="Ex : Cabine conducteur"
                        value="{{ old('name') }}"
                        required
                    >
                    <small style="color: #7f8c8d; font-size: 13px;">
                        Exemples : Cellule VSAV, Medipack ...
                    </small>
                </div>

                <!-- Boutons -->
                    <button
                        type="submit"
                        class="btn-save btn-success"
                        style="flex: 1; padding: 14px; font-size: 16px; font-weight: bold;"
                    >
                        Créer la source
                    </button>

            </form>
        </div>
@endsection
