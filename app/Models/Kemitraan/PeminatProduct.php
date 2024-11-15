<?php

namespace App\Models\Kemitraan;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminatProduct extends Model
{
    use HasFactory;
    protected $table = 'peminat_products';
    protected  $fillable = [
        'peminat_id',
        'product_id',
        'rencana_nilai_pekerjaan',
        'status'
    ];

    public function userPeminat()
    {
        return $this->belongsTo(User::class, 'peminat_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
