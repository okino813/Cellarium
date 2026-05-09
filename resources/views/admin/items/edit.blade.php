@extends('layout.app')

@section('content')
    <div class="admin-page">
        <h1 class="title-user">
            Modifier l'Item
        </h1>
        <p class="instruction">
            Modifiez les informations de <strong>{{ $item->name }}</strong>
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

        <form action="{{ route('admin.items.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')

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
                    value="{{ old('name', $item->name) }}"
                    required
                >

{{--                <label for="sortorder" style="margin-bottom: 8px; font-weight: 600; color: #2c3e50;">--}}
{{--                   Ordre d'affichage--}}
{{--                </label>--}}
{{--                <input--}}
{{--                    type="number"--}}
{{--                    name="sortorder"--}}
{{--                    id="sortorder"--}}
{{--                    class="input-field"--}}
{{--                    placeholder="Ex : 3"--}}
{{--                    value="{{ old('name', $item->sortorder) }}"--}}
{{--                    required--}}
{{--                >--}}
            </div>


            <!-- Est stocké -->
            <div class="card form-item" >
                <div class="field">
                    <label for="is_stock" style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                        Cet item est-il stocké ?
                    </label>
                    <label class="switch">
                        <input name="is_stock" id="is_stock" type="checkbox" {{ old('is_stock', $item->is_stock) == 1 ? 'checked' : '' }}>
                        <span class="slider round"></span>
                    </label>
                </div>

                <div class="field">
                    <label for="state" style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                        État de l'item
                    </label>
                    <label class="switch">
                        <input name="state" id="state" type="checkbox" {{ old('is_stock', $item->state) == 1 ? 'checked' : '' }}>
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

            </div>

            <a class="btn-delete"
               href="{{ route('admin.items.delete', $item->id) }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M136.7 5.9L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-8.7-26.1C306.9-7.2 294.7-16 280.9-16L167.1-16c-13.8 0-26 8.8-30.4 21.9zM416 144L32 144 53.1 467.1C54.7 492.4 75.7 512 101 512L347 512c25.3 0 46.3-19.6 47.9-44.9L416 144z"/></svg>
                Supprimer
            </a>


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
