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
    $validatedData = $request->validate([
        'product_name' => 'required',
        'category' => 'required',
        'description' => 'nullable',
        'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'selling_price' => 'required|numeric',
        'production_cost' => 'required|numeric',
    ]);

    // Jika ada gambar yang diunggah
    if ($request->hasFile('product_image')) {
        $path = $request->file('product_image')->store('products', 'public'); // Simpan ke folder 'products' di disk 'public'
        $validatedData['product_image'] = $path; // Simpan path gambar ke dalam database
    }

    Product::create($validatedData);

    return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

}
