<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
class Admin extends Model
{
    use HasFactory, HasApiTokens;


    protected $fillable = [
        'name',
        'password',
        'permission',
    ];

    protected $hidden = [
        'password',
    ];

    public function hasAccess(){
        return $this->permission;
    }
}
