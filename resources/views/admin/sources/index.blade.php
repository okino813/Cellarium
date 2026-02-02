@extends('layout.admin')

@section('content')
    <div class="container" style="max-width: 1400px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; flex-wrap: wrap; gap: 15px;">
            <div>
                <h1 style="font-size: 32px; color: #2c3e50; margin-bottom: 5px;">
                    Liste des Sources
                </h1>
                <p style="color: #7f8c8d; margin: 0;">
                    Gérez tous les véhicules et locaux
                </p>
            </div>
            <a href="{{ route('admin.sources.create') }}" class="btn btn-success" style="padding: 12px 24px; font-size: 16px; text-decoration: none;">
                + Ajouter une source
            </a>
        </div>

        <!-- Statistiques rapides -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 30px;">
            <div class="card" style="text-align: center; padding: 15px;">
                <p style="color: #7f8c8d; margin: 0; font-size: 14px;">Total Sources</p>
                <p style="font-size: 32px; font-weight: bold; color: #2c3e50; margin: 5px 0 0 0;">{{ $sources->count() }}</p>
            </div>
        </div>

        <div class="card">
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                    <tr style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                        <th style="padding: 15px; text-align: left; font-weight: 600; color: #2c3e50; width: 70%;">Nom</th>
                        <th style="padding: 15px; text-align: center; font-weight: 600; color: #2c3e50; width: 30%;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($sources as $source)
                        <tr style="border-bottom: 1px solid #dee2e6; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#f8f9fa'" onmouseout="this.style.backgroundColor='white'">
                            <td style="padding: 15px; font-weight: 500; color: #2c3e50;">
                                {{ $source->name }}
                            </td>
                            <td style="padding: 15px; text-align: center;">
                                <div style="display: flex; gap: 8px; justify-content: center; flex-wrap: wrap;">
                                    <a href="{{ route('admin.sources.edit', $source->id) }}"
                                       style="padding: 6px 12px; background-color: #007bff; color: white; text-decoration: none; border-radius: 4px; font-size: 14px; transition: background 0.2s;"
                                       onmouseover="this.style.backgroundColor='#0056b3'"
                                       onmouseout="this.style.backgroundColor='#007bff'">
                                        Modifier
                                    </a>
                                    <a href="{{ route('admin.sources.delete', $source->id) }}"
                                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette source ?')"
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
                            <td colspan="2" style="padding: 40px; text-align: center; color: #7f8c8d;">
                                <p style="font-size: 18px; margin: 0;">Aucune source trouvée</p>
                                <p style="margin: 10px 0 0 0;">
                                    <a href="{{ route('admin.sources.create') }}" style="color: #007bff; text-decoration: underline;">
                                        Ajouter votre première source
                                    </a>
                                </p>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
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
