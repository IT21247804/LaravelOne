<?php
// app/Models/Purchase.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'user_id', 'quantity'];

    // Each purchase belongs to one product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Each purchase belongs to one user (who made the purchase)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
