<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function items()
    {
        return $this->hasMany(Item::class); // كل تصنيف له عدة منتجات
    }

}
