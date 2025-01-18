<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileUserRequest extends FormRequest
{
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
            'username' => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . Auth::user()->id_user . ',id_user',
            'alamat'   => 'required',
            'photo'    => 'nullable|image|max:1048',
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'Username wajib diisi.',
            'username.max'      => 'Username tidak boleh melebihi 255 karakter.',

            'email.required'    => 'Email wajib diisi.',
            'email.unique'      => 'Email ini sudah digunakan, silakan pilih email lain.',

            'alamat.required'   => 'Nomor Telepon wajib diisi.',

            'photo.max'         => 'Maksimal ukuran foto 1MB.',
        ];
    }
}
