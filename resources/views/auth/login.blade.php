@extends('base')
@section('titre', 'Page Login')

@section('contenu')
    <div class="row justify-content-center">
        <div class="col-12" style="max-width: 480px;">
            <div class="card shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <h2 class="text-center fw-bold mb-4">Login</h2>
                    @session('erreur')
                        <div class="alert alert-danger">
                            {{ session('erreur') }}
                        </div>
                    @endsession
                    <form action="" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email"
                                class="form-control @error('email') is-invalid @enderror" placeholder="you@example.com"
                                required />
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="votre mot de passe" required />
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                            Login
                        </button>

                        <p class="mt-3 text-center small mb-0">
                            Vous n'avez pas de compte?
                            <a href="{{ route('register') }}" class="link-primary">inscription</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
