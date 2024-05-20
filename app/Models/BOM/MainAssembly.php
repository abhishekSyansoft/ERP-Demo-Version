<?php

namespace App\Models\BOM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainAssembly extends Model
{
    use HasFactory;
    protected $fillable = [
        'parent_id',
        'name'
    ];
}
