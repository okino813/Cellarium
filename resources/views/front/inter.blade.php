@extends('layout.app')

@section('content')
    <div class="return-inter-page">
        <h1 class="title-user">
            Retours d'intervention
        </h1>
        <p class="instruction">Renseignez les éléments pris dans la réserve</p>

        <!-- Barre de recherche -->
        <div class="search-container">
            <label for="search">Rechercher un item</label>
            <input
                type="text"
                id="search"
                placeholder="Tapez pour filtrer les items..."
                onkeyup="filterItems()"
            >
            <small id="result-count">
                <span>{{ count($items) }}</span> item(s) affiché(s)
            </small>
        </div>

        <form class="form-container" action="{{ route('front.return-inter.validate') }}" method="POST">
            @csrf

            <div class="item-grid" id="items-container">
                @foreach($items as $item)
                    <div class="item-card" data-item-name="{{ strtolower($item->name) }}">
                        <label class="item-label">{{ $item->name }}</label>

                        <div class="end">

                            <input type="hidden" name="id{{ $item->id }}" id="qty-{{ $item->id }}" value="0">

                            <div class="item-controls">
                                <button
                                    type="button"
                                    class="btn-quantity minus"
                                    onclick="changeQuantity({{ $item->id }}, -1)"
                                >
                                    −
                                </button>
                                <div class="quantity-display quantity-zero" id="display-{{ $item->id }}">
                                    0
                                </div>
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

            <div class="form-bottom">
                <div class="comment-container">
                    <label for="comment">
                        Commentaire : <span style="font-style: italic; font-size: 10px;">(Facultatif)</span>
                    </label>
                    <input
                        id="comment"
                        name="comment"
                    >

                    <button type="submit" class="btn">
                        Valider
                    </button>

                </div>

            </div>

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
            resultCount.textContent = visibleCount + " item(s) affiché(s)";

            // Afficher/masquer le message "aucun résultat"
            if (visibleCount === 0) {
                itemsContainer.style.display = 'none';
                noResults.style.display = 'block';
            } else {
                itemsContainer.style.display = 'block';
                noResults.style.display = 'none';
            }
        }
    </script>
@endsection
