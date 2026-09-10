<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerReview extends Model
{
    protected $fillable = [
        'reviewer_name',
        'rating',
        'food_rating',
        'service_rating',
        'atmosphere_rating',
        'comment',
        'source',
        'reviewed_ago',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'rating' => 'integer',
            'food_rating' => 'integer',
            'service_rating' => 'integer',
            'atmosphere_rating' => 'integer',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }
}
