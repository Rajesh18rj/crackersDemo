<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Order #{{ $order->id }} Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            color: #1f2937; /* gray-800 */
        }
        h1 {
            color: #b91c1c; /* red-600 */
            margin-bottom: 16px;
        }
        p {
            margin: 4px 0;
        }
        .label {
            font-weight: 700;
            color: #111827; /* gray-900 */
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 24px;
            border: 1px solid #d1d5db; /* gray-300 */
        }
        thead {
            background-color: #b91c1c; /* red-600 */
            color: white;
            text-transform: uppercase;
            font-weight: 600;
            font-size: 12px;
        }
        th, td {
            border: 1px solid #d1d5db; /* gray-300 */
            padding: 8px 12px;
        }
        th {
            text-align: left;
        }
        td {
            text-align: right;
        }
        td.product-name, th.product-name {
            text-align: left;
        }
        tfoot td {
            background-color: #fee2e2; /* red-100 */
            font-weight: 700;
        }
        tfoot td:last-child {
            color: #b91c1c; /* red-600 */
        }
        .no-items {
            color: #6b7280; /* gray-500 */
            font-style: italic;
            text-align: center;
            padding: 16px;
        }
    </style>
</head>
<body>

<h1>Order #{{ $order->id }}</h1>

<p><span class="label">Customer:</span> {{ $order->first_name }} {{ $order->last_name }}</p>
<p><span class="label">Email:</span> {{ $order->email ?? '-' }}</p>
<p><span class="label">Phone:</span> {{ $order->phone ?? '-' }}</p>
<p><span class="label">Status:</span> {{ ucfirst($order->status ?? 'N/A') }}</p>
<p><span class="label">Total:</span> ₹{{ number_format($order->subtotal, 2) }}</p>

<h2>Order Items</h2>
<table>
    <thead>
    <tr>
        <th class="product-name">Product</th>
        <th>Quantity</th>
        <th>Price (₹)</th>
        <th>Total (₹)</th>
    </tr>
    </thead>
    <tbody>
    @php
        $grandTotal = 0;
        $hasItems = false;
    @endphp

    @foreach($order->items as $item)
        @if($item->quantity >= 1)
            @php
                $lineTotal = $item->total ?? ($item->price * $item->quantity);
                $grandTotal += $lineTotal;
                $hasItems = true;
            @endphp
            <tr>
                <td class="product-name">{{ $item->product->name ?? 'Deleted Product' }}</td>
                <td>{{ $item->quantity }}</td>
                <td>₹{{ number_format($item->price, 2) }}</td>
                <td>₹{{ number_format($lineTotal, 2) }}</td>
            </tr>
        @endif
    @endforeach

    @if(!$hasItems)
        <tr>
            <td colspan="4" class="no-items">No items found</td>
        </tr>
    @endif
    </tbody>


</table>

@if($hasItems)

<div style="margin-top: 10px; text-align: right; font-weight: bold;">
    Grand Total: ₹{{ number_format($grandTotal, 2) }}
</div>
@endif

<script>
    window.onload = function() {
        window.print();
    };
</script>

</body>
</html>
