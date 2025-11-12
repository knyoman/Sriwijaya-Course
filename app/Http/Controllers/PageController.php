<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function courses()
    {
        return view('pages.courses');
    }

    public function about()
    {
        return view('pages.about');
    }
}