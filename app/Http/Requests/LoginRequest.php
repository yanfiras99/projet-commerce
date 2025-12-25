<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class  RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        //  Nous évitons d'ajouter la règle 'exists:users,email' car cela permettrait à un utilisateur 
        // tentant de tester un autre compte de déterminer si l'email existe bel et bien dans la base de 
        // données. cela pourrait être exploité pour des attaques par force brute ou d'autres activités malveillantes.
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string']
        ];
    }

    protected function prepareForValidation(): void {}
}
