<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MataPelajaran;
use Illuminate\Support\Arr;
use DB;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MataPelajaran::create([
            'nama_mapel' => 'Bahasa Indonesia'
        ]);
        MataPelajaran::create([
            'nama_mapel' => 'IPA'
        ]);
        MataPelajaran::create([
            'nama_mapel' => 'IPS'
        ]);
        MataPelajaran::create([
            'nama_mapel' => 'Bahasa Jawa'
        ]);
        MataPelajaran::create([
            'nama_mapel' => 'Olahraga'
        ]);
        MataPelajaran::create([
            'nama_mapel' => 'Agama'
        ]);
        MataPelajaran::create([
            'nama_mapel' => 'BTQ'
        ]);
        MataPelajaran::create([
            'nama_mapel' => 'Matematika'
        ]);
        MataPelajaran::create([
            'nama_mapel' => 'Seni Budaya dan Keterampilan'
        ]);
    }
}
