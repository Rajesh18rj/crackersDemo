<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
</head>
<body>
<h2>Thank you, {{ $order->first_name }}!</h2>
<p>Your order has been confirmed successfully.</p>
<p><strong>Order ID:</strong> {{ $order->id }}</p>
<p>Total Amount: ₹{{ number_format($order->total, 2) }}</p>

<br>
<p>We will contact you soon with further details.</p>
<p>NIYAA CRACKERS SHOP</p>
</body>
</html>

