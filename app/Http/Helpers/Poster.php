<?php
/**
 * Created by PhpStorm.
 * User: faizuralmas
 * Date: 5/2/18
 * Time: 12:26 PM
 */

namespace App\Http\Helpers;

use App\Post;
use App\Postmeta;

class Poster
{


    public static function metaext($metas)
    {
        $metakeys = array();

        foreach ($metas as $meta) {
            $metakeys[$meta->meta_key] = $meta->meta_value;
        }

        return $metakeys;
    }


    public static function featuredImage($metas, $class = "image")
    {
        $src = self::featuredImageSrc($metas);
        if ($src != "") {
            return '<img src="' . $src . '" alt="" class="' . $class . '">';
        } else {
            return "";
        }
    }

    public static function featuredImageSrc($metas)
    {
        $src = "";
        if (is_array($metas)):
            if (array_key_exists('posts_featured_image', $metas)):
                $src = $metas['posts_featured_image'][0];
            endif;
        else:
            $src = "";
        endif;

        return $src;

    }

    public static function createPost($fields)
    {

        $post = new Post();
        $post->author = $fields['userid'];
        $post->title = $fields['title'];
        $post->name = $fields['name'];
        $post->content = $fields['content'];
        $post->excerpt = $fields['excerpt'];
        $post->type = $fields['type'];
        $post->status = $fields['status'];
        $post->save();

        return $post->id;

    }

    public static function updatePost($fields, Post $post)
    {

        $post->author = $fields['userid'];
        $post->title = $fields['title'];
        $post->name = $fields['name'];
        $post->content = $fields['content'];
        $post->excerpt = $fields['excerpt'];
        $post->type = $fields['type'];
        $post->status = $fields['status'];
        $post->save();

    }

    public static function collectMetas($metas, $postid)
    {
        $collection = [];
        foreach ($metas as $key => $value) {
            $nv = json_encode($value);
            $collection = array('post_id' => $postid, 'meta_key' => $key, 'meta_value' => $nv);

        }
        $postmeta = new Postmeta();
        $postmeta->insert($collection);
    }

    public static function updateMetas($metas, $postid)
    {

        foreach ($metas as $key => $value) {

            $meta = Postmeta::whereMetaKey($key)->wherePostId($postid)->get()->first();
            if ($meta) {
                $meta->find($meta->id);
                $meta->meta_value = $value;
                $meta->save();
            } else {
                $newmeta = new Postmeta();
                $newmeta->post_id = $postid;
                $newmeta->meta_key = $key;
                $newmeta->meta_value = $value;
                $newmeta->save();
            }

        }

    }

}

