<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    /** @use HasFactory<\Database\Factories\FlightFactory> */
    use HasFactory, HasUuids;
    protected $table = 'my_flights'; // Table name
    protected $primaryKey = 'flight_id'; // PK
    public $incrementing = false; // غير متزايد
    protected $keyType = 'string'; // نوع المفتاح الأساسي
    protected $fillable = ['flight_id', 'flight_name'];
}
