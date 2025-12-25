<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class FormArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'designation' => ['required', 'max:100'],

            'reference' => [
                'required',
                'regex:/^[A-Za-z]{3}-\d{4}-[A-Za-z]{3}$/',
                Rule::unique('articles')->ignore($this->article),
            ],

            'description' => ['nullable', 'max:1000'],
            'prix' => ['required', 'numeric', 'min:0'],
            'qte_stock' => ['required', 'integer', 'min:0'],
            'slug' => ['required'],
            'categorie_id' => ['required', 'exists:categories,id'],

            // ✅ CORRECTION ICI
            'pack_ids' => ['array'],
            'pack_ids.*' => ['exists:packs,id'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->input('designation')),
        ]);
    }
}
