<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $payment->invoice_number ?? '#' . $payment->id }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #333;
            background-color: {{ $isPreview ?? false ? '#f3f4f6' : '#fff' }};
            padding: {{ $isPreview ?? false ? '40px' : '0' }};
        }
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 40px;
            @if($isPreview ?? false)
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            @endif
        }
        .invoice-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
            border-bottom: 2px solid #1e40af;
            padding-bottom: 20px;
        }
        .company-info h1 {
            font-size: 24px;
            color: #1e40af;
            margin-bottom: 5px;
        }
        .company-info p {
            color: #666;
            font-size: 11px;
        }
        .invoice-meta {
            text-align: right;
        }
        .invoice-meta h2 {
            font-size: 28px;
            color: #1e40af;
            margin-bottom: 10px;
        }
        .invoice-meta table {
            margin-left: auto;
        }
        .invoice-meta td {
            padding: 2px 0;
        }
        .invoice-meta td:first-child {
            color: #666;
            padding-right: 15px;
        }
        .invoice-meta td:last-child {
            font-weight: bold;
        }
        .addresses {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .addresses > div {
            width: 48%;
        }
        .addresses h3 {
            font-size: 12px;
            color: #1e40af;
            text-transform: uppercase;
            margin-bottom: 10px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 5px;
        }
        .addresses p {
            color: #666;
            margin-bottom: 3px;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .items-table thead {
            background: #1e40af;
            color: #fff;
        }
        .items-table th {
            padding: 12px 15px;
            text-align: left;
            font-size: 11px;
            text-transform: uppercase;
        }
        .items-table th:last-child,
        .items-table td:last-child {
            text-align: right;
        }
        .items-table th:nth-child(2),
        .items-table td:nth-child(2) {
            text-align: center;
        }
        .items-table tbody tr {
            border-bottom: 1px solid #e5e7eb;
        }
        .items-table tbody tr:nth-child(even) {
            background: #f9fafb;
        }
        .items-table td {
            padding: 12px 15px;
        }
        .totals {
            width: 300px;
            margin-left: auto;
        }
        .totals table {
            width: 100%;
        }
        .totals td {
            padding: 8px 0;
        }
        .totals td:last-child {
            text-align: right;
        }
        .totals tr:last-child {
            border-top: 2px solid #1e40af;
        }
        .totals tr:last-child td {
            font-size: 16px;
            font-weight: bold;
            color: #1e40af;
            padding-top: 12px;
        }
        .payment-info {
            margin-top: 30px;
            padding: 20px;
            background: #f0f9ff;
            border-radius: 8px;
            border-left: 4px solid #1e40af;
        }
        .payment-info h3 {
            font-size: 12px;
            color: #1e40af;
            text-transform: uppercase;
            margin-bottom: 10px;
        }
        .payment-info table td {
            padding: 3px 0;
        }
        .payment-info table td:first-child {
            color: #666;
            padding-right: 15px;
        }
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            color: #666;
            font-size: 11px;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .status-completed {
            background: #dcfce7;
            color: #166534;
        }
        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }
        @if($isPreview ?? false)
        .download-btn {
            display: block;
            text-align: center;
            margin-top: 30px;
        }
        .download-btn a {
            display: inline-block;
            background: #1e40af;
            color: #fff;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }
        .download-btn a:hover {
            background: #1e3a8a;
        }
        @endif
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <div class="company-info">
                <h1>{{ config('app.name', 'E-Commerce Store') }}</h1>
                <p>Your trusted online shopping destination</p>
                <p>Nepal</p>
            </div>
            <div class="invoice-meta">
                <h2>INVOICE</h2>
                <table>
                    <tr>
                        <td>Invoice No:</td>
                        <td>{{ $payment->invoice_number ?? 'INV-' . str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}</td>
                    </tr>
                    <tr>
                        <td>Date:</td>
                        <td>{{ $payment->paid_at ? $payment->paid_at->format('M d, Y') : now()->format('M d, Y') }}</td>
                    </tr>
                    <tr>
                        <td>Order ID:</td>
                        <td>#{{ $order->id }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="addresses">
            <div>
                <h3>Billed To</h3>
                <p><strong>{{ $order->user->name }}</strong></p>
                <p>{{ $order->user->email }}</p>
                @if($order->address)
                    <p>{{ $order->address->street_address_1 }}</p>
                    @if($order->address->street_address_2)
                        <p>{{ $order->address->street_address_2 }}</p>
                    @endif
                    <p>{{ $order->address->city }}, {{ $order->address->state }}</p>
                    <p>{{ $order->address->country }}</p>
                @endif
            </div>
            <div>
                <h3>Payment Information</h3>
                <p><strong>Method:</strong> {{ ucfirst($payment->payment_method->value) }}</p>
                <p><strong>Status:</strong> 
                    <span class="status-badge status-{{ $payment->status->value }}">
                        {{ ucfirst($payment->status->value) }}
                    </span>
                </p>
                @if($payment->transaction_code)
                    <p><strong>Transaction ID:</strong></p>
                    <p style="font-family: monospace; font-size: 10px;">{{ $payment->transaction_code }}</p>
                @endif
            </div>
        </div>

        <table class="items-table">
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
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>NPR {{ number_format($item->amount_per_item, 2) }}</td>
                        <td>NPR {{ number_format($item->amount_per_item * $item->quantity, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="totals">
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td>NPR {{ number_format($order->orderItems->sum(fn($i) => $i->amount_per_item * $i->quantity), 2) }}</td>
                </tr>
                @if($order->discount_amount > 0)
                    <tr>
                        <td>Discount</td>
                        <td>- NPR {{ number_format($order->discount_amount, 2) }}</td>
                    </tr>
                @endif
                <tr>
                    <td>Tax</td>
                    <td>NPR {{ number_format($order->tax_amount, 2) }}</td>
                </tr>
                @if($order->service_charge > 0)
                    <tr>
                        <td>Service Charge</td>
                        <td>NPR {{ number_format($order->service_charge, 2) }}</td>
                    </tr>
                @endif
                @if($order->delivery_charge > 0)
                    <tr>
                        <td>Delivery Charge</td>
                        <td>NPR {{ number_format($order->delivery_charge, 2) }}</td>
                    </tr>
                @endif
                <tr>
                    <td>Total Amount</td>
                    <td>NPR {{ number_format($order->total, 2) }}</td>
                </tr>
            </table>
        </div>

        <div class="footer">
            <p>Thank you for your purchase!</p>
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'E-Commerce Store') }}. All rights reserved.</p>
        </div>

        @if($isPreview ?? false)
            <div class="download-btn">
                <a href="{{ route('invoices.download', $payment->id) }}">
                    <i class="fas fa-download"></i> Download PDF
                </a>
            </div>
        @endif
    </div>
</body>
</html>
