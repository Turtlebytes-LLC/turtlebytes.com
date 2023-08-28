<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\BaseModel;
use Avatar;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Silber\Bouncer\Database\HasRolesAndAbilities;

/**
 * @property string $avatar
 */
class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use BaseModel, HasApiTokens, HasFactory, HasRolesAndAbilities, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
        'password'          => 'hashed',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->can('panel.view');
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return route('user.avatar', $this);
    }

    protected function getAvatarAttribute(): string
    {
        return Avatar::create($this->name)->toBase64();
    }
}
