<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'title', 'name', 'content',
    ];

    protected $casts = [
        'meta' => 'array'
    ];

    public static function getActive()
    {
        return static::whereFeatured(true)->limit(4)->orderBy('created_at', 'desc')->get();

    }

    public function subscriptions(){
        return $this->hasMany('App\Subscription');
    }
    public function active_subscription(){
        return $this->hasMany('App\Subscription')->whereActive(true);
    }

    public static function byName($name){
        return static::whereName($name)->get()->first();
    }
    public function memberBySize(){
        return $this->hasMany('App\Subscription')->whereActive(true)->orderByRaw('RAND()')->limit(8); //->take(8)
    }
    public function memberAsRequired($limit){
        return $this->hasMany('App\Subscription')->whereActive(true)->orderByRaw('RAND()')->limit($limit)->get(); //->take(8)
    }


}
