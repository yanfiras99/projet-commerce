<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{

    // Pour exprimer qu’une catégorie peut avoir plusieurs articles, créer au niveau de la classe Categorie 
    // une nouvelle fonction portant le nom articles()
    public function articles()
    {
        return $this->hasMany(Article::class);
    }   
}
