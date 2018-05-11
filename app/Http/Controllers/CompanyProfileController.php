<?php

namespace App\Http\Controllers;

use App\BusinessCategory;
use App\BusinessPost;
use Illuminate\Http\Request;
use App\Subscription;
use App\Post;
use App\Postmeta;
use App\Http\Helpers\Poster;


class CompanyProfileController extends Controller
{
    protected $type = 'c-profile';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit(Subscription $subscription)
    {

        $meta = Poster::metaext($subscription->post->meta);
        $categories = BusinessCategory::whereParentId(0)->get();
        return view('user-profile/post-editor', compact('subscription', 'meta', 'categories'));
    }

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
        $this->category($request->input('category'), $post->id);
        return redirect(route('my-business.edit', [$post->package->id]));

//        $res = $request->input('category');
//        return explode(',', $res);

    }

    public function updateVoda(Request $request)
    {

//        var_dump($request->input('meta')); exit();
        Poster::updateMetas($request->input('meta'), $request->input('post'));
        return array('success' => "Profile");

    }

    /**
     * @param $input
     * @param $postid
     */

    public function category($input, $postid)
    {
        if (isset($input)) {
            $cats = explode(',', $input);
            $savedcat = BusinessPost::wherePostId($postid)->pluck('cat_id')->all();
            $diffs = array_diff($savedcat, $cats);
            if (isset($diffs)) {
                foreach ($diffs as $diff) {
                    BusinessPost::whereCatId($diff)->wherePostId($postid)->delete();
                    $findthis = BusinessCategory::find($diff);
                    if ($findthis->parent_id != 0) {
                        BusinessPost::whereCatId($findthis->parent_id)->wherePostId($postid)->delete();
                    }
                }
            }

            foreach ($cats as $cat) {
                if (isset($cat)) {
                    $is_saved = BusinessPost::whereCatId($cat)->wherePostId($postid)->get()->first();
                    if ($is_saved) {

                    } else {
                        $bp = new BusinessPost();
                        $bp->post_id = $postid;
                        $bp->cat_id = $cat;
                        $bp->save();

                        $findit = BusinessCategory::find($cat);
                        $is_savedbase = BusinessPost::whereCatId($findit->parent_id)->wherePostId($postid)->get()->first();
                        if ($findit->parent_id != 0 && !$is_savedbase) {
                            $base = new BusinessPost();
                            $base->post_id = $postid;
                            $base->cat_id = $findit->parent_id;
                            $base->save();
                        }

                    }
                }
            }
        }

    }


}
