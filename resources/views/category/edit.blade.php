@extends('components.layouts.admin')

@section('content')
    <div class="max-w-md mx-auto px-6 py-8 bg-white rounded-lg shadow-lg mt-20">

        <h1 class="text-3xl font-bold text-red-600 mb-8 flex items-center">
            <i class="fas fa-edit mr-3"></i> Edit Category
        </h1>

        <form action="{{ route('admin1.categories.update', $category) }}" method="POST" class="space-y-6" novalidate>
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block mb-2 font-semibold text-gray-700">Name <span class="text-red-600">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required
                       class="w-full border rounded-md px-4 py-2 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500
                @error('name') border-red-600 ring-red-600 @enderror" />
                @error('name')
                <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center">
                <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2 rounded shadow transition duration-200 flex items-center">
                    <i class="fas fa-save mr-2"></i> Update
                </button>
                <a href="{{ route('admin1.categories.index') }}"
                   class="ml-6 text-gray-600 hover:text-red-600 hover:underline transition duration-200">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
