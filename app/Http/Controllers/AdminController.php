<?php

namespace App\Http\Controllers;

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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('auth.dashboard');

        // , [
        //     'status' => true,
        //     'message' => GetLangMessage::languagePackage('en')->loginTrue,
        // ]
    }
}
