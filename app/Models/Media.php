<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    /*
     *une image appartient a une seul ressource
    */
    public function ressource(){
        return $this->belongsTo(Ressource::class);
    }
}
