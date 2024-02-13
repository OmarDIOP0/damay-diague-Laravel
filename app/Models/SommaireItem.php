<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SommaireItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle_sommaire',
        'page_num',
        'cour_id'
    ];

    public function courSommaire():BelongsTo
    {
        return $this->belongsTo(Cours::class);
    }
}
