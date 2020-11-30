<?php

namespace App\Http\Controllers;

use DateTime;
use App\Order;
use App\Coupon;
use App\Product;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()


    {
          //si on a pas de produits dans notre panier on peux pas acceder au paiement
          if(Cart::count() <= 0) {
            return redirect()->route('products.index');

        }

        \Stripe\Stripe::setApiKey('sk_test_51HqC2FAWXp5BVHyzBrasAaSqDOlS1VxFeHZU9HQXoVok3HlY830MfhrZBrIRvS8HqxKlXzPYZw0fVPAoAqOkTA4z00zlUAN8LM');


        if(request()->session()->has('coupon')){//si dans notre session on a un coupon nouveau total
       $total= (Cart::subtotal() - request()->session()->get('coupon')['remise'] + (Cart::subtotal() - request()->session()->get('coupon')['remise']) * (config('cart.tax') /100));

        }else{

            $total=Cart::total();
        }
          $intent = \Stripe\PaymentIntent::create([
            'amount' =>round ($total),//montant valeur décimale,on arrondi avec round()
            'currency' => 'eur',


           'metadata' => ['integration_check' => 'accept_a_payment'],
          ]);
         $clientSecret=Arr::get($intent, 'client_secret');//Arr est un helper de tableau qui va nous retourner la clé secrete
        return view ('checkout.index', [
            'clientSecret'=>$clientSecret,
            'total'=>$total//sera egal avec ou sans remise 


        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          //on verfie en 1ere si le produit est disponible

        if( $this->checkIfNotAvailable()){//fonction CheCk //csi notre produit n'est plus disponible
             //si la focntion renvoi true
             Session::flash('error', 'Un produit dans votre panier n\'est plus disponible ');
             return response()->json(['success'=>false], 400);//status 400
        }




        $data = $request->json()->all();//requete ajax checkout.index stripe

        $order = new Order();

        $order->payment_intent_id = $data['paymentIntent']['id'];
        $order->amount = $data['paymentIntent']['amount'];

        $order->payment_created_at = (new DateTime())
            ->setTimestamp($data['paymentIntent']['created'])
            ->format('Y-m-d H:i:s');

        $products = [];
        $i = 0;

        foreach (Cart::content() as $product) {
            $products['product_' . $i][] = $product->model->title;
            $products['product_' . $i][] = $product->model->price;
            $products['product_' . $i][] = $product->qty;
            $i++;
        }

        $order->products = serialize($products);
        $order->user_id = auth()->user()->id;//lutilisateur connecté
        $order->save();

        if ($data['paymentIntent']['status'] === 'succeeded') {//si le paiement c'est bien passé on decremente le produit avant de supprmier le panier
            $this->updateStock();//on appelle la fonction updateStock()
            Cart::destroy();

            Session::flash('success', 'Votre commande a été traitée avec succès.');
            return response()->json(['success' => 'Payment Intent Succeeded']);
        } else {
            return response()->json(['error' => 'Payment Intent Not Succeeded']);
        }
    }

    public function thankyou()

    {
        return Session::has('success') ? view('checkout.thankyou') : redirect()->route('products.index');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }


    private function checkIfNotAvailable (){
        foreach (Cart::content() as $itemPanier) {
            $product=Product::find($itemPanier->model->id);//on recupere l'item correspondant a lid


         if($product->stock < $itemPanier->qty) {  //si  on a un stock inferieur a la quantité que lon aura selctionne dans notre panier

            return true;//si il renvoie true le produit n'est plus disponible en base de données
         }
        }

  return false;
    }

    //une fonction private quyi sera appeler  seulement dans notre class checkout
    private function updateStock()//mise ajour du stock
    {
    //on va boucler sur nore panier et a chaque fois on va recuperter le produit de notre panier et le soustraire la quantité  a notre stock

     foreach (Cart::content() as $itemPanier) {
         $product=Product::find($itemPanier->model->id);//on recupere l'item correspondant a lid

         $product->update(['stock'=>$product->stock - $itemPanier->qty]);//on met a jour la collone stock
         //on pense a rajhouter un fillable dans notre model product.php


     }



    }

    public function destroyCoupon()
    {
       $coupon=Coupon::remove();

    }


}
