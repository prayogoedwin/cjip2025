<?php

namespace App\Models\Simike;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'triwulan',
        'tahun',
        'bulan',
        'periode_start',
        'periode_end',
    ];

    public function user() :BelongsTo{
        return $this->belongsTo(User::class);
    }
}
