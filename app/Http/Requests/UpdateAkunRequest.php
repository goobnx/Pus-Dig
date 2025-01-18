<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAkunRequest extends FormRequest
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
        $idUser = $this->route('akun');

        return [
            'username' => 'required',
            'email'    => 'required|email|unique:users,email,' . $idUser . ',id_user',
            'alamat'   => 'required',
            'role'     => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'Username wajib diisi.',
            'email.required'    => 'Email wajib diisi.',
            'email.unique'      => 'Email ini sudah digunakan, silakan pilih email lain.',
            'alamat.required'   => 'Alamat wajib diisi.',
            'role.required'     => 'Role wajib diisi.',
        ];
    }
}
