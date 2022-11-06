<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    /*
    * dans notre systeme une categorie peut etre 
      attribue a un ou plusieurs ressources
     */
    public function ressource(){
        return $this->hasMany(Ressource::class);
    }

    protected $fillable =[
        'titre'
    ];
}
