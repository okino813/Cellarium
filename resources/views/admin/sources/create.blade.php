@extends('layout.admin')

@section('content')
    <div class="container" style="max-width: 800px;">
        <div style="margin-bottom: 30px;">
            <h1 style="font-size: 32px; color: #2c3e50; margin-bottom: 5px;">
                Ajouter une Source
            </h1>
            <p style="color: #7f8c8d; margin: 0;">
                Créez une nouvelle source (véhicule, local, etc.)
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

            <form action="{{ route('admin.sources.store') }}" method="POST">
                @csrf

                <!-- Nom -->
                <div style="margin-bottom: 20px; padding-left:20px; padding-right:20px;">
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
                <div style="display: flex; gap: 15px; border-top: 2px solid #dee2e6; padding-top: 20px; margin-top: 30px; padding-left:20px; padding-right:20px;">
                    <button
                        type="submit"
                        class="btn btn-success"
                        style="flex: 1; padding: 14px; font-size: 16px; font-weight: bold;"
                    >
                        Créer la source
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

        <!-- Info card -->
        <div style="margin-top: 20px; padding: 15px; background-color: #d1ecf1; border-radius: 8px; border-left: 4px solid #17a2b8;">
            <p style="margin: 0; font-size: 14px; color: #0c5460;">
                <strong>💡 Qu'est-ce qu'une source ?</strong> Une source représente un véhicule, un local ou tout autre emplacement contenant des items à vérifier.
            </p>
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
