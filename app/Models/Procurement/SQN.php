<?php

namespace App\Models\Procurement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SQN extends Model
{
    use HasFactory;
    protected $fillable = [
        'pr_num',
        'rfq_num',
        'qut_num',
        'visibility',
        'supplier_id',
        'item_id',
        'price',
        'valid_until',
    ];
}
