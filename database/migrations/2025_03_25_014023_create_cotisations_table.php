<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('cotisations', function (Blueprint $table) {
            $table->id();

            // Clés étrangères composites pour participants (user_id + tontine_id)
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('tontine_id');

            // Clé étrangère pour le tour
            $table->foreignId('tour_id')->constrained()->onDelete('cascade');

            $table->decimal('montant', 10, 2);
            $table->date('date_paiement')->nullable();
            $table->enum('statut', ['payé', 'en attente'])->default('en attente');
            $table->timestamps();

            // Clé étrangère composite vers participants
            $table->foreign(['user_id', 'tontine_id'])
                  ->references(['user_id', 'tontine_id'])
                  ->on('participants')
                  ->onDelete('cascade');

            // Clés étrangères individuelles (optionnel)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('tontine_id')->references('id')->on('tontines')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cotisations');
    }
};

