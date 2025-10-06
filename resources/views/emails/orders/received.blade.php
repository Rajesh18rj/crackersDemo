@component('mail::message')
    # New Order Received

    A new order has been placed.

    **Order ID:** {{ $order->id }}
    **Customer:** {{ $order->first_name }} {{ $order->last_name }}
    **Phone:** {{ $order->phone }}
    **Email:** {{ $order->email ?? 'N/A' }}
    **Total:** ₹{{ number_format($order->subtotal, 2) }}


    Thanks,
    Niyaa Crackers World
@endcomponent
