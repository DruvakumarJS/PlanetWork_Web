<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = [
        'customer_id',
	    'billing_address',
	    'shipping_address',
	    'quote_number',
	    'quote_date',
	    'expiry_date',
	    'sub_total',
	    'discount_percentage',
	    'discount_amount',
	    'adjustment',
	    'grant_total',
	    'customer_note',
	    'terms',
	    'status',
	    'user_id',
    ];

    public function customer(){
    	return $this->belongsTo(Customer::class);
    }
}
