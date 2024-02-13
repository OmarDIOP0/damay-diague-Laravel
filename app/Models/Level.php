<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;
    use HasTimestamps;

    protected $fillable = [
    'libelle',
];

public function coursNiveau():HasMany
{
    return $this->hasMany(Cours::class);
}
}
