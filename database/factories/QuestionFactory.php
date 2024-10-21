<?php

namespace Database\Factories;

use App\Models\Quiz;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $quiz = Quiz::inRandomOrder()->first();


        return [
           'quiz_id' => $quiz ? $quiz->id : 1, // Default to 1 if no quiz is found
            'question' => $this->faker->sentence(),
            'optionA' => $this->faker->text(15),
            'optionB' => $this->faker->text(15),
            'optionC' => $this->faker->text(15),
            'optionD' => $this->faker->text(15),
            'correct_answer' => $this->faker->randomElement(['optionA', 'optionB', 'optionC', 'optionD']),
            'class' => $this->faker->numberBetween(1, 5),
            'level' => $this->faker->randomElement(['easy', 'medium', 'hard']),
            'status' => $this->faker->boolean,
        ];
    }
}
