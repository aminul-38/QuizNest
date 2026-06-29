<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Three more ways to assign enum columns 

        // 1. Plain PHP
        // 'role' => ['Learner', 'Creator'][array_rand(['Learner', 'Creator'])],

        // 2. Laravel Collection
        // 'role' => collect(['Learner', 'Creator'])->random(), 

        // 3. Scalable Approach (probability distribution)
        /*
        $roles = [
            'Learner' => 80,
            'Creator' => 15,
            'Admin' => 5,
                ];

        $role = collect($roles)
            ->flatMap(fn ($count, $role) => array_fill(0, $count, $role))
            ->random();
        */

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'role' => fake()->randomElement(['Learner', 'Learner', 'Creator']), // can use multiple same value for probability distribution
            'profile_img_path' => 'images/profile_pictures/default_profile_picture.png',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
