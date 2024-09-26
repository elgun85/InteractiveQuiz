<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function category()
    {
        return view('quiz.page.admin.category');
    }
    public function quiz()
    {
        return view('quiz.page.admin.quiz');
    }
    public function question ()
    {
        return view('quiz.page.admin.question ');
    }
    public function answer()
    {
        return view('quiz.page.admin.answer');
    }
}
