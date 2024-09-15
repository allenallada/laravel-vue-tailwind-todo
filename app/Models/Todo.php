<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'todo',
        'is_completed'
    ];

    protected $casts = [
        'is_completed' => 'boolean',
    ];
}
