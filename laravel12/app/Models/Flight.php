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
    protected $fillable = ['flight_name', 'counter'];
    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'updated_date';

    protected $attributes = [ // لتحديد القيم الافتراضية
        'flight_name' => 'تست من خلال النظام مع عداد',
        'counter' => 10,
    ];

    // علاقة مع نموذج Booking
    public function bookings()
    {
        return $this->hasMany(Booking::class,'flight_id', 'flight_id');
    }

}
