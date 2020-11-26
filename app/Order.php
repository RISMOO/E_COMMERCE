<?php

namespace App;

use App\Order;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user(){



            return $this->belongsTo('App\User');

    }
}
