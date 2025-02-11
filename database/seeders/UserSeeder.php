<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'admin',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'nama' => 'andi',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'nama' => 'budi',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'nama' => 'hubner',
            'password' => bcrypt('12345678'),
        ]);
    }
}
