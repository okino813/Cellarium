@extends('layout.admin')

@section('content')
    <div class="container" style="max-width: 800px;">
        <div style="margin-bottom: 30px;">
            <h1 style="font-size: 32px; color: #2c3e50; margin-bottom: 5px;">
                Modifier la Source
            </h1>
            <p style="color: #7f8c8d; margin: 0;">
                Modifiez les informations de <strong>{{ $source->name }}</strong>
            </p>
        </div>

        <div class="card">
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

            @if(session('success'))
                <div class="alert-success" style="margin-bottom: 20px;">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.sources.update', $source->id) }}" method="POST">
                @csrf

                <!-- Nom -->
                <div style="margin-bottom: 20px; padding-left: 20px; padding-right: 20px;">
                    <label for="name" style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                        Nom de la source <span style="color: #e74c3c;">*</span>
                    </label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="input-field"
                        placeholder="Ex : VSAV 1, FPTSR, Réserve principale..."
                        value="{{ old('name', $source->name) }}"
                        required
                    >
                    <small style="color: #7f8c8d; font-size: 13px;">
                        Exemples : VSAV (Véhicule), FPTSR, VTU, Réserve, Armoire pharmacie...
                    </small>
                </div>

                <!-- Boutons -->
                <div style="display: flex; gap: 15px; border-top: 2px solid #dee2e6; padding-top: 20px; margin-top: 30px;">
                    <button
                        type="submit"
                        class="btn btn-success"
                        style="flex: 1; padding: 14px; font-size: 16px; font-weight: bold;"
                    >
                        Enregistrer les modifications
                    </button>

                    <a href="{{ route('admin.sources.index') }}"
                    style="flex: 1; padding: 14px; font-size: 16px; font-weight: bold; text-align: center; background-color: #6c757d; color: white; text-decoration: none; border-radius: 4px; transition: background 0.3s;"
                    onmouseover="this.style.backgroundColor='#5a6268'"
                    onmouseout="this.style.backgroundColor='#6c757d'"
                    >
                    Annuler
                    </a>
                </div>
            </form>
        </div>

        <!-- Informations supplémentaires -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-top: 20px;">
            <div style="padding: 15px; background-color: #fff3e0; border-radius: 8px; border-left: 4px solid #FF9800;">
                <p style="margin: 0; font-size: 12px; color: #E65100; font-weight: 600;">MODIFIÉ LE</p>
                <p style="margin: 5px 0 0 0; font-size: 14px; color: #BF360C;">{{ $source->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        <!-- Zone de danger -->
        <div style="margin-top: 30px; padding: 20px; background-color: #fff5f5; border-radius: 8px; border: 2px solid #e74c3c;">
            <h3 style="color: #e74c3c; margin: 0 0 10px 0; font-size: 18px;">Zone de danger</h3>
            <p style="color: #721c24; margin: 0 0 15px 0; font-size: 14px;">
                La suppression de cette source est irréversible. Toutes les données associées seront perdues.
            </p>
            <a
                href="{{ route('admin.sources.delete', $source->id) }}"
                onclick="return confirm('ATTENTION\n\nÊtes-vous absolument sûr de vouloir supprimer cette source ?\n\nCette action est IRRÉVERSIBLE et supprimera :\n- La source {{ $source->name }}\n- Tous ses contenants\n- Toutes ses attributions\n\nTapez OK pour confirmer la suppression.')"
                style="display: inline-block; padding: 12px 24px; background-color: #e74c3c; color: white; text-decoration: none; border-radius: 4px; font-weight: bold; transition: background 0.3s;"
                onmouseover="this.style.backgroundColor='#c82333'"
                onmouseout="this.style.backgroundColor='#e74c3c'"
            >
                Supprimer définitivement cette source
            </a>
        </div>
    </div>

    <style>
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }
            h1 {
                font-size: 24px !important;
            }
            .btn {
                font-size: 14px !important;
                padding: 12px !important;
            }
        }
    </style>
@endsection
