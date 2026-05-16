@extends('layout.app')

@section('content')
    <div class="admin-page">
        <h1 class="title-user">
            Liste des Utilisateurs
        </h1>
        <p class="instruction">
            Gérez tous les utilisateurs
        </p>

        <a href="{{ route('admin.user.create') }}" class="btn-add">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M256 64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 160-160 0c-17.7 0-32 14.3-32 32s14.3 32 32 32l160 0 0 160c0 17.7 14.3 32 32 32s32-14.3 32-32l0-160 160 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-160 0 0-160z"/></svg>
        </a>

        <div class="list-item-admin">
            @forelse($users as $user)
                <a class="card" href="{{ route('admin.user.edit', $user->id) }}">
                    <div class="name-seuil">
                        <p>{{ $user->firstname }} {{ $user->lastname }}</p>
                    </div>
                    <p>{{ $user->matricule }}</p>
                </a>
            @empty
                <div>
                    <p>Aucun utilisateur trouvé</p>
                    <p>
                        <a href="{{ route('admin.user.create') }}" style="color: #007bff; text-decoration: underline;">
                            Ajouter votre premier utilisateur
                        </a>
                    </p>
                </div>

            @endforelse
        </div>
    </div>
@endsection
