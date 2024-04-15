<?php

namespace App\Models\logistics;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DN extends Model
{
    use HasFactory;
    protected $fillable=[
        "distribution_center_id",
        "location",
        "capacity",
    ];
}
