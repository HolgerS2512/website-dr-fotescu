<?php

namespace App\Http\Controllers;

use App\Mail\ContactFeedbackMail;
use App\Mail\ContactMail;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\GetLangMessage;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function store(Request $request)
    {
        try {
            $credentials = Validator::make($request->all(), [
                'name' => 'required|min:3|max:50',
                'email' => 'required|email',
                'reference' => 'required|min:3|max:50',
                'msg' => 'required|min:10|max:255',
                'terms' => 'accepted',
            ]);

            if ($credentials->fails()) {
                return redirect()->back()
                    ->withErrors($credentials->errors())
                    ->withInput();
            }

            Mail::to(env('MAIL_FROM_ADDRESS'))->send(new ContactMail($request));

            Mail::to($request['email'])->send(new ContactFeedbackMail);

            return redirect()->back()->with([
                'present' => true,
                'status' => true,
                'message' => GetLangMessage::languagePackage()->contactTrue,
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with([
                'present' => true,
                'status' => false,
                'message' => GetLangMessage::languagePackage()->contactFalse,
            ]);
        }

        return redirect()->back()->with([
            'present' => true,
            'status' => false,
            'message' => GetLangMessage::languagePackage()->contactFalse,
        ]);
    }
}
