<?php

namespace App\Http\Controllers;

use App\Post;
use App\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
        $this->middleware('admin');

    }

    public function index(){
        $post = Post::orderBy('created_at', 'desc')->whereType('page')->get();
        return view('admin.menu.menu', compact('post'));
    }


    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required',
            ]);
        $menu = new Menu();
        $menu->title = $request->input('name');
        $menu->name = str_slug($request->input('name'));
        $menu->content = array();
        $menu->save();
    }

    public function update(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required',
            ]);

        $menu = Menu::whereName($request->input('name'))->get()->first();
        $menu->content = $request->input('content');
        $menu->save();

    }

    public function getMenus(){
        $menus = Menu::all();
        return $menus;
    }
}
