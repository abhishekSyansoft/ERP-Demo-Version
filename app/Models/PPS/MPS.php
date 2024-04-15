<?php

namespace App\Models\PPS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MPS extends Model
{
    use HasFactory;
    protected $fillable = [
       'product_id',
       'planned_quantity',
       'planned_start_date',
       'planned_end_date',
       'status'
    ];
}
