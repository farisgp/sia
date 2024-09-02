<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NilaiSelector extends FormRequest
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
            'id_kelas' => 'required|exists:kelas,id',
            'id_mapel' => 'required|exists:mata_pelajaran,id',
        ];
    }
    public function attributes()
    {
        return  [
            'id_kelas' => 'Kelas',
            'id_mapel' => 'Mata Pelajaran',
        ];
    }
}
