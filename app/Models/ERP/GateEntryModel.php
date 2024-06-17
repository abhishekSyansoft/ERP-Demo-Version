<?php

namespace App\Models\ERP;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GateEntryModel extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'dnn',
        'delivery_date',
        'delivery_time',
        'vehicle_number',
        'driver_name',
        'driver_contact',
        'invoice_number',
        'invoice_date',
        'po_number',
        'order_date',
        'item_id',
        'item_name',
        'quantity_delivered',
        'passed_qty',
        'failed_qty',
        'packaging_condition',
        'labeling',
        'visual_inspection_notes',
        'photo_evidence',
        'inspector_name',
        'inspector_id_signature',
        'inspection_status',
        'grn_number'
    ];
}
