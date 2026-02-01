@extends('layout.admin')

@section('content')
    <div class="container" style="max-width: 800px;">
        <div style="margin-bottom: 30px;">
            <h1 style="font-size: 32px; color: #2c3e50; margin-bottom: 5px;">
                Modifier l'Item
            </h1>
            <p style="color: #7f8c8d; margin: 0;">
                Modifiez les informations de <strong>{{ $item->name }}</strong>
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

            <form action="{{ route('admin.items.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nom -->
                <div style="margin-bottom: 20px;">
                    <label for="name" style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                        Nom de l'item <span style="color: #e74c3c;">*</span>
                    </label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="input-field"
                        placeholder="Ex : Compresses stériles"
                        value="{{ old('name', $item->name) }}"
                        required
                    >
                    <small style="color: #7f8c8d; font-size: 13px;">Le nom doit être unique et descriptif</small>
                </div>

                <!-- Quantité en stock -->
                <div style="margin-bottom: 20px;">
                    <label for="total_qty" style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                        Quantité en stock <span style="color: #e74c3c;">*</span>
                    </label>
                    <input
                        type="number"
                        name="total_qty"
                        id="total_qty"
                        class="input-field"
                        placeholder="0"
                        value="{{ old('total_qty', $item->total_qty) }}"
                        min="0"
                        required
                    >
                    <small style="color: #7f8c8d; font-size: 13px;">Quantité actuellement disponible</small>
                </div>

                <!-- Seuil de rupture -->
                <div style="margin-bottom: 20px;">
                    <label for="seuil" style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                        Seuil d'alerte <span style="color: #e74c3c;">*</span>
                    </label>
                    <input
                        type="number"
                        name="seuil"
                        id="seuil"
                        class="input-field"
                        placeholder="10"
                        value="{{ old('seuil', $item->seuil) }}"
                        min="0"
                        required
                    >
                    <small style="color: #7f8c8d; font-size: 13px;">Vous serez alerté quand le stock atteint ce seuil</small>
                </div>

                <!-- État -->
                <div style="margin-bottom: 20px;">
                    <label for="state" style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                        État de l'item
                    </label>
                    <select
                        name="state"
                        id="state"
                        class="input-field"
                        style="cursor: pointer;"
                    >
                        <option value="1" {{ old('state', $item->state) == 1 ? 'selected' : '' }}>Actif</option>
                        <option value="0" {{ old('state', $item->state) == 0 ? 'selected' : '' }}>Désactivé</option>
                    </select>
                    <small style="color: #7f8c8d; font-size: 13px;">Les items désactivés n'apparaissent pas dans les vérifications</small>
                </div>

                <!-- Est stocké -->
                <div style="margin-bottom: 30px;">
                    <label for="is_stock" style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                        Cet item est-il stocké ?
                    </label>
                    <select
                        name="is_stock"
                        id="is_stock"
                        class="input-field"
                        style="cursor: pointer;"
                    >
                        <option value="1" {{ old('is_stock', $item->is_stock) == 1 ? 'selected' : '' }}>Oui</option>
                        <option value="0" {{ old('is_stock', $item->is_stock) == 0 ? 'selected' : '' }}>Non</option>
                    </select>
                    <small style="color: #7f8c8d; font-size: 13px;">Décochez si l'item n'a pas besoin de gestion de stock</small>
                </div>

                <!-- Boutons -->
                <div style="display: flex; gap: 15px; border-top: 2px solid #dee2e6; padding-top: 20px;">
                    <button
                        type="submit"
                        class="btn btn-success"
                        style="flex: 1; padding: 14px; font-size: 16px; font-weight: bold;"
                    >
                        Enregistrer
                    </button>

                    <a href="{{ route('admin.items.index') }}"
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
            <div style="padding: 15px; background-color: #f3e5f5; border-radius: 8px; border-left: 4px solid #9C27B0;">
                <p style="margin: 0; font-size: 12px; color: #7B1FA2; font-weight: 600;">CRÉÉ LE</p>
                <p style="margin: 5px 0 0 0; font-size: 14px; color: #4A148C;">{{ $item->created_at->format('d/m/Y H:i') }}</p>
            </div>
            <div style="padding: 15px; background-color: #fff3e0; border-radius: 8px; border-left: 4px solid #FF9800;">
                <p style="margin: 0; font-size: 12px; color: #E65100; font-weight: 600;">MODIFIÉ LE</p>
                <p style="margin: 5px 0 0 0; font-size: 14px; color: #BF360C;">{{ $item->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        <!-- Zone de danger -->
        <div style="margin-top: 30px; padding: 20px; background-color: #fff5f5; border-radius: 8px; border: 2px solid #e74c3c;">
            <h3 style="color: #e74c3c; margin: 0 0 10px 0; font-size: 18px;">Zone de danger</h3>
            <p style="color: #721c24; margin: 0 0 15px 0; font-size: 14px;">
                La suppression de cet item est irréversible. Toutes les données associées seront perdues.
            </p>
            <a
                href="{{ route('admin.items.delete', $item->id) }}"
                onclick="return confirm('⚠️ ATTENTION ⚠️\n\nÊtes-vous absolument sûr de vouloir supprimer cet item ?\n\nCette action est IRRÉVERSIBLE et supprimera :\n- L\'item {{ $item->name }}\n- Son historique de mouvements\n- Toutes ses attributions\n\nTapez OK pour confirmer la suppression.')"
                style="display: inline-block; padding: 12px 24px; background-color: #e74c3c; color: white; text-decoration: none; border-radius: 4px; font-weight: bold; transition: background 0.3s;"
                onmouseover="this.style.backgroundColor='#c82333'"
                onmouseout="this.style.backgroundColor='#e74c3c'"
            >
                Supprimer définitivement cet item
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
