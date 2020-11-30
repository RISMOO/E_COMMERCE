<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model

{

     protected $fillable =['stock'];//le camps que lon veut modifier

    public function getPrice()
{
    $price = $this->price / 100;
    return number_format($price, 2, ',', ' ');//2 chiffres apres la virgule

}

public function categories(){

    return $this->belongsToMany('App\Category');
}


}


