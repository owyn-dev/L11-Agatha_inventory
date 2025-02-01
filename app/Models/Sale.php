<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sales_user_id',
        'transaction_date',
        'total_amount',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'sales_user_id' => 'integer',
        'transaction_date' => 'timestamp',
        'total_amount' => 'decimal:2',
    ];

    public function detailSales(): HasMany
    {
        return $this->hasMany(DetailSales::class, 'sales_id');
    }

    public function salesUser(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
