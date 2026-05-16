@extends('layout.app')

@section('content')
    <div class="admin-page">
        <h1 class="title-user">
            Modifier l'utilisateur
        </h1>
        <p class="instruction">
            Modifiez les informations de <strong>{{ $user->name }}</strong>
        </p>

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

        <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

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
                    value="{{ old('firstname', $user->firstname) }}"
                    required
                >

                <label for="lastname" style="margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                    Prénom <span style="color: #e74c3c;">*</span>
                </label>
                <input
                    type="text"
                    name="lastname"
                    id="lastname"
                    class="input-field"
                    placeholder="Ex : Delacours"
                    value="{{ old('lastname', $user->lastname) }}"
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
                    placeholder="Ex : Compresses stériles"
                    value="{{ old('email', $user->email) }}"
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
                    placeholder="Ex : 56465"
                    value="{{ old('matricule', $user->matricule) }}"
                    required
                >
            </div>
            <!-- Est Admin ? -->
            <div class="card form-item" >
                <div class="field">
                    <label for="isAdmin" style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                        Est admin ?
                    </label>
                    <label class="switch">
                        <input name="isAdmin" id="isAdmin" type="checkbox" {{ old('isAdmin', $user->isAdmin) == 1 ? 'checked' : '' }}>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>

            <div class="card stock_fields" id="stock_fields">

                <!-- Password -->
                <div style="margin-bottom: 20px;">
                    <label for="password" style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                        Mot de passe <span style="color: #e74c3c;">*</span>
                    </label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="input-field"
                        placeholder="Modifier pour mettre à jours"
                        value=""
                    >
                    <small style="color: #7f8c8d; font-size: 13px;">Laissez le chanps vide pour ne mas modifé le mot de passe</small>
                </div>
            </div>

            <a class="btn-delete"
               href="{{ route('admin.user.delete', $user->id) }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M136.7 5.9L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-8.7-26.1C306.9-7.2 294.7-16 280.9-16L167.1-16c-13.8 0-26 8.8-30.4 21.9zM416 144L32 144 53.1 467.1C54.7 492.4 75.7 512 101 512L347 512c25.3 0 46.3-19.6 47.9-44.9L416 144z"/></svg>
                Supprimer
            </a>


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
                var stockFields = document.getElementById('stock_fields');
                const seuil = document.getElementById('seuil');
                const totalQtyInput = document.getElementById('total_qty');
                const seuilInput = document.getElementById('seuil');

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
