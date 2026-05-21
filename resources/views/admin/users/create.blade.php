@extends('layout.app')

@section('content')
    <div class="admin-page">
        <h1 class="title-user">
            Ajout d'un utilisateur
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

        @if(session('success'))
            <div class="alert-success" style="margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.user.store') }}" method="POST">
            @csrf
            @method('POST')

            <!-- Nom -->
            <div class="card form-item" >
                <label for="firstname" style="margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                    Prénom <span style="color: #e74c3c;">*</span>
                </label>
                <input
                    type="text"
                    name="firstname"
                    id="firstname"
                    class="input-field"
                    placeholder="Ex : Françis"
                    required
                >

                <label for="lastname" style="margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                    Nom de famille <span style="color: #e74c3c;">*</span>
                </label>
                <input
                    type="text"
                    name="lastname"
                    id="lastname"
                    class="input-field"
                    placeholder="Ex : Delacours"
                    required
                >

                <label for="email" style="margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                    Email <span style="color: #e74c3c;">*</span>
                </label>
                <input
                    type="text"
                    name="email"
                    id="email"
                    class="input-field"
                    placeholder="Ex : francis@sdis-vendee.fr"
                    required
                >

                <label for="matricule" style="margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                    Matricule <span style="color: #e74c3c;">*</span>
                </label>
                <input
                    type="text"
                    name="matricule"
                    id="matricule"
                    class="input-field"
                    placeholder="Ex : 12956"
                    required
                >
            </div>


            <!-- Est admin -->
            @if(session()->has('isAdminChief') and session('isAdminChief') == true)
            <div class="card form-item" >
                <div class="field">
                    <label for="isAdmin" style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                        Est admin ?
                    </label>
                    <label class="switch">
                        <input name="isAdmin" id="isAdmin" type="checkbox">
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>

            <div class="card stock_fields password_fields" id="password_fields">

                <!-- Quantité en stock -->
                <div style="margin-bottom: 20px;">
                    <label for="password" style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                        Mot de passe <span style="color: #e74c3c;">*</span>
                    </label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="input-field"
                        placeholder=""
                    >
                </div>

            </div>
            @endif


            <!-- Boutons -->
            <button
                type="submit"
                class="btn-save btn-success"
            >
                Enregistrer
            </button>
        </form>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var isStockSelect = document.getElementById('isAdmin');
                var stockFields = document.getElementById('password_fields');

                // Fonction pour masquer/afficher les champs
                function toggleStockFields() {
                    if (!isStockSelect.checked) {
                        stockFields.style.display = 'none';
                    } else {
                        stockFields.style.display = 'block';
                    }
                }

                // Appelle la fonction au chargement de la page
                toggleStockFields();

                // Ajoute un écouteur d'événement pour le changement de sélection
                isStockSelect.addEventListener('change', toggleStockFields);
            });
        </script>

    </div>

@endsection
