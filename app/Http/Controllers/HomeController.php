<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\GetBoolFromDB;
use Exception;

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
        try {
            $src = DB::table('home_sliders')->orderBy('ranking')->get();
            $public = DB::table('publishes')->get();
    
            return view('pages.home', [
                'src' => $src,
                'public' => GetBoolFromDB::getBool($public, 'home.slider'),
            ]);
        } catch (Exception $e) {

            return view('errors.500', compact('e'));
        }

        return view('errors.500');
    }
}
