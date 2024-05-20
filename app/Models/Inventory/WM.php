<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WM extends Model
{
    use HasFactory;
    protected $fillable = [
        "warehouse_id",
        "warehouse_name",
        "warehouse_manager",
        "address",
        "city",
        "state",
        "pincode",
        "capacity",
        "layout",
        "storage_zone",
        "shelf_number",
        "inventory_allocation",
        "inventory_movement",
        "inventory_levels",
        "picking_and_packing",
        "loading_and_unloading",
        "safety_and_security",
        "maintenance_and_sheduling",
        "temprature_and_climate_control",
        "emergency_procedures",
        "inventory_audits",
        "documents_and_records",
        "integration_with_ims",
        "barcode",
        "qrcode"
    ];
}
