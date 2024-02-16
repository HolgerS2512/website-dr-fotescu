<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\GetBoolFromDB;
use Exception;

class TeamController extends Controller
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
            $src = DB::table('team_sliders')->orderBy('ranking')->get();
            $publish = DB::table('publishes')->get();
    
            return view('pages.team', [
                'src' => $src,
                'public' => GetBoolFromDB::getBool($publish, 'team.slider'),
            ]);
        } catch (Exception $e) {

            return view('errors.500', compact('e'));
        }

        return view('errors.500');
    }
}
