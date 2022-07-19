<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pecas>
 */
class PecasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    public function definition()
    {
        
        return [
            'nome' => $this->faker->name(),
            'descricao' => $this->faker->name(),
            'quantidade' => $this->faker->name(),
            'valor' => $this->faker->name(),
        ];
    }
}

