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

        <div class="card"  style=" padding-left:20px; padding-right:20px;">
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

                <div class="stock_fields" id="stock_fields">

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
    </div>

    <div class="container">

        <div style="margin-bottom: 30px;">
            <h2 style="font-size: 32px; color: #2c3e50; margin-bottom: 5px;">
                Ajout d'associations
            </h2>
        </div>

        <!-- Ajout d'association -->
        <div class="card"  style=" padding-left:20px; padding-right:20px;">
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

            <form action="{{ route('admin.attribution.addItemContaining.validate') }}" method="POST">
                @csrf
                <div style="margin-bottom: 20px;">
                    <label for="contenant" style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                        Associé {{$item->name}} à :
                    </label>
                    <input type="number" name="item" id="item" value="{{$item->id}}" hidden>
                </div>

                <div style="margin-bottom: 20px;">
                    <select
                        name="contenant"
                        id="contenant"
                        class="input-field"
                        style="cursor: pointer;"
                    >
                        @foreach($contenants as $contenant)
                            <option value="{{ $contenant->id }}">{{ $contenant->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Quantité -->
                <div style="margin-bottom: 20px;">
                    <label for="qty" style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                        Quantité <span style="color: #e74c3c;">*</span>
                    </label>
                    <input
                        type="number"
                        name="qty"
                        id="qty"
                        class="input-field"
                        placeholder="0"
                        value=""
                        min="0"
                        required
                    >
                </div>

                <button
                    type="submit"
                    class="btn btn-success"
                    style="flex: 1; padding: 14px; font-size: 16px; font-weight: bold;"
                >
                    Enregistrer
                </button>
            </form>
        </div>
    </div>


    <!-- Listes des assosiation -->
    <div class="container" >
        <div class="card" style="padding-left:10px;padding-right:10px;">
            <h2 style="font-size: 24px; color: #2c3e50; margin-bottom: 20px; border-bottom: 3px solid #e74c3c; padding-bottom: 10px;">
                Associations actuel
            </h2>

            @if(isset($item->containings) && $item->containings->count() > 0)
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                        <tr style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                            <th style="padding: 12px; text-align: left; font-weight: 600; color: #2c3e50;">Nom</th>
                            <th style="padding: 12px; text-align: center; font-weight: 600; color: #2c3e50;">Quantité affecté</th>
                            <th style="padding: 12px; text-align: center; font-weight: 600; color: #2c3e50;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($item->containings as $containing)
                            <tr style="border-bottom: 1px solid #dee2e6; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#f8f9fa'" onmouseout="this.style.backgroundColor='white'"
                                data-containing-id="{{ $containing->id }}">
                                <td style="padding: 12px; font-weight: 500;">{{ $containing->name }}</td>
                                <td style="padding: 12px; text-align: center;">
                                        <span class="qty-value" style="font-size: 18px; font-weight: bold; color: #f39c12;">
                                            {{ $containing->pivot->qty_affect }}
                                        </span>
                                </td>
                                <td style="padding: 12px; text-align: center;">
                                    <!-- Bouton Modifier -->
                                    <button
                                        class="btn-edit"
                                        data-containing-id="{{ $containing->id }}"
                                        data-qty="{{ $containing->pivot->qty_affect }}"
                                        style="padding: 8px 16px; font-size: 14px; background-color: #17a2b8; color: white; border: none; border-radius: 4px; cursor: pointer;"
                                        onclick="showEditInput(this)"
                                    >
                                        Modifier
                                    </button>

                                    <!-- Conteneur pour l'input (caché par défaut) -->
                                    <div
                                        id="edit-container-{{ $containing->id }}"
                                        style="display: none; margin-top: 10px;"
                                    >
                                        <input
                                            type="number"
                                            class="edit-qty-input"
                                            value="{{ $containing->pivot->qty_affect }}"
                                            min="0"
                                            style="width: 80px; padding: 8px; text-align: center; font-size: 16px; border: 1px solid #ced4da; border-radius: 4px;"
                                        />
                                        <button
                                            class="btn-save"
                                            data-containing-id="{{ $containing->id }}"
                                            data-item-id="{{ $item->id }}"
                                            style="margin-left: 5px; padding: 8px 12px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer;"
                                            onclick="saveQty(this)"
                                        >
                                            Enregistrer
                                        </button>
                                        <button
                                            class="btn-cancel"
                                            id="cancel-btn"
                                            style="margin-left: 5px; padding: 8px 12px; background-color: #6c757d; color: white; border: none; border-radius: 4px; cursor: pointer;"
                                            onclick="cancelEdit(this)"
                                        >
                                            Annuler
                                        </button>
                                    </div>

                                    <!-- Bouton Supprimer (inchangé) -->
                                    <a href="{{ route("admin.attribution.ItemContaining.delete", [$containing->id, $item->id])}}"
                                       class="btn"
                                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet item ?')"
                                       style="padding: 6px 12px; background-color: #dc3545; color: white; text-decoration: none; border-radius: 4px; font-size: 14px; margin-top:10px; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#c82333'" onmouseout="this.style.backgroundColor='#dc3545'">
                                        Supprimer
                                    </a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div style="text-align: center; padding: 40px 0; color: #28a745;">
                    <p style="font-size: 18px; margin: 0;">
                        Aucun article en alerte de stock !
                    </p>
                    <p style="color: #7f8c8d; margin-top: 10px;">
                        Tous vos stocks sont au-dessus des seuils d'alerte.
                    </p>
                </div>
            @endif
        </div>
    </div>

    <!-- Informations supplémentaires -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin: 20px;margin-top: 20px;">
        <div style="padding: 15px; background-color: #fff3e0; border-radius: 8px; border-left: 4px solid #FF9800;">
            <p style="margin: 0; font-size: 12px; color: #E65100; font-weight: 600;">MODIFIÉ LE</p>
            <p style="margin: 5px 0 0 0; font-size: 14px; color: #BF360C;">{{ $item->updated_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <!-- Zone de danger -->
    <div style="margin-top: 30px; margin: 20px; padding: 20px; background-color: #fff5f5; border-radius: 8px; border: 2px solid #e74c3c;">
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

    <script>
        // Affiche l'input pour modifier la quantité
        function showEditInput(button) {
            const containingId = button.getAttribute('data-containing-id');
            const container = document.getElementById(`edit-container-${containingId}`);
            container.style.display = 'block';
            button.style.display = 'none';
        }

        // Annule l'édition et cache l'input
        function cancelEdit(button) {
            const container = button.parentElement;
            const row = container.closest('tr');
            const containingId = row.getAttribute('data-containing-id');
            const editButton = row.querySelector(`button.btn-edit[data-containing-id="${containingId}"]`);
            container.style.display = 'none';
            editButton.style.display = 'inline-block';
        }


        // Enregistre la nouvelle quantité (à adapter avec une requête AJAX)
        function saveQty(button) {
            const containingId = button.getAttribute('data-containing-id');
            const itemId = button.getAttribute('data-item-id');
            const input = button.parentElement.querySelector('.edit-qty-input');
            const newQty = input.value;
            const editButton = document.querySelector(`.btn-edit[data-containing-id="${containingId}"]`);
            const qtySpan = document.querySelector(`tr[data-containing-id="${containingId}"] .qty-value`);
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

            if (!csrfToken) {
                console.error("CSRF token non trouvé. Assurez-vous que la balise meta est présente dans le HTML.");
                return;
            }

            console.log(`Nouvelle quantité pour le contenant ${containingId} : ${newQty}`);
            fetch(`{{ route('admin.attribution.addItemContaining.update', $containing->id)  }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({
                    containing_id: containingId,
                    item_id: itemId,
                    qty: newQty,
                }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        if (qtySpan) {
                            qtySpan.textContent = newQty;
                        }
                        alert('Quantité mise à jour avec succès !');
                    } else {
                        alert('Erreur lors de la mise à jour.');
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    alert('Une erreur est survenue.');
                });


            // Met à jour l'affichage (simulation)
            if (qtySpan) {
                qtySpan.textContent = newQty;
            }

            // Cache l'input et réaffiche le bouton Modifier
            button.parentElement.style.display = 'none';
            editButton.style.display = 'inline-block';
        }
    </script>

@endsection
