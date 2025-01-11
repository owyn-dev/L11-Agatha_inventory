<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use HasFactory, Notifiable;

    protected $fillable = [
        'full_name',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array {
        return [
            'password' => 'hashed',
        ];
    }

    public function salesUserAssign(): HasMany {
        return $this->hasMany(Sales::class);
    }

    public function inventoryUserAssign(): HasMany {
        return $this->hasMany(Production::class);
    }

    public function productionUserAssign(): HasMany {
        return $this->hasMany(Production::class);
    }
}
