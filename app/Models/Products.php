<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    public $fillable = [
        'product_name',
        'product_model_num',
        'product_company_name',
        'product_price'
    ];
}
