<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManufacturingOrderMaterial extends Model
{
    use HasFactory;

    protected $table = 'manufacturing_order_materials';
    protected $fillable = [
        'manufacturing_order_id',
        'material_id',
        'required_quantity',
        'ordered_quantity',
        'used_quantity',
    ];

    public function manufacturingOrder()
    {
        return $this->belongsTo(ManufacturingOrder::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
