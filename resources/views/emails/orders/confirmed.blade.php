<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Confirmed</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #1e40af;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            background-color: #f9fafb;
            padding: 20px;
            border: 1px solid #e5e7eb;
            border-top: none;
            border-radius: 0 0 8px 8px;
        }
        .order-details {
            margin-top: 20px;
            background-color: white;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .table th, .table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        .table th {
            background-color: #f3f4f6;
        }
        .total-row {
            font-weight: bold;
            background-color: #f9fafb;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #6b7280;
        }
        .btn {
            display: inline-block;
            background-color: #1e40af;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Order Confirmed!</h1>
        </div>
        <div class="content">
            <p>Hello {{ $order->user->name }},</p>
            <p>Great news! Your order <strong>#{{ $order->id }}</strong> has been confirmed and is now being processed.</p>
            
            <div class="order-details">
                <h3>Order Summary</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderItems as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>NPR {{ number_format($item->amount_per_item, 2) }}</td>
                            <td>NPR {{ number_format($item->amount_per_item * $item->quantity, 2) }}</td>
                        </tr>
                        @endforeach
                        
                        <tr>
                            <td colspan="3" style="text-align: right;">Subtotal:</td>
                            <td>NPR {{ number_format($order->orderItems->sum(fn($i) => $i->amount_per_item * $i->quantity), 2) }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: right;">Tax:</td>
                            <td>NPR {{ number_format($order->tax_amount, 2) }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: right;">Delivery:</td>
                            <td>NPR {{ number_format($order->delivery_charge, 2) }}</td>
                        </tr>
                        <tr class="total-row">
                            <td colspan="3" style="text-align: right;">Total Amount:</td>
                            <td>NPR {{ number_format($order->total, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="order-details">
                <h3>Shipping Address</h3>
                <p>
                    {{ $order->address->street_address_1 }}<br>
                    @if($order->address->street_address_2)
                        {{ $order->address->street_address_2 }}<br>
                    @endif
                    {{ $order->address->city }}, {{ $order->address->state }}<br>
                    {{ $order->address->country }}
                </p>
            </div>

            <div style="text-align: center;">
                <a href="{{ route('user.orders.show', $order->id) }}" class="btn">View Order Details</a>
            </div>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
