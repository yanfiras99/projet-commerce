<?php

use App\Models\Categorie;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        // explication:
        // la methode table permet de modifier une table existante
        // la methode foreignIdFor permet de creer une colonne de type foreign key
        // la methode nullable permet de rendre cette colonne optionnelle
        // la methode constrained permet de definir la contrainte de cle etrangere
        // la methode cascadeOnDelete permet de supprimer en cascade les articles lies a une categorie sup
        Schema::table('articles', function (Blueprint $table) {
            $table->foreignIdFor(Categorie::class)->nullable()->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeignIdFor(Categorie::class);
            $table->dropColumn('categorie_id');
        });
        Schema::dropIfExists('categories');
    }
};
