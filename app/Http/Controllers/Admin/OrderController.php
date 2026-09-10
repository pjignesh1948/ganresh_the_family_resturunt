<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderActivityLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public const STATUSES = [
        'pending',
        'confirmed',
        'preparing',
        'ready',
        'delivered',
        'cancelled',
    ];

    public function index(Request $request): View
    {
        $orders = Order::query()
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')))
            ->latest()
            ->get();

        return view('admin.orders.index', [
            'orders' => $orders,
            'statuses' => self::STATUSES,
        ]);
    }

    public function show(Order $order): View
    {
        $order->load(['orderItems.menuItem', 'activityLogs']);

        return view('admin.orders.show', [
            'order' => $order,
            'statuses' => self::STATUSES,
        ]);
    }

    public function updateStatus(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'string', 'in:' . implode(',', self::STATUSES)],
        ]);

        $previous = $order->status;
        $order->update($validated);

        OrderActivityLog::record(
            $order->id,
            'status_updated',
            $order->status,
            "Status changed from {$previous} to {$order->status}",
            auth()->id()
        );

        return redirect()
            ->route('admin.orders.show', $order)
            ->with('success', 'Order status updated successfully.');
    }

    public function pollNew(Request $request)
    {
        $afterId = (int) $request->input('after', 0);

        $latestId = (int) Order::query()->max('id');

        $newOrders = Order::query()
            ->where('id', '>', $afterId)
            ->where('status', 'pending')
            ->latest('id')
            ->limit(10)
            ->get(['id', 'order_no', 'customer_name', 'phone', 'total_amount', 'created_at']);

        return response()->json([
            'latest_id' => $latestId,
            'pending_count' => Order::where('status', 'pending')->count(),
            'orders' => $newOrders->map(fn (Order $o) => [
                'id' => $o->id,
                'order_no' => $o->order_no,
                'customer_name' => $o->customer_name,
                'phone' => $o->phone,
                'total' => number_format((float) $o->total_amount, 2),
                'created_at' => $o->created_at->format('h:i A'),
            ]),
        ]);
    }
}
