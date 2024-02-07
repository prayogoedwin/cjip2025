<?php

namespace App\Models\SiRusa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailureImport extends Model
{
    use HasFactory;

    protected $fillable = [
        'row',
        'attribute',
        'errors',
        'values',
    ];
}
