<?php

namespace Database\Factories;
use Faker\Generator as Faker;
use App\Models\Guru;
use App\Models\Kelas;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guru>
 */
class KelasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Kelas::class;

    public function definition()
    {
        $idGuru = $this->faker->randomElement([null, Guru::pluck('id')->random()]);
        return [
            'tingkat_kelas' => $this->faker->numberBetween(0, 12),
            'id_guru' => idGuru, 
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
    
}
