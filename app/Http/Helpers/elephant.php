<?php
/**
 * Created by PhpStorm.
 * User: faizuralmas
 * Date: 3/3/18
 * Time: 8:03 AM
 */

use App\Package;
use App\Option;
use App\Post;

if (!function_exists('package_by_name')) {

    function package_by_name($name)
    {
        return Package::byName($name);
    }

}

if (!function_exists('check_url')) {

    function check_url($url)
    {
        if (strpos($url, 'http') !== false) {
            return $url;
        } else {
            return url('/' . $url);
        }
    }

}

if (!function_exists('posts_meta')) {
    function posts_meta($meta, $key)
    {
        if (isset($meta[$key]) || array_key_exists($key, $meta)) {
            return $meta[$key];
        } else {
            return array();
        }
    }
}

if (!function_exists('posts_meta_collection')) {
    function posts_meta_collection($array, $key)
    {
        if (is_array($array)) {
            if (isset($array[$key]) || array_key_exists($key, $array)) {
                return $array[$key];
            } else {
                return "";
            }
        }
    }
}

if (!function_exists('get_metaext')) {
    function get_metaext($metas)
    {
        $metakeys = array();
        foreach ($metas as $meta) {
            $metakeys[$meta->meta_key] = $meta->meta_value;
        }
        return $metakeys;
    }
}

if (!function_exists('cut_limit')) {
    function cut_limit($string, $words = 1)
    {
        $string = strip_tags($string);

        return implode(' ', array_slice(explode(' ', $string), 0, $words));
    }
}

if (!function_exists('posts_thumbnail_uri')) {
    function posts_thumbnail_uri($imageurl)
    {
        $img = "http://via.placeholder.com/350.png";//'<img src="http://via.placeholder.com/350.png">';
        if ($imageurl) {
            $url = explode("/", $imageurl);
            array_splice($url, 4, 0, "thumbs");
            $img = implode("/", $url);
        }
        return $img;
    }
}

if (!function_exists('posts_featured_image_uri')) {
    function posts_featured_image_uri($metas, $type = 'image')
    {
        $img = "http://via.placeholder.com/350.png";//'<img src="http://via.placeholder.com/350.png">';
        $meta = get_metaext($metas);
        $featuredimage = posts_meta($meta, 'posts_featured_image');
        $image = posts_meta_collection($featuredimage, $type);
        if ($image) {
            $img = $image;
        }
        return $img;
    }
}

if (!function_exists('posts_meta_collection_get')) {
    function posts_meta_collection_get($metas, $array, $index)
    {
        $metastring = "";
        $meta = get_metaext($metas);
        $metaarray = posts_meta($meta, $array);
        $value = posts_meta_collection($metaarray, $index);
        if ($value) {
            $metastring = $value;
        }
        return $metastring;
    }
}
if (!function_exists('get_site_option')) {
    function get_site_option($key)
    {
        $options = Option::all();
        $optkeys = array();
        foreach ($options as $option) {
            $optkeys[$option->name] = $option->value;
        }
        return $optkeys[$key];
    }
}

if (!function_exists('get_some_motherfucking_post')) {
    function get_some_motherfucking_post($bra_size)
    {
        return Post::custom('c-profile',$bra_size);
    }
}




