@extends('layout.admin')

@section('content')
    <div class="container" style="max-width: 800px;">
        <!-- Formulaire de modification des informations -->
        <div style="margin-bottom: 30px;">
            <h1 style="font-size: 32px; color: #2c3e50; margin-bottom: 5px;">
                Modifier l'Administrateur
            </h1>
            <p style="color: #7f8c8d; margin: 0;">
                Modifiez les informations de <strong>{{ $admin->firstname }} {{ $admin->lastname }}</strong>
            </p>
        </div>

        <div class="card" style="padding-left:20px; padding-right:20px;">
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

            @if(session('success'))
                <div class="alert-success" style="margin-bottom: 20px;">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.admins.update', $admin->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Prénom -->
                <div style="margin-bottom: 20px;">
                    <label for="firstname" style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                        Prénom <span style="color: #e74c3c;">*</span>
                    </label>
                    <input
                        type="text"
                        name="firstname"
                        id="firstname"
                        class="input-field"
                        placeholder="Ex : Jean"
                        value="{{ old('firstname', $admin->firstname) }}"
                        required
                    >
                </div>

                <!-- Nom -->
                <div style="margin-bottom: 20px;">
                    <label for="lastname" style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                        Nom <span style="color: #e74c3c;">*</span>
                    </label>
                    <input
                        type="text"
                        name="lastname"
                        id="lastname"
                        class="input-field"
                        placeholder="Ex : Dupont"
                        value="{{ old('lastname', $admin->lastname) }}"
                        required
                    >
                </div>

                <!-- Email -->
                <div style="margin-bottom: 20px;">
                    <label for="email" style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                        Email <span style="color: #e74c3c;">*</span>
                    </label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="input-field"
                        placeholder="Ex : admin@caserne.fr"
                        value="{{ old('email', $admin->email) }}"
                        required
                    >
                    <small style="color: #7f8c8d; font-size: 13px;">L'email est utilisé pour se connecter</small>
                </div>

                <!-- Boutons -->
                <div style="display: flex; gap: 15px; border-top: 2px solid #dee2e6; padding-top: 20px;">
                    <button
                        type="submit"
                        class="btn btn-success"
                        style="flex: 1; padding: 14px; font-size: 16px; font-weight: bold;"
                    >
                        Enregistrer
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
    </div>

    <!-- Formulaire de changement de mot de passe -->
    <div class="container" style="margin-top: 40px;">
        <div style="margin-bottom: 30px;">
            <h2 style="font-size: 28px; color: #2c3e50; margin-bottom: 5px;">
                Changer le mot de passe
            </h2>
            <p style="color: #7f8c8d; margin: 0;">
                Définissez un nouveau mot de passe pour cet administrateur
            </p>
        </div>

        <div class="card" style="padding-left:20px; padding-right:20px;">
            <form action="{{ route('admin.admins.updatePassword', $admin->id) }}" method="POST">
                @csrf

                <!-- Nouveau mot de passe -->
                <div style="margin-bottom: 20px;">
                    <label for="newPassword" style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                        Nouveau mot de passe <span style="color: #e74c3c;">*</span>
                    </label>
                    <input
                        type="password"
                        name="newPassword"
                        id="newPassword"
                        class="input-field"
                        placeholder="••••••••"
                        required
                    >
                    <small style="color: #7f8c8d; font-size: 13px;">Minimum 8 caractères recommandés</small>
                </div>

                <!-- Confirmation du mot de passe -->
                <div style="margin-bottom: 20px;">
                    <label for="ConfNewPassword" style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                        Confirmation du mot de passe <span style="color: #e74c3c;">*</span>
                    </label>
                    <input
                        type="password"
                        name="ConfNewPassword"
                        id="ConfNewPassword"
                        class="input-field"
                        placeholder="••••••••"
                        required
                    >
                    <small style="color: #7f8c8d; font-size: 13px;">Saisissez à nouveau le mot de passe</small>
                </div>

                <!-- Bouton -->
                <div style="border-top: 2px solid #dee2e6; padding-top: 20px;">
                    <button
                        type="submit"
                        class="btn"
                        style="width: 100%; padding: 14px; font-size: 16px; font-weight: bold; background-color: #ff9800;"
                        onmouseover="this.style.backgroundColor='#e68900'"
                        onmouseout="this.style.backgroundColor='#ff9800'"
                    >
                        Changer le mot de passe
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Informations supplémentaires -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin: 20px; margin-top: 20px;">
        <div style="padding: 15px; background-color: #fff3e0; border-radius: 8px; border-left: 4px solid #FF9800;">
            <p style="margin: 0; font-size: 12px; color: #E65100; font-weight: 600;">MODIFIÉ LE</p>
            <p style="margin: 5px 0 0 0; font-size: 14px; color: #BF360C;">{{ $admin->updated_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <!-- Zone de danger -->
    <div style="margin: 20px; padding: 20px; background-color: #fff5f5; border-radius: 8px; border: 2px solid #e74c3c;">
        <h3 style="color: #e74c3c; margin: 0 0 10px 0; font-size: 18px;">Zone de danger</h3>
        <p style="color: #721c24; margin: 0 0 15px 0; font-size: 14px;">
            La suppression de cet administrateur est irréversible.
        </p>

        <a href="{{ route('admin.admins.delete', $admin->id) }}"
        onclick="return confirm('ATTENTION\n\nÊtes-vous sûr de vouloir supprimer cet administrateur ?\n\nCette action est IRRÉVERSIBLE.\n\nConfirmer la suppression ?')"
        style="display: inline-block; padding: 12px 24px; background-color: #e74c3c; color: white; text-decoration: none; border-radius: 4px; font-weight: bold; transition: background 0.3s;"
        onmouseover="this.style.backgroundColor='#c82333'"
        onmouseout="this.style.backgroundColor='#e74c3c'"
        >
        Supprimer définitivement cet administrateur
        </a>
    </div>

    <style>
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }
            h1, h2 {
                font-size: 24px !important;
            }
            .btn {
                font-size: 14px !important;
                padding: 12px !important;
            }
        }
    </style>
@endsection
