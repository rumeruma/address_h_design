<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
//    protected $dateFormat = 'D-M-Y';
    protected $fillable = [
        'user_id', 'package_id', 'post_id', 'business', 'type', 'expiry', 'paymentid', 'active'
    ];


    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }


    public function package()
    {
        return $this->belongsTo('App\Package', 'package_id');
    }

    public function post()
    {
        return $this->belongsTo('App\Post', 'post_id')->where('type', '=', 'c-profile');
    }

    public static function getInfo($active)
    {
        return static::join('packages', 'subscriptions.package_id', '=', 'packages.id')
            ->join('users', 'subscriptions.user_id', '=', 'users.id')
            ->select('subscriptions.*', 'packages.title', 'users.email', 'users.name')->where('subscriptions.active', '=', $active);
    }

    public function getMyPacks($id)
    {
        return $this->join('packages', 'subscriptions.package_id', '=', 'packages.id')
            ->select('subscriptions.*', 'packages.title')->whereUserId($id)->get();
    }
}
