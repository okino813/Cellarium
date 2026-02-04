@extends('layout.app')

@section('content')
    <div style="padding: 15px;">
        <h1 style="font-size: 24px; color: #2c3e50; margin-bottom: 8px; text-align: center;">
            Retours d'intervention
        </h1>
        <p style="font-size: 14px; color: #666; margin-bottom: 15px; text-align: center;">
            Renseignez les éléments pris dans la réserve
        </p>

        <div class="instructions-box">
            <p class="instructions-text">
                <strong>−</strong> = Élément pris dans la réserve<br/>
                <strong>+</strong> = Élément remis dans la réserve
            </p>
        </div>

        <!-- Barre de recherche -->
        <div style="margin-bottom: 20px; background-color: white; border-radius: 8px; padding: 15px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
            <label for="search" style="display: block; font-size: 14px; color: #2c3e50; font-weight: 600; margin-bottom: 8px;">
                Rechercher un item
            </label>
            <input
                type="text"
                id="search"
                placeholder="Tapez pour filtrer les items..."
                style="width: 100%; padding: 12px; border: 2px solid #ccc; border-radius: 6px; font-size: 16px; box-sizing: border-box;"
                onkeyup="filterItems()"
            >
            <small style="display: block; margin-top: 5px; color: #7f8c8d; font-size: 12px;">
                <span id="result-count">{{ count($items) }}</span> item(s) affiché(s)
            </small>
        </div>

        <form action="{{ route('front.return-inter.validate') }}" method="POST">
            @csrf

            <div class="item-grid" id="items-container">
                @foreach($items as $item)
                    <div class="item-card" data-item-name="{{ strtolower($item->name) }}">
                        <label class="item-label">{{ $item->name }}</label>

                        <div class="end">
                            <div class="quantity-display quantity-zero" id="display-{{ $item->id }}">
                                0
                            </div>
                            <input type="hidden" name="id{{ $item->id }}" id="qty-{{ $item->id }}" value="0">

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
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Message si aucun résultat -->
            <div id="no-results" style="display: none; text-align: center; padding: 40px 0; color: #7f8c8d;">
                <p style="font-size: 18px; margin: 0;">Aucun item trouvé</p>
                <p style="margin: 10px 0 0 0; font-size: 14px;">
                    Essayez avec un autre terme de recherche
                </p>
            </div>

            <div style="background-color: white; border-radius: 8px; padding: 15px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); margin-bottom: 20px;">
                <label for="comment" style="display: block; font-size: 14px; color: #2c3e50; font-weight: 600; margin-bottom: 8px;">
                    Commentaire : <span style="font-style: italic; font-size: 10px;">(Facultatif)</span>
                </label>
                <textarea
                    id="comment"
                    name="comment"
                    rows="4"
                    style="width: 100%; padding: 12px; border: 2px solid #ccc; border-radius: 6px; font-size: 16px; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; resize: vertical;"
                ></textarea>
            </div>

            <button type="submit" class="btn" style="width: 100%; padding: 16px; font-size: 18px; font-weight: bold;">
                Valider
            </button>
        </form>
    </div>

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

        function filterItems() {
            const searchInput = document.getElementById('search');
            const filter = searchInput.value.toLowerCase();
            const itemsContainer = document.getElementById('items-container');
            const items = itemsContainer.getElementsByClassName('item-card');
            const noResults = document.getElementById('no-results');
            const resultCount = document.getElementById('result-count');

            let visibleCount = 0;

            // Parcourir tous les items
            for (let i = 0; i < items.length; i++) {
                const itemName = items[i].getAttribute('data-item-name');

                if (itemName.includes(filter)) {
                    items[i].style.display = '';
                    visibleCount++;
                } else {
                    items[i].style.display = 'none';
                }
            }

            // Mettre à jour le compteur
            resultCount.textContent = visibleCount;

            // Afficher/masquer le message "aucun résultat"
            if (visibleCount === 0) {
                itemsContainer.style.display = 'none';
                noResults.style.display = 'block';
            } else {
                itemsContainer.style.display = 'grid';
                noResults.style.display = 'none';
            }
        }
    </script>
@endsection
