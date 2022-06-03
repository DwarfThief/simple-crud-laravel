<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=CustomerContact>
 */
class CustomerContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nome_contato' => $this->faker->name(),
            'email_contato' => $this->faker->unique()->safeEmail(),
            'cpf' => $this->faker->unique()->cpf(false),
        ];
    }
}
