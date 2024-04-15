<?php

namespace App\Models\Procurement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CM extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_id',
        'start_date',
        'end_date',
        'terms_and _condition',
    ];
}
