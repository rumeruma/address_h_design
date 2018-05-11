<?php

namespace App\Http\Controllers;

use App\BusinessPost;
use App\Mail\InfoRequest;
use App\Mail\ThankYou;
use App\Package;
use App\Subscription;
use App\User;
use Illuminate\Http\Request;
use App\Http\Helpers\Poster;
use App\Post;
use App\BusinessCategory;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\Types\Null_;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['test', 'post', 'showPosts', 'contactMsg']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('home');

    }

    public function test()
    {
        return view('home');

    }

    public function showPosts($slug = Null)
    {
        $basecategories = BusinessCategory::whereParentId(0)->get();
        $posts = array();
        if($slug != Null){
        $cat = BusinessCategory::whereName($slug)->first();
            $posts = $cat->posts()->paginate(12);
            return view('business-category.index', compact('posts', 'basecategories', 'slug'));
        } else {
            $posts = Post::whereType('c-profile')->paginate(12);
            return view('business-category.c-profile-archive', compact('posts', 'basecategories', 'slug'));

        }


    }

    public function post($slug)
    {
        $posts = new Post();
        $post = $posts->slug($slug)->first();
        $meta = Poster::metaext($post->meta);
        return view('single-' . $post->type, compact('post', 'meta'));
    }

    public function contactMsg(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email'=> 'required',
        ]);

        $content['name']= $request->input('name');
        $content['email']= $request->input('email');
        $content['message']= $request->input('message');

        $receiverAddress = 'addresshelp360@gmail.com';
        Mail::to($receiverAddress)->send(new InfoRequest($content));
        $thanks = ['title'=>"Tanks For Contact Us", 'msg'=>"We Will Contact You Soon"];
        Mail::to($request->input('email'))->send(new ThankYou($thanks));

    }
}
