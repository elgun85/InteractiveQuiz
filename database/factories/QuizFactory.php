<?php

namespace Database\Factories;

use App\Models\Quiz;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $title= fake()->name();
        return [
            'category_id'   =>  rand(1,5),
            'title'         =>  $title,
            'slug'          =>  Str::slug($title),
            'level'         =>  rand(1,4),
            'description'   =>  $this->faker->text(200),
            'status'        =>  $this->faker->boolean,
        ];

    }


}
