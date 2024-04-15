<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IO extends Model
{
    use HasFactory;
    protected $fillable = [
        "product_id",
        "reorder_point",
        "optimal_quantity",
    ];
}
