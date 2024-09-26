<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function homepage()
    {
        $categories=Category::where('status',1)->get();
        return view('quiz.page.homepage',compact('categories'));
    }

}
