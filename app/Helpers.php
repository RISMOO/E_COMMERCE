<?php


function getPrice2($priceInDecimals){//on pourra utiliser la fonction dans toute notre application



//dans mon composer.json je renseigne laravel de prendre en compte mon helper
//dans le fichier composer.json on y a joute  "files":[
     //    "app/Helpers.php"

    //    ],

    //ensuite dans le terminal composer dump-autoload
    //dans notre vue index.blade on englobe notre card::subtotal avec la fonction getPrice2

  $price =floatval($priceInDecimals) / 100;
 //on convertit notre prix en centime en decimal
   return number_format($price,2,',','');


}
