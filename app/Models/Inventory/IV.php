<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IV extends Model
{
    use HasFactory;
    protected $fillable = [
        "inventory_id",
        "part_number",
        "unit_cost",
        "vehicle",
        "qty_on_hand",
        "total_cost",
        "valuation_method",
        "valuation_date",
        "inventory_value",
        "inventory_turnover",
        "stock_aging",
        "financial_metrics",
        "inventory_adjustments",
        "inventory_reserves",
        "inventory_analysis",
        "inventory_reports",
        "comparison_metrics",
        "comlpiance",
        "audit_trials",
    ];
}
