<nav>
    <div class="nav-container">
        <div>
            <a href="/" class="nav-logo">

                    Cellarium
            </a>
        </div>

        <div class="nav-links">

            @if(session()->has('code'))

                <form action="{{ route('logout') }}" method="POST" style="display: inline; margin: 0;">
                    @csrf
                    <button type="submit" class="btn">Déconnexion</button>
                </form>
            @else
                <a href="/login" class="nav-link">Connexion</a>
            @endif
        </div>
    </div>
</nav>
