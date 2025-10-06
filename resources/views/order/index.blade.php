@extends('components.layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">

        {{-- Page Header --}}
        <div class="flex items-center justify-between mb-8 border-b border-gray-200 pb-4 mt-10">
            <h1 class="text-3xl font-extrabold text-red-600 flex items-center">
                <i class="fas fa-clipboard-list mr-3"></i> Orders
            </h1>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow-sm flex items-center">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
        @endif

        <!-- Cards Section -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-4 mb-10">
            <div class="rounded-xl bg-white border border-gray-200 shadow-sm p-3 sm:p-4 md:p-6 flex flex-col items-center">
                <span class="text-gray-400 text-[10px] sm:text-xs md:text-sm mb-1 md:mb-2">New Orders</span>
                <span class="text-lg sm:text-xl md:text-2xl lg:text-3xl font-bold text-yellow-500">{{ $newOrders }}</span>
            </div>
            <div class="rounded-xl bg-white border border-gray-200 shadow-sm p-3 sm:p-4 md:p-6 flex flex-col items-center">
                <span class="text-gray-400 text-[10px] sm:text-xs md:text-sm mb-1 md:mb-2">Order Processing</span>
                <span class="text-lg sm:text-xl md:text-2xl lg:text-3xl font-bold text-orange-500">{{ $processingOrders }}</span>
            </div>
            <div class="rounded-xl bg-white border border-gray-200 shadow-sm p-3 sm:p-4 md:p-6 flex flex-col items-center">
                <span class="text-gray-400 text-[10px] sm:text-xs md:text-sm mb-1 md:mb-2">Order Shipped</span>
                <span class="text-lg sm:text-xl md:text-2xl lg:text-3xl font-bold text-indigo-500">{{ $shippedOrders }}</span>
            </div>
            <div class="rounded-xl bg-white border border-gray-200 shadow-sm p-3 sm:p-4 md:p-6 flex flex-col items-center">
                <span class="text-gray-400 text-[10px] sm:text-xs md:text-sm mb-1 md:mb-2">Order Delivered</span>
                <span class="text-lg sm:text-xl md:text-2xl lg:text-3xl font-bold text-green-500">{{ $deliveredOrders }}</span>
            </div>
            <div class="rounded-xl bg-white border border-gray-200 shadow-sm p-3 sm:p-4 md:p-6 flex flex-col items-center">
                <span class="text-gray-400 text-[10px] sm:text-xs md:text-sm mb-1 md:mb-2">Order Cancelled</span>
                <span class="text-lg sm:text-xl md:text-2xl lg:text-3xl font-bold text-red-500">{{ $cancelledOrders }}</span>
            </div>
        </div>


        <div class="bg-white border border-gray-200 rounded-lg shadow relative">
            <table class="min-w-full divide-y divide-gray-200 table-fixed">
                <thead class="bg-red-600 text-white uppercase text-xs">
                <tr>
                    <th class="px-3 py-3 w-10">#</th>
                    <th class="px-3 py-3 w-40">Customer</th>
                    <th class="px-3 py-3 w-48">Email</th>
                    <th class="px-3 py-3 w-32">Phone</th>
                    <th class="px-3 py-3 w-24 text-right">Total</th>
                    <th class="px-3 py-3 w-28">Status</th>
                    <th class="px-3 py-3 w-32">Payment</th>
                    <th class="px-3 py-3 w-28">Created At</th>
                    <th class="px-3 py-3 w-20 text-center">Actions</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                @forelse($orders as $order)
                    <tr class="hover:bg-red-50 relative">
                        <td class="px-3 py-3 font-semibold text-gray-700">#{{ $order->id }}</td>
                        <td class="px-3 py-3 text-gray-900">{{ $order->first_name }} {{ $order->last_name }}</td>
                        <td class="px-3 py-3 text-gray-700 truncate max-w-xs" title="{{ $order->email }}">{{ $order->email }}</td>
                        <td class="px-3 py-3 text-gray-700">{{ $order->phone }}</td>
                        <td class="px-3 py-3 font-bold text-red-600 text-right">₹{{ number_format($order->total, 2) }}</td>
                        <td class="px-3 py-3">
                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold
                                {{ $order->status === 'new' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                {{ $order->status === 'processing' ? 'bg-orange-100 text-orange-700' : '' }}
                                {{ $order->status === 'shipped' ? 'bg-blue-100 text-blue-700' : '' }}
                                {{ $order->status === 'delivered' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $order->status === 'cancelled' ? 'bg-red-100 text-red-700' : '' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="px-3 py-3 text-gray-700 truncate max-w-xs" title="{{ $order->payment_method }}">
                            <span class="inline-flex items-center">
                                <i class="fas fa-money-check text-gray-400 mr-2"></i>
                                {{ $order->payment_method }}
                            </span>
                        </td>
                        <td class="px-3 py-3 text-gray-500 whitespace-nowrap">{{ $order->created_at->format('d M Y') }}</td>
                        <td class="px-3 py-3 text-center relative">
                            <!-- 3-dot Dropdown Button -->
                            <button onclick="toggleOrderActionsDropdown({{ $order->id }})"
                                    id="actionsBtn-{{ $order->id }}"
                                    class="w-8 h-8 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-full shadow focus:outline-none"
                                    aria-haspopup="true" aria-label="Actions">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div id="orderActionsDropdown-{{ $order->id }}"
                                 class="hidden absolute right-0 mt-2 w-32 bg-white border border-gray-200 rounded-md shadow-lg z-20 max-h-56 overflow-y-auto">
                                <a href="{{ route('admin1.orders.show', $order) }}"
                                   class="block px-4 py-2 text-sm text-blue-700 hover:bg-blue-50 hover:text-blue-900 flex items-center">
                                    <i class="fas fa-eye mr-2"></i> View
                                </a>


                                <a href="{{ route('admin1.orders.print', $order) }}" target="_blank" rel="noopener"
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 flex items-center">
                                    <i class="fas fa-print mr-2"></i> Print
                                </a>

                                <a href="{{ route('admin1.orders.edit', $order) }}"
                                   class="block px-4 py-2 text-sm text-yellow-700 hover:bg-yellow-100 hover:text-yellow-900 flex items-center">
                                    <i class="fas fa-edit mr-2"></i> Edit
                                </a>
                                <button onclick="deleteOrder({{ $order->id }})"
                                        class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-100 hover:text-red-800 flex items-center">
                                    <i class="fas fa-trash-alt mr-2"></i> Delete
                                </button>
                                <form id="delete-form-{{ $order->id }}" action="{{ route('admin1.orders.destroy', $order) }}" method="POST" style="display:none;">
                                    @csrf @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="py-10 text-center text-gray-400 italic">
                            <i class="fas fa-inbox text-3xl text-red-200 mb-3 block"></i>
                            No Orders Found
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-8 flex justify-end">
            {{ $orders->links('pagination::tailwind') }}
        </div>
    </div>

    <style>
        .actions-dropdown-above {
            bottom: 100% !important;
            top: auto !important;
            margin-bottom: 0.5rem;
            margin-top: 0;
        }
    </style>

    <script>
        function toggleOrderActionsDropdown(id) {
            // Close other dropdowns
            document.querySelectorAll('[id^="orderActionsDropdown-"]').forEach(el => {
                if (el.id !== `orderActionsDropdown-${id}`) el.classList.add('hidden');
            });

            const btn = document.getElementById('actionsBtn-' + id);
            const dropdown = document.getElementById('orderActionsDropdown-' + id);
            if (!dropdown || !btn) return;

            // Reset dropdown positioning
            dropdown.classList.remove('actions-dropdown-above');
            dropdown.style.top = '';
            dropdown.style.bottom = '';

            // Toggle dropdown visibility
            dropdown.classList.toggle('hidden');

            if (!dropdown.classList.contains('hidden')) {
                // Get button bounding rectangles
                const btnRect = btn.getBoundingClientRect();
                const dropdownHeight = dropdown.offsetHeight;
                const spaceBelow = window.innerHeight - btnRect.bottom;
                const spaceAbove = btnRect.top;

                // Show above if not enough space below
                if (spaceBelow < dropdownHeight + 10 && spaceAbove > dropdownHeight + 10) {
                    dropdown.classList.add('actions-dropdown-above');
                    dropdown.style.bottom = `${btn.offsetHeight + 8}px`;
                    dropdown.style.top = 'auto';
                } else {
                    dropdown.style.top = `${btn.offsetHeight + 8}px`;
                    dropdown.style.bottom = 'auto';
                }
            }

            // Close dropdown on outside click
            function onClickOutside(event) {
                if (dropdown && !dropdown.contains(event.target) && !btn.contains(event.target)) {
                    dropdown.classList.add('hidden');
                    dropdown.classList.remove('actions-dropdown-above');
                    document.removeEventListener('click', onClickOutside);
                }
            }
            document.addEventListener('click', onClickOutside);
        }

        function deleteOrder(id) {
            if (confirm('Are you sure you want to delete this order?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
@endsection
