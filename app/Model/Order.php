<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function orders(){
        return $this->hasMany('App\Model\OrderProduct', 'order_id');
    }
}
