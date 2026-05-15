@extends('layout.app')

@section('content')
    <div class="admin-page">
        <h1 class="title-user">
            Modifier le Contenant
        </h1>
        <p class="instruction">
            Modifiez les informations de <strong>{{ $contenant->name }}</strong>
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

        <form action="{{ route('admin.containings.update', $contenant->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nom -->
            <div class="card form-item" >
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

                <!-- Source associée -->
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
            </div>

            <!-- Boutons -->
            <button
                type="submit"
                class="btn-save btn-success"
            >
                Enregistrer
            </button>
        </form>


        <!-- Liste des items associés -->
        <h1 class="title-user">
            Items associé
        </h1>

        <div class="card list-item-contain">
            @if(isset($contenant->items) && $contenant->items->count() > 0)
                @foreach($contenant->items as $item)
                    <div class="item itemcontainer-{{ $item->id }}">
                        <p>{{ $item->name }}</p>
                        <div class="qty-value">
                            <button onclick="EditQty({{$item->id}}, 'minus', {{$contenant->id}})" class="left">-</button>
                            <input type="number" name="item-{{ $item->id }}" id="item-{{ $item->id }}" value="{{ $item->pivot->qty_affect }}" readonly>
                            <button onclick="EditQty({{$item->id}}, 'more', {{$contenant->id}})" class="right">+</button>
                        </div>
                    </div>
                @endforeach
            @else
                <div style="text-align: center; padding: 40px 0; color: #7f8c8d;">
                    <p style="font-size: 18px; margin: 0;">Aucun item associé</p>
                    <p style="margin: 10px 0 0 0;">
                        Utilisez le formulaire ci-dessus pour ajouter des items
                    </p>
                </div>
            @endif


            <!-- Bouton ouvrir modal -->
            <button onclick="document.getElementById('modal-add-item').style.display='flex'"
                    class="btn-delete">
                + Ajouter une association
            </button>

            <div id="modal-add-item" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:1000; align-items:center; justify-content:center;">
                <div style="background:white; border-radius: 12px; padding: 24px; width: 90%; max-width: 480px; box-shadow: 0 20px 60px rgba(0,0,0,0.3);">

                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
                        <h3 style="margin:0; color:#2c3e50; font-size:18px;">Associer un item</h3>
                        <button onclick="document.getElementById('modal-add-item').style.display='none'"
                                style="background:none; border:none; font-size:22px; cursor:pointer; color:#aaa; line-height:1;">×</button>
                    </div>

                    <form action="{{ route('admin.attribution.addItemContaining.validate') }}" method="POST">
                        @csrf

                        <!-- Champ caché pour le contenant -->
                        <input type="hidden" name="contenant" value="{{ $contenant->id }}">

                        <!-- Sélection item -->
                        <div style="margin-bottom: 16px;">
                            <label style="display:block; font-weight:600; color:#2c3e50; margin-bottom:6px; font-size:14px;">
                                Item <span style="color:#e74c3c;">*</span>
                            </label>
                            <select name="item" required
                                    style="width:100%; padding:10px 12px; border:2px solid #e0e0e0; border-radius:8px; font-size:14px; color:#333; background:white; cursor:pointer; outline:none;">
                                <option value="" disabled selected>Sélectionner un item...</option>
                                @foreach($items as $item)
                                    {{-- On exclut les items déjà associés --}}
                                    @if(!$contenant->items->contains($item->id))
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <!-- Quantité -->
                        <div style="margin-bottom: 24px;">
                            <label style="display:block; font-weight:600; color:#2c3e50; margin-bottom:6px; font-size:14px;">
                                Quantité affectée <span style="color:#e74c3c;">*</span>
                            </label>
                            <input type="number" name="qty" min="1" value="1" required
                                   style="width:100%; padding:10px 12px; border:2px solid #e0e0e0; border-radius:8px; font-size:14px; color:#333; outline:none;">
                        </div>

                        <!-- Boutons -->
                        <div style="display:flex; gap:10px;">
                            <button type="button"
                                    onclick="document.getElementById('modal-add-item').style.display='none'"
                                    style="flex:1; padding:12px; background:#f5f5f5; color:#555; border:none; border-radius:8px; font-size:14px; font-weight:600; cursor:pointer;">
                                Annuler
                            </button>
                            <button type="submit"
                                    style="flex:2; padding:12px; background:#28a745; color:white; border:none; border-radius:8px; font-size:14px; font-weight:600; cursor:pointer;">
                                Associer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
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
    <br>
    <br>

    <script>
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
        function saveQty(itemId, contenantId, newQty) {

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
                    if (!data.success) {
                        alert('Erreur lors de la mise à jour.');
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    alert('Une erreur est survenue.');
                });
        }

        function EditQty(id, operation, contenantId){
            var input = document.getElementById(`item-${id}`);
            calcule = parseInt(input.value)

            if(operation == "more"){
                calcule = (calcule) + 1
            }else{
                calcule = calcule - 1
            }

            if(calcule>0){
                input.value = calcule
                saveQty(id, contenantId, calcule)
            }
            else{
                const confirmation = confirm("Souhaitez-vous supprimé cet élément ?")
                if(confirmation){
                    input.value = calcule
                    saveQty(id, contenantId, calcule)
                    // On refresh la page
                    const items = document.getElementsByClassName(`itemcontainer-${id}`);
                    if (items.length > 0) {
                        // Supprime le premier élément trouvé (ou un spécifique si nécessaire)
                        items[0].remove();
                    } else {
                        console.log("Aucun élément trouvé avec cette classe.");
                    }
                }
            }



        }


        document.getElementById('modal-add-item').addEventListener('click', function(e) {
            if(e.target === this) this.style.display = 'none';
        });

    </script>
@endsection
