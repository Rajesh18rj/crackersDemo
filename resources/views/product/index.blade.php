@extends('components.layouts.admin')

@section('content')
    <div class=" max-w-7xl mx-auto py-6 mt-10">

        {{-- Page Header --}}
        <div class="flex items-center justify-between mb-6 border-b pb-4 ">
            <h1 class="text-2xl  font-bold text-red-600 flex items-center">
                <i class="fas fa-box text-red-600 mr-2"></i> Manage Products
            </h1>
            <a href="{{ route('admin1.products.create') }}"
               class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded shadow">
                <i class="fas fa-plus mr-2 "></i> Add Product
            </a>
        </div>

        <div class="flex justify-end">
            <form action="{{ route('admin1.products.index') }}" method="GET" class="inline-flex mb-4">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search Product"
                       class="px-2 py-1 border rounded-l text-sm border-gray-400 mr-1" />
                <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-r text-sm font-semibold">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 border border-green-300 rounded-md flex items-center space-x-2">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        {{-- Product Table --}}
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="bg-red-600 px-4 py-3 flex justify-between items-center">
                <h2 class="text-white font-semibold flex items-center">
                    <i class="fas fa-list mr-2"></i> Product List
                </h2>
                <span class="bg-white text-red-600 text-sm font-bold px-3 py-1 rounded-full shadow">
                    {{ $products->total() }} Total
                </span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full divide-y divide-gray-200 text-[10px] xs:text-xs sm:text-sm">
                    <thead class="bg-red-500 text-white uppercase font-semibold">
                    <tr>
                        <th class="px-1 py-1 sm:px-4 sm:py-3 text-left">ID</th>
                        <th class="px-1 py-1 sm:px-4 sm:py-3 text-left">Image</th>
                        <th class="px-1 py-1 sm:px-4 sm:py-3 text-left">Product</th>
                        <th class="px-1 py-1 sm:px-4 sm:py-3 text-left hidden sm:table-cell">Category</th>
                        <th class="px-1 py-1 sm:px-4 sm:py-3 text-left">Package</th>
                        <th class="px-1 py-1 sm:px-4 sm:py-3 text-left">O.Price</th>
                        <th class="px-1 py-1 sm:px-4 sm:py-3 text-left">Price</th>
                        <th class="px-1 py-1 sm:px-4 sm:py-3 text-left hidden sm:table-cell">Status</th>
                        <th class="px-1 py-1 sm:px-4 sm:py-3 text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($products as $product)
                        <tr class="hover:bg-red-50 transition">
                            {{-- ID --}}
                            <td class="px-1 py-1 sm:px-4 sm:py-3 font-semibold text-gray-700">{{ $product->id }}</td>

                            {{-- Image --}}
                            <td class="px-1 py-1 sm:px-4 sm:py-3">
                                @if($product->image_path)
                                    <img src="{{ asset('storage/'.$product->image_path) }}"
                                         class="w-8 h-8 sm:w-14 sm:h-14 object-cover rounded-lg shadow border" alt="">
                                @else
                                    <span class="text-gray-400 text-[10px] sm:text-sm">No Image</span>
                                @endif
                            </td>

                            {{-- Name --}}
                            <td class="px-1 py-1 sm:px-4 sm:py-3 text-gray-800 font-medium truncate max-w-[5rem] sm:max-w-xs">
                                {{ $product->name }}
                            </td>

                            {{-- Category --}}
                            <td class="px-1 py-1 sm:px-4 sm:py-3 text-gray-600 hidden sm:table-cell">
                                {{ $product->category->name ?? '-' }}
                            </td>

                            {{-- Package --}}
                            <td class="px-1 py-1 sm:px-4 sm:py-3 text-gray-600">{{ $product->package ?? '-' }}</td>

                            {{-- Original Price --}}
                            <td class="px-1 py-1 sm:px-4 sm:py-3 text-gray-500">
                                @if($product->original_price)
                                    <s>₹{{ number_format($product->original_price, 2) }}</s>
                                @else
                                    -
                                @endif
                            </td>

                            {{-- Price --}}
                            <td class="px-1 py-1 sm:px-4 sm:py-3 font-bold text-red-600">
                                ₹{{ number_format($product->price, 2) }}
                            </td>

                            {{-- Status (hidden in mobile) --}}
                            <td class="px-1 py-1 sm:px-4 sm:py-3 hidden sm:table-cell">
                                @if($product->is_active)
                                    <span class="px-2 py-0.5 text-[10px] sm:text-xs font-semibold bg-green-100 text-green-700 rounded-full flex items-center justify-center">
                            <i class="fas fa-check-circle mr-1"></i> Active
                        </span>
                                @else
                                    <span class="px-2 py-0.5 text-[10px] sm:text-xs font-semibold bg-gray-200 text-gray-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-ban mr-1"></i> Inactive
                        </span>
                                @endif
                            </td>

                            {{-- Actions --}}
                            <td class="px-1 py-1 sm:px-4 sm:py-3 text-center relative">
                                {{-- 3-dot button --}}
                                <button id="actionsBtn-{{ $product->id }}"
                                        onclick="toggleActionsDropdown({{ $product->id }})"
                                        class="inline-flex items-center justify-center w-6 h-6 sm:w-8 sm:h-8 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-full shadow">
                                    <i class="fas fa-ellipsis-v text-[10px] sm:text-sm"></i>
                                </button>

                                {{-- Dropdown --}}
                                <div id="actionsDropdown-{{ $product->id }}"
                                     class="hidden absolute right-0 mt-2 w-20 sm:w-28 bg-white border border-gray-200 rounded-md shadow-lg z-20 origin-top-right">
                                    <a href="{{ route('admin1.products.edit', $product->id) }}"
                                       class="block px-2 py-1 text-[10px] sm:text-sm text-yellow-700 hover:bg-yellow-100 flex items-center space-x-1">
                                        <i class="fas fa-edit"></i>
                                        <span>Edit</span>
                                    </a>
                                    <form action="{{ route('admin1.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Delete this product?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="w-full text-left px-2 py-1 text-[10px] sm:text-sm text-red-600 hover:bg-red-100 flex items-center space-x-1">
                                            <i class="fas fa-trash-alt"></i>
                                            <span>Delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-6 text-gray-500">
                                <i class="fas fa-box-open text-red-400 text-2xl mb-2 block"></i>
                                No products found.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <script>
            // Close all dropdowns except the one with specified id
            function closeAllDropdowns(exceptId) {
                const dropdowns = document.querySelectorAll('[id^="actionsDropdown-"]');
                dropdowns.forEach(dropdown => {
                    if (dropdown.id !== `actionsDropdown-${exceptId}`) {
                        dropdown.classList.add('hidden');
                    }
                });
            }

            function toggleActionsDropdown(id) {
                const dropdown = document.getElementById(`actionsDropdown-${id}`);
                if (!dropdown) return;

                const isHidden = dropdown.classList.contains('hidden');

                // Close all other dropdowns
                closeAllDropdowns(id);

                if (isHidden) {
                    dropdown.classList.remove('hidden');

                    // Setup listener to close dropdown when clicking outside
                    const outsideClickListener = event => {
                        if (!dropdown.contains(event.target) && !document.getElementById(`actionsBtn-${id}`).contains(event.target)) {
                            dropdown.classList.add('hidden');
                            document.removeEventListener('click', outsideClickListener);
                        }
                    };
                    document.addEventListener('click', outsideClickListener);
                } else {
                    dropdown.classList.add('hidden');
                }
            }
        </script>


        {{-- Pagination --}}
        <div class="mt-6 flex justify-end">
            {{ $products->links('pagination::tailwind') }}
        </div>

    </div>
@endsection
