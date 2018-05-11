<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postmeta extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'post_id', 'meta_key', 'meta_value'
    ];

    protected $casts = [
        'meta_value' => 'array'
    ];
}
