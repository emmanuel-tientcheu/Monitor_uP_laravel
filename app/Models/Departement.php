<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;
     /*
     * dans notre systeme un departement peut etre
     *associé a plusieurs users
     */

    public function user(){
        return $this->hasMany(User::class);
    }

    /*
     *dans le systeme un departement possede une ou plusieurs ressources
     */
    public function ressource(){
        return $this->hasMany(Ressource::class);
    }
}
