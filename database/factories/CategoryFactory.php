<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{

    public function definition(): array
    {
        $title=$this->faker->sentence(rand(3,7));
        $status = rand(0, 1);
        return [

                        'title' => $title,
                        'slug' => Str::slug($title),
                        'status' => $status,
                        'description' => $this->faker->text(200),
        ];
    }
}
