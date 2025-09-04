<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuperUser extends Model
{
    protected $table = 'super_users';
    protected $fillable = ['email', 'password'];
}
