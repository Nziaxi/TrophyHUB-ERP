<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class BomController extends Controller
{
    public function index()
    {
        // Logic untuk menampilkan daftar BoM
        return view('bom.index');  // Buat view bom.index untuk menampilkan data BoM
    }

    public function create()
{
    // Ambil data produk dari database
    $products = Product::all(); // Atau sesuaikan dengan model produk Anda

    // Kirim data produk ke view
    return view('bom.create', compact('products'));
}


    public function store(Request $request)
    {
        // Logic untuk menyimpan data BoM
        $validatedData = $request->validate([
            // Tambahkan validasi yang sesuai
        ]);

        // Simpan data BoM ke database
        // ...

        return redirect()->route('bom.index')->with('success', 'BoM added successfully!');
    }
}
