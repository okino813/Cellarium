@extends('layout.app')
@section('content')
    <div class="container" style="max-width: 800px;">
        <div style="margin-bottom: 30px;">
            <h1 style="font-size: 32px; color: #2c3e50; margin-bottom: 5px;">
                Ajouter un Item
            </h1>
            <p style="color: #7f8c8d; margin: 0;">
                Créez un nouvel article pour le stock
            </p>
        </div>

        <div class="card" style=" padding-left:20px; padding-right:20px;">
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

            <form action="{{ route('admin.items.store') }}" method="POST">
                @csrf

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
                        value="{{ old('name') }}"
                        required
                    >
                    <small style="color: #7f8c8d; font-size: 13px;">Le nom doit être unique et descriptif</small>
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
                        <option value="1" {{ old('is_stock', 1) == 1 ? 'selected' : '' }}>Oui</option>
                        <option value="0" {{ old('is_stock') == 0 ? 'selected' : '' }}>Non</option>
                    </select>
                    <small style="color: #7f8c8d; font-size: 13px;">Décochez si l'item n'a pas besoin de gestion de stock</small>
                </div>

                <div class="stock_fields" id="stock_fields">
                    <!-- Quantité en stock -->

                    <div style="margin-bottom: 20px;">
                        <label for="total_qty" style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                            Quantité initiale en stock <span style="color: #e74c3c;">*</span>
                        </label>
                        <input
                            type="number"
                            name="total_qty"
                            id="total_qty"
                            class="input-field"
                            placeholder="0"
                            value="{{ old('total_qty', 0) }}"
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
                            value="{{ old('seuil', 10) }}"
                            min="0"
                            required
                        >
                        <small style="color: #7f8c8d; font-size: 13px;">Vous serez alerté quand le stock atteint ce seuil</small>
                    </div>
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
                        <option value="0" {{ old('state') == 0 ? 'selected' : '' }}> Désactivé</option>
                        <option value="1" {{ old('state', 1) == 1 ? 'selected' : '' }}> Actif</option>
                    </select>
                    <small style="color: #7f8c8d; font-size: 13px;">Les items désactivés n'apparaissent pas dans les vérifications</small>
                </div>

                <!-- Boutons -->
                <div style="display: flex; gap: 15px; border-top: 2px solid #dee2e6; padding-top: 20px;">
                    <button
                        type="submit"
                        class="btn btn-success"
                        style="flex: 1; padding: 14px; font-size: 16px; font-weight: bold;"
                    >
                        Créer l'item
                    </button>
                    <a
                        href="{{ route('admin.items.index') }}"
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
                <strong>💡 Astuce :</strong> Définissez un seuil d'alerte approprié pour être prévenu avant la rupture de stock.
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const isStockSelect = document.getElementById('is_stock');
            const stockFields = document.getElementById('stock_fields');
            const seuil = document.getElementById('seuil');
            const totalQtyInput = document.getElementById('total_qty');
            const seuilInput = document.getElementById('seuil');

            // Fonction pour masquer/afficher les champs
            function toggleStockFields() {
                if (isStockSelect.value === '0') {
                    stockFields.style.display = 'none';
                    totalQtyInput.value = 0;
                    seuil.value = 0;
                } else {
                    stockFields.style.display = 'block';
                }
            }

            // Appelle la fonction au chargement de la page
            toggleStockFields();

            // Ajoute un écouteur d'événement pour le changement de sélection
            isStockSelect.addEventListener('change', toggleStockFields);
        });
    </script>
@endsection
