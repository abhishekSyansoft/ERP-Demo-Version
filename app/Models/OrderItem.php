<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        "order_id",
        "product_name",
        "product_id",
        "quantity",
        "unit_price",
        "total_price",
        "sku",
        "tax_rate",
        "tax_amount",
        "discount",
        "sub_total",
        "line_item_total",
    ];
}
