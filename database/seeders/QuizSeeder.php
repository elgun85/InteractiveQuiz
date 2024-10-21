<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Quiz::factory(5)->create();

        $title = 'Riyaziyyat';
        Quiz::create([
            'category_id'   =>  rand(1,5),
            'title'         =>  $title,
            'slug'          =>  Str::slug($title),
            'level'         =>  rand(1,4),
            'description'   =>  'Riyaziyyat Elmllərin şahıdır',
            'status'        =>  1,
        ]);
    }
}
