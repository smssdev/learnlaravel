<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostDb2 extends Model
{
    protected $connection = 'db2';
    protected $table = 'posts';
    protected $fillable = ['title'];
}
