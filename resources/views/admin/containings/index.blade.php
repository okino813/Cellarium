@extends('layout.app')

@section('content')
    <div class="admin-page">
        <h1 class="title-user">
            Liste des Contenants
        </h1>
        <p class="instruction">
            Gérez tous les contenants (sacs, armoires, etc.)
        </p>
        <a href="{{ route('admin.containings.create') }}" class="btn-add">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M256 64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 160-160 0c-17.7 0-32 14.3-32 32s14.3 32 32 32l160 0 0 160c0 17.7 14.3 32 32 32s32-14.3 32-32l0-160 160 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-160 0 0-160z"/></svg>
        </a>



        <div class="list-contain-admin">
            @forelse($containings as $containing)
                <a class="card" href="{{ route('admin.containings.edit', $containing->id) }}">
                    <div class="text">
                        <p class="name">
                            {{ $containing->name }}
                        </p>
                        <p class="source">
                            {{ json_decode($containing->source, true)['name'] ?? 'Aucun' }}
                        </p>
                    </div>

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l370.7 0-105.4 105.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/></svg>

                </a>
            @empty
                <div>
                    <p style="font-size: 18px; margin: 0;">Aucun contenant trouvé</p>
                    <p>
                        <a href="{{ route('admin.containings.create') }}" style="color: #007bff; text-decoration: underline;">
                            Ajouter votre premier contenant
                        </a>
                    </p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
