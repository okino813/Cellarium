@extends('layout.app')

@section('content')
    <div class="admin-page">
        <h1 class="title-user">
            Modifier la Source
        </h1>
        <p class="instruction">
            Modifiez les informations de <strong>{{ $source->name }}</strong>
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

        @if(session('success'))
            <div class="alert-success" style="margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.sources.update', $source->id) }}" method="POST">
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
                        placeholder="Ex : VSAV 1, FPTSR, Réserve principale..."
                        value="{{ old('name', $source->name) }}"
                        required
                    >

            </div>

                <!-- Boutons -->
                <button
                    type="submit"
                    class="btn-save btn-success"
                    style="flex: 1; padding: 14px; font-size: 16px; font-weight: bold;"
                >
                    Enregistrer les modifications
                </button>
        </form>
    </div>


    <!-- Zone de danger -->
    <div style="margin-top: 30px; padding: 20px; margin: 10px; background-color: #fff5f5; border-radius: 8px; border: 2px solid #e74c3c;">
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
