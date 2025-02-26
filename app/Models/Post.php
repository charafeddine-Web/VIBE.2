<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'auteur_id',
        'contenu',
        'image',
        'datePublication',
    ];

    /**
     * Relation avec l'utilisateur (Auteur du post).
     */
    public function auteur(){
        return $this->belongsTo(User::class, 'auteur_id');
    }


    public function likes(){
        return $this->hasMany(Like::class);
    }
}

