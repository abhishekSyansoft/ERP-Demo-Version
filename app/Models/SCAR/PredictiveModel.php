<?php

namespace App\Models\SCAR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PredictiveModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'model_name',
        'prediction_value',
        'prediction_date'
    ];
}
