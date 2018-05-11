<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Helpers\Poster;

class PostController extends Controller
{
    protected $type = 'page';
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
        return view('admin.post.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.post.new');
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

        $id = Poster::createPost(array(
            'userid' => auth()->user()->id,
            'title' => $request->input('title'),
            'name' => str_slug($request->input('title')),
            'content' => $request->input('content'),
            'excerpt' => $request->input('excerpt'),
            'type' => $this->type,
            'status' => 'published'
        ));

        Poster::collectMetas($request->input('meta'), $id);

         return redirect(route('post.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {


        $metas =   $post->meta;

        $metakeys = Poster::metaext($metas);

        return $metakeys;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $meta = Poster::metaext($post->meta);
        return view('admin.post.edit', compact('post', 'meta'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $this->validate($request,
            [
                'title' => 'required',
            ]);

        Poster::updatePost(array(
            'userid' => auth()->user()->id,
            'title' => $request->input('title'),
            'name' => str_slug($request->input('title')),
            'content' => $request->input('content'),
            'excerpt' => $request->input('excerpt'),
            'type' => $this->type,
            'status' => 'published'
        ), $post);

        Poster::updateMetas($request->input('meta'), $post->id);

        return redirect(route('post.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        echo $post->name;
    }

    public function getAll($type)
    {
        $post = Post::orderBy('created_at', 'desc')->whereType($type)->get();


        return DataTables::of($post)
            ->addIndexColumn()
            ->addColumn('operations',
                '<a class="button is-small is-primary is-outlined" href="'.$type.'/{{$id}}/edit"><i class="fa fa-pencil-square-o"></i></a>
                 <a class="button is-small is-danger is-outlined" href="'.$type.'/{{$id}}"><i class="fa fa-trash-o"></i></a>')
            ->rawColumns(['operations'])
            ->make(true);
    }
}
