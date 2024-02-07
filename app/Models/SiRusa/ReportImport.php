<?php

namespace App\Models\SiRusa;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReportImport extends Model
{
    use HasFactory;

    protected $fillable = [
        'tahun',
        'triwulan',
        'file',
        'user_id',
        'status',
        'tanggal_awal',
        'tanggal_akhir',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
