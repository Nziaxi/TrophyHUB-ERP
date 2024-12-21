<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table = 'material';
    protected $fillable = ['material_name', 'unit', 'price'];

    public function manufacturingOrderMaterials()
    {
        return $this->hasMany(ManufacturingOrderMaterial::class);
    }

    public function manufacturingOrders()
    {
        return $this->belongsToMany(ManufacturingOrder::class, 'manufacturing_order_materials')
            ->withPivot('required_quantity', 'ordered_quantity', 'used_quantity')
            ->withTimestamps();
    }
}
