<?php

namespace Database\Factories;

use App\Models\Quiz;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Result>
 */
class ResultFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $participantId = User::where('role', 'Learner')
            ->inRandomOrder()
            ->value('id');
        $quizId = Quiz::select('id')
            ->inRandomOrder()
            ->first();
        return [
            'participant_id' => $participantId,
            'quiz_id' => $quizId,
            'total_point' => 10,
            'gained_point' => fake()->numberBetween(0, 10),
            'wrong_answer' => 0,
        ];
    }
}
