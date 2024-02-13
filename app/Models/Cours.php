<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle',
        'slug',
        'description',
        'published',
        'nomFichier',
        'matiere_id',
        'level_id'
    ];

    public function sommaireCour():HasOne
    {
            return $this->hasOne(SommaireItem::class);
    }

    public function matiereCours():BelongsTo
    {
        return $this->belongTo(Matiere::class);
    }

    public function adminCours():BelongsTo
    {
        return $this->belongTo(Admin::class);
    }

    public function exerciceCours():HasMany
    {
        return $this->hasMany(Exercice::class);
    }

    public function niveauCours():BelongsTo
    {
        return $this->belognsTo(Level::class);
    }

    public function userCours():BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}

