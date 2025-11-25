<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Owner;
use App\Models\Pet;
use App\Models\Appointment;
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
            ['email' => 'admin@veterinaria.com'],
            [
                'name' => 'Administrador',
                'password' => 'password',
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // Create Staff Users
        $staff1 = User::firstOrCreate(
            ['email' => 'staff1@veterinaria.com'],
            [
                'name' => 'Dr. Juan Pérez',
                'password' => 'password',
                'role' => 'staff',
                'email_verified_at' => now(),
            ]
        );

        $staff2 = User::firstOrCreate(
            ['email' => 'staff2@veterinaria.com'],
            [
                'name' => 'Dra. María García',
                'password' => 'password',
                'role' => 'staff',
                'email_verified_at' => now(),
            ]
        );

        // Create Client User
        $client = User::firstOrCreate(
            ['email' => 'client@veterinaria.com'],
            [
                'name' => 'Carlos Rodríguez',
                'password' => 'password',
                'role' => 'client',
                'email_verified_at' => now(),
            ]
        );

        // Create additional random users
        User::factory(5)->client()->withoutTwoFactor()->create();

        // Create Owners with Pets and Appointments
        Owner::factory(10)
            ->has(
                Pet::factory(2)
                    ->has(
                        Appointment::factory(3)
                            ->state(function (array $attributes) use ($staff1, $staff2) {
                                return [
                                    'user_id' => fake()->randomElement([$staff1->id, $staff2->id]),
                                ];
                            })
                    )
            )
            ->create();

        $this->command->info('Database seeded successfully!');
        $this->command->info('Admin: admin@veterinaria.com / password');
        $this->command->info('Staff: staff1@veterinaria.com / password');
        $this->command->info('Staff: staff2@veterinaria.com / password');
        $this->command->info('Client: client@veterinaria.com / password');
    }
}
