<?php

namespace App\Models\Cjip;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kawasan extends Model
{
    use HasFactory;
    protected $table = 'kawasans';
    protected $fillable = ['nama'];
}