<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SchoolWork>
 */
class SchoolWorkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->sentence,
            'contenido' => $this->faker->text,
            'fecha_inicio' => now(),
            'fecha_fin' => $this->faker->dateTimeBetween('now', '+1 month'),
            'files' => $this->faker->boolean,
            'edit' => $this->faker->boolean,
        ];
    }
}
