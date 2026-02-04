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
    <div class="container">

        <div class="grid-2">
            <div class="card text-center">
                <h2>Retours d'Intervention</h2>
                <p style="margin-bottom: 25px;">
                    Renseignez les éléments pris dans la réserve après une intervention.
                </p>
                <a href="{{ route('front.return-inter.index') }}" class="btn">Accéder</a>
            </div>

            <div class="card text-center">
                <h2>Vérification des Engins</h2>
                <p style="margin-bottom: 25px;">
                    Vérifiez les engins et leur contenu.
                </p>
                <a href="{{ route('front.verif.index') }}" class="btn btn-success">Accéder</a>
            </div>
        </div>
    </div>
@endsection
