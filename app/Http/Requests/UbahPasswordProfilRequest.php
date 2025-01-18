<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UbahPasswordProfilRequest extends FormRequest
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
            'new_password'              => 'required|min:8|confirmed',
            'new_password_confirmation' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'new_password.required'              => 'Password baru wajib diisi.',
            'new_password.min'                   => 'Password baru harus memiliki minimal 8 karakter.',
            'new_password.confirmed'             => 'Konfirmasi password tidak sesuai.',
            'new_password_confirmation.required' => 'Konfirmasi password wajib diisi.',
        ];
    }
}
