<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kursus;

class PageController extends Controller
{
    public function home()
    {
        $courses = Kursus::where('status', 'published')->get();
        return view('pages.home', compact('courses'));
    }

    public function courses()
    {
        $courses = Kursus::where('status', 'published')->get();
        return view('pages.courses', compact('courses'));
    }

    public function about()
    {
        return view('pages.about');
    }
}
