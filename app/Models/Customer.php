<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
            'customer_no',
            'customer_type',
            'company_name',
            'salutaion',
            'first_name',
            'last_name',  
            'email',
            'mobile',
            'gst',
            'treatment',
            'pan',
            'payment',
            'supply',
            'user_id',
            'enquiry_id',
            'status',
    ];

    public function addresses(){
    	return $this->hasMany(Address::class);
    }
}
