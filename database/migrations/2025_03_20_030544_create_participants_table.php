<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->foreignId('tontine_id')
                ->constrained()
                ->onDelete('cascade');

            $table->decimal('montant_personne', 10, 2);
            $table->enum('cycle_vie', ['HEBDOMADAIRE', 'MENSUEL', 'JOURNALIER'])->default('MENSUEL');
            $table->boolean('est_actif')->default(true);

            $table->unique(['user_id', 'tontine_id']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('participants');
    }
};
