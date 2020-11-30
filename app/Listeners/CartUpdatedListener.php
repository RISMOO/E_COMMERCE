<?php

namespace App\Listeners;

use App\Coupon;
use Illuminate\Queue\InteractsWithQueue;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Queue\ShouldQueue;

class CartUpdatedListener
//php artisan make:listener cartUpdatedListener
//on va ecouter notre panier et réactualiser notre coupon
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //reactualisera le coupan en session

        $code=request()->session()->get('coupon');//si la session contient un coupon

        $coupon=Coupon::where('code',$code)->first(); //je re'cupere le code ou le code est egal au code que lon a entrer code et on ^rend le 1er enregistrement
        //On recupere notre coupon dans notre base de données
        if($coupon){

          //SI LE COUPON ON RECUPERE UN COUPON
        request()->session()->put('coupon',[//notre reqete appelle notre session qui aura comme clé coupon et comme valeur le tableau
        'code'=>$coupon->code,//code aura la valeur de coupon->code//cle name
        'remise'=>$coupon->discount(Cart::subtotal())
       ]);


        }


        }

 //ON SE REND DANS PRIVIDERS EVENTSERVICEPROVIDER


    }

