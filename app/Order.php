<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Orderlist_address;

class Order extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function orderlist_address(){
        return $this->hasMany('App\Orderlist_address');
    }
 
    public function orderItems(){
    	
        return $this->hasMany('App\OrderItem');
    }

    public function country(){
    	return $this->belongsTo('App\country');
    }
}

