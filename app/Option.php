<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name', 'value'
    ];

    protected $casts = [
        'value' => 'array'
    ];
}
