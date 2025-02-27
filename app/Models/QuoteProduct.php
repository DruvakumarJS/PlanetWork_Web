<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteProduct extends Model
{
    protected $fillable = [
    	'quote_id',
    	'product_id',
    	'revised_price',
    	'quantity',
    	'tax',
    	'amount'
    ];
}
