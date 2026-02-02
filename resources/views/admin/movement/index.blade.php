@extends('layout.admin')

@section('content')
    <div class="container" style="max-width: 1400px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; flex-wrap: wrap; gap: 15px;">
            <div>
                <h1 style="font-size: 32px; color: #2c3e50; margin-bottom: 5px;">
                    Mouvements de Stock
                </h1>
            </div>
        </div>

        <!-- Statistiques rapides -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 30px;">
            <div class="card" style="text-align: center; padding: 15px;">
                <p style="color: #7f8c8d; margin: 0; font-size: 14px;">Total Mouvements</p>
                <p style="font-size: 32px; font-weight: bold; color: #2c3e50; margin: 5px 0 0 0;">{{ $movements->count() }}</p>
            </div>
            <div class="card" style="text-align: center; padding: 15px;">
                <p style="color: #7f8c8d; margin: 0; font-size: 14px;">Ce mois</p>
                <p style="font-size: 32px; font-weight: bold; color: #007bff; margin: 5px 0 0 0;">
                    {{ $movements->where('created_at', '>=', now()->startOfMonth())->count() }}
                </p>
            </div>

        </div>

        <div class="card" style="margin:0px !important;">
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                    <tr style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                        <th style="padding: 15px; text-align: left; font-weight: 600; color: #2c3e50; width: 180px;">Date</th>
                        <th style="padding: 15px; text-align: left; font-weight: 600; color: #2c3e50; width: 150px;">Utilisateur</th>
                        <th style="padding: 15px; text-align: left; font-weight: 600; color: #2c3e50;">Mouvements</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($movements as $movement)
                        <tr style="border-bottom: 1px solid #dee2e6; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#f8f9fa'" onmouseout="this.style.backgroundColor='white'">
                            <td style="padding: 15px; color: #495057;">
                                <div style="font-weight: 500; color: #2c3e50;">{{ $movement->created_at->format('d/m/Y') }}</div>
                                <div style="font-size: 13px; color: #7f8c8d;">{{ $movement->created_at->format('H:i') }}</div>
                            </td>
                            <td style="padding: 15px; font-weight: 500; color: #2c3e50;">
                                {{ $movement->firstname }}
                            </td>
                            <td style="padding: 15px;">
                                <div style="display: flex; flex-direction: column; gap: 6px;">
                                    @foreach($movement->items as $item)
                                        <div style="display: flex; align-items: center; gap: 8px;">
                                            @if($item->pivot->operation > 0)
                                                <span style="background-color: #d4edda; color: #155724; padding: 3px 8px; border-radius: 12px; font-size: 12px; font-weight: bold; min-width: 40px; text-align: center;">
                                                    +{{ $item->pivot->operation }}
                                                </span>
                                            @else
                                                <span style="background-color: #f8d7da; color: #721c24; padding: 3px 8px; border-radius: 12px; font-size: 12px; font-weight: bold; min-width: 40px; text-align: center;">
                                                    {{ $item->pivot->operation }}
                                                </span>
                                            @endif
                                            <span style="color: #495057;">{{ $item->name }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" style="padding: 40px; text-align: center; color: #7f8c8d;">
                                <p style="font-size: 18px; margin: 0;">Aucun mouvement enregistré</p>
                                <p style="margin: 10px 0 0 0; font-size: 14px;">
                                    Les mouvements apparaîtront ici lorsque des utilisateurs feront des retours d'intervention.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Légende -->
        <div style="margin-top: 20px; padding: 15px; background-color: #f8f9fa; border-radius: 8px; border-left: 4px solid #007bff;">
            <p style="margin: 0; font-size: 14px; color: #2c3e50;">
                <strong>Légende :</strong><br>
                <span style="background-color: #d4edda; color: #155724; padding: 2px 8px; border-radius: 12px; font-size: 12px; font-weight: bold;">+X</span> Entrée en stock
                <br>
                <span style="background-color: #f8d7da; color: #721c24; padding: 2px 8px; border-radius: 12px; font-size: 12px; font-weight: bold;">-X</span> Sortie de stock
            </p>
        </div>
    </div>

    <style>
        @media (max-width: 768px) {
            table {
                font-size: 14px;
            }
            th, td {
                padding: 10px 8px !important;
            }
        }
    </style>
@endsection
