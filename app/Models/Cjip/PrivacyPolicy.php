<?php

namespace App\Models\Cjip;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class PrivacyPolicy extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'privacy_policies';

    protected $fillable =[
        'policy', 'category'
    ];

    protected $translatable =[
        'policy', 'category'
    ];
}
