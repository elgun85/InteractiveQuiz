<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Question::factory(5)->create();

/*        Question::create(
            [
                'quiz_id' => 6, // Default to 6 if no quiz is found
                'question' => 'Bu nümunə sualdır?',
                'answerA' => 'Answer A',
                'answerB' => 'Answer B',
                'answerC' => 'Answer C',
                'answerD' => 'Answer D',
                'correct_answer' => 'answerD',
                'level' => 'easy',
                'class' => 1,
                'status' => true,
            ]
        );*/

    }
}
