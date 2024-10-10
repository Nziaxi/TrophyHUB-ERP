<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function create()
    {
        return view('materials.create');  // Return the view for adding products
    }

    public function store(Request $request)
    {
        // Validate form data
        $validatedData = $request->validate([
            'material_name' => 'required|max:255',
            'category' => 'required',
            'description' => 'nullable',
            'material_image' => 'nullable|image',
            'unit' => 'required',
            'price' => 'required|numeric',
        ]);

        if ($request->hasFile('material_image')) {
            $path = $request->file('material_image')->store('public/materials');
        }        

        return redirect()->back()->with('success', 'Material added successfully!');
    }
}