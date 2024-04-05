<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentModules extends Model
{
    use HasFactory;
    protected $fillable = [
        "parent_module",
        "parent_icon"
    ];
}
