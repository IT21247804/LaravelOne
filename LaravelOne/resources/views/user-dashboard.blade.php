<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in as User!") }}
                </div>
            </div>

            <!-- Products Display -->
            <div class="mt-6">
                <h3 class="text-xl font-bold mb-4">Products</h3>

                <!-- Filter by Category -->
                <form method="GET" action="{{ route('user-dashboard') }}" class="mb-4">
                    <select name="category" class="form-select" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $selectedCategory == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </form>

                <table class="min-w-full bg-white mt-4">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="py-2">ID</th>
                            <th class="py-2">Name</th>
                            <th class="py-2">Description</th>
                            <th class="py-2">Price</th>
                            <th class="py-2">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td class="border px-4 py-2">{{ $product->id }}</td>
                                <td class="border px-4 py-2">{{ $product->name }}</td>
                                <td class="border px-4 py-2">{{ $product->description }}</td>
                                <td class="border px-4 py-2">{{ $product->price }}</td>
                                <td class="border px-4 py-2">
                                <a class="btn btn-primary" href="{{ route('products.show', $product->id) }}" role="button">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($products->isEmpty())
                    <div class="mt-4 text-center text-gray-600">
                        {{ __('No products found.') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
