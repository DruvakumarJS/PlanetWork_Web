<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
            'product_type',
            'product_name',
            'product_code',
            'tax_preference',
            'sku',
            'hsn_code',
            'product_image',
            'product_desc',
            'Price',
            'units',
            'gst',
            'igst',
            'selling_price',
            'in_stocks',
            'in_market',
            'user_id',
        ];
}
