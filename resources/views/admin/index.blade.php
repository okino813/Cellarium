@extends('layout.admin')

@section('content')
    <div class="container" style="max-width: 1400px;">
        <h1 style="font-size: 32px; color: #2c3e50; margin-bottom: 10px;">
            Tableau de bord Administrateur
        </h1>
        <p style="color: #7f8c8d; margin-bottom: 30px;">
            Vue d'ensemble du stock et des alertes
        </p>

        <!-- Statistiques rapides -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px;">
            <!-- Card Total Items -->
            <div class="card" style="text-align: center; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                <h3 style="font-size: 18px; margin-bottom: 10px; color: white;">Total Items</h3>
                <p style="font-size: 42px; font-weight: bold; margin: 0;">{{ $totalItems ?? 0 }}</p>
            </div>

            <!-- Card Mouvements du mois -->
            <div class="card" style="text-align: center; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white;">
                <h3 style="font-size: 18px; margin-bottom: 10px; color: white;">Mouvements ce mois</h3>
                <p style="font-size: 42px; font-weight: bold; margin: 0;">{{ $movementsThisMonth ?? 0 }}</p>
            </div>

            <!-- Card Alertes -->
            <div class="card" style="text-align: center; background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); color: white;">
                <h3 style="font-size: 18px; margin-bottom: 10px; color: white;">Alertes Stock</h3>
                <p style="font-size: 42px; font-weight: bold; margin: 0;">{{ $lowStockCount ?? 0 }}</p>
            </div>
        </div>

        <!-- Alertes de stock faible -->
        <div class="card">
            <h2 style="font-size: 24px; color: #2c3e50; margin-bottom: 20px; border-bottom: 3px solid #e74c3c; padding-bottom: 10px;">
                Articles en rupture de stock
            </h2>

            @if(isset($lowStockItems) && $lowStockItems->count() > 0)
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                        <tr style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                            <th style="padding: 12px; text-align: left; font-weight: 600; color: #2c3e50;">Item</th>
                            <th style="padding: 12px; text-align: center; font-weight: 600; color: #2c3e50;">Stock Actuel</th>
                            <th style="padding: 12px; text-align: center; font-weight: 600; color: #2c3e50;">Statut</th>
                            <th style="padding: 12px; text-align: center; font-weight: 600; color: #2c3e50;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lowStockItems as $item)
                            <tr style="border-bottom: 1px solid #dee2e6; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#f8f9fa'" onmouseout="this.style.backgroundColor='white'">
                                <td style="padding: 12px; font-weight: 500;">{{ $item->name }}</td>
                                <td style="padding: 12px; text-align: center;">
                                    <span style="font-size: 18px; font-weight: bold; color: {{ $item->qty_stock <= 0 ? '#e74c3c' : '#f39c12' }};">
                                        {{ $item->total_qty }}
                                    </span>
                                </td>
                                <td style="padding: 12px; text-align: center;">
                                    @if($item->total_qty <= $item->seuil)
                                        <span style="background-color: #e74c3c; color: white; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold;">
                                            RUPTURE
                                        </span>
                                    @else
                                        <span style="background-color: #f39c12; color: white; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold;">
                                            ALERTE
                                        </span>
                                    @endif
                                </td>
                                <td style="padding: 12px; text-align: center;">
                                    <a href="{{ route('admin.items.edit', $item->id) }}" class="btn" style="padding: 8px 16px; font-size: 14px;">
                                        Gérer
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

        <!-- Accès rapides -->
        <div style="margin-top: 30px;">
            <h2 style="font-size: 24px; color: #2c3e50; margin-bottom: 20px;">
                Accès rapides
            </h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                <a href="{{ route('admin.items.create') }}" class="btn btn-success" style="padding: 20px; text-align: center; text-decoration: none; display: block;">
                    Nouvel Item
                </a>
                <a href="{{ route('admin.movement.index') }}" class="btn" style="padding: 20px; text-align: center; text-decoration: none; display: block;">
                    Voir Mouvements
                </a>
                <a href="{{ route('admin.sources.index') }}" class="btn" style="padding: 20px; text-align: center; text-decoration: none; display: block;">
                    Gérer Sources
                </a>
            </div>
        </div>
    </div>
@endsection
