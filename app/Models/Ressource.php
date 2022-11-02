<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ressource extends Model
{
    use HasFactory;

    /*
     * une ressource appartient appartient a un unique departement 
     */
    public function departement (){
        return $this->belongsTo(Departement::class);
    }

    /*
     * une ressource appartient a une unique categorie
    */
    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }
}
