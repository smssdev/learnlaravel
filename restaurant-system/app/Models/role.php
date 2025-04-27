<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class role extends SpatieRole
{
    protected $fillable = ['name', 'guard_name'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function ourUsers()
    {
        return $this->belongsToMany(User::class, 'model_has_roles', 'role_id', 'model_id');
    }

}
