<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Package;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Helpers\Packageer;

class AdminPackageController extends Controller
{
    protected $meta = ['package_price'=>[0], 'package_media'=>['slider_image'=>"", 'vdo'=>""]];
    public function __construct(){
        $this->middleware('auth:admin');
        $this->middleware('admin');

    }
    /**
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.package.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.package.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'title' => 'required',
            ]);

        $package = new Package();
        $package->author = auth()->user()->id;
        $package->title = $request->input('title');
        $package->name = str_slug($request->input('title'));
        $package->content = $request->input('content');
        $package->excerpt = $request->input('excerpt');
        $package->meta = $request->input('meta');
        $package->featured = true;
        $package->save();


        return redirect(route('package.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {


        $metas = $package->meta;

        $metakeys = Packageer::metaext($metas);

        return $metakeys;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        $meta = $package->meta;
        if(!$meta){ $meta = $this->meta; }
        return view('admin.package.edit', compact('package', 'meta'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {

        $this->validate($request,
            [
                'title' => 'required',
            ]);

        $package->author = auth()->user()->id;
        $package->title = $request->input('title');
        $package->name = str_slug($request->input('title'));
        $package->content = $request->input('content');
        $package->excerpt = $request->input('excerpt');
        $package->meta = $request->input('meta');
        $package->featured = true;
        $package->save();

        return redirect(route('package.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        echo $package->name;
    }

    public function getAll()
    {
        $package = Package::orderBy('created_at', 'desc')->get();


        return DataTables::of($package)
            ->addIndexColumn()
            ->addColumn('operations','<a class="btn btn-xs btn-info" href="{{ route( \'package.edit\', [$id]) }}"><i class="fa fa-pencil-square-o"></i></a>
                    <a class="btn btn-xs btn-danger" href="{{ route( \'package.destroy\', [$id]) }}"><i class="fa fa-trash-o"></i></a>')
            ->rawColumns(['operations'])
            ->make(true);
    }

}
