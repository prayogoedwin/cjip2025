<?php

namespace App\Models\Cjip;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Terms extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'body'
    ];

    protected $translatable = [
        'body'
    ];
}
