<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quiz>
 */
class QuizFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categoryId = Category::select('id')
            ->inRandomOrder()
            ->first();
        $creatorId = User::where('role', 'Creator')
            ->inRandomOrder()
            ->value('id');

        return [
            'creator_id' => $creatorId,
            'title' => fake()->sentence(),
            'number_of_question' => 10,
            'category_id' => $categoryId,
            'subject' => fake()->words(1, true),
        ];
    }
}
