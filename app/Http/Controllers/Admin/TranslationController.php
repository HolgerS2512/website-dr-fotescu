<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HandleHttp\GetPageUrlVars;
use App\Models\Content;
use App\Models\Lang\DE_Content;
use App\Models\Lang\DE_List;
use App\Models\Lang\EN_Content;
use App\Models\Lang\EN_List;
use App\Models\Lang\RU_Content;
use App\Models\Lang\RU_List;
use App\Models\Lang\Word;
use Exception;
use Illuminate\Http\Request;
use App\Traits\GetLangMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Models\Page;
use App\Models\Subpage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

final class TranslationController extends Controller
{
    /**
     * Stores a specific model resource.
     *
     * @param  \Illuminate\Http\Request  $name
     * @var     \Illuminate\Database\Eloquent\Model
     */
    private Model $model, $en, $ru, $sub;

    /**
     * Contains the request variables with validation rules.
     *
     * @param  \Illuminate\Http\Request
     * @var array
     */
    private array $validateRules;

    /**
     * Contains the request variables for the respective language.
     *
     * @param  \Illuminate\Http\Request
     * @var array
     */
    private array $persistValues;

    public function __construct()
    {
        $this->sub = new Subpage;
    }

    /**
     * Set the variable $model.
     *
     * @param  \Illuminate\Http\Request  $name
     * @var    \Illuminate\Database\Eloquent\Model
     * @return void
     */
    public function setModel($name)
    {
        switch ($name) {
            case 'Words':
                $this->model = new Word;
                break;
            case 'Title':
                $this->model = new Page;
                break;
            case 'Content':
                $this->model = new DE_Content;
                $this->en = new EN_Content;
                $this->ru = new RU_Content;
                break;
            case 'List':
                $this->model = new DE_List;
                $this->en = new EN_List;
                $this->ru = new RU_List;
                break;
            default:
                break;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($name)
    {
        try {
            $name = ucfirst(strtolower($name));
            $this->setModel($name);

            if ($this->model instanceof Page || $this->model instanceof Word) {

                return view('admin.translation.index', [
                    'name' => $name,
                    'editable' => $this->model::all(),
                    'editable_2' => $this->sub::all(),
                ]);
            } else {
                
                return view('admin.translation.lang', [
                    'name' => $name,
                    'langs' => GetPageUrlVars::getAllLangs(),
                    'contents' => Content::whereNot('format', 'buttons')->get(),
                    'deEdit' => $this->model::all(),
                    'enEdit' => $this->en::all(),
                    'ruEdit' => $this->ru::all(),
                ]);
            }
        } catch (Exception $e) {
            return redirect()->back()->with([
                'present' => true,
                'status' => false,
                'message' => GetLangMessage::languagePackage('en')->databaseError,
            ]);
        }
        return redirect()->back()->with([
            'present' => true,
            'status' => false,
            'message' => GetLangMessage::languagePackage('en')->databaseError,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\Request  $name
     * @param  \Illuminate\Http\Request  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $name, $model, $id)
    {
        try {
            $name = ucfirst(strtolower($name));
            $this->setModel($name);

            $credentials = Validator::make($request->all(), [
                'de' => 'required|min:3|max:255',
                'en' => 'required|min:3|max:255',
                'ru' => 'required|min:3|max:255',
            ]);

            if ($credentials->fails()) {
                return redirect()->back()
                    ->withErrors($credentials->errors())
                    ->withInput();
            }

            dd($request->all());

            $model = ucfirst($model);

            if ($name === 'Words') {
                $model = "Lang\\$model";
            }

            $obj = ("\App\Models\\$model")::find($id);
            $obj->update([
                'de' => $request->de,
                'en' => $request->en,
                'ru' => $request->ru,
                'updated_at' => Carbon::now(),
            ]);

            return response()->json([
                'present' => true,
                'status' => true,
                'message' => GetLangMessage::languagePackage('en')->updateTrue,
            ]);

        } catch (Exception $e) {
            return response()->json([
                'present' => true,
                'status' => false,
                'message' => GetLangMessage::languagePackage('en')->updateFalse,
            ]);
        }

        return response()->json([
            'present' => true,
            'status' => false,
            'message' => GetLangMessage::languagePackage('en')->updateFalse,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\Request  $name
     * @param  \Illuminate\Http\Request  $deId
     * @param  \Illuminate\Http\Request  $enId
     * @param  \Illuminate\Http\Request  $ruId
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $name, $deId, $enId = false, $ruId = false)
    {
        try {
            $name = ucfirst(strtolower($name));
            $this->setModel($name);
            $this->setStoreValues($request->all());

            $credentials = Validator::make($request->all(), $this->validateRules);

            if ($credentials->fails()) {
                return redirect()->back()
                    ->withErrors($credentials->errors())
                    ->withInput();
            }

            if ($deId) {
                $this->model::whereId($deId)
                    ->update($this->filtedLang('de', $name, $this->persistValues, 'updated_at'));
            } else {
                return response()->json([
                    'present' => true,
                    'status' => false,
                    'message' => GetLangMessage::languagePackage('en')->updateFalse,
                ]);
            }

            if (boolval($enId)) {
                $this->en::whereId($enId)
                ->update($this->filtedLang('en', $name, $this->persistValues, 'updated_at'));
            } else {
                $en = new ($this->en)($this->filtedLang('en', $name, $this->persistValues, 'created_at'));
                $en->save();
            }

            if (boolval($ruId)) {
                $this->ru::whereId($ruId)
                ->update($this->filtedLang('ru', $name, $this->persistValues, 'updated_at'));
            } else {
                $ru = new ($this->ru)($this->filtedLang('ru', $name, $this->persistValues, 'created_at'));
                $ru->save();
            }

            return response()->json([
                'present' => true,
                'status' => true,
                'message' => GetLangMessage::languagePackage('en')->updateTrue,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'present' => true,
                'status' => false,
                'message' => GetLangMessage::languagePackage('en')->updateFalse,
            ]);
        }

        return response()->json([
            'present' => true,
            'status' => false,
            'message' => GetLangMessage::languagePackage('en')->updateFalse,
        ]);
    }

    /**
     * Filters the request and sets the variable values for validation and persistence.
     *
     * @param array $requVal
     * @return void
     */
    public function setStoreValues($requVal)
    {
        $rule = [
            true => '|max:255',
            false => '',
        ];

        $this->persistValues = array_filter($requVal, function ($v) {
            return ! ($v === '_method' || $v === '_token');
        }, ARRAY_FILTER_USE_KEY);

        $values = array_filter(array_flip($this->persistValues), function ($v) {
            return ! ($v === 'content_id' || $v === 'ranking');
        });

        foreach ($values as $val) {
            $this->validateRules[$val] = "required|min:3{$rule[str_contains($val, 'title')]}";
        }

        $this->validateRules['content_id'] = 'required|integer';
        $this->validateRules['ranking'] = 'required|integer';

    }

    /**
     * Filters an array by language and the composed keys.
     *
     * @param string $lang
     * @param string $name
     * @param array $values
     * @param string $now
     * @return array
     */
    public function filtedLang(string $lang, string $name, array $values, string $now): array
    {
        $result = [
            "$now" => Carbon::now(),
        ];

        foreach ( $values as $key => $value ) {
            if ( str_contains($key, "_{$lang}_") ) {
                $k = preg_replace("/{$name}_{$lang}_/", '', $key);
                $result[$k] = $value;
            }

            if ( ! ( str_contains($key, 'List') || str_contains($key, 'Content') ) ) {
                $result[$key] = $value;
            }
        }

        return $result;
    }
}
