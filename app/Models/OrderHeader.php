<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHeader extends Model
{
    use HasFactory;
    protected $fillable = [
        "dealer_id",
        "order_id",
        "order_header",
        "order_date",
        "order_status",
        "total_amount",
        "sales_representative",
        "shipping_address",
        "billing_address",
        "payment_method",
        "payment_status",
        "sipping_method",
        "shipping_carrier",
        "shipping_tracking_number",
        "expected_delivery_date",
        "order_notes",
        "order_source",
        "item_count",
        "priority",
        "discount",
        "order_totoal",
        "return_rma",
        "comments",
        "attachments",
    ];

}
