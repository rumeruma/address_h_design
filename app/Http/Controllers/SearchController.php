<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $posts = array();
        if ($request->has('search')) {
            $posts = Post::whereType('c-profile')->search($request->get('search'))->paginate(20);
            //->with('business_categories')
        } else {
            $posts = Post::whereType('c-profile')->paginate(20);
        }

        return view('search', compact('posts'));

    }
}
