<?php

namespace App\Models\supplier;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    use HasFactory;
    protected $fillable = [
        "supplier_name",
        "contact_person",
        "email",
        "phone_number",
        "address",
        "city",
        "state",
        "country",
        "postal_code",
        "account_number",
        "tax_id",
        "payment_terms",
        "lead_time",
        "notes",
    ];
}
