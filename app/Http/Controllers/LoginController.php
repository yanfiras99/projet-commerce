<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\RegisterRequest;

class LoginController extends Controller
{
    public function getFormLogin()
    {
        return view('auth.login');
    }

    public function loginUser(Request $request)
    {
        // recupérer les données du formulaire
        $identifiants = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        // tenter de connecter l'utilisateur
        // la methode attempt() va vérifier les identifiants fournis
        if (Auth::attempt($identifiants)) {
            $request->session()->regenerate();
            // intended redirige vers l'url précédemment demandée avant la connexion
            return redirect()->intended(route('shop.index'))
                ->with('success', 'Connexion réussie ! Bienvenue');
        }
        return back()->with('error', 'Les identifiants fournis sont incorrects.');
    }

    public function logout(Request $request)
    {
        // la méthode logout() déconnecte l'utilisateur actuel
        Auth::logout();
        // Invalider la session pour des raisons de sécurité
        $request->session()->invalidate();
        // Générer un nouveau token CSRF pour prévenir les attaques de type CSRF
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
