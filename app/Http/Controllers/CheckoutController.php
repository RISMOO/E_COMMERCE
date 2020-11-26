<?php

namespace App\Http\Controllers;

use DateTime;
use App\Order;
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

          $intent = \Stripe\PaymentIntent::create([
            'amount' =>round (Cart::total()),//montant valeur décimale,on arrondi avec round()
            'currency' => 'eur',


           'metadata' => ['integration_check' => 'accept_a_payment'],
          ]);
         $clientSecret=Arr::get($intent, 'client_secret');//Arr est un helper de tableau qui va nous retourner la clé secrete
        return view ('checkout.index')->with('clientSecret',$clientSecret);

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
         
        $data = $request->json()->all();

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

        if ($data['paymentIntent']['status'] === 'succeeded') {
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
        //
    }
}
