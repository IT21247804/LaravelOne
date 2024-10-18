<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // 1. **GET**: Fetch all products (index)
    public function index()
    {
        $products = Product::with('category')->get(); // Fetch all products with their associated categories
        return view('products.index', compact('products'));
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

