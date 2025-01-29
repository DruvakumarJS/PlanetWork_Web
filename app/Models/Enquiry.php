<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $fillable = [
        'enquiry_no',
	    'customer_type',
	    'customer_name',
	    'company_name',
	    'salutaion',
	    'first_name',
	    'last_name',  
	    'email',
	    'mobile',
	    'date',
	    'details',
	    'user_id',
	    'status',
    ];

    public function user(){
    	return $this->belongsTo(User::class);
    }
}
