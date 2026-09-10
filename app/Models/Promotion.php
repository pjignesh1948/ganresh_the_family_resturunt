<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = ['title', 'image', 'link', 'is_active', 'show_once'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean', 'show_once' => 'boolean'];
    }
}
