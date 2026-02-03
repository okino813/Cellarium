@extends('layout.admin')

@section('content')
    <div class="container" style="max-width: 1400px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; flex-wrap: wrap; gap: 15px;">
            <div>
                <h1 style="font-size: 32px; color: #2c3e50; margin-bottom: 5px;">
                    Liste des Contenants
                </h1>
                <p style="color: #7f8c8d; margin: 0;">
                    Gérez tous les contenants (sacs, armoires, etc.)
                </p>
            </div>
            <a href="{{ route('admin.containings.create') }}" class="btn btn-success" style="padding: 12px 24px; font-size: 16px; text-decoration: none;">
                + Ajouter un contenant
            </a>
        </div>

        <!-- Statistiques rapides -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 30px;">
            <div class="card" style="text-align: center; padding: 15px;">
                <p style="color: #7f8c8d; margin: 0; font-size: 14px;">Total Contenants</p>
                <p style="font-size: 32px; font-weight: bold; color: #2c3e50; margin: 5px 0 0 0;">{{ $containings->count() }}</p>
            </div>
            <div class="card" style="text-align: center; padding: 15px;">
                <p style="color: #7f8c8d; margin: 0; font-size: 14px;">Sources Utilisées</p>
                <p style="font-size: 32px; font-weight: bold; color: #007bff; margin: 5px 0 0 0;">
                    {{ $containings->pluck('source_id')->unique()->count() }}
                </p>
            </div>
        </div>

        <div class="card">
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                    <tr style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                        <th style="padding: 15px; text-align: left; font-weight: 600; color: #2c3e50; width: 40%;">Nom du Contenant</th>
                        <th style="padding: 15px; text-align: left; font-weight: 600; color: #2c3e50; width: 35%;">Source Associée</th>
                        <th style="padding: 15px; text-align: center; font-weight: 600; color: #2c3e50; width: 25%;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($containings as $containing)
                        <tr style="border-bottom: 1px solid #dee2e6; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#f8f9fa'" onmouseout="this.style.backgroundColor='white'">
                            <td style="padding: 15px; font-weight: 500; color: #2c3e50;">
                                {{ $containing->name }}
                            </td>
                            <td style="padding: 15px; color: #495057;">
                                <span style="background-color: #e7f3ff; color: #0d47a1; padding: 5px 12px; border-radius: 20px; font-size: 13px; font-weight: 600;">
                                  {{ json_decode($containing->source, true)['name'] ?? 'Aucun' }}
                                </span>
                            </td>
                            <td style="padding: 15px; text-align: center;">
                                <div style="display: flex; gap: 8px; justify-content: center; flex-wrap: wrap;">
                                    <a href="{{ route('admin.containings.edit', $containing->id) }}"
                                       style="padding: 6px 12px; background-color: #007bff; color: white; text-decoration: none; border-radius: 4px; font-size: 14px; transition: background 0.2s;"
                                       onmouseover="this.style.backgroundColor='#0056b3'"
                                       onmouseout="this.style.backgroundColor='#007bff'">
                                        Modifier
                                    </a>
                                    <a href="{{ route('admin.containings.delete', $containing->id) }}"
                                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contenant ?')"
                                       style="padding: 6px 12px; background-color: #dc3545; color: white; text-decoration: none; border-radius: 4px; font-size: 14px; transition: background 0.2s;"
                                       onmouseover="this.style.backgroundColor='#c82333'"
                                       onmouseout="this.style.backgroundColor='#dc3545'">
                                        Supprimer
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" style="padding: 40px; text-align: center; color: #7f8c8d;">
                                <p style="font-size: 18px; margin: 0;">Aucun contenant trouvé</p>
                                <p style="margin: 10px 0 0 0;">
                                    <a href="{{ route('admin.containings.create') }}" style="color: #007bff; text-decoration: underline;">
                                        Ajouter votre premier contenant
                                    </a>
                                </p>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Info utile -->
        <div style="margin-top: 20px; padding: 15px; background-color: #f8f9fa; border-radius: 8px; border-left: 4px solid #007bff;">
            <p style="margin: 0; font-size: 14px; color: #2c3e50;">
                <strong>Astuce :</strong> Les contenants sont des emplacements de stockage (sacs, armoires, tiroirs) situés dans une source (véhicule ou local).
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
            .btn {
                font-size: 14px !important;
                padding: 8px 12px !important;
            }
        }
    </style>
@endsection
