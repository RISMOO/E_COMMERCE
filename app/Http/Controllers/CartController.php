<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cart.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {

        //on recherche notre produit
            $duplicata = Cart::search(function ($cartItem, $rowId) use ($request) {//cherche un produit retourne item qui contient lid du produit
            return $cartItem->id === $request->product_id;
           });

           if($duplicata->isNotEmpty()){
            return redirect()->route('products.index')->with('success','Ce produit a deja été ajouté');
           }

           $product=Product::find($request->product_id);


           Cart::add($product->id, $product->title, 1, $product->price)
                   ->associate('App\Product');//on associe notre produit a nore model Product



               return redirect()->route('products.index')->with('success','Le produit a bien été ajouté dans votre panier');


    }

    //////COUPON//////////////////
public function storeCoupon(Request $request)

{

    $code=$request->get('code');//on stocke la requete//code= name du formulaire

    $coupon=Coupon::where('code',$code)->first(); //je re'cupere le code ou le code est egal au code que lon a entrer code et on ^rend le 1er enregistrement
    //On recupere notre coupon dans notre base de données

    if(!$coupon){//si on a pâs le coupons dans notre base de données
      return redirect()->back()->with('error','Le coupon est invalide');

    }

//SI LE COUPON EST VALIDE
    $request->session()->put('coupon',[//notre reqete appelle notre session qui aura comme clé coupon et comme valeur le tableau
     'code'=>$coupon->code,//code aura la valeur de coupon->code//cle name
     'remise'=>$coupon->discount(Cart::subtotal())//la methode discount je la creee dans mon model coupon
    ]);
    return redirect()->back()->with('success','Le coupon est apppliqué');
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
    public function update(Request $request, $rowId)
    {

        $data =$request->json()->all();//onn recupere nos données
         //regle pour le select

        $validator=Validator::make($request->all(),[
           'qty' => 'required|numeric|between:1,6'
        ]);

        if($validator->fails()){

            Session::flash('error','La quantité doit etre comprise entre 1 et 6');

            return response()->json(['error'=>'Cart Quantity Has Not bBeen Updated']);

        }

        if($data['qty'] > $data['stock']){

            Session::flash('error','La quantité de ce produit n\'est pas disponible.');

            return response()->json(['error'=>'Produit Quantity not Available']);

        }



        Cart::update($rowId, $data['qty']);//mise a jour du select

        Session::flash('success','La quantité a été modifié a ' . $data['qty'] . '.');

        return response()->json(['success'=>'Cart Quantity Has Been Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($rowId)
    {
        Cart::remove($rowId);
        return back()->with('success','Le produit a été supprimé');
    }

    public function destroyCoupon()



    {
     request()->session()->forget('coupon');

     return redirect()->back()->with('success','Le coupon a été retiré');

    }
}
