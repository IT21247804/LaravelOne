<?php

// app/Http/Controllers/PurchaseController.php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PurchaseController extends Controller
{
    // Store a new purchase
    public function store(Request $request)
{
    try {
        // Validate request
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        // Create a purchase
        Purchase::create([
            'product_id' => $request->input('product_id'),
            'user_id' => Auth::id(),  // Automatically associate with logged-in user
            'quantity' => $request->input('quantity')
        ]);

       // return response()->json(['message' => 'Purchase successful']);
       return redirect()->route('user-dashboard');
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Log validation errors
        Log::error('Validation error during purchase: ', $e->errors());
        return response()->json(['message' => 'Validation error', 'errors' => $e->errors()], 422);
    } catch (\Exception $e) {
        // Log any other exceptions
        Log::error('Error during purchase: ' . $e->getMessage());
        return response()->json(['message' => 'An error occurred while processing your purchase.'], 500);
    }
}

    // Show all purchases for a user (optional, if needed)
    // public function index()
    // {
    //     $purchases = Purchase::where('user_id', Auth::id())->with('product')->get();
    //    // return view('purchases.index', compact('purchases'));
    // }
}

