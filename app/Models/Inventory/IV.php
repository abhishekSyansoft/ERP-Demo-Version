<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IV extends Model
{
    use HasFactory;
    protected $fillable = [
        "product_id",
        "unit_cost",
        "total_value",
    ];
}
