<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;
use App\Models\Tontine; // Ajout de l'import manquant

return new class extends Migration
{
    public function up()
    {
        Schema::table('tontines', function (Blueprint $table) {
            $table->string('slug')->unique()->after('id');
        });

        // Génération des slugs pour les entrées existantes
        Tontine::withoutEvents(function () {
            Tontine::each(function ($tontine) {
                $tontine->update(['slug' => Str::slug($tontine->libelle)]);
            });
        });
    }

    public function down()
    {
        Schema::table('tontines', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
