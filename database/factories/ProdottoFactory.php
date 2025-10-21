<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prodotto>
 */
class ProdottoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       return [
            'nome' => fake()->name(),
            'descrizione' => fake()->paragraph(),
            'prezzo' => fake()->unique()->randomDigit(),
            'disponibilità' => fake()->randomElement([true, false]),
            'category_id' => Categoria::factory()
        ];
    }
}
