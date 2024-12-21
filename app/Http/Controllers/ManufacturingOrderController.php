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
    public function index()
    {
        $manufacturingOrders = ManufacturingOrder::with(['product', 'bom'])->get();
        return view('mo.index', compact('manufacturingOrders'));
    }
    public function create()
    {
        $products = Product::all();
        $boms = BillOfMaterial::with('components.material')->get();
        return view('mo.create', compact('products', 'boms'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'bom_id' => 'required|exists:bill_of_materials,id',
            'quantity' => 'required|integer|min:1',
            'dateline' => 'required|date|after_or_equal:planning_date',
            'planning_date' => 'required|date',
            'responsible_person' => 'required|string|max:255',
            'materials.*.material_id' => 'required|exists:material,id',
            'materials.*.required' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($validated) {
            $mo = ManufacturingOrder::create([
                'product_id' => $validated['product_id'],
                'bom_id' => $validated['bom_id'],
                'quantity' => $validated['quantity'],
                'dateline' => $validated['dateline'],
                'planning_date' => $validated['planning_date'],
                'responsible_person' => $validated['responsible_person'],
            ]);

            foreach ($validated['materials'] as $materialData) {
                ManufacturingOrderMaterial::create([
                    'manufacturing_order_id' => $mo->id,
                    'material_id' => $materialData['material_id'],
                    'required_quantity' => $materialData['required'],
                    'ordered_quantity' => 0,
                    'used_quantity' => 0,
                ]);
            }
        });

        return redirect()->route('mo.index')->with('success', 'Manufacturing Order berhasil ditambahkan.');
    }


    public function edit(ManufacturingOrder $mo)
    {
        $products = Product::all();
        $boms = BillOfMaterial::with('components.material')->get();
        $mo->load('materials');
        return view('mo.edit', compact('mo', 'products', 'boms'));
    }

    public function update(Request $request, ManufacturingOrder $mo)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'bom_id' => 'required|exists:bill_of_materials,id',
            'quantity' => 'required|numeric|min:1',
            'dateline' => 'required|date',
            'planning_date' => 'required|date',
            'responsible_person' => 'required|string|max:255',
            'materials.*.material_id' => 'required|exists:material,id',
            'materials.*.required_quantity' => 'nullable|numeric|min:0',  // Nullable agar tidak wajib
            'materials.*.ordered_quantity' => 'nullable|numeric|min:0',  // Nullable agar tidak wajib
            'materials.*.used_quantity' => 'nullable|numeric|min:0',  // Nullable agar tidak wajib
        ]);

        // Update data utama MO
        $mo->update([
            'product_id' => $validated['product_id'],
            'bom_id' => $validated['bom_id'],
            'quantity' => $validated['quantity'],
            'dateline' => $validated['dateline'],
            'planning_date' => $validated['planning_date'],
            'responsible_person' => $validated['responsible_person'],
        ]);

        // Update pivot data untuk bahan
        $materialsData = collect($validated['materials'])->mapWithKeys(function ($material) {
            return [
                $material['material_id'] => [
                    'required_quantity' => $material['required_quantity'] ?? 0,  // Default jika kosong
                    'ordered_quantity' => $material['ordered_quantity'] ?? 0,  // Default jika kosong
                    'used_quantity' => $material['used_quantity'] ?? 0,  // Default jika kosong
                ]
            ];
        });

        $mo->materials()->sync($materialsData);

        return redirect()->route('mo.index')->with('success', 'MO berhasil diperbarui.');
    }

    public function updateStatus(Request $request, ManufacturingOrder $mo)
    {
        $validated = $request->validate([
            'status_production' => 'required|in:draft,in progress,completed',
        ]);
        $mo->status_production = $validated['status_production'];
        $mo->save();
        return redirect()->route('mo.edit', $mo->id)->with('success', 'Status produksi berhasil diperbarui.');
    }
}
