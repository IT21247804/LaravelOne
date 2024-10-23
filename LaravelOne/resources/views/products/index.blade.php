@extends('layouts.layout')

@section('content')

    <div class="container">
        <h2>Products</h2>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Add New Product</a>
        
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Filter by Category -->
        <form method="GET" action="{{ route('products.index') }}" class="mb-4">
            <select name="category" class="form-select" onchange="this.form.submit()">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $selectedCategory == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </form>

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Image</th> <!-- Add this column for images -->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>
                            <!-- Check if the product has an image and display it -->
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="100"> <!-- Image column -->
                            @else
                                <span>No Image</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="mt-4" style="text-align: center;">
            <style>
                .pagination .page-link {
                    padding: 0.5rem 0.75rem; /* Adjust padding */
                    font-size: 0.875rem; /* Adjust font size */
                    margin: 0 0.1rem; /* Control spacing between buttons */
                }
                .pagination .page-item {
                    display: inline-block; /* Align buttons inline */
                }
            </style>
            {{ $products->appends(request()->input())->links() }}
        </div>
    </div>

@endsection
