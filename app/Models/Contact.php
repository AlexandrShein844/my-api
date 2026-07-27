<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'comment',
        'ai_sentiment',
        'ai_response',
    ];
    protected $casts = [
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
];
}
