<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class price extends Model
{
        public function order()
    {
        return $this->belongsTo('App\Order');
    }
}
