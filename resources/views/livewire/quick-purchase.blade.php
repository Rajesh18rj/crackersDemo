<!-- Quick Purchase Header -->
<div>
<div class="relative bg-gradient-to-r from-purple-700 to-pink-500 py-10 mb-6">
    <div class="text-center text-white">
        <h1 class="text-4xl font-bold">Quick Purchase</h1>
        <div class="mt-2">
            <a href="/" class="hover:underline">Home</a>
            <span class="mx-2">/</span>
            <span>Quick Purchase</span>
        </div>
    </div>
</div>


<div>
    <!-- Totals Bar -->
    <div class="grid grid-cols-4 text-center font-bold mb-4">
        <div class="bg-blue-200 p-4">Total Products <br> {{ $totalProducts }}</div>
        <div class="bg-cyan-200 p-4">Your Savings <br> ₹{{ number_format($totalSavings, 2) }}</div>
        <div class="bg-lime-200 p-4">Total Amount <br> ₹{{ number_format($totalAmount, 2) }}</div>
        <div class="bg-red-200 p-4">
            <button
                class="px-4 py-2 bg-white border {{ $totalAmount >= 3000 ? 'cursor-pointer' : 'opacity-50 cursor-not-allowed' }}"
                @if($totalAmount < 3000) disabled @endif
            >
                CHECKOUT
            </button>
            <br>
            <small>(Min. ₹3000)</small>
        </div>
    </div>

    <!-- Product List -->
    @foreach($categories as $category)
        <div class="bg-red-500 text-white p-2 font-bold">{{ strtoupper($category->name) }}</div>
        <table class="w-full border table-fixed">
            <thead>
            <tr class="bg-gray-100 text-left">
                <th class="w-24 text-center">Image</th>
                <th class="w-48">Name</th>
                <th class="w-32">Package</th>
                <th class="w-32 text-right">Price</th>
                <th class="w-32 text-center">Quantity</th>
                <th class="w-40 text-right pr-10">Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach($category->products as $product)
                <tr class="border-b">
                    <td class="text-center">
                        <img src="{{ Storage::url($product->image_path) }}" class="w-16 mx-auto" alt="{{ $product->name }}">
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->package }}</td>
                    <td class="text-right">
                        <span class="text-purple-600 font-bold">₹{{ number_format($product->price, 2) }}</span>
                        @if($product->original_price > $product->price)
                            <del class="text-gray-400 ml-1">₹{{ number_format($product->original_price, 2) }}</del>
                        @endif
                    </td>
                    <td class="text-center">
                        <button wire:click="decrement({{ $product->id }})" class="bg-red-500 text-white px-2">-</button>
                        <span class="inline-block w-8 text-center">{{ $quantities[$product->id] }}</span>
                        <button wire:click="increment({{ $product->id }})" class="bg-red-500 text-white px-2">+</button>
                    </td>
                    <td class="text-right pr-10">
                        ₹{{ number_format($quantities[$product->id] * $product->price, 2) }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endforeach
</div>
</div>
