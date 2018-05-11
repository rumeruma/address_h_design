<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CareerApplication;
use App\Mail\ThankYou;

class CareerController extends Controller
{
    public function index()
    {
        return view('career.careerform');
    }

    public function apply(Request $request)
    {

        $this->validate($request, [

            'my_file' => 'required|mimes:doc,pdf,docx|max:2048',
            'sender_name'=> 'required',
            'sender_email'=> 'required',
            'subject'=> 'required',

        ]);

       $cv = $request->file('my_file');


        $content = [
            'title'=> 'addresshelp360.com Career',
            'sender' => $request->input('sender_name'),
            'email' => $request->input('sender_email'),
            'body' => $request->input('message'),
            'subject' => $request->input('subject'),
            'file'=>['path'=>$cv->getRealPath(),'name'=>$cv->getClientOriginalName(), 'mime'=>$cv->getMimeType()]
        ];

//echo $content['file']['path'];

        $receiverAddress = 'addresshelp360@gmail.com';
        Mail::to($receiverAddress)->send(new CareerApplication($content));
        $thanks = ['title'=>"Tanks for Submitting Your Resume", 'msg'=>"We Will Contact You Soon"];
        Mail::to($content['email'])->send(new ThankYou($thanks));


//        Mail::send(['text' => 'mail.career'], ['name' => $name], function ($message) {
//            $message->to('addresshelp360@gmail.com', 'To 360')->subject($subject);
//            $message->from($email, 'career');
//        });

        return redirect(route('360.career'))->with('status', 'Thanks For Submitting Your Resume');
    }
}

//https://itsolutionstuff.com/post/laravel-54-send-email-using-markdown-mailablesexample.html