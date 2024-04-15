<?php

namespace App\Models\logistics;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IOL extends Model
{
    use HasFactory;
    protected $fillable=[
        "transport_id",
        "order_id",
        "received_date",
        "dispatched_date",
    ];
}
