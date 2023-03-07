<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;


    protected $fillable = [
        'description',
        'province',
        'city',
    ];


    protected $hidden = [
        'user_id',
    ];
}
