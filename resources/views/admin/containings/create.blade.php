@extends('layout.app')

@section('content')
    <div class="admin-page">
        <h1 class="title-user">
                Ajouter un Contenant
            </h1>

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

                <div class="card form-item" >

                <!-- Nom -->
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

                </div>

                <!-- Boutons -->
                    <button
                        type="submit"
                        class="btn-save btn-success"
                        style="flex: 1; padding: 14px; font-size: 16px; font-weight: bold;"
                        @if($sources->isEmpty()) disabled @endif
                    >
                        Créer le contenant
                    </button>

            </form>
        </div>

@endsection
