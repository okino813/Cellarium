@extends('layout.app')

@section('content')
    @if(session('success'))
        <div style="
            background-color: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            animation: fadeIn 0.5s ease-in-out;
        ">
            {{ session('success') }}
        </div>
    @endif
    <div class="return-inter-page" style="padding: 15px;">
        <h1 class="title-user">
            Vérification du VSAV
        </h1>
        <p class="instruction">Choisissez la source à vérifié</p>

        <div style="background-color: white; border-radius: 8px; padding: 20px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                 <div style="display: flex; flex-direction: column; gap: 12px;">
                @foreach($sources as $source)
                    <a
                        href="{{ route('front.verif.show', $source->id) }}"
                        style="
                        background-color: #f8f9fa;
                        border: 2px solid #B00020;
                        border-radius: 8px;
                        padding: 18px;
                        text-decoration: none;
                        color: #2c3e50;
                        font-size: 16px;
                        font-weight: 600;
                        text-align: center;
                        transition: all 0.3s;
                        display: block;
                    "
                        onmouseover="this.style.backgroundColor='#007bff'; this.style.color='white';"
                        onmouseout="this.style.backgroundColor='#f8f9fa'; this.style.color='#2c3e50';"
                    >
                        {{ $source->name }}
                    </a>
                @endforeach

                @if($sources->isEmpty())
                    <p style="text-align: center; color: #666; padding: 30px 0;">
                        Aucune source disponible.
                    </p>
                @endif
            </div>
        </div>
    </div>
@endsection
