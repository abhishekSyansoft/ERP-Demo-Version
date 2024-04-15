<?php

namespace App\Models\DPF;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DC extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'collaborator_id',
        'forecast_quantity',
        'collaboration_date'
    ];
}
