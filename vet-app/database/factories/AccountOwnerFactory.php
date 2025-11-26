<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AccountOwner>
 */
class AccountOwnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $regions = [
            'NA-East',
            'NA-West',
            'Europe',
            'Asia',
            'Oceania',
            'Brazil',
            'Middle East',
        ];

        return [
            'name' => fake()->name(),
            'discord_username' => fake()->userName() . '#' . fake()->numberBetween(1000, 9999),
            'email' => fake()->unique()->safeEmail(),
            'region' => fake()->randomElement($regions),
        ];
    }
}
