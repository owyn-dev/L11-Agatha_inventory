<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailSales extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sales_id',
        'product_id',
        'quantity',
        'price',
        'sub_total',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'sales_id' => 'integer',
        'product_id' => 'integer',
        'price' => 'decimal:2',
        'sub_total' => 'decimal:2',
    ];

    public function sales(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Sales::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
