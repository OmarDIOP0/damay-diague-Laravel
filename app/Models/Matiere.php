<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle'
    ];

    public function coursMatiere():HasMany
    {
        return $this->hasMany(Cours::class);
    }
}
