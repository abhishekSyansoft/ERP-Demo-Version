<?php

namespace App\Models\PPS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MRp extends Model
{
    use HasFactory;
    protected $fillable = [
        "material_id",
        "quantity_required",
        "due_date",
        "order_type",
    ];
}
