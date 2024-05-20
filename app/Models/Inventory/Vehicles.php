<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicles extends Model
{
    use HasFactory;
    protected $fillable = [
        'vin',
        'model',
        'year',
        'color',
        'trim',
        'mileage',
        'condition',
        'price',
        'location',
        'status',
        'salesperson',
        'image',
        'history',
        'features',
        'vehicles_identification_documents',
        'availability',
        'warranty_information',
        'financial_information',
        'trade_in_information',
        'min_stock_level',
        'max_stock_level'
    ];
}
