<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    public function getFormRegister()
    {
        return view('auth.register');
    }

    public function registerUser(RegisterRequest $request)
    {
        $reqValidate = $request->validated();
        $reqValidate['password'] = Hash::make($reqValidate['password']);

        $user = User::create($reqValidate);

        Auth::login($user);

        return redirect()->route('profile')
            ->with('success', 'Inscription réussie ! Bienvenue');
    }
}
