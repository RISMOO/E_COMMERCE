<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public function discount($subtotal)//calcler a partir du sous total

    {
      return ($subtotal * ( $this->percent_off / 100 ));//le pourcentage aapplliqué au sous total

    }
}
