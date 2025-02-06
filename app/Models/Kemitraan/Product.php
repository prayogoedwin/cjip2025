<?php

namespace App\Models\Kemitraan;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'is_active',
        'image_cover',
        'description'
    ];

    public function getGambarAttribute()
    {
        $storagePath = storage_path('app/public/' . $this->image_cover);
        $publicPath = public_path('product/cover/' . $this->image_cover);
        $defaultImage = asset('images/no_image.jpg');

        if (file_exists($storagePath)) {
            return Storage::url($this->image_cover);
        } elseif (file_exists($publicPath)) {
            return asset('product/cover/' . $this->image_cover);
        } else {
            return $defaultImage;
        }
    }

    public function productMinat()
    {
        return $this->hasMany(PeminatProduct::class);
    }

    public function galleryProduct()
    {
        return $this->hasMany(ProductGallery::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comment()
    {
        return $this->hasMany(ComentProduct::class);
    }
}
