<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pack extends Model
{
    // Pour exprimer qu’un pack peut contenir plusieurs articles, créer au niveau de la classe Pack 
    // une nouvelle fonction portant le nom articles()
    // Une fois la relation définie, nous pouvons récupérer les articles contenus dans un 
    // pack en accédant à la « propriété dynamique de relation » articles.
    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}
