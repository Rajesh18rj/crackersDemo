@extends('components.layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8 pt-20">

        {{-- Page Header --}}
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-8 border-b border-gray-200 pb-4">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-red-600 tracking-tight flex items-center mb-4 sm:mb-0">
                <i class="fas fa-tags mr-3"></i> Categories
            </h1>
            <a href="{{ route('admin1.categories.create') }}"
               class="inline-block bg-red-600 hover:bg-red-700 text-white font-bold px-6 py-3 rounded-lg shadow-lg transition duration-300 ease-in-out w-full sm:w-auto text-center">
                <i class="fas fa-plus mr-2"></i> New Category
            </a>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow-sm flex items-center space-x-2">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white border border-gray-200 rounded-lg shadow w-full">
            <table class="min-w-full table-auto divide-y divide-gray-200">
                <thead class="bg-red-600">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider min-w-[150px]">Name</th>
                    <th class="px-4 py-3 text-right text-xs font-semibold text-white uppercase tracking-wider min-w-[110px]">Actions</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                @forelse ($categories as $category)
                    <tr class="hover:bg-red-50 transition-colors duration-200">
                        <td class="px-4 py-4 truncate text-gray-900 font-medium max-w-xs"
                            title="{{ $category->name }}">
                            {{ $category->name }}
                        </td>
                        <td class="px-4 py-4 text-right relative w-28">
                            <div class="inline-block text-left">
                                <button onclick="toggleDropdown({{ $category->id }})"
                                        class="text-gray-600 hover:text-red-600 focus:outline-none"
                                        aria-haspopup="true" aria-label="Options">
                                    <i class="fas fa-ellipsis-v fa-lg"></i>
                                </button>
                                <div id="dropdown-{{ $category->id }}"
                                     class="origin-top-right absolute right-0 mt-2 w-32 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-20 hidden">
                                    <div class="py-1">
                                        <a href="{{ route('admin1.categories.edit', $category) }}"
                                           class="block px-4 py-2 text-sm text-red-700 hover:bg-red-100 hover:text-red-900 flex items-center">
                                            <i class="fas fa-edit mr-2"></i> Edit
                                        </a>

                                        <form action="{{ route('admin1.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                    class="w-full text-left px-4 py-2 text-[10px] sm:text-sm text-red-600 hover:bg-red-100 flex items-center space-x-1">
                                                <i class="fas fa-trash-alt"></i>
                                                <span>Delete</span>
                                            </button>
                                        </form>

{{--                                        <button onclick="deleteCategory({{ $category->id }})" type="button"--}}
{{--                                                class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-red-100 hover:text-red-800 flex items-center">--}}
{{--                                            <i class="fas fa-trash-alt mr-2"></i> Delete--}}
{{--                                        </button>--}}
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="p-10 text-center text-gray-400 italic select-none">
                            <i class="fas fa-folder-open text-red-300 text-3xl mb-3 block"></i>
                            No categories found.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-8 flex justify-end">
            {{ $categories->links() }}
        </div>
    </div>

    <form id="deleteForm" method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        function toggleDropdown(id) {
            // Hide all other dropdowns
            document.querySelectorAll('[id^="dropdown-"]').forEach(menu => {
                if (menu.id !== 'dropdown-' + id) {
                    menu.classList.add('hidden');
                }
            });
            // Toggle current dropdown
            const menu = document.getElementById('dropdown-' + id);
            menu.classList.toggle('hidden');
        }

        // Close dropdown if clicking outside
        document.addEventListener('click', function(event) {
            const dropdowns = document.querySelectorAll('[id^="dropdown-"]');
            const isDropdownButton = event.target.closest('button');
            const isDropdownMenu = event.target.closest('[id^="dropdown-"]');
            if (!isDropdownButton && !isDropdownMenu) {
                dropdowns.forEach(menu => menu.classList.add('hidden'));
            }
        });

        function deleteCategory(id) {
            if (confirm('Are you sure you want to delete this category?')) {
                const form = document.getElementById('deleteForm');
                form.action = `/admin1/categories/${id}`;
                form.submit();
            }
        }
    </script>
@endsection
