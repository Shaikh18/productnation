<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    public $fillable = [
        'product_img',
        'product_name',
        'product_company_name',
        'product_price'
    ];
}
