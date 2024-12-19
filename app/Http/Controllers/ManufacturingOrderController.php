<?php

namespace App\Http\Controllers;

use App\Models\BillOfMaterial;
use App\Models\ManufacturingOrder;
use App\Models\ManufacturingOrderMaterial;
use App\Models\Product;
use Illuminate\Http\Request;
use DB;

class ManufacturingOrderController extends Controller
{
    //
    public function index()
    {
        // Ambil semua data Manufacturing Order beserta relasinya
        $manufacturingOrders = ManufacturingOrder::with(['product', 'bom'])->get();

        // Kirim data ke view
        return view('mo.index', compact('manufacturingOrders'));
    }

    public function create()
    {
        // Ambil data produk dan BoM untuk dropdown
        $products = Product::all();
        $boms = BillOfMaterial::with('components.material')->get(); // Memuat BoM dan bahan terkait
        return view('mo.create', compact('products', 'boms'));
    }


    public function store(Request $request)
    {
        // try {
        // dd($request->all());
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'bom_id' => 'required|exists:bill_of_materials,id',
            'quantity' => 'required|integer|min:1',
            'dateline' => 'required|date|after_or_equal:planning_date',
            'planning_date' => 'required|date',
            'responsible_person' => 'required|string|max:255',
            'materials.*.material_id' => 'required|exists:material,id',
            'materials.*.required' => 'required|numeric|min:0',
            'materials.*.ordered' => 'nullable|numeric|min:0',
            'materials.*.used' => 'nullable|numeric|min:0',
        ]);

        DB::transaction(function () use ($validated) {
            // Buat Manufacturing Order
            $mo = ManufacturingOrder::create([
                'product_id' => $validated['product_id'],
                'bom_id' => $validated['bom_id'],
                'quantity' => $validated['quantity'],
                'dateline' => $validated['dateline'],
                'planning_date' => $validated['planning_date'],
                'responsible_person' => $validated['responsible_person'],
            ]);

            // Simpan data material ke tabel pivot
            foreach ($validated['materials'] as $materialData) {
                ManufacturingOrderMaterial::create([
                    'manufacturing_order_id' => $mo->id,
                    'material_id' => $materialData['material_id'],
                    'required_quantity' => $materialData['required'],
                    'ordered_quantity' => $materialData['ordered'] ?? 0,
                    'used_quantity' => $materialData['used'] ?? 0,
                ]);
            }
        });

        return redirect()->route('mo.index')->with('success', 'Manufacturing Order berhasil ditambahkan.');
        // } catch (\Illuminate\Validation\ValidationException $e) {
        //     // Menangani kesalahan validasi
        //     return redirect()->back()->withErrors($e->errors())->withInput();
        // } catch (\Exception $e) {
        //     // Menangani kesalahan umum
        //     \Log::error('Kesalahan saat menyimpan Manufacturing Order: ' . $e->getMessage());
        //     return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        // }
    }
}
