<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
{
    Schema::create('tirages', function (Blueprint $table) {
        $table->id();

        // Clé étrangère vers le tour
        $table->foreignId('tour_id')
              ->constrained()
              ->onDelete('cascade');

        // Clés étrangères pour le participant (clé composite)
        $table->unsignedBigInteger('user_id'); // Partie 1 de la clé composite
        $table->unsignedBigInteger('tontine_id'); // Partie 2 de la clé composite

        // Clé étrangère composite vers participants
        $table->foreign(['user_id', 'tontine_id'])
              ->references(['user_id', 'tontine_id'])
              ->on('participants')
              ->onDelete('cascade');

        // Clés étrangères individuelles pour faciliter les requêtes
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('tontine_id')->references('id')->on('tontines')->onDelete('cascade');

        // Autres champs
        $table->decimal('montant_total', 10, 2)->nullable();
        $table->date('date_tirage');
        $table->string('status')->default('en attente');
        $table->timestamps();
    });
}

    public function down()
    {
        Schema::dropIfExists('tirages');
    }
};

