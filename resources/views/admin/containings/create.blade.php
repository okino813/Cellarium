@extends('layout.admin')

@section('content')
    <div class="container" style="max-width: 800px;">
        <div style="margin-bottom: 30px;">
            <h1 style="font-size: 32px; color: #2c3e50; margin-bottom: 5px;">
                Ajouter un Contenant
            </h1>
        </div>

        <div class="card">
            @if($errors->any())
                <div class="alert-error" style="margin-bottom: 20px;">
                    <strong>Erreurs :</strong>
                    <ul style="margin: 10px 0 0 20px; padding: 0;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.containings.store') }}" method="POST">
                @csrf

                <!-- Nom -->
                <div style="margin-bottom: 20px; padding-left:20px; padding-right:20px;">
                    <label for="name" style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                        Nom du contenant <span style="color: #e74c3c;">*</span>
                    </label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="input-field"
                        placeholder="Ex : Saccoche, Tiroir ..."
                        value="{{ old('name') }}"
                        required
                    >
                </div>

                <!-- Source associée -->
                <div style="margin-bottom: 20px; padding-left:20px; padding-right:20px;">
                    <label for="source_id" style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                        Source associée <span style="color: #e74c3c;">*</span>
                    </label>
                    <select
                        name="source_id"
                        id="source_id"
                        class="input-field"
                        style="cursor: pointer;"
                        required
                    >
                        @foreach($sources as $source)
                            <option value="{{ $source->id }}" {{ old('source_id') == $source->id ? 'selected' : '' }}>
                                {{ $source->name }}
                            </option>
                        @endforeach
                    </select>
                    <small style="color: #7f8c8d; font-size: 13px;">
                        Le véhicule ou local où se trouve ce contenant
                    </small>
                </div>

                @if($sources->isEmpty())
                    <div style="padding: 15px; background-color: #fff3cd; border-left: 4px solid #ffc107; margin-bottom: 20px; border-radius: 4px;">
                        <p style="margin: 0; color: #856404; font-size: 14px;">
                            <strong>Attention :</strong> Aucune source n'est disponible.
                            <a href="{{ route('admin.sources.create') }}" style="color: #007bff; text-decoration: underline;">
                                Créez d'abord une source
                            </a> avant de créer un contenant.
                        </p>
                    </div>
                @endif

                <!-- Boutons -->
                <div style="display: flex; gap: 15px; border-top: 2px solid #dee2e6; padding-top: 20px; margin-top: 30px; padding-left:20px; padding-right:20px;">
                    <button
                        type="submit"
                        class="btn btn-success"
                        style="flex: 1; padding: 14px; font-size: 16px; font-weight: bold;"
                        @if($sources->isEmpty()) disabled @endif
                    >
                        Créer le contenant
                    </button>

                    <a href="{{ route('admin.containings.index') }}"
                    style="flex: 1; padding: 14px; font-size: 16px; font-weight: bold; text-align: center; background-color: #6c757d; color: white; text-decoration: none; border-radius: 4px; transition: background 0.3s;"
                    onmouseover="this.style.backgroundColor='#5a6268'"
                    onmouseout="this.style.backgroundColor='#6c757d'"
                    >
                    Annuler
                    </a>
                </div>
            </form>
        </div>

        <!-- Info card -->
        <div style="margin-top: 20px; padding: 15px; background-color: #d1ecf1; border-radius: 8px; border-left: 4px solid #17a2b8;">
            <p style="margin: 0; font-size: 14px; color: #0c5460;">
                <strong>Qu'est-ce qu'un contenant ?</strong> Un contenant est un sac, un tiroir ou tout autre emplacement de rangement situé dans une source (véhicule ou local).
            </p>
        </div>


    </div>

    <style>
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }
            h1 {
                font-size: 24px !important;
            }
            .btn {
                font-size: 14px !important;
                padding: 12px !important;
            }
        }
    </style>
@endsection
