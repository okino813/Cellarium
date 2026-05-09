@extends('layout.app')

@section('content')
    <div class="admin-page">
        <h1 class="title-user">Mouvements de Stock</h1>


        <div class="list-movement">
            @forelse($movements as $movement)
                <div class="card">
                    <div class="row">
                        <p>{{ $movement->firstname }}</p>
                        <p class="date">{{ $movement->created_at->format('d/m/Y') }}
                            {{ $movement->created_at->format('H:i') }}</p>
                    </div>

                    <div class="divider"></div>

                    <div class="list-item">
                        @foreach($movement->items as $item)
                            <div class="item">
                                @if($item->pivot->operation > 0)
                                    <span style="background-color: #d4edda; color: #155724; padding: 3px 8px; border-radius: 12px; font-size: 12px; font-weight: bold; min-width: 40px; text-align: center;">
                                                    +{{ $item->pivot->operation }}
                                                </span>
                                @else
                                    <span style="background-color: #f8d7da; color: #721c24; padding: 3px 8px; border-radius: 12px; font-size: 12px; font-weight: bold; min-width: 40px; text-align: center;">
                                                    {{ $item->pivot->operation }}
                                                </span>
                                @endif
                                <span style="color: #495057;">{{ $item->name }}</span>
                            </div>
                        @endforeach
                    </div>

                    @if(isset($movement->comment) and strlen($movement->comment) > 1)
                        <div class="comment">
                            <p><b>Commentaire :</b></p>
                            <p style="font-style: italic">"{{$movement->comment}}"</p>
                        </div>
                    @endif
                </div>

            @empty
                <div>
                    <p style="font-size: 18px; margin: 0;">Aucun mouvement enregistré</p>
                    <p style="margin: 10px 0 0 0; font-size: 14px;">
                        Les mouvements apparaîtront ici lorsque des utilisateurs feront des retours d'intervention.
                    </p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
