<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderActivityLog extends Model
{
    protected $fillable = ['order_id', 'action', 'status', 'note', 'user_id'];

    public static function record(int $orderId, string $action, ?string $status = null, ?string $note = null, ?int $userId = null): void
    {
        static::create([
            'order_id' => $orderId,
            'action' => $action,
            'status' => $status,
            'note' => $note,
            'user_id' => $userId,
        ]);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
