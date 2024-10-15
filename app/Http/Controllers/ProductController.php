<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Ambil semua data produk
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');  // Return the view for adding products
    }

    public function store(Request $request)
    {
        // Validate form data
        $validatedData = $request->validate([
            'product_name' => 'required|max:255',
            'category' => 'required',
            'description' => 'nullable',
            'product_image' => 'nullable|image',
            'selling_price' => 'required|numeric',
            'production_cost' => 'required|numeric',
        ]);

        // Save the product image if available
        if ($request->hasFile('product_image')) {
            $path = $request->file('product_image')->store('public/products');
            $validatedData['product_image'] = $path;
        }

        // Create a new product
        Product::create($validatedData);

        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }
}
