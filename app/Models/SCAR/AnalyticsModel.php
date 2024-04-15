<?php

namespace App\Models\SCAR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalyticsModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'metric_name',
        'value',
        'date'
    ];
}
