<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Production extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'inventory_user_id',
        'production_request_date',
        'production_user_id',
        'production_date',
        'status',
        'note',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'inventory_user_id' => 'integer',
        'production_request_date' => 'timestamp',
        'production_user_id' => 'integer',
        'production_date' => 'timestamp',
    ];

    public function detailProductions(): HasMany
    {
        return $this->hasMany(DetailProduction::class);
    }

    public function inventoryUser(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function productionUser(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
