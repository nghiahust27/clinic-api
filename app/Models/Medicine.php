<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medicine extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['code', 'name', 'unit', 'price',
    'stock', 'is_active'];
}
