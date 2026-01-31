@extends('layout.app')

@section('content')
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
