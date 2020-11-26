<?php

namespace App\Http\Controllers;

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

            Session::flash('danger','La quantité ne dois pas dépasser 6');

            return response()->json(['error'=>'Cart Quantity Has NotbBeen Updated']);

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
}
