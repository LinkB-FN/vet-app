<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\AccountOwner;
use App\Models\FortniteAccount;
use App\Models\CoachingSession;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@fortnitecoaching.com'],
            [
                'name' => 'Administrador',
                'password' => 'password',
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // Create Coach Users (Staff)
        $coach1 = User::firstOrCreate(
            ['email' => 'coach1@fortnitecoaching.com'],
            [
                'name' => 'Coach ProBuilder',
                'password' => 'password',
                'role' => 'staff',
                'email_verified_at' => now(),
            ]
        );

        $coach2 = User::firstOrCreate(
            ['email' => 'coach2@fortnitecoaching.com'],
            [
                'name' => 'Coach EditMaster',
                'password' => 'password',
                'role' => 'staff',
                'email_verified_at' => now(),
            ]
        );

        // Create Client User
        $client = User::firstOrCreate(
            ['email' => 'client@fortnitecoaching.com'],
            [
                'name' => 'Player Noob',
                'password' => 'password',
                'role' => 'client',
                'email_verified_at' => now(),
            ]
        );

        // Create additional random coach users
        User::factory(3)->staff()->withoutTwoFactor()->create();

        // Create Account Owners with Fortnite Accounts and Coaching Sessions
        AccountOwner::factory(15)
            ->has(
                FortniteAccount::factory(2)
                    ->has(
                        CoachingSession::factory(3)
                            ->state(function (array $attributes) use ($coach1, $coach2) {
                                return [
                                    'coach_id' => fake()->randomElement([$coach1->id, $coach2->id]),
                                ];
                            })
                    )
            )
            ->create();

        $this->command->info('Database seeded successfully!');
        $this->command->info('===========================================');
        $this->command->info('🎮 Fortnite Coaching Platform');
        $this->command->info('===========================================');
        $this->command->info('Admin: admin@fortnitecoaching.com / password');
        $this->command->info('Coach 1: coach1@fortnitecoaching.com / password');
        $this->command->info('Coach 2: coach2@fortnitecoaching.com / password');
        $this->command->info('Client: client@fortnitecoaching.com / password');
        $this->command->info('===========================================');
    }
}
