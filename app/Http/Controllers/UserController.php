<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login()
    {
        return view('quiz.page.user.login');
    }
    public function Register()
    {
        return view('quiz.page.user.Register');
    }
    public function Forgot()
    {
        return view('quiz.page.user.forgot-password');
    }
}
