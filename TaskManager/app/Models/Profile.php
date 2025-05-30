<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    // protected $fillable = ['user_id', 'phone', 'address', 'date_of_birth', 'bio'];
    protected $guarded=['id']; // ممنوع تدخل id هيك

    // Accessor لتنسيق تاريخ الميلاد
    protected function dateOfBirth(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? Carbon::parse($value)->format('d-m-Y') : null,
        );
    }

    public function user() {
        return $this->belongsTo(User::class); // البروفايل هذا بينتمي إلى يوزر واحد
    }
}
