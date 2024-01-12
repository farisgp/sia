<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuruRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nip' => 'required|unique:guru|min:8',
            'nama_guru' => 'required|min:3',
            'jenis_kelamin' => 'required',
            'id_mapel' => 'required|integer',
            'id_kelas' => 'required|integer',
            'alamat' => 'required|max:255',
            'kontak' => 'nullable',
            'id_agama' => 'required|integer',
            'pendidikan' => 'required',
            'jabatan' => 'required',
        ];
    }
}
