<div>
    {{-- Header --}}
    <div class="relative bg-gradient-to-r from-blue-700 to-orange-500 py-10 mb-6">
        <div class="text-center text-white">
            <h1 class="text-4xl font-bold">Checkout Page</h1>
            <div class="mt-2">
                <a href="/quick-purchase" class="hover:underline"> &larr; Back</a>
                <span class="mx-2">/</span>
                <span>Checkout</span>
            </div>
        </div>
    </div>

    {{-- Checkout Form --}}
    <form wire:submit.prevent="placeOrder" class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-6xl mx-auto p-6">

        {{-- Left: Billing & Shipping --}}
        <div class="bg-white p-6 shadow rounded">
            <h2 class="text-xl font-bold mb-4">Billing & Shipping</h2>

            {{-- If cart validation fails --}}
            @error('cart')
            <div class="mb-3 text-red-600">{{ $message }}</div>
            @enderror

            {{-- First & Last Name --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block">First name*</label>
                    <input type="text" wire:model.defer="first_name"
                           class="w-full border rounded p-2 focus:ring focus:ring-blue-300">
                    @error('first_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block">Last name</label>
                    <input type="text" wire:model.defer="last_name"
                           class="w-full border rounded p-2 focus:ring focus:ring-blue-300">
                </div>
            </div>

            {{-- Country --}}
            <div class="mt-3">
                <label class="block">Country / Region*</label>
                <input type="text" wire:model="country" readonly
                       class="w-full border rounded p-2 bg-gray-100">
                @error('country') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Street --}}
            <div class="mt-3">
                <label class="block">Street address*</label>
                <input type="text" wire:model.defer="street_address"
                       class="w-full border rounded p-2 focus:ring focus:ring-blue-300">
                @error('street_address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- City --}}
            <div class="mt-3">
                <label class="block">Town / City*</label>
                <input type="text" wire:model.defer="city"
                       class="w-full border rounded p-2 focus:ring focus:ring-blue-300">
                @error('city') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- State --}}
            <div class="mt-3">
                <label class="block">State*</label>
                <input type="text" wire:model.defer="state"
                       class="w-full border rounded p-2 focus:ring focus:ring-blue-300">
                @error('state') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- PIN Code --}}
            <div class="mt-3">
                <label class="block">PIN Code*</label>
                <input type="text" wire:model.defer="pincode"
                       class="w-full border rounded p-2 focus:ring focus:ring-blue-300">
                @error('pincode') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Phone --}}
            <div class="mt-3">
                <label class="block">Phone*</label>
                <input type="text" wire:model.defer="phone"
                       class="w-full border rounded p-2 focus:ring focus:ring-blue-300">
                @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Email --}}
            <div class="mt-3">
                <label class="block">Email address</label>
                <input type="email" wire:model.defer="email"
                       class="w-full border rounded p-2 focus:ring focus:ring-blue-300">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Notes --}}
            <div class="mt-6">
                <h3 class="font-semibold">Additional information</h3>
                <textarea wire:model.defer="notes" rows="4"
                          class="w-full border rounded p-2 focus:ring focus:ring-blue-300"
                          placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
            </div>
        </div>

        {{-- Right: Your Order --}}
        <div class="bg-white p-6 shadow rounded">
            <h2 class="text-xl font-bold mb-4">Your Order</h2>

            {{-- Cart Items --}}
            <table class="w-full mb-4">
                <thead>
                <tr class="border-b">
                    <th class="text-left p-2">Product</th>
                    <th class="text-right p-2">Subtotal</th>
                </tr>
                </thead>
                <tbody>
                @forelse($cart as $item)
                    <tr class="border-b">
                        <td class="p-2">{{ $item['name'] }} × {{ $item['quantity'] }}</td>
                        <td class="p-2 text-right">
                            ₹{{ number_format($item['price'] * $item['quantity'], 2) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="p-4 text-center text-red-600 bg-red-100 font-semibold rounded">
                            Your Cart is Empty..
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            {{-- Totals --}}
            <div class="space-y-1 text-right">
                <p><b>Subtotal:</b> ₹{{ number_format($subtotal, 2) }}</p>
                <p><b>Shipping:</b> Paid by Transport Office</p>
                <p><b>Packing Charges 3% extra:</b> ₹{{ number_format($packing_charges, 2) }}</p>
                <p class="text-lg font-bold"><b>Total:</b> ₹{{ number_format($total, 2) }}</p>
            </div>

            {{-- Payment Method --}}
            <div class="mt-6 border p-3 rounded bg-gray-50 text-sm">
                <p class="font-semibold mb-2">Direct bank transfer</p>
                <p>Make your payment directly into our bank account. Please use your Order ID as the
                    payment reference. Your order will not be shipped until the funds have cleared.</p>
            </div>

            {{-- Terms & Conditions --}}
            <label class="flex items-center gap-2 mt-4 text-sm">
                <input type="checkbox" wire:model="agree">
                <span>I have read and agree to the website terms and conditions.</span>
            </label>
            @error('agree') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror

            {{-- Submit --}}
            <button type="submit"
                    class="w-full mt-5 bg-purple-600 text-white py-3 rounded hover:bg-green-700 disabled:opacity-50"
{{--                @disabled(!$agree)--}}
            >
                PLACE ORDER
            </button>

            {{-- Success Message --}}
            @if (session()->has('success'))
                <div class="mt-4 p-3 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </form>
</div>
