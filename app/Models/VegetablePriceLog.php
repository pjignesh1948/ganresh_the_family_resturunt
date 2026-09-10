<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VegetablePriceLog extends Model
{
    protected $fillable = [
        'vegetable_id',
        'retail_price_per_kg',
        'vendor_price_per_kg',
        'logged_date',
        'changed_by',
        'note',
    ];

    protected function casts(): array
    {
        return [
            'retail_price_per_kg' => 'decimal:2',
            'vendor_price_per_kg' => 'decimal:2',
            'logged_date' => 'date',
        ];
    }

    public function vegetable(): BelongsTo
    {
        return $this->belongsTo(Vegetable::class);
    }

    public function changedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
