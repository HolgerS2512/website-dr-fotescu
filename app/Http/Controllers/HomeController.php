<?php

namespace App\Http\Controllers;

use App\Models\HomeSlider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $src = HomeSlider::all();

        return view('pages.home', compact('src'));
    }
}
