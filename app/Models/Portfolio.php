<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'event_date',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }
}
