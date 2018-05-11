<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessPost extends Model
{
    public $timestamps = false;
    public $fillable = ['post_id','cat_id'];

    public function posts(){
        return $this->belongsTo('App\Post', 'post_id');
    }

    public function bus_category(){
        return $this->belongsTo('App\BusinessCategory','cat_id');
    }
}
