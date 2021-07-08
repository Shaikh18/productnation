<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Products extends Model
{
    protected  $fillable = [
        'product_img',
        'product_name',
        'product_c_name',
        'product_price'
    ];

}
