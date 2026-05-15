@extends('layout.app')

@section('content')
    <div class="admin-page">
        <h1 class="title-user">
                    Liste des Sources
                </h1>
        <p class="instruction">
                    Gérez tous les véhicules et locaux
                </p>

        <a href="{{ route('admin.sources.create') }}" class="btn-add">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M256 64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 160-160 0c-17.7 0-32 14.3-32 32s14.3 32 32 32l160 0 0 160c0 17.7 14.3 32 32 32s32-14.3 32-32l0-160 160 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-160 0 0-160z"/></svg>
        </a>


        <div class="list-contain-admin">
                    @forelse($sources as $source)
                <a href="{{ route('admin.sources.edit', $source->id) }}" class="card source">
                    <div class="text">
                        <p class="name">
                            {{ $source->name }}
                        </p>
                    </div>

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l370.7 0-105.4 105.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/></svg>
                </a>
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
