<?php

namespace App\Models\SiMike;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RulesSimike extends Model
{
    use HasFactory;

    protected $casts = [
        'rules' => 'array',
    ];

    protected $fillable = [
        'nama',
        'rules',
        'is_active',

    ];
}
