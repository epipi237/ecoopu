<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{


	protected $table='order_items';
	
	public function order(){
		return $this->belongsTo('App\Order');
	}

	public function user(){
		return $this->belongsTo('App\User');
	}
}
