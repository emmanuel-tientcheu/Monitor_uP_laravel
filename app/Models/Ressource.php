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

    /*
     *une ressource a une ou plusieurs image
     */
    public function media(){
        return $this->hasMany(Media::class);
    }

    protected $fillable = [
        'id_departement',
        'id_categorie',
        'isDisponible',
        'nom',
        'description'
    ];
}
