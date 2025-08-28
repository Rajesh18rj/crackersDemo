@extends('components.layouts.new-layout')

@section('content')

    {{-- Header --}}
    <div class="relative bg-gradient-to-r from-blue-700 to-orange-500 py-10 mb-6">
        <div class="text-center text-white">
            <h1 class="text-4xl font-bold">Checkout Page</h1>
        </div>
    </div>

    <form action="{{ route('checkout.place') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-6xl mx-auto p-6">
        @csrf

        {{-- Left: Billing & Shipping --}}
        <div class="bg-white p-6 shadow rounded">
            <h2 class="text-xl font-bold mb-4">Billing & Shipping</h2>

            {{-- Cart validation --}}
            @error('cart')
            <div class="mb-3 text-red-600">{{ $message }}</div>
            @enderror

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label>First name*</label>
                    <input type="text" name="first_name" value="{{ old('first_name') }}"
                           class="w-full border rounded p-2 focus:ring focus:ring-blue-300">
                    @error('first_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label>Last name</label>
                    <input type="text" name="last_name" value="{{ old('last_name') }}"
                           class="w-full border rounded p-2 focus:ring focus:ring-blue-300">
                </div>
            </div>

            <div class="mt-3">
                <label>Country / Region*</label>
                <input type="text" name="country" value="India" readonly
                       class="w-full border rounded p-2 bg-gray-100">
            </div>

            <div class="mt-3">
                <label>Street address*</label>
                <input type="text" name="street_address" value="{{ old('street_address') }}"
                       class="w-full border rounded p-2 focus:ring focus:ring-blue-300">
                @error('street_address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mt-3">
                <label>Town / City*</label>
                <input type="text" name="city" value="{{ old('city') }}"
                       class="w-full border rounded p-2 focus:ring focus:ring-blue-300">
                @error('city') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mt-3">
                <label>State*</label>
                <input type="text" name="state" value="{{ old('state') }}"
                       class="w-full border rounded p-2 focus:ring focus:ring-blue-300">
                @error('state') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mt-3">
                <label>PIN Code*</label>
                <input type="text" name="pincode" value="{{ old('pincode') }}"
                       class="w-full border rounded p-2 focus:ring focus:ring-blue-300">
                @error('pincode') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mt-3">
                <label>Phone*</label>
                <input type="text" name="phone" value="{{ old('phone') }}"
                       class="w-full border rounded p-2 focus:ring focus:ring-blue-300">
                @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mt-3">
                <label>Email address</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="w-full border rounded p-2 focus:ring focus:ring-blue-300">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mt-6">
                <label>Additional information</label>
                <textarea name="notes" rows="4"
                          class="w-full border rounded p-2 focus:ring focus:ring-blue-300"
                          placeholder="Notes about your order">{{ old('notes') }}</textarea>
            </div>
        </div>

        {{-- Right: Order Summary --}}
        <div class="bg-white p-6 shadow rounded">
            <h2 class="text-xl font-bold mb-4">Your Order</h2>

            <table class="w-full mb-4">
                <thead>
                <tr class="border-b">
                    <th class="text-left p-2">Product</th>
                    <th class="text-right p-2">Subtotal</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $filteredCart = array_filter($cart, function($item) {
                        return $item['quantity'] > 0;
                    });
                @endphp

                @forelse($filteredCart as $item)
                    <tr class="border-b">
                        <td class="p-2">{{ $item['name'] }} × {{ $item['quantity'] }}</td>
                        <td class="p-2 text-right">₹{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="p-4 text-center text-red-600 bg-red-100 font-semibold">
                            Your Cart is Empty..
                        </td>
                    </tr>
                @endforelse

                </tbody>
            </table>

            <div class="space-y-1 text-right">
                <p><b>Subtotal:</b> ₹{{ number_format($subtotal, 2) }}</p>
                <p><b>Shipping:</b> Paid by Transport Office</p>
                <p><b>Packing Charges 3% extra:</b> ₹{{ number_format($packing, 2) }}</p>
                <p class="text-lg font-bold"><b>Total:</b> ₹{{ number_format($total, 2) }}</p>
            </div>

            <div class="mt-6 border p-3 rounded bg-gray-50 text-sm">
                <p class="font-semibold mb-2">Direct bank transfer</p>
                <p>Make your payment directly into our bank account. Please use your Order ID as the
                    payment reference. Your order will not be shipped until the funds have cleared.</p>
            </div>

            <label class="flex items-center gap-2 mt-4 text-sm">
                <input type="checkbox" name="agree" {{ old('agree') ? 'checked' : '' }}>
                <span>I have read and agree to the website terms and conditions.</span>
            </label>
            @error('agree') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror

            <button type="submit" class="w-full mt-5 bg-purple-600 text-white py-3 rounded hover:bg-green-700 disabled:opacity-50">
                PLACE ORDER
            </button>

            @if (session('success'))
                <div class="mt-4 p-3 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </form>


@endsection
