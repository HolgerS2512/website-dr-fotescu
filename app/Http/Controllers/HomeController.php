<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\GetBoolFromDb;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @var Illuminate\Support\Facades\DB $src
     * @var Illuminate\Support\Facades\DB $publish
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $src = DB::table('home_sliders')->orderBy('ranking')->get();
        $publish = DB::table('publishes')->get();

        return view('pages.home', [
            'src' => $src,
            'public' => GetBoolFromDb::getBool($publish, 'home.slider'),
        ]);
    }
}
