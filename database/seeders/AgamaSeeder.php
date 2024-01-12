<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Agama;
use Illuminate\Support\Arr;
use DB;

class AgamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Agama::create([
            'agama' => 'Islam'
        ]);
        Agama::create([
            'agama' => 'Kristen'
        ]);
        Agama::create([
            'agama' => 'Katholik'
        ]);
        Agama::create([
            'agama' => 'Hindu'
        ]);
        Agama::create([
            'agama' => 'Buddha'
        ]);
        Agama::create([
            'agama' => 'Konghucu'
        ]);
    }
}
