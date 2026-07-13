@extends('layout.login')

@section('content')
<div class="container">
    <div class="card" style="max-width: 500px; margin: 0px auto; padding:20px;">
        <div style="text-align: center; margin-bottom: 30px;">
            <h1 style="font-size: 32px; color: #2c3e50; margin-bottom: 10px;">
                Administration
            </h1>
            <p style="color: #7f8c8d;">
                Connectez-vous pour accéder au back-office
            </p>
        </div>

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

        <form method="POST" action="{{ route('admin.login.validate') }}">
            @csrf

            <div style="margin-bottom: 20px;">
                <label for="code" style="display: block; margin-bottom: 5px; font-weight: bold;">
                    Code caserne :
                </label>
                <input
                    type="number"
                    name="code"
                    id="code"
                    class="input-field"
                    value="{{ old('code', $code ?? '') }}"
                    placeholder="Ex: 123456"
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
                    value="{{ old('matricule') }}"
                    placeholder="Ex: 123456"
                    required
                >
            </div>

            <div style="margin-bottom: 20px;">
                <label for="password" style="display: block; margin-bottom: 5px; font-weight: bold;">
                    Mot de passe :
                </label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="input-field"
                    placeholder="••••••••"
                    required
                >
            </div>

            <button type="submit" class="btn btn-login" >
                Se connecter
            </button>
        </form>

        <div style="margin-top: 20px;">
           @if(old('code', $code))
            <a href="{{route("front.login.code", $code)}}">Utilisateur ? Cliquez ici</a>
        @else
            <a href="{{route("front.login")}}">Utilisateur ? Cliquez ici</a>
        @endif
        
        </div>
    </div>
@endsection
