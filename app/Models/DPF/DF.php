<?php

namespace App\Models\DPF;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DF extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'forecast_quantity',
        'forecast_date'
    ];
}
