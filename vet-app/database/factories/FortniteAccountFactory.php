<?php

namespace Database\Factories;

use App\Models\AccountOwner;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FortniteAccount>
 */
class FortniteAccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $platforms = ['PC', 'PlayStation', 'Xbox', 'Nintendo Switch', 'Mobile'];
        
        $ranks = [
            'Bronze I', 'Bronze II', 'Bronze III',
            'Silver I', 'Silver II', 'Silver III',
            'Gold I', 'Gold II', 'Gold III',
            'Platinum I', 'Platinum II', 'Platinum III',
            'Diamond I', 'Diamond II', 'Diamond III',
            'Elite', 'Champion', 'Unreal'
        ];

        $epicUsernames = [
            'TTV_' . fake()->userName(),
            'YT_' . fake()->userName(),
            fake()->userName() . '_FN',
            fake()->userName() . fake()->numberBetween(100, 999),
            'Pro' . fake()->userName(),
            fake()->userName() . 'Gaming',
        ];

        $notes = [
            'Wants to improve building speed',
            'Focus on edit course training',
            'Needs help with game sense and rotations',
            'Working on box fight mechanics',
            'Preparing for competitive tournaments',
            'Beginner looking to learn basics',
            'Advanced player seeking VOD reviews',
            'Wants to master piece control',
            'Improving aim and tracking',
            'Learning advanced tunneling techniques',
        ];

        return [
            'epic_username' => fake()->randomElement($epicUsernames),
            'platform' => fake()->randomElement($platforms),
            'rank' => fake()->randomElement($ranks),
            'account_created_date' => fake()->dateTimeBetween('-5 years', '-1 month'),
            'account_owner_id' => AccountOwner::factory(),
            'notes' => fake()->optional(0.7)->randomElement($notes),
        ];
    }
}
