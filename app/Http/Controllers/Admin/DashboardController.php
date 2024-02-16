<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use App\Traits\GetLangMessage;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $homeHead = DB::table('home_sliders')->orderBy('ranking')->first();
            $teamHead = DB::table('team_sliders')->orderBy('ranking')->first();

            $data = [
                (object) [
                    'title' => 'Home',
                    'image' => $homeHead->image,
                    'route' => 'home',
                ],
                (object) [
                    'title' => 'Team',
                    'image' => $teamHead->image,
                    'route' => 'team',
                ],
            ];

            return view('auth.dashboard', compact('data'));
        } catch (Exception $e) {

            return view('auth.dashboard', compact('e'));
        }
        $err = GetLangMessage::languagePackage('en')->databaseError;

        return view('auth.dashboard', compact('err'));
    }
}
