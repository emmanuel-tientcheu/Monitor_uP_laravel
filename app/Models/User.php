<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    
    /*
     * dans notre systeme une utilisateur ne peut etre
     *associé qu'a un departement
     */

    public function departement(){
        return $this->belongsTo(Departement::class);
     }

     /*
      *un user ne possede q'un seul role 
      */
     public function role(){
        return $this->belongsTo(Role::class);
     }

    protected $fillable =[
        'nom',
        'prenom',
        'email',
        'telephone',
        'statut',
        'matricule',
        'isActif',
        'password',
    ];
}
