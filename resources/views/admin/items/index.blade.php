@extends('layout.app')

@section('content')
    <div class="admin-page">
        <h1 class="title-user">
            Liste des Items
        </h1>
        <p class="instruction">
            Gérez tous les items du stock
        </p>

        <a href="{{ route('admin.items.create') }}" class="btn-add">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M256 64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 160-160 0c-17.7 0-32 14.3-32 32s14.3 32 32 32l160 0 0 160c0 17.7 14.3 32 32 32s32-14.3 32-32l0-160 160 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-160 0 0-160z"/></svg>
        </a>

        <div class="list-item-admin">
            @forelse($items as $item)
                <a class="card" href="{{ route('admin.items.edit', $item->id) }}">
                    <div class="name-seuil">
                        <p>{{ $item->name }}</p>

                        @if($item->is_stock)
                            <p class="seuil">
                                Seuil : {{ $item->seuil }}
                            </p>
                        @endif
                    </div>

                    <div class="qty-status">
                        <div class="qty">
                            @if(!$item->is_stock)
                                <div class="background">
                                    <p>Non stocké</p>
                                </div>
                            @else
                                <span class="print" style="color: {{ $item->total_qty <= $item->seuil ? '#e74c3c' : '#28a745' }};">
                                    {{ $item->total_qty }}
                                </span>
                            @endif

                            @if($item->is_stock)
                                @if($item->total_qty <= $item->seuil)
                                    <div class="background-rupture">
                                        <p>
                                            Rupture
                                        </p>
                                    </div>
                                @else
                                    <div class="background-ok">
                                        <p>
                                            Ok
                                        </p>
                                    </div>

                                @endif
                            @endif
                        </div>
                    </div>

                </a>
            @empty
                <div>
                    <p>Aucun item trouvé</p>
                    <p>
                        <a href="{{ route('admin.items.create') }}" style="color: #007bff; text-decoration: underline;">
                            Ajouter votre premier item
                        </a>
                    </p>
                </div>

            @endforelse
        </div>
    </div>
@endsection
