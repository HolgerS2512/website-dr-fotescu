<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HandleHttp\GetPageUrlVars;
use App\Models\Lang\DE_Content;
use App\Models\Lang\DE_List;
use App\Models\Lang\EN_Content;
use App\Models\Lang\EN_List;
use App\Models\Lang\RU_Content;
use App\Models\Lang\RU_List;
use App\Models\Lang\Word;
use App\Models\Page;
use App\Models\Subpage;
use App\Traits\GetLangMessage;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\JoinClause;
use Exception;
use PhpParser\ErrorHandler\Collecting;

/**
 * Contains this methods and variables.
 * 
 * @var float $wordsPercent
 * @var float $titlePercent
 * @method construct
 * @method index
 * @method setWordsPercent: void
 * @method setTitlePercent: void
 * 
 */
final class DashboardController extends Controller
{
    /**
     * Stores the percentage values.
     *
     * @var array<float> $percentage
     */
    public array $percentage;

    /**
     * Calls the methods and set value for this object vars.
     * 
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        try {
            $title = ($this->getPercent(Page::all()) + $this->getPercent(Subpage::all())) / 2;

            $words = $this->getPercent(Word::all());


            $conVal = [
                'base' => DE_Content::all(),
                'options' => [
                    EN_Content::all(),
                    RU_Content::all(),
                ],
            ];
            $content = $this->getPercentByItem($conVal);

            $listVal = [
                'base' => DE_List::all(),
                'options' => [
                    EN_List::all(),
                    RU_List::all(),
                ],
            ];
            $list = $this->getPercentByItem($listVal);

            $this->percentage = compact('title', 'words', 'content', 'list');
        } catch (\Throwable $th) {
            //
        }
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
                        ->where('slide', true)
                        ->where('subpage_id', null)
                        ->limit(1);
                })
                ->get(['pages.*', 'images.src']);

            $subpages = DB::table('subpages')
                ->leftJoin('images', function (JoinClause $join) {
                    $join->on('subpages.id', '=', 'images.subpage_id')
                        ->where('images.ranking', '=', 1)
                        ->where('slide', true)
                        ->limit(1);
                })
                ->get(['subpages.*', 'images.src']);

            $percent = (object) $this->percentage;

            return view('auth.dashboard', compact('pages', 'subpages', 'percent'));
        } catch (Exception $e) {
            // dump($e);
            // todo errorlog
        }
    }

    /**
     * Get the percent for different languages.
     *
     * @param Model $model
     * @return float
     */
    public function getPercent($models): float
    {
        $percent = [];
        $total = $models->count() * count(GetPageUrlVars::hasLanguages()['options']);

        foreach ($models as $val) {
            foreach (GetPageUrlVars::hasLanguages()['options'] as $lang) {
                $percent[] = $val->{$lang};
            }
        }

        return round(count(array_filter($percent)) * 100 / $total, 1);
    }

    /**
     * Get the percent for different languages from any tables.
     *
     * @param Model $model
     * @return float
     */
    public function getPercentByItem(array $collectArr): float
    {
        $percent = [];

        foreach ($collectArr['base'] as $model) {
            if ( isset($model->title) && ! empty($model->title) ) $percent [] = $model->title;
            if ( isset($model->content) && ! empty($model->content) ) $percent [] = $model->content;
            if ( isset($model->item_1) && ! empty($model->item_1) ) {
                for ($i = 1; $i <= 20; $i++) {
                    if ( isset($model->{'item_' . $i}) && ! empty($model->{'item_' . $i}) ) {
                        $percent [] = $model->{'item_' . $i};
                    }
                }
            }
        }

        $total = count($percent) * count(GetPageUrlVars::hasLanguages()['options']);
        $percent = [];

        foreach ($collectArr['options'] as $models) {
            foreach ($models as $model) {
                if ( isset($model->title) && ! empty($model->title) ) $percent [] = $model->title;
                if ( isset($model->content) && ! empty($model->content) ) $percent [] = $model->content;
                if ( isset($model->item_1) && ! empty($model->item_1) ) {
                    for ($i = 1; $i <= 20; $i++) {
                        if ( isset($model->{'item_' . $i}) && ! empty($model->{'item_' . $i}) ) {
                            $percent [] = $model->{'item_' . $i};
                        }
                    }
                }
            }
        }

        return round(count($percent) * 100 / $total, 1);
    }
}
