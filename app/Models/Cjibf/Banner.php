<?php

namespace App\Models\Cjibf;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $table = 'banners';

    protected $casts = [
        'button' => 'array',
        'foto' => 'array'
    ];
    protected $fillable = [
        'foto',
        'title',
        'desc',
        'button'
    ];
}