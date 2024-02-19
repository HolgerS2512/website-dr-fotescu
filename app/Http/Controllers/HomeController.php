<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\GetBoolFromDB;
use Exception;

class HomeController extends Controller
{
    /**
     * Saves the associated id for the respective controller.
     *
     * @var int $pageId
     */
    public int $pageId = 1;

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
            $src = DB::table('images')->where('page_id', '=', $this->pageId)->orderBy('ranking')->get();
            $public = DB::table('publishes')->get();

            return view('pages.home', [
                'src' => $src,
                'public' => GetBoolFromDB::getBool($public, 'home.slider'),
            ]);
        } catch (Exception $e) {

            return view('errors.500');
        }

        return view('errors.500');
    }
}
