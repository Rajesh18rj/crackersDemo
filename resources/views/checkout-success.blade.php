@extends('components.layouts.new-layout')

@section('content')
    <div>
        <div class="relative bg-gradient-to-r from-red-700 to-white py-10 mb-6 rounded-lg shadow-md text-center">
            <div class="flex flex-col items-center space-y-4 max-w-xl mx-auto text-red-700">
                <!-- Smaller green round circle with white tick -->
                <span class="fa-stack fa-2x">
            <i class="fas fa-circle fa-stack-2x text-green-500"></i>  <!-- Green circle -->
            <i class="fas fa-check fa-stack-1x text-white"></i>       <!-- White tick mark -->
        </span>

                <!-- Header -->
                <h1 class="text-4xl font-bold">Order Completed</h1>

                <!-- Back link -->
                <a href="/quick-order"
                   class="inline-block text-red-700 hover:text-red-900 font-semibold transition-colors duration-200 underline">
                    &larr; Back to Quick Order
                </a>
            </div>
        </div>


        <div class="max-w-3xl mx-auto bg-white shadow rounded p-8 mt-10">

            <!-- Thank You -->
            <div class="mb-6 text-center border border-green-500 bg-green-50 p-4 rounded">
                <span class="text-green-700">Thank you. Your order has been received.</span>
            </div>

            <!-- Order Info -->
            <div class="grid grid-cols-1 md:grid-cols-4 border border-gray-200 divide-y md:divide-y-0 md:divide-x text-sm mb-8">
                <div class="p-3">
                    <div class="text-gray-600">Order number:</div>
                    <div class="font-medium">{{ $order->id }}</div>
                </div>
                <div class="p-3">
                    <div class="text-gray-600">Date:</div>
                    <div class="font-medium">{{ $order->created_at->format('F d, Y') }}</div>
                </div>
                <div class="p-3">
                    <div class="text-gray-600">Total:</div>
                    <div class="font-medium">₹{{ number_format($order->subtotal, 2) }}</div>
                </div>
                <div class="p-3">
                    <div class="text-gray-600">Payment method:</div>
                    <div class="font-medium">Direct bank transfer</div>
                </div>
            </div>

            <!-- Bank Details -->
            <div class="mb-8">
                <div class="font-semibold">OUR BANK DETAILS</div>
                <div class="text-sm text-gray-700 mb-2">CRACKER TRADERS:</div>

                <div class="grid grid-cols-1 md:grid-cols-3 border border-gray-200 divide-y md:divide-y-0 md:divide-x text-sm">
                    <div class="p-3">
                        <div class="text-gray-600">Bank:</div>
                        <div class="font-medium">DEMO BANK</div>
                    </div>
                    <div class="p-3">
                        <div class="text-gray-600">Account number:</div>
                        <div class="font-medium">1234567890</div>
                    </div>
                    <div class="p-3">
                        <div class="text-gray-600">IFSC:</div>
                        <div class="font-medium">DEMO123</div>
                    </div>
                </div>
            </div>
            <!-- Order Details -->
            <div class="mb-6">
                <div class="font-semibold mb-2">ORDER DETAILS</div>
                <table class="w-full text-sm mb-6">
                    <thead>
                    <tr class="border-b">
                        <th class="text-left py-2">PRODUCT</th>
                        <th class="text-right py-2">TOTAL</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->items as $item)
                        @if($item->quantity > 0)
                            <tr class="border-b">
                                <td class="py-2">{{ $item->product->name }} × {{ $item->quantity }}</td>
                                <td class="py-2 text-right">₹{{ number_format($item->total, 2) }}</td>
                            </tr>
                        @endif
                    @endforeach

                    <tr class="border-b">
                        <td class="py-2 font-semibold">Payment method:</td>
                        <td class="py-2 text-right">Direct bank transfer</td>
                    </tr>

                    <tr class="border-b">
                        <td class="py-2 font-semibold">Total:</td>
                        <td class="py-2 text-right">₹{{ number_format($order->subtotal, 2) }}</td>
                    </tr>
{{--                    <tr class="border-b">--}}
{{--                        <td class="py-2 font-semibold">Shipping:</td>--}}
{{--                        <td class="py-2 text-right">Paid by Transport Office</td>--}}
{{--                    </tr>--}}

{{--                    <tr class="border-b">--}}
{{--                        <td class="py-2 font-semibold">Packing Charges 3% extra:</td>--}}
{{--                        <td class="py-2 text-right">₹{{ number_format($order->packing_charges, 2) }}</td>--}}
{{--                    </tr>--}}

{{--                    <tr>--}}
{{--                        <td class="py-2 font-semibold">Total:</td>--}}
{{--                        <td class="py-2 text-right font-bold">₹{{ number_format($order->total, 2) }}</td>--}}
{{--                    </tr>--}}
                    </tbody>
                </table>

                <div class="mb-8">
                    <span class="font-semibold">NOTE:</span> {{ $order->notes ?? '-' }}
                </div>
            </div>

            <!-- Billing Address -->
            <div class="mt-8">
                <div class="font-semibold mb-3">BILLING ADDRESS</div>

                <div class="border border-gray-200 rounded p-4 text-sm">
                    <div class="mb-2">
                        <span class="text-gray-600">Name:</span>
                        <span class="font-medium">{{ $order->first_name }} {{ $order->last_name }}</span>
                    </div>
                    <div class="mb-2">
                        <span class="text-gray-600">Address:</span>
                        <span class="font-medium">{{ $order->street_address }}</span>
                    </div>
                    <div class="mb-2">
                        <span class="text-gray-600">City/State:</span>
                        <span class="font-medium">{{ $order->city }}, {{ $order->state }} - {{ $order->pincode }}</span>
                    </div>
                    <div class="mb-2">
                        <span class="text-gray-600">Country:</span>
                        <span class="font-medium">{{ $order->country }}</span>
                    </div>
                    <div class="mb-2">
                        <span class="text-gray-600">Phone:</span>
                        <span class="font-medium">{{ $order->phone }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Email:</span>
                        <span class="font-medium">{{ $order->email }}</span>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
