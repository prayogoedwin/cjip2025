<?php

namespace App\Models\Sinida;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pns extends Model
{
    use HasFactory;
    protected $table = 'pns';
    protected $fillable = [
        'nama', 'nip', 'jab'
    ];
}
