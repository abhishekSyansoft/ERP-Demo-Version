<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterial extends Model
{
    use HasFactory;
    protected $fillable = [
        "material_name",
        "material_description",
        "unit_of_measure",
        "lead_time",
        "safety_stock",
        "storage_condition",
        "shelf_life",
        "supplier_id",
        "cost_per_unit"
    ];
}
