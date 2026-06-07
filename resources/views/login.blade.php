@extends('layout.login')

@section('content')
    <div class="container">
        <div class="card" style="max-width: 500px; margin: 50px auto; padding: 20px;">
            <h1 class="text-center">Connexion</h1>
            <p class="text-center" style="margin-bottom: 30px;">
                Veuillez entrer votre code caserne pour accéder au suivi de stock.
            </p>

            @if($errors->any())
                <div class="alert-error">
                    @foreach($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif

            @if(session('error'))
                <div class="alert-error">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login.validate') }}" method="POST">
                @csrf

                <div style="margin-bottom: 20px;">
                    <label for="code" style="display: block; margin-bottom: 5px; font-weight: bold;">
                        Code caserne :
                    </label>
                    <input
                        type="number"
                        id="code"
                        name="code"
                        class="input-field"
                        placeholder="Ex : 123456"
                        value="{{ old('code', $code ?? '') }}"
                        required
                    >
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="matricule" style="display: block; margin-bottom: 5px; font-weight: bold;">
                        Matricule :
                    </label>
                    <input
                        type="number"
                        id="matricule"
                        name="matricule"
                        class="input-field"
                        placeholder="Ex : 759644"
                        value="{{ old('matricule') }}"
                        required
                    >
                </div>

                <button type="submit" class="btn btn-login">
                    Se connecter
                </button>
            </form>
        </div>

        <a href="{{route("admin.login")}}">Admin ? Cliquez ici</a>
    </div>
@endsection
