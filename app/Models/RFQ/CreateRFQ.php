<?php

namespace App\Models\RFQ;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreateRFQ extends Model
{
    use HasFactory;

    protected $fillable=[
        'pr_num',
        'rfq_num',
        'rfq_status',
        'send',
        'date',
        'status'
    ];
}
