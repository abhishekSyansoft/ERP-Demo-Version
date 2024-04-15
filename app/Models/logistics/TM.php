<?php

namespace App\Models\logistics;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TM extends Model
{
    use HasFactory;
    protected $fillable=[
        "transport_mode",
        "departure_location",
        "arrival_location",
        "departure_date",
        "arrival_date"
    ];
}
