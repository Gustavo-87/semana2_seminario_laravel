<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'rol',
        'telefono',
        'direccion',
        'avatar',
        'otp_code',
        'otp_expires_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'otp_code',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'otp_expires_at' => 'datetime',
        ];
    }

    public function generateOtp(): string
    {
        $otp = str_pad(
            (string) random_int(0, 999999),
            6,
            '0',
            STR_PAD_LEFT
        );

        $this->otp_code = $otp;
        $this->otp_expires_at = now()->addMinutes(5);
        $this->save();

        return $otp;
    }

    public function verifyOtp(string $code): bool
    {
        if (!$this->otp_code || !$this->otp_expires_at) {
            return false;
        }

        if (now()->greaterThan($this->otp_expires_at)) {
            return false;
        }

        return hash_equals((string) $this->otp_code, $code);
    }

    public function getAvatarUrlAttribute(): ?string
    {
        return $this->avatar
            ? asset('storage/' . $this->avatar)
            : null;
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
