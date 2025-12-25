@extends('base')

@section('titre', 'Inscription')
@section('contenu')


    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <h2 class="text-center fw-bold mb-4">Créer un compte</h2>

                    <form action="{{ route('register') }}" method="POST">
                        @csrf

                        <!-- Name Field -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom</label>
                            <input type="text" id="name" name="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                required />
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email"
                                class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                required />
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" id="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" required />
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmer mot de passe</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control" required />

                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold mb-3">
                            s'inscrire
                        </button>

                        <p class="text-center small mb-0">
                            Vous avez déjà un compte ?
                            <a href="{{ route('login') }}" class="link-primary">se connecter</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
