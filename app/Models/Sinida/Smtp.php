<?php

namespace App\Models\Sinida;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smtp extends Model
{
    use HasFactory;
    protected $table = 'smtps';
    protected $fillable = [
        'mail_mailer', 'mail_host', 'mail_port', 'mail_username', 'mail_password', 'mail_encryption', 'mail_from_address', 'mail_from_name','modul'
    ];

    public function scopeByModul($query, $modul)
    {
        return $query->where('modul', $modul);
    }
}
