<?php

namespace App\Models\Cjip;

use App\Models\Cjip\Loi;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kabkota extends Model
{
    use HasFactory;

    protected $table = 'kabkotas';

    // public function user(){
    //     return $this->belongsTo(KabKotaUser::class, 'id', 'kab_kota_id');
    // }

    // public function usernya(){
    //     return $this->belongsToMany(User::class, 'kabkota_user', 'kab_kota_id', 'user_id');
    // }

    public function lois()
    {
        return $this->hasMany(Loi::class, 'kab_kota_id');
    }

}
