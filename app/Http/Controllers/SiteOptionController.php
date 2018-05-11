<?php

namespace App\Http\Controllers;

use App\Option;
use Illuminate\Http\Request;

class SiteOptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('admin');
    }

    public function index($name)
    {
        $options = $this->option(Option::all());
        return view('admin.option.' . $name, compact('options'));
    }

    public function update(Request $request)
    {

        $option = Option::whereName($request->input('name'))->update(['value'=>json_encode($request->input('value'))]);

        //return $option;
    }

    public function option($options){
        $optkeys = array();
        foreach ($options as $option){
            $optkeys[$option->name] = $option->value;
        }
        return $optkeys;
    }
}
