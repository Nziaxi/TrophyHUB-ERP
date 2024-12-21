<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BomComponent extends Model
{
    use HasFactory;

    protected $table = 'bom_components'; // Name of the table
    protected $fillable = ['bill_of_material_id', 'material_id', 'quantity'];

    public function material()
    {
        return $this->belongsTo(Material::class); // Relate to 'material' table without 's'
    }

    public function billOfMaterial()
    {
        return $this->belongsTo(BillOfMaterial::class);
    }
}
