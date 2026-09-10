<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalaryTransaction extends Model
{
    public const TYPE_SALARY = 'salary';

    public const TYPE_ADVANCE = 'advance';

    protected $fillable = [
        'staff_id',
        'type',
        'amount',
        'transaction_date',
        'month',
        'year',
        'note',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'transaction_date' => 'date',
            'month' => 'integer',
            'year' => 'integer',
        ];
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }
}
