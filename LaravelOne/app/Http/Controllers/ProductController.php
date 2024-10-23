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
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048' // Validate the image
        ]);
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
        } else {
            $imagePath = null;
        }
    
        // Create the product with image path
        Product::create(array_merge(
            $request->all(),
            ['image' => $imagePath]
        ));
    
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        // Find the product by ID
        $product = Product::findOrFail($id);
        // Get all categories for the dropdown
        $categories = Category::all();
        // Return the edit view with the product and categories
        return view('products.edit', compact('product', 'categories'));
    }
    
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048' // Validate the image
        ]);
    
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image) {
                \Storage::delete('public/' . $product->image);
            }
    
            // Store new image
            $imagePath = $request->file('image')->store('product_images', 'public');
        } else {
            $imagePath = $product->image; // Keep existing image if no new one is uploaded
        }
    
        // Update product with new data
        $product->update(array_merge(
            $request->all(),
            ['image' => $imagePath]
        ));
    
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }    

    // 6. **DELETE**: Remove the specified product from the database (destroy)
    public function destroy(Product $product)
    {
        $product->delete(); // Delete the product

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

 public function show(Product $product)
 {
    return view('products.show', compact('product'));
 }

    public function userProducts(Request $request)
{
    $categories = Category::all();  // Fetch all categories
    $selectedCategory = $request->get('category');

    // Fetch products based on selected category
    $products = Product::with('category')
        ->when($selectedCategory, function ($query) use ($selectedCategory) {
            return $query->where('category_id', $selectedCategory);
        })
        ->paginate(10); // Ensure you are retrieving the products collection

    return view('user-dashboard', compact('products', 'categories', 'selectedCategory'));
}

    
}

