<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SC extends Model
{
    use HasFactory;
    protected $fillable = [
        "product_id",
        "quantity_available",
        "location_id",
    ];
}
