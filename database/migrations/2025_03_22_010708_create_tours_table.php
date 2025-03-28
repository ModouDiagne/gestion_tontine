<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    if (!Schema::hasTable('tours')) {
        Schema::create('tours', function (Blueprint $table) {
            $table->id();

            // Clé étrangère vers la tontine
            $table->foreignId('tontine_id')
                  ->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            // Clé étrangère vers le bénéficiaire (utilisateur)
            $table->foreignId('beneficiaire_id')
                  ->constrained('users') // <-- Changé à "users"
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->date('date_debut');
            $table->date('date_fin');
            $table->decimal('montant', 10, 2);
            $table->boolean('termine')->default(false);
            $table->timestamps();

            // Index complémentaires
            $table->index('date_debut');
            $table->index('date_fin');
        });
    }
}

    public function down()
    {
        Schema::dropIfExists('tours');
    }
};
