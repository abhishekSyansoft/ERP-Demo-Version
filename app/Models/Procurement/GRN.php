<?php

namespace App\Models\Procurement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GRN extends Model
{
    use HasFactory;
    protected $fillable = [
        "po_id",
        "received_date",
        "received_quantity",
    ];
}
