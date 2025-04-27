<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name', 'price', 'description'];

    public function category()
    {
        return $this->belongsTo(Category::class); // المنتج يتبع لتصنيف واحد
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity', 'price');
        // المنتج يتبع لعدة طلبات  لأنه الطلب ممكن يكون لأكثر من منتج
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable'); // المنتج ممكن يكون له عدة صور
    }

}
