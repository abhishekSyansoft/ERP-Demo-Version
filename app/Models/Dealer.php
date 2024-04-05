<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    use HasFactory;
    protected $fillable = [
        'dealership_name',
        'dealership_contact_person',
        'dealership_contact_number',
        'dealership_contact_email',
        'dealership_contact_address',
        'dealership_located_city',
        'dealership_located_state/province',
        'dealership_located_country',
        'dealership_located_pincode',
        'dealership_type',
        'dealership_business_type',
        'dealership_associated_brand',
        'dealership_sales_territory',
        'dealership_taxid',
        'dealership_licence_number',
        'dealership_registration_date',
        'dealership_licence_renewal_date',
        'dealership_status',
        'dealership_notes',
    ];
}
