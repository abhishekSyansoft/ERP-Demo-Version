<?php

namespace App\Models\QM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SQModel extends Model
{
    use HasFactory;
    protected $fillable = [
        "supplier_id",
        "quality_rating",
        "audit_date"
    ];
}
