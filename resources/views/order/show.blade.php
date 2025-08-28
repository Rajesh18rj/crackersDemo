@extends('components.layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto px-6 py-8 bg-white rounded-lg shadow-lg mt-10">

        <h1 class="text-3xl font-bold text-red-600 mb-8 flex items-center">
            <i class="fas fa-box-open mr-3"></i> Order #{{ $order->id }}
        </h1>

        <div class="space-y-4 text-gray-800">

            <p>
                <span class="font-semibold text-gray-900">Customer:</span>
                {{ $order->first_name }} {{ $order->last_name }}
            </p>

            <p>
                <span class="font-semibold text-gray-900">Email:</span>
                {{ $order->email ?? '-' }}
            </p>

            <p>
                <span class="font-semibold text-gray-900">Phone:</span>
                {{ $order->phone ?? '-' }}
            </p>

            <p>
                <span class="font-semibold text-gray-900">Status:</span>
                <span
                    class="inline-block px-3 py-1 rounded-full text-xs font-semibold
            {{ $order->status == 'new' ? 'bg-yellow-100 text-yellow-700' : '' }}
            {{ $order->status == 'processing' ? 'bg-orange-100 text-orange-700' : '' }}
            {{ $order->status == 'shipped' ? 'bg-blue-100 text-blue-700' : '' }}
            {{ $order->status == 'completed' ? 'bg-green-100 text-green-700' : '' }}
            {{ $order->status == 'cancelled' ? 'bg-red-100 text-red-700' : '' }}
            {{ !$order->status ? 'bg-gray-100 text-gray-700' : '' }}">
            {{ ucfirst($order->status ?? 'N/A') }}
        </span>
            </p>

            <p>
                <span class="font-semibold text-gray-900">Packing Charges:</span>
                <span class="text-red-600 font-bold">
            ₹{{ number_format($order->packing_charges, 2) }}
        </span>
            </p>

            <p>
                <span class="font-semibold text-gray-900">Total:</span>
                <span class="text-red-600 font-bold">
            ₹{{ number_format($order->total, 2) }}
        </span>
            </p>
        </div>


        <h2 class="mt-10 mb-4 text-xl font-bold text-red-600 flex items-center">
            <i class="fas fa-list mr-2"></i> Order Items
        </h2>

        <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
            <table class="min-w-full divide-y divide-gray-200 table-auto">
                <thead class="bg-red-600 text-white uppercase text-xs font-semibold">
                <tr>
                    <th class="px-4 py-3 text-left">Product</th>
                    <th class="px-4 py-3 text-center">Quantity</th>
                    <th class="px-4 py-3 text-right">Price (₹)</th>
                    <th class="px-4 py-3 text-right">Total (₹)</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                @php $grandTotal = 0; @endphp
                @foreach($order->items as $item)
                    @php $grandTotal += $item->total; @endphp
                    <tr>
                        <td class="px-4 py-3">{{ $item->product->name ?? 'Deleted Product' }}</td>
                        <td class="px-4 py-3 text-center">{{ $item->quantity }}</td>
                        <td class="px-4 py-3 text-right">{{ number_format($item->price, 2) }}</td>
                        <td class="px-4 py-3 text-right">{{ number_format($item->total, 2) }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="px-4 py-3 text-right font-bold bg-red-50 border-t-2 border-red-200">Grand Total</td>
                    <td class="px-4 py-3 text-right text-red-600 font-extrabold bg-red-50 border-t-2 border-red-200">
                        ₹{{ number_format($grandTotal, 2) }}
                    </td>
                </tr>
                </tfoot>
            </table>

        </div>

        <div class="mt-6">
            <a href="{{ route('admin1.orders.index') }}"
               class="inline-flex items-center px-5 py-3 bg-gray-200 text-gray-700 rounded shadow hover:bg-gray-300 transition">
                <i class="fas fa-arrow-left mr-2"></i> Back to Orders
            </a>
        </div>
    </div>
@endsection
