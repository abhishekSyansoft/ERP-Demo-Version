<?php

namespace App\Models\QM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QCModel extends Model
{
    use HasFactory;
    protected $fillable = [
        "product_id",
        "inspection_date",
        "result",
        "remarks"
    ];
}
