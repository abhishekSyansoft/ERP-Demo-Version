<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WM extends Model
{
    use HasFactory;
    protected $fillable = [
        "warehouse_name",
        "location",
        "capacity",
    ];
}
