<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;


    /*
    * un role peut attribué a un ou plusieur users
    */
    public function user(){
        return $this->hasMany(User::class);
    }
}
