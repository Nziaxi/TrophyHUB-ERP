<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillOfMaterial extends Model
{
    use HasFactory;

    protected $table = 'bill_of_materials'; // Name of the table
    protected $fillable = ['product_id', 'bom_code'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function components()
    {
        return $this->hasMany(BomComponent::class);
    }
}
