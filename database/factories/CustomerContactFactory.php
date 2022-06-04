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
            'nome_contact' => $this->faker->name(),
            'email_contact' => $this->faker->unique()->safeEmail(),
            'cpf' => $this->faker->unique()->cpf(false),
        ];
    }
}
