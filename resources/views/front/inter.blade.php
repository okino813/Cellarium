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

        <form action="{{ route('front.return-inter.validate') }}" method="POST">
            @csrf

            <div class="item-grid">
                @foreach($items as $item)
                    <div class="item-card">
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

            <div style="background-color: white; border-radius: 8px; padding: 15px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); margin-bottom: 20px;">
                <label for="comment" style="display: block; font-size: 14px; color: #2c3e50; font-weight: 600; margin-bottom: 8px;">
                    Commentaire :
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
    </script>
@endsection
