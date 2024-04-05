<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $fillable = [
        "category_id",
        "product_name",
        "product_image",
        "product_description",
        "product_sku",
        "product_hsn",
        "product_uom",
        "product_weight",
        "product_volume",
        "product_taxrate",
        "product_price",
        "product_currency",
        "product_quantity",
    ];
}
