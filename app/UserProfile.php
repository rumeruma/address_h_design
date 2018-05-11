<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'about_me', 'organization', 'designation', 'cell_numbers', 'avatar', 'links'
    ];

    protected $casts = [
        'cell_numbers' => 'array',
        'links' => 'array',
    ];

}
