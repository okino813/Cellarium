@extends('layout.app')

@section('content')
    <div class="admin-page">
        <h1 class="title-user">
            Ajout d'un d'item
        </h1>

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

        <form action="{{ route('admin.items.store') }}" method="POST">
            @csrf
            @method('POST')

            <!-- Nom -->
            <div class="card form-item" >
                <label for="name" style="margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                    Nom de l'item <span style="color: #e74c3c;">*</span>
                </label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="input-field"
                    placeholder="Ex : Compresses stériles"
                    required
                >
            </div>


            <!-- Est stocké -->
            <div class="card form-item" >
                <div class="field">
                    <label for="is_stock" style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                        Cet item est-il stocké ?
                    </label>
                    <label class="switch">
                        <input name="is_stock" id="is_stock" type="checkbox">
                        <span class="slider round"></span>
                    </label>
                </div>

                <div class="field">
                    <label for="state" style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                        État de l'item
                    </label>
                    <label class="switch">
                        <input name="state" id="state" type="checkbox" checked>
                        <span class="slider round"></span>
                    </label>
                </div>

                <small style="color: #7f8c8d; font-size: 13px;">Les items désactivés n'apparaissent pas dans les vérifications</small>
            </div>

            <div class="card stock_fields" id="stock_fields">

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
                        min="0"
                        required
                    >
                    <small style="color: #7f8c8d; font-size: 13px;">Vous serez alerté quand le stock atteint ce seuil</small>
                </div>

            </div>

            <!-- Boutons -->
            <button
                type="submit"
                class="btn-save btn-success"
            >
                Enregistrer
            </button>
        </form>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var isStockSelect = document.getElementById('is_stock');
                var stockFields = document.getElementById('stock_fields');
                const seuil = document.getElementById('seuil');
                const totalQtyInput = document.getElementById('total_qty');
                const seuilInput = document.getElementById('seuil');

                // Fonction pour masquer/afficher les champs
                function toggleStockFields() {
                    if (!isStockSelect.checked) {
                        stockFields.style.display = 'none';
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

    </div>

@endsection
