<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payment Received</title>
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
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
        }
        .header .icon {
            font-size: 48px;
            margin-bottom: 10px;
        }
        .content {
            background-color: #f9fafb;
            padding: 30px 20px;
            border: 1px solid #e5e7eb;
            border-top: none;
            border-radius: 0 0 8px 8px;
        }
        .greeting {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .payment-summary {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            margin: 20px 0;
        }
        .payment-summary h3 {
            margin-top: 0;
            color: #1e40af;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 10px;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #f3f4f6;
        }
        .summary-row:last-child {
            border-bottom: none;
        }
        .summary-row.total {
            font-weight: bold;
            font-size: 16px;
            color: #1e40af;
            border-top: 2px solid #e5e7eb;
            padding-top: 12px;
            margin-top: 8px;
        }
        .success-badge {
            display: inline-block;
            background: #dcfce7;
            color: #166534;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }
        .btn {
            display: inline-block;
            background-color: #1e40af;
            color: white !important;
            padding: 14px 28px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            margin: 10px 5px;
        }
        .btn-secondary {
            background-color: #6b7280;
        }
        .buttons {
            text-align: center;
            margin-top: 25px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            font-size: 12px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
        }
        .attachment-note {
            background: #eff6ff;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            border-left: 4px solid #1e40af;
        }
        .attachment-note strong {
            color: #1e40af;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="icon">✓</div>
            <h1>Payment Received!</h1>
        </div>
        <div class="content">
            <p class="greeting">Hello {{ $payment->order->user->name }},</p>
            
            <p>Great news! We have received your payment for Order <strong>#{{ $payment->order->id }}</strong>.</p>
            
            <div class="payment-summary">
                <h3>Payment Details</h3>
                <div class="summary-row">
                    <span>Invoice Number</span>
                    <span>{{ $payment->invoice_number ?? 'INV-' . str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="summary-row">
                    <span>Payment Method</span>
                    <span>{{ ucfirst($payment->payment_method->value) }}</span>
                </div>
                <div class="summary-row">
                    <span>Payment Date</span>
                    <span>{{ $payment->paid_at ? $payment->paid_at->format('M d, Y h:i A') : now()->format('M d, Y h:i A') }}</span>
                </div>
                <div class="summary-row">
                    <span>Status</span>
                    <span class="success-badge">Completed</span>
                </div>
                <div class="summary-row total">
                    <span>Total Amount</span>
                    <span>NPR {{ number_format($payment->order->total, 2) }}</span>
                </div>
            </div>

            <div class="attachment-note">
                <strong>📎 Invoice Attached</strong><br>
                Your invoice is attached to this email as a PDF file. You can download and save it for your records.
            </div>

            <div class="buttons">
                <a href="{{ route('user.orders.show', $payment->order->id) }}" class="btn">View Order</a>
            </div>
            
            <p style="margin-top: 25px;">Thank you for shopping with us!</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <p>If you have any questions, please contact our support team.</p>
        </div>
    </div>
</body>
</html>
