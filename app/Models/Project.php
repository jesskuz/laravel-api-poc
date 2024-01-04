<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
        'member_id',
    ];

    public function member()
    {
        return $this->hasOne(Member::class, 'member_id', 'id');
    }
}
