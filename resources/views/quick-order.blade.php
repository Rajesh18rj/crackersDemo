@extends('components.layouts.new-layout')

@section('content')
@php
    $totalProducts = 0;
    $totalAmount = 0;
    $totalSavings = 0;
@endphp

    <!-- Quick Purchase Header -->
<div>
    <div class="relative bg-gradient-to-r from-red-700 to-white py-10 mb-6">
        <div class="text-center text-red-700 flex items-center justify-center space-x-2">
            <i class="fas fa-rocket text-4xl"></i>
            <h1 class="text-4xl font-bold">Quick Order</h1>
        </div>
    </div>



    <!-- Totals Bar -->
    <div class="sticky top-0 z-50 bg-white shadow-md">
        <div class="grid grid-cols-4 text-center font-bold mb-4">
            <div class="bg-blue-200 p-4">Total Products <br> <span id="total-products">0</span></div>
            <div class="bg-cyan-200 p-4">Your Savings <br> ₹<span id="total-savings">0.00</span></div>
            <div class="bg-lime-200 p-4">Total Amount <br> ₹<span id="total-amount">0.00</span></div>
            <div class="bg-red-200 p-4 flex flex-col items-center justify-center text-center">
                <form id="checkout-form" action="{{ route('quick-order.checkout') }}" method="POST" class="w-full">
                    @csrf
                    <input type="hidden" name="cart" id="cart-input">
                    <div class="flex justify-center w-full">
                        <button type="submit" id="checkout-btn"
                                class="px-4 py-2 bg-white border opacity-50 cursor-not-allowed text-xs sm:text-base flex items-center justify-center"
                                disabled>
                            CHECKOUT
                        </button>
                    </div>
                </form>
                <br>
                <small>(Min. ₹3000)</small>
            </div>

        </div>
    </div>

    <!-- Product List -->
    @foreach($categories as $category)
        <div class="bg-red-500 text-white p-2 font-bold flex items-center justify-center">
            {{ strtoupper($category->name) }}
        </div>

        <!-- Desktop Table -->
        <div class="hidden md:block">
            <table class="w-full border">
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
                    <tr class="border-b"
                        data-product-id="{{ $product->id }}"
                        data-price="{{ $product->price }}"
                        data-original-price="{{ $product->original_price }}">
                        <td class="text-center p-2">
                            <img src="{{ asset('storage/'.$product->image_path) }}" class="w-16 mx-auto" alt="{{ $product->name }}">
                        </td>
                        <td class="p-2">{{ $product->name }}</td>
                        <td class="p-2">{{ $product->package }}</td>
                        <td class="text-right p-2">
                            <span class="text-purple-600 font-bold">₹{{ number_format($product->price, 2) }}</span>
                            @if($product->original_price > $product->price)
                                <del class="text-gray-400 ml-1">₹{{ number_format($product->original_price, 2) }}</del>
                            @endif
                        </td>
                        <td class="text-center p-2">
                            <button class="decrement bg-red-500 text-white px-3 py-1 rounded-full shadow hover:bg-red-600 transition transform active:scale-90">–</button>
                            <span class="inline-block w-8 text-center font-semibold quantity">0</span>
                            <button class="increment bg-red-500 text-white px-3 py-1 rounded-full shadow hover:bg-red-600 transition transform active:scale-90">+</button>
                        </td>
                        <td class="text-right p-2 pr-10">
                            ₹<span class="line-total">0.00</span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mobile Card Layout -->
        <div class="md:hidden space-y-4">
            @foreach($category->products as $product)
                <div class="border rounded-lg p-3 shadow-sm"
                     data-product-id="{{ $product->id }}"
                     data-price="{{ $product->price }}"
                     data-original-price="{{ $product->original_price }}">
                    <div class="flex items-center space-x-3">
                        <img src="{{ asset('storage/'.$product->image_path) }}" class="w-16 h-16 object-contain" alt="{{ $product->name }}">
                        <div class="flex-1">
                            <h3 class="font-semibold">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $product->package }}</p>
                            <div class="text-purple-600 font-bold">
                                ₹{{ number_format($product->price, 2) }}
                                @if($product->original_price > $product->price)
                                    <del class="text-gray-400 ml-1 text-xs">₹{{ number_format($product->original_price, 2) }}</del>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center mt-3">
                        <div class="flex items-center space-x-2">
                            <button class="decrement bg-red-500 text-white px-3 py-1 rounded-full shadow hover:bg-red-600 active:scale-90">–</button>
                            <span class="w-8 text-center font-semibold quantity">0</span>
                            <button class="increment bg-red-500 text-white px-3 py-1 rounded-full shadow hover:bg-red-600 active:scale-90">+</button>
                        </div>
                        <div class="font-bold">
                            ₹<span class="line-total">0.00</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach

</div>

<!-- JS for Increment/Decrement & Totals -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const cart = {}; // { productId: { name, price, quantity } }

        // Get all product rows (desktop + mobile)
        const productRows = document.querySelectorAll("[data-product-id]");

        // Initialize cart with zero quantities
        productRows.forEach(row => {
            const id = row.dataset.productId;
            if (!cart[id]) {
                const nameEl = row.querySelector("h3") || row.querySelector("td:nth-child(2)");
                const name = nameEl.textContent.trim();
                const price = parseFloat(row.dataset.price);
                cart[id] = { name: name, price: price, quantity: 0 };
            }
        });

        // Update totals & row displays
        function updateTotals() {
            let totalProducts = 0;
            let totalAmount = 0;
            let totalSavings = 0;
            const countedIds = new Set();

            productRows.forEach(row => {
                const id = row.dataset.productId;
                if (countedIds.has(id)) return; // skip duplicates for totals
                countedIds.add(id);

                const item = cart[id];
                const originalPrice = parseFloat(row.dataset.originalPrice);
                totalProducts += item.quantity;
                totalAmount += item.quantity * item.price;
                totalSavings += item.quantity * (originalPrice - item.price);
            });

            // Update totals display
            document.getElementById("total-products").textContent = totalProducts;
            document.getElementById("total-amount").textContent = totalAmount.toFixed(2);
            document.getElementById("total-savings").textContent = totalSavings.toFixed(2);

            // Enable/disable checkout button
            const checkoutBtn = document.getElementById("checkout-btn");
            if (totalAmount >= 3000) {
                checkoutBtn.disabled = false;
                checkoutBtn.classList.remove("opacity-50", "cursor-not-allowed");
            } else {
                checkoutBtn.disabled = true;
                checkoutBtn.classList.add("opacity-50", "cursor-not-allowed");
            }

            // Update all row quantities and line totals
            productRows.forEach(row => {
                const id = row.dataset.productId;
                const item = cart[id];
                row.querySelector(".quantity").textContent = item.quantity;
                row.querySelector(".line-total").textContent = (item.quantity * item.price).toFixed(2);
            });
        }

        // Increment / Decrement buttons
        productRows.forEach(row => {
            const id = row.dataset.productId;

            row.querySelectorAll(".increment, .decrement").forEach(btn => {
                btn.addEventListener("click", () => {
                    if (btn.classList.contains("increment")) {
                        cart[id].quantity++;
                    } else if (btn.classList.contains("decrement") && cart[id].quantity > 0) {
                        cart[id].quantity--;
                    }
                    updateTotals();
                });
            });
        });

        // Submit cart to server
        const checkoutForm = document.getElementById("checkout-form");
        checkoutForm.addEventListener("submit", e => {
            document.getElementById("cart-input").value = JSON.stringify(cart);
        });

        // Initial update
        updateTotals();
    });
</script>
@endsection
