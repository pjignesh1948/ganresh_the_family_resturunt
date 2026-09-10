<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'order_no',
        'customer_name',
        'phone',
        'email',
        'address',
        'notes',
        'total_amount',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'total_amount' => 'decimal:2',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Order $order) {
            if (empty($order->order_no)) {
                $order->order_no = static::generateOrderNo();
            }
        });
    }

    public static function generateOrderNo(): string
    {
        do {
            $orderNo = 'ORD-' . now()->format('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
        } while (static::query()->where('order_no', $orderNo)->exists());

        return $orderNo;
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function activityLogs(): HasMany
    {
        return $this->hasMany(OrderActivityLog::class)->orderByDesc('created_at');
    }
}
