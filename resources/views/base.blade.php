<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titre')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-primary navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Tech-Shop</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02"
                aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active " aria-current="page" href="{{ route('shop.index') }}">Articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->route()->getName() === 'shop.create' ? 'active' : '' }}"
                            href="{{ route('shop.create') }}">
                            Ajouter un article
                        </a>
                    </li>

                </ul>
            </div>
            <div class="ms-auto text-light d-flex align-items-center">
                {{-- La directive @auth permet de tester si un utilisateur est connecté.   --}}
                @auth
                    {{ Auth::user()->name }}
                    <form action="{{ route('logout') }}" method="POST" class="ms-3">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-link text-light text-decoration-none p-0">
                            Se déconnecter
                        </button>
                    </form>
                @endauth
                {{-- @guest est une directive Blade qui rend son contenu seulement si l'utilisateur n'est pas authentifié.  --}}
                @guest
                    <a class="btn btn-link text-light text-decoration-none p-0" href="{{ route('login') }}">se connecter</a>
                @endguest
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @yield('contenu')
    </div>
</body>

</html>
