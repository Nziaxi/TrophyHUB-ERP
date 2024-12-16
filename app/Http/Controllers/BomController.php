<?php

// app/Http/Controllers/BomController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\BillOfMaterial;
use App\Models\BomComponent;
use App\Models\Material;
use DB;

class BomController extends Controller
{
    public function index()
    {
        // Retrieve all BoM records
        $boms = BillOfMaterial::with('product')->get();
        return view('bom.index', compact('boms'));
    }

    public function create()
    {
        // Retrieve all products and materials for the form
        $products = Product::all();
        $materials = Material::all();
        return view('bom.create', compact('products', 'materials'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'bom_code'   => 'required|string|unique:bill_of_materials,bom_code',
            'components' => 'required|array',
            'components.*.material_id' => 'required|exists:material,id',  // Sesuaikan nama tabel di sini
            'components.*.quantity'    => 'required|numeric|min:0.01',
        ]);

        // Transaction to ensure both tables are inserted properly
        DB::beginTransaction();

        try {
            // Simpan BoM ke database
            $bom = BillOfMaterial::create([
                'product_id' => $validatedData['product_id'],
                'bom_code'   => $validatedData['bom_code'],
            ]);

            // Simpan komponen ke tabel bom_components
            foreach ($validatedData['components'] as $component) {
                BomComponent::create([
                    'bill_of_material_id' => $bom->id,
                    'material_id' => $component['material_id'],
                    'quantity'    => $component['quantity'],
                ]);
            }

            // Commit transaction
            DB::commit();
            return redirect()->route('bom.index')->with('success', 'BoM berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Rollback transaction if any error occurs
            DB::rollback();
            \Log::error('Error storing BoM: ' . $e->getMessage());
            return back()->withErrors('Terjadi kesalahan saat menyimpan BoM.');
        }
    }

    public function edit($id)
    {
        // Retrieve BoM and its components
        $bom = BillOfMaterial::with('components.material')->findOrFail($id);
        $products = Product::all();
        $materials = Material::all();
        return view('bom.edit', compact('bom', 'products', 'materials'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'bom_code'   => 'required|string|unique:bill_of_materials,bom_code,' . $id,
            'components' => 'required|array',
            'components.*.material_id' => 'required|exists:material,id',
            'components.*.quantity'    => 'required|numeric|min:0.01',
        ]);

        // Transaction to ensure updates are properly handled
        DB::beginTransaction();

        try {
            $bom = BillOfMaterial::findOrFail($id);
            $bom->update([
                'product_id' => $validatedData['product_id'],
                'bom_code'   => $validatedData['bom_code'],
            ]);

            // Clear existing components and insert updated ones
            $bom->components()->delete();

            foreach ($validatedData['components'] as $component) {
                BomComponent::create([
                    'bill_of_material_id' => $bom->id,
                    'material_id' => $component['material_id'],
                    'quantity'    => $component['quantity'],
                ]);
            }

            // Commit transaction
            DB::commit();
            return redirect()->route('bom.index')->with('success', 'BoM berhasil diperbarui!');
        } catch (\Exception $e) {
            // Rollback transaction if any error occurs
            DB::rollback();
            \Log::error('Error updating BoM: ' . $e->getMessage());
            return back()->withErrors('Terjadi kesalahan saat memperbarui BoM.');
        }
    }

    public function destroy($id)
    {
        // Delete the BoM and its components
        DB::beginTransaction();

        try {
            $bom = BillOfMaterial::findOrFail($id);
            $bom->components()->delete();
            $bom->delete();

            // Commit transaction
            DB::commit();
            return redirect()->route('bom.index')->with('success', 'BoM berhasil dihapus!');
        } catch (\Exception $e) {
            // Rollback transaction if any error occurs
            DB::rollback();
            \Log::error('Error deleting BoM: ' . $e->getMessage());
            return back()->withErrors('Terjadi kesalahan saat menghapus BoM.');
        }
    }
}
