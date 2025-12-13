<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AiAnalysis extends Model
{
    use HasFactory;

    protected $fillable = [
        'cahier_charge_name',
        'file_path',
        'analysis_result',
        'status',
        'user_id',
        'project_id' 
    ];

    protected $casts = [
        'analysis_result' => 'array',
    ];

    public function chef()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // AJOUTER LA RELATION AVEC LE PROJET
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}