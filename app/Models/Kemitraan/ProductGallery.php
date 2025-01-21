<?php

namespace App\Models\Kemitraan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductGallery extends Model
{
    use HasFactory;
    protected $table = 'product_galleries';

    protected $casts = [
        'image' => 'array',
    ];
    protected $fillable = [
        'product_id',
        'image',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getGalleryAttribute()
    {
        // Check if image is an array and map it to URLs
        if (is_array($this->image)) {
            return array_map(function ($img) {
                return Storage::url($img) ?: asset('images/no_image.jpg');
            }, $this->image);
        }

        // If it's not an array, return a default image
        return [asset('images/no_image.jpg')];
    }
}
