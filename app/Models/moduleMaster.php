<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class moduleMaster extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'url',
        'mdi_icon'
    ];
}
