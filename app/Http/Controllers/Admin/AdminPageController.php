<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post as Page;
use App\Http\Helpers\Poster;

class AdminPageController extends Controller
{
    protected $type = 'page';
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
        return view('admin.page.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page.new');
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
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {


        $metas =   $page->meta;

        $metakeys = Poster::metaext($metas);

        return $metakeys;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        $meta = Poster::metaext($page->meta);
        return view('admin.page.edit', compact('page', 'meta'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
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
        ), $page);

        Poster::updateMetas($request->input('meta'), $page->id);

        return redirect(route('post.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        echo $page->name;
    }
}
