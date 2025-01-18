<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBukuRequest extends FormRequest
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
            'judul_buku'       => 'required',
            'penulis_buku'     => 'required',
            'penerbit_buku'    => 'required',
            'tahunterbit_buku' => 'required',
            'sinopsis_buku'    => 'required',
            'sampul_buku'      => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'judul_buku.required'         => 'Judul Buku wajib diisi.',
            'penulis_buku.required'       => 'Penulis Buku wajib diisi.',
            'penerbit_buku.required'      => 'Penerbit Buku wajib diisi.',
            'tahunterbit_buku.required'   => 'Tahun Terbit wajib diisi.',
            'sinopsis_buku.required'      => 'Sinopsis Buku wajib diisi.',
            'sampul_buku.required'        => 'Sampul Buku wajib diisi.',
        ];
    }
}
