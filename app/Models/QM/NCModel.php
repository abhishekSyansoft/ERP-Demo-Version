<?php

namespace App\Models\QM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NCModel extends Model
{
    use HasFactory;
    protected $fillable = [
        "qc_id",
        "non_conformance_date",
        "action_taken"
    ];
}
