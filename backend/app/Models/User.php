<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    
    protected $primaryKey = 'id_utilisateur';

    // 2. Les champs qu'on a le droit de modifier
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
        'date_naissance',
        'numero_telephone',
        'role',          
        'status',
        'specialite',
        'chef_id',     
    ];

    // Pour masquer le mot de passe dans les réponses JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function tachesCrees()
    {
        // On précise la clé étrangère 'cree_par_id'
        return $this->hasMany(Task::class, 'cree_par_id');
    }

    public function tachesAssignees()
    {
        return $this->hasMany(Task::class, 'assigne_a_id');
    }

   
     //Le chef de cet utilisateur (Relation récursive)
    public function monChef()
    {
        return $this->belongsTo(User::class, 'chef_id');
    }

    
    public function mesEmployes()
    {
        return $this->hasMany(User::class, 'chef_id');
    }

    

    public function isChef(): bool
    {
        return $this->role === 'chef';
    }

    public function isEmploye(): bool
    {
        return $this->role === 'employe';
    }
}