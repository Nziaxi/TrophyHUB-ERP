<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
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

        if ($request->hasFile('product_image')) {
            $path = $request->file('product_image')->store('public/products');
        }        

        return redirect()->back()->with('success', 'Product added successfully!');
    }
}
