@extends('layout.app')

@section('content')
    <div style="padding: 15px;">
        <h1 style="font-size: 24px; color: #2c3e50; margin-bottom: 8px; text-align: center;">
            Vérification {{ $source->name ?? 'Source' }}
        </h1>
        <p style="font-size: 14px; color: #666; margin-bottom: 20px; text-align: center;">
            Cochez les éléments présents dans chaque contenant
        </p>


        @foreach($contenants as $contenant)
            <div style="background-color: white; border-radius: 8px; padding: 20px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); margin-bottom: 15px;">
                <h2 style="font-size: 20px; color: #2c3e50; margin-bottom: 15px; border-bottom: 2px solid #007bff; padding-bottom: 10px;">
                    {{ $contenant->name }}
                </h2>

                <div style="display: flex; flex-direction: column; gap: 12px;">
                    @foreach($contenant->items as $item)
                        <div style="display:flex; gap:12px;">
                            <label
                                class="item-label"
                                data-item-id="{{ $item->id }}"
                                style="
                                        display: flex;
                                        align-items: center;
                                        gap: 12px;
                                        padding: 12px;
                                        background-color: #f8f9fa;
                                        border: 2px solid #ddd;
                                        border-radius: 6px;
                                        cursor: pointer;
                                        transition: all 0.3s ease;
                                        font-size: 16px;
                                        width: 90%;
                                    "
                            >
                                <input
                                    type="checkbox"
                                    name="items[{{ $contenant->id }}][{{ $item->id }}]"
                                    value="1"
                                    class="item-checkbox"
                                    onchange="toggleItem(this)"
                                    style="
                                            width: 24px;
                                            height: 24px;
                                            cursor: pointer;
                                            accent-color: #28a745;
                                        "
                                >
                                <span class="item-text" style="flex: 1; color: #2c3e50; transition: all 0.3s ease;">
                                        <strong>{{ $item->pivot->qty_affect }}</strong> × {{ $item->name }}
                                    </span>
                            </label>

                            <div id="overlay-{{ $item->id }}" style="display:none; position: fixed; top:0px; left: 0px; bottom: 0px; right:0px; background: rgba(76,76,76,0.8); justify-content: center; align-items: center">
                                <form id="form-{{ $item->id }}" method="POST" style="display:flex; flex-direction: column; align-items: center; justify-content: center; gap: 10px; width:80%; background: white; padding: 50px; border: 2px solid black; border-radius: 20px;">
                                    @csrf

                                    <div class="end">
                                        <div class="quantity-display quantity-zero" id="display-{{ $item->id }}">
                                            0
                                        </div>
                                        <input type="hidden" name="qty" id="qty-{{ $item->id }}" value="0">

                                        <div class="item-controls">
                                            <button
                                                type="button"
                                                class="btn-quantity minus"
                                                onclick="changeQuantity({{ $item->id }}, -1)"
                                            >
                                                −
                                            </button>
                                            <button
                                                type="button"
                                                class="btn-quantity plus"
                                                onclick="changeQuantity({{ $item->id }}, 1)"
                                            >
                                                +
                                            </button>
                                        </div>


                                        <div style="display:flex; gap: 20px;">

                                            <button
                                                type="button"
                                                onclick="soumettreForm({{ $item->id }})"
                                                style="padding: 12px 24px; background-color: #28a745; color: white; border: none; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer; transition: background-color 0.2s ease;"
                                                onmouseover="this.style.backgroundColor='#218838'"
                                                onmouseout="this.style.backgroundColor='#28a745'"
                                            >
                                                Valider
                                            </button>

                                            <button
                                                type="button"
                                                onclick="masquer({{ $item->id }})"
                                                style="padding: 12px 24px;background-color: #dc3545;color: white;border: none;border-radius: 8px;font-size: 16px;font-weight: 600;cursor: pointer;transition: background-color 0.2s ease;"
                                                onmouseover="this.style.backgroundColor='#c82333'"
                                                onmouseout="this.style.backgroundColor='#dc3545'"
                                            >
                                                Annuler
                                            </button>

                                        </div>

                                    </div>


                                </form>

                            </div>
                            <button class="modify-qty" type="button" id="btn-modify-{{$item->id}}" onclick="modifier({{ $item->id }})">Mettre à jour</button>
                        </div>

                    @endforeach

                </div>


                @if($contenant->items->isEmpty())
                    <p style="text-align: center; color: #999; padding: 20px 0; font-style: italic;">
                        Aucun élément dans ce contenant
                    </p>
                @endif
            </div>

        @endforeach
    </div>

    @if($contenants->isEmpty())
        <div class="card text-center">
            <p style="color: #666; padding: 40px 0;">
                Aucun contenant disponible pour cette source.
            </p>
        </div>
    @endif


    <form action="{{ route('front.verif.validate', $source->id ?? 1) }}" method="POST">
        @csrf

        <!-- Boutons d'action -->
        <div style="display: flex; gap: 10px; margin: 20px;margin-bottom: 20px;">
            <button type="submit" class="btn" style="flex: 1; padding: 16px; font-size: 18px; font-weight: bold;">
                Valider la vérification
            </button>
        </div>

        <div style="text-align: center;">
            <a href="{{ route('front.verif.index') }}" style="color: #007bff; text-decoration: underline; font-size: 14px;">
                ← Retour aux sources
            </a>
        </div>
    </form>
    </div>

    <style>
        .item-label.checked {
            background-color: #d4edda !important;
            border-color: #28a745 !important;
        }

        .item-label.checked .item-text {
            text-decoration: line-through;
            color: #6c757d !important;
        }

        .item-label:hover {
            border-color: #007bff !important;
            background-color: #f0f7ff !important;
        }

        .item-label.checked:hover {
            border-color: #28a745 !important;
            background-color: #d4edda !important;
        }
    </style>

    <script>
        function changeQuantity(itemId, delta) {
            const input = document.getElementById('qty-' + itemId);
            const display = document.getElementById('display-' + itemId);
            let currentValue = parseInt(input.value) || 0;

            currentValue += delta;
            input.value = currentValue;

            // Update display with sign
            if (currentValue > 0) {
                display.textContent = '+' + currentValue;
                display.className = 'quantity-display quantity-positive';
            } else if (currentValue < 0) {
                display.textContent = currentValue;
                display.className = 'quantity-display quantity-negative';
            } else {
                display.textContent = '0';
                display.className = 'quantity-display quantity-zero';
            }
        }
        function modifier(id) {
            document.getElementById("overlay-" + id).style.display = "flex";
        }

        function masquer(id) {
            document.getElementById("overlay-" + id).style.display = "none";
        }

        function toggleItem(checkbox) {
            const label = checkbox.closest('.item-label');
            if (checkbox.checked) {
                label.classList.add('checked');
            } else {
                label.classList.remove('checked');
            }
        }

        async function soumettreForm(id) {
            const form = document.getElementById('form-' + id);
            if (!form) {
                alert('Formulaire introuvable : form-' + id);
                return;
            }

            const formData = new FormData(form);

            try {
                const response = await fetch(`/verif/update-qty/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        'Accept': 'application/json',
                    },
                    body: formData
                });

                if (response.ok) {
                    const data = await response.json();
                    alert(data.message || 'Modification réussie !');
                    masquer(id);
                    location.reload();
                } else {
                    const error = await response.json();
                    alert(error.message || 'Erreur lors de la modification.');
                }
            } catch (error) {
                console.error('Erreur:', error);
                alert('Une erreur est survenue.');
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.item-checkbox').forEach(checkbox => {
                if (checkbox.checked) toggleItem(checkbox);
            });
        });
    </script>
@endsection
