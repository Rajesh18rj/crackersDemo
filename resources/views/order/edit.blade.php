@extends('components.layouts.admin')

@section('content')
    <div class="max-w-3xl mx-auto px-6 py-8 bg-white rounded-lg shadow-lg mt-10">

        <h1 class="text-3xl font-bold text-red-600 mb-8 flex items-center">
            <i class="fas fa-edit mr-3"></i> Edit Order #{{ $order->id }}
        </h1>

        <form action="{{ route('admin1.orders.update', $order) }}" method="POST" class="space-y-6" novalidate>
            @csrf
            @method('PUT')

            <div>
                <label for="status" class="block mb-2 font-semibold text-gray-700">
                    Order Status <span class="text-red-600">*</span>
                </label>
                <select id="status" name="status"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    @php
                        $statuses = ['new', 'processing', 'shipped', 'delivered', 'cancelled'];
                    @endphp
                    @foreach ($statuses as $status)
                        <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
                @error('status')
                <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="payment_method" class="block mb-2 font-semibold text-gray-700">
                    Payment Method
                </label>
                <input type="text" id="payment_method" name="payment_method"
                       value="{{ old('payment_method', $order->payment_method) }}"
                       class="w-full border border-gray-300 rounded-md px-4 py-2 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500" />
                @error('payment_method')
                <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center space-x-4">
                <button type="submit"
                        class="inline-flex items-center bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded shadow font-semibold transition">
                    <i class="fas fa-save mr-2"></i> Update Order
                </button>
                <a href="{{ route('admin1.orders.index') }}"
                   class="text-gray-600 hover:text-red-600 hover:underline transition font-semibold">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
