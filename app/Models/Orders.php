<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    public $fillable = [
        'product_name',
        'product_model_num',
        'product_company_name',
        'product_price',
        'total_pricing',
        'status'
    ];
}
