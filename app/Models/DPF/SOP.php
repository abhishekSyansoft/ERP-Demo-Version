<?php

namespace App\Models\DPF;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SOP extends Model
{
    use HasFactory;
    protected $fillable = [
        'forecast_id',
        'production_plan_id',
        'sales_target',
        'production_target'
    ];
}
