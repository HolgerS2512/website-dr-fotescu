<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HandleHttp\GetPageUrlVars;
use App\Models\Content;
use App\Models\Helpers\ImageConverter;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Models\Image;
use App\Models\Lang\DE_Content;
use App\Models\Lang\EN_Content;
use App\Models\Lang\RU_Content;
use App\Models\Post;
use App\Traits\GetLangMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = (object) ['id' => null];

        try {
            $credentials = Validator::make($request->all(), [
                'de' => 'required|min:3|max:255',
                'en' => 'required|min:3|max:255',
                'ru' => 'required|min:3|max:255',
                'image' => 'mimes:jpg,png,webp,jpeg',
            ]);

            if ($credentials->fails()) {
                return redirect()->back()
                    ->withErrors($credentials->errors())
                    ->withInput();
            }

            if ($request->image) {
                $ic = new ImageConverter($request->image, 'uploads/images/posts/');
                $ic->move();

                $image = Image::create([
                    'page_id' => 3,
                    'src' => $ic->saveUrl,
                    'ext' => $ic->extension,
                    'created_at' => Carbon::now(),
                ]);
                $image->save();
            }

            $content = Content::create([
                'page_id' => 3,
                'format' => 'post',
            ]);
            $content->save();

            $post = Post::create([
                'user_id' => Auth::user()->id,
                'content_id' => $content->id,
                'image_id' => $image->id,
                'ranking' => Post::all()->count() + 1,
                'de' => $request->de,
                'en' => $request->en,
                'ru' => $request->ru,
            ]);
            $post->save();

            $content->update([
                'url_link' => $post->getUrl(),
                'created_at' => Carbon::now(),
            ]);

            return redirect("administration/post/edit/$post->id")->with([
                'present' => true,
                'status' => true,
                'message' => GetLangMessage::languagePackage('en')->createPostTrue,
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with([
                'present' => true,
                'status' => false,
                'message' => GetLangMessage::languagePackage('en')->createPostFalse,
            ]);
        }

        return redirect()->back()->with([
            'present' => true,
            'status' => false,
            'message' => GetLangMessage::languagePackage('en')->createPostFalse,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $currPost = Post::find($id);

            return view('admin.post.edit', [
                'post' => $currPost,
                'deContent' => $currPost->content()->de()->get(),
                'enContent' => $currPost->content()->en()->get(),
                'ruContent' => $currPost->content()->ru()->get(),
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with([
                'present' => true,
                'status' => false,
                'message' => GetLangMessage::languagePackage('en')->updateFalse,
            ]);
        }

        return redirect()->back()->with([
            'present' => true,
            'status' => false,
            'message' => GetLangMessage::languagePackage('en')->updateFalse,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $postId, $conId)
    {
        try {
            $this->setStoreValues($request->all());
            $credentials = Validator::make($request->all(), $this->validateRules);

            if ($credentials->fails()) {
                return redirect()->back()
                    ->withErrors($credentials->errors())
                    ->withInput();
            }

            if ($request->ranking !== $request->new_ranking) {
                $i = 1;
                foreach (Post::whereNot('id', $postId)->orderBy('ranking')->get() as $pModel) {
                    if ($i === (int) $request->new_ranking) ++$i;
                    $pModel->update(['ranking' => $i]);
                    ++$i;
                }
            }

            $post = Post::find($postId);
            $post->update([
                'ranking' => $request->new_ranking,
                'de' => $request->de,
                'en' => $request->en,
                'ru' => $request->ru,
            ]);

            $conTable = Content::find($conId);
            $conTable->update([
                'url_link' => $post->getUrl(),
            ]);

            if ($request->image) {
                $ic = new ImageConverter($request->image, 'uploads/images/posts/');
                $ic->move();

                if ($request->old_image && File::exists($request->old_image)) {
                    File::delete($request->old_image);
                }

                $img = Image::updateOrCreate([
                    'id' => $post->image_id ?? null,
                ], [
                    'page_id' => 3,
                    'src' => $ic->saveUrl,
                    'ext' => $ic->extension,
                ]);

                if ($img->id) {
                    $post->update(['image_id' => $img->id]);
                }
            }

            foreach (GetPageUrlVars::getAllLangs() as $lang) {
                foreach ($this->filtedLang($lang, $this->persistValues) as $values) {
                    if (array_key_exists('id', $values)) {
                        ('\App\Models\Lang\\' . strtoupper($lang) . '_Content')::whereId(array_slice($values, 0, 1)['id'])
                            ->update(array_slice($values, 1));
                    } else {
                        $values['content_id'] = $conId;
                        $deCon = ('\App\Models\Lang\\' . strtoupper($lang) . '_Content')::create($values);
                        $deCon->save();
                    }
                }
            }

            return redirect()->back()->with([
                'present' => true,
                'status' => true,
                'message' => GetLangMessage::languagePackage('en')->updateTrue,
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with([
                'present' => true,
                'status' => false,
                'message' => GetLangMessage::languagePackage('en')->updateFalse,
            ]);
        }

        return redirect()->back()->with([
            'present' => true,
            'status' => false,
            'message' => GetLangMessage::languagePackage('en')->updateFalse,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function visible(Request $request, $id)
    {
        try {
            $credentials = Validator::make($request->all(), [
                'public' => 'required|boolean',
            ]);

            if ($credentials->fails()) {
                return redirect()->back()
                    ->withErrors($credentials->errors())
                    ->withInput();
            }

            Post::whereId($id)->update(['public' => $request->public]);

            return redirect()->back()->with([
                'present' => true,
                'status' => true,
                'message' => GetLangMessage::languagePackage('en')->updateTrue,
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with([
                'present' => true,
                'status' => false,
                'message' => GetLangMessage::languagePackage('en')->updateFalse,
            ]);
        }

        return redirect()->back()->with([
            'present' => true,
            'status' => false,
            'message' => GetLangMessage::languagePackage('en')->updateFalse,
        ]);
    }

    /**
     * Remove the specified content resource from storage.
     *
     * @param  int  $deId, $enId, $ruId
     * @return \Illuminate\Http\Response
     */
    public function deleteContent($deId, $enId, $ruId)
    {
        try {
            foreach (GetPageUrlVars::getAllLangs() as $lang) {
                $id = ${$lang . 'Id'};
                if ($id) {
                    $model = ('\App\Models\Lang\\' . strtoupper($lang) . '_Content')::find($id);
                    if ($model) $model->delete();
                }
            }

            return response()->json([
                'present' => true,
                'status' => true,
                'message' => GetLangMessage::languagePackage('en')->deleteConTrue,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'present' => true,
                'status' => false,
                'message' => GetLangMessage::languagePackage('en')->deleteConFalse,
            ]);
        }

        return response()->json([
            'present' => true,
            'status' => false,
            'message' => GetLangMessage::languagePackage('en')->deleteConFalse,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($postId, $conId)
    {
        try {
            $content = Content::find($conId);
            $content->delete();

            foreach (GetPageUrlVars::getAllLangs() as $lang) {
                $model = ('\App\Models\Lang\\' . strtoupper($lang) . '_Content')::all()->where('content_id', $conId);
                foreach ($model as $item) {
                    $item->delete();
                }
            }

            $post = Post::find($postId);
            $img = Image::find($post->image_id);
            if ($img) $img->delete();
            $post->delete();

            $posts = Post::whereNot('id', $postId)->orderBy('ranking')->get();
            for ($i = 1; $i <= $posts->count(); $i++) {
                $posts[$i - 1]->update([
                    'ranking' => $i,
                    'updated_at' => Carbon::now(),
                ]);
            }

            if ($content && $post) {
                return redirect()->route('dashboard')->with([
                    'present' => true,
                    'status' => true,
                    'message' => GetLangMessage::languagePackage('en')->deletePostTrue,
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'present' => true,
                'status' => false,
                'message' => GetLangMessage::languagePackage('en')->deletePostFalse,
            ]);
        }

        return response()->json([
            'present' => true,
            'status' => false,
            'message' => GetLangMessage::languagePackage('en')->deletePostFalse,
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
            false => 'max:255',
            true => '',
        ];

        $this->persistValues = array_filter($requVal, function ($v) {
            return !(
                $v === '_method'
                || $v === '_token'
                || $v === 'image'
                || $v === 'old_image'
                || $v === 'ranking'
                || $v === 'new_ranking'
            );
        }, ARRAY_FILTER_USE_KEY);

        foreach ($this->persistValues as $key => $_) {
            if (str_contains($key, 'content')) $this->validateRules[$key] = 'max:255';
            // $this->validateRules[$key] = "{$rule[str_contains($key, 'content')]}";
        }

        $this->validateRules['ranking'] = 'required|numeric|min:1';
        $this->validateRules['new_ranking'] = 'required|numeric|min:1';

        if (array_key_exists('image', $requVal)) {
            $this->validateRules['image'] = 'required|mimes:jpg,png,webp,jpeg';
        }

        if (array_key_exists('old_image', $requVal)) {
            $this->validateRules['old_image'] = 'required|min:10|max:255';
        }

        $this->persistValues = array_filter($this->persistValues, function ($v) {
            return !($v === 'de' || $v === 'en' || $v === 'ru');
        }, ARRAY_FILTER_USE_KEY);
    }

    /**
     * Filters an array by language and the composed keys.
     *
     * @param string $lang
     * @param array $values
     * @return array
     */
    public function filtedLang(string $lang, array $values): array
    {
        $result = [];

        foreach ($values as $key => $value) {
            if (str_contains($key, "_{$lang}_")) {
                $key = preg_replace("/_{$lang}/", '', $key);
                $resId = substr($key, strpos($key, '_') + 1);
                $resKey = substr($key, 0, strpos($key, '_'));

                if (empty($result)) {
                    $result[] = [
                        'id' => $resId,
                        $resKey => $value,
                    ];
                } else {
                    $check = true;

                    for ($i = 0; $i < count($result); $i++) {
                        if ($result[$i]['id'] === $resId) {
                            $result[$i][$resKey] = $value;
                            $check = false;
                        }
                    }

                    if ($check) {
                        $result[] = [
                            'id' => $resId,
                            $resKey => $value,
                        ];
                    }
                }
            }
        }

        return $this->filterResult($result);
    }

    /**
     * Filters the result array of null id keys.
     *
     * @param array $resArr
     * @return array $resArr
     */
    public function filterResult($resArr): array
    {
        for ($i = 0; $i < count($resArr); $i++) {
            $check = false;

            if (isset($resArr[$i]['content'])) $resArr[$i]['content'] = preg_replace('/\r\n/', '<br>', $resArr[$i]['content']);
            if (isset($resArr[$i]['title'])) $resArr[$i]['title'] = preg_replace('/\r\n/', '<br>', $resArr[$i]['title']);

            foreach ($resArr[$i] as $key => $val) {
                if ($key === 'id' && str_contains($val, '_new')) {
                    $resArr[$i]['ranking'] = substr($val, 0, strpos($val, '_'));
                    $check = true;
                }
            }

            if ($check) unset($resArr[$i]['id']);
        }

        return $resArr;
    }
}
