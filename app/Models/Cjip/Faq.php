<?php

namespace App\Models\Cjip;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cjip\JenisFaq;

use Spatie\Translatable\HasTranslations;

class Faq extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'faqs';

    protected $translatable = [
        'question',
        'answer'
    ];

    protected $fillable = [
        'question', 'answer', 'jenis_id'
    ];

    public function jenisfaqs()
    {
        return $this->belongsTo(JenisFaq::class, 'jenis_id');
    }
}
