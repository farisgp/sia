<?php

namespace Database\Factories;
use App\Models\Siswa;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siswa>
 */
class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Siswa::class;

    public function definition(): array
    {
        return [
            'nis',
            'nisn',
            'nama_siswa',
            'jenis_kelamin',
            'tanggal_lahir',
            'id_kelas',
            'tahun_ajaran',
            'status',
            'alamat',
            'kontak_ortu',
            'id_agama',
            
        ];
    }
}
