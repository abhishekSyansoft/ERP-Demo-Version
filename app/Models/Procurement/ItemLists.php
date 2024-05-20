<?php

namespace App\Models\Procurement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemLists extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'part_number',
        'vehicle',
        'part_name',
        'unit_price',
        'quantity',
        'total_price',
        'category',
        'pr_num',
        'item_type',
        'item_des',
        'item_feature'
    ];
}
