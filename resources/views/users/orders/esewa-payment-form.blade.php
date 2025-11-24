<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting to eSewa</title>
</head>

<body>
    @php

        // Test with EXACT values from eSewa documentation
        // $total_amount = 100;
        // $transaction_uuid = '11-201-13';
        // $product_code = 'EPAYTEST';

        // // Try the exact secret key as shown in documentation
        // $secret_key = '8gBm/:&EnhH.1/q';

        // $string_to_sign = 'total_amount=100,transaction_uuid=11-201-13,product_code=EPAYTEST';
        // $signature = base64_encode(hash_hmac('sha256', $string_to_sign, $secret_key, true));

        // echo "Testing with secret key WITHOUT trailing ( :\n";
        // echo 'Secret key: ' . $secret_key . "\n";
        // echo 'String to sign: ' . $string_to_sign . "\n";
        // echo 'Generated signature: ' . $signature . "\n";
        // echo "Expected signature: 4Ov7pCI1zIOdwtV2BRMUNjz1upIlT/COTxfLhWvVurE=\n";
        // echo 'Match: ' . ($signature === '4Ov7pCI1zIOdwtV2BRMUNjz1upIlT/COTxfLhWvVurE=' ? 'YES' : 'NO') . "\n\n";

        // // Try without the field names (just values)
        // $string_to_sign2 = '100,11-201-13,EPAYTEST';
        // $signature2 = base64_encode(hash_hmac('sha256', $string_to_sign2, $secret_key, true));

        // echo "Testing with just values (no field names):\n";
        // echo 'String to sign: ' . $string_to_sign2 . "\n";
        // echo 'Generated signature: ' . $signature2 . "\n";
        // echo 'Match: ' . ($signature2 === '4Ov7pCI1zIOdwtV2BRMUNjz1upIlT/COTxfLhWvVurE=' ? 'YES' : 'NO') . "\n\n";

        // // Try with your values using the corrected secret key
        // $total_amount3 = 1;
        // $transaction_uuid3 = '6923ce337acf3';
        // $product_code3 = 'EPAYTEST';

        // $string_to_sign3 = 'total_amount=1,transaction_uuid=6923ce337acf3,product_code=EPAYTEST';
        // $signature3 = base64_encode(hash_hmac('sha256', $string_to_sign3, $secret_key, true));

        // echo "Testing Your Values with corrected secret key:\n";
        // echo 'String to sign: ' . $string_to_sign3 . "\n";
        // echo 'Generated signature: ' . $signature3 . "\n";
    @endphp

    <form id="esewaForm" action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">
        <input type="hidden" name="amount" value="{{ $amount }}">
        <input type="hidden" name="tax_amount" value="{{ $tax_amount }}">
        <input type="hidden" name="total_amount" value="{{ $total_amount }}">
        <input type="hidden" name="transaction_uuid" value="{{ $transaction_uuid }}">
        <input type="hidden" name="product_code" value="{{ $product_code }}">
        <input type="hidden" name="product_service_charge" value="{{ $product_service_charge }}">
        <input type="hidden" name="product_delivery_charge" value="{{ $product_delivery_charge }}">
        <input type="hidden" name="success_url" value="{{ $success_url }}">
        <input type="hidden" name="failure_url" value="{{ $failure_url }}">
        <input type="hidden" name="signed_field_names" value="{{ $signed_field_names }}">
        <input type="hidden" name="signature" value="{{ $signature }}">
    </form>

    <script>
        document.getElementById('esewaForm').submit();
    </script>

    <div style="text-align: center; margin-top: 50px;">
        <h3>Redirecting to eSewa Payment Gateway...</h3>
        <p>If you are not redirected automatically, click the button below:</p>
        <button onclick="document.getElementById('esewaForm').submit()">Proceed to eSewa</button>
    </div>
</body>

</html>
