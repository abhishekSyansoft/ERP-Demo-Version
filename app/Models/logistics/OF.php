<?php

namespace App\Models\logistics;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OF extends Model
{
    use HasFactory;
    protected $fillable = [
        "order_id",
        "fulfillment-date",
        "status"
    ];
}
