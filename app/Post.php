<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Nicolaslopezj\Searchable\SearchableTrait;

class Post extends Model
{
    use Notifiable;
    use SearchableTrait;

    protected $searchable = [
        'columns' => [
            'posts.title' => 10,
            'posts.name' => 10,
            'posts.content' => 10,
        ]
    ];

    protected $fillable = [
        'title', 'name', 'content',
    ];

    public function slug($name)
    {
        return $this->whereName($name)->get();
    }

    public function meta()
    {
        return $this->hasMany('App\Postmeta');
    }

    public function scopeSlug($query, $slug)
    {
        return $query->where('neme', $slug);
    }

    public function package()
    {
        return $this->hasOne(Subscription::class, 'post_id');
    }

    public function business_categories()
    {
        return $this->hasMany('App\BusinessPost');
    }

    public static function custom($postType, $limit, $status = 'published', $orderby = 'created_at', $order = 'desc')
    {
        return static::whereType($postType)->whereStatus($status)->limit($limit)->orderBy($orderby, $order)->get();
    }
}
