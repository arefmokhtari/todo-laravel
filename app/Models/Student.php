<?php

namespace App\Models;

use App\Http\Helper\ClassName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory, ClassName;

    protected $fillable = [
        'name'
    ];

    public function classes() {
        return $this->belongsToMany(Classes::class, 'classes_students', relatedPivotKey: 'class_id');
    }
}