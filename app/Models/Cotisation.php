<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotisation extends Model
{
    use HasFactory;

    // Tableau des attributs assignables en masse
    protected $fillable = [
        'participant_id', 'tontine_id', 'tour_id', 'montant', 'date_paiement', 'statut'
    ];

    /**
     * Relation inverse vers le modèle Participant.
     * Une cotisation appartient à un participant.
     */
    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    /**
     * Relation inverse vers le modèle Tontine.
     * Une cotisation appartient à une tontine.
     */
    public function tontine()
    {
        return $this->belongsTo(Tontine::class);
    }

    /**
     * Relation inverse vers le modèle Tour.
     * Une cotisation appartient à un tour.
     */
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
