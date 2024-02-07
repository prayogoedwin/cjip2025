<?php

namespace App\Models\Cjip;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class JenisFaq extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'jenis_faqs';

    protected $fillable = [
        'nama'
    ];

    protected $translatable = [
        'nama'
    ];
}
