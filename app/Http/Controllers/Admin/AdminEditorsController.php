<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminEditorsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('reporter');
    }

    public function index(){
        return view('admin.index');
    }
}
