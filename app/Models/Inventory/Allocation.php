a<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allocation extends Model
{
    use HasFactory;
    protected $fillable = [
        "inventory_id",
        "item_code",
        "description",
        "category",
        "current_stock_level",
        "min_stock_level",
        "max_stock_level",
        "reorder_point",
        "lead_time",
        "last_replenishment_date",
        "demand_forecast",
        "sales_channels",
        "allocation_qty",
        "alloation_date",
        "location",
        "demand_variability",
        "safety_stock",
        "order_qty",
        "availability"
    ];
}
