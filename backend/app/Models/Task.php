<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // 1. Clé primaire personnalisée
    protected $primaryKey = 'id_tache';

    // 2. Champs modifiables
    protected $fillable = [
        'titre',
        'description',
        'status',          // en_attente, en_cours, terminee...
        'date_limitee',
        'date_achevement',
        'date_debut',
        'cree_par_id',     // FK Chef
        'assigne_a_id',    // FK Employé
    ];

    // 3. Gestion automatique des dates (Casts)
    // Cela transforme vos dates SQL en objets Carbon (facile à formater)
    protected $casts = [
        'date_limitee' => 'datetime',
        'date_achevement' => 'datetime',
        'date_debut' => 'datetime',
    ];

    // --- RELATIONS ---

    /**
     * L'utilisateur qui a créé la tâche (Le Chef)
     */
    public function createur()
    {
        return $this->belongsTo(User::class, 'cree_par_id', 'id_utilisateur');
    }

    /**
     * L'utilisateur qui doit faire la tâche (L'Employé)
     * Peut renvoyer null si pas encore assignée
     */
    public function assigneA()
    {
        return $this->belongsTo(User::class, 'assigne_a_id', 'id_utilisateur');
    }
}