<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Helper\ClassName;

class Classes extends Model
{
    use HasFactory, ClassName;



    protected $fillable = [
        'name'
    ];

    public function students() {
        return $this->belongsToMany(Student::class, 'classes_students', 'class_id');
    }
}
