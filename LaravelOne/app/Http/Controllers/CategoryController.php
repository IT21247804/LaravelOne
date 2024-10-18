<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // 1. **GET**: Fetch all categories (index)
    public function index()
    {
        $categories = Category::all(); // Fetch all categories
        return view('categories.index', compact('categories'));
    }

    // 2. **GET**: Show the form to create a new category (create)
    public function create()
    {
        return view('categories.create'); // Show the create form
    }

    // 3. **POST**: Store a newly created category in the database (store)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Category::create($request->all()); // Create a new category

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    // 4. **GET**: Show the form to edit an existing category (edit)
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category')); // Show the edit form
    }

    // 5. **PUT/PATCH**: Update the specified category in the database (update)
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $category->update($request->all()); // Update the category

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    // 6. **DELETE**: Remove the specified category from the database (destroy)
    public function destroy(Category $category)
    {
        $category->delete(); // Delete the category

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}


