<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManufacturingOrder extends Model
{
    use HasFactory;

    protected $table = 'manufacturing_orders';
    protected $fillable = [
        'product_id',
        'bom_id',
        'quantity',
        'deadline',
        'scheduled_date',
        'responsible_person',
        'production_status',
        'status'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function bom()
    {
        return $this->belongsTo(BillOfMaterial::class);
    }

    public function manufacturingOrderMaterials()
    {
        return $this->hasMany(ManufacturingOrderMaterial::class);
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'manufacturing_order_materials')
            ->withPivot('required_quantity', 'ordered_quantity', 'used_quantity')
            ->withTimestamps();
    }
}
