<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleAdmin extends Model
{
    protected $fillable = [
        'role_id', 'admin_id'
    ];
}
