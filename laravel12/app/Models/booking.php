<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    protected $fillable = ['flight_id','name'];
      public function flight()
      {
          return $this->belongsTo(Flight::class,'flight_id', 'flight_id');
      }
}
