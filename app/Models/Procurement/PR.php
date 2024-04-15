<?php

namespace App\Models\Procurement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PR extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "requisition_date",
        "status",
    ];
}
