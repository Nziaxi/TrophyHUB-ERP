<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BomController extends Controller
{
    public function index()
    {
        // Logic untuk menampilkan daftar BoM
        return view('bom.index');  // Buat view bom.index untuk menampilkan data BoM
    }

    public function create()
    {
        // Logic untuk menampilkan form tambah BoM
        return view('bom.create');  // Buat view bom.create untuk form tambah BoM
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
