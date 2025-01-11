<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InventoryOut extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventory_out';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'inventory_in_id',
        'batch_code',
        'transaction_date',
        'shelf_name',
        'stock_out',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'inventory_in_id' => 'integer',
        'transaction_date' => 'timestamp',
    ];

    public function inventoryIn(): BelongsTo
    {
        return $this->belongsTo(InventoryIn::class);
    }
}
