<?php

use App\Models\Article;
use App\Models\Pack;
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
        Schema::create('packs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('prix');
            $table->timestamps();
        });

        // Table pivot entre articles et packs
        // Un pack peut contenir plusieurs articles
        // Un article peut appartenir à plusieurs packs
        // Donc une relation many-to-many
        Schema::create('article_pack', function (Blueprint $table) {
            $table->foreignIdFor(Article::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Pack::class)->constrained()->cascadeOnDelete();
            $table->primary(['article_id', 'pack_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // pour supprimer une table pivot, il faut d'abord supprimer la table pivot elle-même
        Schema::dropIfExists('article_pack');
        Schema::dropIfExists('packs');
    }
};
