@extends('layout.app')

@section('content')
    <div class="admin-page">
        <h1 class="title-user">
            Statistique
        </h1>

        <!-- Statistiques rapides -->
        <div class="card-stat-list">
            <!-- Card Total Items -->
            <div class="card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <h3>Total Items</h3>
                <p>{{ $totalItems ?? 0 }}</p>
            </div>

            <!-- Card Mouvements du mois -->
            <div class="card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <h3>Mouvements ce mois</h3>
                <p>{{ $movementsThisMonth ?? 0 }}</p>
            </div>

            <!-- Card Alertes -->
            <div class="card" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                <h3>Alertes Stock</h3>
                <p>{{ $lowStockCount ?? 0 }}</p>
            </div>
        </div>

        {{--        <!-- Alertes de stock faible -->--}}
        <div>
            <h1 class="title-user">
                Rupture de stock
            </h1>

            @if(isset($lowStockItems) && $lowStockItems->count() > 0)
                <div class="list-item-rupture">
                    @foreach($lowStockItems as $item)
                        <a class="card" href="{{ route('admin.items.edit', $item->id) }}">
                            <p class="name">{{ $item->name }}</p>
                            <p class="stock" style="font-size: 18px; font-weight: bold; color: {{ $item->qty_stock <= 0 ? '#e74c3c' : '#f39c12' }};">
                                {{ $item->total_qty }}
                            </p>
                        </a>

                    @endforeach
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
@endsection
