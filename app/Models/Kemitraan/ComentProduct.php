<?php

namespace App\Models\Kemitraan;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComentProduct extends Model
{
    use HasFactory;
    protected $table = 'coment_products';
    protected $fillable = [
        'user_id',
        'product_id',
        'comment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
