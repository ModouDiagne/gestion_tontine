<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    // Liste des champs qui peuvent être assignés en masse
    protected $fillable = [
        'tontine_id',
        'beneficiaire_id',
        'date_debut',
        'date_fin',
        'montant',
        'termine',
        'status', // Ajout du champ 'status' si nécessaire
    ];

    // Cast des attributs
    protected $casts = [
        'date_debut' => 'datetime', // On laisse la gestion de la date sans spécifier un format précis
        'date_fin' => 'datetime',
        'termine' => 'boolean', // Ceci permet de traiter le champ comme un booléen
    ];

    // Relation avec le bénéficiaire
    public function beneficiaire()
    {
        return $this->belongsTo(Participant::class, 'beneficiaire_id');
    }

    // Scope pour les tours terminés
    public function scopeTerminated($query)
    {
        return $query->where('termine', true);
    }

    // Méthode pour vérifier si un tour est terminé
    public function isTerminated()
    {
        return $this->termine;
    }

    // Relation avec la tontine
    public function tontine()
    {
        return $this->belongsTo(Tontine::class);
    }

    // Relation avec les cotisations (si applicable)
    public function cotisations()
    {
        return $this->hasMany(Cotisation::class);
    }

    // Relation avec les cotisations non payées
    public function unpaidCotisations()
    {
        return $this->cotisations()->where('paye', false);
    }
}
