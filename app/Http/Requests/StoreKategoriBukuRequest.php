<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKategoriBukuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_buku'     => 'required',
            'id_kategori' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'id_buku.required'     => 'Judul Buku wajib diisi.',
            'id_kategori.required' => 'Kategori wajib diisi.',
        ];
    }
}
