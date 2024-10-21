<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function category()
    {
        return view('quiz.page.admin.category');
    }
    public function quizzes()
    {
        return view('quiz.page.admin.quiz');
    }
    public function quiz($slug,$id)
    {

        return view('quiz.page.admin.quiz',['categoryId' => $id,'slug'=>$slug]);
    }
    public function question ($slug,$quiz_id)
    {

        return view('quiz.page.admin.question',['quiz_id' => $quiz_id,'slug'=>$slug]);
    }
    public function answer()
    {
        return view('quiz.page.admin.answer');
    }
}
