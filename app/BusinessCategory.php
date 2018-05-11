<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessCategory extends Model
{
    public $timestamps = false;
    public $fillable = ['title','parent_id'];

    public function childs() {

        return $this->hasMany('App\BusinessCategory','parent_id','id') ;

    }

    public function posts(){
        return $this->hasMany('App\BusinessPost','cat_id','id');
    }
    public function catposts($limit){
        return $this->hasMany('App\BusinessPost','cat_id','id')->paginate($limit);
    }

    public static function basecategories($limit){
        return static::whereParentId(0)->orderByRaw('RAND()')->limit($limit)->get();
    }

    public function featured_childs() {
        return $this->hasMany('App\BusinessCategory','parent_id','id')->orderByRaw('RAND()')->limit(5) ;

    }
}
