<?php

namespace App\Models\supplier;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class resource extends Model
{
    use HasFactory;
    protected $fillable = [
        "resource_name",
        "rsource_description",
    ];
}
