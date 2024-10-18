<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex">
        <!-- Sidebar -->
        <div class="w-1/4 bg-gray-800 h-screen p-6">
            <h3 class="text-white text-lg mb-6">Administrator Panel</h3>
            <ul class="space-y-4">
                <li>
                    <a href="javascript:void(0)" onclick="showSection('products')" class="text-gray-300 hover:text-white block">
                        <i class="fas fa-boxes"></i> Products
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)" onclick="showSection('categories')" class="text-gray-300 hover:text-white block">
                        <i class="fas fa-list"></i> Categories
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content Area -->
        <div class="w-3/4 bg-white p-6">
            <div class="py-6">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            {{ __("You're logged in as Administrator!") }}
                        </div>
                    </div>

                    <div class="mt-6">
                        <h3 class="text-xl font-bold mb-4">Manage Products and Categories</h3>
                        <p>Use the sidebar to view and manage products and categories.</p>
                    </div>

                    <!-- Products Table (Initially hidden) -->
                    <div id="products" class="mt-6 hidden">
                        <h3 class="text-xl font-bold mb-4">Products</h3>
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="py-2">ID</th>
                                    <th class="py-2">Name</th>
                                    <th class="py-2">Description</th>
                                    <th class="py-2">Price</th>
                                    <th class="py-2">Category</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $product->id }}</td>
                                        <td class="border px-4 py-2">{{ $product->name }}</td>
                                        <td class="border px-4 py-2">{{ $product->description }}</td>
                                        <td class="border px-4 py-2">{{ $product->price }}</td>
                                        <td class="border px-4 py-2">{{ $product->category->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Categories Table (Initially hidden) -->
                    <div id="categories" class="mt-6 hidden">
                        <h3 class="text-xl font-bold mb-4">Categories</h3>
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="py-2">Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $category->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function showSection(section) {
            // Hide both sections initially
            document.getElementById('products').classList.add('hidden');
            document.getElementById('categories').classList.add('hidden');
            
            // Show the selected section
            document.getElementById(section).classList.remove('hidden');
        }
    </script>
</x-app-layout>
