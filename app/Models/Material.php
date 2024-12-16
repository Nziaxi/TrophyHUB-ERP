<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table = 'material'; // Name of the table
    protected $fillable = ['material_name', 'unit', 'price'];

    public function bomComponents()
    {
        return $this->hasMany(BomComponent::class);
    }
}
