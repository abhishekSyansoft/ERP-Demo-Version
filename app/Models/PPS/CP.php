<?php

namespace App\Models\PPS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CP extends Model
{
    use HasFactory;
    protected $fillable = [
        "resource_id",
        "date",
        "shift",
        "capacity_available",
    ];
}
