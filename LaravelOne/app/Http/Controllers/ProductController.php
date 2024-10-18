<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // 1. **GET**: Fetch all products (index)
    public function index(Request $request)
{
    // Fetch all categories for the filter dropdown
    $categories = Category::all();
    
    // Get the selected category ID from the request
    $selectedCategory = $request->get('category');

    // Query products and apply filtering and pagination
    $products = Product::with('category')
        ->when($selectedCategory, function ($query) use ($selectedCategory) {
            return $query->where('category_id', $selectedCategory);
        })
        ->paginate(10); // Adjust the number to set the number of items per page

    return view('products.index', compact('products', 'categories', 'selectedCategory'));
}

    // 2. **GET**: Show the form to create a new product (create)
    public function create()
    {
        $categories = Category::all(); // Fetch all categories for selection in the product creation form
        return view('products.create', compact('categories'));
    }

    // 3. **POST**: Store a newly created product in the database (store)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required'
        ]);

        Product::create($request->all()); // Create a new product with the validated data

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    // 4. **GET**: Show the form to edit an existing product (edit)
    public function edit(Product $product)
    {
        $categories = Category::all(); // Fetch all categories for the dropdown
        return view('products.edit', compact('product', 'categories'));
    }

    // 5. **PUT/PATCH**: Update the specified product in the database (update)
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required'
        ]);

        $product->update($request->all()); // Update the product with new data

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    // 6. **DELETE**: Remove the specified product from the database (destroy)
    public function destroy(Product $product)
    {
        $product->delete(); // Delete the product

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}

