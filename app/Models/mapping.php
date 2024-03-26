<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mapping extends Model
{
    use HasFactory;
    protected $fillable = [
        'role',
        'module'
    ];
}
