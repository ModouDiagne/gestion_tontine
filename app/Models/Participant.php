<?php
// app/Models/Participant.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\User;

class Participant extends Authenticatable
{
    use HasFactory;

    protected $table = 'participants';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom',
        'prenoms',
        'sexe',
        'telephone',
        'email',
        'password',
        'montant_personne',
        'cycle_vie',
        'tontine_id'
         // Ajout essentiel
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'montant_personne' => 'decimal:2',
    ];

    /**
     * Get the tontine associated with the participant.
     */
    public function tontine()
    {
        return $this->belongsTo(Tontine::class);
    }

    /**
     * Get the cotisations for the participant.
     */
    public function cotisations()
    {
        return $this->hasMany(Cotisation::class);
    }
}
