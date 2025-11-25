<?php

namespace Database\Factories;

use App\Models\Owner;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $species = fake()->randomElement(['Perro', 'Gato', 'Conejo', 'Hamster', 'Ave']);
        
        $breeds = [
            'Perro' => ['Labrador', 'Pastor Alemán', 'Bulldog', 'Beagle', 'Chihuahua', 'Golden Retriever'],
            'Gato' => ['Persa', 'Siamés', 'Maine Coon', 'Bengalí', 'Ragdoll', 'Británico'],
            'Conejo' => ['Holandés', 'Angora', 'Rex', 'Belier'],
            'Hamster' => ['Sirio', 'Ruso', 'Roborovski'],
            'Ave' => ['Canario', 'Periquito', 'Loro', 'Cacatúa'],
        ];

        return [
            'name' => fake()->firstName(),
            'species' => $species,
            'breed' => fake()->randomElement($breeds[$species]),
            'birth_date' => fake()->dateTimeBetween('-10 years', '-1 month'),
            'owner_id' => Owner::factory(),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
