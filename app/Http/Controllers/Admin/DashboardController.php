<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lang\Word;
use App\Models\Page;
use App\Traits\GetLangMessage;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\JoinClause;
use Exception;

final class DashboardController extends Controller
{
    public float $wordsPercent, $titlePercent;

    public function __construct()
    {
        $this->setWordsPercent();
        $this->setTitlePercent();
    }

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
                        ->where('images.ranking', '=', 1)
                        ->limit(1);
                })
                ->get(['pages.*', 'images.image']);

            $percent = (object) [
                'title' => $this->titlePercent,
                'words' => $this->wordsPercent,
            ];

            return view('auth.dashboard', compact('pages', 'percent'));
        } catch (Exception $e) {
            // dump($e);
            // todo errorlog
        }
    }

    /**
     * Set value for $wordsPercent.
     *
     * @var float $wordsPercent
     */
    public function setWordsPercent(): void
    {
        $percent = [];
        $words = Word::all();

        $total = $words->count() * 3;

        $col = $words->map(function ($word) {
            return collect($word->toArray())
                ->only(['de', 'en', 'ru'])
                ->whereNotNull()
                ->all();
        })->toArray();

        for ($i = 0; $i < count($col); $i++) {

            if (isset($col[$i]['de'])) $percent[] = $col[$i]['de'];

            if (isset($col[$i]['en'])) $percent[] = $col[$i]['en'];

            if (isset($col[$i]['ru'])) $percent[] = $col[$i]['ru'];
        }

        $this->wordsPercent = round(count($percent) * 100 / $total, 1);
    }

    /**
     * Set value for $titlePercent.
     *
     * @var float $titlePercent
     */
    public function setTitlePercent(): void
    {
        $percent = [];
        $pages = Page::all();

        $total = $pages->count() * 3;

        $col = $pages->map(function ($page) {
            return collect($page->toArray())
                ->only(['name', 'en_name', 'ru_name'])
                ->whereNotNull()
                ->all();
        })->toArray();

        for ($i = 0; $i < count($col); $i++) {

            if (isset($col[$i]['name'])) $percent[] = $col[$i]['name'];

            if (isset($col[$i]['en_name'])) $percent[] = $col[$i]['en_name'];

            if (isset($col[$i]['ru_name'])) $percent[] = $col[$i]['ru_name'];
        }

        $this->titlePercent = round(count($percent) * 100 / $total, 1);
    }
}
