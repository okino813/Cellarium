@extends('layout.app')

@section('content')
    <div style="padding: 15px;">
        <h1 style="font-size: 24px; color: #2c3e50; margin-bottom: 8px; text-align: center;">
            Vérification {{ $source->name ?? 'Source' }}
        </h1>
        <p style="font-size: 14px; color: #666; margin-bottom: 20px; text-align: center;">
            Cochez les éléments présents dans chaque contenant
        </p>

        <form action="{{ route('front.verif.validate', $source->id ?? 1) }}" method="POST">
            @csrf

            @foreach($contenants as $contenant)
                <div style="background-color: white; border-radius: 8px; padding: 20px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); margin-bottom: 15px;">
                    <h2 style="font-size: 20px; color: #2c3e50; margin-bottom: 15px; border-bottom: 2px solid #007bff; padding-bottom: 10px;">
                        {{ $contenant->name }}
                    </h2>

                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        @foreach($contenant->items as $item)
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
                                "
                            >
                                <input
                                    type="checkbox"
                                    name="items[{{ $contenant->id }}][{{ $item->id }}]"
                                    value="1"
                                    class="item-checkbox"
                                    onchange="toggleItem(this)"
                                    required
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
                        @endforeach

                        @if($contenant->items->isEmpty())
                            <p style="text-align: center; color: #999; padding: 20px 0; font-style: italic;">
                                Aucun élément dans ce contenant
                            </p>
                        @endif
                    </div>
                </div>
            @endforeach

            @if($contenants->isEmpty())
                <div class="card text-center">
                    <p style="color: #666; padding: 40px 0;">
                        Aucun contenant disponible pour cette source.
                    </p>
                </div>
            @endif

            <!-- Boutons d'action -->
            <div style="display: flex; gap: 10px; margin-bottom: 20px;">
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
        function toggleItem(checkbox) {
            const label = checkbox.closest('.item-label');

            if (checkbox.checked) {
                // Animation de coche : passage au vert avec texte barré
                label.classList.add('checked');
            } else {
                // Retour à l'état initial
                label.classList.remove('checked');
            }
        }

        // Au chargement, appliquer l'état aux cases déjà cochées (si formulaire pré-rempli)
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.item-checkbox').forEach(checkbox => {
                if (checkbox.checked) {
                    toggleItem(checkbox);
                }
            });
        });
    </script>
@endsection
