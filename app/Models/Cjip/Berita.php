<?php

namespace App\Models\Cjip;

use App\Models\Cjip\Kabkota;
use App\Models\User;
use Filament\Resources\Concerns\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Translatable\HasTranslations;

class Berita extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'beritas';

    protected $casts = [
        'image' => 'array'
    ];
    protected $translatable = [
        'title',
        'seo_title',
        'excerpt',
        'body',
        'slug',
        'meta_description',
        'meta_keyword',
        // 'image'
    ];

    protected $fillable = [
        'author_id',
        'category_id',
        'title',
        'seo_title',
        'excerpt',
        'body',
        'image',
        'slug',
        'meta_description',
        'meta_keyword',
        'status',
        'kab_kota_id',
        'featured',
        'count',
    ];


    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])
            ->format('d M Y');
    }


    /**
     * Get the total number of views.
     *
     * @return int
     */



    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    public function kabKota()
    {
        return $this->belongsTo(Kabkota::class);
    }
    // public function save(array $options = [])
    // {

    //     $this->user_id = Auth::guard('administrator')->user()->id;

    //     parent::save();
    // }
}