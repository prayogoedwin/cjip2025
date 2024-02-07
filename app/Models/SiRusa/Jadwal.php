<?php

namespace App\Models\SiRusa;

use App\Models\User;
use Buildix\Timex\Traits\TimexTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Jadwal extends Model
{
    use HasUuids;
    // use TimexTrait;

    protected $guarded = [];

    protected $casts = [
        'start' => 'date',
        'end' => 'date',
        'isAllDay' => 'boolean',
        'participants' => 'array',
        'personil' => 'array',
        'attachments' => 'array',
    ];

    public function getTable()
    {
        return config('timex.tables.event.name', "jadwals");
    }

    public function __construct(array $attributes = [])
    {
        $attributes['organizer'] = Auth::id();
        $attributes['tahun'] = now()->year;
        $attributes['participants'] = User::whereHas('roles', function($q){
            $q->where('name', 'pengawas');
        })->pluck('id')->toArray();

        parent::__construct($attributes);

    }

    public function category()
    {
        return $this->hasOne(self::getCategoryModel());
    }
}
