<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{

    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
        'team_id',
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
