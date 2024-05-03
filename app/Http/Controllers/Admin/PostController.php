<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Models\Image;
use App\Models\Lang\DE_Content;
use App\Models\Lang\EN_Content;
use App\Models\Lang\RU_Content;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
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
                $file = $request->file('image');

                $name_gen = hexdec(uniqid());
                $extension = strtolower($file->getClientOriginalExtension());
                $img_name = $name_gen . '.' . $extension;

                $upload_location = 'uploads/images/posts/';
                $save_url = $upload_location . $img_name;

                $file->move($upload_location, $img_name);

                $image = Image::create([
                    'page_id' => 3,
                    'src' => $save_url,
                    'ext' => $extension,
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

            $post = Post::find($postId)->update([
                'de' => $request->de,
                'en' => $request->en,
                'ru' => $request->ru,
            ]);

            foreach ($this->filtedLang('de', $this->persistValues) as $values) {
                
                if (array_key_exists('id', $values)) {
                    DE_Content::whereId(array_slice($values, 0, 1)['id'])
                        ->update(array_slice($values, 1));
                } else {
                    $values['content_id'] = $conId;
                    $deCon = DE_Content::create($values);
                    $deCon->save();
                }
            }

            foreach ($this->filtedLang('en', $this->persistValues) as $values) {

                if (array_key_exists('id', $values)) {
                    EN_Content::whereId(array_slice($values, 0, 1)['id'])
                        ->update(array_slice($values, 1));
                } else {
                    $values['content_id'] = $conId;
                    $enCon = new EN_Content($values);
                    $enCon->save();
                }
            }

            foreach ($this->filtedLang('ru', $this->persistValues) as $values) {

                if (array_key_exists('id', $values)) {
                    RU_Content::whereId(array_slice($values, 0, 1)['id'])
                        ->update(array_slice($values, 1));
                } else {
                    $values['content_id'] = $conId;
                    $ruCon = RU_Content::create($values);
                    $ruCon->save();
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function up(Request $request, $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function down(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
            false => '|max:255',
            true => '',
        ];

        $this->persistValues = array_filter($requVal, function ($v) {
            return !($v === '_method' || $v === '_token');
        }, ARRAY_FILTER_USE_KEY);

        foreach (array_flip($this->persistValues) as $val) {
            $this->validateRules[$val] = "required|min:3{$rule[str_contains($val, 'content')]}";
        }

        $this->validateRules['image'] = 'mimes:jpg,png,webp,jpeg';

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

                if ( empty($result) ) {
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
