<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTontineUserTable extends Migration
{
    /**
     * Exécuter la migration.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tontines', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->integer('nbreParticipant');
            $table->integer('montant_base');
            $table->enum('frequence', ['JOURNALIERE', 'HEBDOMADAIRE', 'MENSUEL']);
            $table->date('dateDebut');
            $table->date('dateFin');
            $table->string('description');
            $table->decimal('montant_total', 10, 2);
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Ajoutez cette ligne
             $table->boolean('active')->default(true); // Optionnel
            $table->timestamps();
        });
    }

    /**
     * Annuler la migration.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tontines');
    }
}
