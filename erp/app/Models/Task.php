<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // protected $table= 'tasks'; // ممكن تخصيصه
    // protected $primaryKey = 'id'; // ممكن تخصيصه

    protected $fillable = ['title','description','priority','user_id'];

    public function user() {
        return $this->belongsTo(User::class); // التاسك ينتمي إلى يوزر واحد
    }

    public function categories() {
        return $this->belongsToMany(Category::class, 'category_task'); // التاسك تنتمي لعدة كاتوجريز
    }


}
