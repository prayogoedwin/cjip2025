<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Cjip\Kabkota;
use App\Models\Cjip\Kawasan;
use App\Models\Kepeminatan\Perusahaan;
use App\Models\Simike\Report;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Filament\Models\Contracts\FilamentUser;
// use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasAvatar
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    public function canImpersonate()
    {
        return true;
    }

    public function getFilamentName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function canAccessFilament(): bool
    {
        return true;
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->profile_photo_path ? Storage::url($this->profile_photo_path) : null;
    }
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo_path',
        'nip',
        'kabkota_id',
        'jabatan',
        'no_hp',
        'is_kawasan',
        'is_kabkota',
        'user_kawasan_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function kabkota()
    {
        return $this->belongsTo(Kabkota::class);
    }
    public function userkawasan()
    {
        return $this->belongsTo(Kawasan::class, 'user_kawasan_id');
    }

    public function simikeReport(): HasMany
    {
        return $this->hasMany(Report::class, 'user_id', 'id');
    }

    public function userperusahaan()
    {
        return $this->hasOne(Perusahaan::class);
    }
}
