<?php

namespace App\Http\Controllers;

use App\Traits\GetLangMessage;
use Exception;
use Illuminate\Support\Facades\DB;

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
        try {
            $srcHome = DB::table('home_sliders')->orderBy('ranking')->get();
            $srcTeam = DB::table('team_sliders')->orderBy('ranking')->get();

            $i = 1;
            $homeSlideIds = []; 
            $teamSlideIds = []; 

            foreach ($srcHome as $slider) {
              $homeSlideIds[$slider->ranking] = $slider->id;
            }

            foreach ($srcTeam as $slider) {
              $teamSlideIds[$slider->ranking] = $slider->id;
            }

            return view('auth.dashboard', compact('i', 'homeSlideIds', 'teamSlideIds', 'srcHome', 'srcTeam'));
        } catch (Exception $e) {
            
            return view('auth.dashboard', compact('e'));
        }
        $err = GetLangMessage::languagePackage('en')->databaseError;

        return view('auth.dashboard', compact('err'));
    }
}
