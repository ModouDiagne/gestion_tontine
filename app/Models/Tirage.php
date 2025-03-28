<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tirage extends Model
{
    use HasFactory;

    protected $fillable = ['tour_id', 'beneficiaire_id', 'montant_total', 'date_tirage', 'status'];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function beneficiaire()
    {
        return $this->belongsTo(Participant::class, 'beneficiaire_id');
    }
}

