<?php

namespace App\Models\RFQ;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompList extends Model
{
    use HasFactory;
    protected $fillable = [
        'pr_num',
        'rfq_num',
        'qut_num',
        'payment_terms',
        'lead_time',
        'qut_date',
        'dos',
        'quotation',
        'total_amount'
    ];
}
