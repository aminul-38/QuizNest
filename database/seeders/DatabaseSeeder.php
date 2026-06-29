<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Option;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
        ]);

        Quiz::factory()
            ->count(10)
            ->has(
                Question::factory()
                    ->count(10)
                    ->has(
                        Option::factory()
                            ->count(4)
                    )
            )->create()
            ->each(function ($quiz) {
                $quiz->questions->each(function ($question) {
                    $question->options()
                        ->inRandomOrder()
                        ->first()
                        ->update(['is_correct' => true]);
                });
            });
        $this->call([
            ResultSeeder::class,
        ]);
    }
}
