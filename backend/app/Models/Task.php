<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'description', 'priority', 'status', 'sprint_id', 'assigned_to'];

    public function sprint()
    {
        return $this->belongsTo(Sprint::class);
    }

    // L'employé assigné
    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}