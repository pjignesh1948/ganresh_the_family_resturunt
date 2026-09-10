<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vegetable extends Model
{
    protected $fillable = [
        'name',
        'name_hi',
        'name_gu',
        'description',
        'description_hi',
        'description_gu',
        'type',
        'image',
        'retail_price_per_kg',
        'vendor_price_per_kg',
        'unit',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'retail_price_per_kg' => 'decimal:2',
            'vendor_price_per_kg' => 'decimal:2',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function priceLogs(): HasMany
    {
        return $this->hasMany(VegetablePriceLog::class);
    }

    public function priceForWeight(int|float $grams, string $type = 'retail'): float
    {
        $pricePerKg = match ($type) {
            'vendor' => $this->vendor_price_per_kg ?? 0,
            default => $this->retail_price_per_kg,
        };

        return round(((float) $grams / 1000) * (float) $pricePerKg, 2);
    }

    public function searchBlob(): string
    {
        return strtolower(implode(' ', array_filter([
            $this->name,
            $this->name_hi,
            $this->name_gu,
            $this->description,
            $this->description_hi,
            $this->description_gu,
        ])));
    }
}
