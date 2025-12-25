<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'designation',
        'reference',
        'description',
        'prix',
        'qte_stock',
        'slug',
        'categorie_id'
    ];


    // Pour exprimer qu’un article est associé à une catégorie, créer au niveau de la classe Article 
    // une nouvelle fonction portant le nom categorie()
    // Une fois la relation définie, nous pouvons récupérer la catégorie à laquelle appartient un 
    // article en accédant à la « propriété dynamique de relation » categorie. 
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    // Pour exprimer qu’un article peut appartenir à plusieurs packs, créer au niveau de la classe Article 
    // une nouvelle fonction portant le nom packs()
    // Une fois la relation définie, nous pouvons récupérer les packs auxquels appartient un 
    // article en accédant à la « propriété dynamique de relation » packs.
    public function packs()
    {
        return $this->belongsToMany(Pack::class);
    }
}
