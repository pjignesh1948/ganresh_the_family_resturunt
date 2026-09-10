<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VegetableSale extends Model
{
    protected $fillable = [
        'vegetable_id', 'grams', 'price_type', 'unit_price_per_kg',
        'total_price', 'sold_date', 'customer_note', 'recorded_by',
    ];

    protected function casts(): array
    {
        return [
            'grams' => 'decimal:2',
            'unit_price_per_kg' => 'decimal:2',
            'total_price' => 'decimal:2',
            'sold_date' => 'date',
        ];
    }

    public function vegetable(): BelongsTo
    {
        return $this->belongsTo(Vegetable::class);
    }
}
