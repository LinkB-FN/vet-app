<?php

namespace Database\Factories;

use App\Models\FortniteAccount;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CoachingSession>
 */
class CoachingSessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sessionTypes = [
            'Build Training',
            'Edit Course',
            'Box Fights',
            'Zone Wars',
            '1v1 Practice',
            'VOD Review',
            'Strategy Session',
            'Aim Training',
            'Game Sense',
            'Tournament Prep',
            'Creative Practice',
            'Piece Control',
        ];

        $sessionNotes = [
            'Focused on building speed and efficiency',
            'Reviewed recent tournament gameplay',
            'Practiced advanced editing techniques',
            'Worked on rotation strategies',
            'Improved box fight mechanics',
            'Analyzed mistakes from recent matches',
            'Practiced endgame scenarios',
            'Worked on piece control and retakes',
            'Improved aim and tracking skills',
            'Discussed meta strategies and loadouts',
        ];

        return [
            'fortnite_account_id' => FortniteAccount::factory(),
            'coach_id' => User::factory()->staff(),
            'session_date' => fake()->dateTimeBetween('now', '+3 months'),
            'session_type' => fake()->randomElement($sessionTypes),
            'status' => fake()->randomElement(['pending', 'confirmed', 'completed', 'cancelled']),
            'notes' => fake()->optional(0.6)->randomElement($sessionNotes),
        ];
    }

    /**
     * Indicate that the coaching session is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
        ]);
    }

    /**
     * Indicate that the coaching session is confirmed.
     */
    public function confirmed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'confirmed',
        ]);
    }

    /**
     * Indicate that the coaching session is completed.
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
        ]);
    }

    /**
     * Indicate that the coaching session is cancelled.
     */
    public function cancelled(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'cancelled',
        ]);
    }
}
