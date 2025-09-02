<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleAI extends Model
{
    use HasFactory;

    protected $table = 'role_ai';
    protected $fillable = [
        'name',
        'context',
    ];
}
