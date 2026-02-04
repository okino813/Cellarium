@extends('layout.admin')

@section('content')
    <div class="container" style="max-width: 800px;">
        <div style="margin-bottom: 30px;">
            <h1 style="font-size: 32px; color: #2c3e50; margin-bottom: 5px;">
                Ajouter un Administrateur
            </h1>
            <p style="color: #7f8c8d; margin: 0;">
                Créez un nouveau compte administrateur
            </p>
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

            <form action="{{ route('admin.admins.store') }}" method="POST">
                @csrf

                <!-- Prénom -->
                <div style="margin-bottom: 20px; padding-left: 20px; padding-right: 20px;">
                    <label for="firstname" style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                        Prénom <span style="color: #e74c3c;">*</span>
                    </label>
                    <input
                        type="text"
                        name="firstname"
                        id="firstname"
                        class="input-field"
                        placeholder="Ex : Jean"
                        value="{{ old('firstname') }}"
                        required
                    >
                </div>

                <!-- Nom -->
                <div style="margin-bottom: 20px; padding-left: 20px; padding-right: 20px;">
                    <label for="lastname" style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                        Nom <span style="color: #e74c3c;">*</span>
                    </label>
                    <input
                        type="text"
                        name="lastname"
                        id="lastname"
                        class="input-field"
                        placeholder="Ex : Dupont"
                        value="{{ old('lastname') }}"
                        required
                    >
                </div>

                <!-- Email -->
                <div style="margin-bottom: 20px; padding-left: 20px; padding-right: 20px;">
                    <label for="email" style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                        Email <span style="color: #e74c3c;">*</span>
                    </label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="input-field"
                        placeholder="Ex : admin@caserne.fr"
                        value="{{ old('email') }}"
                        required
                    >
                    <small style="color: #7f8c8d; font-size: 13px;">L'email sera utilisé pour se connecter</small>
                </div>

                <!-- Mot de passe -->
                <div style="margin-bottom: 20px; padding-left: 20px; padding-right: 20px;">
                    <label for="password" style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                        Mot de passe <span style="color: #e74c3c;">*</span>
                    </label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="input-field"
                        placeholder="••••••••"
                        required
                    >
                    <small style="color: #7f8c8d; font-size: 13px;">Minimum 8 caractères recommandés</small>
                </div>

                <!-- Boutons -->
                <div style="display: flex; gap: 15px; border-top: 2px solid #dee2e6; padding-top: 20px; margin-top: 30px; padding-left: 20px; padding-right: 20px;">
                    <button
                        type="submit"
                        class="btn btn-success"
                        style="flex: 1; padding: 14px; font-size: 16px; font-weight: bold;"
                    >
                        Créer l'administrateur
                    </button>

                    <a href="{{ route('admin.admins.index') }}"
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
        <div style="margin-top: 20px; padding: 15px; background-color: #fff3cd; border-radius: 8px; border-left: 4px solid #ffc107;">
            <p style="margin: 0; font-size: 14px; color: #856404;">
                <strong>Important :</strong> L'administrateur pourra gérer tous les aspects du système. Assurez-vous de créer un mot de passe sécurisé.
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
