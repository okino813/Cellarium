@extends('layout.admin')

@section('content')
    <div class="container" style="max-width: 800px;">
        <!-- Formulaire de modification du contenant -->
        <div style="margin-bottom: 30px;">
            <h1 style="font-size: 32px; color: #2c3e50; margin-bottom: 5px;">
                Modifier le Contenant
            </h1>
            <p style="color: #7f8c8d; margin: 0;">
                Modifiez les informations de <strong>{{ $contenant->name }}</strong>
            </p>
        </div>

        <div class="card" style="padding-left:20px; padding-right:20px;">
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

            <form action="{{ route('admin.containings.update', $contenant->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nom -->
                <div style="margin-bottom: 20px;">
                    <label for="name" style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                        Nom du contenant <span style="color: #e74c3c;">*</span>
                    </label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="input-field"
                        placeholder="Ex : Sac PROMPT, Armoire pharmacie..."
                        value="{{ old('name', $contenant->name) }}"
                        required
                    >
                    <small style="color: #7f8c8d; font-size: 13px;">Le nom doit être unique et descriptif</small>
                </div>

                <!-- Source associée -->
                <div style="margin-bottom: 20px;">
                    <label for="source_id" style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                        Source associée <span style="color: #e74c3c;">*</span>
                    </label>
                    <select
                        name="source_id"
                        id="source_id"
                        class="input-field"
                        style="cursor: pointer;"
                        required
                    >
                        @foreach($sources as $source)
                            <option value="{{ $source->id }}" {{ old('source_id', $contenant->source_id) == $source->id ? 'selected' : '' }}>
                                {{ $source->name }}
                            </option>
                        @endforeach
                    </select>
                    <small style="color: #7f8c8d; font-size: 13px;">Le véhicule ou local où se trouve ce contenant</small>
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

                    <a href="{{ route('admin.containings.index') }}"
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


    <!-- Liste des items associés -->
    <div class="container" style="margin-top: 40px;">
        <div class="card" style="padding-left:10px;padding-right:10px;">
            <h2 style="font-size: 24px; color: #2c3e50; margin-bottom: 20px; border-bottom: 3px solid #007bff; padding-bottom: 10px;">
                Items actuels dans ce contenant
            </h2>

            @if(isset($contenant->items) && $contenant->items->count() > 0)
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                        <tr style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                            <th style="padding: 12px; text-align: left; font-weight: 600; color: #2c3e50;">Item</th>
                            <th style="padding: 12px; text-align: center; font-weight: 600; color: #2c3e50;">Quantité</th>
                            <th style="padding: 12px; text-align: center; font-weight: 600; color: #2c3e50;">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contenant->items as $item)
                            <tr style="border-bottom: 1px solid #dee2e6; transition: background 0.2s;"
                                onmouseover="this.style.backgroundColor='#f8f9fa'"
                                onmouseout="this.style.backgroundColor='white'"
                                data-item-id="{{ $item->id }}">
                                <td style="padding: 12px; font-weight: 500;">{{ $item->name }}</td>
                                <td style="padding: 12px; text-align: center;">
                                    <span class="qty-value" style="font-size: 18px; font-weight: bold; color: #007bff;">
                                        {{ $item->pivot->qty_affect }}
                                    </span>
                                </td>
                                <td style="padding: 12px; text-align: center;">
                                    <!-- Bouton Modifier -->
                                    <button
                                        class="btn-edit"
                                        data-item-id="{{ $item->id }}"
                                        data-qty="{{ $item->pivot->qty_affect }}"
                                        style="padding: 8px 16px; font-size: 14px; background-color: #17a2b8; color: white; border: none; border-radius: 4px; cursor: pointer;"
                                        onclick="showEditInput(this)"
                                    >
                                        Modifier
                                    </button>

                                    <!-- Conteneur pour l'input (caché par défaut) -->
                                    <div
                                        id="edit-container-{{ $item->id }}"
                                        style="display: none; margin-top: 10px;"
                                    >
                                        <input
                                            type="number"
                                            class="edit-qty-input"
                                            value="{{ $item->pivot->qty_affect }}"
                                            min="1"
                                            style="width: 80px; padding: 8px; text-align: center; font-size: 16px; border: 2px solid #ced4da; border-radius: 4px;"
                                        />
                                        <button
                                            class="btn-save"
                                            data-item-id="{{ $item->id }}"
                                            data-contenant-id="{{ $contenant->id }}"
                                            style="margin-left: 5px; padding: 8px 12px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer;"
                                            onclick="saveQty(this)"
                                        >
                                            Valider
                                        </button>
                                        <button
                                            class="btn-cancel"
                                            style="margin-left: 5px; padding: 8px 12px; background-color: #6c757d; color: white; border: none; border-radius: 4px; cursor: pointer;"
                                            onclick="cancelEdit(this)"
                                        >
                                            Annuler
                                        </button>
                                    </div>

                                    <!-- Bouton Supprimer -->
                                    <a href="{{ route('admin.attribution.ItemContaining.delete', [$contenant->id, $item->id]) }}"
                                       onclick="return confirm('Êtes-vous sûr de vouloir retirer cet item du contenant ?')"
                                       style="display: inline-block; margin-top: 10px; padding: 6px 12px; background-color: #dc3545; color: white; text-decoration: none; border-radius: 4px; font-size: 14px; transition: background 0.2s;"
                                       onmouseover="this.style.backgroundColor='#c82333'"
                                       onmouseout="this.style.backgroundColor='#dc3545'">
                                        Supprimer
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div style="text-align: center; padding: 40px 0; color: #7f8c8d;">
                    <p style="font-size: 18px; margin: 0;">Aucun item associé</p>
                    <p style="margin: 10px 0 0 0;">
                        Utilisez le formulaire ci-dessus pour ajouter des items
                    </p>
                </div>
            @endif
        </div>
    </div>

    <!-- Informations supplémentaires -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin: 20px; margin-top: 20px;">
        <div style="padding: 15px; background-color: #fff3e0; border-radius: 8px; border-left: 4px solid #FF9800;">
            <p style="margin: 0; font-size: 12px; color: #E65100; font-weight: 600;">MODIFIÉ LE</p>
            <p style="margin: 5px 0 0 0; font-size: 14px; color: #BF360C;">{{ $contenant->updated_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <!-- Zone de danger -->
    <div style="margin: 20px; padding: 20px; background-color: #fff5f5; border-radius: 8px; border: 2px solid #e74c3c;">
        <h3 style="color: #e74c3c; margin: 0 0 10px 0; font-size: 18px;">Zone de danger</h3>
        <p style="color: #721c24; margin: 0 0 15px 0; font-size: 14px;">
            La suppression de ce contenant est irréversible. Toutes les associations avec les items seront perdues.
        </p>

        <a href="{{ route('admin.containings.delete', $contenant->id) }}"
        onclick="return confirm('ATTENTION\n\nÊtes-vous sûr de vouloir supprimer ce contenant ?\n\nCette action supprimera :\n- Le contenant {{ $contenant->name }}\n- Toutes ses associations avec les items\n\nConfirmer la suppression ?')"
        style="display: inline-block; padding: 12px 24px; background-color: #e74c3c; color: white; text-decoration: none; border-radius: 4px; font-weight: bold; transition: background 0.3s;"
        onmouseover="this.style.backgroundColor='#c82333'"
        onmouseout="this.style.backgroundColor='#e74c3c'"
        >
        Supprimer définitivement ce contenant
        </a>
    </div>

    <style>
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }
            h1, h2 {
                font-size: 24px !important;
            }
            .btn {
                font-size: 14px !important;
                padding: 12px !important;
            }
        }
    </style>

    <script>
        // Affiche l'input pour modifier la quantité
        function showEditInput(button) {
            const itemId = button.getAttribute('data-item-id');
            const container = document.getElementById(`edit-container-${itemId}`);
            container.style.display = 'block';
            button.style.display = 'none';
        }

        // Annule l'édition
        function cancelEdit(button) {
            const container = button.parentElement;
            const row = container.closest('tr');
            const itemId = row.getAttribute('data-item-id');
            const editButton = row.querySelector(`.btn-edit[data-item-id="${itemId}"]`);
            container.style.display = 'none';
            editButton.style.display = 'inline-block';
        }

        // Enregistre la nouvelle quantité
        function saveQty(button) {
            const itemId = button.getAttribute('data-item-id');
            const contenantId = button.getAttribute('data-contenant-id');
            const input = button.parentElement.querySelector('.edit-qty-input');
            const newQty = input.value;
            const editButton = document.querySelector(`.btn-edit[data-item-id="${itemId}"]`);
            const qtySpan = document.querySelector(`tr[data-item-id="${itemId}"] .qty-value`);
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}';

            fetch('{{ route("admin.attribution.addItemContaining.update", ":id") }}'.replace(':id', contenantId), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({
                    item_id: itemId,
                    containing_id: contenantId,
                    qty: newQty,
                }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        if (qtySpan) {
                            qtySpan.textContent = newQty;
                        }
                        alert('Quantité mise à jour !');
                        button.parentElement.style.display = 'none';
                        editButton.style.display = 'inline-block';
                    } else {
                        alert('Erreur lors de la mise à jour.');
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    alert('Une erreur est survenue.');
                });
        }
    </script>
@endsection
