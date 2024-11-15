<?php

namespace App\Models\Sinida;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateEmail extends Model
{
    use HasFactory;
    protected $table = 'template_email';
    protected $fillable = [
        'status', 'subject', 'content', 'modul'
    ];

    public function scopeByModul($query, $modul)
    {
        return $query->where('modul', $modul);
    }
}
