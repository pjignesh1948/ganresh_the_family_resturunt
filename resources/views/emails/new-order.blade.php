<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .header { background: #7B1113; color: #fff; padding: 20px; text-align: center; }
        .content { padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #f5f5f5; }
        .total { font-size: 18px; font-weight: bold; color: #7B1113; }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin:0;">New Online Order</h1>
        <p style="margin:5px 0 0;">Ganesh The Family Restaurant</p>
    </div>
    <div class="content">
        <p><strong>Order #:</strong> {{ $order->order_no }}</p>
        <p><strong>Date:</strong> {{ $order->created_at->format('M d, Y h:i A') }}</p>
        <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>

        <h3>Customer Details</h3>
        <p>
            <strong>Name:</strong> {{ $order->customer_name }}<br>
            <strong>Phone:</strong> {{ $order->phone }}<br>
            @if($order->email)<strong>Email:</strong> {{ $order->email }}<br>@endif
            @if($order->address)<strong>Address:</strong> {{ $order->address }}<br>@endif
            @if($order->notes)<strong>Notes:</strong> {{ $order->notes }}@endif
        </p>

        <h3>Order Items</h3>
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems as $item)
                    <tr>
                        <td>{{ $item->item_name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>₹{{ number_format($item->unit_price, 2) }}</td>
                        <td>₹{{ number_format($item->line_total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p class="total">Grand Total: ₹{{ number_format($order->total_amount, 2) }}</p>
    </div>
</body>
</html>
