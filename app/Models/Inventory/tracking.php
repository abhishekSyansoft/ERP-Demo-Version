<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tracking extends Model
{
    use HasFactory;
    protected $fillable = [
        "inventory_id",
        "item_code",
        "description",
        "category",
        "location",
        "qty_on_hand",
        "min_stock_level",
        "max_stock_level",
        "reorder_point",
        "unit_cost",
        "total_cost",
        "supplier",
        "received_date",
        "updated_date",
        "serial_number",
        "qrcode",
        "barcode",
        "condition",
        "expiry_date",
        "quality_control_detail",
        "availability"
    ];
}
