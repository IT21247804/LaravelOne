<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold">{{ $product->name }}</h3>
                    <p>{{ $product->description }}</p>
                    <p class="mt-4 text-lg">Price: ${{ $product->price }}</p>

                    <!-- Purchase Button -->
                    <button class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" data-modal-toggle="purchaseModal">
                        Purchase
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Purchase Modal -->
    <div id="purchaseModal" tabindex="-1" class="hidden fixed top-0 left-0 right-0 z-50 w-full h-full flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-md mx-auto">
            <h3 class="text-2xl font-bold mb-4">Purchase Product</h3>

            <form action="{{ route('purchases.store') }}" method="POST">
                @csrf
                <!-- Hidden input for product_id -->
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="mb-4">
                    <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                    <input type="number" name="quantity" id="quantity" value="1" min="1" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="mb-4">
                    <label for="address" class="block text-sm font-medium text-gray-700">Shipping Address</label>
                    <textarea name="address" id="address" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                </div>

                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Confirm Purchase
                </button>
                <button type="button" class="ml-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" data-modal-toggle="purchaseModal">
                    Cancel
                </button>
            </form>
        </div>
    </div>

    <script>
        // JavaScript to toggle modal visibility
        document.querySelectorAll('[data-modal-toggle]').forEach(button => {
            button.addEventListener('click', function() {
                const modalId = this.getAttribute('data-modal-toggle');
                const modal = document.getElementById(modalId);
                if (modal.classList.contains('hidden')) {
                    modal.classList.remove('hidden');
                } else {
                    modal.classList.add('hidden');
                }
            });
        });
    </script>
</x-app-layout>
