<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parts extends Model
{
    use HasFactory;

    protected $fillable = [
        "part_number",
        "serial_number",
        "part_name",
        "vehicle",
        "part_description",
        "notes",
        "warranty_description",
        "location",
        "shelf_number",
        "condition",
        "unit_cost",
        "qty_on_hand",
        "min_stock_level",
        "max_stock_level",
        "compatability",
        "barcode",
        "image",
        "supplier_id",
        "lead_time"
    ];
}
