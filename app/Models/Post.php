<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'auteur',
        'contenu',
        'image',
        'datePublication',
    ];

    /**
     * Relation avec l'utilisateur (Auteur du post).
     */
    public function auteur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'auteur');
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }
}

