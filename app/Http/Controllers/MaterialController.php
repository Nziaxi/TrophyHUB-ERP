<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::all();
        return view('materials.index', compact('materials'));
    }
    public function create()
    {
        return view('materials.create');
    }

    public function store(Request $request)
    {
        $request->validate(['material_name' => 'required', 'unit' => 'required', 'price' => 'required|numeric',]);
        Material::create(['material_name' => $request->material_name, 'unit' => $request->unit, 'price' => $request->price,]);
        return redirect()->route('materials.index');
    }

    public function edit($id)
    {
        $material = Material::findOrFail($id);
        return view('materials.edit', compact('material'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['material_name' => 'required', 'unit' => 'required', 'price' => 'required|numeric',]);
        $material = Material::findOrFail($id);
        $material->update(['material_name' => $request->material_name, 'unit' => $request->unit, 'price' => $request->price,]);
        return redirect()->route('materials.index');
    }

    public function destroy($id)
    {
        $material = Material::findOrFail($id);
        $material->delete();
        return redirect()->route('materials.index');
    }
}
