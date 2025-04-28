<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDb1 extends Model
{
    protected $connection = 'db1';
    protected $table = 'users';
    protected $fillable = ['name'];
}
