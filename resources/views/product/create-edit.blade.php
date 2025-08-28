@extends('components.layouts.admin')

@section('content')
    <div class="max-w-3xl mx-auto px-6 py-6 bg-white rounded-lg shadow-lg mt-10">

        {{-- Page Title --}}
        <h1 class="text-3xl font-bold text-red-600 mb-6 flex items-center">
            <i class="fas fa-box-open mr-3"></i>
            {{ isset($product) ? 'Edit' : 'Add' }} Product
        </h1>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="mb-6 p-4 border border-red-300 bg-red-50 text-red-700 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
        <form action="{{ isset($product) ? route('admin1.products.update', $product->id) : route('admin1.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @if(isset($product)) @method('PUT') @endif


            {{-- Name --}}
            <div>
                <label for="name" class="block font-semibold text-gray-700 mb-1">Name <span class="text-red-600">*</span></label>
                <input id="name" type="text" name="name" required
                       value="{{ $product->name ?? '' }}"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500" />
            </div>

            {{-- Category --}}
            <div>
                <label for="category_id" class="block font-semibold text-gray-700 mb-1">Category <span class="text-red-600">*</span></label>
                <select id="category_id" name="category_id" required
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ (isset($product) && $product->category_id == $category->id) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Package --}}
            <div>
                <label for="package" class="block font-semibold text-gray-700 mb-1">Package</label>
                <input id="package" type="text" name="package"
                       value="{{ $product->package ?? '' }}"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500" />
            </div>

            {{-- Price --}}
            <div>
                <label for="price" class="block font-semibold text-gray-700 mb-1">Price <span class="text-red-600">*</span></label>
                <input id="price" type="number" step="0.01" name="price" required
                       value="{{ $product->price ?? '' }}"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500" />
            </div>

            {{-- Original Price --}}
            <div>
                <label for="original_price" class="block font-semibold text-gray-700 mb-1">Original Price</label>
                <input id="original_price" type="number" step="0.01" name="original_price"
                       value="{{ $product->original_price ?? '' }}"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500" />
            </div>

            {{-- Image --}}
            <div>
                <label for="image" class="block font-semibold text-gray-700 mb-1">Image</label>
                <input id="image" type="file" name="image" class="w-full text-gray-700" />
                @if(isset($product) && $product->image_path)
                    <img src="{{ asset('storage/'.$product->image_path) }}" alt="Product Image" class="mt-4 w-24 h-24 object-cover rounded shadow border border-gray-200" />
                @endif
            </div>

            {{-- Status --}}
            <div class="flex items-center space-x-3">
                <label for="toggleActive" class="font-semibold text-gray-700 select-none cursor-pointer">Status</label>
                <input type="hidden" id="isActiveInput" name="is_active" value="{{ (isset($product) && $product->is_active) ? '1' : '0' }}">
                <button type="button" id="toggleActive" aria-pressed="{{ (isset($product) && $product->is_active) ? 'true' : 'false' }}"
                        class="relative inline-flex items-center h-6 rounded-full w-11 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 bg-gray-300"
                        onclick="toggleStatus()"
                >
                    <span class="sr-only">Toggle Active Status</span>
                    <span class="toggle-dot absolute left-0.5 top-0.5 h-5 w-5 rounded-full bg-white border border-gray-300 shadow transform transition-transform duration-300 ease-in-out
            {{ (isset($product) && $product->is_active) ? 'translate-x-5' : 'translate-x-0' }}"></span>
                </button>
            </div>

            <script>
                function toggleStatus() {
                    const toggle = document.getElementById('toggleActive');
                    const input = document.getElementById('isActiveInput');
                    const isActive = input.value === '1';

                    if (isActive) {
                        // Turn OFF
                        toggle.classList.remove('bg-red-600');
                        toggle.classList.add('bg-gray-300');
                        toggle.setAttribute('aria-pressed', 'false');
                        input.value = '0';

                        // Move dot left
                        toggle.querySelector('.toggle-dot').classList.remove('translate-x-5');
                        toggle.querySelector('.toggle-dot').classList.add('translate-x-0');

                    } else {
                        // Turn ON
                        toggle.classList.remove('bg-gray-300');
                        toggle.classList.add('bg-red-600');
                        toggle.setAttribute('aria-pressed', 'true');
                        input.value = '1';

                        // Move dot right
                        toggle.querySelector('.toggle-dot').classList.remove('translate-x-0');
                        toggle.querySelector('.toggle-dot').classList.add('translate-x-5');
                    }
                }

                // Initialize toggle background color on page load
                document.addEventListener('DOMContentLoaded', function() {
                    const toggle = document.getElementById('toggleActive');
                    const input = document.getElementById('isActiveInput');
                    if(input.value === '1'){
                        toggle.classList.remove('bg-gray-300');
                        toggle.classList.add('bg-red-600');
                    } else {
                        toggle.classList.remove('bg-red-600');
                        toggle.classList.add('bg-gray-300');
                    }
                });
            </script>


            {{-- Submit Button --}}
            <div>
                <button type="submit"
                        class="inline-flex items-center px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded shadow focus:outline-none focus:ring-2 focus:ring-red-500">
                    <i class="fas fa-save mr-2"></i> {{ isset($product) ? 'Update' : 'Create' }}
                </button>
            </div>
        </form>
    </div>
@endsection
