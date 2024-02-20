<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\GetLangMessage;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\JoinClause;
use Exception;

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
            $pages = DB::table('pages')
                ->leftJoin('images', function (JoinClause $join) {
                    $join->on('pages.id', '=', 'images.page_id')
                        ->where('images.ranking', '=', 1);
                })
                ->get(['pages.*', 'images.image']);

            return view('auth.dashboard', compact('pages'));
        } catch (Exception $e) {
            // $e
        } finally {
            return view('auth.dashboard', compact('pages'));
        }
        $err = GetLangMessage::languagePackage('en')->databaseError;

        return view('auth.dashboard', compact('err'));
    }
}
