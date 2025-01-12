<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, HasRoles, Notifiable;

    protected $fillable = [
        'full_name',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function salesUserAssign(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    public function inventoryUserAssign(): HasMany
    {
        return $this->hasMany(Production::class);
    }

    public function productionUserAssign(): HasMany
    {
        return $this->hasMany(Production::class);
    }

    public function modelHasRole()
    {
        return $this->morphOne('App\Models\ModelHasRole', 'model');
    }
}
