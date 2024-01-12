<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use App\Models\Kelas;
// use App\Models\Guru;
use Illuminate\Support\Arr;
use App\Models\Kelas;
use DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=1;$i<=6;$i++){
            Kelas::create(
            [
            'tingkat_kelas' => ('Kelas '. $i),
            'created_at' => now(),
            'updated_at' => now(),
            ]);
            }
            
        // $guruIds = Guru::pluck('id')->toArray();

        // DB::statement('SET FOREIGN_KEY_CHECKS=0');
        // Kelas::truncate();
        // DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // $kelasData = [];
        // for ($i = 1; $i <= 6; $i++) {
        //     $idGuru = $guruIds[$i - 1] ?? null;
        //     $kelasData[] = [
        //         'id' => $i,
        //         'tingkat_kelas' => $i,
        //         'id_guru' => $idGuru,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ];
        // }

        // Kelas::insert($kelasData);
    }
}
