<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'total', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class); // الطلب يتبع ليوزر معين
    }

    public function items()
    {
        return $this->belongsToMany(Item::class)->withPivot('quantity', 'price');
        // الطلب ينتمي لعدة منتجات تماما كما أن المنتج يتبع لعدة طلبات
    }
}
