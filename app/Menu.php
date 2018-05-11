<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'title', 'name', 'content'
    ];

    protected $casts = [
        'content' => 'array'
    ];

    public static function getMenu($name){
        return static::select('content')->whereName($name)->get()->first();
    }
}
