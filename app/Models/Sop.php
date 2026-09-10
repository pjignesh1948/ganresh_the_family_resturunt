<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sop extends Model
{
    protected $fillable = [
        'title',
        'category',
        'content',
        'document',
        'version',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}
