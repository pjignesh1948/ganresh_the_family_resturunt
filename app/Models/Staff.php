<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Staff extends Model
{
    protected $table = 'staff';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'role',
        'joining_date',
        'monthly_salary',
        'is_active',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'joining_date' => 'date',
            'monthly_salary' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function salaryTransactions(): HasMany
    {
        return $this->hasMany(SalaryTransaction::class);
    }
}
