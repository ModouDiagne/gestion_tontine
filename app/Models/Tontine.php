<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tontine extends Model
{
    use HasFactory;

    protected $table = 'tontines';

    protected $fillable = [
        'libelle',
        'nbreParticipant',
        'montant_base',
        'frequence',
        'dateDebut',
        'dateFin',
        'description',
        'slug',
        'user_id',
        'active',
        'montant_total'
    ];

    protected $casts = [
        'dateDebut' => 'datetime',
        'dateFin' => 'datetime',
        'active' => 'boolean'
    ];

    protected $appends = ['status']; // Ajout de l'attribut virtuel

    protected static function boot() {
        parent::boot();
        static::creating(function ($tontine) {
            $tontine->slug = Str::slug($tontine->libelle, '-', 'fr');
        });
    }

    // Accessor pour le statut
    public function getStatusAttribute()
    {
        return $this->isOpen() ? 'Ouverte' : 'Fermée';
    }

    // Vérifie si la tontine est ouverte
    public function isOpen()
    {
        return $this->active &&
               $this->current_members < $this->max_members &&
               now()->lt($this->dateFin);
    }

    // Scope pour les tontines actives
    public function scopeActive($query)
    {
        return $query->where('active', true)
            ->where('current_members', '<', \DB::raw('max_members'))
            ->where('dateFin', '>', now());
    }

    // Relation avec les participants
    public function participants()
    {
        return $this->belongsToMany(User::class, 'participants')
            ->withPivot(['montant_personne', 'cycle_vie', 'est_actif'])
            ->withTimestamps();
    }

    // Relation avec les tours
    public function tours()
    {
        return $this->hasMany(Tour::class);
    }

    // Méthode pour ajouter un membre
    public function addMember()
    {
        if ($this->isOpen()) {
            $this->increment('current_members');
            return true;
        }
        return false;
    }

    // Vérifie si un utilisateur est membre de cette tontine
    public function isMember(User $user)
    {
        return $this->user_id === $user->id ||
               $this->participants()->where('user_id', $user->id)->exists();
    }

    // Vérifie si la tontine est active
    public function isActive()
    {
        return $this->status === 'ACTIVE';
    }

    // Vérifie si le nombre minimum de participants est atteint
    public function hasMinimumParticipants()
    {
        return $this->participants()->count() >= $this->nbreParticipant;
    }

    // Utilisé pour récupérer l'URL du modèle
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Vérifie si la tontine est éligible pour un nouveau tour
    public function isEligibleForNewTour()
    {
        return $this->participants()->count() >= $this->nbreParticipant &&
               $this->tours()->where('termine', false)->doesntExist();
    }

    // Méthode pour récupérer les participants éligibles
    public function eligibleParticipants()
    {
        // On récupère les participants actifs (colonne 'est_actif' doit être true)
        return $this->participants()->wherePivot('est_actif', true)->get();
    }


}
