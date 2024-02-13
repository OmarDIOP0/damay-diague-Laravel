<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercice extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
        'description',
        'nomFichier',
    ];

    public function coursExercice():BelongsTo
    {
        return $this->belongsTo(Cours::class);
    }
}
