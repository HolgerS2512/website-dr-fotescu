<?php

namespace App\Http\Controllers;

use App\Models\HomeSlider;
use Illuminate\Http\Request;
use App\Traits\GetLangMessage;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Load the application dashboard & data.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $src = HomeSlider::all();

        return view('auth.dashboard', compact('src'));
    }
}
