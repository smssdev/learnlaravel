<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class table extends Model
{
    use HasFactory;
    protected $fillable = ['number', 'status'];

    protected $casts = [
        'status' => 'string',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
