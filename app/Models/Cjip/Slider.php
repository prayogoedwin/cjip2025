<?php

namespace App\Models\Cjip;

use Filament\Resources\Concerns\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Slider extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'sliders';

    protected $casts = [
        'button' => 'array'
    ];

    protected $fillable = [
        'foto',
        'title',
        'desc',
        'button'
    ];

    protected $translatable = [
        'title',
        'desc',
    ];
}
