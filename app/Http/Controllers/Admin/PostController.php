<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use App\Traits\GetLangMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
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
        $image = (object) [ 'id' => null ];

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
            return view('admin.post.edit', [
                'post' => Post::find($id),
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
    public function update(Request $request, $id)
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

            Post::whereId($id)->update([ 'public' => $request->public ]);

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
}
